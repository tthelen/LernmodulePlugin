<?php

class InitPlugin extends Migration {

    function up() {
        DBManager::get()->exec("
            CREATE TABLE `lernmodule_module` (
                `module_id` varchar(32) NOT NULL,
                `user_id` varchar(32) NOT NULL,
                `seminar_id` varchar(32) NOT NULL,
                `name` varchar(64) NOT NULL,
                `type` varchar(16) NOT NULL DEFAULT 'html',
                `start_file` varchar(64) DEFAULT NULL,
                `image` varchar(128) DEFAULT NULL,
                `sandbox` tinyint(4) NOT NULL DEFAULT '0',
                `chdate` int(11) DEFAULT NULL,
                `mkdate` int(11) DEFAULT NULL,
                PRIMARY KEY (`module_id`),
                KEY `user_id` (`user_id`),
                KEY `seminar_id` (`seminar_id`)
            ) ENGINE=InnoDB
        ");
        DBManager::get()->exec("
            INSERT IGNORE INTO `roles` (`rolename`, `system`)
            VALUES
                ('Lernmodule-Admin', 'n');
        ");
        DBManager::get()->exec("
            CREATE TABLE `lernmodule_attempts` (
                `attempt_id` varchar(32) NOT NULL,
                `module_id` varchar(32) NOT NULL,
                `user_id` varchar(32) NOT NULL,
                `successful` tinyint(4) NULL,
                `mkdate` int(11) NOT NULL,
                `chdate` int(11) NOT NULL,
                PRIMARY KEY (`attempt_id`),
                KEY `module_id` (`module_id`),
                KEY `user_id` (`user_id`)
            ) ENGINE=InnoDB
        ");
        DBManager::get()->exec("
            CREATE TABLE `lernmodule_dependencies` (
                `dependency_id` varchar(32) NOT NULL,
                `seminar_id` varchar(32) NOT NULL,
                `module_id` varchar(32) NOT NULL,
                `depends_from_module_id` varchar(32) NOT NULL,
                PRIMARY KEY (`dependency_id`)
            ) ENGINE=InnoDB
        ");
    }

    function down() {
        DBManager::get()->exec("
            DROP TABLE IF EXISTS `lernmodule_module`;
        ");
    }
}