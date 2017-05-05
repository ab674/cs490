<?php

$conn = mysqli_connect("sql2.njit.edu", "bm297", "WY2X2ekF", "bm297");
$tbl = "Answer_bank";
$query = "select * from $tbl";
$rows = mysqli_query($conn, $query);

$rowcount = mysqli_num_rows($rows);

$count = 0;

$result = array();
$result["totalcount"] = $rowcount;
while($row = mysqli_fetch_assoc($rows)){
	$result["question$count"] = $row['Question'];
  $result["answer$count"] = $row['Answer'];
  $result["score$count"] = $row['Score'];
  $result["feedback$count"] = $row['Feedback'];
	$result["potential$count"] = $row['Potential'];
  $count++;
}

echo json_encode($result);

$query = "truncate table $tbl";
mysqli_query($conn, $query);

exit;

?>
