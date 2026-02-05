<?php
require_once 'config/session.php';
require_once 'config/db.php';
requireAuth();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Profil — TaskFlow</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="layout">

    <?php require_once 'config/nav.php'; ?>

    <main class="main">

        <div class="page-header">
            <h2>Profil Saya</h2>
            <p>Kelola informasi dan pengaturan akun Anda</p>
        </div>

        <div class="profile-layout">

            <!-- Left: Profile Summary -->
            <div class="profile-sidebar">
                <div class="avatar-lg" id="prof-avatar" style="background-color:#6366f1;">
                    ??
                </div>
                <div class="pname" id="prof-name">—</div>
                <div class="pusername" id="prof-username">@—</div>
                <div class="pbio" id="prof-bio">Belum ada bio.</div>
                <div class="pjoined" id="prof-joined">—</div>
            </div>

            <!-- Right: Edit Forms -->
            <div class="profile-content">

                <!-- Edit Profile -->
                <div class="card">
                    <div class="card-title">✏️ Edit Profil</div>

                    <div class="form-group">
                        <label for="input-fullname">Nama Lengkap</label>
                        <input type="text" id="input-fullname" placeholder="Nama lengkap Anda">
                    </div>

                    <div class="form-group">
                        <label for="input-email">Email</label>
                        <input type="email" id="input-email" placeholder="email@contoh.com">
                    </div>

                    <div class="form-group">
                        <label for="input-bio">Bio</label>
                        <textarea id="input-bio" placeholder="Ceritakan sedikit tentang diri Anda…"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Warna Avatar</label>
                        <div class="color-picker-row">
                            <input type="color" id="input-avatar-color" value="#6366f1">
                            <div class="color-preview" id="color-preview" style="background-color:#6366f1;"></div>
                            <span>Pilih warna favorit Anda</span>
                        </div>
                    </div>

                    <button class="btn-update" id="btn-update-profile">Perbarui Profil</button>
                </div>

                <!-- Change Password -->
                <div class="card">
                    <div class="card-title">🔒 Ubah Password</div>

                    <div class="form-group">
                        <label for="input-cur-pw">Password Saat Ini</label>
                        <input type="password" id="input-cur-pw" placeholder="Password lama Anda">
                    </div>

                    <div class="form-group">
                        <label for="input-new-pw">Password Baru</label>
                        <input type="password" id="input-new-pw" placeholder="Min. 6 karakter">
                    </div>

                    <div class="form-group">
                        <label for="input-con-pw">Konfirmasi Password Baru</label>
                        <input type="password" id="input-con-pw" placeholder="Ulangi password baru">
                    </div>

                    <button class="btn-update" id="btn-change-password">Ubah Password</button>
                </div>

            </div>
        </div>

    </main>
</div>

<script src="js/app.js"></script>
<script src="js/profile.js"></script>
</body>
</html>
