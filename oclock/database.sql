-- =====================================================
-- OClock Database Schema
-- Aplikasi Manajemen Tugas dengan K-Means Clustering
-- =====================================================

CREATE DATABASE IF NOT EXISTS oclock_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE oclock_db;

-- =====================================================
-- Table: users
-- =====================================================
DROP TABLE IF EXISTS tasks;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL COMMENT 'Bcrypt hashed password',
    full_name VARCHAR(100) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_username (username),
    INDEX idx_email (email),
    INDEX idx_role (role)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =====================================================
-- Table: tasks
-- =====================================================
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    
    -- 4 Parameter untuk K-Means Clustering
    deadline DATE NOT NULL COMMENT 'Tanggal deadline',
    importance ENUM('rendah', 'sedang', 'tinggi') DEFAULT 'sedang' COMMENT 'Tingkat kepentingan',
    duration INT NOT NULL COMMENT 'Estimasi pengerjaan (jam)',
    difficulty ENUM('mudah', 'sedang', 'sulit') DEFAULT 'sedang' COMMENT 'Tingkat kesulitan',
    
    -- Hasil K-Means
    priority ENUM('rendah', 'sedang', 'tinggi') DEFAULT 'sedang' COMMENT 'Hasil clustering',
    
    status ENUM('belum', 'proses', 'selesai') DEFAULT 'belum',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user (user_id),
    INDEX idx_priority (priority),
    INDEX idx_status (status),
    INDEX idx_deadline (deadline)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =====================================================
-- Default Users (Password: admin123 dan user123)
-- =====================================================

-- Admin Account
INSERT INTO users (username, email, password, full_name, role) VALUES
('admin', 'admin@oclock.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'admin');

-- Regular User
INSERT INTO users (username, email, password, full_name, role) VALUES
('user', 'user@oclock.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Demo User', 'user');

-- =====================================================
-- Sample Tasks (untuk demo)
-- =====================================================

INSERT INTO tasks (user_id, title, description, deadline, importance, duration, difficulty, priority, status) VALUES
-- User 2 (Regular User) Tasks
(2, 'Belajar K-Means Clustering', 'Memahami algoritma K-Means untuk menghitung prioritas tugas otomatis', DATE_ADD(CURDATE(), INTERVAL 2 DAY), 'tinggi', 5, 'sedang', 'tinggi', 'proses'),
(2, 'Setup Development Environment', 'Install XAMPP, VS Code, dan konfigurasi PHP', DATE_ADD(CURDATE(), INTERVAL 7 DAY), 'sedang', 3, 'mudah', 'sedang', 'belum'),
(2, 'Membuat Dokumentasi API', 'Dokumentasi endpoint REST API menggunakan Postman', DATE_ADD(CURDATE(), INTERVAL 14 DAY), 'rendah', 8, 'mudah', 'rendah', 'belum'),
(2, 'Code Review Backend', 'Review kode PHP backend dan perbaiki bug', DATE_ADD(CURDATE(), INTERVAL 1 DAY), 'tinggi', 4, 'sulit', 'tinggi', 'belum'),
(2, 'Update Database Schema', 'Tambah kolom baru dan index untuk performa', DATE_ADD(CURDATE(), INTERVAL 10 DAY), 'rendah', 2, 'mudah', 'rendah', 'selesai');

-- Admin Tasks
INSERT INTO tasks (user_id, title, description, deadline, importance, duration, difficulty, priority, status) VALUES
(1, 'Monitoring Server', 'Cek performa server dan database', DATE_ADD(CURDATE(), INTERVAL 1 DAY), 'tinggi', 2, 'mudah', 'tinggi', 'proses');

-- =====================================================
-- Queries untuk Testing (uncomment jika perlu)
-- =====================================================

-- Lihat semua users
-- SELECT * FROM users;

-- Lihat semua tasks dengan info user
-- SELECT t.*, u.username, u.full_name 
-- FROM tasks t 
-- JOIN users u ON t.user_id = u.id
-- ORDER BY t.priority DESC, t.deadline ASC;

-- Statistik per user
-- SELECT 
--     u.username,
--     u.full_name,
--     COUNT(t.id) as total_tasks,
--     SUM(CASE WHEN t.status = 'selesai' THEN 1 ELSE 0 END) as completed,
--     SUM(CASE WHEN t.priority = 'tinggi' THEN 1 ELSE 0 END) as high_priority
-- FROM users u
-- LEFT JOIN tasks t ON u.id = t.user_id
-- GROUP BY u.id;

-- Tasks yang akan deadline (3 hari ke depan)
-- SELECT * FROM tasks 
-- WHERE deadline <= DATE_ADD(CURDATE(), INTERVAL 3 DAY)
-- AND status != 'selesai'
-- ORDER BY deadline ASC;
