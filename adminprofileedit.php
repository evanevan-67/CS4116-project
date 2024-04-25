<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intrysts - Profile Review</title>
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
        <a href="admindashboard.php">Admin Dashboard</a>
        
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
    <?php
        include 'db_connect.php';

        $profile_id = $_GET['profileid']; 
        
        $query = "SELECT profilepic FROM profiles WHERE userid = $profile_id";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        if (empty($row['profilepic'])){
            echo '<img src="Images/ProfilePlaceholder.PNG">';
        } else {
            echo '<img src="' . $row['profilepic'] . '">';
        }

        mysqli_close($conn);
        ?>
    </div>



    <form method="GET" action="clear_profilepic.php">
    <input type="hidden" name="profileid" value="<?php echo $profile_id; ?>">
    <input type="submit" value="Clear Profile Pic">
    </form>

    <?php
    // Include the database connection file
        include 'db_connect.php';
        
        $profile_id = $_GET['profileid']; 
        
        $sql = "SELECT name, dob, location, occupation FROM profiles WHERE userid = $profile_id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class="mydetails">
            <div id="name"><?php echo $row['name']; ?></div>
            <div id="age"><?php $dob = new DateTime($row['dob']);
                                $today   = new DateTime('today');
                                $year = $dob->diff($today)->y;
                                echo $year;?></div>
            <div id="location"><?php echo $row['location']; ?></div>
            <div id="occupation"><?php echo $row['occupation']; ?></div>
        </div>
        <?php mysqli_close($conn);
        ?>
    <div class="myphotos">
        <div id="myphotosheader">
            <p>Photos</p>
        </div>
        <div class="photoslist">

        <?php
        include 'db_connect.php';

        
        
        $query = "SELECT photo1, photo2, photo3 FROM profiles WHERE userid = $profile_id";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        if (empty($row['photo1'])){
            echo '<img src="Images/ProfilePlaceholder.PNG">';
        } else {
            echo '<img src="' . $row['photo1'] . '">';
        }
        if (empty($row['photo2'])){
            echo '<img src="Images/ProfilePlaceholder.PNG">';
        } else {
            echo '<img src="' . $row['photo2'] . '">';
        }
        if (empty($row['photo3'])){
            echo '<img src="Images/ProfilePlaceholder.PNG">';
        } else {
            echo '<img src="' . $row['photo3'] . '">';
        }

        mysqli_close($conn);
        ?>

    <form method="GET" action="clear_photo.php">
    <input type="hidden" name="profileid" value="<?php echo $profile_id; ?>">
    <label for="select-number">Select photo number</label>
    <select id="select-number" name="number">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
    </select>
    <input type="submit" value="Clear Photo">
    </form>

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

        <form action="connection.php" method="get">
        	<input type="hidden" name="profileid" value="<?php echo $profile_id; ?>">
            <input type="hidden" name="connection" value="1">
            <button type="submit"><img src="Images/tickbox.jpg"></button>
        </form>
        <form action="connection.php" method="get">
        	<input type="hidden" name="profileid" value="<?php echo $profile_id; ?>">
            <input type="hidden" name="connection" value="0">
            <button type="submit"><img src="Images/xbox.jpg"></button>
        </form>
        
            <!--Positive and negative boxes?-->
        </div>
    </div>
    <div class="matchstatussection">
        <h1 class="matchstatusheader">Match Status</h1>

    
        <?php
            include 'db_connect.php';

            $userid = $_SESSION['userid'];
            $profileid = $_GET['profileid'];



            $sql = "SELECT connectionstatus FROM connections WHERE (user1id = $userid OR user2id = $userid) AND (user1id = $profileid OR user2id = $profileid)";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            // echo  $row['connectionstatus'];
            
            if ($row['connectionstatus'] == 1 ){
                
                echo '<p class="matchsuccess">It\'s a match!</div>';
                echo '<a class="matchlink" href="messages.php">Message me!</a>';
            } else {
                echo '<p class="unknownmatch">Unknown</div>';
            }
            mysqli_close($conn);
        ?>
        

        <?php
            echo '<a href="report_user.php?profileid=' . $profileid . '">';
            echo '<button id="blockbutton">Report User</button>';
            echo '</a>';
        ?>



    </div>


    <footer>
    <div class="container">
        <p>&copy; 2024 Intrysts. All rights reserved.</p>
    </div>
</footer>
    
</body>
</html>