<?php

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('v1.admin.dashboard.index');
    })->name('admin.dashboard');

    Route::get('/guests', function () {
        return view('v1.admin.guests.index');
    })->name('admin.guests');

    // rooms
    Route::get('/rooms', function () {
        return view('v1.admin.rooms.index');
    })->name('admin.rooms');
    Route::get('/rooms/create', function () {
        return view('v1.admin.rooms.create');
    })->name('admin.rooms.create');
    Route::get('/rooms/{room}/edit', function ($room) {
        return view('v1.admin.rooms.edit', [
            'room' => $room,
        ]);
    })->name('admin.rooms.edit');
    // end rooms

    // floors
    Route::get('/floors', function () {
        return view('v1.admin.floors.index');
    })->name('admin.floors');

    Route::get('/floors/create', function () {
        return view('v1.admin.floors.create');
    })->name('admin.floors.create');

    Route::get('/floors/{floor}/edit', function ($floor) {
        return view('v1.admin.floors.edit', [
            'floor' => $floor,
        ]);
    })->name('admin.floors.edit');
    // end floors

    // room types
    Route::get('/room-types', function () {
        return view('v1.admin.room-types.index');
    })->name('admin.room-types');

    Route::get('/room-types/create', function () {
        return view('v1.admin.room-types.create');
    })->name('admin.room-types.create');
    Route::get('/room-types/{type}/edit', function ($type) {
        return view('v1.admin.room-types.edit', [
            'type' => $type,
        ]);
    })->name('admin.room-types.edit');

    // end room types

    Route::get('/employees', function () {
        return view('v1.admin.employees.index');
    })->name('admin.employees');

    // front desk
    Route::get('/frontdesks', function () {
        return view('v1.admin.frontdesks.index');
    })->name('admin.frontdesks');

    Route::get('/frontdesks/create', function () {
        return view('v1.admin.frontdesks.create');
    })->name('admin.frontdesks.create');

    Route::get('/frontdesks/{frontdesk}/edit', function ($frontdesk) {
        return view('v1.admin.frontdesks.edit', [
            'frontdesk' => $frontdesk,
        ]);
    })->name('admin.frontdesks.edit');
    // end front desk

    // amenity
    Route::get('/amenities', function () {
        return view('v1.admin.amenities.index');
    })->name('admin.amenities');
    Route::get('/amenities/create', function () {
        return view('v1.admin.amenities.create');
    })->name('admin.amenities.create');
    Route::get('/amenities/{amenity}/edit', function ($amenity) {
        return view('v1.admin.amenities.edit', [
            'amenity' => $amenity,
        ]);
    })->name('admin.amenities.edit');

    //end amenity

    // asset
    Route::get('/assets', function () {
        return view('v1.admin.assets.index');
    })->name('admin.assets');

    Route::get('/assets/create', function () {
        return view('v1.admin.assets.create');
    })->name('admin.assets.create');
    Route::get('/assets/{asset}/edit', function ($asset) {
        return view('v1.admin.assets.edit', [
            'asset' => $asset,
        ]);
    })->name('admin.assets.edit');
    // end asset

    // discount
    Route::get('/discounts', function () {
        return view('v1.admin.discounts.index');
    })->name('admin.discounts');
    Route::get('/discounts/create', function () {
        return view('v1.admin.discounts.create');
    })->name('admin.discounts.create');
    Route::get('/discounts/{discount}/edit', function ($discount) {
        return view('v1.admin.discounts.edit', [
            'discount' => $discount,
        ]);
    })->name('admin.discounts.edit');

    //end discount

    // rates
    Route::get('/rates', function () {
        return view('v1.admin.rates.index');
    })->name('admin.rates');
    Route::get('/rates/create', function () {
        return view('v1.admin.rates.create');
    })->name('admin.rates.create');
    Route::get('/rates/{rate}/edit', function ($rate) {
        return view('v1.admin.rates.edit', [
            'rate' => $rate,
        ]);
    })->name('admin.rates.edit');
    //end rates

    // extension rates
    Route::get('/extension-rates', function () {
        return view('v1.admin.extension-rates.index');
    })->name('admin.extension-rates');

    Route::get('/extension-rates/create', function () {
        return view('v1.admin.extension-rates.create');
    })->name('admin.extension-rates.create');

    Route::get('/extension-rates/{extensionRate}/edit', function ($extensionRate) {
        return view('v1.admin.extension-rates.edit', [
            'extensionRate' => $extensionRate,
        ]);
    })->name('admin.extension-rates.edit');

    // end extension rates

    Route::get('/menus', function () {
        return view('v1.admin.menus.index');
    })->name('admin.menus');

    // cleaners

    Route::get('/cleaners', function () {
        return view('v1.admin.cleaners.index');
    })->name('admin.cleaners');

    // users

    Route::get('/roomboys', function () {
        return view('v1.admin.roomboys.index');
    })->name('admin.roomboys');

    Route::get('/roomboys/create', function () {
        return view('v1.admin.roomboys.create');
    })->name('admin.roomboys.create');

    Route::get('/roomboys/{roomboy}/edit', function ($roomboy) {
        return view('v1.admin.roomboys.edit',[
            'roomboy' => $roomboy,
        ]);
    })->name('admin.roomboys.edit');


});
