<?php

namespace App\Http\Livewire\BackOffice;

use Livewire\Component;
use App\Models\Transaction;

class OccupiedRoom extends Component
{

    public $date = null;

    public $shift = null; // AM = 8:00 AM - 8:00 PM, PM = 8:00 PM - 8:00 AM

    public function render()
    {
        return view('livewire.back-office.occupied-room', [
            'transactions' => $this->date ?
                Transaction::whereBranchId(auth()->user()->branch_id)
                ->whereType(Transaction::CHECKED_IN_ROOM)
                ->when($this->date, function ($query) {
                    if ($this->shift == 'AM') {
                        $query->whereTime('created_at', '>=', '08:00:00')
                            ->whereTime('created_at', '<=', '19:59:59');
                    } else if ($this->shift == 'PM') {
                        $nextDay = \Carbon\Carbon::parse($this->date)->addDay()->format('Y-m-d 07:59:59');
                        $query->whereTime('created_at', '>=', '20:00:00')
                            ->whereTime('created_at', '<=', $nextDay);
                    } else {
                        $nextDay = \Carbon\Carbon::parse($this->date)->addDay()->format('Y-m-d 07:59:59');
                        $query->whereBetween('created_at', [\Carbon\Carbon::parse($this->date)->format('Y-m-d 08:00:00'), $nextDay]);
                    }
                })
                ->with(['guest', 'room'])
                ->get()
                : [],
        ]);
    }
}
