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

    // transactions
    Route::get('/transactions', function () {
        return view('v1.frontdesk.transactions.index');
    })->name('frontdesk.transactions');

    Route::get('/transactions/{transaction}/pay', function ($transaction) {
        return view('v1.frontdesk.pay-transactions', [
            'transaction' => $transaction,
        ]);
    })->name('frontdesk.pay-transactions');

    Route::get('/transactions/{guest}/transfer-room', function ($guest) {
        if (auth()->user()->branch->setting_administrator_code == null) {
            session()->flash('alert', [
                'type' => 'error',
                'title' => 'UNABLE TO PROCEED',
                'message' => 'SYSTEM : Administrator code is not set. Please contact your administrator.',
            ]);

            return redirect()->route('frontdesk.transactions', ['guestId' => $guest]);
        }

        return view('v1.frontdesk.transactions.transfer-room.index', [
            'guest' => $guest,
        ]);
    })->name('frontdesk.transactions.transfer-room');

    Route::get('/transactions/{guest}/extend', function ($guest) {
        if (auth()->user()->branch->setting_extension_resetting_hours == null) {
            session()->flash('alert', [
                'type' => 'error',
                'title' => 'UNABLE TO PROCEED',
                'message' => 'SYSTEM : Extension resetting hours is not set. Please contact your administrator.',
            ]);

            return redirect()->route('frontdesk.transactions', ['guestId' => $guest]);
        }

        return view('v1.frontdesk.transactions.extend.index', [
            'guest' => $guest,
        ]);
    })->name('frontdesk.transactions.extend');

    Route::get('/transactions/{guest}/amenities', function ($guest) {
        return view('v1.frontdesk.transactions.amenities.index', [
            'guest' => $guest,
        ]);
    })->name('frontdesk.transactions.amenities');

    Route::get('/transactions/{guest}/damages', function ($guest) {
        return view('v1.frontdesk.transactions.damages.index', [
            'guest' => $guest,
        ]);
    })->name('frontdesk.transactions.damages');

    Route::get('/transactions/{guest}/deposits', function ($guest) {
        return view('v1.frontdesk.transactions.deposits.index', [
            'guest' => $guest,
        ]);
    })->name('frontdesk.transactions.deposits');

    // end transactions

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
