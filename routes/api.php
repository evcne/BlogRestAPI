<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserAPIController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostAPIController;




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

Route::group(['prefix' => 'auth'], function(){
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
});

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/', [UserAPIController::class, 'index']);
    Route::post('/', [UserAPIController::class, 'store']);
    Route::get('/{id}', [UserAPIController::class, 'show']);
    Route::put('/{id}', [UserAPIController::class, 'update']);
    Route::delete('/{id}', [UserAPIController::class, 'delete']);

    Route::post('posts', [PostAPIController::class, 'store']);
    Route::get('posts', [PostAPIController::class, 'index']);
    Route::get('posts/{id}', [PostAPIController::class, 'show']);
    Route::put('posts/{id}', [PostAPIController::class, 'update']);
    Route::delete('posts/{id}', [PostAPIController::class, 'delete']);

});


