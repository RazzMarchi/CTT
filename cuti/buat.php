<?php
include "../config/auth.php";
include "../layout/header.php";
include "../config/db.php";

$pegawai = $conn->query("SELECT * FROM pegawai");
?>

<div class="container-fluid">

    <!-- PAGE TITLE -->
    <div class="row mb-4">
        <div class="col">
            <h4 class="fw-semibold mb-1">Rekam Surat Cuti Tahunan Tambahan. Lengkapi data berikut untuk menerbitkan surat Cuti Tahunan Tambahan</h4>
        </div>
    </div>

    <form method="post" action="simpan.php">

        <!-- =====================
             IDENTITAS PEGAWAI
        ====================== -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white fw-semibold">
                1. Identitas Pegawai
            </div>
            <div class="card-body">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Pegawai</label>
                        <select name="pegawai_id" id="pegawai" class="form-select" required>
                            <option value="">-- Pilih Pegawai --</option>
                            <?php while ($p = $pegawai->fetch_assoc()) { ?>
                                <option value="<?= $p['id'] ?>"
                                    data-nip="<?= $p['nip'] ?>"
                                    data-jabatan="<?= $p['jabatan'] ?>"
                                    data-saldo="<?= $p['saldo_cuti'] ?>">
                                    <?= $p['nama'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">NIP</label>
                        <input type="text" id="nip" class="form-control" readonly>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Jabatan</label>
                        <input type="text" id="jabatan" class="form-control" readonly>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Unit Kerja</label>
                        <input type="text" class="form-control"
                               value="Kanwil Ditjen Perbendaharaan Provinsi Nusa Tenggara Timur"
                               readonly>
                    </div>
                </div>

            </div>
        </div>

        <!-- =====================
             DETAIL CUTI
        ====================== -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white fw-semibold">
                2. Detail Cuti
            </div>
            <div class="card-body">

                <div class="mb-3">
                    <label class="form-label">Alasan Cuti</label>
                    <textarea name="alasan" class="form-control" rows="3">Bertemu keluarga inti</textarea>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" name="tgl_mulai" id="mulai" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date" name="tgl_selesai" id="selesai" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Lama Cuti (Hari Kerja)</label>
                        <input type="text" id="lama" class="form-control" readonly>

                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Periode Cuti</label>
                        <input type="text" id="tanggal_cuti" class="form-control" readonly>
                    </div>
                </div>

            </div>
        </div>

        <!-- =====================
             SALDO & CATATAN
        ====================== -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white fw-semibold">
                3. Catatan & Saldo Cuti
            </div>
            <div class="card-body">

                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">Tahun</label>
                        <input type="text" class="form-control" value="<?= date('Y') ?>" readonly>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Sisa Saldo Cuti</label>
                        <input type="text" id="saldo" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Keterangan</label>
                        <input type="text" class="form-control" value="-" readonly>
                    </div>
                </div>

            </div>
        </div>

        <!-- =====================
             KONTAK CUTI
        ====================== -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white fw-semibold">
                4. Kontak Selama Menjalankan Cuti
            </div>
            <div class="card-body">

                <div class="mb-3">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" name="telp" class="form-control">
                </div>

                <div>
                    <label class="form-label">Alamat Selama Cuti</label>
                    <textarea name="alamat_cuti" class="form-control" rows="3"></textarea>
                </div>

            </div>
        </div>

        <!-- =====================
             ACTION BAR
        ====================== -->
<div class="card shadow-sm mb-5">
    <div class="card-body text-center">

        <button type="submit"
                class="btn btn-primary btn-lg px-5 py-3 fw-semibold shadow">
            Simpan & Buat Nomor Surat
        </button>
    </div>
</div>


    </form>
</div>

<script>
let saldoCuti = 0;

document.getElementById('pegawai').addEventListener('change', function () {
    let opt = this.options[this.selectedIndex];
    document.getElementById('nip').value = opt.dataset.nip || '';
    document.getElementById('jabatan').value = opt.dataset.jabatan || '';
    document.getElementById('saldo').value = opt.dataset.saldo || '';
    saldoCuti = parseInt(opt.dataset.saldo || 0);
    validasiSaldo();
});

function hitungHariKerja(mulai, selesai) {
    let count = 0;
    let d = new Date(mulai);
    while (d <= selesai) {
        let day = d.getDay();
        if (day !== 0 && day !== 6) count++;
        d.setDate(d.getDate() + 1);
    }
    return count;
}

function hitungCuti() {
    let m = document.getElementById('mulai').value;
    let s = document.getElementById('selesai').value;
    if (!m || !s) return;

    let md = new Date(m);
    let sd = new Date(s);
    let lama = hitungHariKerja(md, sd);

    document.getElementById('lama').value = lama;
    document.getElementById('tanggal_cuti').value =
        md.toLocaleDateString('id-ID') + " s.d. " + sd.toLocaleDateString('id-ID');

    validasiSaldo();
}

function validasiSaldo() {
    let lama = parseInt(document.getElementById('lama').value || 0);
    let alert = document.getElementById('alertSaldo');
    let btn = document.querySelector('button[type=submit]');

    if (lama > saldoCuti) {
        alert.classList.remove('d-none');
        btn.disabled = true;
    } else {
        alert.classList.add('d-none');
        btn.disabled = false;
    }
}

document.getElementById('mulai').addEventListener('change', hitungCuti);
document.getElementById('selesai').addEventListener('change', hitungCuti);
</script>

<?php include "../layout/footer.php"; ?>
