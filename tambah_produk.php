<?php
session_start();
if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Anda harus login sebagai admin');location='login_admin.php';</script>";
    exit;
}

include 'koneksi.php';
include 'partials/header.php';
?>

<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Tambah Produk Baru</h4>
        </div>
        <div class="card-body">
            <form action="proses_tambah_produk.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga (Rp)</label>
                    <input type="number" class="form-control" id="harga" name="harga" required>
                </div>
                <div class="mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" class="form-control" id="stok" name="stok" required>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar Produk</label>
                    <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" required>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="produk_admin.php" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle me-1"></i> Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
