<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class PostController extends Controller
{ 
    // insert the provided question into the database
    public function store() {
      // server validation
      request()->validate([ 'question' => 'required|min:5|max:50|ends_with:?' ]);
      $question = request('question');
      $id = DB::table('question')->insertGetId( ['text' => $question] );
      return redirect("question/$id");
    }

    public function show($id) {
      $data = DB::table('question')->where('id', $id)->first();
      dd($data);
    }
}
