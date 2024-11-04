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
    // dd('tailwind');
    // return view('template.text');
    // return view('template.collection');
    return view('template.shop_list');
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
