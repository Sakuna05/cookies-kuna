<?php
include 'koneksi.php';

$nama     = htmlspecialchars($_POST['nama']);
$email    = htmlspecialchars($_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // amankan password
$no_hp  = htmlspecialchars($_POST['no_hp']);
$alamat   = htmlspecialchars($_POST['alamat']);

// Cek apakah email sudah terdaftar
$cek = mysqli_query($conn, "SELECT * FROM pelanggan WHERE email = '$email'");
if (mysqli_num_rows($cek) > 0) {
    echo "<script>
            alert('Email sudah terdaftar!');
            window.location.href = 'register.php';
          </script>";
    exit;
}

// Simpan data pelanggan
$query = mysqli_query($conn, "INSERT INTO pelanggan (nama, email, password, no_hp, alamat)
                              VALUES ('$nama', '$email', '$password', '$no_hp', '$alamat')");

if ($query) {
    echo "<script>
            alert('Pendaftaran berhasil! Silakan login.');
            window.location.href = 'login.php';
          </script>";
} else {
    echo "<script>
            alert('Pendaftaran gagal. Silakan coba lagi.');
            window.location.href = 'register.php';
          </script>";
}
?>

<div class="mt-4 d-flex justify-content-start">
  <button class="btn btn-outline-dark rounded-pill px-4 py-2 shadow-sm" onclick="history.back()">
    <i class="bi bi-arrow-left-circle me-2"></i> Kembali
  </button>
</div>
