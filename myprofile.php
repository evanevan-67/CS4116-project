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
        <input type="text" placeholder="Search...">
        <a href="myprofile.php">My Profile</a>
        <a href="viewprofiles.html">Explore</a>
        <a href="messages.html">Messages</a>
    </div>
    <div class="profilephoto">
        <img src="Images/ProfilePlaceholder.PNG">
    </div>
    <div class="mydetails">
        <div id="name">

        </div>
        <div id="age">
            
        </div>
        <div id="location">
            
        </div>
        <div id="occupation">
            
        </div>
        <button id="editdetails">Edit my details</button>
    </div>
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
    </div>
    <div class="aboutme">
        <div id="aboutmeheader">
            <p>About Me</p>
        </div>
        <p>Placeholder text about me</p>
    </div>
    <!--Used this to check if the userid is being properly stored in the session-->
    <?php
        session_start();
        echo $_SESSION['userid'];
    ?>
    
</body>
</html>