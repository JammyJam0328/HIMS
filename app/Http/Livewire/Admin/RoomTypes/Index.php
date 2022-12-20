<?php

namespace App\Http\Livewire\Admin\RoomTypes;

use App\Models\Type;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.admin.room-types.index', [
            'types' => Type::whereBranchId(auth()->user()->branch_id)->withCount('rooms')->paginate(10),
        ]);
    }
}
