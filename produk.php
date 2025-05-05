<?php
session_start();
include 'koneksi.php';
include 'partials/header.php';

$produk = mysqli_query($conn, "SELECT * FROM produk");
?>

<div class="container py-5">
  <h2 class="text-center mb-4 fw-bold">Daftar Produk</h2>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
    <?php while ($row = mysqli_fetch_assoc($produk)) : ?>
      <div class="col">
        <div class="card h-100 shadow rounded-4">
          <img src="images/<?php echo $row['gambar']; ?>" class="card-img-top rounded-top-4" alt="<?php echo $row['nama_produk']; ?>" style="height: 200px; object-fit: cover;">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title fw-semibold text-center"><?php echo $row['nama_produk']; ?></h5>
            <p class="card-text text-center text-muted">Rp <?php echo number_format($row['harga']); ?></p>
            <a href="detail.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-primary mt-auto w-100">Lihat Detail</a>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>

<div class="mt-4 d-flex justify-content-start">
  <button class="btn btn-outline-dark rounded-pill px-4 py-2 shadow-sm" onclick="history.back()">
    <i class="bi bi-arrow-left-circle me-2"></i> Kembali
  </button>
</div>


<?php include 'partials/footer.php'; ?>
