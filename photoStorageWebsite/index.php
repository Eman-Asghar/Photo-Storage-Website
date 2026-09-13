<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PhotoStorage | Home</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

<!--Font library-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- CSS -->
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <!-- Floating Background Shapes -->
  <div class="floating-bg"></div>

  <!-- Navbar -->
  <header class="navbar">
    <div class="logo">📸 PhotoStorage</div>
    <nav>
      <a href="index.php" class="active">Home</a>
      <a href="login.php">Login</a>
      <a href="signup.php">Sign Up</a>
      <a href="profile.php">Profile</a>
    </nav>
  </header>

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-content">
      <h1 class="glow">Your Memories,<br><span>Beautifully Stored</span></h1>
      <p class="fade-in">A secure and elegant space to upload, organize, and relive your best moments.</p>
      <div class="btn-group">
        <a href="signup.php" class="btn primary">Get Started</a>
        <a href="login.php" class="btn secondary">Login</a>
      </div>
    </div>
  </section>

<!-- FEATURES SECTION -->
<section class="photo-feat-section">
  <div class="photo-feat-container">
    <h2 class="photo-feat-heading">More Than Just Storage. It's Your Digital Vault.</h2>
    
    <div class="photo-feat-grid">
      
      <div class="photo-feat-card">
        <i class="photo-feat-icon fas fa-lock"></i>
        <h3>Unbreakable Security</h3>
        <p>Your photos are protected with AES-256 encryption. We ensure end-to-end privacy for every memory you upload.</p>
      </div>

      <div class="photo-feat-card">
        <i class="photo-feat-icon fas fa-infinity"></i>
        <h3>Original Quality Uploads</h3>
        <p>Never compress your memories. Store your high-resolution photos and videos in their original, untouched quality forever.</p>
      </div>

      <div class="photo-feat-card">
        <i class="photo-feat-icon fas fa-magic"></i>
        <h3>Smart Organization</h3>
        <p>AI-powered tagging automatically organizes by date, location, and even faces, helping you find any photo in seconds.</p>
      </div>

      <div class="photo-feat-card">
        <i class="photo-feat-icon fas fa-share-alt"></i>
        <h3>Easy Private Sharing</h3>
        <p>Share albums via password-protected links and grant temporary access. Complete control over who sees your best moments.</p>
      </div>

    </div>
  </div>
</section>


  <!-- Footer -->
  <footer>
    <p>© 2025 PhotoStorage | Designed with ❤️ by <b>Eman Asghar</b></p>
  </footer>

  <!-- JS -->
  <script>
    // Fade-in animation on scroll
const cards = document.querySelectorAll('.service-card');

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
    }
  });
}, { threshold: 0.2 });

cards.forEach(card => observer.observe(card));

  </script>
</body>
</html>
