<?php
include "../config/auth.php";
include "../config/auth_admin.php";
include "../config/db.php";
include "../layout/header.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];
$data = $conn->query("SELECT * FROM pegawai WHERE id = $id");

if ($data->num_rows === 0) {
    echo "<div class='alert alert-danger'>Data pegawai tidak ditemukan.</div>";
    include "../layout/footer.php";
    exit;
}

$p = $data->fetch_assoc();
?>

<div class="container-fluid">
    <h4 class="mb-4">Edit Pegawai</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="post" action="update.php">
                <input type="hidden" name="id" value="<?= $p['id'] ?>">

                <div class="mb-3">
                    <label class="form-label">NIP</label>
                    <input type="text" name="nip" class="form-control"
                           value="<?= htmlspecialchars($p['nip']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control"
                           value="<?= htmlspecialchars($p['nama']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jabatan</label>
                    <input type="text" name="jabatan" class="form-control"
                           value="<?= htmlspecialchars($p['jabatan']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Saldo Cuti</label>
                    <input type="number" name="saldo_cuti" class="form-control"
                           value="<?= $p['saldo_cuti'] ?>" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                    <button class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "../layout/footer.php"; ?>
