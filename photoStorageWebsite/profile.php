<?php
session_start();
include 'dbconnect.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user name (optional, if you have a users table)
$queryUser = "SELECT username FROM users WHERE id='$user_id'";
$userResult = mysqli_query($conn, $queryUser);
$user = mysqli_fetch_assoc($userResult);
$username = $user ? $user['username'] : 'User';

// Fetch photos from database
$query = "SELECT * FROM photos WHERE user_id='$user_id' ORDER BY upload_time DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Profile - Photo Storage</title>
  <link rel="stylesheet" href="profile.css">
  <style>
    /* === Image Preview Modal === */
    .modal {
      display: none;
      position: fixed;
      z-index: 999;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.9);
      justify-content: center;
      align-items: center;
      animation: fadeIn 0.3s ease-in-out;
    }

    .modal-content {
      max-width: 80%;
      max-height: 80%;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0,255,255,0.3);
      animation: zoomIn 0.3s ease-in-out;
    }

    .close {
      position: absolute;
      top: 30px;
      right: 50px;
      color: #fff;
      font-size: 35px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
    }

    .close:hover {
      color: #00e5ff;
    }

    @keyframes zoomIn {
      from { transform: scale(0.8); opacity: 0; }
      to { transform: scale(1); opacity: 1; }
    }
  </style>
</head>
<body>
  <!-- Header -->
<header class="header">
  <div class="logo"><b>📸 PhotoStorage</b></div>
  <nav>
    <a href="index.php">Home</a>
    <a href="login.php">Login</a>
    <a href="signup.php">Sign Up</a>
    <a href="profile.php" class="active">Profile</a>
    <button class="logout-btn" onclick="window.location.href='logout.php'">Logout</button>
  </nav>
</header>


  <div class="container">
    <div class="welcome-box">
      <h1>Welcome, <?php echo htmlspecialchars($username); ?> !</h1>
      <p>Here you can upload, view, and manage all your favorite memories.</p>
    </div>

    <h2>Upload Your Photo</h2>

    
    <!-- Image Preview -->
    <div id="preview-container" class="preview-container" style="display: none;">
      <p>Preview Before Upload:</p>
      <img id="preview" src="#" alt="Image Preview">
    </div>

<!-- Upload Form -->
    <form action="upload_photo.php" method="POST" enctype="multipart/form-data" class="upload-form">
      <label for="photo">Choose Photo:</label>
      <input type="file" id="photo" name="photo" accept="image/*" required onchange="previewImage(event)">
      <button type="submit" name="upload">Upload</button>
    </form>

   
  
  <h2 class="uploaded"><b> Image Library - Moments you have stored </b></h2>
  

<!-- Photo Gallery -->
    <div class="gallery">
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="photo-card">
          <img src="images/<?php echo htmlspecialchars($row['photo_name']); ?>" alt="Photo">
          <div class="photo-info">
            <p class="photo-name"><?php echo htmlspecialchars($row['photo_name']); ?></p>
            <p class="photo-date">Uploaded on: <?php echo $row['upload_time']; ?></p>
          </div>
          <div class="photo-actions">
            <button class="btn view" onclick="openModal('images/<?php echo htmlspecialchars($row['photo_name']); ?>')">View</button>
            <a href="edit_photo.php?id=<?php echo $row['id']; ?>" class="btn edit">Edit</a>
            <a href="delete_photo.php?id=<?php echo $row['id']; ?>" class="btn delete" onclick="return confirm('Are you sure you want to delete this photo?');">Delete</a>
          
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
  <!-- Image Modal -->
  <div id="imageModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImg">
  </div>

  <script>
    function previewImage(event) {
      const preview = document.getElementById('preview');
      const container = document.getElementById('preview-container');
      const file = event.target.files[0];
      if (file) {
        preview.src = URL.createObjectURL(file);
        container.style.display = 'block';
      }
    }

    // Open modal for View button
    function openModal(src) {
      const modal = document.getElementById("imageModal");
      const modalImg = document.getElementById("modalImg");
      modal.style.display = "flex";
      modalImg.src = src;
    }

    // Close modal
    function closeModal() {
      document.getElementById("imageModal").style.display = "none";
    }

    // Close when clicking outside
    window.onclick = function(event) {
      const modal = document.getElementById("imageModal");
      if (event.target === modal) {
        modal.style.display = "none";
      }
    }
  </script>

</body>
</html>
