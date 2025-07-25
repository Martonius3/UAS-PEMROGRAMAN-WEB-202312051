<?php
include '../../../includes/header.php';
include '../../../config/database.php';

// Handle delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM suppliers WHERE id = $id");
    header("Location: index.php");
    exit;
}

// Fetch data
$result = mysqli_query($conn, "SELECT * FROM suppliers ORDER BY id DESC");
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manajemen Supplier</h2>
        <a href="create.php" class="btn btn-primary">Tambah Supplier</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Nama Supplier</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['address']) ?></td>
                    <td><?= htmlspecialchars($row['contact']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="index.php?delete=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-sm btn-danger">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>