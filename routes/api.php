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

//Route::resource('authenticate', 'Api\AuthController', ['only' => ['index']]);
Route::post('authenticate', 'Api\AuthController@authenticate');

Route::group(['middleware' => 'jwt.auth'], function(){
    Route::get('users', 'Api\UsersController@users');
});

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:api');
