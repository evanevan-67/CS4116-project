<?php

include 'db_connect.php';


$sql = "SELECT * FROM interests";
$result = $conn->query($sql);

echo '<form action="search_results.php" method="post">';
echo '<h2>Search Profiles by Interests:</h2>';
// Loop through each interest retrieved from the database
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Create a checkbox for each interest
        echo '<input type="checkbox" name="interests[]" value="' . $row["interestid"] . '"> ' . $row["name"] . ' ';
    }
    // Add a submit button
    echo '<input type="submit" value="Search">';
} else {
    echo "No interests found in the database.";
}
echo '</form>';

// Close database connection
$conn->close();




?>