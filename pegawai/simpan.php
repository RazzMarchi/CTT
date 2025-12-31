<?php
include "../config/auth.php";        // SESSION + LOGIN
include "../config/auth_admin.php";  // ROLE ADMIN
include "../config/db.php";

// Pastikan method POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

// Ambil & sanitasi input
$nip        = trim($_POST['nip'] ?? '');
$nama       = trim($_POST['nama'] ?? '');
$jabatan    = trim($_POST['jabatan'] ?? '');
$saldo_cuti = isset($_POST['saldo_cuti']) ? (int) $_POST['saldo_cuti'] : 6;

// Validasi wajib
if ($nip === '' || $nama === '' || $jabatan === '') {
    echo "<script>alert('Data tidak lengkap');history.back();</script>";
    exit;
}

// Cek NIP duplikat
$cek = $conn->query("SELECT id FROM pegawai WHERE nip = '$nip'");
if ($cek && $cek->num_rows > 0) {
    echo "<script>alert('NIP sudah terdaftar');history.back();</script>";
    exit;
}

// Simpan data
$sql = "
    INSERT INTO pegawai (nip, nama, jabatan, saldo_cuti)
    VALUES ('$nip', '$nama', '$jabatan', $saldo_cuti)
";

if ($conn->query($sql)) {
    header("Location: index.php");
    exit;
} else {
    echo "<div style='margin:20px'>Gagal menyimpan data pegawai.</div>";
}
