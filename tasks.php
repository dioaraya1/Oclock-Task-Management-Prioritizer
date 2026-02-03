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
<title>Tugas Saya — TaskFlow</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="layout">

    <?php require_once 'config/nav.php'; ?>

    <main class="main">

        <div class="page-header">
            <h2>Tugas Saya</h2>
            <p>Kelola, tambah, dan lacak semua tugas Anda</p>
        </div>

        <!-- Filter + Add -->
        <div class="tasks-header">
            <div class="filters">
                <button class="filter-btn active" data-filter="All">Semua</button>
                <button class="filter-btn" data-filter="Pending">Pending</button>
                <button class="filter-btn" data-filter="In Progress">In Progress</button>
                <button class="filter-btn" data-filter="Done">Done</button>
            </div>
            <button class="btn-add" id="btn-add-task">+ Tambah Tugas</button>
        </div>

        <!-- Task List -->
        <div class="task-list" id="task-list">
            <div class="empty-state">Memuat tugas...</div>
        </div>

    </main>
</div>

<!-- ─── Modal: Tambah / Edit Tugas ─────────────────────────── -->
<div class="modal-backdrop" id="modal-backdrop">
    <div class="modal">
        <div class="modal-header">
            <h3 id="modal-title">Tambah Tugas Baru</h3>
            <button class="close-btn" id="modal-close">&times;</button>
        </div>
        <div class="modal-body">
            <form id="task-form" novalidate>
                <input type="hidden" id="task-id" name="id" value="0">

                <div class="form-group">
                    <label for="task-title">Judul Tugas *</label>
                    <input type="text" id="task-title" name="title" placeholder="Misal: Selesaikan laporan Q4" required>
                </div>

                <div class="form-group">
                    <label for="task-description">Deskripsi</label>
                    <textarea id="task-description" name="description" placeholder="Tambahkan detail tugas (opsional)…"></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="task-difficulty">Kesulitan *</label>
                        <select id="task-difficulty" name="difficulty">
                            <option value="Easy">Easy — Mudah</option>
                            <option value="Medium" selected>Medium — Sedang</option>
                            <option value="Hard">Hard — Sulit</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="task-importance">Kepentingan *</label>
                        <select id="task-importance" name="importance">
                            <option value="Low">Low — Rendah</option>
                            <option value="Medium" selected>Medium — Sedang</option>
                            <option value="High">High — Tinggi</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="task-deadline">Deadline *</label>
                        <input type="date" id="task-deadline" name="deadline" required>
                    </div>

                    <div class="form-group">
                        <label for="task-status">Status</label>
                        <select id="task-status" name="status">
                            <option value="Pending">Pending</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Done">Done</option>
                        </select>
                    </div>
                </div>

                <div style="background:#eef2ff;border-radius:8px;padding:10px 14px;margin-top:4px;margin-bottom:4px;">
                    <p style="font-size:0.72rem;color:#4338ca;margin:0;line-height:1.5;">
                        💡 <strong>Prioritas dihitung otomatis</strong> menggunakan <em>K-Means Clustering 3D</em>
                        berdasarkan <strong>3 parameter</strong>: kedekatan deadline, tingkat kesulitan, dan tingkat kepentingan tugas.
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" id="modal-close-btn">Batal</button>
                    <button type="submit" class="btn-save">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="js/app.js"></script>
<script src="js/tasks.js"></script>
<script>
    document.getElementById('modal-close-btn').addEventListener('click', () => {
        document.getElementById('modal-backdrop').classList.remove('active');
    });
</script>
</body>
</html>
