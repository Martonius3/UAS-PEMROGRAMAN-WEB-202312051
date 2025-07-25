<?php
require '../../includes/header.php';
require '../../config/database.php';

$products = $conn->query("SELECT * FROM products")->fetch_all(MYSQLI_ASSOC);
?>

<div class="container mt-4">
    <h2>Transaksi Penjualan</h2>
    <form action="proses_transaksi.php" method="post">
        <div class="mb-3">
            <label for="payment_method">Metode Pembayaran</label>
            <select name="payment_method" class="form-control" required>
                <option value="">Pilih Metode</option>
                <option value="Tunai">Tunai</option>
                <option value="Transfer">Transfer</option>
                <option value="QRIS">QRIS</option>
            </select>
        </div>

        <div id="produk-list">
            <div class="row mb-3 produk-item">
                <div class="col-md-5">
                    <select name="produk_id[]" class="form-control" required>
                        <option value="">Pilih Produk</option>
                        <?php foreach ($products as $p): ?>
                            <option value="<?= $p['id'] ?>"><?= $p['name'] ?> - Rp<?= number_format($p['price'], 0, ',', '.') ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" name="quantity[]" class="form-control" placeholder="Jumlah" required>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="paid_amount">Jumlah Dibayar</label>
            <input type="number" name="paid_amount" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Proses</button>
    </form>
</div>

<?php require '../../includes/footer.php'; ?>