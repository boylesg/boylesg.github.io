CREATE TABLE `advert_spaces` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `space_code` varchar(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `space_description` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cost_per_year` int unsigned NOT NULL DEFAULT '10',
  `app_or_web` varchar(8) NOT NULL DEFAULT 'web',
  PRIMARY KEY (`id`),
  KEY `advert_space_name` (`space_code`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `advert_spaces` (`id`,`space_code`,`space_description`,`cost_per_year`,`app_or_web`) VALUES (1,'index1','Index page, beside search form',100,'web');
INSERT INTO `advert_spaces` (`id`,`space_code`,`space_description`,`cost_per_year`,`app_or_web`) VALUES (2,'login1','Login page, beside login form',100,'web');
INSERT INTO `advert_spaces` (`id`,`space_code`,`space_description`,`cost_per_year`,`app_or_web`) VALUES (3,'login2','Below the login form',100,'web');
INSERT INTO `advert_spaces` (`id`,`space_code`,`space_description`,`cost_per_year`,`app_or_web`) VALUES (4,'index2','Top of home page',100,'web');
INSERT INTO `advert_spaces` (`id`,`space_code`,`space_description`,`cost_per_year`,`app_or_web`) VALUES (5,'account1','Top of account page',100,'web');
INSERT INTO `advert_spaces` (`id`,`space_code`,`space_description`,`cost_per_year`,`app_or_web`) VALUES (6,'account2','Second from top of account page',100,'web');
INSERT INTO `advert_spaces` (`id`,`space_code`,`space_description`,`cost_per_year`,`app_or_web`) VALUES (19,'about1','Top of about page',50,'web');
INSERT INTO `advert_spaces` (`id`,`space_code`,`space_description`,`cost_per_year`,`app_or_web`) VALUES (20,'about','Second from top of about page',50,'web');
INSERT INTO `advert_spaces` (`id`,`space_code`,`space_description`,`cost_per_year`,`app_or_web`) VALUES (21,'faq1','Top of FAQ page',50,'web');
INSERT INTO `advert_spaces` (`id`,`space_code`,`space_description`,`cost_per_year`,`app_or_web`) VALUES (22,'faq2','Second from top of FAQ page',10,'web');
INSERT INTO `advert_spaces` (`id`,`space_code`,`space_description`,`cost_per_year`,`app_or_web`) VALUES (23,'benefit1','Top of benefit page',50,'web');
INSERT INTO `advert_spaces` (`id`,`space_code`,`space_description`,`cost_per_year`,`app_or_web`) VALUES (24,'benefit2','Second from top of benefit page',50,'web');
INSERT INTO `advert_spaces` (`id`,`space_code`,`space_description`,`cost_per_year`,`app_or_web`) VALUES (25,'contact1','Top of comtact page',80,'web');
INSERT INTO `advert_spaces` (`id`,`space_code`,`space_description`,`cost_per_year`,`app_or_web`) VALUES (26,'contact2','Second from top of contact page',80,'web');
INSERT INTO `advert_spaces` (`id`,`space_code`,`space_description`,`cost_per_year`,`app_or_web`) VALUES (27,'contact3','Second from bottom of contact page',80,'web');
INSERT INTO `advert_spaces` (`id`,`space_code`,`space_description`,`cost_per_year`,`app_or_web`) VALUES (28,'contact4','Bottom of contact page',80,'web');
