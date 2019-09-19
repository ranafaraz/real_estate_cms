-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2019 at 10:41 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rems`
--
CREATE DATABASE IF NOT EXISTS `rems` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `rems`;

-- --------------------------------------------------------

--
-- Table structure for table `account_head`
--

CREATE TABLE `account_head` (
  `id` int(11) NOT NULL,
  `nature_id` int(11) NOT NULL,
  `account_name` varchar(150) NOT NULL,
  `account_no` varchar(20) NOT NULL,
  `created_by` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` varchar(150) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_head`
--

INSERT INTO `account_head` (`id`, `nature_id`, `account_name`, `account_no`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(15, 15, 'account payable', '04-001', 'rehan', '2019-08-27 09:08:12', 'rehan', '2019-08-27 09:08:12'),
(16, 14, 'Cash in Hand', '03-001', 'rehan', '2019-08-27 08:08:49', 'rehan', '2019-08-27 08:08:49'),
(17, 14, 'bank', '03-002', 'rehan', '2019-08-27 08:08:17', 'rehan', '2019-08-27 08:08:17'),
(18, 14, 'patty cash', '03-003', 'rehan', '2019-08-27 08:08:30', 'rehan', '2019-08-27 08:08:30'),
(19, 17, 'salaries', '06-001', 'rehan', '2019-08-27 08:08:08', 'rehan', '2019-08-27 08:08:08'),
(20, 17, 'utility bills', '06-002', 'rehan', '2019-08-27 08:08:22', 'rehan', '2019-08-27 08:08:22'),
(21, 14, 'Account Receivable', '03-004', 'rehan', '2019-08-30 08:08:39', 'rehan', '2019-08-30 08:08:39'),
(22, 16, 'Student Fee', '05-001', 'rehan', '2019-08-30 08:08:55', 'rehan', '2019-08-30 08:08:55');

-- --------------------------------------------------------

--
-- Table structure for table `account_nature`
--

CREATE TABLE `account_nature` (
  `id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `account_no` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_nature`
--

INSERT INTO `account_nature` (`id`, `organization_id`, `name`, `account_no`, `created_at`) VALUES
(13, 1, 'Fixed Assets', '02-000', '2019-08-27 08:08:32'),
(14, 1, 'Current Assets', '03-000', '2019-08-27 08:08:46'),
(15, 1, 'Liabilities', '04-000', '2019-08-27 08:08:25'),
(16, 1, 'Earning', '05-000', '2019-08-27 08:08:06'),
(17, 1, 'Expense', '06-000', '2019-08-27 08:08:16');

-- --------------------------------------------------------

--
-- Table structure for table `account_payable`
--

CREATE TABLE `account_payable` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `amount` double DEFAULT NULL,
  `account_payable` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(150) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_payable`
--

INSERT INTO `account_payable` (`id`, `transaction_id`, `recipient_id`, `amount`, `account_payable`, `due_date`, `updated_at`, `updated_by`, `status`) VALUES
(1, 1, 1, 30000, 19, '2019-08-29', '2019-08-29 12:08:30', 'rehan', 1),
(2, 2, 1, 1200, 15, '2019-08-30', '2019-08-29 12:08:10', 'rehan', 1),
(3, 3, 1, 1, 19, '2019-09-30', '2019-08-29 01:08:48', 'rehan', 1),
(4, 4, 1, 10000, 19, '2019-08-30', '2019-08-30 07:08:45', 'rehan', 1),
(5, 5, 1, 333, 15, '2019-08-31', '2019-08-30 07:08:27', 'rehan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `account_recievable`
--

CREATE TABLE `account_recievable` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `payer_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `account_receivable` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `updated_by` varchar(150) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_recievable`
--

INSERT INTO `account_recievable` (`id`, `transaction_id`, `payer_id`, `amount`, `account_receivable`, `due_date`, `updated_by`, `updated_at`) VALUES
(3, 3, 1, 2000, 16, '2019-08-26', 'rehan', '2019-08-29 09:08:27');

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`id`, `item_name`, `user_id`, `created_at`) VALUES
(1, 'Admin', 74, NULL),
(8, 'Manager', 73, '2019-09-05 07:09:24'),
(9, 'Admin', 76, '2019-09-17 08:09:03'),
(10, 'Manager', 77, '2019-09-18 09:09:40'),
(11, 'Admin', 78, '2019-09-18 09:09:06'),
(12, 'Manager', 79, '2019-09-18 09:09:38'),
(13, 'Admin', 80, '2019-09-18 09:09:17'),
(14, 'Admin', 81, '2019-09-18 09:09:29'),
(15, 'Admin', 82, '2019-09-18 09:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `created_at`, `updated_at`) VALUES
('Admin', 1, 'Admin have all the Privileges', NULL, NULL),
('Manager', 2, 'Manager has limited privileges.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Admin', 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `father_name` varchar(150) NOT NULL,
  `cnic_no` varchar(150) NOT NULL,
  `contact_no` varchar(150) NOT NULL,
  `email_address` varchar(150) NOT NULL,
  `address` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `name`, `father_name`, `cnic_no`, `contact_no`, `email_address`, `address`, `user_id`, `organization_id`, `created_date`) VALUES
(87, 'saqib rehan', 'afzal rehan', '234532', '234', 'saqibrehan2007@gmail.com', 'chak 117, rahim yar khan', 0, 1, '2019-09-11'),
(88, 'Kashif Ali', 'xxxx', '234324', '234234', 'kashifsahil622@gmail.com', 'Chak No. 117p, Teh. & Distt RYK', 0, 1, '2019-09-11');

-- --------------------------------------------------------

--
-- Table structure for table `installment`
--

CREATE TABLE `installment` (
  `installment_id` int(11) NOT NULL,
  `installment_type` varchar(250) NOT NULL,
  `advance_amount` varchar(250) NOT NULL,
  `total_amount` varchar(250) NOT NULL,
  `no_of_installments` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `plot_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `installment`
--

INSERT INTO `installment` (`installment_id`, `installment_type`, `advance_amount`, `total_amount`, `no_of_installments`, `customer_id`, `property_id`, `organization_id`, `plot_no`) VALUES
(62, 'Monthly', '0', '200000', 3, 86, 19, 1, 7),
(63, 'Yearly', '9', '20', 10, 87, 20, 1, 1),
(64, 'Monthly', '90000', '120000', 10, 88, 24, 1, 13);

-- --------------------------------------------------------

--
-- Table structure for table `installment_status`
--

CREATE TABLE `installment_status` (
  `id` int(11) NOT NULL,
  `installment_id` int(11) NOT NULL,
  `installment_no` int(4) NOT NULL,
  `installment_amount` double NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date` date NOT NULL,
  `paid_date` date NOT NULL,
  `created_by` varchar(150) NOT NULL,
  `organization_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `installment_status`
--

INSERT INTO `installment_status` (`id`, `installment_id`, `installment_no`, `installment_amount`, `status`, `date`, `paid_date`, `created_by`, `organization_id`) VALUES
(38, 62, 1, 80000, 0, '2019-09-10', '2019-09-10', '1', 1),
(39, 62, 2, 40000, 0, '2019-09-10', '2019-09-09', '1', 0),
(40, 62, 3, 40000, 1, '2019-09-10', '2019-09-10', '1', 1),
(41, 62, 4, 40000, 0, '2019-09-10', '2019-10-10', '1', 1),
(42, 63, 1, 10, 0, '2019-09-11', '2020-09-11', '1', 0),
(43, 63, 2, 1, 0, '2019-09-11', '2020-09-11', '1', 0),
(44, 63, 3, 1, 1, '2019-09-11', '2020-09-11', '1', 0),
(45, 63, 4, 1, 1, '2019-09-11', '2020-09-11', '1', 0),
(46, 63, 5, 1, 1, '2019-09-11', '2020-09-11', '1', 0),
(47, 63, 6, 1, 1, '2019-09-11', '2020-09-11', '1', 0),
(48, 63, 7, 1, 1, '2019-09-11', '2020-09-11', '1', 0),
(49, 63, 8, 1, 1, '2019-09-11', '2020-09-11', '1', 0),
(50, 63, 9, 1, 1, '2019-09-11', '2020-09-11', '1', 0),
(51, 63, 10, 1, 1, '2019-09-11', '2020-09-11', '1', 0),
(52, 63, 11, 1, 1, '2019-09-11', '2020-09-11', '1', 0),
(53, 64, 1, 20000, 0, '2019-09-11', '2019-10-11', '1', 0),
(54, 64, 2, 10000, 0, '2019-09-11', '2019-10-11', '1', 0),
(55, 64, 3, 10000, 1, '2019-09-11', '2019-10-11', '1', 0),
(56, 64, 4, 10000, 1, '2019-09-11', '2019-10-11', '1', 0),
(57, 64, 5, 10000, 1, '2019-09-11', '2019-10-11', '1', 0),
(58, 64, 6, 10000, 1, '2019-09-11', '2019-10-11', '1', 0),
(59, 64, 7, 10000, 1, '2019-09-11', '2019-10-11', '1', 0),
(60, 64, 8, 10000, 1, '2019-09-11', '2019-10-11', '1', 0),
(61, 64, 9, 10000, 1, '2019-09-11', '2019-10-11', '1', 0),
(62, 64, 10, 10000, 1, '2019-09-11', '2019-10-11', '1', 0),
(63, 64, 11, 10000, 1, '2019-09-11', '2019-10-11', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1567424273),
('m130524_201442_init', 1567424286),
('m190124_110200_add_verification_token_column_to_user_table', 1567424287);

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`id`, `name`, `user_id`, `created_at`) VALUES
(1, 'DEXDEVS', 1, '2019-09-03'),
(2, 'abc', 1, '2019-09-11'),
(4, 'test', 76, '2019-09-17');

-- --------------------------------------------------------

--
-- Table structure for table `payer_receiver_info`
--

CREATE TABLE `payer_receiver_info` (
  `id` int(11) NOT NULL,
  `head_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `choice` enum('Receiver','Payer') NOT NULL,
  `created_by` varchar(150) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payer_receiver_info`
--

INSERT INTO `payer_receiver_info` (`id`, `head_id`, `name`, `choice`, `created_by`, `created_at`) VALUES
(1, 19, 'Rehan', 'Receiver', 'rehan', '2019-08-29'),
(2, 16, 'Saqib pay', 'Payer', 'rehan', '2019-08-29');

-- --------------------------------------------------------

--
-- Table structure for table `plot`
--

CREATE TABLE `plot` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `plot_no` int(11) NOT NULL,
  `plot_length` varchar(50) NOT NULL,
  `plot_width` varchar(50) NOT NULL,
  `plot_type` enum('Residential','Commercial') NOT NULL,
  `plot_price` double NOT NULL,
  `per_merla_rate` double NOT NULL,
  `status` enum('Sold','Unsold') NOT NULL,
  `created_by` varchar(150) NOT NULL,
  `created_at` date NOT NULL,
  `updated_by` varchar(150) NOT NULL,
  `updated_at` date NOT NULL,
  `organization_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plot`
--

INSERT INTO `plot` (`id`, `property_id`, `plot_no`, `plot_length`, `plot_width`, `plot_type`, `plot_price`, `per_merla_rate`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`, `organization_id`) VALUES
(175, 20, 1, '1123', '10', 'Residential', 12345, 123, 'Sold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(176, 20, 2, '132333', '1343333122', 'Residential', 234234123, 112333, 'Sold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(177, 20, 3, '1', '1', 'Commercial', 1, 1, 'Sold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(178, 20, 4, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(179, 20, 5, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(180, 20, 6, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(181, 20, 7, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(182, 20, 8, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(183, 20, 9, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(184, 20, 10, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(185, 20, 11, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(186, 20, 12, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(187, 20, 13, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(188, 20, 14, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(189, 20, 15, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(190, 21, 1, '1', '1', 'Residential', 1, 12, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(191, 21, 2, '1435', '1345', 'Residential', 1342, 12, 'Sold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(192, 21, 3, '1', '13', 'Residential', 1, 122, 'Sold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(193, 21, 4, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(194, 21, 5, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(195, 21, 6, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(196, 21, 7, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(197, 21, 8, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(198, 21, 9, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(199, 21, 10, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(200, 21, 11, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(201, 21, 12, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(202, 21, 13, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(203, 21, 14, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(204, 21, 15, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(205, 21, 16, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(206, 21, 17, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(207, 21, 18, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(208, 21, 19, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(209, 21, 20, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(210, 21, 21, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(211, 21, 22, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(212, 21, 23, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(213, 21, 24, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(214, 21, 25, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(215, 21, 26, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(216, 21, 27, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(217, 21, 28, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(218, 21, 29, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(219, 21, 30, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(220, 22, 1, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(221, 22, 2, '112', '112', 'Commercial', 1122, 112, 'Sold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(222, 22, 3, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(223, 22, 4, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(224, 22, 5, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(225, 22, 6, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(226, 22, 7, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(227, 22, 8, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(228, 22, 9, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(229, 22, 10, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(230, 22, 11, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(231, 22, 12, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(232, 22, 13, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(233, 22, 14, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(234, 22, 15, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(235, 22, 16, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(236, 22, 17, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(237, 22, 18, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(238, 22, 19, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(239, 22, 20, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(240, 22, 21, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(241, 22, 22, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(242, 22, 23, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(243, 22, 24, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(244, 22, 25, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(245, 22, 26, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(246, 22, 27, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(247, 22, 28, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(248, 22, 29, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(249, 22, 30, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(250, 22, 31, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(251, 22, 32, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(252, 22, 33, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(253, 22, 34, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(254, 22, 35, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(255, 22, 36, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(256, 22, 37, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(257, 22, 38, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(258, 22, 39, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(259, 22, 40, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(260, 22, 41, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(261, 22, 42, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(262, 22, 43, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(263, 22, 44, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(264, 22, 45, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(265, 22, 46, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(266, 22, 47, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(267, 22, 48, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(268, 22, 49, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(269, 22, 50, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(270, 23, 1, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(271, 23, 2, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(272, 23, 3, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(273, 23, 4, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(274, 23, 5, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(275, 23, 6, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(276, 23, 7, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(277, 23, 8, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(278, 23, 9, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(279, 23, 10, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(280, 23, 11, '134', '14343', 'Commercial', 134, 1434, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(281, 23, 12, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(282, 23, 13, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(283, 23, 14, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(284, 23, 15, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(285, 23, 16, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(286, 23, 17, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(287, 23, 18, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(288, 23, 19, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(289, 23, 20, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(290, 23, 21, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(291, 23, 22, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(292, 23, 23, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(293, 23, 24, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(294, 23, 25, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(295, 23, 26, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(296, 23, 27, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(297, 23, 28, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(298, 23, 29, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(299, 23, 30, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(300, 23, 31, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(301, 23, 32, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(302, 23, 33, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(303, 23, 34, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(304, 23, 35, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(305, 23, 36, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(306, 23, 37, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(307, 23, 38, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(308, 23, 39, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(309, 23, 40, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(310, 23, 41, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(311, 23, 42, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(312, 23, 43, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(313, 23, 44, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(314, 23, 45, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(315, 23, 46, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(316, 23, 47, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(317, 23, 48, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(318, 23, 49, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(319, 23, 50, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(320, 24, 1, '120', '120', 'Commercial', 12000, 10000, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(321, 24, 2, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(322, 24, 3, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(323, 24, 4, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(324, 24, 5, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(325, 24, 6, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(326, 24, 7, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(327, 24, 8, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(328, 24, 9, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(329, 24, 10, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(330, 24, 11, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(331, 24, 12, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(332, 24, 13, '1', '1', 'Residential', 1, 1, 'Sold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(333, 24, 14, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(334, 24, 15, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(335, 24, 16, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(336, 24, 17, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(337, 24, 18, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(338, 24, 19, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(339, 24, 20, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(340, 24, 21, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(341, 24, 22, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(342, 24, 23, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(343, 24, 24, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(344, 24, 25, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(345, 24, 26, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(346, 24, 27, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(347, 24, 28, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(348, 24, 29, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(349, 24, 30, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(350, 24, 31, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(351, 24, 32, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(352, 24, 33, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(353, 24, 34, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(354, 24, 35, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(355, 24, 36, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(356, 24, 37, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(357, 24, 38, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(358, 24, 39, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(359, 24, 40, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(360, 24, 41, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(361, 24, 42, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(362, 24, 43, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(363, 24, 44, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(364, 24, 45, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(365, 24, 46, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(366, 24, 47, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(367, 24, 48, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(368, 24, 49, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1),
(369, 24, 50, '1', '1', 'Residential', 1, 1, 'Unsold', 'Usama', '2019-09-11', '', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `plot_owner_info`
--

CREATE TABLE `plot_owner_info` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `plot_no` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `organization_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plot_owner_info`
--

INSERT INTO `plot_owner_info` (`id`, `customer_id`, `property_id`, `plot_no`, `start_date`, `end_date`, `organization_id`) VALUES
(1, 87, 20, 1, '2019-09-11', '0000-00-00', 1),
(2, 88, 24, 13, '2019-09-11', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `property_id` int(11) NOT NULL,
  `property_name` varchar(250) NOT NULL,
  `area` varchar(50) NOT NULL,
  `property_price` bigint(20) NOT NULL,
  `location` varchar(250) NOT NULL,
  `city` varchar(200) NOT NULL,
  `district` varchar(200) NOT NULL,
  `province` varchar(200) NOT NULL,
  `created_by` varchar(150) NOT NULL,
  `created_at` date NOT NULL,
  `organization_id` int(11) NOT NULL,
  `no_of_plots` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`property_id`, `property_name`, `area`, `property_price`, `location`, `city`, `district`, `province`, `created_by`, `created_at`, `organization_id`, `no_of_plots`) VALUES
(20, 'garden A', '12', 120000, 'abc', 'SDK', 'abc', 'abc', 'Usama', '2019-09-11', 1, 40),
(21, 'garden b', '12', 10000, 'asdas', 'RYK', 'kh', 'jh', 'Usama', '2019-09-11', 1, 22);

-- --------------------------------------------------------

--
-- Table structure for table `provide_services`
--

CREATE TABLE `provide_services` (
  `provide_services_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `services_type_id` int(11) NOT NULL,
  `services_id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `services_details`
--

CREATE TABLE `services_details` (
  `services_id` int(11) NOT NULL,
  `provide_name` varchar(250) NOT NULL,
  `contact_no` varchar(150) NOT NULL,
  `address` varchar(250) NOT NULL,
  `services_type_id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services_details`
--

INSERT INTO `services_details` (`services_id`, `provide_name`, `contact_no`, `address`, `services_type_id`, `organization_id`) VALUES
(2, 'Usama Javed', '03176310603', 'Muhallah karigran tarinda saway khan', 1, 1),
(3, 'saqib', '9213874', 'akljsdfh', 4, 1),
(4, 'xyz', '65657', 'xyz', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `services_type`
--

CREATE TABLE `services_type` (
  `services_type_id` int(11) NOT NULL,
  `services_type` varchar(250) NOT NULL,
  `organization_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services_type`
--

INSERT INTO `services_type` (`services_type_id`, `services_type`, `organization_id`) VALUES
(1, 'contractor', 1),
(2, 'lawyer', 2),
(3, 'water supplayer', 1),
(4, 'abc', 1),
(5, 'plumber', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `receiver_payer_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `type` enum('Cash Payment','Bank Payment') NOT NULL,
  `narration` text NOT NULL,
  `debit_account` int(11) NOT NULL,
  `debit_amount` double NOT NULL,
  `credit_account` int(11) NOT NULL,
  `credit_amount` double NOT NULL,
  `date` datetime NOT NULL,
  `ref_no` varchar(50) NOT NULL,
  `created_by` varchar(150) NOT NULL,
  `updated_by` varchar(150) NOT NULL,
  `updated_at` datetime NOT NULL,
  `transaction_type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `receiver_payer_id`, `transaction_id`, `type`, `narration`, `debit_account`, `debit_amount`, `credit_account`, `credit_amount`, `date`, `ref_no`, `created_by`, `updated_by`, `updated_at`, `transaction_type`) VALUES
(2, 2, 2, 'Cash Payment', 'loan', 16, 20000, 22, 20000, '2019-08-30 08:08:03', '', 'rehan', 'rehan', '2019-08-30 08:08:03', 'receipt'),
(31, 1, 3, 'Cash Payment', 'kjknk', 20, 1200, 16, 1000, '2019-09-02 08:09:06', '', 'rehan', 'rehan', '2019-09-02 08:09:06', 'payment'),
(32, 1, 4, 'Cash Payment', 'mnm', 20, 1200, 16, 1000, '2019-09-02 08:09:47', '', 'rehan', 'rehan', '2019-09-02 08:09:47', 'payment'),
(33, 1, 5, 'Cash Payment', 'sdf', 20, 1000, 16, 100, '2019-09-02 08:09:18', '', 'rehan', 'rehan', '2019-09-02 08:09:18', 'payment');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `organization_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `username`, `image_name`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`, `organization_id`) VALUES
(4, 'Arslan', 'Nasir', 'arslanch', '', 'F6AWcfl1nc2sP4khoHK-_cAKvV15IBMZ', '$2y$13$o8fNK/SaMi5vHu/WzFcFmuGdEzAI5SOIzft08eNPVsWTGW4F.GbN.', NULL, 'arslanch@gmail.com', 10, '0', '0', 'j1J5nCjjJMJ5g_znz2wXLrKXkjKikoJt_1563725671', 0),
(73, 'ch', 'ali', 'chali', '', 'gqUiQZxG4hfzQlm3KsxUytn_Q5LXWeZ3', '$2y$13$j26VX6s6STO3MHAaWWJG/ejDYsI33qGsUwrUJs69O0.wg.lEZEie.', NULL, 'chali@gmail.com', 10, '2019-09-05 07:09:45', '2019-09-05 07:09:24', 'kqhoAd1oTMC8WjxJmtgj3HP87T2rTDW-_1567662264', 0),
(74, '', '', 'dexdevs', 'uploads/logo.png', 'iFISDX0OMTSGTWyko_rObETNJMeJivkr', '$2y$13$Gi.0ikD78vx6otxPbos/DOHtgxb8rXG8eQHbpDFk52fe03vXVjHZi', NULL, 'dexdevs@gmail.com', 10, '1568449222', '1568449222', '-ZxYmGCPhElUxB9UlSkKT6meGLROvRer_1568449222', 1),
(75, '', '', 'abc', '', 'BA6KfKNshe7eXrME2NvHQHTVy3w-Wiqv', '$2y$13$UiqAgx3emYsdTkPq.anBo.gh4kY43QrJCg3tPTxZUHidGErLhbz1a', NULL, 'asdb@gmail.com', 9, '1568699890', '1568699890', 'iRXIypEQs4Ar_TydcxLgwC3c8DvqMJ_F_1568699890', 0),
(76, '123456', '123456', '123456', 'uploads/usr.png', 'JpI2RkFf_5xahYryJnOm7JNush4azYFN', '$2y$13$SIFR3jlQFx6sMPP5EkFmjOH3BRFd5CPsr75AyDlpKXbaMHZyr.IvS', NULL, '1242fjjj@ggghh.cojm', 10, '2019-09-17 08:09:03', '2019-09-17 08:09:03', 'R562J5xkRR0E92dyUnvX_dvC7N9GoX53_1568700663', 4),
(77, 'dfsdfsdf', 'sdfsdfdsf', 'sdfsdfsd', 'uploads/sdfsdfsd.jpg', 'k_7BDrG53iRmqDfqKr2JzLfqMI8RSqhk', '$2y$13$Xsnap5JGtJC8bS5NGi4enOOACGEIe08hFjJiltwYOJTLpkTblxINm', NULL, 'sdfsdfsdf', 10, '2019-09-18', '2019-09-18 09:09:40', 'xM_eeCJrkXSFMxOxa_5fkJyeUSIlTa8Q_1568834440', 1),
(78, 'fgsdgdfg', 'dfgdfgdg', 'dfgdfgdf', 'uploads/usr.png', 'ZJAQn73JZk3My14MYPuE_ssXO85-4Nqo', '$2y$13$Rhrc5hSJ8D5NIzcqXcayleLdTGKwe7tqtkOg5Ub.sh7HtXVQn7Whe', NULL, 'gfdgdgdf', 10, '2019-09-18 09:09:06', '2019-09-18 09:09:06', '5avoWe_t_mfKHy__OI_nwF7VefTT9o6K_1568834946', 1),
(79, 'dsfsdf', 'dsfdf', 'dfdf', 'uploads/usr.png', '3LIC53mE2tnYf701MrMW_88mFnLG6c2o', '$2y$13$PgdX7EesGMtYCqdCMapK/uQjJoKqaiaCTUbHUN3P9aaWAy4a9tDza', NULL, 'dfdfd', 10, '2019-09-18 09:09:38', '2019-09-18 09:09:38', 'LxN112NUIfI3AQXwSyJvshk5BRzKISAi_1568835098', 1),
(80, 'saqib', 'rehan', 'dfgfdgdfg', 'uploads/dfgfdgdfg.png', 'XiRiZOIyEX6MkvWVHl3Hw3b4Ef4FM-LT', '$2y$13$KRWc02KykyQJirWTBTHcZOAgPc67Js/Rln0RHzRbWN5xi4fNZgK8S', NULL, 'saqibrehan2007@gmail.com', 10, '2019-09-18 09:09:16', '2019-09-18 09:09:16', '2aUt9o_brtMD_-daFwOC-R2yQHbtNyMU_1568835256', 1),
(81, 'vbcbcv', 'bcvbcvb', 'cvbcvbv', 'uploads/cvbcvbv.jpg', '6HV-_wz2JW4-MfkFSg6DxkC4BpDKxrZH', '$2y$13$jPTec1veHn.MLfLpYDPFJeKsvm8rHvSahw90bSU7JdBF/YiJ77CV.', NULL, 'cbv', 10, '2019-09-18 09:09:29', '2019-09-18 09:09:29', 'PHy0svT91VoAQ5Onwnx_A_-E5X3fkYDL_1568835449', 1),
(82, 'fdgdfg', 'fdgdfgf', 'gfgfgdf', 'uploads/usr.png', 'in7-7BdZ_gdJspXvmeuJhVXpEc26s3Bt', '$2y$13$7/I9NECZDeQ/CMfQjaskwu05DpaalsrjYyU.LVHF1SAHtAYINNoZi', NULL, 'gdfgdfg', 10, '2019-09-18 09:09:33', '2019-09-18 09:09:33', 'LII5TkygBL1RzpZcN6b1QhM8MxE_7utq_1568835513', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `cnic_no` varchar(150) NOT NULL,
  `contact_no` varchar(150) NOT NULL,
  `email_address` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `user_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`user_id`, `first_name`, `last_name`, `password`, `cnic_no`, `contact_no`, `email_address`, `address`, `user_type_id`) VALUES
(2, 'Usama', 'Javed', 'Usama786', '8970897', '08970897', 'klasdjhjkl@gmail.com', 'jkhdjlk', 1),
(3, 'Usama', 'Javed', 'Usama786.sa@gmail.com', '3456789', '4567889', 'Usama786.sa@gmail.com', 'kljaskljas', 1),
(4, 'junaid', 'mehmood', 'junaid', '097987897', '987097089', 'asihdljk@gmail.com', 'Usamaopdlskjd', 1),
(5, 'ali', 'raza', '412312323', '23940980809', '089', 'usa@gmail.com', '0909709jiojioj', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_type_id` int(11) NOT NULL,
  `user_type` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `user_type`) VALUES
(1, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_head`
--
ALTER TABLE `account_head`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nature_id` (`nature_id`);

--
-- Indexes for table `account_nature`
--
ALTER TABLE `account_nature`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organization_id` (`organization_id`);

--
-- Indexes for table `account_payable`
--
ALTER TABLE `account_payable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `recipient_id` (`recipient_id`),
  ADD KEY `account_payable` (`account_payable`);

--
-- Indexes for table `account_recievable`
--
ALTER TABLE `account_recievable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payer_id` (`payer_id`),
  ADD KEY `transaction__id` (`transaction_id`),
  ADD KEY `account_receivable` (`account_receivable`);

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_name` (`item_name`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `installment`
--
ALTER TABLE `installment`
  ADD PRIMARY KEY (`installment_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `organization_id` (`organization_id`),
  ADD KEY `plot_no` (`plot_no`);

--
-- Indexes for table `installment_status`
--
ALTER TABLE `installment_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `installment_id` (`installment_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `payer_receiver_info`
--
ALTER TABLE `payer_receiver_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `head_id` (`head_id`);

--
-- Indexes for table `plot`
--
ALTER TABLE `plot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `organization_id` (`organization_id`),
  ADD KEY `plot_no` (`plot_no`);

--
-- Indexes for table `plot_owner_info`
--
ALTER TABLE `plot_owner_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `plot_no` (`plot_no`),
  ADD KEY `organization_id` (`organization_id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`property_id`),
  ADD KEY `organization_id` (`organization_id`);

--
-- Indexes for table `provide_services`
--
ALTER TABLE `provide_services`
  ADD PRIMARY KEY (`provide_services_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `services_id` (`services_id`),
  ADD KEY `services_type_id` (`services_type_id`),
  ADD KEY `organization_id` (`organization_id`);

--
-- Indexes for table `services_details`
--
ALTER TABLE `services_details`
  ADD PRIMARY KEY (`services_id`),
  ADD KEY `services_type_id` (`services_type_id`),
  ADD KEY `organization_id` (`organization_id`);

--
-- Indexes for table `services_type`
--
ALTER TABLE `services_type`
  ADD PRIMARY KEY (`services_type_id`),
  ADD KEY `organization_id` (`organization_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `debit_account` (`debit_account`),
  ADD KEY `credit_account` (`credit_account`),
  ADD KEY `receiver_payer_id` (`receiver_payer_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_type_id` (`user_type_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_head`
--
ALTER TABLE `account_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `account_nature`
--
ALTER TABLE `account_nature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `account_payable`
--
ALTER TABLE `account_payable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `account_recievable`
--
ALTER TABLE `account_recievable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `installment`
--
ALTER TABLE `installment`
  MODIFY `installment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `installment_status`
--
ALTER TABLE `installment_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payer_receiver_info`
--
ALTER TABLE `payer_receiver_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `plot`
--
ALTER TABLE `plot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=370;

--
-- AUTO_INCREMENT for table `plot_owner_info`
--
ALTER TABLE `plot_owner_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `provide_services`
--
ALTER TABLE `provide_services`
  MODIFY `provide_services_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services_details`
--
ALTER TABLE `services_details`
  MODIFY `services_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services_type`
--
ALTER TABLE `services_type`
  MODIFY `services_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_head`
--
ALTER TABLE `account_head`
  ADD CONSTRAINT `account_head_ibfk_1` FOREIGN KEY (`nature_id`) REFERENCES `account_nature` (`id`);

--
-- Constraints for table `account_nature`
--
ALTER TABLE `account_nature`
  ADD CONSTRAINT `account_nature_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`);

--
-- Constraints for table `account_payable`
--
ALTER TABLE `account_payable`
  ADD CONSTRAINT `account_payable_ibfk_1` FOREIGN KEY (`account_payable`) REFERENCES `account_head` (`id`),
  ADD CONSTRAINT `account_payable_ibfk_2` FOREIGN KEY (`recipient_id`) REFERENCES `payer_receiver_info` (`id`);

--
-- Constraints for table `account_recievable`
--
ALTER TABLE `account_recievable`
  ADD CONSTRAINT `account_recievable_ibfk_2` FOREIGN KEY (`payer_id`) REFERENCES `payer_receiver_info` (`id`),
  ADD CONSTRAINT `account_recievable_ibfk_3` FOREIGN KEY (`account_receivable`) REFERENCES `account_head` (`id`);

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`),
  ADD CONSTRAINT `auth_assignment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`),
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`);

--
-- Constraints for table `installment`
--
ALTER TABLE `installment`
  ADD CONSTRAINT `installment_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `installment_ibfk_2` FOREIGN KEY (`property_id`) REFERENCES `property` (`property_id`),
  ADD CONSTRAINT `installment_ibfk_3` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`),
  ADD CONSTRAINT `installment_ibfk_4` FOREIGN KEY (`plot_no`) REFERENCES `plot_owner_info` (`plot_no`);

--
-- Constraints for table `installment_status`
--
ALTER TABLE `installment_status`
  ADD CONSTRAINT `installment_status_ibfk_1` FOREIGN KEY (`installment_id`) REFERENCES `installment` (`installment_id`);

--
-- Constraints for table `organization`
--
ALTER TABLE `organization`
  ADD CONSTRAINT `organization_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `payer_receiver_info`
--
ALTER TABLE `payer_receiver_info`
  ADD CONSTRAINT `payer_receiver_info_ibfk_1` FOREIGN KEY (`head_id`) REFERENCES `account_head` (`id`);

--
-- Constraints for table `plot`
--
ALTER TABLE `plot`
  ADD CONSTRAINT `plot_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `property` (`property_id`),
  ADD CONSTRAINT `plot_ibfk_2` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`);

--
-- Constraints for table `plot_owner_info`
--
ALTER TABLE `plot_owner_info`
  ADD CONSTRAINT `plot_owner_info_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `plot_owner_info_ibfk_2` FOREIGN KEY (`plot_no`) REFERENCES `plot` (`plot_no`),
  ADD CONSTRAINT `plot_owner_info_ibfk_3` FOREIGN KEY (`property_id`) REFERENCES `property` (`property_id`),
  ADD CONSTRAINT `plot_owner_info_ibfk_4` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`);

--
-- Constraints for table `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `property_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`);

--
-- Constraints for table `provide_services`
--
ALTER TABLE `provide_services`
  ADD CONSTRAINT `provide_services_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `provide_services_ibfk_2` FOREIGN KEY (`services_id`) REFERENCES `services_details` (`services_id`),
  ADD CONSTRAINT `provide_services_ibfk_3` FOREIGN KEY (`services_type_id`) REFERENCES `services_type` (`services_type_id`),
  ADD CONSTRAINT `provide_services_ibfk_4` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`);

--
-- Constraints for table `services_details`
--
ALTER TABLE `services_details`
  ADD CONSTRAINT `services_details_ibfk_1` FOREIGN KEY (`services_type_id`) REFERENCES `services_type` (`services_type_id`),
  ADD CONSTRAINT `services_details_ibfk_2` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`);

--
-- Constraints for table `services_type`
--
ALTER TABLE `services_type`
  ADD CONSTRAINT `services_type_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`credit_account`) REFERENCES `account_head` (`id`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`debit_account`) REFERENCES `account_head` (`id`);

--
-- Constraints for table `user_login`
--
ALTER TABLE `user_login`
  ADD CONSTRAINT `user_login_ibfk_1` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`user_type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
