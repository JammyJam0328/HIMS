<?php

namespace App\Http\Livewire\Admin\Discounts;

use App\Models\Discount;
use Livewire\Component;

class Create extends Component
{
    public $discount;

    public function rules()
    {
        return [
            'discount.branch_id' => 'nullable',
            'discount.name' => 'required|unique:discounts,name,NULL,id,branch_id,'.auth()->user()->branch_id,
            'discount.description' => 'nullable',
            'discount.amount' => 'required|numeric|min:0',
            'discount.is_percentage' => 'required|in:0,1',
            'discount.is_available' => 'nullable',
        ];
    }

    public function store()
    {
        $this->validate();

        $this->discount->save();

        \session()->flash('alert', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Record has been saved successfully',
        ]);

        return redirect()->route('admin.discounts');
    }

    public function mount()
    {
        $this->discount = Discount::make([
            'branch_id' => auth()->user()->branch_id,
            'is_percentage' => '0',
            'is_available' => '0',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.discounts.create');
    }
}
