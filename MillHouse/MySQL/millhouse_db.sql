-- MySQL dump 10.13  Distrib 8.0.43, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: millhouse_db
-- ------------------------------------------------------
-- Server version	8.0.43

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `shortkey` int unsigned NOT NULL AUTO_INCREMENT,
  `group_shortkey` int unsigned NOT NULL,
  `description` varchar(8192) NOT NULL,
  `photo` varchar(64) DEFAULT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`shortkey`),
  UNIQUE KEY `shortkey_UNIQUE` (`shortkey`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `groups` (
  `shortkey` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `contact` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `description` varchar(45) NOT NULL,
  `dow1` int DEFAULT NULL,
  `dow2` int DEFAULT NULL,
  `wom` int DEFAULT NULL,
  `time1` datetime DEFAULT NULL,
  `time2` datetime DEFAULT NULL,
  `hours` decimal(4,2) DEFAULT NULL,
  `cost` decimal(5,2) DEFAULT '0.00',
  `donation` tinyint(3) unsigned zerofill NOT NULL,
  `display` tinyint NOT NULL DEFAULT '1',
  `purpose` varchar(1024) NOT NULL,
  `facebook` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`shortkey`),
  UNIQUE KEY `shortkey_UNIQUE` (`shortkey`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'art4soul','password','Will Johns','','','Art for the Soul',4,6,0,'0000-01-01 10:00:00','0000-01-01 13:00:00',2.00,0.00,000,1,'',NULL),(2,'bridge','password','Fred Smith','fred.smith@gmail.com','0455123456','Bridge Learners',4,NULL,0,'0000-01-01 11:00:00',NULL,2.50,0.00,000,1,'',NULL),(3,'cybercafe','password','Fred Smith','fred.smith@gmail.com','0455123456','Cyber Cafe',NULL,NULL,NULL,NULL,NULL,NULL,0.00,000,0,'',NULL),(4,'deadly','password','Tonya Fedel &  Kymberley Williams','mdhs@mdhs.vic.gov.au','54610333','Deadly Catch-up',2,NULL,3,'0000-01-01 10:00:00',NULL,2.00,0.00,000,1,'',NULL),(5,'dungeons_dragons','password','Tristan & Charlotte','manager@millhouse.org.au','54613185','Dungeons & Dragons',3,NULL,0,'0000-01-01 13:00:00',NULL,2.00,0.00,000,1,'This a casual group is for anyone that enjoys playing table top games, including dungeons & dragons.',NULL),(6,'hookers','password','Sarah McLean, Rhonda or Ruth','fred.smith@gmail.com','54613185','The Hookers',6,NULL,0,'0000-01-01 13:00:00',NULL,2.00,0.00,000,1,'','https://www.facebook.com/groups/799716008396517/'),(7,'playgroup','password','Sarah Mclean','sarahmc@djerriwarrh.org','','Millhouse Playgroup',3,NULL,0,'0000-01-01 11:00:00',NULL,1.50,0.00,000,1,'',NULL),(8,'parent_pathways','password','Sarah McLean','manager@millhouse.org.au','0422629249','Parent Pathways',1,NULL,0,NULL,NULL,NULL,0.00,000,1,'This group allows parents select appropriate Service Australia support programs, with the help of a mentor.\\',NULL),(9,'u3a_writers','password','Deb Sealey','deb.sealey@hotmail.com','0491105356','U3A Writers',6,NULL,1,'0000-01-01 10:00:00',NULL,2.00,0.00,000,1,'',NULL),(10,'u3a_photobooks','password','Deb Sealey','deb.sealey@hotmail.com','0491105356','U3A Digital Photobooks',3,NULL,0,'0000-01-01 10:00:00',NULL,2.00,0.00,000,1,'',NULL),(11,'mental_health','password','Fred Smith','vmhpeers@outlook.comvmhpeers@outlook.com','0466577522','Peer Collective Mental Health',4,NULL,0,'0000-01-01 14:00:00',NULL,2.00,0.00,000,1,'',NULL),(12,'u3a_books','password','Deb Sealey','deb.sealey@hotmail.com','0491105356','U3A Book Club',3,NULL,2,'0000-01-01 10:00:00',NULL,2.00,0.00,000,1,'',NULL),(14,'stamps','password','Grey Loyer','','0354605008','Stamp Club',3,NULL,2,'0000-01-01 20:00:00',NULL,2.00,0.00,000,1,'This group is for anyone with a passion for collecting coins and stamps. We can assist you with valuation of your collection. You can buy, sell & swap. We hold auctions and an annual fair.',NULL),(15,'scrappers','password','Fred Smith','fred.smith@gmail.com','0455123456','Millhouse Scrappers',3,NULL,0,'0000-01-01 10:00:00',NULL,2.00,0.00,001,1,'',NULL),(16,'cafe','password','Sarah','manager@millhouse.org.au','54613185','Millhouse Cafe',3,NULL,0,'0000-01-01 11:00:00',NULL,2.00,5.00,000,1,'',NULL),(17,'feast','password','Sarah','manager@millhouse.org.au','54613185','Friday Feast',6,NULL,0,'0000-01-01 12:00:00',NULL,2.00,5.00,001,1,'',NULL),(18,'admin','password','Sarah','sarah&gmail.com','0422629249','The Admin Team',NULL,NULL,NULL,NULL,NULL,NULL,0.00,000,0,'',NULL),(19,'u3a_adult','password','Deb Sealey','deb.sealey@hotmail.com','0491105356','U3A Adult Learning',3,NULL,4,'0000-01-01 11:00:00',NULL,1.50,0.00,000,1,'',NULL),(20,'market','password','Sarah','manager@millhouse.org.au','54613185','Millhouse Market',5,NULL,0,'0000-01-01 09:30:00',NULL,2.00,5.00,001,1,'',NULL),(21,'food_friends','password','Sarah McLean','manager@millhouse.org.au','54613185','Food with Friends',5,NULL,0,'0000-01-01 10:00:00',NULL,2.00,10.00,000,1,'',NULL),(22,'labour_party','password','Secretary','secretary@maryboroughlabor.com','','Australian Labour Party',5,NULL,4,'0000-01-01 19:00:00',NULL,2.00,0.00,000,1,'',NULL);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-02 22:11:57
