<?php
    session_start();

    if (! isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: ../auth/login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Data Mahasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

  <div class="container mt-5">
    <div class="row">
      <div class="col-12">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h2>Data Mahasiswa</h2>
          <div class="d-flex flex-column flex-md-row gap-2">
            <a href="../layout/halaman_utama.php" class="btn btn-outline-light">Halaman Utama</a>
            <a href="tambah.php" class="btn btn-dark border-white">Tambah Data Baru</a>
          </div>
        </div>

        <!-- Table -->
        <div class="card bg-dark border-secondary">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-dark table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Fakultas</th>
                    <th>Program Studi</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                      include "../config/config.php";

                      $no  = 1;
                      $sql = mysqli_query($connect, "SELECT * FROM mahasiswa ORDER BY nim ASC");

                      $fakultasMap = [
                          'ftik'      => 'Fakultas Teknologi Informasi dan Komunikasi',
                          'teknik'    => 'Fakultas Teknik',
                          'ekonomi'   => 'Fakultas Ekonomi',
                          'hukum'     => 'Fakultas Hukum',
                          'psikologi' => 'Fakultas Psikologi',
                          'ftp'       => 'Fakultas Teknologi Pertanian',
                      ];

                      while ($row = mysqli_fetch_assoc($sql)) {
                          $fakultasFull = $fakultasMap[$row['fakultas']] ?? $row['fakultas'];

                          echo "<tr>
                          <td>{$no}</td>
                          <td>{$row['nim']}</td>
                          <td>{$row['nama']}</td>
                          <td>{$fakultasFull}</td>
                          <td>{$row['prodi']}</td>
                          <td>
                            <div class='d-flex flex-column flex-md-row gap-2'>
                            <a href='edit.php?nim={$row['nim']}' class='btn btn-sm btn-outline-success text-white'>Edit</a>
                            <a href='hapus.php?nim={$row['nim']}' class='btn btn-sm btn-outline-danger'>Hapus</a>
                           </div>
                          </td>

                        </tr>";
                          $no++;
                      }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- Info -->
        <div class="mt-3">
          <small class="text-muted">Total:                                           <?php echo $no - 1; ?> data mahasiswa</small>
        </div>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>