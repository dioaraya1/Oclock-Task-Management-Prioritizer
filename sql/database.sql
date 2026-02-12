CREATE DATABASE IF NOT EXISTS oclockdb;
USE oclockdb;

-- tabel user
CREATE TABLE if not exists users (
  id INT auto_increment PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  role enum('admin', , 'user') DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- tabel task
CREATE TABLE if not exists tasks (
  id INT auto_increment PRIMARY KEY,
  user_id INT,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  deadline DATE NOT NULL
  importance enum('Rendah', 'Sedang', 'Tinggi') NOT NULL,
  estimation INT not NULL COMMENT 'Estimasi waktu dalam menit',
  difficulty enum('Mudah', 'Sedang', 'Sulit') NOT NULL,
  priority_cluster INT DEFAULT 0,
  status enum('not_started', 'in_progress', 'completed') DEFAULT 'not_started',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  Foreign Key (user_id) REFERENCES (users(id)) on delete cascade
);

-- Insert admin default
INSERT INTO users (username, email, password, role) VALUES 
('admin', 'admin@task.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Insert user demo
INSERT INTO users (username, email, password, role) VALUES 
('demo', 'demo@task.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user');
-- Password untuk semua akun demo: password