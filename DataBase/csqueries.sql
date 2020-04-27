-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 27, 2020 at 07:58 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csqueries`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
CREATE TABLE IF NOT EXISTS `author` (
  `AuthId` int(10) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) NOT NULL,
  `PassWord` varchar(200) NOT NULL,
  `PassWordSalt` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `CreatedAt` datetime NOT NULL DEFAULT current_timestamp(),
  `Image` varchar(100) NOT NULL,
  PRIMARY KEY (`AuthId`),
  UNIQUE KEY `UniqueUserName` (`UserName`)
) ENGINE=InnoDB AUTO_INCREMENT=1006 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`AuthId`, `UserName`, `PassWord`, `PassWordSalt`, `Email`, `Name`, `CreatedAt`, `Image`) VALUES
(1003, 'KuntalSarkar', '34a283d519a47dc9e87d1f7f4b2d74d4', '4828d68ae56cea66ab4b', 'kunta@12.com', 'kuntal sarkar', '2020-04-26 18:28:21', ''),
(1004, 'rajadas', '6a3710ce8468aa6c13384daa095c80e6', '5add7f9126b6a8f55ddf', 'rajadas@12.com', 'Rajesh Debnath', '2020-04-26 21:33:55', ''),
(1005, 'Rajesh', '8a6709b6e4ee0d1dcfe8e624e0d83a24', '6e55ed99d5086f6f29b1', 'raj@gmail.com', 'raja', '2020-04-26 22:19:18', '');

-- --------------------------------------------------------

--
-- Table structure for table `authorexperienced`
--

DROP TABLE IF EXISTS `authorexperienced`;
CREATE TABLE IF NOT EXISTS `authorexperienced` (
  `AuthId` int(10) NOT NULL,
  `CategoryId` int(10) NOT NULL,
  PRIMARY KEY (`AuthId`,`CategoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `authorinterests`
--

DROP TABLE IF EXISTS `authorinterests`;
CREATE TABLE IF NOT EXISTS `authorinterests` (
  `AuthId` int(10) NOT NULL,
  `CategoryId` int(10) NOT NULL,
  PRIMARY KEY (`AuthId`,`CategoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `CategoryId` int(10) NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(100) NOT NULL,
  `CategoryDescription` varchar(200) NOT NULL,
  `CategoryIcon` varchar(200) NOT NULL,
  PRIMARY KEY (`CategoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryId`, `CategoryName`, `CategoryDescription`, `CategoryIcon`) VALUES
(1, 'DBMS', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

DROP TABLE IF EXISTS `contents`;
CREATE TABLE IF NOT EXISTS `contents` (
  `ContentId` int(10) NOT NULL AUTO_INCREMENT,
  `AuthId` int(10) DEFAULT NULL,
  `Question` varchar(1000) DEFAULT NULL,
  `DashedQuestion` varchar(1000) NOT NULL,
  `Answer` text DEFAULT NULL,
  `CreatedAt` datetime DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NULL DEFAULT current_timestamp(),
  `CategoryId` int(10) DEFAULT NULL,
  `isPublished` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ContentId`),
  KEY `AuthId` (`AuthId`),
  KEY `CategoryId` (`CategoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`ContentId`, `AuthId`, `Question`, `DashedQuestion`, `Answer`, `CreatedAt`, `UpdatedAt`, `CategoryId`, `isPublished`) VALUES
(29, 1005, 'Where can I get some?', 'herecangetsome', '', '2020-04-27 23:07:34', '2020-04-27 17:37:34', 1, 1),
(33, 1003, 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, ', 'Contrary-to-popular-belief-Lorem-Ipsum-is-not-simply-random-text-It-has-roots-in-a-piece-of-classical-Latin-literature-from-45-BC-making-it-over-2000-years-old-Richard-McClintock-', '', '2020-04-27 23:16:51', '2020-04-27 17:46:51', 1, 0),
(34, 1003, '\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself,', 'But-I-must-explain-to-you-how-all-this-mistaken-id', '<h3>Section 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>\r\n', '2020-04-28 00:31:21', '2020-04-27 19:01:21', 1, 0),
(35, 1003, 'Section 1.10.32 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC', 'Section-11032-of-de-Finibus-Bonorum-et-Malorum-written-by-Cicero-in-45-BC', '<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n', '2020-04-28 00:32:46', '2020-04-27 19:02:46', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `logtable`
--

DROP TABLE IF EXISTS `logtable`;
CREATE TABLE IF NOT EXISTS `logtable` (
  `LogId` int(10) NOT NULL AUTO_INCREMENT,
  `AuthId` int(10) NOT NULL,
  `Operation` varchar(50) NOT NULL,
  `ContentId` int(10) NOT NULL,
  `OperationTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`LogId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
