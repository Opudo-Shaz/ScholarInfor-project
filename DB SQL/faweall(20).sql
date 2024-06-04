-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2023 at 07:12 AM
-- Server version: 8.0.31
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `faweall`
--

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int NOT NULL,
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `middle_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gender` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `guardian_first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `guardian_middle_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `guardian_last_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `age` int NOT NULL,
  `date_of_birth` date NOT NULL,
  `school_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `expected_completion_date` date NOT NULL,
  `student_status` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dropout_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `other_dropout_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `school_id` int DEFAULT NULL,
  `primary_sponsor_id` int DEFAULT NULL,
  `verification_status` enum('Verified','Pending','Declined') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Pending',
  `current_academic_year` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `first_name`, `middle_name`, `last_name`, `gender`, `guardian_first_name`, `guardian_middle_name`, `guardian_last_name`, `phone`, `email`, `age`, `date_of_birth`, `school_name`, `expected_completion_date`, `student_status`, `dropout_reason`, `other_dropout_reason`, `created`, `modified`, `school_id`, `primary_sponsor_id`, `verification_status`, `current_academic_year`) VALUES
(120, 'kelvin', 'kelvin', 'rrrr', 'male', 'Amos', 'Macharia', 'Okello', '0766666666', 'amos@gmail.com', 14, '2009-10-10', 'Kabianga School', '2023-11-29', 'ongoing', 'Alcohol', '', '2023-11-07 07:50:46', '2023-11-07 07:50:46', NULL, NULL, 'Verified', NULL);

--
-- Triggers `student`
--
DELIMITER $$
CREATE TRIGGER `student_audit` AFTER UPDATE ON `student` FOR EACH ROW BEGIN
    -- Audit first_name changes
    IF NOT (OLD.first_name <=> NEW.first_name) THEN
        INSERT INTO student_audit (modified_by, date_modified, field_changed, student_id, old_value, new_value)
        VALUES (USER(), NOW(), 'first_name', NEW.id, OLD.first_name, NEW.first_name);
    END IF;

    -- Audit middle_name changes
    IF NOT (OLD.middle_name <=> NEW.middle_name) THEN
        INSERT INTO student_audit (modified_by, date_modified, field_changed, student_id, old_value, new_value)
        VALUES (USER(), NOW(), 'middle_name', NEW.id, OLD.middle_name, NEW.middle_name);
    END IF;

    -- Audit last_name changes
    IF NOT (OLD.last_name <=> NEW.last_name) THEN
        INSERT INTO student_audit (modified_by, date_modified, field_changed, student_id, old_value, new_value)
        VALUES (USER(), NOW(), 'last_name', NEW.id, OLD.last_name, NEW.last_name);
    END IF;

    -- Audit gender changes
    IF NOT (OLD.gender <=> NEW.gender) THEN
        INSERT INTO student_audit (modified_by, date_modified, field_changed, student_id, old_value, new_value)
        VALUES (USER(), NOW(), 'gender', NEW.id, OLD.gender, NEW.gender);
    END IF;

    -- Audit guardian_first_name changes
    IF NOT (OLD.guardian_first_name <=> NEW.guardian_first_name) THEN
        INSERT INTO student_audit (modified_by, date_modified, field_changed, student_id, old_value, new_value)
        VALUES (USER(), NOW(), 'guardian_first_name', NEW.id, OLD.guardian_first_name, NEW.guardian_first_name);
    END IF;

    -- Audit guardian_middle_name changes
    IF NOT (OLD.guardian_middle_name <=> NEW.guardian_middle_name) THEN
        INSERT INTO student_audit (modified_by, date_modified, field_changed, student_id, old_value, new_value)
        VALUES (USER(), NOW(), 'guardian_middle_name', NEW.id, OLD.guardian_middle_name, NEW.guardian_middle_name);
    END IF;

    -- Audit guardian_last_name changes
    IF NOT (OLD.guardian_last_name <=> NEW.guardian_last_name) THEN
        INSERT INTO student_audit (modified_by, date_modified, field_changed, student_id, old_value, new_value)
        VALUES (USER(), NOW(), 'guardian_last_name', NEW.id, OLD.guardian_last_name, NEW.guardian_last_name);
    END IF;

    -- Audit phone changes
    IF NOT (OLD.phone <=> NEW.phone) THEN
        INSERT INTO student_audit (modified_by, date_modified, field_changed, student_id, old_value, new_value)
        VALUES (USER(), NOW(), 'phone', NEW.id, OLD.phone, NEW.phone);
    END IF;

    -- Audit email changes
    IF NOT (OLD.email <=> NEW.email) THEN
        INSERT INTO student_audit (modified_by, date_modified, field_changed, student_id, old_value, new_value)
        VALUES (USER(), NOW(), 'email', NEW.id, OLD.email, NEW.email);
    END IF;

    -- Audit age changes
    IF NOT (OLD.age <=> NEW.age) THEN
        INSERT INTO student_audit (modified_by, date_modified, field_changed, student_id, old_value, new_value)
        VALUES (USER(), NOW(), 'age', NEW.id, OLD.age, NEW.age);
    END IF;

    -- Audit date_of_birth changes
    IF NOT (OLD.date_of_birth <=> NEW.date_of_birth) THEN
        INSERT INTO student_audit (modified_by, date_modified, field_changed, student_id, old_value, new_value)
        VALUES (USER(), NOW(), 'date_of_birth', NEW.id, OLD.date_of_birth, NEW.date_of_birth);
    END IF;

    -- Audit school_name changes
    IF NOT (OLD.school_name <=> NEW.school_name) THEN
        INSERT INTO student_audit (modified_by, date_modified, field_changed, student_id, old_value, new_value)
        VALUES (USER(), NOW(), 'school_name', NEW.id, OLD.school_name, NEW.school_name);
    END IF;

    -- Audit expected_completion_date changes
    IF NOT (OLD.expected_completion_date <=> NEW.expected_completion_date) THEN
        INSERT INTO student_audit (modified_by, date_modified, field_changed, student_id, old_value, new_value)
        VALUES (USER(), NOW(), 'expected_completion_date', NEW.id, OLD.expected_completion_date, NEW.expected_completion_date);
    END IF;

    -- Audit student_status changes
    IF NOT (OLD.student_status <=> NEW.student_status) THEN
        INSERT INTO student_audit (modified_by, date_modified, field_changed, student_id, old_value, new_value)
        VALUES (USER(), NOW(), 'student_status', NEW.id, OLD.student_status, NEW.student_status);
    END IF;

    -- Audit dropout_reason changes
    IF NOT (OLD.dropout_reason <=> NEW.dropout_reason) THEN
        INSERT INTO student_audit (modified_by, date_modified, field_changed, student_id, old_value, new_value)
        VALUES (USER(), NOW(), 'dropout_reason', NEW.id, OLD.dropout_reason, NEW.dropout_reason);
    END IF;

    -- Audit other_dropout_reason changes
    IF NOT (OLD.other_dropout_reason <=> NEW.other_dropout_reason) THEN
        INSERT INTO student_audit (modified_by, date_modified, field_changed, student_id, old_value, new_value)
        VALUES (USER(), NOW(), 'other_dropout_reason', NEW.id, OLD.other_dropout_reason, NEW.other_dropout_reason);
    END IF;

    -- Audit created changes
    IF NOT (OLD.created <=> NEW.created) THEN
        INSERT INTO student_audit (modified_by, date_modified, field_changed, student_id, old_value, new_value)
        VALUES (USER(), NOW(), 'created', NEW.id, OLD.created, NEW.created);
    END IF;

    -- Audit modified changes
    IF NOT (OLD.modified <=> NEW.modified) THEN
        INSERT INTO student_audit (modified_by, date_modified, field_changed, student_id, old_value, new_value)
        VALUES (USER(), NOW(), 'modified', NEW.id, OLD.modified, NEW.modified);
    END IF;

    -- Audit school_id changes
    IF NOT (OLD.school_id <=> NEW.school_id) THEN
        INSERT INTO student_audit (modified_by, date_modified, field_changed, student_id, old_value, new_value)
        VALUES (USER(), NOW(), 'school_id', NEW.id, OLD.school_id, NEW.school_id);
    END IF;

    -- Audit primary_sponsor_id changes
    IF NOT (OLD.primary_sponsor_id <=> NEW.primary_sponsor_id) THEN
        INSERT INTO student_audit (modified_by, date_modified, field_changed, student_id, old_value, new_value)
        VALUES (USER(), NOW(), 'primary_sponsor_id', NEW.id, OLD.primary_sponsor_id, NEW.primary_sponsor_id);
    END IF;

    -- Audit verification_status changes
    IF NOT (OLD.verification_status <=> NEW.verification_status) THEN
        INSERT INTO student_audit (modified_by, date_modified, field_changed, student_id, old_value, new_value)
        VALUES (USER(), NOW(), 'verification_status', NEW.id, OLD.verification_status, NEW.verification_status);
    END IF;

    -- Audit current_academic_year changes
    IF NOT (OLD.current_academic_year <=> NEW.current_academic_year) THEN
        INSERT INTO student_audit (modified_by, date_modified, field_changed, student_id, old_value, new_value)
        VALUES (USER(), NOW(), 'current_academic_year', NEW.id, OLD.current_academic_year, NEW.current_academic_year);
    END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `student_audit`
--

CREATE TABLE `student_audit` (
  `id` int NOT NULL,
  `modified_by` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `field_changed` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `student_id` int NOT NULL,
  `old_value` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `new_value` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `student_fk_primary_sponsor` (`primary_sponsor_id`);

--
-- Indexes for table `student_audit`
--
ALTER TABLE `student_audit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `student_audit`
--
ALTER TABLE `student_audit`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_fk_primary_sponsor` FOREIGN KEY (`primary_sponsor_id`) REFERENCES `sponsors` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
