<?php

Route::prefix('back_office')
    ->middleware(['auth', 'role:back_office'])
    ->group(function () {
        Route::get('/', function () {
            return view('v1.back-office.index');
        })->name('back-office.index');
        Route::get('/sales', function () {
            return view('v1.back-office.sales');
        })->name('back-office.sales');
        Route::get('/expenses', function () {
            return view('v1.back-office.expenses');
        })->name('back-office.expenses');
        Route::get('/manage-category', function () {
            return view('v1.back-office.manage-category');
        })->name('back-office.manage-category');
        Route::get('/add-expenses', function () {
            return view('v1.back-office.add-expenses');
        })->name('back-office.add-expenses');
        Route::get('/reports', function () {
            return view('v1.back-office.reports');
        })->name('back-office.reports');
    });
