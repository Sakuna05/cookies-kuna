<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus gambar terlebih dahulu
    $queryGambar = mysqli_query($conn, "SELECT gambar FROM produk WHERE id = '$id'");
    $dataGambar = mysqli_fetch_assoc($queryGambar);
    if ($dataGambar && file_exists("../img/" . $dataGambar['gambar'])) {
        unlink("../img/" . $dataGambar['gambar']);
    }

    // Hapus data produk dari database
    $query = mysqli_query($conn, "DELETE FROM produk WHERE id = '$id'");

    if ($query) {
        // Sukses
        $_SESSION['success'] = "Produk berhasil dihapus.";
    } else {
        // Gagal
        $_SESSION['error'] = "Gagal menghapus produk.";
    }
} else {
    $_SESSION['error'] = "ID produk tidak ditemukan.";
}

// Redirect kembali ke halaman produk admin
header("Location: produk_admin.php");
exit();
