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
  exit;
}

$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

//$sql = "INSERT INTO `users`(`name`, `email`, `password`) VALUES ('$name', '$email', '$password');";

$stmt = $conn->prepare("INSERT INTO `users` (`name`, `email`, `password`) VALUES (?, ?, ?)");
$stmt->bind_param('sss', $name, $email, $hashedPassword);



if ($stmt->execute()) {
     echo "New user record created successfully";
     $userid = $stmt->insert_id;

     //$sql2 = "INSERT INTO `profiles`(`userid`, `name`, `dob`, `gender`, `interestedin`, `occupation`, `location`) VALUES ('$userid', '$name', '$dob', '$gender', '$interestedin', '$occupation', '$location');";

     //Insert user's profile data
     $stmt2 = $conn->prepare("INSERT INTO `profiles`(`userid`, `name`, `dob`, `gender`, `interestedin`, `occupation`, `location`) VALUES (?, ?, ?, ?, ?, ?, ?)");
     $stmt2->bind_param('sssssss', $userid, $name, $dob, $gender, $interestedin, $occupation, $location);

     if ($stmt2->execute()) {
        echo "New profile record created successfully";
        session_start();
        $_SESSION['userid'] = $userid;
        $stmt->close();
        $stmt2->close();
        $conn->close();
        header("Location: myprofile.php");
        exit;
   } else {
        echo "Error: " . $stmt2->error;
   }
   } 

 else {
     echo "Error: " . $stmt->error;
}

$stmt->close();
$stmt2->close();
$conn->close();
?>