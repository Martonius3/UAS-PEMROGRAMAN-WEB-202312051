<?php
require '../../includes/header.php';
require '../../config/database.php';

$sale_id = $_GET['sale_id'] ?? 0;

$saleQuery = $conn->prepare("
    SELECT s.*, u.name 
    FROM sales s 
    JOIN users u ON s.user_id = u.id 
    WHERE s.id = ?
");
$saleQuery->bind_param("i", $sale_id);
$saleQuery->execute();
$sale = $saleQuery->get_result()->fetch_assoc();

$detailQuery = $conn->prepare("
    SELECT d.*, p.name 
    FROM sale_details d 
    JOIN products p ON d.product_id = p.id 
    WHERE d.sale_id = ?
");
$detailQuery->bind_param("i", $sale_id);
$detailQuery->execute();
$details = $detailQuery->get_result();
?>

<div class="container mt-4">
    <h3>Detail Penjualan - <?= htmlspecialchars($sale['invoice_number']) ?></h3>
    <p><strong>Tanggal:</strong> <?= date('d-m-Y H:i', strtotime($sale['sale_date'])) ?></p>
    <p><strong>Kasir:</strong> <?= htmlspecialchars($sale['name']) ?></p>
    <p><strong>Metode Pembayaran:</strong> <?= htmlspecialchars($sale['payment_method']) ?></p>

    <table class="table table-bordered">
        <thead class="table-secondary">
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($d = $details->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($d['name']) ?></td>
                    <td>Rp<?= number_format($d['price'], 0, ',', '.') ?></td>
                    <td><?= $d['quantity'] ?></td>
                    <td>Rp<?= number_format($d['subtotal'], 0, ',', '.') ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-end">Total</th>
                <th>Rp<?= number_format($sale['total_amount'], 0, ',', '.') ?></th>
            </tr>
        </tfoot>
    </table>
</div>

<?php require '../../includes/footer.php'; ?>