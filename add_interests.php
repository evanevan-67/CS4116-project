<?php
// Include database connection file
include 'db_connect.php';

// Start session
// session_start();
// Check if user is logged in
if (!isset($_SESSION['userid'])) {
    echo "You must be logged in to add interests.";
    exit;
}
echo 2;
// Check if form is submitted
    // Get user ID from session
    $userid = $_SESSION['userid'];
    echo $_POST['interests'];
    // Check if any interests were selected
    if (isset($_POST['interests']) && is_array($_POST['interests'])) {
        // Sanitize and validate interests array
        $interests = array_map('intval', $_POST['interests']);
        echo $interests;
        /*$interests = array_filter($interests, function ($interest) {
            // Check if interest ID is valid (e.g., exists in the database)
            // You may implement additional validation here if needed
            return $interest > 0;
        });*/

        // Insert interests into database
        foreach ($interests as $interestid) {
            $sql = "INSERT INTO userinterests (userid, interestid) VALUES ($userid, $interestid)";
            if (mysqli_query($conn, $sql)) {
                echo "Interests added successfully.";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Please select at least one interest.";
    }

header("Location: myprofile.php");

?>