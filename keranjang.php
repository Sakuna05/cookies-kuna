<?php
session_start();
if (!isset($_SESSION['keranjang']) || empty($_SESSION['keranjang'])) {
  echo "<script>alert('Keranjang masih kosong.'); location='index.php';</script>";
  exit();
}
include 'koneksi.php';
include 'partials/header.php';
?>

<div class="container py-5">
  <h2 class="text-center fw-bold mb-4">Keranjang Belanja</h2>

  <div class="table-responsive shadow-sm rounded">
    <table class="table table-bordered align-middle">
      <thead class="table-light">
        <tr>
          <th>#</th>
          <th>Produk</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th>Subtotal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $total = 0;
        foreach ($_SESSION['keranjang'] as $id => $jumlah):
          $query = mysqli_query($conn, "SELECT * FROM produk WHERE id = '$id'");
          $produk = mysqli_fetch_assoc($query);
          $subtotal = $produk['harga'] * $jumlah;
          $total += $subtotal;
        ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $produk['nama_produk']; ?></td>
          <td>Rp<?= number_format($produk['harga'], 0, ',', '.'); ?></td>
          <td><?= $jumlah; ?></td>
          <td>Rp<?= number_format($subtotal, 0, ',', '.'); ?></td>
          <td>
            <a href="hapus_keranjang.php?id=<?= $id; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus produk ini?')">
              <i class="bi bi-trash"></i> Hapus
            </a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr class="table-secondary fw-bold">
          <td colspan="4" class="text-end">Total</td>
          <td colspan="2">Rp<?= number_format($total, 0, ',', '.'); ?></td>
        </tr>
      </tfoot>
    </table>
  </div>

  <div class="text-end mt-4">
    <a href="produk.php" class="btn btn-outline-secondary">
      <i class="bi bi-arrow-left"></i> Lanjut Belanja
    </a>
    <a href="checkout.php" class="btn btn-primary">
      <i class="bi bi-cart-check"></i> Checkout
    </a>
  </div>
</div>

<?php include 'partials/footer.php'; ?>
