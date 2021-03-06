<?php

Auth::routes();

Route::get('/', 'MovieController@index')->name('/');
Route::get('/home', 'MovieController@index')->name('home');

Route::get('/movie/create', 'MovieController@create')->name('movie.create');
Route::post('/movie/store', 'MovieController@store')->name('movie.store');
Route::get('/movie', 'MovieController@index')->name('movie.index');
Route::get('/movie/{id}', 'MovieController@show')->name('movie.show');
Route::get('/movie/edit/{id}', 'MovieController@edit')->name('movie.edit');
Route::post('/movie/update/{id}', 'MovieController@update')->name('movie.update');
Route::delete('/movie/{id}', 'MovieController@destroy')->name('movie.destroy');

Route::post('/movie/deleteAll', 'MovieController@deleteAll')->name('movie.deleteAll');
Route::get('/movie/sort/{sort}', 'MovieController@getMovieBySort')->name('movie.sort');
Route::post('/movie/search', 'MovieController@getMovieBySearch')->name('movie.search');
Route::get('/movie/trailer/{id}', 'MovieController@viewTrailer')->name('movie.trailer');


