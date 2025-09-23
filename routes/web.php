<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\OrderController;

// Route::get('/', 'App\Http\Controllers\Web\HomeController@index');
// Route::get('/', 'App\Http\Controllers\Web\HomeController@home');
Route::get('/', [\App\Http\Controllers\Web\BookController::class, 'products'])->name('book.products');
Route::get('/checkout', [\App\Http\Controllers\Web\OrderController::class, 'create'])->name('order.create');
Route::post('/order/store', [\App\Http\Controllers\Web\OrderController::class, 'store'])->name('order.store');

// Route::get('/template/{temp_name}',function($temp_name){
//     // dd('template.'.$temp_name);
//     return view('template.'.$temp_name);
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::post('chanel-work/{service}/upload', [\App\Http\Controllers\Web\ChanelWorkController::class, 'upload'])->name('chanel-work.upload');
    Route::resource('chanel-order', \App\Http\Controllers\Web\ChanelOrderController::class);
    Route::get('/dashboard', [\App\Http\Controllers\Web\BookController::class, 'dashboard'])->name('dashboard');

    Route::resource('book', \App\Http\Controllers\Web\BookController::class);
    Route::get('/order/index', [OrderController::class, 'index'])->name('order.index');
    // 訂單詳情
    Route::get('/order/{order}', [OrderController::class, 'show'])->name('order.show');
    // 更新管理者備註
    Route::post('/order/{order}/admin-note', [OrderController::class, 'updateAdminNote'])->name('order.update-admin-note');
    // 更新訂單狀態
    Route::post('/order/{order}/status', [OrderController::class, 'updateStatus'])->name('order.update-status');
    // 更新付款狀態
    Route::post('/order/{order}/payment-status', [OrderController::class, 'updatePaymentStatus'])->name('order.update-payment-status');
    // 批量操作
    Route::post('/order/batch-action', [OrderController::class, 'batchAction'])->name('order.batch-action');


});
// Route::get('/test',[App\Http\Controllers\Web\TestController::class,'index']);
