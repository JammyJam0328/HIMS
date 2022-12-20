<?php

namespace App\Http\Livewire\Admin\RoomTypes;

use App\Models\Type;
use Livewire\Component;

class Create extends Component
{
    public $type;

    public function rules()
    {
        return [
            'type.branch_id' => 'nullable',
            'type.name' => 'required|string|unique:types,name,NULL,id,branch_id,'.auth()->user()->branch_id,
            'type.description' => 'nullable|string',
        ];
    }

    public function store()
    {
        $this->validate();

        $this->type->save();

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Record has been saved successfully',
        ]);

        return redirect()->route('admin.room-types');
    }

    public function mount()
    {
        $this->type = Type::make(['branch_id' => auth()->user()->branch_id]);
    }

    public function render()
    {
        return view('livewire.admin.room-types.create');
    }
}
