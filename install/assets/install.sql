-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.27 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2013-01-21 04:20:35
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for elibrary
CREATE DATABASE IF NOT EXISTS `elibrary` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `elibrary`;


-- Dumping structure for table elibrary.author
CREATE TABLE IF NOT EXISTS `author` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `au_lname` varchar(50) NOT NULL,
  `au_fname` varchar(50) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `postalcode` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table elibrary.author: ~2 rows (approximately)
/*!40000 ALTER TABLE `author` DISABLE KEYS */;
INSERT INTO `author` (`id`, `au_lname`, `au_fname`, `phone`, `address`, `city`, `state`, `country`, `postalcode`) VALUES
	(1, 'Chevalier', 'Tracy', NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 'Card', 'Orson Scott', NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `author` ENABLE KEYS */;


-- Dumping structure for table elibrary.book
CREATE TABLE IF NOT EXISTS `book` (
  `ISBN` int(9) NOT NULL,
  `title` varchar(150) NOT NULL,
  `author_id` int(10) NOT NULL,
  `pub_id` int(10) NOT NULL,
  `year` year(4) NOT NULL,
  `description` mediumtext,
  `quantity` int(10) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image_url` varchar(50) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  PRIMARY KEY (`ISBN`),
  KEY `FK__author` (`author_id`),
  KEY `FK__publisher` (`pub_id`),
  KEY `FK_book_category` (`cat_name`),
  CONSTRAINT `FK_book_category` FOREIGN KEY (`cat_name`) REFERENCES `category` (`name`),
  CONSTRAINT `FK__author` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`),
  CONSTRAINT `FK__publisher` FOREIGN KEY (`pub_id`) REFERENCES `publisher` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table elibrary.book: ~4 rows (approximately)
/*!40000 ALTER TABLE `book` DISABLE KEYS */;
INSERT INTO `book` (`ISBN`, `title`, `author_id`, `pub_id`, `year`, `description`, `quantity`, `price`, `image_url`, `cat_name`) VALUES
	(111111111, 'The Last Runway', 1, 1, '2013', 'In New York Times bestselling author Tracy Chevalier\'s newest historical saga, she introduces Honor Bright, a modest English Quaker who moves to Ohio in 1850, only to find herself alienated and alone in a strange land. Sick from the moment she leaves England, and fleeing personal disappointment, she is forced by family tragedy to rely on strangers in a harsh, unfamiliar landscape.\r\n\r\nNineteenth-century America is practical, precarious, and unsentimental, and scarred by the continuing injustice of slavery. In her new home Honor discovers that principles count for little, even within a religious community meant to be committed to human equality.\r\n\r\nHowever, drawn into the clandestine activities of the Underground Railroad, a network helping runaway slaves escape to freedom, Honor befriends two surprising women who embody the remarkable power of defiance. Eventually she must decide if she too can act on what she believes in, whatever the personal costs.\r\n\r\nA powerful journey brimming with color and drama,The Last Runawayis Tracy Chevalier\'s vivid engagement with an iconic part of American history.', 1, 20.99, 'the_last_runway.png', 'Adventure'),
	(111111112, 'The Lady and Unicorn', 1, 1, '2009', 'Jean le Viste, a newly-wealthy member of the French court, commissions a series of tapestries to hang in his chateau named \'The Lady and the Unicorn.\' Nicolas, his chosen designer, is a talented artist. He is also dangerously attractive to the women around him including le Viste\'s wife, Genevieve, and his daughter, Claude. Nicolas is at once smitten with Claude but will her social standing prevent her from returning his advances?', 1, 15.99, 'the_lady_and_unicorn.jpeg', 'History'),
	(111111119, 'Ender\'s Game', 2, 1, '2011', 'The human race faces annihilation. An alien menace is hovering on the horizon, ready to strike. And if humanity is to be defended, the government must create the greatest military commander in history.The brilliant young Ender Wiggin is their last hope. But first he must survive the rigours of a brutal military training program - to prove that he can be the leader of all leaders.A saviour for mankind must be produced, through whatever means possible. But will they create a hero or a monster?This is the multiple award-winning classic ENDER\'S GAME - a groundbreaking tale of war, strategy and survival.', 2, 13.00, 'enders_game.jpeg', 'Fiction'),
	(222222222, 'Girl With a Pearl Earring', 1, 2, '2010', 'An international bestseller with over two million copies sold, this is a story of an artist\'s desire for beauty and the ultimate corruption of innocence.', 1, 25.99, 'girl_with_a_pearl_earring.jpeg', 'History');
/*!40000 ALTER TABLE `book` ENABLE KEYS */;


-- Dumping structure for table elibrary.book_request
CREATE TABLE IF NOT EXISTS `book_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `requested` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table elibrary.book_request: ~0 rows (approximately)
/*!40000 ALTER TABLE `book_request` DISABLE KEYS */;
INSERT INTO `book_request` (`id`, `title`, `author`, `requested`) VALUES
	(1, 'Cats And Dogs', 'Paul', 5);
/*!40000 ALTER TABLE `book_request` ENABLE KEYS */;


-- Dumping structure for table elibrary.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table elibrary.category: ~11 rows (approximately)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`id`, `name`, `description`) VALUES
	(1, 'Adventure', NULL),
	(2, 'Animals', NULL),
	(3, 'Audio Books', 'The audio copy of books.'),
	(4, 'Autobiography and memoir', NULL),
	(5, 'Ballet', NULL),
	(6, 'Biography', NULL),
	(7, 'Business and finance', NULL),
	(8, 'Classics', NULL),
	(9, 'Computing and the net', NULL),
	(10, 'History', NULL),
	(11, 'Fiction', NULL);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;


-- Dumping structure for table elibrary.history
CREATE TABLE IF NOT EXISTS `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ISBN` int(9) NOT NULL,
  `system_id` int(11) NOT NULL,
  `date_out` date NOT NULL,
  `date_due` date NOT NULL,
  `returned` enum('Y','N') NOT NULL DEFAULT 'N',
  `display_history` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`),
  KEY `FK_history_book` (`ISBN`),
  KEY `FK_history_system` (`system_id`),
  CONSTRAINT `FK_history_book` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`),
  CONSTRAINT `FK_history_system` FOREIGN KEY (`system_id`) REFERENCES `system` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table elibrary.history: ~3 rows (approximately)
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
/*!40000 ALTER TABLE `history` ENABLE KEYS */;


-- Dumping structure for table elibrary.publisher
CREATE TABLE IF NOT EXISTS `publisher` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pub_name` varchar(50) NOT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table elibrary.publisher: ~2 rows (approximately)
/*!40000 ALTER TABLE `publisher` DISABLE KEYS */;
INSERT INTO `publisher` (`id`, `pub_name`, `city`, `state`, `country`) VALUES
	(1, 'John House', NULL, NULL, NULL),
	(2, 'Little, Brown Book Group Limited', NULL, NULL, NULL);
/*!40000 ALTER TABLE `publisher` ENABLE KEYS */;


-- Dumping structure for table elibrary.reservation
CREATE TABLE IF NOT EXISTS `reservation` (
  `ISBN` int(9) NOT NULL,
  `system_id` int(11) NOT NULL,
  `date_log` date NOT NULL,
  KEY `FK_reservation_system` (`system_id`),
  KEY `ISBN` (`ISBN`),
  CONSTRAINT `FK_reservation_book` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`),
  CONSTRAINT `FK_reservation_system` FOREIGN KEY (`system_id`) REFERENCES `system` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table elibrary.reservation: ~3 rows (approximately)
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;


-- Dumping structure for table elibrary.system
CREATE TABLE IF NOT EXISTS `system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ower_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_system_user` (`ower_id`),
  CONSTRAINT `FK_system_user` FOREIGN KEY (`ower_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table elibrary.system: ~4 rows (approximately)
/*!40000 ALTER TABLE `system` DISABLE KEYS */;
INSERT INTO `system` (`id`, `ower_id`) VALUES
	(2, 2),
	(3, 4),
	(4, 5);
/*!40000 ALTER TABLE `system` ENABLE KEYS */;


-- Dumping structure for table elibrary.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `registration_date` datetime NOT NULL,
  `role_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `blocked` enum('Y','N') NOT NULL,
  `activation_key` varchar(255) NOT NULL,
  `user_status` enum('Y','N') NOT NULL,
  `display_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_email` (`username`,`email`),
  KEY `FK_user_user_group_roles` (`role_id`),
  CONSTRAINT `FK_user_user_group_roles` FOREIGN KEY (`role_id`) REFERENCES `user_group_roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table elibrary.user: ~4 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`, `fname`, `lname`, `registration_date`, `role_id`, `email`, `blocked`, `activation_key`, `user_status`, `display_name`) VALUES
	(2, 'johndoe', '6eeafaef013319822a1f30407a5353f778b59790', 'John', 'Doe', '2012-06-14 21:20:45', 1, 'johndoe@yahoo.com', 'N', '111', 'Y', 'John Doe'),
	(4, 'janedoe', '6eeafaef013319822a1f30407a5353f778b59790', 'Jane', 'Doe', '2012-06-14 21:20:45', 1, 'janedoe@yahoo.com', 'N', '111', 'Y', 'Jane Doe'),
	(5, 'pauldoe', '6eeafaef013319822a1f30407a5353f778b59790', 'Paul', 'Doe', '2012-06-14 21:20:45', 9999, 'pauldoe@yahoo.com', 'N', '111', 'Y', 'Paul Doe');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- Dumping structure for table elibrary.user_group_roles
CREATE TABLE IF NOT EXISTS `user_group_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` mediumtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table elibrary.user_group_roles: ~2 rows (approximately)
/*!40000 ALTER TABLE `user_group_roles` DISABLE KEYS */;
INSERT INTO `user_group_roles` (`id`, `name`, `description`) VALUES
	(1, 'Member', 'uu'),
	(9999, 'Superuser', 'Superuser is a special user account used for system administrator.');
/*!40000 ALTER TABLE `user_group_roles` ENABLE KEYS */;


-- Dumping structure for table elibrary.user_profile
CREATE TABLE IF NOT EXISTS `user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `system_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT 'N/A',
  `mobilephone` varchar(50) DEFAULT 'N/A',
  `dob` varchar(50) DEFAULT 'N/A',
  `gender` enum('Female','Male') DEFAULT NULL,
  `address` text,
  `country` varchar(255) DEFAULT 'N/A',
  `city` varchar(255) DEFAULT 'N/A',
  `state` varchar(255) DEFAULT 'N/A',
  `zip` varchar(5) DEFAULT 'N/A',
  `fax` varchar(50) DEFAULT 'N/A',
  `photo` varchar(255) DEFAULT 'N/A',
  `website` varchar(255) DEFAULT 'N/A',
  PRIMARY KEY (`id`),
  KEY `FK_user_profile_system` (`system_id`),
  CONSTRAINT `FK_user_profile_system` FOREIGN KEY (`system_id`) REFERENCES `system` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table elibrary.user_profile: ~4 rows (approximately)
/*!40000 ALTER TABLE `user_profile` DISABLE KEYS */;
INSERT INTO `user_profile` (`id`, `system_id`, `fullname`, `email`, `phone`, `mobilephone`, `dob`, `gender`, `address`, `country`, `city`, `state`, `zip`, `fax`, `photo`, `website`) VALUES
	(2, 2, 'John Doe', 'johndoe@yahoo.com', 'N/A', '60143298260', 'January 21, 1980', 'Male', 'This is my test address', 'Malaysia', 'Kuala Lumpur', 'WP', '58200', 'N/A', NULL, 'N/A'),
	(3, 3, 'Jane Doe', 'janedoe@yahoo.com', '1234567890', '1234567890', 'January 21, 1980', 'Female', 'This is my test address', 'Bostwana', 'Gaborone', 'N/A', '12345', 'N/A', NULL, 'N/A'),
	(4, 4, 'Paul Doe', 'pauldoe@yahoo.com', '1234567890', '1234567890', 'January 21, 1980', 'Male', 'This is my test address', 'Malaysia', 'Kuala Lumpur', 'N/A', '12345', 'N/A', NULL, 'N/A');
/*!40000 ALTER TABLE `user_profile` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
