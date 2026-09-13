<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Forgot Password | PhotoStorage</title>

  <!-- Link your reset password styling -->
  <link rel="stylesheet" href="passwordrecovery.css">

  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>

  <div class="reset-container">
    <h2>Forgot Your Password? </h2>
    <p>Enter your registered email address and we’ll help you reset your password.</p>

    <form action="forgot_process.php" method="POST">
      <div class="input-box">
        <input type="email" name="email" placeholder="Enter your email" required>
      </div>

      <button type="submit">Send Reset Link</button>
    </form>

    <p style="margin-top: 15px;">
      Remember your password? <a href="login.php">Back to Login</a>
    </p>
  </div>

</body>
</html>
