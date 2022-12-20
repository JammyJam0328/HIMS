<?php

namespace App\Observers;

use App\Models\Guest;
use Carbon\Carbon;

class GuestObserver
{
    public function creating(Guest $guest)
    {
        $guestCount = \App\Models\Guest::whereYear(
            'created_at',
            Carbon::today()->year
        )->count();
        $code = auth()->user()->branch_id.today()->format('y').str_pad($guestCount, 4, '0', STR_PAD_LEFT);
        $guest->qr_code = $code;
    }
}
