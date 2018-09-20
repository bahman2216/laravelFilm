<?php

namespace App\Http\Controllers;

use App\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
	public function index()
	{
		return Film::all();
	}

	public function show($id)
	{
		return Film::find($id);
	}

	public function store(Request $request)
	{
		return Film::create($request->all());
	}

	public function update(Request $request, $id)
	{
		$film = Film::findOrFail($id);
		$film->update($request->all());

		return $film;
	}

	public function delete(Request $request, $id)
	{
		$film = Film::findOrFail($id);
		$film->delete();

		return 204;
	}
}
