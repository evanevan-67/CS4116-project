<?php

include 'db_connect.php';

if (!isset($_SESSION['userid'])) {
    die("User ID not set in session");
}


$userid = $_SESSION['userid'];
$profileid = $_GET['profileid'];

//connection will be false0 or true1 depending on which box is pressed
$connection =  $_GET['connection'];

// Check database for connectionid where user1id = $userid || $profileid AND user2id = $userid || $profileid

$query = "SELECT connectionid, CASE WHEN user1id = $userid THEN 'user1id'
                                    WHEN user2id = $userid THEN 'user2id'
                                    ELSE NULL
                                    END AS matched_column 
                                    FROM connections WHERE (user1id = $userid OR user1id = $profileid) 
                                                    AND (user2id = $userid OR user2id = $profileid);";
$result = mysqli_query($conn, $query);




// If none, create new connection user1id = $userid, user2id = $profileid, user1connection = $connection
if(mysqli_num_rows($result) == 0) {
    $stmt = $conn->prepare("INSERT INTO `connections` (`user1id`, `user2id`, `user1connection`) VALUES (?, ?, ?)");
    $stmt->bind_param('iii', $userid, $profileid, $connection);

    if ($stmt->execute()) {
        echo "New connection created successfully";
        $connectionid = $stmt->insert_id;
    } else {
        echo "Error: " . $stmt->error;
   }
   $stmt->close();
} else {
    echo "Connection exists already";
}

$row = mysqli_fetch_assoc($result);
// If one exists, find out whether user1id or user2id matches $userid, then change the relevant user1/2connection to be = connection
if(mysqli_num_rows($result) == 1) {
    //$row = mysqli_fetch_assoc($result);
    
    if ($row['matched_column'] == "user1id") {
        $stmt2 = $conn->prepare("UPDATE connections SET user1connection = ? WHERE connectionid = ?");
    } else if ($row['matched_column'] == "user2id") {
        $stmt2 = $conn->prepare("UPDATE connections SET user2connection = ? WHERE connectionid = ?");
    } else {
        echo "Error, didn't match either id";
    }
    $stmt2->bind_param('ii', $connection, $row['connectionid']); // Bind parameters
    if ($stmt2->execute()) {
        echo "Connection updated successfully";
    } else {
        echo "Error: " . $stmt2->error;
    }

    
}
// if user1connection and user2connection are both true at the end of the sequence, change connectionstatus to true


$query2 = "SELECT user1connection, user2connection FROM connections WHERE connectionid = " . $row['connectionid'];
$result2 = mysqli_query($conn, $query2);

$row2 = mysqli_fetch_assoc($result2);

 


if ($row2['user1connection'] && $row2['user2connection']){
    $stmt3 = $conn->prepare("UPDATE connections SET connectionstatus = 1 WHERE connectionid = ?");
    $stmt3->bind_param('i', $row['connectionid']);
        if ($stmt3->execute()) {
            echo "Connection status updated successfully to true";
        } else {
            echo "Error: " . $stmt3->error;
       }


    $query3 = "SELECT chatid FROM chats WHERE connectionid =" . $row['connectionid'];
    $result3 = mysqli_query($conn, $query3);

    if(mysqli_num_rows($result3) == 0) {
        $stmt4 = $conn->prepare("INSERT INTO `chats` (`connectionid`, `user1id`, `user2id`) VALUES (?, ?, ?)");
        $stmt4->bind_param('iii', $row['connectionid'], $userid, $profileid);

        if ($stmt4->execute()) {
            echo "New chat created successfully";
            
        } else {
        echo "Error: " . $stmt4->error;
        }
        $stmt4->close();
    }
} else {
    $stmt5 = $conn->prepare("UPDATE connections SET connectionstatus = 0 WHERE connectionid = ?");
    $stmt5->bind_param('i', $row['connectionid']);
        if ($stmt5->execute()) {
            echo "Connection status updated successfully to false";
        } else {
            echo "Error: " . $stmt5->error;
       }
}



// if no chat exists with this connectionstatus(and it's true), create a chat
// if either are false, change connectionstatus to false



header("Location: profileview.php?profileid=$profileid");

?>