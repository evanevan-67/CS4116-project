<?php
// Include database connection file
include 'db_connect.php';

// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['userid'])) {
    echo "You must be logged in to remove interests.";
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
        
        $sql = "DELETE FROM userinterests WHERE userid = $userid AND interestid = $interestid";
        $result = mysqli_query($conn, $sql);

        if (mysqli_query($conn, $sql)) {
                echo "Interest removed successfully.";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    } else {
    echo "Please select at least one interest.";
}

header("Location: myprofile.php");

?>