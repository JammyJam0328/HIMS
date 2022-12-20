<?php

namespace App\Http\Livewire\Admin\Floors;

use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.admin.floors.index', [
            'floors' => \App\Models\Floor::withCount('rooms')->paginate(10),
        ]);
    }
}
