<?php

namespace App\Http\Livewire\Admin\Frontdesks;

use App\Models\Employee;
use Livewire\Component;

class Create extends Component
{
    public $frontdesk;

    public function rules()
    {
        return [
            'frontdesk.branch_id' => 'nullable',
            'frontdesk.unique_id' => 'nullable',
            'frontdesk.name' => 'required',
            'frontdesk.email' => 'nullable|email|unique:employees,email',
            'frontdesk.contact_number' => 'required|unique:employees,contact_number|min:11|max:11|regex:/^09[0-9]{9}$/',
            'frontdesk.type' => 'nullable',
        ];
    }

    public function store()
    {
        $this->validate();

        $this->frontdesk->save();

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Record has been saved successfully',
        ]);

        return redirect()->route('admin.frontdesks');
    }

    public function mount()
    {
        $this->frontdesk = Employee::make([
            'branch_id' => auth()->user()->branch_id,
            'type' => Employee::FRONTDESK,
        ]);
    }

    public function render()
    {
        return view('livewire.admin.frontdesks.create');
    }
}
