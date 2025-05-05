<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$id_pembelian = $_GET['id'];
$ambil = mysqli_query($conn, "SELECT * FROM pesanan
                              JOIN pelanggan ON pesanan.nama_pelanggan = pelanggan.nama
                              WHERE pesanan.id = '$id_pembelian'");
$detail = mysqli_fetch_assoc($ambil);
?>

<?php include 'partials/header.php'; ?>

<div class="container py-4">
    <h4 class="mb-4">Detail Transaksi</h4>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="card-title mb-3">Pelanggan</h5>
                    <p><strong>Nama:</strong> <?= $detail['nama']; ?></p>
                    <p><strong>Email:</strong> <?= $detail['email']; ?></p>
                    <p><strong>Telepon:</strong> <?= $detail['no_hp']; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="card-title mb-3">Pembelian</h5>
                    <p><strong>Tanggal:</strong> <?= date('d-m-Y', strtotime($detail['tanggal'])); ?></p>
                    <p><strong>Total:</strong> Rp <?= number_format($detail['total'], 0, ',', '.'); ?></p>
                    <p><strong>Status:</strong>
                        <?php
                        $status = $detail['status'];
                        $badge = '<span class="badge bg-secondary">Belum diketahui</span>';
                        if ($status == 'pending') $badge = '<span class="badge bg-warning text-dark">Pending</span>';
                        if ($status == 'lunas') $badge = '<span class="badge bg-success">Lunas</span>';
                        if ($status == 'ditolak') $badge = '<span class="badge bg-danger">Ditolak</span>';
                        echo $badge;
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <h5>Produk yang Dibeli</h5>
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $ambil_produk = mysqli_query($conn, "SELECT * FROM detail_pesanan
                                                     JOIN produk ON detail_pesanan.produk_id = produk.id
                                                     WHERE detail_pesanan.id = '$id_pembelian'");
                while ($pecah = mysqli_fetch_assoc($ambil_produk)) {
                ?>
                <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td><?= $pecah['nama_produk']; ?></td>
                    <td>Rp <?= number_format($pecah['harga'], 0, ',', '.'); ?></td>
                    <td class="text-center"><?= $pecah['jumlah']; ?></td>
                    <td>Rp <?= number_format($pecah['harga'] * $pecah['jumlah'], 0, ',', '.'); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4 d-flex justify-content-start">
  <button class="btn btn-outline-dark rounded-pill px-4 py-2 shadow-sm" onclick="history.back()">
    <i class="bi bi-arrow-left-circle me-2"></i> Kembali
  </button>
</div>


<?php include 'partials/footer.php'; ?>
