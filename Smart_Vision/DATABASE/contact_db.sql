-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2025 at 02:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contact_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `course_year` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `looking_for` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `full_name`, `age`, `birth_date`, `course_year`, `email`, `address`, `looking_for`, `message`) VALUES
(200000, 'Albert Trillanes ', 21, '2003-01-01', 'BSIS3', 'SOPRETTY@gmail.com', 'Hamtic', 'Love', 'hi hello goodbye gggdgfd'),
(1111111, 'Cassel Cilon', 21, '2003-10-10', 'BSIS3', 'MAOY@gmail.com', 'Comon', 'Girls', 'MAOYYYY'),
(1234567, 'Dwayne Near', 21, '2003-10-03', 'BSIS3', 'dwaynenear87@gmail.com', 'Bayo Grande Anini-y Antique', 'Money', 'moneymoney'),
(3232323, 'Cy', 21, '2003-05-05', 'BSIS3', 'cy@gmail.com', 'Patnongon', 'Mawmaw', 'aaaaaaaaaaaah'),
(3333333, 'Bojort Jobert', 56, '1987-12-19', 'BSIS3', 'boj@gmai.com', 'Igkaputol', 'Potato', 'papaya'),
(12345678, 'Ricmar', 21, '2001-12-12', 'BSIS3', 'ricmarpogi@gmail.com', 'Barbaza', 'Wilson', 'Maria labo'),
(75745737, 'Neji', 25, '2001-09-09', 'BSIS3', 'neji@gmail.com', 'Patnongon', 'Wife', 'PISBOK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
