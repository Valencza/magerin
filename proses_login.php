<?php
// Membuat koneksi ke database (ganti dengan informasi koneksi Anda)
include 'config/koneksi.php';

function user_notif($id_user, $message)
{
    global $conn;
    $sql = "INSERT INTO tbl_notifikasi (id_user, pesan) VALUES ($id_user, '$message')";
    $result = mysqli_query($conn, $sql);
    return $result;
}

// validate expired subscription
function validateAndDeleteExpiredRows()
{
    // Database connection parameters
    global $conn;

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Select all rows from tbl_subscription
    $sql = "SELECT * FROM tbl_subscription";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Iterate through each row
        while ($row = $result->fetch_assoc()) {
            $timeEnd = $row['time_end'];

            // Check if time_end is in the past
            if (strtotime($timeEnd) < time()) {
                // Delete the row
                $id = $row['id'];
                $deleteSql = "DELETE FROM tbl_subscription WHERE id = $id";
                user_notif($row['id_user'], 'Subscription Anda telah berakhir. Silahkan membeli subscription kembali untuk menikmati fitur premium.');
                $conn->query($deleteSql); // Perform deletion without echoing
            }
        }
    }
}

// Mengambil data dari formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    validateAndDeleteExpiredRows();

    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validasi data (gantilah dengan aturan validasi Anda)
    if (empty($username) || empty($password)) {
        echo "Harap isi semua field.";
    } else {
        // Query untuk mengambil data pengguna berdasarkan username
        $sql = "SELECT * FROM tbl_user WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            // Data pengguna ditemukan
            $row = $result->fetch_assoc();

            // Memeriksa apakah password cocok
            if (password_verify($password, $row["password"])) {
                // Password cocok, pengguna berhasil login
                session_start();
                $_SESSION["id_user"] = $row["id_user"];
                $_SESSION["email"] = $row['email'];;
                $_SESSION["username"] = $username;
                $_SESSION["level"] = $row["level"];
                $_SESSION["foto_profile"] = $row["foto_profile"];
                $_SESSION['active'] = "Login Sukses";

                if ($_SESSION["level"] == "admin") {
                    header("Location: dashboard/index.php");
                } else if ($_SESSION["level"] == "user") {
                    header("Location: user/home.php");
                } else {
                    echo "Level tidak valid.";
                }
                exit;
            } else {
                echo "Password salah.";
            }
        } else {
            echo "Username tidak ditemukan.";
        }
    }
}

// Tutup koneksi database
$conn->close();
