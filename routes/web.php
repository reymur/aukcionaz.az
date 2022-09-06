<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\AukcionRealTimeController::class, 'index'])->name('home');
Route::post('sum', [App\Http\Controllers\AukcionRealTimeController::class, 'setAukcionSum']);
Route::post('get-auksion-users', [App\Http\Controllers\AukcionRealTimeController::class, 'getResponseAukcionUsers']);
