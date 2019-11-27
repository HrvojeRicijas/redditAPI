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
    return redirect('/index/1');
});

Route::get('/test', function () {
    return view('index');
});

Route::get('/index', function () {
    return redirect('/index/1');
});
Route::get('/index/{sorting}', 'PostController@index');
Route::get('/index/{sorting}/{after?}/{direction}', 'PostController@index');


