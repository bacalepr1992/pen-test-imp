DROP TABLE IF EXISTS `language`;
CREATE TABLE `language` (
  `language_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `code` varchar(5) NOT NULL,
  `locale` varchar(255) NOT NULL,
  `image` varchar(64) NOT NULL,
  `directory` varchar(32) NOT NULL,
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `language` (`language_id`, `name`, `code`, `locale`, `image`, `directory`, `sort_order`, `status`) VALUES
(1, 'English', 'en', 'en-US,en_US.UTF-8,en_US,en-gb,english', 'gb.png', 'english', 1, 1),
(2, 'Vietnamese', 'vi', '', 'vi.png', 'vietnamese', 2, 1);

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8_unicode_ci,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `serialized` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `setting` (`setting_id`, `code`, `key`, `value`, `serialized`) VALUES
(49, 'config', 'config_meta_title', 'PenCMS', 0),
(50, 'config', 'config_meta_description', 'PenCMS', 0),
(51, 'config', 'config_meta_keyword', 'PenCMS', 0),
(52, 'config', 'config_email', 'info@coronetstore.com', 0),
(53, 'config', 'config_phone', '1234578678', 0),
(54, 'config', 'config_limit_admin', '1', 0),
(55, 'config', 'config_admin_template', 'admin_lte', 0);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_group_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `user` (`user_id`, `fullname`, `email`, `password`, `remember_token`, `user_group_id`, `created_at`, `updated_at`) VALUES
(1, 'Son Vo', 'admin@admin.com', '$2a$08$053u48AxK15LmtZkNpSh7.jagiymwoHUob8IDJpl7YPxMSOZwB87i', 'Hgd0j502byqQTBfytrz0BNAit16AsdF5aa5LK5CaPVjjmqdS9XsJ1nIib0pE', 1, '2016-11-01 02:52:51', '2016-11-29 15:12:55'),
(2, 'Võ Đặng Hoàng Sơn', 'test@test.com', '$2y$10$sgTt2cUKK.NoQlDcLaGS7ecXS5.OCv33m5xuvs1lHL3ySYFGw0wcW', NULL, 1, '2016-11-02 07:58:53', '2016-11-02 07:58:53'),
(4, 'demo', 'demo@demo.com', '$2y$10$NaPb0EvreoZV0oKrrTz6dOgjJXFI5N9YR4N1eBEkrapAiBs6zDvWS', NULL, 1, '2016-11-03 11:21:25', '2016-11-03 11:21:25');

DROP TABLE IF EXISTS `user_group`;
CREATE TABLE `user_group` (
  `user_group_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permission` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `user_group` (`user_group_id`, `name`, `description`, `permission`) VALUES
(1, 'Administrator', 'Administrator', '{"view":["extension\\/module","common\\/dashboard","common\\/menu","extension\\/theme","setting\\/language","setting\\/log","setting\\/setting","tool\\/filemanager","user\\/user","user\\/user_group"],"edit":["common\\/dashboard","common\\/menu","extension\\/theme","setting\\/language","setting\\/log","setting\\/setting","tool\\/filemanager","user\\/user","user\\/user_group"],"delete":["common\\/dashboard","common\\/menu","extension\\/theme","setting\\/language","setting\\/log","setting\\/setting","tool\\/filemanager","user\\/user","user\\/user_group"]}');


ALTER TABLE `language`
  ADD PRIMARY KEY (`language_id`),
  ADD KEY `name` (`name`);

ALTER TABLE `module`
  ADD PRIMARY KEY (`module_id`);

ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

ALTER TABLE `setting`
  ADD PRIMARY KEY (`setting_id`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

ALTER TABLE `user_group`
  ADD PRIMARY KEY (`user_group_id`);


ALTER TABLE `language`
  MODIFY `language_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
ALTER TABLE `user`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
ALTER TABLE `user_group`
  MODIFY `user_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;