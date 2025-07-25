# 📦 Aplikasi Point of Sale (POS) - PHP Native + MySQL

Sistem ini adalah aplikasi **Point of Sale (POS)** sederhana berbasis **PHP native** dan **MySQL**. Aplikasi ini mencakup fitur penjualan, manajemen produk, log aktivitas pengguna, pengaturan sistem, dan laporan penjualan.

---

## 🖥️ Fitur Utama

- 🔐 Login multi-user (Admin, Kasir)
- 🧾 Transaksi penjualan + cetak struk
- 📦 Manajemen produk & stok
- 📊 Laporan riwayat penjualan
- 📚 Log aktivitas pengguna
- ⚙️ Pengaturan sistem

---

## 🧰 Requirements

- PHP 7.4 atau lebih tinggi
- MySQL/MariaDB
- Apache/Nginx
- Web browser modern
- XAMPP/Laragon/WAMP (untuk pengguna Windows)

---

## 🛠️ Cara Instalasi

### 1. Clone atau Download

Download project sebagai ZIP lalu **ekstrak ke dalam folder `htdocs`** (jika pakai XAMPP), misalnya:

```
C:\xampp\htdocs\pos-app
```

### 2. Buat Database

1. Buka phpMyAdmin.
2. Buat database baru dengan nama:

```
pos-app
```

3. Import file `pos-app.sql` (disediakan dalam folder project) ke database tersebut.

### 3. Konfigurasi Koneksi

Edit file koneksi di:

```php
/config/database.php
```

Contoh:

```php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'pos-app';
```

### 4. Jalankan Aplikasi

Buka browser dan akses:

```
http://localhost/pos-app/
```

atau buka di www jika menggukana laragon

Login menggunakan akun berikut (contoh bawaan):

```
Username: admin
Password: admin123
```
