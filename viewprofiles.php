<?php

    include 'db_connect.php';
     
      

      // Prepare and execute SQL query
      $stmt = $conn->prepare("SELECT name, location, profile_picture FROM accounts");
      $stmt->execute();
      $stmt->bind_result($name, $location, $profile_picture);

      // Fetch results and generate HTML for each account
      while ($stmt->fetch()) {
          echo '<a href="profileview.html">';
          echo '<div class="account">';
          echo '<img src="' . $profile_picture . '">';
          echo '<p>' . $name . '</p>';
          echo '<p>' . $location . '</p>';
          echo '</div>';
          echo '</a>';
      }

      // Close statement and database connection
      $stmt->close();
      ?>