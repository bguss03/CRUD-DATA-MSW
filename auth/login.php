<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: ../layout/halaman_utama.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      overflow: hidden;
    }
    .form-wrapper {
      max-height: 100vh;
      overflow-y: auto;
    }
  </style>
</head>
<body class="bg-dark text-white d-flex justify-content-center align-items-center">

<div class="container form-wrapper">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-6 col-lg-6">
      <form action="../auth/proses_login.php" method="post" class="p-4 border rounded shadow bg-dark">
        <h4 class="mb-4 text-center">Login</h4>

        <?php
        if (isset($_SESSION['error_message'])) {
            echo '<div class="alert alert-danger text-center" role="alert">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']);
        }
        if (isset($_SESSION['success_message'])) {
            echo '<div class="alert alert-success text-center" role="alert">' . $_SESSION['success_message'] . '</div>';
            unset($_SESSION['success_message']);
        }
        ?>

        <div class="mb-4">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control bg-dark text-white border-secondary" id="username" name="username" placeholder="Masukkan username" required
            value="<?php echo isset($_SESSION['form_input_login']['username']) ? htmlspecialchars($_SESSION['form_input_login']['username']) : ''; ?>">
        </div>

        <div class="mb-4">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control bg-dark text-white border-secondary" id="password" name="password" placeholder="Masukkan password" required>
        </div>

        <div class="mb-3">
          <button type="submit" class="btn btn-dark w-100 border-white mb-2">Login</button>
        </div>

        <div class="text-center">
          Belum punya akun? <a href="daftar.php" class="text-decoration-none text-info">Daftar di sini</a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
if (isset($_SESSION['form_input_login'])) {
    unset($_SESSION['form_input_login']);
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
