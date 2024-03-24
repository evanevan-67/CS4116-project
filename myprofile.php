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
        <a href="myprofile.php">My Profile</a>
        <a href="viewprofiles.html">Explore</a>
        <a href="messages.html">Messages</a>
    </div>
    <div class="profilephoto">
        <img src="Images/ProfilePlaceholder.PNG">
    </div>



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
            <!--Nine interests go here-->
            <ul>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
        <!--Add Interests? Select list?-->
        <form action="add_interests.php" method="post">
            <label for="interests">Select your interests:</label><br>
            <select name="interests[]" id="interests" multiple>
                <?php
                include 'db_connect.php';
        
                //$user_id = $_SESSION['userid']; 
                $sql = "SELECT interestid, name FROM interests";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['interestid']}'>{$row['name']}</option>";
                }
                ?>
            </select><br>
            <input type="submit" value="Add Interests">
        </form>
    </div>
    <div class="aboutme">
        <div id="aboutmeheader">
            <p>About Me</p>
        </div>
        <p>Placeholder text about me</p>
    </div>
    <!--Used this to check if the userid is being properly stored in the session-->
    <?php
        
        echo $_SESSION['userid'];
    ?>
    
</body>
</html>