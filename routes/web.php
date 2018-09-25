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
    return view('github_users.search');
});

Route::get('/search/users/{search}', 'GitHubUserController@search');
Route::get('/users/followers/', 'GitHubUserController@getFollowers');
Route::get('/users/{username}', 'GitHubUserController@show');
