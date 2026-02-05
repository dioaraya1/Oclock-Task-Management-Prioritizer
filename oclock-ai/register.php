<?php
require_once 'config/session.php';
requireGuest();

$error = $_GET['error'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Daftar — TaskFlow</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="auth-wrapper">
    <div class="auth-card">

        <div class="logo">
            <h1>TaskFlow</h1>
            <p>Manajemen tugas dengan AI prioritas</p>
        </div>

        <h2>Buat Akun Baru</h2>
        <p class="subtitle">Isi formulir di bawah untuk mendaftar</p>

        <?php if ($error): ?>
            <div class="auth-error"><?= htmlspecialchars(urldecode($error)) ?></div>
        <?php endif; ?>

        <form action="auth/handle.php" method="post">
            <input type="hidden" name="action" value="register">

            <div class="form-group">
                <label for="full_name">Nama Lengkap</label>
                <input type="text" id="full_name" name="full_name" placeholder="Nama lengkap Anda">
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Pilih username" required autocomplete="off">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email Anda" required autocomplete="off">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Min. 6 karakter" required autocomplete="new-password">
            </div>

            <div class="form-group">
                <label for="confirm_password">Konfirmasi Password</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Ulangi password" required autocomplete="new-password">
            </div>

            <button type="submit" class="btn-primary">Daftar</button>
        </form>

        <div class="auth-footer">
            Sudah punya akun? <a href="login.php">Masuk di sini</a>
        </div>

    </div>
</div>

</body>
</html>
