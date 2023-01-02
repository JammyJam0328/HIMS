<?php

namespace App\Http\Livewire\BackOffice\Reports;

use Livewire\Component;
use App\Models\CleaningHistory;

class OverdueRooms extends Component
{
    public $date = null;

    public $shift = null; // AM = 8:00 AM - 8:00 PM, PM = 8:00 PM - 8:00 AM

    public function render()
    {
        return view('livewire.back-office.reports.overdue-rooms', [
            'cleaningHistories' => CleaningHistory::whereHas('room', function ($query) {
                $query->where('branch_id', auth()->user()->branch_id);
            })
                ->whereDelayedCleaning(true)
                ->when($this->date, function ($query) {
                    if ($this->shift == 'AM') {
                        $query->whereTime('expected_end_time', '>=', '08:00:00')
                            ->whereTime('expected_end_time', '<=', '19:59:59');
                    } else if ($this->shift == 'PM') {
                        $nextDay = \Carbon\Carbon::parse($this->date)->addDay()->format('Y-m-d 07:59:59');
                        $query->whereTime('expected_end_time', '>=', '20:00:00')
                            ->whereTime('expected_end_time', '<=', $nextDay);
                    } else {
                        $nextDay = \Carbon\Carbon::parse($this->date)->addDay()->format('Y-m-d 07:59:59');
                        $query->whereBetween('expected_end_time', [\Carbon\Carbon::parse($this->date)->format('Y-m-d 08:00:00'), $nextDay]);
                    }
                })
                ->get()
        ]);
    }
}
