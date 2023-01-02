<?php

namespace App\Http\Livewire\Frontdesk\Transactions\TransferRoom;

use Carbon\Carbon;
use App\Models\Rate;
use App\Models\Room;
use App\Models\Type;
use App\Models\Floor;
use App\Models\Guest;
use Livewire\Component;
use App\Models\Frontdesk;
use App\Models\Transaction;
use App\Traits\WithCaching;
use App\Models\RoomTransfer;
use Illuminate\Support\Facades\DB;
use App\Models\RoomCheckinInterval;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests , WithCaching;

    public $guest;

    public $rates = [];

    public $types = [];

    public $floors = [];

    public $rooms = [];

    public $newRoomId;

    public $newRoomNumber;

    public $transferReason;

    public $newRoomTypeId;

    public $newRoomRateId;

    public $newRoomFloorId;

    public $newRoomAmount;

    public $oldRoomAmount;

    public $oldRoomStatus;

    public $totalAmountToPay = 0;

    public $excessAmountFromPreviousPayment = 0;

    public $settingAdministratorCode;

    public $saveToDeposit = false;

    public function mount($guest)
    {
        abort_unless($this->guest = Guest::find($guest), 404);
        $this->authorize('view', $this->guest);

        $this->loadData();
        $this->getNewRoomAmountToPay();
    }

    public function loadData()
    {
        $this->guest->refresh();

        $this->newRoomTypeId = $this->guest->type_id;
        $this->newRoomRateId = $this->guest->rate_id;
        $this->newRoomFloorId = $this->guest->floor_id;

        $this->types = Type::whereBranchId(auth()->user()->branch_id)->get();
        $this->floors = Floor::whereBranchId(auth()->user()->branch_id)->get();
        $this->rooms = Room::query()
                        ->whereBranchId(auth()->user()->branch_id)
                        ->whereStatus(Room::AVAILABLE)
                        ->whereTypeId($this->newRoomTypeId)
                        ->whereFloorId($this->newRoomFloorId)
                        ->get();
        $this->getOldRoomAmountPaid();
    }

    public function getRoomTransferHistoryProperty()
    {
        return $this->cache(function () {
            return Transaction::whereGuestId($this->guest->id)
                            ->whereType(Transaction::TRANSFER_ROOM)
                            ->get();
        });
    }

    public function updatedNewRoomTypeId()
    {
        $this->useCacheRows();
        $this->findRooms();
        $this->whenNoAvailableRooms($this->rooms);
    }

    public function updatedNewRoomFloorId()
    {
        $this->useCacheRows();
        $this->findRooms();
        $this->whenNoAvailableRooms($this->rooms);
    }

    public function findRooms()
    {
        $this->rooms = Room::query()
                ->whereBranchId(auth()->user()->branch_id)
                ->whereStatus(Room::AVAILABLE)
                ->whereTypeId($this->newRoomTypeId)
                ->whereFloorId($this->newRoomFloorId)
                ->get();
        $this->getNewRoomAmountToPay();
    }

    public function getOldRoomAmountPaid()
    {
        $this->oldRoomAmount = $this->guest->recent_transfer_amount ?? $this->guest->check_in_amount;
    }

    public function getNewRoomAmountToPay()
    {
        $newRate = Rate::whereTypeId($this->newRoomTypeId)
                        ->whereStayingHourId($this->guest->staying_hour_id)
                        ->first();
        $this->newRoomRateId = $newRate->id;

        if ($this->guest->is_long_stay) {
            $this->newRoomAmount = $newRate->amount * $this->guest->long_stay_number_of_days;
        } else {
            $this->newRoomAmount = $newRate->amount;
        }

        $this->totalAmountToPay = $this->oldRoomAmount > $this->newRoomAmount ? 0 : $this->newRoomAmount - $this->oldRoomAmount;
        $this->excessAmountFromPreviousPayment = $this->oldRoomAmount > $this->newRoomAmount ? $this->oldRoomAmount - $this->newRoomAmount : 0;
    }

    public function whenNoAvailableRooms($rooms)
    {
        if (count($rooms) == 0) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'title' => 'Alert',
                'message' => 'No available rooms in this floor',
            ]);
        }
    }

    public function transferRoom()
    {
        $this->validate([
            'newRoomId' => 'required',
            'settingAdministratorCode' => 'required|in:'.auth()->user()->branch->setting_administrator_code,
            'transferReason' => 'required | max:255',
        ]);

        DB::beginTransaction();

        if ($this->guestIsNotAllowedToTransfer()) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'title' => 'Alert',
                'message' => 'Guest is not allowed to transfer room : Guest may have transferred room 2 times already or 3 hours has passed since check in time',
            ]);

            return;
        }

        $newRoom = $this->rooms->find($this->newRoomId)->load('type');

        if ($newRoom->status != Room::AVAILABLE) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'title' => 'Alert',
                'message' => 'Room is not available',
            ]);

            return;
        }

        $this->newRoomNumber = $newRoom->number;

        $oldRoom = $this->guest->room;

        $oldRoom->update([
            'status' => $this->oldRoomStatus,
            'is_priority' => $this->oldRoomStatus == Room::CLEANED ? true : false,
            'last_checkout_at' => now(),
            'time_to_clean' => $this->oldRoomStatus == Room::UNCLEAN ? now()->addHours(3) : null,
            'check_out_time' => null,
        ]);

        Transaction::create([
            'branch_id' => auth()->user()->branch_id,
            'floor_id' => $this->guest->floor_id,
            'room_id' => $this->guest->room_id,
            'guest_id' => $this->guest->id,
            'description' => 'Transfer room from RM# '.$this->guest->room_number.' ('.$this->guest->roomType->name.') to RM# '.$newRoom->number.' ('.$newRoom->type->name.')',
            'type' => Transaction::TRANSFER_ROOM,
            'payable_amount' => $this->totalAmountToPay,
            'return_amount' => $this->oldRoomAmount > $this->newRoomAmount ? $this->oldRoomAmount - $this->newRoomAmount : 0,
            'change_amount' => $this->excessAmountFromPreviousPayment,
            'change_has_been_deposit' => $this->saveToDeposit,
            'paid_at' => $this->totalAmountToPay == 0 ? now() : null,
        ]);

        $this->guest->update([
            'room_id' => $this->newRoomId,
            'type_id' => $this->newRoomTypeId,
            'rate_id' => $this->newRoomRateId,
            'floor_id' => $this->newRoomFloorId,
            'room_number' => $this->newRoomNumber,
            'recent_transfer_amount' => $this->newRoomAmount,
            'total_deposits' => $this->saveToDeposit ? $this->guest->total_deposits + $this->excessAmountFromPreviousPayment : $this->guest->total_deposits,
            'transfered_count' => $this->guest->transfered_count + 1,
        ]);

        $newRoom->update([
            'status' => Room::OCCUPIED,
            'is_priority' => false,
            'last_checkin_at' => now(),
            'check_out_time' => $this->guest->expected_checkout_at,
        ]);

        RoomCheckinInterval::create([
            'branch_id' => auth()->user()->branch_id,
            'room_id' => $this->newRoomId,
            'guest_id' => $this->guest->id,
            'last_check_out' => $newRoom->last_checkout_at,
            'check_in_time' => now(),
            'duration' => $newRoom->last_checkout_at ? now()->diffInMinutes(Carbon::parse($newRoom->last_checkout_at)) : 0,
        ]);

        if ($this->saveToDeposit) {
            $this->guest->deposits()->create([
                'branch_id' => auth()->user()->branch_id,
                'description' => 'Transfer room from '.$this->guest->room->number.' to '.$newRoom->number,
                'amount' => $this->excessAmountFromPreviousPayment,
                'floor_id' => $this->guest->floor_id,
            ]);
        }


        $frontdesks = Frontdesk::whereBranchId(auth()->user()->branch_id)
        ->whereActive(true)
        ->with('employee')
        ->get()->map(function ($frontdesk) {
            return [
                'id' => $frontdesk->id,
                'name' => $frontdesk->employee->name,
            ];
        })->toArray();

        RoomTransfer::create([
            'branch_id' => auth()->user()->branch_id,
            'guest_id' => $this->guest->id,
            'from_room_id' => $oldRoom->id,
            'from_room_type_id' => $oldRoom->type_id,
            'to_room_id' => $newRoom->id,
            'to_room_type_id' => $newRoom->type_id,
            'from_room_number' => $oldRoom->number,
            'from_room_type' => $oldRoom->type->name,
            'to_room_number' => $newRoom->number,
            'to_room_type' => $newRoom->type->name,
            'reason' => $this->reason,
            'frontdesks'=>json_encode($frontdesks),
            'transact_by_admin'=>auth()->user()->hasRole('admin') ? auth()->user()->id : null
        ]);

        $this->oldRoomAmount = $this->newRoomAmount;

        DB::commit();

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Room transfered successfully',
        ]);
        $this->dispatchBrowserEvent('close-form');
    }

    public function guestIsNotAllowedToTransfer()
    {
        return $this->guest->transfered_count == 2 || Carbon::parse($this->guest->checkin_at)->diffInHours(now()) > 3;
    }

    public function render()
    {
        return view('livewire.frontdesk.transactions.transfer-room.index', [
            'transactions' => $this->guest ? $this->roomTransferHistory : [],
        ]);
    }
}
