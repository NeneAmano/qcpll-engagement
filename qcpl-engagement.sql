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

-- Dumping data for table qcpl_engagement.choices: ~4 rows (approximately)
INSERT INTO `choices` (`choice_id`, `question_id`, `choice`, `is_deleted`, `created_at`, `updated_at`) VALUES
	(5, 22, 'Online Search [Sa Internet]', 0, '2024-02-12 20:41:35', '2024-02-12 20:41:35'),
	(6, 22, 'Word of Mouth [Kwento ng Iba]', 0, '2024-02-12 20:41:35', '2024-02-12 20:41:35'),
	(7, 22, 'Social Media [Facebook, Twitter, Instagram, etc.]', 0, '2024-02-12 20:41:35', '2024-02-12 20:41:35'),
	(8, 22, 'Government Website [Sa website ng pamahalaan]', 0, '2024-02-12 20:41:35', '2024-02-12 20:41:35'),
	(9, 22, 'Printed Materials (Flyers, Brochures) [Naka-print na Materyales]', 0, '2024-02-12 20:41:35', '2024-02-12 20:41:35'),
	(10, 22, 'Referral from a Friend or Family [Sa payo ng kaibigan o kamag-anak]', 0, '2024-02-12 20:41:35', '2024-02-12 20:41:35'),
	(11, 23, 'Helpful customer service. [Matulunging customer service.]', 0, '2024-02-12 20:43:26', '2024-02-12 20:43:26'),
	(12, 23, 'Diverse services for specific needs. [Iba\'t ibang serbisyo para sa pangangailangan.]', 0, '2024-02-12 20:43:26', '2024-02-12 20:43:26'),
	(13, 23, 'Clean and organized facilities. [Malinis at maayos na pasilidad.]', 0, '2024-02-12 20:43:26', '2024-02-12 20:43:26'),
	(14, 23, 'Timely service delivery. [Mabilis na paghahatid ng serbisyo.]', 0, '2024-02-12 20:43:26', '2024-02-12 20:43:26'),
	(15, 23, 'Easy accessibility. [Madaling ma-access.]', 0, '2024-02-12 20:43:26', '2024-02-12 20:43:26'),
	(16, 23, 'Knowledgeable staff. [Maraming kaalaman ang mga kawani.]', 0, '2024-02-12 20:43:26', '2024-02-12 20:43:26'),
	(17, 24, 'Customer Service [Serbisyo sa customer]', 0, '2024-02-12 20:45:01', '2024-02-12 20:45:01'),
	(18, 24, 'Service Variety [Iba\'t ibang uri ng serbisyo]', 0, '2024-02-12 20:45:01', '2024-02-12 20:45:01'),
	(19, 24, 'Facility Cleanliness and Organization [Kalinisan at ayos ng pasilidad]', 0, '2024-02-12 20:45:01', '2024-02-12 20:45:01'),
	(20, 24, 'Timeliness of Service [Bilis ng serbisyo]', 0, '2024-02-12 20:45:01', '2024-02-12 20:45:01'),
	(21, 24, 'Service Accessibility [Aksisibilidad sa serbisyo]', 0, '2024-02-12 20:45:01', '2024-02-12 20:45:01'),
	(22, 24, 'Staff Knowledge and Training [Kaalaman at kasanayan ng kawani]', 0, '2024-02-12 20:45:01', '2024-02-12 20:45:01'),
	(23, 24, 'None', 0, '2024-02-12 20:45:01', '2024-02-12 20:45:01');

-- Dumping structure for table qcpl_engagement.client
CREATE TABLE IF NOT EXISTS `client` (
  `client_id` int NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table qcpl_engagement.client: ~26 rows (approximately)
INSERT INTO `client` (`client_id`, `f_name`, `m_name`, `l_name`, `suffix`, `age_id`, `gender`, `education`, `occupation`, `status`, `created_at`, `updated_at`) VALUES
	(35, 'da', 'das', 'das', 'das', 5, 'Male', 'Doctorate Degree', 'Employed', 1, '2024-02-08 01:26:03', '2024-02-08 01:26:03'),
	(36, 'dasd', 'dsad', 'dasd', 'da', 3, 'Female', 'College Level', 'Unemployed', 2, '2024-02-08 01:29:29', '2024-02-08 01:29:29'),
	(37, 'da', 'das', 'das', 'd', 3, 'Male', 'Masters Degree', 'Unemployed', 0, '2024-02-08 01:30:33', '2024-02-08 01:30:33'),
	(38, 'zcxxz', 'zcxzxczxc', 'zxczxc', 'zxczxc', 3, 'Male', 'Elementary Graduate', 'Student', 0, '2024-02-08 19:46:33', '2024-02-08 19:46:33'),
	(39, 'asdasd', 'zcxzxcasdasdzxc', 'asdasd', '', 3, 'Others', 'HighSchool Graduate', 'Student', 2, '2024-02-08 19:47:08', '2024-02-08 19:47:08'),
	(40, 'asdasd', 'zczxczxc', 'asdasd', '', 3, 'Male', 'HighSchool Level', 'Student', 0, '2024-02-08 20:02:46', '2024-02-08 20:02:46'),
	(41, 'qweqwe', '', 'qweqweqwe', '', 5, 'Male', 'Elementary Graduate', 'Student', 1, '2024-02-08 20:03:06', '2024-02-08 20:03:06'),
	(42, 'xczxc', '', 'zxcxzc', '', 3, 'Male', 'HighSchool Level', 'Unemployed', 3, '2024-02-08 20:03:52', '2024-02-08 20:03:52'),
	(43, 'xzcxzcxc', '', 'ss', '', 3, 'Male', 'HighSchool Level', 'Unemployed', 0, '2024-02-08 20:04:23', '2024-02-08 20:04:23'),
	(44, 'asd', '', 'zxc', '', 3, 'Others', 'College Level', 'Retired', 0, '2024-02-08 20:08:38', '2024-02-08 20:08:38'),
	(45, 'cvcv', '', 'cvcvcv', '', 2, 'Female', 'HighSchool Level', 'Student', 0, '2024-02-08 20:15:51', '2024-02-08 20:15:51'),
	(46, 'da', '', 'zcx', '', 5, 'Male', 'HighSchool Level', 'Unemployed', 1, '2024-02-08 20:22:00', '2024-02-08 20:22:00'),
	(47, 'qwesad', '', 'xzc', '', 3, 'Female', 'Vocational', 'Employed', 0, '2024-02-08 20:23:45', '2024-02-08 20:23:45'),
	(48, 'please gumana kana', 'nakikiusap ako', 'for the love of god', 'please work', 3, 'Male', 'Elementary Graduate', 'Unemployed', 0, '2024-02-08 20:25:28', '2024-02-08 20:25:28'),
	(49, 'Gumana ka', 'Please', 'For the love of our beloved maker', 'Please work', 2, 'Female', 'Elementary Graduate', 'Employed', 2, '2024-02-08 20:26:36', '2024-02-08 20:26:36'),
	(50, 'zxc', 'zc', 'zxczxc', '', 5, 'Female', 'Elementary Graduate', 'Unemployed', 1, '2024-02-08 20:27:33', '2024-02-08 20:27:33'),
	(51, 'zcxvxcvcxv', 'zccvcxvcxv', 'zxczxcxcvcxvcxv', 'cxvcxvcx', 3, 'Others', 'Vocational', 'Employed', 0, '2024-02-08 20:28:06', '2024-02-08 20:28:06'),
	(52, 'Washing', '', 'Machine', '', 2, 'Female', 'Elementary Graduate', 'Unemployed', 0, '2024-02-10 13:29:39', '2024-02-10 13:29:39'),
	(53, 'sadasd', 'zxc', 'sdasd', '', 2, 'Female', 'Elementary Graduate', 'Employed', 0, '2024-02-10 13:45:13', '2024-02-10 13:45:13'),
	(54, 'asdxzc', '', 'zxczxc', '', 3, 'Female', 'Elementary Graduate', 'Student', 0, '2024-02-10 13:51:14', '2024-02-10 13:51:14'),
	(55, 'test', '', 'test', '', 3, 'Female', 'Masters Degree', 'Unemployed', 0, '2024-02-10 13:54:54', '2024-02-10 13:54:54'),
	(56, 'vbvbvbvbvbvb', '', 'vbvbvbvbvb', '', 3, 'Others', 'HighSchool Graduate', 'Employed', 2, '2024-02-10 13:57:19', '2024-02-10 13:57:19'),
	(57, 'asd', 'asd', 'asd', 'as', 3, 'Others', 'Elementary Graduate', 'Employed', 2, '2024-02-10 15:01:54', '2024-02-10 15:01:54'),
	(58, 'Bogart', 'Pederico', 'Pedring', 'Sr.', 5, 'Male', 'Elementary Graduate', 'Student', 1, '2024-02-10 15:07:05', '2024-02-10 15:07:05'),
	(59, 'awaasdasd', 'sadzxc', 'zxc', '', 3, 'Female', 'HighSchool Level', 'Unemployed', 3, '2024-02-10 15:17:47', '2024-02-10 15:17:47'),
	(60, 'qweqweqwe', '', 'qweqweqwe', '', 2, 'Female', 'Elementary Graduate', 'Student', 0, '2024-02-10 15:24:37', '2024-02-10 15:24:37'),
	(61, 'zxc', '', 'zxc', '', 3, 'Others', 'HighSchool Level', 'Employed', 0, '2024-02-10 15:36:10', '2024-02-10 15:36:10'),
	(62, 'test', '', 'test', '', 3, 'Female', 'HighSchool Graduate', 'Employed', 2, '2024-02-12 19:26:46', '2024-02-12 19:26:46');

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
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table qcpl_engagement.emoji: ~6 rows (approximately)
INSERT INTO `emoji` (`emoji_id`, `image_path`, `_char`, `image`, `unicode_codepoint`, `occurrences`, `_position`, `negative`, `neutral`, `positive`, `sentiment_score`, `unicode_name`, `unicode_block`, `remarks`, `in_choices`, `created_at`, `updated_at`) VALUES
	(106, 'public/assets/images/emojis/ANGRY FACE.png', '😠', '😠', '0x1f620', 288, 0.849, 0.564, 0.172, 0.265, -0.299, 'ANGRY FACE', 'Emoticons', 'A yellow face with a frowning mouth and eyes and eyebrows scrunched downward in anger. Conveys varying degrees of anger, from grumpiness and irritation to disgust and outrage. May also represent someone acting tough or being mean.', 1, '2024-02-12 20:00:36', '2024-02-12 20:00:38'),
	(107, 'public/assets/images/emojis/DISAPPOINTED FACE.png', '😞', '😞', '0x1f61e', 532, 0.825, 0.479, 0.161, 0.361, -0.118, 'DISAPPOINTED FACE', 'Emoticons', 'A yellow face with a frown and closed, downcast eyes, as if aching with sorrow or pain. May convey a variety of unhappy emotions, including disappointment, grief, stress, regret, and remorse. Similar to 😔 Pensive Face, but with a sadder, more hurt expression. Samsung’s design previously featured an expression closer to 😕 Confused Face.', 1, '2024-02-12 20:00:55', '2024-02-12 20:00:56'),
	(108, 'public/assets/images/emojis/NEUTRAL FACE.png', '😐', '😐', '0x1f610', 270, 0.883, 0.553, 0.282, 0.165, -0.388, 'NEUTRAL FACE', 'Emoticons', 'A yellow face with simple, open eyes and a flat, closed mouth. Intended to depict a neutral sentiment but often used to convey mild irritation and concern or a deadpan sense of humor. Goes Great With', 1, '2024-02-12 20:01:13', '2024-02-12 20:01:14'),
	(109, 'public/assets/images/emojis/SMILING FACE WITH SMILING EYES.png', '😊', '😊', '0x1f60a', 3186, 0.813, 0.060, 0.237, 0.704, 0.644, 'SMILING FACE WITH SMILING EYES', 'Emoticons', 'A yellow face with smiling eyes and a broad, closed smile turning up to rosy cheeks. Often expresses genuine happiness and warm, positive feelings. An emoji form of the ^^ emoticon.', 1, '2024-02-12 20:01:33', '2024-02-12 20:01:33'),
	(110, 'public/assets/images/emojis/SMILING FACE WITH OPEN MOUTH AND SMILING EYES.png', '😄', '😄', '0x1f604', 1398, 0.795, 0.137, 0.305, 0.558, 0.421, 'SMILING FACE WITH OPEN MOUTH AND SMILING EYES', 'Emoticons', 'A yellow face with smiling eyes and a broad, open smile, showing upper teeth and tongue on some platforms. Often conveys general happiness and good-natured amusement. Similar to 😀 Grinning Face and 😃 Grinning Face With Big Eyes, but with warmer, less excited eyes.', 1, '2024-02-12 20:01:49', '2024-02-12 20:01:51'),
	(111, 'public/assets/images/emojis/GROWING HEART.png', '💗', '💗', '0x1f497', 836, 0.800, 0.051, 0.241, 0.708, 0.657, 'GROWING HEART', 'Miscellaneous Symbols and Pictographs', 'A pink heart, inside a slightly larger pink heart, inside a larger-again pink heart. Intended to give the impression of a heart increasing in size. An early Apple design displayed as a plain Pink Heart.', 0, '2024-02-12 20:02:47', '2024-02-12 20:03:03');

-- Dumping structure for table qcpl_engagement.feedback
CREATE TABLE IF NOT EXISTS `feedback` (
  `feedback_id` int NOT NULL AUTO_INCREMENT,
  `client_id` int DEFAULT NULL,
  `question_id` int DEFAULT NULL,
  `emoji_id` int DEFAULT NULL,
  `text_feedback` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`feedback_id`),
  KEY `client_id` (`client_id`),
  KEY `question_id` (`question_id`),
  KEY `emoji_id` (`emoji_id`),
  CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `feedback_ibfk_3` FOREIGN KEY (`emoji_id`) REFERENCES `emoji` (`emoji_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table qcpl_engagement.feedback: ~0 rows (approximately)

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table qcpl_engagement.questions: ~12 rows (approximately)
INSERT INTO `questions` (`question_id`, `qt_id`, `qc_id`, `english_question`, `tagalog_question`, `is_deleted`, `created_at`, `updated_at`) VALUES
	(9, 1, 1, 'Is our staff helpful?', 'Matulungin ba ang aming mga tauhan?', 0, '2024-02-10 09:07:13', '2024-02-10 09:07:13'),
	(10, 1, 1, 'How was your experience with our staff?', 'Kumusta ang iyong karanasan sa aming mga tauhan?', 0, '2024-02-10 09:09:56', '2024-02-10 09:09:56'),
	(11, 1, 2, 'How was our service?', 'Kumusta ang aming serbisyo?', 0, '2024-02-10 09:10:21', '2024-02-10 09:10:21'),
	(12, 1, 2, 'Are you satisfied with the service you received?', 'Nasiyahan ka ba sa iyong serbisyong natanggap?', 0, '2024-02-10 09:10:38', '2024-02-10 09:10:38'),
	(13, 1, 3, 'Is the facility clean?', 'Malinis ba ang pasilidad?', 0, '2024-02-10 09:10:53', '2024-02-10 09:10:53'),
	(14, 1, 3, 'Do you feel comfortable while waiting?', 'Komportable ka ba habang naghihintay?\r\n', 0, '2024-02-10 09:11:10', '2024-02-10 09:11:10'),
	(15, 3, 4, 'How was your overall experience with our system?', 'Kumusta ang iyong pangkalahatang karanasan sa aming sistema?', 0, '2024-02-10 09:11:37', '2024-02-10 09:11:37'),
	(22, 2, 2, 'How did you learn about our service?', 'Paano mo natuklasan ang aming serbisyo?', 0, '2024-02-12 20:41:35', '2024-02-12 20:41:35'),
	(23, 2, 4, 'What positive aspects or experiences would you like to share?', 'Ano ang mga positibong aspeto o karanasan na nais mong ibahagi?', 0, '2024-02-12 20:43:26', '2024-02-12 20:43:26'),
	(24, 2, 4, 'Category of concerns or issues faced?', 'Alin ang mga isyu na iyong nakita o naranasan?', 0, '2024-02-12 20:45:01', '2024-02-12 20:45:01');

-- Dumping structure for table qcpl_engagement.question_category
CREATE TABLE IF NOT EXISTS `question_category` (
  `qc_id` int NOT NULL AUTO_INCREMENT,
  `question_category` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`qc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table qcpl_engagement.question_category: ~4 rows (approximately)
INSERT INTO `question_category` (`qc_id`, `question_category`, `created_at`, `updated_at`) VALUES
	(1, 'Staff', '2024-01-22 06:54:45', '2024-01-22 06:54:45'),
	(2, 'Service', '2024-01-22 06:54:53', '2024-01-22 06:54:53'),
	(3, 'Facility', '2024-01-22 06:55:01', '2024-01-22 06:55:01'),
	(4, 'System', '2024-01-22 09:03:22', '2024-02-10 17:02:09');

-- Dumping structure for table qcpl_engagement.question_type
CREATE TABLE IF NOT EXISTS `question_type` (
  `qt_id` int NOT NULL AUTO_INCREMENT,
  `question_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`qt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table qcpl_engagement.question_type: ~4 rows (approximately)
INSERT INTO `question_type` (`qt_id`, `question_type`, `created_at`, `updated_at`) VALUES
	(1, 'Emoji-based', '2024-01-22 08:51:53', '2024-01-22 08:51:53'),
	(2, 'Multiple Selection', '2024-02-10 06:56:20', '2024-02-12 20:21:51'),
	(3, 'Text-based', '2024-01-22 08:52:02', '2024-02-12 20:21:50');

-- Dumping structure for table qcpl_engagement.queue
CREATE TABLE IF NOT EXISTS `queue` (
  `queue_id` int NOT NULL AUTO_INCREMENT,
  `total_queue` int NOT NULL,
  `queue_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`queue_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table qcpl_engagement.queue: ~10 rows (approximately)
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
	(11, 1, '2024-02-12 16:00:00', '2024-02-12 19:26:46');

-- Dumping structure for table qcpl_engagement.queue_details
CREATE TABLE IF NOT EXISTS `queue_details` (
  `qd_id` int NOT NULL AUTO_INCREMENT,
  `client_id` int DEFAULT NULL,
  `queue_number` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT '0 = Pending\r\n1 = Complete',
  `entry_check` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`qd_id`),
  KEY `client_id` (`client_id`),
  CONSTRAINT `queue_details_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table qcpl_engagement.queue_details: ~19 rows (approximately)
INSERT INTO `queue_details` (`qd_id`, `client_id`, `queue_number`, `service`, `status`, `entry_check`, `created_at`, `updated_at`) VALUES
	(65, 40, 'N-00001', 'NBI', 0, 1, '2024-02-08 20:02:46', '2024-02-09 14:03:09'),
	(66, 40, 'N-00001', 'Police', 0, 1, '2024-02-08 20:02:46', '2024-02-09 14:03:09'),
	(67, 41, 'P-00001', 'Police', 0, 1, '2024-02-08 20:03:06', '2024-02-08 20:03:06'),
	(68, 42, 'P-00002', 'Police', 0, 1, '2024-02-08 20:03:52', '2024-02-08 20:03:52'),
	(75, 48, 'N-00002', 'Police', 0, 1, '2024-02-08 20:25:28', '2024-02-08 20:25:28'),
	(76, 49, 'P-00003', 'NBI', 0, 1, '2024-02-08 20:26:36', '2024-02-08 20:26:36'),
	(77, 49, 'P-00003', 'Police', 0, 1, '2024-02-08 20:26:36', '2024-02-08 20:26:36'),
	(78, 50, 'P-00004', 'NBI', 0, 1, '2024-02-08 20:27:33', '2024-02-08 20:27:33'),
	(79, 51, 'N-00003', 'PSA', 0, 1, '2024-02-08 20:28:06', '2024-02-08 20:28:06'),
	(80, 52, 'N-00001', 'NBI', 1, 1, '2024-02-10 13:29:39', '2024-02-10 15:44:57'),
	(81, 53, 'N-00002', 'NBI', 0, 1, '2024-02-10 13:45:13', '2024-02-10 13:45:13'),
	(82, 54, 'N-00003', 'NBI', 0, 1, '2024-02-10 13:51:14', '2024-02-10 13:51:14'),
	(83, 55, 'N-00004', 'NBI', 0, 1, '2024-02-10 13:54:54', '2024-02-10 13:54:54'),
	(84, 56, 'P-00001', 'NBI', 0, 1, '2024-02-10 13:57:19', '2024-02-10 13:57:19'),
	(85, 57, 'P-00002', 'NBI', 0, 1, '2024-02-10 15:01:54', '2024-02-10 15:01:54'),
	(86, 58, 'P-00003', 'NBI', 0, 1, '2024-02-10 15:07:05', '2024-02-10 15:07:05'),
	(87, 59, 'P-00004', 'NBI', 0, 1, '2024-02-10 15:17:47', '2024-02-10 15:17:47'),
	(88, 60, 'N-00005', 'Police', 0, 1, '2024-02-10 15:24:37', '2024-02-10 15:24:37'),
	(89, 61, 'N-00006', 'NBI', 0, 1, '2024-02-10 15:36:10', '2024-02-10 15:36:10'),
	(90, 62, 'P-00001', 'NBI', 1, 1, '2024-02-12 19:26:46', '2024-02-12 19:38:20');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table qcpl_engagement.users: ~3 rows (approximately)
INSERT INTO `users` (`user_id`, `user_role_id`, `username`, `password`, `is_active`, `last_login`, `created_at`, `updated_at`) VALUES
	(4, 1, 'admin', '$2y$10$MRaoOOnRQ69KTufCOTKo3u87J0E41e3XIIvYSr/3vG58uJ6NDtWWS', 1, '2024-02-12 19:44:41', '2023-12-28 02:52:00', '2024-02-12 19:44:41'),
	(5, 2, 'staff', '$2y$10$pk3hTpWf00wNWmTR6XtSY.mOzNX3T8Gy.tmlArEtxEY3djTzoCnE6', 1, '0000-00-00 00:00:00', '2023-12-28 02:53:48', '2023-12-28 02:53:48'),
	(7, 1, 'bogart123', '$2y$10$uH24T.acTZWVm3Mt8fjO9.d.xV3jKgXxlJR/ch8swhPZKEImZgLw6', 1, '0000-00-00 00:00:00', '2024-01-23 02:35:23', '2024-01-23 02:35:23');

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

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;