<?php
session_start();

$servername = "sql113.infinityfree.com";
$database = "if0_36142329_intrysts";
$dbusername = "if0_36142329";
$dbpassword = "eamonnmatt";

$email = $_POST["email"];
$password = $_POST["password"];

// Create Connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword, $database);
// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

$query = "SELECT userid FROM users WHERE email = '$email' AND password = '$password'";
$result = mysqli_query($conn, $query);

// Check if query was successful
if ($result) {
    // Check if user exists
    if (mysqli_num_rows($result) > 0) {
        // Authentication successful
        // Fetch the userid
        $row = mysqli_fetch_assoc($result);
        $userid = $row['userid'];
        
        // Start session and store user ID
        $_SESSION['userid'] = $userid;
        
        // Redirect to a dashboard or home page
        header("Location: /myprofile.php");
        

    } else {
        // Authentication failed
        echo "Invalid email or password";
    }
} else {
    // Query failed
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>