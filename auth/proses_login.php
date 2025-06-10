<?php
session_start();
require_once '../config/config.php';

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitize_input($_POST['username']);
    $password = $_POST['password']; // Password tidak perlu disanitasi karena akan dibandingkan dengan hash

    if (empty($username) || empty($password)) {
        $_SESSION['error_message'] = "Username dan Password wajib diisi.";
        $_SESSION['form_input_login'] = $_POST;
        header("location: ../auth/login.php");
        exit;
    }

    $sql = "SELECT id, username, password FROM user WHERE username = ?";

    if ($stmt = $connect->prepare($sql)) {
        $stmt->bind_param("s", $username);

        if ($stmt->execute()) {
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                $stmt->bind_result($id, $db_username, $hashed_password);
                if ($stmt->fetch()) {
                    if (password_verify($password, $hashed_password)) {
                        session_regenerate_id(true);

                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $db_username;

                        header("location: ../layout/halaman_utama.php");
                        exit;
                    } else {
                        $_SESSION['error_message'] = "Password yang Anda masukkan salah.";
                    }
                }
            } else {
                $_SESSION['error_message'] = "Akun dengan username tersebut tidak ditemukan.";
            }
        } else {
            $_SESSION['error_message'] = "Oops! Terjadi kesalahan. Silakan coba lagi nanti.";
        }
        $stmt->close();
    } else {
        $_SESSION['error_message'] = "Error preparing statement: " . $connect->error;
    }

    $_SESSION['form_input_login'] = $_POST;
    header("location: ../auth/login.php");
    exit;

    $connect->close();
} else {
    header("location: ../auth/login.php");
    exit;
}
?>