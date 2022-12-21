<?php

Route::prefix('frontdesk')->middleware(['auth', 'role:frontdesk', 'has_frontend'])->group(function () {
    Route::get('/dashboard', function () {
        return view('v1.frontdesk.dashboard');
    })->name('frontdesk.dashboard');
    // check in
    Route::get('/check-in', function () {
        return view('v1.frontdesk.check-in.index');
    })->name('frontdesk.check-in');
    Route::get('/check-in/{guest}/view-guest', function ($guest) {
        return view('v1.frontdesk.check-in.view-guest', [
            'guest' => $guest,
        ]);
    })->name('frontdesk.check-in.view-guest');
    // end check in

    Route::get('/check-out', function () {
        return view('v1.frontdesk.check-out');
    })->name('frontdesk.check-out');
    Route::get('/transactions', function () {
        return view('v1.frontdesk.transactions.index');
    })->name('frontdesk.transactions');

    Route::get('/prioritizing-room', function () {
        return view('v1.frontdesk.prioritizing-room');
    })->name('frontdesk.prioritizing-room');
    Route::get('/room-monitoring', function () {
        return view('v1.frontdesk.room-monitoring');
    })->name('frontdesk.room-monitoring');
});

Route::prefix('frontdesk')->middleware(['auth', 'role:frontdesk'])->group(function () {
    Route::get('/shifting', function () {
        $activeFrontdesk = \App\Models\Frontdesk::whereBranchId(auth()->user()->branch_id)
        ->whereActive(true)
        ->count();

        if ($activeFrontdesk) {
            return redirect()->route('frontdesk.dashboard');
        }

        return view('v1.frontdesk.shifting');
    })->name('frontdesk.shifting');
});
