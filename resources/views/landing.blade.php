<!doctype html>
<html>
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<script>
  // client-side input validation
  const Q_MIN_LENGTH = 5;
  const Q_MAX_LENGTH = 50;
  function validate_q() {
    var str = document.getElementById("q_text").value.trim();
    if(str.length < Q_MIN_LENGTH) {
      document.getElementById("q_err").innerHTML = "The question must be at least "+Q_MIN_LENGTH+" characters.";      
    } else if(str.length > Q_MAX_LENGTH) {
      document.getElementById("q_err").innerHTML = "The question must be no longer than "+Q_MAX_LENGTH+" characters.";
    } else if(str.charAt(str.length-1) != "?") {
      document.getElementById("q_err").innerHTML = "The question must end with a question mark (?).";
    } else {
      document.getElementById("q_form").submit();
    }
  }
</script>
</head>
<body>
  
  <?php
  $questions = array("Studies show Vegans carry a lower risk of heart disease. Why?",
                     "What is the only essential vitamin that cannot be obtained on a plant-based diet?",
                     "What industry is responsible for the majority of greenhouse gas emissions?",
                     "Is it feasible to raise children on a Vegan diet?",
                     "Where do Vegans obtain Omega-3?");
  ?>
  
  <form id="q_form" method="post" action="question">
    @csrf
    <div> Ask a question </div>
    <textarea id="q_text" name="question" rows="2" cols="50" 
              placeholder="<?php echo $questions[rand(0, sizeof($questions)-1)]?>"></textarea>
    <div style="color: red;" id="q_err"></div>
    <button type="button" onclick="validate_q()"> Ask </button>
  </form>
  <!-- <div> Answer a question </div> -->
</body>
</html>