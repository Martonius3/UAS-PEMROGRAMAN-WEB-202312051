<?php
include '../../../config/database.php';

$id = $_GET["id"] ?? null;
$error = '';

if (!$id) {
    header("Location: index.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM categories WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$category = $result->fetch_assoc();

if (!$category) {
    echo "<div class='alert alert-danger m-4'>Kategori tidak ditemukan.</div>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);

    if (empty($name)) {
        $error = "Nama kategori wajib diisi.";
    } else {
        $stmt = $conn->prepare("UPDATE categories SET name = ? WHERE id = ?");
        $stmt->bind_param("si", $name, $id);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Gagal memperbarui kategori.";
        }
    }
}
?>

<?php
include '../../../includes/header.php';
?>

<div class="container mt-4">
    <h2>Edit Kategori</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="name" class="form-label">Nama Kategori</label>
            <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($category['name']); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>