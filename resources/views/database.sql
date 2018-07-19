
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `types` (
`id` int(11) NOT NULL,
`title` varchar(100) NOT NULL,
`detail` text NULL,
`icon` varchar(20) NOT NULL,
`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `types`
ADD PRIMARY KEY (`id`);
ALTER TABLE `types`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


CREATE TABLE `organizes` (
`id` int(11) NOT NULL,
`amphur_id` int(11) NOT NULL,
`tambon_id` int(11) NOT NULL,
`name` varchar(100) NOT NULL,
`type` varchar(1) NOT NULL,
`address` varchar(300) NOT NULL,
`lat` DOUBLE NULL,
`lng` DOUBLE NULL,
`zm` int(11) NULL,
`website` varchar(100) NULL,
`facebook` varchar(100) NULL,
`tel` varchar(20) NULL,
`vision` text NULL,
`basic` text NULL,
`detail` text NULL,
`history` text NULL,
`icon` varchar(20) NULL,
`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `organizes`
ADD PRIMARY KEY (`id`);
ALTER TABLE `organizes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
INSERT INTO `organizes` (`id`, `name`, `type`, `address`, `lat`, `lng`, `zm`, `website`, `facebook`, `vision`, `basic`, `detail`, `history`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'อบจ', '1', 'เมือง อุตรดิตถ์', 17, 100, 12, NULL, NULL, NULL, NULL, NULL, NULL, 'icon1.png', '2018-07-13 06:22:31', '0000-00-00 00:00:00');

CREATE TABLE `villages` (
`id` int(11) NOT NULL,
`organize_id` int(11) NOT NULL,
`name` varchar(100) NOT NULL,
`detail` text NULL,
`address` varchar(300) NOT NULL,
`lat` DOUBLE NULL,
`lng` DOUBLE NULL,
`zm` int(11) NULL,
`people` int(11) NULL,
`leader` varchar(100) NULL,
`contact` varchar(200) NULL,
`tel` varchar(20) NULL,
`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `villages`
ADD PRIMARY KEY (`id`);
ALTER TABLE `villages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `amphurs` (
`id` int(11) NOT NULL,
`name` varchar(100) NOT NULL,
`shortname` varchar(100) NULL,
`detail` varchar(500) NULL,
`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `amphurs`
ADD PRIMARY KEY (`id`);
ALTER TABLE `amphurs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `tambons` (
`id` int(11) NOT NULL,
`amphur_id` int(11) NOT NULL,
`name` varchar(100) NOT NULL,
`slug` varchar(100) NULL,
`detail` varchar(500) NULL,
`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `tambons`
ADD PRIMARY KEY (`id`);
ALTER TABLE `tambons`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `persons` (
`id` int(11) NOT NULL,
`organize_id` int(11) NOT NULL,
`headname` varchar(100) NOT NULL,
`firstname` varchar(100) NOT NULL,
`lastname` varchar(100) NOT NULL,
`position` varchar(150) NULL,
`duedate` varchar(50) NULL,
`tel` varchar(20) NULL,
`email` varchar(100) NULL,
`picture` varchar(100) NULL,
`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `persons`
ADD PRIMARY KEY (`id`);
ALTER TABLE `persons`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `groups` (
`id` int(11) NOT NULL,
`organize_id` int(11) NOT NULL,
`type` varchar(2) NOT NULL,
`name` varchar(100) NOT NULL,
`detail` text NULL,
`address` varchar(300) NULL,
`people` int(11) NULL,
`leader` varchar(100) NULL,
`contact` varchar(200) NULL,
`tel` varchar(20) NULL,
`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `groups`
ADD PRIMARY KEY (`id`);
ALTER TABLE `groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `users` (
`id` int(11) NOT NULL,
`organize_id` int(11) NOT NULL,
`role_id` int(11) NOT NULL,
`headname` varchar(100) NOT NULL,
`firstname` varchar(100) NOT NULL,
`lastname` varchar(100) NOT NULL,
`address` varchar(500) NULL,
`tel` varchar(20) NULL,
`email` varchar(50) NULL,
`facebook` varchar(200) NULL,
`picture` varchar(50) NULL,
`username` varchar(50) NOT NULL,
`password` varchar(100) NOT NULL,
`status` varchar(1) NULL,
`permit` varchar(1) NULL,
`seen` varchar(1) NULL,
`remember_token` varchar(100) NULL,
`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `users`
ADD PRIMARY KEY (`id`);
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
INSERT INTO `users` (`id`, `organize_id`, `role_id`, `headname`, `firstname`, `lastname`, `address`, `tel`, `email`, `facebook`, `picture`, `username`, `password`, `status`, `permit`, `seen`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'นาย', 'ภานุวัฒน์', 'ขันจา', 'อุตรดิตถ์', '086', 'thelrdsystem@gmail.com', NULL, NULL, 'phanuwat', '$2y$10$TtzQ.QY3f9ZjVe9cpwCyT.fDK2mf65iGFfY6zQvvHMh82rUzR8kie', '1', '1', '1', 'Cezoub2s9yOFhGL77Lx0iIgfysLFuLTe2KNWZED88Jg0qzavJLa6UIXavmbp', '2018-07-13 06:24:02', '2018-07-13 06:27:22');


CREATE TABLE `roles` (
`id` int(11) NOT NULL,
`title` varchar(100) NOT NULL,
`slug` varchar(100) NOT NULL,
`detail` varchar(500) NULL,
`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `roles`
ADD PRIMARY KEY (`id`);
ALTER TABLE `roles`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
INSERT INTO `roles` (`id`, `title`, `slug`, `detail`, `created_at`, `updated_at`) VALUES
(1, 'ผู้ดูแลระบบ', 'Admin', NULL, '2018-07-13 06:31:09', '0000-00-00 00:00:00'),
(2, 'ผู้บริหาร', 'Amphur', NULL, '2018-07-13 06:31:09', '0000-00-00 00:00:00'),
(3, 'ผู้ดูแลหน่วยงาน', 'Organize', NULL, '2018-07-13 06:31:56', '0000-00-00 00:00:00'),
(4, 'สมาชิกระบบ', 'Operator', NULL, '2018-07-13 06:31:56', '0000-00-00 00:00:00');


CREATE TABLE `tourists` (
`id` int(11) NOT NULL,
`organize_id` int(11) NOT NULL,
`name` varchar(200) NOT NULL,
`detail` text NULL,
`address` varchar(200) NULL,
`picture` varchar(100) NULL,
`lat` DOUBLE NULL,
`lng` DOUBLE NULL,
`zm` int(11) NULL,
`website` varchar(100) NULL,
`contact` varchar(500) NULL,
`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `tourists`
ADD PRIMARY KEY (`id`);
ALTER TABLE `tourists`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `activitys` (
`id` int(11) NOT NULL,
`organize_id` int(11) NOT NULL,
`name` varchar(200) NOT NULL,
`type` varchar(50) NOT NULL,
`detail` text NULL,
`address` varchar(200) NULL,
`leader` varchar(100) NULL,
`picture` varchar(100) NULL,
`tel` varchar(100) NULL,
`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `activitys`
ADD PRIMARY KEY (`id`);
ALTER TABLE `activitys`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `complaints` (
`id` int(11) NOT NULL,
`organize_id` int(11) NOT NULL,
`name` varchar(200) NOT NULL,
`type` varchar(50) NOT NULL,
`detail` text NULL,
`sender` varchar(100) NULL,
`contact` varchar(200) NULL,
`status` varchar(1) NULL,
`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `complaints`
ADD PRIMARY KEY (`id`);
ALTER TABLE `complaints`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `problems` (
`id` int(11) NOT NULL,
`organize_id` int(11) NOT NULL,
`name` varchar(200) NOT NULL,
`type` varchar(50) NOT NULL,
`detail` text NULL,
`address` varchar(200) NULL,
`status` varchar(1) NULL,
`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `problems`
ADD PRIMARY KEY (`id`);
ALTER TABLE `problems`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `downloads` (
  `id` int(11) NOT NULL,
  `organize_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `detail` text NULL,
  `type` varchar(50) NOT NULL,
  `file` varchar(100) NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `downloads`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `polltopics` (
  `id` int(11) NOT NULL,
  `organize_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `detail` text NULL,
  `type` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `polltopics`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `polltopics`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `pollanswers` (
  `id` int(11) NOT NULL,
  `polltopic_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `detail` text NULL,
  `score` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `pollanswers`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `pollanswers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;



CREATE TABLE `products` (
`id` int(11) NOT NULL,
`name` varchar(200) NOT NULL,
`type` varchar(50) NOT NULL,
`detail` text NULL,
`address` varchar(200) NULL,
`keyman` varchar(100) NULL,
`picture` varchar(100) NULL,
`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `products`
ADD PRIMARY KEY (`id`);
ALTER TABLE `products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `infos` (
`id` int(11) NOT NULL,
`organize_id` int(11) NOT NULL,
`user_id` int(11) NOT NULL,
`title` varchar(200) NOT NULL,
`detail` text NULL,
`day` timestamp NULL,
`file` varchar(100) NULL,
`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `infos`
ADD PRIMARY KEY (`id`);
ALTER TABLE `infos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `counters` (
  `id` int(11) NOT NULL,
  `day` date NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `counters`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `counters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;



CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `organize_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `type` varchar(50) NOT NULL,
  `detail` text NULL,
  `address` varchar(200) NULL,
  `day` timestamp NULL,
  `sender` varchar(100) NULL,
  `picture` varchar(100) NULL,
  `status` varchar(1) NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `organize_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `detail` text NULL,
  `type` varchar(50) NOT NULL,
  `day` timestamp NULL,
  `file` varchar(100) NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `timeuser` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `module` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
