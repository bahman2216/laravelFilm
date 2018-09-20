<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Film;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Model;


class FilmTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

	    factory(App\Film::class, 3)->create();
	    factory(App\Genre::class, 4)->create();

	    factory(App\User::class, 1)->create();

	    factory(App\Film::class, 3)->create()->each(function ($film) {
		    $film->genres()->save(factory(App\Genre::class)->make());
	    });

	    factory(App\Film::class, 3)->create()->each(function ($film) {
		    factory(\App\Comment::class, 1)->create(['film_id'=>$film->id]);
	    });

    }
}
