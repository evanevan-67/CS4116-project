<?php
include 'db_connect.php';

$profileid = $_GET['profileid'];
$number = $_GET['number'];

// Update photo? column to be blank
$sql = "UPDATE profiles SET photo" . $number . " = '' WHERE userid = '{$profileid}'";

mysqli_query($conn, $sql); // Execute the query using mysqli

header("Location: adminprofileedit.php?profileid=$profileid");
exit(); // Ensure that no further code is executed after redirection
?>