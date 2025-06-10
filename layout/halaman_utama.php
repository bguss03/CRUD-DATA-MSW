<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../auth/login.php");
    exit;
}


?>
<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Beranda</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <style>
    body, html {
      height: 100%;
      margin: 0;
      padding: 0;
    }
  </style>
</head>
<body class="bg-dark text-white d-flex align-items-center justify-content-center">

<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-8 col-lg-6">
      <div class="p-4 border rounded shadow bg-dark text-center">
        <h2 class="mb-3">Selamat Datang, <span class="text-info"><?php echo htmlspecialchars($_SESSION["username"]); ?></span>!</h2>
        <p class="mb-4">Anda telah berhasil login.</p>

        <div class="d-grid gap-3 mb-4">
          <a href="../layout/tambah.php" class="btn btn-outline-success btn-lg text-white">
            <i class="bi bi-plus-circle"></i> Tambah Data Mahasiswa
          </a>
          <a href="../layout/data.php" class="btn btn-outline-light btn-lg">
            <i class="bi bi-table"></i> Lihat Data Mahasiswa
          </a>
        </div>

        <a href="../auth/logout.php" class="btn btn-outline-danger w-100 text-white">
          <i class="bi bi-box-arrow-right"></i> Logout
        </a>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
