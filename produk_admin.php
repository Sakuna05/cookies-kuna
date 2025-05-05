<?php
session_start();
if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Anda harus login sebagai admin');location='login_admin.php';</script>";
    exit;
}

include 'koneksi.php';
include 'partials/header.php';

// Query untuk mengambil semua data produk
$query = mysqli_query($conn, "SELECT * FROM produk");

// Cek apakah query berhasil
if (!$query) {
    echo "Error: " . mysqli_error($conn);
    exit;
}

?>

<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0"><i class="bi bi-boxes me-2"></i> Daftar Produk</h4>
        </div>
        <div class="card-body">
            <!-- Tombol Tambah Produk -->
            <a href="tambah_produk.php" class="btn btn-success mb-3">
                <i class="bi bi-plus-circle me-2"></i> Tambah Produk
            </a>

            <!-- Tabel Daftar Produk -->
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Produk</th>
                        <th>Harga (Rp)</th>
                        <th>Stok</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    // Loop untuk menampilkan data produk
                    while ($produk = mysqli_fetch_assoc($query)) :
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($produk['nama_produk']); ?></td>
                            <td><?= number_format($produk['harga'], 0, ',', '.'); ?></td>
                            <td><?= $produk['stok']; ?></td>
                            <td><img src="images/<?= htmlspecialchars($produk['gambar']); ?>" width="100" class="img-thumbnail"></td>
                            <td>
                                <a href="edit_produk.php?id=<?= $produk['id']; ?>" class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                </a>
                                <a href="hapus_produk.php?id=<?= $produk['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                    <i class="bi bi-trash me-1"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4 d-flex justify-content-start">
  <button class="btn btn-outline-dark rounded-pill px-4 py-2 shadow-sm" onclick="history.back()">
    <i class="bi bi-arrow-left-circle me-2"></i> Kembali
  </button>
</div>


<?php include 'partials/footer.php'; ?>


