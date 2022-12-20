<?php

namespace App\Http\Livewire\Admin\Amenities;

use App\Models\Amenity;
use Livewire\Component;

class Edit extends Component
{
    public $amenity;

    public function rules()
    {
        return [
            'amenity.branch_id' => 'nullable',
            'amenity.name' => 'required|unique:amenities,name,'.$this->amenity->id.',id,branch_id,'.auth()->user()->branch_id,
            'amenity.amount' => 'required|numeric|min:0',
        ];
    }

    public function update()
    {
        $this->validate();

        $this->amenity->save();

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Record has been updated successfully',
        ]);

        return redirect()->route('admin.amenities');
    }

    public function mount($amenity)
    {
        \abort_unless($this->amenity = Amenity::find($amenity), 404);
    }

    public function render()
    {
        return view('livewire.admin.amenities.edit');
    }
}
