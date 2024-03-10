-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for qcpl_engagement
CREATE DATABASE IF NOT EXISTS `qcpl_engagement` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `qcpl_engagement`;

-- Dumping structure for table qcpl_engagement.age
CREATE TABLE IF NOT EXISTS `age` (
  `age_id` int NOT NULL AUTO_INCREMENT,
  `age_range` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`age_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table qcpl_engagement.age: ~5 rows (approximately)
INSERT INTO `age` (`age_id`, `age_range`, `created_at`, `updated_at`) VALUES
	(1, '0-12', '2023-12-06 15:20:43', '2023-12-06 15:20:43'),
	(2, '13-21', '2023-12-06 15:20:58', '2023-12-06 15:20:58'),
	(3, '22-35', '2023-12-06 15:21:15', '2023-12-06 15:21:15'),
	(4, '36-59', '2023-12-06 15:21:25', '2023-12-06 15:21:25'),
	(5, '60 above', '2023-12-06 15:21:37', '2023-12-06 15:21:52');

-- Dumping structure for view qcpl_engagement.busiest_times
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `busiest_times` (
	`hour` VARCHAR(5) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`monday` DECIMAL(23,0) NULL,
	`tuesday` DECIMAL(23,0) NULL,
	`wednesday` DECIMAL(23,0) NULL,
	`thursday` DECIMAL(23,0) NULL,
	`friday` DECIMAL(23,0) NULL
) ENGINE=MyISAM;

-- Dumping structure for table qcpl_engagement.choices
CREATE TABLE IF NOT EXISTS `choices` (
  `choice_id` int NOT NULL AUTO_INCREMENT,
  `question_id` int DEFAULT NULL,
  `choice` varchar(255) NOT NULL,
  `is_deleted` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`choice_id`),
  KEY `question_id` (`question_id`),
  CONSTRAINT `choices_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table qcpl_engagement.choices: ~0 rows (approximately)

-- Dumping structure for table qcpl_engagement.client
CREATE TABLE IF NOT EXISTS `client` (
  `client_id` int NOT NULL AUTO_INCREMENT,
  `civil_status` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `m_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `l_name` varchar(255) NOT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `age_id` int DEFAULT NULL,
  `gender` varchar(255) NOT NULL,
  `education` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = Normal\r\n1 = Senior\r\n2 = PWD\r\n3 = Pregnant',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`client_id`),
  KEY `age_id` (`age_id`),
  CONSTRAINT `client_ibfk_1` FOREIGN KEY (`age_id`) REFERENCES `age` (`age_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table qcpl_engagement.client: ~94 rows (approximately)
INSERT INTO `client` (`client_id`, `civil_status`, `f_name`, `m_name`, `l_name`, `suffix`, `age_id`, `gender`, `education`, `occupation`, `status`, `created_at`, `updated_at`) VALUES
	(35, '', 'da', 'das', 'das', 'das', 5, 'Male', 'Doctorate Degree', 'Employed', 1, '2024-02-08 01:26:03', '2024-02-08 01:26:03'),
	(36, '', 'dasd', 'dsad', 'dasd', 'da', 3, 'Female', 'College Level', 'Unemployed', 2, '2024-02-08 01:29:29', '2024-02-08 01:29:29'),
	(37, '', 'da', 'das', 'das', 'd', 3, 'Male', 'Masters Degree', 'Unemployed', 0, '2024-02-08 01:30:33', '2024-02-08 01:30:33'),
	(38, '', 'zcxxz', 'zcxzxczxc', 'zxczxc', 'zxczxc', 3, 'Male', 'Elementary Graduate', 'Student', 0, '2024-02-08 19:46:33', '2024-02-08 19:46:33'),
	(39, '', 'asdasd', 'zcxzxcasdasdzxc', 'asdasd', '', 3, 'Others', 'HighSchool Graduate', 'Student', 2, '2024-02-08 19:47:08', '2024-02-08 19:47:08'),
	(40, '', 'asdasd', 'zczxczxc', 'asdasd', '', 3, 'Male', 'HighSchool Level', 'Student', 0, '2024-02-08 20:02:46', '2024-02-08 20:02:46'),
	(41, '', 'qweqwe', '', 'qweqweqwe', '', 5, 'Male', 'Elementary Graduate', 'Student', 1, '2024-02-08 20:03:06', '2024-02-08 20:03:06'),
	(42, '', 'xczxc', '', 'zxcxzc', '', 3, 'Male', 'HighSchool Level', 'Unemployed', 3, '2024-02-08 20:03:52', '2024-02-08 20:03:52'),
	(43, '', 'xzcxzcxc', '', 'ss', '', 3, 'Male', 'HighSchool Level', 'Unemployed', 0, '2024-02-08 20:04:23', '2024-02-08 20:04:23'),
	(44, '', 'asd', '', 'zxc', '', 3, 'Others', 'College Level', 'Retired', 0, '2024-02-08 20:08:38', '2024-02-08 20:08:38'),
	(45, '', 'cvcv', '', 'cvcvcv', '', 2, 'Female', 'HighSchool Level', 'Student', 0, '2024-02-08 20:15:51', '2024-02-08 20:15:51'),
	(46, '', 'da', '', 'zcx', '', 5, 'Male', 'HighSchool Level', 'Unemployed', 1, '2024-02-08 20:22:00', '2024-02-08 20:22:00'),
	(47, '', 'qwesad', '', 'xzc', '', 3, 'Female', 'Vocational', 'Employed', 0, '2024-02-08 20:23:45', '2024-02-08 20:23:45'),
	(48, '', 'please gumana kana', 'nakikiusap ako', 'for the love of god', 'please work', 3, 'Male', 'Elementary Graduate', 'Unemployed', 0, '2024-02-08 20:25:28', '2024-02-08 20:25:28'),
	(49, '', 'Gumana ka', 'Please', 'For the love of our beloved maker', 'Please work', 2, 'Female', 'Elementary Graduate', 'Employed', 2, '2024-02-08 20:26:36', '2024-02-08 20:26:36'),
	(50, '', 'zxc', 'zc', 'zxczxc', '', 5, 'Female', 'Elementary Graduate', 'Unemployed', 1, '2024-02-08 20:27:33', '2024-02-08 20:27:33'),
	(51, '', 'zcxvxcvcxv', 'zccvcxvcxv', 'zxczxcxcvcxvcxv', 'cxvcxvcx', 3, 'Others', 'Vocational', 'Employed', 0, '2024-02-08 20:28:06', '2024-02-08 20:28:06'),
	(52, '', 'Washing', '', 'Machine', '', 2, 'Female', 'Elementary Graduate', 'Unemployed', 0, '2024-02-10 13:29:39', '2024-02-10 13:29:39'),
	(53, '', 'sadasd', 'zxc', 'sdasd', '', 2, 'Female', 'Elementary Graduate', 'Employed', 0, '2024-02-10 13:45:13', '2024-02-10 13:45:13'),
	(54, '', 'asdxzc', '', 'zxczxc', '', 3, 'Female', 'Elementary Graduate', 'Student', 0, '2024-02-10 13:51:14', '2024-02-10 13:51:14'),
	(55, '', 'test', '', 'test', '', 3, 'Female', 'Masters Degree', 'Unemployed', 0, '2024-02-10 13:54:54', '2024-02-10 13:54:54'),
	(56, '', 'vbvbvbvbvbvb', '', 'vbvbvbvbvb', '', 3, 'Others', 'HighSchool Graduate', 'Employed', 2, '2024-02-10 13:57:19', '2024-02-10 13:57:19'),
	(57, '', 'asd', 'asd', 'asd', 'as', 3, 'Others', 'Elementary Graduate', 'Employed', 2, '2024-02-10 15:01:54', '2024-02-10 15:01:54'),
	(58, '', 'Bogart', 'Pederico', 'Pedring', 'Sr.', 5, 'Male', 'Elementary Graduate', 'Student', 1, '2024-02-10 15:07:05', '2024-02-10 15:07:05'),
	(59, '', 'awaasdasd', 'sadzxc', 'zxc', '', 3, 'Female', 'HighSchool Level', 'Unemployed', 3, '2024-02-10 15:17:47', '2024-02-10 15:17:47'),
	(60, '', 'qweqweqwe', '', 'qweqweqwe', '', 2, 'Female', 'Elementary Graduate', 'Student', 0, '2024-02-10 15:24:37', '2024-02-10 15:24:37'),
	(61, '', 'zxc', '', 'zxc', '', 3, 'Others', 'HighSchool Level', 'Employed', 0, '2024-02-10 15:36:10', '2024-02-10 15:36:10'),
	(62, '', 'test', '', 'test', '', 3, 'Female', 'HighSchool Graduate', 'Employed', 2, '2024-02-12 19:26:46', '2024-02-12 19:26:46'),
	(63, '', 'Bogart', '', 'Pedring', '', 5, 'Others', 'HighSchool Level', 'Unemployed', 1, '2024-02-13 01:47:12', '2024-02-13 01:47:12'),
	(64, '', 'asdasd', '', 'asdas', '', 2, 'Female', 'HighSchool Level', 'Unemployed', 2, '2024-02-13 02:57:46', '2024-02-13 02:57:46'),
	(65, '', 'zczxc', '', 'zxczxc', '', 3, 'Male', 'Elementary Graduate', 'Student', 0, '2024-02-13 02:58:21', '2024-02-13 02:58:21'),
	(66, '', 'Hedgehog', '', 'Duck', '', 2, 'Male', 'HighSchool Graduate', 'Employed', 2, '2024-02-13 03:02:57', '2024-02-13 03:02:57'),
	(67, '', 'Jumbo', '', 'Hotdog', '', 3, 'Others', 'Elementary Graduate', 'Student', 3, '2024-02-13 03:03:43', '2024-02-13 03:03:43'),
	(68, '', 'dfdfdf', 'd', 'dfdfdf', '', 2, 'Female', 'HighSchool Level', 'Student', 2, '2024-02-13 03:06:33', '2024-02-13 03:06:33'),
	(69, '', 'santa', 'alarcon', 'clara', '', 4, 'Male', 'Elementary Graduate', 'Retired', 3, '2024-02-13 06:16:46', '2024-02-13 06:16:46'),
	(70, '', 'lean', 'marchan', 'phabos', '', 4, 'Others', 'Elementary Graduate', 'Unemployed', 2, '2024-02-13 06:20:39', '2024-02-13 06:20:39'),
	(71, '', 'thessa', 'alarcon', 'wifi', '', 4, 'Female', 'College Level', 'Student', 0, '2024-02-13 06:22:11', '2024-02-13 06:22:11'),
	(72, '', 'thessa', 'salde', 'obana', '', 2, 'Female', 'College Level', 'Student', 2, '2024-02-13 07:06:30', '2024-02-13 07:06:30'),
	(73, '', 'winchell', '', 'castillo', '', 2, 'Female', 'College Level', 'Student', 3, '2024-02-13 07:18:24', '2024-02-13 07:18:24'),
	(74, '', 'asdasd', 'fsdfsd', 'ds', 'ds', 3, 'Female', 'Elementary Graduate', 'Student', 0, '2024-02-15 00:11:06', '2024-02-15 00:11:06'),
	(75, '', 'aliena', 'aliena', 'aliena', '', 3, 'Female', 'Doctorate Degree', 'Student', 0, '2024-02-17 05:10:26', '2024-02-17 05:10:26'),
	(76, '', 'hahah', 'hahah', 'hahah', '', 3, 'Male', 'Doctorate Degree', 'Unemployed', 0, '2024-02-17 15:54:20', '2024-02-17 15:54:20'),
	(77, '', 'haha', 'ahah', 'haha', 'haha', 3, 'Female', 'Elementary Graduate', 'Unemployed', 0, '2024-02-17 15:55:16', '2024-02-17 15:55:16'),
	(78, '', 'haha', 'haha', 'haha', 'hah', 3, 'Male', 'Elementary Graduate', 'Unemployed', 0, '2024-02-17 15:55:57', '2024-02-17 15:55:57'),
	(79, '', 'sad', 'ds', 'asd', 'asd', 3, 'Female', 'High School Level', 'Student', 3, '2024-02-17 15:57:55', '2024-02-17 15:57:55'),
	(80, '', 'zcx', 'zxc', 'zcx', '', 3, 'Male', 'High School Level', 'Student', 0, '2024-02-17 15:58:39', '2024-02-17 15:58:39'),
	(81, '', 'asd', 'asd', 'asd', 'asd', 5, 'Male', 'High School Level', 'Student', 1, '2024-02-17 16:04:11', '2024-02-17 16:04:11'),
	(82, '', 'qweqwe', 'sad', 'zxccxz', '', 4, 'Male', 'High School Level', 'Unemployed', 2, '2024-02-17 16:07:49', '2024-02-17 16:07:49'),
	(83, '', 'cxzczx', 'czxczxczxc', 'asdasd', 'asdasd', 2, 'Female', 'Elementary Graduate', 'Student', 0, '2024-02-19 09:44:13', '2024-02-19 09:44:13'),
	(84, '', 'Bogart', '', 'Pedring', 'Sr.', 3, 'Others', 'Vocational', 'Retired', 2, '2024-02-19 13:09:17', '2024-02-19 13:09:17'),
	(85, '', 'Thanks', '', 'Jesus', '', 2, 'Female', 'High School Graduate', 'Student', 2, '2024-02-19 15:42:37', '2024-02-19 15:42:37'),
	(86, '', 'Pacquiao', '', 'Manny', '', 3, 'Female', 'High School Level', 'Student', 2, '2024-02-19 15:52:55', '2024-02-19 15:52:55'),
	(87, '', 'vbvb', '', 'bvbvbv', '', 2, 'Male', 'Elementary Graduate', 'Unemployed', 0, '2024-02-19 15:53:38', '2024-02-19 15:53:38'),
	(88, '', 'Nikola', '', 'Jokic', '', 2, 'Male', 'Elementary Graduate', 'Unemployed', 2, '2024-02-19 16:12:21', '2024-02-19 16:12:21'),
	(89, '', 'Luka', '', 'Magic', '', 3, 'Female', 'Elementary Graduate', 'Student', 3, '2024-02-19 16:12:50', '2024-02-19 16:12:50'),
	(90, '', 'Joel', '', 'Embid', '', 2, 'Male', 'High School Level', 'Student', 2, '2024-02-19 16:13:35', '2024-02-19 16:13:35'),
	(91, '', 'Kobe', '', 'Bryant', '', 5, 'Male', 'Elementary Graduate', 'Student', 1, '2024-02-19 16:14:24', '2024-02-19 16:14:24'),
	(92, '', 'Aaron', '', 'Gordon', '', 3, 'Others', 'Elementary Graduate', 'Employed', 0, '2024-02-19 16:15:06', '2024-02-19 16:15:06'),
	(93, '', 'Michael', '', 'Porter', 'Jr.', 3, 'Male', 'Elementary Graduate', 'Student', 0, '2024-02-19 17:22:31', '2024-02-19 17:22:31'),
	(94, '', 'Jesus', '', 'Help Us', '', 3, 'Male', 'Elementary Graduate', 'Unemployed', 0, '2024-02-19 17:36:58', '2024-02-19 17:36:58'),
	(95, '', 'Jamal', '', 'Murray', '', 3, 'Female', 'Elementary Graduate', 'Student', 0, '2024-02-19 17:39:10', '2024-02-19 17:39:10'),
	(96, '', 'Kentavious', 'Caldwell', 'Pope', '', 3, 'Male', 'Elementary Graduate', 'Student', 2, '2024-02-19 17:42:22', '2024-02-19 17:42:22'),
	(97, '', 'Lebron', 'asd', 'James', '', 5, 'Male', 'Elementary Graduate', 'Student', 1, '2024-02-19 17:42:55', '2024-02-19 17:42:55'),
	(98, '', 'Dirk', 'asd', 'Nowitzki', '', 2, 'Male', 'Elementary Graduate', 'Student', 0, '2024-02-19 17:43:27', '2024-02-19 17:43:27'),
	(99, '', 'Bam', '', 'Adebayo', '', 2, 'Male', 'Elementary Graduate', 'Student', 0, '2024-02-19 18:35:52', '2024-02-19 18:35:52'),
	(100, '', 'Marc', '', 'Campbell', '', 4, 'Male', 'Elementary Graduate', 'Student', 0, '2024-02-20 02:53:39', '2024-02-20 02:53:39'),
	(101, 'Married', 'asad', 'zxc', 'asd', 'sad', 3, 'Male', 'High School Level', 'Unemployed', 2, '2024-02-26 00:33:13', '2024-02-26 00:33:13'),
	(102, 'Widow', 'ads', 'zxcxzc', 'zxcxzc', 'asdasd', 3, 'Male', 'High School Level', 'Unemployed', 3, '2024-02-26 00:39:30', '2024-02-26 00:39:30'),
	(103, 'Widow', 'ad', 'c', 'zxc', '', 3, 'Female', 'Elementary Graduate', 'Student', 0, '2024-02-26 00:42:26', '2024-02-26 00:42:26'),
	(104, '', 'asdcz', 'ds', 'qwe', '', 2, 'Others', 'Elementary Graduate', 'Student', 0, '2024-02-26 00:45:21', '2024-02-26 00:45:21'),
	(105, 'Widow', 'qwe', 'qw', 'xc', '', 2, 'Male', 'Vocational', 'Student', 0, '2024-02-26 00:45:39', '2024-02-26 00:45:39'),
	(106, 'Single', 'Peyton', '', 'Watson', '', 3, 'Male', 'Elementary Graduate', 'Student', 2, '2024-02-26 03:18:14', '2024-02-26 03:18:14'),
	(107, 'Single', 'ads', 'asd', 'sad', '', 3, 'Others', 'High School Level', 'Unemployed', 2, '2024-02-26 09:44:12', '2024-02-26 09:44:12'),
	(108, 'Single', 'James', '', 'Yap', '', 3, 'Female', 'Elementary Graduate', 'Student', 2, '2024-02-26 10:25:39', '2024-02-26 10:25:39'),
	(109, 'Single', 'Steph', '', 'Curry', '', 3, 'Male', 'High School Level', 'Unemployed', 0, '2024-02-26 10:26:30', '2024-02-26 10:26:30'),
	(110, 'Single', 'James', '', 'Harden', '', 3, 'Male', 'High School Level', 'Unemployed', 2, '2024-02-26 10:26:49', '2024-02-26 10:26:49'),
	(111, '', 'Jim', '', 'Carrey', '', 3, 'Male', 'High School Graduate', 'Student', 2, '2024-02-26 10:42:30', '2024-02-26 10:42:30'),
	(112, 'Single', 'Jeff', '', 'Daniels', '', 3, 'Male', 'Elementary Graduate', 'Student', 2, '2024-02-26 10:43:18', '2024-02-26 10:43:18'),
	(113, 'Single', 'Ja', '', 'Morant', '', 3, 'Male', 'High School Graduate', 'Unemployed', 0, '2024-02-26 12:53:05', '2024-02-26 12:53:05'),
	(114, 'Single', 'sasdas', 'xz', 'zx', '', 3, 'Male', 'Elementary Graduate', 'Employed', 0, '2024-03-03 13:34:14', '2024-03-03 13:34:14'),
	(115, 'Single', 'asd', 'asd', 'asd', '', 3, 'Male', 'Elementary Graduate', 'Student', 2, '2024-03-04 13:27:48', '2024-03-04 13:27:48'),
	(116, 'Widow', 'asd', 'xzc', 'zxc', '', 3, 'Male', 'Elementary Graduate', 'Unemployed', 2, '2024-03-04 13:28:10', '2024-03-04 13:28:10'),
	(117, 'Married', 'sda', 'cx', 'asd', '', 3, 'Others', 'High School Level', 'Student', 2, '2024-03-04 13:28:33', '2024-03-04 13:28:33'),
	(118, 'Single', 'asd', 'zx', 'c', '', 3, 'Female', 'High School Level', 'Employed', 3, '2024-03-04 13:29:19', '2024-03-04 13:29:19'),
	(119, 'Married', 'asd', 'asd', 'asd', '', 3, 'Female', 'Elementary Graduate', 'Student', 0, '2024-03-04 13:29:39', '2024-03-04 13:29:39'),
	(120, 'Married', 'asdsad', 'sadsad', 'asd', '', 3, 'Male', 'Elementary Graduate', 'Student', 0, '2024-03-09 05:09:40', '2024-03-09 05:09:40'),
	(121, 'Widow', 'asd', 'asd', 'qwe', 'qwe', 3, 'Male', 'Elementary Graduate', 'Student', 0, '2024-03-10 01:56:30', '2024-03-10 01:56:30'),
	(122, '', 'sdasd', 'xc', 'zxc', 'asd', 3, 'Male', 'Elementary Graduate', 'Student', 0, '2024-03-10 02:17:11', '2024-03-10 02:17:11'),
	(123, 'Widow', 'asd', 'asd', 'dsa', 'as', 3, 'Others', 'High School Level', 'Student', 2, '2024-03-10 02:21:18', '2024-03-10 02:21:18'),
	(124, '', 'asd', 'asd', 'asd', '', 3, 'Male', 'Elementary Graduate', 'Student', 2, '2024-03-10 03:41:39', '2024-03-10 03:41:39'),
	(125, 'Widow', 'asdasd', 'asd', 'asdsad', '', 3, 'Male', 'Elementary Graduate', 'Student', 2, '2024-03-10 03:49:03', '2024-03-10 03:49:03'),
	(126, '', 'asd', 'zxc', 'asd', '', 3, 'Female', 'Elementary Graduate', 'Student', 0, '2024-03-10 10:14:58', '2024-03-10 10:14:58'),
	(127, '', 'asd', 'asd', 'zxc', '', 3, 'Male', 'High School Level', 'Student', 0, '2024-03-10 10:23:26', '2024-03-10 10:23:26'),
	(128, 'Widow', 'Testingers', '', 'test', '', 3, 'Male', 'High School Level', 'Student', 0, '2024-03-10 11:17:46', '2024-03-10 11:17:46');

-- Dumping structure for table qcpl_engagement.emoji
CREATE TABLE IF NOT EXISTS `emoji` (
  `emoji_id` int NOT NULL AUTO_INCREMENT,
  `image_path` varchar(255) NOT NULL,
  `_char` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `unicode_codepoint` varchar(255) NOT NULL,
  `occurrences` int NOT NULL,
  `_position` decimal(4,3) NOT NULL,
  `negative` decimal(4,3) NOT NULL,
  `neutral` decimal(4,3) NOT NULL,
  `positive` decimal(4,3) NOT NULL,
  `sentiment_score` decimal(4,3) NOT NULL,
  `unicode_name` varchar(255) NOT NULL,
  `unicode_block` varchar(255) NOT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `in_choices` tinyint DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`emoji_id`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table qcpl_engagement.emoji: ~5 rows (approximately)
INSERT INTO `emoji` (`emoji_id`, `image_path`, `_char`, `image`, `unicode_codepoint`, `occurrences`, `_position`, `negative`, `neutral`, `positive`, `sentiment_score`, `unicode_name`, `unicode_block`, `remarks`, `in_choices`, `created_at`, `updated_at`) VALUES
	(106, 'public/assets/images/emojis/ANGRY FACE.png', '😠', '😠', '0x1f620', 288, 0.849, 0.564, 0.172, 0.265, -0.299, 'ANGRY FACE', 'Emoticons', 'A yellow face with a frowning mouth and eyes and eyebrows scrunched downward in anger. Conveys varying degrees of anger, from grumpiness and irritation to disgust and outrage. May also represent someone acting tough or being mean.', 1, '2024-02-12 20:00:36', '2024-02-12 20:00:38'),
	(107, 'public/assets/images/emojis/DISAPPOINTED FACE.png', '😞', '😞', '0x1f61e', 532, 0.825, 0.479, 0.161, 0.361, -0.118, 'DISAPPOINTED FACE', 'Emoticons', 'A yellow face with a frown and closed, downcast eyes, as if aching with sorrow or pain. May convey a variety of unhappy emotions, including disappointment, grief, stress, regret, and remorse. Similar to 😔 Pensive Face, but with a sadder, more hurt expression. Samsung’s design previously featured an expression closer to 😕 Confused Face.', 1, '2024-02-12 20:00:55', '2024-02-12 20:00:56'),
	(108, 'public/assets/images/emojis/NEUTRAL FACE.png', '😐', '😐', '0x1f610', 270, 0.883, 0.553, 0.282, 0.165, -0.388, 'NEUTRAL FACE', 'Emoticons', 'A yellow face with simple, open eyes and a flat, closed mouth. Intended to depict a neutral sentiment but often used to convey mild irritation and concern or a deadpan sense of humor. Goes Great With', 1, '2024-02-12 20:01:13', '2024-02-12 20:01:14'),
	(109, 'public/assets/images/emojis/SMILING FACE WITH SMILING EYES.png', '😊', '😊', '0x1f60a', 3186, 0.813, 0.060, 0.237, 0.704, 0.644, 'SMILING FACE WITH SMILING EYES', 'Emoticons', 'A yellow face with smiling eyes and a broad, closed smile turning up to rosy cheeks. Often expresses genuine happiness and warm, positive feelings. An emoji form of the ^^ emoticon.', 1, '2024-02-12 20:01:33', '2024-02-12 20:01:33'),
	(110, 'public/assets/images/emojis/SMILING FACE WITH OPEN MOUTH AND SMILING EYES.png', '😄', '😄', '0x1f604', 1398, 0.795, 0.137, 0.305, 0.558, 0.421, 'SMILING FACE WITH OPEN MOUTH AND SMILING EYES', 'Emoticons', 'A yellow face with smiling eyes and a broad, open smile, showing upper teeth and tongue on some platforms. Often conveys general happiness and good-natured amusement. Similar to 😀 Grinning Face and 😃 Grinning Face With Big Eyes, but with warmer, less excited eyes.', 1, '2024-02-12 20:01:49', '2024-02-12 20:01:51');

-- Dumping structure for table qcpl_engagement.feedback
CREATE TABLE IF NOT EXISTS `feedback` (
  `feedback_id` int NOT NULL AUTO_INCREMENT,
  `client_id` int DEFAULT NULL,
  `question_id` int DEFAULT NULL,
  `answer_id` int DEFAULT NULL,
  `text_feedback` text,
  `text_sentiment` tinyint DEFAULT NULL COMMENT '0 = Negative\r\n1 = Neutral\r\n2 = Positive',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`feedback_id`),
  KEY `client_id` (`client_id`),
  KEY `question_id` (`question_id`),
  CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=566 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table qcpl_engagement.feedback: ~14 rows (approximately)
INSERT INTO `feedback` (`feedback_id`, `client_id`, `question_id`, `answer_id`, `text_feedback`, `text_sentiment`, `created_at`, `updated_at`) VALUES
	(552, 126, 31, 108, NULL, NULL, '2024-03-10 10:19:40', '2024-03-10 10:19:40'),
	(553, 126, 32, 107, NULL, NULL, '2024-03-10 10:19:40', '2024-03-10 10:19:40'),
	(554, 126, 33, 108, NULL, NULL, '2024-03-10 10:19:40', '2024-03-10 10:19:40'),
	(555, 126, 38, 107, NULL, NULL, '2024-03-10 10:19:40', '2024-03-10 10:19:40'),
	(556, 126, 39, 107, NULL, NULL, '2024-03-10 10:19:40', '2024-03-10 10:19:40'),
	(557, 126, 40, 106, NULL, NULL, '2024-03-10 10:19:40', '2024-03-10 10:19:40'),
	(558, 126, 41, NULL, 'Poor', 0, '2024-03-10 10:19:40', '2024-03-10 10:19:40'),
	(559, 127, 31, 108, NULL, NULL, '2024-03-10 10:30:13', '2024-03-10 10:30:13'),
	(560, 127, 32, 107, NULL, NULL, '2024-03-10 10:30:13', '2024-03-10 10:30:13'),
	(561, 127, 33, 107, NULL, NULL, '2024-03-10 10:30:13', '2024-03-10 10:30:13'),
	(562, 127, 38, 108, NULL, NULL, '2024-03-10 10:30:13', '2024-03-10 10:30:13'),
	(563, 127, 39, 107, NULL, NULL, '2024-03-10 10:30:13', '2024-03-10 10:30:13'),
	(564, 127, 40, 106, NULL, NULL, '2024-03-10 10:30:13', '2024-03-10 10:30:13'),
	(565, 127, 41, NULL, 'Average', 1, '2024-03-10 10:30:13', '2024-03-10 10:30:13');

-- Dumping structure for table qcpl_engagement.history_logs
CREATE TABLE IF NOT EXISTS `history_logs` (
  `hl_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `content` varchar(255) NOT NULL,
  `content_id` int NOT NULL,
  `_action` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`hl_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `history_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table qcpl_engagement.history_logs: ~41 rows (approximately)
INSERT INTO `history_logs` (`hl_id`, `user_id`, `content`, `content_id`, `_action`, `created_at`) VALUES
	(1, 5, 'login', 0, 'Log in', '2024-03-10 11:07:15'),
	(2, 4, 'queue', 186, 'Add', '2024-03-10 11:17:46'),
	(3, 4, 'login', 0, 'Log in', '2024-03-10 11:28:42'),
	(4, 4, 'login', 0, 'Log in', '2024-03-10 11:31:49'),
	(5, 4, 'logout', 0, 'Log out', '2024-03-10 11:38:17'),
	(6, 4, 'login', 0, 'Log in', '2024-03-10 11:41:51'),
	(7, 4, 'logout', 0, 'Log out', '2024-03-10 11:47:31'),
	(8, 4, 'login', 0, 'Log in', '2024-03-10 11:50:07'),
	(9, 4, 'logout', 0, 'Log out', '2024-03-10 11:52:37'),
	(10, 4, 'login', 0, 'Log in', '2024-03-10 11:52:48'),
	(11, 4, 'logout', 0, 'Log out', '2024-03-10 11:53:31'),
	(12, 5, 'login', 0, 'Log in', '2024-03-10 11:53:43'),
	(13, 5, 'logout', 0, 'Log out', '2024-03-10 11:53:51'),
	(14, 4, 'login', 0, 'Log in', '2024-03-10 11:54:00'),
	(15, 4, 'logout', 0, 'Log out', '2024-03-10 12:25:53'),
	(16, 4, 'login', 0, 'Log in', '2024-03-10 12:26:00'),
	(17, 4, 'users', 8, 'Add', '2024-03-10 13:13:43'),
	(18, 4, 'logout', 0, 'Log out', '2024-03-10 13:18:17'),
	(19, 4, 'login', 0, 'Log in', '2024-03-10 13:19:51'),
	(20, 4, 'users', 0, 'Edit', '2024-03-10 13:34:28'),
	(21, 4, 'users', 8, 'Edit', '2024-03-10 13:35:18'),
	(22, 4, 'users', 8, 'Deactivate', '2024-03-10 13:58:12'),
	(23, 4, 'users', 8, 'Edit', '2024-03-10 14:09:42'),
	(24, 4, 'users', 8, 'Edit', '2024-03-10 14:09:55'),
	(25, 4, 'users', 4, 'Edit', '2024-03-10 14:10:06'),
	(26, 4, 'users', 8, 'Edit', '2024-03-10 14:10:13'),
	(27, 4, 'questions', 51, 'Add', '2024-03-10 14:26:52'),
	(28, 4, 'questions', 52, 'Add', '2024-03-10 14:27:23'),
	(29, 4, 'users', 7, 'Edit Password', '2024-03-10 14:32:04'),
	(30, 4, 'questions', 53, 'Add', '2024-03-10 14:34:34'),
	(31, 4, 'questions', 53, 'Edit', '2024-03-10 14:34:45'),
	(32, 4, 'questions', 53, 'Delete', '2024-03-10 14:34:53'),
	(33, 4, 'question-type', 18, 'Edit', '2024-03-10 14:54:47'),
	(34, 4, 'question-type', 18, 'Edit', '2024-03-10 14:55:07'),
	(35, 4, 'question-category', 3, 'Edit', '2024-03-10 14:55:21'),
	(36, 4, 'question-category', 3, 'Edit', '2024-03-10 14:55:29'),
	(37, 4, 'question-category', 7, 'Add', '2024-03-10 14:58:23'),
	(38, 4, 'question-type', 0, 'Add', '2024-03-10 14:59:16'),
	(39, 4, 'question-type', 19, 'Edit', '2024-03-10 15:01:40'),
	(40, 4, 'question-type', 0, 'Add', '2024-03-10 15:03:35'),
	(41, 4, 'question-type', 21, 'Add', '2024-03-10 15:13:54'),
	(42, 4, 'logout', 0, 'Log out', '2024-03-10 15:45:12'),
	(43, 8, 'login', 0, 'Log in', '2024-03-10 15:45:17'),
	(44, 8, 'logout', 0, 'Log out', '2024-03-10 15:45:30');

-- Dumping structure for table qcpl_engagement.questions
CREATE TABLE IF NOT EXISTS `questions` (
  `question_id` int NOT NULL AUTO_INCREMENT,
  `qt_id` int DEFAULT NULL,
  `qc_id` int DEFAULT NULL,
  `english_question` varchar(255) NOT NULL,
  `tagalog_question` varchar(255) NOT NULL,
  `is_deleted` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`question_id`),
  KEY `qt_id` (`qt_id`),
  KEY `qc_id` (`qc_id`),
  CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`qt_id`) REFERENCES `question_type` (`qt_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`qc_id`) REFERENCES `question_category` (`qc_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table qcpl_engagement.questions: ~22 rows (approximately)
INSERT INTO `questions` (`question_id`, `qt_id`, `qc_id`, `english_question`, `tagalog_question`, `is_deleted`, `created_at`, `updated_at`) VALUES
	(31, 1, 1, 'Is our staff helpful?', 'Matulungin ba ang aming mga tauhan?', 0, '2024-02-26 01:34:49', '2024-02-26 01:34:49'),
	(32, 1, 2, 'Are you satisfied with the service you received?', 'Nasiyahan ka ba sa iyong serbisyong natanggap?', 0, '2024-02-26 01:37:02', '2024-02-26 01:37:02'),
	(33, 1, 3, 'Is the facility clean?', 'Malinis ba ang pasilidad?', 0, '2024-02-26 01:38:00', '2024-02-26 01:38:00'),
	(34, 3, 1, 'What qualities should our staff possess to better meet the needs of our customers?', 'Ano ang mga dapat na katangian ng aming mga tauhan para maging maganda ang serbisyo sa mga customer?', 1, '2024-02-26 01:44:05', '2024-03-10 09:51:41'),
	(35, 3, 3, 'How would you describe the overall ambiance and atmosphere of our facilities during your visit?', 'Paano mo ilalarawan ang overall na atmospera ng aming pasilidad sa iyong pagbisita?', 1, '2024-02-26 01:45:04', '2024-03-10 09:51:39'),
	(36, 3, 2, 'In your opinion, what enhancements or additions could be made to our services to enhance your overall experience?', 'Ano ang mga puwedeng idagdag sa aming serbisyo upang mapabuti ang iyong karanasan?', 1, '2024-02-26 01:47:13', '2024-03-10 09:51:36'),
	(38, 1, 1, 'How was your experience with our staffs?', 'Kumusta ang iyong karanasan sa aming mga tauhan?', 0, '2024-03-10 10:05:40', '2024-03-10 10:05:40'),
	(39, 1, 2, 'How was our service?', 'Kumusta ang aming serbisyo?', 0, '2024-03-10 10:06:36', '2024-03-10 10:10:11'),
	(40, 1, 3, 'Do you feel comfortable while waiting?', 'Komportable ka ba habang naghihintay?', 0, '2024-03-10 10:11:15', '2024-03-10 10:11:15'),
	(41, 3, 2, 'How was your overall experience in our service?\r\n', 'Kumusta ang iyong pangkalahatang karanasan sa aming serbisyo?', 0, '2024-03-10 10:14:32', '2024-03-10 10:14:32'),
	(42, 1, 1, 'asd', 'asd', 1, '2024-03-10 14:07:44', '2024-03-10 14:09:15'),
	(43, 1, 1, 'asd', 'asd', 1, '2024-03-10 14:08:32', '2024-03-10 14:09:17'),
	(44, 1, 1, 'ad', 'adasd', 1, '2024-03-10 14:13:31', '2024-03-10 14:15:12'),
	(45, 1, 1, 'ad', 'adasd', 1, '2024-03-10 14:14:57', '2024-03-10 14:15:10'),
	(46, 1, 1, 'asdsad', 'asdasd', 1, '2024-03-10 14:15:18', '2024-03-10 14:15:32'),
	(47, 1, 1, 'asdsad', 'asdasd', 1, '2024-03-10 14:15:25', '2024-03-10 14:15:34'),
	(48, 1, 2, 'ad', 'asdsad', 1, '2024-03-10 14:16:16', '2024-03-10 14:16:29'),
	(49, 1, 1, 'asdsad', 'xzcxzc', 1, '2024-03-10 14:16:39', '2024-03-10 14:24:52'),
	(50, 1, 1, 'asdzxcz', 'asdzxc', 1, '2024-03-10 14:23:51', '2024-03-10 14:24:51'),
	(51, 1, 1, 'asd', 'asd', 1, '2024-03-10 14:26:52', '2024-03-10 14:27:41'),
	(52, 1, 1, 'asd', 'asd', 1, '2024-03-10 14:27:23', '2024-03-10 14:27:39'),
	(53, 1, 1, 'test1', 'test1', 1, '2024-03-10 14:34:34', '2024-03-10 14:34:53');

-- Dumping structure for table qcpl_engagement.question_category
CREATE TABLE IF NOT EXISTS `question_category` (
  `qc_id` int NOT NULL AUTO_INCREMENT,
  `question_category` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`qc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table qcpl_engagement.question_category: ~3 rows (approximately)
INSERT INTO `question_category` (`qc_id`, `question_category`, `created_at`, `updated_at`) VALUES
	(1, 'Staff', '2024-01-22 06:54:45', '2024-01-22 06:54:45'),
	(2, 'Service', '2024-01-22 06:54:53', '2024-01-22 06:54:53'),
	(3, 'Facility', '2024-01-22 06:55:01', '2024-03-10 14:55:29');

-- Dumping structure for table qcpl_engagement.question_type
CREATE TABLE IF NOT EXISTS `question_type` (
  `qt_id` int NOT NULL AUTO_INCREMENT,
  `question_type` varchar(255) NOT NULL,
  `multiple_choice` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`qt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table qcpl_engagement.question_type: ~3 rows (approximately)
INSERT INTO `question_type` (`qt_id`, `question_type`, `multiple_choice`, `created_at`, `updated_at`) VALUES
	(1, 'Emoji-based', 0, '2024-01-22 08:51:53', '2024-01-22 08:51:53'),
	(2, 'Multiple Selection', 1, '2024-02-10 06:56:20', '2024-03-10 14:59:10'),
	(3, 'Text-based', 0, '2024-01-22 08:52:02', '2024-02-12 20:21:50'),
	(21, 'test', 0, '2024-03-10 15:13:54', '2024-03-10 15:13:54');

-- Dumping structure for table qcpl_engagement.queue
CREATE TABLE IF NOT EXISTS `queue` (
  `queue_id` int NOT NULL AUTO_INCREMENT,
  `total_queue` int NOT NULL,
  `queue_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`queue_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table qcpl_engagement.queue: ~15 rows (approximately)
INSERT INTO `queue` (`queue_id`, `total_queue`, `queue_date`, `updated_at`) VALUES
	(1, 5, '2024-01-21 16:00:00', '2024-01-22 06:16:54'),
	(2, 2, '2024-01-22 16:00:00', '2024-01-23 03:41:27'),
	(3, 11, '2024-01-28 16:00:00', '2024-01-29 08:59:53'),
	(4, 7, '2024-01-29 16:00:00', '2024-01-30 07:39:10'),
	(5, 1, '2024-01-31 16:00:00', '2024-02-01 05:45:13'),
	(6, 3, '2024-02-05 16:00:00', '2024-02-06 07:35:00'),
	(7, 1, '2024-02-06 16:00:00', '2024-02-07 05:24:15'),
	(8, 6, '2024-02-07 16:00:00', '2024-02-08 01:30:33'),
	(9, 14, '2024-02-08 16:00:00', '2024-02-08 20:28:06'),
	(10, 10, '2024-02-09 16:00:00', '2024-02-10 15:36:10'),
	(11, 12, '2024-02-12 16:00:00', '2024-02-13 07:18:24'),
	(12, 1, '2024-02-14 16:00:00', '2024-02-15 00:11:06'),
	(13, 6, '2024-02-16 16:00:00', '2024-02-17 15:58:39'),
	(14, 2, '2024-02-17 16:00:00', '2024-02-17 16:07:49'),
	(15, 5, '2024-02-18 16:00:00', '2024-02-19 15:53:38'),
	(16, 13, '2024-02-19 16:00:00', '2024-02-20 02:53:39'),
	(17, 13, '2024-02-25 16:00:00', '2024-02-26 12:53:05'),
	(18, 1, '2024-03-02 16:00:00', '2024-03-03 13:34:14'),
	(19, 5, '2024-03-03 16:00:00', '2024-03-04 13:29:39'),
	(20, 1, '2024-03-08 16:00:00', '2024-03-09 05:09:40'),
	(21, 8, '2024-03-09 16:00:00', '2024-03-10 11:17:46');

-- Dumping structure for table qcpl_engagement.queue_details
CREATE TABLE IF NOT EXISTS `queue_details` (
  `qd_id` int NOT NULL AUTO_INCREMENT,
  `client_id` int DEFAULT NULL,
  `queue_number` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT '0 = Pending\r\n1 = Complete',
  `entry_check` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 - Rejected 1 - Passed',
  `is_inside` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = Waiting\r\n1 = Inside\r\n2 = Done',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`qd_id`),
  KEY `client_id` (`client_id`),
  CONSTRAINT `queue_details_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=187 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table qcpl_engagement.queue_details: ~116 rows (approximately)
INSERT INTO `queue_details` (`qd_id`, `client_id`, `queue_number`, `service`, `status`, `entry_check`, `is_inside`, `created_at`, `updated_at`) VALUES
	(65, 40, 'N-00001', 'NBI', 0, 1, 0, '2024-02-08 20:02:46', '2024-02-09 14:03:09'),
	(66, 40, 'N-00001', 'Police', 0, 1, 0, '2024-02-08 20:02:46', '2024-02-09 14:03:09'),
	(67, 41, 'P-00001', 'Police', 0, 1, 0, '2024-02-08 20:03:06', '2024-02-08 20:03:06'),
	(68, 42, 'P-00002', 'Police', 0, 1, 0, '2024-02-08 20:03:52', '2024-02-08 20:03:52'),
	(75, 48, 'N-00002', 'Police', 0, 1, 0, '2024-02-08 20:25:28', '2024-02-08 20:25:28'),
	(76, 49, 'P-00003', 'NBI', 0, 1, 0, '2024-02-08 20:26:36', '2024-02-08 20:26:36'),
	(77, 49, 'P-00003', 'Police', 0, 1, 0, '2024-02-08 20:26:36', '2024-02-08 20:26:36'),
	(78, 50, 'P-00004', 'NBI', 0, 1, 0, '2024-02-08 20:27:33', '2024-02-08 20:27:33'),
	(79, 51, 'N-00003', 'PSA', 0, 1, 0, '2024-02-08 20:28:06', '2024-02-08 20:28:06'),
	(80, 52, 'N-00001', 'NBI', 0, 1, 0, '2024-02-10 13:29:39', '2024-02-13 01:32:44'),
	(81, 53, 'N-00002', 'NBI', 0, 1, 0, '2024-02-10 13:45:13', '2024-02-10 13:45:13'),
	(82, 54, 'N-00003', 'NBI', 0, 1, 0, '2024-02-10 13:51:14', '2024-02-10 13:51:14'),
	(83, 55, 'N-00004', 'NBI', 0, 1, 0, '2024-02-10 13:54:54', '2024-02-10 13:54:54'),
	(84, 56, 'P-00001', 'NBI', 0, 1, 0, '2024-02-10 13:57:19', '2024-02-10 13:57:19'),
	(85, 57, 'P-00002', 'NBI', 0, 1, 0, '2024-02-10 15:01:54', '2024-02-10 15:01:54'),
	(86, 58, 'P-00003', 'NBI', 0, 1, 0, '2024-02-10 15:07:05', '2024-02-10 15:07:05'),
	(87, 59, 'P-00004', 'NBI', 0, 1, 0, '2024-02-10 15:17:47', '2024-02-10 15:17:47'),
	(88, 60, 'N-00005', 'Police', 0, 1, 0, '2024-02-10 15:24:37', '2024-02-10 15:24:37'),
	(89, 61, 'N-00006', 'NBI', 0, 1, 0, '2024-02-10 15:36:10', '2024-02-10 15:36:10'),
	(90, 62, 'P-00001', 'NBI', 1, 1, 0, '2024-02-12 19:26:46', '2024-02-13 06:12:53'),
	(91, 63, 'P-00002', 'NBI', 2, 1, 1, '2024-02-13 01:47:12', '2024-03-04 13:55:08'),
	(92, 63, 'P-00002', 'Police', 1, 1, 0, '2024-02-13 01:47:12', '2024-02-13 06:07:57'),
	(93, 63, 'P-00002', 'PSA', 1, 1, 0, '2024-02-13 01:47:12', '2024-02-13 06:07:57'),
	(94, 64, 'P-00003', 'NBI', 2, 1, 1, '2024-02-13 02:57:46', '2024-03-04 13:55:08'),
	(95, 65, 'N-00001', 'NBI', 2, 1, 1, '2024-02-13 02:58:21', '2024-03-04 13:55:07'),
	(96, 66, 'P-00004', 'Police', 1, 1, 0, '2024-02-13 03:02:57', '2024-02-13 06:13:22'),
	(97, 67, 'P-00005', 'Police', 1, 1, 0, '2024-02-13 03:03:43', '2024-02-13 06:13:26'),
	(98, 68, 'P-00006', 'PSA', 1, 1, 0, '2024-02-13 03:06:33', '2024-02-13 06:13:31'),
	(99, 69, 'P-00007', 'NBI', 1, 1, 0, '2024-02-13 06:16:46', '2024-02-13 06:18:02'),
	(100, 70, 'P-00008', 'PSA', 2, 1, 0, '2024-02-13 06:20:39', '2024-02-13 06:35:15'),
	(101, 71, 'N-00002', 'Police', 0, 1, 0, '2024-02-13 06:22:11', '2024-02-13 06:22:11'),
	(102, 72, 'P-00009', 'NBI', 0, 1, 0, '2024-02-13 07:06:30', '2024-02-13 07:06:30'),
	(103, 73, 'P-00010', 'Police', 0, 1, 0, '2024-02-13 07:18:24', '2024-02-13 07:18:24'),
	(104, 74, 'N-00001', 'NBI', 0, 1, 0, '2024-02-15 00:11:06', '2024-02-15 00:11:06'),
	(105, 75, 'N-00001', 'PSA', 1, 1, 0, '2024-02-17 05:10:26', '2024-02-17 15:01:37'),
	(106, 75, 'N-00001', 'Clearance', 1, 1, 1, '2024-02-17 05:10:26', '2024-03-04 13:55:05'),
	(107, 76, 'N-00002', 'NBI', 0, 1, 0, '2024-02-17 15:54:20', '2024-02-17 15:54:20'),
	(108, 77, 'N-00003', 'NBI', 0, 1, 0, '2024-02-17 15:55:16', '2024-02-17 15:55:16'),
	(109, 77, 'N-00003', 'Police', 0, 1, 0, '2024-02-17 15:55:16', '2024-02-17 15:55:16'),
	(110, 78, 'N-00004', 'NBI', 0, 1, 0, '2024-02-17 15:55:57', '2024-02-17 15:55:57'),
	(111, 78, 'N-00004', 'Police', 0, 1, 0, '2024-02-17 15:55:57', '2024-02-17 15:55:57'),
	(112, 79, 'P-00001', 'NBI', 0, 1, 0, '2024-02-17 15:57:55', '2024-02-17 15:57:55'),
	(113, 79, 'P-00001', 'Police', 0, 1, 0, '2024-02-17 15:57:55', '2024-02-17 15:57:55'),
	(114, 79, 'P-00001', 'das', 0, 1, 2, '2024-02-17 15:57:55', '2024-03-04 13:59:22'),
	(115, 80, 'N-00005', 'NBI', 0, 1, 0, '2024-02-17 15:58:39', '2024-02-17 15:58:39'),
	(116, 81, 'P-00001', 'NBI', 1, 1, 0, '2024-02-17 16:04:11', '2024-02-17 20:37:19'),
	(117, 82, 'P-00002', 'NBI', 1, 1, 0, '2024-02-17 16:07:49', '2024-02-17 22:48:20'),
	(118, 83, 'N-00001', 'NBI', 2, 0, 1, '2024-02-19 09:44:13', '2024-03-04 13:55:06'),
	(119, 83, 'N-00001', 'Police', 2, 0, 0, '2024-02-19 09:44:13', '2024-02-19 13:07:03'),
	(120, 84, 'P-00001', 'NBI', 1, 1, 0, '2024-02-19 13:09:17', '2024-02-19 13:16:45'),
	(121, 84, 'P-00001', 'Police', 1, 1, 0, '2024-02-19 13:09:17', '2024-02-19 13:16:45'),
	(122, 84, 'P-00001', 'test', 2, 0, 0, '2024-02-19 13:09:17', '2024-02-19 13:15:49'),
	(123, 85, 'P-00002', 'NBI', 0, 1, 0, '2024-02-19 15:42:37', '2024-02-19 15:42:37'),
	(124, 85, 'P-00002', 'Police', 0, 1, 0, '2024-02-19 15:42:37', '2024-02-19 15:42:37'),
	(125, 86, 'P-00003', 'NBI', 0, 1, 0, '2024-02-19 15:52:55', '2024-02-19 15:52:55'),
	(126, 86, 'P-00003', 'Police', 0, 1, 0, '2024-02-19 15:52:55', '2024-02-19 15:52:55'),
	(127, 87, 'N-00002', 'test12', 0, 1, 0, '2024-02-19 15:53:38', '2024-02-19 15:53:38'),
	(128, 87, 'N-00002', 'ad', 0, 1, 1, '2024-02-19 15:53:38', '2024-03-04 13:58:52'),
	(129, 88, 'P-00001', 'Police', 1, 1, 0, '2024-02-19 16:12:21', '2024-02-19 16:21:45'),
	(130, 89, 'P-00002', 'Police', 1, 1, 0, '2024-02-19 16:12:50', '2024-02-19 16:23:07'),
	(131, 90, 'P-00003', 'Police', 1, 1, 0, '2024-02-19 16:13:35', '2024-02-19 16:19:44'),
	(132, 90, 'P-00003', 'asd', 1, 1, 1, '2024-02-19 16:13:35', '2024-03-04 13:55:03'),
	(133, 90, 'P-00003', 'zxczc ', 2, 0, 0, '2024-02-19 16:13:35', '2024-02-19 16:17:33'),
	(134, 91, 'P-00004', 'NBI', 2, 0, 1, '2024-02-19 16:14:24', '2024-03-04 13:55:06'),
	(135, 91, 'P-00004', 'Police', 2, 0, 0, '2024-02-19 16:14:24', '2024-02-19 16:18:01'),
	(136, 91, 'P-00004', 'zxc', 2, 0, 0, '2024-02-19 16:14:24', '2024-02-19 16:18:01'),
	(137, 92, 'N-00001', 'Police', 1, 1, 0, '2024-02-19 16:15:06', '2024-02-19 16:25:34'),
	(138, 93, 'N-00002', 'sad', 1, 1, 0, '2024-02-19 17:22:31', '2024-02-19 17:22:50'),
	(139, 94, 'N-00003', 'NBI', 1, 1, 0, '2024-02-19 17:36:58', '2024-02-19 17:37:20'),
	(140, 95, 'N-00004', 'NBI', 1, 1, 1, '2024-02-19 17:39:10', '2024-03-04 13:59:33'),
	(141, 96, 'P-00005', 'Police', 1, 1, 0, '2024-02-19 17:42:22', '2024-02-19 17:44:05'),
	(142, 97, 'P-00006', 'NBI', 1, 1, 1, '2024-02-19 17:42:55', '2024-03-04 13:57:49'),
	(143, 98, 'N-00005', 'Police', 1, 1, 0, '2024-02-19 17:43:27', '2024-02-19 17:45:38'),
	(144, 99, 'N-00006', 'Police', 1, 1, 0, '2024-02-19 18:35:52', '2024-02-19 18:36:08'),
	(145, 100, 'N-00007', 'NBI', 1, 1, 1, '2024-02-20 02:53:39', '2024-03-04 13:57:01'),
	(146, 101, 'P-00001', 'NBI', 1, 1, 1, '2024-02-26 00:33:13', '2024-03-04 13:55:17'),
	(147, 102, 'P-00002', 'Police', 1, 1, 0, '2024-02-26 00:39:30', '2024-02-26 03:11:01'),
	(148, 103, 'N-00001', 'NBI', 1, 1, 1, '2024-02-26 00:42:26', '2024-03-04 13:55:12'),
	(149, 103, 'N-00001', 'Police', 1, 1, 0, '2024-02-26 00:42:26', '2024-02-26 02:00:25'),
	(150, 104, 'N-00002', 'Police', 1, 1, 0, '2024-02-26 00:45:21', '2024-02-26 02:02:24'),
	(151, 104, 'N-00002', 'sdasd', 1, 1, 0, '2024-02-26 00:45:21', '2024-02-26 02:02:24'),
	(152, 105, 'N-00003', 'Police', 1, 1, 0, '2024-02-26 00:45:39', '2024-02-26 03:09:59'),
	(153, 106, 'P-00003', 'NBI', 1, 1, 1, '2024-02-26 03:18:14', '2024-03-04 13:55:10'),
	(154, 106, 'P-00003', 'Police', 1, 1, 0, '2024-02-26 03:18:14', '2024-02-26 09:45:07'),
	(155, 107, 'P-00004', 'Police', 1, 1, 0, '2024-02-26 09:44:12', '2024-02-26 10:02:14'),
	(156, 108, 'P-00005', 'Police', 1, 1, 0, '2024-02-26 10:25:39', '2024-02-26 10:44:19'),
	(157, 109, 'N-00004', 'Police', 0, 1, 0, '2024-02-26 10:26:30', '2024-02-26 10:26:30'),
	(158, 109, 'N-00004', 'adas', 0, 1, 1, '2024-02-26 10:26:30', '2024-03-04 13:55:03'),
	(159, 110, 'P-00006', 'Police', 0, 1, 0, '2024-02-26 10:26:49', '2024-02-26 10:26:49'),
	(160, 111, 'P-00007', 'NBI', 0, 1, 0, '2024-02-26 10:42:30', '2024-02-26 10:42:30'),
	(161, 111, 'P-00007', 'Police', 0, 1, 0, '2024-02-26 10:42:30', '2024-02-26 10:42:30'),
	(162, 112, 'P-00008', 'NBI', 0, 1, 0, '2024-02-26 10:43:18', '2024-02-26 10:43:18'),
	(163, 112, 'P-00008', 'Police', 0, 1, 0, '2024-02-26 10:43:18', '2024-02-26 10:43:18'),
	(164, 113, 'N-00005', 'NBI', 1, 1, 1, '2024-02-26 12:53:05', '2024-03-04 13:55:09'),
	(165, 113, 'N-00005', 'Police', 1, 1, 0, '2024-02-26 12:53:05', '2024-02-26 12:53:54'),
	(166, 114, 'N-00001', 'Police', 0, 1, 0, '2024-03-03 13:34:14', '2024-03-03 13:36:01'),
	(167, 115, 'P-00001', 'Police', 2, 0, 0, '2024-03-04 13:27:48', '2024-03-04 13:39:38'),
	(168, 116, 'P-00002', 'NBI', 0, 1, 0, '2024-03-04 13:28:10', '2024-03-04 13:28:10'),
	(169, 116, 'P-00002', 'aw', 0, 1, 1, '2024-03-04 13:28:10', '2024-03-04 13:58:51'),
	(170, 117, 'P-00003', 'NBI', 0, 1, 0, '2024-03-04 13:28:33', '2024-03-04 13:28:33'),
	(171, 117, 'P-00003', 'Police', 0, 1, 0, '2024-03-04 13:28:33', '2024-03-04 13:28:33'),
	(172, 118, 'P-00004', 'NBI', 0, 1, 0, '2024-03-04 13:29:19', '2024-03-04 13:29:19'),
	(173, 118, 'P-00004', 'Police', 0, 1, 0, '2024-03-04 13:29:19', '2024-03-04 13:29:19'),
	(174, 119, 'N-00001', 'Police', 0, 1, 0, '2024-03-04 13:29:39', '2024-03-04 13:29:39'),
	(175, 120, 'N-00001', 'Police', 1, 1, 0, '2024-03-09 05:09:40', '2024-03-09 05:10:18'),
	(176, 121, 'N-00001', 'NBI', 1, 1, 0, '2024-03-10 01:56:30', '2024-03-10 02:04:08'),
	(177, 121, 'N-00001', 'Police', 1, 1, 0, '2024-03-10 01:56:30', '2024-03-10 02:04:08'),
	(178, 122, 'N-00002', 'Police', 1, 1, 0, '2024-03-10 02:17:11', '2024-03-10 02:17:35'),
	(179, 123, 'P-00001', 'Police', 1, 1, 0, '2024-03-10 02:21:18', '2024-03-10 02:22:06'),
	(180, 124, 'P-00002', 'Police', 1, 1, 0, '2024-03-10 03:41:39', '2024-03-10 03:41:55'),
	(181, 125, 'P-00003', 'Police', 1, 1, 0, '2024-03-10 03:49:03', '2024-03-10 03:49:26'),
	(182, 125, 'P-00003', 'sda', 1, 1, 0, '2024-03-10 03:49:03', '2024-03-10 03:49:26'),
	(183, 126, 'N-00003', 'NBI', 1, 1, 0, '2024-03-10 10:14:58', '2024-03-10 10:19:23'),
	(184, 126, 'N-00003', 'Police', 1, 1, 0, '2024-03-10 10:14:58', '2024-03-10 10:19:23'),
	(185, 127, 'N-00004', 'Police', 1, 1, 0, '2024-03-10 10:23:26', '2024-03-10 10:23:40'),
	(186, 128, 'N-00005', 'NBI', 0, 1, 0, '2024-03-10 11:17:46', '2024-03-10 11:17:46');

-- Dumping structure for table qcpl_engagement.service
CREATE TABLE IF NOT EXISTS `service` (
  `service_id` int NOT NULL AUTO_INCREMENT,
  `service` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table qcpl_engagement.service: ~0 rows (approximately)

-- Dumping structure for table qcpl_engagement.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_role_id` int DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0',
  `last_login` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  KEY `user_role_id` (`user_role_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`user_role_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table qcpl_engagement.users: ~3 rows (approximately)
INSERT INTO `users` (`user_id`, `user_role_id`, `username`, `password`, `is_active`, `last_login`, `created_at`, `updated_at`) VALUES
	(4, 1, 'sta_clara', '$2y$10$MRaoOOnRQ69KTufCOTKo3u87J0E41e3XIIvYSr/3vG58uJ6NDtWWS', 0, '2024-03-10 13:19:51', '2023-12-28 02:52:00', '2024-03-10 14:10:06'),
	(5, 2, 'staff', '$2y$10$pk3hTpWf00wNWmTR6XtSY.mOzNX3T8Gy.tmlArEtxEY3djTzoCnE6', 0, '2024-03-10 11:53:43', '2023-12-28 02:53:48', '2024-03-10 13:15:49'),
	(7, 1, 'bogart123', '$2y$10$6ylVVS1GM8EcPJGafvmlJ.s5JljOWi3jYT9W97DN1JTYFPGWb.Xfq', 0, '0000-00-00 00:00:00', '2024-01-23 02:35:23', '2024-03-10 14:32:04'),
	(8, 1, 'admin', '$2y$10$cEs4Nkyq9pyL4wFModVWbelahSrzNPfEqb0/rMvpIIjlMpngy7PlW', 0, '2024-03-10 15:45:17', '2024-03-10 13:13:43', '2024-03-10 15:45:17');

-- Dumping structure for table qcpl_engagement.user_role
CREATE TABLE IF NOT EXISTS `user_role` (
  `user_role_id` int NOT NULL AUTO_INCREMENT,
  `user_role` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table qcpl_engagement.user_role: ~2 rows (approximately)
INSERT INTO `user_role` (`user_role_id`, `user_role`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', '2023-12-06 14:57:56', '2023-12-06 15:01:56'),
	(2, 'Staff', '2023-12-06 14:58:17', '2023-12-06 15:02:06');

-- Dumping structure for view qcpl_engagement.busiest_times
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `busiest_times`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `busiest_times` AS select concat(`hour_table`.`hour`,':00') AS `hour`,sum(if((dayofweek(`client`.`created_at`) = 2),1,0)) AS `monday`,sum(if((dayofweek(`client`.`created_at`) = 3),1,0)) AS `tuesday`,sum(if((dayofweek(`client`.`created_at`) = 4),1,0)) AS `wednesday`,sum(if((dayofweek(`client`.`created_at`) = 5),1,0)) AS `thursday`,sum(if((dayofweek(`client`.`created_at`) = 6),1,0)) AS `friday` from (((select '8' AS `hour` union select '9' AS `9` union select '10' AS `10` union select '11' AS `11` union select '12' AS `12` union select '13' AS `13` union select '14' AS `14` union select '15' AS `15` union select '16' AS `16` union select '17' AS `17`) `hour_table` join (select 1 AS `day` union select 2 AS `2` union select 3 AS `3` union select 4 AS `4` union select 5 AS `5`) `day_table`) left join `client` on(((hour(`client`.`created_at`) = `hour_table`.`hour`) and (dayofweek(`client`.`created_at`) = `day_table`.`day`)))) where ((yearweek(`client`.`created_at`,1) = yearweek(curdate(),1)) or (`client`.`created_at` is null)) group by `hour_table`.`hour` order by (case `hour_table`.`hour` when '8' then 1 when '9' then 2 when '10' then 3 when '11' then 4 when '12' then 5 when '13' then 6 when '14' then 7 when '15' then 8 when '16' then 9 when '17' then 10 end);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
