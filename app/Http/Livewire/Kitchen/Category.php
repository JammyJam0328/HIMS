<?php

namespace App\Http\Livewire\Kitchen;

use Livewire\Component;
use App\Models\MealCategory;

class Category extends Component
{
    public $name;
    public $category_id;
    public $updateMode = false;
    public function render()
    {
        return view('livewire.kitchen.category', [
            'categories' => MealCategory::withCount('menus')->get(),
        ]);
    }

    public function addCategory()
    {
        $this->validate([
            'name' => 'required|unique:meal_categories,name',
        ]);

        MealCategory::create([
            'name' => $this->name,
            'branch_id' => auth()->user()->branch_id,
        ]);

        $this->dispatchBrowserEvent('alert', [
            'title' => 'Success',
            'type' => 'success',
            'message' => 'Category added successfully!',
        ]);

        $this->name = '';
    }

    public function editCategory($category_id)
    {
        $this->category_id = $category_id;
        $this->updateMode = true;
        $category = MealCategory::where('id', $this->category_id)->first();
        $this->name = $category->name;
    }

    public function cancelUpdate()
    {
        $this->updateMode = false;
        $this->name = '';
    }

    public function updateCategory()
    {
        $this->validate([
            'name' =>
                'required|unique:meal_categories,name,' . $this->category_id,
        ]);

        $category = MealCategory::where('id', $this->category_id)->first();
        $category->update([
            'name' => $this->name,
        ]);

        $this->dispatchBrowserEvent('alert', [
            'title' => 'Success',
            'type' => 'success',
            'message' => 'Category updated successfully!',
        ]);

        $this->updateMode = false;
        $this->name = '';
    }
}
