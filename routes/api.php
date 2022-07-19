<?php

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

//Регистрация через web
Route::get('/home', [App\Http\Controllers\Api\DeskController::class, 'index']);

Route::post('/login', [\App\Http\Controllers\Api\Auth\LoginController::class, 'login']);

Route::group(['middleware'=>['jwt.verify']], function (){
    Route::post('/store', [App\Http\Controllers\Api\DeskController::class, 'store']);
    Route::delete('/delete/{desk}', [App\Http\Controllers\Api\DeskController::class, 'destroy']);
    Route::get('/refresh', [\App\Http\Controllers\Api\Auth\LoginController::class, 'refresh']);
});
