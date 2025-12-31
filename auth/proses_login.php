<?php
// SET SESSION COOKIE AGAR BERLAKU DI SELURUH APLIKASI
session_set_cookie_params([
    'path' => '/aplikasi-cuti',
    'httponly' => true
]);

session_start();

include "../config/db.php";

$username = $_POST['username'];
$password = $_POST['password'];

$q = $conn->query("SELECT * FROM users WHERE username='$username'");
$user = $q->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {

    $_SESSION['user'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    header("Location: /aplikasi-cuti/dashboard.php");
    exit;
}

header("Location: login.php?error=1");
exit;
