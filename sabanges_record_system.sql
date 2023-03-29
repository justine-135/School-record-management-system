-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2023 at 10:53 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sabanges_record_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `enrollment_history_table`
--

CREATE TABLE `enrollment_history_table` (
  `id` int(11) NOT NULL COMMENT 'Unique identity',
  `student_id` int(11) NOT NULL COMMENT 'Foreign student id',
  `sy` text NOT NULL COMMENT 'School year',
  `enrolled_at` date NOT NULL COMMENT 'First enrollment date',
  `school` text NOT NULL COMMENT 'School enrolled at',
  `grade` text NOT NULL COMMENT 'Enrolled grade level',
  `section` text NOT NULL COMMENT 'Section enrolled',
  `status` text NOT NULL COMMENT 'Current status'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fathers_table`
--

CREATE TABLE `fathers_table` (
  `id` int(11) NOT NULL COMMENT 'Parent/Guardian ID',
  `student_lrn` bigint(12) NOT NULL,
  `surname` text NOT NULL COMMENT 'The surname of the person',
  `first_name` text NOT NULL COMMENT 'The first name of the person',
  `middle_name` text NOT NULL COMMENT 'The middle name of the person',
  `education` text NOT NULL COMMENT 'Highest educational attainment',
  `employment` text NOT NULL COMMENT 'Employment status',
  `contact_number` varchar(255) NOT NULL COMMENT 'Cellphone/Telephone contact number',
  `is_beneficiary` int(1) NOT NULL COMMENT 'Is beneficiary of 4Ps'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fathers_table`
--

INSERT INTO `fathers_table` (`id`, `student_lrn`, `surname`, `first_name`, `middle_name`, `education`, `employment`, `contact_number`, `is_beneficiary`) VALUES
(1, 123456789123, 'asdasd', 'qweqwe', 'fgsdf', 'Elementary Graduate', 'Full-time', '2147483647', 1),
(2, 123456789123, 'asdasda', 'sdasdasd', 'asdasdas', 'Elementary Graduate', 'Full-time', '2147483647', 1),
(3, 9223372036854775807, 'asdasd', 'adasd', 'asdasd', 'Elementary Graduate', 'Full-time', 'asdasdasd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `guardians_table`
--

CREATE TABLE `guardians_table` (
  `id` int(11) NOT NULL COMMENT 'Parent/Guardian ID',
  `student_lrn` bigint(12) NOT NULL,
  `surname` text NOT NULL COMMENT 'The surname of the person',
  `first_name` text NOT NULL COMMENT 'The first name of the person',
  `middle_name` text NOT NULL COMMENT 'The middle name of the person',
  `education` text NOT NULL COMMENT 'Highest educational attainment',
  `employment` text NOT NULL COMMENT 'Employment status',
  `contact_number` varchar(255) NOT NULL COMMENT 'Cellphone/Telephone contact number',
  `is_beneficiary` int(1) NOT NULL COMMENT 'Is beneficiary of 4Ps'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guardians_table`
--

INSERT INTO `guardians_table` (`id`, `student_lrn`, `surname`, `first_name`, `middle_name`, `education`, `employment`, `contact_number`, `is_beneficiary`) VALUES
(1, 123456789123, 'qweqwe', 'asdqw', 'qweqwe', 'Elementary Graduate', 'Full-time', '2147483647', 1),
(2, 123456789123, 'dasdasd', 'asdasda', 'sdasdasd', 'Elementary Graduate', 'Full-time', '2147483647', 1),
(3, 9223372036854775807, 'asdasd', 'asdasd', 'asdasd', 'Elementary Graduate', 'Full-time', 'asdasdasdasd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mothers_table`
--

CREATE TABLE `mothers_table` (
  `id` int(11) NOT NULL COMMENT 'Parent/Guardian ID',
  `student_lrn` bigint(12) NOT NULL,
  `surname` text NOT NULL COMMENT 'The surname of the person',
  `first_name` text NOT NULL COMMENT 'The first name of the person',
  `middle_name` text NOT NULL COMMENT 'The middle name of the person',
  `education` text NOT NULL COMMENT 'Highest educational attainment',
  `employment` text NOT NULL COMMENT 'Employment status',
  `contact_number` varchar(255) NOT NULL COMMENT 'Cellphone/Telephone contact number',
  `is_beneficiary` int(1) NOT NULL COMMENT 'Is beneficiary of 4Ps'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mothers_table`
--

INSERT INTO `mothers_table` (`id`, `student_lrn`, `surname`, `first_name`, `middle_name`, `education`, `employment`, `contact_number`, `is_beneficiary`) VALUES
(1, 123456789123, 'asdas', 'qweqwe', 'asdadf', 'Elementary Graduate', 'Full-time', '2147483647', 1),
(2, 123456789123, 'dasdas', 'dasdasdasd', 'asdasdas', 'Elementary Graduate', 'Full-time', '2147483647', 1),
(3, 9223372036854775807, 'asdasd', 'asdasd', 'asdasd', 'Elementary Graduate', 'Full-time', 'asdasdasd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `students_table`
--

CREATE TABLE `students_table` (
  `id` int(11) NOT NULL COMMENT 'ID of students',
  `enrolled_at` date NOT NULL DEFAULT current_timestamp() COMMENT 'Date enrolled at',
  `updated_at` date DEFAULT NULL COMMENT 'Date updated at',
  `surname` text NOT NULL COMMENT 'Last name of the student',
  `first_name` text NOT NULL COMMENT 'First name of the student',
  `middle_name` text NOT NULL COMMENT 'Middle name of the student',
  `ext` text NOT NULL COMMENT 'Name extension',
  `image` blob NOT NULL COMMENT 'Student profile image',
  `lrn` bigint(12) NOT NULL COMMENT 'Learner''s reference number (LRN) of student',
  `sy` text NOT NULL COMMENT 'Current school year enrolled',
  `grade_level` text NOT NULL COMMENT 'Grade level to enroll',
  `birth_date` date NOT NULL COMMENT 'Birth date of the student',
  `gender` varchar(255) NOT NULL COMMENT 'Gender of the student',
  `religion` text NOT NULL COMMENT 'Religion of the student',
  `house_street` mediumtext NOT NULL COMMENT 'House number and street',
  `subdivision` mediumtext NOT NULL COMMENT 'Subdivision, village, or street',
  `barangay` mediumtext NOT NULL COMMENT 'Barangay',
  `city` mediumtext NOT NULL COMMENT 'City or municipality',
  `province` text NOT NULL COMMENT 'Province',
  `region` text NOT NULL COMMENT 'Region'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='List of student''s general informations';

--
-- Dumping data for table `students_table`
--

INSERT INTO `students_table` (`id`, `enrolled_at`, `updated_at`, `surname`, `first_name`, `middle_name`, `ext`, `image`, `lrn`, `sy`, `grade_level`, `birth_date`, `gender`, `religion`, `house_street`, `subdivision`, `barangay`, `city`, `province`, `region`) VALUES
(1, '2023-03-29', NULL, 'upano', 'justine ray ', 'cabang', 'None', '', 123456789123, '2023 - 2024', 'Kindergarten', '2016-06-29', 'Male', 'Catholic', '212', 'Phase 3', 'Pasong Buaya 9', 'Imus', 'Cavite', 'CALABARZON'),
(2, '2023-03-29', NULL, 'asdasda', 'adsdas', 'dasdasd', 'None', '', 123456789123, '2023 - 2024', 'Kindergarten', '2016-07-29', 'Male', 'asdasdasd', 'asdasda', 'asdasd', 'asdasd', 'sdasda', 'asdasda', 'asdasd'),
(3, '2023-03-29', NULL, 'asdasd', 'asdasd', 'asdasd', 'None', '', 9223372036854775807, '2023 - 2024', 'Kindergarten', '2023-02-27', 'Male', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `enrollment_history_table`
--
ALTER TABLE `enrollment_history_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fathers_table`
--
ALTER TABLE `fathers_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guardians_table`
--
ALTER TABLE `guardians_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mothers_table`
--
ALTER TABLE `mothers_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_table`
--
ALTER TABLE `students_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `enrollment_history_table`
--
ALTER TABLE `enrollment_history_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique identity';

--
-- AUTO_INCREMENT for table `fathers_table`
--
ALTER TABLE `fathers_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Parent/Guardian ID', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `guardians_table`
--
ALTER TABLE `guardians_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Parent/Guardian ID', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mothers_table`
--
ALTER TABLE `mothers_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Parent/Guardian ID', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students_table`
--
ALTER TABLE `students_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID of students', AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
