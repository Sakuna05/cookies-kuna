<?php
session_start();
include 'koneksi.php';

$email = $_POST['email'];
$pass = $_POST['password'];

$cek = mysqli_query($conn, "SELECT * FROM pelanggan WHERE email = '$email'");
if (mysqli_num_rows($cek) === 1) {
    $data = mysqli_fetch_assoc($cek);
    if (password_verify($pass, $data['password'])) {
        $_SESSION['pelanggan'] = $data;
        echo "<script>alert('Login berhasil!'); window.location='index.php';</script>";
        exit;
    }
}
echo "<script>alert('Login gagal'); window.location='login.php';</script>";

<div class="mt-4 d-flex justify-content-start">
  <button class="btn btn-outline-dark rounded-pill px-4 py-2 shadow-sm" onclick="history.back()">
    <i class="bi bi-arrow-left-circle me-2"></i> Kembali
  </button>
</div>
