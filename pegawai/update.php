<?php
include "../config/auth.php";
include "../config/auth_admin.php";
include "../config/db.php";

$id         = (int) $_POST['id'];
$nip        = $_POST['nip'];
$nama       = $_POST['nama'];
$jabatan    = $_POST['jabatan'];
$saldo_cuti = (int) $_POST['saldo_cuti'];

$conn->query("
    UPDATE pegawai SET
        nip = '$nip',
        nama = '$nama',
        jabatan = '$jabatan',
        saldo_cuti = $saldo_cuti
    WHERE id = $id
");

header("Location: index.php");
exit;
