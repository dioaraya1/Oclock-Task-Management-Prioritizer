<?php
// ============================================================
// config/session.php — Manajemen Sesi dengan Pengaturan Halaman Pertama
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
    'role' => $_SESSION['role'] ?? 'user',
    'first_page' => $_SESSION['first_page'] ?? 'dashboard.php'
  ];
}

/** Simpan login ke sesi */
function setSessionUser(array $user): void
{
  $_SESSION['user_id'] = $user['id'];
  $_SESSION['username'] = $user['username'];
  $_SESSION['full_name'] = $user['full_name'] ?: $user['username'];
  $_SESSION['avatar_color'] = $user['avatar_color'] ?? '#6366f1';
  $_SESSION['role'] = $user['role'] ?? 'user';

  // Set halaman pertama berdasarkan role jika tidak disediakan
  if (isset($user['first_page'])) {
    $_SESSION['first_page'] = $user['first_page'];
  } else {
    $_SESSION['first_page'] = getDefaultFirstPage($user['role'] ?? 'user');
  }
}

/** Set halaman pertama yang diinginkan user */
function setFirstPage(string $page): bool
{
  // Validasi halaman yang diperbolehkan
  $allowedPages = ['dashboard.php', 'profile.php', 'tasks.php', 'reports.php', 'settings.php'];

  if (in_array($page, $allowedPages)) {
    $_SESSION['first_page'] = $page;
    return true;
  }

  // Jika custom page, tambahkan validasi keamanan
  $page = basename($page); // Hanya nama file, hindari path traversal
  $_SESSION['first_page'] = $page;
  return true;
}

/** Dapatkan halaman pertama berdasarkan role */
function getDefaultFirstPage(string $role): string
{
  $rolePages = [
    'admin' => 'dashboard.php',
    'manager' => 'reports.php',
    'employee' => 'tasks.php',
    'user' => 'dashboard.php'
  ];

  return $rolePages[$role] ?? 'dashboard.php';
}

/** Redirect ke halaman pertama yang telah ditentukan */
function redirectToFirstPage(): void
{
  if (isLoggedIn()) {
    $firstPage = $_SESSION['first_page'] ?? getDefaultFirstPage($_SESSION['role'] ?? 'user');
    header('Location: ' . $firstPage);
    exit;
  }
}

/** Redirect ke halaman login atau pertama berdasarkan status */
function smartRedirect(): void
{
  if (isLoggedIn()) {
    redirectToFirstPage();
  } else {
    header('Location: login.php');
    exit;
  }
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

/** Guard: redirect ke halaman pertama kalau sudah login */
function requireGuest(): void
{
  if (isLoggedIn()) {
    redirectToFirstPage();
  }
}