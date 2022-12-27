<?php

namespace App\Http\Livewire\Frontdesk;

use Livewire\Component;
use App\Models\Frontdesk;
use Illuminate\Support\Facades\DB;

class Endshift extends Component
{

    public function endShift()
    {
        DB::beginTransaction();
        $activeFrontdesk = Frontdesk::whereBranchId(auth()->user()->branch_id)
            ->whereActive(true)
            ->get();
        foreach ($activeFrontdesk as $frontdesk) {
            $frontdesk->update([
                'active' => false,
                'time_out' => now()
            ]);
        }
        DB::commit();

        return redirect()->route('frontdesk.shifting');
    }
    public function render()
    {
        return view('livewire.frontdesk.endshift');
    }
}
