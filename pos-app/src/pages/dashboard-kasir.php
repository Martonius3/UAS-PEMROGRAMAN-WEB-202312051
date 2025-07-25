<?php
require '../includes/header.php';
require '../config/database.php';

// Total Penjualan Hari Ini
$total_penjualan = $conn->query("SELECT SUM(total_amount) AS total FROM sales")->fetch_assoc()['total'] ?? 0;
$tanggal = date('Y-m-d');
$sql = "SELECT SUM(total_amount) as total FROM sales WHERE DATE(sale_date) = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $tanggal);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
$total_hari_ini = $result['total'] ?? 0;
?>

<div class="container mt-4">
    <h2>Dashboard Kasir</h2>
    <div class="alert alert-info">
        Total Penjualan Hari Ini: <strong>Rp<?= number_format($total_penjualan, 0, ',', '.') ?></strong>
    </div>
</div>

<?php require '../includes/footer.php'; ?>