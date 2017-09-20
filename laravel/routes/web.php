<?php


Route::get('/{any}', 'Controller@checkLogin')->where('any', '.*');