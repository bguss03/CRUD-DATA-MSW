<?php
include "../config/config.php";

if (!isset($_GET['nim'])) {
  header('Location: halaman_utama.php');
  exit;
}

$nim = $_GET['nim'];
$sql = mysqli_query($connect, "SELECT * FROM mahasiswa WHERE nim='$nim'");
$data = mysqli_fetch_assoc($sql);

if (!$data) {
  echo "<script>alert('Data tidak ditemukan'); window.location='halaman_utama.php';</script>";
  exit;
}

if (isset($_POST['hapus'])) {
  $hapus = mysqli_query($connect, "DELETE FROM mahasiswa WHERE nim='$nim'");
  if ($hapus) {
    echo "<script>alert('Data berhasil dihapus'); window.location='data.php';</script>";
  } else {
    echo "<script>alert('Gagal menghapus data');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Konfirmasi Hapus</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-8 col-lg-6">
      <div class="card bg-dark border-danger shadow">
        <div class="card-header bg-danger text-white text-center">
          <h5 class="mb-0">⚠️ Konfirmasi Hapus Data</h5>
        </div>
        <div class="card-body">
          <div class="text-center mb-4">
            <p class="mb-3">Apakah Anda yakin ingin menghapus data mahasiswa berikut?</p>
            
            <div class="border border-secondary rounded p-3 mb-4 table-responsive">
              <table class="table table-dark table-borderless mb-0">
                <tr><td><strong>NIM</strong></td><td>:</td><td><?= $data['nim'] ?></td></tr>
                <tr><td><strong>Nama</strong></td><td>:</td><td><?= $data['nama'] ?></td></tr>
                <tr><td><strong>Fakultas</strong></td><td>:</td><td><?= $data['fakultas'] ?></td></tr>
                <tr><td><strong>Program Studi</strong></td><td>:</td><td><?= $data['prodi'] ?></td></tr>
              </table>
            </div>

            <div class="alert alert-warning" role="alert">
              <small><strong>Peringatan:</strong>  Data yang dihapus tidak dapat dikembalikan. Lanjutkan?</small>
            </div>
          </div>

          <form method="POST">
            <div class="d-grid gap-2">
              <button type="submit" name="hapus" class="btn btn-danger">Ya, Hapus Data</button>
              <a href="data.php" class="btn btn-secondary">Batal</a>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
