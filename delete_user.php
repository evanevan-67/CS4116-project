<?php
include 'db_connect.php';

$profileid = $_GET['profileid'];

// Delete user and profile
$sql = "DELETE FROM `users` WHERE userid = '{$profileid}'; DELETE FROM `profiles` WHERE userid = '{$profileid}';"
mysqli_query($conn, $sql); // Execute the query using mysqli

// header("Location: admindashboard.php");
header('Refresh: 10; URL=admindashboard.php');
exit(); // Ensure that no further code is executed after redirection
?>