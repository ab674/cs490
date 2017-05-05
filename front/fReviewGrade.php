<?php

$connection = curl_init();
curl_setopt($connection, CURLOPT_URL, "http://afsaccess3.njit.edu/~ab674/cs490/mCheckRelease.php");
curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($connection);
curl_close($connection);
$result = json_decode($result, true);

if ($result["value"] == "false") {
  echo "<p style='text-align:center;'>";
  echo "Exam review not available.";
  echo "</p>";
}
else {
  $connection = curl_init();
  curl_setopt($connection, CURLOPT_URL, "http://afsaccess3.njit.edu/~ab674/cs490/mGradedExam.php");
  curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
  $data = curl_exec($connection);
  curl_close($connection);
  $data = json_decode($data, true);

  $totalscore = 0;
  $totalpotential = 0;

  $count = $data["totalcount"];
  for ($i=0; $i<$count; $i++) {
    $totalscore += $data["score$i"];
    $totalpotential += $data["potential$i"];
  }

  echo "<p style='text-align:center;'>";
  echo "Total score: ";
  echo $totalscore;
  echo "/";
  echo $totalpotential;
  echo "<br>";
  $scorepercent = ($totalscore/$totalpotential)*100;
  if ($scorepercent == 100) {
    $scorepercent = number_format($scorepercent, 2, '.', ',' );
    echo $scorepercent;
    echo "%<br>";
    echo "<span style='color:green;'>Great job!</span>";
  }
  else if ($scorepercent > 90) {
    $scorepercent = number_format($scorepercent, 2, '.', ',' );
    echo $scorepercent;
    echo "%<br>";
    echo "<span style='color:green;'>Almost there!</span>";
  }
  else if ($scorepercent > 80) {
    $scorepercent = number_format($scorepercent, 2, '.', ',' );
    echo $scorepercent;
    echo "%<br>";
    echo "<span style='color:green;'>Solid effort!</span>";
  }
  else if ($scorepercent > 70) {
    $scorepercent = number_format($scorepercent, 2, '.', ',' );
    echo $scorepercent;
    echo "%<br>";
    echo "<span style='color:green;'>Study harder!</span>";
  }
  else if ($scorepercent < 70) {
    $scorepercent = number_format($scorepercent, 2, '.', ',' );
    echo $scorepercent;
    echo "%<br>";
    echo "<span style='color:red;'>Failure does not have to define you!</span>";
  }
  echo "<br><br>";

  $count = $data["totalcount"];

  for ($i=0; $i<$count; $i++) {
    echo "<div style='background:#ededed;padding:20px;'";
    echo "Question:<br>";
    echo $data["question$i"];
    echo "<br><br>";
    echo "Your answer:<br>";
    echo $data["answer$i"];
    echo "<br><br>";
    echo "Your score:<br>";
    echo $data["score$i"];
    echo "/";
    echo $data["potential$i"];
    echo "<br><br>";
    echo "Score breakdown:<br>";
    echo $data["feedback$i"];
    echo "</div>";
    echo "<br><br>";
  }

  echo "</p>";

}

?>
