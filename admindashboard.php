<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intrysts - Home Page</title>
    <!--<link rel="stylesheet"  href=“https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
                            integrity=“sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh”
                            crossorigin="anonymous">>-->
    <link rel="stylesheet" href="style.css">                      
</head>
<body>
  <div class="navbar">
    <a href="index.html">
      <img src="Images/Intrysts.PNG" alt="Intrysts Logo">
    </a>
    <!--<input type="text" placeholder="Search...">-->
    <form action="signout.php" method="post">
            <button type="submit">Sign Out</button>
    </form>
</div>

<!--View reports
Select report
view + edit Profile (remove profiles) enter userid
 ban user enter userid-->


<?php

include 'db_connect.php';
// Assuming you have already connected to your database

// Function to mark a report as resolved
function markReportResolved($conn, $reportid) {
    $query = "UPDATE reports SET resolved = 1 WHERE reportid = $reportid";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["resolve_report"])) {
    $reportid = $_POST["reportid"];
    markReportResolved($conn, $reportid);
}

// Fetch data from the reports table
$query = "SELECT reportid, userid, reportedid, message, resolved FROM reports";
$result = mysqli_query($conn, $query);

// Check if query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Display the table
echo "<form method='post'>";
echo "<table border='1'>
<tr>
<th>Report ID</th>
<th>User ID</th>
<th>Reported ID</th>
<th>Message</th>
<th>Resolved</th>
<th>Action</th>
</tr>";

// Loop through the rows of the result set
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['reportid'] . "</td>";
    echo "<td>" . $row['userid'] . "</td>";
    echo "<td>" . $row['reportedid'] . "</td>";
    echo "<td>" . $row['message'] . "</td>";
    echo "<td>" . ($row['resolved'] ? 'Yes' : 'No') . "</td>";
    echo "<td><button type='submit' name='resolve_report' value='1'>Mark Resolved</button>";
    echo "<input type='hidden' name='reportid' value='" . $row['reportid'] . "'></td>";
    echo "</tr>";
}

echo "</table>";
echo "</form>";

// Close the database connection
mysqli_close($conn);
?>




    <footer>
      <div class="container">
          <p>&copy; 2024 Intrysts. All rights reserved.</p>
      </div>
  </footer>
</body>
</html>