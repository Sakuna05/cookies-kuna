<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama   = $_POST['nama'];
  $harga  = $_POST['harga'];
  $stok   = $_POST['stok'];

  // Handle upload gambar
  $gambar = $_FILES['gambar']['name'];
  $tmp    = $_FILES['gambar']['tmp_name'];

  if (!empty($gambar)) {
    $uploadPath = "images/" . basename($gambar);
    if (move_uploaded_file($tmp, $uploadPath)) {
      $query = mysqli_query($conn, "INSERT INTO produk (nama_produk, harga, stok, gambar) VALUES ('$nama', '$harga', '$stok', '$gambar')");

      if ($query) {
        echo "<script>alert('Produk berhasil ditambahkan'); window.location='produk_admin.php';</script>";
      } else {
        echo "<script>alert('Gagal menambahkan produk ke database'); window.location='tambah_produk.php';</script>";
      }
    } else {
      echo "<script>alert('Upload gambar gagal'); window.location='tambah_produk.php';</script>";
    }
  } else {
    echo "<script>alert('Gambar produk wajib diisi'); window.location='tambah_produk.php';</script>";
  }
} else {
  header("Location: tambah_produk.php");
  exit;
}
?>

<div class="mt-4 d-flex justify-content-start">
  <button class="btn btn-outline-dark rounded-pill px-4 py-2 shadow-sm" onclick="history.back()">
    <i class="bi bi-arrow-left-circle me-2"></i> Kembali
  </button>
</div>
