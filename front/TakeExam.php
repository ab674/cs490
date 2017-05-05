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
				<a href="WelcomeStd.html">Home</a>
			</li>
			<li>
				<a href="TakeExam.php">Take Exam</a>
			</li>
			<li>
				<a href="Review.php">Review Exam</a>
			</li>
			<li>
				<a class="active" href="index.html">Log Out</a>
			</li>
		</ul>
		<div class="handle">
			Menu
		</div>
	</nav>
	<h1 style="text-align:center;">Take Exam</h1>
	<form action="SubmitExam.php" id="testtime" method="post" name="testtime">
		<div id="aa" style="width:75%;margin:0 auto;text-align:center;">
		<table id="aa" style="text-align:center;">
			<?php include("fBlankExam.php"); ?>
		</table>
	</div>
	</form>
</body>
</html>
