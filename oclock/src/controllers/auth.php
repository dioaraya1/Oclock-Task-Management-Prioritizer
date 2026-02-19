<?php
// src/controllers/auth.php
// Authentication API

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/helpers.php';

$action = $_GET['action'] ?? '';

// ============================================
// LOGIN
// ============================================
if ($action === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = clean($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        setFlash('error', 'Username dan password wajib diisi');
        redirect('login');
    }
    
    // Cek user di database
    $user = dbFetch(
        "SELECT * FROM users WHERE username = ? LIMIT 1",
        [$username],
        "s"
    );
    
    if (!$user) {
        setFlash('error', 'Username atau password salah');
        redirect('login');
    }
    
    // Verify password
    if (!password_verify($password, $user['password'])) {
        setFlash('error', 'Username atau password salah');
        redirect('login');
    }
    
    // Set session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['full_name'] = $user['full_name'];
    
    setFlash('success', 'Login berhasil! Selamat datang, ' . $user['full_name']);
    redirect('dashboard');
}

// ============================================
// REGISTER
// ============================================
if ($action === 'register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $full_name = clean($_POST['full_name'] ?? '');
    $username = clean($_POST['username'] ?? '');
    $email = clean($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    // Validasi
    $errors = [];
    
    if (empty($full_name)) $errors[] = 'Nama lengkap wajib diisi';
    if (empty($username)) $errors[] = 'Username wajib diisi';
    if (empty($email)) $errors[] = 'Email wajib diisi';
    if (empty($password)) $errors[] = 'Password wajib diisi';
    
    if (strlen($username) < 3 || strlen($username) > 20) {
        $errors[] = 'Username harus 3-20 karakter';
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email tidak valid';
    }
    
    if (strlen($password) < 6) {
        $errors[] = 'Password minimal 6 karakter';
    }
    
    if ($password !== $confirm_password) {
        $errors[] = 'Password dan konfirmasi password tidak cocok';
    }
    
    // Cek username sudah ada
    $existingUser = dbFetch(
        "SELECT id FROM users WHERE username = ? LIMIT 1",
        [$username],
        "s"
    );
    
    if ($existingUser) {
        $errors[] = 'Username sudah digunakan';
    }
    
    // Cek email sudah ada
    $existingEmail = dbFetch(
        "SELECT id FROM users WHERE email = ? LIMIT 1",
        [$email],
        "s"
    );
    
    if ($existingEmail) {
        $errors[] = 'Email sudah terdaftar';
    }
    
    // Jika ada error
    if (!empty($errors)) {
        setFlash('error', implode('<br>', $errors));
        redirect('register');
    }
    
    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
    // Insert user baru
    $stmt = dbQuery(
        "INSERT INTO users (username, email, password, full_name, role) VALUES (?, ?, ?, ?, 'user')",
        [$username, $email, $hashedPassword, $full_name],
        "ssss"
    );
    
    if ($stmt->affected_rows > 0) {
        setFlash('success', 'Registrasi berhasil! Silakan login');
        redirect('login');
    } else {
        setFlash('error', 'Terjadi kesalahan. Coba lagi');
        redirect('register');
    }
}

// ============================================
// LOGOUT
// ============================================
if ($action === 'logout') {
    session_destroy();
    redirect('home');
}

// Redirect jika akses langsung
redirect('home');
