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

Route::get('/map', [App\Http\Controllers\MapController::class, 'index'])->name('map');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
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
Route::resource('routes', App\Http\Controllers\RouteController::class);
Route::resource('locations', App\Http\Controllers\LocationController::class);

Route::post('/items', [App\Http\Controllers\ItemsController::class, 'index'])->name('items.index');
Route::get('/items/getAllPlaces', [App\Http\Controllers\ItemsController::class, 'getAllPlaces'])->name('items.getAllPlaces');
Route::get('/items/getAllGeocodes', [App\Http\Controllers\ItemsController::class, 'getAllGeocodes'])->name('items.getAllGeocodes');
Route::get('/items/getOneGeocode', [App\Http\Controllers\ItemsController::class, 'getOneGeocode'])->name('items.getOneGeocode');
Route::get('/items/getReverseGeocode', [App\Http\Controllers\ItemsController::class, 'getReverseGeocode'])->name('items.getReverseGeocode');

Route::get('/route/{id}/points', [App\Http\Controllers\ApiRouteController::class, 'getPoints'])->name('route.getPoints');
