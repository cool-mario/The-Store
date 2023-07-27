-- store
CREATE TABLE IF NOT EXISTS `store` (
    `id` int NOT NULL AUTO_INCREMENT,
    `name` text,
    `location` text,
    `storeID` int,
    PRIMARY KEY (`id`)
);
INSERT INTO `store`
	  (`name`,`location`,`storeID`)
VALUES
    ('Store 1','Lordran', 1);

-- items
CREATE TABLE IF NOT EXISTS `items` (
    `id` int NOT NULL AUTO_INCREMENT,
    `storeID` int,
    `name` text,
    `price` int,
    `desc` text,
    `img` text,
    PRIMARY KEY (`id`)
);
INSERT INTO `items`
(`storeID`,`name`, `price`,`desc`,`img`)
VALUES
    (1, 'Apples', 3,'A normal apple. Very healthy','apple2.png'),
    (1, 'Mangoes', 5, 'A very tasty mango!','mango.png'),
    (1, 'Scaramouche', 65, 'Fandango','scaramouche.png'),
    (1, 'Warheads', 5, 'Not for recreational use','warhead.png'), 
    (1, 'Muffin Stumps', 5, 'Not for consumption','stump.png');

-- users
CREATE TABLE IF NOT EXISTS `users` (
    `id` int NOT NULL AUTO_INCREMENT,
    `uName` text,
    `role` boolean,
    `hashpass` text,
    PRIMARY KEY (`id`)
);
INSERT INTO `users`
	  (`uName`,`role`,`hashpass`)
VALUES
    ('testAdmin','1','$2y$10$QhCPlzi9.DndB2UDn3B7NusCvMsm2DcPY6VQO8BaGuCdc8iobEEM6'),
    ('testUser','0','$2y$10$QhCPlzi9.DndB2UDn3B7NusCvMsm2DcPY6VQO8BaGuCdc8iobEEM6');

-- cart
CREATE TABLE IF NOT EXISTS `cart` (
	`id` int NOT NULL AUTO_INCREMENT, 
	`user_id` int,
	`item_id` int,
	PRIMARY KEY (`id`)
);
