-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 18, 2017 at 09:11 AM
-- Server version: 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Inquiry_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('enquiryspecialist', 7, NULL),
('enquiryspecialist', 8, NULL),
('learner', 1, NULL),
('learner', 3, NULL),
('learner', 4, NULL),
('learner', 5, NULL),
('learner', 6, NULL),
('learner', 7, NULL),
('learner', 10, NULL),
('moduleowner', 3, NULL),
('moduleowner', 6, NULL),
('moduleowner', 7, NULL),
('moduleowner', 8, NULL),
('moduleowner', 9, NULL),
('platformadmin', 2, NULL),
('techspecialist', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('enquiryspecialist', 1, 'Expert in enquiry based learning methods. ', NULL, NULL, NULL, NULL),
('learner', 1, 'person using the platform and modules created for enquiry based learning.', NULL, NULL, NULL, NULL),
('moduleowner', 1, 'creator of enquiry based learning module (a.k.a. Lesson Plans LP)', NULL, NULL, NULL, NULL),
('platformadmin', 1, 'Administrator role this for this platform.', NULL, NULL, NULL, NULL),
('techspecialist', 1, 'Technology Specialist/s in charge of enhancing and maintaining platform.', NULL, NULL, NULL, NULL),
('user-create', 1, 'create new user', NULL, NULL, NULL, NULL),
('user-delete', 1, 'delete user-profile', NULL, NULL, NULL, NULL),
('user-manage', 1, 'manage users. roles, status etc.', NULL, NULL, NULL, NULL),
('user-update', 1, 'update user details', NULL, NULL, NULL, NULL),
('user-view', 1, 'view user profile', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('platformadmin', 'user-create'),
('techspecialist', 'user-create'),
('platformadmin', 'user-delete'),
('techspecialist', 'user-delete'),
('platformadmin', 'user-manage'),
('techspecialist', 'user-manage'),
('platformadmin', 'user-update'),
('techspecialist', 'user-update'),
('platformadmin', 'user-view'),
('techspecialist', 'user-view');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dummy`
--

CREATE TABLE `dummy` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dummy`
--

INSERT INTO `dummy` (`id`, `name`, `description`) VALUES
(1, 'test', 'test'),
(2, 'another', 'another'),
(3, 'third', 'third');

-- --------------------------------------------------------

--
-- Table structure for table `learning`
--

CREATE TABLE `learning` (
  `id` int(11) NOT NULL,
  `learner_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `status` enum('shortlisted','on-going','completed') CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='learning activity is captured in this table.';

-- --------------------------------------------------------

--
-- Table structure for table `learning_comment`
--

CREATE TABLE `learning_comment` (
  `id` int(11) NOT NULL,
  `commenter_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `comment` text CHARACTER SET utf8 NOT NULL,
  `learning_status_before` enum('shortlisted','on-going','completed') CHARACTER SET utf8 NOT NULL,
  `learning_status_after` enum('shortlisted','on-going','completed') CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1489094304),
('m130524_201442_init', 1489094315),
('m230416_200116_tree', 1492188126);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `mode_of_inquiry` varchar(255) NOT NULL,
  `age_group` int(11) NOT NULL,
  `intro_txt` varchar(255) DEFAULT NULL,
  `add_vid_img` varchar(255) DEFAULT NULL,
  `outcome` varchar(255) NOT NULL,
  `status` enum('in-making','completed','in-review','approved','published','archived','deleted') NOT NULL,
  `review_status` enum('yet-to-review','in-review','suggestions','approved') DEFAULT NULL,
  `reviewer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='modules master table';

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `owner_id`, `name`, `description`, `mode_of_inquiry`, `age_group`, `intro_txt`, `add_vid_img`, `outcome`, `status`, `review_status`, `reviewer_id`) VALUES
(3, 3, 'Earth connect - why sky is Blue?', 'Again, I am being little playful here by saying - skye is Blue because I painted it so :p', '', 0, '', '', '', 'in-making', NULL, NULL),
(6, 9, 'Maths - What is volume', 'I have no idea how should I explain what is volume at 1:09am :) :P\r\n\r\nhaa\r\n\r\nadding suggestions 1.2.3', 'ethical', 0, '', '', '', 'in-making', 'approved', 7),
(7, 9, 'Maths - What is speed', 'no idea..', '', 0, '', '', '', 'published', 'approved', 7),
(8, 2, 'Candle Experiment', 'sdds', '', 0, '', '', '', 'in-review', 'in-review', 7),
(10, 2, 'Candle Experiment', 'hhgh', 'ethical', 11, NULL, NULL, 'ddfds', 'in-making', 'yet-to-review', NULL),
(11, 2, 'Candle Experiment', 'sdsdf', 'ethical', 12, NULL, NULL, 'ffdf', 'in-making', 'yet-to-review', NULL),
(12, 2, 'Why should I believe earth is round', 'Provide evidences to prove the statement', 'scintific', 12, NULL, NULL, 'Learn to validate our believes', 'in-making', 'yet-to-review', NULL),
(13, 2, 'Why should I believe earth is round', 'Provide evidences to prove the statement', 'scintific', 12, NULL, NULL, 'Learn to validate our believes', 'in-making', 'yet-to-review', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `review_comment`
--

CREATE TABLE `review_comment` (
  `id` int(11) NOT NULL,
  `commenter_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `review_status_before` enum('yet-to-review','in-review','suggestions','approved') DEFAULT NULL,
  `review_status_after` enum('yet-to-review','in-review','suggestions','approved') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='table for capturing module review process summary ';

-- --------------------------------------------------------

--
-- Table structure for table `tree`
--

CREATE TABLE `tree` (
  `id` bigint(20) NOT NULL,
  `root` int(11) DEFAULT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `lvl` smallint(5) NOT NULL,
  `name` varchar(60) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `icon_type` smallint(1) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `selected` tinyint(1) NOT NULL DEFAULT '0',
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `readonly` tinyint(1) NOT NULL DEFAULT '0',
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `collapsed` tinyint(1) NOT NULL DEFAULT '0',
  `movable_u` tinyint(1) NOT NULL DEFAULT '1',
  `movable_d` tinyint(1) NOT NULL DEFAULT '1',
  `movable_l` tinyint(1) NOT NULL DEFAULT '1',
  `movable_r` tinyint(1) NOT NULL DEFAULT '1',
  `removable` tinyint(1) NOT NULL DEFAULT '1',
  `removable_all` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `surname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `purpose` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profession` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('deleted','suspended','pending','active') CHARACTER SET utf8mb4 NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `name`, `surname`, `email`, `purpose`, `profession`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ravya', '3kHJwOUJ9wL7Fb8znIV61hXBu45ZNW5G', '$2y$13$YDjqFLDxF0HtMKIJRZ4pNOffTwAZFBMjNexeonnAMyMb5QW5CtXIy', NULL, 'Ravikant', 'P', 'ravikantjp@gmail.com', '', '', 'active', 1489094509, 2017),
(2, 'sukhada', 'w16xjFnTMIU7Nh-T-JCnzWwMEEkKQvtG', '$2y$13$kGzOkJRBEOTWu7th03vV7OVMUT3g3EwrFrtNE1k6eaAjj1//8k/LS', NULL, 'Sukhada', 'S', 'sukhada@gmail.com', '', '', 'active', 1489134921, 1489134921),
(3, 'amruta', 'RMANGC2ivmZjdUa0oQfPefTKCYuPmbBx', '$2y$13$3MyJT5uSDtB88v8W6RFDYOmJKl8XBdEj/FcippshIYCeCuuXV9eVq', NULL, 'Amruta', 'P', 'amruta@gmail.com', '', '', 'active', 1489137149, 1489137149),
(4, 'test', 'tRu-mN7V3i4-mbFhduO51_kAgZYAmvNy', '$2y$13$ZMikpBNG7juOt//7dyLOqu4entgG725WBZwOB1ohXsTZSeYGomsk.', NULL, 'Steve', 'J', 'test@gmail.com', '', '', 'deleted', 1489139400, 1489139400),
(5, 'sanat', 'U1EEb5nngP4KeCnrm3KZbUZFdm9Rvj44', '$2y$13$ckkYyqvIMyS7k52B2hDu8uK49PJguxQaah.qQQD7o.a6DhDci.8yy', NULL, 'Sanat', 'G', 'sanat@gmail.com', '', '', 'active', 1489160060, 1489160060),
(6, 'sayali', 'fZF1jIpiAr_rEpKirT8IuJMSogTzdlV6', '$2y$13$7C5AfmiRdHO4cgOWscWGe.qeSGX8xO29d3UA/7f6JlM13rmIhyZQK', NULL, 'Sayali', 'T', 'sayali@gmail.com', '', '', 'active', 1489160110, 1489160110),
(7, 'mohanan', 'K9yhWBgQHLKhWLcsJhiSFfgzjW_JADJg', '$2y$13$rUBvsoQczhDTo1s6n2iSXe9WCrfht6fipyg8E.aGql9PQteo8/QxW', NULL, 'Mohanan', 'M', 'mohanan@gmail.com', '', '', 'active', 1489160134, 1489160134),
(8, 'anjali', 'O8ZasbPPqtAPCQ7KLleABPqzAa7SxvFD', '$2y$13$ylZNbmO7HhPaWWww2vcivuBXmdphqybDPUixi79z/gev1VMQ88AC.', NULL, 'Anjali', 'C', 'anjali@gmail.com', '', '', 'active', 1489252390, 1489252390),
(9, 'mamta', 'phFYj-oVdIa_v2nVKrJySaItnemY48rO', '$2y$13$n..ddhqOoLq3r.eaJ83OxOmism8iAmBFQIzBiaucK.z37pVitN9di', NULL, 'Mamta', 'M', 'mamta@gmail.com', '', '', 'active', 1489261004, 1489261004),
(10, 'kapil', '5IEkt5PKRUQrCSuU7gP88TKjuJu48cus', '$2y$13$tAIxLr6E4Ao6WfHgE3yxZOeb1QESRoH3MH7QGcyKsz7UP.Zj4P6mO', NULL, 'kapil', 'B', 'kapil@gmail.com', '', '', 'deleted', 1489382579, 1489382579),
(11, 'Kal', 'kfty0ra7R6GzAq3WyqpjX-Nd5wujEN4r', '$2y$13$O/kWNZN2aTXwBlW4gp5Cs.i751a4wm2txvK4lm6m/0Y42i5HzLURa', NULL, NULL, NULL, 'kal@quester.com', '', '', 'deleted', 1492428322, 1492428322),
(12, 'Kal123', '2de0JUjN534x60jwd8iyQfpQZpHIxhSC', '$2y$13$b7I5Y.Ca9KaPI/qCZTBaf.dZOiF6UKp8VVySU8byFNbGP.6dM8WIu', NULL, NULL, NULL, 'kal@quester.com1', '', '', 'pending', 1492429849, 1492429849),
(13, 'Riya', 'OkWaL4kKnKg8Lm3tZade-0yttg4jflRi', '$2y$13$fFzwzhyYszxcI7mnhKouceRBc05WJGL8o8J2h/TChADOjYEGsJ8Y6', NULL, NULL, NULL, 'riya@gmail.com', 'Learning inquiry abilities', 'st', 'pending', 1492446689, 1492446689);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `first` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `dummy`
--
ALTER TABLE `dummy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `learning`
--
ALTER TABLE `learning`
  ADD PRIMARY KEY (`id`),
  ADD KEY `learner_id` (`learner_id`),
  ADD KEY `learner-module-id` (`module_id`);

--
-- Indexes for table `learning_comment`
--
ALTER TABLE `learning_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commenter_id` (`commenter_id`),
  ADD KEY `learning-comment-module-id` (`module_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module-reviewer-id` (`reviewer_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `review_comment`
--
ALTER TABLE `review_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commenter_id` (`commenter_id`),
  ADD KEY `review-module-id` (`module_id`);

--
-- Indexes for table `tree`
--
ALTER TABLE `tree`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tree_NK1` (`root`),
  ADD KEY `tree_NK2` (`lft`),
  ADD KEY `tree_NK3` (`rgt`),
  ADD KEY `tree_NK4` (`lvl`),
  ADD KEY `tree_NK5` (`active`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dummy`
--
ALTER TABLE `dummy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `learning`
--
ALTER TABLE `learning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `review_comment`
--
ALTER TABLE `review_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tree`
--
ALTER TABLE `tree`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user-roles` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `learning`
--
ALTER TABLE `learning`
  ADD CONSTRAINT `learner-module-id-1` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`),
  ADD CONSTRAINT `learner-user-id-1` FOREIGN KEY (`learner_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `learning_comment`
--
ALTER TABLE `learning_comment`
  ADD CONSTRAINT `learning-comment-module-id-1` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`),
  ADD CONSTRAINT `learning-comment-user-id` FOREIGN KEY (`commenter_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `module-owner-constraint-1` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `module-reviewer-constrain-1` FOREIGN KEY (`reviewer_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `review_comment`
--
ALTER TABLE `review_comment`
  ADD CONSTRAINT `review-comments-commenter-id-1` FOREIGN KEY (`commenter_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `review-comments-module-id-1` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
