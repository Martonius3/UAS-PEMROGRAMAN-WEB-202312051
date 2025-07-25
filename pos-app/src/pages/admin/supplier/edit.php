<?php
include '../../../config/database.php';

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM suppliers WHERE id = $id");
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<div class='container mt-5'><div class='alert alert-danger'>Data tidak ditemukan.</div></div>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = $_POST['name'];
    $alamat = $_POST['address'];
    $telepon = $_POST['contact'];

    mysqli_query($conn, "UPDATE suppliers SET name='$nama', address='$alamat', contact='$telepon' WHERE id=$id");
    header("Location: index.php");
    exit;
}
?>

<?php
include '../../../includes/header.php';
?>

<div class="container mt-5">
    <h2>Edit Supplier</h2>
    <form method="POST" class="mt-4">
        <div class="mb-3">
            <label class="form-label">Nama Supplier</label>
            <input type="text" name="name" value="<?= htmlspecialchars($data['name']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="address" class="form-control" required><?= htmlspecialchars($data['address']) ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Telepon</label>
            <input type="text" name="contact" value="<?= htmlspecialchars($data['contact']) ?>" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>