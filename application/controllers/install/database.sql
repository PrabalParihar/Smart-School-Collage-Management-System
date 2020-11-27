-- Smart School DB
-- version 5.2.0
-- https://smart-school.in
-- https://qdocs.in

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Table structure for table `attendence_type`
--

CREATE TABLE `attendence_type` (
  `id` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `key_value` varchar(50) NOT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attendence_type`
--

INSERT INTO `attendence_type` (`id`, `type`, `key_value`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Present', '<b class=\"text text-success\">P</b>', 'yes', '2016-06-23 18:11:37', '0000-00-00'),
(2, 'Late With Excuse', '<b class=\"text text-warning\">E</b>', 'no', '2018-05-29 08:19:48', '0000-00-00'),
(3, 'Late', '<b class=\"text text-warning\">L</b>', 'yes', '2016-06-23 18:12:28', '0000-00-00'),
(4, 'Absent', '<b class=\"text text-danger\">A</b>', 'yes', '2016-10-11 11:35:40', '0000-00-00'),
(5, 'Holiday', 'H', 'yes', '2016-10-11 11:35:01', '0000-00-00'),
(6, 'Half Day', '<b class=\"text text-warning\">F</b>', 'yes', '2016-06-23 18:12:28', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `book_title` varchar(100) NOT NULL,
  `book_no` varchar(50) NOT NULL,
  `isbn_no` varchar(100) NOT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `rack_no` varchar(100) NOT NULL,
  `publish` varchar(100) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `perunitcost` float(10,2) DEFAULT NULL,
  `postdate` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `available` varchar(10) DEFAULT 'yes',
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `book_issues`
--

CREATE TABLE `book_issues` (
  `id` int(11) UNSIGNED NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `duereturn_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `is_returned` int(11) DEFAULT 0,
  `member_id` int(11) DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` int(11) NOT NULL,
  `certificate_name` varchar(100) NOT NULL,
  `certificate_text` text NOT NULL,
  `left_header` varchar(100) NOT NULL,
  `center_header` varchar(100) NOT NULL,
  `right_header` varchar(100) NOT NULL,
  `left_footer` varchar(100) NOT NULL,
  `right_footer` varchar(100) NOT NULL,
  `center_footer` varchar(100) NOT NULL,
  `background_image` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  `created_for` tinyint(1) NOT NULL COMMENT '1 = staff, 2 = students',
  `status` tinyint(1) NOT NULL,
  `header_height` int(11) NOT NULL,
  `content_height` int(11) NOT NULL,
  `footer_height` int(11) NOT NULL,
  `content_width` int(11) NOT NULL,
  `enable_student_image` tinyint(1) NOT NULL COMMENT '0=no,1=yes',
  `enable_image_height` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `certificate_name`, `certificate_text`, `left_header`, `center_header`, `right_header`, `left_footer`, `right_footer`, `center_footer`, `background_image`, `created_at`, `updated_at`, `created_for`, `status`, `header_height`, `content_height`, `footer_height`, `content_width`, `enable_student_image`, `enable_image_height`) VALUES
(1, 'Sample Transfer Certificate', 'This is certify that <b>[name]</b> has born on [dob]  <br> and have following details [present_address] [guardian] [created_at] [admission_no] [roll_no] [class] [section] [gender] [admission_date] [category] [cast] [father_name] [mother_name] [religion] [email] [phone] .<br>We wish best of luck for future endeavors.', 'Reff. No.....1111111.........', 'To Whomever It May Concern', 'Date: _10__/_10__/__2019__', '.................................<br>admin', '.................................<br>principal', '.................................<br>admin', 'sampletc121.png', '2019-12-21 15:14:34', '0000-00-00', 2, 1, 360, 400, 480, 810, 1, 230);

-- --------------------------------------------------------

--
-- Table structure for table `chat_connections`
--

CREATE TABLE `chat_connections` (
  `id` int(11) NOT NULL,
  `chat_user_one` int(11) NOT NULL,
  `chat_user_two` int(11) NOT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `chat_user_id` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `time` int(11) NOT NULL,
  `is_first` int(1) DEFAULT 0,
  `is_read` int(1) NOT NULL DEFAULT 0,
  `chat_connection_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chat_users`
--

CREATE TABLE `chat_users` (
  `id` int(11) NOT NULL,
  `user_type` varchar(20) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `create_staff_id` int(11) DEFAULT NULL,
  `create_student_id` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `class` varchar(60) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `class_sections`
--

CREATE TABLE `class_sections` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `class_teacher`
--

CREATE TABLE `class_teacher` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `id` int(11) NOT NULL,
  `complaint_type` varchar(255) NOT NULL,
  `source` varchar(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `email` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `action_taken` varchar(200) NOT NULL,
  `assigned` varchar(50) NOT NULL,
  `note` text NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `complaint_type`
--

CREATE TABLE `complaint_type` (
  `id` int(11) NOT NULL,
  `complaint_type` varchar(100) NOT NULL,
  `description` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `is_public` varchar(10) DEFAULT 'No',
  `class_id` int(11) DEFAULT NULL,
  `cls_sec_id` int(10) NOT NULL,
  `file` varchar(250) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `content_for`
--

CREATE TABLE `content_for` (
  `id` int(11) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `content_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `custom_fields`
--

CREATE TABLE `custom_fields` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `belong_to` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `type` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `bs_column` int(10) DEFAULT NULL,
  `validation` int(11) DEFAULT 0,
  `field_values` text CHARACTER SET latin1 DEFAULT NULL,
  `show_table` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `visible_on_table` int(11) NOT NULL,
  `weight` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `custom_field_values`
--

CREATE TABLE `custom_field_values` (
  `id` int(11) NOT NULL,
  `belong_table_id` int(11) DEFAULT NULL,
  `custom_field_id` int(11) DEFAULT NULL,
  `field_value` longtext CHARACTER SET latin1 DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `department_name` varchar(200) NOT NULL,
  `is_active` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `disable_reason`
--

CREATE TABLE `disable_reason` (
  `id` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dispatch_receive`
--

CREATE TABLE `dispatch_receive` (
  `id` int(11) NOT NULL,
  `reference_no` varchar(50) NOT NULL,
  `to_title` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `note` varchar(500) NOT NULL,
  `from_title` varchar(200) NOT NULL,
  `date` varchar(20) NOT NULL,
  `image` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `email_config`
--

CREATE TABLE `email_config` (
  `id` int(11) UNSIGNED NOT NULL,
  `email_type` varchar(100) DEFAULT NULL,
  `smtp_server` varchar(100) DEFAULT NULL,
  `smtp_port` varchar(100) DEFAULT NULL,
  `smtp_username` varchar(100) DEFAULT NULL,
  `smtp_password` varchar(100) DEFAULT NULL,
  `ssl_tls` varchar(100) DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email_config`
--

INSERT INTO `email_config` (`id`, `email_type`, `smtp_server`, `smtp_port`, `smtp_username`, `smtp_password`, `ssl_tls`, `is_active`, `created_at`) VALUES
(1, 'sendmail', NULL, NULL, NULL, NULL, NULL, '', '2020-02-28 13:46:03');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE `enquiry` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` mediumtext NOT NULL,
  `reference` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(500) NOT NULL,
  `follow_up_date` date NOT NULL,
  `note` mediumtext NOT NULL,
  `source` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `assigned` varchar(100) NOT NULL,
  `class` int(11) NOT NULL,
  `no_of_child` varchar(11) DEFAULT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_type`
--

CREATE TABLE `enquiry_type` (
  `id` int(11) NOT NULL,
  `enquiry_type` varchar(100) NOT NULL,
  `description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_title` varchar(200) NOT NULL,
  `event_description` varchar(300) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `event_type` varchar(100) NOT NULL,
  `event_color` varchar(200) NOT NULL,
  `event_for` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `sesion_id` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `exam_groups`
--

CREATE TABLE `exam_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `exam_type` varchar(250) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `exam_group_class_batch_exams`
--

CREATE TABLE `exam_group_class_batch_exams` (
  `id` int(11) NOT NULL,
  `exam` varchar(250) DEFAULT NULL,
  `session_id` int(10) NOT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `exam_group_id` int(11) DEFAULT NULL,
  `is_publish` int(1) DEFAULT 0,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `exam_group_class_batch_exam_students`
--

CREATE TABLE `exam_group_class_batch_exam_students` (
  `id` int(11) NOT NULL,
  `exam_group_class_batch_exam_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_session_id` int(11) NOT NULL,
  `roll_no` int(6) NOT NULL DEFAULT 0,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `exam_group_class_batch_exam_subjects`
--

CREATE TABLE `exam_group_class_batch_exam_subjects` (
  `id` int(11) NOT NULL,
  `exam_group_class_batch_exams_id` int(11) DEFAULT NULL,
  `subject_id` int(10) NOT NULL,
  `date_from` date NOT NULL,
  `time_from` time NOT NULL,
  `duration` varchar(50) NOT NULL,
  `room_no` varchar(100) DEFAULT NULL,
  `max_marks` float(10,2) DEFAULT NULL,
  `min_marks` float(10,2) DEFAULT NULL,
  `credit_hours` float(10,2) DEFAULT 0.00,
  `date_to` datetime DEFAULT NULL,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `exam_group_exam_connections`
--

CREATE TABLE `exam_group_exam_connections` (
  `id` int(11) NOT NULL,
  `exam_group_id` int(11) DEFAULT NULL,
  `exam_group_class_batch_exams_id` int(11) DEFAULT NULL,
  `exam_weightage` float(10,2) DEFAULT 0.00,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `exam_group_exam_results`
--

CREATE TABLE `exam_group_exam_results` (
  `id` int(11) NOT NULL,
  `exam_group_class_batch_exam_student_id` int(11) NOT NULL,
  `exam_group_class_batch_exam_subject_id` int(11) DEFAULT NULL,
  `attendence` varchar(10) DEFAULT NULL,
  `get_marks` float(10,2) DEFAULT 0.00,
  `note` text DEFAULT NULL,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  `exam_group_student_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `exam_group_students`
--

CREATE TABLE `exam_group_students` (
  `id` int(11) NOT NULL,
  `exam_group_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `student_session_id` int(10) DEFAULT NULL,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

CREATE TABLE `exam_results` (
  `id` int(11) NOT NULL,
  `attendence` varchar(10) NOT NULL,
  `exam_schedule_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `get_marks` float(10,2) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `exam_schedules`
--

CREATE TABLE `exam_schedules` (
  `id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `teacher_subject_id` int(11) DEFAULT NULL,
  `date_of_exam` date DEFAULT NULL,
  `start_to` varchar(50) DEFAULT NULL,
  `end_from` varchar(50) DEFAULT NULL,
  `room_no` varchar(50) DEFAULT NULL,
  `full_marks` int(11) DEFAULT NULL,
  `passing_marks` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `exp_head_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `invoice_no` varchar(200) NOT NULL,
  `date` date DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `documents` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'yes',
  `is_deleted` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `expense_head`
--

CREATE TABLE `expense_head` (
  `id` int(11) NOT NULL,
  `exp_category` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'yes',
  `is_deleted` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `feecategory`
--

CREATE TABLE `feecategory` (
  `id` int(11) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `feemasters`
--

CREATE TABLE `feemasters` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `feetype_id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fees_discounts`
--

CREATE TABLE `fees_discounts` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fees_reminder`
--

CREATE TABLE `fees_reminder` (
  `id` int(11) NOT NULL,
  `reminder_type` varchar(10) DEFAULT NULL,
  `day` int(2) DEFAULT NULL,
  `is_active` int(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fees_reminder`
--

INSERT INTO `fees_reminder` (`id`, `reminder_type`, `day`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'before', 2, 0, '2020-02-28 13:38:32', NULL),
(2, 'before', 5, 0, '2020-02-28 13:38:36', NULL),
(3, 'after', 2, 0, '2020-02-28 13:38:40', NULL),
(4, 'after', 5, 0, '2020-02-28 13:38:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `feetype`
--

CREATE TABLE `feetype` (
  `id` int(11) NOT NULL,
  `is_system` int(1) NOT NULL DEFAULT 0,
  `feecategory_id` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `code` varchar(100) NOT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fee_groups`
--

CREATE TABLE `fee_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `is_system` int(1) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fee_groups_feetype`
--

CREATE TABLE `fee_groups_feetype` (
  `id` int(11) NOT NULL,
  `fee_session_group_id` int(11) DEFAULT NULL,
  `fee_groups_id` int(11) DEFAULT NULL,
  `feetype_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `fine_type` varchar(50) NOT NULL DEFAULT 'none',
  `due_date` date DEFAULT NULL,
  `fine_percentage` float(10,2) NOT NULL DEFAULT 0.00,
  `fine_amount` float(10,2) NOT NULL DEFAULT 0.00,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fee_receipt_no`
--

CREATE TABLE `fee_receipt_no` (
  `id` int(11) NOT NULL,
  `payment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fee_session_groups`
--

CREATE TABLE `fee_session_groups` (
  `id` int(11) NOT NULL,
  `fee_groups_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `follow_up`
--

CREATE TABLE `follow_up` (
  `id` int(11) NOT NULL,
  `enquiry_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `next_date` date NOT NULL,
  `response` text NOT NULL,
  `note` text NOT NULL,
  `followup_by` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `front_cms_media_gallery`
--

CREATE TABLE `front_cms_media_gallery` (
  `id` int(11) NOT NULL,
  `image` varchar(300) DEFAULT NULL,
  `thumb_path` varchar(300) DEFAULT NULL,
  `dir_path` varchar(300) DEFAULT NULL,
  `img_name` varchar(300) DEFAULT NULL,
  `thumb_name` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `file_type` varchar(100) NOT NULL,
  `file_size` varchar(100) NOT NULL,
  `vid_url` mediumtext NOT NULL,
  `vid_title` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `front_cms_menus`
--

CREATE TABLE `front_cms_menus` (
  `id` int(11) NOT NULL,
  `menu` varchar(100) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `open_new_tab` int(10) NOT NULL DEFAULT 0,
  `ext_url` mediumtext NOT NULL,
  `ext_url_link` mediumtext NOT NULL,
  `publish` int(11) NOT NULL DEFAULT 0,
  `content_type` varchar(10) NOT NULL DEFAULT 'manual',
  `is_active` varchar(10) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `front_cms_menus`
--

INSERT INTO `front_cms_menus` (`id`, `menu`, `slug`, `description`, `open_new_tab`, `ext_url`, `ext_url_link`, `publish`, `content_type`, `is_active`, `created_at`) VALUES
(1, 'Main Menu', 'main-menu', 'Main menu', 0, '', '', 0, 'default', 'no', '2018-04-20 14:54:49'),
(2, 'Bottom Menu', 'bottom-menu', 'Bottom Menu', 0, '', '', 0, 'default', 'no', '2018-04-20 14:54:55');

-- --------------------------------------------------------

--
-- Table structure for table `front_cms_menu_items`
--

CREATE TABLE `front_cms_menu_items` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `menu` varchar(100) DEFAULT NULL,
  `page_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `ext_url` mediumtext DEFAULT NULL,
  `open_new_tab` int(11) DEFAULT 0,
  `ext_url_link` mediumtext DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `publish` int(11) NOT NULL DEFAULT 0,
  `description` mediumtext DEFAULT NULL,
  `is_active` varchar(10) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `front_cms_menu_items`
--

INSERT INTO `front_cms_menu_items` (`id`, `menu_id`, `menu`, `page_id`, `parent_id`, `ext_url`, `open_new_tab`, `ext_url_link`, `slug`, `weight`, `publish`, `description`, `is_active`, `created_at`) VALUES
(1, 1, 'Home', 1, 0, NULL, NULL, NULL, 'home', 1, 0, NULL, 'no', '2019-12-02 22:11:50'),
(2, 1, 'Contact Us', 76, 0, NULL, NULL, NULL, 'contact-us', 4, 0, NULL, 'no', '2019-12-02 22:11:52'),
(3, 1, 'Complain', 2, 0, NULL, NULL, NULL, 'complain', 3, 0, NULL, 'no', '2019-12-02 22:11:52'),
(4, 1, 'Admission', 0, 0, '1', NULL, 'http://yourschoolurl.com/online_admission', 'admssion', 2, 0, NULL, 'no', '2019-12-21 15:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `front_cms_pages`
--

CREATE TABLE `front_cms_pages` (
  `id` int(11) NOT NULL,
  `page_type` varchar(10) NOT NULL DEFAULT 'manual',
  `is_homepage` int(1) DEFAULT 0,
  `title` varchar(250) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `meta_title` mediumtext DEFAULT NULL,
  `meta_description` mediumtext DEFAULT NULL,
  `meta_keyword` mediumtext DEFAULT NULL,
  `feature_image` varchar(200) NOT NULL,
  `description` longtext DEFAULT NULL,
  `publish_date` date NOT NULL,
  `publish` int(10) DEFAULT 0,
  `sidebar` int(10) DEFAULT 0,
  `is_active` varchar(10) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `front_cms_pages`
--

INSERT INTO `front_cms_pages` (`id`, `page_type`, `is_homepage`, `title`, `url`, `type`, `slug`, `meta_title`, `meta_description`, `meta_keyword`, `feature_image`, `description`, `publish_date`, `publish`, `sidebar`, `is_active`, `created_at`) VALUES
(1, 'default', 1, 'Home', 'page/home', 'page', 'home', '', '', '', '', '<p>home page</p>', '0000-00-00', 1, NULL, 'no', '2019-12-02 15:23:47'),
(2, 'default', 0, 'Complain', 'page/complain', 'page', 'complain', 'Complain form', '                                                                                                                                                                                    complain form                                                                                                                                                                                                                                ', 'complain form', '', '<p>[form-builder:complain]</p>', '0000-00-00', 1, NULL, 'no', '2019-11-13 10:16:36'),
(54, 'default', 0, '404 page', 'page/404-page', 'page', '404-page', '', '                                ', '', '', '<html>\r\n<head>\r\n <title></title>\r\n</head>\r\n<body>\r\n<p>404 page found</p>\r\n</body>\r\n</html>', '0000-00-00', 0, NULL, 'no', '2018-05-18 14:46:04'),
(76, 'default', 0, 'Contact us', 'page/contact-us', 'page', 'contact-us', '', '', '', '', '<section class=\"contact\">\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<h2 class=\"col-md-12 col-sm-12\">Send In Your Query</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div class=\"col-md-12 col-sm-12\">[form-builder:contact_us]<!--./row--></div>\r\n<!--./col-md-12--></div>\r\n<!--./row--></div>\r\n<!--./container--></section>\r\n\r\n<div class=\"col-md-4 col-sm-4\">\r\n<div class=\"contact-item\"><img src=\"http://192.168.1.81/repos/smartschool/uploads/gallery/media/pin.svg\" />\r\n<h3>Our Location</h3>\r\n\r\n<p>350 Fifth Avenue, 34th floor New York NY 10118-3299 USA</p>\r\n</div>\r\n<!--./contact-item--></div>\r\n<!--./col-md-4-->\r\n\r\n<div class=\"col-md-4 col-sm-4\">\r\n<div class=\"contact-item\"><img src=\"http://192.168.1.81/repos/smartschool/uploads/gallery/media/phone.svg\" />\r\n<h3>CALL US</h3>\r\n\r\n<p>E-mail : info@abcschool.com</p>\r\n\r\n<p>Mobile : +91-9009987654</p>\r\n</div>\r\n<!--./contact-item--></div>\r\n<!--./col-md-4-->\r\n\r\n<div class=\"col-md-4 col-sm-4\">\r\n<div class=\"contact-item\"><img src=\"http://192.168.1.81/repos/smartschool/uploads/gallery/media/clock.svg\" />\r\n<h3>Working Hours</h3>\r\n\r\n<p>Mon-Fri : 9 am to 5 pm</p>\r\n\r\n<p>Sat : 9 am to 3 pm</p>\r\n</div>\r\n<!--./contact-item--></div>\r\n<!--./col-md-4-->\r\n\r\n<div class=\"col-md-12 col-sm-12\">\r\n<div class=\"mapWrapper fullwidth\"><iframe frameborder=\"0\" height=\"500\" marginheight=\"0\" marginwidth=\"0\" scrolling=\"no\" src=\"http://maps.google.com/maps?f=q&source=s_q&hl=EN&q=time+square&aq=&sll=40.716558,-73.931122&sspn=0.40438,1.056747&ie=UTF8&rq=1&ev=p&split=1&radius=33.22&hq=time+square&hnear=&ll=37.061753,-95.677185&spn=0.438347,0.769043&z=9&output=embed\" width=\"100%\"></iframe></div>\r\n</div>', '0000-00-00', 0, NULL, 'no', '2019-05-04 15:46:41');

-- --------------------------------------------------------

--
-- Table structure for table `front_cms_page_contents`
--

CREATE TABLE `front_cms_page_contents` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT NULL,
  `content_type` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `front_cms_programs`
--

CREATE TABLE `front_cms_programs` (
  `id` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `url` mediumtext DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `event_start` date DEFAULT NULL,
  `event_end` date DEFAULT NULL,
  `event_venue` mediumtext DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `is_active` varchar(10) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `meta_title` mediumtext NOT NULL,
  `meta_description` mediumtext NOT NULL,
  `meta_keyword` mediumtext NOT NULL,
  `feature_image` mediumtext NOT NULL,
  `publish_date` date NOT NULL,
  `publish` varchar(10) DEFAULT '0',
  `sidebar` int(10) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `front_cms_program_photos`
--

CREATE TABLE `front_cms_program_photos` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `media_gallery_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `front_cms_settings`
--

CREATE TABLE `front_cms_settings` (
  `id` int(11) NOT NULL,
  `theme` varchar(50) DEFAULT NULL,
  `is_active_rtl` int(10) DEFAULT 0,
  `is_active_front_cms` int(11) DEFAULT 0,
  `is_active_sidebar` int(1) DEFAULT 0,
  `logo` varchar(200) DEFAULT NULL,
  `contact_us_email` varchar(100) DEFAULT NULL,
  `complain_form_email` varchar(100) DEFAULT NULL,
  `sidebar_options` mediumtext NOT NULL,
  `fb_url` varchar(200) NOT NULL,
  `twitter_url` varchar(200) NOT NULL,
  `youtube_url` varchar(200) NOT NULL,
  `google_plus` varchar(200) NOT NULL,
  `instagram_url` varchar(200) NOT NULL,
  `pinterest_url` varchar(200) NOT NULL,
  `linkedin_url` varchar(200) NOT NULL,
  `google_analytics` mediumtext DEFAULT NULL,
  `footer_text` varchar(500) DEFAULT NULL,
  `fav_icon` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `front_cms_settings`
--

INSERT INTO `front_cms_settings` (`id`, `theme`, `is_active_rtl`, `is_active_front_cms`, `is_active_sidebar`, `logo`, `contact_us_email`, `complain_form_email`, `sidebar_options`, `fb_url`, `twitter_url`, `youtube_url`, `google_plus`, `instagram_url`, `pinterest_url`, `linkedin_url`, `google_analytics`, `footer_text`, `fav_icon`, `created_at`) VALUES
(1, 'material_pink', NULL, NULL, NULL, NULL, '', '', '[\"news\",\"complain\"]', '', '', '', '', '', '', '', '', '', '', '2020-02-28 13:48:32');

-- --------------------------------------------------------

--
-- Table structure for table `general_calls`
--

CREATE TABLE `general_calls` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(500) NOT NULL,
  `follow_up_date` date NOT NULL,
  `call_dureation` varchar(50) NOT NULL,
  `note` mediumtext NOT NULL,
  `call_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `exam_type` varchar(250) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `point` float(10,1) DEFAULT NULL,
  `mark_from` float(10,2) DEFAULT NULL,
  `mark_upto` float(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `homework`
--

CREATE TABLE `homework` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `session_id` int(10) NOT NULL,
  `homework_date` date NOT NULL,
  `submit_date` date NOT NULL,
  `staff_id` int(11) NOT NULL,
  `subject_group_subject_id` int(11) DEFAULT NULL,
  `subject_id` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `create_date` date NOT NULL,
  `evaluation_date` date NOT NULL,
  `document` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `evaluated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `homework_evaluation`
--

CREATE TABLE `homework_evaluation` (
  `id` int(11) NOT NULL,
  `homework_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_session_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hostel`
--

CREATE TABLE `hostel` (
  `id` int(11) NOT NULL,
  `hostel_name` varchar(100) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `intake` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hostel_rooms`
--

CREATE TABLE `hostel_rooms` (
  `id` int(11) NOT NULL,
  `hostel_id` int(11) DEFAULT NULL,
  `room_type_id` int(11) DEFAULT NULL,
  `room_no` varchar(200) DEFAULT NULL,
  `no_of_bed` int(11) DEFAULT NULL,
  `cost_per_bed` float(10,2) DEFAULT 0.00,
  `title` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `id_card`
--

CREATE TABLE `id_card` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `school_address` varchar(500) NOT NULL,
  `background` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `sign_image` varchar(100) NOT NULL,
  `header_color` varchar(100) NOT NULL,
  `enable_admission_no` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_student_name` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_class` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_fathers_name` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_mothers_name` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_address` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_phone` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_dob` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_blood_group` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `status` tinyint(1) NOT NULL COMMENT '0=disable,1=enable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `id_card`
--

INSERT INTO `id_card` (`id`, `title`, `school_name`, `school_address`, `background`, `logo`, `sign_image`, `header_color`, `enable_admission_no`, `enable_student_name`, `enable_class`, `enable_fathers_name`, `enable_mothers_name`, `enable_address`, `enable_phone`, `enable_dob`, `enable_blood_group`, `status`) VALUES
(1, 'Sample Student Identity Card', 'Mount Carmel School', '110 Kings Street, CA  Phone: 456542 Email: mount@gmail.com', 'samplebackground12.png', 'samplelogo12.png', 'samplesign12.png', '#595959', 1, 1, 1, 1, 0, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(11) NOT NULL,
  `inc_head_id` varchar(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `invoice_no` varchar(200) NOT NULL,
  `date` date DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `note` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'yes',
  `is_deleted` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  `documents` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `income_head`
--

CREATE TABLE `income_head` (
  `id` int(255) NOT NULL,
  `income_category` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` varchar(255) NOT NULL DEFAULT 'yes',
  `is_deleted` varchar(255) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `item_category_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `item_photo` varchar(225) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  `item_store_id` int(11) DEFAULT NULL,
  `item_supplier_id` int(11) DEFAULT NULL,
  `quantity` int(100) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

CREATE TABLE `item_category` (
  `id` int(255) NOT NULL,
  `item_category` varchar(255) NOT NULL,
  `is_active` varchar(255) NOT NULL DEFAULT 'yes',
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `item_issue`
--

CREATE TABLE `item_issue` (
  `id` int(11) NOT NULL,
  `issue_type` varchar(15) DEFAULT NULL,
  `issue_to` varchar(100) DEFAULT NULL,
  `issue_by` varchar(100) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `item_category_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(10) NOT NULL,
  `note` text NOT NULL,
  `is_returned` int(2) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` varchar(10) DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `item_stock`
--

CREATE TABLE `item_stock` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `symbol` varchar(10) NOT NULL DEFAULT '+',
  `store_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `purchase_price` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `attachment` varchar(250) DEFAULT NULL,
  `description` text NOT NULL,
  `is_active` varchar(10) DEFAULT 'yes',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `item_store`
--

CREATE TABLE `item_store` (
  `id` int(255) NOT NULL,
  `item_store` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `item_supplier`
--

CREATE TABLE `item_supplier` (
  `id` int(255) NOT NULL,
  `item_supplier` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_person_name` varchar(255) NOT NULL,
  `contact_person_phone` varchar(255) NOT NULL,
  `contact_person_email` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `language` varchar(50) DEFAULT NULL,
  `short_code` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `is_deleted` varchar(10) NOT NULL DEFAULT 'yes',
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language`, `short_code`, `country_code`, `is_deleted`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Azerbaijan', 'az', 'az', 'no', 'no', '2019-11-20 11:23:12', '0000-00-00'),
(2, 'Albanian', 'sq', 'al', 'no', 'no', '2019-11-20 11:42:42', '0000-00-00'),
(3, 'Amharic', 'am', 'am', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(4, 'English', 'en', 'us', 'no', 'no', '2019-11-20 11:38:50', '0000-00-00'),
(5, 'Arabic', 'ar', 'sa', 'no', 'no', '2019-11-20 11:47:28', '0000-00-00'),
(7, 'Afrikaans', 'af', 'af', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(8, 'Basque', 'eu', 'es', 'no', 'no', '2019-11-20 11:54:10', '0000-00-00'),
(11, 'Bengali', 'bn', 'in', 'no', 'no', '2019-11-20 11:41:53', '0000-00-00'),
(13, 'Bosnian', 'bs', 'bs', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(14, 'Welsh', 'cy', 'cy', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(15, 'Hungarian', 'hu', 'hu', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(16, 'Vietnamese', 'vi', 'vi', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(17, 'Haitian (Creole)', 'ht', 'ht', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(18, 'Galician', 'gl', 'gl', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(19, 'Dutch', 'nl', 'nl', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(21, 'Greek', 'el', 'gr', 'no', 'no', '2019-11-20 12:12:08', '0000-00-00'),
(22, 'Georgian', 'ka', 'ge', 'no', 'no', '2019-11-20 12:11:40', '0000-00-00'),
(23, 'Gujarati', 'gu', 'in', 'no', 'no', '2019-11-20 11:39:16', '0000-00-00'),
(24, 'Danish', 'da', 'dk', 'no', 'no', '2019-11-20 12:03:25', '0000-00-00'),
(25, 'Hebrew', 'he', 'il', 'no', 'no', '2019-11-20 12:13:50', '0000-00-00'),
(26, 'Yiddish', 'yi', 'il', 'no', 'no', '2019-11-20 12:25:33', '0000-00-00'),
(27, 'Indonesian', 'id', 'id', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(28, 'Irish', 'ga', 'ga', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(29, 'Italian', 'it', 'it', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(30, 'Icelandic', 'is', 'is', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(31, 'Spanish', 'es', 'es', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(33, 'Kannada', 'kn', 'kn', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(34, 'Catalan', 'ca', 'ca', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(36, 'Chinese', 'zh', 'cn', 'no', 'no', '2019-11-20 12:01:48', '0000-00-00'),
(37, 'Korean', 'ko', 'kr', 'no', 'no', '2019-11-20 12:19:09', '0000-00-00'),
(38, 'Xhosa', 'xh', 'ls', 'no', 'no', '2019-11-20 12:24:39', '0000-00-00'),
(39, 'Latin', 'la', 'la', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(40, 'Latvian', 'lv', 'lv', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(41, 'Lithuanian', 'lt', 'lt', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(43, 'Malagasy', 'mg', 'mg', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(44, 'Malay', 'ms', 'ms', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(45, 'Malayalam', 'ml', 'ml', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(46, 'Maltese', 'mt', 'mt', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(47, 'Macedonian', 'mk', 'mk', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(48, 'Maori', 'mi', 'nz', 'no', 'no', '2019-11-20 12:20:27', '0000-00-00'),
(49, 'Marathi', 'mr', 'in', 'no', 'no', '2019-11-20 11:39:51', '0000-00-00'),
(51, 'Mongolian', 'mn', 'mn', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(52, 'German', 'de', 'de', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(53, 'Nepali', 'ne', 'ne', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(54, 'Norwegian', 'no', 'no', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(55, 'Punjabi', 'pa', 'in', 'no', 'no', '2019-11-20 11:40:16', '0000-00-00'),
(57, 'Persian', 'fa', 'ir', 'no', 'no', '2019-11-20 12:21:17', '0000-00-00'),
(59, 'Portuguese', 'pt', 'pt', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(60, 'Romanian', 'ro', 'ro', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(61, 'Russian', 'ru', 'ru', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(62, 'Cebuano', 'ceb', 'ph', 'no', 'no', '2019-11-20 11:59:12', '0000-00-00'),
(64, 'Sinhala', 'si', 'si', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(65, 'Slovakian', 'sk', 'sk', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(66, 'Slovenian', 'sl', 'sl', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(67, 'Swahili', 'sw', 'ke', 'no', 'no', '2019-11-20 12:21:57', '0000-00-00'),
(68, 'Sundanese', 'su', 'sd', 'no', 'no', '2019-12-03 11:06:57', '0000-00-00'),
(70, 'Thai', 'th', 'th', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(71, 'Tagalog', 'tl', 'tl', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(72, 'Tamil', 'ta', 'in', 'no', 'no', '2019-11-20 11:40:53', '0000-00-00'),
(74, 'Telugu', 'te', 'in', 'no', 'no', '2019-11-20 11:41:15', '0000-00-00'),
(75, 'Turkish', 'tr', 'tr', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(77, 'Uzbek', 'uz', 'uz', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(79, 'Urdu', 'ur', 'pk', 'no', 'no', '2019-11-20 12:23:57', '0000-00-00'),
(80, 'Finnish', 'fi', 'fi', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(81, 'French', 'fr', 'fr', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(82, 'Hindi', 'hi', 'in', 'no', 'no', '2019-11-20 11:36:34', '0000-00-00'),
(84, 'Czech', 'cs', 'cz', 'no', 'no', '2019-11-20 12:02:36', '0000-00-00'),
(85, 'Swedish', 'sv', 'sv', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(86, 'Scottish', 'gd', 'gd', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(87, 'Estonian', 'et', 'et', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(88, 'Esperanto', 'eo', 'br', 'no', 'no', '2019-11-21 04:49:18', '0000-00-00'),
(89, 'Javanese', 'jv', 'id', 'no', 'no', '2019-11-20 12:18:29', '0000-00-00'),
(90, 'Japanese', 'ja', 'jp', 'no', 'no', '2019-11-20 12:14:39', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `id` int(11) NOT NULL,
  `type` varchar(200) NOT NULL,
  `is_active` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `libarary_members`
--

CREATE TABLE `libarary_members` (
  `id` int(11) UNSIGNED NOT NULL,
  `library_card_no` varchar(50) DEFAULT NULL,
  `member_type` varchar(50) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `record_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `platform` varchar(50) DEFAULT NULL,
  `agent` varchar(50) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `send_mail` varchar(10) DEFAULT '0',
  `send_sms` varchar(10) DEFAULT '0',
  `is_group` varchar(10) DEFAULT '0',
  `is_individual` varchar(10) DEFAULT '0',
  `is_class` int(10) NOT NULL DEFAULT 0,
  `group_list` text DEFAULT NULL,
  `user_list` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `multi_class_students`
--

CREATE TABLE `multi_class_students` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `student_session_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notification_roles`
--

CREATE TABLE `notification_roles` (
  `id` int(11) NOT NULL,
  `send_notification_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notification_setting`
--

CREATE TABLE `notification_setting` (
  `id` int(11) NOT NULL,
  `type` varchar(100) DEFAULT NULL,
  `is_mail` varchar(10) DEFAULT '0',
  `is_sms` varchar(10) DEFAULT '0',
  `is_notification` int(11) NOT NULL DEFAULT 0,
  `display_notification` int(11) NOT NULL DEFAULT 0,
  `template` longtext NOT NULL,
  `variables` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notification_setting`
--

INSERT INTO `notification_setting` (`id`, `type`, `is_mail`, `is_sms`, `is_notification`, `display_notification`, `template`, `variables`, `created_at`) VALUES
(1, 'student_admission', '1', '0', 0, 0, 'Dear {{firstname}} {{lastname}} your admission is confirm in Class: {{class}} Section:  {{section}} for Session: {{current_session_name}} for more detail contact System Admin\r\n{{firstname}} {{lastname}} {{class}} {{section}} {{admission_no}} {{roll_no}} {{admission_date}} {{mobileno}} {{email}} {{dob}} {{guardian_name}} {{guardian_relation}} {{guardian_phone}} {{father_name}} {{father_phone}} {{blood_group}} {{mother_name}} {{gender}} {{guardian_email}}', '{{firstname}}  {{lastname}}  {{class}}  {{section}}  {{admission_no}}  {{roll_no}}  {{admission_date}}   {{mobileno}}  {{email}}  {{dob}}  {{guardian_name}}  {{guardian_relation}}  {{guardian_phone}}  {{father_name}}  {{father_phone}}  {{blood_group}}  {{mother_name}}  {{gender}}  {{guardian_email}} {{current_session_name}}', '2020-02-01 08:58:40'),
(2, 'exam_result', '1', '0', 0, 1, 'Dear {{student_name}} - {{exam_roll_no}}, your {{exam}} result has been published.', '{{student_name}} {{exam_name}} {{total_marks}} {{achive_marks}} {{result}}', '2020-01-20 16:09:22'),
(3, 'fee_submission', '1', '0', 0, 1, 'Dear parents, we have received  Fees Amount {{fee_amount}} for  {{firstname}} {{lastname}}  by Your School Name', ' {{firstname}} {{lastname}} {{class}} {{section}} {{fine_type}} {{fine_percentage}} {{fine_amount}} {{fee_group_name}} {{type}} {{code}} {{email}} {{contact_no}} {{invoice_id}} {{sub_invoice_id}} {{due_date}} {{amount}} {{fee_amount}}', '2020-02-08 17:23:20'),
(4, 'absent_attendence', '1', '0', 0, 1, 'Absent Notice :{{firstname}} {{lastname}}  was absent on date {{date}} in period {{subject_name}} {{subject_code}} {{subject_type}} from Your School Name', '{{firstname}} {{lastname}} {{mobileno}} {{email}} {{father_name}} {{father_phone}} {{father_occupation}} {{mother_name}} {{mother_phone}} {{guardian_name}} {{guardian_phone}} {{guardian_occupation}} {{guardian_email}} {{date}} {{current_session_name}}             {{time_from}} {{time_to}} {{subject_name}} {{subject_code}} {{subject_type}} ', '2020-02-08 17:33:13'),
(5, 'login_credential', '1', '0', 0, 0, 'Hello {{display_name}} your login details for Url: {{url}} Username: {{username}}  Password: {{password}}', '{{url}} {{display_name}} {{username}} {{password}}', '2020-02-08 15:55:33'),
(6, 'homework', '1', '0', 0, 1, 'New Homework has been created for {{student_name}} at {{homework_date}} for the class {{class}} {{section}} {{subject}}. kindly submit your homework before {{submit_date}} .Thank you', '{{homework_date}} {{submit_date}} {{class}} {{section}} {{subject}} {{student_name}}', '2020-02-08 15:55:33'),
(7, 'fees_reminder', '1', '0', 0, 1, 'Dear parents, please pay fee amount Rs.{{due_amount}} of {{fee_type}} before {{due_date}} for {{firstname}} {{lastname}} from smart school (ignore if you already paid)', '{{fee_type}}{{fee_code}}{{due_date}}{{firstname}} {{lastname}}{{school_name}}{{fee_amount}}{{due_amount}}{{deposit_amount}}', '2020-02-08 15:55:33');

-- --------------------------------------------------------

--
-- Table structure for table `onlineexam`
--

CREATE TABLE `onlineexam` (
  `id` int(11) NOT NULL,
  `exam` text DEFAULT NULL,
  `attempt` int(11) NOT NULL,
  `exam_from` date DEFAULT NULL,
  `exam_to` date DEFAULT NULL,
  `time_from` time DEFAULT NULL,
  `time_to` time DEFAULT NULL,
  `duration` time NOT NULL,
  `passing_percentage` float NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `publish_result` int(11) NOT NULL DEFAULT 0,
  `is_active` varchar(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `onlineexam_attempts`
--

CREATE TABLE `onlineexam_attempts` (
  `id` int(11) NOT NULL,
  `onlineexam_student_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `onlineexam_questions`
--

CREATE TABLE `onlineexam_questions` (
  `id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `onlineexam_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `is_active` varchar(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `onlineexam_students`
--

CREATE TABLE `onlineexam_students` (
  `id` int(11) NOT NULL,
  `onlineexam_id` int(11) DEFAULT NULL,
  `student_session_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `onlineexam_student_results`
--

CREATE TABLE `onlineexam_student_results` (
  `id` int(11) NOT NULL,
  `onlineexam_student_id` int(11) NOT NULL,
  `onlineexam_question_id` int(11) NOT NULL,
  `select_option` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `online_admissions`
--

CREATE TABLE `online_admissions` (
  `id` int(11) NOT NULL,
  `admission_no` varchar(100) DEFAULT NULL,
  `roll_no` varchar(100) DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `rte` varchar(20) NOT NULL DEFAULT 'No',
  `image` varchar(100) DEFAULT NULL,
  `mobileno` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `pincode` varchar(100) DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `cast` varchar(50) NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `current_address` text DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `class_section_id` int(11) DEFAULT NULL,
  `route_id` int(11) NOT NULL,
  `school_house_id` int(11) DEFAULT NULL,
  `blood_group` varchar(200) NOT NULL,
  `vehroute_id` int(11) NOT NULL,
  `hostel_room_id` int(11) NOT NULL,
  `adhar_no` varchar(100) DEFAULT NULL,
  `samagra_id` varchar(100) DEFAULT NULL,
  `bank_account_no` varchar(100) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `ifsc_code` varchar(100) DEFAULT NULL,
  `guardian_is` varchar(100) NOT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `father_phone` varchar(100) DEFAULT NULL,
  `father_occupation` varchar(100) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `mother_phone` varchar(100) DEFAULT NULL,
  `mother_occupation` varchar(100) DEFAULT NULL,
  `guardian_name` varchar(100) DEFAULT NULL,
  `guardian_relation` varchar(100) DEFAULT NULL,
  `guardian_phone` varchar(100) DEFAULT NULL,
  `guardian_occupation` varchar(150) NOT NULL,
  `guardian_address` text DEFAULT NULL,
  `guardian_email` varchar(100) NOT NULL,
  `father_pic` varchar(200) NOT NULL,
  `mother_pic` varchar(200) NOT NULL,
  `guardian_pic` varchar(200) NOT NULL,
  `is_enroll` int(255) DEFAULT 0,
  `previous_school` text DEFAULT NULL,
  `height` varchar(100) NOT NULL,
  `weight` varchar(100) NOT NULL,
  `note` varchar(200) NOT NULL,
  `measurement_date` date DEFAULT NULL,
  `app_key` text DEFAULT NULL,
  `document` text DEFAULT NULL,
  `disable_at` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment_settings`
--

CREATE TABLE `payment_settings` (
  `id` int(11) NOT NULL,
  `payment_type` varchar(200) NOT NULL,
  `api_username` varchar(200) DEFAULT NULL,
  `api_secret_key` varchar(200) NOT NULL,
  `salt` varchar(200) NOT NULL,
  `api_publishable_key` varchar(200) NOT NULL,
  `api_password` varchar(200) DEFAULT NULL,
  `api_signature` varchar(200) DEFAULT NULL,
  `api_email` varchar(200) DEFAULT NULL,
  `paypal_demo` varchar(100) NOT NULL,
  `account_no` varchar(200) NOT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_settings`
--

INSERT INTO `payment_settings` (`id`, `payment_type`, `api_username`, `api_secret_key`, `salt`, `api_publishable_key`, `api_password`, `api_signature`, `api_email`, `paypal_demo`, `account_no`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'paypal', NULL, '', '', '', NULL, NULL, NULL, 'FALSE', '', 'no', '2020-02-28 13:31:52', NULL),
(2, 'stripe', NULL, '', '', '', NULL, NULL, NULL, '', '', 'no', '2020-02-28 13:29:05', NULL),
(3, 'payu', NULL, '', '', '', NULL, NULL, NULL, '', '', 'no', '2020-02-28 13:29:02', NULL),
(4, 'ccavenue', NULL, '', '', '', NULL, NULL, NULL, '', '', 'no', '2020-02-28 13:28:57', NULL),
(5, 'paystack', NULL, '', '', '', NULL, NULL, NULL, '', '', 'no', '2020-02-28 13:20:04', NULL),
(6, 'instamojo', NULL, '', '', '', NULL, NULL, NULL, '', '', 'no', '2020-02-28 13:29:50', NULL),
(7, 'razorpay', NULL, '', '', '', NULL, NULL, NULL, '', '', 'no', '2020-02-28 13:21:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payslip_allowance`
--

CREATE TABLE `payslip_allowance` (
  `id` int(11) NOT NULL,
  `payslip_id` int(11) NOT NULL,
  `allowance_type` varchar(200) NOT NULL,
  `amount` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `cal_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `permission_category`
--

CREATE TABLE `permission_category` (
  `id` int(11) NOT NULL,
  `perm_group_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `short_code` varchar(100) DEFAULT NULL,
  `enable_view` int(11) DEFAULT 0,
  `enable_add` int(11) DEFAULT 0,
  `enable_edit` int(11) DEFAULT 0,
  `enable_delete` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permission_category`
--

INSERT INTO `permission_category` (`id`, `perm_group_id`, `name`, `short_code`, `enable_view`, `enable_add`, `enable_edit`, `enable_delete`, `created_at`) VALUES
(1, 1, 'Student', 'student', 1, 1, 1, 1, '2019-10-24 11:12:03'),
(2, 1, 'Import Student', 'import_student', 1, 0, 0, 0, '2018-06-22 15:47:19'),
(3, 1, 'Student Categories', 'student_categories', 1, 1, 1, 1, '2018-06-22 15:47:36'),
(4, 1, 'Student Houses', 'student_houses', 1, 1, 1, 1, '2018-06-22 15:47:53'),
(5, 2, 'Collect Fees', 'collect_fees', 1, 1, 0, 1, '2018-06-22 15:51:03'),
(6, 2, 'Fees Carry Forward', 'fees_carry_forward', 1, 0, 0, 0, '2018-06-27 05:48:15'),
(7, 2, 'Fees Master', 'fees_master', 1, 1, 1, 1, '2018-06-27 05:48:57'),
(8, 2, 'Fees Group', 'fees_group', 1, 1, 1, 1, '2018-06-22 15:51:46'),
(9, 3, 'Income', 'income', 1, 1, 1, 1, '2018-06-22 15:53:21'),
(10, 3, 'Income Head', 'income_head', 1, 1, 1, 1, '2018-06-22 15:52:44'),
(11, 3, 'Search Income', 'search_income', 1, 0, 0, 0, '2018-06-22 15:53:00'),
(12, 4, 'Expense', 'expense', 1, 1, 1, 1, '2018-06-22 15:54:06'),
(13, 4, 'Expense Head', 'expense_head', 1, 1, 1, 1, '2018-06-22 15:53:47'),
(14, 4, 'Search Expense', 'search_expense', 1, 0, 0, 0, '2018-06-22 15:54:13'),
(15, 5, 'Student / Period Attendance', 'student_attendance', 1, 1, 1, 0, '2019-11-29 06:49:05'),
(20, 6, 'Marks Grade', 'marks_grade', 1, 1, 1, 1, '2018-06-22 15:55:25'),
(21, 7, 'Class Timetable', 'class_timetable', 1, 0, 1, 0, '2019-11-24 08:35:17'),
(23, 7, 'Subject', 'subject', 1, 1, 1, 1, '2018-06-22 16:02:17'),
(24, 7, 'Class', 'class', 1, 1, 1, 1, '2018-06-22 16:02:35'),
(25, 7, 'Section', 'section', 1, 1, 1, 1, '2018-06-22 16:01:10'),
(26, 7, 'Promote Student', 'promote_student', 1, 0, 0, 0, '2018-06-22 16:02:47'),
(27, 8, 'Upload Content', 'upload_content', 1, 1, 0, 1, '2018-06-22 16:03:19'),
(28, 9, 'Books List', 'books', 1, 1, 1, 1, '2019-11-24 06:07:12'),
(29, 9, 'Issue Return', 'issue_return', 1, 0, 0, 0, '2019-11-24 06:07:18'),
(30, 9, 'Add Staff Member', 'add_staff_member', 1, 0, 0, 0, '2018-07-02 17:07:00'),
(31, 10, 'Issue Item', 'issue_item', 1, 1, 1, 1, '2019-11-29 12:09:27'),
(32, 10, 'Add Item Stock', 'item_stock', 1, 1, 1, 1, '2019-11-24 06:09:17'),
(33, 10, 'Add Item', 'item', 1, 1, 1, 1, '2019-11-24 06:09:39'),
(34, 10, 'Item Store', 'store', 1, 1, 1, 1, '2019-11-24 06:10:41'),
(35, 10, 'Item Supplier', 'supplier', 1, 1, 1, 1, '2019-11-24 06:10:49'),
(37, 11, 'Routes', 'routes', 1, 1, 1, 1, '2018-06-22 16:09:17'),
(38, 11, 'Vehicle', 'vehicle', 1, 1, 1, 1, '2018-06-22 16:09:36'),
(39, 11, 'Assign Vehicle', 'assign_vehicle', 1, 1, 1, 1, '2018-06-27 10:09:20'),
(40, 12, 'Hostel', 'hostel', 1, 1, 1, 1, '2018-06-22 16:10:49'),
(41, 12, 'Room Type', 'room_type', 1, 1, 1, 1, '2018-06-22 16:10:27'),
(42, 12, 'Hostel Rooms', 'hostel_rooms', 1, 1, 1, 1, '2018-06-25 11:53:03'),
(43, 13, 'Notice Board', 'notice_board', 1, 1, 1, 1, '2018-06-22 16:11:17'),
(44, 13, 'Email', 'email', 1, 0, 0, 0, '2019-11-26 10:50:37'),
(46, 13, 'Email / SMS Log', 'email_sms_log', 1, 0, 0, 0, '2018-06-22 16:11:23'),
(53, 15, 'Languages', 'languages', 0, 1, 0, 0, '2018-06-22 16:13:18'),
(54, 15, 'General Setting', 'general_setting', 1, 0, 1, 0, '2018-07-05 14:38:35'),
(55, 15, 'Session Setting', 'session_setting', 1, 1, 1, 1, '2018-06-22 16:14:15'),
(56, 15, 'Notification Setting', 'notification_setting', 1, 0, 1, 0, '2018-07-05 14:38:41'),
(57, 15, 'SMS Setting', 'sms_setting', 1, 0, 1, 0, '2018-07-05 14:38:47'),
(58, 15, 'Email Setting', 'email_setting', 1, 0, 1, 0, '2018-07-05 14:38:51'),
(59, 15, 'Front CMS Setting', 'front_cms_setting', 1, 0, 1, 0, '2018-07-05 14:38:55'),
(60, 15, 'Payment Methods', 'payment_methods', 1, 0, 1, 0, '2018-07-05 14:38:59'),
(61, 16, 'Menus', 'menus', 1, 1, 0, 1, '2018-07-09 09:20:06'),
(62, 16, 'Media Manager', 'media_manager', 1, 1, 0, 1, '2018-07-09 09:20:26'),
(63, 16, 'Banner Images', 'banner_images', 1, 1, 0, 1, '2018-06-22 16:16:02'),
(64, 16, 'Pages', 'pages', 1, 1, 1, 1, '2018-06-22 16:16:21'),
(65, 16, 'Gallery', 'gallery', 1, 1, 1, 1, '2018-06-22 16:17:02'),
(66, 16, 'Event', 'event', 1, 1, 1, 1, '2018-06-22 16:17:20'),
(67, 16, 'News', 'notice', 1, 1, 1, 1, '2018-07-03 14:09:34'),
(68, 2, 'Fees Group Assign', 'fees_group_assign', 1, 0, 0, 0, '2018-06-22 15:50:42'),
(69, 2, 'Fees Type', 'fees_type', 1, 1, 1, 1, '2018-06-22 15:49:34'),
(70, 2, 'Fees Discount', 'fees_discount', 1, 1, 1, 1, '2018-06-22 15:50:10'),
(71, 2, 'Fees Discount Assign', 'fees_discount_assign', 1, 0, 0, 0, '2018-06-22 15:50:17'),
(73, 2, 'Search Fees Payment', 'search_fees_payment', 1, 0, 0, 0, '2018-06-22 15:50:27'),
(74, 2, 'Search Due Fees', 'search_due_fees', 1, 0, 0, 0, '2018-06-22 15:50:35'),
(77, 7, 'Assign Class Teacher', 'assign_class_teacher', 1, 1, 1, 1, '2018-06-22 16:00:52'),
(78, 17, 'Admission Enquiry', 'admission_enquiry', 1, 1, 1, 1, '2018-06-22 16:21:24'),
(79, 17, 'Follow Up Admission Enquiry', 'follow_up_admission_enquiry', 1, 1, 0, 1, '2018-06-22 16:21:39'),
(80, 17, 'Visitor Book', 'visitor_book', 1, 1, 1, 1, '2018-06-22 16:18:58'),
(81, 17, 'Phone Call Log', 'phone_call_log', 1, 1, 1, 1, '2018-06-22 16:20:57'),
(82, 17, 'Postal Dispatch', 'postal_dispatch', 1, 1, 1, 1, '2018-06-22 16:20:21'),
(83, 17, 'Postal Receive', 'postal_receive', 1, 1, 1, 1, '2018-06-22 16:20:04'),
(84, 17, 'Complain', 'complaint', 1, 1, 1, 1, '2018-07-03 14:10:55'),
(85, 17, 'Setup Font Office', 'setup_font_office', 1, 1, 1, 1, '2018-06-22 16:19:24'),
(86, 18, 'Staff', 'staff', 1, 1, 1, 1, '2018-06-22 16:23:31'),
(87, 18, 'Disable Staff', 'disable_staff', 1, 0, 0, 0, '2018-06-22 16:23:12'),
(88, 18, 'Staff Attendance', 'staff_attendance', 1, 1, 1, 0, '2018-06-22 16:23:10'),
(90, 18, 'Staff Payroll', 'staff_payroll', 1, 1, 0, 1, '2018-06-22 16:22:51'),
(93, 19, 'Homework', 'homework', 1, 1, 1, 1, '2018-06-22 16:23:50'),
(94, 19, 'Homework Evaluation', 'homework_evaluation', 1, 1, 0, 0, '2018-06-27 08:37:21'),
(96, 20, 'Student Certificate', 'student_certificate', 1, 1, 1, 1, '2018-07-06 16:11:07'),
(97, 20, 'Generate Certificate', 'generate_certificate', 1, 0, 0, 0, '2018-07-06 16:07:16'),
(98, 20, 'Student ID Card', 'student_id_card', 1, 1, 1, 1, '2018-07-06 16:11:28'),
(99, 20, 'Generate ID Card', 'generate_id_card', 1, 0, 0, 0, '2018-07-06 16:11:49'),
(102, 21, 'Calendar To Do List', 'calendar_to_do_list', 1, 1, 1, 1, '2018-06-22 16:24:41'),
(104, 10, 'Item Category', 'item_category', 1, 1, 1, 1, '2018-06-22 16:04:33'),
(106, 22, 'Quick Session Change', 'quick_session_change', 1, 0, 0, 0, '2018-06-22 16:24:45'),
(107, 1, 'Disable Student', 'disable_student', 1, 0, 0, 0, '2018-06-25 11:51:34'),
(108, 18, ' Approve Leave Request', 'approve_leave_request', 1, 0, 1, 0, '2019-11-29 05:17:51'),
(109, 18, 'Apply Leave', 'apply_leave', 1, 1, 0, 0, '2019-11-29 05:17:46'),
(110, 18, 'Leave Types ', 'leave_types', 1, 1, 1, 1, '2018-07-02 15:47:56'),
(111, 18, 'Department', 'department', 1, 1, 1, 1, '2018-06-26 09:27:07'),
(112, 18, 'Designation', 'designation', 1, 1, 1, 1, '2018-06-26 09:27:07'),
(113, 22, 'Fees Collection And Expense Monthly Chart', 'fees_collection_and_expense_monthly_chart', 1, 0, 0, 0, '2018-07-03 12:38:15'),
(114, 22, 'Fees Collection And Expense Yearly Chart', 'fees_collection_and_expense_yearly_chart', 1, 0, 0, 0, '2018-07-03 12:38:15'),
(115, 22, 'Monthly Fees Collection Widget', 'Monthly fees_collection_widget', 1, 0, 0, 0, '2018-07-03 12:43:35'),
(116, 22, 'Monthly Expense Widget', 'monthly_expense_widget', 1, 0, 0, 0, '2018-07-03 12:43:35'),
(117, 22, 'Student Count Widget', 'student_count_widget', 1, 0, 0, 0, '2018-07-03 12:43:35'),
(118, 22, 'Staff Role Count Widget', 'staff_role_count_widget', 1, 0, 0, 0, '2018-07-03 12:43:35'),
(122, 5, 'Attendance By Date', 'attendance_by_date', 1, 0, 0, 0, '2018-07-03 14:12:29'),
(123, 9, 'Add Student', 'add_student', 1, 0, 0, 0, '2018-07-03 14:12:29'),
(126, 15, 'User Status', 'user_status', 1, 0, 0, 0, '2018-07-03 14:12:29'),
(127, 18, 'Can See Other Users Profile', 'can_see_other_users_profile', 1, 0, 0, 0, '2018-07-03 14:12:29'),
(128, 1, 'Student Timeline', 'student_timeline', 0, 1, 0, 1, '2018-07-05 13:38:52'),
(129, 18, 'Staff Timeline', 'staff_timeline', 0, 1, 0, 1, '2018-07-05 13:38:52'),
(130, 15, 'Backup', 'backup', 1, 1, 0, 1, '2018-07-09 09:47:17'),
(131, 15, 'Restore', 'restore', 1, 0, 0, 0, '2018-07-09 09:47:17'),
(134, 1, 'Disable Reason', 'disable_reason', 1, 1, 1, 1, '2019-11-27 12:09:21'),
(135, 2, 'Fees Reminder', 'fees_reminder', 1, 0, 1, 0, '2019-10-25 06:09:49'),
(136, 5, 'Approve Leave', 'approve_leave', 1, 0, 0, 0, '2019-10-25 06:16:44'),
(137, 6, 'Exam Group', 'exam_group', 1, 1, 1, 1, '2019-10-25 06:32:34'),
(141, 6, 'Design Admit Card', 'design_admit_card', 1, 1, 1, 1, '2019-10-25 06:36:59'),
(142, 6, 'Print Admit Card', 'print_admit_card', 1, 0, 0, 0, '2019-11-24 05:27:51'),
(143, 6, 'Design Marksheet', 'design_marksheet', 1, 1, 1, 1, '2019-10-25 06:40:25'),
(144, 6, 'Print Marksheet', 'print_marksheet', 1, 0, 0, 0, '2019-10-25 06:41:02'),
(145, 7, 'Teachers Timetable', 'teachers_time_table', 1, 0, 0, 0, '2019-11-30 08:22:21'),
(146, 14, 'Student Report', 'student_report', 1, 0, 0, 0, '2019-10-25 06:57:00'),
(147, 14, 'Guardian Report', 'guardian_report', 1, 0, 0, 0, '2019-10-25 07:00:27'),
(148, 14, 'Student History', 'student_history', 1, 0, 0, 0, '2019-10-25 07:09:07'),
(149, 14, 'Student Login Credential Report', 'student_login_credential_report', 1, 0, 0, 0, '2019-10-25 07:09:07'),
(150, 14, 'Class Subject Report', 'class_subject_report', 1, 0, 0, 0, '2019-10-25 07:09:07'),
(151, 14, 'Admission Report', 'admission_report', 1, 0, 0, 0, '2019-10-25 07:09:07'),
(152, 14, 'Sibling Report', 'sibling_report', 1, 0, 0, 0, '2019-10-25 07:09:07'),
(153, 14, 'Homework Evaluation Report', 'homehork_evaluation_report', 1, 0, 0, 0, '2019-11-24 06:34:24'),
(154, 14, 'Student Profile', 'student_profile', 1, 0, 0, 0, '2019-10-25 07:09:07'),
(155, 14, 'Fees Statement', 'fees_statement', 1, 0, 0, 0, '2019-10-25 07:25:52'),
(156, 14, 'Balance Fees Report', 'balance_fees_report', 1, 0, 0, 0, '2019-10-25 07:25:52'),
(157, 14, 'Fees Collection Report', 'fees_collection_report', 1, 0, 0, 0, '2019-10-25 07:25:52'),
(158, 14, 'Online Fees Collection Report', 'online_fees_collection_report', 1, 0, 0, 0, '2019-10-25 07:25:52'),
(159, 14, 'Income Report', 'income_report', 1, 0, 0, 0, '2019-10-25 07:25:52'),
(160, 14, 'Expense Report', 'expense_report', 1, 0, 0, 0, '2019-10-25 07:25:52'),
(161, 14, 'PayRoll Report', 'payroll_report', 1, 0, 0, 0, '2019-10-31 05:53:22'),
(162, 14, 'Income Group Report', 'income_group_report', 1, 0, 0, 0, '2019-10-25 07:25:52'),
(163, 14, 'Expense Group Report', 'expense_group_report', 1, 0, 0, 0, '2019-10-25 07:25:52'),
(164, 14, 'Attendance Report', 'attendance_report', 1, 0, 0, 0, '2019-10-25 07:38:06'),
(165, 14, 'Staff Attendance Report', 'staff_attendance_report', 1, 0, 0, 0, '2019-10-25 07:38:06'),
(174, 14, 'Transport Report', 'transport_report', 1, 0, 0, 0, '2019-10-25 07:43:56'),
(175, 14, 'Hostel Report', 'hostel_report', 1, 0, 0, 0, '2019-11-27 12:21:53'),
(176, 14, 'Audit Trail Report', 'audit_trail_report', 1, 0, 0, 0, '2019-10-25 07:46:39'),
(177, 14, 'User Log', 'user_log', 1, 0, 0, 0, '2019-10-25 07:49:27'),
(178, 14, 'Book Issue Report', 'book_issue_report', 1, 0, 0, 0, '2019-10-25 07:59:04'),
(179, 14, 'Book Due Report', 'book_due_report', 1, 0, 0, 0, '2019-10-25 07:59:04'),
(180, 14, 'Book Inventory Report', 'book_inventory_report', 1, 0, 0, 0, '2019-10-25 07:59:04'),
(181, 14, 'Stock Report', 'stock_report', 1, 0, 0, 0, '2019-10-25 08:01:28'),
(182, 14, 'Add Item Report', 'add_item_report', 1, 0, 0, 0, '2019-10-25 08:01:28'),
(183, 14, 'Issue Item Report', 'issue_item_report', 1, 0, 0, 0, '2019-11-29 09:18:06'),
(185, 23, 'Online Examination', 'online_examination', 1, 1, 1, 1, '2019-11-24 05:24:50'),
(186, 23, 'Question Bank', 'question_bank', 1, 1, 1, 1, '2019-11-24 05:25:18'),
(187, 6, 'Exam Result', 'exam_result', 1, 0, 0, 0, '2019-11-24 05:28:50'),
(188, 7, 'Subject Group', 'subject_group', 1, 1, 1, 1, '2019-11-24 06:04:32'),
(189, 18, 'Teachers Rating', 'teachers_rating', 1, 0, 1, 1, '2019-11-24 08:42:54'),
(190, 22, 'Fees Awaiting Payment Widegts', 'fees_awaiting_payment_widegts', 1, 0, 0, 0, '2019-11-24 06:22:51'),
(191, 22, 'Conveted Leads Widegts', 'conveted_leads_widegts', 1, 0, 0, 0, '2019-11-24 06:28:24'),
(192, 22, 'Fees Overview Widegts', 'fees_overview_widegts', 1, 0, 0, 0, '2019-11-24 06:27:41'),
(193, 22, 'Enquiry Overview Widegts', 'enquiry_overview_widegts', 1, 0, 0, 0, '2019-12-02 10:36:09'),
(194, 22, 'Library Overview Widegts', 'book_overview_widegts', 1, 0, 0, 0, '2019-12-01 06:43:04'),
(195, 22, 'Student Today Attendance Widegts', 'today_attendance_widegts', 1, 0, 0, 0, '2019-12-03 10:27:45'),
(196, 6, 'Marks Import', 'marks_import', 1, 0, 0, 0, '2019-11-24 06:32:11'),
(197, 14, 'Student Attendance Type Report', 'student_attendance_type_report', 1, 0, 0, 0, '2019-11-24 06:36:32'),
(198, 14, 'Exam Marks Report', 'exam_marks_report', 1, 0, 0, 0, '2019-11-24 06:41:15'),
(200, 14, 'Online Exam Wise Report', 'online_exam_wise_report', 1, 0, 0, 0, '2019-11-24 06:48:14'),
(201, 14, 'Online Exams Report', 'online_exams_report', 1, 0, 0, 0, '2019-11-29 08:18:05'),
(202, 14, 'Online Exams Attempt Report', 'online_exams_attempt_report', 1, 0, 0, 0, '2019-11-29 08:16:24'),
(203, 14, 'Online Exams Rank Report', 'online_exams_rank_report', 1, 0, 0, 0, '2019-11-24 06:52:25'),
(204, 14, 'Staff Report', 'staff_report', 1, 0, 0, 0, '2019-11-24 06:55:27'),
(205, 6, 'Exam', 'exam', 1, 1, 1, 1, '2019-11-24 10:25:48'),
(207, 6, 'Exam Publish', 'exam_publish', 1, 0, 0, 0, '2019-11-24 10:45:04'),
(208, 6, 'Link Exam', 'link_exam', 1, 0, 1, 0, '2019-11-24 10:45:04'),
(210, 6, 'Assign / View student', 'exam_assign_view_student', 1, 0, 1, 0, '2019-11-24 10:45:04'),
(211, 6, 'Exam Subject', 'exam_subject', 1, 0, 1, 0, '2019-11-24 10:45:04'),
(212, 6, 'Exam Marks', 'exam_marks', 1, 0, 1, 0, '2019-11-24 10:45:04'),
(213, 15, 'Language Switcher', 'language_switcher', 1, 0, 0, 0, '2019-11-24 10:47:11'),
(214, 23, 'Add Questions in Exam ', 'add_questions_in_exam', 1, 0, 1, 0, '2019-11-28 07:08:57'),
(215, 15, 'Custom Fields', 'custom_fields', 1, 0, 0, 0, '2019-11-29 09:38:35'),
(216, 15, 'System Fields', 'system_fields', 1, 0, 0, 0, '2019-11-25 05:45:01'),
(217, 13, 'SMS', 'sms', 1, 0, 0, 0, '2018-06-22 16:10:54'),
(219, 14, 'Student / Period Attendance Report', 'student_period_attendance_report', 1, 0, 0, 0, '2019-11-29 07:49:31'),
(220, 14, 'Biometric Attendance Log', 'biometric_attendance_log', 1, 0, 0, 0, '2019-11-27 11:29:16'),
(221, 14, 'Book Issue Return Report', 'book_issue_return_report', 1, 0, 0, 0, '2019-11-27 12:00:23'),
(222, 23, 'Assign / View Student', 'online_assign_view_student', 1, 0, 1, 0, '2019-11-28 09:50:22'),
(223, 14, 'Rank Report', 'rank_report', 1, 0, 0, 0, '2019-11-29 08:00:21'),
(224, 25, 'Chat', 'chat', 1, 0, 0, 0, '2019-11-29 09:40:28'),
(226, 22, 'Income Donut Graph', 'income_donut_graph', 1, 0, 0, 0, '2019-11-29 10:30:33'),
(227, 22, 'Expense Donut Graph', 'expense_donut_graph', 1, 0, 0, 0, '2019-11-29 10:31:10'),
(228, 9, 'Import Book', 'import_book', 1, 0, 0, 0, '2019-11-29 11:51:01'),
(229, 22, 'Staff Present Today Widegts', 'staff_present_today_widegts', 1, 0, 0, 0, '2019-11-29 12:18:00'),
(230, 22, 'Student Present Today Widegts', 'student_present_today_widegts', 1, 0, 0, 0, '2019-11-29 12:17:42'),
(231, 26, 'Multi Class Student', 'multi_class_student', 1, 0, 0, 0, '2019-12-02 11:32:58'),
(232, 27, 'Online Admission', 'online_admission', 1, 0, 1, 1, '2019-12-02 11:41:10'),
(233, 15, 'Print Header Footer', 'print_header_footer', 1, 0, 0, 0, '2020-02-12 07:32:02');

-- --------------------------------------------------------

--
-- Table structure for table `permission_group`
--

CREATE TABLE `permission_group` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `short_code` varchar(100) NOT NULL,
  `is_active` int(11) DEFAULT 0,
  `system` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permission_group`
--

INSERT INTO `permission_group` (`id`, `name`, `short_code`, `is_active`, `system`, `created_at`) VALUES
(1, 'Student Information', 'student_information', 1, 1, '2019-03-15 15:00:22'),
(2, 'Fees Collection', 'fees_collection', 1, 0, '2019-12-01 14:08:13'),
(3, 'Income', 'income', 1, 0, '2019-03-15 14:36:20'),
(4, 'Expense', 'expense', 1, 0, '2019-03-15 14:36:22'),
(5, 'Student Attendance', 'student_attendance', 1, 0, '2018-07-02 13:18:08'),
(6, 'Examination', 'examination', 1, 0, '2018-07-11 08:19:08'),
(7, 'Academics', 'academics', 1, 1, '2018-07-02 12:55:43'),
(8, 'Download Center', 'download_center', 1, 0, '2018-07-02 13:19:29'),
(9, 'Library', 'library', 1, 0, '2018-06-28 16:43:14'),
(10, 'Inventory', 'inventory', 1, 0, '2018-06-27 06:18:58'),
(11, 'Transport', 'transport', 1, 0, '2018-06-27 13:21:26'),
(12, 'Hostel', 'hostel', 1, 0, '2018-07-02 13:19:32'),
(13, 'Communicate', 'communicate', 1, 0, '2018-07-02 13:20:00'),
(14, 'Reports', 'reports', 1, 1, '2018-06-27 09:10:22'),
(15, 'System Settings', 'system_settings', 1, 1, '2018-06-27 09:10:28'),
(16, 'Front CMS', 'front_cms', 1, 0, '2018-07-10 10:46:54'),
(17, 'Front Office', 'front_office', 1, 0, '2018-06-27 09:15:30'),
(18, 'Human Resource', 'human_resource', 1, 1, '2018-06-27 09:11:02'),
(19, 'Homework', 'homework', 1, 0, '2018-06-27 06:19:38'),
(20, 'Certificate', 'certificate', 1, 0, '2018-06-27 13:21:29'),
(21, 'Calendar To Do List', 'calendar_to_do_list', 1, 0, '2019-03-15 14:36:25'),
(22, 'Dashboard and Widgets', 'dashboard_and_widgets', 1, 1, '2018-06-27 09:11:17'),
(23, 'Online Examination', 'online_examination', 1, 0, '2019-11-24 05:24:02'),
(25, 'Chat', 'chat', 1, 0, '2019-11-24 05:24:04'),
(26, 'Multi Class', 'multi_class', 1, 0, '2019-11-27 17:44:14'),
(27, 'Online Admission', 'online_admission', 1, 0, '2019-11-27 08:12:13');

-- --------------------------------------------------------

--
-- Table structure for table `permission_parent`
--

CREATE TABLE `permission_parent` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `short_code` varchar(100) NOT NULL,
  `is_active` int(11) DEFAULT 0,
  `system` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permission_parent`
--

INSERT INTO `permission_parent` (`id`, `group_id`, `name`, `short_code`, `is_active`, `system`, `created_at`) VALUES
(1, 2, 'Fees', 'fees', 1, 0, '2019-12-01 14:08:13'),
(2, 7, 'Class Timetable', 'class_timetable', 1, 1, '2019-12-01 07:46:35'),
(3, 19, 'Homework', 'homework', 1, 0, '2019-12-01 07:46:44'),
(4, 8, 'Download Center', 'download_center', 1, 0, '2019-12-01 07:46:52'),
(5, 5, 'Attendance', 'attendance', 1, 0, '2019-12-01 07:47:03'),
(7, 6, 'Examinations', 'examinations', 1, 0, '2019-12-01 07:43:17'),
(8, 13, 'Notice Board', 'notice_board', 1, 0, '2019-12-01 07:47:12'),
(11, 9, 'Library', 'library', 1, 0, '2019-12-01 07:47:18'),
(12, 11, 'Transport Routes', 'transport_routes', 1, 0, '2019-12-01 07:47:26'),
(13, 12, 'Hostel Rooms', 'hostel_rooms', 1, 0, '2019-12-01 07:47:34'),
(14, 21, 'Calendar To Do List', 'calendar_to_do_list', 1, 0, '2019-12-01 07:47:40'),
(15, 0, 'Teachers Rating', 'teachers_rating', 1, 0, '2019-12-01 07:47:49');

-- --------------------------------------------------------

--
-- Table structure for table `permission_student`
--

CREATE TABLE `permission_student` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `short_code` varchar(100) NOT NULL,
  `is_active` int(11) DEFAULT 0,
  `system` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permission_student`
--

INSERT INTO `permission_student` (`id`, `name`, `short_code`, `is_active`, `system`, `group_id`, `created_at`) VALUES
(1, 'Fees', 'fees', 1, 0, 2, '2019-12-01 07:55:37'),
(2, 'Class Timetable', 'class_timetable', 1, 1, 7, '2019-12-01 07:40:07'),
(3, 'Homework', 'homework', 1, 0, 19, '2019-12-01 07:40:18'),
(4, 'Download Center', 'download_center', 1, 0, 8, '2019-12-01 07:40:30'),
(5, 'Attendance', 'attendance', 1, 0, 5, '2019-12-01 07:40:38'),
(7, 'Examinations', 'examinations', 1, 0, 6, '2019-12-06 07:55:30'),
(8, 'Notice Board', 'notice_board', 1, 0, 13, '2019-12-01 07:40:46'),
(11, 'Library', 'library', 1, 0, 9, '2019-12-01 07:40:52'),
(12, 'Transport Routes', 'transport_routes', 1, 0, 11, '2019-12-01 07:40:58'),
(13, 'Hostel Rooms', 'hostel_rooms', 1, 0, 12, '2019-12-01 07:41:04'),
(14, 'Calendar To Do List', 'calendar_to_do_list', 1, 0, 21, '2019-12-01 07:41:09'),
(15, 'Online Examination', 'online_examination', 1, 0, 23, '2019-12-01 07:41:21'),
(16, 'Teachers Rating', 'teachers_rating', 1, 0, 0, '2019-12-01 07:41:31'),
(17, 'Chat', 'chat', 1, 0, 25, '2019-12-01 07:50:25'),
(18, 'Multi Class', 'multi_class', 1, 0, 26, '2019-12-01 07:50:28');

-- --------------------------------------------------------

--
-- Table structure for table `print_headerfooter`
--

CREATE TABLE `print_headerfooter` (
  `id` int(11) NOT NULL,
  `print_type` varchar(255) NOT NULL,
  `header_image` varchar(255) NOT NULL,
  `footer_content` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `print_headerfooter`
--

INSERT INTO `print_headerfooter` (`id`, `print_type`, `header_image`, `footer_content`, `created_by`, `entry_date`) VALUES
(1, 'staff_payslip', 'header_image.jpg', 'This payslip is computer generated hence no signature is required.', 1, '2020-02-28 15:41:08'),
(2, 'student_receipt', 'header_image.jpg', 'This receipt is computer generated hence no signature is required.', 1, '2020-02-28 15:40:58');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `question` text DEFAULT NULL,
  `opt_a` text DEFAULT NULL,
  `opt_b` text DEFAULT NULL,
  `opt_c` text DEFAULT NULL,
  `opt_d` text DEFAULT NULL,
  `opt_e` text DEFAULT NULL,
  `correct` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `question_answers`
--

CREATE TABLE `question_answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `question_options`
--

CREATE TABLE `question_options` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `option` text CHARACTER SET latin1 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `read_notification`
--

CREATE TABLE `read_notification` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `notification_id` int(11) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reference`
--

CREATE TABLE `reference` (
  `id` int(11) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `slug` varchar(150) DEFAULT NULL,
  `is_active` int(11) DEFAULT 0,
  `is_system` int(1) NOT NULL DEFAULT 0,
  `is_superadmin` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `is_active`, `is_system`, `is_superadmin`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, 0, 1, 0, '2018-06-30 15:39:11', '0000-00-00'),
(2, 'Teacher', NULL, 0, 1, 0, '2018-06-30 15:39:14', '0000-00-00'),
(3, 'Accountant', NULL, 0, 1, 0, '2018-06-30 15:39:17', '0000-00-00'),
(4, 'Librarian', NULL, 0, 1, 0, '2018-06-30 15:39:21', '0000-00-00'),
(6, 'Receptionist', NULL, 0, 1, 0, '2018-07-02 05:39:03', '0000-00-00'),
(7, 'Super Admin', NULL, 0, 1, 1, '2018-07-11 14:11:29', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `roles_permissions`
--

CREATE TABLE `roles_permissions` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `perm_cat_id` int(11) DEFAULT NULL,
  `can_view` int(11) DEFAULT NULL,
  `can_add` int(11) DEFAULT NULL,
  `can_edit` int(11) DEFAULT NULL,
  `can_delete` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles_permissions`
--

INSERT INTO `roles_permissions` (`id`, `role_id`, `perm_cat_id`, `can_view`, `can_add`, `can_edit`, `can_delete`, `created_at`) VALUES
(10, 1, 17, 1, 1, 1, 1, '2018-07-06 15:18:56'),
(11, 1, 78, 1, 1, 1, 1, '2018-07-03 06:19:43'),
(23, 1, 12, 1, 1, 1, 1, '2018-07-06 15:15:38'),
(24, 1, 13, 1, 1, 1, 1, '2018-07-06 15:18:28'),
(26, 1, 15, 1, 1, 1, 0, '2019-11-28 05:17:28'),
(28, 1, 19, 1, 1, 1, 0, '2018-07-02 17:01:10'),
(30, 1, 76, 1, 1, 1, 0, '2018-07-02 17:01:10'),
(31, 1, 21, 1, 0, 1, 0, '2019-11-26 10:21:15'),
(32, 1, 22, 1, 1, 1, 1, '2018-07-02 17:02:05'),
(34, 1, 24, 1, 1, 1, 1, '2019-11-28 12:05:20'),
(43, 1, 32, 1, 1, 1, 1, '2018-07-06 15:52:05'),
(44, 1, 33, 1, 1, 1, 1, '2018-07-06 15:52:29'),
(45, 1, 34, 1, 1, 1, 1, '2018-07-06 15:53:59'),
(46, 1, 35, 1, 1, 1, 1, '2018-07-06 15:54:34'),
(47, 1, 104, 1, 1, 1, 1, '2018-07-06 15:53:08'),
(48, 1, 37, 1, 1, 1, 1, '2018-07-06 15:55:30'),
(49, 1, 38, 1, 1, 1, 1, '2018-07-09 10:45:27'),
(58, 1, 52, 1, 1, 0, 1, '2018-07-09 08:49:43'),
(61, 1, 55, 1, 1, 1, 1, '2018-07-02 14:54:16'),
(67, 1, 61, 1, 1, 0, 1, '2018-07-09 11:29:19'),
(68, 1, 62, 1, 1, 0, 1, '2018-07-09 11:29:19'),
(69, 1, 63, 1, 1, 0, 1, '2018-07-09 09:21:38'),
(70, 1, 64, 1, 1, 1, 1, '2018-07-09 08:32:19'),
(71, 1, 65, 1, 1, 1, 1, '2018-07-09 08:41:21'),
(72, 1, 66, 1, 1, 1, 1, '2018-07-09 08:43:09'),
(73, 1, 67, 1, 1, 1, 1, '2018-07-09 08:44:47'),
(74, 1, 79, 1, 1, 0, 1, '2019-11-30 07:02:51'),
(75, 1, 80, 1, 1, 1, 1, '2018-07-06 15:11:23'),
(76, 1, 81, 1, 1, 1, 1, '2018-07-06 15:11:23'),
(78, 1, 83, 1, 1, 1, 1, '2018-07-06 15:11:23'),
(79, 1, 84, 1, 1, 1, 1, '2018-07-06 15:11:23'),
(80, 1, 85, 1, 1, 1, 1, '2018-07-12 05:46:00'),
(87, 1, 92, 1, 1, 1, 1, '2018-06-26 09:03:43'),
(94, 1, 82, 1, 1, 1, 1, '2018-07-06 15:11:23'),
(120, 1, 39, 1, 1, 1, 1, '2018-07-06 15:56:28'),
(156, 1, 9, 1, 1, 1, 1, '2019-11-28 05:15:46'),
(157, 1, 10, 1, 1, 1, 1, '2019-11-28 05:15:46'),
(159, 1, 40, 1, 1, 1, 1, '2019-11-30 06:19:39'),
(160, 1, 41, 1, 1, 1, 1, '2019-12-02 11:13:41'),
(161, 1, 42, 1, 1, 1, 1, '2019-11-30 06:19:39'),
(169, 1, 27, 1, 1, 0, 1, '2019-11-29 11:45:37'),
(178, 1, 54, 1, 0, 1, 0, '2018-07-05 14:39:22'),
(179, 1, 56, 1, 0, 1, 0, '2019-11-30 06:19:54'),
(180, 1, 57, 1, 0, 1, 0, '2019-11-30 07:02:51'),
(181, 1, 58, 1, 0, 1, 0, '2019-11-30 07:02:51'),
(182, 1, 59, 1, 0, 1, 0, '2019-11-30 07:02:51'),
(183, 1, 60, 1, 0, 1, 0, '2019-11-30 06:29:57'),
(190, 1, 105, 1, 0, 0, 0, '2018-07-02 16:43:25'),
(199, 1, 75, 1, 0, 0, 0, '2018-07-02 16:49:46'),
(201, 1, 14, 1, 0, 0, 0, '2018-07-02 16:52:03'),
(203, 1, 16, 1, 0, 0, 0, '2018-07-02 16:54:21'),
(204, 1, 26, 1, 0, 0, 0, '2018-07-02 17:02:05'),
(206, 1, 29, 1, 0, 0, 0, '2018-07-02 17:13:54'),
(207, 1, 30, 1, 0, 0, 0, '2018-07-02 17:13:54'),
(208, 1, 31, 1, 1, 1, 1, '2019-11-30 07:02:51'),
(215, 1, 50, 1, 0, 0, 0, '2018-07-02 17:34:53'),
(216, 1, 51, 1, 0, 0, 0, '2018-07-02 17:34:53'),
(222, 1, 1, 1, 1, 1, 1, '2019-11-28 04:25:06'),
(227, 1, 91, 1, 0, 0, 0, '2018-07-03 07:19:27'),
(230, 10, 53, 0, 1, 0, 0, '2018-07-03 09:22:55'),
(231, 10, 54, 0, 0, 1, 0, '2018-07-03 09:22:55'),
(232, 10, 55, 1, 1, 1, 1, '2018-07-03 09:28:42'),
(233, 10, 56, 0, 0, 1, 0, '2018-07-03 09:22:55'),
(235, 10, 58, 0, 0, 1, 0, '2018-07-03 09:22:55'),
(236, 10, 59, 0, 0, 1, 0, '2018-07-03 09:22:55'),
(239, 10, 1, 1, 1, 1, 1, '2018-07-03 09:46:43'),
(241, 10, 3, 1, 0, 0, 0, '2018-07-03 09:53:56'),
(242, 10, 2, 1, 0, 0, 0, '2018-07-03 09:54:39'),
(243, 10, 4, 1, 0, 1, 1, '2018-07-03 10:01:24'),
(245, 10, 107, 1, 0, 0, 0, '2018-07-03 10:06:41'),
(246, 10, 5, 1, 1, 0, 1, '2018-07-03 10:08:18'),
(247, 10, 7, 1, 1, 1, 1, '2018-07-03 10:12:07'),
(248, 10, 68, 1, 0, 0, 0, '2018-07-03 10:12:53'),
(249, 10, 69, 1, 1, 1, 1, '2018-07-03 10:19:46'),
(250, 10, 70, 1, 0, 0, 1, '2018-07-03 10:22:40'),
(251, 10, 72, 1, 0, 0, 0, '2018-07-03 10:26:46'),
(252, 10, 73, 1, 0, 0, 0, '2018-07-03 10:26:46'),
(253, 10, 74, 1, 0, 0, 0, '2018-07-03 10:28:34'),
(254, 10, 75, 1, 0, 0, 0, '2018-07-03 10:28:34'),
(255, 10, 9, 1, 1, 1, 1, '2018-07-03 10:32:22'),
(256, 10, 10, 1, 1, 1, 1, '2018-07-03 10:33:09'),
(257, 10, 11, 1, 0, 0, 0, '2018-07-03 10:33:09'),
(258, 10, 12, 1, 1, 1, 1, '2018-07-03 10:38:40'),
(259, 10, 13, 1, 1, 1, 1, '2018-07-03 10:38:40'),
(260, 10, 14, 1, 0, 0, 0, '2018-07-03 10:38:53'),
(261, 10, 15, 1, 1, 1, 0, '2018-07-03 10:41:28'),
(262, 10, 16, 1, 0, 0, 0, '2018-07-03 10:42:12'),
(263, 10, 17, 1, 1, 1, 1, '2018-07-03 10:44:30'),
(264, 10, 19, 1, 1, 1, 0, '2018-07-03 10:45:45'),
(265, 10, 20, 1, 1, 1, 1, '2018-07-03 10:48:51'),
(266, 10, 76, 1, 0, 0, 0, '2018-07-03 10:51:21'),
(267, 10, 21, 1, 1, 1, 0, '2018-07-03 10:52:45'),
(268, 10, 22, 1, 1, 1, 1, '2018-07-03 10:55:00'),
(269, 10, 23, 1, 1, 1, 1, '2018-07-03 10:57:16'),
(270, 10, 24, 1, 1, 1, 1, '2018-07-03 10:57:49'),
(271, 10, 25, 1, 1, 1, 1, '2018-07-03 10:57:49'),
(272, 10, 26, 1, 0, 0, 0, '2018-07-03 10:58:25'),
(273, 10, 77, 1, 1, 1, 1, '2018-07-03 10:59:57'),
(274, 10, 27, 1, 1, 0, 1, '2018-07-03 11:00:36'),
(275, 10, 28, 1, 1, 1, 1, '2018-07-03 11:03:09'),
(276, 10, 29, 1, 0, 0, 0, '2018-07-03 11:04:03'),
(277, 10, 30, 1, 0, 0, 0, '2018-07-03 11:04:03'),
(278, 10, 31, 1, 0, 0, 0, '2018-07-03 11:04:03'),
(279, 10, 32, 1, 1, 1, 1, '2018-07-03 11:05:42'),
(280, 10, 33, 1, 1, 1, 1, '2018-07-03 11:06:32'),
(281, 10, 34, 1, 1, 1, 1, '2018-07-03 11:08:03'),
(282, 10, 35, 1, 1, 1, 1, '2018-07-03 11:08:41'),
(283, 10, 104, 1, 1, 1, 1, '2018-07-03 11:10:43'),
(284, 10, 37, 1, 1, 1, 1, '2018-07-03 11:12:42'),
(285, 10, 38, 1, 1, 1, 1, '2018-07-03 11:13:56'),
(286, 10, 39, 1, 1, 1, 1, '2018-07-03 11:15:39'),
(287, 10, 40, 1, 1, 1, 1, '2018-07-03 11:17:22'),
(288, 10, 41, 1, 1, 1, 1, '2018-07-03 11:18:54'),
(289, 10, 42, 1, 1, 1, 1, '2018-07-03 11:19:31'),
(290, 10, 43, 1, 1, 1, 1, '2018-07-03 11:21:15'),
(291, 10, 44, 1, 0, 0, 0, '2018-07-03 11:22:06'),
(292, 10, 46, 1, 0, 0, 0, '2018-07-03 11:22:06'),
(293, 10, 50, 1, 0, 0, 0, '2018-07-03 11:22:59'),
(294, 10, 51, 1, 0, 0, 0, '2018-07-03 11:22:59'),
(295, 10, 60, 0, 0, 1, 0, '2018-07-03 11:25:05'),
(296, 10, 61, 1, 1, 1, 1, '2018-07-03 11:26:52'),
(297, 10, 62, 1, 1, 1, 1, '2018-07-03 11:28:53'),
(298, 10, 63, 1, 1, 0, 0, '2018-07-03 11:29:37'),
(299, 10, 64, 1, 1, 1, 1, '2018-07-03 11:30:27'),
(300, 10, 65, 1, 1, 1, 1, '2018-07-03 11:32:51'),
(301, 10, 66, 1, 1, 1, 1, '2018-07-03 11:32:51'),
(302, 10, 67, 1, 0, 0, 0, '2018-07-03 11:32:51'),
(303, 10, 78, 1, 1, 1, 1, '2018-07-04 09:40:04'),
(307, 1, 126, 1, 0, 0, 0, '2018-07-03 14:56:13'),
(310, 1, 119, 1, 0, 0, 0, '2018-07-03 15:45:00'),
(311, 1, 120, 1, 0, 0, 0, '2018-07-03 15:45:00'),
(315, 1, 123, 1, 0, 0, 0, '2018-07-03 15:57:03'),
(317, 1, 124, 1, 0, 0, 0, '2018-07-03 15:59:14'),
(320, 1, 47, 1, 0, 0, 0, '2018-07-03 16:31:12'),
(321, 1, 121, 1, 0, 0, 0, '2018-07-03 16:31:12'),
(369, 1, 102, 1, 1, 1, 1, '2019-12-02 10:32:15'),
(372, 10, 79, 1, 1, 0, 0, '2018-07-04 09:40:04'),
(373, 10, 80, 1, 1, 1, 1, '2018-07-04 09:53:09'),
(374, 10, 81, 1, 1, 1, 1, '2018-07-04 09:53:50'),
(375, 10, 82, 1, 1, 1, 1, '2018-07-04 09:56:54'),
(376, 10, 83, 1, 1, 1, 1, '2018-07-04 09:57:55'),
(377, 10, 84, 1, 1, 1, 1, '2018-07-04 10:00:26'),
(378, 10, 85, 1, 1, 1, 1, '2018-07-04 10:02:54'),
(379, 10, 86, 1, 1, 1, 1, '2018-07-04 10:16:18'),
(380, 10, 87, 1, 0, 0, 0, '2018-07-04 10:19:49'),
(381, 10, 88, 1, 1, 1, 0, '2018-07-04 10:21:20'),
(382, 10, 89, 1, 0, 0, 0, '2018-07-04 10:21:51'),
(383, 10, 90, 1, 1, 0, 1, '2018-07-04 10:25:01'),
(384, 10, 91, 1, 0, 0, 0, '2018-07-04 10:25:01'),
(385, 10, 108, 1, 1, 1, 1, '2018-07-04 10:27:46'),
(386, 10, 109, 1, 1, 1, 1, '2018-07-04 10:28:26'),
(387, 10, 110, 1, 1, 1, 1, '2018-07-04 10:32:43'),
(388, 10, 111, 1, 1, 1, 1, '2018-07-04 10:33:21'),
(389, 10, 112, 1, 1, 1, 1, '2018-07-04 10:35:06'),
(390, 10, 127, 1, 0, 0, 0, '2018-07-04 10:35:06'),
(391, 10, 93, 1, 1, 1, 1, '2018-07-04 10:37:14'),
(392, 10, 94, 1, 1, 0, 0, '2018-07-04 10:38:02'),
(394, 10, 95, 1, 0, 0, 0, '2018-07-04 10:38:44'),
(395, 10, 102, 1, 1, 1, 1, '2018-07-04 10:41:02'),
(396, 10, 106, 1, 0, 0, 0, '2018-07-04 10:41:39'),
(397, 10, 113, 1, 0, 0, 0, '2018-07-04 10:42:37'),
(398, 10, 114, 1, 0, 0, 0, '2018-07-04 10:42:37'),
(399, 10, 115, 1, 0, 0, 0, '2018-07-04 10:48:45'),
(400, 10, 116, 1, 0, 0, 0, '2018-07-04 10:48:45'),
(401, 10, 117, 1, 0, 0, 0, '2018-07-04 10:49:43'),
(402, 10, 118, 1, 0, 0, 0, '2018-07-04 10:49:43'),
(434, 1, 125, 1, 0, 0, 0, '2018-07-06 15:29:26'),
(435, 1, 96, 1, 1, 1, 1, '2018-07-09 06:33:54'),
(445, 1, 48, 1, 0, 0, 0, '2018-07-06 17:19:35'),
(446, 1, 49, 1, 0, 0, 0, '2018-07-06 17:19:35'),
(461, 1, 97, 1, 0, 0, 0, '2018-07-09 06:30:16'),
(462, 1, 95, 1, 0, 0, 0, '2018-07-09 06:48:41'),
(464, 1, 86, 1, 1, 1, 1, '2019-11-28 12:09:19'),
(474, 1, 130, 1, 1, 0, 1, '2018-07-09 16:26:36'),
(476, 1, 131, 1, 0, 0, 0, '2018-07-09 10:23:32'),
(479, 2, 47, 1, 0, 0, 0, '2018-07-10 12:17:12'),
(480, 2, 105, 1, 0, 0, 0, '2018-07-10 12:17:12'),
(482, 2, 119, 1, 0, 0, 0, '2018-07-10 12:17:12'),
(483, 2, 120, 1, 0, 0, 0, '2018-07-10 12:17:12'),
(486, 2, 16, 1, 0, 0, 0, '2018-07-10 12:17:12'),
(493, 2, 22, 1, 0, 0, 0, '2018-07-12 05:50:27'),
(504, 2, 95, 1, 0, 0, 0, '2018-07-10 12:17:12'),
(513, 3, 72, 1, 0, 0, 0, '2018-07-10 12:37:30'),
(517, 3, 75, 1, 0, 0, 0, '2018-07-10 12:40:38'),
(527, 3, 89, 1, 0, 0, 0, '2018-07-10 12:48:44'),
(529, 3, 91, 1, 0, 0, 0, '2018-07-10 12:48:44'),
(549, 3, 124, 1, 0, 0, 0, '2018-07-10 12:52:17'),
(557, 6, 82, 1, 1, 1, 1, '2019-12-01 07:18:28'),
(558, 6, 83, 1, 1, 1, 1, '2019-12-01 07:19:08'),
(559, 6, 84, 1, 1, 1, 1, '2019-12-01 07:19:59'),
(575, 6, 44, 1, 0, 0, 0, '2018-07-10 13:05:33'),
(576, 6, 46, 1, 0, 0, 0, '2018-07-10 13:05:33'),
(578, 6, 102, 1, 1, 1, 1, '2019-12-01 07:22:27'),
(594, 3, 125, 1, 0, 0, 0, '2018-07-10 13:28:12'),
(595, 3, 48, 1, 0, 0, 0, '2018-07-10 13:28:12'),
(596, 3, 49, 1, 0, 0, 0, '2018-07-10 13:28:12'),
(617, 2, 17, 1, 1, 1, 1, '2018-07-11 12:25:14'),
(618, 2, 19, 1, 1, 1, 0, '2018-07-11 12:25:14'),
(620, 2, 76, 1, 1, 1, 0, '2018-07-11 12:25:14'),
(622, 2, 121, 1, 0, 0, 0, '2018-07-11 12:26:27'),
(625, 1, 28, 1, 1, 1, 1, '2019-11-29 11:49:18'),
(628, 6, 22, 1, 0, 0, 0, '2018-07-12 05:53:47'),
(634, 4, 102, 1, 1, 1, 1, '2019-12-01 06:33:00'),
(662, 1, 138, 1, 0, 0, 0, '2019-11-01 07:58:24'),
(663, 1, 139, 1, 1, 1, 1, '2019-11-01 07:58:24'),
(664, 1, 140, 1, 1, 1, 1, '2019-11-01 07:58:24'),
(669, 1, 145, 1, 0, 0, 0, '2019-11-26 10:21:15'),
(677, 1, 153, 1, 0, 0, 0, '2019-11-01 07:58:24'),
(690, 1, 166, 1, 0, 0, 0, '2019-11-01 07:58:24'),
(691, 1, 167, 1, 0, 0, 0, '2019-11-01 07:58:24'),
(692, 1, 168, 1, 0, 0, 0, '2019-11-01 07:58:24'),
(693, 1, 170, 1, 0, 0, 0, '2019-11-01 07:58:24'),
(694, 1, 172, 1, 0, 0, 0, '2019-11-01 07:58:24'),
(695, 1, 173, 1, 0, 0, 0, '2019-11-01 07:58:24'),
(720, 1, 216, 1, 0, 0, 0, '2019-11-26 10:54:12'),
(728, 1, 185, 1, 1, 1, 1, '2019-11-28 08:20:33'),
(729, 1, 186, 1, 1, 1, 1, '2019-11-28 08:19:07'),
(730, 1, 214, 1, 0, 1, 0, '2019-11-28 07:17:53'),
(732, 1, 198, 1, 0, 0, 0, '2019-11-26 10:54:30'),
(733, 1, 199, 1, 0, 0, 0, '2019-11-26 10:54:30'),
(734, 1, 200, 1, 0, 0, 0, '2019-11-26 10:54:30'),
(735, 1, 201, 1, 0, 0, 0, '2019-11-26 10:54:30'),
(736, 1, 202, 1, 0, 0, 0, '2019-11-26 10:54:30'),
(737, 1, 203, 1, 0, 0, 0, '2019-11-26 10:54:30'),
(739, 1, 218, 1, 0, 0, 0, '2019-11-27 12:06:31'),
(743, 1, 218, 1, 0, 0, 0, '2019-11-27 12:06:32'),
(747, 1, 2, 1, 0, 0, 0, '2019-11-28 04:26:08'),
(748, 1, 3, 1, 1, 1, 1, '2019-11-28 04:26:32'),
(749, 1, 4, 1, 1, 1, 1, '2019-11-28 04:26:48'),
(751, 1, 128, 0, 1, 0, 1, '2019-11-28 04:27:01'),
(752, 1, 132, 1, 0, 1, 1, '2019-11-28 04:32:23'),
(754, 1, 134, 1, 1, 1, 1, '2019-11-28 04:48:21'),
(755, 1, 5, 1, 1, 0, 1, '2019-11-28 05:05:07'),
(756, 1, 6, 1, 0, 0, 0, '2019-11-28 05:05:25'),
(757, 1, 7, 1, 1, 1, 1, '2019-11-28 05:06:35'),
(758, 1, 8, 1, 1, 1, 1, '2019-11-28 05:07:27'),
(760, 1, 68, 1, 0, 0, 0, '2019-11-28 05:08:06'),
(761, 1, 69, 1, 1, 1, 1, '2019-11-28 05:09:06'),
(762, 1, 70, 1, 1, 1, 1, '2019-11-28 05:09:41'),
(763, 1, 71, 1, 0, 0, 0, '2019-11-28 05:09:59'),
(764, 1, 72, 1, 0, 0, 0, '2019-11-28 05:10:11'),
(765, 1, 73, 1, 0, 0, 0, '2019-11-28 05:13:15'),
(766, 1, 74, 1, 0, 0, 0, '2019-11-28 05:13:55'),
(768, 1, 11, 1, 0, 0, 0, '2019-11-28 05:15:46'),
(769, 1, 122, 1, 0, 0, 0, '2019-11-28 05:22:43'),
(771, 1, 136, 1, 0, 0, 0, '2019-11-28 05:25:36'),
(772, 1, 20, 1, 1, 1, 1, '2019-11-28 09:36:44'),
(773, 1, 137, 1, 1, 1, 1, '2019-11-28 06:16:14'),
(774, 1, 141, 1, 1, 1, 1, '2019-11-28 06:29:42'),
(775, 1, 142, 1, 0, 0, 0, '2019-11-28 05:26:12'),
(776, 1, 143, 1, 1, 1, 1, '2019-11-28 06:29:42'),
(777, 1, 144, 1, 0, 0, 0, '2019-11-28 05:26:12'),
(778, 1, 187, 1, 0, 0, 0, '2019-11-28 05:26:12'),
(779, 1, 196, 1, 0, 0, 0, '2019-11-28 05:26:12'),
(781, 1, 207, 1, 0, 0, 0, '2019-11-28 05:26:12'),
(782, 1, 208, 1, 0, 1, 0, '2019-11-28 05:40:22'),
(783, 1, 210, 1, 0, 1, 0, '2019-11-28 06:04:40'),
(784, 1, 211, 1, 0, 1, 0, '2019-11-28 06:08:23'),
(785, 1, 212, 1, 0, 1, 0, '2019-11-28 06:12:15'),
(786, 1, 205, 1, 1, 1, 1, '2019-11-28 06:12:15'),
(787, 1, 222, 1, 0, 1, 0, '2019-11-28 07:06:36'),
(788, 1, 77, 1, 1, 1, 1, '2019-11-28 11:52:10'),
(789, 1, 188, 1, 1, 1, 1, '2019-11-28 11:56:16'),
(790, 1, 23, 1, 1, 1, 1, '2019-11-28 12:04:20'),
(791, 1, 25, 1, 1, 1, 1, '2019-11-28 12:06:20'),
(792, 1, 127, 1, 0, 0, 0, '2019-11-28 12:11:25'),
(794, 1, 88, 1, 1, 1, 0, '2019-11-28 12:13:04'),
(795, 1, 90, 1, 1, 0, 1, '2019-11-28 12:16:22'),
(796, 1, 108, 1, 0, 1, 0, '2019-11-29 05:19:01'),
(797, 1, 109, 1, 1, 0, 0, '2019-11-29 05:08:11'),
(798, 1, 110, 1, 1, 1, 1, '2019-11-29 05:19:29'),
(799, 1, 111, 1, 1, 1, 1, '2019-11-29 05:19:57'),
(800, 1, 112, 1, 1, 1, 1, '2019-11-29 05:19:57'),
(801, 1, 129, 0, 1, 0, 1, '2019-11-29 05:19:57'),
(802, 1, 189, 1, 0, 1, 1, '2019-11-29 05:29:22'),
(806, 2, 133, 1, 0, 1, 0, '2019-11-29 06:04:35'),
(810, 2, 1, 1, 1, 1, 1, '2019-11-30 08:24:16'),
(813, 1, 133, 1, 0, 1, 0, '2019-11-29 06:09:57'),
(817, 1, 93, 1, 1, 1, 1, '2019-11-29 06:26:14'),
(825, 1, 87, 1, 0, 0, 0, '2019-11-29 06:26:14'),
(829, 1, 94, 1, 1, 0, 0, '2019-11-29 06:27:57'),
(836, 1, 146, 1, 0, 0, 0, '2019-11-29 06:43:28'),
(837, 1, 147, 1, 0, 0, 0, '2019-11-29 06:43:28'),
(838, 1, 148, 1, 0, 0, 0, '2019-11-29 06:43:28'),
(839, 1, 149, 1, 0, 0, 0, '2019-11-29 06:43:28'),
(840, 1, 150, 1, 0, 0, 0, '2019-11-29 06:43:28'),
(841, 1, 151, 1, 0, 0, 0, '2019-11-29 06:43:28'),
(842, 1, 152, 1, 0, 0, 0, '2019-11-29 06:43:28'),
(843, 1, 154, 1, 0, 0, 0, '2019-11-29 06:43:28'),
(862, 1, 155, 1, 0, 0, 0, '2019-11-29 07:37:30'),
(863, 1, 156, 1, 0, 0, 0, '2019-11-29 07:37:52'),
(864, 1, 157, 1, 0, 0, 0, '2019-11-29 07:38:05'),
(874, 1, 158, 1, 0, 0, 0, '2019-11-29 07:44:03'),
(875, 1, 159, 1, 0, 0, 0, '2019-11-29 07:44:31'),
(876, 1, 160, 1, 0, 0, 0, '2019-11-29 07:44:44'),
(878, 1, 162, 1, 0, 0, 0, '2019-11-29 07:45:58'),
(879, 1, 163, 1, 0, 0, 0, '2019-11-29 07:46:19'),
(882, 1, 164, 1, 0, 0, 0, '2019-11-29 07:55:17'),
(884, 1, 165, 1, 0, 0, 0, '2019-11-29 07:55:30'),
(886, 1, 197, 1, 0, 0, 0, '2019-11-29 07:55:48'),
(887, 1, 219, 1, 0, 0, 0, '2019-11-29 07:56:05'),
(889, 1, 220, 1, 0, 0, 0, '2019-11-29 07:56:22'),
(932, 1, 204, 1, 0, 0, 0, '2019-11-29 09:13:27'),
(933, 1, 221, 1, 0, 0, 0, '2019-11-29 09:15:04'),
(934, 1, 178, 1, 0, 0, 0, '2019-11-29 09:15:16'),
(935, 1, 179, 1, 0, 0, 0, '2019-11-29 09:15:33'),
(936, 1, 161, 1, 0, 0, 0, '2019-11-29 09:15:48'),
(937, 1, 180, 1, 0, 0, 0, '2019-11-29 09:15:48'),
(938, 1, 181, 1, 0, 0, 0, '2019-11-29 09:19:33'),
(939, 1, 182, 1, 0, 0, 0, '2019-11-29 09:19:45'),
(940, 1, 183, 1, 0, 0, 0, '2019-11-29 09:19:56'),
(941, 1, 174, 1, 0, 0, 0, '2019-11-29 09:20:53'),
(943, 1, 176, 1, 0, 0, 0, '2019-11-29 09:22:10'),
(944, 1, 177, 1, 0, 0, 0, '2019-11-29 09:22:22'),
(945, 1, 53, 0, 1, 0, 0, '2019-11-29 09:24:52'),
(946, 1, 215, 1, 0, 0, 0, '2019-11-29 09:31:37'),
(947, 1, 213, 1, 0, 0, 0, '2019-11-29 09:37:45'),
(974, 1, 224, 1, 0, 0, 0, '2019-11-29 10:02:52'),
(979, 1, 225, 1, 0, 0, 0, '2019-11-29 10:15:30'),
(982, 2, 225, 1, 0, 0, 0, '2019-11-29 10:17:19'),
(1026, 1, 135, 1, 0, 1, 0, '2019-11-29 11:32:12'),
(1031, 1, 228, 1, 0, 0, 0, '2019-11-29 11:51:16'),
(1083, 1, 175, 1, 0, 0, 0, '2019-11-30 06:07:24'),
(1086, 1, 43, 1, 1, 1, 1, '2019-11-30 06:19:39'),
(1087, 1, 44, 1, 0, 0, 0, '2019-11-30 06:19:39'),
(1088, 1, 46, 1, 0, 0, 0, '2019-11-30 06:19:39'),
(1089, 1, 217, 1, 0, 0, 0, '2019-11-30 06:19:39'),
(1090, 1, 98, 1, 1, 1, 1, '2019-11-30 07:02:51'),
(1091, 1, 99, 1, 0, 0, 0, '2019-11-30 07:00:18'),
(1092, 1, 223, 1, 0, 0, 0, '2019-11-30 07:02:51'),
(1103, 2, 205, 1, 1, 1, 1, '2019-11-30 07:26:04'),
(1105, 2, 23, 1, 0, 0, 0, '2019-11-30 07:26:04'),
(1106, 2, 24, 1, 0, 0, 0, '2019-11-30 07:26:04'),
(1107, 2, 25, 1, 0, 0, 0, '2019-11-30 07:26:04'),
(1108, 2, 77, 1, 0, 0, 0, '2019-11-30 07:26:04'),
(1119, 2, 117, 1, 0, 0, 0, '2019-11-30 07:26:04'),
(1123, 3, 8, 1, 1, 1, 1, '2019-11-30 12:16:18'),
(1125, 3, 69, 1, 1, 1, 1, '2019-11-30 12:30:49'),
(1126, 3, 70, 1, 1, 1, 1, '2019-11-30 12:34:46'),
(1130, 3, 9, 1, 1, 1, 1, '2019-11-30 12:44:54'),
(1131, 3, 10, 1, 1, 1, 1, '2019-11-30 12:46:02'),
(1134, 3, 35, 1, 1, 1, 1, '2019-11-30 12:55:04'),
(1135, 3, 104, 1, 1, 1, 1, '2019-11-30 12:55:53'),
(1140, 3, 41, 1, 1, 1, 1, '2019-11-30 13:07:13'),
(1141, 3, 42, 1, 1, 1, 1, '2019-11-30 13:07:46'),
(1142, 3, 43, 1, 1, 1, 1, '2019-11-30 13:12:06'),
(1151, 3, 87, 1, 0, 0, 0, '2019-11-30 07:53:13'),
(1152, 3, 88, 1, 1, 1, 0, '2019-11-30 07:53:13'),
(1153, 3, 90, 1, 1, 0, 1, '2019-11-30 07:53:13'),
(1154, 3, 108, 1, 0, 1, 0, '2019-11-30 07:53:13'),
(1155, 3, 109, 1, 1, 0, 0, '2019-11-30 07:53:13'),
(1156, 3, 110, 1, 1, 1, 1, '2019-11-30 07:53:13'),
(1157, 3, 111, 1, 1, 1, 1, '2019-11-30 07:53:13'),
(1158, 3, 112, 1, 1, 1, 1, '2019-11-30 07:53:13'),
(1159, 3, 127, 1, 0, 0, 0, '2019-11-30 07:53:13'),
(1160, 3, 129, 0, 1, 0, 1, '2019-11-30 07:53:13'),
(1161, 3, 102, 1, 1, 1, 1, '2019-11-30 07:53:13'),
(1162, 3, 106, 1, 0, 0, 0, '2019-11-30 07:53:13'),
(1163, 3, 113, 1, 0, 0, 0, '2019-11-30 07:53:13'),
(1164, 3, 114, 1, 0, 0, 0, '2019-11-30 07:53:13'),
(1165, 3, 115, 1, 0, 0, 0, '2019-11-30 07:53:13'),
(1166, 3, 116, 1, 0, 0, 0, '2019-11-30 07:53:13'),
(1167, 3, 117, 1, 0, 0, 0, '2019-11-30 07:53:13'),
(1168, 3, 118, 1, 0, 0, 0, '2019-11-30 07:53:13'),
(1171, 2, 142, 1, 0, 0, 0, '2019-11-30 08:06:17'),
(1172, 2, 144, 1, 0, 0, 0, '2019-11-30 08:06:17'),
(1179, 2, 212, 1, 0, 1, 0, '2019-11-30 08:06:17'),
(1183, 2, 148, 1, 0, 0, 0, '2019-11-30 08:06:17'),
(1184, 2, 149, 1, 0, 0, 0, '2019-11-30 08:06:17'),
(1185, 2, 150, 1, 0, 0, 0, '2019-11-30 08:06:17'),
(1186, 2, 151, 1, 0, 0, 0, '2019-11-30 08:06:17'),
(1187, 2, 152, 1, 0, 0, 0, '2019-11-30 08:06:17'),
(1188, 2, 153, 1, 0, 0, 0, '2019-11-30 08:06:17'),
(1189, 2, 154, 1, 0, 0, 0, '2019-11-30 08:06:17'),
(1190, 2, 197, 1, 0, 0, 0, '2019-11-30 08:06:17'),
(1191, 2, 198, 1, 0, 0, 0, '2019-11-30 08:06:17'),
(1192, 2, 199, 1, 0, 0, 0, '2019-11-30 08:06:17'),
(1193, 2, 200, 1, 0, 0, 0, '2019-11-30 08:06:17'),
(1194, 2, 201, 1, 0, 0, 0, '2019-11-30 08:06:17'),
(1195, 2, 202, 1, 0, 0, 0, '2019-11-30 08:06:17'),
(1196, 2, 203, 1, 0, 0, 0, '2019-11-30 08:06:17'),
(1197, 2, 219, 1, 0, 0, 0, '2019-11-30 08:06:17'),
(1198, 2, 223, 1, 0, 0, 0, '2019-11-30 08:06:17'),
(1199, 2, 213, 1, 0, 0, 0, '2019-11-30 08:06:17'),
(1201, 2, 230, 1, 0, 0, 0, '2019-11-30 08:06:17'),
(1204, 2, 214, 1, 0, 1, 0, '2019-11-30 08:06:17'),
(1206, 2, 224, 1, 0, 0, 0, '2019-11-30 08:06:17'),
(1208, 2, 2, 1, 0, 0, 0, '2019-11-30 08:25:45'),
(1210, 2, 143, 1, 1, 1, 1, '2019-11-30 08:27:28'),
(1211, 2, 145, 1, 0, 0, 0, '2019-11-30 08:27:28'),
(1214, 2, 3, 1, 1, 1, 1, '2019-11-30 08:33:18'),
(1216, 2, 4, 1, 1, 1, 1, '2019-11-30 09:02:56'),
(1218, 2, 128, 0, 1, 0, 1, '2019-11-30 09:07:44'),
(1220, 3, 135, 1, 0, 1, 0, '2019-11-30 12:38:56'),
(1231, 3, 190, 1, 0, 0, 0, '2019-11-30 09:14:02'),
(1232, 3, 192, 1, 0, 0, 0, '2019-11-30 09:14:02'),
(1233, 3, 226, 1, 0, 0, 0, '2019-11-30 09:14:02'),
(1234, 3, 227, 1, 0, 0, 0, '2019-11-30 09:14:02'),
(1235, 3, 224, 1, 0, 0, 0, '2019-11-30 09:14:02'),
(1236, 2, 15, 1, 1, 1, 0, '2019-11-30 09:24:25'),
(1239, 2, 122, 1, 0, 0, 0, '2019-11-30 09:27:48'),
(1240, 2, 136, 1, 0, 0, 0, '2019-11-30 09:27:48'),
(1242, 6, 217, 1, 0, 0, 0, '2019-11-30 09:30:13'),
(1243, 6, 224, 1, 0, 0, 0, '2019-11-30 09:30:13'),
(1245, 2, 20, 1, 1, 1, 1, '2019-11-30 09:31:28'),
(1246, 2, 137, 1, 1, 1, 1, '2019-11-30 09:32:40'),
(1248, 2, 141, 1, 1, 1, 1, '2019-11-30 09:34:04'),
(1250, 2, 187, 1, 0, 0, 0, '2019-11-30 09:41:19'),
(1252, 2, 207, 1, 0, 0, 0, '2019-11-30 09:51:21'),
(1253, 2, 208, 1, 0, 1, 0, '2019-11-30 09:52:00'),
(1255, 2, 210, 1, 0, 1, 0, '2019-11-30 09:52:58'),
(1256, 2, 211, 1, 0, 1, 0, '2019-11-30 09:54:03'),
(1257, 2, 21, 1, 0, 0, 0, '2019-11-30 10:02:59'),
(1259, 2, 188, 1, 0, 0, 0, '2019-11-30 10:04:35'),
(1260, 2, 27, 1, 0, 0, 0, '2019-11-30 10:06:13'),
(1262, 2, 43, 1, 1, 1, 1, '2019-11-30 10:09:42'),
(1263, 2, 44, 1, 0, 0, 0, '2019-11-30 10:11:43'),
(1264, 2, 46, 1, 0, 0, 0, '2019-11-30 10:11:43'),
(1265, 2, 217, 1, 0, 0, 0, '2019-11-30 10:11:43'),
(1266, 2, 146, 1, 0, 0, 0, '2019-11-30 10:16:35'),
(1267, 2, 147, 1, 0, 0, 0, '2019-11-30 10:17:37'),
(1269, 2, 164, 1, 0, 0, 0, '2019-11-30 10:21:04'),
(1271, 2, 109, 1, 1, 0, 0, '2019-11-30 10:33:37'),
(1272, 2, 93, 1, 1, 1, 1, '2019-11-30 10:37:25'),
(1273, 2, 94, 1, 1, 0, 0, '2019-11-30 10:37:42'),
(1275, 2, 102, 1, 1, 1, 1, '2019-11-30 10:41:22'),
(1277, 2, 196, 1, 0, 0, 0, '2019-11-30 10:45:01'),
(1278, 2, 195, 1, 0, 0, 0, '2019-11-30 10:49:08'),
(1279, 2, 185, 1, 1, 1, 1, '2019-11-30 10:51:44'),
(1280, 2, 186, 1, 1, 1, 1, '2019-11-30 10:52:43'),
(1281, 2, 222, 1, 0, 1, 0, '2019-11-30 10:54:30'),
(1283, 3, 5, 1, 1, 0, 1, '2019-11-30 12:13:04'),
(1284, 3, 6, 1, 0, 0, 0, '2019-11-30 12:13:29'),
(1285, 3, 7, 1, 1, 1, 1, '2019-11-30 12:14:39'),
(1286, 3, 68, 1, 0, 0, 0, '2019-11-30 12:16:58'),
(1287, 3, 71, 1, 0, 0, 0, '2019-11-30 12:35:41'),
(1288, 3, 73, 1, 0, 0, 0, '2019-11-30 12:35:59'),
(1289, 3, 74, 1, 0, 0, 0, '2019-11-30 12:36:08'),
(1290, 3, 11, 1, 0, 0, 0, '2019-11-30 12:46:37'),
(1291, 3, 12, 1, 1, 1, 1, '2019-11-30 12:49:29'),
(1292, 3, 13, 1, 1, 1, 1, '2019-11-30 12:52:27'),
(1294, 3, 14, 1, 0, 0, 0, '2019-11-30 12:52:55'),
(1295, 3, 31, 1, 1, 1, 1, '2019-12-02 12:00:37'),
(1297, 3, 37, 1, 1, 1, 1, '2019-11-30 12:58:09'),
(1298, 3, 38, 1, 1, 1, 1, '2019-11-30 12:59:02'),
(1299, 3, 39, 1, 1, 1, 1, '2019-11-30 13:00:07'),
(1300, 3, 40, 1, 1, 1, 1, '2019-11-30 13:02:43'),
(1301, 3, 44, 1, 0, 0, 0, '2019-11-30 13:14:09'),
(1302, 3, 46, 1, 0, 0, 0, '2019-11-30 13:14:09'),
(1303, 3, 217, 1, 0, 0, 0, '2019-11-30 13:14:09'),
(1304, 3, 155, 1, 0, 0, 0, '2019-11-30 13:14:32'),
(1305, 3, 156, 1, 0, 0, 0, '2019-11-30 13:15:18'),
(1306, 3, 157, 1, 0, 0, 0, '2019-11-30 13:15:42'),
(1307, 3, 158, 1, 0, 0, 0, '2019-11-30 13:16:07'),
(1308, 3, 159, 1, 0, 0, 0, '2019-11-30 13:16:21'),
(1309, 3, 160, 1, 0, 0, 0, '2019-11-30 13:16:33'),
(1313, 3, 161, 1, 0, 0, 0, '2019-11-30 13:18:26'),
(1314, 3, 162, 1, 0, 0, 0, '2019-11-30 13:18:48'),
(1315, 3, 163, 1, 0, 0, 0, '2019-11-30 13:18:48'),
(1316, 3, 164, 1, 0, 0, 0, '2019-11-30 13:19:47'),
(1317, 3, 165, 1, 0, 0, 0, '2019-11-30 13:19:47'),
(1318, 3, 174, 1, 0, 0, 0, '2019-11-30 13:19:47'),
(1319, 3, 175, 1, 0, 0, 0, '2019-11-30 13:19:59'),
(1320, 3, 181, 1, 0, 0, 0, '2019-11-30 13:20:08'),
(1321, 3, 86, 1, 1, 1, 1, '2019-11-30 13:24:08'),
(1322, 4, 28, 1, 1, 1, 1, '2019-12-01 06:22:39'),
(1324, 4, 29, 1, 0, 0, 0, '2019-12-01 06:23:46'),
(1325, 4, 30, 1, 0, 0, 0, '2019-12-01 06:23:59'),
(1326, 4, 123, 1, 0, 0, 0, '2019-12-01 06:24:26'),
(1327, 4, 228, 1, 0, 0, 0, '2019-12-01 06:24:39'),
(1328, 4, 43, 1, 1, 1, 1, '2019-12-01 06:28:05'),
(1332, 4, 44, 1, 0, 0, 0, '2019-12-01 06:29:16'),
(1333, 4, 46, 1, 0, 0, 0, '2019-12-01 06:29:16'),
(1334, 4, 217, 1, 0, 0, 0, '2019-12-01 06:29:16'),
(1335, 4, 178, 1, 0, 0, 0, '2019-12-01 06:29:59'),
(1336, 4, 179, 1, 0, 0, 0, '2019-12-01 06:30:11'),
(1337, 4, 180, 1, 0, 0, 0, '2019-12-01 06:30:29'),
(1338, 4, 221, 1, 0, 0, 0, '2019-12-01 06:30:46'),
(1339, 4, 86, 1, 0, 0, 0, '2019-12-01 06:31:02'),
(1341, 4, 106, 1, 0, 0, 0, '2019-12-01 06:35:21'),
(1342, 1, 107, 1, 0, 0, 0, '2019-12-01 06:36:44'),
(1343, 4, 117, 1, 0, 0, 0, '2019-12-01 06:40:20'),
(1344, 4, 194, 1, 0, 0, 0, '2019-12-01 06:41:35'),
(1348, 4, 230, 1, 0, 0, 0, '2019-12-01 06:49:15'),
(1350, 6, 1, 1, 0, 0, 0, '2019-12-01 07:05:32'),
(1351, 6, 21, 1, 0, 0, 0, '2019-12-01 07:06:29'),
(1352, 6, 23, 1, 0, 0, 0, '2019-12-01 07:06:45'),
(1353, 6, 24, 1, 0, 0, 0, '2019-12-01 07:07:05'),
(1354, 6, 25, 1, 0, 0, 0, '2019-12-01 07:07:34'),
(1355, 6, 77, 1, 0, 0, 0, '2019-12-01 07:08:08'),
(1356, 6, 188, 1, 0, 0, 0, '2019-12-01 07:08:45'),
(1357, 6, 43, 1, 1, 1, 1, '2019-12-01 07:10:44'),
(1358, 6, 78, 1, 1, 1, 1, '2019-12-01 07:13:04'),
(1360, 6, 79, 1, 1, 0, 1, '2019-12-01 07:14:39'),
(1361, 6, 80, 1, 1, 1, 1, '2019-12-01 07:15:08'),
(1362, 6, 81, 1, 1, 1, 1, '2019-12-01 07:17:50'),
(1363, 6, 85, 1, 1, 1, 1, '2019-12-01 07:20:43'),
(1364, 6, 86, 1, 0, 0, 0, '2019-12-01 07:21:10'),
(1365, 6, 106, 1, 0, 0, 0, '2019-12-01 07:22:55'),
(1366, 6, 117, 1, 0, 0, 0, '2019-12-01 07:23:08'),
(1394, 1, 106, 1, 0, 0, 0, '2019-12-02 10:50:33'),
(1395, 1, 113, 1, 0, 0, 0, '2019-12-02 10:50:59'),
(1396, 1, 114, 1, 0, 0, 0, '2019-12-02 10:51:34'),
(1397, 1, 115, 1, 0, 0, 0, '2019-12-02 10:51:34'),
(1398, 1, 116, 1, 0, 0, 0, '2019-12-02 10:51:54'),
(1399, 1, 117, 1, 0, 0, 0, '2019-12-02 10:52:04'),
(1400, 1, 118, 1, 0, 0, 0, '2019-12-02 10:52:20'),
(1402, 1, 191, 1, 0, 0, 0, '2019-12-02 10:53:34'),
(1403, 1, 192, 1, 0, 0, 0, '2019-12-02 10:53:47'),
(1404, 1, 193, 1, 0, 0, 0, '2019-12-02 10:53:58'),
(1405, 1, 194, 1, 0, 0, 0, '2019-12-02 10:54:11'),
(1406, 1, 195, 1, 0, 0, 0, '2019-12-02 10:54:20'),
(1408, 1, 227, 1, 0, 0, 0, '2019-12-02 10:55:47'),
(1410, 1, 226, 1, 0, 0, 0, '2019-12-02 11:01:41'),
(1411, 1, 229, 1, 0, 0, 0, '2019-12-02 11:02:57'),
(1412, 1, 230, 1, 0, 0, 0, '2019-12-02 11:02:57'),
(1413, 1, 190, 1, 0, 0, 0, '2019-12-02 11:13:41'),
(1414, 2, 174, 1, 0, 0, 0, '2019-12-02 11:24:37'),
(1415, 2, 175, 1, 0, 0, 0, '2019-12-02 11:24:37'),
(1418, 2, 232, 1, 0, 1, 1, '2019-12-02 11:41:27'),
(1419, 2, 231, 1, 0, 0, 0, '2019-12-02 11:42:28'),
(1420, 1, 231, 1, 0, 0, 0, '2019-12-02 11:49:32'),
(1421, 1, 232, 1, 0, 1, 1, '2019-12-02 11:49:32'),
(1422, 3, 32, 1, 1, 1, 1, '2019-12-02 12:00:37'),
(1423, 3, 33, 1, 1, 1, 1, '2019-12-02 12:00:37'),
(1424, 3, 34, 1, 1, 1, 1, '2019-12-02 12:00:37'),
(1425, 3, 182, 1, 0, 0, 0, '2019-12-02 12:00:37'),
(1426, 3, 183, 1, 0, 0, 0, '2019-12-02 12:00:37'),
(1427, 3, 189, 1, 0, 1, 1, '2019-12-02 12:00:37'),
(1428, 3, 229, 1, 0, 0, 0, '2019-12-02 12:00:37'),
(1429, 3, 230, 1, 0, 0, 0, '2019-12-02 12:00:37'),
(1430, 4, 213, 1, 0, 0, 0, '2019-12-02 12:02:14'),
(1432, 4, 224, 1, 0, 0, 0, '2019-12-02 12:02:14'),
(1433, 4, 195, 1, 0, 0, 0, '2019-12-03 10:27:53'),
(1434, 4, 229, 1, 0, 0, 0, '2019-12-03 10:28:19'),
(1436, 6, 213, 1, 0, 0, 0, '2019-12-03 10:40:11'),
(1437, 6, 191, 1, 0, 0, 0, '2019-12-03 10:40:11'),
(1438, 6, 193, 1, 0, 0, 0, '2019-12-03 10:40:11'),
(1439, 6, 230, 1, 0, 0, 0, '2019-12-03 10:40:11'),
(1440, 2, 106, 1, 0, 0, 0, '2020-01-25 09:51:36'),
(1441, 2, 107, 1, 0, 0, 0, '2020-02-12 07:40:13'),
(1442, 2, 134, 1, 1, 1, 1, '2020-02-12 07:42:36'),
(1443, 1, 233, 1, 0, 0, 0, '2020-02-12 07:51:57'),
(1444, 2, 86, 1, 0, 0, 0, '2020-02-12 07:52:33'),
(1445, 3, 233, 1, 0, 0, 0, '2020-02-12 09:21:17');

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE `room_types` (
  `id` int(11) NOT NULL,
  `room_type` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `school_houses`
--

CREATE TABLE `school_houses` (
  `id` int(11) NOT NULL,
  `house_name` varchar(200) NOT NULL,
  `description` varchar(400) NOT NULL,
  `is_active` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sch_settings`
--

CREATE TABLE `sch_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `biometric` int(11) DEFAULT 0,
  `biometric_device` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `languages` varchar(500) NOT NULL,
  `dise_code` varchar(50) DEFAULT NULL,
  `date_format` varchar(50) NOT NULL,
  `time_format` varchar(255) NOT NULL,
  `currency` varchar(50) NOT NULL,
  `currency_symbol` varchar(50) NOT NULL,
  `is_rtl` varchar(10) DEFAULT 'disabled',
  `is_duplicate_fees_invoice` int(1) DEFAULT 0,
  `timezone` varchar(30) DEFAULT 'UTC',
  `session_id` int(11) DEFAULT NULL,
  `cron_secret_key` varchar(100) NOT NULL,
  `currency_place` varchar(50) NOT NULL DEFAULT 'before_number',
  `class_teacher` varchar(100) NOT NULL,
  `start_month` varchar(40) NOT NULL,
  `attendence_type` int(10) NOT NULL DEFAULT 0,
  `image` varchar(100) DEFAULT NULL,
  `admin_logo` varchar(255) NOT NULL,
  `admin_small_logo` varchar(255) NOT NULL,
  `theme` varchar(200) NOT NULL DEFAULT 'default.jpg',
  `fee_due_days` int(3) DEFAULT 0,
  `adm_auto_insert` int(1) NOT NULL DEFAULT 1,
  `adm_prefix` varchar(50) NOT NULL DEFAULT 'ssadm19/20',
  `adm_start_from` varchar(11) NOT NULL,
  `adm_no_digit` int(10) NOT NULL DEFAULT 6,
  `adm_update_status` int(11) NOT NULL DEFAULT 0,
  `staffid_auto_insert` int(11) NOT NULL DEFAULT 1,
  `staffid_prefix` varchar(100) NOT NULL DEFAULT 'staffss/19/20',
  `staffid_start_from` varchar(50) NOT NULL,
  `staffid_no_digit` int(11) NOT NULL DEFAULT 6,
  `staffid_update_status` int(11) NOT NULL DEFAULT 0,
  `is_active` varchar(255) DEFAULT 'no',
  `online_admission` int(1) DEFAULT 0,
  `is_blood_group` int(10) NOT NULL DEFAULT 1,
  `is_student_house` int(10) NOT NULL DEFAULT 1,
  `roll_no` int(11) NOT NULL DEFAULT 1,
  `category` int(11) NOT NULL,
  `religion` int(11) NOT NULL DEFAULT 1,
  `cast` int(11) NOT NULL DEFAULT 1,
  `mobile_no` int(11) NOT NULL DEFAULT 1,
  `student_email` int(11) NOT NULL DEFAULT 1,
  `admission_date` int(11) NOT NULL DEFAULT 1,
  `lastname` int(11) NOT NULL,
  `student_photo` int(11) NOT NULL DEFAULT 1,
  `student_height` int(11) NOT NULL DEFAULT 1,
  `student_weight` int(11) NOT NULL DEFAULT 1,
  `measurement_date` int(11) NOT NULL DEFAULT 1,
  `father_name` int(11) NOT NULL DEFAULT 1,
  `father_phone` int(11) NOT NULL DEFAULT 1,
  `father_occupation` int(11) NOT NULL DEFAULT 1,
  `father_pic` int(11) NOT NULL DEFAULT 1,
  `mother_name` int(11) NOT NULL DEFAULT 1,
  `mother_phone` int(11) NOT NULL DEFAULT 1,
  `mother_occupation` int(11) NOT NULL DEFAULT 1,
  `mother_pic` int(11) NOT NULL DEFAULT 1,
  `guardian_relation` int(11) NOT NULL DEFAULT 1,
  `guardian_email` int(11) NOT NULL DEFAULT 1,
  `guardian_pic` int(11) NOT NULL DEFAULT 1,
  `guardian_address` int(11) NOT NULL DEFAULT 1,
  `current_address` int(11) NOT NULL DEFAULT 1,
  `permanent_address` int(11) NOT NULL DEFAULT 1,
  `route_list` int(11) NOT NULL DEFAULT 1,
  `hostel_id` int(11) NOT NULL DEFAULT 1,
  `bank_account_no` int(11) NOT NULL DEFAULT 1,
  `national_identification_no` int(11) NOT NULL DEFAULT 1,
  `local_identification_no` int(11) NOT NULL DEFAULT 1,
  `rte` int(11) NOT NULL DEFAULT 1,
  `previous_school_details` int(11) NOT NULL DEFAULT 1,
  `student_note` int(11) NOT NULL DEFAULT 1,
  `upload_documents` int(11) NOT NULL DEFAULT 1,
  `staff_designation` int(11) NOT NULL DEFAULT 1,
  `staff_department` int(11) NOT NULL DEFAULT 1,
  `staff_last_name` int(11) NOT NULL DEFAULT 1,
  `staff_father_name` int(11) NOT NULL DEFAULT 1,
  `staff_mother_name` int(11) NOT NULL DEFAULT 1,
  `staff_date_of_joining` int(11) NOT NULL DEFAULT 1,
  `staff_phone` int(11) NOT NULL DEFAULT 1,
  `staff_emergency_contact` int(11) NOT NULL DEFAULT 1,
  `staff_marital_status` int(11) NOT NULL DEFAULT 1,
  `staff_photo` int(11) NOT NULL DEFAULT 1,
  `staff_current_address` int(11) NOT NULL DEFAULT 1,
  `staff_permanent_address` int(11) NOT NULL DEFAULT 1,
  `staff_qualification` int(11) NOT NULL DEFAULT 1,
  `staff_work_experience` int(11) NOT NULL DEFAULT 1,
  `staff_note` int(11) NOT NULL DEFAULT 1,
  `staff_epf_no` int(11) NOT NULL DEFAULT 1,
  `staff_basic_salary` int(11) NOT NULL DEFAULT 1,
  `staff_contract_type` int(11) NOT NULL DEFAULT 1,
  `staff_work_shift` int(11) NOT NULL DEFAULT 1,
  `staff_work_location` int(11) NOT NULL DEFAULT 1,
  `staff_leaves` int(11) NOT NULL DEFAULT 1,
  `staff_account_details` int(11) NOT NULL DEFAULT 1,
  `staff_social_media` int(11) NOT NULL DEFAULT 1,
  `staff_upload_documents` int(11) NOT NULL DEFAULT 1,
  `mobile_api_url` tinytext NOT NULL,
  `app_primary_color_code` varchar(20) DEFAULT NULL,
  `app_secondary_color_code` varchar(20) DEFAULT NULL,
  `app_logo` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sch_settings`
--

INSERT INTO `sch_settings` (`id`, `name`, `biometric`, `biometric_device`, `email`, `phone`, `address`, `lang_id`, `languages`, `dise_code`, `date_format`, `time_format`, `currency`, `currency_symbol`, `is_rtl`, `is_duplicate_fees_invoice`, `timezone`, `session_id`, `cron_secret_key`, `currency_place`, `class_teacher`, `start_month`, `attendence_type`, `image`, `admin_logo`, `admin_small_logo`, `theme`, `fee_due_days`, `adm_auto_insert`, `adm_prefix`, `adm_start_from`, `adm_no_digit`, `adm_update_status`, `staffid_auto_insert`, `staffid_prefix`, `staffid_start_from`, `staffid_no_digit`, `staffid_update_status`, `is_active`, `online_admission`, `is_blood_group`, `is_student_house`, `roll_no`, `category`, `religion`, `cast`, `mobile_no`, `student_email`, `admission_date`, `lastname`, `student_photo`, `student_height`, `student_weight`, `measurement_date`, `father_name`, `father_phone`, `father_occupation`, `father_pic`, `mother_name`, `mother_phone`, `mother_occupation`, `mother_pic`, `guardian_relation`, `guardian_email`, `guardian_pic`, `guardian_address`, `current_address`, `permanent_address`, `route_list`, `hostel_id`, `bank_account_no`, `national_identification_no`, `local_identification_no`, `rte`, `previous_school_details`, `student_note`, `upload_documents`, `staff_designation`, `staff_department`, `staff_last_name`, `staff_father_name`, `staff_mother_name`, `staff_date_of_joining`, `staff_phone`, `staff_emergency_contact`, `staff_marital_status`, `staff_photo`, `staff_current_address`, `staff_permanent_address`, `staff_qualification`, `staff_work_experience`, `staff_note`, `staff_epf_no`, `staff_basic_salary`, `staff_contract_type`, `staff_work_shift`, `staff_work_location`, `staff_leaves`, `staff_account_details`, `staff_social_media`, `staff_upload_documents`, `mobile_api_url`, `app_primary_color_code`, `app_secondary_color_code`, `app_logo`, `created_at`, `updated_at`) VALUES
(1, 'Your School Name', 0, '', 'yourschoolemail@domain.com', 'Your School Phone', 'Your School Address', 4, '[\"4\"]', 'Your School Code', 'm/d/Y', '12-hour', 'USD', '$', 'disabled', 0, 'UTC', 14, '', 'before_number', 'no', '4', 0, '1.png', '1.png', '1.png', 'default.jpg', 60, 0, '', '', 0, 1, 0, '', '', 0, 1, 'no', 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '', '#424242', '#eeeeee', '1.png', '2020-02-28 13:57:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `section` varchar(60) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `send_notification`
--

CREATE TABLE `send_notification` (
  `id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `date` date DEFAULT NULL,
  `message` text DEFAULT NULL,
  `visible_student` varchar(10) NOT NULL DEFAULT 'no',
  `visible_staff` varchar(10) NOT NULL DEFAULT 'no',
  `visible_parent` varchar(10) NOT NULL DEFAULT 'no',
  `created_by` varchar(60) DEFAULT NULL,
  `created_id` int(11) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `session` varchar(60) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `session`, `is_active`, `created_at`, `updated_at`) VALUES
(7, '2016-17', 'no', '2017-04-20 06:42:19', '0000-00-00'),
(11, '2017-18', 'no', '2017-04-20 06:41:37', '0000-00-00'),
(13, '2018-19', 'no', '2016-08-24 19:26:44', '0000-00-00'),
(14, '2019-20', 'no', '2016-08-24 19:26:55', '0000-00-00'),
(15, '2020-21', 'no', '2016-10-01 05:28:08', '0000-00-00'),
(16, '2021-22', 'no', '2016-10-01 05:28:20', '0000-00-00'),
(18, '2022-23', 'no', '2016-10-01 05:29:02', '0000-00-00'),
(19, '2023-24', 'no', '2016-10-01 05:29:10', '0000-00-00'),
(20, '2024-25', 'no', '2016-10-01 05:29:18', '0000-00-00'),
(21, '2025-26', 'no', '2016-10-01 05:30:10', '0000-00-00'),
(22, '2026-27', 'no', '2016-10-01 05:30:18', '0000-00-00'),
(23, '2027-28', 'no', '2016-10-01 05:30:24', '0000-00-00'),
(24, '2028-29', 'no', '2016-10-01 05:30:30', '0000-00-00'),
(25, '2029-30', 'no', '2016-10-01 05:30:37', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `sms_config`
--

CREATE TABLE `sms_config` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `api_id` varchar(100) NOT NULL,
  `authkey` varchar(100) NOT NULL,
  `senderid` varchar(100) NOT NULL,
  `contact` text DEFAULT NULL,
  `username` varchar(150) DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'disabled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `source`
--

CREATE TABLE `source` (
  `id` int(11) NOT NULL,
  `source` varchar(100) NOT NULL,
  `description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(200) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `department` int(11) DEFAULT 0,
  `designation` int(11) DEFAULT 0,
  `qualification` varchar(200) NOT NULL,
  `work_exp` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `surname` varchar(200) NOT NULL,
  `father_name` varchar(200) NOT NULL,
  `mother_name` varchar(200) NOT NULL,
  `contact_no` varchar(200) NOT NULL,
  `emergency_contact_no` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `dob` date NOT NULL,
  `marital_status` varchar(100) NOT NULL,
  `date_of_joining` date NOT NULL,
  `date_of_leaving` date NOT NULL,
  `local_address` varchar(300) NOT NULL,
  `permanent_address` varchar(200) NOT NULL,
  `note` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `password` varchar(250) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `account_title` varchar(200) NOT NULL,
  `bank_account_no` varchar(200) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `ifsc_code` varchar(200) NOT NULL,
  `bank_branch` varchar(100) NOT NULL,
  `payscale` varchar(200) NOT NULL,
  `basic_salary` varchar(200) NOT NULL,
  `epf_no` varchar(200) NOT NULL,
  `contract_type` varchar(100) NOT NULL,
  `shift` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `facebook` varchar(200) NOT NULL,
  `twitter` varchar(200) NOT NULL,
  `linkedin` varchar(200) NOT NULL,
  `instagram` varchar(200) NOT NULL,
  `resume` varchar(200) NOT NULL,
  `joining_letter` varchar(200) NOT NULL,
  `resignation_letter` varchar(200) NOT NULL,
  `other_document_name` varchar(200) NOT NULL,
  `other_document_file` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `verification_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `staff_attendance`
--

CREATE TABLE `staff_attendance` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `staff_id` int(11) NOT NULL,
  `staff_attendance_type_id` int(11) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `staff_attendance_type`
--

CREATE TABLE `staff_attendance_type` (
  `id` int(11) NOT NULL,
  `type` varchar(200) NOT NULL,
  `key_value` varchar(200) NOT NULL,
  `is_active` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff_attendance_type`
--

INSERT INTO `staff_attendance_type` (`id`, `type`, `key_value`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Present', '<b class=\"text text-success\">P</b>', 'yes', '0000-00-00 00:00:00', '0000-00-00'),
(2, 'Late', '<b class=\"text text-warning\">L</b>', 'yes', '0000-00-00 00:00:00', '0000-00-00'),
(3, 'Absent', '<b class=\"text text-danger\">A</b>', 'yes', '0000-00-00 00:00:00', '0000-00-00'),
(4, 'Half Day', '<b class=\"text text-warning\">F</b>', 'yes', '2018-05-07 01:56:16', '0000-00-00'),
(5, 'Holiday', 'H', 'yes', '0000-00-00 00:00:00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `staff_designation`
--

CREATE TABLE `staff_designation` (
  `id` int(11) NOT NULL,
  `designation` varchar(200) NOT NULL,
  `is_active` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `staff_leave_details`
--

CREATE TABLE `staff_leave_details` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `alloted_leave` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `staff_leave_request`
--

CREATE TABLE `staff_leave_request` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `leave_from` date NOT NULL,
  `leave_to` date NOT NULL,
  `leave_days` int(11) NOT NULL,
  `employee_remark` varchar(200) NOT NULL,
  `admin_remark` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL,
  `applied_by` varchar(200) NOT NULL,
  `document_file` varchar(200) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `staff_payroll`
--

CREATE TABLE `staff_payroll` (
  `id` int(11) NOT NULL,
  `basic_salary` int(11) NOT NULL,
  `pay_scale` varchar(200) NOT NULL,
  `grade` varchar(50) NOT NULL,
  `is_active` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `staff_payslip`
--

CREATE TABLE `staff_payslip` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `basic` int(11) NOT NULL,
  `total_allowance` int(11) NOT NULL,
  `total_deduction` int(11) NOT NULL,
  `leave_deduction` int(11) NOT NULL,
  `tax` varchar(200) NOT NULL,
  `net_salary` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `month` varchar(200) NOT NULL,
  `year` varchar(200) NOT NULL,
  `payment_mode` varchar(200) NOT NULL,
  `payment_date` date NOT NULL,
  `remark` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `staff_rating`
--

CREATE TABLE `staff_rating` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `comment` text CHARACTER SET latin1 NOT NULL,
  `rate` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role` varchar(255) CHARACTER SET latin1 NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 decline, 1 Approve',
  `entrydt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `staff_roles`
--

CREATE TABLE `staff_roles` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `staff_timeline`
--

CREATE TABLE `staff_timeline` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `timeline_date` date NOT NULL,
  `description` varchar(300) NOT NULL,
  `document` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `admission_no` varchar(100) DEFAULT NULL,
  `roll_no` varchar(100) DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `rte` varchar(20) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `mobileno` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `pincode` varchar(100) DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `cast` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `current_address` text DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `category_id` varchar(100) DEFAULT NULL,
  `route_id` int(11) NOT NULL,
  `school_house_id` int(11) NOT NULL,
  `blood_group` varchar(200) NOT NULL,
  `vehroute_id` int(11) NOT NULL,
  `hostel_room_id` int(11) NOT NULL,
  `adhar_no` varchar(100) DEFAULT NULL,
  `samagra_id` varchar(100) DEFAULT NULL,
  `bank_account_no` varchar(100) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `ifsc_code` varchar(100) DEFAULT NULL,
  `guardian_is` varchar(100) NOT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `father_phone` varchar(100) DEFAULT NULL,
  `father_occupation` varchar(100) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `mother_phone` varchar(100) DEFAULT NULL,
  `mother_occupation` varchar(100) DEFAULT NULL,
  `guardian_name` varchar(100) DEFAULT NULL,
  `guardian_relation` varchar(100) DEFAULT NULL,
  `guardian_phone` varchar(100) DEFAULT NULL,
  `guardian_occupation` varchar(150) NOT NULL,
  `guardian_address` text DEFAULT NULL,
  `guardian_email` varchar(100) DEFAULT NULL,
  `father_pic` varchar(200) NOT NULL,
  `mother_pic` varchar(200) NOT NULL,
  `guardian_pic` varchar(200) NOT NULL,
  `is_active` varchar(255) DEFAULT 'yes',
  `previous_school` text DEFAULT NULL,
  `height` varchar(100) NOT NULL,
  `weight` varchar(100) NOT NULL,
  `measurement_date` date NOT NULL,
  `dis_reason` int(11) NOT NULL,
  `note` varchar(200) DEFAULT NULL,
  `dis_note` text NOT NULL,
  `app_key` text DEFAULT NULL,
  `parent_app_key` text DEFAULT NULL,
  `disable_at` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student_applyleave`
--

CREATE TABLE `student_applyleave` (
  `id` int(11) NOT NULL,
  `student_session_id` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `apply_date` date NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `docs` text NOT NULL,
  `reason` text NOT NULL,
  `approve_by` int(11) NOT NULL,
  `request_type` int(11) NOT NULL COMMENT '0 student,1 staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student_attendences`
--

CREATE TABLE `student_attendences` (
  `id` int(11) NOT NULL,
  `student_session_id` int(11) DEFAULT NULL,
  `biometric_attendence` int(1) NOT NULL DEFAULT 0,
  `date` date DEFAULT NULL,
  `attendence_type_id` int(11) DEFAULT NULL,
  `remark` varchar(200) NOT NULL,
  `biometric_device_data` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student_doc`
--

CREATE TABLE `student_doc` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `doc` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student_fees`
--

CREATE TABLE `student_fees` (
  `id` int(11) NOT NULL,
  `student_session_id` int(11) DEFAULT NULL,
  `feemaster_id` int(11) DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `amount_discount` float(10,2) NOT NULL,
  `amount_fine` float(10,2) NOT NULL DEFAULT 0.00,
  `description` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student_fees_deposite`
--

CREATE TABLE `student_fees_deposite` (
  `id` int(11) NOT NULL,
  `student_fees_master_id` int(11) DEFAULT NULL,
  `fee_groups_feetype_id` int(11) DEFAULT NULL,
  `amount_detail` text DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student_fees_discounts`
--

CREATE TABLE `student_fees_discounts` (
  `id` int(11) NOT NULL,
  `student_session_id` int(11) DEFAULT NULL,
  `fees_discount_id` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'assigned',
  `payment_id` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student_fees_master`
--

CREATE TABLE `student_fees_master` (
  `id` int(11) NOT NULL,
  `is_system` int(1) NOT NULL DEFAULT 0,
  `student_session_id` int(11) DEFAULT NULL,
  `fee_session_group_id` int(11) DEFAULT NULL,
  `amount` float(10,2) DEFAULT 0.00,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student_session`
--

CREATE TABLE `student_session` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `route_id` int(11) NOT NULL,
  `hostel_room_id` int(11) NOT NULL,
  `vehroute_id` int(10) DEFAULT NULL,
  `transport_fees` float(10,2) NOT NULL DEFAULT 0.00,
  `fees_discount` float(10,2) NOT NULL DEFAULT 0.00,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student_sibling`
--

CREATE TABLE `student_sibling` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `sibling_student_id` int(11) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student_subject_attendances`
--

CREATE TABLE `student_subject_attendances` (
  `id` int(11) NOT NULL,
  `student_session_id` int(11) DEFAULT NULL,
  `subject_timetable_id` int(11) DEFAULT NULL,
  `attendence_type_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `remark` text CHARACTER SET latin1 DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student_timeline`
--

CREATE TABLE `student_timeline` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `timeline_date` date NOT NULL,
  `description` varchar(200) NOT NULL,
  `document` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `code` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subject_groups`
--

CREATE TABLE `subject_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `description` text CHARACTER SET latin1 DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subject_group_class_sections`
--

CREATE TABLE `subject_group_class_sections` (
  `id` int(11) NOT NULL,
  `subject_group_id` int(11) DEFAULT NULL,
  `class_section_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subject_group_subjects`
--

CREATE TABLE `subject_group_subjects` (
  `id` int(11) NOT NULL,
  `subject_group_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subject_timetable`
--

CREATE TABLE `subject_timetable` (
  `id` int(11) NOT NULL,
  `day` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `subject_group_id` int(11) DEFAULT NULL,
  `subject_group_subject_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `time_from` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `time_to` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `room_no` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `submit_assignment`
--

CREATE TABLE `submit_assignment` (
  `id` int(11) NOT NULL,
  `homework_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `docs` varchar(225) NOT NULL,
  `file_name` text,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subjects`
--

CREATE TABLE `teacher_subjects` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `class_section_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `template_admitcards`
--

CREATE TABLE `template_admitcards` (
  `id` int(11) NOT NULL,
  `template` varchar(250) DEFAULT NULL,
  `heading` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `left_logo` varchar(200) DEFAULT NULL,
  `right_logo` varchar(200) DEFAULT NULL,
  `exam_name` varchar(200) DEFAULT NULL,
  `school_name` varchar(200) DEFAULT NULL,
  `exam_center` varchar(200) DEFAULT NULL,
  `sign` varchar(200) DEFAULT NULL,
  `background_img` varchar(200) DEFAULT NULL,
  `is_name` int(1) NOT NULL DEFAULT 1,
  `is_father_name` int(1) NOT NULL DEFAULT 1,
  `is_mother_name` int(1) NOT NULL DEFAULT 1,
  `is_dob` int(1) NOT NULL DEFAULT 1,
  `is_admission_no` int(1) NOT NULL DEFAULT 1,
  `is_roll_no` int(1) NOT NULL DEFAULT 1,
  `is_address` int(1) NOT NULL DEFAULT 1,
  `is_gender` int(1) NOT NULL DEFAULT 1,
  `is_photo` int(11) NOT NULL,
  `is_class` int(11) NOT NULL DEFAULT 0,
  `is_section` int(11) NOT NULL DEFAULT 0,
  `content_footer` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `template_admitcards`
--

INSERT INTO `template_admitcards` (`id`, `template`, `heading`, `title`, `left_logo`, `right_logo`, `exam_name`, `school_name`, `exam_center`, `sign`, `background_img`, `is_name`, `is_father_name`, `is_mother_name`, `is_dob`, `is_admission_no`, `is_roll_no`, `is_address`, `is_gender`, `is_photo`, `is_class`, `is_section`, `content_footer`, `created_at`, `updated_at`) VALUES
(1, 'Sample Admit Card', 'BOARD OF SECONDARY EDUCATION, MADHYA PRADESH, BHOPAL', 'HIGHER SECONDARY SCHOOL CERTIFICATE EXAMINATION (10+2) 2014', 'ab12c4b65f53ee621dcf84370a7c5be4.png', '0910482bf79df5fd103e8383d61b387a.png', 'Test', 'Mount Carmel School', 'test dmit card2', 'aa9c7087e68c5af1d2c04946de1d3bd3.png', '782a71f53ea6bca213012d49e9d46d98.jpg', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '2020-02-28 14:26:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_marksheets`
--

CREATE TABLE `template_marksheets` (
  `id` int(11) NOT NULL,
  `template` varchar(200) DEFAULT NULL,
  `heading` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `left_logo` varchar(200) DEFAULT NULL,
  `right_logo` varchar(200) DEFAULT NULL,
  `exam_name` varchar(200) DEFAULT NULL,
  `school_name` varchar(200) DEFAULT NULL,
  `exam_center` varchar(200) DEFAULT NULL,
  `left_sign` varchar(200) DEFAULT NULL,
  `middle_sign` varchar(200) DEFAULT NULL,
  `right_sign` varchar(200) DEFAULT NULL,
  `exam_session` int(1) DEFAULT 1,
  `is_name` int(1) DEFAULT 1,
  `is_father_name` int(1) DEFAULT 1,
  `is_mother_name` int(1) DEFAULT 1,
  `is_dob` int(1) DEFAULT 1,
  `is_admission_no` int(1) DEFAULT 1,
  `is_roll_no` int(1) DEFAULT 1,
  `is_photo` int(11) DEFAULT 1,
  `is_division` int(1) NOT NULL DEFAULT 1,
  `is_customfield` int(1) NOT NULL,
  `background_img` varchar(200) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `is_class` int(11) NOT NULL DEFAULT 0,
  `is_section` int(11) NOT NULL DEFAULT 0,
  `content` text DEFAULT NULL,
  `content_footer` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `template_marksheets`
--

INSERT INTO `template_marksheets` (`id`, `template`, `heading`, `title`, `left_logo`, `right_logo`, `exam_name`, `school_name`, `exam_center`, `left_sign`, `middle_sign`, `right_sign`, `exam_session`, `is_name`, `is_father_name`, `is_mother_name`, `is_dob`, `is_admission_no`, `is_roll_no`, `is_photo`, `is_division`, `is_customfield`, `background_img`, `date`, `is_class`, `is_section`, `content`, `content_footer`, `created_at`, `updated_at`) VALUES
(1, 'Sample Marksheet', 'BOARD OF SECONDARY EDUCATION, MADHYA PRADESH, BHOPAL', 'BOARD OF SECONDARY EDUCATION, MADHYA PRADESH, BHOPAL', 'f314cec3f688771ccaeddbcee6e52f7c.png', 'e824b2df53266266be2dbfd2001168b8.png', 'HIGHER SECONDARY SCHOOL CERTIFICATE EXAMINATION', 'Mount Carmel School', 'GOVT GIRLS H S SCHOOL', '331e0690e50f8c6b7a219a0a2b9667f7.png', '351f513d79ee5c0f642c2d36514a1ff4.png', 'fb79d2c0d163357d1706b78550a05e2c.png', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '', NULL, 0, 0, NULL, NULL, '2020-02-28 14:26:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `timetables`
--

CREATE TABLE `timetables` (
  `id` int(11) NOT NULL,
  `teacher_subject_id` int(20) DEFAULT NULL,
  `day_name` varchar(50) DEFAULT NULL,
  `start_time` varchar(50) DEFAULT NULL,
  `end_time` varchar(50) DEFAULT NULL,
  `room_no` varchar(50) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transport_route`
--

CREATE TABLE `transport_route` (
  `id` int(11) NOT NULL,
  `route_title` varchar(100) DEFAULT NULL,
  `no_of_vehicle` int(11) DEFAULT NULL,
  `fare` float(10,2) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `user` varchar(100) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `ipaddress` varchar(100) DEFAULT NULL,
  `user_agent` varchar(500) DEFAULT NULL,
  `login_datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `childs` text NOT NULL,
  `role` varchar(30) NOT NULL,
  `verification_code` varchar(200) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `is_active` varchar(255) DEFAULT 'yes',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users_authentication`
--

CREATE TABLE `users_authentication` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expired_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(10) UNSIGNED NOT NULL,
  `vehicle_no` varchar(20) DEFAULT NULL,
  `vehicle_model` varchar(100) NOT NULL DEFAULT 'None',
  `manufacture_year` varchar(4) DEFAULT NULL,
  `driver_name` varchar(50) DEFAULT NULL,
  `driver_licence` varchar(50) NOT NULL DEFAULT 'None',
  `driver_contact` varchar(20) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_routes`
--

CREATE TABLE `vehicle_routes` (
  `id` int(11) NOT NULL,
  `route_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `visitors_book`
--

CREATE TABLE `visitors_book` (
  `id` int(11) NOT NULL,
  `source` varchar(100) DEFAULT NULL,
  `purpose` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact` varchar(12) NOT NULL,
  `id_proof` varchar(50) NOT NULL,
  `no_of_pepple` int(11) NOT NULL,
  `date` date NOT NULL,
  `in_time` varchar(20) NOT NULL,
  `out_time` varchar(20) NOT NULL,
  `note` mediumtext NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `visitors_purpose`
--

CREATE TABLE `visitors_purpose` (
  `id` int(11) NOT NULL,
  `visitors_purpose` varchar(100) NOT NULL,
  `description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendence_type`
--
ALTER TABLE `attendence_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_issues`
--
ALTER TABLE `book_issues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_connections`
--
ALTER TABLE `chat_connections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_user_one` (`chat_user_one`),
  ADD KEY `chat_user_two` (`chat_user_two`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_user_id` (`chat_user_id`),
  ADD KEY `chat_connection_id` (`chat_connection_id`);

--
-- Indexes for table `chat_users`
--
ALTER TABLE `chat_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `create_staff_id` (`create_staff_id`),
  ADD KEY `create_student_id` (`create_student_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_sections`
--
ALTER TABLE `class_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `class_teacher`
--
ALTER TABLE `class_teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaint_type`
--
ALTER TABLE `complaint_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_for`
--
ALTER TABLE `content_for`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_id` (`content_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `custom_fields`
--
ALTER TABLE `custom_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_field_values`
--
ALTER TABLE `custom_field_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `custom_field_id` (`custom_field_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disable_reason`
--
ALTER TABLE `disable_reason`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dispatch_receive`
--
ALTER TABLE `dispatch_receive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_config`
--
ALTER TABLE `email_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiry`
--
ALTER TABLE `enquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiry_type`
--
ALTER TABLE `enquiry_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_groups`
--
ALTER TABLE `exam_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_group_class_batch_exams`
--
ALTER TABLE `exam_group_class_batch_exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_group_id` (`exam_group_id`);

--
-- Indexes for table `exam_group_class_batch_exam_students`
--
ALTER TABLE `exam_group_class_batch_exam_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_group_class_batch_exam_id` (`exam_group_class_batch_exam_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `student_session_id` (`student_session_id`);

--
-- Indexes for table `exam_group_class_batch_exam_subjects`
--
ALTER TABLE `exam_group_class_batch_exam_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_group_class_batch_exams_id` (`exam_group_class_batch_exams_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `exam_group_exam_connections`
--
ALTER TABLE `exam_group_exam_connections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_group_id` (`exam_group_id`),
  ADD KEY `exam_group_class_batch_exams_id` (`exam_group_class_batch_exams_id`);

--
-- Indexes for table `exam_group_exam_results`
--
ALTER TABLE `exam_group_exam_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_group_class_batch_exam_subject_id` (`exam_group_class_batch_exam_subject_id`),
  ADD KEY `exam_group_student_id` (`exam_group_student_id`),
  ADD KEY `exam_group_class_batch_exam_student_id` (`exam_group_class_batch_exam_student_id`);

--
-- Indexes for table `exam_group_students`
--
ALTER TABLE `exam_group_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_group_id` (`exam_group_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_schedule_id` (`exam_schedule_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `exam_schedules`
--
ALTER TABLE `exam_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_subject_id` (`teacher_subject_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_head`
--
ALTER TABLE `expense_head`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feecategory`
--
ALTER TABLE `feecategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feemasters`
--
ALTER TABLE `feemasters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees_discounts`
--
ALTER TABLE `fees_discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `fees_reminder`
--
ALTER TABLE `fees_reminder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feetype`
--
ALTER TABLE `feetype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_groups`
--
ALTER TABLE `fee_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_groups_feetype`
--
ALTER TABLE `fee_groups_feetype`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fee_session_group_id` (`fee_session_group_id`),
  ADD KEY `fee_groups_id` (`fee_groups_id`),
  ADD KEY `feetype_id` (`feetype_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `fee_receipt_no`
--
ALTER TABLE `fee_receipt_no`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_session_groups`
--
ALTER TABLE `fee_session_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fee_groups_id` (`fee_groups_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `follow_up`
--
ALTER TABLE `follow_up`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_cms_media_gallery`
--
ALTER TABLE `front_cms_media_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_cms_menus`
--
ALTER TABLE `front_cms_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_cms_menu_items`
--
ALTER TABLE `front_cms_menu_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_cms_pages`
--
ALTER TABLE `front_cms_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_cms_page_contents`
--
ALTER TABLE `front_cms_page_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_id` (`page_id`);

--
-- Indexes for table `front_cms_programs`
--
ALTER TABLE `front_cms_programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_cms_program_photos`
--
ALTER TABLE `front_cms_program_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_id` (`program_id`);

--
-- Indexes for table `front_cms_settings`
--
ALTER TABLE `front_cms_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_calls`
--
ALTER TABLE `general_calls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_group_subject_id` (`subject_group_subject_id`);

--
-- Indexes for table `homework_evaluation`
--
ALTER TABLE `homework_evaluation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hostel`
--
ALTER TABLE `hostel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hostel_rooms`
--
ALTER TABLE `hostel_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `id_card`
--
ALTER TABLE `id_card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income_head`
--
ALTER TABLE `income_head`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_category`
--
ALTER TABLE `item_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_issue`
--
ALTER TABLE `item_issue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `item_category_id` (`item_category_id`);

--
-- Indexes for table `item_stock`
--
ALTER TABLE `item_stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `item_store`
--
ALTER TABLE `item_store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_supplier`
--
ALTER TABLE `item_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type` (`type`);

--
-- Indexes for table `libarary_members`
--
ALTER TABLE `libarary_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `multi_class_students`
--
ALTER TABLE `multi_class_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `student_session_id` (`student_session_id`);

--
-- Indexes for table `notification_roles`
--
ALTER TABLE `notification_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `send_notification_id` (`send_notification_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `notification_setting`
--
ALTER TABLE `notification_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `onlineexam`
--
ALTER TABLE `onlineexam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `onlineexam_attempts`
--
ALTER TABLE `onlineexam_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `onlineexam_student_id` (`onlineexam_student_id`);

--
-- Indexes for table `onlineexam_questions`
--
ALTER TABLE `onlineexam_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `onlineexam_id` (`onlineexam_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `onlineexam_students`
--
ALTER TABLE `onlineexam_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `onlineexam_id` (`onlineexam_id`),
  ADD KEY `student_session_id` (`student_session_id`);

--
-- Indexes for table `onlineexam_student_results`
--
ALTER TABLE `onlineexam_student_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `onlineexam_student_id` (`onlineexam_student_id`),
  ADD KEY `onlineexam_question_id` (`onlineexam_question_id`);

--
-- Indexes for table `online_admissions`
--
ALTER TABLE `online_admissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_section_id` (`class_section_id`);

--
-- Indexes for table `payment_settings`
--
ALTER TABLE `payment_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payslip_allowance`
--
ALTER TABLE `payslip_allowance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_category`
--
ALTER TABLE `permission_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_group`
--
ALTER TABLE `permission_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_parent`
--
ALTER TABLE `permission_parent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_student`
--
ALTER TABLE `permission_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `print_headerfooter`
--
ALTER TABLE `print_headerfooter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `question_answers`
--
ALTER TABLE `question_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_options`
--
ALTER TABLE `question_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `read_notification`
--
ALTER TABLE `read_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reference`
--
ALTER TABLE `reference`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_houses`
--
ALTER TABLE `school_houses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sch_settings`
--
ALTER TABLE `sch_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_id` (`lang_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `send_notification`
--
ALTER TABLE `send_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_config`
--
ALTER TABLE `sms_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `source`
--
ALTER TABLE `source`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`);

--
-- Indexes for table `staff_attendance`
--
ALTER TABLE `staff_attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_staff_attendance_staff` (`staff_id`),
  ADD KEY `FK_staff_attendance_staff_attendance_type` (`staff_attendance_type_id`);

--
-- Indexes for table `staff_attendance_type`
--
ALTER TABLE `staff_attendance_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_designation`
--
ALTER TABLE `staff_designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_leave_details`
--
ALTER TABLE `staff_leave_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_staff_leave_details_staff` (`staff_id`),
  ADD KEY `FK_staff_leave_details_leave_types` (`leave_type_id`);

--
-- Indexes for table `staff_leave_request`
--
ALTER TABLE `staff_leave_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_staff_leave_request_staff` (`staff_id`),
  ADD KEY `FK_staff_leave_request_leave_types` (`leave_type_id`);

--
-- Indexes for table `staff_payroll`
--
ALTER TABLE `staff_payroll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_payslip`
--
ALTER TABLE `staff_payslip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_staff_payslip_staff` (`staff_id`);

--
-- Indexes for table `staff_rating`
--
ALTER TABLE `staff_rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_staff_rating_staff` (`staff_id`);

--
-- Indexes for table `staff_roles`
--
ALTER TABLE `staff_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `staff_timeline`
--
ALTER TABLE `staff_timeline`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_staff_timeline_staff` (`staff_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_applyleave`
--
ALTER TABLE `student_applyleave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_attendences`
--
ALTER TABLE `student_attendences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_session_id` (`student_session_id`),
  ADD KEY `attendence_type_id` (`attendence_type_id`);

--
-- Indexes for table `student_doc`
--
ALTER TABLE `student_doc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_fees`
--
ALTER TABLE `student_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_fees_deposite`
--
ALTER TABLE `student_fees_deposite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_fees_master_id` (`student_fees_master_id`),
  ADD KEY `fee_groups_feetype_id` (`fee_groups_feetype_id`);

--
-- Indexes for table `student_fees_discounts`
--
ALTER TABLE `student_fees_discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_session_id` (`student_session_id`),
  ADD KEY `fees_discount_id` (`fees_discount_id`);

--
-- Indexes for table `student_fees_master`
--
ALTER TABLE `student_fees_master`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_session_id` (`student_session_id`),
  ADD KEY `fee_session_group_id` (`fee_session_group_id`);

--
-- Indexes for table `student_session`
--
ALTER TABLE `student_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `student_sibling`
--
ALTER TABLE `student_sibling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_subject_attendances`
--
ALTER TABLE `student_subject_attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendence_type_id` (`attendence_type_id`),
  ADD KEY `student_session_id` (`student_session_id`),
  ADD KEY `subject_timetable_id` (`subject_timetable_id`);

--
-- Indexes for table `student_timeline`
--
ALTER TABLE `student_timeline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_groups`
--
ALTER TABLE `subject_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `subject_group_class_sections`
--
ALTER TABLE `subject_group_class_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_section_id` (`class_section_id`),
  ADD KEY `subject_group_id` (`subject_group_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `subject_group_subjects`
--
ALTER TABLE `subject_group_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_group_id` (`subject_group_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `subject_timetable`
--
ALTER TABLE `subject_timetable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `subject_group_id` (`subject_group_id`),
  ADD KEY `subject_group_subject_id` (`subject_group_subject_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `submit_assignment`
--
ALTER TABLE `submit_assignment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_section_id` (`class_section_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `template_admitcards`
--
ALTER TABLE `template_admitcards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_marksheets`
--
ALTER TABLE `template_marksheets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timetables`
--
ALTER TABLE `timetables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transport_route`
--
ALTER TABLE `transport_route`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_authentication`
--
ALTER TABLE `users_authentication`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_routes`
--
ALTER TABLE `vehicle_routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors_book`
--
ALTER TABLE `visitors_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors_purpose`
--
ALTER TABLE `visitors_purpose`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendence_type`
--
ALTER TABLE `attendence_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book_issues`
--
ALTER TABLE `book_issues`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chat_connections`
--
ALTER TABLE `chat_connections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_users`
--
ALTER TABLE `chat_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `class_sections`
--
ALTER TABLE `class_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `class_teacher`
--
ALTER TABLE `class_teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complaint_type`
--
ALTER TABLE `complaint_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `content_for`
--
ALTER TABLE `content_for`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_fields`
--
ALTER TABLE `custom_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_field_values`
--
ALTER TABLE `custom_field_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `disable_reason`
--
ALTER TABLE `disable_reason`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dispatch_receive`
--
ALTER TABLE `dispatch_receive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_config`
--
ALTER TABLE `email_config`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `enquiry`
--
ALTER TABLE `enquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enquiry_type`
--
ALTER TABLE `enquiry_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_groups`
--
ALTER TABLE `exam_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_group_class_batch_exams`
--
ALTER TABLE `exam_group_class_batch_exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_group_class_batch_exam_students`
--
ALTER TABLE `exam_group_class_batch_exam_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_group_class_batch_exam_subjects`
--
ALTER TABLE `exam_group_class_batch_exam_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_group_exam_connections`
--
ALTER TABLE `exam_group_exam_connections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_group_exam_results`
--
ALTER TABLE `exam_group_exam_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_group_students`
--
ALTER TABLE `exam_group_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_schedules`
--
ALTER TABLE `exam_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_head`
--
ALTER TABLE `expense_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feecategory`
--
ALTER TABLE `feecategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feemasters`
--
ALTER TABLE `feemasters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fees_discounts`
--
ALTER TABLE `fees_discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fees_reminder`
--
ALTER TABLE `fees_reminder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feetype`
--
ALTER TABLE `feetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_groups`
--
ALTER TABLE `fee_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_groups_feetype`
--
ALTER TABLE `fee_groups_feetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_receipt_no`
--
ALTER TABLE `fee_receipt_no`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_session_groups`
--
ALTER TABLE `fee_session_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `follow_up`
--
ALTER TABLE `follow_up`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `front_cms_media_gallery`
--
ALTER TABLE `front_cms_media_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `front_cms_menus`
--
ALTER TABLE `front_cms_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `front_cms_menu_items`
--
ALTER TABLE `front_cms_menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `front_cms_pages`
--
ALTER TABLE `front_cms_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `front_cms_page_contents`
--
ALTER TABLE `front_cms_page_contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `front_cms_programs`
--
ALTER TABLE `front_cms_programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `front_cms_program_photos`
--
ALTER TABLE `front_cms_program_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `front_cms_settings`
--
ALTER TABLE `front_cms_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `general_calls`
--
ALTER TABLE `general_calls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homework`
--
ALTER TABLE `homework`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homework_evaluation`
--
ALTER TABLE `homework_evaluation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hostel`
--
ALTER TABLE `hostel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hostel_rooms`
--
ALTER TABLE `hostel_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `id_card`
--
ALTER TABLE `id_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `income_head`
--
ALTER TABLE `income_head`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_category`
--
ALTER TABLE `item_category`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_issue`
--
ALTER TABLE `item_issue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_stock`
--
ALTER TABLE `item_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_store`
--
ALTER TABLE `item_store`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_supplier`
--
ALTER TABLE `item_supplier`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `libarary_members`
--
ALTER TABLE `libarary_members`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `multi_class_students`
--
ALTER TABLE `multi_class_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_roles`
--
ALTER TABLE `notification_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_setting`
--
ALTER TABLE `notification_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `onlineexam`
--
ALTER TABLE `onlineexam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `onlineexam_attempts`
--
ALTER TABLE `onlineexam_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `onlineexam_questions`
--
ALTER TABLE `onlineexam_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `onlineexam_students`
--
ALTER TABLE `onlineexam_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `onlineexam_student_results`
--
ALTER TABLE `onlineexam_student_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `online_admissions`
--
ALTER TABLE `online_admissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_settings`
--
ALTER TABLE `payment_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payslip_allowance`
--
ALTER TABLE `payslip_allowance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permission_category`
--
ALTER TABLE `permission_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;

--
-- AUTO_INCREMENT for table `permission_group`
--
ALTER TABLE `permission_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `permission_parent`
--
ALTER TABLE `permission_parent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `permission_student`
--
ALTER TABLE `permission_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `print_headerfooter`
--
ALTER TABLE `print_headerfooter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_answers`
--
ALTER TABLE `question_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_options`
--
ALTER TABLE `question_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `read_notification`
--
ALTER TABLE `read_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reference`
--
ALTER TABLE `reference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1446;

--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_houses`
--
ALTER TABLE `school_houses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `send_notification`
--
ALTER TABLE `send_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `sms_config`
--
ALTER TABLE `sms_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `source`
--
ALTER TABLE `source`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_attendance`
--
ALTER TABLE `staff_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_attendance_type`
--
ALTER TABLE `staff_attendance_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staff_designation`
--
ALTER TABLE `staff_designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_leave_details`
--
ALTER TABLE `staff_leave_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_leave_request`
--
ALTER TABLE `staff_leave_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_payroll`
--
ALTER TABLE `staff_payroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_payslip`
--
ALTER TABLE `staff_payslip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_rating`
--
ALTER TABLE `staff_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_roles`
--
ALTER TABLE `staff_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_timeline`
--
ALTER TABLE `staff_timeline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_applyleave`
--
ALTER TABLE `student_applyleave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_attendences`
--
ALTER TABLE `student_attendences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_doc`
--
ALTER TABLE `student_doc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_fees`
--
ALTER TABLE `student_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_fees_deposite`
--
ALTER TABLE `student_fees_deposite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_fees_discounts`
--
ALTER TABLE `student_fees_discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_fees_master`
--
ALTER TABLE `student_fees_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_session`
--
ALTER TABLE `student_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_sibling`
--
ALTER TABLE `student_sibling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_subject_attendances`
--
ALTER TABLE `student_subject_attendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_timeline`
--
ALTER TABLE `student_timeline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject_groups`
--
ALTER TABLE `subject_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject_group_class_sections`
--
ALTER TABLE `subject_group_class_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject_group_subjects`
--
ALTER TABLE `subject_group_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject_timetable`
--
ALTER TABLE `subject_timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `submit_assignment`
--
ALTER TABLE `submit_assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_admitcards`
--
ALTER TABLE `template_admitcards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `template_marksheets`
--
ALTER TABLE `template_marksheets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `timetables`
--
ALTER TABLE `timetables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transport_route`
--
ALTER TABLE `transport_route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_authentication`
--
ALTER TABLE `users_authentication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle_routes`
--
ALTER TABLE `vehicle_routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitors_book`
--
ALTER TABLE `visitors_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitors_purpose`
--
ALTER TABLE `visitors_purpose`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat_connections`
--
ALTER TABLE `chat_connections`
  ADD CONSTRAINT `chat_connections_ibfk_1` FOREIGN KEY (`chat_user_one`) REFERENCES `chat_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_connections_ibfk_2` FOREIGN KEY (`chat_user_two`) REFERENCES `chat_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD CONSTRAINT `chat_messages_ibfk_1` FOREIGN KEY (`chat_user_id`) REFERENCES `chat_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_messages_ibfk_2` FOREIGN KEY (`chat_connection_id`) REFERENCES `chat_connections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chat_users`
--
ALTER TABLE `chat_users`
  ADD CONSTRAINT `chat_users_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_users_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_users_ibfk_3` FOREIGN KEY (`create_staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_users_ibfk_4` FOREIGN KEY (`create_student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `content_for`
--
ALTER TABLE `content_for`
  ADD CONSTRAINT `content_for_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `content_for_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `custom_field_values`
--
ALTER TABLE `custom_field_values`
  ADD CONSTRAINT `custom_field_values_ibfk_1` FOREIGN KEY (`custom_field_id`) REFERENCES `custom_fields` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_group_class_batch_exams`
--
ALTER TABLE `exam_group_class_batch_exams`
  ADD CONSTRAINT `exam_group_class_batch_exams_ibfk_1` FOREIGN KEY (`exam_group_id`) REFERENCES `exam_groups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_group_class_batch_exam_students`
--
ALTER TABLE `exam_group_class_batch_exam_students`
  ADD CONSTRAINT `exam_group_class_batch_exam_students_ibfk_1` FOREIGN KEY (`exam_group_class_batch_exam_id`) REFERENCES `exam_group_class_batch_exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_group_class_batch_exam_students_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_group_class_batch_exam_students_ibfk_3` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_group_class_batch_exam_subjects`
--
ALTER TABLE `exam_group_class_batch_exam_subjects`
  ADD CONSTRAINT `exam_group_class_batch_exam_subjects_ibfk_1` FOREIGN KEY (`exam_group_class_batch_exams_id`) REFERENCES `exam_group_class_batch_exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_group_class_batch_exam_subjects_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_group_exam_connections`
--
ALTER TABLE `exam_group_exam_connections`
  ADD CONSTRAINT `exam_group_exam_connections_ibfk_1` FOREIGN KEY (`exam_group_id`) REFERENCES `exam_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_group_exam_connections_ibfk_2` FOREIGN KEY (`exam_group_class_batch_exams_id`) REFERENCES `exam_group_class_batch_exams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_group_exam_results`
--
ALTER TABLE `exam_group_exam_results`
  ADD CONSTRAINT `exam_group_exam_results_ibfk_1` FOREIGN KEY (`exam_group_class_batch_exam_subject_id`) REFERENCES `exam_group_class_batch_exam_subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_group_exam_results_ibfk_2` FOREIGN KEY (`exam_group_student_id`) REFERENCES `exam_group_students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_group_exam_results_ibfk_3` FOREIGN KEY (`exam_group_class_batch_exam_student_id`) REFERENCES `exam_group_class_batch_exam_students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_group_students`
--
ALTER TABLE `exam_group_students`
  ADD CONSTRAINT `exam_group_students_ibfk_1` FOREIGN KEY (`exam_group_id`) REFERENCES `exam_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_group_students_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fees_discounts`
--
ALTER TABLE `fees_discounts`
  ADD CONSTRAINT `fees_discounts_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fee_groups_feetype`
--
ALTER TABLE `fee_groups_feetype`
  ADD CONSTRAINT `fee_groups_feetype_ibfk_1` FOREIGN KEY (`fee_session_group_id`) REFERENCES `fee_session_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fee_groups_feetype_ibfk_2` FOREIGN KEY (`fee_groups_id`) REFERENCES `fee_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fee_groups_feetype_ibfk_3` FOREIGN KEY (`feetype_id`) REFERENCES `feetype` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fee_groups_feetype_ibfk_4` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fee_session_groups`
--
ALTER TABLE `fee_session_groups`
  ADD CONSTRAINT `fee_session_groups_ibfk_1` FOREIGN KEY (`fee_groups_id`) REFERENCES `fee_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fee_session_groups_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `front_cms_page_contents`
--
ALTER TABLE `front_cms_page_contents`
  ADD CONSTRAINT `front_cms_page_contents_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `front_cms_pages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `front_cms_program_photos`
--
ALTER TABLE `front_cms_program_photos`
  ADD CONSTRAINT `front_cms_program_photos_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `front_cms_programs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `homework`
--
ALTER TABLE `homework`
  ADD CONSTRAINT `homework_ibfk_1` FOREIGN KEY (`subject_group_subject_id`) REFERENCES `subject_group_subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `item_issue`
--
ALTER TABLE `item_issue`
  ADD CONSTRAINT `item_issue_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_issue_ibfk_2` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `item_stock`
--
ALTER TABLE `item_stock`
  ADD CONSTRAINT `item_stock_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_stock_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `item_supplier` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_stock_ibfk_3` FOREIGN KEY (`store_id`) REFERENCES `item_store` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `multi_class_students`
--
ALTER TABLE `multi_class_students`
  ADD CONSTRAINT `multi_class_students_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `multi_class_students_ibfk_2` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notification_roles`
--
ALTER TABLE `notification_roles`
  ADD CONSTRAINT `notification_roles_ibfk_1` FOREIGN KEY (`send_notification_id`) REFERENCES `send_notification` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notification_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `onlineexam`
--
ALTER TABLE `onlineexam`
  ADD CONSTRAINT `onlineexam_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `onlineexam_attempts`
--
ALTER TABLE `onlineexam_attempts`
  ADD CONSTRAINT `onlineexam_attempts_ibfk_1` FOREIGN KEY (`onlineexam_student_id`) REFERENCES `onlineexam_students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `onlineexam_questions`
--
ALTER TABLE `onlineexam_questions`
  ADD CONSTRAINT `onlineexam_questions_ibfk_1` FOREIGN KEY (`onlineexam_id`) REFERENCES `onlineexam` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `onlineexam_questions_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `onlineexam_questions_ibfk_3` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `onlineexam_students`
--
ALTER TABLE `onlineexam_students`
  ADD CONSTRAINT `onlineexam_students_ibfk_1` FOREIGN KEY (`onlineexam_id`) REFERENCES `onlineexam` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `onlineexam_students_ibfk_2` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `onlineexam_student_results`
--
ALTER TABLE `onlineexam_student_results`
  ADD CONSTRAINT `onlineexam_student_results_ibfk_1` FOREIGN KEY (`onlineexam_student_id`) REFERENCES `onlineexam_students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `onlineexam_student_results_ibfk_2` FOREIGN KEY (`onlineexam_question_id`) REFERENCES `onlineexam_questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `online_admissions`
--
ALTER TABLE `online_admissions`
  ADD CONSTRAINT `online_admissions_ibfk_1` FOREIGN KEY (`class_section_id`) REFERENCES `class_sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff_attendance`
--
ALTER TABLE `staff_attendance`
  ADD CONSTRAINT `FK_staff_attendance_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_staff_attendance_staff_attendance_type` FOREIGN KEY (`staff_attendance_type_id`) REFERENCES `staff_attendance_type` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff_leave_details`
--
ALTER TABLE `staff_leave_details`
  ADD CONSTRAINT `FK_staff_leave_details_leave_types` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_staff_leave_details_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff_leave_request`
--
ALTER TABLE `staff_leave_request`
  ADD CONSTRAINT `FK_staff_leave_request_leave_types` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`),
  ADD CONSTRAINT `FK_staff_leave_request_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff_payslip`
--
ALTER TABLE `staff_payslip`
  ADD CONSTRAINT `FK_staff_payslip_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff_rating`
--
ALTER TABLE `staff_rating`
  ADD CONSTRAINT `FK_staff_rating_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff_roles`
--
ALTER TABLE `staff_roles`
  ADD CONSTRAINT `FK_staff_roles_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_staff_roles_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff_timeline`
--
ALTER TABLE `staff_timeline`
  ADD CONSTRAINT `FK_staff_timeline_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_session`
--
ALTER TABLE `student_session`
  ADD CONSTRAINT `student_session_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_session_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_session_ibfk_3` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_session_ibfk_4` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_subject_attendances`
--
ALTER TABLE `student_subject_attendances`
  ADD CONSTRAINT `student_subject_attendances_ibfk_1` FOREIGN KEY (`attendence_type_id`) REFERENCES `attendence_type` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_subject_attendances_ibfk_2` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_subject_attendances_ibfk_3` FOREIGN KEY (`subject_timetable_id`) REFERENCES `subject_timetable` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subject_groups`
--
ALTER TABLE `subject_groups`
  ADD CONSTRAINT `subject_groups_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subject_group_class_sections`
--
ALTER TABLE `subject_group_class_sections`
  ADD CONSTRAINT `subject_group_class_sections_ibfk_1` FOREIGN KEY (`class_section_id`) REFERENCES `class_sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_group_class_sections_ibfk_2` FOREIGN KEY (`subject_group_id`) REFERENCES `subject_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_group_class_sections_ibfk_3` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subject_group_subjects`
--
ALTER TABLE `subject_group_subjects`
  ADD CONSTRAINT `subject_group_subjects_ibfk_1` FOREIGN KEY (`subject_group_id`) REFERENCES `subject_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_group_subjects_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_group_subjects_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subject_timetable`
--
ALTER TABLE `subject_timetable`
  ADD CONSTRAINT `subject_timetable_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_timetable_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_timetable_ibfk_3` FOREIGN KEY (`subject_group_id`) REFERENCES `subject_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_timetable_ibfk_4` FOREIGN KEY (`subject_group_subject_id`) REFERENCES `subject_group_subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_timetable_ibfk_5` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_timetable_ibfk_6` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
