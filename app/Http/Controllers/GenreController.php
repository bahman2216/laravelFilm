<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Http\Requests\GenreRequest as Request;

class GenreController extends Controller
{
	public function index()
	{
		$genres =  Genre::paginate(1);

		return view('genre.list', ['genres' => $genres]);
	}

	public function show($id)
	{
		return Genre::find($id);
	}

	public function create()
	{
		$genres = Genre::all();

		return view('film.create-genre', ['genres' => $genres]);
	}

	public function store(Request $request)
	{
		$genre = Genre::create($request->all());

		if($request->ajax()) {
			return response()->json( $genre, 201 );
		}

		return redirect(route('genres.create'));
	}

	public function update(Request $request, $id)
	{
		$genre = Genre::findOrFail($id);

		return response()->json($genre, 200);
	}

	public function delete(Request $request, $id)
	{
		$genre = Genre::findOrFail($id);
		$genre->delete();

		return response()->json(null, 204);
	}
}
