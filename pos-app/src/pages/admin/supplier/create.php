<?php
include '../../../config/database.php';

$nama = $alamat = $telepon = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = $_POST['name'];
    $alamat = $_POST['address'];
    $telepon = $_POST['contact'];

    mysqli_query($conn, "INSERT INTO suppliers (name, address, contact) VALUES ('$nama', '$alamat', '$telepon')");
    header("Location: index.php");
    exit;
}
?>

<?php
include '../../../includes/header.php';
?>

<div class="container mt-5">
    <h2>Tambah Supplier</h2>
    <form method="POST" class="mt-4">
        <div class="mb-3">
            <label class="form-label">Nama Supplier</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="address" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Telepon</label>
            <input type="text" name="contact" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>