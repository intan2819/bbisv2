-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2020 at 01:42 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bbisv2`
--

-- --------------------------------------------------------

--
-- Table structure for table `bloodbag`
--

CREATE TABLE `bloodbag` (
  `id` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `displayBloodbagID` varchar(10) DEFAULT NULL,
  `bloodType` varchar(5) NOT NULL,
  `donorID` int(11) NOT NULL,
  `retrievedDate` date NOT NULL,
  `expiryDate` date NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'In Stock',
  `dateCreated` datetime NOT NULL,
  `lastEdited` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bloodbag`
--

INSERT INTO `bloodbag` (`id`, `productID`, `displayBloodbagID`, `bloodType`, `donorID`, `retrievedDate`, `expiryDate`, `status`, `dateCreated`, `lastEdited`) VALUES
(1, 10, 'RBC1000001', 'A', 2, '2020-06-02', '2020-07-07', 'Discarded', '2020-06-02 01:56:16', '2020-06-02 01:56:16'),
(2, 10, 'RBC1000002', 'B', 3, '2020-03-30', '2020-06-04', 'Discarded', '2020-06-04 10:33:41', '2020-06-07 19:04:15'),
(3, 10, 'RBC1000003', 'O', 2, '2020-06-04', '2020-07-09', 'Discarded', '2020-06-04 12:11:58', '2020-06-04 12:11:58'),
(4, 11, 'RBC1100004', 'B', 3, '2020-06-12', '2020-07-17', 'Transferred', '2020-06-12 09:06:39', '2020-06-12 09:06:39'),
(5, 11, 'RBC1100005', 'B', 3, '2020-06-12', '2020-07-17', 'In Stock', '2020-06-12 09:07:04', '2020-06-12 09:07:04');

-- --------------------------------------------------------

--
-- Table structure for table `components`
--

CREATE TABLE `components` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `shelfLife` int(11) NOT NULL,
  `prefix` varchar(3) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastEdited` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `components`
--

INSERT INTO `components` (`id`, `name`, `shelfLife`, `prefix`, `dateCreated`, `lastEdited`) VALUES
(4, 'Red Blood Cell', 35, 'RBC', '2020-05-31 20:39:49', '2020-05-31 20:41:40'),
(5, 'Plasma', 730, 'PLM', '2020-05-31 20:40:31', '2020-05-31 20:40:31'),
(6, 'Platelet', 5, 'PLT', '2020-05-31 20:40:49', '2020-05-31 20:40:49');

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `icNumber` varchar(12) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthDate` date NOT NULL,
  `bloodType` varchar(5) NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `dateRegistered` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`id`, `name`, `icNumber`, `gender`, `birthDate`, `bloodType`, `phoneNumber`, `emailAddress`, `dateRegistered`, `lastUpdated`) VALUES
(2, 'Kim Yoohyeon', '970107143245', 'Female', '1997-01-07', 'O', '0192049259', 'yoohyeon97@dreamcatchercompany.co.kr', '2019-10-17 07:47:12', '2019-10-24 06:30:20'),
(3, 'Choi Yuna', '971004085202', 'Female', '1997-10-04', 'B', '0132904590', 'yuju@sourcemusic.co.kr', '2019-10-24 05:33:53', '2019-10-24 05:33:53'),
(4, 'Intan Nora Syahira Binti Nazri', '951209092119', 'Female', '1995-08-02', 'B', '0172125507', 'intan.norasyahira@outlook.com', '2020-06-16 00:52:50', '2020-06-16 00:55:33');

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` int(11) NOT NULL,
  `hospitalName` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `town` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `postcode` varchar(5) NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `fax` varchar(15) NOT NULL,
  `emailAddress` varchar(50) NOT NULL,
  `dateRegistered` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `hospitalName`, `address`, `town`, `state`, `postcode`, `phoneNumber`, `fax`, `emailAddress`, `dateRegistered`, `lastUpdated`) VALUES
(2, 'Hospital Ampang', 'Jalan Mewah Utara', 'Ampang Park', 'W.P Kuala Lumpur', '68400', '03-42896000', '03-42954666', 'admin@hampg.moh.gov.my', '2019-08-25 17:24:36', '2019-08-25 17:24:56');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `typeAcount` int(11) NOT NULL DEFAULT '0',
  `typeBcount` int(11) NOT NULL DEFAULT '0',
  `typeOcount` int(11) NOT NULL DEFAULT '0',
  `typeABcount` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `productID`, `typeAcount`, `typeBcount`, `typeOcount`, `typeABcount`) VALUES
(2, 10, 5, 5, 5, 5),
(3, 11, 10, 5, 10, 5),
(5, 13, 5, 5, 15, 5),
(6, 14, 5, 5, 15, 5),
(7, 15, 5, 5, 15, 5),
(8, 16, 5, 5, 10, 5),
(9, 17, 0, 0, 20, 0),
(10, 18, 0, 0, 0, 0),
(11, 19, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product` varchar(255) NOT NULL,
  `componentID` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastEdited` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product`, `componentID`, `dateCreated`, `lastEdited`) VALUES
(10, 'Whole Blood', 4, '2020-05-31 20:54:57', '2020-05-31 20:58:26'),
(11, 'Packed Red Cell', 4, '2020-05-31 20:56:04', '2020-05-31 21:01:15'),
(13, 'Buffy-Coat Poor Red Cell', 4, '2020-05-31 21:00:38', '2020-05-31 21:04:02'),
(14, 'Filtered Red Cell', 4, '2020-05-31 21:04:17', '2020-05-31 21:04:43'),
(15, 'Fresh Frozen Plasma', 5, '2020-05-31 21:05:17', '2020-05-31 21:05:34'),
(16, 'Cryosupernatant', 5, '2020-05-31 21:05:49', '2020-05-31 21:06:07'),
(17, 'Cryoprecipitate', 5, '2020-05-31 21:06:20', '2020-05-31 21:06:40'),
(18, 'Random Platelet Concentrate', 6, '2020-05-31 21:06:57', '2020-05-31 21:06:57'),
(19, 'Apheresis Platelet', 6, '2020-05-31 21:07:09', '2020-05-31 21:07:09');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `displayTransactionID` varchar(6) NOT NULL,
  `userID` int(11) NOT NULL,
  `hospitalID` int(11) DEFAULT NULL,
  `bloodBagID` text NOT NULL,
  `transaction` varchar(255) NOT NULL,
  `remarks` varchar(355) DEFAULT NULL,
  `dateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `displayTransactionID`, `userID`, `hospitalID`, `bloodBagID`, `transaction`, `remarks`, `dateCreated`) VALUES
(1, 'T00001', 3, NULL, '[\"CPA1100007\"]', 'Discard Bloodbag', 'Wrong donor', '2020-04-09 00:06:35'),
(2, 'T00002', 3, NULL, '[\"RBC600001\"]', 'Discard Bloodbag', 'Wrong info', '2020-04-09 00:07:31'),
(3, 'T00003', 3, 2, '[\"PLT500008\",\"PLT500009\"]', 'Transfer Bloodbag', '', '2020-04-14 01:11:58'),
(4, 'T00004', 3, NULL, '[\"RBC1000001\"]', 'Discard Bloodbag', 'Wrong info', '2020-06-04 12:11:08'),
(5, 'T00005', 3, NULL, '[\"RBC1000003\"]', 'Discard Bloodbag', 'Wrong info', '2020-06-07 19:04:44'),
(6, 'T00006', 3, NULL, '[\"RBC1000002\"]', 'Discard Bloodbag', 'Discard expired bloodbag', '2020-06-07 19:07:10'),
(7, 'T00007', 3, 2, '[\"RBC1100004\"]', 'Transfer Bloodbag', '', '2020-06-12 09:08:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icNumber` varchar(12) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `dateRegistered` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `icNumber`, `gender`, `phoneNumber`, `emailAddress`, `password`, `role`, `dateRegistered`, `lastUpdated`) VALUES
(1, 'intan', 'Intan', '950510081995', 'Female', '0172125507', 'intan.norasyahira@abobloodcentre.com.my', 'admin', 'admin', '2019-07-05 21:43:35', '2020-05-29 22:13:13'),
(2, 'yuju', 'Choi Yuna', '971004187281', 'Female', '0123456789', 'yuna_choi@abobloodcentre.com.my', 'yuju123', 'user', '2019-07-05 21:45:19', '2019-08-12 18:17:05'),
(3, 'yoohyeon', 'Kim Yoohyeon', '970107172007', 'Female', '0142125507', 'yoohyeon_kim@abobloodcentre.com.my', 'yuju123', 'user', '2019-07-05 21:47:56', '2019-10-28 22:53:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bloodbag`
--
ALTER TABLE `bloodbag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `components`
--
ALTER TABLE `components`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bloodbag`
--
ALTER TABLE `bloodbag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `components`
--
ALTER TABLE `components`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
