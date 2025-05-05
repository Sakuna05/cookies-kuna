<?php
include 'partials/header.php';
include 'koneksi.php';
?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-lg">
        <div class="card-body">
          <h3 class="card-title text-center mb-4">Daftar Akun Baru</h3>
          <form method="post" action="proses_register.php">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" name="nama" id="nama" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <div class="mb-3">
              <label for="no_hp" class="form-label">Telepon</label>
              <input type="text" class="form-control" name="no_hp" id="no_hp" required>
            </div>
            <div class="mb-3">
              <label for="alamat" class="form-label">Alamat</label>
              <textarea class="form-control" name="alamat" id="alamat" rows="3" required></textarea>
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-primary">Daftar</button>
            </div>
          </form>
          <p class="mt-3 text-center">Sudah punya akun? <a href="login.php">Login di sini</a></p>
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


<?php include 'partials/footer.php'; ?>

