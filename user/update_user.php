<?php
include '../config/koneksi.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_SESSION['email']; // Gunakan username dari sesi yang sudah ada
    $newEmail = $_POST['newEmail']; 
    $username = $_SESSION['username']; // Gunakan username dari sesi yang sudah ada
    $newUsername = $_POST['newUsername']; // Ambil username baru dari form
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validasi password lama
    $query = "SELECT password FROM tbl_user WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $hashedPassword);
    mysqli_stmt_fetch($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0 && password_verify($oldPassword, $hashedPassword)) {
        // Password lama benar, dapat melanjutkan proses edit
        if ($newPassword != '' && $newPassword == $confirmPassword) {
            // Jika pengguna ingin mengganti password
            $hashedNewPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $updatePasswordQuery = "UPDATE tbl_user SET password = ? WHERE username = ?";
            $stmt = mysqli_prepare($conn, $updatePasswordQuery);
            mysqli_stmt_bind_param($stmt, "ss", $hashedNewPassword, $username);
            mysqli_stmt_execute($stmt);
        }

        if (!empty($newUsername)) {
            $updateUsernameQuery = "UPDATE tbl_user SET username = ? WHERE username = ?";
            $stmt = mysqli_prepare($conn, $updateUsernameQuery);
            mysqli_stmt_bind_param($stmt, "ss", $newUsername, $username);
            mysqli_stmt_execute($stmt);

            // Update the session with the new username
            $_SESSION['username'] = $newUsername;
        }

        if (!empty($newEmail)) {
            $updateEmailQuery = "UPDATE tbl_user SET email = ? WHERE email = ?";
            $stmt = mysqli_prepare($conn, $updateEmailQuery);
            mysqli_stmt_bind_param($stmt, "ss", $newEmail, $email);
            mysqli_stmt_execute($stmt);

            // Update the session with the new username
            $_SESSION['email'] = $newEmail;
        }

        if ($_FILES['newProfilePicture']['name'] != '') {
            // Jika pengguna mengganti foto profil
            $targetDir = "../img/avatar/";
            $targetFile = $targetDir . $username . "_" . basename($_FILES['newProfilePicture']['name']);
            if (move_uploaded_file($_FILES['newProfilePicture']['tmp_name'], $targetFile)) {
                $updateProfilePictureQuery = "UPDATE tbl_user SET foto_profile = ? WHERE username = ?";
                $stmt = mysqli_prepare($conn, $updateProfilePictureQuery);
                mysqli_stmt_bind_param($stmt, "ss", $targetFile, $username);
                mysqli_stmt_execute($stmt);
            }
        }

        $notification = '<div class="alert alert-success">Perubahan berhasil.</div>';
        $_SESSION['notification'] = $notification;
    } else {
        // Password lama salah, kembali ke halaman edit dengan pesan error
        $notification = '<div class="alert alert-danger">Perubahan gagal. Password lama salah atau terdapat kesalahan lain.</div>';
        $_SESSION['notification'] = $notification;
    }
    header("Location: home.php");
}

// Tutup koneksi ke database
mysqli_close($conn);
