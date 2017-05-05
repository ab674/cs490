<?php

$connection = curl_init();
curl_setopt($connection, CURLOPT_URL, "http://afsaccess3.njit.edu/~ab674/cs490/mBlankExam.php");
curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($connection);
curl_close($connection);
$result = json_decode($result, true);

$count = $result["totalcount"];
$flag = true;

if ($count == 0) {
  echo "<tr style='text-align:center;'>";
  echo "No exam available.";
  echo "</tr>";
  $flag = false;
}

$newcount = 0;

for ($i=0; $i<$count; $i++) {
  echo "<tr style='text-align:center;'>";
  echo "<label id='question$newcount' for='question$newcount' style='text-align:center;'>";
  echo $result["question$i"];
  echo " (";
  echo $result["points$i"];
  echo " points)</label>";
  echo "</tr><tr>";
  echo "<input type='hidden' id='actualquestion$newcount' name='actualquestion$newcount' value='";
  echo $result["question$i"];
  echo "'>";
  echo "</tr><br>";
  echo "<textarea id='question$newcount' name='question$newcount' form='testtime' wrap='hard' style='width:100%;height:200px;margin:0 auto;margin-top:5px;'></textarea>";
  echo "<br><br><br>";
  $newcount++;
}

// foreach ($result as $question) {
//   echo "<tr style='text-align:center;'>";
//   echo "<label id='question$count' for='question$count' style='text-align:center;'>$question</label>";
//   echo "</tr><tr>";
//   echo "<input type='hidden' id='actualquestion$count' name='actualquestion$count' value='$question'>";
//   echo "</tr><br>";
//   echo "<textarea id='question$count' name='question$count' form='testtime' wrap='hard' style='width:100%;height:200px;margin:0 auto;margin-top:5px;'></textarea>";
//   echo "<br><br><br>";
//   $count++;
// }

if ($flag == true) {
  echo "<div>";
  echo "<div>";
  echo "<button id='saveForm' name='saveForm' type='submit' value='Submit' style='margin-bottom:50px;'>Submit</button>";
  echo "</div>";
  echo "</div>";
}

?>
