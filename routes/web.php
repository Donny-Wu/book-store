<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // dd('hello');
    // return view('welcome');
    return view('kool_form.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
