<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container">

<a class="navbar-brand" href="/aplikasi-cuti/dashboard.php">
    Aplikasi Cuti
</a>

<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navMenu">
<ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item">
        <a class="nav-link" href="/aplikasi-cuti/dashboard.php">Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/aplikasi-cuti/pegawai/index.php">Pegawai</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/aplikasi-cuti/cuti/buat.php">Buat Cuti</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/aplikasi-cuti/cuti/riwayat.php">Riwayat</a>
    </li>
</ul>

<span class="navbar-text text-white me-3">
    <?= $_SESSION['username'] ?> (<?= $_SESSION['role'] ?>)
</span>

<a href="/aplikasi-cuti/auth/logout.php" class="btn btn-outline-light btn-sm">
    Logout
</a>

</div>
</div>
</nav>
