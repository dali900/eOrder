-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2017 at 05:45 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eorder`
--

-- --------------------------------------------------------

--
-- Table structure for table `c_orders`
--

CREATE TABLE `c_orders` (
  `id` int(11) NOT NULL,
  `tab` int(11) DEFAULT NULL,
  `products` text,
  `status` varchar(64) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `c_orders`
--

INSERT INTO `c_orders` (`id`, `tab`, `products`, `status`) VALUES
(1, 25, 'a:3:{i:0;a:3:{s:4:"name";s:4:"Beer";s:8:"quantity";i:2;s:5:"price";i:200;}i:1;a:3:{s:4:"name";s:4:"Vine";s:8:"quantity";i:1;s:5:"price";i:250;}i:2;a:3:{s:4:"name";s:5:"Pasta";s:8:"quantity";i:1;s:5:"price";i:650;}}', NULL),
(4, 5, 'a:4:{i:0;a:3:{s:4:"name";s:4:"Beer";s:8:"quantity";i:2;s:5:"price";i:200;}i:1;a:3:{s:4:"name";s:6:"Cake 1";s:8:"quantity";i:1;s:5:"price";i:350;}i:2;a:3:{s:4:"name";s:6:"Cake 2";s:8:"quantity";i:1;s:5:"price";i:350;}i:3;a:3:{s:4:"name";s:9:"Pizza cap";s:8:"quantity";i:1;s:5:"price";i:550;}}', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `c_orders`
--
ALTER TABLE `c_orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `c_orders`
--
ALTER TABLE `c_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
