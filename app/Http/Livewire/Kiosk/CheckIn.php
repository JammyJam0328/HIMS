<?php

namespace App\Http\Livewire\Kiosk;

use App\Events\KioskEvent;
use App\Jobs\ProcessTerminatedGuest;
use App\Models\Guest;
use App\Models\KioskTemporaryStorage;
use App\Models\Rate;
use App\Models\Room;
use App\Models\Type;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\User;

class CheckIn extends Component
{
    public $types = [];

    public $rooms = [];

    public $rates = [];

    public $roomSelectedByOthers = [];

    public $step = 1;

    public $queryString = [
        'step' => ['except' => 1],
    ];

    // guest details
    public $name;

    public $contactNumber;

    public $roomId;

    public $typeId;

    public $floorId;

    public $stayingHourId;

    public $rateId;

    public $stayingHours;

    public $isLongStay = false;

    public $longStayDays;
    // end guest details

    // check in detail
    public $roomNumber;

    public $roomType;

    public $roomRate;

    public $otherKioskIds = [];

    public $generatedQrCode = '';

    public function getListeners()
    {
        $authId = auth()->user()->id;

        return [
            "echo-private:selectroom.".$authId.",KioskEvent" => 'reloadRooms',
        ];
    }

    public function getTypes()
    {
        $this->types = Type::whereBranchId(auth()->user()->branch_id)->whereHas('rooms', function ($query) {
            $query->whereStatus(Room::AVAILABLE)
                ->whereIsPriority(true);
        })->get();
    }

    public function reloadRooms()
    {
       if ($this->typeId) {
         $kioskTemporaryStorages = KioskTemporaryStorage::whereBranchId(auth()->user()->branch_id)->get()->pluck('room_id')->toArray();
            $this->rooms = Room::whereTypeId($this->typeId)
                            ->whereStatus(Room::AVAILABLE)
                            ->whereIsPriority(true)
                            ->whereNotIn('id', $kioskTemporaryStorages)
                            ->with(['type.rates'])
                            ->orderBy('number', 'asc')
                            ->get()
                            ->take(10);
            $this->rates = Rate::whereBranchId(auth()->user()->branch_id)
                            ->whereTypeId($this->typeId)
                            ->with(['stayingHour'])
                            ->get();
        }
        
    }

    public function getRooms($typeId)
    {
        $this->typeId = $typeId;
        $kioskTemporaryStorages = KioskTemporaryStorage::whereBranchId(auth()->user()->branch_id)->get()->pluck('room_id')->toArray();
        $this->rooms = Room::whereTypeId($this->typeId)
                        ->whereStatus(Room::AVAILABLE)
                        ->whereIsPriority(true)
                        ->whereNotIn('id', $kioskTemporaryStorages)
                        ->with(['type.rates'])
                        ->orderBy('number', 'asc')
                        ->get()
                        ->take(10);
        $this->rates = Rate::whereBranchId(auth()->user()->branch_id)
                        ->whereTypeId($this->typeId)
                        ->with(['stayingHour'])
                        ->get();
        
    }

    public function getRates($roomId, $floorId)
    {
        foreach($this->otherKioskIds as $otherKioskId) {
            KioskEvent::dispatch($otherKioskId->id);
        }

        DB::beginTransaction();
        $room = Room::find($roomId);
        KioskTemporaryStorage::whereUserId(auth()->user()->id)->delete();
        $alreadySelectedRoom = KioskTemporaryStorage::whereRoomId($roomId)->first();
        if ($alreadySelectedRoom) {
            $this->step = 2;
            $this->dispatch('alert',[
                'type' => 'error',
                'title' => 'Failed',
                'message' => 'Room already selected by another kiosk'
            ]);
            return;
        }

        KioskTemporaryStorage::create([
            'branch_id' => auth()->user()->branch_id,
            'user_id' => auth()->user()->id,
            'room_id' => $roomId,
        ]);

        DB::commit();
        $this->roomNumber = $room->number;
        $this->floorId = $floorId;
        $this->roomId = $roomId;
        $this->floorId = $floorId;
        $this->step = 3;
    }

    public function selectRate($rateId)
    {
        $this->rateId = $rateId;
        $this->isLongStay = false;
        $this->step = 4;
        $this->getCheckInDetails();
    }

    public function selectLongStay()
    {
        $this->isLongStay = true;
        $this->step = 4;
    }

    public function mount()
    {
        $temporaryStorage = KioskTemporaryStorage::whereUserId(auth()->user()->id)->first();
        if ($temporaryStorage) {
            $temporaryStorage->delete();
        }


        $this->otherKioskIds = User::whereBranchId(auth()->user()->branch_id)
            ->role('kiosk')
            ->where('id', '!=', auth()->user()->id)
            ->get('id');

        $this->getTypes();

        $this->step = 1;
    }

    public function getCheckInDetails()
    {
        if ($this->step != 4) {
            return;
        }

        $this->roomType = Type::find($this->typeId)->name;
        $this->roomRate = $this->isLongStay ? Rate::whereTypeId($this->typeId)->whereHas('stayingHour', fn ($query) => $query->where('number', 24))->first() : Rate::find($this->rateId);
    }

    public function checkIn()
    {
        $this->validate([
            'name' => 'required',
            'contactNumber' => 'required',
            'roomId' => 'required',
            'typeId' => 'required',
            'floorId' => 'required',
            'rateId' => 'required',
        ]);
        DB::beginTransaction();
        $guest = Guest::create([
            'branch_id' => auth()->user()->branch_id,
            'name' => $this->name,
            'contact_number' => $this->contactNumber,
            'room_id' => $this->roomId,
            'initial_room_id' => $this->roomId,
            'type_id' => $this->typeId,
            'floor_id' => $this->floorId,
            'rate_id' => $this->rateId,
            'room_number' => $this->roomNumber,
            'status' => Guest::IN_KIOSK,
            'type' => Guest::WALK_IN,
            'staying_hour_id' => $this->roomRate->staying_hour_id,
            'staying_hours' => $this->isLongStay ? $this->roomRate->stayingHour->number * $this->longStayDays : $this->roomRate->stayingHour->number,
            'static_staying_hours' => $this->isLongStay ? $this->roomRate->stayingHour->number * $this->longStayDays : $this->roomRate->stayingHour->number,
            'is_long_stay' => $this->isLongStay ? 1 : 0,
            'long_stay_number_of_days' => $this->longStayDays ?? null,
            'check_in_amount' => $this->longStayDays ? $this->roomRate->amount * $this->longStayDays : $this->roomRate->amount,
        ]);

        $this->generatedQrCode = $guest->qr_code; // GuestObserver.php

        // update room status
        $room = Room::find($this->roomId);
        $room->status = Room::SELECTED_IN_KIOSK;
        $room->is_priority = false;
        $room->save();
        //
        $this->step = 5;
        ProcessTerminatedGuest::dispatch($guest->id)->delay(now()->addHours(2));

        KioskTemporaryStorage::whereUserId(auth()->user()->id)->delete();

        DB::commit();
    }

    // cast in events
    public function someOneSelectRoom($roomId)
    {
        $this->roomSelectedByOthers[] = $roomId;
        $this->rooms = Room::whereTypeId($this->typeId)
                        ->whereStatus(Room::AVAILABLE)
                        ->whereIsPriority(true)
                        ->whereNotIn('id', $this->roomSelectedByOthers)
                        ->with(['type.rates'])
                        ->orderBy('number', 'asc')
                        ->get()
                        ->take(10);
        $this->rates = Rate::whereBranchId(auth()->user()->branch_id)
                        ->whereTypeId($this->typeId)
                        ->with(['stayingHour'])
                        ->get();
    }
    // end cast in events

    public function render()
    {
        return view('livewire.kiosk.check-in');
    }
}
