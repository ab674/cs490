<?php

$string = json_decode(file_get_contents("php://input"), true);
$ucid = $string["ucid"];
$password = md5($string["password"]);

$conn = mysqli_connect("sql2.njit.edu", "bm297", "WY2X2ekF", "bm297");

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$tbl = "CS490";

$query = "select * from $tbl where Username='{$ucid}' and Password='{$password}' limit 1";
$row = mysqli_query($conn, $query);
$elms = mysqli_fetch_array($row);

if ($elms[2] == "Professor") {
	echo "professor";
}
else if ($elms[2] == "Student") {
	echo "student";
}
else {
	echo "fail";
}

exit;

?>
