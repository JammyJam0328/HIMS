<?php

namespace App\Http\Livewire\Frontdesk\CheckIn;

use App\Models\Deposit;
use App\Models\Guest;
use App\Models\Room;
use App\Models\RoomCheckinInterval;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ViewGuest extends Component
{
    public $guest;

    public $totalAmountToPay = 0;

    public $changeAmount = 0;

    public $givenAmount = 0;

    public $changeSaveToDeposit = false;

    public function rules()
    {
        return [
            'givenAmount' => 'required|numeric|min:'.$this->totalAmountToPay,
            'changeAmount' => 'required|numeric|min:0',
        ];
    }

    protected $validationAttributes = [
        'givenAmount' => 'given amount',
        'changeSaveToDeposit' => 'save change to deposit',
        'changeAmount' => 'change amount',
    ];

    public function checkIn()
    {
        $this->validate();

        DB::beginTransaction();

        if ($this->changeSaveToDeposit) {
            Deposit::create([
                'branch_id' => auth()->user()->branch_id,
                'guest_id' => $this->guest->id,
                'description' => 'Change from check in',
                'amount' => $this->changeAmount,
                'floor_id' => $this->guest->floor_id,
            ]);
        }

        Transaction::create([
            'branch_id' => auth()->user()->branch_id,
            'floor_id' => $this->guest->floor_id,
            'room_id' => $this->guest->room_id,
            'guest_id' => $this->guest->id,
            'description' => 'Check in to ROOM #'.$this->guest->room_number,
            'type' => Transaction::CHECKED_IN_ROOM,
            'payable_amount' => $this->totalAmountToPay - 200,
            'given_amount' => $this->givenAmount,
            'from_deposit_amount' => false,
            'change_amount' => $this->changeAmount,
            'change_has_been_deposit' => $this->changeSaveToDeposit,
            'paid_at' => now(),
        ]);

        $this->guest->update([
            'status' => Guest::CHECKED_IN,
            'checked_in_at' => now(),
            'total_deposits' => $this->changeSaveToDeposit ? $this->changeAmount : 0,
            'default_deposits' => 200,
            'expected_checkout_at' => now()->addHours($this->guest->staying_hours),
        ]);

        RoomCheckinInterval::create([
            'branch_id' => auth()->user()->branch_id,
            'room_id' => $this->guest->room_id,
            'guest_id' => $this->guest->id,
            'last_check_out' => $this->guest->room->last_checkout_at,
            'check_in_time' => now(),
            'duration' => $this->guest->room->last_checkout_at ? now()->diffInMinutes($this->guest->room->last_checkout_at) : 0,
        ]);

        $this->guest->room->update([
            'status' => Room::OCCUPIED,
            'last_checkin_at' => now(),
            'check_out_time' => now()->addHours($this->guest->staying_hours),
        ]);

        $priorityRooms = Room::whereBranchId(auth()->user()->branch_id)
            ->whereStatus(Room::AVAILABLE)
            ->whereIsPriority(true)
            ->count();

        if ($priorityRooms < 10) {
            $cleanRoom = Room::whereBranchId(auth()->user()->branch_id)
                ->whereStatus(Room::CLEANED)
                ->whereIsPriority(false)
                ->first();
            $cleanRoom->update([
                'status' => Room::AVAILABLE,
                'is_priority' => true,
            ]);
        }

        DB::commit();

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Guest checked in successfully',
        ]);

        return redirect()->route('frontdesk.check-in');
    }

    public function mount($guest)
    {
        abort_unless($this->guest = Guest::whereId($guest)
            ->whereBranchId(auth()->user()->branch_id)
            ->whereStatus(Guest::IN_KIOSK)
            ->first(), 404);
        $this->totalAmountToPay = $this->guest->check_in_amount + 200;
    }

    public function render()
    {
        return view('livewire.frontdesk.check-in.view-guest');
    }
}
