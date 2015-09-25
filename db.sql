CREATE TABLE `users` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`login` varchar(155) NOT NULL,
	`password` varchar(155) NOT NULL,
	`ip` varchar(155) NOT NULL,
	`signed_at` DATE NOT NULL,
	`role` TEXT(50) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `room_info` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`title` varchar(155) NOT NULL,
	`is_private` BOOLEAN NOT NULL,
	`uid` INT(11) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `rm_ruden_family` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`text` TEXT NOT NULL,
	`uid` INT(11) NOT NULL,
	`time` DATE NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `common_messages` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`text` TEXT NOT NULL,
	`time` DATE NOT NULL,
	`uid` INT NOT NULL,
	PRIMARY KEY (`id`)
);

ALTER TABLE `users` ADD CONSTRAINT `users_fk0` FOREIGN KEY (`id`) REFERENCES `room_info`(`uid`);

ALTER TABLE `rm_ruden_family` ADD CONSTRAINT `rm_ruden_family_fk0` FOREIGN KEY (`uid`) REFERENCES `users`(`id`);

ALTER TABLE `common_messages` ADD CONSTRAINT `common_messages_fk0` FOREIGN KEY (`uid`) REFERENCES `users`(`id`);

