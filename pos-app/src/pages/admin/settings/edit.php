<?php
include '../../../config/database.php';

$id = $_GET['id'];
$query = "SELECT * FROM settings WHERE id = $id";
$result = mysqli_query($conn, $query);
$setting = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $value = mysqli_real_escape_string($conn, $_POST['value']);
    $update = "UPDATE settings SET value = '$value' WHERE id = $id";
    mysqli_query($conn, $update);
    header("Location: index.php");
    exit;
}
?>

<?php
include '../../../includes/header.php';
?>

<div class="container mt-4">
    <h2>Edit Pengaturan</h2>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Nama Pengaturan</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($setting['key_name']) ?>" disabled>
        </div>
        <div class="mb-3">
            <label class="form-label">Nilai</label>
            <input type="text" name="value" class="form-control" value="<?= htmlspecialchars($setting['value']) ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php include '../../../includes/footer.php'; ?>