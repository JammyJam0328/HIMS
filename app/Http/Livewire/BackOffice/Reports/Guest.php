<?php

namespace App\Http\Livewire\BackOffice\Reports;

use Livewire\Component;
use App\Models\Guest as guestModel;
use Carbon\Carbon;

class Guest extends Component
{
    public $report_type;
    public $date;
    public $generate_query;
    public function render()
    {
        return view('livewire.back-office.reports.guest', [
            'guests' => $this->loadQuery(),
        ]);
    }

    public function loadQuery()
    {
        if ($this->report_type == 1) {
            if ($this->generate_query == null) {
                return guestModel::where('branch_id', auth()->user()->branch_id)
                    ->with('transactions')
                    ->get();
            } else {
                return $this->generate_query;
            }
        } elseif ($this->report_type == 2) {
            return guestModel::where('branch_id', auth()->user()->branch_id)
                ->whereDate('created_at', now())
                ->get();
        } else {
            return guestModel::whereHas('transactions', function ($query) {
                $query->where('type', '=', 'checked_in_room');
            })->get();
        }
    }

    public function generate()
    {
        $this->validate([
            'date' => 'required',
        ]);
        $this->generate_query = guestModel::where(
            'branch_id',
            auth()->user()->branch_id
        )
            ->with('transactions')
            ->whereDate('created_at', $this->date)
            ->get();
    }
}
