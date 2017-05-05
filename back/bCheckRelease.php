<?php

$conn = mysqli_connect("sql2.njit.edu", "bm297", "WY2X2ekF", "bm297");
$tbl = "releaseExam";
$query1 = "select * from $tbl where flag=1 limit 1";
$rows = mysqli_query($conn, $query1);

$rowcount = mysqli_num_rows($rows);

$flag = array();

if ($rowcount > 0) {
  $flag["value"] = "true";
  $query2 = "update $tbl set flag=0 where flag=1";
  mysqli_query($conn, $query2);
}
else {
  $flag["value"] = "false";
}

echo json_encode($flag);

exit;

?>
