<?php

use Illuminate\Http\Request;

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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

Route::middleware(['auth.jwt'])->group(function() {
    Route::get('logout', 'AuthController@logout');

    Route::apiResource('users', 'UserController')->only('index');
    Route::apiResource('enemies', 'EnemyController')->only('show');
    Route::apiResource('actions', 'ActionController')->only('store');
    Route::apiResource('games', 'GameController')->only(['store', 'show', 'index']);
});