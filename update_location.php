<?php

// Include the database connection file
include 'db_connect.php';

$location = $_POST["location"];

$userid = $_SESSION['userid'];

// Prepare and execute the SQL statement
$query = "UPDATE profiles SET location = ? WHERE userid = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'si', $location, $userid);
mysqli_stmt_execute($stmt);

// Check if the update was successful
if (mysqli_stmt_affected_rows($stmt) > 0) {
    echo "Location updated successfully.";
} else {
    echo "Failed to update occupation.";
}

// Close the statement and database connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
header("Location: myprofile.php");

?>