<?php
include 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // ✅ 1. Hash the password for security
  $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

  // ✅ 2. Check if email already exists
  $checkQuery = "SELECT * FROM users WHERE email='$email'";
  $result = $conn->query($checkQuery);

  if ($result->num_rows > 0) {
    echo "<script>alert('Email already registered! Try logging in.'); window.location.href='login.php';</script>";
  } else {
    // ✅ 3. Insert new user into database
    $sql = "INSERT INTO users (username, email, password) VALUES ('$name', '$email', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
      echo "<script>alert('Account created successfully! You can now login.'); window.location.href='login.php';</script>";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}

$conn->close();
?>
