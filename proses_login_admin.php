<?php
session_start();
include 'koneksi.php';

$username = trim($_POST['username']);
$password = trim($_POST['password']);

// Menghindari injeksi
$username_safe = mysqli_real_escape_string($conn, $username);
$password_safe = mysqli_real_escape_string($conn, $password);

// Ambil data admin
$query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username_safe'");
$data = mysqli_fetch_assoc($query);

if ($data && $data['password'] === $password_safe) {
    $_SESSION['admin'] = $data;

    echo "<script>
            alert('Selamat datang, Admin!');
            window.location.href = 'admin.php';
          </script>";
} else {
    echo "<script>
            alert('Login gagal! Username atau password salah.');
            window.location.href = 'login_admin.php';
          </script>";
}
?>

<div class="mt-4 d-flex justify-content-start">
  <button class="btn btn-outline-dark rounded-pill px-4 py-2 shadow-sm" onclick="history.back()">
    <i class="bi bi-arrow-left-circle me-2"></i> Kembali
  </button>
</div>
