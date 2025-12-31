<?php
$user = $_SESSION['user'] ?? 'User';
$role = strtoupper($_SESSION['role'] ?? '');
?>

<div class="topbar d-flex justify-content-between align-items-center px-4 py-2 shadow-sm bg-white">

    <div class="d-flex align-items-center gap-3">
        <button class="btn btn-sm btn-outline-secondary"
                type="button"
                onclick="toggleSidebar()">
            <i class="bi bi-list"></i>
        </button>
        <strong>Aplikasi Cuti Tahunan Tambahan</strong>
    </div>

    <div class="d-flex align-items-center gap-3">
        <span class="badge bg-primary"><?= htmlspecialchars($role) ?></span>
        <span class="text-muted"><?= htmlspecialchars($user) ?></span>
        <a href="/aplikasi-cuti/auth/logout.php"
           class="btn btn-sm btn-outline-danger">
            Logout
        </a>
    </div>
</div>

<script>
function toggleSidebar() {
    const wrapper = document.getElementById('app-wrapper');
    if (!wrapper) return;

    wrapper.classList.toggle('sidebar-collapsed');

    localStorage.setItem(
        'sidebarCollapsed',
        wrapper.classList.contains('sidebar-collapsed')
    );
}

document.addEventListener('DOMContentLoaded', function () {
    const wrapper = document.getElementById('app-wrapper');
    if (!wrapper) return;

    const collapsed = localStorage.getItem('sidebarCollapsed') === 'true';
    if (collapsed) {
        wrapper.classList.add('sidebar-collapsed');
    }
});
</script>
