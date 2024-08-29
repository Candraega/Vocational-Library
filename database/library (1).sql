-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2024 at 11:57 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id_book` int(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `penulis` varchar(20) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `deskripsi` varchar(1000) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `quantity` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id_book`, `nama`, `penulis`, `jenis`, `penerbit`, `deskripsi`, `prodi`, `foto`, `quantity`) VALUES
(2, 'Atomic Habit', 'James Clear', 'Self Development', 'Gramedia', 'A guide to understanding and implementing small, incremental changes that can lead to significant improvements in one\'s life. The book emphasizes that the key to forming good habits and breaking bad ones lies in making tiny adjustments that are easily manageable and sustainable over time.\r\n\r\nClear introduces the concept of atomic habits as small, actionable steps that accumulate into remarkable results. He breaks down the science of habit formation, explaining the cue-routine-reward cycle and how to leverage it to build positive habits. The book outlines the Four Laws of Behavior Change: make it obvious, make it attractive, make it easy, and make it satisfying.', 'teknik informatika', 'book2.jpg', 0),
(3, 'Pemrograman Web', 'Adam Saputra', 'Jurusan', 'Gramedia', 'A comprehensive guide designed to teach readers the fundamentals of web development. The book covers essential topics such as HTML, CSS, and JavaScript, providing a solid foundation for creating dynamic and interactive websites.\r\n\r\nReaders will learn how to structure web pages with HTML, style them using CSS, and add interactivity with JavaScript. The book also explores advanced concepts like responsive design, front-end frameworks, and back-end development, ensuring a well-rounded understanding of modern web programming.\r\n\r\nThrough practical examples and hands-on exercises, Adam Saputra helps readers build real-world web applications, making the book suitable for beginners and those looking to enhance their web development skills.', 'Teknologi Informasi', 'buku3.png', 0),
(4, 'ega', 'candra', 'Self Development', 'Gramedia', '123 Teknik', 'Self Development', '665e8ad034a0b.jpg', 5),
(6, 'candra', 'candra', 'Self Development', 'Gramedia', '123 Teknik', 'Self Development', '665e8aff92c64.jpg', 5),
(7, 'candra', 'candra', 'Self Development', 'Gramedia', '123 Teknik', 'Self Development', '665e8b1b572c0.jpg', 8),
(8, 'candra', 'candra', 'Self Development', 'Gramedia', '123 Teknik', 'Self Development', '665e8b2ac4b5d.jpg', 8);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id_employee` int(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loaning`
--

CREATE TABLE `loaning` (
  `id_loaning` int(15) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `fullname` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nim` varchar(30) DEFAULT NULL,
  `prodi` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `id_book` int(11) NOT NULL,
  `loan_date` timestamp(1) NOT NULL DEFAULT current_timestamp(1)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loaning`
--

INSERT INTO `loaning` (`id_loaning`, `judul`, `fullname`, `username`, `nim`, `prodi`, `phone`, `id_book`, `loan_date`) VALUES
(1, 'Rich Dad Poor Dad', 'Candra Wah', 'candra', '23340701111043', 'Teknologi Informasi', '085706049122', 1, '0000-00-00 00:00:00.0'),
(2, 'Rich Dad Poor Dad', 'Samsul', '123Teknik', '233140498329423', 'Teknik Mesin', '0857347627', 1, '2024-06-03 06:26:28.0'),
(3, 'Rich Dad Poor Dad', 'Candra Wah', 'candra', '23340701111043', 'Teknologi Informasi', '085706049122', 1, '2024-06-04 02:56:00.7');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `fullname` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(30) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `prodi` varchar(20) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `fullname`, `username`, `password`, `nim`, `prodi`, `level`) VALUES
(1, 'Candra Wahyu Perdana', 'candra', '123teknik', '233140701111043', 'teknik', 'student'),
(2, 'Candra Wahyu Perdana', 'admin', 'admin', '23340701111043', 'Teknologi Informasi', 'student'),
(3, 'Candra Wahyu Perdana', 'admin', 'admin', '23340701111043', 'Teknologi Informasi', 'student'),
(4, 'Candra Wahyu Perdana', 'admin', 'admin', '23340701111043', 'Teknologi Informasi', 'student'),
(5, 'Candra Wahyu Perdana', 'admin', 'admin', '23340701111043', 'Teknologi Informasi', 'student'),
(6, 'Candra Wahyu Perdana', 'admin', 'admin', '23340701111043', 'Teknologi Informasi', 'student'),
(7, 'Candra Wahyu Perdana', 'admin', 'admin', '23340701111043', 'Teknologi Informasi', 'student'),
(8, 'Samsul', 'admin', 'admin', '123', 'Desain Grafis', 'student'),
(10, 'opa', 'operator', 'operator', '-', '-', 'operator'),
(11, 'Admin gaul', 'Admin1', 'admin1', '-', '-', 'admin'),
(12, 'Admin op', 'Admin2', 'admin2', '0', '-', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id_book`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id_employee`);

--
-- Indexes for table `loaning`
--
ALTER TABLE `loaning`
  ADD PRIMARY KEY (`id_loaning`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id_book` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id_employee` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loaning`
--
ALTER TABLE `loaning`
  MODIFY `id_loaning` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
