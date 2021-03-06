-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 06, 2019 at 11:52 AM
-- Server version: 5.6.41
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(22) NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`) VALUES
(36, 'car', 0),
(37, 'cars', 0),
(40, 'sdf', 36),
(42, 'd', 0),
(43, 'f', 0),
(44, 'g', 0),
(45, 'h', 0),
(46, 't', 0),
(47, 'e', 0),
(51, 'bmw', 36);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `dest` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `prod_id`, `dest`) VALUES
(175, 26, 'W:/domains/shop.loc/uploads/5c7cfd99b35e65.96559830.jpg'),
(176, 26, 'W:/domains/shop.loc/uploads/5c7cfd99b419f2.96923977.jpg'),
(177, 26, 'W:/domains/shop.loc/uploads/5c7cfd99b513f9.55995143.jpg'),
(178, 27, 'W:/domains/shop.loc/uploads/5c7e4c07007390.23718890.jpg'),
(179, 27, 'W:/domains/shop.loc/uploads/5c7e4c0700f090.29371951.jpg'),
(180, 28, 'W:/domains/shop.loc/uploads/5c7e6dc070f3f1.37064913.jpg'),
(181, 24, 'W:/domains/shop.loc/uploads/5c7e7a4b3b6658.52395812.jpg'),
(182, 29, 'W:/domains/shop.loc/uploads/5c7f8850b062f5.93506297.jpg'),
(183, 29, 'W:/domains/shop.loc/uploads/5c7f8850b11e70.71747454.jpg'),
(184, 29, 'W:/domains/shop.loc/uploads/5c7f8850b1d9f0.62998731.jpg'),
(185, 29, 'W:/domains/shop.loc/uploads/5c7f8850b50688.35375096.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

CREATE TABLE `manufacturers` (
  `id` int(11) NOT NULL,
  `name` varchar(22) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manufacturers`
--

INSERT INTO `manufacturers` (`id`, `name`, `address`, `phone`) VALUES
(9, 'sdfsdfsdf', 'asdfsdf', 'sdfgdsfg'),
(10, 'Samvel', 'g-1', '95596463'),
(11, 'sdf', 'dfds', 'sdfs');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `time`, `user_id`, `address`) VALUES
(38, '2019-03-05 13:54:14', 7, 'vbg');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `prod_id`, `quantity`) VALUES
(11, 13, 24, 4),
(12, 13, 26, 13),
(13, 14, 24, 14),
(14, 15, 24, 1),
(15, 15, 26, 1),
(16, 0, 24, 1),
(17, 16, 24, 6),
(18, 17, 24, 4),
(19, 17, 26, 1),
(20, 18, 24, 1),
(21, 18, 26, 1),
(22, 19, 24, 1),
(23, 19, 26, 1),
(24, 27, 26, 1),
(25, 28, 26, 1),
(26, 29, 26, 1),
(27, 30, 26, 1),
(28, 31, 26, 1),
(29, 32, 24, 1),
(30, 33, 24, 1),
(31, 33, 24, 2),
(32, 33, 24, 2),
(33, 33, 24, 2),
(34, 33, 24, 2),
(35, 33, 24, 2),
(36, 33, 24, 2),
(37, 33, 24, 2),
(38, 33, 24, 2),
(39, 33, 24, 2),
(40, 33, 24, 2),
(41, 33, 24, 2),
(42, 34, 24, 1),
(43, 35, 24, 1),
(44, 36, 24, 10),
(45, 37, 24, -1),
(46, 38, 24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `in_stock` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `manufacturer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `in_stock`, `price`, `manufacturer_id`) VALUES
(24, 'a', 0, 34, 9),
(26, '5', 4, 4, 9),
(27, 'asdf', 4, 3, 9),
(28, 'bmw', 9, 123, 9),
(29, 'mersedez', 10, 15000, 11);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `prod_id`, `cat_id`) VALUES
(34, 24, 36),
(35, 24, 37),
(37, 26, 36),
(38, 26, 37),
(39, 26, 40),
(40, 27, 37),
(41, 27, 40),
(42, 28, 36),
(43, 29, 36),
(44, 29, 37),
(45, 29, 40);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'samvel', 'samvel.topuzyan@gmail.com', '$2y$10$7OA7e5mCTQZ1Pcbi.ZP1UuooYbekJgrldifwPvL9Nk0Z.HT7H6axG'),
(2, 'samveldf', 'samvel.topsduzyan@gmail.com', '$2y$10$ckuzsbVbyuQlzVR4QOZnFuz8QHiXGglZeetb9xdrJcqFLDQ6gMEqy'),
(3, 'samvela', 'asd@asd', '$2y$10$bTLQiHzn0FyvFzG2XABS/.y1gwDKpFu/UgmQ5xa699DrcrfrNdOGC'),
(4, 'asd', 'asda@asda', '$2y$10$i3GhXLiyDzw3mw4ya1oEkOIoDlAh3eC7K7gn1Lq6GOwa2fSSaMQc6'),
(5, 'asds', 'asda@asdas', '$2y$10$Scbxij.2R/JRz31a7av/DeggmGzo.vt5nqXy2AT5d9gw1koaOhBpy'),
(6, 'asdss', 'asda@asdass', '$2y$10$I32yt.W4hCvS94i/rSDZR.l11cjnpmM4qUdYlha8G0b7LYXFUFMUy'),
(7, 'a', 'a@a', '$2y$10$Xk.zRf8Hippbe.LQ0wdWS.IG11xtihbioHOLz0PQooEG5uWN/WpHq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
