<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intrysts - Profile View</title>
    <!--<link rel="stylesheet"  href=“https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
                            integrity=“sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh”
                            crossorigin="anonymous">>-->
    <link rel="stylesheet" href="style.css">                           
</head>
<body>
    <!--If userid not found, return to explore page?-->
    <div class="navbar">
        <a href="index.html">
          <img src="Images/Intrysts.PNG" alt="Intrysts Logo">
        </a>
        <!--<input type="text" placeholder="Search...">-->
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
    
    <div class="profilephoto">
        <img src="Images/ProfilePlaceholder.PNG">
    </div>
    <?php
    // Include the database connection file
        include 'db_connect.php';
        
        $profile_id = $_GET['profileid']; 
        
        $sql = "SELECT name, dob, location, occupation FROM profiles WHERE userid = $profile_id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class="userdetails">
            <div id="name"><?php echo $row['name']; ?></div>
            <div id="age"><?php     $dob=$row['dob'];
                                    $year = (date('Y') - date('Y',strtotime($dob)));
                                    echo $year;?></div>
            <div id="location"><?php echo $row['location']; ?></div>
            <div id="occupation"><?php echo $row['occupation']; ?></div>
        </div>
        <?php mysqli_close($conn);
        ?>
    <div class="photos">
        <div id="photosheader">
            <p>Photos</p>
        </div>
        <div class="photoslist">
            <img src="Images/ProfilePlaceholder.PNG">
            <img src="Images/ProfilePlaceholder.PNG">
            <img src="Images/ProfilePlaceholder.PNG">
        </div>

    </div>
    <div class="interests">
        <div id="interestsheader">
            <p>Intrysts</p>
        </div>
        <div id="interests">
            <!--Nine interests go here-->
            <ul>
            <?php
            include 'db_connect.php';
            
            $query =    "SELECT interests.name
                        FROM userinterests
                        INNER JOIN interests ON userinterests.interestid = interests.interestid
                        WHERE userinterests.userid = $profile_id";
            
            $result = mysqli_query($conn, $query);
            
            if ($result) {
        
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<li>{$row['name']}</li>";

                }
                
            } else {
            echo "Error: " . mysqli_error($connection);
            }

            ?>
            </ul>
        </div>
    </div>
    <div class="aboutme">
        <div id="aboutmeheader">
            <p>About Me</p>
        </div>
        <?php
            include 'db_connect.php';
            
            $query = "SELECT aboutme FROM profiles WHERE userid = $profile_id";
            
            $result = mysqli_query($conn, $query);
            
            if ($result) {
        
                $row = mysqli_fetch_assoc($result);
                echo "<p>{$row['aboutme']}</p>";

                
                
            } else {
            echo "Error: " . mysqli_error($connection);
            }
        ?>
    </div>
    <div class="Intrysted">
        <p>Are you Intrysted in 
            <?php
            include 'db_connect.php';
            
            $query = "SELECT name FROM profiles WHERE userid = $profile_id";
            
            $result = mysqli_query($conn, $query);
            
            if ($result) {
        
                $row = mysqli_fetch_assoc($result);
                echo "{$row['name']}";

                
                
            } else {
            echo "Error: " . mysqli_error($connection);
            }
        ?></p>
        <div class="connectionbox">
            <button><img src="Images/tickbox.jpg"></button>
            <button><img src="Images/xbox.jpg"></button>
            <!--Positive and negative boxes?-->
        </div>
    </div>
    <div class="matchstatussection">
        <h1 class="matchstatusheader">Match Status</h1>
        <p id="matchstatus">Unknown</p><!--Dynamically created text-->
        <button id="messagebutton">Message</button>
        <button id="blockbutton">Block/Report</button>
    </div>
    
</body>
</html>