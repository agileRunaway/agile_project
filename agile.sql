-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 25, 2017 at 02:35 PM
-- Server version: 5.5.58-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `agile`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `chat_id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf16_unicode_ci NOT NULL,
  `task_id` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `pro_mem_id` int(11) NOT NULL,
  PRIMARY KEY (`chat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chat_id`, `content`, `task_id`, `time`, `pro_mem_id`) VALUES
(1, '會寫不完啦', 2, '2017-12-20 00:00:00', 4),
(2, '幫忙ＱＱＱＱＡＡＡ', 2, '2017-12-21 09:00:18', 3),
(3, '期末大爆炸，軟工寫完了！！！！', 1, '2017-12-15 04:12:16', 2),
(4, '期末大爆炸', 1, '2017-12-18 00:00:00', 2),
(5, 'good', 2, '2017-12-14 00:17:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `dep_id` int(11) NOT NULL,
  `manager` int(11) DEFAULT NULL,
  `name` varchar(30) COLLATE utf16_unicode_ci NOT NULL,
  `man_dep` int(11) DEFAULT NULL,
  PRIMARY KEY (`dep_id`),
  KEY `manager` (`manager`,`man_dep`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dep_id`, `manager`, `name`, `man_dep`) VALUES
(100, NULL, '研發總', NULL),
(106, 1, '研發一', 100),
(107, 3, '研發二', 100),
(200, NULL, '行銷總', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `mem_id` int(11) NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(20) COLLATE utf16_unicode_ci NOT NULL,
  `dep_id` int(11) NOT NULL,
  `id_state` int(11) NOT NULL,
  `Supervisor` int(11) NOT NULL,
  PRIMARY KEY (`mem_id`),
  KEY `dep_id` (`dep_id`),
  KEY `Supervisor` (`Supervisor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`mem_id`, `password`, `name`, `dep_id`, `id_state`, `Supervisor`) VALUES
(1, '1111', 'jeff', 106, 1, 1),
(2, '1111', 'tony', 106, 1, 1),
(3, '1111', 'sam', 107, 2, 1),
(4, '1111', 'pm', 100, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `pro_id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_owner` int(11) NOT NULL,
  `s_time` date NOT NULL,
  `e_time` date NOT NULL,
  `spec` varchar(100) COLLATE utf16_unicode_ci NOT NULL,
  `name` varchar(40) COLLATE utf16_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`pro_id`),
  KEY `pro_owner` (`pro_owner`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`pro_id`, `pro_owner`, `s_time`, `e_time`, `spec`, `name`, `status`) VALUES
(1, 4, '2017-12-01', '2017-12-30', 'spec...', 'project 1', 0),
(2, 4, '2017-12-25', '0000-00-00', '', '', 0),
(3, 1, '2017-12-25', '2017-11-29', '4545', '12', 0),
(4, 1, '2017-12-25', '0000-00-00', '', '', 0),
(5, 1, '2017-12-25', '0000-00-00', '', '', 0),
(6, 1, '2017-12-25', '0000-00-00', '', '', 0),
(7, 4, '2017-12-25', '0000-00-00', '', '', 0),
(8, 1, '2017-12-25', '2017-12-13', '', 'this is test', 0),
(9, 1, '2017-12-25', '0000-00-00', '', '', 0),
(10, 1, '2017-12-25', '2017-12-21', '', 'YA', 0),
(11, 1, '2017-12-25', '0000-00-00', '', '', 0),
(12, 1, '2017-12-25', '0000-00-00', '', '', 0),
(13, 1, '2017-12-25', '0000-00-00', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_member`
--

CREATE TABLE IF NOT EXISTS `project_member` (
  `pro_mem_id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_id` int(11) NOT NULL,
  `mem_id` int(11) NOT NULL,
  `s_time` date NOT NULL,
  `e_time` date NOT NULL,
  `status` int(11) NOT NULL,
  `Supervisor` int(11) NOT NULL,
  `Permission` int(11) NOT NULL,
  PRIMARY KEY (`pro_mem_id`),
  KEY `pro_id` (`pro_id`),
  KEY `mem_id` (`mem_id`),
  KEY `Supervisor` (`Supervisor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `project_member`
--

INSERT INTO `project_member` (`pro_mem_id`, `pro_id`, `mem_id`, `s_time`, `e_time`, `status`, `Supervisor`, `Permission`) VALUES
(1, 1, 4, '2017-12-02', '2017-12-30', 1, 1, 1),
(2, 1, 2, '2017-12-03', '2017-12-29', 1, 1, 1),
(3, 1, 3, '2017-12-02', '2017-12-29', 1, 1, 1),
(4, 1, 1, '2017-12-02', '2017-12-29', 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `step`
--

CREATE TABLE IF NOT EXISTS `step` (
  `step_id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `name` varchar(40) COLLATE utf16_unicode_ci NOT NULL,
  `dep_id` int(11) NOT NULL,
  `s_time` date NOT NULL,
  `e_time` date NOT NULL,
  `pro_id` int(11) NOT NULL,
  `seq` int(11) NOT NULL,
  `description` varchar(50) COLLATE utf16_unicode_ci NOT NULL,
  PRIMARY KEY (`step_id`),
  KEY `pro_id` (`pro_id`),
  KEY `owner_id` (`owner_id`),
  KEY `dep_id` (`dep_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `step`
--

INSERT INTO `step` (`step_id`, `owner_id`, `name`, `dep_id`, `s_time`, `e_time`, `pro_id`, `seq`, `description`) VALUES
(1, 1, '分配', 106, '2017-12-07', '2017-12-16', 1, 1, ''),
(2, 3, 'code', 107, '2017-12-09', '2017-12-15', 1, 1, ''),
(3, 1, '測試', 106, '2017-12-16', '2017-12-30', 1, 1, ''),
(4, 3, 'test', 107, '2017-12-11', '2017-12-08', 10, 1, '輸入你想要寫的內容...'),
(5, 1, '這是測試', 106, '2017-12-27', '2018-01-12', 11, 1, '星期一 Blue monday~~');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf16_unicode_ci NOT NULL,
  `s_time` date NOT NULL,
  `status` int(11) NOT NULL,
  `space` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `e_time` date NOT NULL,
  `description` text COLLATE utf16_unicode_ci NOT NULL,
  `step_id` int(11) NOT NULL,
  PRIMARY KEY (`task_id`),
  KEY `step_id` (`step_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `name`, `s_time`, `status`, `space`, `e_time`, `description`, `step_id`) VALUES
(1, '寫agile前端', '2017-12-08', 1, 'aaa', '2017-12-11', '幫忙寫agile前端', 1),
(2, '寫agile_login端感', '2017-12-14', 1, 'bbb', '2017-12-15', '幫忙寫agile_login後端', 1),
(3, 'project_1前端', '2017-12-10', 1, 'cccc', '2017-12-13', 'project_1前端，麻煩你了', 2),
(4, 'project_1後端', '2017-12-21', 1, 'ddddd', '2017-12-25', 'project_1後端，麻煩你了', 3);

-- --------------------------------------------------------

--
-- Table structure for table `task_mem`
--

CREATE TABLE IF NOT EXISTS `task_mem` (
  `task_mem_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `mem_id` int(11) NOT NULL,
  `s_time` date NOT NULL,
  `e_time` date NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`task_mem_id`),
  KEY `task_id` (`task_id`),
  KEY `mem_id` (`mem_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `task_mem`
--

INSERT INTO `task_mem` (`task_mem_id`, `task_id`, `mem_id`, `s_time`, `e_time`, `status`) VALUES
(1, 1, 1, '2017-12-03', '2017-12-13', 1),
(2, 1, 2, '2017-12-03', '2017-12-08', 1),
(3, 2, 1, '2017-12-06', '2017-12-08', 2),
(4, 3, 3, '2017-12-19', '2017-12-21', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`manager`) REFERENCES `member` (`mem_id`) ON UPDATE CASCADE;

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`dep_id`) REFERENCES `department` (`dep_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `member_ibfk_2` FOREIGN KEY (`Supervisor`) REFERENCES `member` (`mem_id`) ON UPDATE CASCADE;

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`pro_owner`) REFERENCES `member` (`mem_id`) ON UPDATE CASCADE;

--
-- Constraints for table `project_member`
--
ALTER TABLE `project_member`
  ADD CONSTRAINT `project_member_ibfk_2` FOREIGN KEY (`mem_id`) REFERENCES `member` (`mem_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `project_member_ibfk_3` FOREIGN KEY (`Supervisor`) REFERENCES `project_member` (`pro_mem_id`) ON DELETE CASCADE;

--
-- Constraints for table `step`
--
ALTER TABLE `step`
  ADD CONSTRAINT `step_ibfk_1` FOREIGN KEY (`dep_id`) REFERENCES `department` (`dep_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `step_ibfk_2` FOREIGN KEY (`pro_id`) REFERENCES `project` (`pro_id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
