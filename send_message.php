<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve POST data
    $userid = $_POST["userid"];
    $chatid = $_POST["chatid"];
    $message = $_POST["message"];


    
    include 'db_connect.php';
    
    // Validate input
    if (empty($userid) || empty($chatid) || empty($message)) {
        // Handle empty fields
        echo "Please provide all required fields.";
        exit;
    }

    

    // Prepare SQL statement to insert data into the messages table
    $sql = "INSERT INTO messages (chatid, userid, timestamp, message) VALUES (?, ?, NOW(), ?)";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $chatid, $userid, $message);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Message added successfully.";
        header("Location: messages.php?chatid=$chatid");

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // If the request method is not POST, return an error
    echo "Invalid request method.";
}


?>
