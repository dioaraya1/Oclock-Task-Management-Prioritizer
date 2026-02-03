<?php
// ============================================================
// index.php — Entry Point
// Redirect ke dashboard kalau sudah login, login kalau belum.
// ============================================================

require_once 'config/session.php';

if (isLoggedIn()) {
    header('Location: dashboard.php');
} else {
    header('Location: login.php');
}
exit;
