<?php
include '../../../config/database.php';

$name = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);

    if (empty($name)) {
        $error = "Nama kategori wajib diisi.";
    } else {
        $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->bind_param("s", $name);

        if ($stmt->execute()) {
            // Redirect sebelum header.php dimuat
            header("Location: index.php");
            exit;
        } else {
            $error = "Gagal menyimpan kategori.";
        }
    }
}
?>

<?php include '../../../includes/header.php'; ?>

<div class="container mt-4">
    <h4>Tambah Kategori</h4>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($name) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>