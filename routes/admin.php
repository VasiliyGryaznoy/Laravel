<?php

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Blade;

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
Blade::setContentTags('<%', '%>');
Blade::setEscapedContentTags('<%%', '%%>');


//Route::resource('authenticate', 'Api\AuthController', ['only' => ['index']]);
Route::get('/', 'Admin\IndexController@getIndex');
