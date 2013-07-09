-- MySQL dump 10.13  Distrib 5.5.25a, for Linux (i686)
--
-- Host: localhost    Database: calender
-- ------------------------------------------------------
-- Server version	5.5.25a

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `date` int(2) DEFAULT NULL,
  `month` varchar(3) DEFAULT NULL,
  `year` int(4) DEFAULT NULL,
  `event` varchar(300) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (30,'Aug',2006,'this is 30th AUG',1356028739,37),(10,'Feb',1994,'mkfn',1356029672,38),(1,'Jan',2013,'Happy new Year',1356168803,42),(22,'Dec',2012,'India Lost against England 2nd T-20.Yuv 3/9',1356204967,50),(20,'Dec',2012,'India Won against Englan 1st T-20 after indua lost 2-1 in 4 tests test-series..Yuv 3/19',1356205029,51),(23,'Dec',2012,'sunday Trip Parshnatham Dham...in front of Emerald Heights',1356272201,52),(25,'Dec',2012,'Christmas',1356272222,53),(19,'Dec',2012,'Started Making This Calender',1356272647,54),(21,'Dec',1,'Ankur Goyal birthday',1356367577,60),(3,'Dec',1,'Palash Jain birthday',1356367597,61),(18,'Aug',1,'my birthday',1356373603,62),(26,'Dec',2012,'Took train from bhpl for 4th sem at 23:40 sheduled at19:10 ',1356558704,63),(26,'Dec',2012,'watched dabang-2',1356558755,65),(17,'Sep',1,'nikhar agrawal birthday',1356614309,66),(27,'Dec',2012,'bund rs130 lena hai',1356643606,67),(10,'Dec',1,'taradheesh bali birthday',1356746916,68),(28,'Dec',2012,'bali ki party at bikanerwala',1356747005,69),(1,'Jan',1,'New Years Day',1356902800,73),(13,'Jan',1,'Makar Sankranti',1356902800,74),(14,'Jan',1,'Pongal',1356902800,75),(18,'Jan',1,'Guru Govind Singh Jayanti',1356902800,76),(25,'Jan',1,'Milad un-Nabi/Id-e-Milad',1356902800,77),(26,'Jan',1,'Republic Day',1356902800,78),(15,'Feb',1,'Vasant Panchami',1356902800,79),(19,'Feb',1,'Shivaji Jayanti',1356902800,80),(23,'Feb',1,'Maharishi Dayanand Saraswati Jayanti',1356902800,81),(10,'Mar',1,'Maha Shivaratri/Shivaratri',1356902800,82),(25,'Mar',1,'Guru Ravidas Jayanti',1356902800,83),(26,'Mar',1,'Dolyatra',1356902800,84),(27,'Mar',1,'Holi',1356902800,85),(29,'Mar',1,'Good Friday',1356902800,86),(31,'Mar',1,'Easter Day',1356902800,87),(11,'Apr',1,'Chaitra Sukhladi',1356902800,88),(13,'Apr',1,'Vaisakhi',1356902800,89),(14,'Apr',1,'Ambedkar Jayanti',1356902800,90),(14,'Apr',1,'Mesadi/Vaisakhadi',1356902800,91),(19,'Apr',1,'Rama Navami',1356902800,92),(24,'Apr',1,'Mahavir Jayanti',1356902800,93),(8,'May',1,'Birthday of Ravindranath',1356902800,94),(24,'May',1,'Hazarat Alis Birthday',1356902800,95),(25,'May',1,'Buddha Purnima/Vesak',1356902800,96),(10,'Jul',1,'Rath Yatra',1356902800,97),(2,'Aug',1,'Jamat Ul-Vida',1356902800,98),(9,'Aug',1,'Ramzan Id/Eid-ul-Fitar',1356902800,99),(15,'Aug',1,'Independence Day',1356902800,100),(18,'Aug',1,'Parsi New Year',1356902800,101),(20,'Aug',1,'Raksha Bandhan',1356902800,102),(28,'Aug',1,'Janmashtami',1356902800,103),(9,'Sep',1,'Ganesh Chaturthi',1356902800,104),(16,'Sep',1,'Onam',1356902800,105),(2,'Oct',1,'Mahatma Gandhi Jayanti',1356902800,106),(11,'Oct',1,'Maha Saptami',1356902800,107),(12,'Oct',1,'Maha Navami',1356902800,108),(12,'Oct',1,'Maha Ashtami',1356902800,109),(13,'Oct',1,'Dussehra',1356902800,110),(16,'Oct',1,'Bakri Id/Eid ul-Adha',1356902800,111),(18,'Oct',1,'Maharishi Valmiki Jayanti',1356902800,112),(22,'Oct',1,'Karaka Chaturthi',1356902800,113),(2,'Nov',1,'Naraka Chaturdasi',1356902800,114),(3,'Nov',1,'Diwali/Deepavali',1356902800,115),(4,'Nov',1,'Govardhan Puja',1356902800,116),(5,'Nov',1,'Bhai Duj',1356902800,117),(8,'Nov',1,'Chhat Puja (Pratihar Sashthi/Surya Sashthi)',1356902800,118),(14,'Nov',1,'Muharram/Ashura',1356902800,119),(17,'Nov',1,'Guru Nanak Jayanti',1356902800,120),(24,'Nov',1,'Guru Tegh Bahadurs Martyrdom Day',1356902800,121),(24,'Dec',1,'Christmas Eve',1356902800,122),(25,'Dec',1,'Christmas',1356902800,123),(30,'Dec',2012,'india lost against pakistan first odi',1356905556,124),(31,'Dec',2012,'udhar porecha se 75 lena hai',1356989296,125),(31,'Dec',2012,'udhar harrshit se 200 lena hai',1356989317,126),(5,'Jan',2013,'coding competition',1357133922,127),(5,'Jan',2013,'http://opc.shaastra.org/registered/',1357133925,128),(5,'Jan',2013,'poster submission due',1357248214,129),(10,'Jan',2013,'graphics Hw1 submitted today....',1357778438,130),(10,'Jan',2013,'doing Assignment1 tough.....',1357778450,131),(10,'Jan',2013,'guitar (borkar helpin )  Happy Birthday',1357778468,132),(11,'Jan',2013,'kal spoj 4 upload kiee thee...',1357949729,133),(11,'Jan',2013,'aaj kuch nahi kia....Assignment dene hai graphics ki 16 ko vo ho nahi rahe....',1357949756,134),(21,'Jan',2013,'matlab ki phele assignment ki submission hai/......',1358771807,135),(21,'Jan',2013,'spoj 3.5',1358771816,136);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yearly`
--

DROP TABLE IF EXISTS `yearly`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yearly` (
  `date` int(2) DEFAULT NULL,
  `month` varchar(3) DEFAULT NULL,
  `event` varchar(300) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yearly`
--

LOCK TABLES `yearly` WRITE;
/*!40000 ALTER TABLE `yearly` DISABLE KEYS */;
INSERT INTO `yearly` VALUES (3,'Dec','this is 3_yearly test',87,1);
/*!40000 ALTER TABLE `yearly` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-01-22 14:38:51
