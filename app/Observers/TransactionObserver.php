<?php

namespace App\Observers;

use App\Models\Frontdesk;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Casts\AsCollection;

class TransactionObserver
{
    // protected $casts = [
    //     'frontdesks' => AsCollection::class,
    // ];
    public function creating(Transaction $transaction)
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

        $transaction->frontdesks = json_encode($frontdesks);

        $transaction->transact_by_admin = auth()->user()->hasRole('admin') ? auth()->user()->id : null;
    }

    public function updating(Transaction $transaction)
    {
        if ($transaction->paid_at == null) {
            $frontdesks = Frontdesk::whereBranchId(auth()->user()->branch_id)
                ->whereActive(true)
                ->with('employee')
                ->get()->map(function ($frontdesk) {
                    return [
                        'id' => $frontdesk->id,
                        'name' => $frontdesk->employee->name,
                    ];
                })->toArray();

            $transaction->frontdesks = json_encode($frontdesks);

            $transaction->transact_by_admin = auth()->user()->hasRole('admin') ? auth()->user()->id : null;
        }
    }
}
