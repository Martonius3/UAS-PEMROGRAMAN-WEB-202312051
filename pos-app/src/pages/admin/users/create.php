<?php
include '../../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role_id  = $_POST['role_id'];

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $name, $email, $password, $role_id);
    $stmt->execute();
    header("Location: index.php");
}
?>

<?php
include '../../../includes/header.php';
?>

<div class="container mt-4">
    <h4>Tambah User Baru</h4>
    <form method="POST">
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Role</label>
            <select name="role_id" class="form-control" required>
                <?php
                $roles = $conn->query("SELECT * FROM roles");
                while ($role = $roles->fetch_assoc()) {
                    echo "<option value='{$role['id']}'>{$role['name']}</option>";
                }
                ?>
            </select>
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>