<?php

$capture = array();

if (isset($_POST['check_list'])) {
  $selection = $_POST['check_list'];

  foreach ($selection as $question) {
    $capture[] = $question;
  }
}

$capture = json_encode($capture);

$connection = curl_init();
curl_setopt($connection, CURLOPT_URL, "http://afsaccess3.njit.edu/~ab674/cs490/mDeleteQuestions.php");
curl_setopt($connection, CURLOPT_POSTFIELDS, $capture );
curl_setopt($connection, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
$verification = curl_exec($connection);
curl_close($connection);

if ($verification = true) {
	header("location: ResetTables.php");
}

?>
