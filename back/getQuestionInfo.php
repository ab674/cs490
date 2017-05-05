<?php

$result = file_get_contents("php://input");

$conn = mysqli_connect("sql2.njit.edu", "bm297", "WY2X2ekF", "bm297");
$tbl = "Question_bank";
$query = "select * from $tbl where Question='$result'";
$rows = mysqli_query($conn, $query);

$result = array();
while($row = mysqli_fetch_assoc($rows)){
	$result["QFname"] = $row['Fname'];
  $result["QType"] = $row['Type'];
  $result["QTest"] = $row['Test'];
  $result["QResult"] = $row['Result'];
	$result["QPoints"] = $row['Points'];
}

echo json_encode($result);

exit;

?>
