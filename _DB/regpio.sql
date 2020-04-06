-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2020 at 11:59 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `regpio`
--

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

CREATE TABLE `record` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nid` varchar(20) NOT NULL,
  `mobile` int(20) NOT NULL,
  `unionp` int(3) NOT NULL,
  `village` int(10) NOT NULL,
  `type` varchar(255) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `record`
--

INSERT INTO `record` (`id`, `name`, `nid`, `mobile`, `unionp`, `village`, `type`, `date`) VALUES
(41, 'Dewan Md. Ziaur Rahman', '6861525001', 1683113211, 1, 1, 'Corona Relief', '2019-2020');

-- --------------------------------------------------------

--
-- Table structure for table `unionpori`
--

CREATE TABLE `unionpori` (
  `id` int(3) NOT NULL,
  `union_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unionpori`
--

INSERT INTO `unionpori` (`id`, `union_name`) VALUES
(1, 'দশমিনা সদর'),
(2, 'রণগোপালদী'),
(3, 'বেতাগী সানকিপুর'),
(4, 'বহরমপুর'),
(5, 'আলীপুর'),
(6, 'বাঁশবাড়ীয়া'),
(7, 'চরবোরহান');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`) VALUES
(2, 'zia363', 'zia.1993.rahman@gmail.com', '$2y$10$sJEbiNMXQw0RwT/t7oDiBO6sBOCX7xkJsMrfv9RmVqS18UVon4HuO');

-- --------------------------------------------------------

--
-- Table structure for table `village`
--

CREATE TABLE `village` (
  `id` int(10) NOT NULL,
  `name` varchar(222) NOT NULL,
  `unionp` int(3) NOT NULL,
  `word` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `village`
--

INSERT INTO `village` (`id`, `name`, `unionp`, `word`) VALUES
(1, 'গ্রাম-১', 1, 1),
(2, 'গ্রাম-২', 1, 2),
(3, 'গ্রাম-৩', 1, 3),
(4, 'গ্রাম-৪', 1, 4),
(5, 'গ্রাম-৫', 1, 5),
(6, 'গ্রাম-৬', 1, 6),
(7, 'গ্রাম-৭', 1, 7),
(8, 'গ্রাম-১', 2, 1),
(9, 'গ্রাম-২', 2, 2),
(10, 'গ্রাম-৩', 2, 3),
(11, 'গ্রাম-৪', 2, 4),
(12, 'গ্রাম-৫', 2, 5),
(13, 'গ্রাম-৬', 2, 6),
(14, 'গ্রাম-৭', 2, 7),
(15, 'গ্রাম-১', 3, 1),
(16, 'গ্রাম-২', 3, 2),
(17, 'গ্রাম-৩', 3, 3),
(18, 'গ্রাম-৪', 3, 4),
(19, 'গ্রাম-৫', 3, 5),
(20, 'গ্রাম-৬', 3, 6),
(21, 'গ্রাম-৭', 3, 7),
(22, 'গ্রাম-১', 4, 1),
(23, 'গ্রাম-২', 4, 2),
(24, 'গ্রাম-৩', 4, 3),
(25, 'গ্রাম-৪', 4, 4),
(26, 'গ্রাম-৫', 4, 5),
(27, 'গ্রাম-৬', 4, 6),
(28, 'গ্রাম-৭', 4, 7),
(29, 'গ্রাম-১', 5, 1),
(30, 'গ্রাম-২', 5, 2),
(31, 'গ্রাম-৩', 5, 3),
(32, 'গ্রাম-৪', 5, 4),
(33, 'গ্রাম-৫', 5, 5),
(34, 'গ্রাম-৬', 5, 6),
(35, 'গ্রাম-৭', 5, 7),
(36, 'গ্রাম-১', 6, 1),
(37, 'গ্রাম-২', 6, 2),
(38, 'গ্রাম-৩', 6, 3),
(39, 'গ্রাম-৪', 6, 4),
(40, 'গ্রাম-৫', 6, 5),
(41, 'গ্রাম-৬', 6, 6),
(42, 'গ্রাম-৭', 6, 7),
(43, 'গ্রাম-১', 7, 1),
(44, 'গ্রাম-২', 7, 2),
(45, 'গ্রাম-৩', 7, 3),
(46, 'গ্রাম-৪', 7, 4),
(47, 'গ্রাম-৫', 7, 5),
(48, 'গ্রাম-৬', 7, 6),
(49, 'গ্রাম-৭', 7, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nid` (`nid`),
  ADD KEY `unionp` (`unionp`),
  ADD KEY `village` (`village`);

--
-- Indexes for table `unionpori`
--
ALTER TABLE `unionpori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `village`
--
ALTER TABLE `village`
  ADD PRIMARY KEY (`id`,`unionp`),
  ADD KEY `unionp` (`unionp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `record`
--
ALTER TABLE `record`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `record`
--
ALTER TABLE `record`
  ADD CONSTRAINT `record_ibfk_1` FOREIGN KEY (`unionp`) REFERENCES `unionpori` (`id`),
  ADD CONSTRAINT `record_ibfk_2` FOREIGN KEY (`village`) REFERENCES `village` (`id`);

--
-- Constraints for table `village`
--
ALTER TABLE `village`
  ADD CONSTRAINT `village_ibfk_1` FOREIGN KEY (`unionp`) REFERENCES `unionpori` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
