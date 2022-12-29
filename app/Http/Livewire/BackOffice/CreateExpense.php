<?php

namespace App\Http\Livewire\BackOffice;

use Livewire\Component;
use App\Models\ExpenseCategory;
use App\Models\Expense;

class CreateExpense extends Component
{
    public $name, $description, $amount, $category_id;
    public function render()
    {
        return view('livewire.back-office.create-expense', [
            'categories' => ExpenseCategory::all(),
        ]);
    }

    public function addExpense()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'category_id' => 'required',
        ]);
        Expense::create([
            'name' => $this->name,
            'description' => $this->description,
            'amount' => $this->amount,
            'expense_category_id' => $this->category_id,
        ]);
        $this->name = '';
        $this->description = '';
        $this->amount = '';
        $this->category_id = '';

        $this->dispatchBrowserEvent('alert', [
            'title' => 'Success',
            'type' => 'success',
            'message' => 'Expense Added successfully!',
        ]);

        return redirect()->route('back-office.expenses');
    }
}
