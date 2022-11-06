-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2022 at 05:09 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zozzso-online-study`
--

-- --------------------------------------------------------

--
-- Table structure for table `zozzso-online-study_codes`
--

CREATE TABLE `zozzso-online-study_codes` (
  `Codes_ID` int(11) NOT NULL,
  `Codes_Code` varchar(5) NOT NULL,
  `Codes_ClassName` varchar(12) NOT NULL,
  `Codes_AddTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zozzso-online-study_codes`
--

INSERT INTO `zozzso-online-study_codes` (`Codes_ID`, `Codes_Code`, `Codes_ClassName`, `Codes_AddTime`) VALUES
(1, '10511', '5-А КЛАС', '2022-10-15 22:24:25'),
(2, '10522', '5-Б КЛАС', '2022-10-15 22:24:25'),
(3, '10533', '5-В КЛАС', '2022-10-15 22:25:29'),
(4, '05041', '6-А КЛАС', '2022-10-15 22:25:29'),
(5, '05042', '6-Б КЛАС', '2022-10-15 22:25:53'),
(6, '06041', '7-А КЛАС', '2022-10-15 22:25:53'),
(7, '06042', '7-Б КЛАС', '2022-10-15 22:26:43'),
(8, '07031', '8-А КЛАС', '2022-10-15 22:26:43'),
(9, '07032', '8-Б КЛАС', '2022-10-15 22:27:08'),
(10, '07033', '8-В КЛАС', '2022-10-15 22:27:08'),
(11, '08031', '9-А КЛАС', '2022-10-15 22:27:42'),
(12, '08203', '9-Б КЛАС', '2022-10-15 22:27:42'),
(13, '09031', '10-А КЛАС', '2022-10-15 22:28:12'),
(14, '09042', '10-Б КЛАС', '2022-10-15 22:28:12'),
(15, '10031', '11-А КЛАС', '2022-10-15 22:28:45'),
(16, '10042', '11-Б КЛАС', '2022-10-15 22:28:45'),
(17, '71089', 'Адмін Панель', '2022-10-15 22:31:00');

-- --------------------------------------------------------

--
-- Table structure for table `zozzso-online-study_config`
--

CREATE TABLE `zozzso-online-study_config` (
  `Config_ID` int(11) NOT NULL,
  `Config_Name` varchar(50) NOT NULL,
  `Config_Value` varchar(255) NOT NULL,
  `Config_AddTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zozzso-online-study_config`
--

INSERT INTO `zozzso-online-study_config` (`Config_ID`, `Config_Name`, `Config_Value`, `Config_AddTime`) VALUES
(1, 'Title', 'Онлайн Навчання в ЗОЗЗСО', '2022-10-14 20:50:51'),
(2, 'Description', 'Ти не можеш зайти на конференцію вчителя в ZOOM? Тоді гайда сюди, просто введи свій код доступу і продовжуй навчатися!', '2022-10-14 20:58:55'),
(3, 'BtnRedirectTo', 'Перейти в Zoom', '2022-10-26 18:31:22');

-- --------------------------------------------------------

--
-- Table structure for table `zozzso-online-study_lessons`
--

CREATE TABLE `zozzso-online-study_lessons` (
  `Lessons_ID` int(11) NOT NULL,
  `Lessons_Name` varchar(40) NOT NULL,
  `Lessons_AddTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zozzso-online-study_lessons`
--

INSERT INTO `zozzso-online-study_lessons` (`Lessons_ID`, `Lessons_Name`, `Lessons_AddTime`) VALUES
(1, 'МАТЕМАТИКА', '2022-10-20 16:05:12'),
(2, 'УКРАЇНСЬКА МОВА', '2022-10-20 16:05:12'),
(3, 'УКРАЇНСЬКА ЛІТЕРАТУРА', '2022-10-20 16:08:52'),
(4, 'ІНФОРМАТИКА', '2022-10-20 16:08:52'),
(5, 'МИСТЕЦТВО', '2022-10-20 19:55:16'),
(6, 'ФІЗИЧНА КУЛЬТУРА', '2022-10-20 21:16:37'),
(7, 'ВСЕСВІТНЯ ІСТОРІЯ', '2022-10-20 21:17:00'),
(8, 'ІСТОРІЯ', '2022-10-20 21:17:09'),
(9, 'ОСНОВИ ХРИСТИЯНСЬКОЇ ЕТИКИ', '2022-10-31 15:16:17'),
(10, 'ГЕОГРАФІЯ', '2022-11-01 10:26:07'),
(11, 'ІСТОРІЯ УКРАЇНИ', '2022-11-06 09:16:11'),
(12, 'ФІЗИКА', '2022-11-06 09:16:21'),
(13, 'ГЕОГРАФІЯ КУЛЬТУРИ УКРАЇНИ', '2022-11-06 09:16:44'),
(14, 'ЗАРУБІЖНА ЛІТЕРАТУРА', '2022-11-06 09:17:09'),
(15, 'БІОЛОГІЯ', '2022-11-06 09:17:41'),
(16, 'АНГЛІЙСЬКА МОВА', '2022-11-06 09:17:49'),
(17, 'ХІМІЯ', '2022-11-06 09:17:55'),
(18, 'ЕКОЛОГІЯ', '2022-11-06 09:18:19');

-- --------------------------------------------------------

--
-- Table structure for table `zozzso-online-study_roles`
--

CREATE TABLE `zozzso-online-study_roles` (
  `Roles_ID` int(11) NOT NULL,
  `Roles_CodeId` int(11) NOT NULL,
  `Roles_Role` varchar(10) NOT NULL,
  `Roles_AddTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zozzso-online-study_roles`
--

INSERT INTO `zozzso-online-study_roles` (`Roles_ID`, `Roles_CodeId`, `Roles_Role`, `Roles_AddTime`) VALUES
(1, 17, 'Admin', '2022-10-17 20:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `zozzso-online-study_schedule`
--

CREATE TABLE `zozzso-online-study_schedule` (
  `schedule_ID` int(11) NOT NULL,
  `schedule_Number` int(2) NOT NULL,
  `schedule_StartTime` varchar(5) NOT NULL,
  `schedule_EndTime` varchar(5) NOT NULL,
  `schedule_AddTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zozzso-online-study_schedule`
--

INSERT INTO `zozzso-online-study_schedule` (`schedule_ID`, `schedule_Number`, `schedule_StartTime`, `schedule_EndTime`, `schedule_AddTime`) VALUES
(1, 1, '09:00', '09:30', '2022-10-16 11:12:53'),
(2, 2, '09:45', '10:15', '2022-10-16 11:14:27'),
(3, 3, '10:30', '11:00', '2022-10-16 11:14:44'),
(4, 4, '11:15', '11:45', '2022-10-16 11:15:09'),
(5, 5, '12:00', '12:30', '2022-10-16 11:15:09'),
(6, 6, '12:45', '13:15', '2022-10-16 11:15:42'),
(7, 7, '13:30', '14:00', '2022-10-16 11:15:42');

-- --------------------------------------------------------

--
-- Table structure for table `zozzso-online-study_schedulelessons`
--

CREATE TABLE `zozzso-online-study_schedulelessons` (
  `ScheduleLessons_ID` int(11) NOT NULL,
  `ScheduleLessons_ClassID` int(2) NOT NULL,
  `ScheduleLessons_Day` int(1) NOT NULL,
  `ScheduleLessons_LessonNumber` int(1) NOT NULL,
  `ScheduleLessons_LessonID` varchar(5) NOT NULL,
  `ScheduleLessons_TeacherID` varchar(11) NOT NULL,
  `ScheduleLessons_AddTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zozzso-online-study_schedulelessons`
--

INSERT INTO `zozzso-online-study_schedulelessons` (`ScheduleLessons_ID`, `ScheduleLessons_ClassID`, `ScheduleLessons_Day`, `ScheduleLessons_LessonNumber`, `ScheduleLessons_LessonID`, `ScheduleLessons_TeacherID`, `ScheduleLessons_AddTime`) VALUES
(1, 15, 1, 1, '11,0', '25,0,0,0', '2022-10-20 16:22:59'),
(2, 15, 3, 6, '4,5', '8,0,5,0', '2022-10-20 19:55:45'),
(3, 15, 3, 1, '6,0', '7,0,0,0', '2022-10-20 21:18:08'),
(4, 15, 3, 2, '1,0', '6,0,0,0', '2022-10-20 21:18:27'),
(5, 15, 3, 3, '2,0', '14,0,0,0', '2022-10-22 10:33:51'),
(6, 15, 3, 4, '7,0', '25,0,0,0', '2022-10-22 10:33:51'),
(7, 15, 3, 5, '4,0', '8,0,0,0', '2022-10-22 10:34:44'),
(8, 15, 3, 7, '8,0', '25,0,0,0', '2022-10-22 10:34:44'),
(9, 15, 2, 2, '5', '5,0,0,0', '2022-11-05 21:09:25'),
(10, 15, 1, 2, '12,0', '2,0,0,0', '2022-11-06 09:23:39'),
(11, 15, 1, 3, '12,0', '2,0,0,0', '2022-11-06 09:23:39'),
(12, 15, 5, 1, '1,0', '6,0,0,0', '2022-11-06 09:58:57'),
(13, 15, 5, 2, '4,5', '8,9,5,0', '2022-11-06 09:58:57');

-- --------------------------------------------------------

--
-- Table structure for table `zozzso-online-study_teachers`
--

CREATE TABLE `zozzso-online-study_teachers` (
  `Teachers_ID` int(11) NOT NULL,
  `Teachers_Name` varchar(50) NOT NULL,
  `Teachers_Link` varchar(100) NOT NULL,
  `Teachers_AddTime` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zozzso-online-study_teachers`
--

INSERT INTO `zozzso-online-study_teachers` (`Teachers_ID`, `Teachers_Name`, `Teachers_Link`, `Teachers_AddTime`) VALUES
(1, 'НЕДОСТУПНО', '', '2022-10-20 16:12:37'),
(2, 'Ілюк Катерина Валентинівна', 'https://us05web.zoom.us/j/6589970070?pwd=Vlp3dTU3ayt5eTNtTGpYSkhOTGU5dz09', '2022-10-20 16:14:04'),
(3, 'Галяра Юрій Дмитрович', 'https://us04web.zoom.us/j/3503532115?pwd=MWVXL1FRR3VtRHlxSjYrbFNKRGdjUT09', '2022-10-20 16:14:04'),
(4, 'Мартинюк Світлана Василівна', 'https://us05web.zoom.us/j/3265057462?pwd=WEc4L1huMUZkU1JJdnVqU2JVa21XUT09', '2022-10-20 19:22:43'),
(5, 'Палагнюк Тетяна Іванівна', 'https://us04web.zoom.us/j/5161188905?pwd=OFpHL1E3Zml3a3cxVlhzczhPYXhuUT09', '2022-10-20 19:22:43'),
(6, 'Агатій Тамара Василівна', 'https://us04web.zoom.us/j/9054859091?pwd=a0pNakRjbzdlbHAzbE5tai9NczBEUT09', '2022-10-20 19:23:07'),
(7, 'Ткач Василь Васильович', 'https://us05web.zoom.us/j/3673705968?pwd=cTZwZ3JpOGduNUQ2OGZuSE5SWGduZz09', '2022-10-20 19:23:07'),
(8, 'Малинник Василь Васильович', 'https://us04web.zoom.us/j/8010710853?pwd=eGs1OGlXUUZSeVUwNjA2NG5nRVg1UT09', '2022-10-20 19:23:38'),
(9, 'Баланецький Віктор Петрович', 'https://us04web.zoom.us/j/9282320929?pwd=SEcyNjNKWmFWVHNPV0dXL0sxdVB5Zz09', '2022-10-20 19:23:38'),
(10, 'Дарійчук Людмила Василівна', 'https://us04web.zoom.us/j/2438672024?pwd=UDdURjhjRSttdnlJVHBVeWJxZml4Zz09', '2022-10-20 19:26:28'),
(11, 'Агатій Володимир Володимирович', 'https://us05web.zoom.us/j/8895427841?pwd=TjVETTBFbFU2c2J4d1ZPdHVLcFU4dz09', '2022-10-20 19:26:28'),
(12, 'Масло Тетяна Олексіївна', 'https://us04web.zoom.us/j/6902500564?pwd=QzJkalg5ZkFEY0luVkdVVFh6eUNWdz09', '2022-10-20 19:27:20'),
(13, 'Ганич Дмитро Васильович', 'https://us05web.zoom.us/j/5344642693?pwd=SUdROFpCMHI2clU0ekNieXRBNmFTdz09', '2022-10-20 19:29:22'),
(14, 'Паньків Оксана Василівна', 'https://zoom.us/j/4647730505?pwd=NEV2ckxoSlVlV3B6SVROYThBZmNoUT09', '2022-10-20 19:27:20'),
(15, 'Ткач Уляна Василівна', 'https://zoom.us/j/3234675563?pwd=cjY5anQ0VFhick1Kcks2Q2c0WWMyQT09', '2022-10-20 19:27:41'),
(16, 'Ткач Ольга Іванівна', 'https://us02web.zoom.us/j/2050752668?pwd=YWkrVEh2QSs1cjBJTTIwZmpzdHdkQT09', '2022-10-20 19:27:41'),
(17, 'Літовська Тетяна Олексіївна', 'https://us04web.zoom.us/j/9383897000?pwd=M3BqK3U0WXFOTis3am8wVTV4R0xmUT09', '2022-10-20 19:28:11'),
(18, 'Савчук Василина Василівна', 'https://us04web.zoom.us/j/2359560419?pwd=bVBoRFI3K25lYlBxVXl2b2JIREtWUT09', '2022-10-20 19:28:11'),
(19, 'Стрельнікова Марина Маноліївна', 'https://us05web.zoom.us/j/2470796665?pwd=YnFBcEhtUlc0cXA3NXZwMTBDam5EZz09', '2022-10-20 19:29:22'),
(20, 'Король Галина Василівна', 'https://us04web.zoom.us/j/5713849450?pwd=cHp0S0t0c2JxNVp4dlBGNFBod0hWQT09', '2022-10-20 19:32:44'),
(21, 'Пазюк Зоряна Михайлівна', 'https://zoom.us/j/2952516060?pwd=ZWh6dlZsdm1pTFFMWWRheXorMkhoQT09', '2022-10-20 19:32:44'),
(22, 'Ралик Оксана Іванівна', 'https://us04web.zoom.us/j/7764410678?pwd=Z2lBRjBBaCtMUFlpbzJjSUhaYytDZz09', '2022-10-20 19:34:25'),
(23, 'Михайлюк Світлана Володимирівна', 'https://us04web.zoom.us/j/3596491642?pwd=dXpCbXdjME1nYzJWWEppcE5ZeFBCUT09', '2022-10-20 19:34:25'),
(24, 'Микитей Ольга Михайлівна', 'https://us05web.zoom.us/j/9686277425?pwd=dGVVZE5FN0gyc1R5TkRVQyttRk0vUT09', '2022-10-20 19:34:48'),
(25, 'Лахман Віра Василівна', 'https://zoom.us/j/8167580898?pwd=NDc2UDZUL1E5YVpsOXZMNlNVbldLdz09', '2022-10-20 19:34:48'),
(26, 'Цуркан Галина Іванівна', 'https://us04web.zoom.us/j/5468798806?pwd=TGdzcHlFai9JYU1wc3lVTzZjRzZoQT09', '2022-10-20 19:35:10'),
(27, 'Дарвай Марія Іванівна', 'https://us02web.zoom.us/j/4133326413?pwd=ZmF5UjNFQXMyU3NCWE81Y3YrQVRjUT09', '2022-10-20 19:35:10'),
(28, 'Гнідан Марія Василівна', 'https://us05web.zoom.us/j/8033956122?pwd=bFdxVEVoMXU1cHlEUzdCQkFQSU94UT09І', '2022-10-20 19:35:34'),
(29, 'Шевага Галина Михайлівна', 'https://us04web.zoom.us/j/7635973549?pwd=OHEwak13WEhQejhxRGt2K2UzeU1iZz09', '2022-10-20 19:35:34'),
(30, 'Пазюк Зоя Іванівна', 'https://us04web.zoom.us/j/2955475300?pwd=NUY5VlpIWDVtR21IbTVac2gyV2lWUT09', '2022-10-20 19:35:56'),
(31, 'Котляр Світлана Михайлівна', 'https://zoom.us/j/2588424173?pwd=enBQZC9jemNNMWovZnB0RktvR0kxZz09', '2022-10-20 19:35:56'),
(32, 'Женихай Оксана Дмитрівна', 'https://us04web.zoom.us/j/2022138816?pwd=dkNycVNEdWhraDM1dEt2YmtGT0I3QT09', '2022-10-20 19:36:20'),
(33, 'Дідич Юлія Валеріївна', 'https://us04web.zoom.us/j/3867689431?pwd=ZEZSQUVVTVc1OWdmY0NCUnU2OFVVQT09', '2022-10-20 19:36:20'),
(34, 'Косар Марічка Юріївна', 'https://us05web.zoom.us/j/2011323898?pwd=TUxWY0xCNk1EWnU0QWxHQ3pOZzJuZz09', '2022-10-20 19:38:54'),
(35, 'Василевич Галина Миколаївна', 'https://us05web.zoom.us/j/4401693860?pwd=R3N6RGZ3RkVTTlVTUXdHRGdNdkZOUT09', '2022-10-20 19:38:54'),
(36, 'Грицанюк Володимир Григорович', 'https://us05web.zoom.us/j/4723765578?pwd=ZThFWU1TS2hSUTZIQ0Q4VldZNWtUdz09', '2022-10-20 19:39:30'),
(37, 'Зубик Ніна Миколаївна', 'https://us04web.zoom.us/j/8651028608?pwd=U3lDTWpOK0Y2Nk85eWt6b0hLM2ZDUT09', '2022-10-20 19:39:30'),
(38, 'Остапович Ірина Миколаївна', 'https://us05web.zoom.us/j/5174430909?pwd=R1dMK3R5dHRXRmpQbkVQMDNFV3NMQT09', '2022-10-20 19:39:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `zozzso-online-study_codes`
--
ALTER TABLE `zozzso-online-study_codes`
  ADD PRIMARY KEY (`Codes_ID`);

--
-- Indexes for table `zozzso-online-study_config`
--
ALTER TABLE `zozzso-online-study_config`
  ADD PRIMARY KEY (`Config_ID`);

--
-- Indexes for table `zozzso-online-study_lessons`
--
ALTER TABLE `zozzso-online-study_lessons`
  ADD PRIMARY KEY (`Lessons_ID`);

--
-- Indexes for table `zozzso-online-study_roles`
--
ALTER TABLE `zozzso-online-study_roles`
  ADD PRIMARY KEY (`Roles_ID`);

--
-- Indexes for table `zozzso-online-study_schedule`
--
ALTER TABLE `zozzso-online-study_schedule`
  ADD PRIMARY KEY (`schedule_ID`);

--
-- Indexes for table `zozzso-online-study_schedulelessons`
--
ALTER TABLE `zozzso-online-study_schedulelessons`
  ADD PRIMARY KEY (`ScheduleLessons_ID`);

--
-- Indexes for table `zozzso-online-study_teachers`
--
ALTER TABLE `zozzso-online-study_teachers`
  ADD PRIMARY KEY (`Teachers_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `zozzso-online-study_codes`
--
ALTER TABLE `zozzso-online-study_codes`
  MODIFY `Codes_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `zozzso-online-study_config`
--
ALTER TABLE `zozzso-online-study_config`
  MODIFY `Config_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `zozzso-online-study_lessons`
--
ALTER TABLE `zozzso-online-study_lessons`
  MODIFY `Lessons_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `zozzso-online-study_roles`
--
ALTER TABLE `zozzso-online-study_roles`
  MODIFY `Roles_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `zozzso-online-study_schedule`
--
ALTER TABLE `zozzso-online-study_schedule`
  MODIFY `schedule_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `zozzso-online-study_schedulelessons`
--
ALTER TABLE `zozzso-online-study_schedulelessons`
  MODIFY `ScheduleLessons_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `zozzso-online-study_teachers`
--
ALTER TABLE `zozzso-online-study_teachers`
  MODIFY `Teachers_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
