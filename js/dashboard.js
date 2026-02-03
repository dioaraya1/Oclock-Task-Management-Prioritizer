/* ============================================================
   js/dashboard.js — Isi Dashboard dari API
   ============================================================ */

document.addEventListener('DOMContentLoaded', async () => {
    try {
        const res  = await fetch('api/dashboard.php');
        const data = await res.json();

        if (data.error) { console.warn(data.error); return; }

        const { total, byStatus, byPriority, recent } = data;

        // ─── Stat Cards ───────────────────────────────────
        setText('#stat-total',      total);
        setText('#stat-pending',    byStatus['Pending']);
        setText('#stat-inprogress', byStatus['In Progress']);
        setText('#stat-done',       byStatus['Done']);

        // ─── Priority Bars ────────────────────────────────
        const priTotal = (byPriority['High']||0) + (byPriority['Medium']||0) + (byPriority['Low']||0);
        setPriBar('high', byPriority['High']   || 0, priTotal);
        setPriBar('med',  byPriority['Medium'] || 0, priTotal);
        setPriBar('low',  byPriority['Low']    || 0, priTotal);

        // ─── Status Bars ──────────────────────────────────
        setStatusBar('pending',    byStatus['Pending'],     total);
        setStatusBar('inprogress', byStatus['In Progress'], total);
        setStatusBar('done',       byStatus['Done'],        total);

        // ─── Recent Tasks ─────────────────────────────────
        const container = document.getElementById('recent-tasks');
        if (recent.length === 0) {
            container.innerHTML = '<div class="empty-state">Belum ada tugas. Tambahkan tugas pertama Anda!</div>';
            return;
        }

        container.innerHTML = recent.map(t => `
            <div class="recent-task-item">
                <span class="badge ${priBadgeClass(t.priority_label)}">${t.priority_label}</span>
                <span class="task-title">${escHtml(t.title)}</span>
                <span class="badge ${statusBadgeClass(t.status)}">${t.status}</span>
                <span class="task-deadline">${formatDate(t.deadline)}</span>
            </div>
        `).join('');

    } catch (e) {
        console.error('Dashboard fetch error:', e);
    }
});

// ─── Helpers ────────────────────────────────────────────────
function setText(selector, value) {
    const el = document.querySelector(selector);
    if (el) el.textContent = value;
}

function setPriBar(key, count, total) {
    const pct = total > 0 ? (count / total) * 100 : 0;
    const fill  = document.querySelector(`.pri-bar-fill.${key}`);
    const cnt   = document.querySelector(`.pri-bar-count.${key}`);
    if (fill) { fill.style.width = pct + '%'; }
    if (cnt)  { cnt.textContent  = count; }
}

function setStatusBar(key, count, total) {
    const pct  = total > 0 ? (count / total) * 100 : 0;
    const fill = document.querySelector(`.status-bar-fill.${key}`);
    const cnt  = document.querySelector(`.status-bar-count.${key}`);
    if (fill) { fill.style.width = pct + '%'; }
    if (cnt)  { cnt.textContent  = count; }
}

function priBadgeClass(label) {
    return { High: 'pri-high', Medium: 'pri-med', Low: 'pri-low' }[label] || 'pri-low';
}

function statusBadgeClass(status) {
    return { Pending: 'st-pending', 'In Progress': 'st-inprogress', Done: 'st-done' }[status] || 'st-pending';
}

function formatDate(dateStr) {
    if (!dateStr) return '—';
    const d = new Date(dateStr + 'T00:00:00');
    return d.toLocaleDateString('id-ID', { day:'numeric', month:'short', year:'numeric' });
}

function escHtml(s) {
    const d = document.createElement('div');
    d.appendChild(document.createTextNode(s));
    return d.innerHTML;
}
