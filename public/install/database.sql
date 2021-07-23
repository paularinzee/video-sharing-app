-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 25, 2020 at 06:19 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vtube`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Music', 'music', '2017-06-30 10:24:35', '2017-06-30 10:24:35'),
(2, 'Sports', 'sports', '2017-06-30 10:24:35', '2017-06-30 10:24:35'),
(3, 'Gaming', 'gaming', '2017-06-30 10:25:08', '2017-06-30 10:25:08'),
(4, 'Movies', 'movies', '2017-06-30 10:25:08', '2017-06-30 10:25:08'),
(5, 'TV Shows', 'tv-shows', '2017-06-30 10:25:37', '2017-06-30 10:25:37'),
(6, 'News', 'news', '2017-06-30 10:25:37', '2017-06-30 10:25:37'),
(8, 'Entertainment', 'entertainment', '2018-08-22 07:55:38', '2018-08-22 07:55:38');

-- --------------------------------------------------------

--
-- Table structure for table `laravellikecomment_comments`
--

DROP TABLE IF EXISTS `laravellikecomment_comments`;
CREATE TABLE IF NOT EXISTS `laravellikecomment_comments` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `item_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laravellikecomment_likes`
--

DROP TABLE IF EXISTS `laravellikecomment_likes`;
CREATE TABLE IF NOT EXISTS `laravellikecomment_likes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vote` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laravellikecomment_total_likes`
--

DROP TABLE IF EXISTS `laravellikecomment_total_likes`;
CREATE TABLE IF NOT EXISTS `laravellikecomment_total_likes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `item_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_like` int(11) NOT NULL,
  `total_dislike` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_01_04_173148_create_admin_tables', 2),
('2016_08_17_203844_create_laravellikecommet_comments_table', 3),
('2016_08_18_152344_create_laravellikecomment_total_likes_table', 3),
('2016_08_18_152401_create_laravellikecomment_likes_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` mediumtext COLLATE utf8_unicode_ci,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `active`, `created_at`, `updated_at`) VALUES
(1, 'About Us', 'about', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n&lt;br&gt;&lt;/div&gt;', 1, '2018-06-20 08:46:27', '2018-07-13 02:14:51'),
(2, 'Privacy Policy', 'privacy-policy', 'Privacy page content. You can edit this from admin panel.&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n&lt;/div&gt;\r\n\r\n&lt;br&gt;&lt;/div&gt;&lt;div&gt;\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n&lt;/div&gt;\r\n\r\n&lt;br&gt;&lt;/div&gt;&lt;div&gt;\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n&lt;/div&gt;\r\n\r\n&lt;br&gt;&lt;/div&gt;&lt;div&gt;\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n&lt;/div&gt;\r\n\r\n&lt;br&gt;&lt;/div&gt;&lt;div&gt;\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n&lt;/div&gt;\r\n\r\n&lt;br&gt;&lt;/div&gt;&lt;div&gt;\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n&lt;/div&gt;\r\n\r\n&lt;br&gt;&lt;/div&gt;', 1, '2018-06-20 08:46:27', '2018-07-13 02:16:20'),
(3, 'Terms & Condition', 'terms-condition', 'Terms &amp;amp; Condition Page. You can edit this from admin panel.&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n&lt;/div&gt;\r\n\r\n&lt;br&gt;&lt;/div&gt;&lt;div&gt;\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n&lt;/div&gt;\r\n\r\n&lt;br&gt;&lt;/div&gt;&lt;div&gt;\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n&lt;/div&gt;\r\n\r\n\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n&lt;/div&gt;\r\n\r\n&lt;br&gt;&lt;/div&gt;&lt;div&gt;\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n&lt;/div&gt;\r\n\r\n&lt;br&gt;&lt;/div&gt;&lt;div&gt;\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n\r\n\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Libero justo laoreet sit amet cursus sit amet dictum sit. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec\r\n&lt;/div&gt;\r\n\r\n&lt;br&gt;&lt;/div&gt;', 1, '2018-06-20 09:16:47', '2018-07-13 02:16:29');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reported_videos`
--

DROP TABLE IF EXISTS `reported_videos`;
CREATE TABLE IF NOT EXISTS `reported_videos` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `video_id` int(11) NOT NULL,
  `video_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `option`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'VTube', '2017-03-08 07:10:06', '2020-07-25 12:34:47'),
(2, 'site_email', 'admin@example.com', '2017-03-08 07:10:06', '2020-07-25 12:34:47'),
(3, 'meta_description', 'VTube is a video hosting & sharing script which allows you to upload and share videos.', '2017-03-08 07:11:46', '2020-07-25 12:34:47'),
(5, 'ad1', 'Ad Block 1', '2017-03-08 09:25:08', '2020-07-25 12:34:47'),
(6, 'ad2', 'Ad Block 2', '2017-03-08 09:25:08', '2020-07-25 12:34:47'),
(7, 'ad3', 'Ad Block 3', '2017-03-08 09:25:21', '2020-07-25 12:34:47'),
(8, 'ad4', 'Ad Block 4', '2017-03-08 09:25:21', '2020-07-25 12:34:47'),
(9, 'ad', '1', '2017-03-08 09:57:06', '2020-07-25 12:34:47'),
(10, 'ad5', 'Ad Block 5', '2017-03-09 09:05:49', '2017-03-09 09:05:49'),
(11, 'ad6', 'Ad Block 6', '2017-03-09 09:05:49', '2017-03-09 09:05:49'),
(12, 'comments', '1', '2017-03-09 09:09:09', '2020-07-25 12:34:47'),
(13, 'disqus_code', '', '2017-03-09 09:09:09', '2020-07-25 12:34:47'),
(15, 'max_video_upload_size', '20', '2017-03-23 17:00:28', '2020-07-25 12:34:47'),
(16, 'skin', 'black-skin', '2017-06-01 08:36:26', '2020-07-25 12:34:47'),
(17, 'skins', 'white-skin,black-skin,cyan-skin,mdb-skin,deep-purple-skin,navy-blue-skin,pink-skin,indigo-skin,light-blue-skin,light-blue-skin', '2017-06-01 08:42:30', '2017-06-01 08:42:30'),
(18, 'social_fb', '#', '2017-07-04 12:37:53', '2020-07-25 12:34:47'),
(19, 'social_pinterest', '#', '2017-07-04 12:37:53', '2020-07-25 12:34:47'),
(20, 'social_gplus', '#', '2017-07-04 12:38:09', '2020-07-25 12:34:47'),
(21, 'social_twitter', '#', '2017-07-04 12:38:09', '2020-07-25 12:34:47'),
(22, 'google_analytics', '&lt;script&gt;&lt;/script&gt;', '2017-07-08 05:50:02', '2020-07-25 12:34:47'),
(23, 'max_thumbnail_upload_size', '1', '2017-03-23 17:00:28', '2020-07-25 12:34:47'),
(24, 'vast_ad1', NULL, '2018-08-20 12:21:43', '2020-07-25 12:34:47'),
(25, 'vast_ad2', NULL, '2018-08-20 12:21:43', '2020-07-25 12:34:47'),
(26, 'meta_keywords', 'vtube', '2018-08-21 10:38:00', '2020-07-25 12:34:47'),
(27, 'site_logo', '/img/logo.png?v=1534850680', '2018-08-21 10:57:02', '2018-08-21 05:54:40'),
(28, 'youtube_api_key', 'AIzaSyBru3daZO0nVrgKlXcJFSSFJNzKqgsQ0N0', '2018-08-22 06:55:33', '2020-07-25 12:34:48'),
(29, 'auto_approve', '1', '2018-08-22 08:25:14', '2020-07-25 12:34:48'),
(30, 'videos_per_page', '20', '2018-08-22 12:19:09', '2020-07-25 12:34:48'),
(31, 'footer_text', 'All videos are copyrighted to their respectful owners unless stated otherwise. This website is not associated with any external links or websites', '2018-08-22 13:39:20', '2020-07-25 12:34:48'),
(32, 'user_upload', '1', '2020-07-25 14:31:10', '2020-07-25 12:34:47'),
(33, 'user_embed', '1', '2020-07-25 14:31:10', '2020-07-25 12:34:47'),
(34, 'user_import', '1', '2020-07-25 14:31:10', '2020-07-25 12:34:47'),
(35, 'video_download', '1', '2020-07-25 14:31:10', '2020-07-25 12:34:47'),
(36, 'mail_driver', 'mail', '2020-07-25 16:58:59', '2020-07-25 12:34:48'),
(37, 'mail_host', 'smtp.mailtrap.io', '2020-07-25 16:58:59', '2020-07-25 12:34:48'),
(38, 'mail_username', NULL, '2020-07-25 16:58:59', '2020-07-25 12:34:48'),
(39, 'mail_password', NULL, '2020-07-25 16:58:59', '2020-07-25 12:34:48'),
(40, 'mail_port', '2525', '2020-07-25 16:58:59', '2020-07-25 12:34:48'),
(41, 'mail_encryption', 'tls', '2020-07-25 17:05:41', '2020-07-25 12:34:48'),
(42, 'mail_from_name', 'VTube', '2020-07-25 17:05:41', '2020-07-25 12:34:48'),
(43, 'mail_from_address', 'noreply@example.com', '2020-07-25 17:05:41', '2020-07-25 12:34:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(1) NOT NULL COMMENT '1 - admin / 2 - user',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` int(1) NOT NULL COMMENT '0 - inactive / 1 - active',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `views` text COLLATE utf8_unicode_ci,
  `watch_later` text COLLATE utf8_unicode_ci,
  `history` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `remember_token`, `active`, `activation_code`, `views`, `watch_later`, `history`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@example.com', '$2y$10$xRIDb0eIMfSEgEYYtBE.h.XJTpNERi86dXCdUZ9ZvbS9b/6fCzAMu', 1, 'XlILzBswl0YV3BYu00GjetxaMuPMcqVJW1Nzarwek1TjCSCwnyPSu12vH9Pb', 1, 'a34a685988cf29928867709c6da53a9c80a69fg7', ',1,2,3,5,8,9,6,10,12,13,15,16', ',1,9', ',2,3,8,9,6,5,10,12,13,15,16', '2017-03-21 02:36:35', '2018-08-22 08:35:34'),
(2, 'demo', 'demo@example.com', '$2y$10$Ned4I/m892u1fYMEwalU2.CyNP/RRtiGxcRznTBx.U8RBH0t5FZge', 2, 'IONemkvrfJpMHBNpsBQLmXD3i7lRwUpC8fPErSr9LwyVtecO8GAqdvsahAlG', 1, 'a34a685988cf29928867709c6da53a9c80a69fd3', '', '', '', '2017-03-21 02:36:35', '2018-08-21 04:20:19');

-- --------------------------------------------------------


ALTER TABLE `laravellikecomment_comments` CHANGE `comment` `comment` LONGTEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;

--
-- Table structure for table `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL COMMENT '1 - Upload / 2 - Embed',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `tags` text COLLATE utf8_unicode_ci,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `content` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `thumbnail` mediumtext COLLATE utf8_unicode_ci,
  `views` int(20) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `published` int(11) NOT NULL DEFAULT '1' COMMENT '0 - No / 1 - Yes',
  `status` int(11) NOT NULL DEFAULT '0',
  `featured` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `type`, `title`, `description`, `tags`, `slug`, `category_id`, `content`, `thumbnail`, `views`, `user_id`, `created_at`, `updated_at`, `published`, `status`, `featured`) VALUES
(1, 2, 'YALGAAR - CARRYMINATI X Wily Frenzy', 'YALGAAR HO &lt;br /&gt;\n &lt;br /&gt;\nApple Music ►  https://music.apple.com/in/album/yalgaar/1517209410?i=1517209411 &lt;br /&gt;\n&lt;br /&gt;\nSpotify ► https://open.spotify.com/track/0RGp4KA9wvndxqPIWoKwnD&lt;br /&gt;\n&lt;br /&gt;\nHungama ► http://www.hungama.com/song/yalgaar/54018800/&lt;br /&gt;\n&lt;br /&gt;\nGaana ► https://gaana.com/album/yalgaar-hindi-1&lt;br /&gt;\n&lt;br /&gt;\nJioSaavn► https://www.jiosaavn.com/album/yalgaar/r4xcIwL0rUA_&lt;br /&gt;\n&lt;br /&gt;\nSong&amp; Lyrics - Ajey Nagar (CarryMinati)&lt;br /&gt;\nMusic composed &amp; Produced by -  Wily Frenzy &lt;br /&gt;\nManaged by - Deepak Char &lt;br /&gt;\nShot by - Shlok Mishra &amp; Lakshay Bhoria&lt;br /&gt;\nEngineered at Noisy Gates studio &lt;br /&gt;\n&lt;br /&gt;\nCarryisLive : https://www.youtube.com/channel/UC0IW...&lt;br /&gt;\r\n&lt;br /&gt;\r\nInstagram► https://www.instagram.com/carryminati/&lt;br /&gt;\r\nFacebook ► https://www.facebook.com/CarryDeol/&lt;br /&gt;\r\nSnapchat► heyAjey&lt;br /&gt;\r\nTwitter ► https://twitter.com/CarryMinati&lt;br /&gt;\r\n&lt;br /&gt;\r\nFor Business Related queries: workforcarry@gmail.com &lt;br /&gt;\r\n&lt;br /&gt;\r\nAbout CarryMinati : Youthoob certified member&lt;br /&gt;\r\n&lt;br /&gt;\r\nDisclaimer : DISCLAIMER: Please don\'t go out of your way to or hate on anyone I talk about in my videos, this channel is to entertain people and I usually focus on joking about what the people are doing not the individual themselves, please don\'t go spreading hate it\'s all for laughs&lt;br /&gt;\r\n&lt;br /&gt;\r\nCopyright Disclaimer Under Section 107 of the Copyright Act 1976, allowance is made for &quot;fair use&quot; for purposes such as criticism, comment, news reporting, teaching, scholarship, and research. Fair use is a use permitted by copyright statute that might otherwise be infringing. Non-profit, educational or personal use tips the balance in favor of fair use.&lt;br /&gt;\r\nˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍˍ', 'CarryMinati,Carry,Indian,youtuber,#CarryMinati,roast,yalgaar,carryminati new song,song yalgaar', 'yalgaar-carryminati-x-wily-frenzy-VoHNSLk7T1', 8, '<iframe width=\"480\" height=\"270\" src=\"//www.youtube.com/embed/zzwRbKI2pn4\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 'https://i.ytimg.com/vi/zzwRbKI2pn4/mqdefault.jpg', 0, 1, '2020-07-25 11:38:54', '2020-07-25 11:38:54', 1, 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

