<?php
require '../../includes/header.php';
require '../../config/database.php';

$total_penjualan = $conn->query("SELECT SUM(total_amount) AS total FROM sales")->fetch_assoc()['total'] ?? 0;
$total_transaksi = $conn->query("SELECT COUNT(*) AS total FROM sales")->fetch_assoc()['total'] ?? 0;
?>

<div class="container mt-4">
    <h2>Laporan Penjualan</h2>
    <ul class="list-group">
        <li class="list-group-item">Total Transaksi: <?= $total_transaksi ?> kali</li>
        <li class="list-group-item">Total Penjualan: Rp<?= number_format($total_penjualan, 0, ',', '.') ?></li>
    </ul>
</div>

<?php require '../../includes/footer.php'; ?>