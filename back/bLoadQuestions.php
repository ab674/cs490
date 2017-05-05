<?php

$result = json_decode(file_get_contents("php://input"), true);

$classification = $result["classification"];
$value = $result["value"];

$conn = mysqli_connect("sql2.njit.edu", "bm297", "WY2X2ekF", "bm297");
$tbl = "Question_bank";
if ($classification == "all") {
	$query = "select * from $tbl";
}
else {
	$query = "select * from $tbl where $classification='$value'";
}
$rows = mysqli_query($conn, $query);

$rowcount = mysqli_num_rows($rows);

$count = 0;

$result = array();
$result["totalcount"] = $rowcount;
while($row = mysqli_fetch_assoc($rows)){
	$result["question$count"] = $row['Question'];
  $result["points$count"] = $row['Points'];
	$result["type$count"] = $row['Type'];
	$result["difficulty$count"] = $row['Difficulty'];
  $count++;
}

echo json_encode($result);

exit;

?>
