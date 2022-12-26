<?php

namespace App\Http\Livewire\Frontdesk\Transactions\RequestAmenities;

use App\Models\Amenity;
use App\Models\Guest;
use App\Models\RequestAmenity;
use App\Models\Transaction;
use App\Traits\WithCaching;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    use AuthorizesRequests , WithCaching;

    public $guest;

    public $amenities = [];

    public $amenityId;

    public $amenityAmount;

    public $amenityName;

    public $additionalAmount = 0;

    public $totalAmountToPay = 0;

    protected $validationAttributes = [
        'amenityId' => 'amenity',
        'additionalAmount' => 'additional amount',
    ];

    public function mount($guest)
    {
        \abort_unless($this->guest = Guest::find($guest), 404);
        $this->authorize('view', $this->guest);

        $this->amenities = Amenity::whereBranchId($this->guest->branch_id)->get();
    }

    public function getTransactionsProperty()
    {
        return $this->cache(function () {
            return $this->guest->transactions()->whereType(Transaction::AMENITIES)->get();
        });
    }

    public function saveRequest()
    {
        $this->validate([
            'amenityId' => 'required|in:'.$this->amenities->pluck('id')->implode(','),
            'additionalAmount' => 'nullable|numeric|min:0',
        ]);
        DB::beginTransaction();
        RequestAmenity::create([
            'branch_id' => $this->guest->branch_id,
            'room_id' => $this->guest->room_id,
            'type_id' => $this->guest->type_id,
            'floor_id' => $this->guest->floor_id,
            'guest_id' => $this->guest->id,
            'amenity_id' => $this->amenityId,
            'room_number' => $this->guest->room_number,
            'floor_number' => $this->guest->floor->number,
            'type_name' => $this->guest->roomType->name,
            'amount' => $this->totalAmountToPay,
        ]);
        Transaction::create([
            'branch_id' => auth()->user()->branch_id,
            'floor_id' => $this->guest->floor_id,
            'room_id' => $this->guest->room_id,
            'guest_id' => $this->guest->id,
            'description' => 'Amenity request : '.$this->amenityName,
            'type' => Transaction::AMENITIES,
            'payable_amount' => $this->totalAmountToPay,
        ]);

        DB::commit();
        $this->reset('amenityId', 'additionalAmount', 'totalAmountToPay', 'amenityName');
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Amenity request saved successfully',
        ]);
        $this->dispatchBrowserEvent('close-form');
    }

    public function updatedAmenityId()
    {
        $amenity = $this->amenityId ? Amenity::find($this->amenityId) : 0;
        $this->amenityAmount = $amenity ? $amenity->amount : 0;
        $this->totalAmountToPay = $this->additionalAmount + $this->amenityAmount;
        $this->amenityName = $this->amenityId ? $amenity->name : '';
    }

    public function updatedAdditionalAmount()
    {
        $this->totalAmountToPay = $this->additionalAmount != '' ? $this->amenityAmount + $this->additionalAmount : $this->amenityAmount;
    }

    public function render()
    {
        return view('livewire.frontdesk.transactions.request-amenities.index', [
            'transactions' => $this->transactions,
        ]);
    }
}
