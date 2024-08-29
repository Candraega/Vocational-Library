-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2024 at 04:38 PM
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
(1, 'Rich Dad Poor Dad', 'Robert Kiyosaki', 'Self Development', 'Gramedia', 'A personal finance classic that contrasts the financial philosophies of the author’s two father figures: his biological father (the \"Poor Dad\") and the father of his best friend (the \"Rich Dad\"). The book explores the different approaches these two men took towards money, investing, and financial education.\r\n\r\nThe \"Poor Dad\" is characterized by traditional views on work, emphasizing formal education and job security, while the \"Rich Dad\" teaches the importance of financial literacy, entrepreneurship, and making money work for you. Kiyosaki shares lessons on how to build wealth through investing in assets, understanding liabilities, and developing the right mindset for financial success. The book aims to inspire readers to rethink their financial strategies and consider alternative paths to achieving financial independence.', 'Teknologi Informasi', 'buku1.jpg', 2),
(2, 'Atomic Habit', 'James Clear', 'Self Development', 'Gramedia', 'A guide to understanding and implementing small, incremental changes that can lead to significant improvements in one\'s life. The book emphasizes that the key to forming good habits and breaking bad ones lies in making tiny adjustments that are easily manageable and sustainable over time.\r\n\r\nClear introduces the concept of atomic habits as small, actionable steps that accumulate into remarkable results. He breaks down the science of habit formation, explaining the cue-routine-reward cycle and how to leverage it to build positive habits. The book outlines the Four Laws of Behavior Change: make it obvious, make it attractive, make it easy, and make it satisfying.', 'teknik informatika', 'book2.jpg', 0),
(3, 'Pemrograman Web', 'Adam Saputra', 'Jurusan', 'Gramedia', 'A comprehensive guide designed to teach readers the fundamentals of web development. The book covers essential topics such as HTML, CSS, and JavaScript, providing a solid foundation for creating dynamic and interactive websites.\r\n\r\nReaders will learn how to structure web pages with HTML, style them using CSS, and add interactivity with JavaScript. The book also explores advanced concepts like responsive design, front-end frameworks, and back-end development, ensuring a well-rounded understanding of modern web programming.\r\n\r\nThrough practical examples and hands-on exercises, Adam Saputra helps readers build real-world web applications, making the book suitable for beginners and those looking to enhance their web development skills.', 'Teknologi Informasi', 'buku3.png', 0);

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
  `nim` varchar(50) NOT NULL,
  `jumlah_buku` varchar(10) NOT NULL,
  `durasi` varchar(50) NOT NULL,
  `nama_buku` varchar(30) DEFAULT NULL,
  `id_buku` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id_mahasiswa` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `prodi` varchar(20) NOT NULL,
  `semester` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id_book` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id_employee` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loaning`
--
ALTER TABLE `loaning`
  MODIFY `id_loaning` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
