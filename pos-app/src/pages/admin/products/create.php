<?php
include '../../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $supplier_id = $_POST['supplier_id'] !== "" ? $_POST['supplier_id'] : "NULL";

    $query = "INSERT INTO products (name, category_id, price, stock, supplier_id)
                VALUES ('$name', $category_id, $price, $stock, $supplier_id)";
    mysqli_query($conn, $query);
    header('Location: index.php');
}
?>

<?php
include '../../../includes/header.php';
?>

<div class="container mt-4">
    <h2>Tambah Produk</h2>
    <form method="POST" class="mt-3">
        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="category_id" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                <?php
                $kategori = mysqli_query($conn, "SELECT * FROM categories");
                while ($k = mysqli_fetch_assoc($kategori)) {
                    echo "<option value='{$k['id']}'>{$k['name']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stock" value="0" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Supplier (Opsional)</label>
            <select name="supplier_id" class="form-select">
                <option value="">-- Tidak ada --</option>
                <?php
                $supplier = mysqli_query($conn, "SELECT * FROM suppliers");
                while ($s = mysqli_fetch_assoc($supplier)) {
                    echo "<option value='{$s['id']}'>{$s['name']}</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>


</div>