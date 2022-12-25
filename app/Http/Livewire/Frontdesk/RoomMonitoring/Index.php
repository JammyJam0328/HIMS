<?php

namespace App\Http\Livewire\Frontdesk\RoomMonitoring;

use App\Models\Room;
use App\Models\Type;
use App\Models\Floor;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public $filterStatus = 'OCCUPIED';

    public $filterFloor = '';

    public $filterType = '';

    public $statuses = [];

    public $floors = [];

    public $types = [];


    public function mount()
    {
        $this->types = Type::whereBranchId(auth()->user()->branch_id)->get();
        $this->floors = Floor::whereBranchId(auth()->user()->branch_id)->get();
        $this->statuses = ROOM::STATUSES;
    }

    public function render()
    {
        return view('livewire.frontdesk.room-monitoring.index', [
            'rooms' => Room::whereBranchId(auth()->user()->branch_id)
                ->when($this->filterStatus != '', function ($query) {
                    return $query->whereStatus($this->filterStatus);
                })
                ->when($this->filterFloor != '', function ($query) {
                    return $query->whereFloorId($this->filterFloor);
                })
                ->when($this->filterType != '', function ($query) {
                    return $query->whereTypeId($this->filterType);
                })
                ->paginate(10)
        ]);
    }
}
