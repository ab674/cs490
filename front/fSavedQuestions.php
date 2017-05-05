<?php

$flag = false;
$selection = $_POST["pick"];

if ($selection == "all") {
  $capture = array(
    "classification" => "all",
    "value" => $selection
  );
}
else if ($selection == "Easy" || $selection == "Medium" || $selection == "Hard") {
  $capture = array(
    "classification" => "Difficulty",
    "value" => $selection
  );
}
else {
  $capture = array(
    "classification" => "Type",
    "value" => $selection
  );
}

$capture = json_encode($capture);

$connection = curl_init();
curl_setopt($connection, CURLOPT_URL, "http://afsaccess3.njit.edu/~ab674/cs490/mSavedQuestions.php");
curl_setopt($connection, CURLOPT_POSTFIELDS, $capture );
curl_setopt($connection, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($connection);
curl_close($connection);
$result = json_decode($result, true);

$count = $result["totalcount"];

if ($count == 0) {
  echo "<p style='text-align:center;padding:30px 0px 0px 0px;'>Please select a filter.</p>";
}

echo "<p style='text-align:left;'>";

for ($i=0; $i<$count; $i++) {
  echo $result["question$i"];
  echo " (Difficulty: ";
  echo $result["difficulty$i"];
  echo ") ";
  echo " (";
  echo $result["points$i"];
  echo " points)";
  echo "<br><br>";
}

echo "<br>";
echo "</p>";

?>
