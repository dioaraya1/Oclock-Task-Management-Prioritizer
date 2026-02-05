<?php
// ============================================================
// config/nav.php — Sidebar + Topbar HTML (include di setiap page)
// ============================================================
// Gunakan: <?php require_once 'config/nav.php'; 
// Pastikan session.php sudah di-require sebelumnya.
// ============================================================

$user = getSessionUser();
$initials = '';
$parts = explode(' ', $user['full_name'] ?: $user['username']);
foreach ($parts as $p) {
    if ($p !== '')
        $initials .= strtoupper($p[0]);
}
$initials = substr($initials, 0, 2) ?: '?';
?>

<!-- Mobile Topbar -->
<div class="topbar">
    <button class="hamburger" aria-label="Buka menu">
        <span></span><span></span><span></span>
    </button>
    <span class="topbar-logo">TaskFlow</span>
    <div style="width:32px;"></div><!-- spacer -->
</div>

<!-- Overlay (mobile) -->
<div class="overlay"></div>

<!-- Sidebar -->
<aside class="sidebar">
    <div class="logo">
        <h1>TaskFlow</h1>
        <p>Manajemen Tugas Cerdas</p>
    </div>

    <nav>
        <a href="dashboard.php"><span class="icon">📊</span> Dashboard</a>
        <a href="tasks.php"> <span class="icon">📝</span> Tugas Saya</a>
        <a href="profile.php"> <span class="icon">👤</span> Profil</a>
    </nav>

    <div class="sidebar-bottom">
        <div class="user-mini">
            <div class="avatar-sm" style="background-color:<?= htmlspecialchars($user['avatar_color']) ?>;">
                <?= htmlspecialchars($initials) ?>
            </div>
            <div class="user-info">
                <div class="name"><?= htmlspecialchars($user['full_name'] ?: $user['username']) ?></div>
                <div class="username">@<?= htmlspecialchars($user['username']) ?></div>
            </div>
        </div>
        <form action="auth/handle.php" method="post" style="margin-top:8px;">
            <input type="hidden" name="action" value="logout">
            <button type="submit" class="logout-btn">Logout →</button>
        </form>
    </div>
</aside>