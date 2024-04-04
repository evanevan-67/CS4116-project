<?php

include 'db_connect.php';


// SQL query to fetch user data
$stmt = $conn->prepare("SELECT name, email, location FROM users");
$stmt->bind_param($name, $email, $location);
$stmt->execute();
$result = $stmt->get_result(); 

// Check query execution
if ($result->num_rows > 0) {
  // Loop through each user record
  while($row = $result->fetch_assoc()) {
    // Create the HTML structure for each profile entry
    $profileEntry = "
      <div class = 'list'>
        <div class='line'>
          <div class='user'>
            <div class='profile'>
              <img src='Images/ProfilePlaceholder.PNG' alt=''>
            </div>
            <div class='details'>
              <h1 class='name'>" . $row["name"] . "</h1>
              <h3 class='email'>" . $row["email"] . "</h3>
            </div>
          </div>
          <div class='status'>
            <span></span>
            <p>active</p>
          </div>
          <div class='location'>
            <p>" . $row["location"] . "</p>
          </div>
          <div class='phone'>
            <p>+123456789</p>
          </div>
          <div class='contact'>
            <a href='#' class='btn'>Contact</a>
          </div>
          <div class='action'>
            <div class='icon'>
              <span></span>
              <span></span>
              <span></span>
            </div>
          </div>
        </div>
      </div>
    ";

    // Echo the generated profile entry HTML
    echo $profileEntry;
  }
} else {
  echo "No users found";
}

$conn->close();

?>
