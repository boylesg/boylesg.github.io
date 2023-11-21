CREATE TABLE `trades` 
(
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `description` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

CREATE TABLE `members` 
(
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `trade_id` int NOT NULL,
  `business_name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `first_name` varchar(64) NOT NULL,
  `surname` varchar(64) NOT NULL,
  `abn` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `structure` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `license` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `description` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `minimum_charge` int(10) unsigned zerofill DEFAULT NULL,
  `minimum_budget` int(10) unsigned zerofill DEFAULT NULL,
  `maximum_size` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `maximum_distance` int(10) unsigned zerofill DEFAULT NULL,
  `logo_file_name` varchar(32) DEFAULT NULL,
  `unit` varchar(64) DEFAULT NULL,
  `street` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `suburb` varchar(64) NOT NULL,
  `state` varchar(3) NOT NULL,
  `postcode` varchar(4) NOT NULL,
  `phone` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

CREATE TABLE `additional_trades` 
(
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int NOT NULL,
  `trade_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`),
  KEY `trade_id` (`trade_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

 	
CREATE TABLE `feedback` 
(
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `recipient_id` int unsigned NOT NULL,
  `provider_id` int unsigned NOT NULL,
  `positive` tinyint(1) NOT NULL,
  `description` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`recipient_id`),
  KEY `tradie_id` (`provider_id`),
  KEY `date_added` (`date_added`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

CREATE TABLE `advert_spaces` 
(
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `space_code` varchar(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `space_description` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cost_per_month` int unsigned NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`),
  KEY `advert_space_name` (`space_code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

CREATE TABLE `adverts` 
(
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int NOT NULL,
  `space_id` int unsigned NOT NULL,
  `text` varchar(600) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `image_name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `expiry_date` date NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `space` (`space_id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

