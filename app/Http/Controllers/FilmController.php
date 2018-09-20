<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Film;
use App\Http\Requests\FilmRequest as Request;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FilmController extends Controller
{
	public function index()
	{
		$films = Film::with('comments')->paginate(1);

		return view('film.list', ['films' => $films]);
	}

	public function show($slug, Request $request)
	{
		$film = Film::where('slug', $slug)->first();

		if($request->ajax()) {
			return response()->json( $film, 200 );
		}

		return view('film.show', ['film'=>$film]);
	}

	public function create()
	{
		return view('film.create');
	}

	public function store(Request $request)
	{
		$film = Film::create($request->all());

		$film->genres()->attach($request->genre);

		Session::flash('alert-class', 'alert-success');
		Session::flash('message', 'Film successfully added!');

		if($request->ajax()) {
			return response()->json( $film, 201 );
		}

		return redirect(route('films.create'));
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

	public function commentStore(CommentRequest $request){

		$film = Film::find($request->fid);

		$comment = Comment::create([
			'name' => $request->name,
			'comment' => $request->comment,
			'user_id' => Auth::user()->id,
		]);

		$film->comments()->save($comment);

		return response()->json(['message' => 'Comment sent!'], 201);
	}
}
