<?php
session_start();

$base_url = '/';

if (!isset($_SESSION['user_id'])) {
  header("Location: {$base_url}src/index.php");
  exit;
}

// kalau sudah login, load dashboard misalnya
header("Location: {$base_url}src/dashboard.php");
exit;
