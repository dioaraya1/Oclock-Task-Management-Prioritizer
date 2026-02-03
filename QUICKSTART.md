# ⚡ Quick Start — TaskFlow Docker

## 3 Perintah untuk Jalan

```bash
# 1. Start containers
docker-compose up -d

# 2. Setup admin (jalankan sekali)
# Buka di browser: http://localhost:8080/setup_admin.php

# 3. Login
# http://localhost:8080/
# Username: admin
# Password: password123
```

## Perintah Berguna

```bash
# Stop containers
docker-compose down

# Restart
docker-compose restart

# Lihat logs
docker logs taskflow-web -f

# Reset database (hapus semua data)
docker-compose down -v
docker-compose up -d
```

## Port

- **App:** http://localhost:8080/
- **phpMyAdmin:** http://localhost:8081/
- **MySQL:** localhost:3306

## File Structure

- Edit `.php`, `.css`, `.js` di VS Code
- Simpan (Ctrl+S)
- Refresh browser (F5)
- ✅ Perubahan langsung terlihat — TIDAK perlu restart!

---

📖 **Panduan lengkap:** Baca `README.md`
