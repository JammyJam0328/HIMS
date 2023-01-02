<?php

namespace App\Http\Livewire\Frontdesk\Transactions;

use App\Models\Guest;
use App\Models\Transaction;
use Livewire\Component;

class Index extends Component
{
    public $search = '';

    public $searchBy = 'QRCODE';

    public $guest = null;

    public $guestId = null;

    public $queryString = [
        'search' => ['except' => ''],
        'searchBy',
        'guestId' => ['except' => ''],
    ];

    public function search($fromButton = false)
    {
        if ($fromButton) {
            $this->guestId = null;
        }
        $this->guest = Guest::query()
            ->when($this->search, function ($query) {
                if ($this->searchBy == 'QRCODE') {
                    $query->whereQrCode($this->search);
                } elseif ($this->searchBy == 'ROOM_NUMBER') {
                    $query->whereRoomNumber($this->search);
                }
            })
            ->when($this->guestId, function ($query) {
                $query->whereId($this->guestId);
            })
            ->whereBranchId(auth()->user()->branch_id)
            ->whereStatus(Guest::CHECKED_IN)
            ->first();
    }

    public function mount()
    {
        if ($this->search != '' || $this->guestId != '') {
            $this->search();
        }
    }

    public function render()
    {
        return view('livewire.frontdesk.transactions.index', [
            'groupedTransactions' => $this->guest ? Transaction::query()
                        ->whereGuestId($this->guest->id)
                        ->get()
                        ->groupBy('type') : [],
        ]);
    }
}
