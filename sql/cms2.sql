-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2022 at 03:18 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `age_group`
--

CREATE TABLE `age_group` (
  `age_group_id` int(11) NOT NULL,
  `age_from` int(2) DEFAULT NULL,
  `age_to` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `age_group`
--

INSERT INTO `age_group` (`age_group_id`, `age_from`, `age_to`) VALUES
(3, 0, 18),
(4, 18, 25),
(5, 26, 35),
(8, 55, 60);

-- --------------------------------------------------------

--
-- Table structure for table `bed_requests`
--

CREATE TABLE `bed_requests` (
  `patient_id` int(11) NOT NULL,
  `request_date` date NOT NULL,
  `patient_status` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `hospital_id` int(11) NOT NULL,
  `ward_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bed_requests`
--

INSERT INTO `bed_requests` (`patient_id`, `request_date`, `patient_status`, `user_id`, `member_id`, `hospital_id`, `ward_id`) VALUES
(1, '2022-03-25', 'pending', 2, NULL, 38, 1),
(2, '2022-03-31', 'accepted', 6, NULL, 40, 7);

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `district_id` int(11) NOT NULL,
  `district_name` text NOT NULL,
  `state_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`district_id`, `district_name`, `state_id`) VALUES
(1, 'Ahmedabad', 1),
(2, 'Vadodara', 1),
(3, 'Anand', 1),
(4, 'Mumbai', 2),
(7, 'Pali', 4),
(10, 'Pune', 2),
(11, 'Dahod', 1),
(12, 'Kheda', 1),
(13, 'Mahisagar', 1),
(15, 'Gandhinagar', 1),
(16, 'Nagpur', 2),
(17, 'Thane', 2),
(18, 'Ajmer', 4),
(19, 'Alwar', 4),
(20, 'Udaipur', 4),
(21, 'Jaipur', 4);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_details`
--

CREATE TABLE `doctor_details` (
  `doctor_id` int(11) NOT NULL,
  `doctor_name` varchar(50) NOT NULL,
  `doctor_description` text NOT NULL,
  `hospital_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor_details`
--

INSERT INTO `doctor_details` (`doctor_id`, `doctor_name`, `doctor_description`, `hospital_id`) VALUES
(7, 'I am pote', 'Specialist', 38),
(8, 'Arun Dave', 'Multi-specialist', 38),
(9, 'Anil Maheta', 'Semi Specialist', 38),
(10, 'Anil Maheta', 'Multi-specialist', 39),
(11, 'Samira Dave', 'Cancer Specialist', 39),
(12, 'Arun Dave', 'Specialist', 40),
(13, 'Anil Maheta', 'Multi-specialist', 40),
(14, 'Tarak Maheta', 'Specialist', 40),
(16, 'Arun Maheta', 'Multi-specialist', 41),
(17, 'Anil Dave', 'Medicine Specialists', 41),
(18, 'Ramesh Kumar', 'Dermatologists', 41);

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `hospital_id` int(11) NOT NULL,
  `hospital_username` varchar(50) NOT NULL,
  `hospital_password` varchar(50) NOT NULL,
  `hospital_name` text NOT NULL,
  `hospital_address` text NOT NULL,
  `contact_no` bigint(10) NOT NULL,
  `hospital_pincode` int(6) NOT NULL,
  `hospital_status` varchar(10) NOT NULL,
  `hospital_accepting_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`hospital_id`, `hospital_username`, `hospital_password`, `hospital_name`, `hospital_address`, `contact_no`, `hospital_pincode`, `hospital_status`, `hospital_accepting_status`) VALUES
(5, 'longlife123', '1234', 'Long Life Hospital', '3rd Floor, Ambika Complex, Paldi Char Rasta, Paldi Rd, Paldi, Ahmedabad, Gujarat', 7926587736, 380007, 'open', 'accepted'),
(6, 'sushrut123', '1234', 'Sushrut Hospital', 'Mahalaxmi, Mahalaxmi Five Rd, Fatehpura, Ramvihar Society, Paldi, Ahmedabad, Gujarat', 7926605052, 380007, 'open', 'accepted'),
(7, 'shraddha123', '1234', 'Shraddha Children Hospital', 'Bhairavnath - Isanpur Road, Society, opp. Bhagwannagar Society, Govindwadi, Isanpur, Ahmedabad, Gujarat', 7929095853, 382443, 'open', 'accepted'),
(8, 'sterling123', '1234', 'Sterling Hospital Vadodara', 'Circle West, Race Course Road Opposite Inox Cinema, Hari Nagar, Vadodara, Gujarat', 2656144111, 390007, 'open', 'accepted'),
(9, 'baroda123', '1234', 'Baroda Laparoscopy Hospital', '60, Sampat Rao Colony, Near Circuit House, Alkapuri, Vadodara, Gujarat', 2652324128, 390007, 'open', 'accepted'),
(10, 'ram1234', '1234', 'Shri Ram Hospital', 'Opp. Bangar college Main Gate, College Rd, Vasant Vihar, Pali, Rajasthan', 2932222100, 306401, 'open', 'accepted'),
(11, 'chc123', '1234', 'CHC Desuri (Government Hospital)', ' 7HG8+2PJ, Desuri, Rajasthan', 8880576811, 306502, 'open', 'accepted'),
(38, 'hbd', '1234', 'HBD', 'address', 1234567890, 382443, 'open', 'accepted'),
(39, 'shortlife', '1234', 'ShortLife Hospital', '2H9C+VMG, Ellisbridge, Ahmedabad, Gujarat', 1020305040, 382443, 'open', 'accepted'),
(40, 'hospital123', '1234', 'Jalandar Hospital', 'Ramwadi-Anandwadi Rd, Jay Krishna Society, Isanpur, Ahmedabad, Gujarat', 1234567890, 382440, 'open', 'accepted'),
(41, 'safal123', '1234', 'Safal Hospital', 'Sardar Complex, Govindwadi, Isanpur, Ahmedabad, Gujarat 382443 ', 9104402108, 382443, 'open', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `laboratories`
--

CREATE TABLE `laboratories` (
  `lab_id` int(11) NOT NULL,
  `lab_username` varchar(50) NOT NULL,
  `lab_password` varchar(50) NOT NULL,
  `lab_name` text NOT NULL,
  `lab_address` text NOT NULL,
  `contact_no` bigint(10) NOT NULL,
  `lab_pincode` int(6) NOT NULL,
  `lab_status` varchar(10) NOT NULL,
  `lab_accepting_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laboratories`
--

INSERT INTO `laboratories` (`lab_id`, `lab_username`, `lab_password`, `lab_name`, `lab_address`, `contact_no`, `lab_pincode`, `lab_status`, `lab_accepting_status`) VALUES
(4, 'shilp123', '1234', 'Shilp Pathology Laboratory', 'A-103, Radhekishan villa, 132 ft ring road, near Jaymala, Isanpur, Ahmedabad, Gujarat', 7925381621, 382443, 'open', 'accepted'),
(5, 'vir123', '1234', 'VIR Pathology Laboratory', '6, P.H. Jain Nagar, New Sharda Mandir Rd, near Sanjivani Hospital, Paldi, Ahmedabad, Gujarat', 7926601672, 380007, 'open', 'accepted'),
(6, 'maa123', '1234', 'Maa Diagnostic Center', ' 159, Veer Durga Das Nagar, Pali, Rajasthan', 9414122016, 306401, 'open', 'accepted'),
(7, 'Qline123', '1234', 'Qline Diagnostics - Pathology Laboratory', 'B - 203, Shivalik Yash Complex, Near Shashtri nagar BRTS Stand, 132 Feet Ring Rd, Naranpura, Ahmedabad, Gujarat', 7948979042, 382443, 'open', 'accepted'),
(10, 'lab123', '1234', 'Jalandar Lab', 'Ramwadi-Anandwadi Rd, Jay Krishna Society, Isanpur, Ahmedabad, Gujarat', 1234567890, 380050, 'open', 'accepted'),
(11, 'mahi123', '1234', 'Mahi Laboratory', ' Geban Shah Pir, New Vatva Rd, Paras Nagar, Isanpur, Ahmedabad, Gujarat', 9723768424, 382443, 'open', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `labs_testings`
--

CREATE TABLE `labs_testings` (
  `LT_id` int(11) NOT NULL,
  `testing_name` varchar(20) NOT NULL,
  `testing_price` int(4) NOT NULL,
  `lab_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `labs_testings`
--

INSERT INTO `labs_testings` (`LT_id`, `testing_name`, `testing_price`, `lab_id`) VALUES
(3, 'RT/PCR Testing', 800, 10),
(4, 'Blood Count Test', 300, 10),
(5, 'Urine Test', 150, 10),
(7, 'Blood Count Testing', 150, 11),
(8, 'Urine Testing', 100, 11),
(9, 'RT/PCR Testing', 800, 11);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `member_name` text NOT NULL,
  `member_aadhar_no` bigint(12) NOT NULL,
  `member_dob` date NOT NULL,
  `member_gender` tinytext NOT NULL,
  `member_blood_group` varchar(3) NOT NULL,
  `aadhar_document_name` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pincode`
--

CREATE TABLE `pincode` (
  `pincode` int(6) NOT NULL,
  `area_name` text NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pincode`
--

INSERT INTO `pincode` (`pincode`, `area_name`, `district_id`) VALUES
(306502, 'Desuri', 7),
(380007, 'Anandnagar ', 1),
(380050, 'Ghodasar', 1),
(382440, 'Vatva', 1),
(382443, 'Isanpur', 1),
(390007, 'Alkapuri', 2);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `state_id` int(11) NOT NULL,
  `state_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `state_name`) VALUES
(1, 'Gujarat'),
(2, 'Maharashtra'),
(4, 'Rajasthan'),
(12, 'Madhya Pradesh'),
(13, 'Andhra Pradesh'),
(14, 'Arunachal Pradesh'),
(16, 'Bihar');

-- --------------------------------------------------------

--
-- Table structure for table `testing_list`
--

CREATE TABLE `testing_list` (
  `testing_list_id` int(11) NOT NULL,
  `testing_id` int(11) NOT NULL,
  `LT_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `testing_list`
--

INSERT INTO `testing_list` (`testing_list_id`, `testing_id`, `LT_id`) VALUES
(1, 1, 3),
(2, 1, 4),
(3, 2, 3),
(4, 2, 4),
(5, 2, 5),
(6, 5, 7),
(7, 5, 8);

-- --------------------------------------------------------

--
-- Table structure for table `testing_requests`
--

CREATE TABLE `testing_requests` (
  `testing_id` int(11) NOT NULL,
  `testing_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `lab_id` int(11) NOT NULL,
  `testing_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `testing_requests`
--

INSERT INTO `testing_requests` (`testing_id`, `testing_date`, `user_id`, `member_id`, `lab_id`, `testing_status`) VALUES
(1, '2022-03-27', 2, NULL, 10, 'accepted'),
(2, '2022-03-15', 2, NULL, 10, 'pending'),
(5, '2022-03-29', 6, NULL, 11, 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `time_slot`
--

CREATE TABLE `time_slot` (
  `time_slot_id` int(11) NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `time_slot`
--

INSERT INTO `time_slot` (`time_slot_id`, `time_from`, `time_to`) VALUES
(5, '09:00:00', '11:00:00'),
(6, '11:00:00', '13:00:00'),
(7, '13:00:00', '15:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `password` varchar(25) NOT NULL,
  `user_name` text NOT NULL,
  `user_aadhar_no` bigint(12) NOT NULL,
  `mobile_no` bigint(10) NOT NULL,
  `user_email` text NOT NULL,
  `user_dob` date NOT NULL,
  `user_gender` tinytext NOT NULL,
  `user_blood_group` varchar(3) NOT NULL,
  `aadhar_document_name` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `password`, `user_name`, `user_aadhar_no`, `mobile_no`, `user_email`, `user_dob`, `user_gender`, `user_blood_group`, `aadhar_document_name`) VALUES
(2, '1234', 'Prajapati Manish Ratilal', 123443215678, 4554554545, 'manish6@gmail.com', '2002-07-13', 'Male', 'B+', '329065.jpg'),
(3, '1234', 'Aniket Patel', 123456789123, 123456789012, 'aniket@gmail.com', '2003-12-02', 'Male', 'AB+', NULL),
(6, '1234', 'Rahul Dave', 987698769876, 9876987676, 'rahuldave123@gmail.com', '2003-12-31', 'Male', 'AB+', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vaccination_centres`
--

CREATE TABLE `vaccination_centres` (
  `vc_id` int(11) NOT NULL,
  `vc_username` varchar(25) NOT NULL,
  `vc_password` varchar(25) NOT NULL,
  `vc_name` text NOT NULL,
  `vc_address` text NOT NULL,
  `vc_cost_type` tinytext NOT NULL,
  `vc_pincode` int(6) NOT NULL,
  `vc_status` varchar(10) NOT NULL,
  `vc_accepting_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vaccination_centres`
--

INSERT INTO `vaccination_centres` (`vc_id`, `vc_username`, `vc_password`, `vc_name`, `vc_address`, `vc_cost_type`, `vc_pincode`, `vc_status`, `vc_accepting_status`) VALUES
(14, 'ghodasar123', '1234', 'UHC GHODASAR', 'Ramwadi-Anandwadi Rd, Jay Krishna Society, Isanpur, Ahmedabad, Gujarat', 'free', 380050, 'open', 'accepted'),
(15, 'isanpuruhc123', '1234', 'Urban Health Center Isanpur', 'br 5 BR-5, Vishalnagar, Isanpur, Ahmedabad, Gujarat', 'free', 382443, 'open', 'accepted'),
(16, 'vatvauhc123', '1234', 'VATVA URBAN HEALTH CENTER', '  XJC6+R8V, Vatva, Ahmedabad, Gujarat', 'free', 382440, 'open', 'accepted'),
(17, 'svp123', '1234', 'SVP Hospital', ' 2H9C+VMG, Ellisbridge, Ahmedabad, Gujarat', 'paid', 380007, 'open', 'accepted'),
(19, 'vraj123', '1234', 'Vraj Vaccination Centre', 'Vijay Estate, 5, Lal Bahadur Shastri Rd, Anupam Colony, Bapunagar, Ahmedabad, Gujarat', 'free', 380050, 'open', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `vaccination_requests`
--

CREATE TABLE `vaccination_requests` (
  `vaccination_id` int(11) NOT NULL,
  `vaccination_date` date NOT NULL,
  `dose_no` int(2) NOT NULL,
  `vaccination_status` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `vc_id` int(11) NOT NULL,
  `vaccine_type` int(11) NOT NULL,
  `time_slot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vaccination_requests`
--

INSERT INTO `vaccination_requests` (`vaccination_id`, `vaccination_date`, `dose_no`, `vaccination_status`, `user_id`, `member_id`, `vc_id`, `vaccine_type`, `time_slot`) VALUES
(8, '2022-03-29', 1, 'accepted', 3, 0, 17, 7, 5),
(13, '2022-03-29', 1, 'accepted', 6, 0, 19, 6, 6),
(14, '2022-03-29', 1, 'pending', 2, 0, 19, 6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `vaccine_stock`
--

CREATE TABLE `vaccine_stock` (
  `stock_count_id` int(11) NOT NULL,
  `vc_id` int(11) NOT NULL,
  `vaccine_type` int(11) NOT NULL,
  `stock_date` date NOT NULL,
  `total_vaccine_stock` int(3) NOT NULL,
  `available_vaccine_stock` int(3) NOT NULL,
  `vaccine_price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vaccine_stock`
--

INSERT INTO `vaccine_stock` (`stock_count_id`, `vc_id`, `vaccine_type`, `stock_date`, `total_vaccine_stock`, `available_vaccine_stock`, `vaccine_price`) VALUES
(1, 17, 7, '2022-03-29', 500, 498, 300),
(2, 17, 6, '2022-03-29', 100, 100, 250),
(3, 17, 8, '2022-04-01', 50, 50, 800),
(4, 16, 7, '2022-03-23', 800, 800, NULL),
(5, 19, 6, '2022-03-29', 120, 118, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vaccine_type`
--

CREATE TABLE `vaccine_type` (
  `vaccine_id` int(11) NOT NULL,
  `vaccine_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vaccine_type`
--

INSERT INTO `vaccine_type` (`vaccine_id`, `vaccine_name`) VALUES
(6, 'Covaxin'),
(7, 'Covishield'),
(8, 'Sputnik V');

-- --------------------------------------------------------

--
-- Table structure for table `vc_age_group`
--

CREATE TABLE `vc_age_group` (
  `vc_age_id` int(11) NOT NULL,
  `vc_id` int(11) NOT NULL,
  `age_group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vc_age_group`
--

INSERT INTO `vc_age_group` (`vc_age_id`, `vc_id`, `age_group_id`) VALUES
(16, 14, 3),
(17, 14, 4),
(18, 15, 8),
(19, 16, 5),
(34, 17, 3),
(35, 17, 4),
(36, 17, 5),
(39, 19, 3),
(40, 19, 8);

-- --------------------------------------------------------

--
-- Table structure for table `ward_details`
--

CREATE TABLE `ward_details` (
  `ward_id` int(11) NOT NULL,
  `ward_name` varchar(25) NOT NULL,
  `Total_beds` int(3) NOT NULL,
  `Available_beds` int(3) NOT NULL,
  `Hospital_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ward_details`
--

INSERT INTO `ward_details` (`ward_id`, `ward_name`, `Total_beds`, `Available_beds`, `Hospital_id`) VALUES
(1, 'general', 1120, 1119, 38),
(2, 'special', 150, 150, 38),
(3, 'General Ward', 150, 150, 39),
(4, 'Special Ward', 10, 10, 39),
(5, 'Semi Special Ward', 5, 5, 39),
(6, 'General Ward', 500, 500, 40),
(7, 'Special Room', 10, 9, 40),
(8, 'Semi-Special Room', 5, 5, 40),
(9, 'Covid19 Beds', 60, 60, 40),
(13, 'General Ward', 250, 250, 41),
(14, 'Special Ward', 50, 50, 41),
(15, 'Semi Special Room', 10, 10, 41),
(16, 'Covid19 Beds', 35, 35, 41);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `age_group`
--
ALTER TABLE `age_group`
  ADD PRIMARY KEY (`age_group_id`);

--
-- Indexes for table `bed_requests`
--
ALTER TABLE `bed_requests`
  ADD PRIMARY KEY (`patient_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `hospital_id` (`hospital_id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `ward_id` (`ward_id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`district_id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `doctor_details`
--
ALTER TABLE `doctor_details`
  ADD PRIMARY KEY (`doctor_id`),
  ADD KEY `hisptial_id` (`hospital_id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`hospital_id`),
  ADD KEY `pincode` (`hospital_pincode`);

--
-- Indexes for table `laboratories`
--
ALTER TABLE `laboratories`
  ADD PRIMARY KEY (`lab_id`),
  ADD KEY `lab_pincode` (`lab_pincode`);

--
-- Indexes for table `labs_testings`
--
ALTER TABLE `labs_testings`
  ADD PRIMARY KEY (`LT_id`),
  ADD KEY `lab_id` (`lab_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pincode`
--
ALTER TABLE `pincode`
  ADD PRIMARY KEY (`pincode`),
  ADD KEY `district_id` (`district_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `testing_list`
--
ALTER TABLE `testing_list`
  ADD PRIMARY KEY (`testing_list_id`),
  ADD KEY `testing_id` (`testing_id`),
  ADD KEY `LT_id` (`LT_id`);

--
-- Indexes for table `testing_requests`
--
ALTER TABLE `testing_requests`
  ADD PRIMARY KEY (`testing_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `lab_id` (`lab_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `time_slot`
--
ALTER TABLE `time_slot`
  ADD PRIMARY KEY (`time_slot_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vaccination_centres`
--
ALTER TABLE `vaccination_centres`
  ADD PRIMARY KEY (`vc_id`),
  ADD KEY `vc_pincode` (`vc_pincode`);

--
-- Indexes for table `vaccination_requests`
--
ALTER TABLE `vaccination_requests`
  ADD PRIMARY KEY (`vaccination_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `vc_id` (`vc_id`),
  ADD KEY `vaccine_type` (`vaccine_type`),
  ADD KEY `time_slot` (`time_slot`);

--
-- Indexes for table `vaccine_stock`
--
ALTER TABLE `vaccine_stock`
  ADD PRIMARY KEY (`stock_count_id`),
  ADD KEY `vc_id` (`vc_id`),
  ADD KEY `vaccine_type` (`vaccine_type`);

--
-- Indexes for table `vaccine_type`
--
ALTER TABLE `vaccine_type`
  ADD PRIMARY KEY (`vaccine_id`);

--
-- Indexes for table `vc_age_group`
--
ALTER TABLE `vc_age_group`
  ADD PRIMARY KEY (`vc_age_id`),
  ADD KEY `vc_id` (`vc_id`),
  ADD KEY `vc_age_group_ibfk_1` (`age_group_id`);

--
-- Indexes for table `ward_details`
--
ALTER TABLE `ward_details`
  ADD PRIMARY KEY (`ward_id`),
  ADD KEY `Hospital_id` (`Hospital_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `age_group`
--
ALTER TABLE `age_group`
  MODIFY `age_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bed_requests`
--
ALTER TABLE `bed_requests`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `doctor_details`
--
ALTER TABLE `doctor_details`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `hospital_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `laboratories`
--
ALTER TABLE `laboratories`
  MODIFY `lab_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `labs_testings`
--
ALTER TABLE `labs_testings`
  MODIFY `LT_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pincode`
--
ALTER TABLE `pincode`
  MODIFY `pincode` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=391166;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `testing_list`
--
ALTER TABLE `testing_list`
  MODIFY `testing_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `testing_requests`
--
ALTER TABLE `testing_requests`
  MODIFY `testing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `time_slot`
--
ALTER TABLE `time_slot`
  MODIFY `time_slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vaccination_centres`
--
ALTER TABLE `vaccination_centres`
  MODIFY `vc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `vaccination_requests`
--
ALTER TABLE `vaccination_requests`
  MODIFY `vaccination_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `vaccine_stock`
--
ALTER TABLE `vaccine_stock`
  MODIFY `stock_count_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vaccine_type`
--
ALTER TABLE `vaccine_type`
  MODIFY `vaccine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vc_age_group`
--
ALTER TABLE `vc_age_group`
  MODIFY `vc_age_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `ward_details`
--
ALTER TABLE `ward_details`
  MODIFY `ward_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bed_requests`
--
ALTER TABLE `bed_requests`
  ADD CONSTRAINT `bed_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `bed_requests_ibfk_2` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`hospital_id`),
  ADD CONSTRAINT `bed_requests_ibfk_4` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`),
  ADD CONSTRAINT `bed_requests_ibfk_5` FOREIGN KEY (`ward_id`) REFERENCES `ward_details` (`ward_id`);

--
-- Constraints for table `district`
--
ALTER TABLE `district`
  ADD CONSTRAINT `district_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `state` (`state_id`);

--
-- Constraints for table `doctor_details`
--
ALTER TABLE `doctor_details`
  ADD CONSTRAINT `doctor_details_ibfk_1` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`hospital_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD CONSTRAINT `hospitals_ibfk_1` FOREIGN KEY (`hospital_pincode`) REFERENCES `pincode` (`pincode`);

--
-- Constraints for table `laboratories`
--
ALTER TABLE `laboratories`
  ADD CONSTRAINT `laboratories_ibfk_1` FOREIGN KEY (`lab_pincode`) REFERENCES `pincode` (`pincode`);

--
-- Constraints for table `labs_testings`
--
ALTER TABLE `labs_testings`
  ADD CONSTRAINT `labs_testings_ibfk_1` FOREIGN KEY (`lab_id`) REFERENCES `laboratories` (`lab_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `pincode`
--
ALTER TABLE `pincode`
  ADD CONSTRAINT `pincode_ibfk_1` FOREIGN KEY (`district_id`) REFERENCES `district` (`district_id`);

--
-- Constraints for table `testing_list`
--
ALTER TABLE `testing_list`
  ADD CONSTRAINT `testing_list_ibfk_1` FOREIGN KEY (`testing_id`) REFERENCES `testing_requests` (`testing_id`),
  ADD CONSTRAINT `testing_list_ibfk_2` FOREIGN KEY (`LT_id`) REFERENCES `labs_testings` (`LT_id`);

--
-- Constraints for table `testing_requests`
--
ALTER TABLE `testing_requests`
  ADD CONSTRAINT `testing_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `testing_requests_ibfk_2` FOREIGN KEY (`lab_id`) REFERENCES `laboratories` (`lab_id`),
  ADD CONSTRAINT `testing_requests_ibfk_4` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

--
-- Constraints for table `vaccination_centres`
--
ALTER TABLE `vaccination_centres`
  ADD CONSTRAINT `vaccination_centres_ibfk_1` FOREIGN KEY (`vc_pincode`) REFERENCES `pincode` (`pincode`);

--
-- Constraints for table `vaccination_requests`
--
ALTER TABLE `vaccination_requests`
  ADD CONSTRAINT `vaccination_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `vaccination_requests_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`),
  ADD CONSTRAINT `vaccination_requests_ibfk_3` FOREIGN KEY (`vc_id`) REFERENCES `vaccination_centres` (`vc_id`),
  ADD CONSTRAINT `vaccination_requests_ibfk_4` FOREIGN KEY (`vaccine_type`) REFERENCES `vaccine_type` (`vaccine_id`),
  ADD CONSTRAINT `vaccination_requests_ibfk_5` FOREIGN KEY (`time_slot`) REFERENCES `time_slot` (`time_slot_id`);

--
-- Constraints for table `vaccine_stock`
--
ALTER TABLE `vaccine_stock`
  ADD CONSTRAINT `vaccine_stock_ibfk_1` FOREIGN KEY (`vc_id`) REFERENCES `vaccination_centres` (`vc_id`),
  ADD CONSTRAINT `vaccine_stock_ibfk_2` FOREIGN KEY (`vaccine_type`) REFERENCES `vaccine_type` (`vaccine_id`);

--
-- Constraints for table `vc_age_group`
--
ALTER TABLE `vc_age_group`
  ADD CONSTRAINT `vc_age_group_ibfk_1` FOREIGN KEY (`age_group_id`) REFERENCES `age_group` (`age_group_id`),
  ADD CONSTRAINT `vc_age_group_ibfk_2` FOREIGN KEY (`vc_id`) REFERENCES `vaccination_centres` (`vc_id`);

--
-- Constraints for table `ward_details`
--
ALTER TABLE `ward_details`
  ADD CONSTRAINT `ward_details_ibfk_1` FOREIGN KEY (`Hospital_id`) REFERENCES `hospitals` (`hospital_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
