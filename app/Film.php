<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Film extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'name',
		'slug',
		'description',
		'release_date',
		'rating',
		'ticket_price',
		'country_code',
		'photo',
	];

	/*
	 * many to many relation between film and genre
	 */
	public function genres(){
		return $this->belongsToMany(Genre::class);
	}

	public function comments(){
		return $this->hasMany(Comment::class);
	}

}
