<?php
//This file handles connecting to the database and should be included at the top of every php script that needs to connect to our database

session_start();

$servername = "sql113.infinityfree.com";
$database = "if0_36142329_intrysts";
$dbusername = "if0_36142329";
$dbpassword = "eamonnmatt";

// Create Connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword, $database);
// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
?>