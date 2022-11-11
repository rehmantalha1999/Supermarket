-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 15, 2022 at 07:45 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `metaquest`
--

-- --------------------------------------------------------

--
-- Table structure for table `consumer`
--

DROP TABLE IF EXISTS `consumer`;
CREATE TABLE IF NOT EXISTS `consumer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_turkish_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `city` varchar(20) COLLATE utf8mb4_turkish_ci NOT NULL,
  `district` varchar(20) COLLATE utf8mb4_turkish_ci NOT NULL,
  `address` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `verificationNumber` int NOT NULL,
  `isVerified` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dumping data for table `consumer`
--

INSERT INTO `consumer` (`id`, `email`, `name`, `password`, `city`, `district`, `address`, `verificationNumber`, `isVerified`) VALUES
(3, 'talhaabid10@gmail.com', 'Talha Abid Customer', '$2y$10$eXPUfwA/CDAznIlnXM58aOcqBXkXPAxKW7UyeC2iUDVTT/S.AMxfi', 'Ankara', 'Çankaya', 'sdafada', 605138, 1);

-- --------------------------------------------------------

--
-- Table structure for table `market`
--

DROP TABLE IF EXISTS `market`;
CREATE TABLE IF NOT EXISTS `market` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `city` varchar(20) COLLATE utf8mb4_turkish_ci NOT NULL,
  `district` varchar(20) COLLATE utf8mb4_turkish_ci NOT NULL,
  `address` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `isVerified` tinyint(1) NOT NULL,
  `verificationNumber` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dumping data for table `market`
--

INSERT INTO `market` (`id`, `email`, `name`, `password`, `city`, `district`, `address`, `isVerified`, `verificationNumber`) VALUES
(9, 'suheera.tanvir@ug.bilkent.edu.tr', 'Suheera Tanvir Marketplace', '$2y$10$y2jBgqYjNzGv2EfaL9MWS.PUZofqIgjFZqFe/BgNKyYhna7nI2CC2', 'Ankara', 'Çankaya', 'Maltepe mah, Akıncılar Sk. No: 34/B, 06570 Çankaya/Ankara', 1, 988507),
(15, 'talhaabid10@gmail.com', 'Talha Abid', '$2y$10$VnZkCsHwU2/cWllA9mB07.rWFNP9qcUitF8lg.0afE9kevpzp8Wjm', 'Islamabad', 'DHA', 'Sector D DHA Phase II, Islamabad', 1, 405484);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(20) COLLATE utf8mb4_turkish_ci NOT NULL,
  `stock` int NOT NULL,
  `normal_price` int NOT NULL,
  `discounted_price` int NOT NULL,
  `expiration_date` date NOT NULL,
  `image_path` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `market_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `title`, `stock`, `normal_price`, `discounted_price`, `expiration_date`, `image_path`, `market_id`) VALUES
(22, 'Yulaf Ezmesi', 18, 20, 12, '2022-11-17', 'e7b6f21ef92aa92dbf3303fe1f8e25c2b29abc42.jpeg', 9),
(21, 'Tön Balığı (x6)', 12, 40, 30, '2027-02-04', '2adbc33d6229593202a13298c32232cfd318c78b.jpeg', 9),
(20, 'Migros Süt', 20, 9, 6, '2022-08-18', 'f6151d36017f9491079f4723fa11b96dddd7ea50.jpeg', 9),
(19, 'Makarna', 7, 6, 4, '2024-03-20', '5f8d936aa7b124b61556604edc4299109ae0d9e5.jpeg', 9),
(18, 'Migros Ayran', 3, 15, 9, '2022-02-17', '0ca6a84b50614ad49bf254a72f3e32d41f66718b.jpg', 9),
(23, 'Nesquik', 4, 30, 18, '2023-02-08', '294688d54e1e6e992d09f00306526109849319e5.jpeg', 9),
(24, 'Bread', 7, 20, 16, '2016-02-29', '0367d5d0bb2eaf034acadf31e2d7a10a8282e0cd.jpeg', 15),
(25, 'Chocolate', 8, 10, 7, '2019-04-26', 'd5e513fc2243b765324b27c44a847f470c76a3df.jpeg', 15),
(26, 'Eggs', 100, 8, 6, '2022-10-16', 'f3122685b6041a18b069eae8f5d8888d0995a5ec.jpeg', 15),
(27, 'Rice', 8, 30, 20, '2022-06-15', '3162b64b16c94dcec1104f0f05d9dc3b3c3008f2.png', 15),
(28, 'Milk', 8, 8, 5, '2022-04-04', '9ce533afcb3e6833e0cebcbef2f4b7676afdb2e6.jpeg', 15),
(29, 'Organic Milk', 20, 10, 8, '2017-08-02', '05037664940764877d2aac3fcc8525d63c340d35.jpeg', 15),
(30, 'Tropicana Juice', 3, 12, 8, '2007-07-13', 'b387b139c90504b138f2294deebf6bb7e1a14708.jpeg', 15);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
