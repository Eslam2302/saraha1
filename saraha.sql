-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2022 at 08:11 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saraha`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `title`, `message`) VALUES
(1, 'eslam', 'eslam@gmail.com', 'eslam', 'dfsafes'),
(2, 'mohamed', 'ahmed@gmail.com', 'asdasd', 'dasdasd');

-- --------------------------------------------------------

--
-- Table structure for table `login_token`
--

CREATE TABLE `login_token` (
  `id` int(11) NOT NULL,
  `token` char(64) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_token`
--

INSERT INTO `login_token` (`id`, `token`, `user_id`) VALUES
(31, '8a17f73199239c56782dc1b0bd15e25fc1e72b3d', 1),
(34, '8bc4fbca003ae2dc9ed116995d2cae61bd663db1', 3),
(43, '6d0f1ad0230a2beb7aed4dbda575c59cc7bc7af1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `body` varchar(255) NOT NULL,
  `senter` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `body`, `senter`, `receiver`, `date`) VALUES
(1, 'adfasdfa', 2, 2, '2022-01-18 14:18:24'),
(2, 'asdasdfadsf', 2, 2, '2022-01-18 14:18:24'),
(3, 'eslam eslam\r\n', 1, 2, '2022-01-18 14:18:24'),
(4, 'asdfasdf', 2, 2, '2022-01-18 14:18:24'),
(5, 'fsadfasdf', 2, 2, '2022-01-18 14:18:24'),
(6, 'fasdfasdfasdf', 2, 2, '2022-01-18 14:18:24'),
(7, 'asdasdasfasdf', 2, 1, '2022-01-18 14:18:24'),
(8, 'dsafasdf', 2, 1, '2022-01-18 14:18:24'),
(9, 'dsafasdf', 2, 1, '2022-01-18 14:18:24'),
(10, 'adsfasdf', 2, 1, '2022-01-18 14:18:24'),
(11, '55151', 4, 4, '2022-01-18 14:31:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `group_id` tinyint(4) NOT NULL DEFAULT 0,
  `user_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `user_password`, `user_email`, `reg_date`, `group_id`, `user_img`) VALUES
(1, 'eslam', '$2y$10$eR21ceP5yALtpt7T4jLvouqnQlC4mlipqS/69R4JXoElydzyk965K', 'eslam@gmail.com', '2022-01-03 17:44:45', 0, '61e5f76fc77d83.23191094.png'),
(2, 'ahmed', '$2y$10$1gD8vM9CFqFbHa655eR9bek2w7cSakDsGKJTW6Kt4OOEWuo3gh8ly', 'ahmed@gmail.com', '2022-01-03 21:23:08', 0, '61e5ff2fc6c9e8.97866735.png'),
(3, 'mohamed ahmed', '$2y$10$9jmbVQctq8nFwmcAACmZIuDzdhs8qHGcG6DU4hEFXef6ekzNW.BAK', 'ahmed@gmail.com', '2022-01-13 16:54:13', 0, NULL),
(4, 'eslam eslam', '$2y$10$ybhpvcQafDfw3ZQlVY64muf1fCD.KrR3I6kZg09DvorEKG83ahWeK', '', '2022-01-13 22:36:30', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_token`
--
ALTER TABLE `login_token`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
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
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login_token`
--
ALTER TABLE `login_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login_token`
--
ALTER TABLE `login_token`
  ADD CONSTRAINT `login_token_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
