<?php
session_start();
include 'koneksi.php';

// Redirect jika belum login
if (!isset($_SESSION['pelanggan'])) {
  echo "<script>alert('Silakan login terlebih dahulu');location='login.php';</script>";
  exit();
}

include 'partials/header.php';
?>

<div class="container py-5">
  <h2 class="text-center fw-bold mb-4">Riwayat Pesanan</h2>

  <div class="card shadow-sm">
    <div class="card-body p-4">
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Tanggal</th>
              <th>Total</th>
              <th>Status</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $nama_pelanggan = $_SESSION['pelanggan']['nama'];
            $no = 1;
            $ambil = mysqli_query($conn, "SELECT * FROM pesanan WHERE nama_pelanggan='$nama_pelanggan' ORDER BY tanggal DESC");
            while ($row = mysqli_fetch_assoc($ambil)) {
            ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= date('d M Y', strtotime($row['tanggal'])); ?></td>
              <td>Rp<?= number_format($row['total'], 0, ',', '.'); ?></td>
              <td>
                <span class="badge bg-<?= $row['status'] == 'pending' ? 'warning' : 'success'; ?>">
                  <?= ucfirst($row['status']); ?>
                </span>
              </td>
              <td>
                <a href="nota.php?id=<?= $row['id']; ?>" class="btn btn-outline-primary btn-sm">
                  <i class="bi bi-receipt-cutoff"></i> Detail
                </a>
              </td>
            </tr>
            <?php } ?>
            <?php if (mysqli_num_rows($ambil) == 0): ?>
            <tr>
              <td colspan="5" class="text-center text-muted">Belum ada riwayat pembelian</td>
            </tr>
            <?php endif; ?>
          </tbody>
        </table>
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
