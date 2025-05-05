<?php 
include 'koneksi.php'; 
include 'partials/header.php'; 

if (!isset($_GET['id'])) {
    echo "<script>alert('Produk tidak ditemukan.'); window.location='index.php';</script>";
    exit;
}

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM produk WHERE id = '$id'");
$produk = mysqli_fetch_assoc($query);
if (!$produk) {
    echo "<script>alert('Produk tidak ditemukan.'); window.location='index.php';</script>";
    exit;
}
?>

<!-- Detail Produk -->
<div class="container py-5">
  <div class="row">
    <div class="col-md-6">
      <img src="images/<?= $produk['gambar']; ?>" class="img-fluid rounded shadow" alt="<?= $produk['nama_produk']; ?>">
    </div>
    <div class="col-md-6">
      <h2 class="fw-bold"><?= $produk['nama_produk']; ?></h2>
      <h4 class="text-muted">Rp<?= number_format($produk['harga'], 0, ',', '.'); ?></h4>
      <p class="mt-3"><?= nl2br($produk['deskripsi'] ?? ''); ?></p>

      <form action="tambah_keranjang.php" method="post" class="mt-4">
        <input type="hidden" name="id_produk" value="<?= $produk['id']; ?>">
        <div class="mb-3">
          <label for="jumlah" class="form-label">Jumlah</label>
          <input type="number" name="jumlah" id="jumlah" value="1" min="1" class="form-control w-25" required>
        </div>
        <button type="submit" class="btn btn-primary">
          <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
        </button>
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
