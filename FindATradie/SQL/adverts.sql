CREATE TABLE `adverts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int NOT NULL,
  `space_id` int unsigned NOT NULL,
  `text` varchar(600) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `expiry_date` date NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `clicks` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
SELECT * FROM `find-a-tradie`.adverts;

INSERT INTO `advert` (`id`,`member_id`,`space_id`,`text`,`expiry_date`,`date_added`,`clicks`) VALUES (1,1,2,'Greg''s Native Landscapes','2023-12-18','2023-11-18 20:18:35',0);
INSERT INTO `advert` (`id`,`member_id`,`space_id`,`text`,`expiry_date`,`date_added`,`clicks`) VALUES (29,1,1,'Greg''s Native Landscapes','2025-02-26','2024-02-27 00:51:36',0);
