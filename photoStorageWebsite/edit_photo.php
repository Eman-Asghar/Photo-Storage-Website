<?php
session_start();
include 'dbconnect.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

$user_id = $_SESSION['user_id'];
$upload_dir = 'images/'; // ✅ Correct directory path

// ✅ Fetch photo by ID
if (!isset($_GET['id'])) {
  header('Location: profile.php');
  exit();
}

$photo_id = (int) $_GET['id'];
$query = "SELECT * FROM photos WHERE id='$photo_id' AND user_id='$user_id'";
$result = mysqli_query($conn, $query);
$photo = mysqli_fetch_assoc($result);

if (!$photo) {
  echo "<script>alert('Photo not found!'); window.location='profile.php';</script>";
  exit();
}

// ✅ Rename photo logic
if (isset($_POST['rename'])) {
  $new_name = trim($_POST['photo_name']);
  if (!empty($new_name)) {
    $old_name = $photo['photo_name'];
    $extension = pathinfo($old_name, PATHINFO_EXTENSION);
    $new_file_name = preg_replace("/[^a-zA-Z0-9_\-]/", "_", $new_name) . '.' . $extension;

    $old_path = $upload_dir . $old_name;
    $new_path = $upload_dir . $new_file_name;

    // Rename file in folder + update in database
    if (file_exists($old_path)) {
      if (rename($old_path, $new_path)) {
        $update = "UPDATE photos SET photo_name='$new_file_name', upload_time=NOW() WHERE id='$photo_id'";
        mysqli_query($conn, $update);
        echo "<script>alert('✅ Photo renamed successfully!'); window.location='profile.php';</script>";
        exit();
      } else {
        echo "<script>alert('❌ Failed to rename file on server.');</script>";
      }
    } else {
      echo "<script>alert('⚠️ Original file not found in folder.');</script>";
    }
  }
}

// ✅ Change photo logic
if (isset($_POST['change'])) {
  if (isset($_FILES['new_photo']) && $_FILES['new_photo']['error'] === 0) {
    $file_name = basename($_FILES['new_photo']['name']);
    $tmp_name = $_FILES['new_photo']['tmp_name'];
    $target = $upload_dir . $file_name;

    // Upload new photo
    if (move_uploaded_file($tmp_name, $target)) {
      // Delete old photo from folder
      $old_file = $upload_dir . $photo['photo_name'];
      if (file_exists($old_file)) unlink($old_file);

      // Update database record
      $update = "UPDATE photos SET photo_name='$file_name', upload_time=NOW() WHERE id='$photo_id'";
      mysqli_query($conn, $update);
      echo "<script>alert('✅ Photo changed successfully!'); window.location='profile.php';</script>";
      exit();
    } else {
      echo "<script>alert('❌ Failed to upload new photo.');</script>";
    }
  } else {
    echo "<script>alert('⚠️ Please select a photo to upload.');</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Photo - PhotoStorage</title>
  <link rel="stylesheet" href="editprofilephoto.css">
</head>
<body>
  <header class="header">
    <div class="logo">📸 PhotoStorage</div>
    <nav>
      <a href="profile.php" class="back-gradient">←Back to profile</a>
      <!-- <a href="logout.php" class="logout">Logout</a> -->
       <button onclick="window.location.href='logout.php'" class="logout-btn">Logout</button>
    </nav>
  </header>

  <div class="edit-container">
    <div class="edit-card">
      <h2>Edit Photo</h2>

      <div class="current-photo">
        <img src="<?php echo $upload_dir . htmlspecialchars($photo['photo_name']); ?>" alt="Current Photo">
        <p><strong>Current Name:</strong> <?php echo htmlspecialchars($photo['photo_name']); ?></p>
        <p><strong>Uploaded on:</strong> <?php echo htmlspecialchars($photo['upload_time']); ?></p>
      </div>

      <!-- Rename Section -->
      <form method="POST" class="edit-form">
        <h3>Rename Photo</h3>
        <input type="text" name="photo_name" placeholder="Enter new name (without extension)" required>
        <button type="submit" name="rename" class="btn rename-btn">Rename Photo</button>
      </form>

      <hr class="divider">

      <!-- Change Photo Section -->
      <form method="POST" enctype="multipart/form-data" class="edit-form">
        <h3>Change Photo</h3>
        <input type="file" name="new_photo" accept="image/*" required onchange="previewNewImage(event)">
        <div id="newPreview" class="new-preview" style="display: none;">
          <p>Preview:</p>
          <img id="newPreviewImg" src="#" alt="Preview">
        </div>
        <button type="submit" name="change" class="btn change-btn">Change Photo</button>
      </form>
    </div>
  </div>

  <script>
    function previewNewImage(event) {
      const file = event.target.files[0];
      const preview = document.getElementById("newPreviewImg");
      const container = document.getElementById("newPreview");
      if (file) {
        preview.src = URL.createObjectURL(file);
        container.style.display = "block";
      }
    }
  </script>
</body>
</html>
