<?php

Route::prefix('roomboy')->middleware(['auth','role:roomboy'])->group(function(){
    Route::get('/', function () {
        return view('v1.roomboy.index');
    })->name('roomboy.index');
});