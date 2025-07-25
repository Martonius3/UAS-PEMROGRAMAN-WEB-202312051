<?php
session_start();
require '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        echo "Username dan password wajib diisi. <a href='../login.php'>Kembali</a>";
        exit;
    }

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'username' => $user['username'],
            'role_id' => $user['role_id']
        ];

        // ✅ Alihkan ke index (biarkan index yang mengatur dashboard)
        header("Location: ../../index.php");
        exit;
    } else {
        echo "Login gagal. <a href='../login.php'>Coba lagi</a>";
        exit;
    }
} else {
    header("Location: ../login.php");
    exit;
}
