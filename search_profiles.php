<?php

include 'db_connect.php';

$userid = $_SESSION['userid'];

// Get the selected interests from the user
$selected_interests = $_POST['interests'];

$query = "SELECT interestedin FROM profiles WHERE userid = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $userid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    $interestedIn = $row['interestedin'];
    // echo "Interested In: " . $interestedIn . "<br>"; // Echo the value of $interestedIn
} else {
    echo "No value found for interestedin";
}


// Debug: Output the contents of selected_interests array
/*echo "Selected Interests: ";
print_r($selected_interests);
echo "<br>";*/

// Generate placeholders for the selected interests
$placeholders = implode(',', $selected_interests);
//echo "Placeholders: " . $placeholders . "<br>"; // Echo the value of $placeholders


// Count the selected interests
$selected_interests_count = count($selected_interests);
//echo "Selected Interests Count: " . $selected_interests_count . "<br>"; // Echo the count of selected interests

// Construct the SQL query
$query = "SELECT p.userid, p.name, p.dob, p.occupation, p.location, p.profilepic 
          FROM profiles p
          INNER JOIN userinterests ui ON p.userid = ui.userid
          WHERE p.gender = '$interestedIn' AND ui.interestid IN ($placeholders)
          GROUP BY p.userid
          HAVING COUNT(DISTINCT ui.interestid) = " . $selected_interests_count;

// Execute the query
//echo "Executing Query...<br>";
$result = mysqli_query($conn, $query);
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="line">';
            echo '<a href="profileview.php?profileid=' . $row['userid'] . '">';
            echo '<div class="user">';
            echo '<div class="profile"><img src="' . $row['profilepic'] . '" alt="Profile Picture" class="profile-picture"></div>';
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
            echo '</div>'; // Closing line div
        }
    } else {
        echo "No matching profiles found for this user.";
    }
} else {
    echo "Error executing query: " . mysqli_error($conn);
}

mysqli_close($conn);

?>
