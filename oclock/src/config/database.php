<?php
// src/config/database.php
// Konfigurasi koneksi MySQL

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'oclock_db');

// Fungsi koneksi database
function getDB() {
    static $conn = null;
    
    if ($conn === null) {
        try {
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
            if ($conn->connect_error) {
                throw new Exception("Connection failed: " . $conn->connect_error);
            }
            
            $conn->set_charset("utf8mb4");
        } catch (Exception $e) {
            die("Database Error: " . $e->getMessage());
        }
    }
    
    return $conn;
}

// Helper untuk prepared statements
function dbQuery($sql, $params = [], $types = "") {
    $db = getDB();
    $stmt = $db->prepare($sql);
    
    if ($params && $types) {
        $stmt->bind_param($types, ...$params);
    }
    
    $stmt->execute();
    return $stmt;
}

function dbFetch($sql, $params = [], $types = "") {
    $stmt = dbQuery($sql, $params, $types);
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function dbFetchAll($sql, $params = [], $types = "") {
    $stmt = dbQuery($sql, $params, $types);
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}
