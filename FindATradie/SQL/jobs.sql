CREATE TABLE `jobs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `member_id` int unsigned NOT NULL,
  `accepted_by_member_id` int unsigned DEFAULT '0',
  `date_accepted` date DEFAULT NULL,
  `trade_id` int unsigned NOT NULL,
  `description` varchar(512) NOT NULL,
  `maximum_budget` int NOT NULL,
  `size` varchar(16) NOT NULL,
  `urgent` tinyint(1) NOT NULL DEFAULT '0',
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `date_completed` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `date_added` (`date_added`),
  KEY `member_id` (`member_id`),
  KEY `trade_id` (`trade_id`),
  KEY `completed` (`completed`),
  KEY `accepted_by_member_id` (`accepted_by_member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
SELECT * FROM `find-a-tradie`.jobs;

INSERT INTO `jobs` (`id`,`date_added`,`member_id`,`accepted_by_member_id`,`date_accepted`,`trade_id`,`description`,`maximum_budget`,`size`,`urgent`,`completed`,`date_completed`) VALUES (1,'2023-11-22 20:39:24',11,0,'2024-03-04',52,'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',6000,'Up to 50',1,0,NULL);
INSERT INTO `jobs` (`id`,`date_added`,`member_id`,`accepted_by_member_id`,`date_accepted`,`trade_id`,`description`,`maximum_budget`,`size`,`urgent`,`completed`,`date_completed`) VALUES (2,'2023-11-22 20:39:24',12,1,'2024-03-03',52,'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.',5001,'Up to 50',0,0,'2024-03-06');
INSERT INTO `jobs` (`id`,`date_added`,`member_id`,`accepted_by_member_id`,`date_accepted`,`trade_id`,`description`,`maximum_budget`,`size`,`urgent`,`completed`,`date_completed`) VALUES (3,'2024-03-02 15:15:01',1,11,'2024-03-04',11,'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.',2002,'Up to 50',0,0,NULL);
INSERT INTO `jobs` (`id`,`date_added`,`member_id`,`accepted_by_member_id`,`date_accepted`,`trade_id`,`description`,`maximum_budget`,`size`,`urgent`,`completed`,`date_completed`) VALUES (6,'2024-03-03 20:16:22',1,0,NULL,7,'xxxxxxxxxxxxx',2005,'Up to 50',0,0,NULL);

