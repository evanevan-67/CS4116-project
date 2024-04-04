<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intrysts - Messages</title>
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
    <a href="myprofile.php">My Profile</a>
    <a href="viewprofiles.html">Explore</a>
    <a href="messages.php">Messages</a>
    <form action="signout.php" method="post">
        <button type="submit">Sign Out</button>
    </form>
    
</div>

<?php
if (!isset($_SESSION['userid'])) {
        // Redirect the user to the index.html page
        header("Location: index.html");
        exit; 
    }
?>

</div>
   
    <div class="conversationslist">
        <h1>Connections</h1>
        <?php
            include 'db_connect.php';
        
            $user_id = $_SESSION['userid'];

            $sql = "SELECT conversationid FROM conversations WHERE user1id = $user_id OR user2id = $user_id";
            $result = mysqli_query($conn, $sql);
                
            
            
            while ($row = mysqli_fetch_assoc($result)) {
                    if (user_id == $row['user1id') {
                        $match_id = $row['user2id'];
                        $sql2 = "SELECT name FROM profiles WHERE userid = $match_id";
                        $result2 = mysqli_query($conn, $sql2);
                        echo <li> $result2 </li>
                        ;
                    }


                    
                }







        ?>
        <!--List to be populated with clickable matches from database opening the relevant chat-->
    </div>
    <div class="chatbox">
        <div class="connectionprofilephoto">
            <img src="Images/ProfilePlaceholder.PNG">
            <p>Placeholder name</p>
            <!--Populate fields with messages from the database connected to this chatid-->
        </div>
    </div>
    
</body>
</html>