<?php

namespace App\Observers;

use App\Models\Deposit;
use App\Models\Frontdesk;

class DepositObserver
{
    public function creating(Deposit $deposit)
    {
        $frontdesks = Frontdesk::whereBranchId(auth()->user()->branch_id)
        ->whereActive(true)
        ->with('employee')
        ->get()->map(function ($frontdesk) {
            return [
                'id' => $frontdesk->id,
                'name' => $frontdesk->employee->name,
            ];
        })->toArray();

        $deposit->frontdesks = json_encode($frontdesks);

        $deposit->transact_by_admin = auth()->user()->hasRole('admin') ? auth()->user()->id : null;
    }
}
