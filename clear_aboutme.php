<?php
include 'db_connect.php';

$profileid = $_GET['profileid'];


// Update aboutme column to be blank
$sql = "UPDATE profiles SET aboutme = '' WHERE userid = '{$profileid}'";

mysqli_query($conn, $sql); // Execute the query using mysqli

header("Location: adminprofileedit.php?profileid=$profileid");
exit(); // Ensure that no further code is executed after redirection
?>