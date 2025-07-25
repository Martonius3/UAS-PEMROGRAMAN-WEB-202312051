<?php
include '../../../includes/header.php';
include '../../../config/database.php';

$sql = "SELECT logs.*, users.name AS username 
        FROM logs 
        JOIN users ON logs.user_id = users.id 
        ORDER BY log_time DESC";
$result = mysqli_query($conn, $sql);
?>

<div class="container mt-4">
    <h2 class="mb-4">Log Aktivitas Pengguna</h2>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Pengguna</th>
                        <th>Aksi</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    while ($log = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($log['username']) ?></td>
                            <td><?= htmlspecialchars($log['action']) ?></td>
                            <td><?= date('d-m-Y H:i:s', strtotime($log['log_time'])) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">Belum ada aktivitas tercatat.</div>
    <?php endif; ?>
</div>

<?php include '../../../includes/footer.php'; ?>