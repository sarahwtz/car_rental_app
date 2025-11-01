<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;



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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::apiResource('clients', 'App\Http\Controllers\ClientController');
Route::apiResource('brands', 'App\Http\Controllers\BrandController');
Route::apiResource('rentals', 'App\Http\Controllers\RentalController');
Route::apiResource('cars', 'App\Http\Controllers\CarController');
Route::apiResource('car-models', 'App\Http\Controllers\CarModelController');
