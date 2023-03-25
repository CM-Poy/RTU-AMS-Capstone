-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2023 at 05:05 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demolist`
--

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

CREATE TABLE `building` (
  `id_bldg` int(11) NOT NULL,
  `name_bldg` varchar(100) NOT NULL,
  `code_bldg` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`id_bldg`, `name_bldg`, `code_bldg`) VALUES
(1, 'Josefa Estolas Building', 'ITC'),
(2, 'Lydia Profetta Building', 'ITB'),
(3, 'Old Nursing Building', 'ONB'),
(4, 'Old Building', 'OB'),
(5, 'Main Academic Building', 'MAB'),
(6, 'Wellness Building', 'WB'),
(7, 'Research and Development Building', 'RNDB'),
(8, 'Senator Neptali A. Gonzales Academic Hall', 'TED');

-- --------------------------------------------------------

--
-- Table structure for table `cas`
--

CREATE TABLE `cas` (
  `name_crs` varchar(150) DEFAULT NULL,
  `code_crs` varchar(150) DEFAULT NULL,
  `name_dept` varchar(100) NOT NULL,
  `code_dept` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cas`
--

INSERT INTO `cas` (`name_crs`, `code_crs`, `name_dept`, `code_dept`) VALUES
('Bachelor of Science in Psychology', 'BSP', 'College of Arts and Sciences', 'CAS'),
('Bachelor of Arts in Political Science', 'BAPS', 'College of Arts and Sciences', 'CAS'),
('Bachelor of Science in Statistics', 'BSS', 'College of Arts and Sciences', 'CAS'),
('Bachelor of Science in Biology', 'BSB', 'College of Arts and Sciences', 'CAS');

-- --------------------------------------------------------

--
-- Table structure for table `cbet`
--

CREATE TABLE `cbet` (
  `name_crs` varchar(150) DEFAULT NULL,
  `code_crs` varchar(150) DEFAULT NULL,
  `name_dept` varchar(100) NOT NULL,
  `code_dept` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cbet`
--

INSERT INTO `cbet` (`name_crs`, `code_crs`, `name_dept`, `code_dept`) VALUES
('Bachelor of Science in Accountancy', 'BSA', 'College of Business, Entrepreneurship and Accountancy', 'CBET'),
('Bachelor of Science in Entrepreneurship', 'BSET', 'College of Business, Entrepreneurship and Accountancy', 'CBET'),
('Bachelor of Science in Office Administration Major in Office Management', 'BSOM', 'College of Business, Entrepreneurship and Accountancy', 'CBET'),
('Bachelor of Science in Business Administration Major in Operations Management', 'BSBAmOM', 'College of Business, Entrepreneurship and Accountancy', 'CBET'),
('Bachelor of Science in Business Administration Major in Marketing Management', 'BSBAmMM', 'College of Business, Entrepreneurship and Accountancy', 'CBET'),
('Bachelor of Science in Business Administration Major in Financial Management', 'BSBAmFM', 'College of Business, Entrepreneurship and Accountancy', 'CBET'),
('Bachelor of Science in Business Administration Major in Human Resource Management', 'BSBAmHRM', 'College of Business, Entrepreneurship and Accountancy', 'CBET');

-- --------------------------------------------------------

--
-- Table structure for table `ce`
--

CREATE TABLE `ce` (
  `name_crs` varchar(150) DEFAULT NULL,
  `code_crs` varchar(150) DEFAULT NULL,
  `name_dept` varchar(100) NOT NULL,
  `code_dept` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ce`
--

INSERT INTO `ce` (`name_crs`, `code_crs`, `name_dept`, `code_dept`) VALUES
('Bachelor of Secondary Education Major in English', 'BSEmE', 'College of Education', 'CE'),
('Bachelor of Secondary Education Major in Math', 'BSEmM', 'College of Education', 'CE'),
('Bachelor of Secondary Education Major in Science', 'BSEmS', 'College of Education', 'CE'),
('Bachelor of Secondary Education Major in Social Studies', 'BSEmSS', 'College of Education', 'CE'),
('Bachelor of Secondary Education Major in Filipino ', 'BSEmF', 'College of Education', 'CE'),
('Bachelor of Technical-Vocational Teacher Education Major in Animation', 'BTVLEmA', 'College of Education', 'CE'),
('Bachelor of Technical-Vocational Teacher Education major in Computer Hardware Servicing', 'BTVLEmCHS', 'College of Education', 'CE'),
('Bachelor of Technical-Vocational Teacher Education major in Visual Graphic Design', 'BTVLEmVCG', 'College of Education', 'CE'),
('Bachelor or Technical-Vocational Teacher Education Major in Garments Fashion and Design', 'BTVLEmGFD', 'College of Education', 'CE'),
('Bachelor or Technical-Vocational Teacher Education Major in Electronics Technology', 'BTVLEmET', 'College of Education', 'CE'),
('Bachelor or Technical-Vocational Teacher Education Major in Welding and Fabrications Technology', 'BTVLEmFT', 'College of Education', 'CE');

-- --------------------------------------------------------

--
-- Table structure for table `ceat`
--

CREATE TABLE `ceat` (
  `name_crs` varchar(150) DEFAULT NULL,
  `code_crs` varchar(150) DEFAULT NULL,
  `name_dept` varchar(100) NOT NULL,
  `code_dept` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ceat`
--

INSERT INTO `ceat` (`name_crs`, `code_crs`, `name_dept`, `code_dept`) VALUES
('Bachelor of Science in Mechanical Engineering', 'BSME', 'College of Engineering and Architecture', 'CEAT'),
('Bachelor of Science in Architecture', 'BSA', 'College of Engineering and Architecture', 'CEAT'),
('Bachelor of Science in Civil Engineering', 'BSCE', 'College of Engineering and Architecture', 'CEAT'),
('Bachelor of Science in Electrical Engineering', 'BSEE', 'College of Engineering and Architecture', 'CEAT'),
('Bachelor of Science in Electronics Engineering', 'BSECE', 'College of Engineering and Architecture', 'CEAT'),
('Bachelor of Science in Astronomy', 'BSA', 'College of Engineering and Architecture', 'CEAT'),
('Bachelor of Science in Computer Engineering', 'BSComE', 'College of Engineering and Architecture', 'CEAT'),
('Bachelor of Science in Industrial Engineering', 'BSIE', 'College of Engineering and Architecture', 'CEAT'),
('Bachelor of Science Industrial Technology', 'BSIT', 'College of Engineering and Architecture', 'CEAT'),
('Bachelor of Science in Information Technology', 'BSIT', 'College of Engineering and Architecture', 'CEAT'),
('Bachelor of Science in Instrumentation and Control Engineering', 'BSICE', 'College of Engineering and Architecture', 'CEAT');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id_crs` int(11) NOT NULL,
  `code_crs` varchar(150) DEFAULT NULL,
  `name_crs` varchar(150) DEFAULT NULL,
  `id_dept_fk` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id_crs`, `code_crs`, `name_crs`, `id_dept_fk`) VALUES
(1, 'BSME', 'Bachelor of Science in Mechanical Engineering', 1),
(2, 'BSA', 'Bachelor of Science in Architecture', 1),
(3, 'BSCE', 'Bachelor of Science in Civil Engineering', 1),
(4, 'BSEE', 'Bachelor of Science in Electrical Engineering', 1),
(5, 'BSECE', 'Bachelor of Science in Electronics Engineering', 1),
(6, 'BSA', 'Bachelor of Science in Astronomy', 1),
(7, 'BSComE', 'Bachelor of Science in Computer Engineering', 1),
(8, 'BSIE', 'Bachelor of Science in Industrial Engineering', 1),
(9, 'BSIT', 'Bachelor of Science Industrial Technology', 1),
(10, 'BSIT', 'Bachelor of Science in Information Technology', 1),
(11, 'BSICE', 'Bachelor of Science in Instrumentation and Control Engineering', 1),
(12, 'BSA', 'Bachelor of Science in Accountancy', 2),
(13, 'BSET', 'Bachelor of Science in Entrepreneurship', 2),
(14, 'BSOM', 'Bachelor of Science in Office Administration Major in Office Management', 2),
(15, 'BSBA-OM', 'Bachelor of Science in Business Administration Major in Operations Management', 2),
(16, 'BSBA-MM', 'Bachelor of Science in Business Administration Major in Marketing Management', 2),
(17, 'BSBA-FM', 'Bachelor of Science in Business Administration Major in Financial Management', 2),
(18, 'BSBA-HRM', 'Bachelor of Science in Business Administration Major in Human Resource Management', 2),
(19, 'BSE-E', 'Bachelor of Secondary Education Major in English', 3),
(20, 'BSE-M', 'Bachelor of Secondary Education Major in Math', 3),
(21, 'BSE-S', 'Bachelor of Secondary Education Major in Science', 3),
(22, 'BSE-SS', 'Bachelor of Secondary Education Major in Social Studies', 3),
(23, 'BSE-F', 'Bachelor of Secondary Education Major in Filipino ', 3),
(24, 'BTVLE-A', 'Bachelor of Technical-Vocational Teacher Education Major in Animation', 3),
(25, 'BTVLE-CHS', 'Bachelor of Technical-Vocational Teacher Education major in Computer Hardware Servicing', 3),
(26, 'BTVLEmVCG', 'Bachelor of Technical-Vocational Teacher Education major in Visual Graphic Design', 3),
(27, 'BTVLEmGFD', 'Bachelor or Technical-Vocational Teacher Education Major in Garments Fashion and Design', 3),
(28, 'BTVLEmET', 'Bachelor or Technical-Vocational Teacher Education Major in Electronics Technology', 3),
(29, 'BTVLEmFT', 'Bachelor or Technical-Vocational Teacher Education Major in Welding and Fabrications Technology', 3),
(30, 'BSP', 'Bachelor of Science in Psychology', 4),
(31, 'BAPS', 'Bachelor of Arts in Political Science', 4),
(32, 'BSS', 'Bachelor of Science in Statistics', 4),
(33, 'BSB', 'Bachelor of Science in Biology', 4),
(34, 'BSPE', 'Bachelor of Science in Physical Education', 5),
(36, 'ASDSDGSDFSDFSFD', 'CEREA', 0),
(37, 'Bachelor of Science in Administration Department', 'BSAD', 2),
(38, 'BSAD', 'BACH', 2);

-- --------------------------------------------------------

--
-- Table structure for table `demo`
--

CREATE TABLE `demo` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id_dept` int(11) NOT NULL,
  `name_dept` varchar(100) NOT NULL,
  `code_dept` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id_dept`, `name_dept`, `code_dept`) VALUES
(1, 'College of Engineering and Architecture', 'CEAT'),
(2, 'College of Business, Entrepreneurship and Accountancy', 'CBET'),
(3, 'College of Education', 'CE'),
(4, 'College of Arts and Sciences', 'CAS'),
(5, 'Institute of Human Kinetics', 'IHK'),
(6, 'College of Martial Arts and Crafts', 'CMAC');

-- --------------------------------------------------------

--
-- Table structure for table `ihk`
--

CREATE TABLE `ihk` (
  `name_crs` varchar(150) DEFAULT NULL,
  `code_crs` varchar(150) DEFAULT NULL,
  `name_dept` varchar(100) NOT NULL,
  `code_dept` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ihk`
--

INSERT INTO `ihk` (`name_crs`, `code_crs`, `name_dept`, `code_dept`) VALUES
('Bachelor of Science in Physical Education', 'BSPE', 'Institute of Human Kinetics', 'IHK');

-- --------------------------------------------------------

--
-- Table structure for table `ittuesday20230321`
--

CREATE TABLE `ittuesday20230321` (
  `id` int(6) NOT NULL,
  `studnum` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `midin` varchar(100) NOT NULL,
  `remarks` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id_room` int(11) NOT NULL,
  `code_room` varchar(100) NOT NULL,
  `id_bldg_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id_room`, `code_room`, `id_bldg_fk`) VALUES
(1, 'ITC-100', 1),
(2, 'ITB-100', 2),
(3, 'ONB-100', 3),
(4, 'OB-100', 4),
(5, 'MAB-100', 5),
(6, 'WB-100', 6),
(7, 'RNDB-100', 7),
(8, 'TED-100', 8);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id_schd` int(11) NOT NULL,
  `fnameuser_schd` varchar(100) NOT NULL,
  `subj_schd` varchar(100) NOT NULL,
  `sect_schd` varchar(100) NOT NULL,
  `day_schd` varchar(100) NOT NULL,
  `frmtime_schd` varchar(100) NOT NULL,
  `totime_schd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id_sect` int(11) NOT NULL,
  `code_sect` varchar(100) NOT NULL,
  `id_crs_fk` int(11) NOT NULL,
  `id_yearlvl_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id_sect`, `code_sect`, `id_crs_fk`, `id_yearlvl_fk`) VALUES
(1, 'CEAT-37-801A', 10, 1),
(2, 'CEAT-37-802A', 10, 2),
(3, 'CBET-23-102P', 13, 3),
(4, 'asdasdasd', 1, 1),
(5, 'asdasdasd', 1, 1),
(6, 'asdasdasd', 1, 1),
(7, 'asdasdasd', 1, 1),
(8, 'asdasd', 0, 0),
(9, 'asdasd', 0, 0),
(10, 'asdasd', 0, 0),
(11, 'CEAT-45-112A', 1, 0),
(12, 'CEAT-45-112A', 1, 0),
(13, 'CAS-12-301P', 22, 2),
(14, 'CAS-12-301P', 22, 2);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id_stud` int(11) NOT NULL,
  `fullname_stud` varchar(100) NOT NULL,
  `instemail_stud` varchar(100) NOT NULL,
  `studentsid_stud` varchar(100) NOT NULL,
  `gfullname_stud` varchar(100) NOT NULL,
  `gemail_stud` varchar(100) NOT NULL,
  `id_course_fk` int(11) NOT NULL,
  `id_yr_fk` int(11) NOT NULL,
  `id_section_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id_stud`, `fullname_stud`, `instemail_stud`, `studentsid_stud`, `gfullname_stud`, `gemail_stud`, `id_course_fk`, `id_yr_fk`, `id_section_fk`) VALUES
(1, 'Clint Marius', '', '2019-105701', 'Divino Angelo Cabacaba', 'quindao.clintmarius@gmail.com', 10, 1, 1),
(2, 'Edgie Roy', '', '2019-105702', 'Marc Gido Mendoza', '2019-105700@rtu.edu.ph', 10, 2, 2),
(3, 'Jamir Matthew', '', '2019-105703', 'Mark Joseph Lapera', 'jamirmatthewdemata@gmail.com', 10, 3, 1),
(4, 'Ross Matthew', '', '2019-105704', 'Troy Matthew Pablo', 'rossmatthewsantos@gmail.com', 10, 4, 2),
(6, 'asd', 'asd@gmail.com', 'asd', '123', '123@gmail.com', 1, 1, 1),
(7, 'asdf', 'asdf@gmail.com', '12314123', 'asddf', '123123asdasd@gmail.com', 21, 2, 2),
(8, 'asdf', 'asdf@gmail.com', '12314123', 'asddf', '123123asdasd@gmail.com', 21, 3, 2),
(9, 'asdf', 'asdf@gmail.com', '12314123', 'asddf', '123123asdasd@gmail.com', 21, 4, 2),
(10, 'asdf', 'asdf@gmail.com', '12314123', 'asddf', '123123asdasd@gmail.com', 21, 2, 2),
(11, 'adoy', 'adoy@gmail.com', '12341-1232', 'asdoy', 'asody@gmail.com', 2, 4, 2),
(12, 'adoy', 'adoy@gmail.com', '12341-1232', 'asdoy', 'asody@gmail.com', 2, 3, 2),
(16, '', '', '', '', '', 1, 0, 0),
(17, '', '', '', '', '', 1, 0, 0),
(18, 'Casd', 'Casd@gmail.com', '123412312', 'asds2222', 'sdg2@gmail.com', 2, 0, 0),
(19, 'Casd', 'Casd@gmail.com', '123412312', 'asds2222', 'sdg2@gmail.com', 2, 0, 0),
(20, 'qqweqwe', 'qwewqe@gmail.com', 'qweqwe', 'asdasd', 'asdsad@gmail.com', 21, 0, 0),
(21, 'qqweqwe', 'qwewqe@gmail.com', 'qweqwe', 'asdasd', 'asdsad@gmail.com', 21, 0, 0),
(22, 'Adoy', 'adoy@gmail.com', '12341-2312', 'asdg', 'asd2@gmail.com', 19, 0, 0),
(23, 'Adoy', 'adoy@gmail.com', '12341-2312', 'asdg', 'asd2@gmail.com', 19, 0, 0),
(24, 'asd', 'asd@gmail.com', 'asd', 'asd', 'asd@gmail.com', 1, 0, 0),
(25, 'asd', 'asd@gmail.com', 'asd', 'asd', 'asd@gmail.com', 1, 0, 0),
(26, 'asd', 'asd@gmail.com', 'asd', 'asd', 'asd@gmail.com', 1, 0, 0),
(27, 'asd', 'asd@gmail.com', 'asd', 'asd', 'asd@gmail.com', 1, 0, 0),
(28, 'asd', 'asd@gmail.com', 'asd', 'asd', 'asd@gmail.com', 1, 0, 0),
(29, 'asd', 'asd@gmail.com', 'asd', 'asd', 'asd@gmail.com', 1, 0, 0),
(30, 'clint', 'asd2@gmail.com', '1234', 'asdas', '11asdasd@gmail.com', 3, 0, 0),
(31, 'clint', 'asd2@gmail.com', '1234', 'asdas', '11asdasd@gmail.com', 3, 0, 0),
(32, 'clint', 'asd2@gmail.com', '1234', 'asdas', '11asdasd@gmail.com', 3, 0, 0),
(33, 'clint', 'asd2@gmail.com', '1234', 'asdas', '11asdasd@gmail.com', 3, 0, 0),
(34, 'clint', 'asd2@gmail.com', '1234', 'asdas', '11asdasd@gmail.com', 3, 0, 0),
(35, 'dsfgsdfgsdfg', 'sdfgsdfg@gmaill.com', '123sdsdsdf', 'asddsa2', 'sdfsdfw2@gmail.com', 16, 0, 0),
(36, 'Clint Marius Quindao', '2019-105701@rtu.edu.ph', '2019-105701@rtu.edu.ph', 'Divinoi', 'divino@gmail.com', 4, 0, 0),
(37, 'Jamir Jay Q. De Estoquia', '2019-234123', '2019-234123@gmail.com', 'Matthew Edgie B. Quindao', 'mesdj@gmai.com', 12, 12, 4);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id_subj` int(11) NOT NULL,
  `code_subj` varchar(150) NOT NULL,
  `name_subj` varchar(150) NOT NULL,
  `units_subj` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id_subj`, `code_subj`, `name_subj`, `units_subj`) VALUES
(1, 'qwe', 'qwe', 0),
(2, 'qwe', 'qwe', 0),
(3, 'ASD', 'ASD', 0),
(4, 'Information Media Arts Laboratory', 'ITL-122L', 2);

-- --------------------------------------------------------

--
-- Table structure for table `userlogs`
--

CREATE TABLE `userlogs` (
  `id` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `logintime` datetime NOT NULL,
  `logouttime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlogs`
--

INSERT INTO `userlogs` (`id`, `user`, `logintime`, `logouttime`) VALUES
(1, '', '2023-03-11 09:19:58', '0000-00-00 00:00:00'),
(2, '', '2023-03-11 09:20:19', '0000-00-00 00:00:00'),
(3, '', '0000-00-00 00:00:00', '2023-03-11 09:20:23'),
(4, '', '2023-03-11 09:25:12', '0000-00-00 00:00:00'),
(5, '', '0000-00-00 00:00:00', '2023-03-11 09:26:20'),
(6, '', '2023-03-11 09:26:26', '0000-00-00 00:00:00'),
(7, '', '2023-03-11 09:27:08', '0000-00-00 00:00:00'),
(8, 'admin', '2023-03-11 09:27:42', '0000-00-00 00:00:00'),
(9, 'admin', '2023-03-11 09:50:14', '0000-00-00 00:00:00'),
(10, 'admin', '2023-03-11 09:50:56', '0000-00-00 00:00:00'),
(11, 'admin', '2023-03-11 09:51:33', '0000-00-00 00:00:00'),
(12, '', '0000-00-00 00:00:00', '2023-03-11 09:51:36'),
(13, 'admin', '2023-03-11 09:54:34', '0000-00-00 00:00:00'),
(14, 'admin', '2023-03-21 06:51:53', '2023-03-21 06:53:51'),
(15, 'admin', '2023-03-21 06:56:33', '0000-00-00 00:00:00'),
(16, 'admin', '2023-03-21 06:56:44', '0000-00-00 00:00:00'),
(17, 'admin', '2023-03-21 06:57:00', '0000-00-00 00:00:00'),
(18, 'admin', '2023-03-21 06:58:45', '0000-00-00 00:00:00'),
(19, 'admin', '2023-03-21 07:00:26', '0000-00-00 00:00:00'),
(20, 'admin', '2023-03-21 07:03:32', '0000-00-00 00:00:00'),
(21, 'admin', '2023-03-21 07:04:55', '0000-00-00 00:00:00'),
(22, 'admin', '2023-03-21 07:05:59', '0000-00-00 00:00:00'),
(23, 'admin', '2023-03-21 07:06:24', '0000-00-00 00:00:00'),
(24, 'admin', '2023-03-21 07:06:51', '2023-03-21 07:06:53'),
(25, 'admin', '2023-03-22 12:51:43', '0000-00-00 00:00:00'),
(26, 'admin', '2023-03-22 01:56:51', '0000-00-00 00:00:00'),
(27, 'admin', '2023-03-22 01:57:03', '0000-00-00 00:00:00'),
(28, 'admin', '2023-03-22 01:57:17', '0000-00-00 00:00:00'),
(29, 'admin', '2023-03-22 03:38:09', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `hnr_users` varchar(100) NOT NULL,
  `fullname_users` varchar(100) NOT NULL,
  `instemail_users` varchar(100) NOT NULL,
  `empno_users` varchar(100) NOT NULL,
  `pass_users` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `hnr_users`, `fullname_users`, `instemail_users`, `empno_users`, `pass_users`) VALUES
(1, 'Professor', 'Clint Marius S. Quindao', 'clintmarius@rtu.edu.ph', '2019-105701', 'admin'),
(3, 'Assistant Professor', 'Edgie Roy B. Estoquia II', 'jayestoquia@rtu.edu.ph', '2019-105700', 'admin'),
(5, '', '', '', '', ''),
(6, 'Doctor', 'Ma. Cecilia A. Tapar', 'mctapar@rtu.edu.ph', '2017-134632', 'admin'),
(7, 'Instructor', 'Armando D. Moslow', 'admoslow@rtu.edu.ph', '2018-273521', 'admin'),
(8, 'Instructor', 'Joseph L. Macasala', 'jmacasala@rtu.edu.ph', '2017-674823', 'admin'),
(9, 'Doctor', 'Matthew F. Santos', 'mssantos@rtu.edu.ph', '2019-153023', 'admin'),
(10, 'Doctor', 'Jamir De Estoquia', 'md@gmail.com', '123501232312', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE `year` (
  `id_yr` int(11) NOT NULL,
  `yearlvl_yr` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `year`
--

INSERT INTO `year` (`id_yr`, `yearlvl_yr`) VALUES
(1, '1st Year'),
(2, '2nd Year'),
(3, '3nd Year'),
(4, '4nd Year');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`id_bldg`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id_crs`),
  ADD KEY `dept_fk` (`id_dept_fk`);

--
-- Indexes for table `demo`
--
ALTER TABLE `demo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id_dept`);

--
-- Indexes for table `ittuesday20230321`
--
ALTER TABLE `ittuesday20230321`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id_room`),
  ADD KEY `id_bldg_fk` (`id_bldg_fk`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id_schd`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id_sect`),
  ADD KEY `sections_ibfk_1` (`id_crs_fk`),
  ADD KEY `id_yrlvl_fk` (`id_yearlvl_fk`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id_stud`),
  ADD KEY `course_fk` (`id_course_fk`),
  ADD KEY `section_fk` (`id_section_fk`),
  ADD KEY `id_yr_fk` (`id_yr_fk`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id_subj`);

--
-- Indexes for table `userlogs`
--
ALTER TABLE `userlogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- Indexes for table `year`
--
ALTER TABLE `year`
  ADD PRIMARY KEY (`id_yr`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `building`
--
ALTER TABLE `building`
  MODIFY `id_bldg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id_crs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `demo`
--
ALTER TABLE `demo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id_dept` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ittuesday20230321`
--
ALTER TABLE `ittuesday20230321`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id_room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id_schd` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id_sect` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id_stud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id_subj` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `userlogs`
--
ALTER TABLE `userlogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `year`
--
ALTER TABLE `year`
  MODIFY `id_yr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
