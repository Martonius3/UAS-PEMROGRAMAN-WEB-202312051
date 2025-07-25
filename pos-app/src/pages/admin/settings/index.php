<?php
include '../../../includes/header.php';
include '../../../config/database.php';

$query = "SELECT * FROM settings";
$result = mysqli_query($conn, $query);
?>

<div class="container mt-4">
    <h2 class="mb-4">Pengaturan Sistem</h2>

    <table class="table table-bordered">
        <thead class="table-secondary">
            <tr>
                <th>#</th>
                <th>Nama Pengaturan</th>
                <th>Nilai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            while ($setting = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($setting['key_name']) ?></td>
                    <td><?= htmlspecialchars($setting['value']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $setting['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include '../../../includes/footer.php'; ?>