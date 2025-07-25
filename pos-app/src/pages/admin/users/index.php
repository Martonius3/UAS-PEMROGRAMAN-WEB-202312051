<?php
include '../../../includes/header.php';
include '../../../config/database.php';

// Hapus user
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM users WHERE id = $id");
    header("Location: index.php");
}
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Manajemen User</h4>
        <a href="create.php" class="btn btn-success">+ Tambah User</a>
    </div>

    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT users.*, roles.role_name as role_name FROM users JOIN roles ON users.role_id = roles.id");
            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['role_name']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit Role</a>
                        <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Hapus user ini?')" class="btn btn-sm btn-danger">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>