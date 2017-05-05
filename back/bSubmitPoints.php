<?php

$capture = json_decode(file_get_contents("php://input"), true);

$question = $capture["question"];
$points = $capture["points"];

if ($points != "") {

  $conn = mysqli_connect("sql2.njit.edu", "bm297", "WY2X2ekF", "bm297");
  $tbl = "Question_bank";
  $query = "update $tbl set Points='$points' where Question='$question'";
  mysqli_query($conn, $query);

  $conn = mysqli_connect("sql2.njit.edu", "bm297", "WY2X2ekF", "bm297");
  $tbl = "Exam_questions";
  $query = "update $tbl set Points='$points' where Question='$question'";
  mysqli_query($conn, $query);

  exit;

}

?>
