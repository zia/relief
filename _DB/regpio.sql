-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2020 at 01:20 PM
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
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nid` varchar(20) NOT NULL,
  `mobile` varchar(11) CHARACTER SET utf8 DEFAULT NULL,
  `unionp` int(3) NOT NULL,
  `ward` int(10) NOT NULL,
  `relief_type` int(1) NOT NULL,
  `fiscal_year` varchar(20) NOT NULL,
  `signature` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `name`, `nid`, `mobile`, `unionp`, `ward`, `relief_type`, `fiscal_year`, `signature`) VALUES
(41, 'Dewan Md. Ziaur Rahman', '6861525001', '01683113211', 1, 1, 4, '২০১৯-২০', NULL),
(42, 'Md. Ziaur Rahman', '19934798525000164', '01711732399', 2, 9, 2, '২০১৮-১৯', NULL),
(43, 'আব্দুর রহিম', '19937819511000166', '01765788407', 4, 22, 3, '২০১৯-২০', NULL),
(44, 'wdwdwdwddwwdwd', '12345678901234567', '02147483647', 2, 9, 4, '২০১৯-২০', NULL),
(45, 'djegjgdjgdjgj', '6861525002', '01793661290', 7, 49, 1, '২০১৯-২০২০', NULL),
(46, 'Tridip Sarker', '6861525004', '01671266777', 7, 49, 1, '২০১৯-২০২০', NULL),
(47, 'dfgfdhghghg', '6861525033', '01912849573', 1, 4, 1, '২০১৯-২০২০', NULL),
(48, 'sekjhkskhskhskhg', '6861525099', '01826625708', 5, 32, 1, '২০১৯-২০২০', NULL),
(49, 'skkfhukfhsuksfhkhf', '6861525007', '01724407551', 5, 33, 4, '২০১৯-২০২০', NULL),
(50, 'Shakib Al Hassan', '6861525009', '01912849583', 4, 22, 3, '২০১৯-২০২০', NULL),
(51, 'Tamim Iqbal', '6861525011', '01670147333', 3, 17, 2, '২০১৯-২০২০', NULL),
(52, 'AP MiRAZ', '6861525013', '01915466145', 4, 26, 4, '২০১৯-২০২০', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `relief_types`
--

CREATE TABLE `relief_types` (
  `id` int(3) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `relief_types`
--

INSERT INTO `relief_types` (`id`, `name`) VALUES
(4, 'করোনা রিলিফ'),
(1, 'টিন'),
(3, 'ভিজিএফ'),
(2, 'সোলার');

-- --------------------------------------------------------

--
-- Table structure for table `unions`
--

CREATE TABLE `unions` (
  `id` int(3) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unions`
--

INSERT INTO `unions` (`id`, `name`) VALUES
(1, 'দশমিনা সদর'),
(2, 'রণগোপালদী'),
(3, 'বেতাগী সানকিপুর'),
(4, 'বহরমপুর'),
(5, 'আলীপুর'),
(6, 'বাঁশবাড়ীয়া'),
(7, 'চরবোরহান');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(1) NOT NULL DEFAULT 0 COMMENT '0 = user, 1 = super user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(3, 'admin', 'admin@admin.admin', '$2y$10$MPe9pmDd9pe64o9myFR6YORKyD/wI5DtNi2qLdX5zbFcqT7sY9Tam', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wards`
--

CREATE TABLE `wards` (
  `id` int(10) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `unionp` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wards`
--

INSERT INTO `wards` (`id`, `name`, `unionp`) VALUES
(1, '১', 1),
(2, '২', 1),
(3, '৩', 1),
(4, '৪', 1),
(5, '৫', 1),
(6, '৬', 1),
(7, '৭', 1),
(8, '১', 2),
(9, '২', 2),
(10, '৩', 2),
(11, '৪', 2),
(12, '৫', 2),
(13, '৬', 2),
(14, '৭', 2),
(15, '১', 3),
(16, '২', 3),
(17, '৩', 3),
(18, '৪', 3),
(19, '৫', 3),
(20, '৬', 3),
(21, '৭', 3),
(22, '১', 4),
(23, '২', 4),
(24, '৩', 4),
(25, '৪', 4),
(26, '৫', 4),
(27, '৬', 4),
(28, '৭', 4),
(29, '১', 5),
(30, '২', 5),
(31, '৩', 5),
(32, '৪', 5),
(33, '৫', 5),
(34, '৬', 5),
(35, '৭', 5),
(36, '১', 6),
(37, '২', 6),
(38, '৩', 6),
(39, '৪', 6),
(40, '৫', 6),
(41, '৬', 6),
(42, '৭', 6),
(43, '১', 7),
(44, '২', 7),
(45, '৩', 7),
(46, '৪', 7),
(47, '৫', 7),
(48, '৬', 7),
(49, '৭', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nid` (`nid`),
  ADD KEY `unionp` (`unionp`),
  ADD KEY `village` (`ward`),
  ADD KEY `type` (`relief_type`);

--
-- Indexes for table `relief_types`
--
ALTER TABLE `relief_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `unions`
--
ALTER TABLE `unions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wards`
--
ALTER TABLE `wards`
  ADD PRIMARY KEY (`id`,`unionp`),
  ADD KEY `unionp` (`unionp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `relief_types`
--
ALTER TABLE `relief_types`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `records`
--
ALTER TABLE `records`
  ADD CONSTRAINT `records_ibfk_1` FOREIGN KEY (`unionp`) REFERENCES `unions` (`id`),
  ADD CONSTRAINT `records_ibfk_2` FOREIGN KEY (`ward`) REFERENCES `wards` (`id`),
  ADD CONSTRAINT `records_ibfk_3` FOREIGN KEY (`relief_type`) REFERENCES `relief_types` (`id`);

--
-- Constraints for table `wards`
--
ALTER TABLE `wards`
  ADD CONSTRAINT `wards_ibfk_1` FOREIGN KEY (`unionp`) REFERENCES `unions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
