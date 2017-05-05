<?php

$connection = curl_init();
curl_setopt($connection, CURLOPT_URL, "http://afsaccess3.njit.edu/~ab674/cs490/mBlankExam.php");
curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($connection);
curl_close($connection);
$result = json_decode($result, true);

$count = $result["totalcount"];

echo "<p style='text-align:left;'>";

$newcount = 0;

for ($i=0; $i<$count; $i++) {
  echo "<label id='question$newcount' for='question$newcount' style='text-align:center;'>";
  echo $result["question$i"];
  echo "</label>";
  echo "<input type='hidden' id='actualquestion$newcount' name='actualquestion$newcount' value='";
  echo $result["question$i"];
  echo "'>";
  echo " ( ";
  echo "<input size='2' name='qpv$newcount' form='testtime' id='qpv$newcount' style='height:10px;' placeholder='";
  echo $result["points$i"];
  echo "'>";
  echo " points)";
  echo "<br><br>";
  $newcount++;
}

echo "</p>";

echo "<div>";
echo "<div>";
echo "<button id='saveForm' name='saveForm' type='submit' value='Submit' style='margin-bottom:50px;'>Submit</button>";
echo "</div>";
echo "</div>";

?>
