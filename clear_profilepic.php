<?php
include 'db_connect.php'

    $profileid = $_GET('profileid');
    // Update profilepic column to be blank
    $sql = "UPDATE profiles SET profilepic = '' WHERE userid = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$profileid]);
    
    header("Location: adminprofileedit.php?profileid=$profileid");

 
?>