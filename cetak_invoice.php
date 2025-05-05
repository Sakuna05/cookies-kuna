<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$id_pembelian = $_GET['id'];
$ambil = mysqli_query($conn, "SELECT * FROM pembelian 
                              JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan 
                              WHERE pembelian.id_pembelian = '$id_pembelian'");
$detail = mysqli_fetch_assoc($ambil);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Invoice - Cookies Kuna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-size: 14px;
        }
        h4 {
            margin-bottom: 20px;
        }
        table th, table td {
            padding: 6px;
            vertical-align: middle;
        }
        .small-text {
            font-size: 12px;
            color: #555;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body onload="window.print()">

<div class="container mt-4">
    <h4 class="text-center">INVOICE PEMBELIAN</h4>

    <div class="row mb-3">
        <div class="col-6">
            <strong>Data Pelanggan:</strong><br>
            Nama: <?= $detail['nama']; ?><br>
            Email: <?= $detail['email']; ?><br>
            Telepon: <?= $detail['telepon']; ?><br>
        </div>
        <div class="col-6 text-end">
            <strong>Detail Transaksi:</strong><br>
            Tanggal: <?= date('d-m-Y', strtotime($detail['tanggal_pembelian'])); ?><br>
            Total: Rp <?= number_format($detail['total_pembelian'], 0, ',', '.'); ?><br>
            Status: <?= ucwords($detail['status_pembelian']); ?>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr class="table-light">
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
            $ambil_produk = mysqli_query($conn, "SELECT * FROM pembelian_produk 
                                                 JOIN produk ON pembelian_produk.id_produk = produk.id_produk 
                                                 WHERE pembelian_produk.id_pembelian = '$id_pembelian'");
            while ($pecah = mysqli_fetch_assoc($ambil_produk)) {
                $subtotal = $pecah['harga'] * $pecah['jumlah'];
                echo "<tr>
                        <td>{$no}</td>
                        <td>{$pecah['nama_produk']}</td>
                        <td>Rp " . number_format($pecah['harga'], 0, ',', '.') . "</td>
                        <td>{$pecah['jumlah']}</td>
                        <td>Rp " . number_format($subtotal, 0, ',', '.') . "</td>
                      </tr>";
                $no++;
            }
            ?>
        </tbody>
    </table>

    <div class="text-end mt-4">
        <p><strong>Total Pembayaran:</strong> Rp <?= number_format($detail['total_pembelian'], 0, ',', '.'); ?></p>
        <p class="small-text">Terima kasih telah berbelanja di Cookies Kuna!</p>
    </div>
</div>

<div class="mt-4 d-flex justify-content-start">
  <button class="btn btn-outline-dark rounded-pill px-4 py-2 shadow-sm" onclick="history.back()">
    <i class="bi bi-arrow-left-circle me-2"></i> Kembali
  </button>
</div>


</body>
</html>
