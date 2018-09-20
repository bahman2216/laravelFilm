<?php

use Illuminate\Database\Seeder;

class FilmTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $county = config('countries')->random();
	    $settlement = $county->settlements->random();

	    factory(App\Role::class, 20)->create();

		// Populate users
	    factory(App\User::class, 50)->create();

		// Get all the roles attaching up to 3 random roles to each user
	    $roles = App\Role::all();

		// Populate the pivot table
	    App\User::all()->each(function ($user) use ($roles) {
		    $user->roles()->attach(
			    $roles->random(rand(1, 3))->pluck('id')->toArray()
		    );
	    });

	    \Illuminate\Support\Facades\DB::table('films')->insert([
		    'name' => str_random(10),
		    'description' => str_random(1000),
		    'release_date' => date('YY/mm/dd'),
		    'rating' => range(1, 5),
		    'ticket_price' => range(30, 300),
		    'country_code' => $settlement,
		    'photo' => str_random(100),
	    ]);
    }
}
