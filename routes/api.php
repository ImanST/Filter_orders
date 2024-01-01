<?php

use App\Http\Controllers\FilterOrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('backoffice')->name('backoffice.')->group(function () {
    Route::post('orders', [FilterOrderController::class, 'ordersIndex'])->name('orders');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
