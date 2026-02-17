<?php
session_start();
$page = $_GET['page'] ?? 'login';

// whitelist halaman yang boleh diakses
$allowedPages = ['index', 'login', 'register', 'dashboard'];

define('BASE_PATH', dirname(__DIR__));
// kalau page tidak valid → fallback ke index
if (!in_array($page, $allowedPages)) {
  $page = 'index';
}

// proteksi dashboard
if ($page === 'dashboard' && !isset($_SESSION['user_id'])) {
  header('Location: ?page=login');
  exit;
}

// include header
require_once BASE_PATH . '/src/includes/header.php';

// include halaman
require_once BASE_PATH . "/src/{$page}.php";

// include footer
require_once BASE_PATH . '/src/includes/footer.php';

