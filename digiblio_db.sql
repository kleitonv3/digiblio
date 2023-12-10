CREATE DATABASE `digiblio`;

USE `digiblio`;

CREATE TABLE `users` (
    `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `cpf` CHAR(11),
    `role` VARCHAR(255) NOT NULL DEFAULT 'reader',
    `password` VARCHAR(255) NOT NULL,
    `remember_token` VARCHAR(100) NULL DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`) USING BTREE,
    UNIQUE INDEX `users_cpf_unique` (`cpf`) USING BTREE,
    UNIQUE INDEX `users_email_unique` (`email`) USING BTREE
);

CREATE TABLE `books` (
    `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `registered_by` BIGINT(20) UNSIGNED NOT NULL,
    `isbn` VARCHAR(255) NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `authorship` VARCHAR(255) NOT NULL,
    `publication` DATE NULL DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`) USING BTREE,
    CONSTRAINT `books_registered_by_foreign` FOREIGN KEY (`registered_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE `copies` (
    `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `book_id` BIGINT(20) UNSIGNED NOT NULL,
    `registered_by` BIGINT(20) UNSIGNED NOT NULL,
    `edition` VARCHAR(255) NOT NULL,
    `editor` VARCHAR(255) NOT NULL,
    `print_date` DATE NULL DEFAULT NULL,
    `pages` INT(10) UNSIGNED NOT NULL,
    `loan_status` TINYINT(1) NOT NULL DEFAULT '0',
    `copy_state` VARCHAR(255) NOT NULL DEFAULT 'normal',
    `location` VARCHAR(255) NULL DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`) USING BTREE,
    CONSTRAINT `copies_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT `copies_registered_by_foreign` FOREIGN KEY (`registered_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE `loan_records` (
    `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `borrower_id` BIGINT(20) UNSIGNED NOT NULL,
    `copy_id` BIGINT(20) UNSIGNED NOT NULL,
    `registered_by` BIGINT(20) UNSIGNED NOT NULL,
    `date_loaned` DATE NOT NULL,
    `date_return` DATE NOT NULL,
    `date_returned` DATE NULL DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`) USING BTREE,
    CONSTRAINT `loan_records_borrower_id_foreign` FOREIGN KEY (`borrower_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT `loan_records_copy_id_foreign` FOREIGN KEY (`copy_id`) REFERENCES `copies` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT `loan_records_registered_by_foreign` FOREIGN KEY (`registered_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT
);