<?php

include 'db_connect.php';


$sql = "SELECT * FROM interests";
$result = $conn->query($sql);

echo '<form action="search_results.php" method="post">';

echo '<link rel="stylesheet" href="search_form_style.css">';

echo '<div class = "dropdown">';
echo '<button class = "dropbtn">Select Interests</button>';
echo '<div class = "dropdown-content">';

    echo '<table border = "1" cellpadding = "5" cellspacing = "5" bordercolor = "pink" bgcolor = "white">';
    echo '<th color = "white" bgcolor = "pink">Search Profiles by Interests:</th>';

$counter = 0;

// Loop through each interest retrieved from the database
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

        //create a new row every 14th entry
        if ($counter % 15 === 0) {
            echo '<tr>';
          }

        // Create a checkbox for each interest
        echo '<td>';

        echo '<input type="checkbox" name="interests[]" value="' . $row["interestid"] . '"> ' . $row["name"] . ' ';
        echo '</td>';
        $counter++; // Increment counter after each entry

         //Close the table row if we reach the limit (14 entries)
        if ($counter % 15 === 0) {
            echo '</tr>';
        }

        
    }
} else {
    echo "No interests found in the database.";
    echo '</tr>';
}

// Add a submit button
echo '</table>';
echo '<input type="submit" value="Search">';
echo '</div>'; // Close dropdown content
echo '</div>'; // Close dropdown container
echo '</form>';

// Close database connection
$conn->close();




?>