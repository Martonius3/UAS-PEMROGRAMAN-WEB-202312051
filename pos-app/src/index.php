<?php
session_start();

// Jika belum login, arahkan ke login
if (!isset($_SESSION['user'])) {
    header("Location: pages/login.php");
    exit;
}

// Jika sudah login, arahkan ke dashboard sesuai role
$role = $_SESSION['user']['role_id'];

if ($role == 1) {
    header("Location: pages/dashboard-admin.php");
    exit;
} elseif ($role == 2) {
    header("Location: pages/dashboard-kasir.php");
    exit;
} else {
    echo "Role tidak dikenali. Hubungi administrator.";
    exit;
}
