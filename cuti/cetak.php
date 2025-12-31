<?php
require_once "../vendor/phpword/src/PhpWord/Autoloader.php";
\PhpOffice\PhpWord\Autoloader::register();

use PhpOffice\PhpWord\TemplateProcessor;

include "../config/db.php";
include "../config/auth.php";

$id = $_GET['id'];

/* ===============================
   AMBIL DATA CUTI + PEGAWAI
   =============================== */
$data = $conn->query("
SELECT c.*, p.nama, p.nip, p.jabatan, p.saldo_cuti
FROM cuti c
JOIN pegawai p ON c.pegawai_id = p.id
WHERE c.id = $id
")->fetch_assoc();

if(!$data){
    die("Data tidak ditemukan");
}

/* ===============================
   SIAPKAN TEMPLATE
   =============================== */
$template = new TemplateProcessor(
    "../template/Form Cuti Tahunan Tambahan CGPT.docx"
);

/* ===============================
   ISI PLACEHOLDER
   =============================== */
$template->setValue('tanggal_surat', date('d F Y'));
$template->setValue('nomor_surat', $data['nomor_surat']);

$template->setValue('nama', $data['nama']);
$template->setValue('nip', $data['nip']);
$template->setValue('jabatan', $data['jabatan']);

$template->setValue('lama_cuti', $data['lama']);
$template->setValue(
    'tanggal_cuti',
    date('d F Y', strtotime($data['tgl_mulai'])) .
    " s.d. " .
    date('d F Y', strtotime($data['tgl_selesai']))
);

$template->setValue('sisa_cuti', $data['saldo_cuti']);
$template->setValue('telp', $data['telp']);
$template->setValue('alamat_cuti', $data['alamat_cuti']);

/* Atasan (sesuai template Anda) */
$template->setValue(
    'jabatan_atasan',
    'Kepala Kanwil DJPb Provinsi Nusa Tenggara Timur'
);

/* ===============================
   OUTPUT FILE
   =============================== */
$filename = "Surat_Cuti_".$data['nama'].".docx";
$template->saveAs($filename);

header("Content-Disposition: attachment; filename=\"$filename\"");
readfile($filename);
unlink($filename);
exit;
