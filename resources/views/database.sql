
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `detail` text NULL,
  `icon` varchar(20) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


CREATE TABLE `organizes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(1) NOT NULL,
  `address` varchar(300) NOT NULL,
  `lat` DOUBLE NULL,
  `lng` DOUBLE NULL,
  `zm` int(11) NULL,
  `website` varchar(100) NULL,
  `facebook` varchar(100) NULL,
  `vision` text NULL,
  `basic` text NULL,
  `detail` text NULL,
  `history` text NULL,
  `icon` varchar(20) NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `organizes`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `organizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

  CREATE TABLE `villages` (
    `id` int(11) NOT NULL,
    `organize_id` int(11) NOT NULL,
    `name` varchar(100) NOT NULL,
    `detail` text NULL,
    `lat` DOUBLE NULL,
    `lng` DOUBLE NULL,
    `zm` int(11) NULL,
    `people` int(11) NULL,
    `leader` varchar(100) NULL,
    `contact` varchar(200) NULL,
    `tel` varchar(20) NULL,
    `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  ALTER TABLE `villages`
    ADD PRIMARY KEY (`id`);
  ALTER TABLE `organizes`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

    CREATE TABLE `amphurs` (
      `id` int(11) NOT NULL,
      `name` varchar(100) NOT NULL,
      `slug` varchar(100) NULL,
      `detail` varchar(500) NULL,
      `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
      `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
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
        `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
      ALTER TABLE `tambons`
        ADD PRIMARY KEY (`id`);
      ALTER TABLE `tambons`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `organize_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `detail` text NULL,
  `address` varchar(300) NOT NULL,
  `people` int(11) NULL,
  `leader` varchar(100) NULL,
  `contact` varchar(200) NULL,
  `tel` varchar(20) NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

  CREATE TABLE `users` (
    `id` int(11) NOT NULL,
    `organize_id` int(11) NOT NULL,
    `role_id` int(11) NOT NULL,
    `prefix` varchar(100) NOT NULL,
    `firstname` varchar(100) NOT NULL,
    `lastname` varchar(100) NOT NULL,
    `address` varchar(500) NULL,
    `tel` varchar(20) NULL,
    `email` varchar(50) NULL,
    `picture` varchar(50) NULL,
    `username` varchar(50) NOT NULL,
    `password` varchar(50) NOT NULL,
    `status` varchar(1) NULL,
    `permit` varchar(1) NULL,
    `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  ALTER TABLE `users`
    ADD PRIMARY KEY (`id`);
  ALTER TABLE `users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

    CREATE TABLE `roles` (
      `id` int(11) NOT NULL,
      `title` varchar(100) NOT NULL,
      `slug` varchar(100) NOT NULL,
      `detail` varchar(500) NULL,
      `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
      `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ALTER TABLE `roles`
      ADD PRIMARY KEY (`id`);
    ALTER TABLE `roles`
      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

      CREATE TABLE `tourist` (
        `id` int(11) NOT NULL,
        `name` varchar(200) NOT NULL,
        `detail` text NULL,
        `address` varchar(200) NULL,
        `picture` varchar(100) NULL,
        `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
      ALTER TABLE `tourist`
        ADD PRIMARY KEY (`id`);
      ALTER TABLE `tourist`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

        CREATE TABLE `activitys` (
          `id` int(11) NOT NULL,
          `name` varchar(200) NOT NULL,
          `type` varchar(50) NOT NULL,
          `detail` text NULL,
          `address` varchar(200) NULL,
          `dateact` timestamp NULL,
          `keyman` varchar(100) NULL,
          `picture` varchar(100) NULL,
          `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ALTER TABLE `activitys`
          ADD PRIMARY KEY (`id`);
        ALTER TABLE `activitys`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

          CREATE TABLE `products` (
            `id` int(11) NOT NULL,
            `name` varchar(200) NOT NULL,
            `type` varchar(50) NOT NULL,
            `detail` text NULL,
            `address` varchar(200) NULL,
            `keyman` varchar(100) NULL,
            `picture` varchar(100) NULL,
            `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
          ALTER TABLE `products`
            ADD PRIMARY KEY (`id`);
          ALTER TABLE `products`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

            CREATE TABLE `complaints` (
              `id` int(11) NOT NULL,
              `title` varchar(200) NOT NULL,
              `type` varchar(50) NOT NULL,
              `detail` text NULL,
              `address` varchar(200) NULL,
              `sender` varchar(100) NULL,
              `picture` varchar(100) NULL,
              `status` varchar(1) NULL,
              `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ALTER TABLE `complaints`
              ADD PRIMARY KEY (`id`);
            ALTER TABLE `complaints`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

              CREATE TABLE `problems` (
                `id` int(11) NOT NULL,
                `organize_id` int(11) NOT NULL,
                `title` varchar(200) NOT NULL,
                `type` varchar(50) NOT NULL,
                `detail` text NULL,
                `address` varchar(200) NULL,
                `sender` varchar(100) NULL,
                `picture` varchar(100) NULL,
                `status` varchar(1) NULL,
                `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
              ALTER TABLE `problems`
                ADD PRIMARY KEY (`id`);
              ALTER TABLE `problems`
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
                  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
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
                    `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                  ALTER TABLE `files`
                    ADD PRIMARY KEY (`id`);
                  ALTER TABLE `files`
                    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

                    CREATE TABLE `news` (
                      `id` int(11) NOT NULL,
                      `organize_id` int(11) NOT NULL,
                      `user_id` int(11) NOT NULL,
                      `title` varchar(200) NOT NULL,
                      `detail` text NULL,
                      `type` varchar(50) NOT NULL,
                      `day` timestamp NULL,
                      `file` varchar(100) NULL,
                      `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                      `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                    ALTER TABLE `news`
                      ADD PRIMARY KEY (`id`);
                    ALTER TABLE `news`
                      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

                      CREATE TABLE `counters` (
                        `id` int(11) NOT NULL,
                        `count` int(11) NOT NULL,
                        `day` timestamp NULL,
                        `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                        `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                      ALTER TABLE `counters`
                        ADD PRIMARY KEY (`id`);
                      ALTER TABLE `counters`
                        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
