<?php

namespace App\Http\Livewire\Frontdesk\PriorityRooms;

use App\Models\Room;
use Livewire\Component;
use Livewire\WithPagination;
class Index extends Component
{
    use WithPagination;

    public function removeFromPriority(Room $room)
    {
        $room->update([
            'is_priority' => false
        ]);
    }

    public function addToPriority(Room $room)
    {
        $room->update([
            'is_priority' => true
        ]);
    }

    public function render()
    {
        return view('livewire.frontdesk.priority-rooms.index',[
            'priorityRooms'=> Room::whereBranchId(auth()->user()->branch_id)
                ->whereStatus(Room::AVAILABLE)
                ->whereIsPriority(true)
                ->with(['floor'])
                ->orderBy('number', 'asc')
                ->get()
                ->take(10),
            'availableRooms'=> Room::whereBranchId(auth()->user()->branch_id)
                ->whereStatus(Room::AVAILABLE)
                ->whereIsPriority(false)
                ->with(['floor'])
                ->orderBy('number', 'asc')
                ->get()->take(10),
        ]);
    }
}
