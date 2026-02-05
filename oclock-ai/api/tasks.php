<?php
// ============================================================
// api/tasks.php — CRUD Tasks + K-Means (3 Parameter)
// ============================================================

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../config/kmeans.php';

header('Content-Type: application/json');

if (!isLoggedIn()) { echo json_encode(['error' => 'Belum login']); exit; }

$userId = getSessionUser()['id'];
$action  = $_POST['action'] ?? $_GET['action'] ?? 'list';

match($action) {
    'list'   => listTasks($userId),
    'save'   => saveTask($userId),
    'delete' => deleteTask($userId),
    'status' => updateStatus($userId),
    default  => listTasks($userId),
};

// ─── LIST ───────────────────────────────────────────────────
function listTasks(int $uid): void {
    $stmt = getDB()->prepare(
        "SELECT * FROM tasks WHERE user_id = ? ORDER BY priority DESC, deadline ASC"
    );
    $stmt->execute([$uid]);
    echo json_encode($stmt->fetchAll());
}

// ─── SAVE (insert / update + K-Means 3D) ────────────────────
function saveTask(int $uid): void {
    $db = getDB();

    $id         = (int)($_POST['id'] ?? 0);
    $title      = trim($_POST['title'] ?? '');
    $desc       = trim($_POST['description'] ?? '');
    $difficulty = trim($_POST['difficulty'] ?? 'Medium');
    $importance = trim($_POST['importance'] ?? 'Medium');
    $deadline   = trim($_POST['deadline'] ?? '');
    $status     = trim($_POST['status'] ?? 'Pending');

    // Validasi
    if ($title === '')    { echo json_encode(['error' => 'Judul wajib diisi.']); return; }
    if ($deadline === '') { echo json_encode(['error' => 'Deadline wajib diisi.']); return; }
    if (!in_array($difficulty, ['Easy','Medium','Hard'])) {
        echo json_encode(['error' => 'Difficulty tidak valid.']); return;
    }
    if (!in_array($importance, ['Low','Medium','High'])) {
        echo json_encode(['error' => 'Importance tidak valid.']); return;
    }

    // ── Ambil task lain (exclude yang sedang diedit) ──
    $query = $id > 0
        ? "SELECT deadline, difficulty, importance FROM tasks WHERE user_id = ? AND id != ?"
        : "SELECT deadline, difficulty, importance FROM tasks WHERE user_id = ?";

    $stmt = $db->prepare($query);
    $id > 0 ? $stmt->execute([$uid, $id]) : $stmt->execute([$uid]);
    $existing = $stmt->fetchAll();

    // ── Jalankan K-Means 3D ──
    $result   = KMeans::classify($existing, $deadline, $difficulty, $importance);
    $priority = $result['priority'];
    $label    = $result['label'];

    // ── Insert atau Update ──
    if ($id > 0) {
        $db->prepare(
            "UPDATE tasks SET title=?,description=?,difficulty=?,importance=?,deadline=?,priority=?,priority_label=?,status=?,updated_at=NOW()
             WHERE id=? AND user_id=?"
        )->execute([$title, $desc, $difficulty, $importance, $deadline, $priority, $label, $status, $id, $uid]);

        echo json_encode([
            'success'=>true,'message'=>'Tugas diperbarui!',
            'priority'=>$priority,'priority_label'=>$label
        ]);
    } else {
        $db->prepare(
            "INSERT INTO tasks (user_id,title,description,difficulty,importance,deadline,priority,priority_label,status)
             VALUES (?,?,?,?,?,?,?,?,?)"
        )->execute([$uid, $title, $desc, $difficulty, $importance, $deadline, $priority, $label, $status]);

        echo json_encode([
            'success'=>true,'message'=>'Tugas ditambahkan!',
            'id'=>(int)$db->lastInsertId(),'priority'=>$priority,'priority_label'=>$label
        ]);
    }
}

// ─── DELETE ─────────────────────────────────────────────────
function deleteTask(int $uid): void {
    $id = (int)($_POST['id'] ?? 0);
    if ($id === 0) { echo json_encode(['error'=>'ID tidak valid.']); return; }

    $stmt = getDB()->prepare("DELETE FROM tasks WHERE id=? AND user_id=?");
    $stmt->execute([$id, $uid]);
    echo $stmt->rowCount() > 0
        ? json_encode(['success'=>true,'message'=>'Tugas dihapus.'])
        : json_encode(['error'=>'Tugas tidak ditemukan.']);
}

// ─── UPDATE STATUS ──────────────────────────────────────────
function updateStatus(int $uid): void {
    $id     = (int)($_POST['id'] ?? 0);
    $status = trim($_POST['status'] ?? '');

    if ($id === 0 || $status === '') { echo json_encode(['error'=>'Data tidak lengkap.']); return; }

    getDB()->prepare(
        "UPDATE tasks SET status=?,updated_at=NOW() WHERE id=? AND user_id=?"
    )->execute([$status, $id, $uid]);

    echo json_encode(['success'=>true,'message'=>'Status diperbarui.']);
}
