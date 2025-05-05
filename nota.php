<?php
session_start();
include 'koneksi.php';

// if (!isset($_SESSION['admin'])) {
//     header("Location: login.php");
//     exit();
// }

$id_pembelian = $_GET['id'];
$ambil = mysqli_query($conn, "SELECT * FROM pesanan
                              JOIN pelanggan ON pesanan.nama_pelanggan = pelanggan.nama
                              WHERE pesanan.id = '$id_pembelian'");

$detail = mysqli_fetch_assoc($ambil);

$detail_pesanan = mysqli_query($conn, "SELECT * FROM detail_pesanan WHERE pesanan_id = '$id_pembelian'");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Pembelian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
        .nota-box {
            max-width: 700px;
            margin: auto;
        }
        .nota-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .nota-header h3 {
            font-weight: bold;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="nota-box my-4">
        <div class="nota-header">
            <h3>Nota Pembelian</h3>
            <p><strong>Cookies Kuna</strong><br>
            Tanggal: <?= date("d-m-Y", strtotime($detail['tanggal'])); ?><br>
            No. Nota: <?= $detail['id']; ?></p>
        </div>

        <div class="mb-4">
            <strong>Pelanggan:</strong><br>
            <?= $detail['nama']; ?><br>
            <?= $detail['no_hp']; ?><br>
            <?= $detail['alamat']; ?>
        </div>

        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; $total = 0; ?>
                <?php while ($row = mysqli_fetch_assoc($detail_pesanan)): ?>
                    <?php
                    $produk_id = $row['produk_id'];
                    $produk = mysqli_query($conn, "SELECT * FROM produk WHERE id = '$produk_id'");
                    $produk_data = mysqli_fetch_assoc($produk);
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $produk_data['nama_produk']; ?></td>
                        <td>Rp <?= number_format($produk_data['harga'], 0, ',', '.'); ?></td>
                        <td><?= $row['jumlah']; ?></td>
                        <td>Rp <?= number_format($row['subtotal'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endwhile; ?>
                <tr>
                    <td colspan="4" class="text-end"><strong>Total</strong></td>
                    <td><strong>Rp <?= number_format($detail['total'], 0, ',', '.'); ?></strong></td>
                </tr>
            </tbody>
        </table>

        <div class="text-center mt-4">
            <p>Terima kasih telah berbelanja di <strong>Cookies Kuna</strong>!</p>
        </div>

        <div class="text-center no-print mt-3">
            <a href="detail.php?id=<?= $id_pembelian ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</body>
</html>
