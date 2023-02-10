<?php

use App\Http\Controllers\AukcionRealTimeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewAnnounceController;
use App\Http\Controllers\ElectronicsController;
use App\Http\Controllers\ProductController;
use App\Models\NewAnnounce;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

URL::forceRootUrl(env('APP_URL'));
URL::forceScheme('https');

//Auth::routes();

Route::controller(HomeController::class)->group(function(){
    Route::get('/', 'index')->name('home');
    Route::get('/category/{id}/{name}', 'showSubCategories')->name('sub_category');
});


Route::prefix('announce')->group(function(){
    // SHOW NEW ANNOUNCE
    Route::prefix('new')->controller(NewAnnounceController::class)->group(function (){
        Route::get('/','index')->name('new_announce');
        Route::post('/get_sub_category_types', 'getSubCategoryTypes');
    });

    // CREATE NEW ANNOUNCE
    Route::prefix('new/create')->group(function (){
        // CREATE NEW ANNOUNCE BY Elektronika
        Route::prefix('electronica')->controller(ElectronicsController::class)->group(function (){
            Route::post('/audio-ve-video', 'audioVeVideo')->name('audioVeVideo');
            Route::post('/upload-images', 'uploadImages');
        });
    });
});


Route::controller(AukcionRealTimeController::class)->group(function () {
    Route::get('/realtime', 'index');
    Route::post('/set-aukcion-price', 'setAukcionPrice');
    Route::post('/get-auksion-users',  'getResponseAukcionGamers');
});

// PRODUCTS
Route::prefix('product')->controller(ProductController::class)->group(function() {
    Route::get('/{id}', 'index')->name('product');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
