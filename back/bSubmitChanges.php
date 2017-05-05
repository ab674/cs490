<?php

$result = json_decode(file_get_contents("php://input"), true);

$count = $result["count"];

for ($i=0; $i<$count; $i++) {
  $question = $result["actualquestion$i"];
  $answer = $result["question$i"];

  if ($answer != "") {
    $conn = mysqli_connect("sql2.njit.edu", "bm297", "WY2X2ekF", "bm297");
    $tbl = "Answer_bank";
    $query = "select * from $tbl where Question='$question'";
    $rows = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($rows)){
      $feedback = $row['Feedback'];
    }

    $feedback .= "<br>Note:<br><b>Professor modified score</b><br>";

    $conn = mysqli_connect("sql2.njit.edu", "bm297", "WY2X2ekF", "bm297");
    $tbl = "Answer_bank";
    $query = "update $tbl set Score='$answer' where Question='$question'";
    mysqli_query($conn, $query);

    $conn = mysqli_connect("sql2.njit.edu", "bm297", "WY2X2ekF", "bm297");
    $tbl = "Answer_bank";
    $query = "update $tbl set Feedback='$feedback' where Question='$question'";
    mysqli_query($conn, $query);
  }

}

?>
