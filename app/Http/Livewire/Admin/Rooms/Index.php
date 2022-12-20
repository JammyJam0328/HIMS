<?php

namespace App\Http\Livewire\Admin\Rooms;

use App\Models\Room;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $statuses = [];

    public $floors = [];

    public $types = [];

    public $statusFilter = '';

    public $floorFilter = '';

    public $typeFilter = '';

    public $searchQuery = '';

    public $queryString = [
        'statusFilter' => ['except' => '', 'as' => 's'],
        'floorFilter' => ['except' => '', 'as' => 'f'],
    ];

    public function mount()
    {
        $this->statuses = Room::STATUSES;
        $this->floors = auth()->user()->branch->floors;
        $this->types = auth()->user()->branch->roomTypes;
    }

    public function render()
    {
        return view('livewire.admin.rooms.index', [
            'rooms' => Room::query()
            ->when($this->statusFilter != '', function ($query) {
                $query->whereStatus($this->statusFilter);
            })
            ->when($this->floorFilter != '', function ($query) {
                $query->whereFloorId($this->floorFilter);
            })
            ->when($this->typeFilter != '', function ($query) {
                $query->whereTypeId($this->typeFilter);
            })
            ->when($this->searchQuery != '', function ($query) {
                $query->whereNumber($this->searchQuery);
            })
            ->whereBranchId(auth()->user()->branch_id)->with(['floor', 'type'])->paginate(10),
        ]);
    }
}
