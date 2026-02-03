/* ============================================================
   js/profile.js — Load + Update Profile
   ============================================================ */

document.addEventListener('DOMContentLoaded', async () => {
    await loadProfile();
    bindProfileEvents();
});

// ─── Load profile dari API ──────────────────────────────────
async function loadProfile() {
    const res  = await fetch('api/profile.php?action=get');
    const user = await res.json();

    if (user.error) { console.warn(user.error); return; }

    // Sidebar info
    document.getElementById('prof-avatar').style.backgroundColor = user.avatar_color;
    document.getElementById('prof-avatar').textContent = initials(user.full_name || user.username);
    document.getElementById('prof-name').textContent     = user.full_name || user.username;
    document.getElementById('prof-username').textContent = '@' + user.username;
    document.getElementById('prof-bio').textContent      = user.bio || 'Belum ada bio.';
    document.getElementById('prof-joined').textContent   = 'Bergabung ' + formatDate(user.created_at);

    // Form fields
    document.getElementById('input-fullname').value      = user.full_name || '';
    document.getElementById('input-email').value         = user.email || '';
    document.getElementById('input-bio').value           = user.bio || '';
    document.getElementById('input-avatar-color').value  = user.avatar_color || '#6366f1';
    document.getElementById('color-preview').style.backgroundColor = user.avatar_color || '#6366f1';
}

// ─── Bind events ────────────────────────────────────────────
function bindProfileEvents() {
    // Live color preview
    document.getElementById('input-avatar-color').addEventListener('input', (e) => {
        document.getElementById('color-preview').style.backgroundColor = e.target.value;
    });

    // Update profile
    document.getElementById('btn-update-profile').addEventListener('click', updateProfile);

    // Change password
    document.getElementById('btn-change-password').addEventListener('click', changePassword);
}

// ─── Update Profile ─────────────────────────────────────────
async function updateProfile() {
    const formData = new FormData();
    formData.append('action',       'update');
    formData.append('full_name',    document.getElementById('input-fullname').value.trim());
    formData.append('email',        document.getElementById('input-email').value.trim());
    formData.append('bio',          document.getElementById('input-bio').value.trim());
    formData.append('avatar_color', document.getElementById('input-avatar-color').value);

    const res  = await fetch('api/profile.php', { method:'POST', body: formData });
    const data = await res.json();

    if (data.error) { showToast(data.error, 'error'); return; }

    showToast(data.message, 'success');

    // Sync sidebar avatar
    const color = document.getElementById('input-avatar-color').value;
    document.getElementById('prof-avatar').style.backgroundColor = color;
    document.getElementById('prof-name').textContent = document.getElementById('input-fullname').value.trim() || document.getElementById('prof-username').textContent;
    document.getElementById('prof-bio').textContent  = document.getElementById('input-bio').value.trim() || 'Belum ada bio.';

    // Update global sidebar too
    const sideAvatar = document.querySelector('.sidebar .avatar-sm');
    if (sideAvatar) sideAvatar.style.backgroundColor = color;
}

// ─── Change Password ────────────────────────────────────────
async function changePassword() {
    const cur = document.getElementById('input-cur-pw').value;
    const nw  = document.getElementById('input-new-pw').value;
    const con = document.getElementById('input-con-pw').value;

    const formData = new FormData();
    formData.append('action',           'change_password');
    formData.append('current_password', cur);
    formData.append('new_password',     nw);
    formData.append('confirm_password', con);

    const res  = await fetch('api/profile.php', { method:'POST', body: formData });
    const data = await res.json();

    if (data.error) { showToast(data.error, 'error'); return; }

    showToast(data.message, 'success');
    // Clear fields
    document.getElementById('input-cur-pw').value = '';
    document.getElementById('input-new-pw').value = '';
    document.getElementById('input-con-pw').value = '';
}

// ─── Helpers ────────────────────────────────────────────────
function initials(name) {
    if (!name) return '?';
    return name.split(' ').map(w => w[0]).join('').slice(0,2).toUpperCase();
}

function formatDate(dateStr) {
    if (!dateStr) return '—';
    const d = new Date(dateStr);
    return d.toLocaleDateString('id-ID', { day:'numeric', month:'long', year:'numeric' });
}
