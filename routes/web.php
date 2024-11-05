<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\Web\HomeController@index');
// Route::get('/', function () {
    // dd('hello');
    // return view('index');
    // return view('welcome');
    // return view('kool_form.login');
// });
Route::get('/tailwind',function(){
    return view('template.table_filter_light');
    // dd('tailwind');
    // return view('template.text');
    // return view('template.collection');
    // return view('template.form_layout');
    // return view('template.shop_list');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('book/products', [\App\Http\Controllers\Web\BookController::class, 'products'])->name('book.products');
    Route::resource('book', \App\Http\Controllers\Web\BookController::class);
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
