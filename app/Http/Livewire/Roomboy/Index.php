<?php

namespace App\Http\Livewire\Roomboy;

use App\Models\Room;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.roomboy.index',[
            'assignedRooms'=>Room::whereBranchId(auth()->user()->branch_id)
                ->whereStatus(Room::UNCLEAN)
                ->whereFloorId(auth()->user()->room_boy_assigned_floor_id)
                ->orderBy('last_checkout_at','asc')
                ->get(),

            'unassignedRooms'=>Room::whereBranchId(auth()->user()->branch_id)
                ->whereStatus(Room::UNCLEAN)
                ->where('floor_id','!=',auth()->user()->room_boy_assigned_floor_id)
                ->get(),
        ]);
    }
}
