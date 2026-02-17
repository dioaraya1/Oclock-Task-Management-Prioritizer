<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  require_once __DIR__ . '/../src/login.php';
  exit;
}

require_once __DIR__ . '/../src/dashboard.php';