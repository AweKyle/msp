#SKD101|rating_system|9|2014.03.18 15:02:35|65|5|5|3|42|4|6

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
  `stud_group` tinyint(2) NOT NULL,
  `position_id` int(255) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=834 /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `students` VALUES
(792, 'Вендин И.О.', 1, 0),
(793, 'Головина Т.А.', 1, 0),
(794, 'Гончаров А.И.', 1, 0),
(795, 'Городничева А.А.', 1, 0),
(796, 'Зенфиров И.К.', 1, 0),
(797, 'Коломыцева Ю.Ю.', 1, 0),
(798, 'Лазукин А.В.', 1, 0),
(799, 'Лукин Е.О.', 1, 0),
(800, 'Мазаев В.Н.', 1, 0),
(801, 'Меркулова И.С.', 1, 0),
(802, 'Науменко А.С.', 1, 0),
(803, 'Пашенцева А.С.', 1, 0),
(804, 'Петрушин И.А.', 1, 0),
(805, 'Полухина Н.Ю.', 1, 0),
(806, 'Рагуцкий А.И.', 1, 0),
(807, 'Решетов А.А.', 1, 0),
(808, 'Руфанов С.А.', 1, 0),
(809, 'Смирнов А.А.', 1, 0),
(810, 'Торговцев С.С.', 1, 0),
(811, 'Филимонов Н.О.', 1, 0),
(812, 'Фролова Л.С.', 1, 0),
(813, 'Фуртак Р.М.', 1, 0),
(814, 'Черников В.С.', 1, 0),
(815, 'Щеголеватых П.А.', 1, 0),
(816, 'Адаменко А.А.', 2, 0),
(817, 'Воронцова Н.В.', 2, 0),
(818, 'Марченко К.Г.', 2, 0),
(819, 'Писаченко В.А.', 2, 0),
(820, 'Рапава Т.Э.', 2, 0),
(821, 'Шипулина Э.И.', 2, 0),
(822, 'Бабина А.С.', 3, 0),
(823, 'Белобородов А.Е.', 3, 0),
(824, 'Блинов И.А.', 3, 0),
(825, 'Зотов В.В.', 3, 0),
(826, 'Карандеев А.С.', 3, 0),
(827, 'Кондюрина А.К.', 3, 0),
(828, 'Котелевский Д.М.', 3, 0),
(829, 'Мигаль А.Д.', 3, 0),
(830, 'Нужных А.В.', 3, 0),
(831, 'Суровцев А.С.', 3, 0),
(832, 'Шилов А.С.', 3, 0),
(833, 'Шульгин Д.В.', 3, 0);

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

