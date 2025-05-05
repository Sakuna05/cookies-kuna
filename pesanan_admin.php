<?php
session_start();
include 'koneksi.php';

// Redirect jika belum login admin
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<?php include 'partials/header.php'; ?>

<div class="container py-4">
    <h3 class="mb-4">Data Pesanan</h3>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php elseif (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Produk Dibeli</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($conn, "SELECT * FROM pesanan ORDER BY tanggal DESC");
                        while ($row = mysqli_fetch_assoc($query)) {
                            $id_pesanan = $row['id'];
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nama_pelanggan']); ?></td>
                            <td>
                                <?php
                                $produk_query = mysqli_query($conn, "
                                    SELECT produk.nama_produk, produk.gambar 
                                    FROM detail_pesanan 
                                    JOIN produk ON detail_pesanan.produk_id = produk.id 
                                    WHERE detail_pesanan.pesanan_id = $id_pesanan
                                ");
                                while ($produk = mysqli_fetch_assoc($produk_query)) {
                                ?>
                                <div class="d-flex align-items-center mb-2 p-2 border rounded shadow-sm" style="background-color: #f8f9fa; transition: all 0.3s;">
                                    <img src="images/<?= htmlspecialchars($produk['gambar']); ?>" 
                                         alt="<?= htmlspecialchars($produk['nama_produk']); ?>"
                                         class="rounded me-2" 
                                         style="width: 50px; height: 50px; object-fit: cover;">
                                    <span class="fw-semibold"><?= htmlspecialchars($produk['nama_produk']); ?></span>
                                </div>
                                <?php } ?>
                            </td>
                            <td><?= date('d M Y', strtotime($row['tanggal'])); ?></td>
                            <td>Rp<?= number_format($row['total'], 0, ',', '.'); ?></td>
                            <td>
                                <span class="badge bg-<?= $row['status'] == 'selesai' ? 'success' : 'warning'; ?>">
                                    <?= ucfirst($row['status']); ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="ubah_status.php?id=<?= $row['id']; ?>&status=selesai" class="btn btn-success btn-sm mb-1">
                                    <i class="bi bi-check-circle"></i> Ubah Status
                                </a>
                                <br>
                                <a href="hapus_pesanan.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm mt-1" onclick="return confirm('Yakin ingin hapus pesanan ini?');">
                                    <i class="bi bi-trash"></i> Hapus
                                </a>
                            </td>


                        </tr>
                        <?php } ?>

                        <?php if (mysqli_num_rows($query) == 0): ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada pesanan.</td>
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
