<?php

namespace App\Http\Livewire\Kitchen;

use Livewire\Component;
use App\Models\MealCategory;
use App\Models\Menu;

class AddMenu extends Component
{
    public $name, $price, $category, $stocks, $servings;

    public function render()
    {
        return view('livewire.kitchen.add-menu', [
            'categories' => MealCategory::all(),
        ]);
    }

    public function addMenu()
    {
        $this->validate([
            'name' => 'required|unique:menus,name',
            'price' => 'required',
            'category' => 'required',
            'stocks' => 'required',
            'servings' => 'required',
        ]);

        $menu = Menu::create([
            'branch_id' => auth()->user()->branch_id,
            'name' => $this->name,
            'price' => $this->price,
            'meal_category_id' => $this->category,
        ]);

        $stock = $menu->menuInventory()->create([
            'stocks' => $this->stocks,
            'servings' => $this->servings,
            'total_servings' => $this->stocks * $this->servings,
        ]);

        $this->reset(['name', 'price', 'category', 'stocks', 'servings']);

        $this->dispatchBrowserEvent('alert', [
            'title' => 'Success',
            'type' => 'success',
            'message' => 'Menu Added successfully!',
        ]);

        return redirect()->route('kitchen.inventory');
    }
}
