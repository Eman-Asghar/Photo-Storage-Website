<?php
session_start();
include 'dbconnect.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

if (isset($_GET['id'])) {
  $photo_id = $_GET['id'];
  $user_id = $_SESSION['user_id'];

  // Step 1: Fetch photo file name from database
  $query = "SELECT photo_name FROM photos WHERE id='$photo_id' AND user_id='$user_id'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $photo = mysqli_fetch_assoc($result);
    $photo_path = "images/" . $photo['photo_name'];

    // Step 2: Delete the actual file if it exists
    if (file_exists($photo_path)) {
      unlink($photo_path); // Delete image file
    }

    // Step 3: Delete record from database
    $deleteQuery = "DELETE FROM photos WHERE id='$photo_id' AND user_id='$user_id'";
    mysqli_query($conn, $deleteQuery);

    // Step 4: Redirect back to profile
    header("Location: profile.php");
    exit();
  } else {
    echo "❌ Error: Photo not found or you don’t have permission to delete it.";
  }
} else {
  echo "❌ Invalid request.";
}
?>
