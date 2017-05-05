<?php

$capture = array();

$count = 0;

foreach ($_POST as $key => $value) {
  $capture["$key"] = $value;
  $count++;
}

$count--;
$count = $count/2;
$capture["count"] = $count;

$capture = json_encode($capture);

$connection = curl_init();
curl_setopt($connection, CURLOPT_URL, "http://afsaccess3.njit.edu/~ab674/cs490/gradeExam.php");
curl_setopt($connection, CURLOPT_POSTFIELDS, $capture);
curl_setopt($connection, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
$verification = curl_exec($connection);
curl_close($connection);

header("location: WelcomeStd.html");

?>
