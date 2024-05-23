-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 07:29 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mahoro_chany_online negotiation skills workshops platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `idNumber` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `martialstatus` varchar(20) NOT NULL,
  `DoB` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fname`, `lname`, `idNumber`, `phone`, `martialstatus`, `DoB`, `email`, `password`, `gender`) VALUES
(1, ' mahoro', 'chany', '1', '0789249406', 'Single', '2024-05-16', 'alexx@gamil.com', 'Mahoro@123', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `assessmentresults`
--

CREATE TABLE IF NOT EXISTS `assessmentresults` (
  `ResultID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `AssessmentDate` date DEFAULT NULL,
  `AssessmentScore` decimal(5,2) DEFAULT NULL,
  `Strengths` text,
  `Weaknesses` text,
  `Recommendations` text,
  PRIMARY KEY (`ResultID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assessmentresults`
--

INSERT INTO `assessmentresults` (`ResultID`, `UserID`, `AssessmentDate`, `AssessmentScore`, `Strengths`, `Weaknesses`, `Recommendations`) VALUES
(1, 1, '2024-05-20', 85.50, 'Strong analytical skills', 'Needs improvement in active listening', 'Practice active listening techniques during negotiations.');

-- --------------------------------------------------------

--
-- Table structure for table `attendees`
--

CREATE TABLE IF NOT EXISTS `attendees` (
  `AttendeeID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `WorkshopID` int(11) DEFAULT NULL,
  `AttendanceStatus` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`AttendeeID`),
  KEY `UserID` (`UserID`),
  KEY `WorkshopID` (`WorkshopID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendees`
--

INSERT INTO `attendees` (`AttendeeID`, `UserID`, `WorkshopID`, `AttendanceStatus`) VALUES
(1, 1, 1, 'Attended'),
(2, 2, 1, 'Attended'),
(3, 3, 2, 'registered');

-- --------------------------------------------------------

--
-- Table structure for table `certificationachievements`
--

CREATE TABLE IF NOT EXISTS `certificationachievements` (
  `CertificationID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `CertificationName` varchar(255) DEFAULT NULL,
  `DateAchieved` date DEFAULT NULL,
  PRIMARY KEY (`CertificationID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `certificationachievements`
--

INSERT INTO `certificationachievements` (`CertificationID`, `UserID`, `CertificationName`, `DateAchieved`) VALUES
(1, 1, 'Certified Negotiation Professional', '2024-05-25');

-- --------------------------------------------------------

--
-- Table structure for table `communityengagement`
--

CREATE TABLE IF NOT EXISTS `communityengagement` (
  `EngagementID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Topic` varchar(255) DEFAULT NULL,
  `Thread` text,
  `Comments` text,
  `Likes` int(11) DEFAULT NULL,
  `Replies` int(11) DEFAULT NULL,
  `Timestamp` datetime DEFAULT NULL,
  PRIMARY KEY (`EngagementID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `communityengagement`
--

INSERT INTO `communityengagement` (`EngagementID`, `UserID`, `Topic`, `Thread`, `Comments`, `Likes`, `Replies`, `Timestamp`) VALUES
(1, 1, 'Negotiation Tips', 'How do you handle difficult negotiators?', 'I usually try to find common ground and focus on win-win solutions.', 10, 5, '2024-05-21 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `feedbackevaluation`
--

CREATE TABLE IF NOT EXISTS `feedbackevaluation` (
  `FeedbackID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `WorkshopID` int(11) DEFAULT NULL,
  `Rating` decimal(3,2) DEFAULT NULL,
  `Comments` text,
  `Suggestions` text,
  `Timestamp` datetime DEFAULT NULL,
  PRIMARY KEY (`FeedbackID`),
  KEY `UserID` (`UserID`),
  KEY `WorkshopID` (`WorkshopID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedbackevaluation`
--

INSERT INTO `feedbackevaluation` (`FeedbackID`, `UserID`, `WorkshopID`, `Rating`, `Comments`, `Suggestions`, `Timestamp`) VALUES
(1, 1, 1, 4.50, 'The workshop was excellent, learned a lot from the instructor.', 'Would like more interactive activities.', '2024-05-22 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE IF NOT EXISTS `instructors` (
  `InstructorID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `ExpertiseArea` varchar(255) DEFAULT NULL,
  `Bio` text,
  PRIMARY KEY (`InstructorID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`InstructorID`, `UserID`, `ExpertiseArea`, `Bio`) VALUES
(1, 1, 'Negotiation Strategies', 'John Doe is an experienced negotiator with over 10 years of experience in international business negotiations.'),
(2, 2, 'Conflict Resolution', 'Jane Smith specializes in conflict resolution techniques and has conducted workshops for various organizations.');

-- --------------------------------------------------------

--
-- Table structure for table `negotiationresources`
--

CREATE TABLE IF NOT EXISTS `negotiationresources` (
  `ResourceID` int(11) NOT NULL,
  `ResourceTitle` varchar(255) DEFAULT NULL,
  `ResourceType` varchar(50) DEFAULT NULL,
  `Description` text,
  `Link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ResourceID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `negotiationresources`
--

INSERT INTO `negotiationresources` (`ResourceID`, `ResourceTitle`, `ResourceType`, `Description`, `Link`) VALUES
(1, 'Negotiation Skills Handbook', 'Book', 'Comprehensive guide covering negotiation techniques and strategies.', 'https://example.com/negotiation-handbook'),
(2, 'Effective Negotiation Videos', 'Video', 'Series of video tutorials demonstrating effective negotiation skills in action.', 'https://example.com/negotiation-videos');

-- --------------------------------------------------------

--
-- Table structure for table `progresstracking`
--

CREATE TABLE IF NOT EXISTS `progresstracking` (
  `ProgressID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `WorkshopID` int(11) DEFAULT NULL,
  `ModuleCompleted` varchar(255) DEFAULT NULL,
  `QuizScores` decimal(5,2) DEFAULT NULL,
  `TimeSpent` int(11) DEFAULT NULL,
  `Comments` text,
  PRIMARY KEY (`ProgressID`),
  KEY `UserID` (`UserID`),
  KEY `WorkshopID` (`WorkshopID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `progresstracking`
--

INSERT INTO `progresstracking` (`ProgressID`, `UserID`, `WorkshopID`, `ModuleCompleted`, `QuizScores`, `TimeSpent`, `Comments`) VALUES
(1, 1, 1, 'Module 1', 90.00, 60, 'Great workshop! Learned a lot about negotiation strategies.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `UserType` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Email`, `Password`, `UserType`) VALUES
(1, 'john_doe', 'john@gmail.com', 'password123', 'Regular'),
(2, 'jane_smith', 'jane@gmail.com', 'password456', 'Regular'),
(3, 'jane_angela', 'jane@gmail.com', 'password1234', 'regular');

-- --------------------------------------------------------

--
-- Table structure for table `workshops`
--

CREATE TABLE IF NOT EXISTS `workshops` (
  `WorkshopID` int(11) NOT NULL,
  `WorkshopTitle` varchar(255) DEFAULT NULL,
  `Description` text,
  `InstructorID` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Duration` int(11) DEFAULT NULL,
  PRIMARY KEY (`WorkshopID`),
  KEY `InstructorID` (`InstructorID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workshops`
--

INSERT INTO `workshops` (`WorkshopID`, `WorkshopTitle`, `Description`, `InstructorID`, `Date`, `Duration`) VALUES
(1, 'Advanced Negotiation Techniques', 'This workshop covers advanced negotiation strategies and tactics for complex business scenarios.', 1, '2024-05-15', 120),
(2, 'Effective Communication in Negotiation', 'Learn how to communicate effectively during negotiations to achieve win-win outcomes.', 2, '2024-06-01', 90);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assessmentresults`
--
ALTER TABLE `assessmentresults`
  ADD CONSTRAINT `assessmentresults_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `attendees`
--
ALTER TABLE `attendees`
  ADD CONSTRAINT `attendees_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `attendees_ibfk_2` FOREIGN KEY (`WorkshopID`) REFERENCES `workshops` (`WorkshopID`);

--
-- Constraints for table `certificationachievements`
--
ALTER TABLE `certificationachievements`
  ADD CONSTRAINT `certificationachievements_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `communityengagement`
--
ALTER TABLE `communityengagement`
  ADD CONSTRAINT `communityengagement_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `feedbackevaluation`
--
ALTER TABLE `feedbackevaluation`
  ADD CONSTRAINT `feedbackevaluation_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `feedbackevaluation_ibfk_2` FOREIGN KEY (`WorkshopID`) REFERENCES `workshops` (`WorkshopID`);

--
-- Constraints for table `instructors`
--
ALTER TABLE `instructors`
  ADD CONSTRAINT `instructors_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `progresstracking`
--
ALTER TABLE `progresstracking`
  ADD CONSTRAINT `progresstracking_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `progresstracking_ibfk_2` FOREIGN KEY (`WorkshopID`) REFERENCES `workshops` (`WorkshopID`);

--
-- Constraints for table `workshops`
--
ALTER TABLE `workshops`
  ADD CONSTRAINT `workshops_ibfk_1` FOREIGN KEY (`InstructorID`) REFERENCES `instructors` (`InstructorID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
