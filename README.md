# QR Code API - Native PHP

API ini dibuat menggunakan Native PHP dan MongoDB untuk kebutuhan autentikasi dengan JWT serta fitur lainnya terkait QR Code.

## 📌 Fitur API
- **User Registration** (Daftar pengguna baru)
- **User Login** (Login dengan JWT Authentication)
- **Protected Routes** (Akses endpoint hanya dengan token JWT yang valid)

---

## 🚀 Cara Menjalankan Proyek
### 1. **Clone Repository**
```sh
git clone https://github.com/Nandbgus/QR_PROJECT.git
cd QR_PROJECT
```

### 2. **Install Dependencies**
Gunakan **Composer** untuk menginstall dependensi yang diperlukan:
```sh
composer install
```

### 3. **Buat File .env**
Buat file **.env** di root project dan tambahkan konfigurasi berikut:
```
MONGO_URI=mongodb+srv://admin:admin123@cluster0.dtvge.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0
DB_NAME=qrcode
JWT_SECRET=apiqrcode-12345
```

### 4. **Jalankan Server Local**
Gunakan PHP built-in server untuk menjalankan API:
```sh
php -S localhost:8000 -t public
```
API akan berjalan di `http://localhost:8000`

---

## 🛠️ Endpoint API
### 1️⃣ **Register User**
- **URL:** `POST /api/auth/register`
- **Body:**
```json
{
  "nama": "John Doe",
  "email": "johndoe@example.com",
  "password": "password123"
}
```
- **Response:**
```json
{
  "message": "Registrasi berhasil",
  "user_id": "656adf23acb2a"
}
```

### 2️⃣ **Login User**
- **URL:** `POST /api/auth/login`
- **Body:**
```json
{
  "email": "johndoe@example.com",
  "password": "password123"
}
```
- **Response:**
```json
{
  "message": "Login berhasil",
  "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
}
```

### 3️⃣ **Get User Profile (Protected)**
- **URL:** `GET /api/user/profile`
- **Headers:**
  - `Authorization: Bearer {TOKEN}`
- **Response:**
```json
{
  "nama": "John Doe",
  "email": "johndoe@example.com"
}
```

---

## ⚠️ Troubleshooting
Jika terdapat error saat menjalankan proyek, coba periksa:
- **Pastikan Composer sudah diinstall:** `composer --version`
- **Pastikan MongoDB sudah berjalan** dan dapat diakses melalui `MONGO_URI`
- **Pastikan file .env sudah dibuat** dan isinya benar

---

## 👥 Kontribusi
Jika ingin berkontribusi:
1. Fork repository ini
2. Buat branch baru: `git checkout -b feature-xyz`
3. Commit perubahan: `git commit -m "Menambahkan fitur xyz"`
4. Push ke GitHub: `git push origin feature-xyz`
5. Buat Pull Request

---

**Dibuat dengan ❤️ oleh Tim QR PROJECT**

