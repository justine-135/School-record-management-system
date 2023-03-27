-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2023 at 04:20 PM
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
-- Table structure for table `parent/guardians_table`
--

CREATE TABLE `parent/guardians_table` (
  `id` int(11) NOT NULL COMMENT 'Parent/Guardian ID',
  `student_lrn` bigint(12) NOT NULL,
  `relation` text NOT NULL,
  `surname` text NOT NULL COMMENT 'The surname of the person',
  `first_name` text NOT NULL COMMENT 'The first name of the person',
  `middle_name` text NOT NULL COMMENT 'The middle name of the person',
  `education` text NOT NULL COMMENT 'Highest educational attainment',
  `employment` text NOT NULL COMMENT 'Employment status',
  `contact_number` int(11) NOT NULL COMMENT 'Cellphone/Telephone contact number',
  `is_beneficiary` int(1) NOT NULL COMMENT 'Is beneficiary of 4Ps'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parent/guardians_table`
--

INSERT INTO `parent/guardians_table` (`id`, `student_lrn`, `relation`, `surname`, `first_name`, `middle_name`, `education`, `employment`, `contact_number`, `is_beneficiary`) VALUES
(1, 1, 'Father', 'a', 's', 'd', 'Highschool Graduate', 'Full-time', 0, 1),
(2, 1, 'Mother', 'f', 'g', 'h', 'Highschool Graduate', 'Part-time', 123123, 1),
(3, 1, 'Guardian', 'k', 'j', 'l', 'College Graduate', 'Unemployed', 123123, 1),
(4, 4, 'Father', 'fathersname', 'fatherfnam', 'fathermnam', 'Elementary Graduate', 'Full-time', 2147483647, 1),
(5, 4, 'Mother', 'mothersnam', 'motherfname', 'mothermname', 'Bootcamp', 'Part-time', 2147483647, 1),
(6, 4, 'Guardian', 'guardiansname', 'guardianfname', 'guardianmname', 'Elementary Graduate', 'Not Working', 2147483647, 1),
(7, 123123123121, 'Father', 'fsname', 'ffname', 'fmname', 'College Graduate', 'Full-time', 2147483647, 1),
(8, 123123123121, 'Mother', 'msname', 'mfname', 'mmname', 'College Graduate', 'Full-time', 2147483647, 1),
(9, 123123123121, 'Guardian', 'gsname', 'gfname', 'gmname', 'Bootcamp', 'Full-time', 2147483647, 1),
(10, 928392910232, 'Father', 'Doe', 'Asd', 'Dsawd', 'College Graduate', 'Full-time', 2147483647, 1),
(11, 928392910232, 'Mother', 'Doe', 'poasd', 'qwioe', 'Bootcamp', 'Full-time', 2147483647, 1),
(12, 928392910232, 'Guardian', 'Mark', 'aoisjd', 'qowie', 'Master\'s Doctorate Degree', 'Full-time', 2147483647, 1),
(13, 192837293812, 'Father', 'uzumaki', 'minato', 'nani', 'Elementary Graduate', 'Full-time', 2147483647, 1),
(14, 192837293812, 'Mother', 'uzumaki', 'hirana', 'nano', 'Elementary Graduate', 'Full-time', 2147483647, 1),
(15, 192837293812, 'Guardian', 'uzumaki', 'jiraya', 'nanu', 'Elementary Graduate', 'Full-time', 2147483647, 1);

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
  `lrn` bigint(12) NOT NULL COMMENT 'Learner''s reference number (LRN) of student',
  `sy` text NOT NULL COMMENT 'Current school year enrolled',
  `grade_level` text NOT NULL COMMENT 'Grade level to enroll',
  `birth_date` date NOT NULL COMMENT 'Birth date of the student',
  `age` int(3) NOT NULL COMMENT 'Age of the student',
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

INSERT INTO `students_table` (`id`, `enrolled_at`, `updated_at`, `surname`, `first_name`, `middle_name`, `lrn`, `sy`, `grade_level`, `birth_date`, `age`, `gender`, `religion`, `house_street`, `subdivision`, `barangay`, `city`, `province`, `region`) VALUES
(1, '2023-03-21', '0000-00-00', 'UPANOE', 'JUSTINE RAY', 'CABANG', 2147483647, '2022-2023', '3', '0000-00-00', 12, 'Male', 'Catholic', '150', 'Phase 10', 'Pasong Buaya', 'Imus', 'Cavite', 'CALABARZON'),
(4, '2023-03-25', NULL, 'Magpantay', 'Daryl', 'C', 2147483647, '2023 - 2024', 'Kindergarten', '2015-02-01', 5, 'Male', 'Catholic', '138', 'Phase 10 ', 'Pasong Buaya 2', 'Imus', 'Cavite', 'CALABARZON'),
(25, '2023-03-25', NULL, 'upano', 'nika', 'cabang', 123123123121, '2023 - 2024', 'Kindergarten', '2017-01-25', 6, 'Male', 'Catholic', '167', 'Phase 10', 'Pasong Buaya 5', 'Imus', 'Cavite', 'Calabarzon'),
(26, '2023-03-25', NULL, 'Doe', 'John', 'Mark', 928392910232, '2023 - 2024', '12', '2017-01-25', 6, 'Male', 'Catholic', '29', 'Avignon', 'Buhay na tubig', 'Bacoor', 'Cavite', 'CALABARZON'),
(27, '2023-03-25', NULL, 'uzumaki', 'naruto', 'hinata', 192837293812, '2023 - 2024', '7', '2016-04-25', 12, 'Male', 'Catholic', '28', 'Hidden leaf', 'BNT', 'Imus', 'Cavite', 'Japan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `enrollment_history_table`
--
ALTER TABLE `enrollment_history_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parent/guardians_table`
--
ALTER TABLE `parent/guardians_table`
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
-- AUTO_INCREMENT for table `parent/guardians_table`
--
ALTER TABLE `parent/guardians_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Parent/Guardian ID', AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `students_table`
--
ALTER TABLE `students_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID of students', AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
