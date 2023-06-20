<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ApiRouteController;

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

//route for login
Route::post('/login', [App\Http\Controllers\ApiController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [ApiController::class, 'logout']);
    Route::get('/me', [ApiController::class, 'me']);
    Route::put('/user/availability', [ApiRouteController::class, 'updateAvailability']);
    Route::get('/user/availability', [ApiRouteController::class, 'getAvailability']);
    Route::get('/routes/available', [ApiRouteController::class, 'getAvailableRoutes']);
    Route::put('/routes/{id}/start', [ApiRouteController::class, 'startRoute']);
    Route::put('/routes/{id}/informPickedUp', [ApiRouteController::class, 'informPickedUp']);
    Route::post('/routes/{id}/location', [ApiRouteController::class, 'sendLocation']);
    Route::put('/routes/{id}/finish', [ApiRouteController::class, 'endRoute']);
    
});
