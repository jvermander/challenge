<!doctype html>
<html>
<head>
<?php 
  define("PLACEHOLDER_ANS", "No answers yet. Be the first one to answer by using the form below.");
?>

<script>
  const A_MIN_LENGTH = 5;
  const A_MAX_LENGTH = 50;
  function validate_a() {
    var str = document.getElementById("a_text").value.trim();
    if(str.length < A_MIN_LENGTH) {
      document.getElementById("a_err").innerHTML = "Answers must be at least "+A_MIN_LENGTH+" characters long."
    } else if(str.length > A_MAX_LENGTH) {
      document.getElementById("a_err").innerHTML = "Answers must be at most "+A_MAX_LENGTH+" characters long."
    } else {
      document.getElementById("a_form").submit();
    }
  }
  </script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>
<body>
  <div> {{ $question->text }} </div>
  <br/>
  <?php
    if($answers->isEmpty()) {
      $answers[] = PLACEHOLDER_ANS;
    }
    
    foreach($answers as $answer) {
      echo "<div> $answer </div>";
    }
  ?>
  <br/>
  <form id="a_form" method="post" action="/question/<?php echo $question->id; ?>/answer">
    @csrf
    <div> Answer the Question! </div>
    <textarea id="a_text" name="answer" rows="2" cols="50"></textarea>
    <div style="color: red;" id="a_err"></div>
    <button type="button" onclick="validate_a()"> Answer </button>
  </form>

</body>
</html>