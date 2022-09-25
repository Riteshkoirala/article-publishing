-- Adminer 4.8.1 MySQL 8.0.30 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE DATABASE `assignment1` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `assignment1`;

DROP TABLE IF EXISTS `Admins`;
CREATE TABLE `Admins` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(30) NOT NULL,
  `admin_email` varchar(30) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `Admins` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1,	'Ritz',	'ritz.admin@gmail.com',	'b03fe80da4c5cb1a5e8b863054cb711af868b633'),
(2,	'rohit',	'rohit.admin@gmail.com',	'9710ecfa3e2f4f5e25884b490a31819c08a577f2'),
(3,	'techno',	'techno.admin@gmail.com',	'77ea8af1f764f89c1dfaf7fb9e80fedc5c10445e');

DROP TABLE IF EXISTS `Users`;
CREATE TABLE `Users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phonenumber` varchar(15) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `password_user` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Introduction` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `Users` (`user_id`, `username`, `email`, `phonenumber`, `gender`, `password_user`, `Introduction`) VALUES
(1,	'Ritesh Koirala',	'admin.1@gmail.com',	'23',	'Female',	'c516bf61c32974a176b135e4f1c2c2b2607cbb60',	'we');

DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `article_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `categoryId` int NOT NULL,
  `admin_id` int NOT NULL,
  `content` varchar(655) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `publishDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image_a` varbinary(60000) NOT NULL,
  PRIMARY KEY (`article_id`),
  KEY `categoryId` (`categoryId`),
  KEY `admin_id` (`admin_id`),
  CONSTRAINT `article_ibfk_3` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `article_ibfk_4` FOREIGN KEY (`admin_id`) REFERENCES `Admins` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `article` (`article_id`, `title`, `categoryId`, `admin_id`, `content`, `publishDate`, `image_a`) VALUES
(1,	'Janaki Temple',	1,	1,	'Janaki temple is the one of the oldest temple in Nepal.\r\nWhich was built by the king named janak (father of sita).\r\nIt is said that the temple was build using 9 lakhs rupee in that \r\nancient period. The sita was married to lord ram.',	'2022-09-22 11:16:54',	UNHEX('57494E5F32303232303831345F31375F35365F35325F50726F2E6A7067')),
(2,	'Temples',	1,	3,	'The kathmandu which is the capital city of Nepal is said to the city of temple.\r\n\r\nThere is the famous places in kathmandu like:\r\n1. Pashupati nath\r\n2.Basantapur\r\n3. Patan durbar squar\r\n4.soyambunath\r\n5.Boudha stupa\r\n5. The narayanhiti palace',	'2022-09-24 23:33:02',	UNHEX('57494E5F32303232303831345F31375F35365F35325F50726F2E6A7067')),
(3,	'Social Media',	2,	3,	'Social media are the most used this by the people. \r\nI think this has been the most impactful product which is being in very handy for people since they can see each other from miles away and communicate like they are in home.',	'2022-09-24 23:37:26',	UNHEX('57494E5F32303232303831345F31375F35365F35325F50726F2E6A7067')),
(4,	'Technology in a good way',	2,	3,	'Technology has affected society and its surroundings in a number of ways. In many societies, technology has helped develop more advanced economies (including today\'s global economy) and has allowed the rise of a leisure class. ',	'2022-09-24 23:41:07',	UNHEX('57494E5F32303232303831345F31375F35365F35325F50726F2E6A7067')),
(5,	'To Kill a Mockingbird',	3,	3,	'Harper Lee, believed to be one of the most influential authors to have ever existed, famously published only a single novel (up until its controversial sequel was published in 2015 just before her death). Lee’s To Kill a Mockingbird was published in 1960 and became an immediate classic of literature.',	'2022-09-24 23:43:54',	UNHEX('57494E5F32303232303831345F31375F35365F35325F50726F2E6A7067')),
(6,	' The Great Gatsby',	3,	1,	'The Great Gatsby is distinguished as one of the greatest texts for introducing students to the art of reading literature critically (which means you may have read it in school). The novel is told from the perspective of a young man named Nick Carraway who has recently moved to New York City and is befriended by his eccentric nouveau riche neighbor with mysterious origins, Jay Gatsby.',	'2022-09-24 23:45:23',	UNHEX('57494E5F32303232303831345F31375F35365F35325F50726F2E6A7067')),
(7,	'Nepal royal king',	4,	1,	'Birendra Bir Bikram Shah Dev (Nepali: श्री ५ महाराजाधिराज वीरेन्द्र वीर विक्रम शाह देव) (28 December 1945 – 1 June 2001) was the tenth Shah Ruler and the King of Nepal from 1972 until his assassination in 2001. He was the eldest son of King Mahendra.',	'2022-09-24 23:47:50',	UNHEX('57494E5F32303232303831345F31375F35365F35325F50726F2E6A7067')),
(8,	'Queen Elizabeth II',	4,	1,	'Elizabeth II (Elizabeth Alexandra Mary; 21 April 1926 – 8 September 2022) was Queen of the United Kingdom and other Commonwealth realms from 6 February 1952 until her death in 2022. She was queen regnant of 32 sovereign states during her lifetime and 15 at the time of her death.[a] Her reign of 70 years and 214 days is the longest of any British monarch and the longest verified reign of any female sovereign in history.',	'2022-09-24 23:49:01',	UNHEX('57494E5F32303232303831345F31375F35365F35325F50726F2E6A7067')),
(9,	'Nepal government',	5,	2,	'The head of state is the president and the prime minister holds the position of the head of executive. The role of president is largely ceremonial as the functioning of the government is managed entirely by the prime minister, who is appointed by the Parliament. The heads of constitutional bodies are appointed by the president on the recommendation of Constitutional Council, with the exception of the attorney general, who is appointed by the president on the recommendation of the prime minister.',	'2022-09-24 23:56:36',	UNHEX('57494E5F32303232303831345F31375F35365F35325F50726F2E6A7067')),
(10,	'USA government',	5,	2,	'The federal government of the United States (U.S. federal government or U.S. government)[a] is the national government of the United States, a federal republic located primarily in North America, composed of 50 states, a city within a federal district (the city of Washington in the District of Columbia, where most of the federal government is based), five major self-governing territories and several island possessions.',	'2022-09-24 23:57:39',	UNHEX('57494E5F32303232303831345F31375F35365F35325F50726F2E6A7067'));

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `categoryId` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description_c` varchar(255) NOT NULL,
  PRIMARY KEY (`categoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `category` (`categoryId`, `name`, `description_c`) VALUES
(1,	'Arts ',	'Arts represent our culture, way of living and the person you.'),
(2,	'Technology',	'Its the main area that the today\'s generation is focusing on.'),
(3,	'Novels',	'Book that is very infuential and logistically good for the human minds to read.'),
(4,	'Royal News',	'News regarding the royal family.'),
(5,	'Government ',	'As of now every country is rulled by the government.');

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `comment_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `article_id` int NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comment` varchar(255) NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `article_id` (`article_id`),
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `article` (`article_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `comment` (`comment_id`, `username`, `article_id`, `comment_date`, `comment`) VALUES
(1,	'Ritz',	1,	'2022-09-22 11:23:39',	'That\'s Great...'),
(2,	'Ritz',	1,	'2022-09-23 02:46:09',	'nice!'),
(3,	'techno',	1,	'2022-09-24 23:33:23',	'Is that so, Great'),
(4,	'techno',	2,	'2022-09-24 23:34:53',	'Nice information...'),
(5,	'techno',	3,	'2022-09-24 23:37:49',	'Yes, it has really changed life.'),
(6,	'techno',	4,	'2022-09-24 23:41:20',	'yes!!!'),
(7,	'Ritz',	6,	'2022-09-24 23:45:47',	'ohh!'),
(8,	'Ritz',	5,	'2022-09-24 23:46:03',	'Great!'),
(9,	'Ritz',	2,	'2022-09-24 23:49:53',	'Nice to see about nepal'),
(10,	'Ritz',	3,	'2022-09-24 23:50:12',	'Really that\'s true..'),
(11,	'Ritz',	4,	'2022-09-24 23:50:34',	'we should use it in good way..'),
(12,	'Ritz',	5,	'2022-09-24 23:50:55',	'nice book..'),
(13,	'Ritz',	6,	'2022-09-24 23:51:13',	'nice book..'),
(14,	'rohit',	7,	'2022-09-24 23:52:24',	'He was great!!!'),
(15,	'rohit',	8,	'2022-09-24 23:52:48',	'sad that she is no longer with us...'),
(16,	'rohit',	9,	'2022-09-24 23:57:55',	'But i hate them.'),
(17,	'rohit',	10,	'2022-09-24 23:58:15',	'They are more confident..'),
(18,	'rohit',	5,	'2022-09-24 23:58:38',	'I wanna read this book.'),
(19,	'rohit',	6,	'2022-09-24 23:58:53',	'really nice book'),
(20,	'rohit',	4,	'2022-09-24 23:59:20',	'Great to hear that...'),
(21,	'rohit',	3,	'2022-09-24 23:59:40',	'OHH is that so,'),
(22,	'rohit',	1,	'2022-09-24 23:59:58',	'I love this place...'),
(23,	'rohit',	2,	'2022-09-25 00:00:19',	'I really recommand people for going here...'),
(24,	'techno',	10,	'2022-09-25 00:00:52',	'aww. i oppose them.'),
(25,	'techno',	9,	'2022-09-25 00:01:13',	'those corrupt people..'),
(26,	'techno',	8,	'2022-09-25 00:01:28',	'RIP'),
(27,	'techno',	7,	'2022-09-25 00:01:41',	'RIP');

-- 2022-09-25 00:58:44
