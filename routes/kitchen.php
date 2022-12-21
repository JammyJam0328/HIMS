<?php

Route::prefix('kitchen')
    ->middleware(['auth', 'role:kitchen'])
    ->group(function () {
        Route::get('/', function () {
            return view('v1.kitchen.index');
        })->name('kitchen.index');
        Route::get('/inventories', function () {
            return view('v1.kitchen.inventory.inventory');
        })->name('kitchen.inventory');
        Route::get('/inventories/add', function () {
            return view('v1.kitchen.inventory.add');
        })->name('kitchen.add-inventory');
        Route::get('/inventories/manage-category', function () {
            return view('v1.kitchen.category');
        })->name('kitchen.category');
    });
