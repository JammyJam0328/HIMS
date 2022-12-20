<?php

namespace App\Http\Livewire\Admin\Assets;

use App\Models\Asset;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        return view('livewire.admin.assets.index', [
            'assets' => Asset::whereBranchId(auth()->user()->id)
            ->when($this->search != '', function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%');
            })->paginate(10),
        ]);
    }
}
