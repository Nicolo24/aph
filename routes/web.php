<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/assign', [App\Http\Controllers\HomeController::class, 'assign'])->name('assign');
Route::post('/unassign', [App\Http\Controllers\HomeController::class, 'unassign'])->name('unassign');
Route::post('/report', [App\Http\Controllers\HomeController::class, 'report'])->name('report');
Route::resource('institutions', App\Http\Controllers\InstitutionController::class);
Route::resource('zones', App\Http\Controllers\ZoneController::class);
Route::resource('provinces', App\Http\Controllers\ProvinceController::class);
Route::resource('centers', App\Http\Controllers\CenterController::class);
Route::resource('reporttypes', App\Http\Controllers\ReporttypeController::class);
Route::resource('resourcetypes', App\Http\Controllers\ResourcetypeController::class);
Route::resource('basetypes', App\Http\Controllers\BasetypeController::class);
Route::resource('usertypes', App\Http\Controllers\UsertypeController::class);
Route::resource('resources', App\Http\Controllers\ResourceController::class);
Route::resource('bases', App\Http\Controllers\BasisController::class);
Route::resource('reports', App\Http\Controllers\ReportController::class);
Route::resource('assignations', App\Http\Controllers\AssignationController::class);