<?php

use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\User\UserLoginController;
use Illuminate\Support\Facades\Route;


Route::prefix('user')->group(function () {
    Route::post('/', [UserController::class,'store'])->name('user.store'); 
    Route::post('/login', UserLoginController::class)->name('user.login'); 
    Route::get('/{user}', [UserController::class,'show'])->name('user.show');
    Route::delete('/{user}', [UserController::class,'destroy'])->name('user.destroy');   
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/save-movies', [UserController::class,'saveMovies'])->name('user.saveMovies'); 
        Route::put('/{user}', [UserController::class,'update'])->name('user.update');
    });
});

Route::prefix('movie')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/',[MovieController::class,'index']);
        Route::get('/{movieId}',[MovieController::class,'show']);
        
        Route::middleware('auth.admin')->group(function () {
            Route::post('/',[MovieController::class,'store']);
            Route::put('/{movieId}',[MovieController::class,'update']);
            Route::delete('/{movieId}',[MovieController::class,'destroy']); 
        });
    });
});

Route::prefix('payments')->group(function () {
    
        
            Route::post('/',[PaymentController::class, 'createPayment']);
            Route::get('/',[PaymentController::class, 'getPayments']); 
        
    
});