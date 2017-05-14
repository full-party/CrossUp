<?php

use Illuminate\Http\Request;

Route::get('comboList',  function() {
  return [
    ['id' => 1, 'title' => '最強', 'damage' => '10'],
    ['id' => 2, 'title' => '波動拳コンボ', 'damage' => '40'],
    ['id' => 3, 'title' => 'やばいコンボ', 'damage' => '50'],
    ['id' => 4, 'title' => 'めちゃつよコンボ', 'damage' => '20'],
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
Route::resource('combos', 'Api\ComboController', ['only' => ['index', 'create', 'show', 'update', 'destroy']]);