-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2023 at 09:38 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maidserves`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_german2_ci NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `gender` enum('M','F') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstname`, `lastname`, `email`, `username`, `password`, `gender`) VALUES
(1, 'Don', 'Kim', 'donkim018@gmail.com', 'Donita', '1234567', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `c_firstname` varchar(255) NOT NULL,
  `maid_id` int(11) NOT NULL,
  `m_firstname` varchar(255) NOT NULL,
  `service_id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `s_date` date NOT NULL,
  `e_date` date NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `customer_id`, `c_firstname`, `maid_id`, `m_firstname`, `service_id`, `service_name`, `s_date`, `e_date`, `status`) VALUES
(1, 7, 'Nick', 3, 'Prianka', 3, 'Cleaning', '2023-06-04', '2023-06-08', 'Denied'),
(2, 3, 'George', 5, 'Pablo', 4, 'Gardening', '2023-06-13', '2023-06-22', 'Denied'),
(3, 4, 'don', 3, 'Prianka', 1, 'Laundry', '2023-06-03', '2023-06-03', 'Pending'),
(4, 4, 'don', 2, 'Athena', 2, 'Cooking', '2023-06-03', '2023-06-03', 'Pending'),
(5, 4, 'don', 4, 'Donald', 4, 'Gardening', '2023-06-16', '2023-06-17', 'Denied'),
(6, 4, 'don', 5, 'Pablo', 2, 'Cooking', '2023-06-09', '2023-06-09', 'Denied'),
(7, 4, 'don', 3, 'Prianka', 1, 'Laundry', '2023-06-15', '2023-06-18', 'Approved'),
(44, 7, 'Nick', 12, 'david', 3, 'Cleaning', '2023-06-09', '2023-06-23', 'Denied'),
(45, 4, 'don', 19, 'nan', 2, 'Cooking', '2023-06-22', '2023-06-23', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `c_firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` enum('M','F') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `c_firstname`, `lastname`, `email`, `birthdate`, `username`, `password`, `phone_number`, `address`, `gender`) VALUES
(1, 'Billion', 'Luhwavi', 'Billy@gmail.com', '2020-05-21', 'Billy2020', 'BillyGates2020', '255677004477', 'Dar es salaam, Kigamboni', 'M'),
(2, 'Jackline', 'Luhwavi', 'J@gmail.com', '2000-06-10', 'jay', 'jayjayjay', '255688780478', 'Dar es salaam, kigamboni ', 'F'),
(3, 'George', 'Hemmingway.', 'geo@gmail.com', '1995-05-09', 'geomeo', 'geogeogeo', '255788907577', 'Dar es salaam, Sinza', 'M'),
(4, 'don', 'kim', 'donkim@gmail.com', '2023-05-02', 'Donie', 'don007', '0765454334', 'Dar es salaam', 'M'),
(5, 'lo', 'limao', 'limfao@gmail.com', '2023-05-03', 'lol', 'limao07', '255638393', 'Dare s', 'M'),
(6, 'Bonita Ricardo', 'Mtilly', 'bonitaricardo1602@gmail.com', '2023-05-18', 'bonita', '123456', '123456', 'dar es salaam ', 'F'),
(7, 'Nick', 'Jonas', 'nickjo@gmail.com', '2017-03-23', 'Nickjo', 'nick007', '25598383983', 'Dar es salaam, kinondoni', 'M'),
(9, 'angela', 'kipupwe', 'ange@gmail.com', '2222-02-22', 'angela', 'ange12', '26653869639', 'moro', 'F');

-- --------------------------------------------------------

--
-- Table structure for table `maid`
--

CREATE TABLE `maid` (
  `maid_id` int(11) NOT NULL,
  `m_firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `service_id` int(11) NOT NULL,
  `service_name` varchar(20) NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `status` varchar(50) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `maid`
--

INSERT INTO `maid` (`maid_id`, `m_firstname`, `lastname`, `email`, `birthdate`, `username`, `password`, `phone_number`, `address`, `service_id`, `service_name`, `gender`, `status`, `image`) VALUES
(1, 'Esterliñy', 'Agusto', 'essy@gmail.com', '2000-03-07', 'essyagu', 'essyessyessy', '25699784534', 'Dares salaam, Morocco', 3, 'Cleaning', 'F', 'Available', '1600478880_hotel-cover.jpg'),
(2, 'Athena', 'Galanis', 'Athena@gmail.com', '1996-03-05', 'gala96', 'galaath', '255777457844', 'Dar es salaam, Ilala', 1, 'Laundry', 'F', 'Available', 'room-1.jpg'),
(3, 'Prianka', 'Chopra', 'pricho@gmail.com', '2017-10-10', 'pricho', 'pricho007', '25583789784', 'Kigoma, kasulu', 2, 'Cooking', 'F', 'Available', '1604563680_Apple-Mac-Light-Wallpaper-1920x1200.jpg'),
(4, 'Donald', 'Kim', 'donkim@gmail.comm', '2023-05-04', 'Donniee', 'don123', '2558378339', 'Shinyanga, kahama', 4, 'Gardening', 'M', 'Available', '4.jpg'),
(5, 'Pablo', 'Escobar', 'pabl0@gmail.com', '1990-02-04', 'escobar420', 'escopablo', '255644204204', 'Morogoro, Canada', 2, 'Cooking', 'M', 'Available', '3.jpg'),
(6, 'la', 'lorna', 'lalo@gmail.com', '2023-03-01', 'lalor', 'lalo123', '84747473838', 'Kigamboni,dar', 1, 'Laundry', 'F', 'Available', '2.jpg'),
(7, 'nae', 'nae', 'nae@gmail.com', '2023-05-03', 'nae', 'nae123', '2557383389394', 'nae', 1, 'Laundry', 'F', 'Available', '1604563680_Beach-Umbrellas-Wallpaper-1229x768.jpg'),
(8, 'he', 'hesabu', 'hesabu@gmail.com', '2003-09-10', 'hesabu', 'hesabu1', '2559793389', 'darasani', 3, 'Cleaning', 'M', 'Available', '1600478881_hotel-cover.jpg'),
(9, 'na', 'wew', 'nawew@gmail.com', '2022-02-22', 'nawew', 'nawew2', '25577987987', 'where', 2, 'Cooking', 'F', 'Available', '1600478880_hotel-cover.jpg'),
(11, 'kipupu', 'indogo', 'ponpon@gmail.com', '2005-02-20', 'kipu', '1234567', '25578928798', 'kigali', 4, 'Gardening', 'M', 'Available', '1685562660_theater-bg.jpg'),
(12, 'david', 'shukran', 'davshuk@gmail.com', '1982-04-20', 'shuku', 'shuku12', '25678393879', 'dar', 2, 'Cleaning', 'M', 'Available', 'img7.jpg'),
(19, 'nan', 'nin', 'don@gmail.com', '2001-01-01', 'nana', 'donald', '25507060403', 'dar', 2, 'Cooking', 'M', 'Available', '1604563680_Apple-Mac-Light-Wallpaper-1920x1200.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `amount` decimal(6,2) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `booking_id`, `amount`, `date`, `status`) VALUES
(1, 2, '5000.00', '2023-06-04', 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `service_name`, `description`, `price`) VALUES
(1, 'Laundry', 'Cleaning of clothes', '6000.00'),
(2, 'Cooking', 'Cooking food', '5000.00'),
(3, 'Cleaning', 'Includes mopping the floor, Cleaning the bathroom/toilet, washing the dishes  ', '5000.00'),
(4, 'Gardening', 'Tilling the ground, pruning and watering', '5000.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `Test` (`customer_id`),
  ADD KEY `booking_ibfk_1` (`service_id`),
  ADD KEY `booking_ibfk_2` (`maid_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `firstname` (`c_firstname`),
  ADD UNIQUE KEY `phone_number` (`phone_number`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `maid`
--
ALTER TABLE `maid`
  ADD PRIMARY KEY (`maid_id`),
  ADD UNIQUE KEY `firstname` (`m_firstname`),
  ADD UNIQUE KEY `phone_number` (`phone_number`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `serv_mdfk_1` (`service_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `payment_ibfk_1` (`booking_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `service_id` (`service_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `maid`
--
ALTER TABLE `maid`
  MODIFY `maid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_booking_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_booking_maid` FOREIGN KEY (`maid_id`) REFERENCES `maid` (`maid_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_booking_service` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`) ON DELETE CASCADE;

--
-- Constraints for table `maid`
--
ALTER TABLE `maid`
  ADD CONSTRAINT `serv_mdfk_1` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`booking_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
