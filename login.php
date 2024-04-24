<?php
session_start();

// Include the database connection file
include 'db_connect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"];
}

// Prepare SQL statement to prevent SQL injection
// Prepare SQL statement with placeholder for email
$stmt = $conn->prepare("SELECT userid, password, admin FROM users WHERE email = ?");
$stmt->bind_param('s', $email); // Bind parameter using 's' for string

// Execute the statement
$stmt->execute();

// Get result set
$result = $stmt->get_result();

// Proceed with further operations



if ($result && $result->num_rows > 0) {
    
    //echo $result->num_rows;
       $row = $result->fetch_assoc();
       $hashedPassword = $row['password']; // Get the stored hashed password
       // Verify password
       if (password_verify($password, $hashedPassword)) {
      
         $_SESSION['userid'] = $row['userid'];
         session_regenerate_id(true);

        if ($row['admin'] == 1){
          header("Location: /admindashboard.php");
        } else {
          header("Location: /myprofile.php");
        }
         exit;
       } else {
         echo "Invalid email or password ";
         header('Refresh: 10; URL=index.html');

       }
     } else {
       
       echo "Login failed. ";
       header('Refresh: 10; URL=index.html');
     }
    
    
$stmt->close();

// Close the database connection
$conn->close();

?>