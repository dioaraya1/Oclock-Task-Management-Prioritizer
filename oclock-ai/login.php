<?php
require_once 'config/session.php';
requireGuest(); // redirect ke dashboard kalau sudah login

$error = $_GET['error'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login — TaskFlow</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="auth-wrapper">
    <div class="auth-card">

        <!-- Logo -->
        <div class="logo">
            <h1>TaskFlow</h1>
            <p>Manajemen tugas dengan AI prioritas</p>
        </div>

        <h2>Selamat Datang Kembali</h2>
        <p class="subtitle">Masuk ke akun Anda untuk melanjutkan</p>

        <!-- Error -->
        <?php if ($error): ?>
            <div class="auth-error"><?= htmlspecialchars(urldecode($error)) ?></div>
        <?php endif; ?>

        <!-- Form Login -->
        <form action="auth/handle.php" method="post">
            <input type="hidden" name="action" value="login">

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username" required autocomplete="username">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password" required autocomplete="current-password">
            </div>

            <button type="submit" class="btn-primary">Masuk</button>
        </form>

        <div class="auth-footer">
            Belum punya akun? <a href="register.php">Daftar sekarang</a>
        </div>

    </div>
</div>

</body>
</html>
