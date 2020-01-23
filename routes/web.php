<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/profile/{user}', 'HomeController@user')->name('profile');

Route::get('/posts/{post}', 'PostController@show');