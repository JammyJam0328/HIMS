<?php

namespace App\Http\Livewire\Frontdesk;

use App\Models\Deposit;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PayTransactions extends Component
{
    public $transaction;

    public $referrerLink;

    public $amountToPay = 0;

    public $paymentMethod = 'CASH';

    // pay with cash
    public $givenAmount = 0;

    public $changeAmount = 0;

    public $changeSaveToDeposit = false;

    public function payWithCash()
    {
        $this->validate([
            'givenAmount' => 'required|numeric|min:'.$this->amountToPay,
            'changeAmount' => 'nullable|numeric',
            'changeSaveToDeposit' => 'nullable|boolean',
        ]);
        DB::beginTransaction();
        $this->transaction->update([
            'given_amount' => $this->givenAmount,
            'change_amount' => $this->changeAmount,
            'change_has_been_deposit' => $this->changeSaveToDeposit,
            'paid_at' => Carbon::now(),
            'from_deposit_amount' => 0,
        ]);

        if ($this->changeSaveToDeposit) {
            Deposit::create([
                'branch_id' => $this->transaction->branch_id,
                'guest_id' => $this->transaction->guest_id,
                'description' => 'Change from transaction #'.$this->transaction->id,
                'amount' => $this->changeAmount,
            ]);

            $this->transaction->guest->update([
                'total_deposits' => $this->transaction->guest->total_deposits + $this->changeAmount,
            ]);
        }

        DB::commit();
        \session()->flash('alert', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Transaction has been paid',
        ]);

        return redirect()->to($this->referrerLink);
    }

    public function mount($transaction)
    {
        abort_unless($this->transaction = \App\Models\Transaction::find($transaction)->load('guest'), 404);
        abort_if($this->transaction->paid_at, 404);

        $this->amountToPay = $this->transaction->payable_amount;
    }

    public function render()
    {
        return view('livewire.frontdesk.pay-transactions');
    }
}
