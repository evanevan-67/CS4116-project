<?php

$servername = "sql113.infinityfree.com";
$database = "if0_36142329_intrysts";
$dbusername = "if0_36142329";
$dbpassword = "eamonnmatt";

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$dob = $_POST["dob"];
$gender = $_POST["gender"];
$interestedin = $_POST["interestedin"];
$occupation = $_POST["occupation"];
$location = $_POST["location"];

//Create Connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword, $database);
// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
$sql = "INSERT INTO `users`(`name`, `email`, `password`) VALUES ('$name', '$email', '$password');";
if (mysqli_query($conn, $sql)) {
     echo "New user record created successfully";
     $userid = mysqli_insert_id($conn);
     $sql2 = "INSERT INTO `profiles`(`userid`, `name`, `dob`, `gender`, `interestedin`, `occupation`, `location`) VALUES ('$userid', '$name', '$dob', '$gender', '$interestedin', '$occupation', '$location');";
     if (mysqli_query($conn, $sql2)) {
        echo "New profile record created successfully";
   } else {
        echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
   }
   } 

 else {
     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>