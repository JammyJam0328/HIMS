<?php

namespace App\Http\Livewire\Admin\Rates;

use App\Models\Type;
use Livewire\Component;

class Index extends Component
{
    public function mount()
    {
    }

    public function render()
    {
        return view('livewire.admin.rates.index', [
            'types' => Type::whereBranchId(auth()->user()->branch_id)->with('rates.stayingHour')->get(),
        ]);
    }
}
