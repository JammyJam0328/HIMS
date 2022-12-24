<?php

namespace App\Http\Livewire\Frontdesk\CheckIn;

use App\Models\Guest;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public $recentCheckIns = [];

    public $terminatedGuests = [];

    public $searchBy = 'QRCODE';

    public $queryString = [
        'search' => ['except' => ''],
        'searchBy',
    ];

    public function mount()
    {
        $this->recentCheckIns = Guest::query()
                ->whereBranchId(auth()->user()->branch_id)
                ->whereStatus(Guest::CHECKED_IN)
                ->latest()
                ->take(10)
                ->get();

        $this->terminatedGuests = Guest::query()
                ->whereBranchId(auth()->user()->branch_id)
                ->whereStatus(Guest::TERMINATED)
                ->latest()
                ->take(10)
                ->get();
    }

    public function render()
    {
        return view('livewire.frontdesk.check-in.index', [
            'guests' => Guest::query()
            ->when($this->search, function ($query) {
                if ($this->searchBy == 'QRCODE') {
                    $query->whereQrCode($this->search);
                } elseif ($this->searchBy == 'ROOM_NUMBER') {
                    $query->whereRoomNumber($this->search);
                }
            })
                ->whereBranchId(auth()->user()->branch_id)
                ->whereStatus(Guest::IN_KIOSK)
                ->paginate(10),
        ]);
    }
}
