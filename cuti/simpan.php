<?php
include "../config/auth.php";
include "../config/db.php";

/* ==============================
   AMBIL DATA POST
================================ */
$pegawai_id   = $_POST['pegawai_id'];
$alasan       = $_POST['alasan'];
$tgl_mulai    = $_POST['tgl_mulai'];
$tgl_selesai  = $_POST['tgl_selesai'];
$telp         = $_POST['telp'];
$alamat_cuti  = $_POST['alamat_cuti'];
$tahun        = date('Y');

/* ==============================
   HITUNG LAMA CUTI (HARI KERJA)
================================ */
function hitungHariKerja($mulai, $selesai) {
    $count = 0;
    $d = strtotime($mulai);
    $end = strtotime($selesai);

    while ($d <= $end) {
        $day = date('N', $d);
        if ($day < 6) $count++;
        $d = strtotime("+1 day", $d);
    }
    return $count;
}

$lama_cuti = hitungHariKerja($tgl_mulai, $tgl_selesai);

/* ==============================
   VALIDASI SALDO CUTI
================================ */
$q = $conn->query("SELECT saldo_cuti FROM pegawai WHERE id='$pegawai_id'");
$p = $q->fetch_assoc();

if ($lama_cuti > $p['saldo_cuti']) {
    echo "<script>
        alert('Lama cuti melebihi sisa saldo cuti pegawai!');
        history.back();
    </script>";
    exit;
}

/* ==============================
   GENERATE NOMOR SURAT
================================ */
/*
 Format:
 SICTT-XXX/PB/UP.5/YYYY
*/

$qLast = $conn->query("
    SELECT nomor_surat 
    FROM cuti 
    WHERE YEAR(created_at) = '$tahun'
    ORDER BY id DESC 
    LIMIT 1
");

$urut = 1;
if ($qLast->num_rows > 0) {
    $last = $qLast->fetch_assoc();
    preg_match('/SICTT-(\d+)/', $last['nomor_surat'], $m);
    $urut = isset($m[1]) ? ((int)$m[1] + 1) : 1;
}

$noUrut = str_pad($urut, 3, '0', STR_PAD_LEFT);
$nomor_surat = "SICTT-$noUrut/PB/WPB.241/$tahun";

/* ==============================
   SIMPAN DATA CUTI
================================ */
$insert = $conn->query("
    INSERT INTO cuti 
    (nomor_surat, pegawai_id, alasan, tgl_mulai, tgl_selesai, lama, telp, alamat_cuti, created_at)
    VALUES
    ('$nomor_surat', '$pegawai_id', '$alasan', '$tgl_mulai', '$tgl_selesai', '$lama_cuti', '$telp', '$alamat_cuti', NOW())
");

/* ==============================
   UPDATE SALDO CUTI
================================ */
$conn->query("
    UPDATE pegawai 
    SET saldo_cuti = saldo_cuti - $lama_cuti
    WHERE id = '$pegawai_id'
");

/* ==============================
   REDIRECT
================================ */
header("Location: riwayat.php");
exit;
