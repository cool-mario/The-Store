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
  `storeID` int,
  `name` text,
  `price` int
);

INSERT INTO `items`
	(`storeID`,`name`, `price`)
VALUES
    (1, 'Apples', 5),
    (1, 'Mangoes', 5),
    (1, 'Pencils', 5),
    (1, 'Warheads', 5), 
    (1, 'Muffin Stumps', 5);

CREATE TABLE IF NOT EXISTS `users` (
  `uName` text,
  `role` boolean,
  `hashpass` text
);
INSERT INTO `users`
	(`uName`,`role`,`hashpass`)
VALUES
  ('testAdmin','1','$2y$10$QhCPlzi9.DndB2UDn3B7NusCvMsm2DcPY6VQO8BaGuCdc8iobEEM6'),
  ('testUser','0','$2y$10$QhCPlzi9.DndB2UDn3B7NusCvMsm2DcPY6VQO8BaGuCdc8iobEEM6')
  ;
