<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../auth/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      padding-bottom: 50px; /* Hindari tertutup keyboard */
    }
  </style>
</head>
<body class="bg-dark text-white">

<div class="container-fluid mt-5">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-6 col-lg-5">
      <form method="post" action="" class="p-4 border rounded shadow bg-dark">
        <h4 class="mb-4 text-center">Tambah Data Mahasiswa</h4>

        <div class="mb-4">
          <label for="nim" class="form-label">NIM</label>
          <input type="text" class="form-control bg-dark text-white border-secondary" id="nim" name="nim" placeholder="Masukkan NIM" required>
        </div>

        <div class="mb-4">
          <label for="nama" class="form-label">Nama</label>
          <input type="text" class="form-control bg-dark text-white border-secondary" id="nama" name="nama" placeholder="Masukkan Nama" required>
        </div>

        <div class="mb-4">
          <label for="fakultas" class="form-label">Fakultas</label>
          <select id="fakultas" name="fakultas" class="form-select bg-dark text-white border-secondary">
            <option selected disabled>-- PILIH --</option>
            <option value="hukum">Fakultas Hukum</option>
            <option value="ekonomi">Fakultas Ekonomi</option>
            <option value="teknik">Fakultas Teknik</option>
            <option value="ftik">Fakultas Teknologi Informasi dan Komunikasi</option>
            <option value="psikologi">Fakultas Psikologi</option>
            <option value="ftp">Fakultas Teknologi Pertanian</option>
          </select>
        </div>

        <div class="mb-4">
          <label for="prodi" class="form-label">Program Studi</label>
          <select id="prodi" name="prodi" class="form-select bg-dark text-white border-secondary">
            <option selected disabled>-- Pilih Fakultas terlebih dahulu --</option>
          </select>
        </div>

        <div class="mb-2">
          <button type="submit" class="btn btn-dark w-100 border-white mb-2">Kirim</button>
          <a href="javascript:history.back()" class="btn btn-outline-light w-100 mb-2">Kembali</a>
          <a href="../layout/halaman_utama.php" class="btn btn-outline-light w-100">Halaman Utama</a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
    include "../config/config.php";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $simpan = mysqli_query($connect, "INSERT INTO mahasiswa(nim, nama, fakultas, prodi)
                VALUES('{$_POST['nim']}', '{$_POST['nama']}', '{$_POST['fakultas']}', '{$_POST['prodi']}')");
        if ($simpan) {
            header('Location: ../layout/halaman_utama.php');
            exit;
        } else {
            echo "Gagal menyimpan data: " . mysqli_error($connect);
        }
    }
?>

<script src="../src/main.js"></script>
</body>
</html>
