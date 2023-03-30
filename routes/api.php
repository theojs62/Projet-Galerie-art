<?php

use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\SalleController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(\App\Http\Controllers\Api\AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::prefix('salles')->group(function () {
    Route::get('/', [SalleController::class, 'index'])
        ->middleware(['auth', 'role:visiteur'])
        ->name('salles.index');
    Route::get('/{id}', [SalleController::class, 'show'])
        ->middleware(['auth', 'role:view_salle'])
        ->name('salles.show');
    Route::put('/{id}', [SalleController::class, 'update'])
        ->middleware(['auth', 'role:edit_salle'])
        ->name('salles.update');
    Route::post('/', [SalleController::class, 'store'])
        ->middleware(['auth', 'role:create_salle'])
        ->name('salles.store');
    Route::delete('/{id}', [SalleController::class, 'destroy'])
        ->middleware(['auth', 'role:admin'])
        ->name('salles.destroy');
});

Route::prefix('clients')->group(function () {
    Route::get('/', [ClientController::class, 'index'])
        ->middleware(['auth', 'role:admin'])
        ->name('clients.index ');
    Route::delete('/{id}', [ClientController::class, 'destroy'])
        ->middleware(['auth', 'role:admin'])
        ->name('clients.destroy');
    Route::put('/{id}', [ClientController::class, 'update'])
        ->name('clients.update');

});

// Route::apiResource('salles', SalleController::class)->middleware(['auth', 'role:admin']);
//Route::apiResource('clients', ClientController::class)->middleware(['auth', 'role:admin']);






