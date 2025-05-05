<?php
include 'partials/header.php';
include 'koneksi.php';

if (!isset($_GET['id'])) {
  echo "<div class='container py-5'><div class='alert alert-danger text-center'>ID Pesanan tidak ditemukan.</div></div>";
  include 'partials/footer.php';
  exit;
}

$id = $_GET['id'];
$pesanan = mysqli_query($conn, "SELECT pesanan.*, produk.nama AS nama_produk, produk.gambar 
                                FROM pesanan 
                                JOIN produk ON pesanan.id_produk = produk.id 
                                WHERE pesanan.id = '$id'");

if (mysqli_num_rows($pesanan) == 0) {
  echo "<div class='container py-5'><div class='alert alert-warning text-center'>Data pesanan tidak ditemukan.</div></div>";
  include 'partials/footer.php';
  exit;
}

$data = mysqli_fetch_assoc($pesanan);
?>

<div class="container py-5">
  <h2 class="text-center mb-4">Detail Pesanan</h2>

  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm">
        <div class="row g-0">
          <div class="col-md-5">
            <img src="img/<?= $data['gambar']; ?>" class="img-fluid rounded-start" alt="<?= $data['nama_produk']; ?>">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <h4 class="card-title"><?= $data['nama_produk']; ?></h4>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Nama Pemesan:</strong> <?= $data['nama']; ?></li>
                <li class="list-group-item"><strong>Jumlah:</strong> <?= $data['jumlah']; ?> pcs</li>
                <li class="list-group-item"><strong>Total Harga:</strong> Rp<?= number_format($data['total'], 0, ',', '.'); ?></li>
                <li class="list-group-item"><strong>Tanggal Pesan:</strong> <?= date('d M Y', strtotime($data['tanggal'])); ?></li>
                <li class="list-group-item">
                  <strong>Status:</strong>
                  <?php
                  $badge = 'secondary';
                  if ($data['status'] == 'pending') $badge = 'warning';
                  else if ($data['status'] == 'proses') $badge = 'primary';
                  else if ($data['status'] == 'selesai') $badge = 'success';
                  ?>
                  <span class="badge bg-<?= $badge; ?>"><?= ucfirst($data['status']); ?></span>
                </li>
              </ul>
              <a href="riwayat.php" class="btn btn-outline-secondary mt-3">Kembali ke Riwayat</a>
            </div>
          </div>
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
