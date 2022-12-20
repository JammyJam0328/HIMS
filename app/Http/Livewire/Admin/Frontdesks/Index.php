<?php

namespace App\Http\Livewire\Admin\Frontdesks;

use App\Models\Employee;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        return view('livewire.admin.frontdesks.index', [
            'frontdesks' => Employee::whereBranchId(auth()->user()->branch_id)
                ->whereType(Employee::FRONTDESK)
                ->when($this->search != '', function ($query) {
                    $query->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%')
                        ->orWhere('contact_number', 'like', '%'.$this->search.'%')
                        ->orWhere('unique_id', 'like', '%'.$this->search.'%');
                })
                ->paginate(10),
        ]);
    }
}
