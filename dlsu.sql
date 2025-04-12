-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2025 at 07:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dlsu`
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
(3, 17, 2, 'asdasdasd');

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
(2, 10, 'Borja');

-- --------------------------------------------------------

--
-- Table structure for table `reminder`
--

CREATE TABLE `reminder` (
  `reminder_id` int(11) NOT NULL,
  `teams_id` int(11) NOT NULL,
  `setdeadline_id` int(11) NOT NULL,
  `notes` text NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reminder`
--

INSERT INTO `reminder` (`reminder_id`, `teams_id`, `setdeadline_id`, `notes`, `date`) VALUES
(1, 19, 14, 'asdasdasd', '2024-11-30');

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
  `notif` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reminder_adviser`
--

INSERT INTO `reminder_adviser` (`reminder_adviser_id`, `users_id`, `adviser_id`, `notes`, `date`, `notif`) VALUES
(1, 94, 0, 'You have been added to the group (THESIS GROUP)', '2024-11-30', 0),
(2, 91, 0, 'You have been added to the group (WEB DEV GROUP)', '2024-11-30', 0),
(3, 92, 0, 'You have been added to the group (wasalak group)', '2024-12-06', 0),
(4, 94, 0, 'You have been added to the group (THESIS GROUP)', '2024-12-06', 0),
(5, 94, 0, 'You have been added to the group (ITLOG GROUP)', '2024-12-06', 0),
(6, 94, 0, 'You have been added to the group (dada thesis group)', '2024-12-06', 0),
(7, 92, 0, 'You have been added to the group (bry groups)', '2024-12-06', 0),
(8, 94, 0, 'You have been added to the group (new group)', '2024-12-10', 0),
(9, 92, 0, 'You have been added to the group (FACIAL RECOG GROUP)', '2024-12-10', 0),
(13, 94, 97, 'You have been added to the group (production)', '2024-12-20', 0),
(14, 101, 0, 'You have been added to the group (Small White Kamote)', '2025-01-12', 0),
(15, 94, 0, 'You have been added to the group (THESIS GROUP)', '2025-01-12', 0);

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
-- Table structure for table `setdeadline`
--

CREATE TABLE `setdeadline` (
  `setdeadline_id` int(11) NOT NULL,
  `teams_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `deadline` text NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setdeadline`
--

INSERT INTO `setdeadline` (`setdeadline_id`, `teams_id`, `name`, `deadline`, `status`) VALUES
(67, 14, 'Finding Group Members', '', 0),
(68, 14, 'Title Proposal', '', 0),
(69, 14, 'Title Proposal Chapter 1', '', 0),
(70, 14, 'Title Proposal Chapter 2', '', 0),
(71, 14, 'Title Proposal Chapter 3', '', 0),
(72, 14, 'Proposal Defense', '', 0),
(73, 15, 'Finding Group Members', '', 0),
(74, 15, 'Title Proposal', '', 0),
(75, 15, 'Title Proposal Chapter 1', '', 0),
(76, 15, 'Title Proposal Chapter 2', '', 0),
(77, 15, 'Title Proposal Chapter 3', '', 0),
(78, 15, 'Proposal Defense', '', 0),
(79, 15, 'Finding Group Members', '', 0),
(80, 15, 'Title Proposal', '', 0),
(81, 15, 'Chapter 1', '', 0),
(82, 15, 'Chapter 2', '', 0),
(83, 15, 'Chapter 3', '', 0),
(84, 15, 'Proposal Defense', '', 0),
(85, 15, 'Ethical Research Committee', '', 0),
(86, 15, 'Chapter 4', '', 0),
(87, 15, 'Chapter 5', '', 0),
(88, 15, 'Full Paper', '', 0),
(89, 15, 'Final Defense', '', 0),
(90, 15, 'Finding Group Members', '', 0),
(91, 15, 'Title Proposal', '', 0),
(92, 15, 'Chapter 1', '', 0),
(93, 15, 'Chapter 2', '', 0),
(94, 15, 'Chapter 3', '', 0),
(95, 15, 'Proposal Defense', '', 0),
(96, 15, 'Ethical Research Committee', '', 0),
(97, 15, 'Chapter 4', '', 0),
(98, 15, 'Chapter 5', '', 0),
(99, 15, 'Full Paper', '', 0),
(100, 15, 'Final Defense', '', 0),
(101, 15, 'Finding Group Members', '', 0),
(102, 15, 'Title Proposal', '', 0),
(103, 15, 'Chapter 1', '', 0),
(104, 15, 'Chapter 2', '', 0),
(105, 15, 'Chapter 3', '', 0),
(106, 15, 'Proposal Defense', '', 0),
(107, 15, 'Ethical Research Committee', '', 0),
(108, 15, 'Chapter 4', '', 0),
(109, 15, 'Chapter 5', '', 0),
(110, 15, 'Full Paper', '', 0),
(111, 15, 'Final Defense', '', 0),
(134, 21, 'Finding Group Members', '', 0),
(135, 21, 'Title Proposal', '', 0),
(136, 21, 'Chapter 1', '', 0),
(137, 21, 'Chapter 2', '', 0),
(138, 21, 'Chapter 3', '', 0),
(139, 21, 'Proposal Defense', '', 0),
(140, 21, 'Ethical Research Committee', '', 0),
(141, 21, 'Chapter 4', '', 0),
(142, 21, 'Chapter 5', '', 0),
(143, 21, 'Full Paper', '', 0),
(144, 21, 'Final Defense', '', 0);

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
(4, 47, 10, 'Testing - (Dec 05).pdf', '2024-12-10');

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
(11, 10, 48, 'asdasdasd', 'asdasd', 2, '2024-12-15');

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
(6, 8, 94, 'hello');

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

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `teams_id` int(11) NOT NULL,
  `adviser_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `status` int(1) NOT NULL,
  `adviser_status` int(1) NOT NULL DEFAULT 5,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`teams_id`, `adviser_id`, `users_id`, `name`, `status`, `adviser_status`, `date`) VALUES
(14, 97, 94, 'THESIS GROUP', 0, 1, '2025-01-12 12:09:22'),
(21, 80, 101, 'Small White Kamote', 0, 0, '2025-01-12 12:39:20');

-- --------------------------------------------------------

--
-- Table structure for table `teams_member`
--

CREATE TABLE `teams_member` (
  `teams_member_id` int(11) NOT NULL,
  `adviser_id` int(11) NOT NULL,
  `teams_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams_member`
--

INSERT INTO `teams_member` (`teams_member_id`, `adviser_id`, `teams_id`, `users_id`) VALUES
(19, 97, 14, 94),
(21, 97, 14, 93),
(31, 80, 21, 91),
(32, 80, 21, 101);

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
(1, 0, 'test3', 'sdfsdf4', 'sdfsdf5', 'portal.docx'),
(3, 1, 'asdas', 'xcvxcv', 'asdasd', 'Financial-System-Corrections.docx'),
(4, 94, 'Manobo Proposal', 'Manobo Proposal dec', 'Manobo Proposal dec', 'Manobo-to-English-and-Definitions.docx'),
(5, 97, 'asdasd', 'asdasd', 'asdasdasdasdas            ', 'Website Development Agreement.docx'),
(6, 1, 'test', 'test', 'tset', 'Testing - (Dec 05).pdf');

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
(1, 15, 'total groups'),
(2, 2, 'adviser Information Technology'),
(3, 7, 'adviser Computer SCIENCE');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `img` text NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `middlename` text NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `img`, `firstname`, `lastname`, `middlename`, `email`, `password`, `passwordtxt`, `department`, `contact`, `address`, `code`, `verification_code`, `type`, `status`) VALUES
(1, 'Barbecued-snags.jpg', 'godeg', 'kola', '', 'admin@admin.com', '$2y$10$xkVsLR0D3dLN8lujKtCyVemYuHDWPbjnSbQtDBoD80DGkZsk2ObJi', 'admin', '', '0', '', 22198, 0, 0, 1),
(55, 'Barramundi.jpg', 'Neil', 'Aserit', '', 'admin2@admin.com', '$2y$10$fdQ0KhuswdFDTyLyqXd61u5iCdP0pEeX1Nn3wV/78aJXhujVAjXoO$2y$10$AV9iz3.2RUPdvcwErYxpGeB6cqZUuJ/bi3dvJmJnVdVdeiOhV.V.y', 'admin', '', '0947555593', 'Camarin, Caloocan City', 2323, 0, 0, 1),
(80, '', 'sorar', 'sorara34', '', 'sorar@gmail.com', '$2y$10$o.SqBafJIla87.VniaChF.BNl9jTlaIwUThCh3Vhe3ZmwJzeHjYxW', '123', 'Information Technology', '099999', 'navotas', 0, 0, 1, 0),
(91, 'bread1.jpg', 'jojo', '', '', 'godegkola@gmail.com', '$2y$10$uOIUDP/Wu65Jn.IX0KIJv.vLqge.MJOhMXgs395KzhJc4TK6i4e/C', '123', 'Information Technology', '', '', 0, 0, 2, 0),
(92, '', 'bry', '', '', 'bry@gmail.com', '$2y$10$uOIUDP/Wu65Jn.IX0KIJv.vLqge.MJOhMXgs395KzhJc4TK6i4e/C', '123', 'Computer SCIENCE', '', '', 0, 0, 2, 0),
(93, '', 'raf', '', '', 'godegkola@gmail.com', '$2y$10$uOIUDP/Wu65Jn.IX0KIJv.vLqge.MJOhMXgs395KzhJc4TK6i4e/C', '123', 'Computer SCIENCE', '', '', 0, 0, 2, 0),
(94, '', 'dada', '', '', 'dada@gmail.com', '$2y$10$uOIUDP/Wu65Jn.IX0KIJv.vLqge.MJOhMXgs395KzhJc4TK6i4e/C', '123', 'Computer SCIENCE', '', '', 0, 0, 2, 0),
(97, '', 'adviser', 'adviser', '', 'adviser@email.com', '$2y$10$vXOfchPVqUJ/7uBM8i6.Tu..8v7UewOxDs3dRodxKwnVa1nxgfXQe', '123', 'Computer SCIENCE', '', '', 0, 0, 1, 1),
(98, '', 'tes', 'sdfsd', '', 'Kingemman1820@gmail.com', '$2y$10$imNlITFAXSHfMAsnWsfWjOYrIyetevRSDjuA2ySnKiY6Tv9ltkRKC', 'syuk1820', 'Information Technology', '', '', 0, 0, 1, 0),
(99, '', '', '', '', 'test@email.com', '$2y$10$20h7BRE4gmVfqQUI7VYSh.xGWC1W3ztIOgaCb2T9rYG8lxkXt/pxS', 'test@email.com', 'Information Technology', '', '', 0, 0, 2, 0),
(100, '', '', '', '', 'new@email.com', '$2y$10$EveKseCrgCJ7v7cjORsy0uWfdtgDR2tKom.Z4Mo.Xd//9P5TA61RK', '123', 'Computer SCIENCE', '', '', 0, 0, 1, 0),
(101, '', 'wa', 'sa', 'asd', 'wasalak@email.com', '$2y$10$oyB37eZuC3yDPIw9YmbIYOzavra52zIlrap0n/x301dRHa9Jp7LhO', '123', 'Computer SCIENCE', '', '', 0, 0, 2, 0);

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
  ADD PRIMARY KEY (`reminder_adviser_id`);

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
-- Indexes for table `setdeadline`
--
ALTER TABLE `setdeadline`
  ADD PRIMARY KEY (`setdeadline_id`);

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
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `panelist`
--
ALTER TABLE `panelist`
  MODIFY `panelist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reminder`
--
ALTER TABLE `reminder`
  MODIFY `reminder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reminder_adviser`
--
ALTER TABLE `reminder_adviser`
  MODIFY `reminder_adviser_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
-- AUTO_INCREMENT for table `setdeadline`
--
ALTER TABLE `setdeadline`
  MODIFY `setdeadline_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `setdeadline_file`
--
ALTER TABLE `setdeadline_file`
  MODIFY `setdeadline_file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `task_comment`
--
ALTER TABLE `task_comment`
  MODIFY `task_comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `task_like`
--
ALTER TABLE `task_like`
  MODIFY `task_like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `task_member`
--
ALTER TABLE `task_member`
  MODIFY `task_member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `teams_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `teams_member`
--
ALTER TABLE `teams_member`
  MODIFY `teams_member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `templates_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `totalgroups`
--
ALTER TABLE `totalgroups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
