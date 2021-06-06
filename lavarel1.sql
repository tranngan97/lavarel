-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

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


DROP TABLE IF EXISTS `tblstaff`;
CREATE TABLE `tblstaff` (
  `staff_id` int NOT NULL AUTO_INCREMENT,
  `staff_name` varchar(255) NOT NULL,
  `staff_avatar` varchar(255) NOT NULL,
  `staff_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `staff_pass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `staff_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `staff_department` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `staff_dob` varchar(255) NOT NULL,
  `staff_gross` int NOT NULL,
  `social_insurance` varchar(255) NOT NULL,
  `health_insurance` varchar(255) NOT NULL,
  `bank_account` varchar(255) NOT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


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


-- 2021-06-06 12:30:54
