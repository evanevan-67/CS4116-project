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
    <a href="aboutus.html">About Us</a>
    <a href="myprofile.php">My Profile</a>
    <a href="exploreprofiles.php">Explore</a>
    <a href="messages.php">Messages</a>
</div>

</div>
   


<form class="reportform" action="submit_report.php" method="post">
    <h2>Submit a Report</h2>
    <?php
        $userid = $_SESSION['userid'];
        $reportedid = $POST['profileid'];

        echo "<input type='hidden' name='userid' value='$userid'>";
        echo "<input type='hidden' name='reportedid' value='$reportedid'>";
    ?>
        <label for="message">Report Details:</label><br>
        <textarea id="message" name="message" rows="4" cols="50" maxlength="255" required></textarea><br><br>
    
        <input type="submit" value="Submit Report">
</form>

    
    <footer>
      <div class="container">
          <p>&copy; 2024 Intrysts. All rights reserved.</p>
      </div>
  </footer>
</body>
</html>