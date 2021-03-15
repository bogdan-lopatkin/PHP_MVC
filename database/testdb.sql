-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jan 31, 2021 at 08:42 PM
-- Server version: 5.7.32
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rating` smallint(6) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `author`, `rating`, `comment`, `product_id`, `created_at`) VALUES
(1, 'Богдан', 9, 'Тестовый комментарий ', 3, '2021-01-31 20:40:27'),
(2, 'Богдан', 3, 'Тестовый комментарий', 3, '2021-01-31 20:40:40'),
(3, 'Богдан', 5, 'Тестовый комментарий', 3, '2021-01-31 20:40:53'),
(4, 'Богдан', 4, 'Тестовый комментарий', 1, '2021-01-31 20:41:16'),
(5, 'Богдан', 10, 'Тестовый комментарий', 1, '2021-01-31 20:41:24'),
(6, 'Богдан', 9, 'Тестовый комментарий', 2, '2021-01-31 20:41:40');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` mediumtext CHARACTER SET cp1251 NOT NULL,
  `average_price` float NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `average_price`, `author`, `created_at`) VALUES
(1, 'Наушники', 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixid=MXwxMjA3fDB8MHxzZWFyY2h8MXx8aGVhZHBob25lc3xlbnwwfHwwfA%3D%3D&ixlib=rb-1.2.1&w=1000&q=80', 3000, 'Богдан', '2021-01-31 20:26:49'),
(2, 'Телефон', 'https://media.wired.com/photos/5f1878e1d81b4e7738124d45/16:9/w_2400,h_1350,c_limit/Security_iphone-1139417660.jpg', 7000, 'Богдан', '2021-01-31 20:27:30'),
(3, 'Ноутбук', 'https://ru.gecid.com/data/news/201906031252-56272/img/02_samsung_notebook_7.jpg', 20000, 'Богдан', '2021-01-31 20:29:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
