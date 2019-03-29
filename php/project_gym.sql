-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2019 at 10:12 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_gym`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `MemberId` int(11) UNSIGNED NOT NULL,
  `MemberType` tinyint(1) NOT NULL DEFAULT '2',
  `MemberName` varchar(40) NOT NULL,
  `MemberEmailId` varchar(60) NOT NULL,
  `MembePhone` varchar(10) NOT NULL,
  `MemberGender` tinyint(1) NOT NULL DEFAULT '1',
  `MemberDob` date NOT NULL,
  `MemberJoiningDate` date NOT NULL,
  `MemberPassword` varchar(100) NOT NULL,
  `MemberAddress` text,
  `MemberActiveStatus` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`MemberId`, `MemberType`, `MemberName`, `MemberEmailId`, `MembePhone`, `MemberGender`, `MemberDob`, `MemberJoiningDate`, `MemberPassword`, `MemberAddress`, `MemberActiveStatus`, `created`) VALUES
(1, 1, 'Administrator', 'yogeshshakya1990@gmail.com', '9716350376', 1, '2019-03-29', '2019-03-29', '7c4a8d09ca3762af61e59520943dc26494f8941b', NULL, 1, '2019-03-29 02:06:07'),
(2, 2, 'Isha', 'isha@gg.cc', '0971635037', 2, '2011-01-25', '0000-00-00', '7c4a8d09ca3762af61e59520943dc26494f8941b', '4th floor, 4F-CS-17, Ansal Plaza, Vaishali, Ghaziabad - 201010', 1, '2019-03-29 20:00:16'),
(3, 2, 'Ashish', 'ashish@gmail.com', '9716350374', 1, '0000-00-00', '0000-00-00', '7c4a8d09ca3762af61e59520943dc26494f8941b', NULL, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) UNSIGNED NOT NULL,
  `memberid` int(11) UNSIGNED NOT NULL,
  `title` varchar(40) NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `memberid`, `title`, `message`, `status`, `created`) VALUES
(1, 2, 'Test Message', 'cvbnm', 1, '2019-03-29 21:12:25');

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `PlanId` int(11) UNSIGNED NOT NULL,
  `PlanName` varchar(40) NOT NULL,
  `PlanPrice` decimal(10,0) NOT NULL,
  `discount` decimal(10,0) NOT NULL,
  `PlanDuration` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`PlanId`, `PlanName`, `PlanPrice`, `discount`, `PlanDuration`, `status`, `created`) VALUES
(1, 'Plan 1', '2000', '0', 60, 1, '2019-03-29 19:13:43'),
(2, 'Plan 2', '20', '0', 50, 1, '2019-03-29 19:19:24');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `slots`
--

CREATE TABLE `slots` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `SlotStartTiming` time NOT NULL,
  `SlotEndTiming` time NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slots`
--

INSERT INTO `slots` (`id`, `name`, `SlotStartTiming`, `SlotEndTiming`, `status`, `created`) VALUES
(1, 'Slot 1', '04:00:00', '10:00:00', 1, '2019-03-29 19:30:28');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `SubscriptionId` int(11) UNSIGNED NOT NULL,
  `MemberId` int(11) NOT NULL,
  `SlotId` int(11) NOT NULL,
  `PlanID` int(11) NOT NULL,
  `DateStart` date NOT NULL,
  `DateEnd` date NOT NULL,
  `Amount` decimal(10,0) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`SubscriptionId`, `MemberId`, `SlotId`, `PlanID`, `DateStart`, `DateEnd`, `Amount`, `status`, `created`) VALUES
(1, 2, 1, 2, '2019-03-29', '2019-05-18', '20', 1, '2019-03-29 20:56:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`MemberId`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`PlanId`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slots`
--
ALTER TABLE `slots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`SubscriptionId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `MemberId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `PlanId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slots`
--
ALTER TABLE `slots`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `SubscriptionId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
