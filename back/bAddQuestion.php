<?php
$capture = json_decode(file_get_contents("php://input"), true);
$function_name = $capture["function_name"];
$type = $capture["type"];
$question = $capture["question"];
$difficulty = $capture["difficulty"];
$test_case = $capture["test_case"];
$test_result = $capture["test_result"];
$point_value = $capture["point_value"];
//
//		THIS PART ONLY FOR BACKEND. DO NOT TOUCH.
//
// Create connection
$conn = mysqli_connect("sql2.njit.edu", "bm297", "WY2X2ekF", "bm297");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Select table
$tbl = "Question_bank";
// Query
$query = "INSERT INTO $tbl (Fname, Type, Question, Difficulty, Test, Result, Points) VALUES ('{$function_name}', '{$type}', '{$question}', '{$difficulty}', '{$test_case}', '{$test_result}', '{$point_value}')";
// Execute the query
mysqli_query($conn, $query);
echo "Question has been saved";
