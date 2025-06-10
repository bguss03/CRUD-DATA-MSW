<?php
session_start();

$_SESSION = array(); // Hapus semua variabel session
session_destroy();    // Hancurkan session

header("location: ../auth/login.php"); // Arahkan ke halaman login
exit;
?>