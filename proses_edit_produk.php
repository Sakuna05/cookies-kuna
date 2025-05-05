<?php
session_start();
if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Anda harus login sebagai admin'); location='login_admin.php';</script>";
    exit;
}

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id     = $_POST['id'];
    $nama   = htmlspecialchars($_POST['nama']);
    $harga  = $_POST['harga'];
    $stok   = $_POST['stok'];

    // Ambil data lama untuk cek gambar
    $result = mysqli_query($conn, "SELECT gambar FROM produk WHERE id = '$id'");
    $produk = mysqli_fetch_assoc($result);
    $gambar_lama = $produk['gambar'];

    // Cek apakah ada file gambar baru di-upload
    if (!empty($_FILES['gambar']['name'])) {
        $gambar_baru = $_FILES['gambar']['name'];
        $tmp         = $_FILES['gambar']['tmp_name'];
        $ext         = pathinfo($gambar_baru, PATHINFO_EXTENSION);
        $nama_file   = uniqid() . '.' . $ext;

        move_uploaded_file($tmp, "img/" . $nama_file);

        // Hapus gambar lama jika ada
        if (!empty($gambar_lama) && file_exists("img/" . $gambar_lama)) {
            unlink("img/" . $gambar_lama);
        }

        $gambar = $nama_file;
    } else {
        $gambar = $gambar_lama;
    }

    $query = mysqli_query($conn, "UPDATE produk SET 
    nama_produk = '$nama', 
    harga = '$harga', 
    stok = '$stok', 
    gambar = '$gambar' 
    WHERE id = '$id'
");


    if ($query) {
        echo "<script>alert('Produk berhasil diperbarui!'); location='produk_admin.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui produk.'); history.back();</script>";
    }
} else {
    echo "<script>alert('Akses tidak diizinkan'); location='produk_admin.php';</script>";
}
?>

<div class="mt-4 d-flex justify-content-start">
  <button class="btn btn-outline-dark rounded-pill px-4 py-2 shadow-sm" onclick="history.back()">
    <i class="bi bi-arrow-left-circle me-2"></i> Kembali
  </button>
</div>
