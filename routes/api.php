<?php

use App\Http\Controllers\api\v1\ApartmentsAPIController;
use App\Http\Controllers\api\v1\RoomsAPIController;
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

