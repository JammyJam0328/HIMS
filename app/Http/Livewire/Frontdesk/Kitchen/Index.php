<?php

namespace App\Http\Livewire\Frontdesk\Kitchen;

use App\Models\Menu;
use App\Models\Guest;
use App\Models\Order;
use Livewire\Component;
use App\Models\Transaction;
use App\Models\MealCategory;
use App\Models\MenuInventory;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    public $search = '';

    public $searchBy = 'QRCODE';

    public $guest = null;

    public $hasGuest = false;

    public $orders = [];

    public $guestId = null;



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

        if ($this->guest) {
            $this->hasGuest = true;
        } 
    }

    public function mount()
    {
        if ($this->search != '' || $this->guestId != '') {
            $this->search();
        }

    }

    public function saveOrder()
    {
        DB::beginTransaction();
        foreach($this->orders as $order){
            Order::create([
                'guest_id' => $this->guest->id,
                'branch_id' => auth()->user()->branch_id,
                'floor_id' => $this->guest->floor_id,
                'menu_id' => $order['id'],
                'quantity' => $order['quantity'],
                'total_amount' => $order['quantity'] * $order['price'],
            ]);

            Transaction::create([
                'branch_id' => auth()->user()->branch_id,
                'floor_id' => $this->guest->room->floor_id,
                'room_id' => $this->guest->room_id,
                'guest_id' => $this->guest->id,
                'description' => 'Order :'.$order['name'],
                'type' => Transaction::FOOD,
                'payable_amount' => $order['quantity'] * $order['price'],
            ]);

            $menu = MenuInventory::whereMenuId($order['id'])->first();
            $menu->update([
                'total_servings' => $menu->total_servings - $order['quantity']
            ]);
        }

        DB::commit();

        $this->dispatchBrowserEvent('alert',[
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Order has been saved'
        ]);

        $this->orders = [];
        $this->guest = null;
        $this->hasGuest = false;
        $this->search = '';
        $this->guestId = null;
    }

    public function render()
    {
        return view('livewire.frontdesk.kitchen.index',[
            'categories' => MealCategory::with('menus')->get(),
        ]);
    }
}
