<?php
session_start();
include 'partials/header.php';

// Pastikan ID produk dikirim
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    unset($_SESSION['keranjang'][$id]);
    $pesan = "Produk berhasil dihapus dari keranjang.";
} else {
    $pesan = "Tidak ada produk yang dipilih untuk dihapus.";
}
?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8 text-center">
      <div class="alert alert-info shadow">
        <?= $pesan ?>
      </div>
      <a href="keranjang.php" class="btn btn-primary"><i class="bi bi-arrow-left"></i> Kembali ke Keranjang</a>
    </div>
  </div>
</div>

<?php include 'partials/footer.php'; ?>
