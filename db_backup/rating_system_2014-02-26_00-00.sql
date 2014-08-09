#SKD101|rating_system|9|2014.02.26 00:00:23|23|5|5|3|4|6

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
) ENGINE=InnoDB AUTO_INCREMENT=7 /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `chair` VALUES
(1, 2, 'Информационных систем'),
(3, 2, 'Программирования и информационных технологий'),
(4, 4, 'Информационных систем'),
(5, 4, 'Цифровых технологий'),
(6, 5, 'Защита информации');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `speciality` VALUES
(2, 'Информационные системы и технологии'),
(3, 'Математика и компьютерные науки'),
(4, 'Информационные системы(Бакалавры)'),
(5, 'Програмная инженерия'),
(14, 'dgfch');

DROP TABLE IF EXISTS `specialization`;
CREATE TABLE `specialization` (
  `specialization_id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `chair_id` tinyint(5) NOT NULL,
  `specialization_name` varchar(100) NOT NULL,
  PRIMARY KEY (`specialization_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `specialization` VALUES
(1, 1, 'информационные системы и технологии в сетевых технологиях'),
(2, 3, 'информационные системы и технологии на предприятиях'),
(3, 6, 'рвмира');

DROP TABLE IF EXISTS `stud_positions`;
CREATE TABLE `stud_positions` (
  `position_id` int(255) NOT NULL AUTO_INCREMENT,
  `course` tinyint(1) NOT NULL,
  `group` tinyint(2) NOT NULL,
  `subgroup` tinyint(1) NOT NULL,
  `speciality_id` int(255) NOT NULL,
  `chair_id` int(255) NOT NULL,
  `specialization_id` int(255) NOT NULL,
  PRIMARY KEY (`position_id`)
) ENGINE=InnoDB /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `student_id` int(255) NOT NULL AUTO_INCREMENT,
  `student` varchar(100) NOT NULL,
  `position_id` int(255) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=5 /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `subjects` VALUES
(1, 'Квантовая механика', 0, 0, 3, 6),
(2, 'Диффуры', 0, 0, 2, 3),
(3, 'Психология', 0, 0, 4, 8),
(4, 'Матан', 0, 0, 1, 1);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(255) NOT NULL AUTO_INCREMENT,
  `login` varchar(25) NOT NULL,
  `password` varchar(32) NOT NULL,
  `grades` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=19 /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `users` VALUES
(10, 'test', '3cdf5666859f6906c283a1058cd5b9a7', 0),
(11, 'test2', '3cdf5666859f6906c283a1058cd5b9a7', 0),
(12, 'test3', '3cdf5666859f6906c283a1058cd5b9a7', 0),
(16, 'andrei', '3cdf5666859f6906c283a1058cd5b9a7', 0),
(17, 'user', '3cdf5666859f6906c283a1058cd5b9a7', 0),
(18, 'lol', '3cdf5666859f6906c283a1058cd5b9a7', 0);

