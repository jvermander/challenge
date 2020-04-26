<?php

use Illuminate\Support\Facades\Route;

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

// question submission page (default landing)
Route::get('/', function() {
  return view('landing');
});


// store a new question
Route::post('question', 'PostController@store_q');
Route::get('question', function() {
  abort(404);
});

// store a new answer, to some question
Route::post('question/{id}/answer', 'PostController@store_a');
Route::get('question/{id}/answer', function() {
  abort(404);
});

// display an existing question and its answers
Route::get('question/{id}', 'PostController@show');

