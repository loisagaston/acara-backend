<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\PriceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix("v1")->group(function () {
    Route::prefix("prices")->group(function () {
        Route::get('', [PriceController::class, 'index']);
        Route::post('', [PriceController::class, 'store']);
        Route::post('/import-prices', [PriceController::class, 'importPrices']);
        Route::prefix("{price}")->group(function () {
            Route::get('', [PriceController::class, 'show']);
            Route::put('', [PriceController::class, 'update']);
            Route::delete('', [PriceController::class, 'destroy']);
        });
    });
});