<?php
session_start(); // Make sure to start the session if it hasn't been started yet

// Include your database connection
include "../config/koneksi.php"; // Replace with the actual file name

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user is logged in
    if (isset($_SESSION['id_user'])) {
        // Get user input and id_user from the session
        $id_user = $_SESSION['id_user'];
        $id_video = $_POST['id_video'];
        $komentar_text = $_POST['komentar'];

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO tbl_komentar (id_user, id_video, komentar) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $id_user, $id_video, $komentar_text);

        // Execute the prepared statement
        $stmt->execute();

        // Retrieve the new comment with user details
        $query_new_comment = mysqli_query($conn, "SELECT k.*, u.username AS nama_pengguna, u.foto_profile AS foto_pengguna FROM tbl_komentar k
                        INNER JOIN tbl_user u ON k.id_user = u.id_user
                        WHERE k.id_komentar = LAST_INSERT_ID()");

        $new_comment = mysqli_fetch_assoc($query_new_comment);

        // Return the new comment as JSON response
        echo json_encode($new_comment);

        // Close the prepared statement
        $stmt->close();
    } else {
        // Handle case where the user is not logged in
        echo "User not logged in";
    }
} else {
    // Handle invalid requests
    echo "Invalid Request";
}

// Close the database connection
$conn->close();
?>
