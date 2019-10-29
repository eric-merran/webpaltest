-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `exams`;
CREATE TABLE `exams` (
  `exam_id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_name` varchar(60) NOT NULL,
  PRIMARY KEY (`exam_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `exams` (`exam_id`, `exam_name`) VALUES
(1,	'Calculus'),
(2,	'Economic'),
(3,	'Programation');

DROP TABLE IF EXISTS `grades`;
CREATE TABLE `grades` (
  `user_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `grade` smallint(6) NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `exam_id` (`exam_id`),
  CONSTRAINT `grades_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `grades_ibfk_4` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`exam_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `grades` (`user_id`, `exam_id`, `grade`) VALUES
(1,	1,	98),
(9,	1,	38),
(9,	3,	89),
(1,	3,	100);

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(30) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1,	'Student');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `last_name` varchar(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`user_id`, `last_name`, `first_name`, `role_id`) VALUES
(1,	'Merran',	'Eric',	1),
(9,	'Smith',	'John',	1),
(11,	'Ashkenaz',	'Liora',	1),
(12,	'Zilberman',	'David',	1);

-- 2019-10-29 12:55:09