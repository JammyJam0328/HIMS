<?php

namespace App\Http\Livewire\BackOffice;

use Livewire\Component;
use App\Models\ExpenseCategory;

class Expense extends Component
{
    public function render()
    {
        return view('livewire.back-office.expense', [
            'expenseCategories' => ExpenseCategory::with('expenses')->get(),
        ]);
    }
}
