-- MySQL dump 10.11
--
-- Host: localhost    Database: test
-- ------------------------------------------------------
-- Server version	5.0.77

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `admin` (
  `admin_id` varchar(100) NOT NULL,
  PRIMARY KEY  (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES ('mahaver.chopra@students.iiit.ac.in');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calendar_events`
--

DROP TABLE IF EXISTS `calendar_events`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `calendar_events` (
  `id` int(11) NOT NULL,
  `event_title` text NOT NULL,
  `event_shortdesc` text NOT NULL,
  `start` datetime NOT NULL,
  `link` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `calendar_events`
--

LOCK TABLES `calendar_events` WRITE;
/*!40000 ALTER TABLE `calendar_events` DISABLE KEYS */;
INSERT INTO `calendar_events` VALUES (0,'\n			test','haha','0000-00-00 00:00:00',''),(0,'\n			anshul','','0000-00-00 00:00:00',''),(0,'\n			hie','','0000-00-00 00:00:00',''),(0,'\n			hie','','0000-00-00 00:00:00',''),(0,'\n			hie','','0000-00-00 00:00:00',''),(0,'\n			hie','','0000-00-00 00:00:00',''),(0,'\n			hie','','0000-00-00 00:00:00',''),(0,'\n			hie','','0000-00-00 00:00:00',''),(0,'\n			hie','','0000-00-00 00:00:00',''),(0,'\n			hie','','0000-00-00 00:00:00',''),(0,'\n			hie','','0000-00-00 00:00:00',''),(0,'\n			hie','','0000-00-00 00:00:00',''),(0,'\n			hie','','0000-00-00 00:00:00',''),(0,'\n			wrong','','0000-00-00 00:00:00',''),(0,'\n			wrong','','0000-00-00 00:00:00',''),(0,'\n			ma ki','chuti','0000-00-00 00:00:00',''),(0,'\n			ma ki','chuti','2012-08-02 01:45:00',''),(0,'\n			kya h','chal ja','2012-08-02 01:45:00',''),(0,'\n			kya h','chal ja','2012-08-02 01:45:00',''),(0,'\n			kya h','chal ja','2012-08-02 01:45:00',''),(0,'\n			kya h','chal ja','2012-08-02 01:45:00',''),(0,'\n			kya h','chal ja','2012-08-02 01:45:00',''),(0,'\n			fake','test','2012-08-02 01:00:00',''),(0,'\n			timepass','hehe','2012-08-02 01:00:00',''),(0,'\n			test','lol','2012-08-02 01:00:00',''),(0,'\n			','','2012-08-02 19:00:00',''),(0,'\n			as','','2012-08-02 20:00:00',''),(0,'\n			timepass22','lol','2012-08-02 12:00:00',''),(0,'\n			sd','','2012-08-02 01:00:00',''),(0,'\n			timepass222','','2012-08-02 01:00:00',''),(0,'\n			timepass222','','2012-08-02 01:00:00',''),(0,'\n			timepass222','','2012-08-02 01:00:00',''),(0,'\n			ansh3','','0000-00-00 00:00:00',''),(0,'\n			ansh3','','0000-00-00 00:00:00',''),(0,'\n			tt','','2012-08-28 01:00:00',''),(0,'\n			title1','','2012-08-28 01:00:00',''),(0,'\n			titl2','','2012-08-28 09:00:00',''),(0,'\n			titl3','','2012-08-28 04:00:00',''),(0,'\n			titlbla','','2012-08-28 15:00:00',''),(0,'\n			test on a new date','','2012-08-28 01:00:00',''),(0,'\n			','','2012-08-28 01:00:00',''),(0,'\n			','','2012-08-28 01:00:00',''),(0,'\n			','','2012-08-28 01:00:00',''),(0,'\n			','','2012-08-29 01:00:00',''),(0,'\n			','','2012-08-29 01:00:00',''),(0,'\n			','','2012-08-29 01:00:00',''),(0,'\n			','','2012-08-29 01:00:00',''),(0,'\n			test on a new date2','','2012-08-28 01:00:00',''),(0,'\n			test on a new date','','0000-00-00 00:00:00',''),(0,'\n			test on a new date2','it will b fun ','0000-00-00 00:00:00',''),(0,'\n			test on a new date2','it will b fun ','0000-00-00 00:00:00',''),(0,'\n			','','0000-00-00 00:00:00',''),(0,'\n			','','2012-02-11 01:00:00',''),(0,'\n			hey','haha','2012-09-02 01:00:00',''),(0,'\n			ahan!!','','2012-09-02 01:00:00',''),(0,'\n			ahan!!','','2012-09-02 01:00:00',''),(0,'\n			acchu','','2012-09-02 01:00:00',''),(0,'\n			haha','','2012-09-02 01:00:00',''),(0,'\n			HEY!!','','0000-00-00 00:00:00',''),(0,'\n			HEY!!','','0000-00-00 00:00:00',''),(0,'\n			helo','','0000-00-00 00:00:00',''),(0,'\n			helo heki','','0000-00-00 00:00:00',''),(0,'\n			helo heki','','0000-00-00 00:00:00',''),(0,'\n			helo heki','','0000-00-00 00:00:00',''),(0,'\n			helo heki','','0000-00-00 00:00:00',''),(0,'\n			helo heki','','0000-00-00 00:00:00',''),(0,'\n			new_year','','2012-01-01 01:00:00',''),(0,'\n			Site_launch','','2012-09-14 18:00:00',''),(0,'\n			checking','this is testing','2012-09-05 04:15:00','');
/*!40000 ALTER TABLE `calendar_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `complaints`
--

DROP TABLE IF EXISTS `complaints`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `complaints` (
  `complain_id` int(11) NOT NULL auto_increment,
  `student_id` int(11) default NULL,
  `complaint_type` varchar(20) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `place` varchar(100) default NULL,
  `complaint_date` date default NULL,
  `complaint_time` time default NULL,
  `date_resolved` date default NULL,
  `time_resolved` time default NULL,
  `status` varchar(20) default NULL,
  PRIMARY KEY  (`complain_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `complaints`
--

LOCK TABLES `complaints` WRITE;
/*!40000 ALTER TABLE `complaints` DISABLE KEYS */;
INSERT INTO `complaints` VALUES (13,201203003,'Electritian','Sir,\r\nThe fan regulator in my room is not working properly.','Room','2012-10-18','16:06:46',NULL,NULL,'False'),(14,201101055,'Plumber','Taps not working in washroom','Other','2012-10-18','16:09:45',NULL,NULL,'False'),(15,201101127,'Carpenter','Window glass is broken .','Room','2012-10-18','16:12:40',NULL,NULL,'False');
/*!40000 ALTER TABLE `complaints` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `event` (
  `eid` int(11) NOT NULL auto_increment,
  `admin_id` varchar(100) NOT NULL,
  `description` varchar(1000) default NULL,
  `time_posted` time default NULL,
  `date_posted` date default NULL,
  PRIMARY KEY  (`eid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `example`
--

DROP TABLE IF EXISTS `example`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `example` (
  `id` int(11) default NULL,
  `data` varchar(100) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `example`
--

LOCK TABLES `example` WRITE;
/*!40000 ALTER TABLE `example` DISABLE KEYS */;
/*!40000 ALTER TABLE `example` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guest`
--

DROP TABLE IF EXISTS `guest`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `guest` (
  `guest_no` int(11) NOT NULL auto_increment,
  `room_no` varchar(20) default NULL,
  `booked_from` date default NULL,
  `booked_till` date default NULL,
  `contact_no` varchar(20) default NULL,
  PRIMARY KEY  (`guest_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `guest`
--

LOCK TABLES `guest` WRITE;
/*!40000 ALTER TABLE `guest` DISABLE KEYS */;
/*!40000 ALTER TABLE `guest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guest_room`
--

DROP TABLE IF EXISTS `guest_room`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `guest_room` (
  `room_no` varchar(20) NOT NULL,
  `floor` varchar(20) NOT NULL,
  `capacity` int(10) NOT NULL,
  `ac` tinyint(1) default '0',
  PRIMARY KEY  (`room_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `guest_room`
--

LOCK TABLES `guest_room` WRITE;
/*!40000 ALTER TABLE `guest_room` DISABLE KEYS */;
/*!40000 ALTER TABLE `guest_room` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guestroom`
--

DROP TABLE IF EXISTS `guestroom`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `guestroom` (
  `guest_no` int(11) NOT NULL auto_increment,
  `guest_name` varchar(20) NOT NULL,
  `room_no` varchar(20) default NULL,
  `floor` varchar(20) default NULL,
  `capacity` int(10) default NULL,
  `current` int(20) default NULL,
  `ac` tinyint(1) default '0',
  `booked_from` date default NULL,
  `booked_till` date default NULL,
  `contact_no` int(12) default NULL,
  PRIMARY KEY  (`guest_no`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `guestroom`
--

LOCK TABLES `guestroom` WRITE;
/*!40000 ALTER TABLE `guestroom` DISABLE KEYS */;
INSERT INTO `guestroom` VALUES (6,'guest_1','301','3',2,1,0,'2012-08-13','2012-08-23',2147483647),(7,'guest_2','302','3',2,1,0,'2012-08-15','2012-08-27',2147483647);
/*!40000 ALTER TABLE `guestroom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hit`
--

DROP TABLE IF EXISTS `hit`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `hit` (
  `hit` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `hit`
--

LOCK TABLES `hit` WRITE;
/*!40000 ALTER TABLE `hit` DISABLE KEYS */;
INSERT INTO `hit` VALUES (220);
/*!40000 ALTER TABLE `hit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rent`
--

DROP TABLE IF EXISTS `rent`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `rent` (
  `occupancy_type` varchar(20) NOT NULL default '',
  `ac` tinyint(1) NOT NULL default '0',
  `rent` varchar(20) default NULL,
  PRIMARY KEY  (`occupancy_type`,`ac`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `rent`
--

LOCK TABLES `rent` WRITE;
/*!40000 ALTER TABLE `rent` DISABLE KEYS */;
INSERT INTO `rent` VALUES ('2',0,'500'),('2',1,'1000'),('3',0,'750'),('3',1,'1200');
/*!40000 ALTER TABLE `rent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `staff` (
  `id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `bdate` date default NULL,
  `sex` char(1) default NULL,
  `responsibility` varchar(100) default NULL,
  `job` varchar(100) NOT NULL,
  `address` varchar(200) default NULL,
  `contact_no` varchar(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_room`
--

DROP TABLE IF EXISTS `student_room`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `student_room` (
  `room_no` varchar(20) NOT NULL,
  `floor` varchar(20) NOT NULL,
  `capacity` int(11) NOT NULL,
  `occupancy_status` int(11) default '0',
  `student1` int(11) default NULL,
  `student2` int(11) default NULL,
  `student3` int(11) default NULL,
  PRIMARY KEY  (`room_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `student_room`
--

LOCK TABLES `student_room` WRITE;
/*!40000 ALTER TABLE `student_room` DISABLE KEYS */;
INSERT INTO `student_room` VALUES ('12','0',2,2,201101011,201101055,NULL),('21','0',2,2,201101127,201101034,NULL),('314','3',3,3,201203006,201203003,201201001);
/*!40000 ALTER TABLE `student_room` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `students` (
  `roll_no` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sex` char(1) default NULL,
  `bdate` date default NULL,
  `email_id` varchar(100) NOT NULL,
  `bloodgroup` varchar(5) default NULL,
  `allergy` varchar(100) default NULL,
  `address` varchar(1000) default NULL,
  `contact_no` varchar(20) default NULL,
  `guardian_name` varchar(100) default NULL,
  `guardian_contact_no` varchar(20) default NULL,
  PRIMARY KEY  (`roll_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (201101011,'mahavir','m','0000-00-00','mahaver.chopra@students.iiit.ac.in','B-','my_allergy','indore,MP','9479448027','uttam chopra','9898766754'),(201101055,'Parin Porecha','m','0000-00-00','parin.porecha@students.iiit.ac.in','B+ve','','A-30, Gandhinagar, Jamnagar, 361002','9573589405','Jayant','9898573494'),(201101127,'Yash','m','0000-00-00','yash.shah@students.iiit.ac.in','A','','','','Sandip',''),(201203003,'Ayush','m','0000-00-00','ayush.datta@students.iiit.ac.in','AB+','NIL','Sector-62,Noida','8787876765','SK Datta','9888888787');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp`
--

DROP TABLE IF EXISTS `temp`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `temp` (
  `ID` int(11) NOT NULL auto_increment,
  `FIRST_NAME` varchar(20) default NULL,
  `MIDDLE_NAME` varchar(20) default NULL,
  `LAST_NAME` varchar(20) default NULL,
  `ROLLNO` int(11) default NULL,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `ROLLNO` (`ROLLNO`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `temp`
--

LOCK TABLES `temp` WRITE;
/*!40000 ALTER TABLE `temp` DISABLE KEYS */;
INSERT INTO `temp` VALUES (1,'Vivek',NULL,'Prakash',200501110),(2,'Vivek',NULL,'Prakash',200907026);
/*!40000 ALTER TABLE `temp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `test` (
  `id` int(11) default NULL,
  `name` varchar(10) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `test`
--

LOCK TABLES `test` WRITE;
/*!40000 ALTER TABLE `test` DISABLE KEYS */;
INSERT INTO `test` VALUES (1,'False'),(2,'True');
/*!40000 ALTER TABLE `test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testc`
--

DROP TABLE IF EXISTS `testc`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `testc` (
  `url` varchar(150) NOT NULL,
  `unique1` varchar(250) NOT NULL,
  `last_updated` varchar(30) NOT NULL,
  `postive_comment` varchar(60) NOT NULL,
  `negative_comment` varchar(60) NOT NULL,
  `positive_score` varchar(10) NOT NULL,
  `negative_score` varchar(10) NOT NULL,
  `rating` varchar(10) NOT NULL,
  PRIMARY KEY  (`unique1`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `testc`
--

LOCK TABLES `testc` WRITE;
/*!40000 ALTER TABLE `testc` DISABLE KEYS */;
/*!40000 ALTER TABLE `testc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_rool`
--

DROP TABLE IF EXISTS `user_rool`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `user_rool` (
  `roll_no` int(11) default NULL,
  `username` varchar(100) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `user_rool`
--

LOCK TABLES `user_rool` WRITE;
/*!40000 ALTER TABLE `user_rool` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_rool` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-10-18 10:52:21
