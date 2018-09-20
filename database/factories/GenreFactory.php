<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
*/

$factory->define(App\Genre::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['Western', 'Crime', 'Drama', 'Historical', 'Horror', 'Magical realism', 'Mystery', 'Paranoid Fiction', 'Philosophical', 'Political', 'Romance', 'Saga', 'Satire', 'Science fiction', 'Speculative', 'Thriller', 'Urban']),
    ];
});
