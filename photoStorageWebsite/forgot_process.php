<?php
// forgot_process.php
session_start();
include 'dbconnect.php'; // ensure this filename is exact

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: forgotpassword.php');
    exit;
}

$email = trim($_POST['email'] ?? '');

if ($email === '') {
    echo "<script>alert('Please enter your email'); window.location='forgotpassword.php';</script>";
    exit;
}

// Use prepared statements to avoid SQL injection
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // set session then redirect to reset form
    $_SESSION['reset_email'] = $email;
    header("Location: resetpassword.php");
    exit;
} else {
    echo "<script>alert('Email not found!'); window.location='forgotpassword.php';</script>";
    exit;
}
