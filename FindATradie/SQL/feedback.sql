CREATE TABLE `feedback` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `recipient_id` int unsigned NOT NULL,
  `provider_id` int DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `positive` tinyint(1) NOT NULL,
  `description` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`recipient_id`),
  KEY `tradie_id` (`provider_id`),
  KEY `date_added` (`date_added`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
SELECT * FROM `find-a-tradie`.feedback;

INSERT INTO `feedback` (`id`,`recipient_id`,`provider_id`,`name`,`positive`,`description`,`date_added`,`date_modified`) VALUES (5,1,11,NULL,1,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec condimentum ut purus ac efficitur.','2023-11-20 00:00:00','2023-11-20 19:17:03');
INSERT INTO `feedback` (`id`,`recipient_id`,`provider_id`,`name`,`positive`,`description`,`date_added`,`date_modified`) VALUES (6,1,12,NULL,1,'Vivamus quis sapien volutpat, vehicula sem vitae, venenatis leo. Aenean eget semper lectus. Suspendisse id tellus finibus, vulputate lorem facilisis, ultricies quam.','2023-11-20 00:00:00','2023-11-20 19:18:01');
INSERT INTO `feedback` (`id`,`recipient_id`,`provider_id`,`name`,`positive`,`description`,`date_added`,`date_modified`) VALUES (7,1,25,NULL,0,'Aenean vitae justo vel mauris porttitor pellentesque condimentum vitae arcu.','2023-11-20 00:00:00','2023-11-20 19:18:56');
INSERT INTO `feedback` (`id`,`recipient_id`,`provider_id`,`name`,`positive`,`description`,`date_added`,`date_modified`) VALUES (8,1,26,NULL,1,'Suspendisse potenti. Vestibulum aliquam turpis eu sem euismod accumsan non quis risus. Donec posuere turpis risus, at vulputate ante mollis ac.','2023-11-20 00:00:00','2023-11-20 19:21:34');
INSERT INTO `feedback` (`id`,`recipient_id`,`provider_id`,`name`,`positive`,`description`,`date_added`,`date_modified`) VALUES (11,1,15,NULL,0,'Cras gravida lorem mi, non vulputate neque lacinia quis.','2023-11-20 00:00:00','2023-11-20 19:24:29');
INSERT INTO `feedback` (`id`,`recipient_id`,`provider_id`,`name`,`positive`,`description`,`date_added`,`date_modified`) VALUES (12,1,17,NULL,1,'Aenean nisl dui, suscipit id velit non, convallis ornare dui. Etiam consectetur imperdiet neque in maximus.','2023-11-20 00:00:00','2023-11-20 19:26:06');
INSERT INTO `feedback` (`id`,`recipient_id`,`provider_id`,`name`,`positive`,`description`,`date_added`,`date_modified`) VALUES (13,1,22,NULL,1,'Proin vehicula nisi ut elit volutpat ornare.','2023-11-20 00:00:00','2023-11-20 19:27:38');
INSERT INTO `feedback` (`id`,`recipient_id`,`provider_id`,`name`,`positive`,`description`,`date_added`,`date_modified`) VALUES (14,1,23,NULL,0,'Nulla iaculis dolor sit amet nunc fringilla, eget tristique augue ultricies.','2023-11-20 00:00:00','2023-11-20 19:27:38');
INSERT INTO `feedback` (`id`,`recipient_id`,`provider_id`,`name`,`positive`,`description`,`date_added`,`date_modified`) VALUES (15,11,1,NULL,1,'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua XXXXX.','2023-11-20 00:00:00','2023-11-20 21:31:35');
INSERT INTO `feedback` (`id`,`recipient_id`,`provider_id`,`name`,`positive`,`description`,`date_added`,`date_modified`) VALUES (16,12,1,NULL,0,'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.zzzzz','2023-11-20 00:00:00','2024-02-25 01:02:25');
