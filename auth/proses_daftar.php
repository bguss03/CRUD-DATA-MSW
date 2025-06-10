    <?php
    session_start();
    include "../config/config.php";

    $username = "";
    $errors = [];

    function sanitize_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validasi dan sanitasi username
        if (empty($_POST["username"])) {
            $errors[] = "Username wajib diisi.";
        } else {
            $username = sanitize_input($_POST["username"]);
            if (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
                $errors[] = "Username hanya boleh mengandung huruf, angka, dan underscore.";
            }
        }

        // Validasi password
        if (empty($_POST["password"])) {
            $errors[] = "Password wajib diisi.";
        } elseif (strlen($_POST["password"]) < 6) {
            $errors[] = "Password minimal 6 karakter.";
        } elseif ($_POST["password"] !== $_POST["confirm_password"]) {
            $errors[] = "Konfirmasi password tidak cocok.";
        }

        // Cek apakah username sudah ada
        if (empty($errors)) {
            $sql_check = "SELECT id FROM user WHERE username = ?";
            if ($stmt_check = $connect->prepare($sql_check)) {
                $stmt_check->bind_param("s", $param_username_check);
                $param_username_check = $username;

                if ($stmt_check->execute()) {
                    $stmt_check->store_result();
                    if ($stmt_check->num_rows > 0) {
                        $errors[] = "Username ini sudah digunakan.";
                    }
                } else {
                    $errors[] = "Oops! Terjadi kesalahan. Silakan coba lagi nanti (cek eksekusi).";
                }
                $stmt_check->close();
            } else {
                $errors[] = "Oops! Terjadi kesalahan. Silakan coba lagi nanti (cek prepare).";
            }
        }

        // Jika tidak ada error, masukkan data ke database
        if (empty($errors)) {
            $sql = "INSERT INTO user (username, password) VALUES (?, ?)";

            if ($stmt = $connect->prepare($sql)) {
                $stmt->bind_param("ss", $param_username, $param_password);
                $param_username = $username;
                $param_password = password_hash($_POST["password"], PASSWORD_DEFAULT);

                if ($stmt->execute()) {
                    $_SESSION['success_message'] = "Registrasi berhasil! Silakan login.";
                    header("location: ../auth/login.php");
                    exit();
                } else {
                    $_SESSION['error_message'] = "Oops! Terjadi kesalahan saat menyimpan data.";
                }
                $stmt->close();
            } else {
                $_SESSION['error_message'] = "Error preparing statement: " . $connect->error;
            }
        }

        if (!empty($errors)) {
            $_SESSION['error_message'] = implode("<br>", $errors);
            $_SESSION['form_input'] = $_POST; // Simpan input untuk diisi kembali
            header("location: ../auth/daftar.php");
            exit();
        }

        $connect->close();
    } else {
        header("location: ../auth/daftar.php");
        exit();
    }
    ?>