<?php

$capture = json_decode(file_get_contents("php://input"), true);

$question = $capture["question"];
$answer = $capture["answer"];
$score = $capture["score"];
$feedback = $capture["feedback"];
$potential = $capture["potential"];

$conn = mysqli_connect("sql2.njit.edu", "bm297", "WY2X2ekF", "bm297");
$tbl = "Answer_bank";
$query = "insert into $tbl (Question, Answer, Score, Feedback, Potential) values ('$question', '$answer', '$score', '$feedback', '$potential')";
mysqli_query($conn, $query);

exit;

?>
