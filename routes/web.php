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

// handle storage of a new question
Route::post('question', 'PostController@store');

// view an existing question
Route::get('question/{id}', 'PostController@show');