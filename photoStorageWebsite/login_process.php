<?php
include 'dbconnect.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // ✅ 1. Find the user by email
  $sql = "SELECT * FROM users WHERE email='$email'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // ✅ 2. Verify the entered password with stored hashed password
    if (password_verify($password, $user['password'])) {
      // ✅ 3. Password correct → start session
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['email'] = $user['email'];

      echo "<script>alert('Login successful!'); window.location.href='profile.php';</script>";
    } else {
      echo "<script>alert('Incorrect password!'); window.location.href='login.php';</script>";
    }
  } else {
    echo "<script>alert('No account found with that email.'); window.location.href='signup.php';</script>";
  }
}

$conn->close();
?>
