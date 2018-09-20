<?php

namespace App\Http\Controllers;

use App\Film;
use App\Http\Requests\FilmRequest as Request;

class FilmController extends Controller
{
	public function index()
	{
		$films =  Film::paginate(1);

		return view('film.list', ['films' => $films]);
	}

	public function show($slug)
	{
		return Film::where('slug', $slug)->first();
	}

	public function create()
	{
		return view('film.create');
	}

	public function store(Request $request)
	{
		$film = Film::create($request->all());

		return response()->json($film, 201);
	}

	public function update(Request $request, $id)
	{
		$film = Film::findOrFail($id);

		return response()->json($film, 200);
	}

	public function delete(Request $request, $id)
	{
		$film = Film::findOrFail($id);
		$film->delete();

		return response()->json(null, 204);
	}
}
