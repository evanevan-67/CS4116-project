<?php
include 'db_connect.php';

$profileid = $_GET['profileid'];

// Delete user and profile
$sql = "DELETE FROM `users` WHERE userid = '{$profileid}'";
$sql2 = "DELETE FROM `profiles` WHERE userid = '{$profileid}'";
mysqli_query($conn, $sql); // Execute the query using mysqli
mysqli_query($conn, $sql2); // Execute the query using mysqli


echo "Account deleted";
// header("Location: admindashboard.php");
header('Refresh: 10; URL=admindashboard.php');
exit(); // Ensure that no further code is executed after redirection
?>