<?php

use App\Http\Controllers\api\AdController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\DistrictController;
use App\Http\Controllers\Api\MesaageController;
use App\Http\Controllers\Api\SettingController;
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


## ---------------------------------- AUTH MODULE
Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

Route::get('/setting',SettingController::class);

## ---------------------------------- CITIES MODULE
Route::get('/cities', CityController::class);

## ---------------------------------- DISTRICTS MODULE
Route::get('/districts', DistrictController::class);

## ---------------------------------- MESSAGES MODULE

Route::post('/message', MesaageController::class);


## ---------------------------------- ADS MODULE
Route::prefix('ads')->controller(AdController::class)->group(function () {
    // basic
    Route::get('/', 'index');
    Route::get('/latest', 'latest');
    Route::get('/domain/{domain_id}', 'domain');
    Route::get('/search', 'search');


    Route::middleware('auth:sanctum')->group(function () {
        Route::post('create', 'create');
        Route::post('update/{adId}', 'update');
        Route::get('delete/{adId}', 'delete');
        Route::get('myads', 'myads');
    });
});

