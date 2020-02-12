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
    return redirect('/books');
});

/*Route::get('user/{id}', function($id)
{
    return 'User '.$id;
});*/


/* Books */
Route::get('/books', 'BooksController@index');
Route::get('/books/create', 'BooksController@create');
Route::get('/books/search', 'BooksController@search');
Route::get('/books/{book}/edit', 'BooksController@edit');
Route::get('/books/{book}', 'BooksController@show');

Route::put('/books/{book}', 'BooksController@update');
Route::delete('/books/{book}', 'BooksController@destroy');
Route::post('/books', 'BooksController@store');

/* Series */
Route::get('/series', 'SeriesController@index');
Route::get('/series/create', 'SeriesController@create');
Route::get('/series/{serie}/edit', 'SeriesController@edit');
Route::get('/series/{serie}', 'SeriesController@show');

Route::put('/series/{serie}', 'SeriesController@update');
Route::delete('/series/{serie}', 'SeriesController@destroy');
Route::post('/series', 'SeriesController@store');
