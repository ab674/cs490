<!DOCTYPE html>
<html>
<head>
	<link href="WelcomeInst.css" rel="stylesheet">
	<title>Welcome to NJIT</title>
</head>
<body>
	<nav>
		<ul>
			<li>
				<a href="WelcomeInst.html">Home</a>
			</li>
			<li>
				<a href="AddQuestion.php">Add Questions</a>
			</li>
			<li>
				<a href="ExamQuestion.php">Create Exam</a>
			</li>
			<li>
				<a href="ResetTables.php">Edit Exam</a>
			</li>
			<li>
				<a href="ReviewExam.php">Review Exam</a>
			</li>
			<li>
				<a href="GradeRelease.html">Release Grade</a>
			</li>
			<li>
				<a class="active" href="index.html">Log Out</a>
			</li>
		</ul>
		<div class="handle">
			Menu
		</div>
	</nav>
	<h1 style="text-align:center;">Edit Exam</h1>
	<p>Select questions to delete.</p>
	<form action="DeleteQuestions.php" method="post">

  <div id="aa" style="background:#ededed;width:75%;margin:0 auto;padding:20px 20px 0px 20px;margin-bottom:20px;text-align:left;">
    <?php include("fDQ.php"); ?>
  </div>

    <div>
      <div>
          <button type="submit" value="Submit">Submit</button>
        </div>
    </div>

  </form>
	<p>Delete all questions.</p>
	<form action="fReset.php" method="post">
		<br>
		<button type="submit" value="grade">Reset</button>
	</form>
</body>
</html>
