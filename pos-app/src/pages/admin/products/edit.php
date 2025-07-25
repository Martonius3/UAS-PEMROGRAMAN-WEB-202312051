<?php
include '../../../config/database.php';

$id = $_GET['id'];
$product = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id = $id"));

if (!$product) {
    echo "<div class='alert alert-danger container mt-4'>Produk tidak ditemukan.</div>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $supplier_id = $_POST['supplier_id'] !== "" ? $_POST['supplier_id'] : "NULL";

    $query = "UPDATE products SET
                name = '$name',
                category_id = $category_id,
                price = $price,
                stock = $stock,
                supplier_id = $supplier_id
              WHERE id = $id";
    mysqli_query($conn, $query);
    header('Location: index.php');
}
?>

<?php
include '../../../includes/header.php';
?>

<div class="container mt-4">
    <h2>Edit Produk</h2>
    <form method="POST" class="mt-3">
        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="name" value="<?= $product['name'] ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="category_id" class="form-select" required>
                <?php
                $kategori = mysqli_query($conn, "SELECT * FROM categories");
                while ($k = mysqli_fetch_assoc($kategori)) {
                    $selected = $k['id'] == $product['category_id'] ? 'selected' : '';
                    echo "<option value='{$k['id']}' $selected>{$k['name']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="price" value="<?= $product['price'] ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stock" value="<?= $product['stock'] ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Supplier</label>
            <select name="supplier_id" class="form-select">
                <option value="">-- Tidak ada --</option>
                <?php
                $supplier = mysqli_query($conn, "SELECT * FROM suppliers");
                while ($s = mysqli_fetch_assoc($supplier)) {
                    $selected = $product['supplier_id'] == $s['id'] ? 'selected' : '';
                    echo "<option value='{$s['id']}' $selected>{$s['name']}</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>