CREATE TABLE `products`.`items` ( `id` INT(11) NOT NULL , `name` VARCHAR(255) NOT NULL , `unit` INT(11) NOT NULL , `rate` INT(11) NOT NULL ) ENGINE = InnoDB;

ALTER TABLE `items` ADD PRIMARY KEY(`id`);
ALTER TABLE `items` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;


INSERT INTO `items` (`id`, `name`, `unit`, `rate`) VALUES (NULL, 'A', '1', '5'), (NULL, 'B', '2', '10'),(NULL, 'C', '1', '15'),(NULL, 'A', '2', '20'), (NULL, 'B', '1', '25'), (NULL, 'C', '2', '30')