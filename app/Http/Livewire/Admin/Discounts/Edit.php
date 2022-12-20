<?php

namespace App\Http\Livewire\Admin\Discounts;

use App\Models\Discount;
use Livewire\Component;

class Edit extends Component
{
    public $discount;

    public function rules()
    {
        return [
            'discount.branch_id' => 'nullable',
            'discount.name' => 'required|unique:discounts,name,'.$this->discount->id.',id,branch_id,'.auth()->user()->branch_id,
            'discount.description' => 'nullable',
            'discount.amount' => 'required|numeric|min:0',
            'discount.is_percentage' => 'required|in:0,1',
            'discount.is_available' => 'nullable',
        ];
    }

    public function update()
    {
        $this->validate();

        $this->discount->save();

        \session()->flash('alert', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Record has been update successfully',
        ]);

        return redirect()->route('admin.discounts');
    }

    public function mount($discount)
    {
        \abort_unless($this->discount = Discount::find($discount), 404);
    }

    public function render()
    {
        return view('livewire.admin.discounts.edit');
    }
}
