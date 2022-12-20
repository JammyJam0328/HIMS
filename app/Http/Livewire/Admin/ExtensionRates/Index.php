<?php

namespace App\Http\Livewire\Admin\ExtensionRates;

use App\Models\ExtensionRate;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.admin.extension-rates.index', [
            'extensionRates' => ExtensionRate::whereBranchId(auth()->user()->branch_id)
                ->paginate(10),
        ]);
    }
}
