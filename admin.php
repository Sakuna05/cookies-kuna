<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Silakan login terlebih dahulu.'); location='login.php';</script>";
    exit();
}

// Mengambil data ringkasan
$jumlah_produk = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM produk"));
$jumlah_pelanggan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pelanggan"));
$jumlah_pesanan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pesanan"));
?>

<?php include 'partials/header.php'; ?>

<div class="container py-5">
  <h1 class="mb-4">Dashboard Admin</h1>
  <div class="row">
    <!-- Kartu Ringkasan Produk -->
    <div class="col-md-4">
      <a href="produk_admin.php">
        <div class="card text-white bg-primary mb-3">
          <div class="card-body">
            <h5 class="card-title">Produk</h5>
            <p class="card-text">Total: <?= $jumlah_produk; ?></p>
          </div>
        </div>
      </a>
    </div>
    <!-- Kartu Ringkasan Pelanggan -->
    <div class="col-md-4">
      <a href="pelanggan_admin.php">
        <div class="card text-white bg-success mb-3">
          <div class="card-body">
            <h5 class="card-title">Pelanggan</h5>
            <p class="card-text">Total: <?= $jumlah_pelanggan; ?></p>
          </div>
        </div>
      </a>
    </div>
    <!-- Kartu Ringkasan Pesanan -->
    <div class="col-md-4">
      <a href="pesanan_admin.php">
        <div class="card text-white bg-warning mb-3">
          <div class="card-body">
            <h5 class="card-title">Pesanan</h5>
            <p class="card-text">Total: <?= $jumlah_pesanan; ?></p>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>


<div class="text-end mt-4">
  <a href="index.php" class="btn btn-secondary">
    <i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Beranda
  </a>
</div>

<div class="mt-4 d-flex justify-content-start">
  <button class="btn btn-outline-dark rounded-pill px-4 py-2 shadow-sm" onclick="history.back()">
    <i class="bi bi-arrow-left-circle me-2"></i> Kembali
  </button>
</div>


<?php include 'partials/footer.php'; ?>

