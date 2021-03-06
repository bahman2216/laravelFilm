<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware( 'auth:api' )->get( '/user', function ( Request $request ) {
	return $request->user();
} );

Route::group( [ 'prefix' => 'films', 'as' => 'films.', 'namespace' => '\App\Http\Controllers' ], function () {
	Route::get( '/', [ 'as' => 'index', 'uses' => 'FilmController@index' ] );
	Route::get( '/{slug}', [ 'as' => 'show', 'uses' => 'FilmController@show' ] );
	Route::post( '/store', [ 'as' => 'store', 'uses' => 'FilmController@store' ] );

	Route::put( '/{id}', [ 'as' => 'update', 'uses' => 'FilmController@update' ] );
	Route::delete( '/{id}', [ 'as' => 'delete', 'uses' => 'FilmController@delete' ] );
} );
Route::group( [ 'prefix' => 'genres', 'as' => 'genres.', 'namespace' => '\App\Http\Controllers' ], function () {
	Route::get( '/', [ 'as' => 'index', 'uses' => 'GenreController@index' ] );
	Route::get( '/{id}', [ 'as' => 'show', 'uses' => 'GenreController@show' ] );
	Route::post( '/store', [ 'as' => 'store', 'uses' => 'GenreController@store' ] );
	Route::put( '/{id}', [ 'as' => 'update', 'uses' => 'GenreController@update' ] );
	Route::delete( '/{id}', [ 'as' => 'delete', 'uses' => 'GenreController@delete' ] );
} );
