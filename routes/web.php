<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/profile/{user}', 'HomeController@user')->name('profile');

Route::post('/posts', 'PostController@store');

Route::get('/posts/create', 'PostController@create');

Route::get('/posts/{post}', 'PostController@show');