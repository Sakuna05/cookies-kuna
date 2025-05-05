<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Admin - Cookies Kuna</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Playfair Display', serif;
      background-color: #f8f9fa;
    }
    .login-container {
      max-width: 400px;
      margin: 80px auto;
      padding: 30px;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

<div class="container">
  <div class="login-container">
    <h3 class="text-center mb-4">Login Admin</h3>
    <form action="proses_login_admin.php" method="POST">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" class="form-control" id="username" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password" required>
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
    </form>
    <div class="text-center mt-3">
      <a href="index.php" class="text-decoration-none"><i class="bi bi-arrow-left"></i> Kembali ke Beranda</a>
    </div>
  </div>
</div>

</body>
</html>
