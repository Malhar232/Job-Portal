-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 29, 2021 at 07:22 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id17368161_primathink`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `SrNo` int(255) NOT NULL,
  `AdminID` varchar(255) NOT NULL,
  `AdminName` varchar(255) NOT NULL,
  `AdminEmail` varchar(255) NOT NULL,
  `AdminPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`SrNo`, `AdminID`, `AdminName`, `AdminEmail`, `AdminPassword`) VALUES
(1, 'A1', 'Malhar', 'malhar19deshkar@gmail.com', '9aee390f19345028f03bb16c588550e1');

-- --------------------------------------------------------

--
-- Table structure for table `campusdrive`
--

CREATE TABLE `campusdrive` (
  `SrNo` int(255) NOT NULL,
  `CompanyName` varchar(255) NOT NULL,
  `CollegeName` varchar(255) NOT NULL,
  `Round1` varchar(255) NOT NULL,
  `Date1` date NOT NULL,
  `Round2` varchar(255) NOT NULL,
  `Date2` date NOT NULL,
  `Round3` varchar(255) NOT NULL,
  `Date3` date NOT NULL,
  `Round4` varchar(255) NOT NULL,
  `Date4` date NOT NULL,
  `Round5` varchar(255) NOT NULL,
  `Date5` date NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `campusdrive`
--

INSERT INTO `campusdrive` (`SrNo`, `CompanyName`, `CollegeName`, `Round1`, `Date1`, `Round2`, `Date2`, `Round3`, `Date3`, `Round4`, `Date4`, `Round5`, `Date5`, `Description`) VALUES
(25, 'Infosys', 'RCOEM', 'Aptitude', '2021-08-20', 'Technical Interview', '2021-08-09', 'HR', '2021-08-30', 'Managerial ', '2021-08-09', 'Medical ', '2021-08-28', 'NA');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `SrNo` int(255) NOT NULL,
  `CompanyID` varchar(255) NOT NULL,
  `CompanyName` varchar(255) NOT NULL,
  `CompanyDesc` varchar(1500) NOT NULL,
  `CompanyPic` varchar(500) NOT NULL,
  `TotalEmp` varchar(255) NOT NULL,
  `JobsAvailable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`SrNo`, `CompanyID`, `CompanyName`, `CompanyDesc`, `CompanyPic`, `TotalEmp`, `JobsAvailable`) VALUES
(18, 'C611fdde82b1cf', 'Infosys', 'Infosys Limited is an Indian multinational information technology company that provides business consulting, information technology and outsourcing services. The company was founded in Pune and is headquartered in Bangalore. ', '../uploads/CompanyPics/C611fdde82b1cf.png', '45045', 0),
(19, 'C611fde376a1e8', 'TCS', 'Tata Consultancy Services is an Indian multinational information technology services and consulting company headquartered in Mumbai, Maharashtra, India with its largest campus located in Chennai, Tamil Nadu, India. As of February 2021, TCS is the largest IT services company in the world by market capitalisation.', '../uploads/CompanyPics/C611fde376a1e8.png', '43571', 2);

-- --------------------------------------------------------

--
-- Table structure for table `jobapplications`
--

CREATE TABLE `jobapplications` (
  `SrNo` int(255) NOT NULL,
  `CompanyName` varchar(255) NOT NULL,
  `StudentName` varchar(255) NOT NULL,
  `StudentEmail` varchar(255) NOT NULL,
  `StudentCollege` varchar(255) NOT NULL,
  `ResumePath` text NOT NULL,
  `Post` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobapplications`
--

INSERT INTO `jobapplications` (`SrNo`, `CompanyName`, `StudentName`, `StudentEmail`, `StudentCollege`, `ResumePath`, `Post`, `Status`) VALUES
(1, 'Infosys', 'Daksh Sharma', 'daksh@gmail.com', 'VNIT', '../uploads/Resumes/Infosys/IMG-20210820-WA0016.jpg', 'Jr. Android Developer', 'selected'),
(2, 'Infosys', 'Daksh Sharma', 'daksh@gmail.com', 'Raisoni', '../uploads/Resumes/Infosys/IMG-20210820-WA0016.jpg', 'Jr. Android Developer', 'rejected'),
(3, 'Infosys', 'Daksh Sharma', 'daksh@gmail.com', 'YCCE', '../uploads/Resumes/Infosys/IMG-20210820-WA0016.jpg', 'Jr. Android Developer', 'rejected'),
(4, 'Infosys', 'Daksh Sharma', 'daksh@gmail.com', 'RCOEM', '../uploads/Resumes/Infosys/IMG-20210820-WA0016.jpg', 'Jr. Android Developer', 'selected'),
(5, 'Infosys', 'Sakshi Nakhate', 'sakshinakhate2000@gmail.com', 'RCOEM', '../uploads/Resumes/Infosys/Screenshot 2021-08-20 17.15.15.png', 'Sr. Android Developer', 'selected'),
(6, 'TCS', 'Shruti232', 'shruti@gmail.com', 'RCOEM', '../uploads/Resumes/TCS/Untitled.prproj', 'Project Manager', 'rejected'),
(7, 'TCS', 'Shruti232', 'shruti@gmail.com', 'RCOEM', '../uploads/Resumes/TCS/44_Malhar_Deshkar_Socket_Programming.pdf', 'Project Manager', 'rejected'),
(8, 'TCS', 'Shruti232', 'shruti@gmail.com', 'RCOEM', '../uploads/Resumes/TCS/FLAT (1).pdf', 'Project Manager', 'rejected');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `SrNo` int(255) NOT NULL,
  `JobName` varchar(255) NOT NULL,
  `CompanyName` varchar(255) NOT NULL,
  `Package` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`SrNo`, `JobName`, `CompanyName`, `Package`) VALUES
(126, 'Project Manager', 'TCS', '12'),
(127, 'Systems Engineer ', 'TCS', '8');

-- --------------------------------------------------------

--
-- Table structure for table `selectedstudents`
--

CREATE TABLE `selectedstudents` (
  `SrNo` int(255) NOT NULL,
  `CollegeName` varchar(255) NOT NULL,
  `CompanyName` varchar(255) NOT NULL,
  `StudentName` varchar(255) NOT NULL,
  `StudentEmail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `selectedstudents`
--

INSERT INTO `selectedstudents` (`SrNo`, `CollegeName`, `CompanyName`, `StudentName`, `StudentEmail`) VALUES
(9, 'VNIT', 'Infosys', 'Daksh Sharma', 'daksh@gmail.com'),
(10, 'RCOEM', 'Infosys', 'Sakshi Nakhate', 'sakshinakhate2000@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `SrNo` int(255) NOT NULL,
  `UUID` varchar(255) NOT NULL,
  `StudentName` varchar(255) NOT NULL,
  `StudentEmail` varchar(255) NOT NULL,
  `StudentPassword` varchar(255) NOT NULL,
  `StudentCollege` varchar(255) NOT NULL,
  `DOB` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`SrNo`, `UUID`, `StudentName`, `StudentEmail`, `StudentPassword`, `StudentCollege`, `DOB`) VALUES
(1, '610bb5fa70ed6', 'Maddy23', 'deshkarmm@rknec.edu', '9aee390f19345028f03bb16c588550e1', 'RCOEM', '2001-02-23'),
(2, '610bb670ab6bf', 'Sam', 'deshkarsampada@gmail.com', '9aee390f19345028f03bb16c588550e1', 'YCCE', '2017-06-01'),
(3, '610c252b8e992', 'Omkumar Patil', 'om@gmail.com', '9aee390f19345028f03bb16c588550e1', 'RCOEM', '2021-08-05'),
(4, '611130fc9e9db', 'Dinkar', 'dinkar@gmail.com', 'dc1b46ff41d23647c4e7ca839cfae0ba', 'RCOEM', '1997-05-23'),
(5, '611fdc10e3e69', 'Daksh Sharma', 'daksh@gmail.com', '9aee390f19345028f03bb16c588550e1', 'VNIT', '1997-06-01'),
(6, '6120a5d38bfde', 'Yash', 'yash@gmail.com', '9aee390f19345028f03bb16c588550e1', 'YCCE', '2001-06-01'),
(7, '6120bbabc856d', 'Sakshi Nakhate', 'sakshinakhate2000@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'RCOEM', '2000-08-04'),
(8, '61290af44d79a', 'Disha7181', 'disha@gmail.com', 'c4efd5020cb49b9d3257ffa0fbccc0ae', 'YCCE', '2001-02-23'),
(9, '61290bf63ff17', 'bittu', '', '9aee390f19345028f03bb16c588550e1', 'Raisoni', '2001-04-01'),
(10, '61290d119602c', '', 'sadeem@gmail.com', '9aee390f19345028f03bb16c588550e1', 'RCOEM', '2001-06-01'),
(11, '612b2a1b4823a', 'Shruti232', 'shruti@gmail.com', '9aee390f19345028f03bb16c588550e1', 'RCOEM', '2001-02-23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`SrNo`);

--
-- Indexes for table `campusdrive`
--
ALTER TABLE `campusdrive`
  ADD PRIMARY KEY (`SrNo`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`SrNo`);

--
-- Indexes for table `jobapplications`
--
ALTER TABLE `jobapplications`
  ADD PRIMARY KEY (`SrNo`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`SrNo`);

--
-- Indexes for table `selectedstudents`
--
ALTER TABLE `selectedstudents`
  ADD PRIMARY KEY (`SrNo`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`SrNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `SrNo` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `campusdrive`
--
ALTER TABLE `campusdrive`
  MODIFY `SrNo` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `SrNo` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `jobapplications`
--
ALTER TABLE `jobapplications`
  MODIFY `SrNo` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `SrNo` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `selectedstudents`
--
ALTER TABLE `selectedstudents`
  MODIFY `SrNo` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `SrNo` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
