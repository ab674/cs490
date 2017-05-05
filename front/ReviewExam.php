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
  <h1 style="text-align:center;">Review Exam</h1>
	<form action="SubmitChanges.php" id="testtime" method="post" name="testtime">
		<div id="aa" style="width:75%;margin:0 auto;text-align:center;">
		<table id="aa" style="text-align:center;">
			<?php include("fLoadGrade.php"); ?>
		</table>
	</div>
	</form>
</body>
</html>
