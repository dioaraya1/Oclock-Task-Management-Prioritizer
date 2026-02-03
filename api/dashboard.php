<?php
// ============================================================
// api/dashboard.php — Statistik Dashboard
// ============================================================

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/session.php';

header('Content-Type: application/json');

if (!isLoggedIn()) { echo json_encode(['error'=>'Belum login']); exit; }

$uid = getSessionUser()['id'];
$db  = getDB();

// Total tasks
$total = (int)$db->prepare("SELECT COUNT(*) as c FROM tasks WHERE user_id=?")
    ->execute([$uid]) ?: 0;
$stmt = $db->prepare("SELECT COUNT(*) as c FROM tasks WHERE user_id=?");
$stmt->execute([$uid]);
$total = (int)$stmt->fetch()['c'];

// By status
$byStatus = ['Pending'=>0,'In Progress'=>0,'Done'=>0];
$stmt = $db->prepare(
    "SELECT status, COUNT(*) as c FROM tasks WHERE user_id=? GROUP BY status"
);
$stmt->execute([$uid]);
foreach ($stmt->fetchAll() as $row) $byStatus[$row['status']] = (int)$row['c'];

// By priority
$byPriority = ['Low'=>0,'Medium'=>0,'High'=>0];
$stmt = $db->prepare(
    "SELECT priority_label, COUNT(*) as c FROM tasks WHERE user_id=? GROUP BY priority_label"
);
$stmt->execute([$uid]);
foreach ($stmt->fetchAll() as $row) $byPriority[$row['priority_label']] = (int)$row['c'];

// 5 task terbaru
$stmt = $db->prepare(
    "SELECT * FROM tasks WHERE user_id=? ORDER BY created_at DESC LIMIT 5"
);
$stmt->execute([$uid]);
$recent = $stmt->fetchAll();

echo json_encode([
    'total'      => $total,
    'byStatus'   => $byStatus,
    'byPriority' => $byPriority,
    'recent'     => $recent,
]);
