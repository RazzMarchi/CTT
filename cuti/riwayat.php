<?php
include "../config/auth.php";
include "../layout/header.php";
include "../config/db.php";

/* Ambil data cuti + pegawai */
$q = $conn->query("
SELECT 
    c.id,
    c.nomor_surat,
    c.tgl_mulai,
    c.tgl_selesai,
    c.lama,
    c.created_at,
    p.nama
FROM cuti c
JOIN pegawai p ON c.pegawai_id = p.id
ORDER BY c.id DESC
");
include "../config/auth.php";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Surat Cuti</title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <style>
        body { font-size:14px; }
        h5 { font-weight:bold; }
        table th { background:#f0f0f0; }
    </style>
</head>
<body>

<div class="container mt-4 mb-5">

    <h4 class="mb-3">
        RIWAYAT SURAT CUTI TAHUNAN TAMBAHAN
    </h4>

    <div class="mb-3">
        <a href="buat.php" class="btn btn-primary btn-sm">
            + Buat Surat Cuti Baru
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr class="text-center">
                <th width="5%">No</th>
                <th width="20%">Nomor Surat</th>
                <th width="20%">Nama Pegawai</th>
                <th width="25%">Tanggal Cuti</th>
                <th width="10%">Lama (Hari)</th>
                <th width="20%">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if($q->num_rows == 0){
            echo "<tr><td colspan='6' class='text-center'>Belum ada data cuti</td></tr>";
        } else {
            $no = 1;
            while($r = $q->fetch_assoc()){
        ?>
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= $r['nomor_surat'] ?></td>
                <td><?= $r['nama'] ?></td>
                <td>
                    <?= date('d-m-Y', strtotime($r['tgl_mulai'])) ?>
                    s.d
                    <?= date('d-m-Y', strtotime($r['tgl_selesai'])) ?>
                </td>
                <td class="text-center"><?= $r['lama'] ?></td>
                <td class="text-center">
                    <a href="cetak.php?id=<?= $r['id'] ?>" 
                       class="btn btn-success btn-sm">
                        Download Word
                    </a>
                </td>
            </tr>
        <?php
            }
        }
        ?>
        </tbody>
    </table>

</div>

<!-- JS -->
<script src="/aplikasi-cuti/assets/bootstrap.bundle.min.js"></script>
</body>
</html>

        <!-- FOOTER -->
<?php include "../layout/footer.php"; ?>