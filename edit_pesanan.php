<?php
session_start();
include 'koneksi.php';

// Cek login admin
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Ambil data pesanan berdasarkan ID
if (!isset($_GET['id'])) {
    $_SESSION['error'] = "ID pesanan tidak ditemukan.";
    header("Location: pesanan_admin.php");
    exit();
}

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM pesanan WHERE id = '$id'");
$pesanan = mysqli_fetch_assoc($query);

if (!$pesanan) {
    $_SESSION['error'] = "Pesanan tidak ditemukan.";
    header("Location: pesanan_admin.php");
    exit();
}

// Proses update status
if (isset($_POST['simpan'])) {
    $status = $_POST['status'];
    $update = mysqli_query($conn, "UPDATE pesanan SET status = '$status' WHERE id = '$id'");

    if ($update) {
        $_SESSION['success'] = "Status pesanan berhasil diperbarui.";
    } else {
        $_SESSION['error'] = "Gagal memperbarui status.";
    }
    header("Location: pesanan_admin.php");
    exit();
}
?>

<?php include 'partials/header.php'; ?>

<div class="container py-4">
    <h4 class="mb-4">Edit Status Pesanan</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Nama Pelanggan</label>
                    <input type="text" class="form-control" value="<?= $pesanan['nama_pelanggan']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Pesan</label>
                    <input type="text" class="form-control" value="<?= date('d M Y', strtotime($pesanan['tanggal'])); ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Total</label>
                    <input type="text" class="form-control" value="Rp<?= number_format($pesanan['total'], 0, ',', '.'); ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="proses" <?= $pesanan['status'] == 'proses' ? 'selected' : ''; ?>>Proses</option>
                        <option value="selesai" <?= $pesanan['status'] == 'selesai' ? 'selected' : ''; ?>>Selesai</option>
                    </select>
                </div>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan Perubahan</button>
                <a href="pesanan_admin.php" class="btn btn-secondary ms-2">Kembali</a>
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
