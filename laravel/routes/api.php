<?php

use Illuminate\Http\Request;

Route::get('sortList',  function() {
  return [
    ['id' => '1', 'name' => 'ダメージ値降順'],
    ['id' => '2', 'name' => 'ダメージ値昇順'],
  ];
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
Route::resource('users', 'Api\UserController', ['only' => ['store']]);
Route::resource('games', 'Api\GameController', ['only' => ['index', 'show']]);
Route::resource('combos', 'Api\ComboController', ['only' => ['index', 'create', 'show', 'update', 'destroy']]);
Route::resource('moves', 'Api\MoveController', ['only' => ['index']]);
Route::resource('characters', 'Api\CharacterController', ['only' => ['index', 'show']]);