-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 29, 2015 at 01:32 PM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `laravel`
--
CREATE DATABASE IF NOT EXISTS `laravel` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `laravel`;

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bio` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`, `bio`, `created_at`, `updated_at`) VALUES
(1, 'Jnana', 'Some data about author Jnana', '2014-11-24 07:42:40', '2014-11-24 07:42:40'),
(2, 'author 2', 'Some data about author Jnana', '2014-11-24 07:42:40', '2014-11-24 07:42:40');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_11_24_125234_create_authors_table', 1),
('2014_11_24_130459_add_authors', 2);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `user_id` int(5) unsigned NOT NULL,
  `archived` tinyint(1) NOT NULL,
  `description` varchar(300) CHARACTER SET latin1 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `user_id`, `archived`, `description`, `created_at`, `updated_at`) VALUES
(1, 'New project', 0, 0, 'Some Description', '2014-12-10 08:55:20', '2014-12-10 08:55:20'),
(10, 'First Project', 1, 0, 'First Project', '2015-01-27 10:39:36', '2015-01-27 05:09:36'),
(11, 'Your Project', 1, 0, 'Second Project', '2015-01-23 11:23:39', '2015-01-23 05:53:39'),
(12, 'Project ', 1, 0, '#rd Project', '2014-12-10 09:21:14', '2014-12-10 09:21:14'),
(13, 'New Laravel Project', 1, 0, 'Test desciption', '2015-01-20 05:16:13', '2015-01-20 05:16:13');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(5) unsigned NOT NULL,
  `completed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `project_id`, `completed`, `description`, `created_at`, `updated_at`) VALUES
(1, 'New', 13, 0, '', '2015-01-22 08:07:51', '2015-01-22 08:07:51'),
(2, 'grgr', 484848, 0, '', '2015-01-22 08:32:41', '2015-01-22 08:32:41'),
(3, 'first proj', 10, 0, '', '2015-01-22 08:35:17', '2015-01-23 08:56:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `remember_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `phone`, `country`, `password`, `image`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'Gyan', 'Sahu', 'jsahu', 'jnana@indibits.com', 'Gyana', 'India', '$2y$10$gCSkpeIeYZCPZmABbFEVxuXrLn1BsThAr9y6db3pt7mbEXvmpTJva', 'jsahu', '2015-01-07 14:21:09', '2015-01-07 08:51:09', 'ArYse2crvMizOTjOVv8vv0wsjJVoCpj4fFowR8ccTZgTGPe6wlSNKYpTLhp2'),
(2, 'Indibits', 'bhubaneswar', 'indibits-bhubaneswar', 'mail@indibits.com', '8989898', 'India', '$2y$10$LVYksCpBUJPRrTD93NqvGODAxHgkfvi2VgIvNkSVR/2n3tKXrECFW', '', '2014-12-10 02:21:02', '2014-12-10 02:21:02', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
