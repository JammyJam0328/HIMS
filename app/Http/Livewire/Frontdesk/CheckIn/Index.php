<?php

namespace App\Http\Livewire\Frontdesk\CheckIn;

use App\Models\Guest;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public $searchBy = 'QRCODE';

    public $queryString = [
        'search' => ['except' => ''],
        'searchBy',
    ];

    public function render()
    {
        return view('livewire.frontdesk.check-in.index', [
            'guests' => Guest::query()
                ->whereBranchId(auth()->user()->branch_id)
                ->whereStatus(Guest::IN_KIOSK)
                ->when($this->search, function ($query) {
                    if ($this->searchBy == 'QRCODE') {
                        $query->whereQrCode($this->search);
                    } elseif ($this->searchBy == 'ROOM_NUMBER') {
                        $query->whereRoomNumber($this->search);
                    }
                })
                ->paginate(10),
        ]);
    }
}
