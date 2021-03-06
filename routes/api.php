<?php

use Illuminate\Http\Request;

Route::get('sortList',  function() {
  return [Config::get('sort')];
});


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

Route::post('login', 'Api\AuthController@login');
Route::post('users', 'Api\AuthController@store');

Route::group(['middleware' => 'login:api'], function () {
    Route::post('logout', 'Api\AuthController@logout');
    Route::resource('users', 'Api\UserController', ['only' => ['update', 'destroy']]);
    Route::resource('games', 'Api\GameController', ['only' => ['index', 'show']]);
    Route::resource('combos/statuses', 'Api\Combos\StatusController', ['only' => ['index']]);
    Route::resource('combos', 'Api\ComboController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
    Route::resource('moves', 'Api\MoveController', ['only' => ['index']]);
    Route::resource('characters', 'Api\CharacterController', ['only' => ['index', 'show']]);
});