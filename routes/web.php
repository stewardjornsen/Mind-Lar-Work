<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Event;
use App\Post;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('post', 'PostController');
Route::resource('person', 'PersonController');

Route::get('/eve', 'HomeController@page')->name('eve');

Route::get('/adam/{event}/{song}', function ($event, $song) {
    $song = App\Video::find($song);
    $song = $song->events()->sync([1,2,4]);
    return $song;
});
Route::get('/symlink', function ($event, $song) {
   symlink('/home2/qittomal/laravel_stewardjornsen/public', '/home2/qittomal/public_html/stewardjornsen.com');
});

Route::get('/abel', function () {
    $p = App\Song::all();
    // $p->restore();
    return $p;
});
Route::get('/checkconnection', function () {
    return 1;
});
