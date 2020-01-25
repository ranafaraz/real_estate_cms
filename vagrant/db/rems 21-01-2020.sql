-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2020 at 10:07 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET FOREIGN_KEY_CHECKS=0;
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
(15, 15, 'Account Payable', '04-001', 'rehan', '2019-08-27 09:08:12', 'rehan', '2019-08-27 09:08:12'),
(16, 14, 'Cash', '03-001', 'rehan', '2019-08-27 08:08:49', 'rehan', '2019-08-27 08:08:49'),
(18, 13, 'Plot', '03-003', 'rehan', '2019-08-27 08:08:30', 'rehan', '2019-08-27 08:08:30'),
(19, 15, 'Salaries', '06-001', 'rehan', '2019-08-27 08:08:08', 'rehan', '2019-08-27 08:08:08'),
(20, 17, 'Utility Bills', '06-002', 'rehan', '2019-08-27 08:08:22', 'rehan', '2019-08-27 08:08:22'),
(21, 14, 'Account Receivable', '03-004', 'rehan', '2019-08-30 08:08:39', 'rehan', '2019-08-30 08:08:39'),
(24, 14, 'Bank', '03-005', 'dexdevs', '2019-10-21 07:10:51', 'dexdevs', '2019-10-21 07:10:51'),
(25, 16, 'Miscellaneous Income', '03-006', 'dexdevs', '2019-10-21 08:10:42', 'dexdevs', '2019-10-21 08:10:42'),
(26, 17, 'Stationery Expense', '06-003', 'dexdevs', '2019-10-21 08:10:39', 'dexdevs', '2019-10-21 08:10:39');

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
  `recipient_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `account_payable` int(11) NOT NULL,
  `property_name` varchar(150) DEFAULT NULL,
  `plot_no` int(11) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `identifier` enum('Customer','Expense','Buy Plot') NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `organization_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_payable`
--

INSERT INTO `account_payable` (`id`, `transaction_id`, `recipient_id`, `amount`, `account_payable`, `property_name`, `plot_no`, `due_date`, `identifier`, `created_at`, `updated_at`, `updated_by`, `status`, `organization_id`) VALUES
(44, 1, 20, 0, 16, NULL, NULL, '2019-10-21', 'Expense', '2019-10-22', '2019-10-22', 0, 'Active', 1),
(49, 2, 7, 30000, 18, 'Gulshan Iqbal', 1, '2019-10-22', 'Customer', '2019-10-22', NULL, NULL, 'Active', 1),
(50, 3, 0, 1, 18, 'ewr', 1, '2019-12-03', 'Customer', '2019-12-03', NULL, NULL, 'Active', 1),
(51, 4, 0, 201, 18, 'sdf', 0, '2019-12-27', 'Customer', '2019-12-03', NULL, NULL, 'Active', 1),
(52, 5, 8, 110810, 18, 'ewr', 12, '2019-12-24', 'Customer', '2019-12-03', NULL, NULL, 'Active', 1),
(53, 6, 8, 110810, 18, 'ewr', 12, '2019-12-24', 'Customer', '2019-12-03', NULL, NULL, 'Active', 1),
(54, 7, 0, 181, 18, 'ewr', 1, '2019-12-24', 'Customer', '2019-12-04', NULL, NULL, 'Active', 1),
(55, 8, 2, 181, 18, 'ewr', 1, '2019-12-30', 'Customer', '2019-12-04', NULL, NULL, 'Active', 1);

-- --------------------------------------------------------

--
-- Table structure for table `account_recievable`
--

CREATE TABLE `account_recievable` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `payer_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `property_id` int(11) DEFAULT NULL,
  `plot_no` int(11) DEFAULT NULL,
  `is_installment` int(11) DEFAULT NULL,
  `organization_id` int(11) NOT NULL,
  `due_date` date DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_by` varchar(150) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_recievable`
--

INSERT INTO `account_recievable` (`id`, `transaction_id`, `payer_id`, `amount`, `property_id`, `plot_no`, `is_installment`, `organization_id`, `due_date`, `created_at`, `updated_by`, `updated_at`) VALUES
(12, 1, 6, 400000, 20, 1, 1, 1, '0000-00-00', '0000-00-00', '0', '0000-00-00 00:00:00'),
(13, 2, 10, 321911124, 22, 49, 1, 1, '0000-00-00', '0000-00-00', '0', '0000-00-00 00:00:00'),
(14, 3, 11, 12199, 22, 1, 1, 1, '0000-00-00', '0000-00-00', '0', '0000-00-00 00:00:00'),
(15, 4, 10, 1121, 22, 2, 1, 1, '0000-00-00', '0000-00-00', '0', '0000-00-00 00:00:00'),
(16, 5, 12, 1, 22, 3, 1, 1, '0000-00-00', '0000-00-00', '0', '0000-00-00 00:00:00'),
(17, 6, 13, 21199, 22, 3, 1, 1, '0000-00-00', '0000-00-00', '0', '0000-00-00 00:00:00'),
(18, 7, 14, 0, 22, 4, 1, 1, '0000-00-00', '0000-00-00', '74', '2019-12-03 00:00:00'),
(19, 8, 1, 950000, 1, 1, 1, 1, '0000-00-00', '0000-00-00', '0', '0000-00-00 00:00:00'),
(20, 9, 3, 46.8, 1, 2, 1, 1, '0000-00-00', '0000-00-00', '0', '0000-00-00 00:00:00'),
(21, 10, 4, 750000, 1, 1, 1, 1, '0000-00-00', '0000-00-00', '0', '0000-00-00 00:00:00'),
(22, 11, 5, 3102000, 3, 1, 1, 1, '0000-00-00', '0000-00-00', '0', '0000-00-00 00:00:00');

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
  `description` text DEFAULT NULL,
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
-- Table structure for table `buy_plot`
--

CREATE TABLE `buy_plot` (
  `buy_plot_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `property_name` varchar(255) NOT NULL,
  `plot_no` varchar(50) NOT NULL,
  `plot_area` varchar(50) NOT NULL,
  `plot_price` double NOT NULL,
  `plot_paid_price` double NOT NULL,
  `plot_location` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `buy_date` date NOT NULL,
  `created_at` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` date DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `plot_status` enum('Owned','Self Owned','Customer Owned') NOT NULL,
  `organization_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buy_plot`
--

INSERT INTO `buy_plot` (`buy_plot_id`, `customer_id`, `property_name`, `plot_no`, `plot_area`, `plot_price`, `plot_paid_price`, `plot_location`, `city`, `district`, `province`, `buy_date`, `created_at`, `created_by`, `updated_at`, `updated_by`, `plot_status`, `organization_id`) VALUES
(1, 2, 'ewr', '1', '21', 213, 32, 'dfs ', 'rahim yar khan', '23', 'punjab', '0000-00-00', '2019-12-04', 74, NULL, NULL, 'Self Owned', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_type_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `father_name` varchar(150) NOT NULL,
  `cnic_no` varchar(150) NOT NULL,
  `contact_no` varchar(150) NOT NULL,
  `email_address` varchar(150) NOT NULL,
  `address` varchar(250) NOT NULL,
  `image` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_type_id`, `name`, `father_name`, `cnic_no`, `contact_no`, `email_address`, `address`, `image`, `user_id`, `organization_id`, `created_date`) VALUES
(1, 3, 'saqib rehan', 'dfsd', '1234567890', '2312', 'saqibrehan2007@gmail.com', 'chak 117, rahim yar khan', 'uploads/1234567890.jpg', 74, 1, '2019-12-03'),
(2, 4, 'saqib rehan', '321', '213', 'sdfs', 'saqibrehan2007@gmail.com', 'chak 117, rahim yar khan', '', 74, 1, '2019-12-04'),
(3, 3, 'sdf sdbh', 'jhbjh', '23123-1231231-3', '214312312', 'sfdjk@gfnsd.com', 'sdn fjnkj', '0', 74, 1, '2019-12-15'),
(4, 3, 'saqib rehan', '321', '12345-6789000-0', '2312', 'saqibrehan2007@gmail.com', 'chak 117, rahim yar khan', 'uploads/usr-default.png', 74, 1, '2019-12-16'),
(5, 3, 'saqib rehan', 'Afzal Rehan', '12345-6798876-5', '03126232587', 'saqibrehan587@gmail.com', 'chak 117/p', 'uploads/usr-default.png', 74, 1, '2020-01-20');

-- --------------------------------------------------------

--
-- Table structure for table `customer_type`
--

CREATE TABLE `customer_type` (
  `customer_type_id` int(11) NOT NULL,
  `customer_type` enum('Buyer','Seller') NOT NULL,
  `created_at` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_type`
--

INSERT INTO `customer_type` (`customer_type_id`, `customer_type`, `created_at`, `created_by`, `organization_id`) VALUES
(3, 'Buyer', '2019-09-28', 74, 1),
(4, 'Seller', '2019-09-28', 74, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(11) NOT NULL,
  `emp_type_id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `emp_name` varchar(20) NOT NULL,
  `emp_cnic` varchar(15) NOT NULL,
  `emp_contact` varchar(15) NOT NULL,
  `emp_father_name` varchar(20) NOT NULL,
  `emp_gender` varchar(6) NOT NULL,
  `emp_status` enum('Active','Inactive') NOT NULL,
  `emp_photo` varchar(200) NOT NULL,
  `salary` double NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_type_id`, `organization_id`, `emp_name`, `emp_cnic`, `emp_contact`, `emp_father_name`, `emp_gender`, `emp_status`, `emp_photo`, `salary`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 1, 1, 'abc', '12345-6788765-4', '+23-456-7876543', 'qwertyu', 'Male', 'Active', 'uploads/abc_photo.jpg', 30000, '2019-09-30', '0000-00-00', 74, 0),
(2, 1, 1, 'ygqwdyj', '89712-3897891-2', '+98-127-3912379', 'uiqwiouqiou', 'Male', 'Active', 'uploads/ygqwdyj_photo.jpg', 40000, '2019-10-14', '0000-00-00', 74, 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee_types`
--

CREATE TABLE `employee_types` (
  `emp_type_id` int(11) NOT NULL,
  `emp_type_name` varchar(50) NOT NULL,
  `description` varchar(150) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_types`
--

INSERT INTO `employee_types` (`emp_type_id`, `emp_type_name`, `description`, `created_at`, `updated_at`, `created_by`, `updated_by`, `organization_id`) VALUES
(1, 'Data Entry Operator', 'the person Enter data and collect fee', '2019-09-30', '0000-00-00', 74, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_salary`
--

CREATE TABLE `emp_salary` (
  `emp_salary_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `salary_month` varchar(11) NOT NULL,
  `paid_amount` double NOT NULL,
  `remaining` double NOT NULL,
  `status` enum('Paid','Unpaid','Partially Paid','Advance Paid') NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL,
  `organization_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `emp_salary`
--

INSERT INTO `emp_salary` (`emp_salary_id`, `emp_id`, `date`, `salary_month`, `paid_amount`, `remaining`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `organization_id`) VALUES
(26, 1, '2019-10-21', '2019-10', 25000, 5000, 'Partially Paid', 74, 0, '0000-00-00', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `installment`
--

CREATE TABLE `installment` (
  `installment_id` int(11) NOT NULL,
  `installment_type` varchar(250) NOT NULL,
  `advance_amount` double NOT NULL,
  `total_amount` double NOT NULL,
  `discount_amount` double DEFAULT NULL,
  `no_of_installments` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `plot_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `installment`
--

INSERT INTO `installment` (`installment_id`, `installment_type`, `advance_amount`, `total_amount`, `discount_amount`, `no_of_installments`, `customer_id`, `property_id`, `organization_id`, `plot_no`) VALUES
(1, '6 Months', 0, 1000000, 0, 4, 1, 1, 1, 1),
(2, 'Monthly', 0, 47.8, 0, 12, 3, 1, 1, 2),
(3, 'Monthly', 0, 1000000, 0, 18, 4, 1, 1, 1),
(4, 'Monthly', 0, 4136000, 0, 24, 5, 3, 1, 1);

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
(1, 1, 1, 50000, 0, '2019-12-03', '2019-12-03', '74', 1),
(2, 1, 2, 237500, 1, '2019-12-03', '2020-12-03', '74', 1),
(3, 1, 3, 237500, 1, '2019-12-03', '2021-06-03', '74', 1),
(4, 1, 4, 237500, 1, '2019-12-03', '2021-12-03', '74', 1),
(5, 1, 5, 237500, 1, '2019-12-03', '2022-06-03', '74', 1),
(6, 2, 1, 1, 0, '2019-12-15', '2019-12-15', '74', 1),
(7, 2, 2, 4, 1, '2019-12-15', '2020-02-15', '74', 1),
(8, 2, 3, 4, 1, '2019-12-15', '2020-03-15', '74', 1),
(9, 2, 4, 4, 1, '2019-12-15', '2020-04-15', '74', 1),
(10, 2, 5, 4, 1, '2019-12-15', '2020-05-15', '74', 1),
(11, 2, 6, 4, 1, '2019-12-15', '2020-06-15', '74', 1),
(12, 2, 7, 4, 1, '2019-12-15', '2020-07-15', '74', 1),
(13, 2, 8, 4, 1, '2019-12-15', '2020-08-15', '74', 1),
(14, 2, 9, 4, 1, '2019-12-15', '2020-09-15', '74', 1),
(15, 2, 10, 4, 1, '2019-12-15', '2020-10-15', '74', 1),
(16, 2, 11, 4, 1, '2019-12-15', '2020-11-15', '74', 1),
(17, 2, 12, 4, 1, '2019-12-15', '2020-12-15', '74', 1),
(18, 2, 13, 4, 1, '2019-12-15', '2021-01-15', '74', 1),
(19, 3, 1, 250000, 0, '2019-12-16', '2019-12-16', '74', 1),
(20, 3, 2, 41667, 1, '2019-12-16', '2020-02-16', '74', 1),
(21, 3, 3, 41667, 1, '2019-12-16', '2020-03-16', '74', 1),
(22, 3, 4, 41667, 1, '2019-12-16', '2020-04-16', '74', 1),
(23, 3, 5, 41667, 1, '2019-12-16', '2020-05-16', '74', 1),
(24, 3, 6, 41667, 1, '2019-12-16', '2020-06-16', '74', 1),
(25, 3, 7, 41667, 1, '2019-12-16', '2020-07-16', '74', 1),
(26, 3, 8, 41667, 1, '2019-12-16', '2020-08-16', '74', 1),
(27, 3, 9, 41667, 1, '2019-12-16', '2020-09-16', '74', 1),
(28, 3, 10, 41667, 1, '2019-12-16', '2020-10-16', '74', 1),
(29, 3, 11, 41667, 1, '2019-12-16', '2020-11-16', '74', 1),
(30, 3, 12, 41667, 1, '2019-12-16', '2020-12-16', '74', 1),
(31, 3, 13, 41667, 1, '2019-12-16', '2021-01-16', '74', 1),
(32, 3, 14, 41667, 1, '2019-12-16', '2021-02-16', '74', 1),
(33, 3, 15, 41667, 1, '2019-12-16', '2021-03-16', '74', 1),
(34, 3, 16, 41667, 1, '2019-12-16', '2021-04-16', '74', 1),
(35, 3, 17, 41667, 1, '2019-12-16', '2021-05-16', '74', 1),
(36, 3, 18, 41667, 1, '2019-12-16', '2021-06-16', '74', 1),
(37, 3, 19, 41667, 1, '2019-12-16', '2021-07-16', '74', 1),
(38, 4, 1, 1034000, 0, '2020-01-20', '2020-01-20', '74', 1),
(39, 4, 2, 129250, 1, '2020-01-20', '2020-03-20', '74', 1),
(40, 4, 3, 129250, 1, '2020-01-20', '2020-04-20', '74', 1),
(41, 4, 4, 129250, 1, '2020-01-20', '2020-05-20', '74', 1),
(42, 4, 5, 129250, 1, '2020-01-20', '2020-06-20', '74', 1),
(43, 4, 6, 129250, 1, '2020-01-20', '2020-07-20', '74', 1),
(44, 4, 7, 129250, 1, '2020-01-20', '2020-08-20', '74', 1),
(45, 4, 8, 129250, 1, '2020-01-20', '2020-09-20', '74', 1),
(46, 4, 9, 129250, 1, '2020-01-20', '2020-10-20', '74', 1),
(47, 4, 10, 129250, 1, '2020-01-20', '2020-11-20', '74', 1),
(48, 4, 11, 129250, 1, '2020-01-20', '2020-12-20', '74', 1),
(49, 4, 12, 129250, 1, '2020-01-20', '2021-01-20', '74', 1),
(50, 4, 13, 129250, 1, '2020-01-20', '2021-02-20', '74', 1),
(51, 4, 14, 129250, 1, '2020-01-20', '2021-03-20', '74', 1),
(52, 4, 15, 129250, 1, '2020-01-20', '2021-04-20', '74', 1),
(53, 4, 16, 129250, 1, '2020-01-20', '2021-05-20', '74', 1),
(54, 4, 17, 129250, 1, '2020-01-20', '2021-06-20', '74', 1),
(55, 4, 18, 129250, 1, '2020-01-20', '2021-07-20', '74', 1),
(56, 4, 19, 129250, 1, '2020-01-20', '2021-08-20', '74', 1),
(57, 4, 20, 129250, 1, '2020-01-20', '2021-09-20', '74', 1),
(58, 4, 21, 129250, 1, '2020-01-20', '2021-10-20', '74', 1),
(59, 4, 22, 129250, 1, '2020-01-20', '2021-11-20', '74', 1),
(60, 4, 23, 129250, 1, '2020-01-20', '2021-12-20', '74', 1),
(61, 4, 24, 129250, 1, '2020-01-20', '2022-01-20', '74', 1),
(62, 4, 25, 129250, 1, '2020-01-20', '2022-02-20', '74', 1);

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
(4, 'test1', 76, '2019-09-17');

-- --------------------------------------------------------

--
-- Table structure for table `payer_receiver_info`
--

CREATE TABLE `payer_receiver_info` (
  `id` int(11) NOT NULL,
  `head_id` int(11) NOT NULL,
  `payer_receiver_id` int(11) NOT NULL,
  `choice` enum('Receiver','Payer') NOT NULL,
  `created_by` varchar(150) NOT NULL,
  `created_at` date NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `organization_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payer_receiver_info`
--

INSERT INTO `payer_receiver_info` (`id`, `head_id`, `payer_receiver_id`, `choice`, `created_by`, `created_at`, `status`, `organization_id`) VALUES
(1, 19, 0, 'Receiver', 'rehan', '2019-08-29', 'Active', 0),
(2, 16, 0, 'Payer', 'rehan', '2019-08-29', 'Active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `plot`
--

CREATE TABLE `plot` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `plot_no` int(11) NOT NULL,
  `plot_length` varchar(50) DEFAULT NULL,
  `plot_width` varchar(50) DEFAULT NULL,
  `area` varchar(30) DEFAULT NULL,
  `plot_type` enum('Residential','Commercial') DEFAULT NULL,
  `plot_price` double DEFAULT NULL,
  `per_merla_rate` double DEFAULT NULL,
  `status` enum('Sold','Unsold') DEFAULT NULL,
  `created_by` varchar(150) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_by` varchar(150) NOT NULL,
  `updated_at` date NOT NULL,
  `organization_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plot`
--

INSERT INTO `plot` (`id`, `property_id`, `plot_no`, `plot_length`, `plot_width`, `area`, `plot_type`, `plot_price`, `per_merla_rate`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`, `organization_id`) VALUES
(1, 1, 1, '50', '50', '9.191', 'Residential', 1000000, 108802.089, 'Sold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(2, 1, 2, '20', '13', '0.956', 'Residential', 47.8, 50, 'Sold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(3, 1, 3, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(4, 1, 4, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(5, 1, 5, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(6, 1, 6, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(7, 1, 7, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(8, 1, 8, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(9, 1, 9, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(10, 1, 10, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(11, 1, 11, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(12, 1, 12, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(13, 1, 13, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(14, 1, 14, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(15, 1, 15, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(16, 1, 16, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(17, 1, 17, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(18, 1, 18, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(19, 1, 19, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(20, 1, 20, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(21, 1, 21, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(22, 1, 22, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(23, 1, 23, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(24, 1, 24, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(25, 1, 25, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(26, 2, 1, '100', '100', '36.765', 'Residential', 500000, 13599.891, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(27, 2, 2, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(28, 2, 3, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(29, 2, 4, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(30, 2, 5, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(31, 2, 6, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(32, 2, 7, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(33, 2, 8, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(34, 2, 9, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(35, 2, 10, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(36, 2, 11, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(37, 2, 12, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(38, 2, 13, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(39, 2, 14, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(40, 2, 15, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(41, 2, 16, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(42, 2, 17, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(43, 2, 18, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(44, 2, 19, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(45, 2, 20, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(46, 2, 21, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(47, 2, 22, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(48, 2, 23, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(49, 2, 24, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(50, 2, 25, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(51, 2, 26, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(52, 2, 27, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(53, 2, 28, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(54, 2, 29, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(55, 2, 30, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(56, 2, 31, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(57, 2, 32, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(58, 2, 33, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(59, 2, 34, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(60, 2, 35, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(61, 2, 36, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(62, 2, 37, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(63, 2, 38, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(64, 2, 39, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(65, 2, 40, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(66, 2, 41, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(67, 2, 42, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(68, 2, 43, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(69, 2, 44, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(70, 2, 45, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(71, 2, 46, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(72, 2, 47, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(73, 2, 48, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(74, 2, 49, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(75, 2, 50, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2019-12-03', '', '0000-00-00', 1),
(76, 3, 1, '90', '50', '16.544', 'Residential', 4136000, 250000, 'Sold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(77, 3, 2, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(78, 3, 3, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(79, 3, 4, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(80, 3, 5, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(81, 3, 6, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(82, 3, 7, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(83, 3, 8, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(84, 3, 9, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(85, 3, 10, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(86, 3, 11, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(87, 3, 12, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(88, 3, 13, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(89, 3, 14, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(90, 3, 15, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(91, 3, 16, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(92, 3, 17, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(93, 3, 18, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(94, 3, 19, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(95, 3, 20, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(96, 3, 21, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(97, 3, 22, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(98, 3, 23, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(99, 3, 24, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(100, 3, 25, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(101, 3, 26, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(102, 3, 27, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(103, 3, 28, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(104, 3, 29, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(105, 3, 30, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(106, 3, 31, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(107, 3, 32, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(108, 3, 33, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(109, 3, 34, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(110, 3, 35, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(111, 3, 36, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(112, 3, 37, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(113, 3, 38, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(114, 3, 39, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(115, 3, 40, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(116, 3, 41, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1),
(117, 3, 42, '', '', NULL, NULL, NULL, NULL, 'Unsold', 'dexdevs', '2020-01-20', '', '0000-00-00', 1);

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
  `organization_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plot_owner_info`
--

INSERT INTO `plot_owner_info` (`id`, `customer_id`, `property_id`, `plot_no`, `start_date`, `end_date`, `organization_id`, `status`) VALUES
(1, 1, 1, 1, '2019-12-03', '0000-00-00', 1, 'Active'),
(2, 3, 1, 2, '2019-12-15', '0000-00-00', 1, 'Active'),
(3, 4, 1, 1, '2019-12-16', '0000-00-00', 1, 'Active'),
(4, 5, 3, 1, '2020-01-20', '0000-00-00', 1, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `property_id` int(11) NOT NULL,
  `property_name` varchar(250) NOT NULL,
  `area` varchar(50) NOT NULL,
  `property_price` double NOT NULL,
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
(1, 'itehad garden', '100', 5000000, 'rahim yar khan', 'ryk', 'ryk', 'punjab', 'dexdevs', '2019-12-03', 1, 25),
(2, 'canal garden', '200', 10000000, 'allama iqbal road sdk', 'sdk', 'ryk', 'punjab', 'dexdevs', '2019-12-03', 1, 50),
(3, 'gulshan rehman', '960', 0, 'ryk', 'Rahim Yar khan', 'Rahim Yar Khan', 'Punjab', 'dexdevs', '2020-01-20', 1, 42);

-- --------------------------------------------------------

--
-- Table structure for table `provide_services`
--

CREATE TABLE `provide_services` (
  `provide_services_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `services_type_id` int(11) NOT NULL,
  `services_id` int(11) NOT NULL,
  `service_details` text NOT NULL,
  `organization_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provide_services`
--

INSERT INTO `provide_services` (`provide_services_id`, `customer_id`, `services_type_id`, `services_id`, `service_details`, `organization_id`) VALUES
(1, 88, 1, 2, 'kljkljkljkljkl', 1),
(2, 1, 4, 2, 'sdjksdlvjsdkl', 1),
(3, 3, 1, 2, '1234567', 1);

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
(5, 'plumber', 1),
(6, 'sdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `type` enum('Cash Payment','Bank Payment') NOT NULL,
  `narration` text DEFAULT NULL,
  `debit_account` int(11) NOT NULL,
  `debit_amount` double NOT NULL,
  `credit_account` int(11) NOT NULL,
  `credit_amount` double NOT NULL,
  `date` date NOT NULL,
  `ref_no` varchar(50) DEFAULT NULL,
  `created_by` varchar(150) NOT NULL,
  `organization_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_id`, `type`, `narration`, `debit_account`, `debit_amount`, `credit_account`, `credit_amount`, `date`, `ref_no`, `created_by`, `organization_id`) VALUES
(120, 1, 'Cash Payment', 'scas', 20, 1200, 16, 1000, '2019-10-22', '', 'dexdevs', 1),
(121, 2, 'Cash Payment', 'scas', 20, 200, 15, 200, '2019-10-22', NULL, '74', 1),
(122, 3, 'Cash Payment', 'skadkl', 15, 200, 16, 200, '2019-10-22', NULL, '74', 1),
(123, 4, 'Cash Payment', '', 16, 100000, 18, 100000, '2019-10-22', NULL, '74', 1),
(125, 6, 'Cash Payment', '', 21, 400000, 16, 400000, '2019-10-22', NULL, '74', 1),
(132, 7, 'Cash Payment', 'jkhjk', 18, 30000, 15, 30000, '2019-10-22', NULL, '74', 1),
(133, 8, 'Cash Payment', 'jkhjk', 18, 50000, 16, 20000, '2019-10-22', NULL, '74', 1),
(134, 9, 'Cash Payment', 'mislinious income from abc 1200', 16, 1200, 25, 1200, '2019-10-26', '', 'dexdevs', 0),
(135, 10, 'Cash Payment', 'e', 18, 1, 15, 1, '2019-12-03', NULL, '74', 1),
(136, 11, 'Cash Payment', 'e', 18, 213, 16, 32, '2019-12-03', NULL, '74', 1),
(137, 12, 'Cash Payment', 'dsf', 18, 201, 15, 201, '2019-12-03', NULL, '74', 1),
(138, 13, 'Cash Payment', 'dsf', 18, 213, 16, 12, '2019-12-03', NULL, '74', 1),
(139, 14, 'Cash Payment', 'asdasd', 18, 110810, 15, 110810, '2019-12-03', NULL, '74', 1),
(140, 15, 'Cash Payment', 'asdasd', 18, 123123, 16, 12313, '2019-12-03', NULL, '74', 1),
(141, 16, 'Cash Payment', 'asdasd', 18, 110810, 15, 110810, '2019-12-03', NULL, '74', 1),
(142, 17, 'Cash Payment', 'asdasd', 18, 123123, 16, 12313, '2019-12-03', NULL, '74', 1),
(143, 18, 'Cash Payment', 'dcvgfd s', 16, 123123212321, 18, 123123212321, '2019-12-03', NULL, '74', 1),
(144, 19, 'Cash Payment', 'dcvgfd s', 16, 123123212321, 18, 123123212321, '2019-12-03', NULL, '74', 1),
(145, 20, 'Cash Payment', 'dcvgfd s', 21, 321911124, 16, 321911124, '2019-12-03', NULL, '74', 1),
(146, 21, 'Cash Payment', 'sdf s', 16, 123, 18, 123, '2019-12-03', NULL, '74', 1),
(147, 22, 'Cash Payment', 'sdf s', 16, 123, 18, 123, '2019-12-03', NULL, '74', 1),
(148, 23, 'Cash Payment', 'sdf s', 21, 12199, 16, 12199, '2019-12-03', NULL, '74', 1),
(149, 24, 'Cash Payment', 'ds f', 16, 1, 18, 1, '2019-12-03', NULL, '74', 1),
(150, 25, 'Cash Payment', 'ds f', 16, 1, 18, 1, '2019-12-03', NULL, '74', 1),
(151, 26, 'Cash Payment', 'ds f', 21, 1121, 16, 1121, '2019-12-03', NULL, '74', 1),
(152, 27, 'Cash Payment', 'dcvgfd s', 16, 0, 18, 0, '2019-12-03', NULL, '74', 1),
(153, 28, 'Cash Payment', 'dcvgfd s', 16, 0, 18, 0, '2019-12-03', NULL, '74', 1),
(154, 29, 'Cash Payment', 'dcvgfd s', 21, 1, 16, 1, '2019-12-03', NULL, '74', 1),
(155, 30, 'Cash Payment', 'd fdsfsd f', 16, 123, 18, 123, '2019-12-03', NULL, '74', 1),
(156, 31, 'Cash Payment', 'd fdsfsd f', 16, 123, 18, 123, '2019-12-03', NULL, '74', 1),
(157, 32, 'Cash Payment', 'd fdsfsd f', 21, 21199, 16, 21199, '2019-12-03', NULL, '74', 1),
(158, 33, 'Cash Payment', '12321dfsf', 16, 0, 18, 0, '2019-12-03', NULL, '74', 1),
(159, 34, 'Cash Payment', '12321dfsf', 16, 0, 18, 0, '2019-12-03', NULL, '74', 1),
(160, 35, 'Cash Payment', '12321dfsf', 21, 1, 16, 1, '2019-12-03', NULL, '74', 1),
(161, 36, 'Cash Payment', NULL, 16, 1, 21, 1, '2019-12-03', NULL, '74', 1),
(162, 37, 'Cash Payment', 'test entry', 16, 50000, 18, 50000, '2019-12-03', NULL, '74', 1),
(163, 38, 'Cash Payment', 'test entry', 16, 50000, 18, 50000, '2019-12-03', NULL, '74', 1),
(164, 39, 'Cash Payment', 'test entry', 21, 950000, 16, 950000, '2019-12-03', NULL, '74', 1),
(165, 40, 'Cash Payment', 'fdgdg', 18, 181, 15, 181, '2019-12-04', NULL, '74', 1),
(166, 41, 'Cash Payment', 'fdgdg', 18, 213, 16, 32, '2019-12-04', NULL, '74', 1),
(167, 42, 'Cash Payment', 'sdfdsf', 18, 181, 15, 181, '2019-12-04', NULL, '74', 1),
(168, 43, 'Cash Payment', 'sdfdsf', 18, 213, 16, 32, '2019-12-04', NULL, '74', 1),
(169, 44, 'Cash Payment', 'sd fds ', 16, 1, 18, 1, '2019-12-15', NULL, '74', 1),
(170, 45, 'Cash Payment', 'sd fds ', 16, 1, 18, 1, '2019-12-15', NULL, '74', 1),
(171, 46, 'Cash Payment', 'sd fds ', 21, 46.8, 16, 46.8, '2019-12-15', NULL, '74', 1),
(172, 47, 'Cash Payment', 'test entry', 16, 250000, 18, 250000, '2019-12-16', NULL, '74', 1),
(173, 48, 'Cash Payment', 'test entry', 16, 250000, 18, 250000, '2019-12-16', NULL, '74', 1),
(174, 49, 'Cash Payment', 'test entry', 21, 750000, 16, 750000, '2019-12-16', NULL, '74', 1),
(175, 50, 'Cash Payment', 'test entry', 16, 1034000, 18, 1034000, '2020-01-20', NULL, '74', 1),
(176, 51, 'Cash Payment', 'test entry', 16, 1034000, 18, 1034000, '2020-01-20', NULL, '74', 1),
(177, 52, 'Cash Payment', 'test entry', 21, 3102000, 16, 3102000, '2020-01-20', NULL, '74', 1);

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
  `status` smallint(6) NOT NULL DEFAULT 10,
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
  ADD KEY `account_payable` (`account_payable`),
  ADD KEY `organization_id` (`organization_id`),
  ADD KEY `property_name` (`property_name`),
  ADD KEY `plot_no` (`plot_no`),
  ADD KEY `recipient_id_2` (`recipient_id`),
  ADD KEY `account_payable_2` (`account_payable`);

--
-- Indexes for table `account_recievable`
--
ALTER TABLE `account_recievable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payer_id` (`payer_id`),
  ADD KEY `transaction__id` (`transaction_id`),
  ADD KEY `organization_id` (`organization_id`);

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
-- Indexes for table `buy_plot`
--
ALTER TABLE `buy_plot`
  ADD PRIMARY KEY (`buy_plot_id`),
  ADD KEY `organization_id` (`organization_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `customer_ibfk_1` (`customer_type_id`);

--
-- Indexes for table `customer_type`
--
ALTER TABLE `customer_type`
  ADD PRIMARY KEY (`customer_type_id`),
  ADD KEY `organization_id` (`organization_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `emp_type_id` (`emp_type_id`,`organization_id`),
  ADD KEY `branch_id` (`organization_id`);

--
-- Indexes for table `employee_types`
--
ALTER TABLE `employee_types`
  ADD PRIMARY KEY (`emp_type_id`),
  ADD KEY `organization_id` (`organization_id`);

--
-- Indexes for table `emp_salary`
--
ALTER TABLE `emp_salary`
  ADD PRIMARY KEY (`emp_salary_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `organization_id` (`organization_id`);

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
  ADD KEY `head_id` (`head_id`),
  ADD KEY `organization_id` (`organization_id`);

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
  ADD KEY `organization_id` (`organization_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `account_nature`
--
ALTER TABLE `account_nature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `account_payable`
--
ALTER TABLE `account_payable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `account_recievable`
--
ALTER TABLE `account_recievable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `buy_plot`
--
ALTER TABLE `buy_plot`
  MODIFY `buy_plot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer_type`
--
ALTER TABLE `customer_type`
  MODIFY `customer_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee_types`
--
ALTER TABLE `employee_types`
  MODIFY `emp_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `emp_salary`
--
ALTER TABLE `emp_salary`
  MODIFY `emp_salary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `installment`
--
ALTER TABLE `installment`
  MODIFY `installment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `installment_status`
--
ALTER TABLE `installment_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `plot_owner_info`
--
ALTER TABLE `plot_owner_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `provide_services`
--
ALTER TABLE `provide_services`
  MODIFY `provide_services_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `services_details`
--
ALTER TABLE `services_details`
  MODIFY `services_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services_type`
--
ALTER TABLE `services_type`
  MODIFY `services_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

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
-- Constraints for table `buy_plot`
--
ALTER TABLE `buy_plot`
  ADD CONSTRAINT `buy_plot_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`),
  ADD CONSTRAINT `buy_plot_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`customer_type_id`) REFERENCES `customer_type` (`customer_type_id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`emp_type_id`) REFERENCES `employee_types` (`emp_type_id`);

--
-- Constraints for table `employee_types`
--
ALTER TABLE `employee_types`
  ADD CONSTRAINT `employee_types_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`);

--
-- Constraints for table `emp_salary`
--
ALTER TABLE `emp_salary`
  ADD CONSTRAINT `emp_salary_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`),
  ADD CONSTRAINT `emp_salary_ibfk_2` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`);

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
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
