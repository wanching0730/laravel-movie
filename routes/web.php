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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'MovieController@index')->name('/');

Route::get('/home', 'MovieController@index')->name('home');

Route::get('/movie/create', 'MovieController@create')->name('movie.create');
Route::post('/movie/store', 'MovieController@store')->name('movie.store');
Route::get('/movie', 'MovieController@index')->name('movie.index');
Route::get('/movie/{id}', 'MovieController@show')->name('movie.show');
Route::get('/movie/edit/{id}', 'MovieController@edit')->name('movie.edit');
Route::post('/movie/update/{id}', 'MovieController@update')->name('movie.update');
Route::delete('movie/{id}', 'MovieController@destroy')->name('movie.destroy');
Route::get('movie/{id}/image', 'MovieController@image');
