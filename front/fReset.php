<?php

$connection = curl_init();
curl_setopt($connection, CURLOPT_URL, "http://afsaccess3.njit.edu/~ab674/cs490/mReset.php");
$result = curl_exec($connection);
curl_close($connection);

if ($result = true) {
  header("location: ResetTables.php");
}

?>
