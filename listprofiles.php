<?php

include 'db_connect.php';



$userid = $_SESSION['userid'];
$query = "SELECT interestedin FROM profiles WHERE userid = $userid";
$result = mysqli_query($conn, $query);



if ($row = mysqli_fetch_assoc($result)) {
    $interestedIn = $row['interestedin'];
} else {
    echo "no value found for interestedin";
}
//echo 1;
$today = new DateTime();
//echo 2;
// Calculate the minimum birthdate based on the maximum age
$minBirthdate = (clone $today)->modify("-$maxAge years");
////echo 3;
// Calculate the maximum birthdate based on the minimum age
$maxBirthdate = (clone $today)->modify("-$minAge years");
//echo 4;

// Output the range of birthdates
//echo "Minimum Birthdate: " . $minBirthdate->format('Y-m-d') . "<br>";
//echo "Maximum Birthdate: " . $maxBirthdate->format('Y-m-d');


//echo 5;

$query2 = "SELECT * FROM profiles WHERE gender = ? AND dob BETWEEN ? AND ?";
$stmt2 = mysqli_prepare($conn, $query2);
mysqli_stmt_bind_param($stmt2, "sss", $interestedIn, $minBirthdate->format('Y-m-d'), $maxBirthdate->format('Y-m-d'));
mysqli_stmt_execute($stmt2);
$result2 = mysqli_stmt_get_result($stmt2);


if(mysqli_num_rows($result2) > 0) {
    // Output data of each row
    while($row = mysqli_fetch_assoc($result2)) {
        
        echo '<div class="line">';
        echo '<a href="profileview.php?profileid=' . $row['userid'] . '">';
        echo '<div class="user">';
        echo '<div class="profile"><img src="' . $row['profilepic'] . '" alt="Profile Picture" class="profile-picture" onerror="this.src=\'Images/ProfilePlaceholder.PNG\'"></div>';
        echo '<div class="details">';
        echo '<div class="name">' . $row['name'] . '</div>';
      // Calculating age from date of birth
        $dob = new DateTime($row['dob']);
        $today   = new DateTime('today');
        $year = $dob->diff($today)->y;
        echo '<div class="age">' . $year . ' years old</div>';
        echo '<div class="occupation">' . $row['occupation'] . '</div>';
        echo '<div class="location">' . $row['location'] . '</div>';
        echo '</div>'; // Closing details div
        echo '</div>'; // Closing user div
        echo '</a>';
        echo '</div>'; // closing line div
    }
  } else {
    echo "No matching profiles found for this user.";
  }

  mysqli_close($conn);

  ?>