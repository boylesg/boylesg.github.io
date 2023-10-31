CREATE TABLE `trades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `description` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  UNIQUE KEY `description_UNIQUE` (`description`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `members` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `trade` int NOT NULL,
  `business_name` varchar(64) DEFAULT NULL,
  `first_name` varchar(64) NOT NULL,
  `surname` varchar(64) NOT NULL,
  `abn` varchar(64) NOT NULL,
  `structure` varchar(32) NOT NULL,
  `license` varchar(128) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `minimum_charge` int(10) unsigned zerofill NOT NULL,
  `minimum_budget` int(10) unsigned zerofill NOT NULL,
  `maximum_size` varchar(16) NOT NULL,
  `maximum_distance` int(10) unsigned zerofill NOT NULL,
  `unit` varchar(16) NOT NULL,
  `street` varchar(64) NOT NULL,
  `suburb` varchar(64) NOT NULL,
  `state` varchar(3) NOT NULL,
  `postcode` varchar(4) NOT NULL,
  `phone` varchar(8) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(64) NOT NULL,
  `expiry_date` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `business_name_UNIQUE` (`business_name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `feedback` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int unsigned NOT NULL,
  `positive` tinyint NOT NULL,
  `description` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `additional_trades` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int NOT NULL,
  `trade_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
