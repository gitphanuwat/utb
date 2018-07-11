SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
CREATE TABLE `activitys` (
  `id` int(10) unsigned NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `leader` text COLLATE utf8_unicode_ci,
  `tel` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `area_id` int(10) unsigned DEFAULT NULL,
  `center_id` int(10) unsigned DEFAULT NULL,
  `university_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
ALTER TABLE `activitys`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `activitys`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;


  SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
  SET time_zone = "+00:00";
  CREATE TABLE `groups` (
    `id` int(10) unsigned NOT NULL,
    `title` text COLLATE utf8_unicode_ci NOT NULL,
    `detail` text COLLATE utf8_unicode_ci NOT NULL,
    `address` text COLLATE utf8_unicode_ci NOT NULL,
    `leader` text COLLATE utf8_unicode_ci,
    `tel` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
    `user_id` int(10) unsigned NOT NULL,
    `area_id` int(10) unsigned DEFAULT NULL,
    `center_id` int(10) unsigned DEFAULT NULL,
    `university_id` int(10) unsigned DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
  ALTER TABLE `groups`
    ADD PRIMARY KEY (`id`);
  ALTER TABLE `groups`
    MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;


    -- phpMyAdmin SQL Dump
    -- version 4.4.10
    -- http://www.phpmyadmin.net
    --
    -- Host: localhost:3306
    -- Generation Time: Jul 10, 2018 at 04:48 PM
    -- Server version: 5.5.42
    -- PHP Version: 5.6.10

    
