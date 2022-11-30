<?php

use App\Http\Controllers\AukcionRealTimeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewAnnounceController;
use App\Models\NewAnnounce;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::controller(HomeController::class)->group(function(){
    Route::get('/', 'index');
});

Route::prefix('announce')->controller(NewAnnounceController::class)->group(function(){
    Route::get('/', 'index');
});

// Route::controller(AukcionRealTimeController::class)->group(function () {
//     Route::get('/', 'index');
//     Route::post('/set-aukcion-price', 'setAukcionPrice');
//     Route::post('/get-auksion-users',  'getResponseAukcionGamers');
// });

