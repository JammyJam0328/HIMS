<?php

namespace App\Http\Livewire\Admin\Floors;

use App\Models\Floor;
use Livewire\Component;

class Create extends Component
{
    public $floor;

    public function rules()
    {
        return [
            'floor.branch_id' => 'nullable',
            'floor.number' => 'required|numeric|unique:floors,number,NULL,id,branch_id,'.auth()->user()->branch_id,
        ];
    }

    public function store()
    {
        $this->validate();

        $this->floor->save();

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Record has been saved successfully',
        ]);

        return redirect()->route('admin.floors');
    }

    public function mount()
    {
        $this->floor = Floor::make(['branch_id' => auth()->user()->branch_id]);
    }

    public function render()
    {
        return view('livewire.admin.floors.create');
    }
}
