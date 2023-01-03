<?php

namespace App\Http\Livewire\Frontdesk\Transactions\Damages;

use App\Models\Asset;
use App\Models\Damage;
use App\Models\Guest;
use App\Models\Transaction;
use App\Traits\WithCaching;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    use AuthorizesRequests , WithCaching;

    public $guest;

    public $assets = [];

    public $assetId;

    public $assetAmount = 0;

    public $assetName;

    public $additionalAmount = 0;

    public $totalAmountToPay = 0;

    public function updatedAssetId()
    {
        $asset = Asset::find($this->assetId);
        $this->assetName = $asset ? $asset->name : '';
        $this->assetAmount = $asset ? $asset->amount : 0;
        $this->totalAmountToPay = $asset ? $asset->amount + $this->additionalAmount : 0;
    }

    public function updatedAdditionalAmount()
    {
        $this->totalAmountToPay = $this->additionalAmount != '' ? $this->assetAmount + $this->additionalAmount : $this->assetAmount;
    }

    public function saveDamage()
    {
        $this->validate([
            'assetId' => 'required|in:'.$this->assets->pluck('id')->implode(','),
            'additionalAmount' => 'nullable|numeric|min:0',
        ],[
            'assetId.required' => 'Please select an asset',
            'assetId.in' => 'Asset is invalid',
        ]);
        DB::beginTransaction();

        Damage::create([
            'branch_id' => auth()->user()->branch_id,
            'room_id' => $this->guest->room_id,
            'type_id' => $this->guest->room->type_id,
            'floor_id' => $this->guest->room->floor_id,
            'guest_id' => $this->guest->id,
            'asset_id' => $this->assetId,
            'room_number' => $this->guest->room->number,
            'floor_number' => $this->guest->room->floor->number,
            'type_name' => $this->guest->room->type->name,
            'amount' => $this->totalAmountToPay,
        ]);
        Transaction::create([
            'branch_id' => auth()->user()->branch_id,
            'floor_id' => $this->guest->room->floor_id,
            'room_id' => $this->guest->room_id,
            'guest_id' => $this->guest->id,
            'description' => 'Damage : '.$this->assetName,
            'type' => Transaction::DAMAGE,
            'payable_amount' => $this->totalAmountToPay,
        ]);
        DB::commit();

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Damage request has been saved successfully',
        ]);
        $this->dispatchBrowserEvent('close-form');

        $this->reset('assetId', 'additionalAmount', 'totalAmountToPay', 'assetAmount', 'assetName');
    }

    public function mount($guest)
    {
        abort_unless($this->guest = Guest::find($guest), 404);
        $this->authorize('view', $this->guest);

        $this->assets = Asset::whereBranchId(auth()->user()->branch_id)->get();
    }

    public function getTransactionsProperty()
    {
        return $this->cache(function () {
            return $this->guest->transactions()->whereType(Transaction::DAMAGE)->get();
        });
    }

    public function render()
    {
        return view('livewire.frontdesk.transactions.damages.index', [
            'transactions' => $this->transactions,
        ]);
    }
}
