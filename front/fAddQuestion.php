<?php

$question = $_POST["question"];
$function_name = $_POST["function_name"];
$type = $_POST["type"];
$difficulty = $_POST["difficulty"];
$test_case = $_POST["test_case"];
$test_result = $_POST["test_result"];
$point_value = $_POST["point_value"];
$capture = array(
	"function_name" => $function_name,
	"type" => $type,
	"question" => $question,
	"difficulty" => $difficulty,
	"test_case" => $test_case,
	"test_result" => $test_result,
	"point_value" => $point_value
);

$capture = json_encode($capture);

$connection = curl_init();
curl_setopt($connection, CURLOPT_URL, "http://afsaccess3.njit.edu/~ab674/cs490/sendQuestion.php");
curl_setopt($connection, CURLOPT_POSTFIELDS, $capture );
curl_setopt($connection, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
$verification = curl_exec($connection);
curl_close($connection);

if ($verification = true) {
	header("location: AddQuestion.php");
}

?>
