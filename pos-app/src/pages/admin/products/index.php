<?php
include '../../../includes/header.php';
include '../../../config/database.php';
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Produk</h2>
        <a href="create.php" class="btn btn-primary">+ Tambah Produk</a>
    </div>

    <table class="table table-bordered table-striped table-hover">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Supplier</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT products.*, categories.name AS category_name, suppliers.name AS supplier_name
                FROM products
                JOIN categories ON products.category_id = categories.id
                LEFT JOIN suppliers ON products.supplier_id = suppliers.id";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                  <td>{$row['id']}</td>
                  <td>{$row['name']}</td>
                  <td>{$row['category_name']}</td>
                  <td>Rp " . number_format($row['price'], 0, ',', '.') . "</td>
                  <td>{$row['stock']}</td>
                  <td>" . ($row['supplier_name'] ?? '-') . "</td>
                  <td>
                        <a href='edit.php?id={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                        <a href='delete.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin ingin menghapus produk ini?');\">Hapus</a>
                  </td>

                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>