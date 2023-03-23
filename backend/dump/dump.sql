-- --------------------------------------------------------

-- Хост:                         127.0.0.1

-- Версия сервера:               8.0.30 - MySQL Community Server - GPL

-- Операционная система:         Win64

-- HeidiSQL Версия:              12.3.0.6589

-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */

;

/*!40101 SET NAMES utf8 */

;

/*!50503 SET NAMES utf8mb4 */

;

/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */

;

/*!40103 SET TIME_ZONE='+00:00' */

;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */

;

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */

;

/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */

;

-- Дамп структуры базы данных vue-test

CREATE DATABASE
    IF NOT EXISTS `vue-test`
    /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */
    /*!80016 DEFAULT ENCRYPTION='N' */
;

USE `vue-test`;

-- Дамп структуры для таблица vue-test.user

CREATE TABLE
    IF NOT EXISTS `user` (
        `id` int NOT NULL AUTO_INCREMENT,
        `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
        `auth_key` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
        `password_hash` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
        `password_reset_token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
        `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
        `status` smallint NOT NULL DEFAULT '10',
        `created_at` int NOT NULL,
        `updated_at` int NOT NULL,
        `verification_token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
        PRIMARY KEY (`id`) USING BTREE,
        UNIQUE KEY `username` (`username`) USING BTREE,
        UNIQUE KEY `email` (`email`) USING BTREE,
        UNIQUE KEY `password_reset_token` (`password_reset_token`) USING BTREE
    ) ENGINE = InnoDB AUTO_INCREMENT = 13 DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_unicode_ci;

-- Дамп данных таблицы vue-test.user: ~1 rows (приблизительно)

INSERT INTO
    `user` (
        `id`,
        `username`,
        `auth_key`,
        `password_hash`,
        `password_reset_token`,
        `email`,
        `status`,
        `created_at`,
        `updated_at`,
        `verification_token`
    )
VALUES (
        12,
        'qwe@mail.ru',
        'gxh8Tw9LUO9mnBCNhnLkkAXRcmdZ6Kbd',
        'e10adc3949ba59abbe56e057f20f883e',
        NULL,
        'qwe@mail.ru',
        1,
        1679570378,
        1679570378,
        '332093fcbf4f8401850dc35290ec03f2'
    );

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */

;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */

;

/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */

;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */

;

/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */

;