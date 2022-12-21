<?php

namespace App\Http\Livewire\Kitchen;

use Livewire\Component;
use App\Models\MealCategory;
use App\Models\MenuInventory;

class Inventory extends Component
{
    public $stocks_modal = false;
    public $inventory_id;
    public $new_stocks;
    public function render()
    {
        return view('livewire.kitchen.inventory', [
            'categories' => MealCategory::all(),
        ]);
    }

    public function manageStocks($inventory_id)
    {
        $this->inventory_id = $inventory_id;
        $this->stocks_modal = true;
    }

    public function saveStocks()
    {
        $inventory = MenuInventory::where('id', $this->inventory_id)->first();
        $stocks = $inventory->stocks;
        $total_stocks = $stocks + $this->new_stocks;
        $total_servings = $total_stocks * $inventory->servings;
        $inventory->update([
            'stocks' => $total_stocks,
            'total_servings' => $total_servings,
        ]);

        $this->dispatchBrowserEvent('alert', [
            'title' => 'Success',
            'type' => 'success',
            'message' => 'Stocks added successfully!',
        ]);
        $this->new_stocks = '';
        $this->stocks_modal = false;
    }
}
