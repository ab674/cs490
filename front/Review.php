<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="WelcomeInst.css">
  <title>Welcome to NJIT</title>
</head>
<body>
  <nav>
    <ul>
      <li><a href="WelcomeStd.html">Home</a></li>
      <li><a href="TakeExam.php">Take Exam</a></li>
      <li><a href="Review.php">Review Exam</a></li>
      <li><a class="active" href="index.html">Log Out</a></li>
    </ul>
    <div class="handle">Menu</div>
  </nav>

  <h1 style="text-align:center;">Review Exam</h1>

  <div id="aa">

    <?php include("fReviewGrade.php"); ?>

  </div>

</body>
</html>
