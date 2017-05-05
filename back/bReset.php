<?php

$conn = mysqli_connect("sql2.njit.edu", "bm297", "WY2X2ekF", "bm297");
$tbl = "Answer_bank";
$query = "truncate table $tbl";
mysqli_query($conn, $query);

$tbl = "Exam_questions";
$query = "truncate table $tbl";
mysqli_query($conn, $query);

$result = true;

exit;

echo $result;

?>
