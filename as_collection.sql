-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2024 at 07:27 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `as_collection`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `creationDate`, `updationDate`) VALUES
(7, 'aleem', '705d7b3c3e30443b5a6c7cac25f6ba3c', '2024-09-27 15:14:06', ''),
(8, 'aleem', '705d7b3c3e30443b5a6c7cac25f6ba3c', '2024-09-27 15:14:12', '');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(255) DEFAULT NULL,
  `categoryDescription` longtext DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `meta_title` varchar(100) NOT NULL,
  `h1_title` varchar(100) NOT NULL,
  `meta_keywords` varchar(200) NOT NULL,
  `meta_description` varchar(300) NOT NULL,
  `canonical` varchar(150) NOT NULL,
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categoryName`, `categoryDescription`, `creationDate`, `meta_title`, `h1_title`, `meta_keywords`, `meta_description`, `canonical`, `updationDate`) VALUES
(3, 'Georgette Silk', '', '2017-01-24 19:17:37', 'testing title', 'test', 'testing keywords', 'testing Meta Description', 'test', '23-07-2024 11:52:52 AM'),
(4, 'Katan Warm Silk', '', '2017-01-24 19:19:32', '', '', '', '', '', '18-12-2023 08:04:19 PM'),
(5, 'Organza Silk', '', '2017-01-24 19:19:54', '', '', '', '', '', '18-12-2023 08:04:41 PM'),
(6, 'Pure Katan Saree', '', '2017-02-20 19:18:52', '', '', '', '', '', '18-12-2023 08:04:56 PM'),
(7, 'Pure Katan Silk', '', '2023-12-18 14:32:05', '', '', '', '', '', '18-12-2023 08:05:17 PM'),
(8, 'Pure Kora Organza', '', '2023-12-18 14:32:11', '', '', '', '', '', '18-12-2023 08:05:35 PM'),
(9, 'tissue silk', 'banaras tissue silk sarees', '2024-02-28 10:32:54', '', '', '', '', '', NULL),
(11, 'Kora silk sarees', '', '2024-03-28 07:33:37', '', '', '', '', '', NULL),
(12, 'Georgette silk floral design', '', '2024-03-29 04:46:44', '', '', '', '', '', NULL),
(13, 'Tissue crush silk body plain with tasel', '', '2024-03-29 04:56:21', '', '', '', '', '', NULL),
(14, 'Rainbow dyed tissue silk with tasel', '', '2024-03-29 05:17:28', '', '', '', '', '', NULL),
(15, 'Organza silk sarees', '', '2024-03-29 05:29:36', '', '', '', '', '', NULL),
(16, 'Banarasi ambose suit', '', '2024-04-15 07:46:21', '', '', '', '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `productId` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `orderDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `paymentMethod` varchar(50) DEFAULT NULL,
  `orderStatus` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `userId`, `productId`, `quantity`, `orderDate`, `paymentMethod`, `orderStatus`) VALUES
(8, 9, '1', 1, '2023-12-20 08:26:25', 'Debit / Credit card', NULL),
(9, 9, '1', 1, '2023-12-20 10:45:22', 'Debit / Credit card', 'in Process'),
(10, 9, '3', 1, '2023-12-20 10:45:22', 'Debit / Credit card', NULL),
(16, 9, '3', 1, '2023-12-21 06:00:33', NULL, 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `ordertrackhistory`
--

CREATE TABLE `ordertrackhistory` (
  `id` int(11) NOT NULL,
  `orderId` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remark` mediumtext DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ordertrackhistory`
--

INSERT INTO `ordertrackhistory` (`id`, `orderId`, `status`, `remark`, `postingDate`) VALUES
(1, 3, 'in Process', 'Order has been Shipped.', '2017-03-10 19:36:45');
-- --------------------------------------------------------

--
-- Table structure for table `productreviews`
--

CREATE TABLE `productreviews` (
  `id` int(11) NOT NULL,
  `productId` int(11) DEFAULT NULL,
  `quality` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `review` longtext DEFAULT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `productreviews`
--

INSERT INTO `productreviews` (`id`, `productId`, `quality`, `price`, `value`, `name`, `summary`, `review`, `reviewDate`) VALUES
(2, 3, 4, 5, 5, 'Anuj Kumar', 'BEST PRODUCT FOR ME :)', 'BEST PRODUCT FOR ME :)', '2017-02-26 20:43:57');
-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `subCategory` int(11) DEFAULT NULL,
  `productName` varchar(255) DEFAULT NULL,
  `productCompany` varchar(255) DEFAULT NULL,
  `productPrice` int(11) DEFAULT NULL,
  `productPriceBeforeDiscount` int(11) DEFAULT NULL,
  `productDescription` longtext DEFAULT NULL,
  `productImage1` varchar(255) DEFAULT NULL,
  `productImage2` varchar(255) DEFAULT NULL,
  `productImage3` varchar(255) DEFAULT NULL,
  `shippingCharge` int(11) DEFAULT NULL,
  `productAvailability` varchar(255) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `subCategory`, `productName`, `productCompany`, `productPrice`, `productPriceBeforeDiscount`, `productDescription`, `productImage1`, `productImage2`, `productImage3`, `shippingCharge`, `productAvailability`, `postingDate`, `updationDate`) VALUES
(1, 3, 13, 'Saree', 'DKB Banarasi', 1999, 2499, 'Saree', '1999 - 2.jpg', '3699 - 10.jpg', '3699 - 11.jpg', 0, 'In Stock', '2023-12-18 16:57:04', NULL),
(2, 3, 13, 'Saree', 'DKB Banarasi', 1999, 2499, 'Saree', '1999 - 3.jpg', '', '', 0, 'Out of Stock', '2023-12-18 16:57:42', NULL),
(3, 3, 15, 'Silk Saree', 'DKB Banarasi', 1999, 2499, 'Saree Avalable', '1999 - 4.jpg', '', '', 0, 'In Stock', '2023-12-19 06:34:42', NULL),
(5, 9, 27, 'Tissue Silk', 'DKB Banarasi', 2849, 3000, '											', 'WhatsApp Image 2024-03-26 at 3.18.45 PM.jpeg', '', '', 0, 'In Stock', '2024-03-26 10:29:20', NULL),
(6, 9, 27, 'Tissue Silk', 'DKB Banarasi', 2849, 3000, '											', 'WhatsApp Image 2024-03-26 at 3.18.41 PM (1).jpeg', '', '', 0, 'In Stock', '2024-03-26 10:30:26', NULL),
(7, 9, 27, 'Tissue Silk', 'DKB Banarasi', 2849, 3000, '											', 'WhatsApp Image 2024-03-26 at 3.18.41 PM.jpeg', '', '', 0, 'In Stock', '2024-03-26 11:16:05', NULL),
(8, 9, 27, 'Tissue Silk', 'DKB Banarasi', 2849, 3000, '											', 'WhatsApp Image 2024-03-26 at 3.18.42 PM (2).jpeg', '', '', 0, 'In Stock', '2024-03-26 11:16:22', NULL),
(9, 9, 27, 'Tissue Silk', 'DKB Banarasi', 2849, 3000, '											', 'WhatsApp Image 2024-03-26 at 3.18.42 PM.jpeg', 'WhatsApp Image 2024-03-26 at 3.18.43 PM (1).jpeg', 'WhatsApp Image 2024-03-26 at 3.18.43 PM (2).jpeg', 0, 'In Stock', '2024-03-26 11:17:08', NULL),
(13, 9, 27, 'Tissue Silk', 'DKB Banarasi', 2849, 3000, '											', 'WhatsApp Image 2024-03-26 at 3.18.43 PM (2).jpeg', '', '', 0, 'In Stock', '2024-03-26 11:22:31', NULL),
(14, 9, 27, 'Tissue Silk', 'DKB Banarasi', 2849, 3000, '											', 'WhatsApp Image 2024-03-26 at 3.18.43 PM.jpeg', '', 'imp - Copy.php7', 0, 'In Stock', '2024-03-26 11:22:53', NULL),
(15, 9, 27, 'Tissue Silk', 'DKB Banarasi', 2849, 3000, '											', 'WhatsApp Image 2024-03-26 at 3.18.44 PM (1).jpeg', '', '', 0, 'In Stock', '2024-03-26 11:23:20', NULL),
(16, 9, 27, 'Tissue Silk', 'DKB Banarasi', 2849, 3000, '											', 'WhatsApp Image 2024-03-26 at 3.18.43 PM (1).jpeg', '', '', 0, 'In Stock', '2024-03-26 11:28:44', NULL),
(17, 9, 27, 'Tissue Silk', 'DKB Banarasi', 2849, 3000, '											', 'WhatsApp Image 2024-03-26 at 3.18.44 PM (1).jpeg', '', '', 0, 'In Stock', '2024-03-26 11:29:14', NULL),
(18, 9, 27, 'Tissue Silk', 'DKB Banarasi', 2849, 3000, '											', 'WhatsApp Image 2024-03-26 at 3.18.44 PM (2).jpeg', '', '', 0, 'In Stock', '2024-03-26 11:29:40', NULL),
(19, 9, 27, 'Tissue Silk', 'DKB Banarasi', 2849, 3000, '											', 'WhatsApp Image 2024-03-26 at 3.18.44 PM (3).jpeg', '', '', 0, 'In Stock', '2024-03-26 11:31:40', NULL),
(20, 9, 27, 'Tissue Silk', 'DKB Banarasi', 2849, 3000, '											', 'WhatsApp Image 2024-03-26 at 3.18.44 PM.jpeg', '', '', 0, 'In Stock', '2024-03-26 11:32:43', NULL),
(21, 5, 19, 'Organza silk saree', 'DKB Banarasi', 2249, 3000, '											', 'WhatsApp Image 2024-03-26 at 3.18.54 PM (1).jpeg', '', '', 0, 'In Stock', '2024-03-26 11:39:31', NULL),
(22, 5, 19, 'Organza silk saree', 'DKB Banarasi', 2249, 3000, '											', 'WhatsApp Image 2024-03-26 at 3.18.54 PM.jpeg', '', '', 0, 'In Stock', '2024-03-26 11:40:24', NULL),
(23, 5, 19, 'Organza silk saree', 'DKB Banarasi', 2249, 3000, '											', 'WhatsApp Image 2024-03-26 at 3.18.55 PM (1).jpeg', '', '', 0, 'In Stock', '2024-03-26 11:40:48', NULL),
(24, 5, 19, 'Organza silk saree', 'DKB Banarasi', 2249, 3000, '											', 'WhatsApp Image 2024-03-26 at 3.18.55 PM (2).jpeg', '', '', 0, 'In Stock', '2024-03-26 11:43:11', NULL),
(25, 5, 19, 'Organza silk saree', 'DKB Banarasi', 2249, 3000, '											', 'WhatsApp Image 2024-03-26 at 3.18.55 PM.jpeg', '', '', 0, 'In Stock', '2024-03-26 12:00:28', NULL),
(26, 5, 19, 'Organza silk saree', 'DKB Banarasi', 2249, 3000, '											', 'WhatsApp Image 2024-03-26 at 3.18.56 PM.jpeg', '', '', 0, 'In Stock', '2024-03-26 12:00:52', NULL),
(27, 3, 15, 'Georgette Silk', 'DKB Banarasi', 3450, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.19.13 PM (1).jpeg', '', '', 0, 'In Stock', '2024-03-26 12:04:19', NULL),
(28, 3, 13, 'Georgette Silk', 'DKB Banarasi', 3450, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.19.13 PM (2).jpeg', '', '', 0, 'In Stock', '2024-03-26 12:05:14', NULL),
(29, 3, 13, 'Georgette Silk', 'DKB Banarasi', 3450, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.19.13 PM.jpeg', '', '', 0, 'In Stock', '2024-03-26 12:06:46', NULL),
(30, 3, 13, 'Georgette Silk', 'DKB Banarasi', 3450, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.19.14 PM (1).jpeg', '', '', 0, 'In Stock', '2024-03-26 12:07:17', NULL),
(31, 3, 13, 'Georgette Silk', 'DKB Banarasi', 3450, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.19.14 PM (2).jpeg', '', '', 0, 'In Stock', '2024-03-26 12:07:51', NULL),
(32, 3, 13, 'Georgette Silk', 'DKB Banarasi', 3450, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.19.14 PM.jpeg', '', '', 0, 'In Stock', '2024-03-26 12:08:38', NULL),
(33, 3, 13, 'Georgette Silk', 'DKB Banarasi', 3450, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.19.15 PM (1).jpeg', '', '', 0, 'In Stock', '2024-03-26 12:09:04', NULL),
(34, 3, 13, 'Georgette Silk', 'DKB Banarasi', 3450, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.19.15 PM (2).jpeg', '', '', 0, 'In Stock', '2024-03-26 12:09:38', NULL),
(35, 3, 13, 'Georgette Silk', 'DKB Banarasi', 3450, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.19.15 PM.jpeg', '', '', 0, 'In Stock', '2024-03-26 12:10:09', NULL),
(36, 3, 13, 'Georgette Silk', 'DKB Banarasi', 3450, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.19.16 PM (1).jpeg', '', '', 0, 'In Stock', '2024-03-26 12:10:45', NULL),
(37, 3, 13, 'Georgette Silk', 'DKB Banarasi', 3450, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.19.16 PM (2).jpeg', '', '', 0, 'In Stock', '2024-03-26 12:11:16', NULL),
(38, 3, 13, 'Georgette Silk', 'DKB Banarasi', 3450, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.19.16 PM (3).jpeg', '', '', 0, 'In Stock', '2024-03-26 12:11:39', NULL),
(39, 3, 13, 'Georgette Silk', 'DKB Banarasi', 3450, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.19.16 PM.jpeg', '', '', 0, 'In Stock', '2024-03-26 12:12:12', NULL),
(40, 3, 13, 'Georgette Silk', 'DKB Banarasi', 3450, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.19.17 PM (1).jpeg', '', '', 0, 'In Stock', '2024-03-26 12:12:31', NULL),
(41, 3, 13, 'Georgette Silk', 'DKB Banarasi', 3450, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.19.17 PM (2).jpeg', '', '', 0, 'In Stock', '2024-03-26 12:12:52', NULL),
(42, 3, 13, 'Georgette Silk', 'DKB Banarasi', 3450, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.19.17 PM.jpeg', '', '', 0, 'In Stock', '2024-03-26 12:14:34', NULL),
(43, 3, 13, 'Georgette Silk', 'DKB Banarasi', 3450, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.19.18 PM (1).jpeg', '', '', 0, 'In Stock', '2024-03-26 12:14:53', NULL),
(44, 3, 13, 'Georgette Silk', 'DKB Banarasi', 3450, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.19.18 PM (2).jpeg', '', '', 0, 'In Stock', '2024-03-26 12:15:16', NULL),
(45, 3, 13, 'Georgette Silk', 'DKB Banarasi', 3450, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.19.18 PM.jpeg', '', '', 0, 'In Stock', '2024-03-26 12:15:42', NULL),
(46, 3, 13, 'Georgette Silk', 'DKB Banarasi', 3450, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.19.19 PM (1).jpeg', '', '', 0, 'In Stock', '2024-03-26 12:16:20', NULL),
(47, 3, 13, 'Georgette Silk', 'DKB Banarasi', 3450, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.19.19 PM (2).jpeg', '', '', 0, 'In Stock', '2024-03-26 12:17:50', NULL),
(48, 3, 13, 'Georgette Silk', 'DKB Banarasi', 3450, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.19.19 PM.jpeg', '', '', 0, 'In Stock', '2024-03-26 12:18:13', NULL),
(49, 3, 13, 'Georgette Silk', 'DKB Banarasi', 3450, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.19.20 PM (1).jpeg', '', '', 0, 'In Stock', '2024-03-26 12:19:06', NULL),
(50, 3, 13, 'Georgette Silk', 'DKB Banarasi', 3450, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.19.20 PM (2).jpeg', '', '', 0, 'In Stock', '2024-03-26 12:19:28', NULL),
(51, 3, 13, 'Georgette Silk', 'DKB Banarasi', 3450, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.19.20 PM.jpeg', '', '', 0, 'In Stock', '2024-03-26 12:19:52', NULL),
(54, 3, 13, 'Georgette Silk', 'DKB Banarasi', 3450, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.19.21 PM.jpeg', '', '', 0, 'In Stock', '2024-03-26 12:23:59', NULL),
(55, 11, 28, 'Kora Silk Sarees', 'DKB Banarasi', 2449, 3500, '											', 'WhatsApp Image 2024-03-26 at 3.19.48 PM.jpeg', '', '', 0, 'In Stock', '2024-03-28 07:35:39', NULL),
(56, 11, 28, 'Kora Silk Sarees', 'DKB Banarasi', 2249, 3500, '											', 'WhatsApp Image 2024-03-26 at 3.19.49 PM (1).jpeg', 'WhatsApp Image 2024-03-26 at 3.19.49 PM (2).jpeg', '', 0, 'In Stock', '2024-03-28 07:36:21', NULL),
(59, 11, 28, 'Kora Silk Sarees', 'DKB Banarasi', 2249, 3500, '											', 'WhatsApp Image 2024-03-26 at 3.19.49 PM.jpeg', '', '', 0, 'In Stock', '2024-03-28 07:38:45', NULL),
(60, 11, 28, 'Kora Silk Sarees', 'DKB Banarasi', 2249, 3500, '											', 'WhatsApp Image 2024-03-26 at 3.19.50 PM (1).jpeg', 'WhatsApp Image 2024-03-26 at 3.19.50 PM (2).jpeg', 'WhatsApp Image 2024-03-26 at 3.19.50 PM.jpeg', 0, 'In Stock', '2024-03-28 07:39:16', NULL),
(63, 11, 28, 'Kora Silk Sarees', 'DKB Banarasi', 2249, 3500, '											', 'WhatsApp Image 2024-03-26 at 3.19.52 PM (1).jpeg', 'WhatsApp Image 2024-03-26 at 3.19.52 PM (2).jpeg', 'WhatsApp Image 2024-03-26 at 3.19.52 PM.jpeg', 0, 'In Stock', '2024-03-28 07:45:40', NULL),
(64, 11, 28, 'Kora Silk Sarees', 'DKB Banarasi', 2249, 3500, '											', 'WhatsApp Image 2024-03-26 at 3.19.51 PM (1).jpeg', 'WhatsApp Image 2024-03-26 at 3.19.51 PM (2).jpeg', 'WhatsApp Image 2024-03-26 at 3.19.51 PM.jpeg', 0, 'In Stock', '2024-03-28 07:47:02', NULL),
(65, 3, 15, 'Georgette Silk', 'DKB Banarasi', 2850, 3500, '											', 'WhatsApp Image 2024-03-26 at 3.20.17 PM.jpeg', '', '', 0, 'In Stock', '2024-03-28 07:50:47', NULL),
(66, 3, 15, 'Georgette Silk', 'DKB Banarasi', 2850, 3500, '											', 'WhatsApp Image 2024-03-26 at 3.20.19 PM.jpeg', 'WhatsApp Image 2024-03-26 at 3.21.04 PM (2).jpeg', '', 0, 'In Stock', '2024-03-28 07:51:38', NULL),
(67, 3, 15, 'Georgette Silk', 'DKB Banarasi', 2850, 3500, '											', 'WhatsApp Image 2024-03-26 at 3.20.20 PM (1).jpeg', 'WhatsApp Image 2024-03-26 at 3.20.20 PM (2).jpeg', '', 0, 'In Stock', '2024-03-28 07:52:41', NULL),
(68, 3, 15, 'Georgette Silk', 'DKB Banarasi', 2850, 3500, '											', 'WhatsApp Image 2024-03-26 at 3.20.20 PM.jpeg', 'WhatsApp Image 2024-03-26 at 3.21.03 PM (2).jpeg', '', 0, 'In Stock', '2024-03-28 07:53:46', NULL),
(69, 3, 15, 'Georgette Silk', 'DKB Banarasi', 2850, 3500, '											', 'WhatsApp Image 2024-03-26 at 3.20.21 PM (1).jpeg', '', '', 0, 'In Stock', '2024-03-28 07:54:39', NULL),
(70, 3, 15, 'Georgette Silk', 'DKB Banarasi', 2850, 3500, '											', 'WhatsApp Image 2024-03-26 at 3.20.21 PM (2).jpeg', '', '', 0, 'In Stock', '2024-03-28 07:55:13', NULL),
(71, 3, 15, 'Georgette Silk', 'DKB Banarasi', 2850, 3500, '											', 'WhatsApp Image 2024-03-26 at 3.20.21 PM.jpeg', 'WhatsApp Image 2024-03-26 at 3.21.04 PM.jpeg', '', 0, 'In Stock', '2024-03-28 07:55:39', NULL),
(72, 3, 15, 'Georgette Silk', 'DKB Banarasi', 2850, 3500, '											', 'WhatsApp Image 2024-03-26 at 3.21.02 PM (1).jpeg', 'WhatsApp Image 2024-03-26 at 3.21.02 PM.jpeg', 'WhatsApp Image 2024-03-26 at 3.21.03 PM.jpeg', 0, 'In Stock', '2024-03-28 07:56:16', NULL),
(73, 3, 15, 'Kora Silk Sarees', 'DKB Banarasi', 2850, 3500, '											', 'WhatsApp Image 2024-03-26 at 3.21.02 PM (2).jpeg', '', '', 0, 'In Stock', '2024-03-28 07:57:06', NULL),
(74, 3, 15, 'Georgette Silk', 'DKB Banarasi', 2850, 3500, '											', 'WhatsApp Image 2024-03-26 at 3.21.03 PM (1).jpeg', '', '', 0, 'In Stock', '2024-03-28 07:59:09', NULL),
(75, 3, 15, 'Georgette Silk', 'DKB Banarasi', 2850, 3500, '											', 'WhatsApp Image 2024-03-26 at 3.21.03 PM (2).jpeg', '', '', 0, 'In Stock', '2024-03-28 07:59:54', NULL),
(76, 3, 15, 'Georgette Silk', 'DKB Banarasi', 2850, 3500, '											', 'WhatsApp Image 2024-03-26 at 3.21.04 PM (1).jpeg', '', '', 0, 'In Stock', '2024-03-28 08:00:20', NULL),
(77, 3, 15, 'Georgette Silk', 'DKB Banarasi', 2850, 3500, '											', 'WhatsApp Image 2024-03-26 at 3.21.05 PM (1).jpeg', '', '', 0, 'In Stock', '2024-03-28 08:34:21', NULL),
(78, 3, 15, 'Georgette Silk', 'DKB Banarasi', 2850, 3000, '											', 'WhatsApp Image 2024-03-26 at 3.21.05 PM.jpeg', '', '', 0, 'In Stock', '2024-03-28 08:34:47', NULL),
(79, 3, 15, 'Georgette Silk', 'DKB Banarasi', 2850, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.21.22 PM.jpeg', 'WhatsApp Image 2024-03-26 at 3.21.23 PM (1).jpeg', 'WhatsApp Image 2024-03-26 at 3.21.23 PM (2).jpeg', 0, 'In Stock', '2024-03-28 08:47:57', NULL),
(80, 3, 15, 'Georgette Silk', 'DKB Banarasi', 2850, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.21.24 PM (1).jpeg', 'WhatsApp Image 2024-03-26 at 3.21.27 PM.jpeg', '', 0, 'In Stock', '2024-03-28 08:49:43', NULL),
(81, 3, 15, 'Georgette Silk', 'DKB Banarasi', 2850, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.21.24 PM (2).jpeg', 'WhatsApp Image 2024-03-26 at 3.21.25 PM.jpeg', '', 0, 'In Stock', '2024-03-28 08:50:39', NULL),
(82, 3, 15, 'Georgette Silk', 'DKB Banarasi', 2850, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.21.27 PM (1).jpeg', 'WhatsApp Image 2024-03-26 at 3.21.24 PM.jpeg', '', 0, 'In Stock', '2024-03-28 08:51:30', NULL),
(83, 3, 15, 'Georgette Silk', 'DKB Banarasi', 2850, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.21.25 PM (1).jpeg', 'WhatsApp Image 2024-03-26 at 3.21.28 PM (1).jpeg', '', 0, 'In Stock', '2024-03-28 08:52:12', NULL),
(84, 3, 15, 'Georgette Silk', 'DKB Banarasi', 2850, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.21.26 PM.jpeg', 'WhatsApp Image 2024-03-26 at 3.21.26 PM (1).jpeg', '', 0, 'In Stock', '2024-03-28 08:53:20', NULL),
(85, 3, 15, 'Georgette Silk', 'DKB Banarasi', 2850, 5000, '											', 'WhatsApp Image 2024-03-26 at 3.21.26 PM (2).jpeg', 'WhatsApp Image 2024-03-26 at 3.21.28 PM.jpeg', '', 0, 'In Stock', '2024-03-28 08:53:58', NULL),
(86, 12, 29, 'Georgette silk floral design', 'DKB ', 3150, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.33 AM (1).jpeg', '', '', 0, 'In Stock', '2024-03-29 04:48:50', NULL),
(87, 12, 29, 'Georgette silk floral design', 'DKB ', 3150, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.33 AM.jpeg', '', '', 0, 'In Stock', '2024-03-29 04:49:45', NULL),
(88, 12, 29, 'Georgette silk floral design', 'DKB ', 3150, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.34 AM (1).jpeg', '', '', 0, 'In Stock', '2024-03-29 04:50:22', NULL),
(89, 12, 29, 'Georgette silk floral design', 'DKB ', 3150, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.34 AM.jpeg', '', '', 0, 'In Stock', '2024-03-29 04:50:45', NULL),
(90, 12, 29, 'Georgette silk floral design', 'DKB ', 3150, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.35 AM.jpeg', '', '', 0, 'In Stock', '2024-03-29 04:51:19', NULL),
(91, 12, 29, 'Georgette silk floral design', 'DKB ', 3150, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.36 AM.jpeg', '', '', 0, 'In Stock', '2024-03-29 04:51:44', NULL),
(92, 12, 29, 'Georgette silk floral design', 'DKB ', 3150, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.37 AM.jpeg', '', '', 0, 'In Stock', '2024-03-29 04:53:30', NULL),
(93, 13, 30, 'Tissue crush silk body plain with tasel', 'DKB ', 2999, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.37 AM.jpeg', '', '', 0, 'In Stock', '2024-03-29 05:00:03', NULL),
(94, 13, 30, 'Tissue crush silk body plain with tasel', 'DKB ', 2999, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.39 AM.jpeg', '', '', 0, 'In Stock', '2024-03-29 05:02:44', NULL),
(95, 13, 30, 'Tissue crush silk body plain with tasel', 'DKB ', 2999, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.40 AM.jpeg', '', '', 0, 'In Stock', '2024-03-29 05:04:31', NULL),
(96, 13, 30, 'Tissue crush silk body plain with tasel', 'DKB ', 2999, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.41 AM (1).jpeg', '', '', 0, 'In Stock', '2024-03-29 05:06:00', NULL),
(97, 13, 30, 'Tissue crush silk body plain with tasel', 'DKB ', 2999, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.41 AM.jpeg', '', '', 0, 'In Stock', '2024-03-29 05:06:47', NULL),
(98, 13, 30, 'Tissue crush silk body plain with tasel', 'DKB ', 2999, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.42 AM.jpeg', '', '', 0, 'In Stock', '2024-03-29 05:07:55', NULL),
(99, 13, 30, 'Tissue crush silk body plain with tasel', 'DKB ', 2999, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.43 AM (1).jpeg', '', '', 0, 'In Stock', '2024-03-29 05:08:59', NULL),
(100, 13, 30, 'Tissue crush silk body plain with tasel', 'DKB ', 2999, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.43 AM.jpeg', '', '', 0, 'In Stock', '2024-03-29 05:10:08', NULL),
(101, 13, 30, 'Tissue crush silk body plain with tasel', 'DKB ', 2999, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.44 AM.jpeg', '', '', 0, 'In Stock', '2024-03-29 05:11:58', NULL),
(102, 13, 30, 'Tissue crush silk body plain with tasel', 'DKB ', 2999, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.45 AM.jpeg', '', '', 0, 'In Stock', '2024-03-29 05:12:47', NULL),
(103, 13, 30, 'Tissue crush silk body plain with tasel', 'DKB ', 2999, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.46 AM (1).jpeg', '', '', 0, 'In Stock', '2024-03-29 05:14:05', NULL),
(104, 13, 30, 'Tissue crush silk body plain with tasel', 'DKB ', 2999, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.46 AM.jpeg', '', '', 0, 'In Stock', '2024-03-29 05:15:07', NULL),
(105, 14, 32, 'Rainbow dyed tissue silk with tasel', 'DKB ', 3865, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.47 AM.jpeg', 'WhatsApp Image 2024-03-29 at 10.14.48 AM (1).jpeg', 'WhatsApp Image 2024-03-29 at 10.14.48 AM.jpeg', 0, 'In Stock', '2024-03-29 05:28:27', NULL),
(106, 15, 33, 'Organza silk sarees', 'DKB ', 3550, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.51 AM.jpeg', '', '', 0, 'In Stock', '2024-03-29 05:30:56', NULL),
(107, 15, 33, 'Organza silk sarees', 'DKB ', 3550, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.52 AM.jpeg', '', '', 0, 'In Stock', '2024-03-29 05:32:07', NULL),
(108, 15, 33, 'Organza silk sarees', 'DKB ', 3550, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.53 AM (1).jpeg', '', '', 0, 'In Stock', '2024-03-29 05:32:31', NULL),
(109, 15, 33, 'Organza silk sarees', 'DKB ', 3550, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.53 AM.jpeg', '', '', 0, 'In Stock', '2024-03-29 05:32:50', NULL),
(110, 15, 33, 'Organza silk sarees', 'DKB ', 3550, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.54 AM (1).jpeg', '', '', 0, 'In Stock', '2024-03-29 05:33:12', NULL),
(111, 15, 33, 'Organza silk sarees', 'DKB ', 3550, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.54 AM.jpeg', '', '', 0, 'In Stock', '2024-03-29 05:33:45', NULL),
(112, 15, 33, 'Organza silk sarees', 'DKB ', 3550, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.55 AM.jpeg', '', '', 0, 'In Stock', '2024-03-29 05:34:11', NULL),
(114, 15, 33, 'Organza silk sarees', 'DKB ', 3550, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.56 AM (1).jpeg', '', '', 0, 'In Stock', '2024-03-29 05:34:53', NULL),
(117, 15, 33, 'Organza silk sarees', 'DKB ', 3550, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.57 AM.jpeg', '', '', 0, 'In Stock', '2024-03-29 05:43:56', NULL),
(118, 15, 33, 'Organza silk sarees', 'DKB ', 3550, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.58 AM (1).jpeg', '', '', 0, 'In Stock', '2024-03-29 05:44:24', NULL),
(119, 15, 33, 'Organza silk sarees', 'DKB ', 3550, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.58 AM.jpeg', '', '', 0, 'In Stock', '2024-03-29 05:44:47', NULL),
(120, 15, 33, 'Organza silk sarees', 'DKB ', 3550, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.14.59 AM.jpeg', '', '', 0, 'In Stock', '2024-03-29 05:45:45', NULL),
(124, 15, 33, 'Organza silk sarees', 'DKB ', 3550, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.15.01 AM.jpeg', '', '', 0, 'In Stock', '2024-03-29 05:54:30', NULL),
(125, 15, 33, 'Organza silk sarees', 'DKB ', 3550, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.15.00 AM.jpeg', 'WhatsApp Image 2024-03-29 at 10.15.02 AM.jpeg', 'WhatsApp Image 2024-03-29 at 10.15.07 AM.jpeg', 0, 'In Stock', '2024-03-29 06:00:05', NULL),
(126, 15, 33, 'Organza silk sarees', 'DKB ', 3550, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.15.03 AM (1).jpeg', '', '', 0, 'In Stock', '2024-03-29 06:01:02', NULL),
(127, 15, 33, 'Organza silk sarees', 'DKB ', 3550, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.15.03 AM.jpeg', '', '', 0, 'In Stock', '2024-03-29 06:01:46', NULL),
(128, 15, 33, 'Organza silk sarees', 'DKB ', 3550, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.15.04 AM.jpeg', '', '', 0, 'In Stock', '2024-03-29 06:02:31', NULL),
(129, 15, 33, 'Organza silk sarees', 'DKB ', 3550, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.15.05 AM.jpeg', '', '', 0, 'In Stock', '2024-03-29 06:02:56', NULL),
(130, 15, 33, 'Organza silk sarees', 'DKB ', 3550, 4000, '											', 'WhatsApp Image 2024-03-29 at 10.15.06 AM.jpeg', '', '', 0, 'In Stock', '2024-03-29 06:03:20', NULL),
(131, 4, 17, 'Katan warm silk heavy blouse body plain with border & beautiful pallu', 'DK BROS', 2650, 3000, '											', 'WhatsApp Image 2024-04-04 at 11.58.56 AM (1).jpeg', '', '', 0, 'In Stock', '2024-04-15 07:21:03', NULL),
(132, 4, 17, 'Katan warm silk heavy blouse body plain with border & beautiful pallu', 'DK BROS', 2650, 3000, '											', 'WhatsApp Image 2024-04-04 at 11.58.56 AM (2).jpeg', 'WhatsApp Image 2024-04-04 at 11.58.57 AM (1).jpeg', 'WhatsApp Image 2024-04-04 at 11.58.58 AM.jpeg', 0, 'In Stock', '2024-04-15 07:22:43', NULL),
(133, 4, 17, 'Katan warm silk heavy blouse body plain with border & beautiful pallu', 'DK BROS', 2650, 3000, '											', 'WhatsApp Image 2024-04-04 at 11.58.56 AM.jpeg', 'WhatsApp Image 2024-04-04 at 11.58.57 AM (2).jpeg', '', 0, 'In Stock', '2024-04-15 07:25:15', NULL),
(134, 4, 17, 'Katan warm silk heavy blouse body plain with border & beautiful pallu', 'DK BROS', 2650, 3000, '											', 'WhatsApp Image 2024-04-04 at 11.58.57 AM.jpeg', 'WhatsApp Image 2024-04-04 at 11.58.58 AM (1).jpeg', '', 0, 'In Stock', '2024-04-15 07:25:52', NULL),
(135, 4, 17, 'Katan warm silk heavy blouse body plain with border & beautiful pallu', 'DK BROS', 2650, 3000, '											', 'WhatsApp Image 2024-04-04 at 11.58.58 AM (2).jpeg', '', '', 0, 'In Stock', '2024-04-15 07:26:16', NULL),
(136, 4, 17, 'Katan warm silk heavy blouse body plain with border & beautiful pallu', 'DK BROS', 2650, 3000, '											', 'WhatsApp Image 2024-04-04 at 11.58.58 AM (3).jpeg', 'WhatsApp Image 2024-04-04 at 11.58.59 AM (1).jpeg', '', 0, 'In Stock', '2024-04-15 07:26:54', NULL),
(137, 4, 17, 'Katan warm silk heavy blouse body plain with border & beautiful pallu', 'DK BROS', 2650, 3000, '											', 'WhatsApp Image 2024-04-04 at 11.58.59 AM.jpeg', '', '', 0, 'In Stock', '2024-04-15 07:27:21', NULL),
(138, 13, 30, 'Tissue crush Meena jaal full floral work', 'DK BROS', 2850, 3500, '											', 'WhatsApp Image 2024-04-04 at 11.59.15 AM (1).jpeg', '', '', 0, 'In Stock', '2024-04-15 07:32:01', NULL),
(139, 13, 30, 'Tissue crush Meena jaal full floral work', 'DK BROS', 2850, 3500, '											', 'WhatsApp Image 2024-04-04 at 11.59.15 AM (2).jpeg', 'WhatsApp Image 2024-04-04 at 11.59.17 AM (1).jpeg', '', 0, 'In Stock', '2024-04-15 07:32:53', NULL),
(140, 13, 30, 'Tissue crush Meena jaal full floral work', 'DK BROS', 2850, 3500, '											', 'WhatsApp Image 2024-04-04 at 11.59.15 AM.jpeg', 'WhatsApp Image 2024-04-04 at 11.59.18 AM.jpeg', '', 0, 'In Stock', '2024-04-15 07:33:53', NULL),
(141, 13, 30, 'Tissue crush Meena jaal full floral work', 'DK BROS', 2850, 3500, '											', 'WhatsApp Image 2024-04-04 at 11.59.16 AM (1).jpeg', 'WhatsApp Image 2024-04-04 at 11.59.17 AM (2).jpeg', '', 0, 'In Stock', '2024-04-15 07:34:52', NULL),
(142, 13, 30, 'Tissue crush Meena jaal full floral work', 'DK BROS', 2850, 3500, '											', 'WhatsApp Image 2024-04-04 at 11.59.16 AM (2).jpeg', '', '', 0, 'In Stock', '2024-04-15 07:35:35', NULL),
(143, 13, 30, 'Tissue crush Meena jaal full floral work', 'DK BROS', 2850, 3500, '											', 'WhatsApp Image 2024-04-04 at 11.59.16 AM (3).jpeg', 'WhatsApp Image 2024-04-04 at 11.59.17 AM.jpeg', '', 0, 'In Stock', '2024-04-15 07:36:09', NULL),
(144, 13, 30, 'Tissue crush Meena jaal full floral work', 'DK BROS', 2850, 3500, '											', 'WhatsApp Image 2024-04-04 at 11.59.16 AM.jpeg', '', '', 0, 'In Stock', '2024-04-15 07:36:36', NULL),
(145, 16, 34, 'Banarasi ambose suit Top katan ambose Dupatta chiffon embroidery Bottom dupian dyebal ', 'DK BROS', 3000, 3700, '											', 'WhatsApp Image 2024-04-04 at 11.59.37 AM (1).jpeg', '', '', 0, 'In Stock', '2024-04-15 07:48:17', NULL),
(146, 16, 34, 'Banarasi ambose suit Top katan ambose Dupatta chiffon embroidery Bottom dupian dyebal ', 'DK BROS', 3000, 3700, '											', 'WhatsApp Image 2024-04-04 at 11.59.37 AM.jpeg', '', '', 0, 'In Stock', '2024-04-15 07:48:42', NULL),
(147, 16, 34, 'Banarasi ambose suit Top katan ambose Dupatta chiffon embroidery Bottom dupian dyebal ', 'DK BROS', 3000, 3700, '											', 'WhatsApp Image 2024-04-04 at 11.59.38 AM (1).jpeg', '', '', 0, 'In Stock', '2024-04-15 07:49:06', NULL),
(148, 16, 34, 'Banarasi ambose suit Top katan ambose Dupatta chiffon embroidery Bottom dupian dyebal ', 'DK BROS', 3000, 3700, '											', 'WhatsApp Image 2024-04-04 at 11.59.38 AM (2).jpeg', '', '', 0, 'In Stock', '2024-04-15 07:49:26', NULL),
(149, 16, 34, 'Banarasi ambose suit Top katan ambose Dupatta chiffon embroidery Bottom dupian dyebal ', 'DK BROS', 3000, 3700, '											', 'WhatsApp Image 2024-04-04 at 11.59.38 AM.jpeg', '', '', 0, 'In Stock', '2024-04-15 07:49:59', NULL),
(150, 16, 34, 'Banarasi ambose suit Top katan ambose Dupatta chiffon embroidery Bottom dupian dyebal ', 'DK BROS', 3000, 3700, '											', 'WhatsApp Image 2024-04-04 at 11.59.39 AM (1).jpeg', '', '', 0, 'In Stock', '2024-04-15 07:50:29', NULL),
(151, 16, 34, 'Banarasi ambose suit Top katan ambose Dupatta chiffon embroidery Bottom dupian dyebal ', 'DK BROS', 3000, 3700, '											', 'WhatsApp Image 2024-04-04 at 11.59.39 AM.jpeg', '', '', 0, 'In Stock', '2024-04-15 07:50:49', NULL),
(152, 15, 33, 'Organza silk saree double booti silver golden mix', 'DK BROS', 3450, 4000, '											', 'WhatsApp Image 2024-04-04 at 12.00.09 PM.jpeg', '', '', 0, 'In Stock', '2024-04-15 07:52:48', NULL),
(153, 15, 33, 'Organza silk saree double booti silver golden mix', 'DK BROS', 3450, 4000, '											', 'WhatsApp Image 2024-04-04 at 12.00.10 PM (1).jpeg', '', '', 0, 'In Stock', '2024-04-15 07:53:15', NULL),
(154, 15, 33, 'Organza silk saree double booti silver golden mix', 'DK BROS', 3450, 4000, '											', 'WhatsApp Image 2024-04-04 at 12.00.10 PM (2).jpeg', 'WhatsApp Image 2024-04-04 at 12.00.13 PM.jpeg', '', 0, 'In Stock', '2024-04-15 07:53:57', NULL),
(155, 15, 33, 'Organza silk saree double booti silver golden mix', 'DK BROS', 3450, 4000, '											', 'WhatsApp Image 2024-04-04 at 12.00.10 PM.jpeg', 'WhatsApp Image 2024-04-04 at 12.00.12 PM (2).jpeg', '', 0, 'In Stock', '2024-04-15 07:54:45', NULL),
(156, 15, 33, 'Organza silk saree double booti silver golden mix', 'DK BROS', 3450, 4000, '											', 'WhatsApp Image 2024-04-04 at 12.00.11 PM (1).jpeg', 'WhatsApp Image 2024-04-04 at 12.00.12 PM (3).jpeg', 'WhatsApp Image 2024-04-04 at 12.00.12 PM.jpeg', 0, 'In Stock', '2024-04-15 07:55:32', NULL),
(157, 15, 33, 'Organza silk saree double booti silver golden mix', 'DK BROS', 3450, 4000, '											', 'WhatsApp Image 2024-04-04 at 12.00.11 PM (2).jpeg', '', '', 0, 'In Stock', '2024-04-15 07:55:59', NULL),
(158, 15, 33, 'Organza silk saree double booti silver golden mix', 'DK BROS', 3450, 4000, '											', 'WhatsApp Image 2024-04-04 at 12.00.11 PM.jpeg', '', '', 0, 'In Stock', '2024-04-15 07:56:25', NULL),
(159, 15, 33, 'Organza silk saree double booti silver golden mix', 'DK BROS', 3450, 4000, '											', 'WhatsApp Image 2024-04-04 at 12.00.12 PM (1).jpeg', '', '', 0, 'In Stock', '2024-04-15 07:57:31', NULL),
(160, 15, 33, 'Organza silk saree double booti silver golden mix', 'DK BROS', 3450, 4000, '											', 'WhatsApp Image 2024-04-04 at 12.00.13 PM (1).jpeg', '', '', 0, 'In Stock', '2024-04-15 07:58:11', NULL),
(161, 15, 33, 'Organza silk saree double booti silver golden mix', 'DK BROS', 3450, 4000, '											', 'WhatsApp Image 2024-04-04 at 12.00.13 PM (2).jpeg', '', '', 0, 'In Stock', '2024-04-15 07:58:41', NULL),
(162, 15, 33, 'Organza silk saree double booti silver golden mix', 'DK BROS', 3450, 4000, '											', 'WhatsApp Image 2024-04-04 at 12.00.14 PM (1).jpeg', '', '', 0, 'In Stock', '2024-04-15 07:59:18', NULL),
(163, 15, 33, 'Organza silk saree double booti silver golden mix', 'DK BROS', 3450, 4000, '											', 'WhatsApp Image 2024-04-04 at 12.00.14 PM (2).jpeg', '', '', 0, 'In Stock', '2024-04-15 07:59:40', NULL),
(164, 15, 33, 'Organza silk saree double booti silver golden mix', 'DK BROS', 3450, 4000, '											', 'WhatsApp Image 2024-04-04 at 12.00.14 PM (3).jpeg', '', '', 0, 'In Stock', '2024-04-15 08:00:09', NULL),
(165, 15, 33, 'Organza silk saree double booti silver golden mix', 'DK BROS', 3450, 4000, '											', 'WhatsApp Image 2024-04-04 at 12.00.14 PM.jpeg', '', '', 0, 'In Stock', '2024-04-15 08:00:46', NULL),
(166, 15, 33, 'Organza silk saree double booti silver golden mix', 'DK BROS', 3450, 4000, '											', 'WhatsApp Image 2024-04-04 at 12.00.15 PM.jpeg', '', '', 0, 'In Stock', '2024-04-15 08:01:10', NULL),
(167, 15, 33, 'Organza silk saree double booti silver golden mix', 'DK BROS', 3450, 4000, '											', 'WhatsApp Image 2024-04-04 at 11.59.56 AM.jpeg', '', '', 0, 'In Stock', '2024-04-15 08:42:27', NULL),
(168, 15, 33, 'Organza silk saree double booti silver golden mix', 'DK BROS', 3450, 4000, '											', 'WhatsApp Image 2024-04-04 at 11.59.56 AM (1).jpeg', '', '', 0, 'In Stock', '2024-04-15 08:43:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `categoryid` int(11) DEFAULT NULL,
  `subcategory` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `categoryid`, `subcategory`, `creationDate`, `updationDate`) VALUES
(13, 3, 'Saree', '2023-12-18 16:03:38', NULL),
(15, 3, 'Silk', '2023-12-18 16:18:37', NULL),
(16, 4, 'Saree', '2023-12-18 16:18:47', NULL),
(17, 4, 'Silk', '2023-12-18 16:18:54', NULL),
(18, 5, 'Saree', '2023-12-18 16:19:01', NULL),
(19, 5, 'Silk', '2023-12-18 16:19:06', NULL),
(20, 6, 'Saree', '2023-12-18 16:19:12', NULL),
(22, 6, 'Silk', '2023-12-18 16:19:43', NULL),
(23, 7, 'Saree', '2023-12-18 16:20:49', NULL),
(24, 7, 'Silk', '2023-12-18 16:20:56', NULL),
(25, 8, 'Saree', '2023-12-18 16:21:06', NULL),
(26, 8, 'Silk', '2023-12-18 16:21:19', NULL),
(27, 9, 'benarasi tissue silk', '2024-02-28 10:39:14', NULL),
(28, 11, 'Kora Sarees', '2024-03-28 07:34:56', NULL),
(29, 12, 'Silk Sarees', '2024-03-29 04:47:04', NULL),
(30, 13, 'Silk Sarees', '2024-03-29 04:56:48', NULL),
(31, 13, 'Silk Sarees', '2024-03-29 04:56:57', NULL),
(32, 14, 'Silk Sarees', '2024-03-29 05:17:45', NULL),
(33, 15, 'Silk Sarees', '2024-03-29 05:29:43', NULL),
(34, 16, 'katan Suit', '2024-04-15 07:47:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `userEmail` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `userEmail`, `userip`, `loginTime`, `logout`, `status`) VALUES
(110, 'aleem2023web@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-23 11:10:48', NULL, 1),
(111, 'aleem121020@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-24 06:17:30', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactno` bigint(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `shippingAddress` longtext DEFAULT NULL,
  `shippingState` varchar(255) DEFAULT NULL,
  `shippingCity` varchar(255) DEFAULT NULL,
  `shippingPincode` int(11) DEFAULT NULL,
  `billingAddress` longtext DEFAULT NULL,
  `billingState` varchar(255) DEFAULT NULL,
  `billingCity` varchar(255) DEFAULT NULL,
  `billingPincode` int(11) DEFAULT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contactno`, `password`, `shippingAddress`, `shippingState`, `shippingCity`, `shippingPincode`, `billingAddress`, `billingState`, `billingCity`, `billingPincode`, `regDate`, `updationDate`) VALUES
(18, 'Abdul Aleem', 'aleem2023web@gmail.com', 7599612565, '705d7b3c3e30443b5a6c7cac25f6ba3c', NULL, NULL, NULL, NULL, 'chouhan Bager', 'delhi', 'delhi', 10053, '2024-09-23 11:08:20', NULL),
(19, 'Abdul', 'aleem121020@gmail.com', 7599612695, '705d7b3c3e30443b5a6c7cac25f6ba3c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-24 06:16:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `productId` int(11) DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordertrackhistory`
--
ALTER TABLE `ordertrackhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productreviews`
--
ALTER TABLE `productreviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ordertrackhistory`
--
ALTER TABLE `ordertrackhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `productreviews`
--
ALTER TABLE `productreviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
