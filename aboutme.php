<?php
session_start();

// Include the database connection file
include 'db_connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize the description
    $aboutme = htmlspecialchars($_POST["aboutme"]);

    $aboutme = mysqli_real_escape_string($conn, $aboutme);

    // Prepare SQL statement to update the aboutme column in the profiles table
    $sql = "UPDATE profiles SET aboutme = '$aboutme' WHERE userid = '{$_SESSION['userid']}'";
    
    // Execute the SQL statement
    if (mysqli_query($conn, $sql)) {
        echo "About me updated successfully!";
    } else {
        echo "Error updating about me: " . mysqli_error($conn);
    }
    
    // Close the database connection
    mysqli_close($conn);
}

header("Location: myprofile.php");

?>
