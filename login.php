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


$stmt->execute();


$result = $stmt->get_result();





if ($result && $result->num_rows > 0) {
    
    /
       $row = $result->fetch_assoc();
       $hashedPassword = $row['password']; 
       
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
         
         echo "<script>alert('Incorrect email or password!');</script>";
         echo "<script>location.href = 'index.html';</script>";
         exit; 
       }
     } else {
       
       
       echo "<script>alert('Login failed.');</script>";
       echo "<script>location.href = 'index.html';</script>";
       exit; 
     }
    
    
$stmt->close();

// Close the database connection
$conn->close();

?>
