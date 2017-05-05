<?php

$connection = curl_init();
curl_setopt($connection, CURLOPT_URL, "http://afsaccess3.njit.edu/~ab674/cs490/mGradedProfExam.php");
curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($connection);
curl_close($connection);
$data = json_decode($data, true);

$connection = curl_init();
curl_setopt($connection, CURLOPT_URL, "http://afsaccess3.njit.edu/~ab674/cs490/mBlankExam.php");
curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($connection);
curl_close($connection);
$result = json_decode($result, true);

$totalscore = 0;
$totalpotential = 0;

$count = $data["totalcount"];
for ($i=0; $i<$count; $i++) {
  $totalscore += $data["score$i"];
  $totalpotential += $data["potential$i"];
}

$flag = true;

if ($count == 0) {
  echo "<tr style='text-align:center;'>";
  echo "Exam not taken.";
  echo "</tr>";
  $flag = false;
}
else {
  echo "<p style='text-align:center;'>";
  echo "Total score: ";
  echo $totalscore;
  echo "/";
  echo $totalpotential;
  echo "<br>";
  $scorepercent = ($totalscore/$totalpotential)*100;
  $scorepercent = number_format($scorepercent, 2, '.', ',' );
  echo $scorepercent;
  echo "%<br><br>";
}

$count = $data["totalcount"];

$newcount = 0;

for ($i=0; $i<$count; $i++) {
  echo "<div style='background:#ededed;padding:20px;'";
  echo "Question:<br>";
  echo $data["question$i"];
  echo "<br><br>";
  echo "Student answer:<br>";
  echo $data["answer$i"];
  echo "<br><br>";
  echo "Student score:<br>";
  echo $data["score$i"];
  echo "/";
  echo $data["potential$i"];
  echo "<br><br>";
  echo "Score breakdown:<br>";
  echo $data["feedback$i"];
  echo "</div>";
  echo "<br>";
  echo "<input type='hidden' id='actualquestion$newcount' name='actualquestion$newcount' value='";
  echo $result["question$i"];
  echo "'>";
  echo "</tr>New score<br>";
  echo "<input size='2' id='question$newcount' name='question$newcount' form='testtime' wrap='hard' style='height:10px;margin:0 auto;margin-top:5px;'>";
  echo "<br><br><br>";
  $newcount++;
}

echo "</p>";

if ($flag == true) {
  echo "<div>";
  echo "<div>";
  echo "<button id='saveForm' name='saveForm' type='submit' value='Submit' style='margin-bottom:50px;'>Submit</button>";
  echo "</div>";
  echo "</div>";
}

?>
