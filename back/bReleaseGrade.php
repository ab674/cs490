<?php

$conn = mysqli_connect("sql2.njit.edu", "bm297", "WY2X2ekF", "bm297");
$tbl = "releaseExam";
$query = "update $tbl set flag=1 where flag=0";
$rows = mysqli_query($conn, $query);

$result = true;

echo $result;

?>
