<?php
include('dbconnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

  $query = "UPDATE users SET password = '$new_password' WHERE email = '$email'";
  
  if (mysqli_query($conn, $query)) {
    echo "<p>Password updated successfully! <a href='login.php'>Login now</a></p>";
  } else {
    echo "<p>Error updating password.</p>";
  }
}
?>
