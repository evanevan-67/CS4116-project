<?php
// Include database connection file
include 'db_connect.php';

// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['userid'])) {
    echo "You must be logged in to add interests.";
    exit;
}

// Get user ID from session
$userid = $_SESSION['userid'];

// Check if form is submitted
if (isset($_POST['interests']) && is_array($_POST['interests'])) {
    // Sanitize and validate interests array
    $interests = array_map('intval', $_POST['interests']);
    
    // Insert interests into database
    foreach ($interests as $interestid) {
        // Check if the entry already exists
        $sql_check = "SELECT * FROM userinterests WHERE userid = $userid AND interestid = $interestid";
        $result_check = mysqli_query($conn, $sql_check);
        if (mysqli_num_rows($result_check) == 0) {
            // Entry does not exist, insert into database
            $sql_insert = "INSERT INTO userinterests (userid, interestid) VALUES ($userid, $interestid)";
            if (mysqli_query($conn, $sql_insert)) {
                echo "Interests added successfully.";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            // Entry already exists
            echo "Entry already exists for userid $userid and interestid $interestid.";
        }
    }
} else {
    echo "Please select at least one interest.";
}

header("Location: myprofile.php");

?>