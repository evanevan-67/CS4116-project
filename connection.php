<?php

$userid = $_SESSION['userid'];
$profileid = $_GET['profileid'];

//connection will be false0 or true1 depending on which box is pressed
$connection =  $_GET['connection'];

// Check database for connectionid where user1id = $userid || $profileid AND user2id = $userid || $profileid
// If none, create new connection user1id = $userid, user2id = $profileid, user1connection = $connection
// If one exists, find out whether user1id or user2id matches $userid, then change the relevant user1/2connection to be = connection
// if user1connection and user2connection are both true at the end of the sequence, change connectionstatus to true
// if no chat exists with this connectionstatus(and it's true), create a chat
// if either are false, change connectionstatus to false



header("Location: profileview.php?profileid=' . $profileid . '");
>?