CREATE TABLE `users` (
                         `id` INT(11) NOT NULL AUTO_INCREMENT,
                         `name` VARCHAR(100) NULL DEFAULT '' COLLATE 'utf8_general_ci',
                         `email` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
                         `phone` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
                         `address` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
                         `department` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
                         `vk` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
                         `tg` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
                         `ig` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
                         `password` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
                         `is_admin` CHAR(1) NULL DEFAULT '0' COLLATE 'utf8mb4_general_ci',
                         PRIMARY KEY (`id`) USING BTREE,
                         UNIQUE INDEX `email` (`email`) USING BTREE,
                         INDEX `is_admin` (`is_admin`) USING BTREE
)
    COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;