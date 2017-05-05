<?php

$connection = curl_init();
curl_setopt($connection, CURLOPT_URL, "http://afsaccess3.njit.edu/~ab674/cs490/mReleaseGrade.php");
$result = curl_exec($connection);
curl_close($connection);

if ($result = true) {
  header("location: GradeRelease.html");
}

?>
