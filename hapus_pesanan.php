<?php
session_start();
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Cek apakah pesanan ada
    $cek = mysqli_query($conn, "SELECT * FROM pesanan WHERE id = '$id'");
    if (mysqli_num_rows($cek) > 0) {

        // Hapus data terkait di detail_pesanan terlebih dahulu
        mysqli_query($conn, "DELETE FROM detail_pesanan WHERE pesanan_id = '$id'");

        // Baru hapus data utama di pesanan
        $hapus = mysqli_query($conn, "DELETE FROM pesanan WHERE id = '$id'");
        if ($hapus) {
            $_SESSION['success'] = "Pesanan berhasil dihapus.";
        } else {
            $_SESSION['error'] = "Gagal menghapus pesanan.";
        }
    } else {
        $_SESSION['error'] = "Pesanan tidak ditemukan.";
    }
} else {
    $_SESSION['error'] = "ID pesanan tidak diberikan.";
}

header("Location: pesanan_admin.php");
exit();
