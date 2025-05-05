<?php
session_start();
include 'koneksi.php';
?>

<?php include 'partials/header.php'; ?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow rounded-4">
        <div class="card-body p-5">
          <h3 class="card-title text-center mb-4">Login Pelanggan</h3>

          <?php
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $email = $_POST["email"];
              $password = $_POST["password"];
              $result = mysqli_query($conn, "SELECT * FROM pelanggan WHERE email='$email'");

              if ($row = mysqli_fetch_assoc($result)) {
                  if (password_verify($password, $row["password"])) {
                      $_SESSION["pelanggan"] = $row;
                      echo "<div class='alert alert-success text-center'>Login berhasil. Mengalihkan...</div>";
                      echo "<meta http-equiv='refresh' content='1;url=index.php'>";
                      exit;
                  }
              }
              echo "<div class='alert alert-danger text-center'>Email atau password salah</div>";
          }
          ?>

          <form method="POST">
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control rounded-3" id="email" name="email" required>
            </div>
            <div class="mb-4">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control rounded-3" id="password" name="password" required>
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-primary py-2">Login</button>
            </div>
          </form>

          <p class="text-center mt-3">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
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
