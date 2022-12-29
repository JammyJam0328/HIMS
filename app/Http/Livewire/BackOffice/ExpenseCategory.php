<?php

namespace App\Http\Livewire\BackOffice;

use Livewire\Component;
use App\Models\ExpenseCategory as expenseCategoryModel;

class ExpenseCategory extends Component
{
    public $name;
    public $updateMode = false;
    public $category_id;
    public function render()
    {
        return view('livewire.back-office.expense-category', [
            'expenseCategories' => expenseCategoryModel::withCount(
                'expenses'
            )->get(),
        ]);
    }

    public function addCategory()
    {
        $this->validate([
            'name' => 'required',
        ]);
        expenseCategoryModel::create([
            'name' => $this->name,
        ]);
        $this->name = '';
    }

    public function editCategory($category_id)
    {
        $this->updateMode = true;
        $category = expenseCategoryModel::where('id', $category_id)->first();
        $this->name = $category->name;
        $this->category_id = $category_id;
    }

    public function updateCategory()
    {
        $this->validate([
            'name' => 'required',
        ]);
        if ($this->category_id) {
            $category = expenseCategoryModel::where(
                'id',
                $this->category_id
            )->first();
            $category->update([
                'name' => $this->name,
            ]);
            $this->updateMode = false;
            $this->name = '';
            $this->category_id = '';
        }
    }

    public function cancelUpdate()
    {
        $this->updateMode = false;
        $this->name = '';
        $this->category_id = '';
    }
}
