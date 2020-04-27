<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class PostController extends Controller
{ 
    // insert the provided question into the database, then redirect to the question display
    public function store_q() {
      // server-side input validation
      request()->validate([ 'question' => 'required|min:5|max:100|ends_with:?' ]);
      $question = request('question');
      $id = DB::table('question')->insertGetId( ['text' => $question] );
      return redirect("question/$id");
    }

    // insert the provided answer for some question into the database,
    // then redirect to the question's display 
    public function store_a($id) {
      request()->validate([ 'answer' => 'required|min:5|max:100|' ]);
      $answer = request('answer');
      DB::table('answer')->insert( ['text' => $answer, 'qid' => $id] );
      return redirect("question/$id");
    }

    // display a question (and its answers)
    public function show($id) {
      $question = DB::table('question')->where('id', $id)->first();
      if(!$question) {
        abort(404);
      }
      $answers = DB::table('answer')->where('qid', $id)->orderBy('id', 'ASC')->pluck('text');
      return view('question', [ 'question' => $question, 'answers' => $answers ]);
    }
}
?>
