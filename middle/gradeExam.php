<?php

$result = json_decode(file_get_contents("php://input"), true);

$count = $result["count"];

for ($i=0; $i<$count; $i++) {
  $question = $result["actualquestion$i"];
  $answer = $result["question$i"];

  $connection = curl_init();
  curl_setopt($connection, CURLOPT_URL, "http://afsaccess3.njit.edu/~bm297/CS490-Exam-System/getQuestionInfo.php");
  curl_setopt($connection, CURLOPT_POSTFIELDS, $question);
  curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
  $questiondata = curl_exec($connection);
  curl_close($connection);
  $questiondata = json_decode($questiondata, true);
  $category = $questiondata["QType"];
  $name = $questiondata["QFname"];
  $testcase = $questiondata["QTest"];
  $testcaseresult = $questiondata["QResult"];
  $points = $questiondata["QPoints"];

  $factor = $points/5;
  $grade = 0;
  $feedback = "";
  $file = "temporary.java";

  $publicflag = false;
  $publicstatic = substr_count($answer, "public static");
  if ($publicstatic == 0) {
    $publicflag = true;
  }

  $namecheck = strpos($answer, $name);
  if ($namecheck === false) {
    $grade += 0;
    $feedback .= "<b>Incorrect name (+0)</b><br>";
  }
  else {
    $grade += (1*$factor);
    $temp = (1*$factor);
    $feedback .= "Correct name (+$temp)<br>";
  }

  if ($category == "none" && $answer != "") {
    $grade += (1*$factor);
    $temp = (1*$factor);
    $feedback .= "Correct implementation (+$temp)<br>";
  }
  else if ($category == "recursion") {
    $identifiercount = substr_count($answer, $name);
    if ($identifiercount > 1) {
      $grade += (1*$factor);
      $temp = (1*$factor);
      $feedback .= "Recursive implementation (+$temp)<br>";
    }
    else {
      $grade += 0;
      $feedback .= "<b>Not recursive implementation (+0)</b><br>";
    }
  }
  else if ($category == "forloop") {
    $identifiercount = substr_count($answer, "for");
    if ($identifiercount > 0) {
      $grade += (1*$factor);
      $temp = (1*$factor);
      $feedback .= "For loop implementation (+$temp)<br>";
    }
    else {
      $grade += 0;
      $feedback .= "<b>No for loop implementation (+0)</b><br>";
    }
  }
  else if ($category == "whileloop") {
    $identifiercount = substr_count($answer, "while");
    if ($identifiercount > 0) {
      $grade += (1*$factor);
      $temp = (1*$factor);
      $feedback .= "While loop implementation (+$temp)<br>";
    }
    else {
      $grade += 0;
      $feedback .= "<b>No while loop implementation (+0)</b><br>";
    }
  }
  else if ($category == "conditional") {
    $identifiercount = substr_count($answer, "if");
    $shorthandidentifiercount = substr_count($answer, "?");
    if ($identifiercount > 0 || $shorthandidentifiercount > 0) {
      $grade += (1*$factor);
      $temp = (1*$factor);
      $feedback .= "Conditional implementation (+$temp)<br>";
    }
    else {
      $grade += 0;
      $feedback .= "<b>No conditional implementation (+0)</b><br>";
    }
  }
  else if ($category == "indexing") {
    $identifiercount = substr_count($answer, "[");
    if ($identifiercount > 0) {
      $grade += (1*$factor);
      $temp = (1*$factor);
      $feedback .= "Index implementation (+$temp)<br>";
    }
    else {
      $grade += 0;
      $feedback .= "<b>No index implementation (+0)</b><br>";
    }
  }
  else {
    $grade += 0;
    $feedback .= "<b>Incorrect implementation (+0)</b><br>";
  }

  $returncheck = strpos($answer, "return");
  if ($returncheck === false) {
    $grade += 0;
    $feedback .= "<b>No result returned (+0)</b><br>";
  }
  else {
    $grade += (1*$factor);
    $temp = (1*$factor);
    $feedback .= "Result returned (+$temp)<br>";
  }

  $flag = true;
  $flag2 = false;
  $testcasecount = (substr_count($testcase, " || ") + 1);
  $testcasefactor = $factor/$testcasecount;
  $testcaseresults = explode(" || ", $testcaseresult);
  if ($testcasecount > 1) {
    $flag = false;
    $testcases = explode(" || ", $testcase);
    for ($j=0; $j<$testcasecount; $j++) {
      $k = $j + 1;
      $entry = $testcases[$j];

      file_put_contents($file, "class temporary {\n\n", FILE_APPEND);
      if ($publicflag) {
        file_put_contents($file, "public static ", FILE_APPEND);
      }
      file_put_contents($file, $answer, FILE_APPEND);
      file_put_contents($file, "\n\n", FILE_APPEND);
      file_put_contents($file, "public static void main(String[] args) {\n", FILE_APPEND);
      file_put_contents($file, "System.out.println($name($entry));\n", FILE_APPEND);
      file_put_contents($file, "}\n\n}\n", FILE_APPEND);

      exec("javac temporary.java");
      $newfile = "temporary.class";
      if (file_exists($newfile) == true && $j == 0) {
        $grade += (1*$factor);
        $temp = (1*$factor);
        $feedback .= "Code compiles (+$temp)<br>";
        $flag2 = true;
      }
      else if ($j == 0) {
        $grade -= (1*$factor);
        $temp = (1*$factor);
        $feedback .= "<b>Code does not compile (-$temp)</b><br>";
      }

      if ($flag2) {
        $expected = $testcaseresults[$j];
        $output = exec("java temporary");
        if ($output == $expected) {
          $grade += (1*$testcasefactor);
          $temp = (1*$testcasefactor);
          $feedback .= "Correct result for test case $k (+$temp)<br>";
        }
        else {
          $grade += 0;
          $feedback .= "<b>Incorrect result for test case $k (+0)</b><br>";
        }
      }

      file_put_contents($file, "");
      exec("rm temporary.class");
    }
  }

  if ($flag) {
    file_put_contents($file, "class temporary {\n\n", FILE_APPEND);
    if ($publicflag) {
      file_put_contents($file, "public static ", FILE_APPEND);
    }
    file_put_contents($file, $answer, FILE_APPEND);
    file_put_contents($file, "\n\n", FILE_APPEND);
    file_put_contents($file, "public static void main(String[] args) {\n", FILE_APPEND);
    file_put_contents($file, "System.out.println($name($testcase));\n", FILE_APPEND);
    file_put_contents($file, "}\n\n}\n", FILE_APPEND);

    exec("javac temporary.java");
    $newfile = "temporary.class";
    if (file_exists($newfile) == true) {
      $grade += (1*$factor);
      $temp = (1*$factor);
      $feedback .= "Code compiles (+$temp)<br>";
    }
    else {
      $grade -= (1*$factor);
      $temp = (1*$factor);
      $feedback .= "<b>Code does not compile (-$temp)</b><br>";
    }

    $output = exec("java temporary");
    if ($output == $testcaseresult) {
      $grade += (1*$factor);
      $temp = (1*$factor);
      $feedback .= "Correct result (+$temp)<br>";
    }
    else {
      $grade += 0;
      $feedback .= "<b>Incorrect result (+0)</b><br>";
    }

    file_put_contents($file, "");
    exec("rm temporary.class");
  }

  if ($grade < 0) {
    $grade = 0;
  }

  $score = array(
    "question" => $question,
    "answer" => $answer,
    "score" => $grade,
    "feedback" => $feedback,
    "potential" => $points
  );

  $score = json_encode($score);

  $connection = curl_init();
  curl_setopt($connection, CURLOPT_URL, "http://afsaccess3.njit.edu/~bm297/CS490-Exam-System/gradedQuestion.php");
  curl_setopt($connection, CURLOPT_POSTFIELDS, $score);
  curl_setopt($connection, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  $designation = curl_exec($connection);
  curl_close($connection);

}

echo true;

?>
