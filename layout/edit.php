<?php
include "../config/config.php";

// Ambil data berdasarkan NIM
$nim = $_GET['nim'];
$sql = mysqli_query($connect, "SELECT * FROM mahasiswa WHERE nim='$nim'");
$data = mysqli_fetch_assoc($sql);

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
  <title>Edit Data</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

<div class="container-fluid mt-5">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-6 col-lg-5">
      <form method="post" action="" class="p-4 border rounded shadow bg-dark">
        <h4 class="mb-4 text-center">Edit Data Mahasiswa</h4>

        <div class="mb-4">
          <label for="nim" class="form-label">NIM</label>
          <input type="text" class="form-control bg-dark text-white border-secondary" id="nim" name="nim" required value="<?= $data['nim'] ?>">
        </div>

        <div class="mb-4">
          <label for="nama" class="form-label">Nama</label>
          <input type="text" class="form-control bg-dark text-white border-secondary" id="nama" name="nama" required value="<?= $data['nama'] ?>">
        </div>

        <div class="mb-4">
          <label for="fakultas" class="form-label">Fakultas</label>
          <select id="fakultas" name="fakultas" class="form-select bg-dark text-white border-secondary">
            <option disabled>-- PILIH --</option>
            <option value="hukum" <?= $data['fakultas'] == 'hukum' ? 'selected' : '' ?>>Fakultas Hukum</option>
            <option value="ekonomi" <?= $data['fakultas'] == 'ekonomi' ? 'selected' : '' ?>>Fakultas Ekonomi</option>
            <option value="teknik" <?= $data['fakultas'] == 'teknik' ? 'selected' : '' ?>>Fakultas Teknik</option>
            <option value="ftik" <?= $data['fakultas'] == 'ftik' ? 'selected' : '' ?>>Fakultas Teknologi Informasi dan Komunikasi</option>
            <option value="psikologi" <?= $data['fakultas'] == 'psikologi' ? 'selected' : '' ?>>Fakultas Psikologi</option>
            <option value="ftp" <?= $data['fakultas'] == 'ftp' ? 'selected' : '' ?>>Fakultas Teknologi Pertanian</option>
          </select>
        </div>

        <div class="mb-5">
          <label for="prodi" class="form-label">Program Studi</label>
          <select id="prodi" name="prodi" class="form-select bg-dark text-white border-secondary">
            <option selected><?= $data['prodi'] ?></option>
          </select>
        </div>

        <div class="mb-2">
          <button type="submit" class="btn btn-outline-success text-white w-100 mb-2">Update</button>
          <a href="javascript:history.back()" class="btn btn-outline-light w-100 mb-2">Kembali</a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $update = mysqli_query($connect, "UPDATE mahasiswa SET 
        nama = '{$_POST['nama']}',
        fakultas = '{$_POST['fakultas']}',
        prodi = '{$_POST['prodi']}'
        WHERE nim = '{$_POST['nim']}'
    ");

    if ($update) {
        header('Location: data.php');
        exit;
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($connect);
    }
}
?>

<script>
  const prodiData = {
    hukum: ["S1 Ilmu Hukum"],
    ekonomi: ["S1 Manajemen", "S1 Akuntansi", "D3 Manajemen Perusahaan"],
    teknik: ["S1 Teknik Sipil", "S1 Teknik Elektro", "S1 Perencanaan Wilayah Dan Kota"],
    psikologi: ["S1 Psikologi"],
    ftp: ["S1 Teknologi Hasil Pertanian"],
    ftik: ["S1 Teknik Informatika", "S1 Sistem Informasi", "S1 Ilmu Komunikasi", "S1 Parawisata"]
  };

  const fakultasSelect = document.getElementById("fakultas");
  const prodiSelect = document.getElementById("prodi");
  const selectedProdi = "<?= $data['prodi'] ?>";

  function populateProdi(selectedFakultas) {
    const list = prodiData[selectedFakultas] || [];
    prodiSelect.innerHTML = '<option disabled>-- Pilih Program Studi --</option>';
    list.forEach(prd => {
      const opt = document.createElement("option");
      opt.value = prd;
      opt.textContent = prd;
      if (prd === selectedProdi) {
        opt.selected = true;
      }
      prodiSelect.appendChild(opt);
    });
  }

  fakultasSelect.addEventListener("change", function () {
    populateProdi(this.value);
  });

  window.addEventListener("DOMContentLoaded", () => {
    populateProdi(fakultasSelect.value);
  });
</script>

</body>
</html>
