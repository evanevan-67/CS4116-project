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
/* if (!isset($_SESSION['userid'])) {
        // Redirect the user to the index.html page
        header("Location: index.html");
        exit; 
    }*/
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
            $result2 = mysqli_query($conn, $query);
            
            if ($result2) {
                $row2 = mysqli_fetch_assoc($result2);
                $other_user_name = $row2['name'];
            } else {
            echo "Error: " . mysqli_error($conn);
            }

            //echo "<li><a href='populate_chat.php?chatid=$chatid'>$other_user_name</a></li>";
            echo "<li><a href='messages.php?chatid=$chatid' onclick='setChatId($chatid)'>$other_user_name</a></li>";

        }

        // Close statement and database connection
        $stmt->close();
        
    
        ?>
    </ul>
</div>

<div class="chat-box">
    <!-- Chatbox content will be loaded dynamically based on the selected chat option -->
    <?php
        // include 'populate_chat.php';

        $currentchatid = $_GET["chatid"];
        
        // Prepare SQL statement to select messages from the messages table for the given chatid, ordered by timestamp
        $sql = "SELECT * FROM messages WHERE chatid = ? ORDER BY timestamp";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $currentchatid);
        $stmt->execute();
        $result3 = $stmt->get_result();
        // Output messages
        while ($row3 = $result3->fetch_assoc()) {
        // Determine the CSS class based on whether the message was sent by $userid or not
        $class = ($row3['userid'] == $userid) ? 'sent-by-user' : 'sent-by-others';
    
        // Output the message with appropriate formatting
        echo '<div class="' . $class . '">';
        echo '<p>' . $row3['message'] . '</p>';
        echo '</div>';
        }

        // Close statement and database connection
        $stmt->close();
        $conn->close();
        

    ?>
</div>

<div class="message-input">
    <h2>Send Message</h2>
    <form action="send_message.php" method="post">
        <input type="hidden" name="userid" value="<?php echo $userid; ?>">
        <input type="hidden" name="chatid" id="chatid" value="<?php echo $currentchatid; ?>">
        <textarea name="message" rows="4" cols="50"></textarea><br>
        <input type="submit" value="Send">
    </form>
</div>


<script>
// Function to set the chatid value when a chat option is clicked
function setChatId(chatid) {
    document.getElementById('chatid').value = chatid;
}
</script>
    
</body>
</html>