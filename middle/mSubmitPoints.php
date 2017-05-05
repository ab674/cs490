<?php

$result = json_decode(file_get_contents("php://input"), true);

$count = $result["count"];

for ($i=0; $i<$count; $i++) {
  $question = $result["actualquestion$i"];
  $points = $result["qpv$i"];

  $score = array(
    "question" => $question,
    "points" => $points
  );

  $score = json_encode($score);

  $connection = curl_init();
  curl_setopt($connection, CURLOPT_URL, "http://afsaccess3.njit.edu/~bm297/CS490-Exam-System/bSubmitPoints.php");
  curl_setopt($connection, CURLOPT_POSTFIELDS, $score);
  curl_setopt($connection, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  $designation = curl_exec($connection);
  curl_close($connection);
}

?>
