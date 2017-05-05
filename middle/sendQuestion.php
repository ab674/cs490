<?php

$capture = json_decode(file_get_contents("php://input"), true);

$newcapture = $capture;
$newcapture = json_encode($newcapture);

$verification = false;

$connection = curl_init();
curl_setopt($connection, CURLOPT_URL, "http://afsaccess3.njit.edu/~bm297/CS490-Exam-System/bAddQuestion.php");
curl_setopt($connection, CURLOPT_POST, 1);
curl_setopt($connection, CURLOPT_POSTFIELDS, $newcapture);
curl_setopt($connection, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
$result = curl_exec($connection);
curl_close($connection);

if ($result == "Question has been saved") {
  $verification = true;
  echo $verification;
}

?>
