<?php
session_start();
include 'koneksi.php';

// Cek login admin
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Ambil data pelanggan
$query = mysqli_query($conn, "SELECT * FROM pelanggan");
?>

<?php include 'partials/header.php'; ?>

<div class="container py-4">
    <h4 class="mb-4">Daftar Pelanggan</h4>

    <?php if (mysqli_num_rows($query) > 0): ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while ($row = mysqli_fetch_assoc($query)): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['nama']); ?></td>
                    <td><?= htmlspecialchars($row['email']); ?></td>
                    <td><?= htmlspecialchars($row['no_hp']); ?></td>
                    <td><?= htmlspecialchars($row['alamat']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
        <div class="alert alert-warning">Belum ada pelanggan yang terdaftar.</div>
    <?php endif; ?>
</div>

<div class="mt-4 d-flex justify-content-start">
  <button class="btn btn-outline-dark rounded-pill px-4 py-2 shadow-sm" onclick="history.back()">
    <i class="bi bi-arrow-left-circle me-2"></i> Kembali
  </button>
</div>


<?php include 'partials/footer.php'; ?>
