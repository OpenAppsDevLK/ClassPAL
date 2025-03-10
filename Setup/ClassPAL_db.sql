-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 25, 2024 at 12:14 AM
-- Server version: 5.7.40-log
-- PHP Version: 8.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `classpal`
--

-- --------------------------------------------------------

--
-- Table structure for table `cp_absent`
--

CREATE TABLE `cp_absent` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `student_id` int(11) NOT NULL,
  `subj_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cp_announcements`
--

CREATE TABLE `cp_announcements` (
  `id` int(11) NOT NULL,
  `an_date` date NOT NULL,
  `an_title` varchar(255) NOT NULL,
  `an_des` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cp_announcements`
--

INSERT INTO `cp_announcements` (`id`, `an_date`, `an_title`, `an_des`) VALUES
(15, '2023-01-17', 'Demo', 'Demo announcement');

-- --------------------------------------------------------

--
-- Table structure for table `cp_attendance`
--

CREATE TABLE `cp_attendance` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `student_id` int(11) NOT NULL,
  `subj_id` int(11) DEFAULT NULL,
  `att_time` time DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cp_ins`
--

CREATE TABLE `cp_ins` (
  `ins_id` int(11) NOT NULL,
  `ins_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cp_ins`
--

INSERT INTO `cp_ins` (`ins_id`, `ins_name`) VALUES
(4, 'None');

-- --------------------------------------------------------

--
-- Table structure for table `cp_logs`
--

CREATE TABLE `cp_logs` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `logdate` date DEFAULT NULL,
  `logtime` time DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cp_logs`
--

INSERT INTO `cp_logs` (`id`, `userid`, `username`, `logdate`, `logtime`) VALUES
(374, 2875, 'admin', '2023-05-14', '00:20:23'),
(375, 2875, 'admin', '2024-07-04', '18:13:47'),
(376, 2875, 'admin', '2024-07-07', '15:54:02'),
(377, 2875, 'admin', '2024-07-07', '16:30:28'),
(378, 2875, 'admin', '2024-07-08', '11:06:39'),
(379, 2875, 'admin', '2024-07-08', '11:07:36'),
(380, 2875, 'admin', '2024-07-08', '11:07:59'),
(381, 2875, 'admin', '2024-08-24', '16:23:44'),
(382, 2875, 'admin', '2024-09-16', '00:39:59'),
(383, 2875, 'admin', '2024-09-16', '01:23:34'),
(384, 2875, 'admin', '2024-09-16', '01:27:25'),
(385, 2875, 'admin', '2024-09-24', '13:17:47');

-- --------------------------------------------------------

--
-- Table structure for table `cp_online_reg_stu`
--

CREATE TABLE `cp_online_reg_stu` (
  `stu_ID` int(11) NOT NULL,
  `stu_studentID` int(11) UNSIGNED NOT NULL,
  `stu_regdate` date NOT NULL,
  `stu_studentname` varchar(255) NOT NULL,
  `stu_address` varchar(255) DEFAULT NULL,
  `stu_sex` varchar(45) NOT NULL,
  `stu_bday` date DEFAULT NULL,
  `stu_con_home` varchar(255) DEFAULT NULL,
  `stu_con_mobile1` varchar(255) DEFAULT NULL,
  `stu_con_mobile2` varchar(255) DEFAULT NULL,
  `stu_email` varchar(255) DEFAULT NULL,
  `stu_notes` varchar(255) CHARACTER SET big5 DEFAULT NULL,
  `stu_passGrade` varchar(45) DEFAULT NULL,
  `stu_image_name` varchar(255) DEFAULT NULL,
  `stu_nic` varchar(45) DEFAULT NULL,
  `stu_school` varchar(255) DEFAULT NULL,
  `stu_accesskey` int(11) DEFAULT NULL,
  `stu_barcode` int(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cp_payments`
--

CREATE TABLE `cp_payments` (
  `pay_id` int(11) NOT NULL,
  `Pay_stu_studentID` int(11) NOT NULL,
  `pay_student_name` varchar(255) NOT NULL,
  `pay_subj_id` int(11) DEFAULT NULL,
  `pay_insName` varchar(255) DEFAULT NULL,
  `pay_paymentdate` date DEFAULT NULL,
  `pay_paymentmonth` int(11) DEFAULT NULL,
  `pay_cos_fee` double(10,2) DEFAULT NULL,
  `pay_cos_admi` double(10,2) DEFAULT NULL,
  `pay_cos_total` double(10,2) DEFAULT NULL,
  `pay_misc_pay_description` varchar(255) DEFAULT NULL,
  `pay_misc_amount` double(10,2) DEFAULT NULL,
  `pay_stu_batch_no` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cp_payments`
--

INSERT INTO `cp_payments` (`pay_id`, `Pay_stu_studentID`, `pay_student_name`, `pay_subj_id`, `pay_insName`, `pay_paymentdate`, `pay_paymentmonth`, `pay_cos_fee`, `pay_cos_admi`, `pay_cos_total`, `pay_misc_pay_description`, `pay_misc_amount`, `pay_stu_batch_no`) VALUES
(170605647, 800094, 'Demo Student', 1038, 'None', '2023-05-14', 202305, 1000.00, 0.00, 1000.00, '', 0.00, 'ENG-2023');

-- --------------------------------------------------------

--
-- Table structure for table `cp_settings`
--

CREATE TABLE `cp_settings` (
  `setting_id` int(11) NOT NULL,
  `showrecords` int(11) NOT NULL,
  `sms_gway_dcode` varchar(255) DEFAULT NULL,
  `sms_gway_token` varchar(255) DEFAULT NULL,
  `sms_gway_name` varchar(45) DEFAULT NULL,
  `Enable_Disable_Stu_Reg` int(11) NOT NULL,
  `teacher_name` varchar(255) DEFAULT NULL,
  `teacher_photo` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cp_settings`
--

INSERT INTO `cp_settings` (`setting_id`, `showrecords`, `sms_gway_dcode`, `sms_gway_token`, `sms_gway_name`, `Enable_Disable_Stu_Reg`, `teacher_name`, `teacher_photo`) VALUES
(1, 10, NULL, NULL, NULL, 0, NULL, NULL),
(2, 0, '94773749866', '6847', 'Textit', 0, NULL, NULL),
(3, 0, NULL, NULL, NULL, 1, NULL, NULL),
(4, 0, NULL, NULL, NULL, 0, 'Student Management', '280788_openappz-logo (1).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cp_sidebar`
--

CREATE TABLE `cp_sidebar` (
  `id` int(11) NOT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cp_sidebar`
--

INSERT INTO `cp_sidebar` (`id`, `value`) VALUES
(1, NULL),
(2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cp_students`
--

CREATE TABLE `cp_students` (
  `stu_ID` int(11) NOT NULL,
  `stu_studentID` int(11) UNSIGNED NOT NULL,
  `stu_regdate` date NOT NULL,
  `stu_studentname` varchar(255) NOT NULL,
  `stu_address` varchar(255) DEFAULT NULL,
  `stu_sex` varchar(45) NOT NULL,
  `stu_bday` date DEFAULT '0000-00-00',
  `stu_con_home` varchar(255) DEFAULT NULL,
  `stu_con_mobile1` varchar(255) DEFAULT NULL,
  `stu_con_mobile2` varchar(255) DEFAULT NULL,
  `stu_email` varchar(255) DEFAULT NULL,
  `stu_notes` varchar(255) CHARACTER SET big5 DEFAULT NULL,
  `stu_image_name` varchar(255) DEFAULT NULL,
  `stu_nic` varchar(45) DEFAULT NULL,
  `stu_school` varchar(255) DEFAULT NULL,
  `stu_accesskey` int(11) DEFAULT NULL,
  `stu_barcode` int(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cp_students`
--

INSERT INTO `cp_students` (`stu_ID`, `stu_studentID`, `stu_regdate`, `stu_studentname`, `stu_address`, `stu_sex`, `stu_bday`, `stu_con_home`, `stu_con_mobile1`, `stu_con_mobile2`, `stu_email`, `stu_notes`, `stu_image_name`, `stu_nic`, `stu_school`, `stu_accesskey`, `stu_barcode`) VALUES
(1222, 800094, '2023-05-14', 'Demo Student', '', 'Male', '0000-00-00', '', '0775394882', '', '', '', '800094_96.jpg', '', '', 13506, NULL),
(1223, 1001107, '2024-07-04', 'vssdvsd', '', '', '0000-00-00', '', '5535345', '', '', '', 'df.jpg', '', '', 72606, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cp_subjects`
--

CREATE TABLE `cp_subjects` (
  `subj_id` int(11) NOT NULL,
  `subj_name` varchar(255) NOT NULL,
  `subj_classfee` double(10,2) NOT NULL,
  `subj_des` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cp_subjects`
--

INSERT INTO `cp_subjects` (`subj_id`, `subj_name`, `subj_classfee`, `subj_des`) VALUES
(1038, 'English', 0.00, 'English ');

-- --------------------------------------------------------

--
-- Table structure for table `cp_subj_allo`
--

CREATE TABLE `cp_subj_allo` (
  `sa_id` int(11) NOT NULL,
  `sa_stu_student_id` int(11) NOT NULL,
  `sa_stu_student_Name` varchar(255) DEFAULT NULL,
  `sa_subj_id` int(11) NOT NULL,
  `sa_institutid` int(11) DEFAULT NULL,
  `sa_subj_fee` double(10,2) NOT NULL,
  `sa_batch_no` varchar(255) NOT NULL,
  `sa_notes` varchar(255) DEFAULT NULL,
  `sa_barCode` int(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cp_subj_allo`
--

INSERT INTO `cp_subj_allo` (`sa_id`, `sa_stu_student_id`, `sa_stu_student_Name`, `sa_subj_id`, `sa_institutid`, `sa_subj_fee`, `sa_batch_no`, `sa_notes`, `sa_barCode`) VALUES
(247, 800094, 'Demo Student', 1038, 4, 1000.00, 'ENG-2023', '', 123456789),
(248, 1001107, 'vssdvsd', 1038, 4, 0.00, '2024', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cp_userpermission`
--

CREATE TABLE `cp_userpermission` (
  `per_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `OnOff` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cp_userpermission`
--

INSERT INTO `cp_userpermission` (`per_id`, `permission_id`, `uid`, `OnOff`) VALUES
(1822, 1136, 2875, 0),
(1821, 1135, 2875, 1),
(1820, 1134, 2875, 0),
(1819, 1133, 2875, 0),
(1818, 1132, 2875, 0),
(1817, 1131, 2875, 0),
(1816, 1130, 2875, 0),
(1815, 1129, 2875, 1),
(1814, 1128, 2875, 1),
(1813, 1127, 2875, 0),
(1812, 1126, 2875, 1),
(1811, 1125, 2875, 1),
(1810, 1124, 2875, 1),
(1809, 1123, 2875, 1),
(1808, 1122, 2875, 1),
(1807, 1121, 2875, 1),
(1806, 1120, 2875, 1),
(1805, 1119, 2875, 1),
(1804, 1118, 2875, 1),
(1803, 1117, 2875, 1),
(1802, 1116, 2875, 1),
(1801, 1115, 2875, 1),
(1800, 1114, 2875, 1),
(1799, 1113, 2875, 1),
(1798, 1112, 2875, 1),
(1797, 1111, 2875, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cp_users`
--

CREATE TABLE `cp_users` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `sp_id` int(11) DEFAULT NULL,
  `user_notes` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cp_users`
--

INSERT INTO `cp_users` (`id`, `username`, `password`, `firstname`, `lastname`, `sp_id`, `user_notes`) VALUES
(2875, 'admin', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Admin', 'ClassPAL', NULL, 'Admin Login Details------------------\r\nUsername: admin\r\nPassword: 123456789\r\n--------------------------------------------\r\nDemo Student ID: 800094\r\nBarcode: 123456789');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cp_absent`
--
ALTER TABLE `cp_absent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cp_announcements`
--
ALTER TABLE `cp_announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cp_attendance`
--
ALTER TABLE `cp_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cp_ins`
--
ALTER TABLE `cp_ins`
  ADD PRIMARY KEY (`ins_id`);

--
-- Indexes for table `cp_logs`
--
ALTER TABLE `cp_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cp_online_reg_stu`
--
ALTER TABLE `cp_online_reg_stu`
  ADD PRIMARY KEY (`stu_ID`);

--
-- Indexes for table `cp_payments`
--
ALTER TABLE `cp_payments`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `cp_settings`
--
ALTER TABLE `cp_settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `cp_students`
--
ALTER TABLE `cp_students`
  ADD PRIMARY KEY (`stu_ID`);

--
-- Indexes for table `cp_subjects`
--
ALTER TABLE `cp_subjects`
  ADD PRIMARY KEY (`subj_id`);

--
-- Indexes for table `cp_subj_allo`
--
ALTER TABLE `cp_subj_allo`
  ADD PRIMARY KEY (`sa_id`);

--
-- Indexes for table `cp_userpermission`
--
ALTER TABLE `cp_userpermission`
  ADD PRIMARY KEY (`per_id`);

--
-- Indexes for table `cp_users`
--
ALTER TABLE `cp_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cp_absent`
--
ALTER TABLE `cp_absent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cp_announcements`
--
ALTER TABLE `cp_announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `cp_attendance`
--
ALTER TABLE `cp_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT for table `cp_ins`
--
ALTER TABLE `cp_ins`
  MODIFY `ins_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cp_logs`
--
ALTER TABLE `cp_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=386;

--
-- AUTO_INCREMENT for table `cp_online_reg_stu`
--
ALTER TABLE `cp_online_reg_stu`
  MODIFY `stu_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `cp_settings`
--
ALTER TABLE `cp_settings`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cp_students`
--
ALTER TABLE `cp_students`
  MODIFY `stu_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1224;

--
-- AUTO_INCREMENT for table `cp_subjects`
--
ALTER TABLE `cp_subjects`
  MODIFY `subj_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1052;

--
-- AUTO_INCREMENT for table `cp_subj_allo`
--
ALTER TABLE `cp_subj_allo`
  MODIFY `sa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;

--
-- AUTO_INCREMENT for table `cp_userpermission`
--
ALTER TABLE `cp_userpermission`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1823;

--
-- AUTO_INCREMENT for table `cp_users`
--
ALTER TABLE `cp_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9128;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
