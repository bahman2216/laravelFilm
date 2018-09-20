<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
	protected $fillable = ['name'];

	/*
	 * many to many relation between film and genre
	 */
    public function films(){
    	return $this->blongToMany(Film::class);
    }
}
