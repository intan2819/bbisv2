-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2020 at 02:51 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

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
  `status` varchar(10) NOT NULL DEFAULT 'In Stock',
  `dateCreated` datetime NOT NULL,
  `lastEdited` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bloodbag`
--

INSERT INTO `bloodbag` (`id`, `productID`, `displayBloodbagID`, `bloodType`, `donorID`, `retrievedDate`, `expiryDate`, `status`, `dateCreated`, `lastEdited`) VALUES
(1, 6, 'RBC600001', 'O', 2, '2020-01-07', '2020-02-11', 'In Stock', '2020-01-09 09:36:13', '2020-01-09 09:36:13');

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
(1, 'Red Blood Cell', 35, 'RBC', '2019-09-19 22:48:03', '2019-09-19 22:48:03'),
(2, 'Plasma', 730, 'PLM', '2019-09-19 22:48:03', '2019-09-19 22:48:03'),
(3, 'Platelet', 5, 'PLT', '2019-09-19 22:48:03', '2019-09-19 22:48:03'),
(6, 'Component A', 3, 'CPA', '2019-09-21 21:24:27', '2019-09-21 21:24:27');

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
(3, 'Choi Yuna', '971004085202', 'Female', '1997-10-04', 'B', '0132904590', 'yuju@sourcemusic.co.kr', '2019-10-24 05:33:53', '2019-10-24 05:33:53');

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
  `bloodType` varchar(2) NOT NULL,
  `minCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product` varchar(255) NOT NULL,
  `componentID` int(11) NOT NULL,
  `minCount` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastEdited` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product`, `componentID`, `minCount`, `dateCreated`, `lastEdited`) VALUES
(1, 'Cryoprecipitate', 2, 1, '2019-09-19 23:37:05', '2019-09-19 23:37:05'),
(2, 'Cryosupernatant', 2, 1, '2019-09-19 23:37:05', '2019-09-19 23:37:05'),
(3, 'Fresh Frozen Plasma', 2, 1, '2019-09-19 23:37:05', '2019-09-19 23:37:05'),
(4, 'Apheresis Platelet', 3, 1, '2019-09-19 23:37:05', '2019-09-19 23:37:05'),
(5, 'Random Platelet Concentrate', 3, 1, '2019-09-19 23:37:05', '2019-09-19 23:37:05'),
(6, 'Buffy-Coat Poor Red Cell', 1, 5, '2019-09-19 23:37:05', '2019-09-21 21:23:37'),
(7, 'Filtered Red Cell', 1, 1, '2019-09-19 23:37:05', '2019-09-19 23:37:05'),
(8, 'Packed Red Cell', 1, 1, '2019-09-19 23:37:05', '2019-09-19 23:37:05'),
(9, 'Whole Blood', 1, 1, '2019-09-19 23:37:05', '2019-09-19 23:37:05'),
(11, 'Product B', 6, 7, '2019-09-21 22:02:26', '2019-09-21 22:02:26');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `hospitalID` int(11) DEFAULT NULL,
  `bloodBagID` text NOT NULL,
  `transaction` varchar(255) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `userID`, `hospitalID`, `bloodBagID`, `transaction`, `dateCreated`) VALUES
(1, 3, NULL, '', 'Discard Bloodbag', '2019-12-25 23:15:37'),
(2, 3, NULL, '', 'Discard Bloodbag', '2019-12-27 23:56:28');

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
(1, 'intan', 'Intan Nora Syahira Binti Nazri', '950802086206', 'Female', '0172125507', 'intan.norasyahira@abobloodcentre.com.my', '12345', 'admin', '2019-07-05 21:43:35', '2019-08-25 16:27:19'),
(2, 'yuju', 'Choi Yuna', '971004187281', 'Female', '0123456789', 'yuna_choi@abobloodcentre.com.my', 'yuju123', 'user', '2019-07-05 21:45:19', '2019-08-12 18:17:05'),
(3, 'yoohyeon', 'Kim Yoohyeon', '970107172007', 'Female', '0142125507', 'yoohyeon_kim@abobloodcentre.com.my', 'yuju123', 'user', '2019-07-05 21:47:56', '2019-10-28 22:53:09'),
(4, 'jiu', 'Kim Minji', '940521086206', 'Female', '0142441994', 'jiu@abobloodcentre.com.my', 'jiu123', 'user', '2019-08-09 09:19:45', '2019-08-12 18:17:05'),
(5, 'sinb', 'Hwang Eunbi', '990620', 'Female', '0163661866', 'sinb@abobloodcentre.com.my', 'sinb123', 'user', '2019-08-09 09:23:20', '2019-08-12 18:17:05');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `components`
--
ALTER TABLE `components`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
