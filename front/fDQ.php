<?php

$connection = curl_init();
curl_setopt($connection, CURLOPT_URL, "http://afsaccess3.njit.edu/~ab674/cs490/mDQ.php");
curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($connection);
curl_close($connection);
$result = json_decode($result, true);

$count = $result["totalcount"];

for ($i=0; $i<$count; $i++) {
  echo "<input type='checkbox' name='check_list[]' id='check_list' value='";
  echo $result["question$i"];
  echo "'> ";
  echo $result["question$i"];
  echo "<br><br>";
}

?>
