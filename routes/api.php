<?php

use App\Http\Controllers\api\v1\ApartmentsAPIController;
use App\Http\Controllers\api\v1\ColorsAPIController;
use App\Http\Controllers\api\v1\FurnitureTypesAPIController;
use App\Http\Controllers\api\v1\MaterialsAPIController;
use App\Http\Controllers\api\v1\PiecesOfFurnitureAPIController;
use App\Http\Controllers\api\v1\RoomsAPIController;
use App\Http\Controllers\api\v1\RoomTypesAPIController;
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

Route::controller(ApartmentsAPIController::class)
    ->prefix('apartments')
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
    });

Route::controller(RoomsAPIController::class)
    ->prefix('rooms')
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
    });

Route::controller(PiecesOfFurnitureAPIController::class)
    ->prefix('pieces-of-furniture')
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
    });

// essentially dictionaries
Route::controller(MaterialsAPIController::class)
    ->prefix('materials')
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
    });

Route::controller(ColorsAPIController::class)
    ->prefix('colors')
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
    });

Route::controller(FurnitureTypesAPIController::class)
    ->prefix('furniture-types')
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
    });

Route::controller(RoomTypesAPIController::class)
    ->prefix('room-types')
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
    });

