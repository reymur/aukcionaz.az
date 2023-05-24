<?php

use App\Http\Controllers\AukcionRealTimeController;
use App\Http\Controllers\DeleteRollBackTransactionAnnounceImagesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewAnnounceController;
use App\Http\Controllers\ElectronicsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionErrorImagesDeleteController;
use App\Http\Controllers\WaitingProductController;
use App\Models\NewAnnounce;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

//URL::forceRootUrl(env('APP_URL'));
//URL::forceScheme('https');

Auth::routes();

Route::controller(HomeController::class)->group(function(){
    Route::get('/', 'index')->name('home');

    // CATEGORY
    Route::get('/category/{name}', 'showSubCategories')->name('sub_category');
    // SUB CATEGORY
    Route::get('/category/{category}/{sub_category}', 'showSubCategoryTypes')->name('sub_category_types');
});

Route::prefix('announce/new')->group(function(){
    // SHOW NEW ANNOUNCE
    Route::controller(NewAnnounceController::class)->group(function (){
        Route::get('/','index')->name('new_announce');
        Route::post('/get_sub_category_types', 'getSubCategoryTypes');
    });

    // CREATE NEW ANNOUNCE
    Route::prefix('create')->group(function (){
        // CREATE NEW ANNOUNCE BY Elektronika
        Route::prefix('electronica')->controller(ElectronicsController::class)->group(function (){
            Route::post('/audio-ve-video', 'audioVeVideo')->name('audioVeVideo');
            Route::post('/upload-images', 'uploadImages');
        });
    });
});

// AUKSIYON
Route::controller(AukcionRealTimeController::class)->group(function () {
    Route::get('/realtime/auksiyon/{id}', 'getAuksiyon');
    Route::post('/set-aukcion-price', 'setAukcionPrice');
    Route::post('/get-auksion-users',  'getResponseAukcionGamers');

    Route::post('/add-only-now-auksiyon', 'addOnlyNowAuksiyon');
    Route::post('/add-only-now-auksiyon-with-timer', 'addOnlyNowAuksiyonWithTimer');
    Route::post('/check-auksiyon', 'checkAuksiyon');

    Route::post('/auksiyon/timer', 'auksiyonTimerFunc');
    Route::post('/complete-time-extend-timer', 'completeTimeExtendTimer');
    Route::post('/send/confirmation', 'sendConfirmation');
    Route::post('/send/confirmation/for-gamer', 'sendConfirmationForGamer');
    Route::post('/authorize-auksiyon-gamer', 'authorizeAuksiyonGamer');
    Route::post('/exit-from-auksiyon', 'exitFromAuksiyon');
    Route::post('/check-verification-code', 'checkVerificationCode');
    Route::post('/resend-verification-code', 'resendVerificationCode');
    Route::post('/delete-token', 'deleteToken');
});

// PRODUCT SHOW
Route::prefix('product')->controller(ProductController::class)->group(function() {
    Route::get('/{id}', 'index')->name('product');

    // WAITING PRODUCT
    Route::get('/no/published','NoPublishedProduct');
});

Route::post('/transaction/error/image/delete', [DeleteRollBackTransactionAnnounceImagesController::class, 'imageDelete']);

Route::post('/send-auksiyon-message',[AukcionRealTimeController::class, 'myMess'] );
