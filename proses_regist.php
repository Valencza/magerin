<?php
// Membuat koneksi ke database (ganti dengan informasi koneksi Anda)
include 'config/koneksi.php';

// Mengatur batas ukuran file yang diizinkan menjadi 10MB
ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '12M');

// Mengambil data dari formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $retypepassword = $_POST["retypepassword"];
    $level = $_POST["level"];

    // Validasi data (gantilah dengan aturan validasi Anda)
    if (empty($username) || empty($password) || empty($retypepassword)) {
        echo "Harap isi semua field.";
    } elseif ($password != $retypepassword) {
        echo "Password tidak cocok.";
    } else {

        $target_directory = "img/avatar/"; // Direktori penyimpanan file
        $target_file = $target_directory . basename($_FILES["foto_profile"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Periksa apakah file adalah gambar yang valid
        if (!empty($_FILES["foto_profile"]["tmp_name"])) {
            $check = getimagesize($_FILES["foto_profile"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File bukan gambar.";
                $uploadOk = 0;
            }
        }

        // Periksa apakah file sudah ada
        if (file_exists($target_file)) {
            echo "Maaf, file tersebut sudah ada.";
            $uploadOk = 0;
        }

        // Batasi ukuran file jika diperlukan
        if ($_FILES["foto_profile"]["size"] > 10000000) { // 10MB
            echo "Maaf, file terlalu besar.";
            $uploadOk = 0;
        }

        // Izinkan beberapa tipe file
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "Maaf, hanya file JPG, JPEG, dan PNG yang diizinkan.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Maaf, file tidak diunggah.";
        } else {
            if (move_uploaded_file($_FILES["foto_profile"]["tmp_name"], $target_file)) {
                // Mengenkripsi password menggunakan bcrypt
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                // Query untuk memasukkan data ke database
                $sql = "INSERT INTO tbl_user (username, password, level, foto_profile) VALUES ('$username', '$hashedPassword', '$level', '../$target_file')";

                if ($conn->query($sql) === true) {
                    echo "Registrasi berhasil! Silakan login.";
                    header("Location: login.php");
                    exit;
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Maaf, terjadi kesalahan saat mengunggah file.";
            }
        }
    }
}

// Tutup koneksi database
$conn->close();
