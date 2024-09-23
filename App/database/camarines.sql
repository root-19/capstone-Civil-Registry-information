-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2024 at 03:31 PM
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
-- Database: `camarines`
--

-- --------------------------------------------------------

--
-- Table structure for table `birth_registration`
--

CREATE TABLE `birth_registration` (
  `id` int(11) NOT NULL,
  `registry_no` varchar(50) NOT NULL,
  `name_last` varchar(50) NOT NULL,
  `name_first` varchar(50) NOT NULL,
  `name_middle` varchar(50) DEFAULT NULL,
  `place_birth_city` varchar(50) DEFAULT NULL,
  `place_birth_province` varchar(50) DEFAULT NULL,
  `place_birth_street` varchar(50) DEFAULT NULL,
  `place_birth_barangay` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `father_last` varchar(50) DEFAULT NULL,
  `father_first` varchar(50) DEFAULT NULL,
  `father_middle` varchar(50) DEFAULT NULL,
  `mother_last` varchar(50) DEFAULT NULL,
  `mother_first` varchar(50) DEFAULT NULL,
  `mother_middle` varchar(50) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `birth_registration`
--

INSERT INTO `birth_registration` (`id`, `registry_no`, `name_last`, `name_first`, `name_middle`, `place_birth_city`, `place_birth_province`, `place_birth_street`, `place_birth_barangay`, `date_of_birth`, `gender`, `father_last`, `father_first`, `father_middle`, `mother_last`, `mother_first`, `mother_middle`, `contact_no`) VALUES
(4, 'afsafs', 'afaF', 'AFAfaF', 'FAfaF', 'Vz', 'VXVXZV', 'RVXVXZVX', 'XVXZV', '2024-10-11', 'Female', 'XVXZVX', 'VXZVXZV', 'VXVXZV', 'VXZVXZ', 'XZVXZV', 'XVXZVX', 'sfsaf'),
(5, 'afsafs', 'DADA', 'DADAD', 'ADADAD', 'ADA', 'DADAD', 'ADAD', 'ADADAD', '2024-10-10', 'Female', 'ADAD', 'ADAD', 'ADAd', 'adAD', 'DADA', 'ADAd', 'ADADADA'),
(6, 'afsafs', 'DADA', 'DADAD', 'ADADAD', 'ADA', 'DADAD', 'ADAD', 'ADADAD', '2024-10-10', 'Female', 'ADAD', 'ADAD', 'ADAd', 'adAD', 'DADA', 'ADAd', 'ADADADA'),
(7, 'adaDADA', 'adad', 'adadad', 'adad', 'dada', 'dad', 'adad', 'dad', '2024-10-11', 'Female', 'ada', 'ADA', 'DAD', 'ADAD', 'DAD', 'ADAd', 'DADAd'),
(8, 'rens', 'FSAFSA', 'FSFS', 'FSFSFS', 'FSFS', 'FSF', 'SFSF', 'SFSAFS', '2024-09-15', 'Male', 'SFS', 'FSFS', 'FSF', 'SFSF', 'FSF', 'FSFS', 'FSFSAFSA');

-- --------------------------------------------------------

--
-- Table structure for table `death_info`
--

CREATE TABLE `death_info` (
  `id` int(11) NOT NULL,
  `registry_no` varchar(255) NOT NULL,
  `date_of_death` date DEFAULT NULL,
  `founder_last_name` varchar(255) NOT NULL,
  `founder_first_name` varchar(255) NOT NULL,
  `founder_middle_name` varchar(255) DEFAULT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `founder_street` varchar(255) DEFAULT NULL,
  `founder_barangay` varchar(255) DEFAULT NULL,
  `founder_province` varchar(255) DEFAULT NULL,
  `founder_zipcode` varchar(10) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `civil_status` varchar(50) DEFAULT NULL,
  `cause_of_death` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `death_info`
--

INSERT INTO `death_info` (`id`, `registry_no`, `date_of_death`, `founder_last_name`, `founder_first_name`, `founder_middle_name`, `gender`, `founder_street`, `founder_barangay`, `founder_province`, `founder_zipcode`, `occupation`, `civil_status`, `cause_of_death`, `created_at`) VALUES
(2, 'rens', '2024-09-17', 'ss', 'ss', 'ss', 'Female', 'ss', NULL, 'ss', NULL, 'ss', 'ss', 'ss', '2024-09-17 13:00:55');

-- --------------------------------------------------------

--
-- Table structure for table `live_births`
--

CREATE TABLE `live_births` (
  `id` int(11) NOT NULL,
  `registry_no` varchar(50) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `date_time` datetime NOT NULL,
  `founder_last_name` varchar(50) NOT NULL,
  `founder_first_name` varchar(50) NOT NULL,
  `founder_middle_name` varchar(50) DEFAULT NULL,
  `founder_occupation` varchar(100) DEFAULT NULL,
  `founder_street` varchar(100) DEFAULT NULL,
  `founder_province` varchar(100) DEFAULT NULL,
  `founder_barangay` varchar(100) DEFAULT NULL,
  `founder_zipcode` varchar(10) DEFAULT NULL,
  `informant_last_name` varchar(50) NOT NULL,
  `informant_first_name` varchar(50) NOT NULL,
  `informant_middle_name` varchar(50) DEFAULT NULL,
  `informant_occupation` varchar(100) DEFAULT NULL,
  `relationship_to_founder` varchar(100) DEFAULT NULL,
  `informant_address` varchar(100) DEFAULT NULL,
  `informant_contact` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `live_births`
--

INSERT INTO `live_births` (`id`, `registry_no`, `contact_no`, `date_time`, `founder_last_name`, `founder_first_name`, `founder_middle_name`, `founder_occupation`, `founder_street`, `founder_province`, `founder_barangay`, `founder_zipcode`, `informant_last_name`, `informant_first_name`, `informant_middle_name`, `informant_occupation`, `relationship_to_founder`, `informant_address`, `informant_contact`) VALUES
(1, '', '', '2024-09-16 19:13:59', '', '', '', 'ss', '', '', '', '', '', '', '', '', '', 'ss', 'ss'),
(2, 'renss', '', '2024-09-17 14:25:44', 'ss', 'ss', 'ss', 'ss', 'ss', 'ss', 'ss', 'ss', 'ss', 'ss', 'ss', 'ssss', '', '', 'ss');

-- --------------------------------------------------------

--
-- Table structure for table `marriage_registrations`
--

CREATE TABLE `marriage_registrations` (
  `id` int(11) NOT NULL,
  `registry_no` varchar(255) NOT NULL,
  `date_of_marriage` date NOT NULL,
  `place_of_marriage` varchar(255) NOT NULL,
  `citizenship` varchar(100) NOT NULL,
  `contact_no` varchar(100) NOT NULL,
  `husband_birth_ref_no` varchar(100) NOT NULL,
  `husband_tin` varchar(100) NOT NULL,
  `wife_birth_ref_no` varchar(100) NOT NULL,
  `wife_tin` varchar(100) NOT NULL,
  `founder_last_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marriage_registrations`
--

INSERT INTO `marriage_registrations` (`id`, `registry_no`, `date_of_marriage`, `place_of_marriage`, `citizenship`, `contact_no`, `husband_birth_ref_no`, `husband_tin`, `wife_birth_ref_no`, `wife_tin`, `founder_last_name`) VALUES
(3, 'ss', '2024-09-17', 'ss', 'ss', 'ss', 'ss', 'ss', 'ss', 'ss', 'ss');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'user', 'user', '2024-09-14 16:44:19', '2024-09-14 16:44:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `birth_registration`
--
ALTER TABLE `birth_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `death_info`
--
ALTER TABLE `death_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `live_births`
--
ALTER TABLE `live_births`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marriage_registrations`
--
ALTER TABLE `marriage_registrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `birth_registration`
--
ALTER TABLE `birth_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `death_info`
--
ALTER TABLE `death_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `live_births`
--
ALTER TABLE `live_births`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `marriage_registrations`
--
ALTER TABLE `marriage_registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
