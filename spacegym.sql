-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2016 at 08:28 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spacegym`
--

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE `exercises` (
  `id` int(11) NOT NULL,
  `muscle_name` varchar(20) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `name` varchar(40) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `en_name` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`id`, `muscle_name`, `name`, `en_name`) VALUES
(1, 'גב', 'פולי עליון', 'Front pulldown'),
(2, 'גב', 'מתח', 'Pull-up'),
(3, 'יד קדמית', 'כפיפת מרפקים עם משקולית יד', 'Curl'),
(4, 'גב', 'חתירה ביד אחת בהטיית גב', 'Bent-over row'),
(5, 'גב', 'משיכה עילית בזרועות כפופות בשכיבה', 'Pullover'),
(6, 'גב', 'חתירה בישיבה בכבל', 'Cable seated row'),
(7, 'גב', ' חתירה כנגד מוט בהטיית גוף', 'bent-over Row'),
(10, 'יד קדמית', 'כפיפת מרפקים עם כבל', 'Cable curl'),
(11, 'יד קדמית', 'כפיפת מרפקים עם כבל בשכיבה', 'Cable supine curl'),
(12, 'בטן', 'הרמת רגליים בתלייה', 'hanging leg-hip raise'),
(13, 'בטן', 'כפיפת גב הצידה', 'Side bent'),
(14, 'בטן', 'עלייה משכיבה לישיבה', 'sit-up'),
(15, 'בטן', 'הרמת רגליים', 'Straight leg-hip raise'),
(17, 'יד אחורית', 'אחיזה צרה בדחיקה', 'Close grip bench press'),
(18, 'יד אחורית', 'פשיטת מרפקים כנגד מוט בשכיבה', 'Lying triceps extension'),
(19, 'יד אחורית', 'ירידה בספסל', 'Bench dip'),
(20, 'יד אחורית', 'פשיטת מרפקים כנגד פולי עליון לפנים', 'Cable pushdown'),
(21, 'חזה', 'לחיצת חזה בשכיבה במוט', 'Bench press'),
(22, 'חזה', 'לחיצת חזה עם משקולות יד בשכיבה', 'Bench press '),
(23, 'חזה', 'שכיבות שמיכה', 'Push-ups'),
(24, 'רגליים', 'לחיצת רגליים', 'Seated leg-pess'),
(25, 'רגליים', 'פשיטת ברכיים', 'Lever leg extension'),
(26, 'רגליים', 'כפיפת ברכיים', 'Lying leg curl'),
(27, 'כתפיים', 'לחיצת כתפיים', 'Shoulder press'),
(28, 'כתפיים', 'חתירה בעמידה', 'upright row'),
(29, 'כתפיים', 'הרמה מלפנים', 'Front raise'),
(30, 'כתפיים', 'הרחקת משקולות לצדדים', 'Lateral raise');

-- --------------------------------------------------------

--
-- Table structure for table `lesson`
--

CREATE TABLE `lesson` (
  `id` int(11) NOT NULL,
  `studio_id` int(11) NOT NULL,
  `day` varchar(14) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `time` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lesson`
--

INSERT INTO `lesson` (`id`, `studio_id`, `day`, `time`) VALUES
(1, 1, 'ראשון', '17:00'),
(2, 1, 'רביעי', '13:00'),
(3, 1, 'שבת', '18:00'),
(4, 2, 'ראשון', '17:00'),
(5, 2, 'חמישי', '17:00'),
(6, 3, 'ראשון', '17:00'),
(7, 3, 'שני', '20:00'),
(8, 3, 'רביעי', '20:00'),
(9, 4, 'ראשון', '07:00'),
(10, 4, 'רביעי', '07:00'),
(11, 5, 'שני', '07:00'),
(12, 5, 'חמישי', '07:00'),
(13, 6, 'ראשון', '13:00'),
(14, 6, 'שני', '15:00'),
(21, 12, 'רביעי', '20:00'),
(22, 12, 'שבת', '17:00'),
(23, 13, 'שני', '07:00');

-- --------------------------------------------------------

--
-- Table structure for table `mangers`
--

CREATE TABLE `mangers` (
  `id` bigint(9) UNSIGNED NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `userName` varchar(16) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mangers`
--

INSERT INTO `mangers` (`id`, `firstName`, `lastName`, `userName`, `password`) VALUES
(201643202, 'אלירן', 'אבוחצירה', 'eliran1989', '26705b94b245df321834a0bf1ac7c5a4');

-- --------------------------------------------------------

--
-- Table structure for table `muscles`
--

CREATE TABLE `muscles` (
  `name` varchar(20) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `muscles`
--

INSERT INTO `muscles` (`name`) VALUES
('בטן'),
('גב'),
('חזה'),
('יד אחורית'),
('יד קדמית'),
('כתפיים'),
('רגליים');

-- --------------------------------------------------------

--
-- Table structure for table `studio_cat`
--

CREATE TABLE `studio_cat` (
  `id` int(11) NOT NULL,
  `name` varchar(13) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studio_cat`
--

INSERT INTO `studio_cat` (`id`, `name`) VALUES
(1, 'אירובי'),
(2, 'חיטוב'),
(3, 'ספורט וכושר');

-- --------------------------------------------------------

--
-- Table structure for table `studio_lessons`
--

CREATE TABLE `studio_lessons` (
  `id` int(11) NOT NULL,
  `trainer_id` bigint(20) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `lesson_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studio_lessons`
--

INSERT INTO `studio_lessons` (`id`, `trainer_id`, `cat_id`, `lesson_name`) VALUES
(1, 61917753, 3, 'TRX'),
(2, 61917753, 1, 'ספינינג'),
(3, 2016432022, 2, 'מתיחות'),
(4, 61917753, 1, 'ריצה'),
(5, 61917753, 2, 'זומבה'),
(6, 61917753, 1, 'שחייה'),
(12, 61917753, 1, 'יוגה'),
(13, 2016432022, 3, 'סתם שיעור');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `number` int(11) NOT NULL,
  `id` bigint(9) UNSIGNED NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `userName` varchar(16) NOT NULL,
  `birthDate` varchar(16) NOT NULL,
  `sex` varchar(1) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `address` varchar(16) NOT NULL,
  `email` varchar(30) NOT NULL,
  `dateStart` varchar(16) NOT NULL,
  `dateEnd` varchar(16) NOT NULL,
  `password` varchar(50) NOT NULL,
  `pass_change` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`number`, `id`, `firstName`, `lastName`, `userName`, `birthDate`, `sex`, `phone`, `address`, `email`, `dateStart`, `dateEnd`, `password`, `pass_change`) VALUES
(1, 201643202, 'אלירן', 'אבוחצירה', '', '27-06-1989', 'ז', '0503265300', 'השונית 2', 'elirana1989@gmail.com', '2016-09-11', '2016-12-11', '16f4aa925ab4a70a9ef481c1796dab06', 0),
(2, 459489498, 'ליטל', 'ממן', '', '11-09-2002', 'נ', '0503265300', 'השונית 2', 'elirana1989@gmail.com', '2016-11-11', '2017-02-11', '3f309a061f962850b0df4282a1cfdc67', 0),
(3, 544894894, 'ישראל', 'ישראלי', '', '11-09-2002', 'ז', '0503265300', 'השונית 2', 'elirana1989@gmail.com', '2016-11-19', '2017-02-19', 'ce9ec3feeade16e809cb1a57c4a55f77', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subs_studios`
--

CREATE TABLE `subs_studios` (
  `subId` int(11) NOT NULL,
  `studioId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subs_studios`
--

INSERT INTO `subs_studios` (`subId`, `studioId`) VALUES
(201643202, 2),
(201643202, 3),
(201643202, 1);

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `id` bigint(9) UNSIGNED NOT NULL,
  `firstName` varchar(30) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `lastName` varchar(30) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `userName` varchar(16) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `password` varchar(50) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`id`, `firstName`, `lastName`, `userName`, `password`) VALUES
(2016432022, 'ישראל', 'ישראלי', 'trainer', 'd5486e2c5a67a08d0a792e6241232063'),
(61917753, 'משה ', 'אברהם', 'moshe', 'd5486e2c5a67a08d0a792e6241232063');

-- --------------------------------------------------------

--
-- Table structure for table `training_letter`
--

CREATE TABLE `training_letter` (
  `id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `letter` varchar(1) NOT NULL,
  `muscle` varchar(20) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `exercise` varchar(40) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `sets` int(11) NOT NULL,
  `repeats` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `training_letter`
--

INSERT INTO `training_letter` (`id`, `program_id`, `letter`, `muscle`, `exercise`, `sets`, `repeats`) VALUES
(195, 1, 'A', 'יד אחורית', 'אחיזה צרה בדחיקה', 3, 15),
(196, 1, 'B', 'יד אחורית', 'אחיזה צרה בדחיקה', 3, 12);

-- --------------------------------------------------------

--
-- Table structure for table `training_programs`
--

CREATE TABLE `training_programs` (
  `program_id` int(11) NOT NULL,
  `sub_id` bigint(20) NOT NULL,
  `type` varchar(4) CHARACTER SET latin1 NOT NULL,
  `purpose` varchar(15) COLLATE utf16_bin NOT NULL,
  `date_create` date NOT NULL,
  `date_end` date NOT NULL,
  `program_length` int(11) NOT NULL,
  `note` longtext COLLATE utf16_bin NOT NULL,
  `create_by` varchar(30) COLLATE utf16_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `training_programs`
--

INSERT INTO `training_programs` (`program_id`, `sub_id`, `type`, `purpose`, `date_create`, `date_end`, `program_length`, `note`, `create_by`) VALUES
(1, 201643202, 'AB', 'חיטוב', '2016-07-31', '2016-10-01', 2, '', 'ישראל ישראלי');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `muscle_name` (`muscle_name`);

--
-- Indexes for table `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mangers`
--
ALTER TABLE `mangers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `muscles`
--
ALTER TABLE `muscles`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `studio_cat`
--
ALTER TABLE `studio_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studio_lessons`
--
ALTER TABLE `studio_lessons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`);

--
-- Indexes for table `subs_studios`
--
ALTER TABLE `subs_studios`
  ADD KEY `studioId` (`studioId`),
  ADD KEY `subId` (`subId`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_letter`
--
ALTER TABLE `training_letter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_programs`
--
ALTER TABLE `training_programs`
  ADD PRIMARY KEY (`program_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `studio_cat`
--
ALTER TABLE `studio_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `studio_lessons`
--
ALTER TABLE `studio_lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `training_letter`
--
ALTER TABLE `training_letter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;
--
-- AUTO_INCREMENT for table `training_programs`
--
ALTER TABLE `training_programs`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
