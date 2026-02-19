<?php
// src/config/helpers.php
// Helper functions untuk aplikasi

// Session helpers
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function getUser() {
    if (!isLoggedIn()) return null;
    
    return [
        'id' => $_SESSION['user_id'],
        'username' => $_SESSION['username'],
        'email' => $_SESSION['email'],
        'role' => $_SESSION['role'],
        'full_name' => $_SESSION['full_name'] ?? $_SESSION['username']
    ];
}

function isAdmin() {
    return isLoggedIn() && $_SESSION['role'] === 'admin';
}

function requireAuth() {
    if (!isLoggedIn()) {
        redirect('login');
        exit;
    }
}

function requireAdmin() {
    requireAuth();
    if (!isAdmin()) {
        redirect('dashboard');
        exit;
    }
}

function requireGuest() {
    if (isLoggedIn()) {
        redirect('dashboard');
        exit;
    }
}

// URL helpers
function url($page = '') {
    $base = '/oclock/public/index.php';
    return $page ? $base . '?page=' . $page : $base;
}

function redirect($page) {
    header('Location: ' . url($page));
    exit;
}

function currentPage() {
    return $_GET['page'] ?? 'home';
}

// Sanitize input
function clean($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Flash messages
function setFlash($type, $message) {
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function getFlash() {
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}

// Date helper
function formatDate($date) {
    return date('d M Y', strtotime($date));
}

function timeUntil($deadline) {
    $now = time();
    $target = strtotime($deadline);
    $diff = $target - $now;
    
    if ($diff < 0) return 'Lewat deadline';
    
    $days = floor($diff / 86400);
    if ($days > 0) return $days . ' hari lagi';
    
    $hours = floor($diff / 3600);
    if ($hours > 0) return $hours . ' jam lagi';
    
    return 'Segera!';
}
