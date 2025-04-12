-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 26, 2025 at 01:28 PM
-- Server version: 10.11.10-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u449432509_dlsu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_comment`
--

CREATE TABLE `admin_comment` (
  `admin_comment_id` int(11) NOT NULL,
  `teams_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_comment`
--

INSERT INTO `admin_comment` (`admin_comment_id`, `teams_id`, `comment`, `date`) VALUES
(1, 19, 'asdasd', '2024-11-28'),
(2, 20, 'asdasdsd', '2024-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `image` text NOT NULL,
  `time` varchar(50) NOT NULL DEFAULT current_timestamp(),
  `code` text NOT NULL,
  `chat_notif` int(1) NOT NULL DEFAULT 1,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `sender_id`, `receiver_id`, `message`, `image`, `time`, `code`, `chat_notif`, `date`) VALUES
(28, 1, 82, 'asdasd', '', '2024-11-06 22:15:41', '182', 0, '2024-11-06'),
(29, 82, 1, 'heey', '', '2024-11-06 22:15:47', '182', 0, '2024-11-06'),
(30, 90, 1, 'hello admin', '', '2024-11-07 01:17:21', '190', 0, '2024-11-07'),
(31, 1, 90, 'hi', '', '2024-11-07 01:17:34', '190', 0, '2024-11-07'),
(32, 90, 1, 'test', '', '2024-11-07 01:17:47', '190', 0, '2024-11-07'),
(33, 1, 90, 'asdasd', '', '2024-11-10 19:02:04', '190', 0, '2024-11-10');

-- --------------------------------------------------------

--
-- Table structure for table `chat_code`
--

CREATE TABLE `chat_code` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `scroll` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_code`
--

INSERT INTO `chat_code` (`id`, `sender_id`, `receiver_id`, `code`, `scroll`) VALUES
(3, 82, 1, 182, 0),
(4, 90, 1, 190, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `teams_id` int(11) NOT NULL,
  `setdeadline_id` int(11) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `teams_id`, `setdeadline_id`, `comment`) VALUES
(1, 17, 0, 'good work'),
(2, 17, 0, 'asdasdasd'),
(3, 17, 2, 'asdasdasd'),
(4, 24, 169, 'Finish As Soon as Possible!'),
(5, 23, 158, 'bla'),
(6, 23, 158, 'BetaTest123');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notification_id`, `description`, `date_created`, `status`) VALUES
(1, 'asdasdasdasd', '2024-11-13', 1),
(2, 'New Customer: wasa;al waasas Reserved', '2024-11-06', 1),
(3, 'New Customer: wasa;al waasas Reserved', '2024-11-07', 1),
(4, 'New Customer: wasa;al waasas Reserved', '2024-11-07', 1),
(5, 'New Customer: gode dko Reserved', '2024-11-07', 1),
(6, 'New Customer: gode dko Reserved', '2024-11-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `panelist`
--

CREATE TABLE `panelist` (
  `panelist_id` int(11) NOT NULL,
  `teams_id` int(11) NOT NULL,
  `fullname` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `panelist`
--

INSERT INTO `panelist` (`panelist_id`, `teams_id`, `fullname`) VALUES
(1, 10, 'Don Nikki'),
(2, 10, 'Borja'),
(3, 14, 'Carl Angelo M. Aranas');

-- --------------------------------------------------------

--
-- Table structure for table `reminder`
--

CREATE TABLE `reminder` (
  `reminder_id` int(11) NOT NULL,
  `teams_id` int(11) NOT NULL,
  `setdeadline_id` int(11) NOT NULL,
  `notes` text NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `notif` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reminder`
--

INSERT INTO `reminder` (`reminder_id`, `teams_id`, `setdeadline_id`, `notes`, `date`, `notif`) VALUES
(1, 19, 14, 'asdasdasd', '2024-11-30', 0),
(2, 24, 169, 'Dont Forget to Finish Chapter 1 Before Deadline', '2025-02-08', 0),
(4, 23, 156, 'Guys Finish This asap good job', '2025-02-24', 0),
(7, 23, 157, 'oujahwnieujnaw', '2025-02-25', 0),
(9, 23, 159, 'test103', '2025-02-27', 0),
(10, 23, 160, 'Chapter 3 you may Start', '2025-02-27', 0),
(11, 23, 224, 'Guys you need to redef bagsak po', '2025-03-17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reminder_adviser`
--

CREATE TABLE `reminder_adviser` (
  `reminder_adviser_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `adviser_id` int(11) NOT NULL,
  `notes` text NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `notif` tinyint(1) NOT NULL DEFAULT 1,
  `files_notif` int(1) NOT NULL DEFAULT 0 COMMENT '1=unnotified, 0=notified	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reminder_adviser`
--

INSERT INTO `reminder_adviser` (`reminder_adviser_id`, `users_id`, `adviser_id`, `notes`, `date`, `notif`, `files_notif`) VALUES
(1, 94, 0, 'You have been added to the group (THESIS GROUP)', '2024-11-30', 0, 0),
(2, 91, 0, 'You have been added to the group (WEB DEV GROUP)', '2024-11-30', 0, 0),
(3, 92, 0, 'You have been added to the group (wasalak group)', '2024-12-06', 0, 0),
(4, 94, 0, 'You have been added to the group (THESIS GROUP)', '2024-12-06', 0, 0),
(5, 94, 0, 'You have been added to the group (ITLOG GROUP)', '2024-12-06', 0, 0),
(6, 94, 0, 'You have been added to the group (dada thesis group)', '2024-12-06', 0, 0),
(7, 92, 0, 'You have been added to the group (bry groups)', '2024-12-06', 0, 0),
(8, 94, 0, 'You have been added to the group (new group)', '2024-12-10', 0, 0),
(9, 92, 0, 'You have been added to the group (FACIAL RECOG GROUP)', '2024-12-10', 0, 0),
(13, 94, 97, 'You have been added to the group (production)', '2024-12-20', 0, 0),
(14, 101, 0, 'You have been added to the group (Small White Kamote)', '2025-01-12', 0, 0),
(15, 94, 0, 'You have been added to the group (THESIS GROUP)', '2025-01-12', 0, 0),
(16, 101, 100, 'You have been added to the group (Small White Kamote)', '2025-02-07', 0, 0),
(17, 105, 104, 'You have been added to the group (Team Marvel)', '2025-02-08', 0, 0),
(18, 107, 109, 'You have been added to the group (Thesis Team)', '2025-02-08', 0, 0),
(19, 103, 104, 'New file uploaded by the group (Team Marvel)', '2025-02-21', 0, 0),
(20, 103, 104, 'New file uploaded by the group (Team Marvel)', '2025-02-21', 0, 0),
(21, 103, 104, 'New file uploaded by the group (Team Marvel)', '2025-02-21', 0, 0),
(22, 103, 104, 'New file uploaded by the group (Team Marvel)', '2025-02-21', 0, 0),
(23, 107, 109, 'New file uploaded by the group (Thesis Team)', '2025-02-25', 0, 0),
(24, 103, 104, 'New file uploaded by the group (Team Marvel)', '2025-02-25', 0, 0),
(25, 108, 109, 'You have been added to the group (Thesis Team)', '2025-02-28', 0, 0),
(26, 102, 104, 'You have been added to the group (Android App Devs)', '2025-02-28', 0, 0),
(27, 117, 116, 'You have been added to the group (ASD)', '2025-03-05', 1, 0),
(28, 122, 104, 'You have been added to the group (asdf)', '2025-03-24', 0, 0),
(29, 103, 104, 'New file uploaded by the group (Team Marvel)', '2025-03-26', 0, 0),
(30, 124, 104, 'You have been added to the group (aaaaaa)', '2025-03-26', 0, 0),
(31, 125, 128, 'You have been added to the group (Team Alpha Omega)', '2025-03-26', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(1) NOT NULL,
  `title` text NOT NULL,
  `start_date` date NOT NULL DEFAULT current_timestamp(),
  `end_date` date NOT NULL DEFAULT current_timestamp(),
  `hectare` text NOT NULL,
  `type` text NOT NULL,
  `select2` text NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `title`, `start_date`, `end_date`, `hectare`, `type`, `select2`, `total`) VALUES
(9, 'asdasd', '2024-11-17', '2024-11-18', 'Hectare 1', 'Fertilizer', 'Sacks', 0),
(10, 'sdfsdf', '2024-11-17', '2024-11-18', 'Hectare 2', 'Fertilizer', 'Sacks', 0),
(11, 'nnnnnnnnn', '2024-11-21', '2024-11-22', 'Hectare 1', 'Watering', 'Sacks', 6);

-- --------------------------------------------------------

--
-- Table structure for table `schedule_history`
--

CREATE TABLE `schedule_history` (
  `schedule_history_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule_history`
--

INSERT INTO `schedule_history` (`schedule_history_id`, `schedule_id`, `date`) VALUES
(2, 8, '2024-11-13'),
(3, 8, '2024-11-13'),
(4, 9, '2024-11-17'),
(5, 10, '2024-11-17'),
(6, 11, '2024-11-18');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `section_id` int(11) NOT NULL,
  `department` varchar(255) DEFAULT NULL,
  `yr_lvl` varchar(255) DEFAULT NULL,
  `section_name` varchar(255) DEFAULT NULL,
  `adviser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`section_id`, `department`, `yr_lvl`, `section_name`, `adviser`) VALUES
(1, 'Information Technology', '4TH', 'BIT43', 104),
(2, 'Computer SCIENCE', '4TH', 'BCS41', 104),
(3, 'Computer SCIENCE', '4TH', 'BCS40', NULL),
(4, 'Information Technology', '3RD', 'BIT310', NULL),
(5, 'Computer SCIENCE', '3RD', 'BCS31', NULL),
(6, 'Computer SCIENCE', '3RD', 'BCS33', NULL),
(7, 'Computer SCIENCE', '4TH', 'BCS44', NULL),
(8, 'Information Technology', '4TH', 'BIT42', NULL),
(9, 'Information Technology', '4TH', 'BIT44', 128),
(10, 'Information Technology', '3RD', 'BIT33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `setdeadline`
--

CREATE TABLE `setdeadline` (
  `setdeadline_id` int(11) NOT NULL,
  `teams_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `deadline` date DEFAULT NULL,
  `status` int(1) NOT NULL COMMENT '0=ongoing\r\n1=scheduled\r\n2=past due\r\n3=completed',
  `notif` int(1) NOT NULL DEFAULT 1 COMMENT '1=unnotified, 0=notified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setdeadline`
--

INSERT INTO `setdeadline` (`setdeadline_id`, `teams_id`, `name`, `deadline`, `status`, `notif`) VALUES
(67, 14, 'Finding Group Members', NULL, 0, 0),
(68, 14, 'Title Proposal', NULL, 0, 0),
(69, 14, 'Title Proposal Chapter 1', NULL, 0, 0),
(70, 14, 'Title Proposal Chapter 2', NULL, 0, 0),
(71, 14, 'Title Proposal Chapter 3', NULL, 0, 0),
(72, 14, 'Proposal Defense', NULL, 0, 0),
(73, 15, 'Finding Group Members', NULL, 0, 0),
(74, 15, 'Title Proposal', NULL, 0, 0),
(75, 15, 'Title Proposal Chapter 1', NULL, 0, 0),
(76, 15, 'Title Proposal Chapter 2', NULL, 0, 0),
(77, 15, 'Title Proposal Chapter 3', NULL, 0, 0),
(78, 15, 'Proposal Defense', NULL, 0, 0),
(79, 15, 'Finding Group Members', NULL, 0, 0),
(80, 15, 'Title Proposal', NULL, 0, 0),
(81, 15, 'Chapter 1', NULL, 0, 0),
(82, 15, 'Chapter 2', NULL, 0, 0),
(83, 15, 'Chapter 3', NULL, 0, 0),
(84, 15, 'Proposal Defense', NULL, 0, 0),
(85, 15, 'Ethical Research Committee', NULL, 0, 0),
(86, 15, 'Chapter 4', NULL, 0, 0),
(87, 15, 'Chapter 5', NULL, 0, 0),
(88, 15, 'Full Paper', NULL, 0, 0),
(89, 15, 'Final Defense', NULL, 0, 0),
(90, 15, 'Finding Group Members', NULL, 0, 0),
(91, 15, 'Title Proposal', NULL, 0, 0),
(92, 15, 'Chapter 1', NULL, 0, 0),
(93, 15, 'Chapter 2', NULL, 0, 0),
(94, 15, 'Chapter 3', NULL, 0, 0),
(95, 15, 'Proposal Defense', NULL, 0, 0),
(96, 15, 'Ethical Research Committee', NULL, 0, 0),
(97, 15, 'Chapter 4', NULL, 0, 0),
(98, 15, 'Chapter 5', NULL, 0, 0),
(99, 15, 'Full Paper', NULL, 0, 0),
(100, 15, 'Final Defense', NULL, 0, 0),
(101, 15, 'Finding Group Members', NULL, 0, 0),
(102, 15, 'Title Proposal', NULL, 0, 0),
(103, 15, 'Chapter 1', NULL, 0, 0),
(104, 15, 'Chapter 2', NULL, 0, 0),
(105, 15, 'Chapter 3', NULL, 0, 0),
(106, 15, 'Proposal Defense', NULL, 0, 0),
(107, 15, 'Ethical Research Committee', NULL, 0, 0),
(108, 15, 'Chapter 4', NULL, 0, 0),
(109, 15, 'Chapter 5', NULL, 0, 0),
(110, 15, 'Full Paper', NULL, 0, 0),
(111, 15, 'Final Defense', NULL, 0, 0),
(134, 21, 'Finding Group Members', NULL, 0, 0),
(135, 21, 'Title Proposal', NULL, 0, 0),
(136, 21, 'Chapter 1', NULL, 0, 0),
(137, 21, 'Chapter 2', NULL, 0, 0),
(138, 21, 'Chapter 3', NULL, 0, 0),
(139, 21, 'Proposal Defense', NULL, 0, 0),
(140, 21, 'Ethical Research Committee', NULL, 0, 0),
(141, 21, 'Chapter 4', NULL, 0, 0),
(142, 21, 'Chapter 5', NULL, 0, 0),
(143, 21, 'Full Paper', NULL, 0, 0),
(144, 21, 'Final Defense', NULL, 0, 0),
(145, 22, 'Finding Group Members', NULL, 0, 0),
(146, 22, 'Title Proposal', NULL, 0, 0),
(147, 22, 'Chapter 1', '2025-03-10', 0, 0),
(148, 22, 'Chapter 2', NULL, 0, 0),
(149, 22, 'Chapter 3', NULL, 0, 0),
(150, 22, 'Proposal Defense', NULL, 0, 0),
(151, 22, 'Ethical Research Committee', NULL, 0, 0),
(152, 22, 'Chapter 4', NULL, 0, 0),
(153, 22, 'Chapter 5', NULL, 0, 0),
(154, 22, 'Full Paper', NULL, 0, 0),
(155, 22, 'Final Defense', NULL, 0, 0),
(156, 23, 'Finding Group Members', '2025-02-25', 3, 0),
(157, 23, 'Title Proposal', '2025-02-26', 0, 0),
(158, 23, 'Chapter 1', '2025-03-11', 1, 0),
(159, 23, 'Chapter 2', '2025-03-12', 1, 0),
(160, 23, 'Chapter 3', '2025-03-18', 0, 0),
(161, 23, 'Proposal Defense', NULL, 0, 0),
(162, 23, 'Ethical Research Committee', NULL, 0, 0),
(163, 23, 'Chapter 4', NULL, 0, 0),
(164, 23, 'Chapter 5', NULL, 0, 0),
(166, 23, 'Final Defense', NULL, 0, 0),
(179, 25, 'Finding Group Members', NULL, 0, 1),
(180, 25, 'Title Proposal', NULL, 0, 1),
(181, 25, 'Chapter 1', NULL, 0, 1),
(182, 25, 'Chapter 2', NULL, 0, 1),
(183, 25, 'Chapter 3', NULL, 0, 1),
(184, 25, 'Proposal Defense', NULL, 0, 1),
(185, 25, 'Ethical Research Committee', NULL, 0, 1),
(186, 25, 'Chapter 4', NULL, 0, 1),
(187, 25, 'Chapter 5', NULL, 0, 1),
(188, 25, 'Full Paper', NULL, 0, 1),
(189, 25, 'Final Defense', NULL, 0, 1),
(190, 26, 'Finding Group Members', NULL, 0, 1),
(191, 26, 'Title Proposal', NULL, 0, 1),
(192, 26, 'Chapter 1', NULL, 0, 1),
(193, 26, 'Chapter 2', NULL, 0, 1),
(194, 26, 'Chapter 3', NULL, 0, 1),
(195, 26, 'Proposal Defense', NULL, 0, 1),
(196, 26, 'Ethical Research Committee', NULL, 0, 1),
(197, 26, 'Chapter 4', NULL, 0, 1),
(198, 26, 'Chapter 5', NULL, 0, 1),
(199, 26, 'Full Paper', NULL, 0, 1),
(200, 26, 'Final Defense', NULL, 0, 1),
(201, 23, 'Extra Task', NULL, 0, 0),
(202, 27, 'Finding Group Members', NULL, 0, 1),
(203, 27, 'Title Proposal', NULL, 0, 1),
(204, 27, 'Chapter 1', NULL, 0, 1),
(205, 27, 'Chapter 2', NULL, 0, 1),
(206, 27, 'Chapter 3', NULL, 0, 1),
(207, 27, 'Proposal Defense', NULL, 0, 1),
(208, 27, 'Ethical Research Committee', NULL, 0, 1),
(209, 27, 'Chapter 4', NULL, 0, 1),
(210, 27, 'Chapter 5', NULL, 0, 1),
(211, 27, 'Full Paper', NULL, 0, 1),
(212, 27, 'Final Defense', NULL, 0, 1),
(213, 28, 'Finding Group Members', NULL, 0, 1),
(214, 28, 'Title Proposal', NULL, 0, 1),
(215, 28, 'Chapter 1', NULL, 0, 1),
(216, 28, 'Chapter 2', NULL, 0, 1),
(217, 28, 'Chapter 3', NULL, 0, 1),
(218, 28, 'Proposal Defense', NULL, 0, 1),
(219, 28, 'Ethical Research Committee', NULL, 0, 1),
(220, 28, 'Chapter 4', NULL, 0, 1),
(221, 28, 'Chapter 5', NULL, 0, 1),
(222, 28, 'Full Paper', NULL, 0, 1),
(223, 28, 'Final Defense', NULL, 0, 1),
(224, 23, 'Redefense', '2025-03-25', 1, 1),
(225, 29, 'Finding Group Members', NULL, 0, 1),
(226, 29, 'Title Proposal', NULL, 0, 1),
(227, 29, 'Chapter 1', NULL, 0, 1),
(228, 29, 'Chapter 2', NULL, 0, 1),
(229, 29, 'Chapter 3', NULL, 0, 1),
(230, 29, 'Proposal Defense', NULL, 0, 1),
(231, 29, 'Ethical Research Committee', NULL, 0, 1),
(232, 29, 'Chapter 4', NULL, 0, 1),
(233, 29, 'Chapter 5', NULL, 0, 1),
(234, 29, 'Full Paper', NULL, 0, 1),
(235, 29, 'Final Defense', NULL, 0, 1),
(236, 30, 'Finding Group Members', NULL, 0, 1),
(237, 30, 'Title Proposal', NULL, 0, 1),
(238, 30, 'Chapter 1', NULL, 0, 1),
(239, 30, 'Chapter 2', NULL, 0, 1),
(240, 30, 'Chapter 3', NULL, 0, 1),
(241, 30, 'Proposal Defense', NULL, 0, 1),
(242, 30, 'Ethical Research Committee', NULL, 0, 1),
(243, 30, 'Chapter 4', NULL, 0, 1),
(244, 30, 'Chapter 5', NULL, 0, 1),
(245, 30, 'Full Paper', NULL, 0, 1),
(246, 30, 'Final Defense', NULL, 0, 1),
(247, 31, 'Finding Group Members', NULL, 0, 1),
(248, 31, 'Title Proposal', NULL, 0, 1),
(249, 31, 'Chapter 1', NULL, 0, 1),
(250, 31, 'Chapter 2', NULL, 0, 1),
(251, 31, 'Chapter 3', NULL, 0, 1),
(252, 31, 'Proposal Defense', NULL, 0, 1),
(253, 31, 'Ethical Research Committee', NULL, 0, 1),
(254, 31, 'Chapter 4', NULL, 0, 1),
(255, 31, 'Chapter 5', NULL, 0, 1),
(256, 31, 'Full Paper', NULL, 0, 1),
(257, 31, 'Final Defense', NULL, 0, 1),
(258, 32, 'Finding Group Members', NULL, 0, 1),
(259, 32, 'Title Proposal', NULL, 0, 1),
(260, 32, 'Chapter 1', NULL, 0, 1),
(261, 32, 'Chapter 2', NULL, 0, 1),
(262, 32, 'Chapter 3', NULL, 0, 1),
(263, 32, 'Proposal Defense', NULL, 0, 1),
(264, 32, 'Ethical Research Committee', NULL, 0, 1),
(265, 32, 'Chapter 4', NULL, 0, 1),
(266, 32, 'Chapter 5', NULL, 0, 1),
(267, 32, 'Full Paper', NULL, 0, 1),
(268, 32, 'Final Defense', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `setdeadline_file`
--

CREATE TABLE `setdeadline_file` (
  `setdeadline_file_id` int(11) NOT NULL,
  `setdeadline_id` int(11) NOT NULL,
  `teams_id` int(11) NOT NULL,
  `file` text NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setdeadline_file`
--

INSERT INTO `setdeadline_file` (`setdeadline_file_id`, `setdeadline_id`, `teams_id`, `file`, `date`) VALUES
(1, 3, 1, 'Wireframe.docx', '2024-12-03'),
(2, 5, 1, 'Gym-Membership-Structure.pdf', '2024-12-03'),
(3, 47, 10, 'ERP.pdf', '2024-12-10'),
(4, 47, 10, 'Testing - (Dec 05).pdf', '2024-12-10'),
(5, 67, 14, 'portal (8).docx', '2025-02-01'),
(6, 158, 23, 'COR GULMATICO.pdf', '2025-02-08'),
(7, 158, 23, 'tactiq-free-transcript-3m9gJjxkm58.txt', '2025-02-08'),
(8, 169, 24, 'Final-Defense-Endorsement-Form.pdf', '2025-02-08'),
(9, 158, 23, 'default.jpg', '2025-02-21'),
(10, 158, 23, 'default.jpg', '2025-02-21'),
(11, 158, 23, 'default.jpg', '2025-02-21'),
(12, 158, 23, 'default.jpg', '2025-02-21'),
(13, 158, 23, 'default.jpg', '2025-02-21'),
(14, 158, 23, 'default.jpg', '2025-02-21'),
(15, 158, 23, 'default.jpg', '2025-02-21'),
(16, 158, 23, 'default.jpg', '2025-02-21'),
(17, 158, 23, 'mocha_love.gif', '2025-02-21'),
(18, 159, 23, 'jump-bear.gif', '2025-02-21'),
(19, 160, 23, 'jump-bear.gif', '2025-02-21'),
(20, 170, 24, 'Finalized-Informed-Consent-Form-English-1.pdf', '2025-02-25'),
(21, 158, 23, 'DLSUD MOU.pdf', '2025-02-25'),
(22, 158, 23, 'Final-Defense-Endorsement-Form.pdf', '2025-03-26');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int(11) NOT NULL,
  `teams_id` int(11) NOT NULL,
  `setdeadline_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `status` int(1) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `teams_id`, `setdeadline_id`, `title`, `description`, `status`, `date`) VALUES
(1, 1, 1, 'Create Chapter 1', 'Create Chapter 1', 1, '2024-12-06'),
(2, 1, 3, 'Create Chapter 2', 'Create Chapter 2', 2, '2024-12-06'),
(3, 1, 5, 'Proposal', 'Proposal desc', 4, '2024-12-06'),
(4, 1, 3, 'Chapter 3', 'Chapter 3 desc', 3, '2024-12-06'),
(5, 1, 1, 'Chapter 1', 'Chapter 1', 1, '2024-12-06'),
(6, 5, 15, 'Chapter !', 'Chapter !', 1, '2024-12-06'),
(7, 5, 18, 'asdasd', '           asdasd           ', 3, '2024-12-06'),
(8, 8, 34, 'chapter 1', 'chapter 1', 1, '2024-12-06'),
(9, 8, 36, 'chapter 2', 'chapter 2', 2, '2024-12-06'),
(10, 10, 43, 'chapter 1123', 'chapter 1 ', 1, '2024-12-10'),
(11, 10, 48, 'asdasdasd', 'asdasd', 2, '2024-12-15'),
(12, 14, 67, 'done', 'done', 4, '2025-02-01'),
(13, 14, 72, 'Speaker', 'do speak', 1, '2025-02-07'),
(14, 14, 67, 'Try task', 'task task task', 1, '2025-02-08'),
(15, 23, 158, 'Research - scope', 'make a research for about the topic to finalize the scope of our thesis', 4, '2025-02-08'),
(17, 23, 158, 'Task for Rei', '                    BLa lba', 1, '2025-02-24'),
(18, 23, 158, 'Chapter 1 Introduction of the Study', 'For Rei and Chester. Do this Task Immediately', 3, '2025-03-03'),
(19, 23, 158, 'Example', '                      ', 4, '2025-03-04'),
(20, 23, 159, 'Introduction', '                   Taeoawue', 4, '2025-03-04'),
(21, 23, 158, 'Test123', '                344q3      ', 2, '2025-03-05');

-- --------------------------------------------------------

--
-- Table structure for table `task_comment`
--

CREATE TABLE `task_comment` (
  `task_comment_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task_comment`
--

INSERT INTO `task_comment` (`task_comment_id`, `task_id`, `users_id`, `comment`) VALUES
(1, 1, 97, 'your chapter 1 need revisions'),
(2, 5, 97, 'bobo mo'),
(3, 6, 92, 'asdasdasd'),
(4, 7, 92, 'asdasd'),
(5, 7, 92, 'asdasd'),
(6, 8, 94, 'hello'),
(7, 18, 103, 'copy that'),
(8, 18, 105, 'Comment for Chapter 1'),
(9, 18, 105, 'Comment123'),
(10, 17, 105, 'Task mo Rei tapusin mona for Chapter 1');

-- --------------------------------------------------------

--
-- Table structure for table `task_like`
--

CREATE TABLE `task_like` (
  `task_like_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task_like`
--

INSERT INTO `task_like` (`task_like_id`, `task_id`, `users_id`) VALUES
(18, 1, 34),
(19, 5, 43),
(22, 1, 44),
(26, 1, 97),
(30, 4, 5),
(31, 2, 6),
(32, 4, 97),
(35, 6, 92),
(38, 7, 92),
(43, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `task_member`
--

CREATE TABLE `task_member` (
  `task_member_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `teams_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task_member`
--

INSERT INTO `task_member` (`task_member_id`, `task_id`, `teams_id`, `users_id`) VALUES
(26, 12, 14, 94),
(27, 12, 14, 93),
(28, 13, 14, 93),
(29, 14, 14, 93),
(30, 15, 23, 103),
(31, 16, 24, 108),
(32, 17, 23, 106),
(33, 18, 23, 103),
(34, 18, 23, 106),
(35, 19, 23, 103),
(36, 19, 23, 106),
(37, 20, 23, 103),
(38, 21, 23, 103),
(39, 21, 23, 106);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `teams_id` int(11) NOT NULL,
  `adviser_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `thesis_title` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `grade` double DEFAULT NULL,
  `adviser_status` int(1) NOT NULL DEFAULT 5,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `date_response` date DEFAULT NULL,
  `coor_approval` varchar(255) DEFAULT NULL,
  `ca_upload_date` date DEFAULT NULL,
  `defense_fee` varchar(255) DEFAULT NULL,
  `df_upload_date` date DEFAULT NULL,
  `coor_approval4` varchar(255) DEFAULT NULL,
  `ca_upload_date4` date DEFAULT NULL,
  `defense_fee4` varchar(255) DEFAULT NULL,
  `df_upload_date4` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`teams_id`, `adviser_id`, `users_id`, `name`, `thesis_title`, `status`, `grade`, `adviser_status`, `date`, `date_response`, `coor_approval`, `ca_upload_date`, `defense_fee`, `df_upload_date`, `coor_approval4`, `ca_upload_date4`, `defense_fee4`, `df_upload_date4`) VALUES
(14, 97, 94, 'THESIS GROUP', NULL, 2, 1, 1, '2025-01-12 12:09:22', '2025-02-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 100, 101, 'Small White Kamote', NULL, 0, NULL, 1, '2025-01-12 12:39:20', '2025-02-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 104, 102, 'Android App Devs', NULL, 2, 0, 1, '2025-02-08 00:55:41', '2025-02-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 104, 115, 'Team Marvel', 'Improving Academic Performance', 2, 0, 1, '2025-02-08 02:00:42', '2025-02-08', 'Form-Coordinator-Approval.pdf', '2025-03-24', 'Defense-fee.pdf', '2025-03-23', 'Form-Coordinator-Approval-4th-year.pdf', '2025-03-24', 'Defense-fee-4th-year.pdf', '2025-03-24'),
(25, 0, 110, 'asd', NULL, 0, NULL, 5, '2025-02-25 02:40:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 109, 108, 'Thesis Team', NULL, 0, NULL, 1, '2025-02-28 11:36:54', '2025-02-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 0, 113, 'Test', NULL, 0, NULL, 5, '2025-03-03 06:54:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 116, 117, 'ASD', NULL, 0, NULL, 0, '2025-03-05 09:23:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 0, 107, 'Thesis Teamtesting', NULL, 0, NULL, 5, '2025-03-24 15:06:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 104, 122, 'asdf', NULL, 0, NULL, 1, '2025-03-24 15:44:37', '2025-03-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 104, 124, 'aaaaaa', NULL, 0, NULL, 0, '2025-03-26 09:12:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 128, 125, 'Team Alpha Omega', NULL, 0, NULL, 1, '2025-03-26 10:03:51', '2025-03-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teams_member`
--

CREATE TABLE `teams_member` (
  `teams_member_id` int(11) NOT NULL,
  `adviser_id` int(11) NOT NULL,
  `teams_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `individual_grade` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams_member`
--

INSERT INTO `teams_member` (`teams_member_id`, `adviser_id`, `teams_id`, `users_id`, `individual_grade`) VALUES
(19, 97, 14, 94, NULL),
(21, 97, 14, 93, NULL),
(31, 100, 21, 91, NULL),
(32, 100, 21, 101, NULL),
(33, 104, 22, 102, NULL),
(34, 104, 22, 92, NULL),
(35, 104, 23, 105, 2.5),
(36, 104, 23, 103, 3.75),
(39, 104, 23, 106, NULL),
(40, 0, 25, 110, NULL),
(41, 109, 26, 108, NULL),
(43, 0, 27, 113, NULL),
(44, 116, 28, 117, NULL),
(47, 0, 29, 107, NULL),
(48, 104, 30, 122, NULL),
(49, 0, 29, 123, NULL),
(50, 104, 31, 124, NULL),
(51, 128, 32, 125, 3.75),
(52, 128, 32, 127, 3.75),
(53, 128, 32, 126, 4);

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `templates_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `notes` text NOT NULL,
  `report` text NOT NULL,
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`templates_id`, `users_id`, `title`, `notes`, `report`, `file`) VALUES
(7, 1, 'All Capstone Forms', 'All Official Capstone Forms', 'Capstone', 'Capstone-Research-Forms.pdf'),
(9, 1, 'ERC Checklist', 'Checklist for Ethics Review', 'Ethics Research Comitee', 'Fillable-Assessment-Checklist-for-Initial-Ethics-Review-by-CERC.pdf'),
(10, 1, 'ERC Consent Form', 'Informed Consent form English Version                      ', 'Ethics Research Comitee                      ', 'Finalized-Informed-Consent-Form-English-1.pdf'),
(11, 1, 'ERC Consent Form Fil Ver', 'Informed Consent Form For ERC Filipino Version', 'Ethics Research Comitee                      ', 'Finalized-Filipino-informed-consent-form.pdf'),
(12, 1, 'Final Defense Endorsement Form', 'Final Defense Form                      ', 'Capstone                      ', 'Final-Defense-Endorsement-Form.pdf'),
(13, 1, 'All Capstone Forms Docs', 'Capstone Research Forms', 'Capstone', 'Capstone-Research-Forms_(1)(3).docx'),
(14, 55, 'Acceptance Form', '                      ', '                      ', 'Acceptance Form.pdf'),
(15, 55, 'Approval Sheet', '                      ', '                      ', 'Approval Sheet.pdf'),
(16, 55, 'Final Defense Grade Form', '                      ', '                      ', 'Final Defense Grading Form.pdf'),
(17, 55, 'Endorsement Form of the Editor', '                      ', '                      ', 'Endorsement Form of the Editor.pdf'),
(18, 55, 'Final Endorsement Form', '                      ', '                      ', 'Final Endorsement Form.pdf'),
(19, 55, 'Progress Report Form', '                      ', '                      ', 'Progress Report Form.pdf'),
(20, 55, 'Proposal Defense Evaluation for Game Development', 'For Game Development, Application Development etc.', '                      ', 'Proposal Defense Evaluation Form for Game Development.pdf'),
(21, 55, 'Proposal Defense Evaluation Form for Transaction Processing System, Management Information System, etc', 'For Transaction Processing System, Management Information System, etc', '                      ', 'Proposal Defense Evaluation Form for Transaction Processing System, Management Information System.pdf'),
(22, 55, 'QUESTIONNAIRE FOR SOFTWARE EVALUATION', '                      ', '                      ', 'QUESTIONNAIRE FOR SOFTWARE EVALUATION.pdf'),
(23, 55, 'Revision List & Verdict Form', '                      ', '                      ', 'Revision List & Verdict Form.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `totalgroups`
--

CREATE TABLE `totalgroups` (
  `id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `totalgroups`
--

INSERT INTO `totalgroups` (`id`, `total`, `name`) VALUES
(1, 23, 'total groups'),
(2, 5, 'adviser Information Technology'),
(3, 9, 'adviser Computer SCIENCE');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `img` text NOT NULL DEFAULT 'default.png',
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `middlename` text NOT NULL,
  `section` varchar(255) DEFAULT NULL,
  `yr_lvl` varchar(255) DEFAULT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `passwordtxt` text NOT NULL,
  `department` text NOT NULL,
  `contact` text NOT NULL,
  `address` text NOT NULL,
  `code` int(11) NOT NULL,
  `verification_code` int(11) NOT NULL,
  `type` int(1) NOT NULL DEFAULT 2 COMMENT '0=admin,1=adviser,2=student',
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `img`, `firstname`, `lastname`, `middlename`, `section`, `yr_lvl`, `email`, `password`, `passwordtxt`, `department`, `contact`, `address`, `code`, `verification_code`, `type`, `status`) VALUES
(1, '1 by 1.jpg', 'Chester Admin', 'Gulmatico', '', NULL, NULL, 'admin@admin.com', '$2y$10$gxnN.h0VMgkC7mkREleNX.tjliRGhQ46vWXQ0advp2/kRm/38fcZO', 'admin', '', '0', '', 22198, 0, 0, 1),
(55, '476777709_1524862158186180_841651782384418952_n.jpg', 'Allen Admin', 'Sabater', '', NULL, NULL, 'admin2@admin.com', '$2y$10$/RzPSEoTdMRuQDC5F.W88e/uYN0dNoxXHVRBhYBSQbqvEdmL/Z546', 'admin', '', '0947555593', 'Camarin, Caloocan City', 2323, 0, 0, 1),
(99, 'default.png', '', '', '', NULL, NULL, 'test@email.com', '$2y$10$20h7BRE4gmVfqQUI7VYSh.xGWC1W3ztIOgaCb2T9rYG8lxkXt/pxS', 'test@email.com', 'Information Technology', '', '', 0, 0, 2, 0),
(103, '462924244_8396515283802480_2544004180710317751_n.jpg', 'Chester', 'Gulmatico', 'Adorna', 'BIT43', '4TH', 'StudentTest1@Gmail.com', '$2y$10$X.Qpp6La5I5qd5SK6EJA7.4gL8qWomoHywppCsOOFCwQ44gJvWoN.', 'Test123', 'Computer SCIENCE', '', '', 0, 0, 2, 0),
(104, '1709127757245.jpg', 'Roda', 'Sanares', 'Adviser', NULL, NULL, 'AdviserTest1@gmail.com', '$2y$10$gdgQRmgzEfI.PFE4FibBL.fq2c3Imyc/mtSiJnXEnNmJ825MxY2uK', 'Test123', 'Computer SCIENCE', '', '', 0, 0, 1, 1),
(105, 'bits-8bits.gif', 'Allen', 'Sabater', 'J', 'BIT43', '4TH', 'StudentTest2@gmail.com', '$2y$10$E4P/ODrJuokMCZshFvo7Ge2Pm/QOLfEICzgB3BH8uqm42uCDOLYDi', 'Test123', 'Computer SCIENCE', '', '', 0, 0, 2, 0),
(106, 'IMG_5383.JPG', 'Riezielle', 'Capule', 'Anne', 'BIT43', '4TH', 'StudentTest3@gmail.com', '$2y$10$xeabFuZ22298oLjfwlvZW.s/xvj5tBu1cGYHOgchzE8/aBdtPHNi6', 'Test123', 'Computer SCIENCE', '', '', 0, 0, 2, 0),
(107, 'default.png', 'Allen Jhayvee', 'Sabater', 'B', NULL, NULL, 'alntest@gmail.com', '$2y$10$JPHYFHbrNJifm17tUTob2e0DYdbxLetVRPtH3L94Ll7AdltIBfpXy', 'Test123', 'Information Technology', '', '', 0, 0, 2, 0),
(108, 'default.png', 'Alex Francis', 'Gecto', 'A', NULL, NULL, 'StudentTest4@gmail.com', '$2y$10$M7Lfp63zzNvJ.pFPSXV0puK5ytKEqkaFRRrwFhd16EOutNAp8rkjG', 'Test123', 'Information Technology', '', '', 0, 0, 2, 0),
(110, 'default.png', 'Student ', 'IT', 'B', 'BIT33', '3RD', 'test1@gmail.com', '$2y$10$8DqdnMYs1v8pRuSIoqS2qul9bSC7oTTwULXuMW1vNUGQLywO1AcWe', 'Test123', 'Information Technology', '', '', 0, 0, 2, 0),
(113, 'default.png', 'Allen', 'TEST', 'B', 'BIT44', '4TH', 'aln1234@gmail.com', '$2y$10$Y1C6Veja95W1yfeTVwmc8exuMfFZWcoUef8TMwUAUWtRXYJQE/xQa', 'Aln123', 'Information Technology', '', '', 0, 0, 2, 0),
(118, '358990593_10210866763103242_2895981100998306886_n.jpg', 'Carl', 'Aranas', 'Angelo M.', 'BIT43', '4TH', 'carlaranas01@gmail.com', '$2y$10$0FB10x3zTopGsAh6mLiGGOnOwq8IE20J4lpqzQsC/89DoFWmmXkni', 'qweQWE123', 'Information Technology', '', '', 0, 0, 2, 0),
(119, 'default.png', 'Cedric', 'Alegro', 'd', 'BSIT410', '4TH', 'ceddie@gmail.com', '$2y$10$/fl4kYnfc4cLr0j4raUkcuHeQ9EEyCIhK5dTxfGXZzcvndCieZlhy', 'qweQWE123', 'Information Technology', '', '', 0, 0, 2, 0),
(120, 'default.png', 'Jay', 'Lorenz', 'a', 'BIT310', '3RD', 'jay@gmail.com', '$2y$10$vX7fnA2e.7TtIpXwacH8KupJN36/rPEQK7suQvWHvWcz5P3ny64fi', 'qweQWE123', 'Information Technology', '', '', 0, 0, 2, 0),
(121, 'default.png', 'carlo', 'eguia', 'b', 'BIT310', '3RD', 'carlo@gmail.com', '$2y$10$A3NZjogQ3H1N7StKQgP.HeYKLyhbok6AzqEmzk399xOt2oDEbrHOG', 'QWEqwe123', 'Information Technology', '', '', 0, 0, 2, 0),
(122, 'default.png', 'Alex Francis', 'Gecto2', 'Aguinaldo', 'BIT43', '4TH', 'alextest@gmail.com', '$2y$10$h1/eNWuEi4UqbrYOtUrb2u7AMxtgGqwZ6hRxmBx1yByDyien5E.jy', 'Test1234', 'Information Technology', '', '', 0, 0, 2, 0),
(123, 'default.png', 'Allen tEST', 'Sabater', 'b', 'BIT43', '4TH', 'allensabater2@gmail.com', '$2y$10$TVVu7ac6Qx1N8ZIFdW.Xs.Fk18pYYNZo/h.jotXP/ZfdTQen326ve', 'Aln12345', 'Computer SCIENCE', '', '', 32023, 0, 2, 0),
(124, 'default.png', 'Allen T', 'Sabater', 'B', 'BIT43', '4TH', 'StudentALN@Gmail.com', '$2y$10$2MSXDBNzgADIeIC3meXa5uu9scfzik.p4SMFFnI6n7XV6Wp49qL5i', 'Test12345', 'Information Technology', '', '', 0, 0, 2, 0),
(125, 'default.png', 'Jolo', 'Pangalinan', 'J', 'BIT43', '4TH', 'StudentAlpha@Gmail.com', '$2y$10$.9tQr49/wKF5CpcOC7RXZ.fn9UFQv8IHTCTkVirx6wtztq9ApFWbi', 'Test123@', 'Information Technology', '', '', 0, 0, 2, 0),
(126, 'default.png', 'Jericko', 'Gomez', 'J', 'BIT43', '4TH', 'StudentBravo@Gmail.com', '$2y$10$xVxcpNK/bCfWRhQUoWfNFeQN8RVXBDcOCYScHVhuULrau41h36OuO', 'Test123@', 'Information Technology', '', '', 0, 0, 2, 0),
(127, 'default.png', 'Thomas', 'Edison', 'T', 'BIT43', '4TH', 'StudentCharlie@gmail.com', '$2y$10$dFMbWMPlRloe3eFxsShXfe1fBBiW9/onolMu/SNm4SfDYMjwC1TyW', 'Test123@', 'Information Technology', '', '', 0, 0, 2, 0),
(128, '367450503_6460369153998127_7057316521245686146_n.jpg', 'Rochelle', 'Sermana', 'De Leon', NULL, NULL, 'AdviserBeta@gmail.com', '$2y$10$P8KZlJIr7.VK5VZXvUbUH.mHwYFnNmavOwol81BlzJxmNqSt92.8C', 'Test123@', 'Information Technology', '', '', 0, 0, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_comment`
--
ALTER TABLE `admin_comment`
  ADD PRIMARY KEY (`admin_comment_id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_code`
--
ALTER TABLE `chat_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `panelist`
--
ALTER TABLE `panelist`
  ADD PRIMARY KEY (`panelist_id`);

--
-- Indexes for table `reminder`
--
ALTER TABLE `reminder`
  ADD PRIMARY KEY (`reminder_id`);

--
-- Indexes for table `reminder_adviser`
--
ALTER TABLE `reminder_adviser`
  ADD PRIMARY KEY (`reminder_adviser_id`),
  ADD KEY `files_notif` (`files_notif`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `schedule_history`
--
ALTER TABLE `schedule_history`
  ADD PRIMARY KEY (`schedule_history_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `setdeadline`
--
ALTER TABLE `setdeadline`
  ADD PRIMARY KEY (`setdeadline_id`),
  ADD KEY `notif` (`notif`);

--
-- Indexes for table `setdeadline_file`
--
ALTER TABLE `setdeadline_file`
  ADD PRIMARY KEY (`setdeadline_file_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `task_comment`
--
ALTER TABLE `task_comment`
  ADD PRIMARY KEY (`task_comment_id`);

--
-- Indexes for table `task_like`
--
ALTER TABLE `task_like`
  ADD PRIMARY KEY (`task_like_id`);

--
-- Indexes for table `task_member`
--
ALTER TABLE `task_member`
  ADD PRIMARY KEY (`task_member_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`teams_id`);

--
-- Indexes for table `teams_member`
--
ALTER TABLE `teams_member`
  ADD PRIMARY KEY (`teams_member_id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`templates_id`);

--
-- Indexes for table `totalgroups`
--
ALTER TABLE `totalgroups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_comment`
--
ALTER TABLE `admin_comment`
  MODIFY `admin_comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `chat_code`
--
ALTER TABLE `chat_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `panelist`
--
ALTER TABLE `panelist`
  MODIFY `panelist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reminder`
--
ALTER TABLE `reminder`
  MODIFY `reminder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reminder_adviser`
--
ALTER TABLE `reminder_adviser`
  MODIFY `reminder_adviser_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `schedule_history`
--
ALTER TABLE `schedule_history`
  MODIFY `schedule_history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `setdeadline`
--
ALTER TABLE `setdeadline`
  MODIFY `setdeadline_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;

--
-- AUTO_INCREMENT for table `setdeadline_file`
--
ALTER TABLE `setdeadline_file`
  MODIFY `setdeadline_file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `task_comment`
--
ALTER TABLE `task_comment`
  MODIFY `task_comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `task_like`
--
ALTER TABLE `task_like`
  MODIFY `task_like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `task_member`
--
ALTER TABLE `task_member`
  MODIFY `task_member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `teams_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `teams_member`
--
ALTER TABLE `teams_member`
  MODIFY `teams_member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `templates_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `totalgroups`
--
ALTER TABLE `totalgroups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_ibfk_1` FOREIGN KEY (`adviser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
