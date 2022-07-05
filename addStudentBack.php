<?php
include "dbConnection.php";
if (isset($_POST['submit'])) {



  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $gender = $_POST['gender'];
  $hobbies = $_POST['hobbies'];
  $hoobbieArray = implode(",", $hobbies);
  $birth_date = $_POST['birth_date'];
  $subject1 = $_POST['subject1'];
  $subject2 = $_POST['subject2'];
  $subject3 = $_POST['subject3'];
  $subject4 = $_POST['subject4'];
  $subject5 = $_POST['subject5'];
  $insertRecord = "INSERT INTO `students`
    (
            `first_name`, 
            `last_name`, 
            `gender`,
            `hobbies`, 
            `birth_date`, 
            `subject1`, 
            `subject2`,
            `subject3`, 
            `subject4`,
            `subject5`
        ) 
        VALUES 
        (
            '$first_name',
            '$last_name',
            '$gender',
            '$hoobbieArray',
            '$birth_date',
            '$subject1',
            '$subject2',
            '$subject3',
            '$subject4',
            '$subject5'
        )";



  $dataEnterInDb = mysqli_query($connection, $insertRecord);
  if ($dataEnterInDb == 1) {
    echo json_encode(array('success' => 1));
  } else {
    echo json_encode(array('success' => 0));
  }

  mysqli_fetch_array($dataEnterInDb);
}
