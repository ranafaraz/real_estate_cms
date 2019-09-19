-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2019 at 07:55 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
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

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
