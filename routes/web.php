<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', 'App\Http\Controllers\Web\HomeController@index');
// Route::get('/', 'App\Http\Controllers\Web\HomeController@home');
Route::get('/', [\App\Http\Controllers\Web\BookController::class, 'products'])->name('book.products');
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
    Route::post('chanel-work/{service}/upload', [\App\Http\Controllers\Web\ChanelWorkController::class, 'upload'])->name('chanel-work.upload');
    Route::resource('chanel-order', \App\Http\Controllers\Web\ChanelOrderController::class);
    Route::get('/dashboard', [\App\Http\Controllers\Web\BookController::class, 'dashboard'])->name('dashboard');

    Route::resource('book', \App\Http\Controllers\Web\BookController::class);


});
// Route::get('/test',[App\Http\Controllers\Web\TestController::class,'index']);
