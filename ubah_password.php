<?php
session_start();
include 'koneksi.php';

// Cek login admin
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$alert = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password_lama = mysqli_real_escape_string($conn, $_POST['password_lama']);
    $password_baru = mysqli_real_escape_string($conn, $_POST['password_baru']);
    $konfirmasi_password = mysqli_real_escape_string($conn, $_POST['konfirmasi_password']);

    $id_admin = $_SESSION['admin']['id_admin'];
    $query = mysqli_query($conn, "SELECT * FROM admin WHERE id_admin = '$id_admin'");
    $admin = mysqli_fetch_assoc($query);

    if ($password_baru !== $konfirmasi_password) {
        $alert = '<div class="alert alert-warning">Konfirmasi password tidak cocok.</div>';
    } elseif ($password_lama !== $admin['password']) {
        $alert = '<div class="alert alert-danger">Password lama salah.</div>';
    } else {
        mysqli_query($conn, "UPDATE admin SET password = '$password_baru' WHERE id_admin = '$id_admin'");
        $alert = '<div class="alert alert-success">Password berhasil diubah.</div>';
    }
}
?>

<?php include 'partials/header.php'; ?>

<div class="container py-5" style="max-width: 600px;">
    <h4 class="mb-4">Ubah Password Admin</h4>

    <?= $alert; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="password_lama" class="form-label">Password Lama</label>
            <input type="password" name="password_lama" id="password_lama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password_baru" class="form-label">Password Baru</label>
            <input type="password" name="password_baru" id="password_baru" class="form-control" required>
        </div>
        <div class="mb-4">
            <label for="konfirmasi_password" class="form-label">Konfirmasi Password Baru</label>
            <input type="password" name="konfirmasi_password" id="konfirmasi_password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>

<?php include 'partials/footer.php'; ?>
