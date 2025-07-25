<?php
include '../includes/header.php';
include '../config/database.php'; // koneksi database

// Ambil total barang
$queryTotalBarang = "SELECT COUNT(*) AS total_barang FROM products";
$resultBarang = mysqli_query($conn, $queryTotalBarang);
$dataBarang = mysqli_fetch_assoc($resultBarang);
$totalBarang = $dataBarang['total_barang'] ?? 0;

// Ambil total transaksi hari ini
$queryTotalTransaksiHariIni = "
    SELECT IFNULL(SUM(total_amount), 0) AS total_transaksi 
    FROM sales 
    WHERE DATE(sale_date) = CURDATE()
";
$resultTransaksi = mysqli_query($conn, $queryTotalTransaksiHariIni);
$dataTransaksi = mysqli_fetch_assoc($resultTransaksi);
$totalTransaksiHariIni = $dataTransaksi['total_transaksi'] ?? 0;
?>

<div class="container mt-4">
    <h3>Dashboard Admin</h3>
    <div class="alert alert-primary">
        Selamat datang, <strong><?= htmlspecialchars($_SESSION['user']['name']); ?></strong>! Anda login sebagai <strong>Admin</strong>.
    </div>

    <div class="row">
        <!-- Total Barang -->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Barang</h5>
                    <p class="card-text"><?= number_format($totalBarang); ?> item</p>
                </div>
            </div>
        </div>

        <!-- Transaksi Hari Ini -->
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Transaksi Hari Ini</h5>
                    <p class="card-text">Rp <?= number_format($totalTransaksiHariIni, 0, ',', '.'); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>