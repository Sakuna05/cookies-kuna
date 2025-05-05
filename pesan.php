<?php
session_start();
include 'koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user'])) {
  echo "<script>alert('Silakan login terlebih dahulu.'); location='login.php';</script>";
  exit;
}
?>

<?php include 'partials/header.php'; ?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow">
        <div class="card-header bg-primary text-white">
          <h4 class="mb-0">Form Pemesanan</h4>
        </div>
        <div class="card-body">
          <form action="proses_pesan.php" method="POST">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" value="<?= $_SESSION['user']['nama']; ?>" required>
            </div>
            <div class="mb-3">
              <label for="alamat" class="form-label">Alamat</label>
              <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
            </div>
            <div class="mb-3">
              <label for="nohp" class="form-label">No. HP</label>
              <input type="text" class="form-control" id="nohp" name="nohp" required>
            </div>
            <div class="mb-3">
              <label for="metode" class="form-label">Metode Pembayaran</label>
              <select class="form-select" id="metode" name="metode" required>
                <option value="">-- Pilih Metode --</option>
                <option value="COD">Bayar di Tempat (COD)</option>
                <option value="Transfer">Transfer Bank</option>
              </select>
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-primary">Lanjutkan Pemesanan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div><?php
include 'partials/header.php';
include 'koneksi.php';

if (!isset($_GET['id'])) {
    echo "<div class='alert alert-warning text-center'>Produk tidak ditemukan.</div>";
    include 'partials/footer.php';
    exit;
}

$id = $_GET['id'];
$produk = mysqli_query($conn, "SELECT * FROM produk WHERE id = $id");
$data = mysqli_fetch_assoc($produk);

if (!$data) {
    echo "<div class='alert alert-danger text-center'>Produk tidak ditemukan.</div>";
    include 'partials/footer.php';
    exit;
}
?>

<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">Form Pemesanan</h2>
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <img src="img/<?= $data['gambar']; ?>" class="card-img-top" alt="<?= $data['nama']; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $data['nama']; ?></h5>
                    <p class="card-text">Rp<?= number_format($data['harga'], 0, ',', '.'); ?></p>
                    <p class="card-text small text-muted">Silakan isi formulir di samping untuk melakukan pemesanan.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <form action="proses_pesan.php" method="POST" class="border p-4 shadow-sm rounded bg-light">
                <input type="hidden" name="id_produk" value="<?= $data['id']; ?>">
                
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="no_hp" class="form-label">Nomor HP</label>
                    <input type="text" name="no_hp" id="no_hp" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat Lengkap</label>
                    <textarea name="alamat" id="alamat" rows="3" class="form-control" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" value="1" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Pesan Sekarang</button>
            </form>
        </div>
    </div>
</div>

<div class="mt-4 d-flex justify-content-start">
  <button class="btn btn-outline-dark rounded-pill px-4 py-2 shadow-sm" onclick="history.back()">
    <i class="bi bi-arrow-left-circle me-2"></i> Kembali
  </button>
</div>


<?php include 'partials/footer.php'; ?>


<?php include 'partials/footer.php'; ?>
