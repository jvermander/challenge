<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class PostController extends Controller
{ 
    // insert the provided question into the database, then redirect to the question display
    public function store_q() {
      // server-side input validation
      request()->validate([ 'question' => 'required|min:5|max:50|ends_with:?' ]);
      $question = request('question');
      $id = DB::table('question')->insertGetId( ['text' => $question] );
      return redirect("question/$id");
    }

    public function store_a($id) {
      request()->validate([ 'answer' => 'required|min:5|max:50|' ]);
      $answer = request('answer');
      DB::table('answer')->insert( ['text' => $answer, 'qid' => $id] );
      return redirect("question/$id");
    }


    public function show($id) {
      $question = DB::table('question')->where('id', $id)->first();
      if(!$question) {
        abort(404);
      }
      $answers = DB::table('answer')->where('qid', $id)->orderBy('id')->pluck('text');
      return view('question', [ 'question' => $question, 'answers' => $answers ]);
    }
}
?>
