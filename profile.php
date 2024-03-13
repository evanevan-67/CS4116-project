<?php

class Profile {

  // Database connection - to be replaced with our actual connection details
  private $conn;

  public function __construct($conn) {
    $this->conn = $conn;
  }

  // Method to get user profile by ID
  public function getUserProfile($userId) {
    $sql = "SELECT * FROM profiles WHERE user_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
      return $result->fetch_assoc();
    } else {
      return false;
    }
  }

  // Method to update user profile (we can add more fields as needed)
  public function updateProfile($userId, $name, $email, $bio) {
    $sql = "UPDATE profiles SET name = ?, email = ?, bio = ? WHERE user_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $bio, $userId);
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  

}

?>