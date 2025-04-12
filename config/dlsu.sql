-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2025 at 02:32 PM
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
(1, 2, 'awsdaad');

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
(0, 130, 132, 'You have been added to the group (Test Team)', '2025-04-04', 0, 0),
(0, 130, 132, 'You have been added to the group (Test Team)', '2025-04-04', 0, 0),
(0, 130, 132, 'You have been added to the group (Test Team)', '2025-04-04', 0, 0);

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

-- --------------------------------------------------------

--
-- Table structure for table `schedule_history`
--

CREATE TABLE `schedule_history` (
  `schedule_history_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'Information Technology', '4TH', 'BIT43', 132);

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
(12, 2, 'Finding Group Members', NULL, 0, 1),
(13, 2, 'Title Proposal', NULL, 0, 1),
(14, 2, 'Chapter 1', NULL, 0, 0),
(15, 2, 'Chapter 2', NULL, 0, 1),
(16, 2, 'Chapter 3', NULL, 0, 1),
(17, 2, 'Proposal Defense', NULL, 0, 1),
(18, 2, 'Ethical Research Committee', NULL, 0, 1),
(19, 2, 'Chapter 4', NULL, 0, 1),
(20, 2, 'Chapter 5', NULL, 0, 1),
(21, 2, 'Full Paper', NULL, 0, 1),
(22, 2, 'Final Defense', NULL, 0, 1);

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
(4, 2, 14, 'TESTING', '                      TESTING', 1, '2025-04-04');

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
(1, 4, 132, 'ADVISER TEST COMMENT'),
(2, 4, 130, 'Test123'),
(3, 4, 130, 'Test 123\r\n'),
(4, 4, 130, 'Test 123'),
(7, 4, 132, 'Hello world'),
(8, 4, 130, 'Testing'),
(9, 0, 130, 'Testing Student Comment'),
(10, 0, 130, 'Testing student comment'),
(11, 0, 130, 'Tetsing comment'),
(12, 0, 130, 'testing student comments'),
(13, 0, 130, 'Testing321'),
(14, 0, 130, 'testing 123'),
(15, 0, 130, 'Testing 123'),
(16, 0, 132, 'sssss'),
(17, 0, 130, 'Ambotyasdasd'),
(18, 0, 130, 'asdasdasdasdasd'),
(19, 0, 130, 'Testing 123'),
(20, 4, 130, 'Testing 123'),
(21, 4, 130, 'Testing345');

-- --------------------------------------------------------

--
-- Table structure for table `task_like`
--

CREATE TABLE `task_like` (
  `task_like_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(4, 4, 2, 130);

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
  `comments` text DEFAULT NULL,
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

INSERT INTO `teams` (`teams_id`, `adviser_id`, `users_id`, `name`, `thesis_title`, `comments`, `status`, `grade`, `adviser_status`, `date`, `date_response`, `coor_approval`, `ca_upload_date`, `defense_fee`, `df_upload_date`, `coor_approval4`, `ca_upload_date4`, `defense_fee4`, `df_upload_date4`) VALUES
(2, 132, 130, 'Test Team', 'testing title 123', NULL, 0, NULL, 1, '2025-04-04 19:52:20', '2025-04-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
(3, 132, 2, 130, NULL),
(4, 132, 2, 131, NULL);

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
(130, 'default.png', 'SampleUser', 'SampleUser', 'SampleUser', 'BIT43', '4TH', 'Sample@gmail.com', '$2y$10$K6J8DMNzE1m9sWSOKPtZJeB2W1vpr9nJrS2JKYyES1sibyicvnH2y', 'Testing123', 'Information Technology', '', '', 0, 0, 2, 0),
(131, 'default.png', 'SampleUser2', 'SampleUser2', 'SampleUser2', 'BIT43', '4TH', 'Sample2@gmail.com', '$2y$10$p8xHOMfmd4JIljnAnvKzAOCC.L8JGBwac4Ee6dbUdefv.CgtGaCga', 'Testing123', 'Information Technology', '', '', 0, 0, 2, 0),
(132, 'default.png', 'Sample Adviser', 'Sample Adviser', 'Sample Adviser', NULL, NULL, 'sampleadviser@gmail.com', '$2y$10$P40s6TLz/YeJ4E2UyUVAEu/LznwA5c07LD7iVWaCzW/pwXJ4Jq3mu', 'Testing123', 'Information Technology', '', '', 0, 0, 1, 1);

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
  ADD PRIMARY KEY (`section_id`),
  ADD KEY `sections_ibfk_1` (`adviser`);

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
  MODIFY `admin_comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_code`
--
ALTER TABLE `chat_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `panelist`
--
ALTER TABLE `panelist`
  MODIFY `panelist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reminder`
--
ALTER TABLE `reminder`
  MODIFY `reminder_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(1) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedule_history`
--
ALTER TABLE `schedule_history`
  MODIFY `schedule_history_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setdeadline`
--
ALTER TABLE `setdeadline`
  MODIFY `setdeadline_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `setdeadline_file`
--
ALTER TABLE `setdeadline_file`
  MODIFY `setdeadline_file_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `task_comment`
--
ALTER TABLE `task_comment`
  MODIFY `task_comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `task_like`
--
ALTER TABLE `task_like`
  MODIFY `task_like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `task_member`
--
ALTER TABLE `task_member`
  MODIFY `task_member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `teams_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teams_member`
--
ALTER TABLE `teams_member`
  MODIFY `teams_member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `templates_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `totalgroups`
--
ALTER TABLE `totalgroups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

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
