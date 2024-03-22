<?php

// Include the database connection file
include 'db_connect.php';


$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$dob = $_POST["dob"];
$gender = $_POST["gender"];
$interestedin = $_POST["interestedin"];
$occupation = $_POST["occupation"];
$location = $_POST["location"];

//Verify email format
$email = $_POST["email"];
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $emailErr = "Invalid email format";
}

$sql = "INSERT INTO `users`(`name`, `email`, `password`) VALUES ('$name', '$email', '$password');";
if (mysqli_query($conn, $sql)) {
     echo "New user record created successfully";
     $userid = mysqli_insert_id($conn);
     $sql2 = "INSERT INTO `profiles`(`userid`, `name`, `dob`, `gender`, `interestedin`, `occupation`, `location`) VALUES ('$userid', '$name', '$dob', '$gender', '$interestedin', '$occupation', '$location');";
     if (mysqli_query($conn, $sql2)) {
        echo "New profile record created successfully";
        session_start();
        $_SESSION['userid'] = $userid;
   } else {
        echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
   }
   } 

 else {
     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>