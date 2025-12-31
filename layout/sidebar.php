<?php
$role = $_SESSION['role'] ?? '';
$current = $_SERVER['REQUEST_URI'];
?>

<div class="sidebar" id="sidebar">
    <div class="brand px-3 py-3 text-center fw-bold">
        APLIKASI CUTI TAHUNAN TAMBAHAN
    </div>

    <ul class="nav flex-column mt-2">

        <li class="nav-item">
            <a class="nav-link <?= str_contains($current, 'dashboard') ? 'active' : '' ?>"
               href="/aplikasi-cuti/dashboard.php">
                <i class="bi bi-speedometer2"></i>
                <span class="ms-2">Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= str_contains($current, '/cuti/buat') ? 'active' : '' ?>"
               href="/aplikasi-cuti/cuti/buat.php">
                <i class="bi bi-file-earmark-plus"></i>
                <span class="ms-2">Buat Surat Cuti</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= str_contains($current, '/cuti/riwayat') ? 'active' : '' ?>"
               href="/aplikasi-cuti/cuti/riwayat.php">
                <i class="bi bi-clock-history"></i>
                <span class="ms-2">Riwayat Cuti</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= str_contains($current, '/cuti/saldo') ? 'active' : '' ?>"
               href="/aplikasi-cuti/cuti/saldo.php">
                <i class="bi bi-calendar-check"></i>
                <span class="ms-2">Sisa Saldo Cuti</span>
            </a>
        </li>

        <?php if ($role === 'admin'): ?>
            <li class="nav-divider mt-3 mb-2 small text-muted px-3">
                ADMIN
            </li>
            <li class="nav-item">
                <a class="nav-link <?= str_contains($current, '/pegawai') ? 'active' : '' ?>"
                   href="/aplikasi-cuti/pegawai/index.php">
                    <i class="bi bi-people"></i>
                    <span class="ms-2">Manajemen Pegawai</span>
                </a>
            </li>
        <?php endif; ?>

    </ul>
</div>
