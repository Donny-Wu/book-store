<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\Web\HomeController@index');
// Route::get('/', function () {
    // dd('hello');
    // return view('index');
    // return view('welcome');
    // return view('kool_form.login');
// });
Route::get('/template/{temp_name}',function($temp_name){
    // dd('template.'.$temp_name);
    return view('template.'.$temp_name);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::resource('chanel-order', \App\Http\Controllers\Web\ChanelOrderController::class);
    Route::get('book/products', [\App\Http\Controllers\Web\BookController::class, 'products'])->name('book.products');
    Route::resource('book', \App\Http\Controllers\Web\BookController::class);
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
