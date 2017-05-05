<?php

$connection = curl_init();
curl_setopt($connection, CURLOPT_URL, "http://afsaccess3.njit.edu/~bm297/CS490-Exam-System/bReleaseGrade.php");
$result = curl_exec($connection);
curl_close($connection);

echo $result;

?>
