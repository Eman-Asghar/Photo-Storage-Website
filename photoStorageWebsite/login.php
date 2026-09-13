<?php
if (isset($_GET['logout'])) {
  echo "<script>alert('You have been logged out successfully.');</script>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PhotoStorage | Login</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

  <!-- Header -->
  <header>
    <div class="logo">📸 PhotoStorage </div>
    <nav>
      <a href="index.php">Home</a>
      <a href="login.php" class="btn">login</a>
      <a href="signup.php">signup</a> 
      <a href="profile.php">Profile</a>
      
    </nav>
  </header>

  <!-- Login Form -->
  <div class="signup-container">
    <form action="login_process.php" method="POST" class="signup-form">
      <h2>Login to your Account!</h2>

      <div class="input-box">
        <input type="email" name="email" required>
        <label>Email</label>
      </div>

      <!-- Password Field -->
 <div class="input-box password-box">
  <input type="password" id="password" name="password" required>
  <label for="password">Password</label>
  <i class="fa-solid fa-eye toggle-password" data-target="password"></i>
</div> 

    
      <div class="options">
        <label><input type="checkbox" name="remember"> Remember Me</label>
        <p><a href="forgotpassword.php">Forgot your password?</a></p>

      </div>

      <button type="submit" class="btn">Login</button>
      <p>Don’t have an account? <a href="signup.php">Create one</a></p>
    </form>
  </div>

  <script>
  // ---- Toggle Password Visibility ----
document.querySelectorAll('.toggle-password').forEach(icon => {
  icon.addEventListener('click', () => {
    const input = document.getElementById(icon.getAttribute('data-target'));
    if (input.type === 'password') {
      input.type = 'text';
      icon.classList.remove('fa-eye');
      icon.classList.add('fa-eye-slash');
    } else {
      input.type = 'password';
      icon.classList.remove('fa-eye-slash');
      icon.classList.add('fa-eye');
    }
  });
});
</script>

</body>
</html>
