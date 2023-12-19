-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2023 at 06:25 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `magerin`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES
(7, 'Populer'),
(8, 'Action'),
(9, 'Horror'),
(10, 'Comedy'),
(11, 'Romance'),
(13, 'Premium');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_komentar`
--

CREATE TABLE `tbl_komentar` (
  `id_komentar` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_video` int(11) NOT NULL,
  `komentar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_komentar`
--

INSERT INTO `tbl_komentar` (`id_komentar`, `id_user`, `id_video`, `komentar`) VALUES
(10, 67, 24, 'Woowww film nya bagus banget'),
(11, 68, 24, 'Sumpah co bagus banget'),
(32, 67, 26, 'Woowww film nya bagus banget sumpah coo'),
(33, 68, 26, 'Bagus banget anjayy serius dehhh'),
(34, 67, 25, 'Gelo pisann'),
(35, 68, 25, 'jelek tapi nagih ini'),
(36, 67, 27, 'Sangar tenann'),
(37, 68, 27, 'asikk nihh'),
(38, 67, 28, 'UWAAAWWWW'),
(39, 68, 28, 'ASDAPSDOIASEEKKK'),
(52, 67, 28, 'woww'),
(58, 68, 27, 'vidio e ndi kok malah epan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifikasi`
--

CREATE TABLE `tbl_notifikasi` (
  `id` int(11) NOT NULL,
  `pesan` varchar(222) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_notifikasi`
--

INSERT INTO `tbl_notifikasi` (`id`, `pesan`, `id_user`) VALUES
(30, 'Anda telah melakukan transaksi pembelian subsription tipe basic. Silahkan cek status transaksi Anda di halaman status transaksi.', 68);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_premium`
--

CREATE TABLE `tbl_premium` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `durasi` varchar(50) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_premium`
--

INSERT INTO `tbl_premium` (`id`, `judul`, `harga`, `deskripsi`, `durasi`, `type`) VALUES
(2, 'Basic Plan', 1000, 'basic plan 1 bulan', '1 bulan', 'basic');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subscription`
--

CREATE TABLE `tbl_subscription` (
  `id` int(11) NOT NULL,
  `time_end` date DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `type_subscription` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_subscription`
--

INSERT INTO `tbl_subscription` (`id`, `time_end`, `id_user`, `type_subscription`) VALUES
(11, '2023-12-22', 68, 'basic');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

CREATE TABLE `tbl_transaction` (
  `id_transaction` int(11) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `type_subscription` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` varchar(50) DEFAULT 'pending',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`id_transaction`, `order_id`, `type_subscription`, `email`, `status`, `user_id`) VALUES
(46, 'magerin_40794_basic', 'basic', 'farrelyassar.k@gmail.com', 'success', 68);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(64) NOT NULL,
  `level` varchar(10) NOT NULL,
  `foto_profile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `level`, `foto_profile`) VALUES
(33, 'valen', '$2y$10$XgEAjqPx.0CnTh2L0cXdLO5aNf3F.MXDkC0NI.n5cLOvPdi4NLepG', 'admin', '../img/avatar/pngwing.com.png'),
(67, 'garcia1', '$2y$10$qPVVYP7PmFbH7J/E2uhswOHjBWwzqqYsLvD8XFq8UAHrOcXCuhB.m', 'user', '../img/avatar/kisspng-check-mark-symbol-computer-icons-clip-art-green-yes-check-mark-png-5ab1ade44b6c70.1632218515215938283089.png'),
(68, 'fairus', '$2y$10$Zd1bd0VZuStQMb/bO4IH/.mzwlRgrG8S7aw.7tkBa5u5sZu/SVVbK', 'user', '../img/avatar/Bank BRI (Bank Rakyat Indonesia) Logo (PNG-1080p) - FileVector69.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_video`
--

CREATE TABLE `tbl_video` (
  `id_video` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `video` text NOT NULL,
  `trailer` text NOT NULL,
  `image_video` varchar(255) NOT NULL,
  `thumbnail` text NOT NULL,
  `tahun` year(4) NOT NULL,
  `durasi` varchar(50) NOT NULL,
  `rating` varchar(20) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_video`
--

INSERT INTO `tbl_video` (`id_video`, `id_kategori`, `judul`, `video`, `trailer`, `image_video`, `thumbnail`, `tahun`, `durasi`, `rating`, `deskripsi`) VALUES
(24, 10, 'Comic 8', 'WIN_20231103_13_33_09_Pro.mp4', 'https://www.youtube.com/results?search_query=api+gopay+', 'comic8.jpg', 'comic8-2.jpg', 2016, '1h58m', '8.9', 'Delapan anak muda masing-masing mempunyai alasan dan motif yang berbeda-beda dalam melakukan perampokan bank. Ada yang merampok karena galau, hobi, iseng, olahraga adrenalin, bahkan ada yang merampok untuk menghidupi panti asuhan dan rakyat miskin.'),
(25, 7, 'Indiana Jones', 'WIN_20231016_10_48_18_Pro.mp4', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/mD6uSGSjgr4?si=PZ_S_kyypbKppJL4\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 'indiana-jones.jpg', 'video1.jpeg', 2023, '2h2m', '7.4', 'sdasbdias daubsjd asdbaoisbdibdouaisbdouasodvasuodvaasdvihada sd ausdvasuvduas'),
(26, 9, 'Annabelle', 'MagerinXXI - Google Chrome 2023-11-05 19-30-51.mp4', 'https://www.youtube.com/watch?v=1MFyKz7HlI8', 'annabelle.jpg', 'anabelle.jpg', 2013, '1h23m', '7.4', 'Annabelle adalah film horor supernatural Amerika tahun 2014 yang disutradarai oleh John R. Leonetti , ditulis oleh Gary Dauberman dan diproduksi oleh Peter Safran dan James Wan . Ini adalah prekuel dari film The Conjuring tahun 2013 dan bagian kedua dari franchise The Conjuring Universe .'),
(27, 11, 'Tiga Dara', 'WIN_20231103_13_33_09_Pro.mp4', 'https://chat.openai.com/c/1e75672b-4a23-49fb-8651-c44830f07b03', 'tiga dara.jpg', 'tb tiga dara.jpg', 2012, '2h2m', '6.9', 'Tiga Dara adalah sebuah film komedi musikal Indonesia yang dirilis pada tahun 1956 dan disutradarai oleh Usmar Ismail serta dibintangi oleh Chitra Dewi, Mieke Wijaya, dan Indriati Iskak.'),
(28, 8, 'The Flash', 'WIN_20231114_13_43_38_Pro.mp4', 'https://developers.google.com/adsense/management/getting_started', 'the-flash.jpg', 'tb flashjpg.jpg', 2012, '1h59m', '8.8', 'The Flash adalah tokoh superhero yang dikenal kerap membantu misi superhero lain, seperti ketika Bruce Wayne disibukkan dengan penjahat yang berkeliaran di Gotham. Misi demi misi ini membantu Barry Allen semakin menguasai kekuatan supernya.'),
(29, 7, 'Avatar', 'MagerinXXI - Google Chrome 2023-11-05 19-30-51.mp4', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/JmwDuKzbkNA?si=1N0LC0L9Ha5Zq3mq\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>\n', 'avatar.jpg', 'special26.jpg', 2012, '2h23m', '8.8', 'dasdba shvdah sdahdsa'),
(32, 13, 'Doctor Strange', 'WIN_20231103_13_33_09_Pro.mp4', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/aWzlQ2N6qqg?si=rwsV_WfQiqixvD36\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 'doctor-strange.jpg', 'tb doctor strange.jpg', 2021, '2h9m', '9.2', 'Dr. Stephen Strange, M.D. adalah seorang dokter egois yang hanya peduli dengan kekayaan dari kariernya. Setelah kecelakaan mobil menghancurkan tulang di tangannya, dia tidak dapat melakukan operasi saat tangannya mulai bergetar tak terkendali.'),
(33, 8, 'Bokep', 'MagerinXXI - Google Chrome 2023-11-05 19-30-51.mp4', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/R6u2g6SKGVU?si=m-0VFqwTHJqR6DmH\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 'IMG-20231113-WA0020.jpg', 'ERDValen.jpg', 2023, '1h15m', '5.0', 'Aww');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_komentar`
--
ALTER TABLE `tbl_komentar`
  ADD PRIMARY KEY (`id_komentar`);

--
-- Indexes for table `tbl_notifikasi`
--
ALTER TABLE `tbl_notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_premium`
--
ALTER TABLE `tbl_premium`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_subscription`
--
ALTER TABLE `tbl_subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  ADD PRIMARY KEY (`id_transaction`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tbl_video`
--
ALTER TABLE `tbl_video`
  ADD PRIMARY KEY (`id_video`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_komentar`
--
ALTER TABLE `tbl_komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbl_notifikasi`
--
ALTER TABLE `tbl_notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_premium`
--
ALTER TABLE `tbl_premium`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_subscription`
--
ALTER TABLE `tbl_subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  MODIFY `id_transaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tbl_video`
--
ALTER TABLE `tbl_video`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
