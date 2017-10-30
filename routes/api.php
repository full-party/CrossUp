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
Route::post('logout', 'Api\AuthController@logout');
Route::post('users', 'Api\AuthController', ['only' => ['store']]);
Route::resource('users', 'Api\UserController', ['only' => ['update']]);
Route::resource('games', 'Api\GameController', ['only' => ['index', 'show']]);
Route::resource('combos', 'Api\ComboController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
Route::resource('moves', 'Api\MoveController', ['only' => ['index']]);
Route::resource('characters', 'Api\CharacterController', ['only' => ['index', 'show']]);