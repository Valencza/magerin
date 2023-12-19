<?php

session_start();
session_destroy(); // Menghentikan dan menghapus sesi
header("Location: ../login.php"); // Redirect ke halaman login setelah logout
exit();

?>
