<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/films');
});

Route::group( [ 'prefix' => 'films', 'as' => 'films.', 'namespace' => '\App\Http\Controllers' ], function () {
	Route::get( '/create', [ 'as' => 'create', 'uses' => 'FilmController@create' ] );
	Route::get( '/', [ 'as' => 'index', 'uses' => 'FilmController@index' ] );
	Route::get( '/{slug}', [ 'as' => 'show', 'uses' => 'FilmController@show' ] );
} );

Auth::routes();





