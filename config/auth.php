<?php
// ===============================
// AUTH LOGIN (STABIL & AMAN)
// ===============================

// Pastikan cookie session di-set hanya sekali
if (session_status() === PHP_SESSION_NONE) {

    session_set_cookie_params([
        'path'     => '/aplikasi-cuti',
        'httponly' => true,
        'samesite' => 'Lax'
        // 'secure' => true, // Aktifkan jika HTTPS
    ]);

    session_start();
}

// Cek login
if (!isset($_SESSION['user'])) {
    header("Location: /aplikasi-cuti/auth/login.php");
    exit;
}
