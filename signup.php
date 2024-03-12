<?php
$servername = "intrysts.free.nf";
$database = "if0_36142329_intrysts";
$username = "if0_36142329";
$password = "eamonnmatt";

//Create Connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
$sql = "INSERT INTO users (name, email, password) VALUES ($name, $email, $password)";
if (mysqli_query($conn, $sql)) {
     echo "New user record created successfully";
     $userid = mysqli_insert_id($conn)
     $sql2 = "INSERT INTO profiles (userid, name, dob, gender, interestedin, occupation, location) VALUES ($userid, $name, $dob, $gender, $interestedin, $occupation, $location)";
     if (mysqli_query($conn, $sql2)) {
        echo "New profile record created successfully";
   } else {
        echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
   }
   } 

} else {
     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>