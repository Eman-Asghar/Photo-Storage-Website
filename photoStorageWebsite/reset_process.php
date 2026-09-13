<?php
// reset_process.php
session_start();
include 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: forgotpassword.php');
    exit;
}

if (!isset($_SESSION['reset_email'])) {
    echo "<div style='font-family:Arial; padding:40px; text-align:center;'>
            <h3 style='color:red;'>❌ Session expired. Try again from <a href='forgotpassword.php'>Forgot Password</a>.</h3>
          </div>";
    exit;
}

$email = $_SESSION['reset_email'];
$new_pass = $_POST['new_password'] ?? '';
$confirm_pass = $_POST['confirm_password'] ?? '';

if ($new_pass === '' || $confirm_pass === '') {
    echo "<script>alert('Please fill all fields'); window.location='resetpassword.php';</script>";
    exit;
}

if ($new_pass !== $confirm_pass) {
    echo "<script>alert('Passwords do not match!'); window.location='resetpassword.php';</script>";
    exit;
}

// Hash and update using prepared statement
$hashed = password_hash($new_pass, PASSWORD_DEFAULT);
$stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
$stmt->bind_param("ss", $hashed, $email);

if ($stmt->execute()) {
    // success: clear session var and redirect to login
    unset($_SESSION['reset_email']);
    echo "<script>alert('✅ Password updated successfully! Please log in.'); window.location='login.php';</script>";
    exit;
} else {
    echo "Database error: " . htmlspecialchars($stmt->error);
    exit;
}
