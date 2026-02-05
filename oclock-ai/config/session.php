<?php
// ============================================================
// config/session.php — Manajemen Sesi
// ============================================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/** Cek apakah user sudah login */
function isLoggedIn(): bool
{
    return isset($_SESSION['user_id']);
}

/** Ambil data user dari sesi */
function getSessionUser(): array
{
    return [
        'id' => $_SESSION['user_id'] ?? 0,
        'username' => $_SESSION['username'] ?? '',
        'full_name' => $_SESSION['full_name'] ?? '',
        'avatar_color' => $_SESSION['avatar_color'] ?? '#6366f1',
    ];
}

/** Simpan login ke sesi */
function setSessionUser(array $user): void
{
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['full_name'] = $user['full_name'] ?: $user['username'];
    $_SESSION['avatar_color'] = $user['avatar_color'] ?? '#6366f1';
}

/** Logout: hapus sesi */
function destroySession(): void
{
    $_SESSION = [];
    if (isset($_COOKIE[session_save_path() ?: session_name()])) {
        setcookie(session_name(), '', time() - 1);
    }
    session_destroy();
}

/** Guard: redirect ke login kalau belum login */
function requireAuth(): void
{
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

/** Guard: redirect ke dashboard kalau sudah login */
function requireGuest(): void
{
    if (isLoggedIn()) {
        header('Location: dashboard.php');
        exit;
    }
}
