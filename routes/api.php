<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovieController;

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

Route::group([

    'middleware' => 'auth:api',
    'prefix' => 'auth'

], function () {

    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);

});

Route::group([
    'prefix' => 'auth'
], function () {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

});

Route::group([
    'middleware' => ['auth:api', 'role:user-admin'],
    'prefix' => 'movies'
], function() {
    Route::get('create', [MovieController::class, 'create']);
    Route::get('/index', [MovieController::class, 'index']);
    Route::get('/show', [MovieController::class, 'show']);
    Route::get('destroy', [MovieController::class, 'destroy']);
});