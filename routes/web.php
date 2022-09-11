<?php

use App\Http\Controllers\AukcionRealTimeController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::controller(AukcionRealTimeController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/set-aukcion-price', 'setAukcionPrice');
    Route::post('/get-auksion-users',  'getResponseAukcionGamers');
});

