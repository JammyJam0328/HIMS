<?php

namespace App\Http\Livewire\Admin\ExtensionRates;

use App\Models\ExtensionRate;
use Livewire\Component;

class Edit extends Component
{
    public $extensionRate;

    public function rules()
    {
        return [
            'extensionRate.branch_id' => 'nullable',
            'extensionRate.hour' => 'required|min:1|unique:extension_rates,hour,NULL,id,branch_id,'.auth()->user()->branch_id,
            'extensionRate.amount' => 'required|numeric|min:1',
        ];
    }

    public function store()
    {
        $this->validate();

        $this->extensionRate->save();

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Record has been saved successfully',
        ]);

        return redirect()->route('admin.extension-rates');
    }

    public function mount()
    {
        \abort_unless($this->extensionRate = ExtensionRate::find($this->extensionRate), 404);
    }

    public function render()
    {
        return view('livewire.admin.extension-rates.edit');
    }
}
