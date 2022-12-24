<?php

namespace App\Http\Livewire\Frontdesk;

use App\Models\Employee;
use App\Models\Frontdesk;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Shifting extends Component
{
    use WithPagination;

    public $selectedIds = [];

    public function select($id)
    {
        if (in_array($id, $this->selectedIds)) {
            $this->selectedIds = array_diff($this->selectedIds, [$id]);
        } else {
            array_push($this->selectedIds, $id);
        }
    }

    public function startShift()
    {
        DB::beginTransaction();
        foreach ($this->selectedIds as $value) {
            Frontdesk::create([
                'branch_id' => auth()->user()->branch_id,
                'employee_id' => $value,
                'time_in' => now(),
                'active' => true,
            ]);
        }

        DB::commit();

        return redirect()->route('frontdesk.dashboard');
    }

    public function render()
    {
        return view('livewire.frontdesk.shifting', [
            'frontdesks' => Employee::query()
                            ->whereType(Employee::FRONTDESK)
                            ->whereBranchId(auth()->user()->branch_id)
                            ->whereNotIn('id', $this->selectedIds)
                            ->paginate(10),
            'selecteds' => count($this->selectedIds) > 0 ? Employee::query()
                            ->whereType(Employee::FRONTDESK)
                            ->whereBranchId(auth()->user()->branch_id)
                            ->whereIn('id', $this->selectedIds)
                            ->get() : [],
        ]);
    }
}
