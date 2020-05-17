-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2020 at 01:19 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hablu_mail`
--

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE `mail` (
  `id` int(10) NOT NULL,
  `sender_id` int(10) NOT NULL,
  `reciver_id` int(10) NOT NULL,
  `sender_mail` varchar(50) NOT NULL,
  `reciver_mail` varchar(50) NOT NULL,
  `mail_subject` varchar(200) NOT NULL,
  `mail_content` longtext NOT NULL,
  `mail_date` varchar(20) NOT NULL,
  `mail_time` varchar(20) NOT NULL,
  `mail_status` varchar(50) NOT NULL,
  `mail_seen` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mail`
--

INSERT INTO `mail` (`id`, `sender_id`, `reciver_id`, `sender_mail`, `reciver_mail`, `mail_subject`, `mail_content`, `mail_date`, `mail_time`, `mail_status`, `mail_seen`) VALUES
(4, 1, 1, 'tarik@hablumail.com', 'tarik@hablumail.com', 'just test mail', 'qqqq', '05-05-2020', '04:43:06', 'trash', 'seen'),
(5, 1, 1, 'tarik@hablumail.com', 'tarik@hablumail.com', 'it is my second message', 'hello mr/', '05-05-2020', '04:55:35', 'inbox', 'seen'),
(6, 1, 2, 'tarik@hablumail.com', 'hablu@hublumail.com', 'need to online metting very early', 'hello........', '05-05-2020', '04:57:19', 'inbox', 'seen'),
(7, 1, 2, 'tarik@hablumail.com', 'hablu@hablumail.com', 'welcome', 'hello hablu...', '07-05-2020', '03:34:05', 'deleted', 'seen'),
(8, 1, 2, 'tarik@hablumail.com', 'hablu@hablumail.com', 'hello tarik!', ' hello ....', '17-05-2020', '04:12:20', 'inbox', 'seen'),
(9, 2, 0, '', 'tarik@gmail.com', 'just test mail', 'hello', '10-05-2020', '05:27:05', 'draft', ''),
(10, 1, 0, '', 'tarik@hablumail.com', 'just test mail', ' hello', '16-05-2020', '04:45:58', 'draft', ''),
(11, 2, 1, 'hablu@hablumail.com', 'tarik@hablumail.com', 'need to online metting very early', ' need to online metting very earlyneed to online metting very earlyneed to online metting very earlyneed to online metting very earlyneed to online metting very early', '17-05-2020', '05:02:51', 'inbox', 'seen'),
(12, 1, 1, 'tarik@hablumail.com', 'tarik@hablumail.com', 'spam test', ' hi', '17-05-2020', '05:13:42', 'inbox', 'seen');

-- --------------------------------------------------------

--
-- Table structure for table `mail_replay`
--

CREATE TABLE `mail_replay` (
  `id` int(10) NOT NULL,
  `mail_id` int(10) NOT NULL,
  `mail_subject` varchar(200) NOT NULL,
  `mail_content` longtext NOT NULL,
  `mail_date` varchar(20) NOT NULL,
  `mail_time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `memberID` int(11) NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `address` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  `gender` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `profile_pic_url` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `active` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `resetToken` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `resetComplete` varchar(3) COLLATE utf8mb4_bin DEFAULT 'No'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`memberID`, `first_name`, `last_name`, `username`, `password`, `email`, `address`, `gender`, `profile_pic_url`, `active`, `resetToken`, `resetComplete`) VALUES
(1, 'Tarik', 'Billa', 'tarik', '$2y$10$1JlX1HHfmmuy6y6mVgurCu6LlD1mD8xZo663HWPLRAVneKgwA0JZK', 'tarik@hablumail.com', 'Jessore', 'Male', 'tarik.png', 'Yes', NULL, 'No'),
(2, 'Mr.', 'Hablu', 'hablu', '$2y$10$S9rSqQbLXfoNiW1PXeNoY.cZQqcph53jhErQcebhceankGgtgyE2m', 'hablu@hablumail.com', '', '', 'hablu.png', 'Yes', NULL, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `spam_list`
--

CREATE TABLE `spam_list` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `spam_user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `spam_list`
--

INSERT INTO `spam_list` (`id`, `user_id`, `spam_user_id`) VALUES
(1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_replay`
--
ALTER TABLE `mail_replay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`memberID`);

--
-- Indexes for table `spam_list`
--
ALTER TABLE `spam_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mail_replay`
--
ALTER TABLE `mail_replay`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `memberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `spam_list`
--
ALTER TABLE `spam_list`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
