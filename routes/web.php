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
route::get('/historic', [App\Http\Controllers\HistoricController::class, 'index'])->name('historic');
Route::resource('institutions', App\Http\Controllers\InstitutionController::class);
Route::resource('zones', App\Http\Controllers\ZoneController::class);
Route::resource('provinces', App\Http\Controllers\ProvinceController::class);
Route::resource('centers', App\Http\Controllers\CenterController::class);
Route::resource('reporttypes', App\Http\Controllers\ReporttypeController::class);
Route::resource('resourcetypes', App\Http\Controllers\ResourcetypeController::class);
Route::resource('basetypes', App\Http\Controllers\BasetypeController::class);
Route::resource('usertypes', App\Http\Controllers\UsertypeController::class);
Route::resource('resources', App\Http\Controllers\ResourceController::class);
Route::post('resources/{id}/restore', [App\Http\Controllers\ResourceController::class, 'restore'])->name('resources.restore');
Route::resource('bases', App\Http\Controllers\BaseController::class);
Route::post('bases/{id}/restore', [App\Http\Controllers\BaseController::class, 'restore'])->name('bases.restore');
Route::resource('reports', App\Http\Controllers\ReportController::class);
Route::resource('assignations', App\Http\Controllers\AssignationController::class);
Route::resource('users', App\Http\Controllers\UserController::class);
Route::resource('classifications', App\Http\Controllers\ClassificationController::class);