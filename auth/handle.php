<?php
// ============================================================
// auth/handle.php — Proses Login / Register / Logout
// ============================================================

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/session.php';

$action = $_POST['action'] ?? '';

match($action) {
    'login'    => handleLogin(),
    'register' => handleRegister(),
    'logout'   => handleLogout(),
    default    => header('Location: ../login.php'),
};
exit;

// ─── LOGIN ──────────────────────────────────────────────────
function handleLogin(): void {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        back('../login.php', 'Username dan password wajib diisi.');
    }

    $db   = getDB();
    $user = $db->prepare("SELECT * FROM users WHERE username = ?")->execute([$username]) ?: null;
    // PDO execute() returns bool, kita perlu fetch
    $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($password, $user['password'])) {
        back('../login.php', 'Username atau password salah.');
    }

    setSessionUser($user);
    header('Location: ../dashboard.php');
}

// ─── REGISTER ───────────────────────────────────────────────
function handleRegister(): void {
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';
    $fullName = trim($_POST['full_name'] ?? '');

    // Validasi
    if ($username === '' || $email === '' || $password === '') {
        back('../register.php', 'Semua field wajib diisi.');
    }
    if (strlen($username) < 3) {
        back('../register.php', 'Username minimal 3 karakter.');
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        back('../register.php', 'Format email tidak valid.');
    }
    if ($password !== $confirm) {
        back('../register.php', 'Password dan konfirmasi tidak cocok.');
    }
    if (strlen($password) < 6) {
        back('../register.php', 'Password minimal 6 karakter.');
    }

    $db = getDB();

    // Cek duplikat
    $stmt = $db->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->fetch()) back('../register.php', 'Username sudah dipakai.');

    $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) back('../register.php', 'Email sudah terdaftar.');

    // Insert
    $hash = password_hash($password, PASSWORD_BCRYPT);
    $db->prepare(
        "INSERT INTO users (username, email, password, full_name) VALUES (?,?,?,?)"
    )->execute([$username, $email, $hash, $fullName]);

    // Login otomatis
    $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    setSessionUser($stmt->fetch());

    header('Location: ../dashboard.php');
}

// ─── LOGOUT ─────────────────────────────────────────────────
function handleLogout(): void {
    destroySession();
    header('Location: ../login.php');
}

// ─── Helper ─────────────────────────────────────────────────
function back(string $url, string $msg): void {
    header("Location: {$url}?error=" . urlencode($msg));
    exit;
}
