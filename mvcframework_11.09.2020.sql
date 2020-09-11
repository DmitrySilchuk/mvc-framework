-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.3.13-MariaDB-log - mariadb.org binary distribution
-- Операционная система:         Win64
-- HeidiSQL Версия:              10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица mvcframework.mvc_department
CREATE TABLE IF NOT EXISTS `mvc_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы mvcframework.mvc_department: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `mvc_department` DISABLE KEYS */;
INSERT INTO `mvc_department` (`id`, `name`) VALUES
	(4, '30 минут'),
	(6, '45'),
	(8, 'fghfgh');
/*!40000 ALTER TABLE `mvc_department` ENABLE KEYS */;

-- Дамп структуры для таблица mvcframework.mvc_user
CREATE TABLE IF NOT EXISTS `mvc_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `fk-user-department_id` (`department_id`),
  CONSTRAINT `fk-user-department_id` FOREIGN KEY (`department_id`) REFERENCES `mvc_department` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы mvcframework.mvc_user: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `mvc_user` DISABLE KEYS */;
INSERT INTO `mvc_user` (`id`, `email`, `name`, `address`, `phone`, `comment`, `department_id`) VALUES
	(17, 'dimfdfisius@rambler.ru', 'frwerwer', 'werwer', '+380669782813', NULL, 6),
	(18, 'dimfdfghfghfisius@rambler.ru', 'fghfgh', 'dfghdg', '345345', NULL, 6),
	(19, 'dimretertisius@rambler.ru', 'ewrtrewtwert', 'ewrtewrt', '43532453425324', NULL, 4),
	(20, 'dirteewrmisiufgs@rambler.ru', 'ertewrt', 'retewrt', '5345345', 'fdgdfgfdsg', 4),
	(21, 'diytrrteyrtemisius@rambler.ru', 'yrteyrtey', 'yrtyret', '456456', 'fghgfjhgfhjbnfdj', 4);
/*!40000 ALTER TABLE `mvc_user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
