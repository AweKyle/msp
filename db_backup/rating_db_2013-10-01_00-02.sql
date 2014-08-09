#SKD101|rating_db|7|2013.10.01 00:02:47|0

<<<<<<< HEAD
CREATE DATABASE IF NOT EXISTS `rating_system`;

USE `rating_system`;

=======
>>>>>>> 0f18ff8bc1bf373edbbe211916d9715099876f03
DROP TABLE IF EXISTS `archive`;
CREATE TABLE `archive` (
  `student_id` int(255) NOT NULL,
  `course` tinyint(2) NOT NULL,
  `semester` tinyint(3) NOT NULL,
  `year` year(4) NOT NULL,
  `subject_id` int(255) NOT NULL,
  `mark` tinyint(4) NOT NULL,
  `progress_id` int(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `chair`;
CREATE TABLE `chair` (
  `chair_id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `speciality_id` tinyint(5) NOT NULL,
  `chair_name` varchar(100) NOT NULL,
  PRIMARY KEY (`chair_id`)
) ENGINE=InnoDB /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `progress`;
CREATE TABLE `progress` (
  `student_id` int(255) NOT NULL,
  `course` tinyint(2) NOT NULL,
  `semester` tinyint(3) NOT NULL,
  `year` year(4) NOT NULL,
  `subject_id` int(255) NOT NULL,
  `mark` tinyint(4) NOT NULL,
  `progress_id` int(255) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`progress_id`)
) ENGINE=InnoDB /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `speciality`;
CREATE TABLE `speciality` (
  `speciality_id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `speciality_name` varchar(100) NOT NULL,
  PRIMARY KEY (`speciality_id`)
) ENGINE=InnoDB /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `specialization`;
CREATE TABLE `specialization` (
  `specialization_id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `chair_id` tinyint(5) NOT NULL,
  `specialization_name` varchar(100) NOT NULL,
  PRIMARY KEY (`specialization_id`)
) ENGINE=InnoDB /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `student_id` int(255) NOT NULL AUTO_INCREMENT,
  `student_name` varchar(50) NOT NULL,
  `student_surname` varchar(50) NOT NULL,
  `student_patronymic` varchar(50) NOT NULL,
  `speciality_id` tinyint(5) NOT NULL,
  `specialization_id` tinyint(5) NOT NULL,
  `course` tinyint(1) NOT NULL,
  `group` tinyint(3) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE `subjects` (
  `subject_id` int(255) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(100) NOT NULL,
  `speciality_id` tinyint(5) NOT NULL,
  `specialization_id` tinyint(5) NOT NULL,
  `course` tinyint(5) NOT NULL,
  `semester` tinyint(2) NOT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB /*!40101 DEFAULT CHARSET=utf8 */;

