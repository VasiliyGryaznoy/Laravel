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
Route::post('logout', 'Api\AuthController@logout');
Route::post('signup', 'Api\AuthController@signup');

Route::group(['middleware' => 'jwt.auth'], function(){
    Route::resource('users', 'Api\UsersController', ['only' => ['index', 'show']]);
    Route::resource('files', 'Api\FilesController');
    Route::resource('images', 'Api\ImagesController');
});

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:api');
