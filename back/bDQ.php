<?php

$conn = mysqli_connect("sql2.njit.edu", "bm297", "WY2X2ekF", "bm297");
$tbl = "Exam_questions";
$query = "select * from $tbl";
$rows = mysqli_query($conn, $query);

$rowcount = mysqli_num_rows($rows);

$count = 0;

$result = array();
$result["totalcount"] = $rowcount;
while($row = mysqli_fetch_assoc($rows)){
	$result["question$count"] = $row['Question'];
  $count++;
}

echo json_encode($result);

exit;

?>
