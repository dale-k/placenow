-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2016 at 04:57 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `placenow`
--

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE IF NOT EXISTS `follows` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `follow_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `chatroom_id` int(11) NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `chatroom_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'asdfasf', '2016-06-29 06:54:13', '2016-06-29 06:54:13'),
(2, 1, 0, 'asdf', '2016-06-29 07:01:25', '2016-06-29 07:01:25'),
(3, 1, 0, 'wewe', '2016-06-29 07:01:27', '2016-06-29 07:01:27'),
(4, 1, 0, '2222', '2016-06-29 07:01:28', '2016-06-29 07:01:28'),
(5, 1, 0, '3333', '2016-06-29 07:01:30', '2016-06-29 07:01:30'),
(6, 1, 0, '', '2016-07-06 04:32:06', '2016-07-06 04:32:06'),
(7, 1, 0, '', '2016-07-06 04:32:08', '2016-07-06 04:32:08'),
(8, 1, 0, '', '2016-07-06 04:32:09', '2016-07-06 04:32:09'),
(9, 1, 0, '', '2016-07-06 04:32:10', '2016-07-06 04:32:10'),
(10, 1, 0, '', '2016-07-06 04:32:10', '2016-07-06 04:32:10'),
(11, 1, 0, '', '2016-07-06 04:32:17', '2016-07-06 04:32:17');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pic_location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vote_count` int(11) NOT NULL,
  `favor_count` int(11) NOT NULL,
  `recommend_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `user_id`, `place_id`, `comment`, `pic_location`, `vote_count`, `favor_count`, `recommend_count`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'asdfwerwer', 'img/ Tucson2016-06-27--12-30-29am.jpg', 0, 0, 1, '2016-06-27 07:30:30', '2016-07-10 05:00:30'),
(2, 1, 2, 'sdfasdf', 'img/Tucson2016-06-28--12-08-51am.jpg', 0, 0, 1, '2016-06-28 07:08:51', '2016-06-29 01:44:41'),
(3, 1, 3, 'aa', 'img/Tucson2016-06-28--01-19-17am.jpg', 0, 0, 0, '2016-06-28 08:19:18', '2016-07-10 04:59:44'),
(4, 1, 4, '', 'img/Tucson2016-06-29--04-54-40am.jpg', 0, 0, 0, '2016-06-29 11:54:42', '2016-06-29 11:54:42'),
(5, 1, 5, '', 'img/Tucson2016-06-29--05-37-38am.jpg', 0, 0, 0, '2016-06-29 12:37:39', '2016-06-29 12:37:39'),
(6, 1, 6, '', 'img/Tucson2016-06-29--05-38-55am.jpg', 0, 0, 0, '2016-06-29 12:38:56', '2016-07-09 12:57:55'),
(7, 1, 7, '', 'img/Tucson2016-06-29--05-41-31am.jpg', 0, 0, 0, '2016-06-29 12:41:32', '2016-07-10 04:59:09');

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE IF NOT EXISTS `places` (
  `id` int(10) unsigned NOT NULL,
  `picture_id` int(11) NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `picture_id`, `location`, `city`, `state`, `country`, `lat`, `lng`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tucson Marriott University Park', 'Tucson', ' AZ 85719', 'USA', 32.231207, -110.9505356, '2016-06-27 07:30:29', '2016-06-27 07:30:30'),
(2, 2, '8599-8375 E Bowline Rd', 'Tucson', ' AZ', ' USA', 32.2051339, -110.81289539999999, '2016-06-28 07:08:51', '2016-06-28 07:08:51'),
(3, 3, '8599-8375 E Bowline Rd', 'Tucson', ' AZ', ' USA', 32.2051433, -110.8129196, '2016-06-28 08:19:18', '2016-06-28 08:19:18'),
(4, 4, 'Tucson', 'Tucson', ' AZ', ' USA', 32.2051418, -110.8129158, '2016-06-29 11:54:42', '2016-06-29 11:54:42'),
(5, 5, 'Tucson', 'Tucson', ' AZ', ' USA', 32.205147499999995, -110.8128608, '2016-06-29 12:37:39', '2016-06-29 12:37:39'),
(6, 6, 'Tucson', 'Tucson', ' AZ', ' USA', 32.205126899999996, -110.81285940000001, '2016-06-29 12:38:55', '2016-06-29 12:38:56'),
(7, 7, 'Tucson', 'Tucson', ' AZ', ' USA', 32.2051154, -110.81284509999999, '2016-06-29 12:41:32', '2016-06-29 12:41:32');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE IF NOT EXISTS `positions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` char(255) NOT NULL,
  `city` char(255) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `user_id`, `action`, `city`, `lat`, `lng`, `created_at`, `updated_at`) VALUES
(1, 0, 'login', 'Tucson', 32.230522, -110.94860419999999, '2016-07-11 12:24:23', '2016-07-11 12:24:23'),
(2, 1, 'login', 'Tucson', 32.2051836, -110.81280389999999, '2016-07-12 13:48:05', '2016-07-12 13:48:05'),
(3, 1, 'login', 'AHSC', 32.2398878, -110.9469979, '2016-07-13 06:33:47', '2016-07-13 06:33:47');

-- --------------------------------------------------------

--
-- Table structure for table `social_accounts`
--

CREATE TABLE IF NOT EXISTS `social_accounts` (
  `user_id` int(11) NOT NULL,
  `provider_user_id` varchar(255) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider_user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user`, `provider_user_id`, `provider`, `password`, `email`, `telephone`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Dale Kim', '', '', '$2y$10$Nu3EDDI04sEa14xzMEjqU.VUDv4ODl23PpRKOMOUfyl9smzPu2ulO', 'daeilk811@gmail.com', 0, 'dGWv9hglZGFaB3tHgpASHROjHZLcNel45f55mLCogEwNS8ebWYPZx9UZOLlD', '2016-06-27 07:30:17', '2016-07-13 07:11:51');

-- --------------------------------------------------------

--
-- Table structure for table `votehistories`
--

CREATE TABLE IF NOT EXISTS `votehistories` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `picture_id` int(11) NOT NULL,
  `voted` tinyint(4) NOT NULL,
  `favored` tinyint(4) NOT NULL,
  `recommended` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votehistories`
--
ALTER TABLE `votehistories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `votehistories`
--
ALTER TABLE `votehistories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
