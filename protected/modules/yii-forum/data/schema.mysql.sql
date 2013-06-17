CREATE TABLE `forumuser` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`siteid` VARCHAR(200) NOT NULL,
	`name` VARCHAR(200) NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `siteid` (`siteid`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

CREATE TABLE `forum` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`parent_id` INT(10) UNSIGNED NULL DEFAULT NULL,
	`title` VARCHAR(120) NOT NULL,
	`description` TEXT NOT NULL,
	`listorder` SMALLINT(5) UNSIGNED NOT NULL,
	`is_locked` TINYINT(1) UNSIGNED NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `FK_forum_forum` (`parent_id`),
	CONSTRAINT `FK_forum_forum` FOREIGN KEY (`parent_id`) REFERENCES `forum` (`id`) ON DELETE CASCADE
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

CREATE TABLE `thread` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`forum_id` INT(10) UNSIGNED NOT NULL,
	`subject` VARCHAR(120) NOT NULL,
	`is_sticky` TINYINT(1) UNSIGNED NOT NULL,
	`is_locked` TINYINT(1) UNSIGNED NOT NULL,
	`view_count` BIGINT(20) UNSIGNED NOT NULL,
	`created` INT(10) UNSIGNED NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `FK_thread_forum` (`forum_id`),
	CONSTRAINT `FK_thread_forum` FOREIGN KEY (`forum_id`) REFERENCES `forum` (`id`) ON DELETE CASCADE
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

CREATE TABLE `post` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`author_id` INT(10) UNSIGNED NOT NULL,
	`thread_id` INT(10) UNSIGNED NOT NULL,
	`editor_id` INT(10) UNSIGNED NULL DEFAULT NULL,
	`content` TEXT NOT NULL,
	`created` INT(10) UNSIGNED NOT NULL,
	`updated` INT(10) UNSIGNED NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `FK_post_author` (`author_id`),
	INDEX `FK_post_editor` (`editor_id`),
	INDEX `FK_post_thread` (`thread_id`),
	CONSTRAINT `FK_post_author` FOREIGN KEY (`author_id`) REFERENCES `forumuser` (`id`) ON DELETE CASCADE,
	CONSTRAINT `FK_post_editor` FOREIGN KEY (`editor_id`) REFERENCES `forumuser` (`id`) ON DELETE CASCADE,
	CONSTRAINT `FK_post_thread` FOREIGN KEY (`thread_id`) REFERENCES `thread` (`id`) ON DELETE CASCADE
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;
