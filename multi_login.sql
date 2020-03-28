-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2020 at 03:36 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multi_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `dcotor`
--

CREATE TABLE `dcotor` (
  `doctor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `doctor_first_name` varchar(255) NOT NULL,
  `doctor_last_name` varchar(255) NOT NULL,
  `doctor_phone` int(11) NOT NULL,
  `doctor_address` varchar(255) NOT NULL,
  `doctor_blood_group` varchar(255) NOT NULL,
  `doctor_age` int(11) NOT NULL,
  `doctor_qualification` varchar(255) NOT NULL,
  `doctor_speciality` varchar(255) NOT NULL,
  `doctor_identity` varchar(255) NOT NULL,
  `doctor_medical_document` varchar(255) NOT NULL,
  `doctor_additional_comments` varchar(255) NOT NULL DEFAULT 'NONE',
  `doctor_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dcotor`
--

INSERT INTO `dcotor` (`doctor_id`, `user_id`, `doctor_first_name`, `doctor_last_name`, `doctor_phone`, `doctor_address`, `doctor_blood_group`, `doctor_age`, `doctor_qualification`, `doctor_speciality`, `doctor_identity`, `doctor_medical_document`, `doctor_additional_comments`, `doctor_status`) VALUES
(1, 10, 'Ashnil', 'Vazirani', 987442211, 'ulhasnagar', 'A+', 34, 'MBBS', 'orthologist', 'Tokenize.pdf', 'Tokenize.pdf', 'NONE', 1),
(2, 10, 'ABC', 'XYZ', 2147483647, 'THane', 'A-', 22, 'BAMS', 'legs', 'Signature.pdf', 'Bank Details.pdf', '', 0),
(3, 10, 'ABC', 'XYZ', 2147483647, 'THane', 'A-', 22, 'BAMS', 'legs', 'Signature.pdf', 'Bank Details.pdf', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_hospital`
--

CREATE TABLE `doctor_hospital` (
  `doctor_hospital_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_hospital`
--

INSERT INTO `doctor_hospital` (`doctor_hospital_id`, `doctor_id`, `hospital_id`, `status`) VALUES
(1, 1, 1, 0),
(2, 1, 1, 0),
(3, 1, 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `donor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `donor_first_name` varchar(255) NOT NULL,
  `donor_last_name` varchar(255) NOT NULL,
  `donor_phone` int(11) NOT NULL,
  `donor_address` varchar(255) NOT NULL,
  `donor_blood_group` varchar(255) NOT NULL,
  `donor_age` int(11) NOT NULL,
  `donor_organ` varchar(255) NOT NULL,
  `donor_identity` varchar(255) NOT NULL,
  `donor_medical_document` varchar(255) NOT NULL,
  `donor_additional_comments` varchar(255) DEFAULT NULL,
  `donor_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`donor_id`, `user_id`, `donor_first_name`, `donor_last_name`, `donor_phone`, `donor_address`, `donor_blood_group`, `donor_age`, `donor_organ`, `donor_identity`, `donor_medical_document`, `donor_additional_comments`, `donor_status`) VALUES
(11, 2, 'Ashnil', 'Vazirani', 123456789, 'unr', 'A', 23, 'eyes', 'Bank Details.pdf', 'Tokenize.pdf', '', 1),
(12, 11, 'hari om ', 'bhai', 2147483647, 'Ulhasnagar 5', 'A', 44, 'full body', 'p126 (1).pdf', 'Ashnil Vazirani- Diploma Certificate.pdf', 'bass setting ho jae', 0);

-- --------------------------------------------------------

--
-- Table structure for table `donor_hospital`
--

CREATE TABLE `donor_hospital` (
  `donor_hospital` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donor_hospital`
--

INSERT INTO `donor_hospital` (`donor_hospital`, `donor_id`, `hospital_id`, `status`) VALUES
(1, 11, 1, 1),
(2, 11, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `hospital_id` int(11) NOT NULL,
  `hospital_name` varchar(255) NOT NULL,
  `hospital_address` varchar(255) NOT NULL,
  `hospital_city` varchar(255) NOT NULL,
  `hospital_state` varchar(255) NOT NULL,
  `hospital_phone` int(11) NOT NULL,
  `hospital_incharege_details` varchar(255) NOT NULL,
  `hospital_speciality` varchar(255) NOT NULL,
  `hospital_documents` varchar(255) NOT NULL,
  `hospital_saved_by` int(11) NOT NULL,
  `hospital_additional_comments` varchar(255) DEFAULT 'NONE',
  `hospital_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`hospital_id`, `hospital_name`, `hospital_address`, `hospital_city`, `hospital_state`, `hospital_phone`, `hospital_incharege_details`, `hospital_speciality`, `hospital_documents`, `hospital_saved_by`, `hospital_additional_comments`, `hospital_status`) VALUES
(1, 'Criticare', 'section-25, dhanlaxmi chicken store', 'Ulhasnagar', 'Maharastra', 987712345, 'random man taking care for free', 'kidney transplant', 'Tokenize.pdf', 10, 'NONE', 0),
(8, 'abc', 'abc', 'abc', 'abc', 123456789, 'acb', 'acb', 'CandidateHallTicket (1).pdf', 10, 'abc', 0),
(9, 'sidivinayak', 'dubai', 'bur dubai', 'dubai', 87654321, 'none', 'kidney', 'left-thumb.pdf', 10, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patient_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `patient_first_name` varchar(255) NOT NULL,
  `patient_last_name` varchar(255) NOT NULL,
  `patient_phone` int(11) NOT NULL,
  `patient_address` varchar(255) NOT NULL,
  `patient_blood_group` varchar(255) NOT NULL,
  `patient_age` int(11) NOT NULL,
  `patient_organ` varchar(255) NOT NULL,
  `patient_identity` varchar(255) NOT NULL,
  `patient_medical_document` varchar(255) NOT NULL,
  `patient_additional_comments` varchar(255) NOT NULL,
  `patient_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `user_id`, `patient_first_name`, `patient_last_name`, `patient_phone`, `patient_address`, `patient_blood_group`, `patient_age`, `patient_organ`, `patient_identity`, `patient_medical_document`, `patient_additional_comments`, `patient_status`) VALUES
(1, 9, 'MR. PQR', 'XYZ', 987654321, 'THANE', 'A', 23, 'eyes', 'Medical Fitness.pdf', 'Ayushi Documents.pdf', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patient_hospital`
--

CREATE TABLE `patient_hospital` (
  `patient_hospital` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_hospital`
--

INSERT INTO `patient_hospital` (`patient_hospital`, `patient_id`, `hospital_id`, `status`) VALUES
(1, 1, 1, 1),
(2, 1, 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Complete` tinyint(1) NOT NULL,
  `inprogress` tinyint(1) NOT NULL,
  `blood_group` varchar(100) NOT NULL,
  `age_group` varchar(100) NOT NULL,
  `Document` text NOT NULL,
  `organ` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `email`, `user_type`, `password`, `Complete`, `inprogress`, `blood_group`, `age_group`, `Document`, `organ`) VALUES
(0, 'sneha', 'sneha.almeida.111@gmail.com', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, '0', '0', '0', ''),
(0, 'sneha', 'sneha.almeida.111@gmail.com', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, '0', '0', '0', ''),
(0, 'test_user', 'abc@gmail.com', 'user', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, '0', '0', '0', ''),
(0, 'test 2', 'test2@abc.com', 'user', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, '0', '0', '0', ''),
(0, 'test user', 'test@user.com', 'user', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, '0', '0', '0', ''),
(0, 'yellow', 'yellow@abc.xyz', 'user', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, '0', '0', '0', ''),
(0, 'red', 'red@abc.mkl', 'user', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, '0', '0', '0', ''),
(0, 'black', 'black@abc.com', '', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, '0', '0', '0', ''),
(0, 'white', 'white@abc.com', '', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, '0', '0', '0', ''),
(0, 'white', 'white@abc.com', '', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, '0', '0', '0', ''),
(0, 'blue', 'blue@abc.com', 'Donor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, '0', '0', '0', ''),
(0, 'purple', 'purple@abc.com', 'Acceptor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, '0', '0', '0', ''),
(0, 'green', 'green@abc.com', 'Donor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, '0', '0', '0', ''),
(0, 'grey', 'grey@abc.com', 'Acceptor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, '0', '0', '0', ''),
(0, 'orange', 'orange@abc.com', 'Acceptor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, '0', '0', '0', ''),
(12, 'hello', 'hello@gmail.com', 'Donor', '123456', 1, 0, '0', '0', '0', ''),
(122, 'hi', 'hi@gmail.com', 'Acceptor', '123456', 1, 0, '0', '0', '0', ''),
(43, 'hi2', 'hi2@gmail.com', 'Donor', '123456', 1, 0, '0', '0', '0', ''),
(0, 'one', 'one@gmail.com', 'Donor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, '0', '0', '0', ''),
(0, 'two', '2@gmail.com', 'Acceptor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, '0', '0', '0', ''),
(0, 'pinku', 'pinku@abc.com', 'Donor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, '', '', '', ''),
(0, 'three', 'three@ABC.COM', 'Acceptor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, '', '', '', ''),
(0, 'four', 'four@abc.com', 'Acceptor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 'A+', '', '', ''),
(0, 'five', 'five@abc.com', 'Donor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 'A+', '', '', ''),
(0, 'seven', '7@abc.com', 'Donor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 'A+', '0-18', '', ''),
(0, 'wee', 'A@abc.com', 'Donor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 'A+', '0-18', '', ''),
(0, 'eight', '8@abc.com', 'Acceptor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 'A+', '0-18', '', ''),
(0, 'yo', 'yo@abc.com', 'Acceptor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 'A+', '0-18', '', ''),
(0, 'donor1', '1@abc.com', 'Donor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 'A+', '0-18', '', ''),
(0, 'acceptor1', '1@abc.com', 'Donor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 'A+', '0-18', '', ''),
(0, 'acceptor2', '2@abc.com', 'Acceptor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 'A+', '0-18', '', ''),
(0, 'donor2', '2@abc.com', 'Donor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 'A+', '0-18', '', ''),
(0, 'acceptor3', '3@abc.com', 'Acceptor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 'B+', '0-18', '', ''),
(0, 'acceptor4', '4@abc.com', 'Acceptor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 'AB+', '0-18', '', ''),
(0, 'donor5', '5@abc.com', 'Donor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 'A+', '0-18', '', ''),
(0, 'acceptor5', '5@abc.com', 'Acceptor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 'B+', '0-18', '', ''),
(0, 'donor6', '6@abc.com', 'Donor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 'A+', '0-18', '', ''),
(0, 'acceptor6', '6@abc.com', 'Acceptor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 'B+', '0-18', '', ''),
(0, 'donor7', '7@abc.com', 'Donor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 'A+', '0-18', '', ''),
(0, 'acceptor7', '7@abc.com', 'Acceptor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 'B+', '0-18', '', ''),
(0, 'donor8', '8@abc.com', 'Donor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 'A+', '0-18', '', ''),
(0, 'acceptor8', '8@abc.com', 'Acceptor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 'A+', '0-18', '', ''),
(0, 'donor9', '9@abc.com', 'Donor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 'A+', '0-18', '', ''),
(0, 'acceptor9', '9@abc.com', 'Acceptor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 'A+', '0-18', '', ''),
(0, 'donor10', '10@abc.co', 'Donor', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, 'A+', '0-18', '', ''),
(0, 'acceptor10', '10@abc.com', 'Acceptor', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, 'B+', '40-75', '', ''),
(0, 'donor11', '11@abc.vo', 'Donor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 'A+', '0-18', '', 'Heart'),
(0, 'acceptor11', '11@abc.com', 'Acceptor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 'A+', '0-18', '', 'Heart'),
(0, 'donor_new', 'donor@gmail.com', 'Donor', '900150983cd24fb0d6963f7d28e17f72', 1, 0, 'A+', '0-18', '', 'Eyes'),
(0, 'acceptor_new', 'acc@gmail.com', 'Acceptor', '900150983cd24fb0d6963f7d28e17f72', 1, 0, 'A+', '0-18', '', 'Eyes'),
(0, 'admin', 'admin@gmail.com', 'admin', 'abc123', 0, 0, 'A+', '', '', ''),
(0, 'admin', 'admin@gmail.com', 'admin', 'abc123', 0, 0, 'A+', '0', '0', '0'),
(0, 'admmin', 'abc@gmail.com', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, 'A+', 'o', '', 'none'),
(0, 'admmin', 'abc@gmail.com', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, 'A+', '0', '0', 'none'),
(0, 'kunal', 'kunal@gmail.com', 'Donor', '900150983cd24fb0d6963f7d28e17f72', 1, 0, 'A+', '18-40', '', 'Eyes'),
(0, 'gaurav_new', 'G@GMAIL.COM', 'Acceptor', '900150983cd24fb0d6963f7d28e17f72', 0, 0, 'A+', '40-75', '', 'Eyes'),
(0, 'rahul_chor', 'chor@gmail.com', 'Acceptor', '900150983cd24fb0d6963f7d28e17f72', 0, 0, 'O-', '18-40', '', 'Heart'),
(0, 'ash', 'ash@gmail.com', 'Donor', '900150983cd24fb0d6963f7d28e17f72', 0, 0, 'B+', '0-18', '', 'Heart'),
(0, 'acceptor111', '111@gmail.com', 'Acceptor', '900150983cd24fb0d6963f7d28e17f72', 0, 0, 'A+', '0-18', '', 'Eyes'),
(0, 'acc11', 'acc@gmail.com', 'Acceptor', '900150983cd24fb0d6963f7d28e17f72', 1, 0, 'A+', '18-40', '', 'Eyes'),
(0, 'test 50', 'test50@gmail.com', 'Donor', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 'A+', '0-18', '', 'Heart'),
(0, 'acc111', 'acc111@gmail.com', 'Acceptor', '900150983cd24fb0d6963f7d28e17f72', 1, 0, 'A+', '0-18', '', 'Heart'),
(0, 'abc', 'abc@gmail.com', 'Donor', '900150983cd24fb0d6963f7d28e17f72', 1, 0, 'A+', '0-18', '', 'Heart'),
(0, 'rohit', 'r@GMAIL.COM', 'Acceptor', '900150983cd24fb0d6963f7d28e17f72', 1, 0, 'A+', '0-18', '', 'Heart');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `user_record_stores` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `username`, `user_email`, `user_password`, `user_type`, `user_record_stores`) VALUES
(2, 'ashnil', 'ashnilvazirani26@gmail.com', '900150983cd24fb0d6963f7d28e17f72', 'Donor', 1),
(9, 'pqr', 'ashnilvazirani26@gmail.com', '900150983cd24fb0d6963f7d28e17f72', 'Patient', 1),
(10, 'admin', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'admin', 0),
(11, 'hari', 'hari@om.com', '900150983cd24fb0d6963f7d28e17f72', 'Donor', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dcotor`
--
ALTER TABLE `dcotor`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `doctor_hospital`
--
ALTER TABLE `doctor_hospital`
  ADD PRIMARY KEY (`doctor_hospital_id`);

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`donor_id`);

--
-- Indexes for table `donor_hospital`
--
ALTER TABLE `donor_hospital`
  ADD PRIMARY KEY (`donor_hospital`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`hospital_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `patient_hospital`
--
ALTER TABLE `patient_hospital`
  ADD PRIMARY KEY (`patient_hospital`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dcotor`
--
ALTER TABLE `dcotor`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `doctor_hospital`
--
ALTER TABLE `doctor_hospital`
  MODIFY `doctor_hospital_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `donor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `donor_hospital`
--
ALTER TABLE `donor_hospital`
  MODIFY `donor_hospital` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `hospital_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patient_hospital`
--
ALTER TABLE `patient_hospital`
  MODIFY `patient_hospital` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
