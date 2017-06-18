<?php

use Illuminate\Http\Request;

Route::get('characterList',  function() {
  return [
    ['id' => '1', 'name' => 'リュウ'],
    ['id' => '2', 'name' => 'ケン'],
  ];
});

Route::get('firstList',  function() {
  return [
    ['id' => '1', 'name' => '5弱P'],
    ['id' => '2', 'name' => '波動拳 弱'],
  ];
});


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
Route::resource('games', 'Api\GameController', ['only' => ['index', 'show']]);
Route::resource('combos', 'Api\ComboController', ['only' => ['index', 'create', 'show', 'update', 'destroy']]);
Route::resource('characters', 'Api\CharacterController', ['only' => ['index']]);
Route::resource('users', 'Api\UserController', ['only' => ['store']]);