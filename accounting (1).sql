-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2019 at 08:34 AM
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
-- Database: `accounting`
--
CREATE DATABASE IF NOT EXISTS `accounting` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `accounting`;

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
(12, 1, 'Assets', '01-000', '2019-08-27 08:08:01'),
(13, 1, 'Fixed Assets', '02-000', '2019-08-27 08:08:32'),
(14, 1, 'Current Assets', '03-000', '2019-08-27 08:08:46'),
(15, 1, 'Liabilities', '04-000', '2019-08-27 08:08:25');

-- --------------------------------------------------------

--
-- Table structure for table `account_payable`
--

CREATE TABLE `account_payable` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `account_payable` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `account_recievable`
--

CREATE TABLE `account_recievable` (
  `id` int(11) NOT NULL,
  `transaction__id` int(11) NOT NULL,
  `payer_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `account_receivable` int(11) NOT NULL,
  `updated_by` varchar(150) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
('m000000_000000_base', 1566369326),
('m130524_201442_init', 1566369329),
('m190124_110200_add_verification_token_column_to_user_table', 1566369330);

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `capital` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`id`, `name`, `start_date`, `capital`) VALUES
(1, 'DEXDEVS', '2019-10-10', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `tec_fname` varchar(50) NOT NULL,
  `tec_lname` varchar(50) NOT NULL,
  `tec_faname` varchar(50) NOT NULL,
  `tec_email` varchar(50) NOT NULL,
  `tec_cnic` varchar(15) NOT NULL,
  `tec_number` varchar(15) NOT NULL,
  `tec_gender` varchar(10) NOT NULL,
  `tec_address` varchar(200) NOT NULL,
  `course_id` int(11) NOT NULL,
  `tec_qualification` varchar(100) NOT NULL,
  `tec_uni` varchar(150) NOT NULL,
  `tec_experience` int(2) NOT NULL,
  `tec_age` int(3) NOT NULL,
  `salary` double NOT NULL,
  `tec_status` tinyint(1) NOT NULL DEFAULT '1',
  `tec_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `tec_fname`, `tec_lname`, `tec_faname`, `tec_email`, `tec_cnic`, `tec_number`, `tec_gender`, `tec_address`, `course_id`, `tec_qualification`, `tec_uni`, `tec_experience`, `tec_age`, `salary`, `tec_status`, `tec_date`) VALUES
(1, 'Arslan', 'Nasir', 'Nasir Mehmood', 'm.arslanch007@gmail.com', '31304-9467882-9', '03043374027', 'male', 'Chak no 146p p/o chak 148p sadiqabad ryk', 1, 'BSCS', 'iub', 1, 20, 1, 1, '2018-10-01'),
(2, 'ali', 'khan', 'khan m', 'ali@gmail.com', '1234567', '12345678', 'Male', 'sadiq abad ryk', 2, 'MCS', 'IUB', 1, 22, 1, 0, '2018-10-10'),
(3, 'usama', 'ali', 'm ali', 'usama@gmail.com', '1234567890', '1234567890', 'Male', 'qwertyuiopasdfghjkxcvbnm', 2, 'Bsc', 'BZU', 2, 30, 2, 0, '2018-10-10'),
(4, 'usama', 'ali', 'm ali', 'usama@gmail.com', '1234567890', '1234567890', 'Male', 'qwertyuiopasdfghjkxcvbnm', 2, 'Bsc', 'BZU', 2, 30, 2, 0, '2018-10-10'),
(5, 'usama', 'ali', 'm ali', 'usama@gmail.com', '1234567890', '1234567890', 'Male', 'qwertyuiopasdfghjkxcvbnm', 2, 'Bsc', 'BZU', 2, 30, 2, 0, '2018-10-10'),
(6, 'usama', 'ali', 'm ali', 'usama@gmail.com', '1234567890', '1234567890', 'Male', 'qwertyuiopasdfghjkxcvbnm', 2, 'Bsc', 'BZU', 2, 30, 2, 0, '2018-10-10'),
(7, 'usama', 'ali', 'm ali', 'usama@gmail.com', '1234567890', '1234567890', 'Male', 'qwertyuiopasdfghjkxcvbnm', 2, 'Bsc', 'BZU', 2, 30, 2, 0, '2018-10-10'),
(8, 'usama', 'ali', 'm ali', 'usama@gmail.com', '1234567890', '1234567890', 'Male', 'qwertyuiopasdfghjkxcvbnm', 2, 'Bsc', 'BZU', 2, 30, 2, 0, '2018-10-10'),
(9, 'usama', 'ali', 'm ali', 'usama@gmail.com', '1234567890', '1234567890', 'Male', 'qwertyuiopasdfghjkxcvbnm', 2, 'Bsc', 'BZU', 2, 30, 2, 0, '2018-10-10'),
(10, 'usama', 'ali', 'm ali', 'usama@gmail.com', '1234567890', '1234567890', 'Male', 'qwertyuiopasdfghjkxcvbnm', 2, 'Bsc', 'BZU', 2, 30, 2, 0, '2018-10-10'),
(11, 'usama', 'ali', 'm ali', 'usama@gmail.com', '1234567890', '1234567890', 'Male', 'qwertyuiopasdfghjkxcvbnm', 2, 'Bsc', 'BZU', 2, 30, 2, 0, '2018-10-10'),
(12, 'usama', 'ali', 'm ali', 'usama@gmail.com', '1234567890', '1234567890', 'Male', 'qwertyuiopasdfghjkxcvbnm', 2, 'Bsc', 'BZU', 2, 30, 2, 0, '2018-10-10'),
(13, 'usama', 'ali', 'm ali', 'usama@gmail.com', '1234567890', '1234567890', 'Male', 'qwertyuiopasdfghjkxcvbnm', 2, 'Bsc', 'BZU', 2, 30, 2, 0, '2018-10-10'),
(14, 'saqib', 'rehan', 'Afzal Rehan', 'saqibrehan2007@gmail.com', '31303-1782040-9', '03126232587', 'MALE', 'chak 117, rahim yar khan', 13, 'BSCS', 'IUB', 0, 20, 0, 1, '2018-10-29');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `std_name` varchar(50) NOT NULL,
  `std_cnic` varchar(15) NOT NULL,
  `std_gender` varchar(10) NOT NULL,
  `std_number` varchar(15) NOT NULL,
  `std_email` varchar(50) NOT NULL,
  `status` int(1) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `std_name`, `std_cnic`, `std_gender`, `std_number`, `std_email`, `status`, `teacher_id`) VALUES
(31, 'Usama Javed', '31303-6139547-9', 'male', '03176310603', 'Usama786.sa@gmail.com', 1, 0),
(32, 'Usama', '31303-6139547-9', 'male', '03176310603', 'Usama786.sa@gmail.com', 1, 0),
(33, 'Usama', '31303-6139547-9', 'male', '03176310603', 'Usama786.sa@gmail.com', 1, 0),
(34, 'Usama', '31303-6139547-9', 'female    ', '03176310603777', 'Usama786.sa@gmail.com', 1, 0),
(35, 'Usama', '31303-6139547-9', 'male', '03176310603', 'Usama786.sa@gmail.com', 0, 0),
(36, 'Usama', '31303-6139547-9', 'female    ', '031763106031', 'Usama786.sa@gmail.com', 1, 0),
(37, 'Usama', '31303-6139547-9', 'male', '03176310603', 'Usama786.sa@gmail.com', 1, 0),
(38, 'Usama', 'stdcnic', 'female    ', '0317631060', 'Usama.sa@gmail.com', 1, 0),
(39, 'Usama Javed', '31303-6139547-0', 'male', '03176310603abc', 'Usama@gmail.com', 1, 0),
(40, 'Usama Javed', '31303-6139547-9', 'male', '03176310603', 'Usama786.sa@gmail.com', 1, 0),
(41, 'Usama', '31303-6139547-9', 'male', '03176310603', 'Usama786.sa@gmail.com', 1, 0),
(42, 'saqib', '31303-1782040-9', 'male', '03126232587', 'saqibrehan2007@gmail.com', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `narration` text NOT NULL,
  `debit_account` int(11) NOT NULL,
  `debit_amount` double NOT NULL,
  `credit_account` int(11) NOT NULL,
  `credit_amount` double NOT NULL,
  `remaning_balance` double NOT NULL,
  `date` datetime NOT NULL,
  `ref_no` varchar(50) NOT NULL,
  `created_by` varchar(150) NOT NULL,
  `updated_by` varchar(150) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_id`, `type`, `narration`, `debit_account`, `debit_amount`, `credit_account`, `credit_amount`, `remaning_balance`, `date`, `ref_no`, `created_by`, `updated_by`, `updated_at`) VALUES
(19, 1, 'CP', 'hello', 8, 9000, 9, 0, 12000, '2019-08-23 05:08:20', '10', 'Usama1', 'Usama1', '2019-08-23 05:08:40'),
(20, 2, 'BP', '11', 10, 12, 12, 0, 11, '2019-08-23 05:08:42', '9', 'Usama1', 'Usama1', '2019-08-23 05:08:00'),
(21, 3, 'CP', 'vgggc', 8, 123, 8, 0, 12, '2019-08-24 08:08:27', 'sdf', 'Usama Javed', 'Usama Javed', '2019-08-24 08:08:17');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`, `logo`) VALUES
(9, 'rehan', '22auVqodtTYrr01WyGLLsJSk4q9tSErM', '$2y$13$RkZYc2z0J4rzAhy4TawEp.OEdFNVEmTBPIZ1unmmLOzrCtdlmeTdy', NULL, 'Usama786.sa@gmail.com', 10, 1566578140, 1566578140, 'XB36m5lIZ7ETstUPWACb6PQ6XoRYbZwH_1566578140', 'uploads/UsamaJaved.jpg'),
(10, 'srehan', 'xcmL0jVxVtA8cT77qwBf4MWxw8IHokz1', '$2y$13$JgenoW0HUHUPj0T0lukcqOkcZj8DWaYFTWA/xcGWGMfhQpbC2InRO', NULL, 'saqibrehan2007@gmail.com', 10, 1566629998, 1566629998, 'eVq5HzMON4mNgaOjGK7jM574eeHWzawq_1566629998', '');

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
  ADD KEY `transaction__id` (`transaction__id`),
  ADD KEY `account_receivable` (`account_receivable`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `debit_account` (`debit_account`),
  ADD KEY `credit_account` (`credit_account`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_head`
--
ALTER TABLE `account_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `account_nature`
--
ALTER TABLE `account_nature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `account_payable`
--
ALTER TABLE `account_payable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `account_recievable`
--
ALTER TABLE `account_recievable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  ADD CONSTRAINT `account_payable_ibfk_1` FOREIGN KEY (`account_payable`) REFERENCES `staff` (`id`);

--
-- Constraints for table `account_recievable`
--
ALTER TABLE `account_recievable`
  ADD CONSTRAINT `account_recievable_ibfk_1` FOREIGN KEY (`transaction__id`) REFERENCES `transactions` (`transaction_id`),
  ADD CONSTRAINT `account_recievable_ibfk_2` FOREIGN KEY (`payer_id`) REFERENCES `transactions` (`debit_account`),
  ADD CONSTRAINT `account_recievable_ibfk_3` FOREIGN KEY (`account_receivable`) REFERENCES `student` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`credit_account`) REFERENCES `account_head` (`id`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`debit_account`) REFERENCES `account_head` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
