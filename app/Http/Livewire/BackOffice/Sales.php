<?php

namespace App\Http\Livewire\BackOffice;

use Livewire\Component;
use App\Models\Transaction;
use App\Models\Floor;

class Sales extends Component
{
    public $floors;

    public $date = null;

    public $shift = null; 

    public function mount()
    {
        $this->floors = Floor::where('branch_id',auth()->user()->branch_id)->get();
    }
 
    public function render()
    {
        return view('livewire.back-office.sales', [
            'sales' => Transaction::where('branch_id',auth()->user()->branch_id)
                ->where('paid_at','!=',null)
                ->when($this->date, function ($query) {
                    if ($this->shift == 'AM') {
                        $query->whereBetween('paid_at', [
                            \Carbon\Carbon::parse($this->date)->format('Y-m-d 08:00:00'), 
                            \Carbon\Carbon::parse($this->date)->format('Y-m-d 19:59:59')
                        ]);
                    } else if ($this->shift == 'PM') {
                        $nextDay = \Carbon\Carbon::parse($this->date)->addDay()->format('Y-m-d 07:59:59');
                        $query->whereBetween('paid_at', [
                            \Carbon\Carbon::parse($this->date)->format('Y-m-d 20:00:00'), 
                            $nextDay
                        ]);
                    } else {
                        $nextDay = \Carbon\Carbon::parse($this->date)->addDay()->format('Y-m-d 07:59:59');
                        $query->whereBetween('paid_at', [\Carbon\Carbon::parse($this->date)->format('Y-m-d 08:00:00'), $nextDay]);
                    }
                })
                ->get()
                ->groupBy('floor_id')
        ]);
    }
}
