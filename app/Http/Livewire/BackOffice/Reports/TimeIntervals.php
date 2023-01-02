<?php

namespace App\Http\Livewire\BackOffice\Reports;

use App\Models\Room;
use App\Models\RoomCheckinInterval;
use Livewire\Component;

class TimeIntervals extends Component
{
    public $rooms = [];
    public $date = null;

    public $shift = null;

    public function mount()
    {
        $this->rooms = Room::query()
            ->whereBranchId(auth()->user()->branch_id)
            ->get();
    }
    public function render()
    {
        return view('livewire.back-office.reports.time-intervals',[
            'room_checkin_intervals' => $this->date ? RoomCheckinInterval::query()
                ->whereBranchId(auth()->user()->branch_id)
                ->when($this->date, function($query){
                    if ($this->shift == 'AM') {
                        $query->whereBetween('check_in_time', [
                                \Carbon\Carbon::parse($this->date)->format('Y-m-d 08:00:00'), 
                                \Carbon\Carbon::parse($this->date)->format('Y-m-d 19:59:59')
                    ]);
                    } else if ($this->shift == 'PM') {
                        $nextDay = \Carbon\Carbon::parse($this->date)->addDay()->format('Y-m-d 07:59:59');
                        $query->whereBetween('check_in_time', [
                            \Carbon\Carbon::parse($this->date)->format('Y-m-d 20:00:00'), 
                            $nextDay
                        ]);
                    } else {
                        $nextDay = \Carbon\Carbon::parse($this->date)->addDay()->format('Y-m-d 07:59:59');
                        $query->whereBetween('check_in_time', [\Carbon\Carbon::parse($this->date)->format('Y-m-d 08:00:00'), $nextDay]);
                    }
                })
                ->with(['guest'])
                ->get()->groupBy('room_id') : [],
        ]);
    }
}
