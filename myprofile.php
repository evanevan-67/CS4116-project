<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intrysts - My Profile</title>
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
       <!-- <input type="text" placeholder="Search...">-->
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

    <div class="profilephoto">
    <?php
        include 'db_connect.php';

        $user_id = $_SESSION['userid'];
        
        $query = "SELECT profilepic FROM profiles WHERE userid = $user_id";
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
    
    <form action="upload_image.php" method="POST" enctype="multipart/form-data" class="profile-photo-form">
    <label for="file" class="file-label">
        <span class="file-icon">+</span> Choose a photo
    </label>
    <input type="file" id="file" name="file" class="file-input">
    <button type="submit" name="submit" class="upload-button">Upload</button>
    </form>


    <?php
    // Include the database connection file
        include 'db_connect.php';
        
        $user_id = $_SESSION['userid']; 
        
        $sql = "SELECT name, dob, location, occupation FROM profiles WHERE userid = $user_id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class="mydetails">
            <div id="name"><?php echo $row['name']; ?></div>
            <div id="age"><?php     $dob=$row['dob'];
                                    $year = (date('Y') - date('Y',strtotime($dob)));
                                    echo $year;?></div>
            <div id="location"><?php echo $row['location']; ?></div>
            <div id="occupation"><?php echo $row['occupation']; ?></div>
            <button id="editdetails">Edit my details</button>
        </div>
        <?php mysqli_close($conn);
    ?>


    
    <div class="myphotos">
        <div id="myphotosheader">
            <p>My photos</p>
        </div>
        <div class="photoslist">
            <img src="Images/ProfilePlaceholder.PNG">
            <img src="Images/ProfilePlaceholder.PNG">
            <img src="Images/ProfilePlaceholder.PNG">
        </div>
        <button id="editmyphotos">Edit My Photos</button>

    </div>
    <div class="myinterests">
        <div id="interestsheader">
            <p>My Intrysts</p>
        </div>
        <div id="interests">
            <ul><!--Nine interests go here-->
            <?php
            include 'db_connect.php';
            
            $query =    "SELECT interests.name
                        FROM userinterests
                        INNER JOIN interests ON userinterests.interestid = interests.interestid
                        WHERE userinterests.userid = $user_id";
            
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
        <!--Add Interests? Select list?-->
        <form action="add_interests.php" method="post" class="interests-form">
    <div class="form-group">
        <label for="interests" class="form-label">Select your interests:</label><br>
        <select name="interests[]" id="interests" multiple class="form-select">
            <?php
            include 'db_connect.php';

            //$user_id = $_SESSION['userid']; 
            $sql = "SELECT interestid, name FROM interests";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['interestid']}'>{$row['name']}</option>";
            }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Add Interests</button>
</form>
    </div>
    <div class="aboutme">
        <div id="aboutmeheader">
            <p>About Me</p>
        </div>
        <?php
            include 'db_connect.php';
            
            $query = "SELECT aboutme FROM profiles WHERE userid = $user_id";
            
            $result = mysqli_query($conn, $query);
            
            if ($result) {
        
                $row = mysqli_fetch_assoc($result);
                echo "<p>{$row['aboutme']}</p>";

                
                
            } else {
            echo "Error: " . mysqli_error($connection);
            }
        ?>
        <form action="aboutme.php" method="post">
            <textarea name="aboutme" rows="5" cols="50" maxlength="500" placeholder="Enter your description of yourself (500 characters max)" required></textarea>
            <br>
            <input type="submit" value="Submit">
        </form>
    </div>
    <!--Used this to check if the userid is being properly stored in the session-->
    <footer>
    <div class="container">
        <p>&copy; 2024 Intrysts. All rights reserved.</p>
    </div>
</footer>
    
</body>
</html>