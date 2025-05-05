<?php
include 'koneksi.php';

// Mengambil ID dari URL dengan pengecekan
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$status = isset($_GET['status']) ? $_GET['status'] : '';

// Daftar status yang diizinkan
$allowed_status = ['pending', 'diproses', 'selesai'];

// Mengecek apakah status yang diterima valid
if (!in_array($status, $allowed_status)) {
    echo "<script>
            alert('Status tidak valid.');
            window.location.href = 'pesanan_admin.php';
          </script>";
    exit;
}

// Menggunakan prepared statement untuk keamanan
$query = "UPDATE pesanan SET status = ? WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "si", $status, $id); // 'si' berarti string dan integer

// Eksekusi query
$result = mysqli_stmt_execute($stmt);

// Mengecek hasil eksekusi
if ($result) {
    echo "<script>
            alert('Status pesanan berhasil diperbarui.');
            window.location.href = 'pesanan_admin.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal mengubah status.');
            window.history.back();
          </script>";
}

// Menutup prepared statement
mysqli_stmt_close($stmt);
?>
