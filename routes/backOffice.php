<?php

Route::prefix('back_office')
    ->middleware(['auth', 'role:back_office'])
    ->group(function () {
        Route::get('/', function () {
            return view('v1.back-office.index');
        })->name('back-office.index');
    });
