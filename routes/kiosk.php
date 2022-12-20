<?php

Route::prefix('kiosk')->middleware(['auth', 'role:kiosk'])->group(function () {
    Route::get('/', function () {
        return view('v1.kiosk.index');
    })->name('kiosk.index');

    Route::get('/check-in', function () {
        return view('v1.kiosk.check-in');
    })->name('kiosk.check-in');
});
