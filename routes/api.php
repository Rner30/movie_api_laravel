<?php

use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('user')->group(function () {
    Route::post('/', [UserController::class,'store'])->name('user.store'); 
    Route::get('/{user}', [UserController::class,'show'])->name('user.show');   
    Route::put('/{user}', [UserController::class,'update'])->name('user.update');
    Route::delete('/{user}', [UserController::class,'delete'])->name('user.delete');   

    Route::post('/save-movies/{user}', [UserController::class,'saveMovies'])->name('user.saveMovies'); 
});

Route::prefix('movie')->group(function () {
    Route::get('/',[MovieController::class,'index']);
    Route::post('/',[MovieController::class,'store']);
    Route::get('/{movieId}',[MovieController::class,'show']);
    Route::put('/{movieId}',[MovieController::class,'update']);
    Route::delete('/{movieId}',[MovieController::class,'destroy']);
});
