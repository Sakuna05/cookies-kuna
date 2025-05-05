<?php
session_start();
include 'koneksi.php';
include 'partials/header.php';
?>

<!-- Hero Section -->
<div class="container-fluid bg-light py-5 mb-5 hero-header">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <h1 class="display-3 text-dark mb-4">Selamat Datang di Cookies Kuna</h1>
        <p class="lead text-muted mb-4">Kelezatan kue tradisional dengan sentuhan modern. Dibuat dengan cinta, untuk momen istimewa Anda.</p>
        <a href="produk.php" class="btn btn-primary py-3 px-5">Lihat Produk</a>
      </div>
    </div>
  </div>
</div>

<!-- Produk Unggulan -->
<div class="container py-5">
  <div class="text-center mb-5">
    <h2 class="display-5 fw-bold">Produk Unggulan</h2>
    <p class="text-muted">Berbagai macam kue pilihan terbaik kami</p>
  </div>
  <div class="row">
    <?php
    $produk = mysqli_query($conn, "SELECT * FROM produk ORDER BY RAND() LIMIT 3");

    while ($row = mysqli_fetch_assoc($produk)) :
      $gambar = !empty($row['gambar']) ? $row['gambar'] : 'default.jpg';
      $nama = htmlspecialchars($row['nama_produk'] ?? 'Produk');
      $harga = number_format($row['harga'] ?? 0, 0, ',', '.');
      $id = $row['id'] ?? 0;
    ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
          <img src="images/<?= $gambar; ?>" class="card-img-top" alt="<?= $nama; ?>">
          <div class="card-body">
            <h5 class="card-title"><?= $nama; ?></h5>
            <p class="card-text">Rp<?= $harga; ?></p>
            <a href="detail.php?id=<?= $id; ?>" class="btn btn-outline-primary">Lihat Detail</a>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>

<!-- Tentang Kami -->
<div class="container-fluid bg-light py-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 mb-4 mb-md-0">
        <img class="img-fluid" style="width:500px;" src="images/about.jpg" alt="Tentang Cookies Kuna" class="img-fluid rounded shadow">
      </div>
      <div class="col-md-6">
        <h2 class="fw-bold">Tentang Cookies Kuna</h2>
        <p>Kami adalah toko kue yang menggabungkan resep tradisional dengan kualitas bahan terbaik. Kami percaya setiap gigitan adalah pengalaman yang tak terlupakan.</p>
        <ul>
          <li>Resep turun temurun</li>
          <li>Bahan berkualitas premium</li>
          <li>Rasa yang tak terlupakan</li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- CTA Section -->
<div class="container-fluid py-5 text-white text-center" style="background-color: #6c757d;">
  <div class="container">
    <h2 class="mb-4">Siap merasakan kelezatan Cookies Kuna?</h2>
    <a href="produk.php" class="btn btn-light btn-lg">Pesan Sekarang</a>
  </div>
</div>


<?php include 'partials/footer.php'; ?>