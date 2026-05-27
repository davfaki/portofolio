-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2025 at 02:39 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teknisibaik`
--

-- --------------------------------------------------------

--
-- Table structure for table `orderperbaikan`
--

CREATE TABLE `orderperbaikan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `hp` varchar(16) NOT NULL,
  `layananperbaikan` varchar(100) NOT NULL,
  `merk` varchar(100) NOT NULL,
  `jenisperbaikan` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` varchar(8) NOT NULL,
  `alamat` varchar(300) NOT NULL,
  `status` varchar(100) NOT NULL,
  `teknisi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderperbaikan`
--

INSERT INTO `orderperbaikan` (`id`, `nama`, `hp`, `layananperbaikan`, `merk`, `jenisperbaikan`, `tanggal`, `waktu`, `alamat`, `status`, `teknisi`) VALUES
(31, 'Wahyudi', '0899993939', 'Mobil', 'avanza', 'ganti oli', '2021-12-17', '08:30', 'Jl.Husein Sastra Negara no.5 Tangerang', 'Canceled', 'soleh'),
(32, 'Vicky', '0899999999', 'Kulkas', 'LG', 'isi freon', '2021-12-17', '10:40', 'Jl. Gelong Baru, Jakarta Barat', 'Menunggu Teknisi', ''),
(33, 'nana', '0899999999', 'Mesin Cuci', 'SAMSUNG', 'Mesin cuci mati', '2021-12-17', '14:29', 'Batu Ceper Tangerang', 'Dalam Penanganan', 'test'),
(34, 'kholik', '0899993939', 'TV', 'Polytron', 'TV Mati', '2021-12-17', '10:00', 'Jurumudi, Tangerang', 'Completed', 'test'),
(35, 'Andi', '0899993939', 'TV', 'LG', 'TV Mati', '2021-12-17', '09:38', 'Jakarta', 'Completed', 'soleh'),
(36, 'user', '0823131245', 'Mesin Cuci', 'Sharp', 'Rusak', '2025-06-15', '22:03', 'test', 'Completed', 'test'),
(37, 'user', '0812345435', 'Layanan Perbaikan Mesin Cuci', 'Sharp', 'Meledak', '2025-06-25', '06:28', 'Disono', 'Completed', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `hp` varchar(16) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `username`, `hp`, `email`, `password`) VALUES
(1, 'Wahyudi', 'why14', '0899999999', 'wahyu@gmail.com', '$2y$10$ItKSMghLC3URxUOd6rxo/uTpjqjos1YZalxnqWzl0u/vXhLtUSGi2'),
(3, 'Ari Untung', 'arie123', '0899993939', 'arie@gmail.com', '$2y$10$lTKXnwtfowhmsOsecO6Ks.eDiyNHmONvt6V87R527oGsOyuD2HrhC'),
(5, 'Vicky', 'vicky123', '0899999999', 'vicky@gmail.com', '$2y$10$0LGm4NI/zy1j9vG/wui7NOWmPMsp60hNFtkcvZQg1WDMcCZOYnf1G'),
(6, 'Agus Sutanto', 'agus12', '0899999999', 'agus@gmail.com', '$2y$10$t3YSzRFg9DYGvF4WLmNgtOlguwiUSyK7hnT0hQ0m8EVug/bkGClii'),
(8, 'nana', 'nana', '0899999999', 'nana@gmail.com', '$2y$10$59s21JAaU8sGpAaEW.u5QeYSuFwQDIprZ9uFSk.vfs7YadUoFt0x.'),
(9, 'kholik', 'kholik', '08997772222', 'kholik@gmail.com', '$2y$10$MaHDI/BQg1KnIJeHgJ0mi.Iw9nWNelF18fv43Qh68EevFH0/JSmeu'),
(11, 'Yuni Sarah', 'yuni', '09998876555', 'yuni@gmail.com', '$2y$10$g6AqF9nkMLL8YgI7OWZHm.K2iGWSYeij9sOOPOgRIAPz9aU1oonYq'),
(12, 'Andi', 'andi', '0899993939', 'andi@gmail.com', '$2y$10$WsOPViQ1wV2Mb0NQud5eFeyAjpUh6p53BgHcOMzTW5wgF3AMIS1Vq'),
(13, 'user', 'user', '0823131245', 'user@gmail.com', '$2y$10$Yq/ftB06eGC7Ej69PqF7euf2KFN6wiYrSB3cMMDi2nNZTigZGnpSq');

-- --------------------------------------------------------

--
-- Table structure for table `teknisi`
--

CREATE TABLE `teknisi` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `hp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `keahlian` varchar(100) NOT NULL,
  `alamat` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teknisi`
--

INSERT INTO `teknisi` (`id`, `nama`, `username`, `hp`, `email`, `password`, `keahlian`, `alamat`) VALUES
(4, 'Wahyudi', 'why14', '0899993939', 'wahyu@gmail.com', '$2y$10$YtAViW0rm06ApIDJ.XJcF.Y0CuKPEjtPS.8Z7xXuXb0CYFdNgAgp6', 'teknisi listrik', 'Jl. aja dulu'),
(5, 'Kenny', 'keny12', '09998876555', 'keny@gmail.com', '$2y$10$1C/O4mT/NbQMtojEA1FUdOAu1/6t2dW2D/jvLsrqhbhwAzkezdBTm', 'teknisi mobil', 'Cengkareng Jakarta Barat'),
(7, 'Rulliansyah', 'ruli', '0899999999', 'Rulli@gmail.com', '$2y$10$Xl.D8gic1HBaFTk7O.SAR.i7wshzY5cS5tAdcgkHd5/kD08CVWDly', 'teknisi pendingin', 'Jakarta'),
(8, 'Galih', 'galih123', '0899999999', 'galih@gmail.com', '$2y$10$5qyKWEQJbEWms5NuXbrlJetwfXDwjdh1Fr0ipDKehvfeeQ76CsHj.', 'teknisi electronic', 'Jl.kaki saja sampe'),
(9, 'Suhandi', 'handi', '0899999999', 'handi@gmail.com', '$2y$10$9ZPp0j6Wtvwho8H2APIJSupUovqpoE0NLl5LpHlR4snjt11/af4n6', 'teknisi mobil', 'Jakarta'),
(10, 'Heri', 'heri', '0877595959', 'heri@gmail.com', '$2y$10$YfXVlNbxm1wFM7OXsb/vp.U3EUzV7OkH2NtSif3BzV44RHTeKqeMW', 'teknisi pendingin', 'jakarta'),
(11, 'soleh', 'soleh', '0899999999', 'soleh@gmail.com', '$2y$10$X0OD/VRG1/IVKCd3CWwXSuFnQ4VaCwwYUYp4uBOShhhTR2hTGWEKC', 'teknisi mobil', 'Jakarta'),
(12, 'test', 'test', '0812345435', 'test@gmail.com', '$2y$10$um8va7sNJnDOLuzyJONCa.p1K.20UBPS9xLtV62.EUc2GaFNjo7Py', 'teknisi mobil', 'Jl. Amerika');

-- --------------------------------------------------------

--
-- Table structure for table `tipeperbaikan`
--

CREATE TABLE `tipeperbaikan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipeperbaikan`
--

INSERT INTO `tipeperbaikan` (`id`, `nama`, `icon`) VALUES
(2, 'Layanan Perbaikan Mesin Cuci', 'icon_684ebe6735363.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orderperbaikan`
--
ALTER TABLE `orderperbaikan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teknisi`
--
ALTER TABLE `teknisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipeperbaikan`
--
ALTER TABLE `tipeperbaikan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orderperbaikan`
--
ALTER TABLE `orderperbaikan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `teknisi`
--
ALTER TABLE `teknisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tipeperbaikan`
--
ALTER TABLE `tipeperbaikan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
