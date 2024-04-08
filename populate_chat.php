<?php


include 'db_connect.php';

// Get the chatid from the URL parameter
$chatid = $_GET["chatid"];

// Prepare SQL statement to select messages from the messages table for the given chatid, ordered by timestamp
$sql = "SELECT * FROM messages WHERE chatid = ? ORDER BY timestamp";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $chatid);
$stmt->execute();
$result = $stmt->get_result();

// Output messages
while ($row = $result->fetch_assoc()) {
    // Determine the CSS class based on whether the message was sent by $userid or not
    $class = ($row['userid'] == $userid) ? 'sent-by-user' : 'sent-by-others';
    
    // Output the message with appropriate formatting
    echo '<div class="' . $class . '">';
    echo '<p>' . $row['message'] . '</p>';
    echo '</div>';
}

// Close statement and database connection
$stmt->close();
$conn->close();


?>
