<?php
session_start();

// Include the database connection file
include 'db_connect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"];
}

// Prepare SQL statement to prevent SQL injection
$stmt = $conn->prepare("SELECT userid FROM users WHERE email = '$email' AND password = '$password'");
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result(); 

if ($result && $result->num_rows > 0) {
       $row = $result->fetch_assoc();
       $hashedPassword = $row['password']; // Get the stored hashed password
       
       // Verify password
       if (password_verify($password, $hashedPassword)) {
      
         $_SESSION['userid'] = $row['userid'];
         session_regenerate_id(true);
         header("Location: /myprofile.php");
         exit;
       } else {
         echo "Invalid email or password ";
       }
     } else {
       
       echo "Login failed. ";
     }
    
    
$stmt->close();

// Close the database connection
$conn->close();
  /*
  $query = "SELECT userid FROM users WHERE email = '$email' AND password = '$password'";
  $result = mysqli_query($conn, $query);
  */
  
  
  /*
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
  }*/
?>