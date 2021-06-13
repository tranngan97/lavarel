-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE DATABASE `lavarel1` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `lavarel1`;

DROP TABLE IF EXISTS `tbladmins`;
CREATE TABLE `tbladmins` (
  `admin_email` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL,
  `admin_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tbladmins` (`admin_email`, `admin_pass`, `admin_name`) VALUES
('admin@gmail.com',	'ca762676c74f1b27011e944093b7e929',	'Test Admin');

DROP TABLE IF EXISTS `tblpaysheet`;
CREATE TABLE `tblpaysheet` (
  `paysheet_id` int NOT NULL AUTO_INCREMENT,
  `timesheet_id` int NOT NULL,
  `staff_id` int NOT NULL,
  `month` int NOT NULL,
  `health_insurance` int NOT NULL,
  `social_insurance` int NOT NULL,
  `bank_account` int NOT NULL,
  `total_paid` int NOT NULL,
  PRIMARY KEY (`paysheet_id`),
  KEY `staff_id` (`staff_id`),
  CONSTRAINT `tblpaysheet_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `tblstaff` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `tblrequest`;
CREATE TABLE `tblrequest` (
  `request_id` int NOT NULL AUTO_INCREMENT,
  `staff_id` int NOT NULL,
  `type` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tblrequest` (`request_id`, `staff_id`, `type`, `note`, `status`) VALUES
(2,	2,	'paid_leave',	'ahcfsadfgsah',	0);

DROP TABLE IF EXISTS `tblstaff`;
CREATE TABLE `tblstaff` (
  `staff_id` int NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `staff_name` varchar(255) NOT NULL,
  `staff_avatar` varchar(255) NOT NULL,
  `staff_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `staff_pass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `staff_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `staff_department` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `staff_cert` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `staff_dob` varchar(255) NOT NULL,
  `staff_gross` int NOT NULL,
  `social_insurance` varchar(255) NOT NULL,
  `health_insurance` varchar(255) NOT NULL,
  `bank_account` varchar(255) NOT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tblstaff` (`staff_id`, `created_at`, `staff_name`, `staff_avatar`, `staff_email`, `staff_pass`, `staff_phone`, `staff_department`, `staff_cert`, `staff_dob`, `staff_gross`, `social_insurance`, `health_insurance`, `bank_account`) VALUES
(3,	'2021-06-12 22:48:12',	'Test Staff 1',	'images/user.png',	'test_staff@gmail.com',	'f56a24c4bb9079ef7223f4e41d210061',	'1234567892',	'1',	'',	'1-10-2021',	21321321,	'12321',	'123213',	'213213'),
(4,	'2021-06-12 23:28:54',	'Long Vu',	'images/user.png',	'admin@gmail.com',	'ca762676c74f1b27011e944093b7e929',	'1234567892',	'1',	'1',	'13-Jun-2021',	21321321,	'12321',	'123213',	'213213');

DROP TABLE IF EXISTS `tbltimesheet`;
CREATE TABLE `tbltimesheet` (
  `timesheet_id` int NOT NULL AUTO_INCREMENT,
  `staff_id` int NOT NULL,
  `staff_name` int NOT NULL,
  `paid_days` int NOT NULL,
  `month` int NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`timesheet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- 2021-06-13 08:22:34
