-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2021 at 06:21 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sfp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_deatils_tbl`
--

CREATE TABLE `bank_deatils_tbl` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `branch_name` longtext NOT NULL,
  `bank_balance` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank_deatils_tbl`
--

INSERT INTO `bank_deatils_tbl` (`id`, `bank_name`, `branch_name`, `bank_balance`) VALUES
(1, 'SBI', 'CBE Branch', 8500);

-- --------------------------------------------------------

--
-- Table structure for table `college_details_tbl`
--

CREATE TABLE `college_details_tbl` (
  `id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `collegeofstudy` varchar(255) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `contact_person_mobile` varchar(50) NOT NULL,
  `college_phone` varchar(50) NOT NULL,
  `college_email` varchar(100) NOT NULL,
  `college_address_one` varchar(100) NOT NULL,
  `college_address_two` varchar(100) NOT NULL,
  `college_city` varchar(50) NOT NULL,
  `college_state` varchar(50) NOT NULL,
  `college_zip_code` varchar(50) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `study_duration` varchar(100) NOT NULL,
  `current_semester` varchar(50) NOT NULL,
  `academic_year` varchar(100) NOT NULL,
  `join_date` varchar(50) NOT NULL,
  `transfer_option` varchar(100) NOT NULL,
  `bank_name` longtext NOT NULL,
  `branch_name` longtext NOT NULL,
  `ifsc_code` varchar(50) NOT NULL,
  `bank_account_no` varchar(50) NOT NULL,
  `dd_favouring` longtext NOT NULL,
  `due_date` varchar(50) NOT NULL,
  `payment_type` int(10) NOT NULL,
  `next_notification_date` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `college_details_tbl`
--

INSERT INTO `college_details_tbl` (`id`, `student_id`, `collegeofstudy`, `contact_person`, `contact_person_mobile`, `college_phone`, `college_email`, `college_address_one`, `college_address_two`, `college_city`, `college_state`, `college_zip_code`, `course_name`, `study_duration`, `current_semester`, `academic_year`, `join_date`, `transfer_option`, `bank_name`, `branch_name`, `ifsc_code`, `bank_account_no`, `dd_favouring`, `due_date`, `payment_type`, `next_notification_date`, `created_on`, `updated_on`) VALUES
(3, 43, 'dsgsd', 'dsgsd', '74543543', '6735335', 'col@mailinator.com', 'gfjgj', 'gjgfjfg', 'gfjffg', 'gjfgj', 'gfjfgj', 'gfjfgj', '3', '2', '2021-2023', '06-05-2021', '', '', '', '', '', '', '', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 44, 'gac', 'contact per', '47857485454', '74564545', 'col@mailinator.com', 'dgf', 'fgfg', 'gfgf', 'tn', 'fdhfdhfd', 'MCA', '3', '2', '2021-2023', '05-05-2021', '', '', '', '', '', '', '', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 48, 'fdgdfh', 'fdhfdh', '74654354', '5436543543', 'col@gmail.com', 'gfhfg', 'gjgj', 'gjgfj', 'gfjfgj', 'gfjfgjgf', 'bca', '3', '2', '2021-2023', '06-05-2021', '', '', '', '', '', '', '', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 49, 'gac', 'arasu', '74564785436', '85643785', 'col@gmail.com', 'c1', 'c2', 'c3', 'cs', 'cp', 'mba', '4', '3', '2021-2024', '05-05-2021', '', '', '', '', '', '', '', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 50, 'wal', 'fdgdfg', '47546547', '3532535', 'col@gmail.com', 'fdgdg', 'fdgdg', 'fdgdgdf', 'fdgdfg', 'fdgfdg', 'fdgfdg', '3', '2', '2021-2023', '07-05-2021', '', '', '', '', '', '', '', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 51, 'dgsdg', 'dgdgdg', '46646', '464646', 'col@gmail.com', 'dgdsg', 'dgdsg', 'ddsgs', 'dgsdg', 'dsgdsgg', 'dgdsg', '2', '2', '2021', '07-05-2021', '', '', '', '', '', '', '', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 52, 'fdgdfg', 'fgdfg', '46554', '546546', 'col@gmail.com', 'ffd', 'fdhfdh', 'fdhdf', 'fhfdhfd', 'fhfd', 'MCA', '3', '2', '2021-2023', '01-05-2021', '', '', '', '', '', '', '', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 53, 'stark', 'stark', '76546546', '654375345', 'col@gmail.com', 'a1', 'c2', 'cc', 'cs', 'cp', 'movie make', '3', '2', '2021-2023', '07-05-2021', 'DD', '', '', '', '', 'vinoth', '12-05-2021', 4, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 54, 'gac', '735436754', '7543245325', '4543543', 'col@gmail.com', 'col1', 'ghfh', 'gfhfgh', 'gfhfgh', 'gfhfg', 'MBA', '3', '3', '2021-2023', '06-05-2021', '', '', '', '', '', '', '', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 55, 'vote university', 'gfdg', '34345', '43534543', 'col@gmail.com', 'fghg', 'ghfh', 'gfhfg', 'gfhfg', 'gfhfg', 'mba', '4', '2', '2021-2023', '06-05-2021', 'DD', '', '', '', '', 'ramarajan', '', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 21, 'gjgg', 'gfjfgjgf', '546456', '546546', 'col@email.com', 'gfffh', 'gfhgh', 'ghfgh', 'gfhfg', 'gfhfgh', 'gfhfg', '3', '2', '2', '11-05-2021', 'RTGSORNEFT', 'test bank', 'test branch', 'abc123', '7645645354354354', '', '15-07-2021', 3, '30-10-2021', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 58, 'UG', 'Ram', '464564646', '46364364', 'col@email.com', 'c1', 'c2', 'cc', 'cs', 'abc123', 'MBA', '2', '1', '2021-2023', '15-04-2021', 'RTGSORNEFT', 'UCO', 'test Branch', 'abc123', '75437645365467734', '', '05-07-2021', 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `fees_tbl`
--

CREATE TABLE `fees_tbl` (
  `id` int(10) NOT NULL,
  `student_id` int(10) DEFAULT NULL,
  `fees_type` varchar(100) DEFAULT NULL,
  `fees_per_semester` float DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fees_tbl`
--

INSERT INTO `fees_tbl` (`id`, `student_id`, `fees_type`, `fees_per_semester`, `created_at`, `updated_at`) VALUES
(24, 4, 'semester', 3, '2021-02-03 14:01:05', '2021-02-03 14:01:05'),
(25, 4, 'hostel fees', 2.5, '2021-02-03 14:01:05', '2021-02-03 14:01:05'),
(29, 6, 'semester', 3.2, '2021-02-03 15:17:09', '2021-02-03 15:17:09'),
(30, 6, 'sports fees', 2.5, '2021-02-03 15:17:09', '2021-02-03 15:17:09'),
(31, 6, 'sports', 4, '2021-02-03 15:17:09', '2021-02-03 15:17:09'),
(39, 15, 'Semester Fees', 12000, '2021-04-13 18:45:09', '2021-04-13 18:45:09'),
(40, 15, 'hostel fees', 4000, '2021-04-13 18:45:09', '2021-04-13 18:45:09'),
(41, 15, 'mesh fees', 2000, '2021-04-13 18:45:09', '2021-04-13 18:45:09'),
(42, 14, 'Semester Fees', 12000, '2021-04-14 15:30:24', '2021-04-14 15:30:24'),
(43, 14, 'hostel fees', 6000, '2021-04-14 15:30:24', '2021-04-14 15:30:24'),
(44, 11, 'Semester Fees', 12000, '2021-04-14 18:22:48', '2021-04-14 18:22:48'),
(45, 11, 'hostel fees', 3500, '2021-04-14 18:22:48', '2021-04-14 18:22:48'),
(48, 25, 'Semester Fees', 22000, '2021-04-14 19:49:32', '2021-04-14 19:49:32'),
(49, 25, 'hostel fees', 12000, '2021-04-14 19:49:32', '2021-04-14 19:49:32'),
(50, 27, 'Semester Fees', 22000, '2021-04-19 10:20:34', '2021-04-19 10:20:34'),
(51, 27, 'Hostel Fees', 7500, '2021-04-19 10:20:34', '2021-04-19 10:20:34'),
(52, 27, 'Mesh Fees', 5000, '2021-04-19 10:20:34', '2021-04-19 10:20:34'),
(53, 29, 'Semester Fees', 12000, '2021-04-19 16:39:25', '2021-04-19 16:39:25'),
(54, 29, 'Hostel Fees', 7500, '2021-04-19 16:39:25', '2021-04-19 16:39:25'),
(55, 30, 'Semester Fees', 12000, '2021-05-06 14:27:09', '2021-05-06 14:27:09'),
(56, 30, 'Hostel Fees', 5500, '2021-05-06 14:27:09', '2021-05-06 14:27:09'),
(59, 43, 'Semester Fees', 12000, '2021-05-19 19:25:52', '2021-05-19 19:25:52'),
(60, 43, 'hostel', 11000, '2021-05-19 19:25:52', '2021-05-19 19:25:52'),
(63, 45, 'Semester Fees', 12000, '2021-05-20 11:45:12', '2021-05-20 11:45:12'),
(64, 45, 'Hostel', 7000, '2021-05-20 11:45:12', '2021-05-20 11:45:12'),
(65, 45, 'bus fees', 3500, '2021-05-20 11:45:12', '2021-05-20 11:45:12'),
(66, 46, 'Semester Fees', 12000, '2021-05-20 11:49:30', '2021-05-20 11:49:30'),
(67, 46, 'Hostel', 7000, '2021-05-20 11:49:30', '2021-05-20 11:49:30'),
(68, 46, 'bus fees', 3500, '2021-05-20 11:49:30', '2021-05-20 11:49:30'),
(72, 44, 'Semester Fees', 12000, '2021-05-20 12:18:31', '2021-05-20 12:18:31'),
(73, 44, 'Hostel', 7000, '2021-05-20 12:18:31', '2021-05-20 12:18:31'),
(74, 44, 'bus', 3500, '2021-05-20 12:18:31', '2021-05-20 12:18:31'),
(85, 48, 'Semester Fees', 12000, '2021-05-20 17:08:55', '2021-05-20 17:08:55'),
(86, 48, 'hostel', 7500, '2021-05-20 17:08:55', '2021-05-20 17:08:55'),
(87, 49, 'Semester Fees', 22000, '2021-05-20 18:46:49', '2021-05-20 18:46:49'),
(88, 49, 'Hostel fees', 7500, '2021-05-20 18:46:49', '2021-05-20 18:46:49'),
(89, 49, 'Bus fees', 5000, '2021-05-20 18:46:49', '2021-05-20 18:46:49'),
(91, 50, 'Semester Fees', 12000, '2021-05-20 20:25:26', '2021-05-20 20:25:26'),
(92, 50, 'hostel fees', 5000, '2021-05-20 20:25:26', '2021-05-20 20:25:26'),
(101, 51, 'Semester Fees', 22000, '2021-05-20 21:56:38', '2021-05-20 21:56:38'),
(102, 51, 'hostel fees', 12000, '2021-05-20 21:56:38', '2021-05-20 21:56:38'),
(103, 52, 'Semester Fees', 22000, '2021-05-20 22:07:31', '2021-05-20 22:07:31'),
(104, 52, 'Hostel fees', 7500, '2021-05-20 22:07:31', '2021-05-20 22:07:31'),
(109, 54, 'Semester Fees', 22000, '2021-05-21 19:37:47', '2021-05-21 19:37:47'),
(110, 54, 'Hostel fees', 7500, '2021-05-21 19:37:47', '2021-05-21 19:37:47'),
(127, 55, 'Semester Fees', 12000, '2021-05-22 15:06:50', '2021-05-22 15:06:50'),
(128, 55, 'hostel fees', 3500, '2021-05-22 15:06:50', '2021-05-22 15:06:50'),
(163, 21, 'Semester Fees', 11000, '2021-05-25 20:21:12', '2021-05-25 20:21:12'),
(164, 21, 'hostel fees', 2500, '2021-05-25 20:21:12', '2021-05-25 20:21:12'),
(165, 53, 'Semester Fees', 22000, '2021-05-25 21:20:00', '2021-05-25 21:20:00'),
(166, 53, 'hostel fees', 7500, '2021-05-25 21:20:00', '2021-05-25 21:20:00'),
(169, 58, 'Semester Fees', 22000, '2021-05-28 10:11:57', '2021-05-28 10:11:57'),
(170, 58, 'Hostel fees', 10000, '2021-05-28 10:11:57', '2021-05-28 10:11:57');

-- --------------------------------------------------------

--
-- Table structure for table `notification_tbl`
--

CREATE TABLE `notification_tbl` (
  `id` int(50) NOT NULL,
  `student_id` int(50) NOT NULL,
  `sponsor_id` int(50) NOT NULL,
  `notification_status` int(11) NOT NULL DEFAULT 1,
  `revel_status` int(10) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification_tbl`
--

INSERT INTO `notification_tbl` (`id`, `student_id`, `sponsor_id`, `notification_status`, `revel_status`, `created_on`, `updated_on`) VALUES
(13, 21, 56, 0, 1, '2021-05-27 17:37:58', '2021-05-27 17:37:58');

-- --------------------------------------------------------

--
-- Table structure for table `parent_tbl`
--

CREATE TABLE `parent_tbl` (
  `id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `fatherorguardian_name` varchar(100) NOT NULL,
  `parent_lastname` varchar(200) NOT NULL,
  `parent_age` varchar(100) NOT NULL,
  `parent_occupation` varchar(255) NOT NULL,
  `work_status` varchar(100) NOT NULL,
  `fatherorgardian_mobile` varchar(50) NOT NULL,
  `parent_address_one` varchar(255) NOT NULL,
  `parent_address_two` varchar(255) NOT NULL,
  `parent_city` varchar(50) NOT NULL,
  `parent_state` varchar(100) NOT NULL,
  `parent_zip_code` varchar(20) NOT NULL,
  `name_of_organizations` longtext NOT NULL,
  `organizations_address_one` varchar(50) NOT NULL,
  `organizations_address_two` varchar(50) NOT NULL,
  `organizations_city` varchar(50) NOT NULL,
  `organizations_state` varchar(50) NOT NULL,
  `organizations_pincode` varchar(50) NOT NULL,
  `contact_of_organizations` varchar(50) NOT NULL,
  `why_need_sponsorship` longtext NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parent_tbl`
--

INSERT INTO `parent_tbl` (`id`, `student_id`, `fatherorguardian_name`, `parent_lastname`, `parent_age`, `parent_occupation`, `work_status`, `fatherorgardian_mobile`, `parent_address_one`, `parent_address_two`, `parent_city`, `parent_state`, `parent_zip_code`, `name_of_organizations`, `organizations_address_one`, `organizations_address_two`, `organizations_city`, `organizations_state`, `organizations_pincode`, `contact_of_organizations`, `why_need_sponsorship`, `created_on`, `updated_on`) VALUES
(3, 43, 'fjhdfj', '', '', 'dgdsg', '', '635353', 'dgsdgsdg', 'dsgsdgsd', 'dgsd', 'dsgsdg', 'dsgsdgsdg', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 44, 'karl', '', '', 'work', '', '4657845454', 'a1', 'a2', 'fgf', 'fgfg', 'fgfdg', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 48, 'janarthan', 'R', '56', 'cooli', 'working', '7674867454', 'dgds', 'dsgsdg', 'dsgds', 'dsgsd', 'ddgdsgds', 'Suzuki', '11 road', 'wood company', 'Chennai', 'TN', '60028', '46436436436', 'test need sponsor', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 49, 'rajan', 'A', '45', 'cooli', 'retired', '97589375489', '51 cross', 'cbe', 'cbe', 'tn', 'a1b2c3', 'Pulsur', 'a1', 'a2', 'c', 's', 'p', '783463784', 'description of sponsorship', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 50, 'Odian', 'gdg', 'dsgds', 'dsgsdg', 'deceased', '43543543', 'dsgdg', 'dsgdsgdsg', 'dgdsg', 'dsgsdg', 'dgdsg', '', '', '', '', '', '', '', 'Sponsorships help your business increase its credibility, improve its public image, and build prestige. Like any form of marketing, it should be used strategically as a way to reach your target customers. As you build your marketing plan, research the events and causes that your ideal customers care about.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 51, 'dfhdh', 'dgds', '23', 'dgdsgsd', 'deceased', '4464', 'dgdg', 'dgdsg', 'dgdsg', 'dgdsg', 'dgdsg', '', '', '', '', '', '', '', 'dgsgsdgds', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 52, 'Tom', 'T', '35', 'fdgdg', 'retired', '74543545', 'a1', 'a2', 'fhfd', 'fhdfh', 'fhdfhf', 'fdfh', 'ds', 'dgdgds', 'dgsg', 'dgsdg', 'dgsgsd', '46634', 'Sponsorships help your business increase its credibility, improve its public image, and build prestige. Like any form of marketing, it should be used strategically as a way to reach your target customers. As you build your marketing plan, research the events and causes that your ideal customers care about.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 53, 'Jack', 'P', '45', 'director', 'working', '84574385435', 'a1', 'a2', 'fhdgdf', 'fdhfdh', 'fhfdd', 'steve', 'a1', 'a2', 'ghfg', 'gfhgfhfg', 'ghfhf', '748353', 'Sponsorships help your business increase its credibility, improve its public image, and build prestige. Like any form of marketing, it should be used strategically as a way to reach your target customers. As you build your marketing plan, research the events and causes that your ideal customers care about.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 54, 'Thiru', 'Y', '35', '', 'working', '76547854354', 'a1', 'a2', 'c', 's', 'z', 'sukil', 'dgsd', 'dgsg', 'dgsdgdsg', 'dgds', 'dgsdg', '864543543', 'Sponsorship is increasingly popular among businesses that want to grow fast and reach quality audiences. ... Sponsors offer funding or products and services to support events, trade shows, teams, nonprofits, or organizations. In exchange, you get business exposure and a chance to connect with new customers', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 55, 'Bratio', 'U', '55', '', 'working', '74564378543', 'a1', 'a2', 'gdg', 'dfgfgfd', '13113', 'yaki', 'a1', 'a2', 'dfg', 'fdgdfg', 'fdgfdgf', '7347545', 'Sponsorships help your business increase its credibility, improve its public image, and build prestige. Like any form of marketing, it should be used strategically as a way to reach your target customers. As you build your marketing plan, research the events and causes that your ideal customers care about.Sponsorships help your business increase its credibility, improve its public image, and build prestige. Like any form of marketing, it should be used strategically as a way to reach your target customers. As you build your marketing plan, research the events and causes that your ideal customers care about.Sponsorships help your business increase its credibility, improve its public image, and build prestige. Like any form of marketing, it should be used strategically as a way to reach your target customers. As you build your marketing plan, research the events and causes that your ideal customers care.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 21, 'gjh', '6', '6', 'null', 'deceased', '464654', '6', '6', '6', '6', '6', '', '', '', '', '', '', '', '6', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 58, 'Brito', 'R', '45', 'null', 'deceased', '756457845', 'a1', 'a2', 'city', 'state', '123abc', '', '', '', '', '', '', '', 'Sponsorships help your business increase its credibility, improve its public image, and build prestige. Like any form of marketing, it should be used strategically as a way to reach your target customers. As you build your marketing plan, research the events and causes that your ideal customers care about.', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sponsorship_pay_tbl`
--

CREATE TABLE `sponsorship_pay_tbl` (
  `id` int(20) NOT NULL,
  `student_id` int(20) NOT NULL,
  `sponsor_id` int(20) DEFAULT NULL,
  `pay_date` varchar(50) NOT NULL,
  `paid` float NOT NULL,
  `total_fees` float NOT NULL,
  `paid_status` int(10) NOT NULL,
  `notification_status` int(10) NOT NULL DEFAULT 1,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sponsorship_pay_tbl`
--

INSERT INTO `sponsorship_pay_tbl` (`id`, `student_id`, `sponsor_id`, `pay_date`, `paid`, `total_fees`, `paid_status`, `notification_status`, `created_on`, `updated_on`) VALUES
(1, 15, 20, '14-04-2021', 18000, 0, 0, 0, '2021-04-14 17:55:30', '2021-04-14 17:55:30'),
(2, 11, 17, '14-04-2021', 15500, 0, 0, 0, '2021-04-14 18:25:32', '2021-04-14 18:25:32'),
(3, 21, 22, '14-04-2021', 13500, 0, 0, 0, '2021-04-14 19:16:35', '2021-04-14 19:16:35'),
(4, 14, 20, '14-04-2021', 18000, 0, 0, 1, '2021-04-14 19:18:18', '2021-04-14 19:18:18'),
(5, 25, 26, '14-04-2021', 34000, 0, 0, 0, '2021-04-14 20:12:36', '2021-04-14 20:12:36'),
(7, 25, 26, '16-04-2021', 34000, 0, 0, 0, '2021-04-16 17:41:02', '2021-04-16 17:41:02'),
(8, 25, 26, '16-04-2021', 34000, 0, 0, 0, '2021-04-16 21:48:14', '2021-04-16 21:48:14'),
(9, 27, 22, '19-04-2021', 34500, 0, 0, 0, '2021-04-19 12:44:17', '2021-04-19 12:44:17'),
(10, 29, 17, '19-04-2021', 19500, 0, 0, 0, '2021-04-19 16:40:54', '2021-04-19 16:40:54'),
(11, 29, 17, '20-04-2021', 19500, 0, 0, 0, '2021-04-19 16:42:50', '2021-04-19 16:42:50'),
(12, 30, 32, '06-05-2021', 17500, 0, 0, 0, '2021-05-06 14:32:09', '2021-05-06 14:32:09'),
(14, 11, 17, '27-05-2021', 14000, 15500, 2, 0, '2021-05-27 15:50:19', '2021-05-27 15:50:19'),
(16, 54, 5, '28-05-2021', 20000, 29500, 2, 1, '2021-05-28 12:59:28', '2021-05-28 12:59:28'),
(17, 58, 5, '28-05-2021', 32000, 32000, 2, 0, '2021-05-28 20:22:31', '2021-05-28 20:22:31');

-- --------------------------------------------------------

--
-- Table structure for table `sponsors_tbl`
--

CREATE TABLE `sponsors_tbl` (
  `id` int(10) NOT NULL,
  `name` varchar(150) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sponsors_tbl`
--

INSERT INTO `sponsors_tbl` (`id`, `name`, `mobile`, `email`, `address`, `created_at`, `updated_at`) VALUES
(2, 'arun', '73673856353', 'arun@mailinator.com', 'uk', '2021-02-01 22:40:10', '2021-02-01 22:40:10'),
(3, 'tata', '37567385533', 'tata@mailinator.com', 'uk', '2021-02-01 22:58:36', '2021-02-01 22:58:36'),
(4, 'Tony', '48643654364', 'Tony@mailinator.com', 'uk', '2021-04-12 20:41:40', '2021-04-12 20:41:40');

-- --------------------------------------------------------

--
-- Table structure for table `sponsor_wallet_tbl`
--

CREATE TABLE `sponsor_wallet_tbl` (
  `id` int(10) NOT NULL,
  `sponsor_id` int(10) NOT NULL,
  `amount` float NOT NULL,
  `status` int(10) NOT NULL DEFAULT 2,
  `date` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sponsor_wallet_tbl`
--

INSERT INTO `sponsor_wallet_tbl` (`id`, `sponsor_id`, `amount`, `status`, `date`, `created_on`, `updated_on`) VALUES
(28, 56, 5000, 1, '27-05-2021', '2021-05-27 20:28:15', '2021-05-27 20:28:15'),
(29, 17, 15000, 1, '27-05-2021', '2021-05-27 20:53:19', '2021-05-27 20:53:19'),
(30, 59, 12500, 1, '28-05-2021', '2021-05-28 10:22:36', '2021-05-28 10:22:36'),
(31, 59, 5000, 1, '28-05-2021', '2021-05-28 10:23:56', '2021-05-28 10:23:56'),
(32, 59, 10000, 1, '28-05-2021', '2021-05-28 19:59:41', '2021-05-28 19:59:41'),
(33, 59, 4500, 1, '28-05-2021', '2021-05-28 20:19:34', '2021-05-28 20:19:34'),
(34, 56, 8500, 1, '29-05-2021', '2021-05-29 09:58:48', '2021-05-29 09:58:48');

-- --------------------------------------------------------

--
-- Table structure for table `studentsassigntosponsor_tbl`
--

CREATE TABLE `studentsassigntosponsor_tbl` (
  `id` int(20) NOT NULL,
  `student_id` int(20) DEFAULT NULL,
  `sponsor_id` int(20) DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studentsassigntosponsor_tbl`
--

INSERT INTO `studentsassigntosponsor_tbl` (`id`, `student_id`, `sponsor_id`, `created_on`, `updated_on`) VALUES
(7, 14, 20, '2021-04-14 15:28:47', '2021-04-14 15:28:47'),
(10, 25, 26, '2021-04-14 20:06:38', '2021-04-14 20:06:38'),
(14, 27, 9, '2021-04-19 12:37:50', '2021-04-19 12:37:50'),
(17, 11, 17, '2021-04-19 16:39:53', '2021-04-19 16:39:53'),
(18, 29, 17, '2021-04-19 16:39:53', '2021-04-19 16:39:53'),
(19, 30, 32, '2021-05-06 14:29:08', '2021-05-06 14:29:08'),
(25, 33, 20, '2021-05-18 14:28:24', '2021-05-18 14:28:24'),
(26, 33, 21, '2021-05-18 14:28:24', '2021-05-18 14:28:24'),
(27, 15, 26, '2021-05-18 16:41:00', '2021-05-18 16:41:00'),
(31, 21, 56, '2021-05-24 20:52:19', '2021-05-24 20:52:19'),
(32, 58, 59, '2021-05-28 10:16:28', '2021-05-28 10:16:28');

-- --------------------------------------------------------

--
-- Table structure for table `students_tbl`
--

CREATE TABLE `students_tbl` (
  `id` int(11) NOT NULL,
  `profile_image` varchar(100) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `fatherorguardian_name` varchar(50) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `dateofbirth` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `fatherorgardian_mobile` varchar(50) DEFAULT NULL,
  `address_one` varchar(50) NOT NULL,
  `address_two` varchar(50) NOT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `referred_by` longtext NOT NULL,
  `referred_contact` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `collegeofstudy` varchar(255) DEFAULT NULL,
  `contact_person` varchar(50) DEFAULT NULL,
  `contact_person_mobile` varchar(50) DEFAULT NULL,
  `college_phone` varchar(50) DEFAULT NULL,
  `college_email` varchar(100) DEFAULT NULL,
  `college_address_one` varchar(50) NOT NULL,
  `college_address_two` varchar(50) NOT NULL,
  `college_city` varchar(50) DEFAULT NULL,
  `college_state` varchar(50) DEFAULT NULL,
  `college_zip_code` varchar(20) DEFAULT NULL,
  `college_address` varchar(150) DEFAULT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `study_duration` varchar(100) DEFAULT NULL,
  `academic_year` varchar(50) DEFAULT NULL,
  `join_date` varchar(50) DEFAULT NULL,
  `yearly_fees` float DEFAULT NULL,
  `zip_code` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `role_type` int(10) DEFAULT NULL,
  `status` int(10) DEFAULT NULL,
  `approval` int(10) DEFAULT 0,
  `pending` int(10) NOT NULL DEFAULT 0,
  `reject` int(10) NOT NULL DEFAULT 0,
  `revel_sponsor_details` int(11) NOT NULL DEFAULT 0,
  `opening_bal` float NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students_tbl`
--

INSERT INTO `students_tbl` (`id`, `profile_image`, `name`, `last_name`, `fatherorguardian_name`, `gender`, `dateofbirth`, `mobile`, `fatherorgardian_mobile`, `address_one`, `address_two`, `city`, `state`, `referred_by`, `referred_contact`, `email`, `password`, `collegeofstudy`, `contact_person`, `contact_person_mobile`, `college_phone`, `college_email`, `college_address_one`, `college_address_two`, `college_city`, `college_state`, `college_zip_code`, `college_address`, `course_name`, `study_duration`, `academic_year`, `join_date`, `yearly_fees`, `zip_code`, `address`, `role_type`, `status`, `approval`, `pending`, `reject`, `revel_sponsor_details`, `opening_bal`, `created_at`, `updated_at`) VALUES
(5, NULL, 'Admin', '', NULL, NULL, NULL, '40764876496', NULL, '', '', NULL, NULL, '', '', 'Admin@mailinator.com', '$2y$10$.zFknD5s/bbL.OT5Xj2rsOGsjpIrFT.S2Em0QwGbdQZeNjqLA.v0G', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, '2021-02-02 17:42:57', '2021-02-02 17:42:57'),
(11, '140421070410-img-round2.jpg', 'Meri', 'Josh', 'Peter', 'female', '07-04-2009', '89374738653', '7356783654', 'a1', 'a2', 'uk', 'uk', '', '', 'Meri@mailinator.com', '$2y$10$LvyaYE3v345V6TfhxrdfjeXAh6g.28SI/P.jBcJdSqgvNFEEWg7Ay', 'anna university', 'jarge', '4643643', '464364', 'ake@email.com', 'a1', 'a2', 'cbe', 'tamilnadu', '1424', NULL, 'bsc', '3', '2019 - 2022', '14-03-2019', NULL, '123abc', NULL, 3, 1, 1, 0, 0, 0, 0, '2021-04-12 16:44:41', '2021-04-12 16:44:41'),
(14, '120421080440-img-round4.jpg', 'Brito', 'Mark', '', 'male', '', '', '', '', '', '', '', '', '', 'Brito@mailinator.com', '$2y$10$CX5ybMzfYnUpNJZhA8JIwukBN6v5e0Tb59IJ29GxfFrP9Nmi3lJ5W', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', NULL, '', NULL, 3, 1, 0, 1, 0, 0, 0, '2021-04-12 19:09:40', '2021-04-12 19:09:40'),
(15, '120421090440-card-img1.jpg', 'Jally', 'Jor', '', '', '', '', '', '', '', '', '', '', '', 'Jally@mailinator.com', '$2y$10$J6ChRGtbK7.7XrYqETWMIO9tQnor4YqZTSTyBvj9pblFcxgWD3H1m', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', NULL, '', NULL, 3, 1, 1, 0, 0, 0, 0, '2021-04-12 19:36:09', '2021-04-12 19:36:09'),
(17, '130421020401-card-img3.jpg', 'Candy', 'Brush', NULL, NULL, NULL, '0123456789', NULL, 'a1', 'a2', 'uk', 'tamil nadu', '', '', 'Candybru@mailinator.com', '$2y$10$pFAqN7DyHbZtc7AIOXLPQOfUwuKX6zb1YsHlvbrY9zOESjeXH3gSu', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '123abc', NULL, 2, 1, 0, 0, 0, 0, 15000, '2021-04-13 12:51:01', '2021-04-13 12:51:01'),
(20, '140421010426-card-img2.jpg', 'Mario', 'Lark', NULL, NULL, NULL, '76353754343', NULL, 'a1', 'a2', 'a3', 'test', '', '', 'Mario@mailinator.com', '$2y$10$wZxZUw/IBz6bxxOzzjwgHO6spWJ8cQqc9yKGTLewkvCTg14BBEdlC', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '123456', NULL, 2, 1, 0, 0, 0, 0, 0, '2021-04-14 11:58:26', '2021-04-14 11:58:26'),
(21, '140421080455-img-round1.jpg', 'Studen 1', 'L', 'null', 'male', '09-05-1984', '54765756767', '', 'a1', 'a2', 'fhfd', 'fhfd', 'fhfd', 'dfhdfh', 'student1@mailinator.com', '$2y$10$d/LhJ9iEma/cP5QXtlO4Cu/c0z5mEXtKkjPfqa5lr8V9N4y0Ofjsa', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', NULL, 'fhdfhfdfhdf', NULL, 3, 1, 1, 0, 0, 1, 0, '2021-04-14 18:55:40', '2021-04-14 18:55:40'),
(25, '140421090426-img-round1.jpg', 'Aarav', 'Raj', 'Father', 'male', '', '84789467486', '47564786584', 'a1', 'a2', 'cbe', 'TN', '', '', 'Aarav@mailinator.com', '$2y$10$efC2Lp0yEeCi2HdHijh2cOMXl27mmzuKFntaUbJauYGxAx/jRXMMq', 'test', 'test', '746575454', '5454545', 'clg@mailinator.com', 'a1', 'c2', 'dg', 'gs', '1wrer', NULL, 'MCA', '3', '2019 - 2022', '19-04-2019', NULL, '25sere', NULL, 3, 1, 0, 0, 0, 0, 0, '2021-04-14 19:45:41', '2021-04-14 19:45:41'),
(26, '140421090438-img-round3.jpg', 'BMW', 'Tor', NULL, NULL, NULL, '375657545', NULL, 'a1', 'a2', 'test', 'fhfg', '', '', 'bmwsponsor@mailinator.com', '$2y$10$Ja7THs.S2ezOBldKpSXMTORKItWqigL.MQXAQNYZJSFp2pK3uR/e.', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'gfhgf', NULL, 2, 1, 0, 0, 0, 0, 0, '2021-04-14 20:06:38', '2021-04-14 20:06:38'),
(27, '180421110453-card-img2.jpg', 'Student', 'Park', 'Tor', 'male', '28-03-1984', '83678367385', '04754747547', 'a1', 'a2', 'city', 'TN', '', '', 'student123@mailinator.com', '$2y$10$3uKutgyzeQXK2DuFrbq.7.OwKSP9RN7ApKpQYh/4FgC9QHlWdjcbu', 'Bharathiar university', 'Ram', '09486476746', '044737373', 'bh@email.com', 'c1', 'c2', 'city 1', 'TN', '641305', NULL, 'MCA', '2', '2020-2022', '04-03-2020', NULL, 'abc123', NULL, 3, 1, 1, 0, 0, 0, 0, '2021-04-19 10:11:45', '2021-04-19 10:11:45'),
(29, '190421060410-card-img3.jpg', 'Yark', 'Pove', 'null', 'male', '', '', '', '', '', '', '', '', '', 'yark@mailinator.com', '$2y$10$jPjJ0awLdkpCQOPPcQMvdekTS5YgUkk3JYB1/jH6AMtf8Rrw3aS6W', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', NULL, '', NULL, 3, 1, 1, 0, 0, 0, 0, '2021-04-19 16:25:45', '2021-04-19 16:25:45'),
(30, '060521030532-mikel.jpg', 'john', 'wick', 'guard', 'male', '09-05-1984', '48564785467', '47564754541', 'a1', 'a2', 'city', 'uk', '', '', 'johnwick@mailinator.com', '$2y$10$cWJrEHvbOp.I9988OXeIwOxYF9Bf2i1155zEUxnHWjM3t7mWMSaFK', 'null', 'null', 'null', 'null', 'null', 'null', 'null', 'null', 'null', 'null', NULL, 'null', 'null', 'null', '', NULL, 'dgd545', NULL, 3, 1, 1, 0, 0, 0, 0, '2021-05-06 14:09:25', '2021-05-06 14:09:25'),
(32, '060521030508-1516762412301.jpg', 'Tom', 'Peter', NULL, NULL, NULL, '7346573535', NULL, 'a1', 'a2', 'test', 'uk', '', '', 'tompeter@mailinator.com', '$2y$10$daWRLA4WLPu.ZHBolNhTbuZebWvWbRSReRnQWJSpGWN8Kw0YyIJpu', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '123abc', NULL, 2, 1, 0, 0, 0, 0, 0, '2021-05-06 14:29:08', '2021-05-06 14:29:08'),
(33, NULL, 'sweep', '', NULL, NULL, NULL, '83574756454', NULL, '', '', NULL, NULL, '', '', 'sweep@mailinator.com', '$2y$10$WdzHzrIbKGAIFFCGdBpcqOT4R0knGc6H0M4BxvzEpIqqV0Wzjfbm.', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, 0, 0, 0, 0, '2021-05-17 13:17:44', '2021-05-17 13:17:44'),
(34, NULL, 'Powel', '', NULL, NULL, NULL, '47548754545', NULL, '', '', NULL, NULL, '', '', 'powel@mailinator.com', '$2y$10$rhy2heknuE2wchwKOghFKuVM3hhexF8n5WS9sUG5UmK8wcbJv/Jra', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, 0, 0, 0, 0, '2021-05-18 09:40:33', '2021-05-18 09:40:33'),
(35, NULL, 'Faren', '', NULL, NULL, NULL, '84546543543', NULL, '', '', NULL, NULL, '', '', 'Faren@mailinator.com', '$2y$10$CiZVDvNlw0F93HBBgBxLfue0tzvZIHaHBLI0AeSpGb6W0A2aYOw4a', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, 0, 0, 0, 0, '2021-05-18 18:50:59', '2021-05-18 18:50:59'),
(36, NULL, 'Mark Rober', '', NULL, NULL, NULL, '73658475454', NULL, '', '', NULL, NULL, '', '', 'Markrober@mailinator.com', '$2y$10$UVh5xYMyaHQ/rWtX7cdotOwWa6mNkVdqSIaY.z.jEB1.AamP/YKkK', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, 1, 0, 0, 0, 0, '2021-05-18 20:15:57', '2021-05-18 20:15:57'),
(43, '190521080551-findfont.png', 'sukesh', 'N', NULL, 'male', '08-01-2009', '7465436434', NULL, 'fhfh', 'fhfdhf', 'fdhdfh', 'fdhdfh', 'dfhdf', 'fdhdfh', 'sukesh@mailinator.com', NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fdhdfhdf', NULL, 3, 1, 0, 0, 0, 0, 0, '2021-05-19 19:25:52', '2021-05-19 19:25:52'),
(44, '200521010530-tesst.png', 'robert', 'peter', NULL, 'male', '28-04-2009', '87443646464', NULL, 'a1', 'a2', 'city', 'tn', 'ref', '746547545454', 'robertjohn@mailinator.com', NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tre', NULL, 3, 1, 0, 0, 0, 0, 0, '2021-05-19 22:32:29', '2021-05-19 22:32:29'),
(47, '200521060512-tesst.png', 'yamun', 'yar', NULL, 'male', '29-04-2009', '7653785454', NULL, 'fhfdh', 'fdhdfh', 'fdhdf', 'fdhdfh', 'umer', '746784356454354', 'yamun@mailinator.com', NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dfdfhfh', NULL, 3, 1, 0, 0, 0, 0, 0, '2021-05-20 16:43:12', '2021-05-20 16:43:12'),
(48, '200521060530-tesst.png', 'umer', 'powel', NULL, 'male', '06-05-2009', '735783563', NULL, 'hfdhf', 'fhfd', 'fdhdf', 'fdhfdh', 'yark', '8465473564', 'umer@mailinator.com', NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fdhdfh', NULL, 3, 1, 0, 0, 0, 0, 0, '2021-05-20 16:50:30', '2021-05-20 16:50:30'),
(49, '200521060518-img-round3.jpg', 'Guru park', 'R', NULL, 'male', '14-05-1995', '7564785435', NULL, '10 cross', 'cbe', 'cbe', 'TN', 'thams', '7343', 'guru@mailinator.com', '$2y$10$qe9w9h/.0tkq0Q0Bz.6TH.lftGn0YtS751WXEMKHPHMmwL9gwYapi', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'a1', NULL, 3, 1, 0, 0, 0, 0, 0, '2021-05-20 17:02:18', '2021-05-20 17:02:18'),
(50, '200521090529-card-img1.jpg', 'thor Thun', 'y', NULL, 'male', '01-05-1985', '4645654', NULL, 'a1', 'a2', 'fdhd', 'fhfdh', 'rat', '3534543', 'thor@mailinator.com', '$2y$10$zVcaP9YORQ/vjAZdIG3U9extT2p0jLuLQ6f9/wbXMdD7bOPvdwgqK', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fdhfdh', NULL, 3, 1, 0, 0, 0, 0, 0, '2021-05-20 20:23:29', '2021-05-20 20:23:29'),
(51, '200521100500-card-img3.jpg', 'paru', 'R', NULL, 'male', '09-05-1986', '84754893564', NULL, 'dgh', 'dggdg', 'dgg', 'dggdg', 'dggdg', '748545454', 'paru@mailinator.com', '$2y$10$xBnC.adxSLJO.ibiUZVYKeyPUlXPfYKq02nT9IADq/vY05OAxTjs.', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'gdgdg', NULL, 3, 1, 0, 0, 0, 0, 0, '2021-05-20 20:56:22', '2021-05-20 20:56:22'),
(52, '200521110530-card-img2.jpg', 'Powel Hack', 'T', NULL, 'male', '09-05-1985', '74564375647', NULL, 'fdh', 'fhfdhd', 'fhddh', 'fhdh', 'fhhf', '4764634', 'Powelhack@mailinator.com', '$2y$10$Tss/vDe0zYh.IFnD1UIK0eUvgVOcWVbrU0oSXrYC.pR5PdWz23tJO', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fhdh', NULL, 3, 1, 0, 0, 0, 0, 0, '2021-05-20 22:01:34', '2021-05-20 22:01:34'),
(53, '200521110554-card-img2.jpg', 'Olive', 'U', NULL, 'male', '09-05-1990', '78565465465', NULL, 'pa', 'pa2', 'pc', 'ps', 'stark', '894543875438543', 'Olive@mailinator.com', '$2y$10$CJ.oXFjKw/z.B65pjuzs7u9hsvtImq/9bDLzbOScFZ.j0IZrd5Oh6', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pz', NULL, 3, 1, 0, 0, 0, 0, 0, '2021-05-21 09:30:59', '2021-05-21 09:30:59'),
(54, '210521090546-img-round3.jpg', 'Manoj', 'T', NULL, 'male', '10-05-1990', '746553', NULL, 'sa', 'sa2', 'sc', 'tn', 'agil', '7465843754353', 'manoj@mailinator.com', NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'a1b2c3', NULL, 3, 1, 0, 0, 0, 0, 0, '2021-05-21 19:37:46', '2021-05-21 19:37:46'),
(55, '220521030553-img-round2.jpg', 'jasio', 'Y', NULL, 'female', '09-05-1990', '7456475435', NULL, 'a1', 'a2', 'dgfgf', 'fgdf', 'git', '736537854', 'jasio@mailinator.com', '$2y$10$jqjjqrLT3srvf228E/2qiu8J.5R8yNXbCRs6Nen09mVe/9Vo5sxk.', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fdhfd', NULL, 3, 1, 0, 0, 0, 0, 0, '2021-05-22 13:52:53', '2021-05-22 13:52:53'),
(56, '240521100519-img-round4.jpg', 'Sponsor 1', 'S', NULL, NULL, NULL, '74563545', NULL, 'a1', 'a1', 'gfjfg', 'gjgf', '', '', 'sponsor1@mailinator.com', '$2y$10$mzQDz/HCt7EC2R/qxBhGTe9yJq5z.pLCsUveJHYMsTEkXmzLrhoNa', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'gjgf', NULL, 2, 1, 0, 0, 0, 0, 5000, '2021-05-24 20:52:19', '2021-05-24 20:52:19'),
(57, NULL, 'Manager', '', NULL, NULL, NULL, '76438543534', NULL, '', '', NULL, NULL, '', '', 'Manager@mailinator.com', '$2y$10$nhdSJlLyqhsjmVFu6gTho.zPoZWQ6rXI5kB8mFdJ2uWJMOQjbzMaq', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 1, 0, 0, 0, 0, 0, '2021-05-25 17:06:17', '2021-05-25 17:06:17'),
(58, '270521110534-avatar-5.jpg', 'Anglo', 'B', NULL, 'male', '10-05-1990', '74544354354', NULL, 'a1', 'a2', 'city', 'state', 'sam', '4354364646', 'Anglo@mailinator.com', '$2y$10$F6Wb9DLmzijBiON/RZ4SIepO4un0SLQJP8slkBieQ1srqclL3fzha', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'abc123', NULL, 3, 1, 1, 0, 0, 0, 0, '2021-05-28 09:59:29', '2021-05-28 09:59:29'),
(59, '270521110527-avatar-4.jpg', 'Gloose', 'T', NULL, NULL, NULL, '74564378564', NULL, 'a1', 'a2', 'ac', 'tn', '', '', 'Gloose@mailinator.com', '$2y$10$wkgk7oHU4m1.eWuvDY8kcuVC3.plZWPSX9ltOMMMvt8PVZuH/buTu', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '123abc', NULL, 2, 1, 0, 0, 0, 0, 5000, '2021-05-28 10:16:27', '2021-05-28 10:16:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `town` varchar(30) DEFAULT NULL,
  `postcode` varchar(20) DEFAULT NULL,
  `status` int(10) DEFAULT 0,
  `role_type` int(10) DEFAULT NULL,
  `uniid` varchar(32) DEFAULT NULL,
  `activation_date` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `mobile`, `address`, `town`, `postcode`, `status`, `role_type`, `uniid`, `activation_date`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Admin@mailinator.com', '$2y$10$YT3AvqOq2KejP6Tzjx3ru.YZ8hea1/Z/I15HU/El2TARJl970aTQW', NULL, NULL, NULL, NULL, 0, 1, NULL, '2021-01-11 19:23:52', '2021-01-11 19:23:52', '2021-01-11 19:23:52');

-- --------------------------------------------------------

--
-- Table structure for table `user_role_type`
--

CREATE TABLE `user_role_type` (
  `id` int(10) NOT NULL,
  `role` varchar(100) NOT NULL,
  `role_type` int(10) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role_type`
--

INSERT INTO `user_role_type` (`id`, `role`, `role_type`, `created_on`, `updated_on`) VALUES
(1, 'Admin', 1, '2021-05-25 17:03:02', '2021-05-25 17:03:02'),
(2, 'sponsor', 2, '2021-05-25 17:03:02', '2021-05-25 17:03:02'),
(3, 'student', 3, '2021-05-25 17:03:33', '2021-05-25 17:03:33'),
(4, 'manager', 4, '2021-05-25 17:03:33', '2021-05-25 17:03:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_deatils_tbl`
--
ALTER TABLE `bank_deatils_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `college_details_tbl`
--
ALTER TABLE `college_details_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees_tbl`
--
ALTER TABLE `fees_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_tbl`
--
ALTER TABLE `notification_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parent_tbl`
--
ALTER TABLE `parent_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sponsorship_pay_tbl`
--
ALTER TABLE `sponsorship_pay_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sponsors_tbl`
--
ALTER TABLE `sponsors_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sponsor_wallet_tbl`
--
ALTER TABLE `sponsor_wallet_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentsassigntosponsor_tbl`
--
ALTER TABLE `studentsassigntosponsor_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_tbl`
--
ALTER TABLE `students_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role_type`
--
ALTER TABLE `user_role_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_deatils_tbl`
--
ALTER TABLE `bank_deatils_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `college_details_tbl`
--
ALTER TABLE `college_details_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `fees_tbl`
--
ALTER TABLE `fees_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `notification_tbl`
--
ALTER TABLE `notification_tbl`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `parent_tbl`
--
ALTER TABLE `parent_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sponsorship_pay_tbl`
--
ALTER TABLE `sponsorship_pay_tbl`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sponsors_tbl`
--
ALTER TABLE `sponsors_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sponsor_wallet_tbl`
--
ALTER TABLE `sponsor_wallet_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `studentsassigntosponsor_tbl`
--
ALTER TABLE `studentsassigntosponsor_tbl`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `students_tbl`
--
ALTER TABLE `students_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_role_type`
--
ALTER TABLE `user_role_type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
