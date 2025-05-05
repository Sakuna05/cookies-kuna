<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<?php include 'partials/header.php'; ?>

<div class="container py-4">
    <h4 class="mb-4">Daftar Transaksi</h4>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $ambil = mysqli_query($conn, "SELECT * FROM pesanan
                                              JOIN pelanggan ON pesanan.nama_pelanggan = pelanggan.nama
                                              ORDER BY tanggal DESC");
                while ($pecah = mysqli_fetch_assoc($ambil)) {
                    $badge = '<span class="badge bg-secondary">Belum diketahui</span>';
                    if ($pecah['status'] == 'pending') {
                        $badge = '<span class="badge bg-warning text-dark">Pending</span>';
                    } elseif ($pecah['status'] == 'lunas') {
                        $badge = '<span class="badge bg-success">Lunas</span>';
                    } elseif ($pecah['status'] == 'ditolak') {
                        $badge = '<span class="badge bg-danger">Ditolak</span>';
                    }
                ?>
                <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td><?= $pecah['nama']; ?></td>
                    <td><?= date('d-m-Y', strtotime($pecah['tanggal'])); ?></td>
                    <td>Rp <?= number_format($pecah['total'], 0, ',', '.'); ?></td>
                    <td class="text-center"><?= $badge; ?></td>
                    <td class="text-center">
                        <a href="detail_transaksi.php?id=<?= $pecah['id']; ?>" class="btn btn-sm btn-info">
                            <i class="bi bi-search"></i> Detail
                        </a>
                        <a href="cetak_invoice.php?id=<?= $pecah['id']; ?>" class="btn btn-sm btn-secondary" target="_blank">
                            <i class="bi bi-printer"></i> Cetak
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
