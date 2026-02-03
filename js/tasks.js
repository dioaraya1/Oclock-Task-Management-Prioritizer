/* ============================================================
   js/tasks.js — Tasks Page (dengan Importance Parameter)
   ============================================================ */

let allTasks = [];
let currentFilter = 'All';

document.addEventListener('DOMContentLoaded', async () => {
    await loadTasks();
    bindEvents();
});

// ─── Load tasks ─────────────────────────────────────────────
async function loadTasks() {
    const res   = await fetch('api/tasks.php?action=list');
    allTasks    = await res.json();
    renderTasks();
}

// ─── Render task cards ──────────────────────────────────────
function renderTasks() {
    const container = document.getElementById('task-list');
    let filtered = allTasks;

    if (currentFilter !== 'All') {
        filtered = allTasks.filter(t => t.status === currentFilter);
    }

    if (filtered.length === 0) {
        container.innerHTML = '<div class="empty-state">Tidak ada tugas' +
            (currentFilter !== 'All' ? ' dengan status ' + currentFilter : '') + '.</div>';
        return;
    }

    container.innerHTML = filtered.map(t => {
        const isOverdue = t.status !== 'Done' && new Date(t.deadline + 'T00:00:00') < new Date();
        return `
        <div class="task-card" data-id="${t.id}" onclick="openEdit(${t.id})">
            <div class="task-main">
                <div class="task-title">${escHtml(t.title)}</div>
                ${t.description ? `<div class="task-desc">${escHtml(t.description)}</div>` : ''}
                <div class="task-meta">
                    <span class="badge ${priBadge(t.priority_label)}">${t.priority_label}</span>
                    <span class="badge ${statusBadge(t.status)}">${t.status}</span>
                    <span class="badge" style="background:#f0fdf4;color:#166534;" title="Difficulty">${t.difficulty}</span>
                    <span class="badge" style="background:#fef3c7;color:#92400e;" title="Importance">⚡ ${t.importance}</span>
                    <span class="deadline-text ${isOverdue ? 'overdue' : ''}">
                        📅 ${formatDate(t.deadline)}${isOverdue ? ' · Lewat!' : ''}
                    </span>
                </div>
            </div>
            <div class="task-actions" onclick="event.stopPropagation()">
                <button class="btn-icon" onclick="openEdit(${t.id})" title="Edit">✏️</button>
                <button class="btn-icon del" onclick="deleteTask(${t.id})" title="Hapus">🗑️</button>
            </div>
        </div>`;
    }).join('');
}

// ─── Event bindings ─────────────────────────────────────────
function bindEvents() {
    // Filter buttons
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            currentFilter = btn.dataset.filter;
            renderTasks();
        });
    });

    // Add button
    document.getElementById('btn-add-task').addEventListener('click', () => openModal());

    // Modal close
    document.getElementById('modal-close').addEventListener('click', closeModal);
    document.getElementById('modal-backdrop').addEventListener('click', (e) => {
        if (e.target === e.currentTarget) closeModal();
    });

    // Form submit
    document.getElementById('task-form').addEventListener('submit', saveTask);
}

// ─── Modal ──────────────────────────────────────────────────
function openModal(task = null) {
    const modal = document.getElementById('modal-backdrop');
    const title = document.getElementById('modal-title');
    const form  = document.getElementById('task-form');

    if (task) {
        title.textContent = 'Edit Tugas';
        document.getElementById('task-id').value          = task.id;
        document.getElementById('task-title').value       = task.title;
        document.getElementById('task-description').value = task.description || '';
        document.getElementById('task-difficulty').value  = task.difficulty;
        document.getElementById('task-importance').value  = task.importance;
        document.getElementById('task-deadline').value    = task.deadline;
        document.getElementById('task-status').value      = task.status;
    } else {
        title.textContent = 'Tambah Tugas Baru';
        form.reset();
        document.getElementById('task-id').value = 0;
        // Default deadline: besok
        const tmrw = new Date(); tmrw.setDate(tmrw.getDate() + 1);
        document.getElementById('task-deadline').value = tmrw.toISOString().slice(0,10);
    }

    modal.classList.add('active');
}

function openEdit(id) {
    const task = allTasks.find(t => t.id === id);
    if (task) openModal(task);
}

function closeModal() {
    document.getElementById('modal-backdrop').classList.remove('active');
}

// ─── Save (kirim 3 parameter ke K-Means) ────────────────────
async function saveTask(e) {
    e.preventDefault();

    const formData = new FormData();
    formData.append('action',      'save');
    formData.append('id',          document.getElementById('task-id').value);
    formData.append('title',       document.getElementById('task-title').value.trim());
    formData.append('description', document.getElementById('task-description').value.trim());
    formData.append('difficulty',  document.getElementById('task-difficulty').value);
    formData.append('importance',  document.getElementById('task-importance').value);
    formData.append('deadline',    document.getElementById('task-deadline').value);
    formData.append('status',      document.getElementById('task-status').value);

    const res  = await fetch('api/tasks.php', { method: 'POST', body: formData });
    const data = await res.json();

    if (data.error) {
        showToast(data.error, 'error');
        return;
    }

    showToast(data.message + ' Prioritas: ' + data.priority_label, 'success');
    closeModal();
    await loadTasks();
}

// ─── Delete ─────────────────────────────────────────────────
async function deleteTask(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus tugas ini?')) return;

    const formData = new FormData();
    formData.append('action', 'delete');
    formData.append('id',     id);

    const res  = await fetch('api/tasks.php', { method: 'POST', body: formData });
    const data = await res.json();

    if (data.success) {
        showToast('Tugas dihapus.', 'success');
        await loadTasks();
    } else {
        showToast(data.error || 'Gagal menghapus.', 'error');
    }
}

// ─── Helpers ────────────────────────────────────────────────
function priBadge(label) {
    return { High:'pri-high', Medium:'pri-med', Low:'pri-low' }[label] || 'pri-low';
}
function statusBadge(status) {
    return { Pending:'st-pending', 'In Progress':'st-inprogress', Done:'st-done' }[status] || 'st-pending';
}
function formatDate(d) {
    if (!d) return '—';
    return new Date(d+'T00:00:00').toLocaleDateString('id-ID',{day:'numeric',month:'short',year:'numeric'});
}
function escHtml(s) {
    const d = document.createElement('div');
    d.appendChild(document.createTextNode(s));
    return d.innerHTML;
}
