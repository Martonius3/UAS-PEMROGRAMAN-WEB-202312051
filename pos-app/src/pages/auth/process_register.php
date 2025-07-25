<?php
require '../../config/database.php';

$name = trim($_POST['name']);
$username = trim($_POST['username']);
$password_plain = $_POST['password'];
$role_id = 2; // default: kasir

// Validasi input kosong
if (empty($name) || empty($username) || empty($password_plain)) {
    echo "Semua field wajib diisi. <a href='../pages/register.php'>Kembali</a>";
    exit;
}

// Cek apakah username sudah digunakan
$check = $conn->prepare("SELECT id FROM users WHERE username = ?");
$check->bind_param("s", $username);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo "Username sudah digunakan. <a href='../pages/register.php'>Coba lagi</a>";
    exit;
}

// Simpan data user baru
$password = password_hash($password_plain, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (name, username, password, role_id, created_at)
        VALUES (?, ?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $name, $username, $password, $role_id);

if ($stmt->execute()) {
    header("Location: ../login.php");
    exit;
} else {
    echo "Registrasi gagal: " . $conn->error;
}
