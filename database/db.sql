CREATE TABLE IF NOT EXISTS `users` (
	`id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	`chat_id` VARCHAR(50),
	`lang` INT(10) DEFAULT 0,
	`step` VARCHAR(50) NULL
);

CREATE TABLE IF NOT EXISTS `messages` (
	`id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	`chat_id` VARCHAR(50),
	`message_id` VARCHAR(50)
);