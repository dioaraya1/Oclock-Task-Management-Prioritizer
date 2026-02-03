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
<title>Dashboard — TaskFlow</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="layout">

    <!-- Sidebar + Topbar (shared) -->
    <?php require_once 'config/nav.php'; ?>

    <!-- Main Content -->
    <main class="main">

        <div class="page-header">
            <h2>Dashboard</h2>
            <p>Ringkasan tugas dan aktivitas Anda</p>
        </div>

        <!-- Stat Cards -->
        <div class="stats-grid">
            <div class="stat-card accent-primary">
                <div class="stat-label">Total Tugas</div>
                <div class="stat-value" id="stat-total">0</div>
                <div class="stat-sub">Semua tugas Anda</div>
            </div>
            <div class="stat-card accent-warning">
                <div class="stat-label">Pending</div>
                <div class="stat-value" id="stat-pending">0</div>
                <div class="stat-sub">Belum dimulai</div>
            </div>
            <div class="stat-card accent-danger">
                <div class="stat-label">In Progress</div>
                <div class="stat-value" id="stat-inprogress">0</div>
                <div class="stat-sub">Sedang dikerjakan</div>
            </div>
            <div class="stat-card accent-success">
                <div class="stat-label">Done</div>
                <div class="stat-value" id="stat-done">0</div>
                <div class="stat-sub">Selesai</div>
            </div>
        </div>

        <!-- Priority + Status Distribution -->
        <div class="dashboard-row">

            <!-- Priority Distribution -->
            <div class="card">
                <div class="card-title">📊 Distribusi Prioritas</div>

                <div class="pri-bar-row">
                    <span class="pri-bar-label high">High</span>
                    <div class="pri-bar-track"><div class="pri-bar-fill high" style="width:0%"></div></div>
                    <span class="pri-bar-count high">0</span>
                </div>
                <div class="pri-bar-row">
                    <span class="pri-bar-label med">Medium</span>
                    <div class="pri-bar-track"><div class="pri-bar-fill med" style="width:0%"></div></div>
                    <span class="pri-bar-count med">0</span>
                </div>
                <div class="pri-bar-row">
                    <span class="pri-bar-label low">Low</span>
                    <div class="pri-bar-track"><div class="pri-bar-fill low" style="width:0%"></div></div>
                    <span class="pri-bar-count low">0</span>
                </div>
            </div>

            <!-- Status Distribution -->
            <div class="card">
                <div class="card-title">📋 Distribusi Status</div>

                <div class="status-bar-row">
                    <span class="status-bar-label">Pending</span>
                    <div class="status-bar-track"><div class="status-bar-fill pending" style="width:0%"></div></div>
                    <span class="status-bar-count">0</span>
                </div>
                <div class="status-bar-row">
                    <span class="status-bar-label">In Progress</span>
                    <div class="status-bar-track"><div class="status-bar-fill inprogress" style="width:0%"></div></div>
                    <span class="status-bar-count">0</span>
                </div>
                <div class="status-bar-row">
                    <span class="status-bar-label">Done</span>
                    <div class="status-bar-track"><div class="status-bar-fill done" style="width:0%"></div></div>
                    <span class="status-bar-count">0</span>
                </div>
            </div>

        </div>

        <!-- Recent Tasks -->
        <div class="card">
            <div class="card-title">🕐 Tugas Terbaru</div>
            <div id="recent-tasks">
                <div class="empty-state">Memuat...</div>
            </div>
        </div>

    </main>
</div>

<script src="js/app.js"></script>
<script src="js/dashboard.js"></script>
</body>
</html>
