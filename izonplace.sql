-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Aug 15, 2016 at 05:41 PM
-- Server version: 5.6.26-cll-lve
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `izonplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `ask`
--

CREATE TABLE IF NOT EXISTS `ask` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `city` varchar(30) NOT NULL,
  `place` varchar(30) NOT NULL,
  `question` varchar(255) NOT NULL,
  `num_answer` int(11) NOT NULL,
  `view` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `chatrooms`
--

CREATE TABLE IF NOT EXISTS `chatrooms` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `place_id` varchar(30) NOT NULL,
  `related_id` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(255) NOT NULL,
  `post_count` int(11) NOT NULL,
  `follow_count` int(11) NOT NULL,
  `view_count` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city`, `post_count`, `follow_count`, `view_count`, `created_at`, `updated_at`) VALUES
(1, 'Tucson', 20, 1, 0, '2016-08-13 18:08:07', '2016-08-14 01:08:07');

-- --------------------------------------------------------

--
-- Table structure for table `city_follows`
--

CREATE TABLE IF NOT EXISTS `city_follows` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `city_follows`
--

INSERT INTO `city_follows` (`id`, `user_id`, `city_id`, `created_at`, `updated_at`) VALUES
(2, 3, 1, '2016-08-14 01:08:07', '2016-08-14 01:08:07');

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE IF NOT EXISTS `follows` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `follow_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `chatroom_id` int(11) NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE IF NOT EXISTS `places` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `gplace_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `post_count` int(50) NOT NULL,
  `follow_count` int(255) NOT NULL,
  `view_count` int(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `location`, `city`, `state`, `country`, `lat`, `lng`, `gplace_id`, `post_count`, `follow_count`, `view_count`, `created_at`, `updated_at`) VALUES
(1, 'Toumey Park', 'Tucson', 'Arizona', 'United States', 32.2109725, -110.8964575, 'ChIJScdv0OZv1oYRNpmZ6w09YCo', 0, 0, 0, '2016-08-12 11:58:26', '2016-08-12 11:58:26'),
(2, 'Century 20 El Con And XD', 'Tucson', 'Arizona', 'United States', 32.2248408, -110.91635070000001, 'ChIJq9XLtzFw1oYRelV0IJ2xfrI', 1, 0, 0, '2016-08-12 12:14:04', '2016-08-12 12:24:15'),
(3, 'Reid Park Zoo', 'Tucson', 'Arizona', 'United States', 32.20879300000001, -110.921377, 'ChIJt2VpaRZw1oYR_KrGfRmc7Z8', 2, 0, 0, '2016-08-13 06:47:06', '2016-08-13 06:49:59'),
(4, 'Reid Park', 'Tucson', 'Arizona', 'United States', 32.21066950000001, -110.9223073, 'ChIJDcw4Fj5w1oYRMvfm2arZMic', 2, 0, 0, '2016-08-13 06:52:35', '2016-08-13 06:54:53'),
(5, 'Science - Engineering Library', 'Tucson', 'Arizona', 'United States', 32.2311872, -110.95064869999999, 'ChIJcRwuCKpx1oYR9m8xaRsguRo', 1, 0, 0, '2016-08-13 07:12:39', '2016-08-13 07:14:39'),
(6, 'The University of Arizona', 'Tucson', 'Arizona', 'United States', 32.2318851, -110.95010939999997, 'ChIJTZpd7qpx1oYRZs9AZMBoWIw', 1, 0, 0, '2016-08-13 07:16:21', '2016-08-13 07:17:51'),
(7, 'Arizona Student Unions', 'Tucson', 'Arizona', 'United States', 32.232604, -110.9520976, 'ChIJNYyeFAZx1oYRD8Lkg0NVNJs', 4, 0, 0, '2016-08-13 07:22:33', '2016-08-13 07:29:08'),
(8, 'Animal Kingdom', 'Tucson', 'Arizona', 'United States', 32.289044, -110.97576300000003, 'ChIJ5TR-Sr5z1oYR8tXolzrWG2U', 0, 0, 0, '2016-08-13 08:06:37', '2016-08-13 08:06:37'),
(9, 'Diamond Wireless, Verizon Wireless Premium Retailer', 'Tucson', 'Arizona', 'United States', 32.288728, -110.97393, 'ChIJ30Kp579z1oYR57n8jLg1soo', 0, 0, 0, '2016-08-13 08:09:46', '2016-08-13 08:09:46');

-- --------------------------------------------------------

--
-- Table structure for table `place_follows`
--

CREATE TABLE IF NOT EXISTS `place_follows` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE IF NOT EXISTS `positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `action` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `lat`, `lng`, `action`, `city`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 0, 0, 'login', '', 1, '2016-08-12 09:41:20', '2016-08-12 09:41:20'),
(2, 0, 0, 'login', '', 3, '2016-08-12 11:46:13', '2016-08-12 11:46:13'),
(3, 0, 0, 'login', '', 4, '2016-08-12 11:46:43', '2016-08-12 11:46:43'),
(4, 32.226463, -110.9147122, 'login', 'Tucson', 1, '2016-08-12 12:20:27', '2016-08-12 12:20:27'),
(5, 32.215029, -110.9008207, 'login', 'Tucson', 1, '2016-08-12 15:05:59', '2016-08-12 15:05:59'),
(6, 32.2051236, -110.8128703, 'login', 'Tucson', 1, '2016-08-13 05:07:55', '2016-08-13 05:07:55'),
(7, 0, 0, 'login', '', 3, '2016-08-13 06:12:08', '2016-08-13 06:12:08'),
(8, 0, 0, 'login', '', 3, '2016-08-13 06:29:40', '2016-08-13 06:29:40'),
(9, 32.2099484, -110.9203471, 'login', 'Tucson', 4, '2016-08-13 06:45:39', '2016-08-13 06:45:39'),
(10, 0, 0, 'login', '', 1, '2016-08-13 17:29:56', '2016-08-13 17:29:56'),
(11, 32.2051236, -110.8128703, 'login', 'Tucson', 1, '2016-08-14 00:00:03', '2016-08-14 00:00:03'),
(12, 0, 0, 'login', '', 3, '2016-08-14 01:07:57', '2016-08-14 01:07:57'),
(13, 32.2120209, -110.8979942, 'login', 'Tucson', 4, '2016-08-14 01:11:10', '2016-08-14 01:11:10'),
(14, 0, 0, 'login', '', 1, '2016-08-14 03:06:14', '2016-08-14 03:06:14'),
(15, 32.2119891, -110.8980672, 'login', 'Tucson', 3, '2016-08-14 03:09:25', '2016-08-14 03:09:25'),
(16, 0, 0, 'login', '', 3, '2016-08-14 07:02:04', '2016-08-14 07:02:04'),
(17, 0, 0, 'login', '', 1, '2016-08-14 12:53:47', '2016-08-14 12:53:47'),
(18, 0, 0, 'login', '', 3, '2016-08-15 01:07:48', '2016-08-15 01:07:48'),
(19, 32.20512, -110.8128773, 'login', 'Tucson', 1, '2016-08-16 03:25:14', '2016-08-16 03:25:14'),
(20, 32.2051231, -110.8129148, 'login', 'Tucson', 1, '2016-08-16 06:22:28', '2016-08-16 06:22:28');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pic_location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vote_count` int(11) NOT NULL,
  `favor_count` int(11) NOT NULL,
  `recommend_count` int(11) NOT NULL,
  `view_count` int(11) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `private` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `place_id`, `comment`, `pic_location`, `vote_count`, `favor_count`, `recommend_count`, `view_count`, `lat`, `lng`, `created_at`, `updated_at`, `title`, `private`, `photo`) VALUES
(1, 4, 1, '', 'img/Tucson2016-08-12--04-58-24am.jpg', 0, 0, 0, 1, 32.2120209, -110.8979942, '2016-08-12 11:58:26', '2016-08-12 11:58:29', '', '', ''),
(2, 4, 2, '', 'img/Tucson2016-08-12--05-14-01am.jpg', 0, 0, 0, 1, 32.2249122, -110.9168633, '2016-08-12 12:14:04', '2016-08-12 12:14:12', 'suicide squad', '', ''),
(3, 1, 2, 'Night 10:22 P.M.  Finally came to see suicidesquad. Hope that it is worth to watch. ', 'img/Tucson2016-08-12--05-24-14am.jpg', 0, 0, 0, 3, 32.2234048, -110.9164602, '2016-08-12 12:24:15', '2016-08-13 06:29:40', '', '', ''),
(4, 4, 3, 'Park is closed ', 'img/Tucson2016-08-12--11-47-03pm.jpg', 0, 0, 0, 3, 32.2099141, -110.9203005, '2016-08-13 06:47:06', '2016-08-14 00:02:36', 'Reid Park', '', ''),
(5, 1, 3, 'Reid zoo is closed', 'img/Tucson2016-08-12--11-47-49pm.jpg', 0, 0, 0, 0, 32.2099484, -110.9203471, '2016-08-13 06:47:50', '2016-08-13 06:47:50', '', '', ''),
(6, 1, 3, '', 'img/Tucson2016-08-12--11-49-57pm.jpg', 0, 0, 0, 2, 32.2099003, -110.9206265, '2016-08-13 06:49:59', '2016-08-14 00:02:16', '', '', ''),
(7, 1, 4, 'I see people walkimg around to catch poketmon.', 'img/Tucson2016-08-12--11-52-34pm.jpg', 0, 0, 0, 0, 32.209717, -110.9209524, '2016-08-13 06:52:35', '2016-08-13 06:52:35', '', '', ''),
(8, 4, 4, 'So hot , but the view is good', 'img/Tucson2016-08-12--11-53-41pm.jpg', 0, 0, 0, 2, 32.2103423, -110.9206646, '2016-08-13 06:53:42', '2016-08-14 00:02:09', 'park lake', '', ''),
(9, 1, 4, '', 'img/Tucson2016-08-12--11-54-50pm.jpg', 0, 0, 0, 1, 32.210029, -110.9206147, '2016-08-13 06:54:53', '2016-08-14 00:02:04', '', '', ''),
(10, 4, 5, 'Friday night', 'img/Tucson2016-08-13--12-12-39am.jpg', 0, 0, 0, 1, 32.2305731, -110.9505239, '2016-08-13 07:12:39', '2016-08-14 00:02:54', 'Science Library', '', ''),
(11, 1, 5, 'This library where I and ritchie spend time here to develop this website.', 'img/Tucson2016-08-13--12-14-37am.jpg', 0, 0, 0, 0, 32.2310168, -110.9508964, '2016-08-13 07:14:39', '2016-08-13 07:14:39', '', '', ''),
(12, 1, 6, '', 'img/Tucson2016-08-13--12-16-20am.jpg', 0, 0, 0, 0, 32.2309664, -110.950943, '2016-08-13 07:16:21', '2016-08-13 07:16:21', '', '', ''),
(13, 4, 6, 'Jogging in school', 'img/Tucson2016-08-13--12-17-50am.jpg', 0, 0, 0, 0, 32.2315816, -110.9515484, '2016-08-13 07:17:51', '2016-08-13 07:17:51', 'uofa', '', ''),
(14, 4, 7, '', 'img/Tucson2016-08-13--12-22-32am.jpg', 0, 0, 0, 0, 32.2322836, -110.9523866, '2016-08-13 07:22:33', '2016-08-13 07:22:33', '', '', ''),
(15, 1, 7, '', 'img/Tucson2016-08-13--12-24-10am.jpg', 0, 0, 0, 0, 32.2323158, -110.9522004, '2016-08-13 07:24:12', '2016-08-13 07:24:12', '', '', ''),
(16, 4, 7, 'School is about to start ', 'img/Tucson2016-08-13--12-27-40am.jpg', 0, 0, 0, 0, 32.2325495, -110.9518278, '2016-08-13 07:27:41', '2016-08-13 07:27:41', 'Student Union', '', ''),
(17, 1, 7, '', 'img/Tucson2016-08-13--12-28-23am.jpg', 0, 0, 0, 2, 32.2328518, -110.9515484, '2016-08-13 07:28:25', '2016-08-14 01:19:03', '', '', ''),
(18, 4, 7, 'Hours for student union', 'img/Tucson2016-08-13--12-29-08am.jpg', 0, 0, 0, 2, 32.2328518, -110.9515484, '2016-08-13 07:29:08', '2016-08-14 01:12:36', '', '', ''),
(19, 4, 8, 'Tucson', 'img/Tucson2016-08-13--01-06-36am.jpg', 0, 0, 0, 0, 32.2891912, -110.9757648, '2016-08-13 08:06:37', '2016-08-13 08:06:37', 'Pets', '', ''),
(20, 1, 9, '', 'img/Tucson2016-08-13--01-09-44am.jpg', 0, 0, 0, 2, 32.2892073, -110.9756716, '2016-08-13 08:09:46', '2016-08-14 01:08:11', '', '', '');

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
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `post_id`, `type`, `created_at`, `updated_at`) VALUES
(1, 2, 'movie', '2016-08-12 12:14:04', '2016-08-12 12:14:04'),
(2, 2, 'sucidesquad', '2016-08-12 12:14:04', '2016-08-12 12:14:04'),
(3, 3, 'suicidesquad', '2016-08-12 12:24:15', '2016-08-12 12:24:15'),
(4, 3, 'movie', '2016-08-12 12:24:15', '2016-08-12 12:24:15'),
(5, 3, 'elconmall', '2016-08-12 12:24:15', '2016-08-12 12:24:15'),
(6, 3, 'tucson', '2016-08-12 12:24:15', '2016-08-12 12:24:15'),
(7, 4, 'zoo', '2016-08-13 06:47:06', '2016-08-13 06:47:06'),
(8, 4, 'reidpark', '2016-08-13 06:47:06', '2016-08-13 06:47:06'),
(9, 5, 'tucson', '2016-08-13 06:47:50', '2016-08-13 06:47:50'),
(10, 5, 'reidzoo', '2016-08-13 06:47:50', '2016-08-13 06:47:50'),
(11, 5, 'zoo', '2016-08-13 06:47:50', '2016-08-13 06:47:50'),
(12, 8, 'zoo', '2016-08-13 06:53:42', '2016-08-13 06:53:42'),
(13, 8, 'reidpark', '2016-08-13 06:53:42', '2016-08-13 06:53:42'),
(14, 8, 'lake', '2016-08-13 06:53:42', '2016-08-13 06:53:42'),
(15, 9, 'dirtytucson', '2016-08-13 06:54:53', '2016-08-13 06:54:53'),
(16, 10, 'summer', '2016-08-13 07:12:39', '2016-08-13 07:12:39'),
(17, 10, 'library', '2016-08-13 07:12:39', '2016-08-13 07:12:39'),
(18, 10, 'uofa', '2016-08-13 07:12:39', '2016-08-13 07:12:39'),
(19, 11, 'tucson', '2016-08-13 07:14:39', '2016-08-13 07:14:39'),
(20, 11, 'uofa', '2016-08-13 07:14:39', '2016-08-13 07:14:39'),
(21, 11, 'uofalibrary', '2016-08-13 07:14:39', '2016-08-13 07:14:39'),
(22, 13, 'summer', '2016-08-13 07:17:51', '2016-08-13 07:17:51'),
(23, 13, 'uofa', '2016-08-13 07:17:51', '2016-08-13 07:17:51'),
(24, 16, 'uofa', '2016-08-13 07:27:41', '2016-08-13 07:27:41'),
(25, 16, 'studentunion', '2016-08-13 07:27:41', '2016-08-13 07:27:41'),
(26, 17, 'studentunion', '2016-08-13 07:28:25', '2016-08-13 07:28:25'),
(27, 17, 'map', '2016-08-13 07:28:25', '2016-08-13 07:28:25'),
(28, 18, 'uofa', '2016-08-13 07:29:08', '2016-08-13 07:29:08'),
(29, 18, 'studentunion', '2016-08-13 07:29:08', '2016-08-13 07:29:08'),
(30, 18, 'hours', '2016-08-13 07:29:08', '2016-08-13 07:29:08'),
(31, 19, 'pet', '2016-08-13 08:06:37', '2016-08-13 08:06:37'),
(32, 19, 'tucson-mall', '2016-08-13 08:06:37', '2016-08-13 08:06:37');

-- --------------------------------------------------------

--
-- Table structure for table `userinrooms`
--

CREATE TABLE IF NOT EXISTS `userinrooms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `chatroom_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` int(11) NOT NULL,
  `following_count` int(255) NOT NULL,
  `follower_count` int(255) NOT NULL,
  `user_img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user`, `password`, `email`, `telephone`, `following_count`, `follower_count`, `user_img`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'dale kim', '$2y$10$w6CnhIQEkXJSggc5tCOjWuHWIPXtRGeZNzWLLCeFmlIjspVF67cHq', 'daeilk811@gmail.com', 0, 0, 0, '', '2VByKAG9WnPFCKf11jeYxrHbSPKTNGB5f4WlgPLdeUFwW262yCQNaPYBZb55', '2016-08-12 05:46:28', '2016-08-12 09:41:13'),
(3, 'Ritchie', '$2y$10$Td90bFNWlvtOF26gsIvq.e3OLD34jEWppebTl8hcYSk5Sn3pMpbR2', 'ritchie75ed@gmail.com', 0, 0, 0, '', '7ShQGChqLbYJz7wLPYdKpyNSk3TXEwJfPOOz3k4gb1hfcoJLyH7MSsFt4JIs', '2016-08-12 05:56:50', '2016-08-13 06:13:38'),
(4, 'ritchie', '$2y$10$ODtIVjMh.r34m8EZH/vMfOCz3zv69IyT5alInWG3MXH30SKVAGG6.', 'ritchie75@gmail.com', 0, 0, 0, '', NULL, '2016-08-12 06:34:58', '2016-08-12 06:34:58');

-- --------------------------------------------------------

--
-- Table structure for table `votehistories`
--

CREATE TABLE IF NOT EXISTS `votehistories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `picture_id` int(11) NOT NULL,
  `voted` tinyint(1) NOT NULL,
  `favored` tinyint(1) NOT NULL,
  `recommended` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=51 ;

--
-- Dumping data for table `votehistories`
--

INSERT INTO `votehistories` (`id`, `user_id`, `picture_id`, `voted`, `favored`, `recommended`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 0, 0, 0, '2016-08-12 11:58:26', '2016-08-12 11:58:26'),
(2, 4, 2, 0, 0, 0, '2016-08-12 12:14:04', '2016-08-12 12:14:04'),
(3, 1, 3, 0, 0, 0, '2016-08-12 12:24:15', '2016-08-12 12:24:15'),
(4, 1, 1, 0, 0, 0, '2016-08-12 12:24:33', '2016-08-12 12:24:33'),
(5, 1, 2, 0, 0, 0, '2016-08-12 12:24:33', '2016-08-12 12:24:33'),
(6, 3, 3, 0, 0, 0, '2016-08-13 06:29:40', '2016-08-13 06:29:40'),
(7, 3, 1, 0, 0, 0, '2016-08-13 06:29:40', '2016-08-13 06:29:40'),
(8, 3, 2, 0, 0, 0, '2016-08-13 06:29:40', '2016-08-13 06:29:40'),
(9, 4, 4, 0, 0, 0, '2016-08-13 06:47:06', '2016-08-13 06:47:06'),
(10, 4, 3, 0, 0, 0, '2016-08-13 06:47:12', '2016-08-13 06:47:12'),
(11, 1, 5, 0, 0, 0, '2016-08-13 06:47:50', '2016-08-13 06:47:50'),
(12, 1, 6, 0, 0, 0, '2016-08-13 06:49:59', '2016-08-13 06:49:59'),
(13, 1, 4, 0, 0, 0, '2016-08-13 06:50:20', '2016-08-13 06:50:20'),
(14, 1, 7, 0, 0, 0, '2016-08-13 06:52:35', '2016-08-13 06:52:35'),
(15, 4, 8, 0, 0, 0, '2016-08-13 06:53:42', '2016-08-13 06:53:42'),
(16, 1, 9, 0, 0, 0, '2016-08-13 06:54:53', '2016-08-13 06:54:53'),
(17, 1, 8, 0, 0, 0, '2016-08-13 06:59:01', '2016-08-13 06:59:01'),
(18, 4, 10, 0, 0, 0, '2016-08-13 07:12:39', '2016-08-13 07:12:39'),
(19, 4, 5, 0, 0, 0, '2016-08-13 07:13:01', '2016-08-13 07:13:01'),
(20, 4, 6, 0, 0, 0, '2016-08-13 07:13:01', '2016-08-13 07:13:01'),
(21, 4, 7, 0, 0, 0, '2016-08-13 07:13:01', '2016-08-13 07:13:01'),
(22, 4, 9, 0, 0, 0, '2016-08-13 07:13:01', '2016-08-13 07:13:01'),
(23, 1, 11, 0, 0, 0, '2016-08-13 07:14:39', '2016-08-13 07:14:39'),
(24, 1, 12, 0, 0, 0, '2016-08-13 07:16:21', '2016-08-13 07:16:21'),
(25, 4, 13, 0, 0, 0, '2016-08-13 07:17:51', '2016-08-13 07:17:51'),
(26, 4, 14, 0, 0, 0, '2016-08-13 07:22:33', '2016-08-13 07:22:33'),
(27, 1, 15, 0, 0, 0, '2016-08-13 07:24:12', '2016-08-13 07:24:12'),
(28, 4, 16, 0, 0, 0, '2016-08-13 07:27:41', '2016-08-13 07:27:41'),
(29, 1, 17, 0, 0, 0, '2016-08-13 07:28:25', '2016-08-13 07:28:25'),
(30, 1, 13, 0, 0, 0, '2016-08-13 07:28:34', '2016-08-13 07:28:34'),
(31, 1, 14, 0, 0, 0, '2016-08-13 07:28:34', '2016-08-13 07:28:34'),
(32, 1, 16, 0, 0, 0, '2016-08-13 07:28:34', '2016-08-13 07:28:34'),
(33, 4, 18, 0, 0, 0, '2016-08-13 07:29:08', '2016-08-13 07:29:08'),
(34, 4, 19, 0, 0, 0, '2016-08-13 08:06:37', '2016-08-13 08:06:37'),
(35, 1, 20, 0, 0, 0, '2016-08-13 08:09:46', '2016-08-13 08:09:46'),
(36, 1, 18, 0, 0, 0, '2016-08-13 09:39:26', '2016-08-13 09:39:26'),
(37, 1, 19, 0, 0, 0, '2016-08-13 09:39:26', '2016-08-13 09:39:26'),
(38, 1, 10, 0, 0, 0, '2016-08-14 00:02:04', '2016-08-14 00:02:04'),
(39, 3, 20, 0, 0, 0, '2016-08-14 01:08:11', '2016-08-14 01:08:11'),
(40, 3, 15, 0, 0, 0, '2016-08-14 01:08:11', '2016-08-14 01:08:11'),
(41, 3, 16, 0, 0, 0, '2016-08-14 01:08:11', '2016-08-14 01:08:11'),
(42, 3, 17, 0, 0, 0, '2016-08-14 01:08:11', '2016-08-14 01:08:11'),
(43, 3, 18, 0, 0, 0, '2016-08-14 01:08:11', '2016-08-14 01:08:11'),
(44, 3, 19, 0, 0, 0, '2016-08-14 01:08:11', '2016-08-14 01:08:11'),
(45, 3, 13, 0, 0, 0, '2016-08-14 01:08:42', '2016-08-14 01:08:42'),
(46, 3, 14, 0, 0, 0, '2016-08-14 01:08:42', '2016-08-14 01:08:42'),
(47, 4, 15, 0, 0, 0, '2016-08-14 01:12:36', '2016-08-14 01:12:36'),
(48, 4, 17, 0, 0, 0, '2016-08-14 01:12:36', '2016-08-14 01:12:36'),
(49, 4, 20, 0, 0, 0, '2016-08-14 01:12:36', '2016-08-14 01:12:36'),
(50, 4, 12, 0, 0, 0, '2016-08-14 01:19:03', '2016-08-14 01:19:03');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
