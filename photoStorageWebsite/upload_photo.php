<?php
session_start();
include 'dbconnect.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

if (isset($_POST['upload'])) {
  $user_id = $_SESSION['user_id'];

  // Get photo name from user (optional field)
  $photo_name = trim($_POST['photo_name']);
  $file_name = $_FILES['photo']['name'];
  $file_tmp = $_FILES['photo']['tmp_name'];

  // Directory where images will be stored
  $target_dir = "images/";

  // Create folder if it doesn’t exist
  if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
  }

  // Get file extension (jpg, png, etc.)
  $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

  // If user entered custom name, use it safely
  if (!empty($photo_name)) {
    // Remove spaces and special chars from filename
    $safe_name = preg_replace("/[^a-zA-Z0-9_-]/", "_", $photo_name);
    $final_name = $safe_name . "." . $file_ext;
  } else {
    // Otherwise, keep original name
    $final_name = basename($file_name);
  }

  $target_file = $target_dir . $final_name;

  // Upload file
$targetDir = __DIR__ . '/images/';  // always finds the 'images' folder automatically
$fileName = basename($_FILES['photo']['name']);
$targetFilePath = $targetDir . $fileName;

if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFilePath)) {
    echo "Photo uploaded successfully!";
} else {
    echo "Sorry, there was an error while uploading your photo.";
}
?>
  
<!-- //   if (move_uploaded_file($file_tmp, $target_file)){
//     $query = "INSERT INTO photos (user_id, photo_name, upload_time) 
//               VALUES ('$user_id', '$final_name', NOW())";
//     if (mysqli_query($conn, $query)) {
//       header("Location: profile.php");
//       exit();
//     } else {
//       echo " Database error: " . mysqli_error($conn);
//     }
//   } else {
//     echo " Error: Unable to upload the photo. Please check folder permissions.";
//   }
// }
//  -->
