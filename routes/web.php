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

Route::get('/home', 'HomeController@index');
Route::get('/storylist', 'DatatableController@stories');
Route::resource('reports', 'ReportController');
Route::post('/reports/upload', 'ReportController@upload');
Route::post('/reports/upvote', 'UpvoteController@upvote');
Route::get('/users/profile', 'UserController@profile');
