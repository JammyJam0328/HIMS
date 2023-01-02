<?php

namespace App\Http\Livewire\Roomboy;

use App\Models\Room;
use Livewire\Component;
use App\Models\CleaningHistory;
use Illuminate\Support\Facades\DB;

class Index extends Component
{


    public function cleanAssignedRoom(Room $room)
    {
            if(auth()->user()->room_boy_cleaning_room_id){
                $this->dispatchBrowserEvent('error',[
                    'type'=>'error',
                    'title'=>'Error',
                    'message'=>'You are already cleaning a room'
                ]);
                return;
            }

            DB::beginTransaction();
                $room->update([
                    'status'=>Room::CLEANING,
                    'started_cleaning_at'=>now(),
                ]);

                auth()->user()->update([
                    'room_boy_cleaning_room_id'=>$room->id,
                ]);
                DB::commit();

            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'title'=>'Success',
                'message'=>'Room is now cleaning'
            ]);
    }

    public function finishCleaing()
    {
        $room = Room::find(auth()->user()->room_boy_cleaning_room_id);
        
        if(now()->diffInMinutes($room->started_cleaning_at) < 15){
            $this->dispatchBrowserEvent('alert',[
                'type'=>'error',
                'title'=>'Error',
                'message'=>'You need to clean for at least 15 minutes'
            ]);
            return;
        }

        $priorityRoomsCount = Room::whereBranchId(auth()->user()->branch_id)
            ->whereStatus(Room::AVAILABLE)
            ->whereIsPriority(true)
            ->count();

        DB::beginTransaction();
         
            CleaningHistory::create([
                'user_id'=>auth()->user()->id,
                'room_id'=>$room->id,
                'floor_id'=>$room->floor_id,
                'current_assigned_floor_id'=>auth()->user()->room_boy_assigned_floor_id == $room->floor_id ? true : false,
                'start_time'=>$room->started_cleaning_at,
                'end_time'=>\Carbon\Carbon::now(),
                'expected_end_time'=>$room->time_to_clean,
                'cleaning_duration'=>now()->diffInMinutes($room->started_cleaning_at),
                'delayed_cleaning'=>\Carbon\Carbon::parse($room->time_to_clean)->isPast() ? true : false,
            ]);

            auth()->user()->update([
                'room_boy_cleaning_room_id'=>null,
            ]);

            $room->update([
                'status'=>Room::AVAILABLE,
                'started_cleaning_at'=>null,
                'time_to_clean'=>null,
                'is_priority'=> $priorityRoomsCount < 10 ? true : false,
            ]);

            DB::commit();

            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'title'=>'Success',
                'message'=>'Room is now clean'
            ]);
    }
    public function render()
    {
        return view('livewire.roomboy.index',[
            'assignedRooms'=>Room::whereBranchId(auth()->user()->branch_id)
                ->whereStatus(Room::UNCLEAN)
                ->whereFloorId(auth()->user()->room_boy_assigned_floor_id)
                ->with(['user'])
                ->orderBy('last_checkout_at','asc')
                ->get(),

            'unassignedRooms'=>Room::whereBranchId(auth()->user()->branch_id)
                ->whereStatus(Room::UNCLEAN)
                ->where('floor_id','!=',auth()->user()->room_boy_assigned_floor_id)
                ->with(['user'])
                ->get(),
        ]);
    }
}
