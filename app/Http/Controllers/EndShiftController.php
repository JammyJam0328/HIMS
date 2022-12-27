<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EndShiftController extends Controller
{
    public function index()
    {
        $frontdesks = \App\Models\Frontdesk::whereBranchId(auth()->user()->branch_id)
            ->whereActive(true)
            ->get();

        $floors = auth()->user()->branch->floors;

        return view('v1.frontdesk.end-shift',[
            'frontdesks' => $frontdesks,
            'floors' => $floors,
            'transactions' => \App\Models\Transaction::whereBetween('paid_at',[$frontdesks->first()->time_in,now()])
            ->whereBranchId(auth()->user()->branch_id)
             ->get()
             ->groupBy('floor_id') ,
            'deposits' => \App\Models\Deposit::whereBetween('created_at',[$frontdesks->first()->time_in,now()])->get()->groupBy('floor_id'),
             'new_guest_count' => \App\Models\Guest::where('branch_id',auth()->user()->branch_id)
                ->whereBetween('checked_in_at',[$frontdesks->first()->time_in,now()])
             ->count() ,
            'unique_extensions_today_count' => \App\Models\Extend::whereBranchId(auth()->user()->branch_id)
                ->whereBetween('created_at',[$frontdesks->first()->time_in,now()])
                ->groupBy('guest_id')
                ->count(),
                'unoccupied_rooms' => \App\Models\Room::whereBranchId(auth()->user()->branch_id)
                ->whereDoesntHave('guests',function($q) use($frontdesks){
                    $q->whereBetween('checked_in_at',[$frontdesks->first()->time_in,now()]);
                })->get('number')
         ]);
    }
}
