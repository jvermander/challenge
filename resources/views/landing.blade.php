<!doctype html>
<html lang="en">
<head>
<title> Q & A </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="/styles/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<?php
  // define("PLACEHOLDER_Q", "No questions yet. Be the first one to ask a question by using the form above.");
  $questions = array("What way of dying do you fear the most?",
                     "What fictional character do you most relate to?",
                     "What is your opinion on psychedelic drugs?",
                     "What advice would you give to a younger version of yourself, given the chance?",
                     "Where do vegans obtain Omega-3?");
  ?>
<script>
  const Q_MIN_LENGTH = 5;
  const Q_MAX_LENGTH = 50;

  function validate_q() {
    var str = document.getElementById("q_text").value.trim();

    if(str.length < Q_MIN_LENGTH || str.length > Q_MAX_LENGTH || str.charAt(str.length-1) != "?") {
      var errmsg;
      if(str.length < Q_MIN_LENGTH) errmsg = "Your question must be at least "+Q_MIN_LENGTH+" characters.";
      else if(str.length > Q_MAX_LENGTH) errmsg = "Your question must be no longer than "+Q_MAX_LENGTH+" characters.";
      else if(str.charAt(str.length-1) != "?") errmsg = "Your question must end with a question mark (?).";
      
      document.getElementById("q_err").innerHTML = errmsg;
      document.getElementById("q_err").classList.add("alert", "alert-danger");
      document.getElementById("question").classList.add("has-warning");
    } else {
      document.getElementById("q_form").submit();
    }
  }
</script>
</head>
<body>
  
  <div class="jumbotron text-center"> 
    <h1><a href="/">
      Q & A
    </a></h1> 
  </div>

  <h3 class="container well text-center"><a href="#question" data-toggle="collapse"> Ask a question <span class="glyphicon glyphicon-question-sign"></span></a></h3>

  <div id="question" class="container text-center form-group collapse">
    <form class="" id="q_form" method="post" action="question"> 
      @csrf
      <textarea class="form-control" id="q_text" name="question" rows="2" 
                placeholder="<?php echo $questions[rand(0, sizeof($questions)-1)]?>"></textarea>
      <br/>
      <div id="q_err"></div>
      <button class="btn btn-primary" type="button" onclick="validate_q()"> Ask </button>
    </form>
  </div>

  <h3 class="container well text-center"><a href="#answers" data-toggle="collapse"> Answer a question <span class="glyphicon glyphicon-pencil"></span></a></h3>

  <div id="answers" class="collapse">
    <ul class="list-group container">
      <?php
        $questions = DB::table('question')->orderBy('id', 'DESC')->get();
        foreach($questions as $question) {
          echo "<a style=\"container-fluid\" class=\"list-group-item\" href=\"question/$question->id\">$question->text";           
          $answer_count = DB::table('answer')->where('qid', $question->id)->count();
          echo "<span class=\"badge black\"> $answer_count answers </span>";
          echo "</a>";
          echo "<br/>";
        }
      ?>
    </ul>
  </div>
</body>
</html>