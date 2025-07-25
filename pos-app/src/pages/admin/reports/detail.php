<?php
include '../../../includes/header.php';
include '../../../config/database.php'; // sekarang ini mendefinisikan $conn

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "<div class='alert alert-danger'>ID tidak ditemukan.</div>";
    exit;
}

// Ambil data penjualan dan kasir
$stmt = $conn->prepare("
    SELECT s.*, u.name 
    FROM sales s 
    JOIN users u ON s.user_id = u.id 
    WHERE s.id = ?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$sale = $result->fetch_assoc();
$stmt->close();

if (!$sale) {
    echo "<div class='alert alert-danger'>Data penjualan tidak ditemukan.</div>";
    exit;
}

// Ambil detail produk penjualan
$stmt = $conn->prepare("
    SELECT sd.*, p.name 
    FROM sale_details sd 
    JOIN products p ON sd.product_id = p.id 
    WHERE sd.sale_id = ?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$details = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<div class="container mt-4">
    <h3>Detail Penjualan</h3>
    <p><strong>Tanggal:</strong> <?= date('d-m-Y H:i', strtotime($sale['sale_date'])) ?></p>
    <p><strong>Kasir:</strong> <?= htmlspecialchars($sale['name']) ?></p>
    <p><strong>Total:</strong> Rp <?= number_format($sale['total_amount'], 0, ',', '.') ?></p>

    <h5 class="mt-4">Produk Terjual:</h5>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($details as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td>Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <a href="index.php" class="btn btn-secondary">Kembali</a>
</div>

<?php include '../../../includes/footer.php'; ?>