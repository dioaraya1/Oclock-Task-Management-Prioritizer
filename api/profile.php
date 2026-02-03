<?php
// ============================================================
// api/profile.php — Get / Update Profile + Change Password
// ============================================================

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/session.php';

header('Content-Type: application/json');

if (!isLoggedIn()) { echo json_encode(['error'=>'Belum login']); exit; }

$uid    = getSessionUser()['id'];
$action = $_POST['action'] ?? $_GET['action'] ?? 'get';

match($action) {
    'get'             => getProfile($uid),
    'update'          => updateProfile($uid),
    'change_password' => changePassword($uid),
    default           => getProfile($uid),
};

// ─── GET ────────────────────────────────────────────────────
function getProfile(int $uid): void {
    $stmt = getDB()->prepare(
        "SELECT id,username,email,full_name,bio,avatar_color,created_at FROM users WHERE id=?"
    );
    $stmt->execute([$uid]);
    $user = $stmt->fetch();
    echo $user ? json_encode($user) : json_encode(['error'=>'User tidak ditemukan']);
}

// ─── UPDATE PROFILE ────────────────────────────────────────
function updateProfile(int $uid): void {
    $fullName    = trim($_POST['full_name'] ?? '');
    $email       = trim($_POST['email'] ?? '');
    $bio         = trim($_POST['bio'] ?? '');
    $avatarColor = trim($_POST['avatar_color'] ?? '#6366f1');

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['error'=>'Format email tidak valid.']); return;
    }

    $db = getDB();

    // Cek email duplikat
    $stmt = $db->prepare("SELECT id FROM users WHERE email=? AND id!=?");
    $stmt->execute([$email, $uid]);
    if ($stmt->fetch()) { echo json_encode(['error'=>'Email sudah dipakai akun lain.']); return; }

    $db->prepare(
        "UPDATE users SET full_name=?,email=?,bio=?,avatar_color=?,updated_at=NOW() WHERE id=?"
    )->execute([$fullName, $email, $bio, $avatarColor, $uid]);

    // Sync sesi
    $_SESSION['full_name']    = $fullName ?: $_SESSION['username'];
    $_SESSION['avatar_color'] = $avatarColor;

    echo json_encode(['success'=>true,'message'=>'Profil diperbarui!']);
}

// ─── CHANGE PASSWORD ───────────────────────────────────────
function changePassword(int $uid): void {
    $curPw  = $_POST['current_password'] ?? '';
    $newPw  = $_POST['new_password'] ?? '';
    $conPw  = $_POST['confirm_password'] ?? '';

    if ($curPw==='' || $newPw==='' || $conPw==='') {
        echo json_encode(['error'=>'Semua field wajib diisi.']); return;
    }
    if ($newPw !== $conPw) {
        echo json_encode(['error'=>'Password baru dan konfirmasi tidak cocok.']); return;
    }
    if (strlen($newPw) < 6) {
        echo json_encode(['error'=>'Password baru minimal 6 karakter.']); return;
    }

    $db   = getDB();
    $stmt = $db->prepare("SELECT password FROM users WHERE id=?");
    $stmt->execute([$uid]);
    $row  = $stmt->fetch();

    if (!password_verify($curPw, $row['password'])) {
        echo json_encode(['error'=>'Password lama tidak benar.']); return;
    }

    $db->prepare("UPDATE users SET password=?,updated_at=NOW() WHERE id=?")->execute([
        password_hash($newPw, PASSWORD_BCRYPT), $uid
    ]);

    echo json_encode(['success'=>true,'message'=>'Password berhasil diubah!']);
}
