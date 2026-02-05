-- ============================================================
--  TaskFlow — Database Schema (Docker Version)
--  File ini otomatis dijalankan saat container MySQL pertama kali dibuat.
-- ============================================================

CREATE DATABASE IF NOT EXISTS taskflow
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE taskflow;

-- -----------------------------------------------------------
-- users
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS users (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    username      VARCHAR(50)  NOT NULL UNIQUE,
    email         VARCHAR(100) NOT NULL UNIQUE,
    password      VARCHAR(255) NOT NULL,
    full_name     VARCHAR(100) DEFAULT '',
    bio           TEXT,
    avatar_color  VARCHAR(7)   DEFAULT '#6366f1',
    created_at    DATETIME     DEFAULT CURRENT_TIMESTAMP,
    updated_at    DATETIME     DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------------------------------------------
-- tasks (dengan field importance tambahan)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS tasks (
    id             INT AUTO_INCREMENT PRIMARY KEY,
    user_id        INT          NOT NULL,
    title          VARCHAR(200) NOT NULL,
    description    TEXT,
    difficulty     ENUM('Easy','Medium','Hard') NOT NULL DEFAULT 'Medium',
    importance     ENUM('Low','Medium','High')  NOT NULL DEFAULT 'Medium',
    deadline       DATE         NOT NULL,
    priority       TINYINT      NOT NULL DEFAULT 1,
    priority_label VARCHAR(10)  NOT NULL DEFAULT 'Low',
    status         ENUM('Pending','In Progress','Done') NOT NULL DEFAULT 'Pending',
    created_at     DATETIME     DEFAULT CURRENT_TIMESTAMP,
    updated_at     DATETIME     DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user   (user_id),
    INDEX idx_status (status),
    INDEX idx_pri    (priority)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------------------------------------------
-- Sample admin user
-- Password: password123
-- Hash ini akan di-update oleh setup_admin.php
-- -----------------------------------------------------------
INSERT IGNORE INTO users (username, email, password, full_name, bio, avatar_color)
VALUES (
    'admin',
    'admin@taskflow.local',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    'Administrator',
    'Akun demo TaskFlow dengan Docker.',
    '#6366f1'
);
