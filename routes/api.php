<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [AuthController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum'],'as'=>'api.'], function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::apiResource('publisher', \App\Http\Controllers\Api\PublisherController::class);
    Route::apiResource('language',\App\Http\Controllers\Api\LanguageController::class);
    Route::apiResource('book',\App\Http\Controllers\Api\BookController::class);
});
