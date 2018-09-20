<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
*/

$factory->define(App\Comment::class, function (Faker $faker) {
	return [
		'name' => $faker->name,
		'comment' => $faker->sentence,
		'user_id' => factory(App\User::class)->create()->id
	];
});
