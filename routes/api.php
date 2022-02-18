<?php

use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Movie\MovieIndexController;
use App\Http\Controllers\Movie\MovieShowController;
use App\Http\Controllers\Movie\MovieStoreController;
use App\Http\Controllers\Movie\MovieUpdateController;
use App\Http\Controllers\User\UserDestroyController;
use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\User\UserSaveMoviesController;
use App\Http\Controllers\User\UserShowController;
use App\Http\Controllers\User\UserStoreController;
use App\Http\Controllers\User\UserUpdateController;
use Illuminate\Support\Facades\Route;


Route::prefix('user')->group(function () {
    Route::post('/', UserStoreController::class)->name('user.store'); 
    Route::post('/login', UserLoginController::class)->name('user.login'); 
    Route::get('/{user}', UserShowController::class)->name('user.show');
    Route::delete('/{user}', UserDestroyController::class)->name('user.destroy');   
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/save-movies', UserSaveMoviesController::class)->name('user.saveMovies'); 
        Route::put('/{user}', UserUpdateController::class)->name('user.update');
    });
});

Route::prefix('movie')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/', MovieIndexController::class);
        Route::get('/{movieId}', MovieShowController::class)->name('movie.show');
        
        Route::middleware('auth.admin')->group(function () {
            Route::post('/',MovieStoreController::class);
            Route::put('/{movieId}', MovieUpdateController::class);
            Route::delete('/{movieId}',[MovieController::class,'destroy']); 
        });
    });
});

Route::prefix('payments')->group(function () {
    
        
            Route::post('/',[PaymentController::class, 'createPayment']);
            Route::get('/',[PaymentController::class, 'getPayments']); 
        
    
});