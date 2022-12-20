<?php

namespace App\Http\Livewire\Admin\RoomTypes;

use App\Models\Type;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesRequests;

    public $type;

    public function rules()
    {
        return [
            'type.branch_id' => 'nullable',
            'type.name' => 'required|string|unique:types,name,'.$this->type->id.',id,branch_id,'.auth()->user()->branch_id,
            'type.description' => 'nullable|string',
        ];
    }

    public function update()
    {
        $this->validate();

        $this->type->save();

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Record has been updated successfully',
        ]);

        return redirect()->route('admin.room-types');
    }

    public function mount($type)
    {
        \abort_unless($this->type = Type::find($type), 404);
    }

    public function render()
    {
        return view('livewire.admin.room-types.edit');
    }
}
