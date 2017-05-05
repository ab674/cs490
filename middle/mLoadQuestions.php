<?php

$capture = file_get_contents("php://input");

$connection = curl_init();
curl_setopt($connection, CURLOPT_URL, "http://afsaccess3.njit.edu/~bm297/CS490-Exam-System/bLoadQuestions.php");
curl_setopt($connection, CURLOPT_POSTFIELDS, $capture );
curl_setopt($connection, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($connection);
curl_close($connection);

echo $result;

?>
