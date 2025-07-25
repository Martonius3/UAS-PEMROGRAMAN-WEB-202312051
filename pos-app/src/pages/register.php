<?php include('../includes/header_auth.php'); ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="mb-4 text-center">Registrasi</h3>
                    <form action="auth/process_register.php" method="POST">
                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Daftar</button>
                    </form>
                    <div class="mt-3 text-center">
                        <a href="login.php">Sudah punya akun? Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('../includes/footer.php'); ?>