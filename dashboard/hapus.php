<?php
if (isset($_GET['hapus'])) {
	require "../config/koneksi.php";
	switch ($_GET['hapus']) {
		case 'data_user':
			mysqli_query($conn, "DELETE FROM tbl_user WHERE id_user=" . $_GET['id_user']);
			header('Location:index.php?page=' . $_GET['hapus']);
			break;
		case 'data_video':
			mysqli_query($conn, "DELETE FROM tbl_video WHERE id_video=" . $_GET['id_video']);
			header('Location:index.php?page=' . $_GET['hapus']);
			break;
		case 'data_transaksi':
			mysqli_query($conn, "DELETE FROM tbl_transaction WHERE id_transaction=" . $_GET['id_transaction']);
			header('Location:index.php?page=' . $_GET['hapus']);
			break;
		case 'data_komentar':
			mysqli_query($conn,  "DELETE FROM tbl_komentar WHERE id_komentar=" . $_GET['id_komentar']);
			header('Location:index.php?page=' . $_GET['hapus']);
			break;
		case 'data_kategori':
			mysqli_query($conn, "DELETE FROM tbl_kategori WHERE id_kategori=" . $_GET['id_kategori']);
			header('Location:index.php?page=' . $_GET['hapus']);
			break;

		default:
			require_once("pages/404.php");
			break;
	}
} else {
	require_once("pages/home.php");
}
