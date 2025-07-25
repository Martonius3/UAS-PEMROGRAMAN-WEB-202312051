<?php
include '../../../config/database.php';

$id = $_GET['id'];
$user = $conn->query("SELECT * FROM users WHERE id = $id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role_id = $_POST['role_id'];
    $conn->query("UPDATE users SET role_id = $role_id WHERE id = $id");
    header("Location: index.php");
}
?>

<?php
include '../../../includes/header.php';
?>

<div class="container mt-4">
    <h4>Edit Role: <?= htmlspecialchars($user['name']) ?></h4>
    <form method="POST">
        <div class="mb-3">
            <label>Role</label>
            <select name="role_id" class="form-control" required>
                <?php
                $roles = $conn->query("SELECT * FROM roles");
                while ($role = $roles->fetch_assoc()) {
                    $selected = ($user['role_id'] == $role['id']) ? "selected" : "";
                    echo "<option value='{$role['id']}' $selected>{$role['role_name']}</option>";
                }
                ?>
            </select>
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>