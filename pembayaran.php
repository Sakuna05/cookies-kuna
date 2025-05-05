<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$id_pembelian = $_GET['id'];

$ambil = mysqli_query($conn, "SELECT * FROM pembayaran 
                              JOIN pembelian ON pembayaran.id_pembelian = pembelian.id_pembelian 
                              WHERE pembayaran.id_pembelian = '$id_pembelian'");

if (mysqli_num_rows($ambil) == 0) {
    echo "<script>alert('Belum ada data pembayaran.'); location='pembelian.php';</script>";
    exit();
}

$detail = mysqli_fetch_assoc($ambil);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pembayaran - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-title {
            font-size: 1.3rem;
            font-weight: bold;
        }
        .img-thumbnail {
            max-height: 400px;
            object-fit: contain;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <a href="detail.php?id=<?= $detail['id_pembelian']; ?>" class="btn btn-secondary mb-4">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                Detail Pembayaran
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Nama:</strong><br>
                        <?= $detail['nama']; ?><br><br>
                        <strong>Bank:</strong><br>
                        <?= $detail['bank']; ?><br><br>
                        <strong>Jumlah:</strong><br>
                        Rp <?= number_format($detail['jumlah'], 0, ',', '.'); ?><br><br>
                        <strong>Tanggal:</strong><br>
                        <?= date('d-m-Y', strtotime($detail['tanggal'])); ?>
                    </div>
                    <div class="col-md-6 text-center">
                        <strong>Bukti Transfer:</strong><br>
                        <img src="../bukti/<?= $detail['bukti']; ?>" alt="Bukti Pembayaran" class="img-fluid img-thumbnail mt-2">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-start">
  <button class="btn btn-outline-dark rounded-pill px-4 py-2 shadow-sm" onclick="history.back()">
    <i class="bi bi-arrow-left-circle me-2"></i> Kembali
  </button>
</div>

</body>
</html>
