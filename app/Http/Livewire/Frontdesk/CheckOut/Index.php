<?php

namespace App\Http\Livewire\Frontdesk\CheckOut;

use App\Models\Room;
use App\Models\Guest;
use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    public $search = '';

    public $searchBy = 'QRCODE';

    public $guest = null;

    public $guestId = null;

    public $guestCheckOutStep = 0;

    public $queryString = [
        'search' => ['except' => ''],
        'searchBy',
        'guestId' => ['except' => ''],
    ];

    public function search()
    {
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

        if(!$this->guest) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'title' => 'Guest not found',
                'message' => 'Please check the guest\'s QR Code or Room Number',
            ]);
            return;
        }
    }


    

    public function validateCheckOut()
    {
        $hasUnpaidTransaction = Transaction::query()
            ->whereGuestId($this->guest->id)
            ->wherePaidAt(false)
            ->exists();
        if ($hasUnpaidTransaction) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'title' => 'Guest has unpaid transaction',
                'message' => 'Please check the guest\'s transaction first',
            ]);
            return false;
        }

        if ($this->guest->check_out_step == '0') {
            $this->guest->update([
                'check_out_step'=> '1'
            ]);
        }

        $this->guestCheckOutStep = '1';
    }

    public function unclaimableDepositHandler()
    {
        if ($this->guest->check_out_step == '1') {
            $this->guest->update([
                'default_deposits_is_unclaimable' => true,
                'check_out_step'=> '2'
            ]);
            $this->guestCheckOutStep = '2';
        }
    }

    public function claimedDeposit()
    {
        if ($this->guest->check_out_step == '3') {
            DB::beginTransaction();
            $this->guest->update([
                'total_deposits' => 0,
                'check_out_step'=> '4',
                'checked_out_at' => now(),
                'status' => Guest::CHECKED_OUT,
            ]);

            $this->guest->room->update([
                'status' => Room::UNCLEAN,
                'last_checkout_at' => now(),
                'time_to_clean' => now()->addHours(3),
                'check_out_time' => null,
            ]);

           DB::commit();

           $this->guest = null;

           $this->search = '';
           $this->searchBy = 'QRCODE';
        }
    }

    public function claimableDepositHandler()
    {
        if ($this->guest->check_out_step == '1') {
            $this->guest->update([
                'default_deposits_is_unclaimable' => false,
                'check_out_step'=> '2',
                'default_deposits' => 0,
            ]);
    
            $this->guestCheckOutStep = '2';
        }
    }

    public function noDamage()
    {
        if ($this->guest->check_out_step == '2') {
            $this->guest->update([
                'check_out_step'=> '3',
            ]);
            $this->guestCheckOutStep = '3';
        }
    }

    public function recordDamage()
    {
        return redirect()->route('frontdesk.transactions.damages', $this->guest->id);
    }

    public function mount()
    {
        if ($this->search != '' || $this->guestId != '') {
            $this->search();
        }

        $this->guestCheckOutStep = $this->guest ? $this->guest->check_out_step : 0;
    }

    public function render()
    {
        return view('livewire.frontdesk.check-out.index', [
            'groupedTransactions' => $this->guest ? Transaction::query()
                        ->whereGuestId($this->guest->id)
                        ->get()
                        ->groupBy('type') : [],
            ]);
    }
}
