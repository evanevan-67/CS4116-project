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


//commenting out profile picture stuff until we sort that later




$query2 = "SELECT userid, name, dob, occupation, location FROM profiles WHERE gender = ?";
$stmt2 = mysqli_prepare($conn, $query2);
mysqli_stmt_bind_param($stmt2, "s", $interestedIn);
mysqli_stmt_execute($stmt2);
$result2 = mysqli_stmt_get_result($stmt2);


if(mysqli_num_rows($result2) > 0) {
    // Output data of each row
    while($row = mysqli_fetch_assoc($result2)) {
        
        echo '<div class="line">';
        echo '<a href="profileview.php?profileid=' . $row['userid'] . '">';
        echo '<div class="user">';
        // echo '<div class="profile"><img src="' . $row['profilepicture'] . '" alt="Profile Picture" class="profile-picture"></div>';
        echo '<div class="details">';
        echo '<div class="name">' . $row['name'] . '</div>';
      // Calculating age from date of birth
        $dob=$row['dob'];
        $year = (date('Y') - date('Y',strtotime($dob)));
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