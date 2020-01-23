<?php

/** @var Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Post::class, function (Faker $faker) {
	return [
		'user_id' => function () {
			return create(User::class)->id;
		},
		'title'   => $faker->title,
		//the 2nd param is required to return a string
		'content' => $faker->paragraphs(3, true),
	];
});
