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
curl_setopt($connection, CURLOPT_URL, "http://afsaccess3.njit.edu/~ab674/cs490/mLoadQuestions.php");
curl_setopt($connection, CURLOPT_POSTFIELDS, $capture );
curl_setopt($connection, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($connection);
curl_close($connection);
$result = json_decode($result, true);

$count = $result["totalcount"];

echo "<form action='SubmitQuestions.php' method='post'>";
echo "<div id='aa' style='width:95%;margin:0 auto;margin-top:10px;padding:20px 10px 0px 10px;text-align:left;'>";
if ($count == 0) {
  echo "<p style='text-align:center;padding:-10px 0px 0px 0px;'>Please select a filter.</p>";
}
for ($i=0; $i<$count; $i++) {
  echo "<input type='checkbox' name='check_list[]' id='check_list' value='";
  echo $result["question$i"];
  echo "'> ";
  echo $result["question$i"];
  echo "<br><br>";
  $flag = true;
}
echo "</div>";
echo "<br>";
if ($flag == true) {
  echo "<div>";
  echo "<div id='aa' style='width:100%;margin:0 auto;text-align:center;'>";
  echo "<button id='saveForm' name='saveForm' type='submit' value='Submit' style='margin-bottom:20px;'>Submit</button>";
  echo "</div>";
  echo "</div>";
}
echo "</form>";

?>
