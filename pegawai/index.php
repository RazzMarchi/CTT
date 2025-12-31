<?php
include "../config/auth.php";        // LOGIN CHECK
include "../config/auth_admin.php";  // ROLE CHECK
include "../config/db.php";
include "../layout/header.php";


$data = $conn->query("SELECT * FROM pegawai ORDER BY nama");
?>


<div class="container-fluid">
    <h4 class="mb-3">Manajemen Pegawai</h4>

    <a href="tambah.php" class="btn btn-primary mb-3">
        + Tambah Pegawai
    </a>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Saldo Cuti</th>
                        <th width="140">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php while($p = $data->fetch_assoc()): ?>
                    <tr>
                        <td><?= $p['nip'] ?></td>
                        <td><?= $p['nama'] ?></td>
                        <td><?= $p['jabatan'] ?></td>
                        <td><?= $p['saldo_cuti'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="hapus.php?id=<?= $p['id'] ?>"
                               onclick="return confirm('Hapus pegawai ini?')"
                               class="btn btn-sm btn-danger">
                               Hapus
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include "../layout/footer.php"; ?>
