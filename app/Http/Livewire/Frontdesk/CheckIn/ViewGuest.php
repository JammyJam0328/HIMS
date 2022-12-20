<?php

namespace App\Http\Livewire\Frontdesk\CheckIn;

use App\Models\Guest;
use Livewire\Component;

class ViewGuest extends Component
{
    public $guest;

    public $totalAmountToPay = 0;
    public $changeAmount = 0;
    public $givenAmount = 0;
    public $changeSaveToDeposit = false;

    public function mount($guest)
    {
        abort_unless($this->guest = Guest::whereId($guest)
            ->whereBranchId(auth()->user()->branch_id)
            ->whereStatus(Guest::IN_KIOSK)
            ->first(), 404);
        $this->totalAmountToPay = $this->guest->check_in_amount + 200;
    }
    public function render()
    {
        return view('livewire.frontdesk.check-in.view-guest');
    }
}
