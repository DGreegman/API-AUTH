<?php

use App\Http\Controllers\API\V1\LogoutController;
use App\Http\Controllers\API\V1\RegisterController;
use App\Http\Controllers\API\V1\TaskController;
use App\Http\Controllers\API\V1\UserLoginController;

use App\Http\Controllers\API\V2\LogoutController as V2LogoutController;
use App\Http\Controllers\API\V2\RegisterController as V2RegisterController;
use App\Http\Controllers\API\V2\TaskController as V2TaskController;
use App\Http\Controllers\API\V2\UserLoginController as V2UserLoginController;

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

Route::prefix('v1')->as('v1.')->group(function(){
    Route::apiResource('task', TaskController::class)->middleware('auth:sanctum');
    Route::post('logout', LogoutController::class)->name('logout')->middleware('auth:sanctum');

    Route::post('register', RegisterController::class)->name('register');
    Route::post('login', UserLoginController::class)->name('login');
});

Route::prefix('v2')->as('v2.')->group(function(){
    Route::apiResource('task', V2TaskController::class)->middleware('auth:sanctum');
    Route::post('logout', V2LogoutController::class)->name('logout')->middleware('auth:sanctum');

    Route::post('register', V2RegisterController::class)->name('register');
    Route::post('login', V2UserLoginController::class)->name('login');
});