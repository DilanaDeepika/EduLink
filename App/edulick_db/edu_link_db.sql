-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2025 at 12:26 PM
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
-- Database: `edu_link_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `account_type` enum('student','teacher','institute') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `email`, `password_hash`, `account_type`, `created_at`) VALUES
(1, 'ranthilugayani@gmail.com', '$2y$10$StSpQLcmGhtaUv7RVUFIPe15x2FUlOU1ulPE6kACNGwmuPr/0vdhS', 'student', '2025-10-21 16:37:23'),
(2, 'ddn@gmail.com', '$2y$10$vOh5stQiDZDJf/aSagXa0OPU5SDODOO3Deg8J7hkgzk/kg7rg8fPC', 'student', '2025-10-21 16:41:40'),
(3, 'ghgj@gmail.com', '$2y$10$lxS0lpbiSohAwNr9s46Peem7tGhreT/Vz5XPmtpfVWpnEQPzY5VlS', 'student', '2025-10-21 16:46:33'),
(4, 'dilana@gmail.com', '$2y$10$7IZ8SOwKCykBmzOcEFMpsOzY8/KCdmxBzN70GUnjjOabVo4ypmWn.', 'student', '2025-10-21 16:50:55'),
(5, 'ranyani@gmail.com', '$2y$10$bq2fTqVkRqoF.SCGTrxi6OGMjg7780dQHLhpzoSiZ9nTXYIVZKYWy', 'student', '2025-10-21 16:52:37'),
(6, 'ranthilugani@gmail.com', '$2y$10$ifuRFQriwcFgqLqe56VteONmLuA7TKT90Af9BgGD05QDWK7kRcRcm', 'student', '2025-10-21 16:55:09'),
(7, 'ranthilugyani@gmail.com', '$2y$10$k1ysAwDWDQx76Gcioe0xi.GJEmIfIfkGa1hmGoQMOMUWMfKQboP9O', 'student', '2025-10-21 16:57:14'),
(8, 'anthilugyani@gmail.com', '$2y$10$SJpEefpIq.ZOBl31KAO/j.F74AIsKBhda1ClJPNdaCqJBBiZsyFLC', 'student', '2025-10-21 16:58:20'),
(9, 'anthiluayni@gmail.com', '$2y$10$W3i4J7Dg3Y0rbI2gc/YiCu2MwwsLRyf8z9P.fuWdW2RJOriqok4J.', 'student', '2025-10-21 16:58:51'),
(10, 'sddi@gmail.com', '$2y$10$KMSB0ri7Ifo0nBV/3Eh8ru4R6Vd60CQnOegO1GvEyUl2ATKArSooS', 'student', '2025-10-21 17:01:12'),
(11, 'rabnmni@gmail.com', '$2y$10$GUR16m2dG2ZtAnQq8/kAT.pYXIeaxQN79wWltmXD8HJuMCZPJkInO', 'student', '2025-10-21 17:07:01'),
(12, 'dfdgfgyani@gmail.com', '$2y$10$D/UxclNNSGyxBQuQt2x4Le.Zn5pV6vz1apfnMFhr0qq9jr29fAyUy', 'student', '2025-10-21 17:13:04'),
(13, 'gffghjhlugacdfdgyani@gmail.com', '$2y$10$necgA.RhAZSSmHImNRCHTu33f97d3/1WpG64URjb5/0fmS/WpM8Lm', 'student', '2025-10-21 17:23:10'),
(14, 'gfggfhghgacfgddfdfdgyani@gmail.com', '$2y$10$t8jjG/5PWLRMQ8INy/T1YOnKZLib1QXXa5e6nV9j2HtWo8KBFDz9q', 'student', '2025-10-21 17:27:00'),
(15, 'dgfhgyani@gmail.com', '$2y$10$bIpf2ITxFFxiFPZJDuweiet6tgy/J5F3mawHa064gVX3v4Rb2Cz2m', 'student', '2025-10-21 17:30:30'),
(16, 'fgtgghyani@gmail.com', '$2y$10$93U18SD3q1.RSiBfRYY6UeZ1K9bHl0wPANWDH8NVSmaldURJSwiQa', 'student', '2025-10-21 17:35:28'),
(17, 'gsdfdyani@gmail.com', '$2y$10$rsspWoyJc7YS.aZE0IhsrO5aUunb1DpMYq8.wwQZPo4MBEZ7wVJYq', 'student', '2025-10-21 17:50:24'),
(18, 'dgfgani@gmail.com', '$2y$10$vHfHjAiJ.jssMLT5jrKmJ.v7XKFi1oAkV6..wwvfzW3RQE35J16Ze', 'student', '2025-10-21 17:52:31'),
(19, 'xvcvfcvcdfdgyani@gmail.com', '$2y$10$TEyU8MvSGJ2dQZ30zsbVxuzuhK.sTngpG5cAmh3Ya4zjQnw2H3.qu', 'student', '2025-10-21 17:58:11'),
(20, 'cvcccccccccccccccci@gmail.com', '$2y$10$YLaqBL8SevMFIBKQZp4si.ojoefWRU0S0gH7Amp0kctDprIfLeq9W', 'student', '2025-10-21 18:01:49'),
(21, 'fhghgfggggggni@gmail.com', '$2y$10$7uwqw282DkQXVq9YlYC.wOoAUTS/wTKxRf7D80cb/T2v9s8C5o8Nm', 'student', '2025-10-21 18:06:56'),
(22, 'dfdssssssssssssni@gmail.com', '$2y$10$WFM.M0cB/8KiIwJCGuFvKOr9y0H6/JSuycxjYF4QzAR1TKzHy7H7u', 'student', '2025-10-21 18:07:45'),
(23, 'radgfni@gmail.com', '$2y$10$fn3QyHR8z9knpJ1REWywFOOmoSE6v1UfH1cHcrIBSk9duEzLmLmBG', 'teacher', '2025-10-21 18:30:07'),
(24, 'sfdfayani@gmail.com', '$2y$10$qHBYrhXkXlnHU5hAWcHdNuDKxZnk5kxG/4bUPDJNLNR2.sXlB3vqu', 'teacher', '2025-10-21 18:39:12'),
(25, 'fddddddddddddgyani@gmail.com', '$2y$10$j2jYymSNMq3dRTZFyCY2oe3q1CRU2m2/XX8Rlrv/7GdflHKEZ/RrW', 'institute', '2025-10-21 18:54:18'),
(26, 'dgghgfjgyani@gmail.com', '$2y$10$hCONsAdr483p4cANha15Z.Cb051gjNtmTRhEf6Bj9ulScGtsvUY.6', 'institute', '2025-10-21 18:55:37'),
(27, 'dgdfhtghani@gmail.com', '$2y$10$8zFfqLQ0dd290JedA9gWweeJ.i43XlCjqtqWmtbgz6nUw/HsTRzWm', 'institute', '2025-10-21 18:58:12'),
(28, 'sfdgfbfhfgjni@gmail.com', '$2y$10$MVuzLuFEXfb8SRafuAuZRuHQIav4Emh7VCga5VbLemhVZJ7QacI.e', 'student', '2025-10-21 23:11:41'),
(29, 'sfksdjjkngjhfjkgkgyani@gmail.com', '$2y$10$yLFjdyNU2KMwREpDrU/1TOE01O6HUwBqsgsAeCYh.8F0zDG1Veg0W', 'teacher', '2025-10-21 23:13:32'),
(30, 'gayaniego@gmail.com', '$2y$10$c/1jPZAX.cAo5hrozwh6g.Nmear2HUI7YGIAZ4uapZlFat/iJwaWO', 'teacher', '2025-10-21 23:34:41'),
(31, '2003@gmail.com', '$2y$10$RQjQMh2OWjWSqQglMx5GUOhRNw2fZTg1eUHVgSeX510yeUuaHkD1e', 'teacher', '2025-10-21 23:38:31'),
(32, 'gg@gmail.com', '$2y$10$84kfbrkgF3OelcJf41L1vutY3AvsQTtUt5a8Aq30pJDnfOR4dH2VS', 'student', '2025-10-22 08:44:36'),
(33, 'gghh@gmai.com', '$2y$10$FfVGl1mGHRJrL0JMx8gJiuMSfz2lforTqdE6myD0T0z8O81/iI8wi', 'student', '2025-10-22 08:46:21');

-- --------------------------------------------------------

--
-- Table structure for table `account_events`
--

CREATE TABLE `account_events` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `event_title` varchar(255) NOT NULL,
  `event_time` time NOT NULL,
  `event_description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account_events`
--

INSERT INTO `account_events` (`id`, `account_id`, `event_date`, `event_title`, `event_time`, `event_description`, `created_at`) VALUES
(1, 27, '2025-10-07', 'fd', '04:35:00', 'egffg', '2025-10-21 22:38:27'),
(2, 27, '2025-10-07', 'vfb', '04:43:00', 'sfdfdg', '2025-10-21 22:38:38');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advertisement_requests`
--

CREATE TABLE `advertisement_requests` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `advertiser_contact` varchar(255) NOT NULL,
  `placement_option` enum('homepage_poster','homepage_class_section','community_poster') NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `poster_path` varchar(500) DEFAULT NULL,
  `status` enum('Pending','Submitted','Approved','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advertisement_requests`
--

INSERT INTO `advertisement_requests` (`id`, `account_id`, `advertiser_contact`, `placement_option`, `start_time`, `end_time`, `poster_path`, `status`, `created_at`) VALUES
(1, 31, 'contact@techzone.com', 'homepage_class_section', '03:02:00', '04:02:00', NULL, 'Pending', '2025-10-22 07:18:35'),
(2, 31, 'contact@techzone.com', 'homepage_class_section', '03:04:00', '04:02:00', NULL, 'Pending', '2025-10-22 07:18:47');

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `assignment_id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assignment_submissions`
--

CREATE TABLE `assignment_submissions` (
  `submission_id` int(11) NOT NULL,
  `assignment_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `submission_path` varchar(512) NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `duration_hours` int(11) DEFAULT NULL,
  `subject_name` varchar(255) DEFAULT NULL,
  `grade_level_name` varchar(100) DEFAULT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `language_name` varchar(100) DEFAULT NULL,
  `thumbnail_path` varchar(512) DEFAULT NULL,
  `trailer_path` varchar(512) DEFAULT NULL,
  `max_students` int(11) DEFAULT NULL,
  `monthly_fee` decimal(10,2) DEFAULT NULL,
  `target_audience` text DEFAULT NULL,
  `prerequisites` text DEFAULT NULL,
  `welcome_message` text DEFAULT NULL,
  `congrats_message` text DEFAULT NULL,
  `teacher_id` int(11) NOT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `class_name`, `description`, `duration_hours`, `subject_name`, `grade_level_name`, `category_name`, `language_name`, `thumbnail_path`, `trailer_path`, `max_students`, `monthly_fee`, `target_audience`, `prerequisites`, `welcome_message`, `congrats_message`, `teacher_id`, `institute_id`, `created_at`) VALUES
(1, 'fghgf', 'fgfhg', 45, 'Combined Mathematics', 'yr_25', 'revision', 'tamil', NULL, NULL, 50, 500.00, 'ghgjfbgfh', 'fhfh', 'gnbmn', 'bmnnbm', 1, NULL, '2025-10-21 20:10:14'),
(2, 'gaming', 'dfgf', 23, 'Chemistry', 'yr_26', 'revision', 'sinhala', NULL, NULL, 50, 500.00, 'vxfnnbknkvjn', 'vdmcjcbjkcvjk', '', '', 1, NULL, '2025-10-21 23:50:29'),
(3, 'ict', 'frdfffffffffffffffffffffffffff', 23, 'Chemistry', 'yr_26', 'revision', 'english', NULL, NULL, 50, 500.00, 'ddvfb', 'ffffbfb', 'vffb', 'ffb', 1, NULL, '2025-10-21 23:54:32'),
(4, 'dv', 'dfdgd', 32, 'Combined Mathematics', 'yr_25', 'revision', 'english', NULL, NULL, 70, 6000.00, 'vf', 'vc', 'svdv', 'cvd', 1, NULL, '2025-10-21 23:59:18'),
(5, 'last', 'dffg', 45, 'Combined Mathematics', 'yr_26', 'revision', 'sinhala', NULL, NULL, 50, 5000.00, 'dfdg', 'gdg', 'dfd', 'dg', 4, NULL, '2025-10-22 00:17:57');

-- --------------------------------------------------------

--
-- Table structure for table `class_attendance`
--

CREATE TABLE `class_attendance` (
  `attendance_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `session_date` date NOT NULL,
  `attendance_type` enum('physical','online') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class_content`
--

CREATE TABLE `class_content` (
  `content_id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `content_type` enum('video_recording','note','past_paper','model_paper','external_link') NOT NULL,
  `content_path` varchar(512) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class_objectives`
--

CREATE TABLE `class_objectives` (
  `objective_id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `objective_text` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_objectives`
--

INSERT INTO `class_objectives` (`objective_id`, `class_id`, `objective_text`) VALUES
(1, 1, 'gjhjg'),
(2, 1, 'vcdfggh'),
(3, 2, 'vcvdcv'),
(4, 2, 'cbcb'),
(5, 2, 'xvcv'),
(6, 3, 'ddd'),
(7, 4, 'd'),
(8, 4, 'f'),
(9, 4, 'f'),
(10, 5, 'vfdf'),
(11, 5, 'dfdf'),
(12, 5, 'dgdg');

-- --------------------------------------------------------

--
-- Table structure for table `class_schedules`
--

CREATE TABLE `class_schedules` (
  `schedule_id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `day_of_week` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_schedules`
--

INSERT INTO `class_schedules` (`schedule_id`, `class_id`, `day_of_week`, `start_time`, `end_time`) VALUES
(1, 1, '', '09:00:00', '17:00:00'),
(2, 2, '', '09:00:00', '17:00:00'),
(3, 3, '', '09:00:00', '17:00:00'),
(4, 4, '', '09:00:00', '17:00:00'),
(5, 5, '', '09:00:00', '17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `enrollment_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `enrollment_date` date DEFAULT NULL,
  `status` enum('enrolled','completed','dropped') NOT NULL DEFAULT 'enrolled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `free_card_applications`
--

CREATE TABLE `free_card_applications` (
  `application_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `documentation_path` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `application_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `institutes`
--

CREATE TABLE `institutes` (
  `institute_id` int(11) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `institute_name` varchar(255) NOT NULL,
  `location` text DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(20) DEFAULT NULL,
  `open_time` time DEFAULT NULL,
  `close_time` time DEFAULT NULL,
  `approval_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `approval_document_path` varchar(512) DEFAULT NULL,
  `approved_by_admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `institutes`
--

INSERT INTO `institutes` (`institute_id`, `account_id`, `institute_name`, `location`, `contact_email`, `contact_phone`, `open_time`, `close_time`, `approval_status`, `approval_document_path`, `approved_by_admin_id`) VALUES
(1, 27, 'fbfgn', 'df.nbjfdnk', 'dhh@gmail.xcd', '3445', NULL, NULL, 'pending', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `live_sessions`
--

CREATE TABLE `live_sessions` (
  `session_id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `session_time` datetime NOT NULL,
  `meeting_link` varchar(512) NOT NULL,
  `meeting_password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marking_panel`
--

CREATE TABLE `marking_panel` (
  `panel_member_id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `appointed_date` date NOT NULL,
  `approval_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `application_document_path` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `papers`
--

CREATE TABLE `papers` (
  `paper_id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paper_marks`
--

CREATE TABLE `paper_marks` (
  `mark_id` int(11) NOT NULL,
  `paper_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `marks_obtained` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `quiz_id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `time_limit_minutes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_attempts`
--

CREATE TABLE `quiz_attempts` (
  `attempt_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `score` decimal(5,2) DEFAULT NULL,
  `completed_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_options`
--

CREATE TABLE `quiz_options` (
  `option_id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `option_text` text NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `question_id` int(11) NOT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `question_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_student_answers`
--

CREATE TABLE `quiz_student_answers` (
  `student_answer_id` int(11) NOT NULL,
  `attempt_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `chosen_option_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `school_name` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `stream` enum('Maths','Bio','Commerce','Art','Technology') NOT NULL,
  `parent_name` varchar(255) DEFAULT NULL,
  `parent_phone_number` varchar(20) DEFAULT NULL,
  `payment_status` enum('paid','free_card') NOT NULL DEFAULT 'paid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `account_id`, `first_name`, `last_name`, `age`, `school_name`, `address`, `stream`, `parent_name`, `parent_phone_number`, `payment_status`) VALUES
(1, 22, 'dsfn', 'sabhj', NULL, 'bjhbfjbd', 'gfggh', '', NULL, NULL, 'paid'),
(2, 28, 'vcdvfdv', 'xvvxv', NULL, 'xvv', 'bdcxv', 'Commerce', NULL, NULL, 'paid'),
(3, 32, 'dknfdkn', 'vnfjfsknkfl', NULL, 'fvjnvfnkvnkfv', 'vjvfjdfjofj', '', NULL, NULL, 'paid'),
(4, 33, 'dilana', 'deepika', NULL, 'dkkf', 'nnfnk', 'Commerce', NULL, NULL, 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(11) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `subjects_taught` text DEFAULT NULL,
  `approval_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `approval_document_path` varchar(512) DEFAULT NULL,
  `approved_by_admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `account_id`, `first_name`, `last_name`, `email`, `phone`, `subjects_taught`, `approval_status`, `approval_document_path`, `approved_by_admin_id`) VALUES
(1, 24, 'dfghgj', 'vbcvnbnh', 'bfbd@gmail.com', '343545', 'Combined Mathematics', 'pending', '', NULL),
(2, 29, 'cbnbdbm', 'ddmnm', 'dsvb@gmail.com', '2546', 'ICT', 'pending', '', NULL),
(3, 30, 'gayani', 'weerarathna', 'dilana@gmail.com', '24545', 'Biology', 'pending', '', NULL),
(4, 31, 'gayani', 'xvcxv', 'cbcb@gmail.com', '3546', 'Combined Mathematics', 'pending', '', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `account_events`
--
ALTER TABLE `account_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_account` (`account_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `account_id` (`account_id`);

--
-- Indexes for table `advertisement_requests`
--
ALTER TABLE `advertisement_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  ADD PRIMARY KEY (`submission_id`),
  ADD KEY `assignment_id` (`assignment_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `institute_id` (`institute_id`);

--
-- Indexes for table `class_attendance`
--
ALTER TABLE `class_attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `class_content`
--
ALTER TABLE `class_content`
  ADD PRIMARY KEY (`content_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `class_objectives`
--
ALTER TABLE `class_objectives`
  ADD PRIMARY KEY (`objective_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `class_schedules`
--
ALTER TABLE `class_schedules`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `free_card_applications`
--
ALTER TABLE `free_card_applications`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `institutes`
--
ALTER TABLE `institutes`
  ADD PRIMARY KEY (`institute_id`),
  ADD UNIQUE KEY `account_id` (`account_id`),
  ADD UNIQUE KEY `contact_email` (`contact_email`),
  ADD KEY `fk_institutes_approved_by_admin` (`approved_by_admin_id`);

--
-- Indexes for table `live_sessions`
--
ALTER TABLE `live_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `marking_panel`
--
ALTER TABLE `marking_panel`
  ADD PRIMARY KEY (`panel_member_id`),
  ADD UNIQUE KEY `class_id` (`class_id`,`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `papers`
--
ALTER TABLE `papers`
  ADD PRIMARY KEY (`paper_id`);

--
-- Indexes for table `paper_marks`
--
ALTER TABLE `paper_marks`
  ADD PRIMARY KEY (`mark_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`quiz_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  ADD PRIMARY KEY (`attempt_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quiz_options`
--
ALTER TABLE `quiz_options`
  ADD PRIMARY KEY (`option_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quiz_student_answers`
--
ALTER TABLE `quiz_student_answers`
  ADD PRIMARY KEY (`student_answer_id`),
  ADD KEY `attempt_id` (`attempt_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `chosen_option_id` (`chosen_option_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `account_id` (`account_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`),
  ADD UNIQUE KEY `account_id` (`account_id`),
  ADD KEY `approved_by_admin_id` (`approved_by_admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `account_events`
--
ALTER TABLE `account_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advertisement_requests`
--
ALTER TABLE `advertisement_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `class_attendance`
--
ALTER TABLE `class_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `class_content`
--
ALTER TABLE `class_content`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `class_objectives`
--
ALTER TABLE `class_objectives`
  MODIFY `objective_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `class_schedules`
--
ALTER TABLE `class_schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `free_card_applications`
--
ALTER TABLE `free_card_applications`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institutes`
--
ALTER TABLE `institutes`
  MODIFY `institute_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `live_sessions`
--
ALTER TABLE `live_sessions`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marking_panel`
--
ALTER TABLE `marking_panel`
  MODIFY `panel_member_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  MODIFY `attempt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_options`
--
ALTER TABLE `quiz_options`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_student_answers`
--
ALTER TABLE `quiz_student_answers`
  MODIFY `student_answer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_events`
--
ALTER TABLE `account_events`
  ADD CONSTRAINT `fk_account` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`) ON DELETE CASCADE;

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`);

--
-- Constraints for table `advertisement_requests`
--
ALTER TABLE `advertisement_requests`
  ADD CONSTRAINT `advertisement_requests_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`);

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`);

--
-- Constraints for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  ADD CONSTRAINT `assignment_submissions_ibfk_1` FOREIGN KEY (`assignment_id`) REFERENCES `assignments` (`assignment_id`),
  ADD CONSTRAINT `assignment_submissions_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`),
  ADD CONSTRAINT `classes_ibfk_2` FOREIGN KEY (`institute_id`) REFERENCES `institutes` (`institute_id`);

--
-- Constraints for table `class_attendance`
--
ALTER TABLE `class_attendance`
  ADD CONSTRAINT `class_attendance_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `class_attendance_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`);

--
-- Constraints for table `class_content`
--
ALTER TABLE `class_content`
  ADD CONSTRAINT `class_content_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`);

--
-- Constraints for table `class_objectives`
--
ALTER TABLE `class_objectives`
  ADD CONSTRAINT `class_objectives_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`);

--
-- Constraints for table `class_schedules`
--
ALTER TABLE `class_schedules`
  ADD CONSTRAINT `class_schedules_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`);

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`);

--
-- Constraints for table `free_card_applications`
--
ALTER TABLE `free_card_applications`
  ADD CONSTRAINT `free_card_applications_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints for table `institutes`
--
ALTER TABLE `institutes`
  ADD CONSTRAINT `fk_institutes_approved_by_admin` FOREIGN KEY (`approved_by_admin_id`) REFERENCES `admins` (`admin_id`),
  ADD CONSTRAINT `institutes_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`);

--
-- Constraints for table `live_sessions`
--
ALTER TABLE `live_sessions`
  ADD CONSTRAINT `live_sessions_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`);

--
-- Constraints for table `marking_panel`
--
ALTER TABLE `marking_panel`
  ADD CONSTRAINT `marking_panel_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`),
  ADD CONSTRAINT `marking_panel_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `quizzes_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`);

--
-- Constraints for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  ADD CONSTRAINT `quiz_attempts_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `quiz_attempts_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`quiz_id`);

--
-- Constraints for table `quiz_options`
--
ALTER TABLE `quiz_options`
  ADD CONSTRAINT `quiz_options_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `quiz_questions` (`question_id`);

--
-- Constraints for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD CONSTRAINT `quiz_questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`quiz_id`);

--
-- Constraints for table `quiz_student_answers`
--
ALTER TABLE `quiz_student_answers`
  ADD CONSTRAINT `quiz_student_answers_ibfk_1` FOREIGN KEY (`attempt_id`) REFERENCES `quiz_attempts` (`attempt_id`),
  ADD CONSTRAINT `quiz_student_answers_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `quiz_questions` (`question_id`),
  ADD CONSTRAINT `quiz_student_answers_ibfk_3` FOREIGN KEY (`chosen_option_id`) REFERENCES `quiz_options` (`option_id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`);

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`),
  ADD CONSTRAINT `teachers_ibfk_2` FOREIGN KEY (`approved_by_admin_id`) REFERENCES `admins` (`admin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
