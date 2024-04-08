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
    <a href="exploreprofiles.php">Explore</a>
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


<div class="chat-list">
    <h2>Chat Options</h2>
    <ul>
        <?php
        
        include 'db_connect.php';
        // Retrieve chat options where user1id or user2id match $userid
        $userid = $_SESSION['userid'];
        $sql = "SELECT chatid, user1id, user2id FROM chats WHERE user1id = ? OR user2id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $userid, $userid);
        $stmt->execute();
        $result = $stmt->get_result();

        // Display chat options
        while ($row = $result->fetch_assoc()) {
            $chatid = $row['chatid'];
            $other_user = ($row['user1id'] == $userid) ? $row['user2id'] : $row['user1id'];
            
            $query = "SELECT name FROM profiles WHERE userid = $other_user";
            $result = mysqli_query($conn, $query);
            
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $other_user_name = $row['name'];
            } else {
            echo "Error: " . mysqli_error($connection);
            }

            echo "<li><a href='populate_chat.php?chatid=$chatid&userid=$userid'>$other_user_name</a></li>";
        }

        // Close statement and database connection
        $stmt->close();
        $conn->close();
        ?>
    </ul>
</div>

<div class="chat-box">
    <!-- Chatbox content will be loaded dynamically based on the selected chat option -->
</div>

<div class="message-input">
    <h2>Send Message</h2>
    <form action="send_message.php" method="post">
        <input type="hidden" name="userid" value="<?php echo $userid; ?>">
        <input type="hidden" name="chatid" id="chatid" value="<?php echo $chatid; ?>">
        <textarea name="message" rows="4" cols="50"></textarea><br>
        <input type="submit" value="Send">
    </form>
</div>




</div>
   
    <div class="conversationslist">
        <h1>Connections</h1>
        <?php
            include 'db_connect.php';
        
            $user_id = $_SESSION['userid'];

            $sql = "SELECT chatid, user1id, user2id FROM chats WHERE user1id = $user_id OR user2id = $user_id";
            $result = mysqli_query($conn, $sql);
                
            
            
            while ($row = mysqli_fetch_assoc($result)) {
                    if (user_id == $row['user1id') {
                        $match_id = $row['user2id'];
                        $sql2 = "SELECT name FROM profiles WHERE userid = $match_id";
                        $result2 = mysqli_query($conn, $sql2);
                        echo "<a href="messages.php?chatid=$row[chatid]?profileid=$match_id"><li> $row[name] </li></a>";
                        
                    } else {
                        $match_id = $row['user1id'];
                        $sql2 = "SELECT name FROM profiles WHERE userid = $match_id";
                        $result2 = mysqli_query($conn, $sql2);
                        echo "<li> $result2 </li>";

                    }


                    
                }
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