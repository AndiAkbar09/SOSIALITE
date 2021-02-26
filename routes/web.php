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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('login/github','Login\GithubController@redirectToProvider');
Route::get('login/github/callback','Login\GithubController@handleProviderCallback');

Route::get('auth/google','Login\GoogleController@redirectToGoogle');
Route::get('auth/google/callback','Login\GoogleController@handleGoogleCallback');

Route::get('login/facebook','Login\FacebookController@redirectToProvider');
Route::get('login/facebook/callback','Login\FacebookController@handleProviderCallback');

Route::get('login/twitter','Login\TwitterController@redirectToProvider');
Route::get('login/twitter/callback','Login\TwitterController@handleProviderCallback');