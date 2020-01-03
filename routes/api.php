<?php

use App\Http\Controllers\HomeController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('post/json', 'PostController@json');
Route::resource('post', 'PostController');
Route::resource('person', 'PersonController');
Route::post('landing1', 'HomeController@landing');
Route::get('landing1', 'HomeController@landing');

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {

    Route::post('landing2', 'HomeController@landing');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});
