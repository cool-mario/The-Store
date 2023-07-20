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


CREATE TABLE IF NOT EXISTS `items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `storeID` int,
  `name` text,
  `price` int,
  `desc` text,
  PRIMARY KEY (`id`)
);

INSERT INTO `items`
	(`storeID`,`name`, `price`,`desc`)
VALUES
    (1, 'Apples', 5,'A normal apple. Very healthy'),
    (1, 'Mangoes', 5, 'A very tasty mango!'),
    (1, 'Pencils', 5, 'A very tasty pencil!'),
    (1, 'Warheads', 5, 'Not for recreational use'), 
    (1, 'Muffin Stumps', 5, 'Not for consumption');

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
  ('testUser','0','$2y$10$QhCPlzi9.DndB2UDn3B7NusCvMsm2DcPY6VQO8BaGuCdc8iobEEM6')
  ;
