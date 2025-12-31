<?php
include "../config/auth.php";        // SESSION + LOGIN
include "../config/auth_admin.php";  // ROLE ADMIN
include "../layout/header.php";
?>

<div class="container-fluid">
    <h4 class="mb-4">Tambah Pegawai</h4>

    <div class="card shadow-sm col-lg-6">
        <div class="card-body">

            <form method="post" action="simpan.php">

                <div class="mb-3">
                    <label class="form-label">NIP</label>
                    <input type="text"
                           name="nip"
                           class="form-control"
                           required
                           placeholder="Masukkan NIP Pegawai">
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Pegawai</label>
                    <input type="text"
                           name="nama"
                           class="form-control"
                           required
                           placeholder="Masukkan Nama Lengkap">
                </div>

                <div class="mb-3">
                    <label class="form-label">Jabatan</label>
                    <input type="text"
                           name="jabatan"
                           class="form-control"
                           required
                           placeholder="Masukkan Jabatan">
                </div>

                <div class="mb-3">
                    <label class="form-label">Saldo Cuti Awal</label>
                    <input type="number"
                           name="saldo_cuti"
                           class="form-control"
                           value="6"
                           min="0"
                           required>
                    <small class="text-muted">
                        Default saldo cuti tahunan adalah 6 hari
                    </small>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="index.php" class="btn btn-secondary">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Simpan Pegawai
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<?php include "../layout/footer.php"; ?>
