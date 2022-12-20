<?php

namespace App\Http\Livewire\Admin\Rooms;

use App\Models\Floor;
use App\Models\Room;
use Livewire\Component;

class Create extends Component
{
    public $room;

    public $statuses = [];

    public $roomTypes = [];

    public $floors = [];

    public function rules()
    {
        return [
            'room.branch_id' => 'nullable',
            'room.floor_id' => 'required|exists:floors,id,branch_id,'.auth()->user()->branch_id,
            'room.number' => 'required|numeric|unique:rooms,number,NULL,id,branch_id,'.auth()->user()->branch_id,
            'room.status' => 'required|in:'.implode(',', array_keys($this->statuses)),
            'room.type_id' => 'required|exists:types,id,branch_id,'.auth()->user()->branch_id,
            'room.is_priority' => 'nullable|boolean',
            'room.last_checkin_at' => 'nullable|date',
            'room.last_checkout_at' => 'nullable|date',
            'room.time_to_terminate_in_queue' => 'nullable|date',
            'room.time_to_clean' => 'nullable|date',
        ];
    }

    protected $validationAttributes = [
        'room.branch_id' => 'branch',
        'room.floor_id' => 'floor',
        'room.number' => 'number',
        'room.status' => 'status',
        'room.type_id' => 'type',
    ];

    public function store()
    {
        $this->validate();

        $this->room->save();

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Record has been saved successfully',
        ]);

        return redirect()->route('admin.rooms');
    }

    public function mount()
    {
        $this->room = Room::make([
            'branch_id' => auth()->user()->branch_id,
            'status' => Room::AVAILABLE,
            'is_priority' => true,
        ]);
        $this->statuses = Room::STATUSES;

        $this->roomTypes = auth()->user()->branch->roomTypes;

        $this->floors = Floor::whereBranchId(auth()->user()->branch_id)->get();
    }

    public function render()
    {
        return view('livewire.admin.rooms.create');
    }
}
