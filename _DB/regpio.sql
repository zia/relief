-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2020 at 03:38 PM
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
-- Table structure for table `emg_reliefs`
--

CREATE TABLE `emg_reliefs` (
  `id` int(3) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nid` varchar(17) CHARACTER SET utf8 DEFAULT NULL,
  `mobile` varchar(11) CHARACTER SET utf8 NOT NULL,
  `unionp` int(1) DEFAULT NULL,
  `ward` int(1) DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 NOT NULL,
  `relief_type` int(3) NOT NULL DEFAULT 6,
  `age` int(3) DEFAULT 0,
  `gender` int(1) NOT NULL DEFAULT 1,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emg_reliefs`
--

INSERT INTO `emg_reliefs` (`id`, `name`, `nid`, `mobile`, `unionp`, `ward`, `address`, `relief_type`, `age`, `gender`, `created_on`) VALUES
(1, 'Dewan Md. Ziaur Rahman', '', '01711732399', 0, 0, 'Dashmina', 6, 0, 1, '2020-04-16 15:36:09');

-- --------------------------------------------------------

--
-- Table structure for table `officials`
--

CREATE TABLE `officials` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `grade` int(11) DEFAULT 99
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `officials`
--

INSERT INTO `officials` (`id`, `name`, `designation`, `phone`, `email`, `grade`) VALUES
(1, 'এস এম শাহজাদা', 'মাননীয় সংসদ সদস্য পটুয়াখালী-১১৩', '০১৭৫৯০০০০০০', NULL, 4),
(2, 'মোঃ আব্দুল আজীজ', 'উপজেলা চেয়ারম্যান', '০১৭১৬৫৮৯৬৬০', NULL, 5),
(3, 'মোছাঃ তানিয়া ফেরদৌস', 'উপজেলা নির্বাহী কর্মকর্তা', '০১৭৩৩৩৩৪১৫১', 'unodashmina@mopa.gov.bd', 6);

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(3) NOT NULL DEFAULT 0,
  `gender` int(1) NOT NULL DEFAULT 1,
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

INSERT INTO `records` (`id`, `name`, `age`, `gender`, `nid`, `mobile`, `unionp`, `ward`, `relief_type`, `fiscal_year`, `signature`) VALUES
(41, 'Dewan Md. Ziaur Rahman', 0, 1, '6861525001', '01683113211', 1, 1, 4, '২০১৯-২০', NULL),
(42, 'Md. Ziaur Rahman', 0, 1, '19934798525000164', '01711732399', 2, 9, 2, '২০১৮-১৯', NULL),
(43, 'আব্দুর রহিম', 0, 1, '19937819511000166', '01765788407', 4, 22, 3, '২০১৯-২০', NULL),
(44, 'wdwdwdwddwwdwd', 0, 1, '12345678901234567', '02147483647', 2, 9, 4, '২০১৯-২০', NULL),
(45, 'djegjgdjgdjgj', 0, 1, '6861525002', '01793661290', 7, 49, 1, '২০১৯-২০২০', NULL),
(46, 'Tridip Sarker', 0, 1, '6861525004', '01671266777', 7, 49, 1, '২০১৯-২০২০', NULL),
(47, 'dfgfdhghghg', 0, 1, '6861525033', '01912849573', 1, 4, 1, '২০১৯-২০২০', NULL),
(48, 'sekjhkskhskhskhg', 0, 1, '6861525099', '01826625708', 5, 32, 1, '২০১৯-২০২০', NULL),
(49, 'skkfhukfhsuksfhkhf', 0, 1, '6861525007', '01724407551', 5, 33, 4, '২০১৯-২০২০', NULL),
(50, 'Shakib Al Hassan', 0, 1, '6861525009', '01912849583', 4, 22, 3, '২০১৯-২০২০', NULL),
(51, 'Tamim Iqbal', 0, 1, '6861525011', '01670147333', 3, 17, 2, '২০১৯-২০২০', NULL),
(52, 'AP MiRAZ', 0, 1, '6861525013', '01915466145', 4, 26, 4, '২০১৯-২০২০', NULL),
(53, 'Mustafizur Rahman', 0, 1, '19934798525000166', '01683113212', 2, 10, 1, '২০১৮-২০১৯', NULL),
(54, 'Mustafizur Rahman', 0, 1, '19934798525000162', '01683113213', 2, 10, 1, '২০১৮-২০১৯', NULL),
(55, 'MustFIZUR Rahman', 0, 1, '19934798525000167', '01683113217', 3, 17, 4, '২০১৮-২০১৯', NULL),
(56, 'dewanmdziaurrahman', 0, 1, '6861525017', '01711732398', 3, 18, 4, '২০১৮-২০১৯', NULL),
(57, 'dewanmdziaurrahman', 0, 1, '6861525003', '01712345677', 1, 3, 4, '২০১৯-২০২০', NULL),
(58, 'Dewan Md. Ziaur Rahman', 33, 1, '6861525005', '01711732397', 1, 1, 4, '২০১৮-২০১৯', NULL);

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
(5, 'অন্যান্য'),
(4, 'করোনা রিলিফ'),
(6, 'জরুরী ত্রাণ সাহায্য'),
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
-- Table structure for table `upazilas`
--

CREATE TABLE `upazilas` (
  `id` int(11) NOT NULL,
  `name` varchar(9) CHARACTER SET utf8 NOT NULL DEFAULT 'galachipa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `upazilas`
--

INSERT INTO `upazilas` (`id`, `name`) VALUES
(1, 'গলাচিপা'),
(2, 'দশমিনা');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(1) NOT NULL DEFAULT 0 COMMENT '0 = user, 1 = super user',
  `otp` int(5) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0 = inactive 1 = active',
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `designation`, `username`, `email`, `phone`, `password`, `role`, `otp`, `status`, `created_on`) VALUES
(7, NULL, NULL, 'admin', 'admin@admin.admin', NULL, '$2y$10$LgrolfkI3jL9nGZXAfqVp.R3QWrT/m0Lg30IuJg5ty.jweHi8Ep.m', 1, NULL, 1, '2020-04-14 00:00:00'),
(8, 'Dewan Md. Ziaur Rahman', 'Assistant Programmer', 'zia363', 'zia.doict@gmail.com', '01683113211', '$2y$10$khpBZ1lr8W/ulKENUxjbPeVqtNdA8CGmpE2OgORY92cNXutUHjBYy', 0, NULL, 1, '2020-04-14 18:41:47');

-- --------------------------------------------------------

--
-- Table structure for table `volunteers`
--

CREATE TABLE `volunteers` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` int(1) NOT NULL DEFAULT 1 COMMENT '0 = female 1 = male',
  `occupation` int(2) NOT NULL DEFAULT 0 COMMENT '0 = jobless 1 = student',
  `dob` date NOT NULL,
  `experience` int(1) NOT NULL DEFAULT 0 COMMENT '0 = No 1 = Yes',
  `fit` int(1) NOT NULL DEFAULT 1 COMMENT '0 = No 1 = Yes',
  `mobile` varchar(12) NOT NULL,
  `alternate_mobile` varchar(12) DEFAULT NULL,
  `self_unionp` int(1) NOT NULL,
  `self_ward` int(1) NOT NULL,
  `blood_group` int(1) DEFAULT NULL,
  `last_14_days` varchar(255) DEFAULT NULL,
  `nid` varchar(17) NOT NULL,
  `fathers_name` varchar(50) DEFAULT NULL,
  `mothers_name` varchar(50) DEFAULT NULL,
  `preferred_ward` int(1) NOT NULL,
  `preferred_unionp` int(1) NOT NULL,
  `approved` int(1) NOT NULL DEFAULT 0 COMMENT '0 = No 1 = Yes',
  `address` varchar(255) DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `volunteers`
--

INSERT INTO `volunteers` (`id`, `name`, `gender`, `occupation`, `dob`, `experience`, `fit`, `mobile`, `alternate_mobile`, `self_unionp`, `self_ward`, `blood_group`, `last_14_days`, `nid`, `fathers_name`, `mothers_name`, `preferred_ward`, `preferred_unionp`, `approved`, `address`, `created_on`) VALUES
(3, 'Dewan Md. Ziaur Rahman', 1, 2, '0000-00-00', 1, 0, '01683113211', '01711732399', 4, 5, 3, 'Dashmina', '6861525001', 'Md. Zillur Rahman', 'Badiun Nessa', 5, 1, 0, 'dashmina', '2020-04-16 12:47:29');

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
-- Indexes for table `emg_reliefs`
--
ALTER TABLE `emg_reliefs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `relief_type` (`relief_type`);

--
-- Indexes for table `officials`
--
ALTER TABLE `officials`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `upazilas`
--
ALTER TABLE `upazilas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `volunteers`
--
ALTER TABLE `volunteers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nid` (`nid`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD KEY `self_union` (`self_unionp`),
  ADD KEY `self_ward` (`self_ward`),
  ADD KEY `preferred_ward` (`preferred_ward`),
  ADD KEY `preferred_union` (`preferred_unionp`);

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
-- AUTO_INCREMENT for table `emg_reliefs`
--
ALTER TABLE `emg_reliefs`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `officials`
--
ALTER TABLE `officials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `relief_types`
--
ALTER TABLE `relief_types`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `upazilas`
--
ALTER TABLE `upazilas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `volunteers`
--
ALTER TABLE `volunteers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
