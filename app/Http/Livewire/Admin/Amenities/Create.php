<?php

namespace App\Http\Livewire\Admin\Amenities;

use App\Models\Amenity;
use Livewire\Component;

class Create extends Component
{
    public $amenity;

    public function rules()
    {
        return [
            'amenity.branch_id' => 'nullable',
            'amenity.name' => 'required|unique:amenities,name,NULL,id,branch_id,'.auth()->user()->branch_id,
            'amenity.amount' => 'required|numeric|min:0',
        ];
    }

    public function store()
    {
        $this->validate();

        $this->amenity->save();

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Record has been saved successfully',
        ]);

        return redirect()->route('admin.amenities');
    }

    public function mount()
    {
        $this->amenity = Amenity::make([
            'branch_id' => auth()->user()->branch_id,
        ]);
    }

    public function render()
    {
        return view('livewire.admin.amenities.create');
    }
}
