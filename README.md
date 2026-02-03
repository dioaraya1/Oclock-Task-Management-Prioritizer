# 🐳 TaskFlow — Docker Edition

Aplikasi manajemen tugas dengan **K-Means Clustering 3D** untuk klasifikasi prioritas otomatis.

---

## 📋 Fitur Utama

- ✅ Manajemen tugas (CRUD) dengan status tracking
- 🧠 **K-Means 3D Clustering** — prioritas dihitung dari 3 parameter:
  - **Urgency** (kedekatan deadline)
  - **Difficulty** (Easy / Medium / Hard)
  - **Importance** (Low / Medium / High)
- 📊 Dashboard dengan statistik dan grafik distribusi
- 👤 Manajemen profil dengan avatar warna custom
- 🔐 Autentikasi aman dengan bcrypt password hashing
- 📱 Responsive design — mobile-first UI
- 🐳 **Full Docker setup** — satu perintah langsung jalan

---

## 🚀 Quick Start (3 Langkah)

### 1️⃣ Clone / Extract Project

```bash
# Jika dari zip:
unzip taskflow.zip
cd taskflow-docker

# Atau clone dari repo (jika ada):
# git clone <repo-url>
# cd taskflow-docker
```

### 2️⃣ Jalankan Docker

```bash
docker-compose up -d
```

Tunggu 10-15 detik untuk MySQL initialization.

### 3️⃣ Setup Admin User

Buka browser → `http://localhost:8080/setup_admin.php`

File ini akan:
- Membuat hash bcrypt yang benar untuk password admin
- Menghapus dirinya sendiri secara otomatis

✅ **Selesai!** Buka `http://localhost:8080/` dan login:
- **Username:** `admin`
- **Password:** `password123`

---

## 📁 Struktur Project

```
taskflow-docker/
│
├── docker-compose.yml         ← Orchestration (Web + DB + phpMyAdmin)
├── Dockerfile                 ← PHP 8.2 Apache image
├── database.sql               ← Schema MySQL (auto-load)
├── setup_admin.php            ← One-time setup (jalankan sekali)
│
├── config/
│   ├── db.php                 ← Koneksi PDO MySQL
│   ├── session.php            ← Session management
│   ├── kmeans.php             ← Algoritma K-Means 3D
│   └── nav.php                ← Sidebar/topbar partial
│
├── auth/
│   └── handle.php             ← Login / Register / Logout handler
│
├── api/
│   ├── tasks.php              ← CRUD Tasks + K-Means API
│   ├── profile.php            ← Get/Update Profile API
│   └── dashboard.php          ← Dashboard stats API
│
├── css/
│   └── style.css              ← Unified stylesheet (1130 lines)
│
├── js/
│   ├── app.js                 ← Shared: nav, toast, hamburger
│   ├── dashboard.js           ← Dashboard logic
│   ├── tasks.js               ← Tasks CRUD + modal
│   └── profile.js             ← Profile update + password change
│
├── index.php                  ← Entry point (auto-redirect)
├── login.php                  ← Login page
├── register.php               ← Register page
├── dashboard.php              ← Dashboard (stats + charts)
├── tasks.php                  ← Tasks list + modal
└── profile.php                ← User profile edit
```

**Total:** 24 file

---

## 🧠 Algoritma K-Means 3D

### Cara Kerja

Setiap tugas direpresentasikan sebagai titik di ruang **3 dimensi**:

```
Titik = (Urgency, Difficulty, Importance)

Urgency (X) → kedekatan deadline
  • 1.0 = deadline hari ini atau lewat
  • 0.0 = deadline ≥ 30 hari lagi
  • Formula: max(0, 1 - (days_left / 30))

Difficulty (Y) → tingkat kesulitan
  • Easy   = 0.33
  • Medium = 0.67
  • Hard   = 1.00

Importance (Z) → tingkat kepentingan
  • Low    = 0.33
  • Medium = 0.67
  • High   = 1.00
```

### Clustering Steps

1. **Ambil semua tugas user** dari database
2. **Konversi** setiap task menjadi feature vector 3D
3. **Tambahkan** task baru yang sedang disimpan ke dataset
4. **Jalankan K-Means** (K=3, max 100 iterasi)
   - Init centroids: spread across data
   - Assignment: assign setiap point ke centroid terdekat
   - Update: recalculate centroids
   - Repeat sampai konvergen
5. **Label clusters** berdasarkan kedekatan centroid ke corner:
   - Cluster terdekat ke `(1,1,1)` → **HIGH** priority
   - Cluster terdekat ke `(0,0,0)` → **LOW** priority
   - Sisanya → **MEDIUM** priority
6. **Assign priority** ke task baru sesuai cluster-nya

### Contoh

| Task | Deadline | Difficulty | Importance | Vector | Cluster | Priority |
|------|----------|------------|------------|--------|---------|----------|
| Buat laporan | Hari ini | Hard | High | `(1.0, 1.0, 1.0)` | Cluster A | **HIGH** |
| Email klien | 3 hari lagi | Easy | Medium | `(0.9, 0.33, 0.67)` | Cluster B | **MEDIUM** |
| Riset pasar | 20 hari lagi | Medium | Low | `(0.33, 0.67, 0.33)` | Cluster C | **LOW** |

---

## 🔧 Setup Detail (VS Code + Docker)

### Prerequisites

- **Docker Desktop** (Windows/Mac) atau Docker Engine (Linux)
- **VS Code** (opsional, untuk development)
- **Docker extension** untuk VS Code (opsional)

### Langkah Lengkap

#### 1. Install Docker

**Windows/Mac:**
- Download [Docker Desktop](https://www.docker.com/products/docker-desktop/)
- Install dan jalankan
- Tunggu sampai Docker icon di system tray berwarna hijau

**Linux (Ubuntu/Debian):**
```bash
sudo apt update
sudo apt install docker.io docker-compose
sudo systemctl start docker
sudo usermod -aG docker $USER
# Logout dan login ulang
```

#### 2. Extract Project

```bash
unzip taskflow.zip
cd taskflow-docker
```

#### 3. Buka di VS Code (opsional)

```bash
code .
```

Install extension **Docker** di VS Code untuk melihat container status.

#### 4. Start Containers

```bash
docker-compose up -d
```

**Apa yang terjadi?**
- Container `taskflow-web` (PHP 8.2 + Apache) → port 8080
- Container `taskflow-db` (MySQL 8.0) → port 3306
- Container `taskflow-phpmyadmin` → port 8081
- Volume `db-data` untuk persist MySQL data
- Network `taskflow-network` untuk komunikasi antar container
- File `database.sql` dijalankan otomatis saat MySQL pertama kali dibuat

**Cek status:**
```bash
docker ps
```

Anda harus melihat 3 container running:
```
CONTAINER ID   IMAGE               STATUS
xxxxx          taskflow-web        Up
xxxxx          mysql:8.0           Up
xxxxx          phpmyadmin:latest   Up
```

#### 5. Setup Admin User

Buka browser → `http://localhost:8080/setup_admin.php`

Klik link **"Pergi ke Login"** setelah setup selesai.

#### 6. Login

```
URL:      http://localhost:8080/
Username: admin
Password: password123
```

---

## 🛠️ Development Workflow

### Edit Code

Semua file di folder `taskflow-docker/` **langsung sync** ke container via Docker volume mount.

Artinya:
- Edit file `.php`, `.css`, `.js` di VS Code
- Simpan (Ctrl+S)
- Refresh browser (F5)
- ✅ Perubahan langsung terlihat — **tidak perlu restart container**

### Logs

```bash
# Web server logs
docker logs taskflow-web -f

# MySQL logs
docker logs taskflow-db -f
```

### phpMyAdmin

Buka `http://localhost:8081/` untuk melihat database via GUI.

**Login:**
- Server: `db`
- Username: `root`
- Password: `root123`

### Stop Containers

```bash
docker-compose down
```

### Start Ulang

```bash
docker-compose up -d
```

### Reset Database

```bash
docker-compose down -v        # hapus volume
docker-compose up -d          # recreate (database.sql dijalankan ulang)
```

---

## 📖 Penjelasan File Penting

### `docker-compose.yml`

Mendefinisikan 3 services:
- `web` → PHP Apache (build dari Dockerfile)
- `db` → MySQL (image official)
- `phpmyadmin` → GUI database

### `Dockerfile`

Base image: `php:8.2-apache`
- Install PDO MySQL extension
- Enable mod_rewrite
- Copy semua file ke `/var/www/html/`

### `config/kmeans.php`

Class `KMeans` dengan method `classify()`:
- Input: array tasks, deadline, difficulty, importance
- Output: `['priority' => 1|2|3, 'label' => 'Low'|'Medium'|'High']`
- Algoritma: K-Means 3D dengan K=3, max 100 iterasi

### `api/tasks.php`

POST `/api/tasks.php?action=save`:
1. Validasi input
2. Ambil semua task user (exclude yang diedit)
3. Panggil `KMeans::classify($tasks, $deadline, $diff, $imp)`
4. Simpan task dengan priority hasil K-Means
5. Return JSON response

### `js/tasks.js`

Frontend logic:
- Fetch tasks dari API
- Render task cards dengan badge priority/status/difficulty/importance
- Modal form untuk tambah/edit
- Submit → POST ke API dengan 3 parameter
- Toast notification untuk feedback

---

## 🐛 Troubleshooting

| Problem | Solusi |
|---------|--------|
| **Port 8080 sudah dipakai** | Ubah port di `docker-compose.yml`: `"8888:80"` → akses di `localhost:8888` |
| **Container MySQL tidak start** | Cek logs: `docker logs taskflow-db`. Pastikan port 3306 tidak dipakai program lain. |
| **"Connection refused" ke DB** | Tunggu 10-15 detik setelah `docker-compose up` untuk MySQL init. |
| **Database kosong / table tidak ada** | Jalankan ulang: `docker-compose down -v && docker-compose up -d` |
| **Login gagal password salah** | Jalankan `http://localhost:8080/setup_admin.php` untuk update hash. |
| **Perubahan code tidak terlihat** | Hard refresh browser (Ctrl+Shift+R). Cek volume mount di `docker-compose.yml`. |
| **Permission denied (Linux)** | Jalankan `sudo chown -R $USER:$USER .` di folder project. |

---

## 📊 Port Mapping

| Service | Container Port | Host Port | URL |
|---------|---------------|-----------|-----|
| Web (Apache) | 80 | 8080 | `http://localhost:8080/` |
| MySQL | 3306 | 3306 | `localhost:3306` (untuk MySQL Workbench) |
| phpMyAdmin | 80 | 8081 | `http://localhost:8081/` |

---

## 🔐 Kredensial Default

**Aplikasi:**
- Username: `admin`
- Password: `password123`

**MySQL (Root):**
- User: `root`
- Password: `root123`

**MySQL (App User):**
- User: `taskflow_user`
- Password: `taskflow_pass`
- Database: `taskflow`

---

## 🧪 Testing K-Means

### Skenario 1: Task Urgent + Hard + High

```
Deadline:   Hari ini
Difficulty: Hard
Importance: High
```

**Expected:** Priority = **HIGH**

### Skenario 2: Task Far + Easy + Low

```
Deadline:   30 hari lagi
Difficulty: Easy
Importance: Low
```

**Expected:** Priority = **LOW**

### Skenario 3: Task Mixed

```
Deadline:   7 hari lagi
Difficulty: Medium
Importance: Medium
```

**Expected:** Priority = **MEDIUM** (tergantung distribusi task lain)

---

## 📚 Tech Stack

- **Backend:** PHP 8.2
- **Database:** MySQL 8.0
- **Frontend:** HTML5, CSS3 (custom), Vanilla JavaScript
- **Container:** Docker + Docker Compose
- **Web Server:** Apache 2.4
- **Font:** Sora (Google Fonts)
- **Design:** Minimalist, slate palette, indigo accent

---

## ✨ Fitur Tambahan

- ✅ Session-based authentication (30 menit timeout)
- ✅ Password hashing dengan bcrypt
- ✅ Prepared statements untuk SQL injection prevention
- ✅ Responsive layout (mobile hamburger menu)
- ✅ Toast notifications untuk user feedback
- ✅ Real-time priority calculation on save
- ✅ Filter tasks by status
- ✅ Empty states untuk UX yang lebih baik

---

## 📝 License

Open source untuk pembelajaran.

---

**Dibuat dengan ❤️ untuk pemula yang ingin belajar Docker + K-Means!**
