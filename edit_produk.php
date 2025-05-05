<?php
session_start();
if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Anda harus login sebagai admin'); location='login_admin.php';</script>";
    exit;
}

include 'koneksi.php';

// Ambil data produk yang akan diedit
if (!isset($_GET['id'])) {
    echo "<script>alert('ID produk tidak ditemukan'); location='produk_admin.php';</script>";
    exit;
}

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM produk WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>alert('Produk tidak ditemukan'); location='produk_admin.php';</script>";
    exit;
}
?>

<?php include 'partials/header.php'; ?>

<div class="container py-5">
  <h2 class="mb-4 text-center">Edit Produk</h2>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <form action="proses_edit_produk.php" method="POST" enctype="multipart/form-data" class="shadow p-4 bg-light rounded">

        <input type="hidden" name="id" value="<?= $data['id']; ?>">

        <div class="mb-3">
          <label for="nama" class="form-label">Nama Produk</label>
          <input type="text" class="form-control" id="nama" name="nama" required value="<?= $data['nama_produk']; ?>">
        </div>

        <div class="mb-3">
          <label for="harga" class="form-label">Harga</label>
          <input type="number" class="form-control" id="harga" name="harga" required value="<?= $data['harga']; ?>">
        </div>

        <div class="mb-3">
          <label for="stok" class="form-label">Stok</label>
          <input type="number" class="form-control" id="stok" name="stok" required value="<?= $data['stok']; ?>">
        </div>

        <div class="mb-3">
          <label for="gambar" class="form-label">Gambar Produk</label>
          <?php if (!empty($data['gambar'])): ?>
            <div class="mb-2">
              <img src="images/<?= $data['gambar']; ?>" alt="Gambar Produk" class="img-thumbnail" width="150">
            </div>
          <?php endif; ?>
          <input type="file" class="form-control" id="gambar" name="gambar">
          <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>

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
