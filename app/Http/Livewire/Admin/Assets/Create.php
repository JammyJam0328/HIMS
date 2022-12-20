<?php

namespace App\Http\Livewire\Admin\Assets;

use App\Models\Asset;
use Livewire\Component;

class Create extends Component
{
    public $asset;

    public function rules()
    {
        return [
            'asset.branch_id' => 'nullable',
            'asset.name' => 'required|unique:amenities,name,NULL,id,branch_id,'.auth()->user()->branch_id,
            'asset.amount' => 'required|numeric|min:0',
        ];
    }

    public function store()
    {
        $this->validate();

        $this->asset->save();

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Record has been saved successfully',
        ]);

        return redirect()->route('admin.assets');
    }

    public function mount()
    {
        $this->asset = Asset::make([
            'branch_id' => auth()->user()->branch_id,
        ]);
    }

    public function render()
    {
        return view('livewire.admin.assets.create');
    }
}
