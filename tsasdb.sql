-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2023 at 03:34 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tsasdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `AdminName` varchar(200) DEFAULT NULL,
  `UserName` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `AdminRegdate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'SuperAdmin', 'admin', 5689784592, 'admin@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2023-05-25 11:58:35');

-- --------------------------------------------------------

--
-- Table structure for table `tblcourse`
--

CREATE TABLE `tblcourse` (
  `ID` int(10) NOT NULL,
  `BranchName` varchar(200) DEFAULT NULL,
  `CourseName` varchar(200) DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcourse`
--

INSERT INTO `tblcourse` (`ID`, `BranchName`, `CourseName`, `CreationDate`) VALUES
(1, 'Information Technology', 'B.Tech', '2023-05-24 18:08:52'),
(2, 'Computer Science', 'B.Tech', '2023-05-24 18:08:52'),
(3, 'Electrical Engineering', 'B.Tech', '2023-05-24 18:08:52'),
(4, 'Electronics', 'B.Tech', '2023-05-24 18:08:52'),
(5, 'PCM', 'B.Sc', '2023-05-24 18:08:52'),
(6, 'ZCB', 'B.Tech', '2023-05-24 18:08:52'),
(7, 'English', 'B.Ed', '2023-05-24 18:08:52');

-- --------------------------------------------------------

--
-- Table structure for table `tblsuballocation`
--

CREATE TABLE `tblsuballocation` (
  `ID` int(5) NOT NULL,
  `CourseID` int(5) DEFAULT NULL,
  `Teacherempid` varchar(100) DEFAULT NULL,
  `Subid` int(5) DEFAULT NULL,
  `AllocationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblsuballocation`
--

INSERT INTO `tblsuballocation` (`ID`, `CourseID`, `Teacherempid`, `Subid`, `AllocationDate`) VALUES
(1, 1, 'EMP12345', 3, '2023-05-24 06:02:24'),
(2, 2, 'Emp102', 2, '2023-05-24 06:02:50'),
(3, 2, 'Emp102', 8, '2023-05-24 06:03:05'),
(4, 1, 'Emp101', 3, '2023-05-24 06:03:49'),
(5, 3, 'Emp103', 5, '2023-05-24 06:04:09');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubject`
--

CREATE TABLE `tblsubject` (
  `ID` int(5) NOT NULL,
  `CourseID` int(5) DEFAULT NULL,
  `SubjectFullname` varchar(200) DEFAULT NULL,
  `SubjectShortname` varchar(200) DEFAULT NULL,
  `SubjectCode` varchar(200) DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblsubject`
--

INSERT INTO `tblsubject` (`ID`, `CourseID`, `SubjectFullname`, `SubjectShortname`, `SubjectCode`, `CreationDate`) VALUES
(1, 1, 'Mathematics', 'Math', 'Math101', '2023-05-10 04:45:51'),
(2, 2, 'Operating System', 'OS', 'OS101', '2023-05-10 05:27:04'),
(3, 1, 'Digital Electronics', 'DE', 'DE101', '2023-05-10 05:28:05'),
(4, 3, 'Computer Communication Network', 'CCN', 'CCN101', '2023-05-10 05:28:55'),
(5, 3, 'Management Information Systems', 'MIS', 'MIS', '2023-05-10 05:29:25'),
(6, 4, 'Introduction to Microprocessor', 'ITM', 'ITM101', '2023-05-10 05:30:18'),
(7, 3, 'Relational Database Management System', 'RDBMS', 'RDBMS101', '2023-05-10 05:31:44'),
(8, 2, 'Artificial Intelligence', 'AI', 'AI102', '2023-05-10 05:32:28');

-- --------------------------------------------------------

--
-- Table structure for table `tblteacher`
--

CREATE TABLE `tblteacher` (
  `ID` int(10) NOT NULL,
  `EmpID` varchar(50) DEFAULT NULL,
  `FirstName` varchar(200) DEFAULT NULL,
  `LastName` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Gender` varchar(200) DEFAULT NULL,
  `Dob` varchar(200) DEFAULT NULL,
  `CourseID` int(5) DEFAULT NULL,
  `Religion` varchar(200) DEFAULT NULL,
  `Address` mediumtext DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `ProfilePic` varchar(200) DEFAULT NULL,
  `JoiningDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblteacher`
--

INSERT INTO `tblteacher` (`ID`, `EmpID`, `FirstName`, `LastName`, `MobileNumber`, `Email`, `Gender`, `Dob`, `CourseID`, `Religion`, `Address`, `Password`, `ProfilePic`, `JoiningDate`) VALUES
(1, 'Emp101', 'Test', 'Sample', 8956231478, 'kaushal@gmail.com', 'Male', '1984-01-05', 1, 'Hindu', 'J-125, Mohan Road Jakirpur Merrut', '202cb962ac59075b964b07152d234b70', '779b7513263ef185b6d094af290ef5401595083511.png', '2023-05-25 01:04:34'),
(2, 'Emp102', 'Sarita', 'Pandey', 4564877987, 'sar@gmail.com', 'Female', '1990-01-09', 2, 'Hindu', 'K-980', '202cb962ac59075b964b07152d234b70', 'e76de47f621d84adbab3266e3239baee1594385101.png', '2023-05-13 05:22:14'),
(3, 'Emp103', 'Test', 'Sample', 6544654654, 'test@gmail.com', 'Male', '1990-07-05', 3, 'Hindu', 'B-234 Nehru Nagar New Delhi', '202cb962ac59075b964b07152d234b70', '779b7513263ef185b6d094af290ef5401595247971.png', '2023-05-20 12:26:11'),
(4, 'EMP12345', 'Anuj', 'Kumar', 1234567890, 'ak@gmail.com', 'Male', '2019-04-02', 1, 'Indian', 'New Delhi India 110101', 'f925916e2754e5e03f75dd58a5733251', 'ea8f8a4ef2a9dbbb375c6f9adf0d35501684818674.jpg', '2023-05-23 05:11:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcourse`
--
ALTER TABLE `tblcourse`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblsuballocation`
--
ALTER TABLE `tblsuballocation`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblsubject`
--
ALTER TABLE `tblsubject`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblteacher`
--
ALTER TABLE `tblteacher`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblcourse`
--
ALTER TABLE `tblcourse`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblsuballocation`
--
ALTER TABLE `tblsuballocation`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblsubject`
--
ALTER TABLE `tblsubject`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblteacher`
--
ALTER TABLE `tblteacher`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
