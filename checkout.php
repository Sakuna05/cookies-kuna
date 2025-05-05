<?php
session_start();
include 'koneksi.php';

// Redirect jika belum login
if (!isset($_SESSION['pelanggan'])) {
  echo "<script>alert('Silakan login terlebih dahulu');location='login.php';</script>";
  exit();
}

// Redirect jika keranjang kosong
if (empty($_SESSION['keranjang']) || !isset($_SESSION['keranjang'])) {
  echo "<script>alert('Keranjang kosong, silakan belanja terlebih dahulu');location='produk.php';</script>";
  exit();
}

include 'partials/header.php';
?>

<div class="container py-5">
  <h2 class="text-center fw-bold mb-4">Checkout</h2>

  <div class="row">
    <!-- Kolom Daftar Belanja -->
    <div class="col-md-7 mb-4">
      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white fw-semibold">Ringkasan Belanja</div>
        <div class="card-body p-4">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $total_belanja = 0;
              foreach ($_SESSION['keranjang'] as $id_produk => $jumlah):
                $query = mysqli_query($conn, "SELECT * FROM produk WHERE id = '$id_produk'");
                $produk = mysqli_fetch_assoc($query);
                $subtotal = $produk['harga'] * $jumlah;
                $total_belanja += $subtotal;
              ?>
              <tr>
                <td><?= $produk['nama_produk']; ?></td>
                <td><?= $jumlah; ?></td>
                <td>Rp<?= number_format($subtotal, 0, ',', '.'); ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <tr>
                <th colspan="2" class="text-end">Total</th>
                <th>Rp<?= number_format($total_belanja, 0, ',', '.'); ?></th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>

    <!-- Kolom Form Alamat -->
    <div class="col-md-5">
      <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white fw-semibold">Detail Pengiriman</div>
        <div class="card-body p-4">
          <form method="post" action="proses_pesan.php">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" name="nama" class="form-control" value="<?= $_SESSION['pelanggan']['nama']; ?>" required>
            </div>
            <div class="mb-3">
              <label for="telp" class="form-label">Telepon</label>
              <input type="text" name="no_hp" class="form-control" value="<?= $_SESSION['pelanggan']['no_hp']; ?>" required>
            </div>
            <div class="mb-3">
              <label for="alamat" class="form-label">Alamat Lengkap</label>
              <textarea name="alamat" class="form-control" rows="4" placeholder="Masukkan alamat pengiriman" required><?= $_SESSION['pelanggan']['alamat'] ?></textarea>
            </div>
            <button type="submit" name="checkout" class="btn btn-primary w-100">Selesaikan Pesanan <i class="bi bi-check-circle-fill"></i></button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="mt-4 d-flex justify-content-start">
  <button class="btn btn-outline-dark rounded-pill px-4 py-2 shadow-sm" onclick="history.back()">
    <i class="bi bi-arrow-left-circle me-2"></i> Kembali
  </button>
</div>


<?php include 'partials/footer.php'; ?>
