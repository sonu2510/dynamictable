-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2021 at 01:09 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `metal_skill_balls`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_menu`
--

CREATE TABLE `admin_menu` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `parent_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_menu`
--

INSERT INTO `admin_menu` (`admin_id`, `parent_id`, `title`, `route`, `icon`, `sort`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '0', 'Dashboard', 'home', 'mdi mdi-view-dashboard', 0, 1, NULL, '2020-11-02 08:41:35', '2020-11-02 08:41:35'),
(2, '0', 'User Management', '', 'mdi mdi-account-settings-variant', 0, 1, NULL, '2020-11-02 08:41:35', '2020-11-02 08:41:35'),
(3, '2', 'User type', 'usertype', 'mdi mdi-account-circle', 3, 1, NULL, '2020-11-02 08:41:35', '2020-11-02 08:41:35'),
(4, '2', 'User Permission', 'usersdata', 'mdi mdi-account-key', 2, 1, NULL, '2020-11-02 08:41:35', '2020-11-02 08:41:35'),
(5, '2', 'Users', 'userslist', 'mdi mdi-account-settings-variant', 1, 1, NULL, '2020-11-02 08:41:35', '2020-11-02 08:41:35'),
(6, '0', 'Masters', '', 'mdi mdi-tune-vertical', 0, 1, NULL, '2020-11-02 08:41:35', '2020-11-02 08:41:35'),
(7, '0', 'Production', '', 'mdi mdi-factory', 0, 1, NULL, '2020-11-02 08:41:35', '2020-11-02 08:41:35'),
(8, '0', 'Raw Material', '', 'mdi mdi-truck-delivery', 0, 1, NULL, '2020-11-02 08:41:35', '2020-11-02 08:41:35'),
(10, '8', 'SAPP Inwards', 'inward', 'mdi mdi-package-variant', 1, 1, NULL, '2020-11-02 08:41:35', '2020-11-02 08:41:35'),
(11, '7', 'Vendor', 'supplier', 'mdi mdi-factory', 7, 1, NULL, '2020-11-02 08:41:35', '2020-11-02 08:41:35'),
(12, '8', 'QC Report(Inwards)', 'qcinward_report', 'mdi mdi-package-variant', 4, 1, NULL, '2020-11-02 08:41:35', '2020-11-02 08:41:35'),
(13, '6', 'Coil ', 'coildetail', 'mdi mdi-package-variant', 5, 1, NULL, '2020-11-02 08:41:35', '2020-11-02 08:41:35'),
(14, '8', 'Under Processing Inwards', 'inward_underprocess', 'mdi mdi-package-variant', 2, 1, NULL, '2020-11-02 08:41:35', '2020-11-02 08:41:35'),
(15, '16', 'Finished Wire (Stock)', 'finished_stock', 'mdi mdi-package-variant', 2, 1, NULL, '2020-11-02 08:41:35', '2020-11-02 08:41:35'),
(16, '0', 'Stock', '', 'mdi mdi-truck-delivery', 0, 1, NULL, '2020-11-02 08:41:35', '2020-11-02 08:41:35'),
(17, '16', 'SAPP (Stock)', 'sapp_stock', 'mdi mdi-package-variant', 1, 1, NULL, '2020-11-02 08:41:35', '2020-11-02 08:41:35'),
(18, '6', 'Processed Coil', 'processed_coil', 'mdi mdi-package-variant', 5, 1, NULL, '2020-11-02 08:41:35', '2020-11-02 08:41:35'),
(19, '6', 'Ball Diameter', 'ballsize', 'mdi mdi-package-variant', 5, 1, NULL, '2020-11-02 08:41:35', '2020-11-02 08:41:35'),
(20, '7', 'Heading', 'heading', 'mdi mdi-factory', 1, 1, NULL, '2020-11-02 08:41:35', '2020-11-02 08:41:35'),
(21, '7', 'Flashing', 'flashing', 'mdi mdi-factory', 2, 1, NULL, '2020-11-02 08:41:35', '2020-11-02 08:41:35'),
(22, '7', 'Grinding', 'grinding', 'mdi mdi-factory', 4, 1, NULL, '2020-11-02 08:41:35', '2020-11-02 08:41:35'),
(23, '7', 'Lapping', 'lapping', 'mdi mdi-factory', 5, 1, NULL, '2020-11-02 08:41:35', '2020-11-02 08:41:35'),
(24, '6', 'Machine Master', 'machine_master', 'mdi mdi-package-variant', 5, 1, NULL, NULL, NULL),
(25, '6', 'Machine Type', 'machine_type', 'mdi mdi-package-variant', 5, 1, NULL, NULL, NULL),
(26, '7', 'Heat Treatment Process', 'ht_process', 'mdi mdi-package-variant', 3, 1, NULL, NULL, NULL),
(27, '16', 'Production Stock', 'production_stock', 'mdi mdi-package-variant', 3, 1, NULL, '2020-11-02 08:41:35', '2020-11-02 08:41:35'),
(28, '0', 'Dynamic', 'home', 'mdi mdi-account-settings-variant', 0, 1, NULL, '2020-11-02 08:41:35', '2020-11-02 08:41:35'),
(29, '28', 'Table', 'dynamictable', 'mdi mdi-account-circle', 0, 1, NULL, '2020-11-02 08:41:35', '2020-11-02 08:41:35');

-- --------------------------------------------------------

--
-- Table structure for table `asnewtable`
--

CREATE TABLE `asnewtable` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no` int(11) DEFAULT NULL,
  `dddddd` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asremane`
--

CREATE TABLE `asremane` (
  `table_id` int(10) UNSIGNED NOT NULL,
  `c1` varchar(151) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c2` varchar(54) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c3` int(11) DEFAULT NULL,
  `c4` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assssssss`
--

CREATE TABLE `assssssss` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `atest`
--

CREATE TABLE `atest` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name tyej` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ball_size`
--

CREATE TABLE `ball_size` (
  `id` int(11) NOT NULL,
  `ball_size` varchar(151) DEFAULT NULL,
  `ball_batch_no` varchar(151) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `hs_equator_dia` text DEFAULT NULL,
  `hs_equator_tolerance` text DEFAULT NULL,
  `hs_pole_dimension` text DEFAULT NULL,
  `hs_pole_tolerance` text DEFAULT NULL,
  `hs_offset` text DEFAULT NULL,
  `hs_weight_min` text DEFAULT NULL,
  `hs_weight_max` text DEFAULT NULL,
  `hs_total_balls_min` text DEFAULT NULL,
  `hs_total_balls_max` text DEFAULT NULL,
  `fs_unloading_gauge` text DEFAULT NULL,
  `fs_tolerance` text DEFAULT NULL,
  `fs_ovality` text DEFAULT NULL,
  `fs_lot_variation` text DEFAULT NULL,
  `gs_unloading_gauge` text DEFAULT NULL,
  `gs_tolerance` text DEFAULT NULL,
  `gs_ovality` text DEFAULT NULL,
  `gs_lot_variation` text DEFAULT NULL,
  `ls_unloading_gauge` text DEFAULT NULL,
  `ls_tolerance` text DEFAULT NULL,
  `ls_ovality` text DEFAULT NULL,
  `ls_lot_variation` text DEFAULT NULL,
  `created_at` tinytext DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ball_size`
--

INSERT INTO `ball_size` (`id`, `ball_size`, `ball_batch_no`, `status`, `hs_equator_dia`, `hs_equator_tolerance`, `hs_pole_dimension`, `hs_pole_tolerance`, `hs_offset`, `hs_weight_min`, `hs_weight_max`, `hs_total_balls_min`, `hs_total_balls_max`, `fs_unloading_gauge`, `fs_tolerance`, `fs_ovality`, `fs_lot_variation`, `gs_unloading_gauge`, `gs_tolerance`, `gs_ovality`, `gs_lot_variation`, `ls_unloading_gauge`, `ls_tolerance`, `ls_ovality`, `ls_lot_variation`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1/8', '3175', 1, '3.700', '- 40 / + 60', '50', '3.800', '± 40', '4545', '4762', '21.0', '22.0', '+130', '±15µm', '±20µm', '±30µm', '+ 12 (+/- Gauge Size)', '± 2µm', '± 2µm', '4µm', '0', '0', '0', '0', '2021-03-13 04:17:00', '2021-03-25 01:55:42', NULL),
(2, '3.50 mm', '3500', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(3, '5/32\"', '3969', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(4, '4.00 mm', '4000', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(5, '4.50 mm', '4500', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(6, '3/16\"', '4763', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(7, '5.00 mm', '5000', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(8, '5.50 mm', '5500', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(9, '7/32\"', '5556', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(10, '15/64\"', '5953', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(11, '6.00 mm', '6000', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(12, '1/4\"', '6350', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(13, '6.50 mm', '6500', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(14, '17/64\"', '6747', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(15, '7.00 mm', '7000', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(16, '9/32\"', '7144', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(17, '5/16\"', '7938', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(18, '8.00 mm', '8000', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(19, '11/32\"', '8731', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(20, '9.0 mm', '9000', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(21, '3/8\"', '9525', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(22, '10.0 mm', '10000', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(23, '13/32\"', '10319', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(24, '7/16\"', '11112', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(25, '11.50 mm', '11500', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(26, '29/64\"', '11509', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(27, '15/32\"', '11906', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(28, '12.00MM', '12000', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(29, '31/64\"', '12303', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(30, '1/2\"', '12700', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(31, '17/32\"', '13494', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(32, '14.00 mm', '14000', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(33, '9/16\"', '14288', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(34, '19/32\"', '15081', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(35, '5/8\"', '15875', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(36, '21/32\"', '16669', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(37, '11/16\"', '17462', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(38, '23/32\"', '18256', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(39, '19.00 mm', '19000', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(40, '3/4\"', '19050', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(41, '25/32\"', '19843', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(42, '20.00 mm', '20000', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(43, '13/16\"', '20638', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(44, '27/32\"', '21431', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(45, '22.00MM', '22000', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(46, '7/8\"', '22225', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(47, '29/32\"', '23019', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(48, '15/16\"', '23812', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(49, '31/32\"', '24606', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(50, '25.00 mm', '25000', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(51, '1\"', '25400', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(52, '1.1/32\"', '26194', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(53, '1.1/16\"', '26987', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(54, '1.1/8\"', '28575', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(55, '1.3/16\"', '30162', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(56, '1.1/4\"', '31750', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(57, '1.5/16\"', '33337', 1, '1', '1', '50', '', '641', '6', '16', '1', '61', NULL, NULL, NULL, NULL, '6', '16', '1', '61', '6', '16', '1', '61', '2021-03-13 04:17:00', '2021-03-12 22:47:00', NULL),
(58, 'ball_size', 'ball_batch_no', 0, 'hs_pole_dimension', 'hs_equator_dia', 'hs_offset', 'hs_weight', 'hs_surface', 'fs_unloading_gauge', 'fs_ball_dia_variation', 'fs_loading_dia_variation', 'fs_surface', NULL, NULL, NULL, NULL, 'gs_unloading_gauge', 'gs_ball_dia_variation', 'gs_loading_dia_variation', 'gs_surface', 'ls_unloading_gauge', 'ls_ball_dia_variation', 'ls_loading_dia_variation', 'ls_surface', 'created_at', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `coil_detail`
--

CREATE TABLE `coil_detail` (
  `id` int(11) NOT NULL,
  `coil_size` varchar(255) DEFAULT NULL,
  `coil_number` varchar(151) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coil_detail`
--

INSERT INTO `coil_detail` (`id`, `coil_size`, `coil_number`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '5 mm', '50', 1, '2020-11-29 23:47:46', '2021-03-24 23:33:29', NULL),
(2, '6 mm', '60', 1, '2020-11-29 23:48:46', '2021-03-24 23:33:35', NULL),
(3, '10 mm', NULL, 1, '2021-01-23 06:01:20', '2021-01-23 06:01:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `data_rows`
--

CREATE TABLE `data_rows` (
  `id` int(10) UNSIGNED NOT NULL,
  `data_type_id` int(10) UNSIGNED NOT NULL,
  `field` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `browse` tinyint(1) NOT NULL DEFAULT 1,
  `read` tinyint(1) NOT NULL DEFAULT 1,
  `edit` tinyint(1) NOT NULL DEFAULT 1,
  `add` tinyint(1) NOT NULL DEFAULT 1,
  `delete` tinyint(1) NOT NULL DEFAULT 1,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_types`
--

CREATE TABLE `data_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT 0,
  `server_side` tinyint(4) NOT NULL DEFAULT 0,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `demo`
--

CREATE TABLE `demo` (
  `id` int(10) UNSIGNED NOT NULL,
  `field_1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `field_2` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `field_3` int(11) NOT NULL,
  `field_4` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flashing`
--

CREATE TABLE `flashing` (
  `flashing_id` int(11) NOT NULL,
  `flashing_no` varchar(151) DEFAULT NULL,
  `shift_type` tinyint(2) DEFAULT NULL,
  `flashing_date` date DEFAULT NULL,
  `master_batch_no` varchar(111) DEFAULT NULL,
  `flashing_batch_no` varchar(151) DEFAULT NULL,
  `ball_diameter` int(11) DEFAULT NULL,
  `heading_id` int(11) DEFAULT NULL,
  `fs_unloading_gauge` text DEFAULT NULL,
  `fs_tolerance` text DEFAULT NULL,
  `fs_ovality` text DEFAULT NULL,
  `fs_lot_variation` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `flashing`
--

INSERT INTO `flashing` (`flashing_id`, `flashing_no`, `shift_type`, `flashing_date`, `master_batch_no`, `flashing_batch_no`, `ball_diameter`, `heading_id`, `fs_unloading_gauge`, `fs_tolerance`, `fs_ovality`, `fs_lot_variation`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'FLS000001', 1, '2021-03-24', 'test1', NULL, 1, 9, '1', '2', '3', '4', 1, '2021-03-24 03:16:30', '2021-03-24 03:16:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `flashing_batch`
--

CREATE TABLE `flashing_batch` (
  `flashing_batch_id` int(11) NOT NULL,
  `flashing_id` int(11) DEFAULT NULL,
  `ball_size_id` int(11) DEFAULT NULL,
  `flashing_batch_no` varchar(255) DEFAULT NULL,
  `batch_weight` decimal(10,3) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `flashing_batch`
--

INSERT INTO `flashing_batch` (`flashing_batch_id`, `flashing_id`, `ball_size_id`, `flashing_batch_no`, `batch_weight`, `created_at`, `deleted_at`, `updated_at`) VALUES
(1, 1, 1, 'trest2', NULL, '2021-03-24 03:16:30', NULL, '2021-03-24 03:16:30'),
(2, 1, 1, 'test4', NULL, '2021-03-24 03:16:30', NULL, '2021-03-24 03:16:30');

-- --------------------------------------------------------

--
-- Table structure for table `flashing_observation`
--

CREATE TABLE `flashing_observation` (
  `flashing_observation_id` int(11) NOT NULL,
  `flashing_id` int(11) DEFAULT NULL,
  `machine_id` int(11) DEFAULT NULL,
  `operator_id` int(11) DEFAULT NULL,
  `unloading_gauge` varchar(151) DEFAULT NULL,
  `ball_dia_variation` varchar(151) DEFAULT NULL,
  `load_dia_variation` varchar(151) DEFAULT NULL,
  `surface` varchar(151) DEFAULT NULL,
  `loading_time` time DEFAULT NULL,
  `loading_date` date DEFAULT NULL,
  `unloading_date` date DEFAULT NULL,
  `unloading_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `flashing_observation`
--

INSERT INTO `flashing_observation` (`flashing_observation_id`, `flashing_id`, `machine_id`, `operator_id`, `unloading_gauge`, `ball_dia_variation`, `load_dia_variation`, `surface`, `loading_time`, `loading_date`, `unloading_date`, `unloading_time`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 4, '3', '3', '3', '3', '12:34:00', '2021-03-24', '2021-03-24', '12:04:00', '2021-03-24 03:16:30', '2021-03-24 03:16:30', NULL),
(2, 1, 2, 4, '54', '4', '5', '34', '12:04:00', '2021-03-24', '2021-03-24', '12:34:00', '2021-03-24 03:16:30', '2021-03-24 03:16:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grinding`
--

CREATE TABLE `grinding` (
  `grinding_id` int(11) NOT NULL,
  `grinding_no` varchar(151) DEFAULT NULL,
  `shift_type` tinyint(2) DEFAULT NULL,
  `grinding_date` date DEFAULT NULL,
  `batch_id` varchar(151) DEFAULT NULL,
  `grinding_batch_no` varchar(151) DEFAULT NULL,
  `ball_diameter` int(11) DEFAULT NULL,
  `flashing_id` int(11) DEFAULT NULL,
  `gs_unloading_gauge` text DEFAULT NULL,
  `gs_tolerance` text DEFAULT NULL,
  `gs_ovality` text DEFAULT NULL,
  `gs_lot_variation` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grinding`
--

INSERT INTO `grinding` (`grinding_id`, `grinding_no`, `shift_type`, `grinding_date`, `batch_id`, `grinding_batch_no`, `ball_diameter`, `flashing_id`, `gs_unloading_gauge`, `gs_tolerance`, `gs_ovality`, `gs_lot_variation`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'GRD000001', 1, '2021-02-11', '1', 'GRD12312312', 1, 1, '2', '323', '23', '23', 1, '2021-02-11 02:09:24', '2021-02-16 23:26:33', NULL),
(2, 'GRD000002', 1, '2021-03-24', '1', NULL, 1, NULL, '6', '16', '1', '61', 1, '2021-03-24 06:42:13', '2021-03-24 06:42:13', NULL),
(3, 'GRD000003', 1, '2021-03-25', '1', NULL, 1, NULL, '6', '16', '1', '61', 1, '2021-03-25 01:07:47', '2021-03-25 01:07:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grinding_observation`
--

CREATE TABLE `grinding_observation` (
  `grinding_observation_id` int(11) NOT NULL,
  `grinding_id` int(11) DEFAULT NULL,
  `machine_id` int(11) DEFAULT NULL,
  `operator_id` int(11) DEFAULT NULL,
  `unloading_gauge` varchar(151) DEFAULT NULL,
  `ball_dia_variation` varchar(151) DEFAULT NULL,
  `load_dia_variation` varchar(151) DEFAULT NULL,
  `surface` varchar(151) DEFAULT NULL,
  `loading_time` time DEFAULT NULL,
  `loading_date` date DEFAULT NULL,
  `unloading_date` date DEFAULT NULL,
  `unloading_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grinding_observation`
--

INSERT INTO `grinding_observation` (`grinding_observation_id`, `grinding_id`, `machine_id`, `operator_id`, `unloading_gauge`, `ball_dia_variation`, `load_dia_variation`, `surface`, `loading_time`, `loading_date`, `unloading_date`, `unloading_time`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 3, 4, '123', '323', '232', '3', '11:11:00', '2021-02-11', '2021-02-11', '11:12:00', '2021-02-11 02:09:24', '2021-02-12 06:18:03', NULL),
(2, 2, 3, 5, '4', '4', '4', '4', '12:03:00', '2021-03-24', '2021-03-24', '12:03:00', '2021-03-24 06:42:13', '2021-03-24 06:42:13', NULL),
(3, 2, 3, 5, '5', '5', '5', '5', '12:04:00', '2021-03-24', '2021-03-24', '12:04:00', '2021-03-24 06:42:13', '2021-03-24 06:42:13', NULL),
(4, 3, 3, 5, '124', '34', '4234', '24', '12:04:00', '2021-03-25', '2021-03-01', '12:04:00', '2021-03-25 01:07:47', '2021-03-25 01:07:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `heading`
--

CREATE TABLE `heading` (
  `heading_id` int(11) NOT NULL,
  `heading_no` varchar(151) DEFAULT NULL,
  `heading_batch_no` varchar(151) DEFAULT NULL,
  `ball_diameter` int(11) DEFAULT NULL,
  `processed_coil_id` int(11) DEFAULT NULL,
  `total_balls` decimal(10,2) DEFAULT NULL,
  `weight_per_100` decimal(10,3) DEFAULT NULL,
  `hcl_etching` varchar(151) DEFAULT NULL,
  `shift_type` tinyint(4) DEFAULT NULL,
  `heading_date` date DEFAULT NULL,
  `hs_equator_dia` text DEFAULT NULL,
  `hs_equator_tolerance` text DEFAULT NULL,
  `hs_pole_dimension` text DEFAULT NULL,
  `hs_pole_tolerance` text DEFAULT NULL,
  `hs_offset` text DEFAULT NULL,
  `hs_weight_min` text DEFAULT NULL,
  `hs_weight_max` text DEFAULT NULL,
  `hs_total_balls_min` text DEFAULT NULL,
  `hs_total_balls_max` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `heading`
--

INSERT INTO `heading` (`heading_id`, `heading_no`, `heading_batch_no`, `ball_diameter`, `processed_coil_id`, `total_balls`, `weight_per_100`, `hcl_etching`, `shift_type`, `heading_date`, `hs_equator_dia`, `hs_equator_tolerance`, `hs_pole_dimension`, `hs_pole_tolerance`, `hs_offset`, `hs_weight_min`, `hs_weight_max`, `hs_total_balls_min`, `hs_total_balls_max`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'HEAD000001', 'H-BT000001', 1, 1, '10000.00', NULL, NULL, 1, '2021-01-20', '1', '12', '34', 'OK', '43.000', NULL, NULL, NULL, NULL, 1, '2021-01-20 01:49:12', '2021-01-20 01:49:12', NULL),
(2, 'HEAD000001', 'H-BT000001', 1, 1, '1000.00', NULL, NULL, 1, '2021-01-20', '32', '323', '323', 'OK', '32.000', NULL, NULL, NULL, NULL, 1, '2021-01-20 01:54:01', '2021-02-06 05:29:00', '2021-02-06 05:29:00'),
(3, 'HEAD000003', '1235643155', 1, 1, '10000.00', '1100.320', 'ok', 1, '2021-01-20', '12', '32', '32', 'OK', '32.000', NULL, NULL, NULL, NULL, 1, '2021-01-20 01:55:11', '2021-02-05 23:15:02', NULL),
(4, 'HEAD000004', NULL, 1, 1, '100000.00', '21.000', 'No', 1, '2021-03-23', '1', '1', '1', '1', '1.000', NULL, NULL, NULL, NULL, 1, '2021-03-23 06:20:26', '2021-03-23 06:20:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `heading_batch`
--

CREATE TABLE `heading_batch` (
  `heading_batch_id` int(11) NOT NULL,
  `heading_id` int(11) DEFAULT NULL,
  `ball_size_id` int(11) DEFAULT NULL,
  `heading_batch_no` varchar(255) DEFAULT NULL,
  `batch_weight` decimal(10,3) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `heading_batch`
--

INSERT INTO `heading_batch` (`heading_batch_id`, `heading_id`, `ball_size_id`, `heading_batch_no`, `batch_weight`, `created_at`, `deleted_at`, `updated_at`) VALUES
(1, 9, 1, 'trujrtu', NULL, '2021-03-02 23:36:24', NULL, '2021-03-03 06:03:51'),
(2, 9, 1, '57w57', NULL, '2021-03-02 23:36:24', NULL, '2021-03-03 06:03:51'),
(3, 9, 1, '56uwee56ii', NULL, '2021-03-02 23:36:24', NULL, '2021-03-03 06:03:51'),
(4, 9, 1, '6667jk', NULL, '2021-03-03 05:59:51', '2021-03-03 06:11:26', '2021-03-03 06:11:26'),
(5, 9, 1, 'gjk', NULL, '2021-03-03 06:30:23', NULL, '2021-03-03 06:30:23'),
(6, 4, 1, 't1', NULL, '2021-03-23 06:20:26', NULL, '2021-03-23 06:20:26'),
(7, 4, 1, 't2', NULL, '2021-03-23 06:20:26', NULL, '2021-03-23 06:20:26');

-- --------------------------------------------------------

--
-- Table structure for table `heading_observation`
--

CREATE TABLE `heading_observation` (
  `heading_observation_id` int(11) NOT NULL,
  `heading_id` int(11) DEFAULT NULL,
  `observation_time` time DEFAULT NULL,
  `machine_id` int(11) DEFAULT NULL,
  `operator_id` int(11) DEFAULT NULL,
  `eqautor` varchar(151) DEFAULT NULL,
  `pole_dimension` varchar(151) DEFAULT NULL,
  `offset` varchar(151) DEFAULT NULL,
  `surface` varchar(151) DEFAULT NULL,
  `hcl_etching` varchar(151) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `heading_observation`
--

INSERT INTO `heading_observation` (`heading_observation_id`, `heading_id`, `observation_time`, `machine_id`, `operator_id`, `eqautor`, `pole_dimension`, `offset`, `surface`, `hcl_etching`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '09:00:00', NULL, NULL, '1', '2', '3', 'OK', NULL, '2021-01-20 01:49:13', '2021-01-20 01:49:13', NULL),
(2, 1, '10:00:00', NULL, NULL, '2', '3', '4', 'OK', NULL, '2021-01-20 01:49:13', '2021-01-20 01:49:13', NULL),
(3, 2, '09:00:00', 1, 3, '1', '2', '3', 'OK', NULL, '2021-01-20 01:54:01', '2021-01-20 01:54:01', NULL),
(4, 2, '10:00:00', 1, 3, '22', '3', '331', 'OK', NULL, '2021-01-20 01:54:01', '2021-01-20 01:54:01', NULL),
(5, 3, '09:00:00', 1, 3, '2', '2', '2', 'OK', NULL, '2021-01-20 01:55:11', '2021-02-06 05:50:45', NULL),
(6, 3, '11:00:00', 1, 3, '3', '3', '3', 'ok', NULL, '2021-01-20 01:55:11', '2021-02-06 05:29:09', '2021-02-06 05:29:09'),
(7, 3, '10:00:00', 1, 3, '23', '32', '24', '43', NULL, '2021-02-06 05:31:27', '2021-02-06 05:50:45', NULL),
(8, 3, '11:00:00', 1, 3, '33', '33', '4', '5', NULL, '2021-02-06 05:50:45', '2021-02-06 05:50:45', NULL),
(9, 4, '12:03:00', 1, 3, '1', '1', '1', '1', NULL, '2021-03-23 06:20:26', '2021-03-23 06:20:26', NULL),
(10, 4, '12:04:00', 1, 3, '2', '2', '2', '2', NULL, '2021-03-23 06:20:26', '2021-03-23 06:20:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `heading_wire`
--

CREATE TABLE `heading_wire` (
  `heading_wire_id` int(11) NOT NULL,
  `heading_id` int(11) DEFAULT NULL,
  `processed_coilsize_id` int(11) DEFAULT NULL,
  `processed_coil_weight` decimal(10,3) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `heading_wire`
--

INSERT INTO `heading_wire` (`heading_wire_id`, `heading_id`, `processed_coilsize_id`, `processed_coil_weight`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '50.000', '2021-01-20 01:49:12', '2021-01-25 07:40:48', NULL),
(2, 1, 2, '50.000', '2021-01-20 01:49:12', '2021-01-25 07:53:48', NULL),
(3, 2, 1, '50.000', '2021-01-20 01:54:01', '2021-01-25 07:40:51', NULL),
(4, 2, 2, '50.000', '2021-01-20 01:54:01', '2021-01-25 07:53:50', NULL),
(5, 3, 1, '400.000', '2021-01-20 01:55:11', '2021-02-06 01:26:19', NULL),
(6, 3, 2, '100.000', '2021-01-20 01:55:11', '2021-01-23 04:50:27', NULL),
(7, 4, 1, '1.000', '2021-03-23 06:20:26', '2021-03-23 06:20:26', NULL),
(8, 4, 2, '1.000', '2021-03-23 06:20:26', '2021-03-23 06:20:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `heat_treatment_procces`
--

CREATE TABLE `heat_treatment_procces` (
  `heat_treatment_id` int(11) NOT NULL,
  `heat_treatment_date` date DEFAULT NULL,
  `fc_no` varchar(151) DEFAULT NULL,
  `ball_size` int(11) DEFAULT NULL,
  `flashing_batch_id` int(11) DEFAULT NULL,
  `batch_weight` decimal(10,3) DEFAULT NULL,
  `set_temp` varchar(151) DEFAULT NULL,
  `load_time` time DEFAULT NULL,
  `flow_rate` varchar(151) DEFAULT NULL,
  `at_start_time` time DEFAULT NULL,
  `at_start_temp` time DEFAULT NULL,
  `equalize_time` time DEFAULT NULL,
  `set_soak_time` time DEFAULT NULL,
  `at_unload_time` time DEFAULT NULL,
  `oil_temp` varchar(151) DEFAULT NULL,
  `quench_start_time` time DEFAULT NULL,
  `quench_end_time` time DEFAULT NULL,
  `quench_total_time` time DEFAULT NULL,
  `quench_hardnes` varchar(151) DEFAULT NULL,
  `sub_zero` varchar(151) DEFAULT NULL,
  `tempering_set_temp` decimal(10,4) DEFAULT NULL,
  `tempering_start_time` time DEFAULT NULL,
  `tempering_load_time` time DEFAULT NULL,
  `tempering_hardnes` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `heat_treatment_procces`
--

INSERT INTO `heat_treatment_procces` (`heat_treatment_id`, `heat_treatment_date`, `fc_no`, `ball_size`, `flashing_batch_id`, `batch_weight`, `set_temp`, `load_time`, `flow_rate`, `at_start_time`, `at_start_temp`, `equalize_time`, `set_soak_time`, `at_unload_time`, `oil_temp`, `quench_start_time`, `quench_end_time`, `quench_total_time`, `quench_hardnes`, `sub_zero`, `tempering_set_temp`, `tempering_start_time`, `tempering_load_time`, `tempering_hardnes`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2021-02-15', 'FC no', 1, 1, '32.000', '3', '00:00:02', '4', '00:00:05', '00:00:07', '00:00:08', '00:00:07', '00:00:23', '56', '00:05:45', '00:04:55', '00:00:45', '67', 'no', '4.0000', '00:00:04', '00:00:04', '7', NULL, '2021-02-15 01:12:42', '2021-02-15 01:46:37', NULL),
(2, '2021-02-15', 'TEst', 1, 1, '32.000', '33', '00:00:02', '4', '13:48:00', '00:00:07', '13:48:00', '14:48:00', '13:48:00', '3', '12:48:00', '12:48:00', '12:49:00', '5', 'no', '4.0000', '13:49:00', '14:50:00', '7', NULL, '2021-02-15 01:48:00', '2021-02-15 01:48:47', NULL),
(3, '2021-02-15', 'fW', 1, 3, '32.000', '33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-15 01:49:15', '2021-02-15 01:55:28', '2021-02-15 01:55:28');

-- --------------------------------------------------------

--
-- Table structure for table `inward_coil_detail`
--

CREATE TABLE `inward_coil_detail` (
  `inward_coil_id` int(11) NOT NULL,
  `inward_id` int(11) DEFAULT NULL,
  `coilsize_id` int(11) DEFAULT NULL,
  `per_coil_weight` decimal(10,3) DEFAULT NULL,
  `coil_entry_year` year(4) DEFAULT NULL,
  `spbpl_no` varchar(255) DEFAULT NULL,
  `spbpl_number` varchar(151) DEFAULT NULL,
  `coil_status` tinyint(3) DEFAULT NULL COMMENT '1=sapp,2=underprocessing3=finishedstock',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inward_coil_detail`
--

INSERT INTO `inward_coil_detail` (`inward_coil_id`, `inward_id`, `coilsize_id`, `per_coil_weight`, `coil_entry_year`, `spbpl_no`, `spbpl_number`, `coil_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '1000.000', 2021, '1', NULL, 3, '2021-01-07 17:56:00', '2021-01-08 14:14:29', NULL),
(2, 1, 1, '1000.000', 2021, '2', NULL, 3, '2021-01-07 17:56:00', '2021-02-04 12:08:24', NULL),
(3, 2, 1, '100.000', 2021, '3', NULL, 1, '2021-01-23 10:40:26', '2021-01-23 10:40:26', NULL),
(4, 2, 1, '200.000', 2021, '4', NULL, 1, '2021-01-23 10:40:26', '2021-01-23 10:40:26', NULL),
(5, 2, 1, '300.000', 2021, '5', NULL, 1, '2021-01-23 10:40:26', '2021-01-23 10:40:26', NULL),
(6, 3, 2, '400.000', 2021, '1', '60211', 3, '2021-01-23 10:40:45', '2021-03-25 05:12:01', NULL),
(7, 3, 2, '300.000', 2021, '2', '60212', 1, '2021-01-23 10:40:45', '2021-03-25 05:04:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inward_detail`
--

CREATE TABLE `inward_detail` (
  `id` int(11) NOT NULL,
  `inward_no` varchar(255) DEFAULT NULL,
  `inward_date` date DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `invoice_no` varchar(255) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `coilsize_id` int(11) DEFAULT NULL,
  `heat_point` varchar(151) DEFAULT NULL,
  `total_weight` decimal(10,3) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inward_detail`
--

INSERT INTO `inward_detail` (`id`, `inward_no`, `inward_date`, `supplier_id`, `invoice_no`, `invoice_date`, `coilsize_id`, `heat_point`, `total_weight`, `status`, `remark`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'INWD000001', '2021-01-07', 1, 'test1', '2021-01-07', 1, '34', '2000.000', 1, NULL, '2021-01-07 17:56:00', '2021-01-08 12:39:30', NULL),
(2, 'INWD000002', '2021-01-23', 1, 'test1', '2021-01-23', 1, '34', '600.000', 1, NULL, '2021-01-23 10:40:26', '2021-01-23 10:40:26', NULL),
(3, 'INWD000003', '2021-01-23', 1, 'test1', '2021-01-23', 2, '23', '700.000', 1, NULL, '2021-01-23 10:40:45', '2021-01-23 10:40:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inward_qc_detail`
--

CREATE TABLE `inward_qc_detail` (
  `id` int(11) NOT NULL,
  `inward_id` int(11) DEFAULT NULL,
  `qc_report_date` date DEFAULT NULL,
  `silicate_thin` decimal(10,4) DEFAULT NULL,
  `silicate_thick` decimal(10,4) DEFAULT NULL,
  `globular_thin` decimal(10,4) DEFAULT NULL,
  `globular_thick` decimal(10,4) DEFAULT NULL,
  `decarb` varchar(255) DEFAULT NULL,
  `chem_c` decimal(10,4) DEFAULT NULL,
  `chem_si` decimal(10,4) DEFAULT NULL,
  `chem_mn` decimal(10,4) DEFAULT NULL,
  `chem_cr` decimal(10,4) DEFAULT NULL,
  `chem_s` decimal(10,4) DEFAULT NULL,
  `chem_p` decimal(10,4) DEFAULT NULL,
  `chem_ni` decimal(10,4) DEFAULT NULL,
  `chem_mo` decimal(10,4) DEFAULT NULL,
  `uts` varchar(255) DEFAULT NULL,
  `carbide_network` decimal(10,4) DEFAULT NULL,
  `carbide_segrn` decimal(10,4) DEFAULT NULL,
  `sulphide_thin` decimal(10,4) DEFAULT NULL,
  `sulphide_thick` decimal(10,4) DEFAULT NULL,
  `alumina_thin` decimal(10,4) DEFAULT NULL,
  `alumina_thick` decimal(10,4) DEFAULT NULL,
  `qc_remark` varchar(151) DEFAULT NULL,
  `eatching` varchar(151) DEFAULT NULL,
  `hardness` varchar(151) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inward_qc_detail`
--

INSERT INTO `inward_qc_detail` (`id`, `inward_id`, `qc_report_date`, `silicate_thin`, `silicate_thick`, `globular_thin`, `globular_thick`, `decarb`, `chem_c`, `chem_si`, `chem_mn`, `chem_cr`, `chem_s`, `chem_p`, `chem_ni`, `chem_mo`, `uts`, `carbide_network`, `carbide_segrn`, `sulphide_thin`, `sulphide_thick`, `alumina_thin`, `alumina_thick`, `qc_remark`, `eatching`, `hardness`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '2020-12-16', '1.0000', '1.0000', '1.0000', '1.0000', 'ok', '1.0000', '1.0000', '1.0000', '1.0000', '1.0000', '1.0000', '1.0000', '1.0000', '68.8', '5.0000', '6.0000', '1.0000', '1.0000', '1.0000', '1.0000', 'ok', 'ok', NULL, '2020-12-16 05:17:34', '2020-12-16 05:17:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inward_underprocess`
--

CREATE TABLE `inward_underprocess` (
  `inward_underprocess_id` int(11) NOT NULL,
  `under_processing_no` varchar(255) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inward_underprocess`
--

INSERT INTO `inward_underprocess` (`inward_underprocess_id`, `under_processing_no`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'UPR000001', 0, '2021-01-07 12:27:24', '2021-01-07 12:27:24', NULL),
(2, 'UPR000002', 0, '2021-02-04 04:44:53', '2021-02-04 04:44:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lapping`
--

CREATE TABLE `lapping` (
  `lapping_id` int(11) NOT NULL,
  `lapping_no` varchar(151) DEFAULT NULL,
  `shift_type` tinyint(2) DEFAULT NULL,
  `lapping_date` date DEFAULT NULL,
  `lapping_count` int(11) DEFAULT NULL,
  `batch_id` varchar(111) DEFAULT NULL,
  `lapping_batch_no` varchar(151) DEFAULT NULL,
  `ls_unloading_gauge` text DEFAULT NULL,
  `ls_tolerance` text DEFAULT NULL,
  `ls_ovality` text DEFAULT NULL,
  `ls_lot_variation` text DEFAULT NULL,
  `ball_diameter` int(11) DEFAULT NULL,
  `grinding_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lapping`
--

INSERT INTO `lapping` (`lapping_id`, `lapping_no`, `shift_type`, `lapping_date`, `lapping_count`, `batch_id`, `lapping_batch_no`, `ls_unloading_gauge`, `ls_tolerance`, `ls_ovality`, `ls_lot_variation`, `ball_diameter`, `grinding_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'LAP000001', 1, '2021-03-06', 3, '1', NULL, '23', '3', '23', '23', 1, NULL, 1, '2021-03-06 03:46:40', '2021-03-06 04:24:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lapping_observation`
--

CREATE TABLE `lapping_observation` (
  `lapping_observation_id` int(11) NOT NULL,
  `lapping_id` int(11) DEFAULT NULL,
  `lapping_obs_count_id` int(11) DEFAULT NULL,
  `machine_id` int(11) DEFAULT NULL,
  `operator_id` int(11) DEFAULT NULL,
  `unloading_gauge` varchar(151) DEFAULT NULL,
  `ball_dia_variation` varchar(151) DEFAULT NULL,
  `load_dia_variation` varchar(151) DEFAULT NULL,
  `surface` varchar(151) DEFAULT NULL,
  `loading_time` time DEFAULT NULL,
  `loading_date` date DEFAULT NULL,
  `unloading_date` date DEFAULT NULL,
  `unloading_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lapping_observation`
--

INSERT INTO `lapping_observation` (`lapping_observation_id`, `lapping_id`, `lapping_obs_count_id`, `machine_id`, `operator_id`, `unloading_gauge`, `ball_dia_variation`, `load_dia_variation`, `surface`, `loading_time`, `loading_date`, `unloading_date`, `unloading_time`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 4, 6, '23', '23', '3', '2', '12:03:00', '2021-03-06', '2021-03-06', '12:04:00', '2021-03-06 03:46:40', '2021-03-06 03:46:40', NULL),
(2, 1, 1, 4, 6, '234', '2', '23', '21', '12:03:00', '2021-03-06', '2021-03-06', '12:03:00', '2021-03-06 03:46:40', '2021-03-06 03:46:40', NULL),
(3, 1, 2, 4, 6, '123', '23', '3', '23', '14:02:00', '2021-03-06', '2021-03-06', '13:04:00', '2021-03-06 03:46:40', '2021-03-06 03:46:40', NULL),
(4, 1, 2, 4, 6, '2132', '32', '3', '2', '13:04:00', '2021-03-06', '2021-03-06', '23:41:00', '2021-03-06 03:46:40', '2021-03-06 03:46:40', NULL),
(5, 1, 2, 4, 6, '1234', '232', '32', '2', '03:42:00', '2021-03-06', '2021-03-06', '04:23:00', '2021-03-06 03:46:40', '2021-03-06 03:46:40', NULL),
(6, 1, 3, 4, 6, '124', '43f3r', 'FSDf', 'ASDG', '12:03:00', '2021-03-06', '2021-03-06', '12:03:00', '2021-03-06 04:35:19', '2021-03-06 04:35:19', NULL),
(7, 1, 3, 4, 6, 'ASDF', 'ADFA', 'DFADF', 'AD', '12:03:00', '2021-03-06', '2021-03-06', '12:04:00', '2021-03-06 04:35:19', '2021-03-06 04:35:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lapping_obs_count`
--

CREATE TABLE `lapping_obs_count` (
  `lapping_obs_count_id` int(11) NOT NULL,
  `lapping_id` int(11) DEFAULT NULL,
  `lapping_number` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lapping_obs_count`
--

INSERT INTO `lapping_obs_count` (`lapping_obs_count_id`, `lapping_id`, `lapping_number`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '2021-03-06 03:46:40', '2021-03-06 03:46:40', NULL),
(2, 1, 2, '2021-03-06 03:46:40', '2021-03-06 03:46:40', NULL),
(3, 1, 3, '2021-03-06 04:35:19', '2021-03-06 04:35:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `machinetype_master`
--

CREATE TABLE `machinetype_master` (
  `machine_type_id` int(11) NOT NULL,
  `machine_type` varchar(151) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `machinetype_master`
--

INSERT INTO `machinetype_master` (`machine_type_id`, `machine_type`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Heading', 1, '2021-02-12 11:11:32', '2021-02-12 11:11:32', NULL),
(2, 'Flashing', 1, '2021-02-12 11:11:32', '2021-02-12 11:11:32', NULL),
(3, 'Grinding', 1, '2021-02-12 11:11:32', '2021-02-12 11:11:32', NULL),
(4, 'Lapping', 1, '2021-02-12 11:11:32', '2021-02-12 11:11:32', NULL),
(5, 'Rotary Machine', 1, '2021-03-25 04:00:49', '2021-03-25 04:00:49', NULL),
(6, 'Furnace Machine', 1, '2021-03-25 04:00:59', '2021-03-25 04:00:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `machine_master`
--

CREATE TABLE `machine_master` (
  `machine_master_id` int(11) NOT NULL,
  `machine_type_id` int(11) DEFAULT NULL,
  `machine_name` varchar(151) DEFAULT NULL,
  `machine_slug` varchar(151) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `machine_master`
--

INSERT INTO `machine_master` (`machine_master_id`, `machine_type_id`, `machine_name`, `machine_slug`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'H-01', 'HEADER MACHINE', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(2, 1, 'H-02', 'HEADER MACHINE', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(3, 1, 'H-03', 'HEADER MACHINE', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(4, 1, 'H-04', 'HEADER MACHINE', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(5, 1, 'H-05', 'HEADER MACHINE', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(6, 1, 'H-06', 'HEADER MACHINE', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(7, 1, 'H-07', 'HEADER MACHINE', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(8, 1, 'H-08', 'HEADER MACHINE', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(9, 1, 'H-09', 'HEADER MACHINE', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(10, 1, 'H-10', 'HEADER MACHINE', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(11, 2, 'F-01', 'FLASHER-MPB 36HC', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(12, 2, 'F-02', 'FLASHER-MPB 800', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(13, 2, 'F-04', 'FLASHER-MPB-30', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(14, 2, 'F-05', 'FLASHER-MPB-36HC', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(15, 2, 'F-06', 'FLASHER-MPB-36HC', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(16, 2, 'F-07', 'FLASHER-MPB-30', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(17, 2, 'F-08', 'FLASHER-MPB-30', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(18, 3, 'G-01', 'GRINDER MRB 800', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(19, 3, 'G-02', 'GRINDER MRB 800', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(20, 3, 'G-03', 'GRINDER MACHINE', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(21, 3, 'G-04', 'GRINDER MACHINE', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(22, 3, 'G-05', 'GRINDER MACHINE', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(23, 3, 'G-06', 'GRINDER MACHINE', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(24, 3, 'G-07', 'GRINDER MACHINE', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(25, 3, 'G-08', 'GRINDER MACHINE', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(26, 3, 'G-09', 'GRINDER MACHINE', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(27, 4, 'LM-01', 'LAPPING MACHINE', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(28, 4, 'LM-02', 'LAPPING MACHINE', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(29, 4, 'LM-03', 'LAPPING MACHINE', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(30, 4, 'LM-04', 'LAPPING 3ML - 4780', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(31, 4, 'LM-05', 'LAPPING 3ML - 4780', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(32, 4, 'LM-06', 'LAPPING 3ML - 4780', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(33, 4, 'LM-07', 'LAPPING 3ML - 4780', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(34, 4, 'LM-08', 'LAPPING 3ML - 4780', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(35, 4, 'LM-09', 'LAPPING 3ML - 4780', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(36, 4, 'LM-10', 'LAPPING 3ML - 4780', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(37, 4, 'LM-11', 'LAPPING 3ML - 4780', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(38, 4, 'LM-12', 'LAPPING 3ML - 4780', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(39, 4, 'LM-13', 'LAPPING 3ML - 4780', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(40, 4, 'LM-14', 'LAPPING MACHINE', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(41, 4, 'LM-15', 'LAPPING MACHINE', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(42, 4, 'LM-16', 'LAPPING MACHINE', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(43, 4, 'LM-17', 'LAPPING MACHINE', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(44, 4, 'LM-18', 'LAPPING-660', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(45, 4, 'LM-19', 'LAPPING-800', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(46, 4, 'LM-20', 'LAPPING-800', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(47, 4, 'LM-21', 'LAPPING-660', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(48, 4, 'LM-22', 'LAPPING-660', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(49, 4, 'LM-23', 'LAPPING-660', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(50, 4, 'LM-32', 'LAPPING MACHINE', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(51, 5, 'RF-01', 'ROTARY FURNACE', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(52, 5, 'RF-02', 'ROTARY FURNACE', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(53, 5, 'RF-03', 'ROTARY FURNACE', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(54, 6, 'TF-01', 'TEMPERING FURNACE', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL),
(55, 6, 'TF-02', 'TEMPERING FURNACE', 1, '2021-02-12 11:14:19', '2021-02-12 11:14:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `masterbatchno`
--

CREATE TABLE `masterbatchno` (
  `batch_id` int(11) NOT NULL,
  `ball_size_id` int(11) DEFAULT NULL,
  `master_batch_no` varchar(111) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masterbatchno`
--

INSERT INTO `masterbatchno` (`batch_id`, `ball_size_id`, `master_batch_no`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '31752101', NULL, NULL, NULL),
(2, 2, '	\r\n31752102', '2021-03-24 03:16:30', '2021-03-24 03:16:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2016_01_01_000000_add_voyager_user_fields', 2),
(5, '2016_01_01_000000_create_data_types_table', 2),
(6, '2016_05_19_173453_create_menu_table', 2),
(7, '2016_10_21_190000_create_roles_table', 2),
(8, '2016_10_21_190000_create_settings_table', 2),
(9, '2016_11_30_135954_create_permission_table', 2),
(10, '2016_11_30_141208_create_permission_role_table', 2),
(11, '2016_12_26_201236_data_types__add__server_side', 2),
(12, '2017_01_13_000000_add_route_to_menu_items_table', 2),
(13, '2017_01_14_005015_create_translations_table', 2),
(14, '2017_01_15_000000_make_table_name_nullable_in_permissions_table', 2),
(15, '2017_03_06_000000_add_controller_to_data_types_table', 2),
(16, '2017_04_21_000000_add_order_to_data_rows_table', 2),
(17, '2017_07_05_210000_add_policyname_to_data_types_table', 2),
(18, '2017_08_05_000000_add_group_to_settings_table', 2),
(19, '2017_11_26_013050_add_user_role_relationship', 2),
(20, '2017_11_26_015000_create_user_roles_table', 2),
(21, '2018_03_11_000000_add_user_settings', 2),
(22, '2018_03_14_000000_add_details_to_data_types_table', 2),
(23, '2018_03_16_000000_make_settings_value_nullable', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `processedcoil`
--

CREATE TABLE `processedcoil` (
  `id` int(11) NOT NULL,
  `coil_size` varchar(151) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `processedcoil`
--

INSERT INTO `processedcoil` (`id`, `coil_size`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '5.08 mm', 1, '2021-01-18 12:58:14', '2021-01-18 12:58:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `processed_coli_detail`
--

CREATE TABLE `processed_coli_detail` (
  `id` int(11) NOT NULL,
  `inward_underprocess_id` int(11) NOT NULL,
  `under_process_coil_id` int(11) DEFAULT NULL,
  `coil_weight` decimal(10,3) DEFAULT NULL,
  `coil_name` varchar(151) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `processed_coli_detail`
--

INSERT INTO `processed_coli_detail` (`id`, `inward_underprocess_id`, `under_process_coil_id`, `coil_weight`, `coil_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '501.000', '2021-1A', '2021-01-08 00:52:10', '2021-03-24 23:35:18', NULL),
(2, 1, 1, '502.000', '[2021-1]-2', '2021-01-08 00:52:10', '2021-01-18 12:17:13', NULL),
(4, 1, 2, '1000.000', '2021-2-1', '2021-02-04 06:38:24', '2021-02-04 06:38:24', NULL),
(5, 2, 3, '200.000', '60211A', '2021-03-24 23:42:01', '2021-03-25 00:13:13', NULL),
(6, 2, 3, '200.000', '60211B', '2021-03-24 23:42:01', '2021-03-25 00:38:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE `role_permission` (
  `role_permission_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `add_permission` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `edit_permission` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `delete_permission` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `view_permission` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_permission`
--

INSERT INTO `role_permission` (`role_permission_id`, `user_id`, `user_type_id`, `add_permission`, `edit_permission`, `delete_permission`, `view_permission`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'a:26:{i:0;s:2:\"19\";i:1;s:2:\"13\";i:2;s:1:\"1\";i:3;s:2:\"15\";i:4;s:2:\"21\";i:5;s:2:\"22\";i:6;s:2:\"20\";i:7;s:2:\"26\";i:8;s:2:\"23\";i:9;s:2:\"24\";i:10;s:2:\"25\";i:11;s:1:\"6\";i:12;s:2:\"18\";i:13;s:1:\"7\";i:14;s:2:\"27\";i:15;s:2:\"12\";i:16;s:1:\"8\";i:17;s:2:\"17\";i:18;s:2:\"10\";i:19;s:2:\"16\";i:20;s:2:\"14\";i:21;s:1:\"2\";i:22;s:1:\"4\";i:23;s:1:\"3\";i:24;s:1:\"5\";i:25;s:2:\"11\";}', 'a:26:{i:0;s:2:\"19\";i:1;s:2:\"13\";i:2;s:1:\"1\";i:3;s:2:\"15\";i:4;s:2:\"21\";i:5;s:2:\"22\";i:6;s:2:\"20\";i:7;s:2:\"26\";i:8;s:2:\"23\";i:9;s:2:\"24\";i:10;s:2:\"25\";i:11;s:1:\"6\";i:12;s:2:\"18\";i:13;s:1:\"7\";i:14;s:2:\"27\";i:15;s:2:\"12\";i:16;s:1:\"8\";i:17;s:2:\"17\";i:18;s:2:\"10\";i:19;s:2:\"16\";i:20;s:2:\"14\";i:21;s:1:\"2\";i:22;s:1:\"4\";i:23;s:1:\"3\";i:24;s:1:\"5\";i:25;s:2:\"11\";}', 'a:26:{i:0;s:2:\"19\";i:1;s:2:\"13\";i:2;s:1:\"1\";i:3;s:2:\"15\";i:4;s:2:\"21\";i:5;s:2:\"22\";i:6;s:2:\"20\";i:7;s:2:\"26\";i:8;s:2:\"23\";i:9;s:2:\"24\";i:10;s:2:\"25\";i:11;s:1:\"6\";i:12;s:2:\"18\";i:13;s:1:\"7\";i:14;s:2:\"27\";i:15;s:2:\"12\";i:16;s:1:\"8\";i:17;s:2:\"17\";i:18;s:2:\"10\";i:19;s:2:\"16\";i:20;s:2:\"14\";i:21;s:1:\"2\";i:22;s:1:\"4\";i:23;s:1:\"3\";i:24;s:1:\"5\";i:25;s:2:\"11\";}', 'a:26:{i:0;s:2:\"19\";i:1;s:2:\"13\";i:2;s:1:\"1\";i:3;s:2:\"15\";i:4;s:2:\"21\";i:5;s:2:\"22\";i:6;s:2:\"20\";i:7;s:2:\"26\";i:8;s:2:\"23\";i:9;s:2:\"24\";i:10;s:2:\"25\";i:11;s:1:\"6\";i:12;s:2:\"18\";i:13;s:1:\"7\";i:14;s:2:\"27\";i:15;s:2:\"12\";i:16;s:1:\"8\";i:17;s:2:\"17\";i:18;s:2:\"10\";i:19;s:2:\"16\";i:20;s:2:\"14\";i:21;s:1:\"2\";i:22;s:1:\"4\";i:23;s:1:\"3\";i:24;s:1:\"5\";i:25;s:2:\"11\";}', 1, NULL, '2021-03-25 00:40:45'),
(25, 2, 2, 'a:5:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"4\";i:3;s:1:\"3\";i:4;s:1:\"5\";}', 'a:5:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"4\";i:3;s:1:\"3\";i:4;s:1:\"5\";}', 'a:5:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"4\";i:3;s:1:\"3\";i:4;s:1:\"5\";}', 'a:5:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"4\";i:3;s:1:\"3\";i:4;s:1:\"5\";}', NULL, '2020-11-05 05:48:20', '2020-11-05 05:48:20'),
(26, 7, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:2:\"28\";i:2;s:2:\"29\";}', 'a:3:{i:0;s:1:\"1\";i:1;s:2:\"28\";i:2;s:2:\"29\";}', 'a:3:{i:0;s:1:\"1\";i:1;s:2:\"28\";i:2;s:2:\"29\";}', 'a:3:{i:0;s:1:\"1\";i:1;s:2:\"28\";i:2;s:2:\"29\";}', NULL, '2021-07-05 22:56:53', '2021-07-05 22:59:33');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testing`
--

CREATE TABLE `testing` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testing1`
--

CREATE TABLE `testing1` (
  `test1` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `test2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

CREATE TABLE `translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `table_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int(10) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `under_process_coil`
--

CREATE TABLE `under_process_coil` (
  `under_process_coil_id` int(11) NOT NULL,
  `inward_underprocess_id` int(11) DEFAULT NULL,
  `inward_coil_id` int(11) DEFAULT NULL,
  `coil_size_id` int(11) DEFAULT NULL,
  `coil_spbpl_no` varchar(255) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `challan_no` varchar(255) DEFAULT NULL,
  `jobwork_supplier` int(11) DEFAULT NULL,
  `splitcoil_size` int(11) DEFAULT NULL,
  `splitcoil_inwarddate` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_At` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `under_process_coil`
--

INSERT INTO `under_process_coil` (`under_process_coil_id`, `inward_underprocess_id`, `inward_coil_id`, `coil_size_id`, `coil_spbpl_no`, `issue_date`, `challan_no`, `jobwork_supplier`, `splitcoil_size`, `splitcoil_inwarddate`, `created_at`, `updated_At`, `deleted_at`) VALUES
(1, 1, 1, 1, NULL, '2020-12-29', '101', 1, 1, '2021-01-15', '2021-01-07 12:27:24', '2021-03-24 23:35:18', NULL),
(2, 1, 2, 1, '2021-2', '2020-12-30', '101', 1, 1, '2021-01-08', '2021-01-08 00:48:20', '2021-01-25 09:36:05', NULL),
(3, 2, 6, 2, '60211', '2021-02-12', '101', 1, 1, '2021-03-12', '2021-02-04 04:44:54', '2021-03-25 00:13:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_type_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'users/default.png',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `textpass` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `user_type_id`, `name`, `email`, `avatar`, `email_verified_at`, `password`, `textpass`, `status`, `remember_token`, `settings`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 'admin', 'admin@admin.com', 'users/default.png', NULL, '$2y$10$B80g5dM7QOWGQkLJUehKxeAQiTcSn/6iNqg7VDGwNX9ghJPCdPR6i', 'admin@123', 1, NULL, NULL, '2020-11-05 06:26:46', '2020-11-12 22:59:17'),
(2, NULL, 2, 'Kishanbhai', 'kishan@metal.com', 'users/default.png', NULL, '$2y$10$8qMqXppK/NCjL8lqU6KOPOW41owNaFlKlVBbcxDDfN8/f9MmAyJJG', 'kishan@123', 1, NULL, NULL, '2020-11-05 04:48:55', '2020-11-05 04:48:55'),
(3, NULL, 3, 'ravi', 'test@test.com', 'users/default.png', NULL, '$2y$10$K6eJB4bxxY/GVr/M.8lgy.IyaR4VoBHRGIry8u3cQxs6C2wmQQEKW', 'ravi@123', 1, NULL, NULL, '2021-01-19 05:15:47', '2021-01-19 05:15:47'),
(4, NULL, 4, 'kamal', 'kamal@gmail.com', 'users/default.png', NULL, '$2y$10$NYczNJhVv0QssIFYdemdGOsCPcHzfGTY3pAGRt0hTr15UECSKdcLK', 'kamal123', 1, NULL, NULL, '2021-02-10 23:25:49', '2021-02-10 23:25:49'),
(5, NULL, 5, 'gr op', 'gr@gmail.com', 'users/default.png', NULL, '$2y$10$zQ5RoHW9L9hdxIK4LjcIIeRFPYHKz1ibC6lRlsCDzV5TrRfaXIzcG', 'test1234', 1, NULL, NULL, '2021-03-02 02:55:23', '2021-03-02 02:55:23'),
(6, NULL, 6, 'test lap', 'lp@gmail.com', 'users/default.png', NULL, '$2y$10$cfvLkoE9If2W61jVcrk/nue8uBzsG427XSSLvb2S1pe5OGik6VVQC', 'lapp1234', 1, NULL, NULL, '2021-03-02 02:55:44', '2021-03-02 02:55:44'),
(7, NULL, 1, 'sharan', 'sharanpurohit25@gmail.com', 'users/default.png', NULL, '$2y$10$iljw5Etlxp9UDEvqQY9wAubG3sVJmRJtn9TF2bqp7/iBda0ZjDsyy', 'sharan123', 1, NULL, NULL, '2021-07-05 22:56:31', '2021-07-05 22:56:31');

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `user_type_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`user_type_id`, `name`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Metal Balls Admin', 1, NULL, '2020-10-31 04:40:10', '2020-10-31 07:28:46'),
(2, 'Production Manager', 1, NULL, '2020-10-31 04:40:35', '2020-10-31 04:40:35'),
(3, 'Heading Operator', 1, NULL, '2021-01-19 01:41:33', '2021-01-19 01:41:33'),
(4, 'Flashing Operator', 1, NULL, '2021-02-10 23:25:23', '2021-02-10 23:25:23'),
(5, 'Grinding Operator', 1, NULL, '2021-03-02 02:54:23', '2021-03-02 02:54:23'),
(6, 'Lapping Operator', 1, NULL, '2021-03-02 02:54:32', '2021-03-02 02:54:32'),
(7, 'Heating Operator', 1, NULL, '2021-03-02 02:54:48', '2021-03-02 02:54:48');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_detail`
--

CREATE TABLE `vendor_detail` (
  `id` int(11) NOT NULL,
  `company_name` varchar(211) DEFAULT NULL,
  `email_1` varchar(211) DEFAULT NULL,
  `email_2` varchar(211) DEFAULT NULL,
  `contact_no` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `postal_code` varchar(55) DEFAULT NULL,
  `gst_no` varchar(55) DEFAULT NULL,
  `website` varchar(211) DEFAULT NULL,
  `state` varchar(211) DEFAULT NULL,
  `city` varchar(211) DEFAULT NULL,
  `remark` varchar(211) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor_detail`
--

INSERT INTO `vendor_detail` (`id`, `company_name`, `email_1`, `email_2`, `contact_no`, `address`, `postal_code`, `gst_no`, `website`, `state`, `city`, `remark`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'COIL Supplier', 'asdf@sad.com', 'ASDAS@ASD.COM', '123123123', 'sadasd as\r\nd\r\nas\r\nd\r\nasd', 'a123123', '123124 ad2121', 'asdas.com', 'asasdas', 'asdasdas', 'asdasDASDAS\r\nD\r\nASD', 1, '2020-11-23 23:35:43', '2020-12-07 07:28:53', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_menu`
--
ALTER TABLE `admin_menu`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `asnewtable`
--
ALTER TABLE `asnewtable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asremane`
--
ALTER TABLE `asremane`
  ADD PRIMARY KEY (`table_id`);

--
-- Indexes for table `assssssss`
--
ALTER TABLE `assssssss`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `atest`
--
ALTER TABLE `atest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ball_size`
--
ALTER TABLE `ball_size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coil_detail`
--
ALTER TABLE `coil_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_rows`
--
ALTER TABLE `data_rows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_rows_data_type_id_foreign` (`data_type_id`);

--
-- Indexes for table `data_types`
--
ALTER TABLE `data_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_types_name_unique` (`name`),
  ADD UNIQUE KEY `data_types_slug_unique` (`slug`);

--
-- Indexes for table `demo`
--
ALTER TABLE `demo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flashing`
--
ALTER TABLE `flashing`
  ADD PRIMARY KEY (`flashing_id`);

--
-- Indexes for table `flashing_batch`
--
ALTER TABLE `flashing_batch`
  ADD PRIMARY KEY (`flashing_batch_id`);

--
-- Indexes for table `flashing_observation`
--
ALTER TABLE `flashing_observation`
  ADD PRIMARY KEY (`flashing_observation_id`);

--
-- Indexes for table `grinding`
--
ALTER TABLE `grinding`
  ADD PRIMARY KEY (`grinding_id`);

--
-- Indexes for table `grinding_observation`
--
ALTER TABLE `grinding_observation`
  ADD PRIMARY KEY (`grinding_observation_id`);

--
-- Indexes for table `heading`
--
ALTER TABLE `heading`
  ADD PRIMARY KEY (`heading_id`);

--
-- Indexes for table `heading_batch`
--
ALTER TABLE `heading_batch`
  ADD PRIMARY KEY (`heading_batch_id`);

--
-- Indexes for table `heading_observation`
--
ALTER TABLE `heading_observation`
  ADD PRIMARY KEY (`heading_observation_id`);

--
-- Indexes for table `heading_wire`
--
ALTER TABLE `heading_wire`
  ADD PRIMARY KEY (`heading_wire_id`);

--
-- Indexes for table `heat_treatment_procces`
--
ALTER TABLE `heat_treatment_procces`
  ADD PRIMARY KEY (`heat_treatment_id`);

--
-- Indexes for table `inward_coil_detail`
--
ALTER TABLE `inward_coil_detail`
  ADD PRIMARY KEY (`inward_coil_id`);

--
-- Indexes for table `inward_detail`
--
ALTER TABLE `inward_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inward_qc_detail`
--
ALTER TABLE `inward_qc_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inward_underprocess`
--
ALTER TABLE `inward_underprocess`
  ADD PRIMARY KEY (`inward_underprocess_id`);

--
-- Indexes for table `lapping`
--
ALTER TABLE `lapping`
  ADD PRIMARY KEY (`lapping_id`);

--
-- Indexes for table `lapping_observation`
--
ALTER TABLE `lapping_observation`
  ADD PRIMARY KEY (`lapping_observation_id`);

--
-- Indexes for table `lapping_obs_count`
--
ALTER TABLE `lapping_obs_count`
  ADD PRIMARY KEY (`lapping_obs_count_id`);

--
-- Indexes for table `machinetype_master`
--
ALTER TABLE `machinetype_master`
  ADD PRIMARY KEY (`machine_type_id`);

--
-- Indexes for table `machine_master`
--
ALTER TABLE `machine_master`
  ADD PRIMARY KEY (`machine_master_id`);

--
-- Indexes for table `masterbatchno`
--
ALTER TABLE `masterbatchno`
  ADD PRIMARY KEY (`batch_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_name_unique` (`name`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_key_index` (`key`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- Indexes for table `processedcoil`
--
ALTER TABLE `processedcoil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `processed_coli_detail`
--
ALTER TABLE `processed_coli_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`role_permission_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `testing`
--
ALTER TABLE `testing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`);

--
-- Indexes for table `under_process_coil`
--
ALTER TABLE `under_process_coil`
  ADD PRIMARY KEY (`under_process_coil_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`user_type_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `user_roles_user_id_index` (`user_id`),
  ADD KEY `user_roles_role_id_index` (`role_id`);

--
-- Indexes for table `vendor_detail`
--
ALTER TABLE `vendor_detail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_menu`
--
ALTER TABLE `admin_menu`
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `asnewtable`
--
ALTER TABLE `asnewtable`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asremane`
--
ALTER TABLE `asremane`
  MODIFY `table_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assssssss`
--
ALTER TABLE `assssssss`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `atest`
--
ALTER TABLE `atest`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ball_size`
--
ALTER TABLE `ball_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `coil_detail`
--
ALTER TABLE `coil_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `data_rows`
--
ALTER TABLE `data_rows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_types`
--
ALTER TABLE `data_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `demo`
--
ALTER TABLE `demo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flashing`
--
ALTER TABLE `flashing`
  MODIFY `flashing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `flashing_batch`
--
ALTER TABLE `flashing_batch`
  MODIFY `flashing_batch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `flashing_observation`
--
ALTER TABLE `flashing_observation`
  MODIFY `flashing_observation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `grinding`
--
ALTER TABLE `grinding`
  MODIFY `grinding_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `grinding_observation`
--
ALTER TABLE `grinding_observation`
  MODIFY `grinding_observation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `heading`
--
ALTER TABLE `heading`
  MODIFY `heading_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `heading_batch`
--
ALTER TABLE `heading_batch`
  MODIFY `heading_batch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `heading_observation`
--
ALTER TABLE `heading_observation`
  MODIFY `heading_observation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `heading_wire`
--
ALTER TABLE `heading_wire`
  MODIFY `heading_wire_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `heat_treatment_procces`
--
ALTER TABLE `heat_treatment_procces`
  MODIFY `heat_treatment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inward_coil_detail`
--
ALTER TABLE `inward_coil_detail`
  MODIFY `inward_coil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `inward_detail`
--
ALTER TABLE `inward_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inward_qc_detail`
--
ALTER TABLE `inward_qc_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inward_underprocess`
--
ALTER TABLE `inward_underprocess`
  MODIFY `inward_underprocess_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lapping`
--
ALTER TABLE `lapping`
  MODIFY `lapping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lapping_observation`
--
ALTER TABLE `lapping_observation`
  MODIFY `lapping_observation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lapping_obs_count`
--
ALTER TABLE `lapping_obs_count`
  MODIFY `lapping_obs_count_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `machinetype_master`
--
ALTER TABLE `machinetype_master`
  MODIFY `machine_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `machine_master`
--
ALTER TABLE `machine_master`
  MODIFY `machine_master_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `masterbatchno`
--
ALTER TABLE `masterbatchno`
  MODIFY `batch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `processedcoil`
--
ALTER TABLE `processedcoil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `processed_coli_detail`
--
ALTER TABLE `processed_coli_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `role_permission_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testing`
--
ALTER TABLE `testing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `translations`
--
ALTER TABLE `translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `under_process_coil`
--
ALTER TABLE `under_process_coil`
  MODIFY `under_process_coil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `user_type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vendor_detail`
--
ALTER TABLE `vendor_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_rows`
--
ALTER TABLE `data_rows`
  ADD CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
