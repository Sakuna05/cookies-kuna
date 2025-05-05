<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = htmlspecialchars($_POST['nama']);
    $no_hp = htmlspecialchars($_POST['no_hp']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $tanggal = date('Y-m-d');

    $total = 0;

    foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
        $produk = mysqli_query($conn, "SELECT * FROM produk WHERE id = $id_produk");
        $data_produk = mysqli_fetch_assoc($produk);

        if (!$data_produk) {
            echo "<div class='alert alert-danger text-center'>Produk tidak ditemukan.</div>";
            exit;
        }

        $total += $data_produk['harga'] * $jumlah;
    }

    // Simpan ke tabel pesanan
    $query = mysqli_query($conn, "INSERT INTO pesanan (nama_pelanggan, no_hp, alamat, total, tanggal, status)
                VALUES ('$nama', '$no_hp', '$alamat', '$total', '$tanggal', 'pending')");

    if ($query) {
        // Ambil ID pesanan yang baru dibuat
        $pesanan_id = mysqli_insert_id($conn);

        // Simpan ke tabel detail_pesanan
        foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
            $produk = mysqli_query($conn, "SELECT * FROM produk WHERE id = $id_produk");
            $data_produk = mysqli_fetch_assoc($produk);
            $subtotal = $data_produk['harga'] * $jumlah;

            mysqli_query($conn, "INSERT INTO detail_pesanan (pesanan_id, produk_id, jumlah, subtotal)
                                VALUES ('$pesanan_id', '$id_produk', '$jumlah', '$subtotal')");
        }

        // Kosongkan keranjang
        unset($_SESSION['keranjang']);

        // Redirect ke halaman riwayat
        echo "<script>
                alert('Pesanan berhasil dibuat!');
                window.location.href = 'riwayat.php';
              </script>";
    } else {
        echo "<div class='alert alert-danger text-center'>Gagal memproses pesanan. Silakan coba lagi.</div>";
    }
} else {
    echo "<div class='alert alert-warning text-center'>Metode tidak diizinkan.</div>";
}
?>

<div class="mt-4 d-flex justify-content-start">
  <button class="btn btn-outline-dark rounded-pill px-4 py-2 shadow-sm" onclick="history.back()">
    <i class="bi bi-arrow-left-circle me-2"></i> Kembali
  </button>
</div>
