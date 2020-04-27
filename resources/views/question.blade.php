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
  define("PLACEHOLDER_ANS", "No answers yet. Be the first one to answer by using the form below.");
?>

<script>
  const A_MIN_LENGTH = 5;
  const A_MAX_LENGTH = 100;
  function validate_a() {
    var str = document.getElementById("a_text").value.trim();
    if(str.length < A_MIN_LENGTH || str.length > A_MAX_LENGTH) {
      var errmsg;
      if(str.length < A_MIN_LENGTH) errmsg = "Answers must be at least "+A_MIN_LENGTH+" characters long.";
      else                          errmsg = "Answers must be at most "+A_MAX_LENGTH+" characters long.";

      document.getElementById("a_err").innerHTML = errmsg;
      document.getElementById("a_err").classList.add("alert", "alert-danger");
      document.getElementById("a_form").classList.add("has-warning");
    } else {
      document.getElementById("a_form").submit();
    }
  }
  </script>
</head>

<body>
  <?php
    require_once(public_path('/php/header.blade.php'));
  ?>

  <h3 class="container well"> <span class="glyphicon glyphicon-question-sign"></span> : {{ $question->text }} </h3>
  <?php
    if($answers->isEmpty()) {
      $answers[] = PLACEHOLDER_ANS;
    }
    echo "<ul class=\"list-group container\">";
    
    foreach($answers as $answer) {
      echo "<div class=\"list-group-item\"> $answer </div>";
      echo "<br/>";
    }
    echo "</ul>";
  ?>

  <h3 class="container well"><a href="#answer" data-toggle="collapse"> Submit an answer <span class="glyphicon glyphicon-pencil"></a></h3>
  <div id="answer" class="container text-center form-group collapse">
    <form class="" id="a_form" method="post" action="/question/<?php echo $question->id; ?>/answer">
      @csrf
      <textarea class="form-control" id="a_text" name="answer" rows="2" placeholder="The answer is 42."></textarea>
      <br/>
      <div id="a_err"></div>
      <button class="btn btn-primary" type="button" onclick="validate_a()"> Answer </button>
    </form>
  </div>

</body>
</html>