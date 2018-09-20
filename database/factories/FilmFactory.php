<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
*/

$factory->define(App\Film::class, function (Faker $faker) {
	$county = config('film.countries');
	return [
		'name' => $name = $faker->name,
		'slug' => str_slug($name),
		'description' => $faker->sentence,
		'release_date' => $faker->date(),
		'rating' => rand(1, 5),
		'ticket_price' => rand(30, 300),
		'country_code' =>  array_rand($county),
		'photo' => base64_encode(file_get_contents( "public/images/".rand(1,11).".jpg" )),
	];
});
