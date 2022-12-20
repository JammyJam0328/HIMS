<?php

namespace App\Http\Livewire\Admin\Discounts;

use App\Models\Discount;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        return view('livewire.admin.discounts.index', [
            'discounts' => Discount::whereBranchId(auth()->user()->branch_id)
                        ->when($this->search != '', function ($query) {
                            $query->where('name', 'like', '%'.$this->search.'%');
                        })
                        ->paginate(10),
        ]);
    }
}
