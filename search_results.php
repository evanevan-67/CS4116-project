
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="style.css"> <link rel="stylesheet" href="viewprofiles.css">
  
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
        <form action="signout.php" method="post">
          <button type="submit">Sign Out</button>
        </form>
      
    </div>

    <?php
        /*if (!isset($_SESSION['userid'])) {
                // Redirect the user to the index.html page
                header("Location: index.html");
                exit; 
            }*/
    ?>

    <?php 
    
    $selected_interests = $_POST['interests'];

    foreach($selected_interests as $interest_id) {
        // Echo each selected interest to the screen
        // echo "Selected Interest ID: " . $interest_id . "<br>";
    }

    
    ?>

    <!--Placeholder list of accounts-->

    <!--<div class="search-form">
    <?php include 'search_form.php'; ?>
    </div>-->
    <div class = "list">
        
      <?php 
      //echo 1;
      include 'search_profiles.php'; 
      // echo 2;
      
      ?>


        </div>

        
    </main>
    
    <footer>
    <div class="container">
        <p>&copy; 2024 Intrysts. All rights reserved.</p>
    </div>
</footer>
</body>
</html>