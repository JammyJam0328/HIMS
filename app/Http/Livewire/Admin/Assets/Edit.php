<?php

namespace App\Http\Livewire\Admin\Assets;

use App\Models\Asset;
use Livewire\Component;

class Edit extends Component
{
    public $asset;

    public function rules()
    {
        return [
            'asset.branch_id' => 'nullable',
            'asset.name' => 'required|unique:assets,name,'.$this->asset->id.',id,branch_id,'.auth()->user()->branch_id,
            'asset.amount' => 'required|numeric|min:0',
        ];
    }

    public function update()
    {
        $this->validate();

        $this->asset->save();

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Record has been update successfully',
        ]);

        return redirect()->route('admin.assets');
    }

    public function mount($asset)
    {
        \abort_unless($this->asset = Asset::find($asset), 404);
    }

    public function render()
    {
        return view('livewire.admin.assets.edit');
    }
}
