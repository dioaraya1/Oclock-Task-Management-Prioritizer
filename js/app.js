/* ============================================================
   js/app.js — Shared: Nav, Hamburger, Toast
   ============================================================ */

document.addEventListener('DOMContentLoaded', () => {

    // ─── Highlight active nav link ──────────────────────────
    const page = window.location.pathname.split('/').pop();
    document.querySelectorAll('.sidebar nav a').forEach(a => {
        if (a.getAttribute('href') === page) a.classList.add('active');
    });

    // ─── Mobile hamburger ───────────────────────────────────
    const hamburger = document.querySelector('.hamburger');
    const sidebar   = document.querySelector('.sidebar');
    const overlay   = document.querySelector('.overlay');

    if (hamburger && sidebar && overlay) {
        hamburger.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
        });

        // Close sidebar when a nav link is clicked (mobile)
        sidebar.querySelectorAll('nav a').forEach(a => {
            a.addEventListener('click', () => {
                sidebar.classList.remove('open');
                overlay.classList.remove('active');
            });
        });
    }
});

/* ─── Toast Helper (global) ────────────────────────────────── */
window.showToast = function(message, type = 'success') {
    // Remove existing toast
    const existing = document.querySelector('.toast');
    if (existing) existing.remove();

    const toast = document.createElement('div');
    toast.className = 'toast ' + type;
    toast.textContent = message;
    document.body.appendChild(toast);

    // Show
    requestAnimationFrame(() => {
        requestAnimationFrame(() => toast.classList.add('show'));
    });

    // Auto-hide after 2.8s
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 350);
    }, 2800);
};
