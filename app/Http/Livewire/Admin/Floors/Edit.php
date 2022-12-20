<?php

namespace App\Http\Livewire\Admin\Floors;

use App\Models\Floor;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesRequests;

    public $floor;

    public function rules()
    {
        return [
            'floor.branch_id' => 'nullable',
            'floor.number' => 'required|numeric|unique:floors,number,'.$this->floor->id.',id,branch_id,'.auth()->user()->branch_id,
        ];
    }

    public function update()
    {
        $this->authorize('update', $this->floor);

        $this->validate();

        $this->floor->save();

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Record has been updated successfully',
        ]);

        return redirect()->route('admin.floors');
    }

    public function mount($floor)
    {
        abort_unless($this->floor = Floor::find($this->floor), 404);
        $this->authorize('view', $this->floor);
    }

    public function render()
    {
        return view('livewire.admin.floors.edit');
    }
}
