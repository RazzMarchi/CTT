<?php
// ===============================
// AUTH ADMIN (ROLE CHECK ONLY)
// ===============================

// Pastikan auth.php sudah dipanggil terlebih dahulu
if (!isset($_SESSION['user'])) {
    header("Location: /aplikasi-cuti/auth/login.php");
    exit;
}

// Cek role admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    echo "
    <!DOCTYPE html>
    <html lang='id'>
    <head>
        <meta charset='UTF-8'>
        <title>Akses Ditolak</title>
        <link rel='stylesheet' href='/aplikasi-cuti/assets/bootstrap.min.css'>
    </head>
    <body class='bg-light'>
        <div class='container mt-5'>
            <div class='alert alert-danger text-center shadow-sm'>
                <h5>Akses Ditolak</h5>
                <p>Halaman ini hanya dapat diakses oleh <strong>Administrator</strong>.</p>
                <a href='/aplikasi-cuti/dashboard.php' class='btn btn-primary mt-3'>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </body>
    </html>
    ";
    exit;
}
