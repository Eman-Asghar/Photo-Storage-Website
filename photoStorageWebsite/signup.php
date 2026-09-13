<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PhotoStorage | Signup</title>
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
      <a href="login.php">Login</a>
      <a href="signup.php" class="btn">Signup</a>
      <a href="profile.php">Profile</a>
      
    </nav>
  </header>

  <!-- Signup Form -->
  <div class="signup-container">
    <form action="signup_process.php" method="POST" class="signup-form">
      <h2>Create Account!</h2>

      <div class="input-box">
        <input type="text" name="username" required>
        <label>Username</label>
      </div>

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

<!-- Confirm Password Field -->
 <div class="input-box password-box">
  <input type="password" id="confirm_password" name="confirm_password" required>
  <label for="confirm_password">Confirm Password</label>
  <i class="fa-solid fa-eye toggle-password" data-target="confirm_password"></i>
</div> 

  <button type="submit" class="btn">Sign Up</button>
  <p>Already have an account? <a href="login.php">Login here</a></p>
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