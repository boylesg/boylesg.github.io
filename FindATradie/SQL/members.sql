CREATE TABLE `members` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `trade_id` int NOT NULL,
  `business_name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `first_name` varchar(64) NOT NULL,
  `surname` varchar(64) NOT NULL,
  `profile_filename` varchar(32) DEFAULT NULL,
  `logo_filename` varchar(32) DEFAULT NULL,
  `abn` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `structure` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `license` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `description` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `minimum_charge` int(10) unsigned zerofill DEFAULT NULL,
  `minimum_budget` int(10) unsigned zerofill DEFAULT NULL,
  `maximum_size` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `maximum_distance` int(10) unsigned zerofill DEFAULT NULL,
  `unit` varchar(64) DEFAULT NULL,
  `street` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `suburb` varchar(64) NOT NULL,
  `state` varchar(3) NOT NULL,
  `postcode` varchar(4) NOT NULL,
  `phone` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(256) NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `date_joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `business_name` (`business_name`),
  KEY `surname` (`surname`),
  KEY `abn` (`abn`),
  KEY `structure` (`structure`),
  KEY `suburb` (`suburb`),
  KEY `state` (`state`),
  KEY `postcode` (`postcode`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `members` (`id`,`trade_id`,`business_name`,`first_name`,`surname`,`profile_filename`,`logo_filename`,`abn`,`structure`,`license`,`description`,`minimum_charge`,`minimum_budget`,`maximum_size`,`maximum_distance`,`unit`,`street`,`suburb`,`state`,`postcode`,`phone`,`mobile`,`email`,`username`,`password`,`expiry_date`,`date_joined`) VALUES (1,52,'Greg\'s Native Landscapes','Gregary','Boyles','Gregary_Boyles.jpg','Logo.jpg','51 824 753 556','Sole trader','Electrical license\r\nClass A\r\nNumber: 8743895324','Ecological weed control\r\nLow maintenance\r\nDrought tolerant\r\nIrrigation systems\r\nSmall retaining walls\r\nSmall tree removal\r\nGeneral pruning\r\nBush tucker gardens\r\nSmall ornamental billabongs\r\nNative lawns',0000000120,0000005000,'Up to 50',0000000100,'Unit 3, building 6(Cooper)','56 Derby Drive','EPPING','VIC','3076','94013696','0455328886','gregplants@bigpond.com','gregaryb','{\"ct\":\"L1JVkdLcO3Bggg5MMJAEGw==\",\"iv\":\"989fd9bc8ff182cf540ef36e72ab4b48\",\"s\":\"365e6c6cafdee541\"}','2024-11-08','2023-11-07 22:25:49');
INSERT INTO `members` (`id`,`trade_id`,`business_name`,`first_name`,`surname`,`profile_filename`,`logo_filename`,`abn`,`structure`,`license`,`description`,`minimum_charge`,`minimum_budget`,`maximum_size`,`maximum_distance`,`unit`,`street`,`suburb`,`state`,`postcode`,`phone`,`mobile`,`email`,`username`,`password`,`expiry_date`,`date_joined`) VALUES (11,59,NULL,'Albus','Dumbledore',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'38 Harris Street','Terip Terip','VIC','3179','94012348','0414567980','albus.dumbledore@gmail.com','dumbledorea','{\"ct\":\"L1JVkdLcO3Bggg5MMJAEGw==\",\"iv\":\"989fd9bc8ff182cf540ef36e72ab4b48\",\"s\":\"365e6c6cafdee541\"}',NULL,'2023-11-20 17:20:23');
INSERT INTO `members` (`id`,`trade_id`,`business_name`,`first_name`,`surname`,`profile_filename`,`logo_filename`,`abn`,`structure`,`license`,`description`,`minimum_charge`,`minimum_budget`,`maximum_size`,`maximum_distance`,`unit`,`street`,`suburb`,`state`,`postcode`,`phone`,`mobile`,`email`,`username`,`password`,`expiry_date`,`date_joined`) VALUES (12,59,NULL,'Ronald','Weasley',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'11 Boughtman Street','Notting Hill','VIC','3168','94012846','0414284527','ronald.weasley@gmail.com','weasleyr','{\"ct\":\"L1JVkdLcO3Bggg5MMJAEGw==\",\"iv\":\"989fd9bc8ff182cf540ef36e72ab4b48\",\"s\":\"365e6c6cafdee541\"}','2024-04-30','2023-11-20 17:22:07');
INSERT INTO `members` (`id`,`trade_id`,`business_name`,`first_name`,`surname`,`profile_filename`,`logo_filename`,`abn`,`structure`,`license`,`description`,`minimum_charge`,`minimum_budget`,`maximum_size`,`maximum_distance`,`unit`,`street`,`suburb`,`state`,`postcode`,`phone`,`mobile`,`email`,`username`,`password`,`expiry_date`,`date_joined`) VALUES (15,59,NULL,'Fred','Weasley',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'45 Watson Street','Runnymede','VIC','3559','94013049','0455482983','fred.weasley@gmail.com','weasleyf','{\"ct\":\"L1JVkdLcO3Bggg5MMJAEGw==\",\"iv\":\"989fd9bc8ff182cf540ef36e72ab4b48\",\"s\":\"365e6c6cafdee541\"}',NULL,'2023-11-20 17:26:13');
INSERT INTO `members` (`id`,`trade_id`,`business_name`,`first_name`,`surname`,`profile_filename`,`logo_filename`,`abn`,`structure`,`license`,`description`,`minimum_charge`,`minimum_budget`,`maximum_size`,`maximum_distance`,`unit`,`street`,`suburb`,`state`,`postcode`,`phone`,`mobile`,`email`,`username`,`password`,`expiry_date`,`date_joined`) VALUES (16,59,NULL,'George','Weasley',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'45 Watson Street','Runnymede','VIC','3559','94556737','0455678351','george.weasley@gmail.com','weasleyg','{\"ct\":\"L1JVkdLcO3Bggg5MMJAEGw==\",\"iv\":\"989fd9bc8ff182cf540ef36e72ab4b48\",\"s\":\"365e6c6cafdee541\"}',NULL,'2023-11-20 17:31:25');
INSERT INTO `members` (`id`,`trade_id`,`business_name`,`first_name`,`surname`,`profile_filename`,`logo_filename`,`abn`,`structure`,`license`,`description`,`minimum_charge`,`minimum_budget`,`maximum_size`,`maximum_distance`,`unit`,`street`,`suburb`,`state`,`postcode`,`phone`,`mobile`,`email`,`username`,`password`,`expiry_date`,`date_joined`) VALUES (17,59,NULL,'Harry','Potter',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'60 Yarra Street','Rocklyn','VIC','3364','53501756','0455678293','harry.potter@gmail.com','potterh','{\"ct\":\"L1JVkdLcO3Bggg5MMJAEGw==\",\"iv\":\"989fd9bc8ff182cf540ef36e72ab4b48\",\"s\":\"365e6c6cafdee541\"}',NULL,'2023-11-20 18:09:57');
INSERT INTO `members` (`id`,`trade_id`,`business_name`,`first_name`,`surname`,`profile_filename`,`logo_filename`,`abn`,`structure`,`license`,`description`,`minimum_charge`,`minimum_budget`,`maximum_size`,`maximum_distance`,`unit`,`street`,`suburb`,`state`,`postcode`,`phone`,`mobile`,`email`,`username`,`password`,`expiry_date`,`date_joined`) VALUES (22,59,NULL,'Hermione','Granger',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'86 Shaw Drive','VIC','3465','53666640','0419349268','hermione.granger@gmail.com','grangerh','{\"ct\":\"L1JVkdLcO3Bggg5MMJAEGw==\",\"iv\":\"989fd9bc8ff182cf540ef36e72ab4b48\",\"s\":\"365e6c6cafdee541\"}',NULL,'2023-11-20 18:15:35');
INSERT INTO `members` (`id`,`trade_id`,`business_name`,`first_name`,`surname`,`profile_filename`,`logo_filename`,`abn`,`structure`,`license`,`description`,`minimum_charge`,`minimum_budget`,`maximum_size`,`maximum_distance`,`unit`,`street`,`suburb`,`state`,`postcode`,`phone`,`mobile`,`email`,`username`,`password`,`expiry_date`,`date_joined`) VALUES (23,59,NULL,'Draco','Malfoy',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'31 Larissa Court','Colignan','VIC','3464','53857486','0419285723','','draco.malfoy.gmail.com','{\"ct\":\"L1JVkdLcO3Bggg5MMJAEGw==\",\"iv\":\"989fd9bc8ff182cf540ef36e72ab4b48\",\"s\":\"365e6c6cafdee541\"}',NULL,'2023-11-20 18:15:35');
INSERT INTO `members` (`id`,`trade_id`,`business_name`,`first_name`,`surname`,`profile_filename`,`logo_filename`,`abn`,`structure`,`license`,`description`,`minimum_charge`,`minimum_budget`,`maximum_size`,`maximum_distance`,`unit`,`street`,`suburb`,`state`,`postcode`,`phone`,`mobile`,`email`,`username`,`password`,`expiry_date`,`date_joined`) VALUES (24,59,NULL,'Severus','Snape',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'85 McLachlan Street','Remlaw','VIC','3401','53393767','0456674890','severus.snape@gmail.com','snapes','{\"ct\":\"L1JVkdLcO3Bggg5MMJAEGw==\",\"iv\":\"989fd9bc8ff182cf540ef36e72ab4b48\",\"s\":\"365e6c6cafdee541\"}',NULL,'2023-11-20 18:19:19');
INSERT INTO `members` (`id`,`trade_id`,`business_name`,`first_name`,`surname`,`profile_filename`,`logo_filename`,`abn`,`structure`,`license`,`description`,`minimum_charge`,`minimum_budget`,`maximum_size`,`maximum_distance`,`unit`,`street`,`suburb`,`state`,`postcode`,`phone`,`mobile`,`email`,`username`,`password`,`expiry_date`,`date_joined`) VALUES (25,59,NULL,'Seamus','Finigan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'5 Fitzroy Street','Golden Point','VIC','3350','53269950','0456474990','seamus.finigan@gmail.com','finigans','{\"ct\":\"L1JVkdLcO3Bggg5MMJAEGw==\",\"iv\":\"989fd9bc8ff182cf540ef36e72ab4b48\",\"s\":\"365e6c6cafdee541\"}',NULL,'2023-11-20 18:20:09');
INSERT INTO `members` (`id`,`trade_id`,`business_name`,`first_name`,`surname`,`profile_filename`,`logo_filename`,`abn`,`structure`,`license`,`description`,`minimum_charge`,`minimum_budget`,`maximum_size`,`maximum_distance`,`unit`,`street`,`suburb`,`state`,`postcode`,`phone`,`mobile`,`email`,`username`,`password`,`expiry_date`,`date_joined`) VALUES (26,59,NULL,'Rubeus','Hagrid',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'18 Sullivan Court','Curyo','VIC','3483','53581632','0420346783','hagridr@gmail.com','hagridr','{\"ct\":\"L1JVkdLcO3Bggg5MMJAEGw==\",\"iv\":\"989fd9bc8ff182cf540ef36e72ab4b48\",\"s\":\"365e6c6cafdee541\"}',NULL,'2023-11-20 19:10:19');
