<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/profile/{user}', 'HomeController@user')->name('profile');

Route::post('/posts', 'PostController@store');

Route::get('/posts', 'PostController@index');

Route::get('/posts/create', 'PostController@create');

Route::get('/posts/{post}', 'PostController@show');

Route::get('/posts/{post}/edit', 'PostController@edit')
	->middleware('can:update,post');

Route::patch('/posts/{post}', 'PostController@update')
	->middleware('can:update,post');

Route::get('/posts/{post}/delete', 'PostController@delete')
	->middleware('can:delete,post');

Route::delete('/posts/{post}', 'PostController@destroy')
	->middleware('can:delete,post');