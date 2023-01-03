<?php

namespace App\Http\Livewire\BackOffice;

use Livewire\Component;
use App\Models\Transaction;
use App\Models\Floor;

class Sales extends Component
{
    public $floors;

    public function mount()
    {
        $this->floors = Floor::where(
            'branch_id',
            auth()->user()->branch_id
        )->get();
    }
    public function render()
    {
        return view('livewire.back-office.sales', [
            'sales' => Transaction::where(
                'branch_id',
                auth()->user()->branch_id
            )
                ->sum('payable_amount')
                ->get()
                ->groupBy('floor_id'),
        ]);
    }
}
