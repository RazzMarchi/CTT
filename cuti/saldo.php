<?php
include "../config/auth.php";
include "../layout/header.php";
include "../config/db.php";

/*
 CATATAN:
 - Asumsi tabel:
   pegawai(id, nama, nip, jabatan, saldo_cuti)
   cuti(id, pegawai_id, lama, ...)
 - Jika nama kolom lama cuti Anda berbeda,
   cukup sesuaikan di query SUM(...)
*/

$query = "
SELECT 
    p.id,
    p.nama,
    p.nip,
    p.jabatan,
    p.saldo_cuti,
    IFNULL(SUM(c.lama), 0) AS cuti_diambil
FROM pegawai p
LEFT JOIN cuti c ON p.id = c.pegawai_id
GROUP BY p.id
ORDER BY p.nama ASC
";

$data = $conn->query($query);

/* PROTEKSI JIKA QUERY GAGAL */
if (!$data) {
    die("
        <div style='padding:20px;color:red'>
            <b>Error Query:</b><br>
            ".$conn->error."
        </div>
    ");
}
?>

<div class="container-fluid">

    <div class="row mb-3">
        <div class="col">
            <h4 class="fw-semibold">Sisa Saldo Cuti Tahunan Tambahan</h4>
        </div>
    </div>

    <div class="card">
        <div class="card-header fw-semibold">
            Daftar Saldo Cuti
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th width="5%">No</th>
                            <th>Nama Pegawai</th>
                            <th>NIP</th>
                            <th>Jabatan</th>
                            <th width="15%">Cuti Sudah Diambil (Hari)</th>
                            <th width="15%">Sisa Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; while ($row = $data->fetch_assoc()) { ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['nip']) ?></td>
                            <td><?= htmlspecialchars($row['jabatan']) ?></td>
                            <td class="text-center"><?= (int)$row['cuti_diambil'] ?></td>
                            <td class="text-center">
                                <span class="badge <?= $row['saldo_cuti'] <= 1 ? 'bg-danger' : 'bg-success' ?>">
                                    <?= (int)$row['saldo_cuti'] ?> hari
                                </span>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

<?php include "../layout/footer.php"; ?>
