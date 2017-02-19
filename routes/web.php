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


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/errors', function () {
    return view('messages.errors');
});

Auth::routes();


Route::get('/home', 'HomeController@index');

Route::resource('articles', 'ArticleController');

Route::resource('comments', 'CommentController',  ['except' => ['store']]);

Route::post('/add/{id}', 'CommentController@add')->name('comments.add');

Route::resource('likes', 'LikeController',  ['except' => ['store']]);

Route::post('/store/{id}', 'LikeController@store')->name('likes.store');

Route::resource('messages', 'MessageController');

Route::get('/profile', 'ProfileController@index')->name('profile');


