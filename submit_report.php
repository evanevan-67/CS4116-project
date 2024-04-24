<?php
// Start or resume the session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have already connected to your database
    // Include your database connection code here
    
    // Get the userid from the session
    $userid = $_SESSION['userid'];
    

    // Get the reportedid and message from the form
    $reportedid = $_POST["reportedid"];
    $message = $_POST["message"];


    include 'db_connect.php';
    // Validate the inputs (e.g., check if userid, reportedid, and message are not empty)

    // Insert the report into the database
    $query = "INSERT INTO reports (userid, reportedid, message) VALUES ('$userid', '$reportedid', '$message')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Report submitted successfully.";
        header('Refresh: 10; URL=myprofile.php');
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Redirect users back to the form if they try to access this page directly without submitting the form
    header("Location: report_form.php");
    exit();
}
?>
