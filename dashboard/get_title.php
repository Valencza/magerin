<?php

if (isset($_GET['page'])) {
	switch ($_GET['page']) {
		case 'data_user':
			$title = "Data User";
			break;
		case 'data_video':
			$title = "Data Video";
			break;
		case 'data_transaksi':
			$title = "Data Transaksi";
			break;
		case 'data_komentar':
			$title = "Data Komentar";
			break;
		case 'data_kategori':
			$title = "Data Kategori";
			break;

		default:
			$title = "Halaman Tidak Ditemukan";
			break;
	}
	echo $title;
} else {
	echo "Halaman Utama";
}
