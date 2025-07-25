<?php
include '../../../includes/header.php';
include '../../../config/database.php'; // Harus mendefinisikan $conn (mysqli)

$start_date = $_GET['start_date'] ?? '';
$end_date = $_GET['end_date'] ?? '';

$sql = "SELECT sales.*, users.name, sales.payment_method, sales.invoice_number 
        FROM sales 
        JOIN users ON sales.user_id = users.id";

if (!empty($start_date) && !empty($end_date)) {
    $sql .= " WHERE DATE(sale_date) BETWEEN '$start_date' AND '$end_date'";
}

$sql .= " ORDER BY sale_date DESC";

$result = mysqli_query($conn, $sql);
?>

<div class="container mt-4">
    <h2 class="mb-4">Laporan Penjualan</h2>

    <form class="row g-3 mb-4" method="get">
        <div class="col-md-4">
            <label for="start_date" class="form-label">Dari Tanggal</label>
            <input type="date" class="form-control" name="start_date" id="start_date" value="<?= htmlspecialchars($start_date) ?>">
        </div>
        <div class="col-md-4">
            <label for="end_date" class="form-label">Sampai Tanggal</label>
            <input type="date" class="form-control" name="end_date" id="end_date" value="<?= htmlspecialchars($end_date) ?>">
        </div>
        <div class="col-md-4 align-self-end">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="index.php" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Invoice</th>
                        <th>Tanggal</th>
                        <th>Kasir</th>
                        <th>Total</th>
                        <th>Metode</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= htmlspecialchars($row['invoice_number']) ?></td>
                            <td><?= date('d-m-Y H:i', strtotime($row['sale_date'])) ?></td>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td>Rp <?= number_format($row['total_amount'], 0, ',', '.') ?></td>
                            <td>
                                <?php
                                switch ($row['payment_method']) {
                                    case 0:
                                    case '0':
                                        echo 'Tunai';
                                        break;
                                    case 1:
                                    case '1':
                                        echo 'Transfer';
                                        break;
                                    case 2:
                                    case '2':
                                        echo 'QRIS';
                                        break;
                                    default:
                                        echo 'Tidak diketahui';
                                        break;
                                }
                                ?>
                            </td>
                            <td>
                                <a href="detail.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-info">Lihat</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">Tidak ada data penjualan untuk rentang waktu tersebut.</div>
    <?php endif; ?>
</div>

<?php include '../../../includes/footer.php'; ?>