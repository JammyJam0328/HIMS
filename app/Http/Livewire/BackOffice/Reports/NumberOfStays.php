<?php

namespace App\Http\Livewire\BackOffice\Reports;

use App\Models\Room;
use App\Models\Guest;
use Livewire\Component;

class NumberOfStays extends Component
{
    public $date = null;
    public $shift = null; // AM = 8:00 AM - 8:00 PM, PM = 8:00 PM - 8:00 AM
    public function render()
    {
        return view('livewire.back-office.reports.number-of-stays',[
            'guests' => $this->date ? Guest::whereBranchId(auth()->user()->branch_id)
                ->when($this->date, function($query){
                    $query->whereDate('checked_in_at','>=',$this->date);
                })
                ->when($this->shift == 'AM', function($query){
                   $query->whereTime('checked_in_at','>=','08:00:00')
                        ->whereTime('checked_in_at','<=','19:59:59');
                })
                ->when($this->shift == 'PM', function($query){
                    $nextDay = \Carbon\Carbon::parse($this->date)->addDay()->format('Y-m-d 07:59:59');
                    $query->whereTime('checked_in_at','>=','20:00:00')
                        ->whereTime('checked_in_at','<=',$nextDay);
                })
                ->withSum('transactions', 'payable_amount', function($query){
                    $query->whereType(Transaction::DAMAGES);
                })
                ->withSum('deposits', 'amount')
                ->with(['room.type','transactions'])
                ->get()
                : [],
        ]);
    }
}
