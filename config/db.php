<?php
// ============================================================
// config/db.php — Database Connection (Docker)
// ============================================================
// Koneksi ke MySQL container dengan hostname 'db'
// Kredensial sesuai docker-compose.yml
// ============================================================

define('DB_HOST', 'db');              // ← hostname MySQL container
define('DB_NAME', 'taskflow');
define('DB_USER', 'taskflow_user');
define('DB_PASS', 'taskflow_pass');

function getDB(): PDO {
    static $pdo = null;
    if ($pdo) return $pdo;

    try {
        $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
            DB_USER,
            DB_PASS,
            [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]
        );
    } catch (PDOException $e) {
        $msg = htmlspecialchars($e->getMessage());
        die(<<<HTML
        <div style="font-family:'Segoe UI',sans-serif;max-width:560px;margin:60px auto;
                    background:#fef2f2;border:1px solid #fca5a5;border-radius:12px;padding:36px;">
            <h3 style="color:#991b1b;margin-top:0;">❌ Gagal Terhubung ke Database</h3>
            <p style="color:#7f1d1d;font-size:14px;">$msg</p>
            <hr style="border-color:#fca5a5;">
            <p style="color:#991b1b;font-size:13px;line-height:1.7;">
                <strong>Checklist Docker:</strong><br>
                ✓ Container MySQL sudah running? (<code>docker ps</code>)<br>
                ✓ Database <code>taskflow</code> sudah ada?<br>
                ✓ Tunggu 10-15 detik setelah <code>docker-compose up</code> untuk MySQL init
            </p>
        </div>
        HTML);
    }
    return $pdo;
}
