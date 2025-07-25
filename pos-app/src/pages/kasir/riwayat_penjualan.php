<?php
require '../../includes/header.php';
require '../../config/database.php';

// Ambil data riwayat penjualan
$query = "
    SELECT 
        s.id AS sale_id,
        s.invoice_number,
        s.sale_date,
        s.total_amount,
        s.payment_method,
        s.paid_amount,
        s.change_amount,
        u.name
    FROM sales s
    JOIN users u ON s.user_id = u.id
    ORDER BY s.sale_date DESC
";
$sales = $conn->query($query);
?>

<div class="container mt-4">
    <h2>Riwayat Penjualan</h2>
    <table class="table table-bordered table-hover">
        <thead class="table-primary">
            <tr>
                <th>Invoice</th>
                <th>Tanggal</th>
                <th>Kasir</th>
                <th>Total</th>
                <th>Bayar</th>
                <th>Kembalian</th>
                <th>Metode</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $sales->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['invoice_number']) ?></td>
                    <td><?= date('d-m-Y H:i', strtotime($row['sale_date'])) ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td>Rp<?= number_format($row['total_amount'], 0, ',', '.') ?></td>
                    <td>Rp<?= number_format($row['paid_amount'], 0, ',', '.') ?></td>
                    <td>Rp<?= number_format($row['change_amount'], 0, ',', '.') ?></td>
                    <td>
                        <?php
                        $method = strtolower($row['payment_method']);
                        switch ($method) {
                            case '0':
                            case 'tunai':
                                echo 'Tunai';
                                break;
                            case '1':
                            case 'transfer':
                                echo 'Transfer';
                                break;
                            case '2':
                            case 'qris':
                                echo 'QRIS';
                                break;
                            default:
                                echo ucfirst($method);
                                break;
                        }
                        ?>
                    </td>
                    <td>
                        <a href="detail_penjualan.php?sale_id=<?= $row['sale_id'] ?>" class="btn btn-sm btn-info">Lihat</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php require '../../includes/footer.php'; ?>