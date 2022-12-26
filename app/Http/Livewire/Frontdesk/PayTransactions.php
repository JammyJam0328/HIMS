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


    // declare $remainingDeposit as Integer
    public $remainingDeposit = 0;
    public $additionToDeposit = 0;
    public $additionToDepositChange = 0;
    public $saveAdditionToDepositChange = false;

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

    public function payWithDeposit()
    {
        if ($this->amountToPay > $this->remainingDeposit) {
            if($this->additionToDepositChange > 0) {
                $this->validate([
                    'additionToDeposit' => 'required|numeric|min:'.$this->amountToPay - $this->remainingDeposit,
                    'additionToDepositChange' => 'nullable|numeric',
                    'saveAdditionToDepositChange' => 'nullable|boolean',
                ]);
            } else {
                $this->validate([
                    'additionToDeposit' => 'required|numeric|min:'.$this->amountToPay,
                ]);
            }
        };

        DB::beginTransaction();

        $this->transaction->update([
            'given_amount' => $this->additionToDeposit,
            'change_amount' => $this->additionToDepositChange,
            'change_has_been_deposit' => $this->saveAdditionToDepositChange,
            'paid_at' => Carbon::now(),
            'from_deposit_amount' => $this->amountToPay > $this->remainingDeposit ? $this->remainingDeposit : $this->amountToPay,
        ]);
        $this->transaction->guest->update([
            'total_deposits' => $this->amountToPay > $this->remainingDeposit ? 0: $this->remainingDeposit - $this->amountToPay,
        ]);

        if ($this->saveAdditionToDepositChange) {
            Deposit::create([
                'branch_id' => $this->transaction->branch_id,
                'guest_id' => $this->transaction->guest_id,
                'floor_id' => $this->transaction->floor_id,
                'description' => 'Change from transaction # '.$this->transaction->id,
                'amount' => $this->additionToDepositChange,
            ]);

            $this->transaction->guest->update([
                'total_deposits' => $this->transaction->guest->total_deposits + $this->additionToDepositChange,
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
        $this->remainingDeposit = $this->transaction->guest->total_deposits;
    }

    public function render()
    {
        return view('livewire.frontdesk.pay-transactions');
    }
}
