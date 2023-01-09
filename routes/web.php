<?php

use App\Http\Controllers\AukcionRealTimeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewAnnounceController;
use App\Http\Controllers\NewAnnounceElektronikaController;
use App\Http\Controllers\ProductController;
use App\Models\NewAnnounce;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::controller(HomeController::class)->group(function(){
    Route::get('/', 'index');
    Route::get('/category/{id}/{name}', 'showSubCategories')->name('sub_category');
});


Route::prefix('announce')->group(function(){
    Route::prefix('new')->controller(NewAnnounceController::class)->group(function (){
        Route::get('/','index')->name('new_announce');
        Route::post('/get_sub_category_types', 'getSubCategoryTypes');
    });

    Route::prefix('new/create')->group(function (){
        Route::prefix('electronica')->controller(NewAnnounceElektronikaController::class)->group(function (){
            Route::post('/audio-ve-video', 'audioVeVideo');
        });
    });
});


Route::controller(AukcionRealTimeController::class)->group(function () {
    Route::get('/realtime', 'index');
    Route::post('/set-aukcion-price', 'setAukcionPrice');
    Route::post('/get-auksion-users',  'getResponseAukcionGamers');
});

Route::prefix('product')->controller(ProductController::class)->group(function() {
    Route::get('/', 'index')->name('product');
});

