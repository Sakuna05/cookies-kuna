<?php
session_start();
session_destroy();
?>

<?php include 'partials/header.php'; ?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8 text-center">
      <div class="alert alert-info shadow">
        <i class="bi bi-box-arrow-right fs-3"></i>
        <h4 class="mt-3">Anda telah berhasil logout.</h4>
        <p>Terima kasih telah berkunjung ke Cookies Kuna!</p>
        <a href="index.php" class="btn btn-primary mt-3">
          <i class="bi bi-house-door"></i> Kembali ke Beranda
        </a>
      </div>
    </div>
  </div>
</div>

<?php include 'partials/footer.php'; ?>
