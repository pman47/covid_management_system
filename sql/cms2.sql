-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2022 at 06:56 AM
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
-- Table structure for table `bed_count`
--

CREATE TABLE `bed_count` (
  `bed_count_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `ward_id` int(11) NOT NULL,
  `total_beds` int(3) NOT NULL,
  `available_beds` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(10, 'Pune', 2);

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
  `hospital_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`hospital_id`, `hospital_username`, `hospital_password`, `hospital_name`, `hospital_address`, `contact_no`, `hospital_pincode`, `hospital_status`) VALUES
(1, 'civil123', '1234', 'Civil Hospital', '     D\" Block, Office of the Medical Superintendent Civil Hospital, Ahmedabad, Gujarat 380016    ', 7922683721, 382443, 'open'),
(3, 'shivam123', '1234', 'Shivam Hospital', 'Jaypunj Complex, 3Rd Floor, Near Income Tax Bridge, Shahpur Side, Riverfront Corner, Shahpur, Shah Colony, Kazipur Dariyapur, Near Shapur Post Office, Ahmedabad, Gujarat 380028 ', 7926585220, 380050, 'open');

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
  `lab_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laboratories`
--

INSERT INTO `laboratories` (`lab_id`, `lab_username`, `lab_password`, `lab_name`, `lab_address`, `contact_no`, `lab_pincode`, `lab_status`) VALUES
(1, 'Shriji1234', '1234', 'Shriji Pathology Laboratory', ' Dev Castle, Rachana Maninagar Society, Jay Krishna Society, Isanpur, Ahmedabad, Gujarat 380043 ', 1234567899, 380050, 'open'),
(2, 'shah1234', '1234', 'Shah Pathology Laboratory', ' 20/1, Relief Road, Opposite Gulabbai Gen Hospital, Ahmedabad', 7926741213, 382443, 'open');

-- --------------------------------------------------------

--
-- Table structure for table `labs_testings`
--

CREATE TABLE `labs_testings` (
  `LT_id` int(11) NOT NULL,
  `lab_id` int(11) NOT NULL,
  `tt_id` int(11) NOT NULL,
  `price` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(380007, 'Anandnagar ', 1),
(380050, 'Ghodasa', 1),
(382440, 'Vatva', 1),
(382443, 'Isanpur', 1);

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
(12, 'Madhya Pradesh');

-- --------------------------------------------------------

--
-- Table structure for table `testing_list`
--

CREATE TABLE `testing_list` (
  `testing_list_id` int(11) NOT NULL,
  `testing_id` int(11) NOT NULL,
  `tt_id` int(11) NOT NULL,
  `testing_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `testing_requests`
--

CREATE TABLE `testing_requests` (
  `testing_id` int(11) NOT NULL,
  `testing_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `lab_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `testing_types`
--

CREATE TABLE `testing_types` (
  `tt_id` int(11) NOT NULL,
  `tt_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `testing_types`
--

INSERT INTO `testing_types` (`tt_id`, `tt_name`) VALUES
(1, 'Blood Test'),
(2, 'Urine Test'),
(4, 'RT/PCR Test');

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
  `aadhar_document_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `password`, `user_name`, `user_aadhar_no`, `mobile_no`, `user_email`, `user_dob`, `user_gender`, `user_blood_group`, `aadhar_document_name`) VALUES
(2, '1234', 'Prajapati Manish Ratilal', 240778050543, 9327760618, 'manishprajapatim416@gmail.com', '2002-07-13', 'Male', 'B+', '329065.jpg');

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
  `vc_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vaccination_centres`
--

INSERT INTO `vaccination_centres` (`vc_id`, `vc_username`, `vc_password`, `vc_name`, `vc_address`, `vc_cost_type`, `vc_pincode`, `vc_status`) VALUES
(2, 'ghodasarUHC', '1234', 'Ghodasar UHC', '   Ramwadi-Anandwadi Rd, Jay Krishna Society, Isanpur, Ahmedabad, Gujarat  ', 'free', 380050, 'close'),
(3, 'isanpurUHC', '1234', 'Urban Health Center Isanpur', 'br 5 BR-5, Vishalnagar, Isanpur, Ahmedabad, Gujarat ', 'free', 382443, 'open'),
(6, 'stutivc123', '1234', 'Stuti Child Care & Vaccination Centre', '2nd Floor, Haash Complex, Above Icici Bank, Near Ankur School, Paldi, Ahmedabad, Gujarat 380007 ', 'free', 380007, 'open'),
(12, 'veparseva123', '1234', 'Veparseva Healthcare', 'NR Lakhudi Talawdi, Plot 197/2, NR Sardar Patel Colony, Navjivan, Ahmedabad, Gujarat 380014 · ~5.7 km', 'free', 382443, 'open');

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
  `available_vaccine_stock` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vaccine_type`
--

CREATE TABLE `vaccine_type` (
  `vaccine_id` int(11) NOT NULL,
  `vaccine_name` text NOT NULL,
  `vaccine_price` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vaccine_type`
--

INSERT INTO `vaccine_type` (`vaccine_id`, `vaccine_name`, `vaccine_price`) VALUES
(1, 'Covishield', 900),
(2, 'Covaxin', 1350),
(5, 'Sputnik VI', 500);

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
(1, 2, 4),
(2, 2, 3),
(3, 2, 5),
(4, 3, 5),
(5, 3, 4),
(6, 6, 8),
(7, 12, 4),
(8, 12, 5),
(9, 12, 8);

-- --------------------------------------------------------

--
-- Table structure for table `wards`
--

CREATE TABLE `wards` (
  `ward_id` int(11) NOT NULL,
  `ward_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wards`
--

INSERT INTO `wards` (`ward_id`, `ward_name`) VALUES
(2, 'General Ward'),
(3, 'Special Ward'),
(4, 'Semi-Special Ward'),
(5, 'Deluxe Ward');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `age_group`
--
ALTER TABLE `age_group`
  ADD PRIMARY KEY (`age_group_id`);

--
-- Indexes for table `bed_count`
--
ALTER TABLE `bed_count`
  ADD PRIMARY KEY (`bed_count_id`),
  ADD KEY `hospital_id` (`hospital_id`),
  ADD KEY `ward_id` (`ward_id`);

--
-- Indexes for table `bed_requests`
--
ALTER TABLE `bed_requests`
  ADD PRIMARY KEY (`patient_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `hospital_id` (`hospital_id`),
  ADD KEY `ward_id` (`ward_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`district_id`),
  ADD KEY `state_id` (`state_id`);

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
  ADD KEY `lab_id` (`lab_id`),
  ADD KEY `tt_id` (`tt_id`);

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
  ADD KEY `tt_id` (`tt_id`);

--
-- Indexes for table `testing_requests`
--
ALTER TABLE `testing_requests`
  ADD PRIMARY KEY (`testing_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `lab_id` (`lab_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `testing_types`
--
ALTER TABLE `testing_types`
  ADD PRIMARY KEY (`tt_id`);

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
-- Indexes for table `wards`
--
ALTER TABLE `wards`
  ADD PRIMARY KEY (`ward_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `age_group`
--
ALTER TABLE `age_group`
  MODIFY `age_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bed_count`
--
ALTER TABLE `bed_count`
  MODIFY `bed_count_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bed_requests`
--
ALTER TABLE `bed_requests`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `hospital_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `laboratories`
--
ALTER TABLE `laboratories`
  MODIFY `lab_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `labs_testings`
--
ALTER TABLE `labs_testings`
  MODIFY `LT_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pincode`
--
ALTER TABLE `pincode`
  MODIFY `pincode` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=391151;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `testing_list`
--
ALTER TABLE `testing_list`
  MODIFY `testing_list_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testing_requests`
--
ALTER TABLE `testing_requests`
  MODIFY `testing_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testing_types`
--
ALTER TABLE `testing_types`
  MODIFY `tt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `time_slot`
--
ALTER TABLE `time_slot`
  MODIFY `time_slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vaccination_centres`
--
ALTER TABLE `vaccination_centres`
  MODIFY `vc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `vaccination_requests`
--
ALTER TABLE `vaccination_requests`
  MODIFY `vaccination_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vaccine_stock`
--
ALTER TABLE `vaccine_stock`
  MODIFY `stock_count_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vaccine_type`
--
ALTER TABLE `vaccine_type`
  MODIFY `vaccine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vc_age_group`
--
ALTER TABLE `vc_age_group`
  MODIFY `vc_age_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `wards`
--
ALTER TABLE `wards`
  MODIFY `ward_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bed_count`
--
ALTER TABLE `bed_count`
  ADD CONSTRAINT `bed_count_ibfk_1` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`hospital_id`),
  ADD CONSTRAINT `bed_count_ibfk_2` FOREIGN KEY (`ward_id`) REFERENCES `wards` (`ward_id`);

--
-- Constraints for table `bed_requests`
--
ALTER TABLE `bed_requests`
  ADD CONSTRAINT `bed_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `bed_requests_ibfk_2` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`hospital_id`),
  ADD CONSTRAINT `bed_requests_ibfk_3` FOREIGN KEY (`ward_id`) REFERENCES `wards` (`ward_id`),
  ADD CONSTRAINT `bed_requests_ibfk_4` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

--
-- Constraints for table `district`
--
ALTER TABLE `district`
  ADD CONSTRAINT `district_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `state` (`state_id`);

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
  ADD CONSTRAINT `labs_testings_ibfk_1` FOREIGN KEY (`lab_id`) REFERENCES `laboratories` (`lab_id`),
  ADD CONSTRAINT `labs_testings_ibfk_2` FOREIGN KEY (`tt_id`) REFERENCES `testing_types` (`tt_id`);

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
  ADD CONSTRAINT `testing_list_ibfk_2` FOREIGN KEY (`tt_id`) REFERENCES `testing_types` (`tt_id`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
