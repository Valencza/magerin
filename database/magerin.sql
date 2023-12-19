-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2023 at 02:10 AM
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
(61, 69, 35, 'videonya keren banget bagus');

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
(34, 'Anda telah melakukan transaksi pembelian subsription tipe basic. Silahkan cek status transaksi Anda di halaman status transaksi.', 70);

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
(50, 'magerin_46052_basic', 'basic', 'garciavalencza@gmail.com', 'pending', 70);

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
(33, 'valen', '$2y$10$YN/vauTIxZf1BKuvYTmr6uYPlNE41.v2mDjCTOLGoZ0zCvOIyMqsi', 'admin', '../img/avatar/valen_garcia_avattar.png'),
(70, 'garcia', '$2y$10$xajHcVawZTgmSN0fAVpe7OFvz0RScMy7qyCFJV2zXktE.jpxGzZFO', 'user', '../img/avatar/default.png');

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
(27, 11, 'Tiga Dara', 'WIN_20231103_13_33_09_Pro.mp4', 'https://chat.openai.com/c/1e75672b-4a23-49fb-8651-c44830f07b03', 'tiga dara.jpg', 'tb tiga dara.jpg', 2012, '2h2m', '6.9', 'Tiga Dara adalah sebuah film komedi musikal Indonesia yang dirilis pada tahun 1956 dan disutradarai oleh Usmar Ismail serta dibintangi oleh Chitra Dewi, Mieke Wijaya, dan Indriati Iskak.'),
(32, 13, 'Doctor Strange', 'WIN_20231103_13_33_09_Pro.mp4', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/aWzlQ2N6qqg?si=rwsV_WfQiqixvD36\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 'doctor-strange.jpg', 'tb doctor strange.jpg', 2021, '2h9m', '9.2', 'Dr. Stephen Strange, M.D. adalah seorang dokter egois yang hanya peduli dengan kekayaan dari kariernya. Setelah kecelakaan mobil menghancurkan tulang di tangannya, dia tidak dapat melakukan operasi saat tangannya mulai bergetar tak terkendali.'),
(34, 13, 'The Mask Of Zorro', 'The Mask of Zorro (1-8) Movie CLIP - Master and Pupil (1998) HD (720p).mp4', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/abwtRFZx8Rs?si=zWu3GZaqON1Rxfyp\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 'MASK_OF_ZORRO_1400x2100_EST.jpg', '1129074.jpg', 1998, '1h24m', '8.5', 'The Mask of Zorro is a 1998 American swashbuckler film based on the fictional character of the same name created by Johnston McCulley.'),
(35, 8, 'The Flash', 'The Flash (2023) - Flash Saves the Babies Funny Scene _ Movieclips (480p).mp4', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/hebWYacbdvc?si=HCb58abxgs2c82R5\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 'the-flash.jpg', 'tb flashjpg.jpg', 2021, '1h23m', '8.9', 'The Flash adalah tokoh superhero yang dikenal kerap membantu misi superhero lain, seperti ketika Bruce Wayne disibukkan dengan penjahat yang berkeliaran di Gotham. Misi demi misi ini membantu Barry Allen semakin menguasai kekuatan supernya.'),
(36, 11, 'Refrain', 'Maudy Ayunda - Cinta Datang Terlambat (Ost. Refrain) _ Video Lirik (480p).mp4', 'https://youtu.be/U9gXPvvqkE4?si=FcNEinP0dTQX6hFu', 'refrain.jpg', 'sddefault.jpg', 2002, '1h23m', '9.8', 'Reff/Refrain yang berarti pengulangan biasanya menggunakan bagian lain dari lagu (verse) untuk diulang dibagian ini. Notasi pengulangan dan syair sama, terkadang syair juga dimodifikasi, tetapi notasi atau nada tetap menggunakan nada yang sama [3].'),
(37, 9, 'Annabelle', 'Annabelle - Official Main Trailer [HD] (480p).mp4', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/mE2G-t-i1F0?si=Dq3wJ1YFq3dCXkEm\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 'annabelle.jpg', 'HD-wallpaper-annabelle-comes-home-thumbnail.jpg', 2017, '1h24m', '9.8', 'Annabelle adalah boneka yang dipercayai berhantu yang berada di Museum Warren Occult di Monroe, Connecticut, Amerika Serikat.');

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
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `tbl_notifikasi`
--
ALTER TABLE `tbl_notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_premium`
--
ALTER TABLE `tbl_premium`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_subscription`
--
ALTER TABLE `tbl_subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  MODIFY `id_transaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `tbl_video`
--
ALTER TABLE `tbl_video`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
