<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//route for login
Route::post('/login', [App\Http\Controllers\ApiController::class,'login']);
//route for logout
Route::middleware('auth:sanctum')->post('/logout', [App\Http\Controllers\ApiController::class,'logout']);
//route for get user info
Route::middleware('auth:sanctum')->post('/me', [App\Http\Controllers\ApiController::class,'me']);
//route for get reports
Route::middleware('auth:sanctum')->get('/reports', [App\Http\Controllers\ApiController::class,'reports']);
//route for get resources
Route::middleware('auth:sanctum')->get('/resources', [App\Http\Controllers\ApiController::class,'resources']);




