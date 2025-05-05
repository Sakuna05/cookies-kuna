<?php
session_start();
include 'koneksi.php';

if (!isset($_POST['id_produk'], $_POST['jumlah'])) {
    echo "<script>alert('Data tidak lengkap!'); window.location='index.php';</script>";
    exit;
}

$id_produk = (int)$_POST['id_produk'];
$jumlah = (int)$_POST['jumlah'];

// Validasi jumlah
if ($jumlah < 1) {
    echo "<script>alert('Jumlah tidak valid!'); window.history.back();</script>";
    exit;
}

// Ambil data produk
$query = mysqli_query($conn, "SELECT * FROM produk WHERE id = '$id_produk'");
$produk = mysqli_fetch_assoc($query);

if (!$produk) {
    echo "<script>alert('Produk tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}

// Simpan ke session keranjang
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

// Jika sudah ada produk ini, tambahkan jumlahnya
if (isset($_SESSION['keranjang'][$id_produk])) {
    $_SESSION['keranjang'][$id_produk] += $jumlah;
} else {
    $_SESSION['keranjang'][$id_produk] = $jumlah;
}

echo "<script>alert('Produk telah ditambahkan ke keranjang!'); window.location='keranjang.php';</script>";
