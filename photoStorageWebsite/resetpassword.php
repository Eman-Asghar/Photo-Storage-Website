<?php
// resetpassword.php
session_start();

if (!isset($_SESSION['reset_email'])) {
    // friendly link to go back
    echo "<div style='font-family:Arial; padding:40px; text-align:center;'>
            <h3 style='color:red;'>❌ Session expired. Try again from <a href='forgotpassword.php'>Forgot Password</a>.</h3>
          </div>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Reset Password | PhotoStorage</title>
  <link rel="stylesheet" href="passwordrecovery.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  <div class="reset-container">
    <h2>Reset Your Password 🔐</h2>
    <p>Enter your new password below for <strong><?php echo htmlspecialchars($_SESSION['reset_email']); ?></strong></p>

    <form action="reset_process.php" method="POST">
      <div class="input-box">
        <input type="password" name="new_password" placeholder="New Password" required>
      </div>

      <div class="input-box">
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
      </div>

      <button type="submit" name="update_password">Update Password</button>
    </form>
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
  </div>
</body>
</html>
