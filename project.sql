-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: localhost    Database: grade_projects
-- ------------------------------------------------------
-- Server version	5.6.17

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
-- Table structure for table `brought_by`
--

DROP TABLE IF EXISTS `brought_by`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brought_by` (
  `project_id` int(4) NOT NULL,
  `dept_name` varchar(15) NOT NULL,
  PRIMARY KEY (`project_id`,`dept_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brought_by`
--

LOCK TABLES `brought_by` WRITE;
/*!40000 ALTER TABLE `brought_by` DISABLE KEYS */;
INSERT INTO `brought_by` VALUES (1,'cse'),(1,'ECE'),(2,'ECE'),(3,'ECE');
/*!40000 ALTER TABLE `brought_by` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chooses`
--

DROP TABLE IF EXISTS `chooses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chooses` (
  `bench_no` int(11) NOT NULL,
  `1st_pref` int(11) NOT NULL,
  `2nd_pref` int(11) NOT NULL,
  `3rd_pref` int(11) NOT NULL,
  `selected_project` int(11) NOT NULL,
  PRIMARY KEY (`bench_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chooses`
--

LOCK TABLES `chooses` WRITE;
/*!40000 ALTER TABLE `chooses` DISABLE KEYS */;
INSERT INTO `chooses` VALUES (43716,1,2,3,2),(43717,1,2,3,1);
/*!40000 ALTER TABLE `chooses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `dept_name` varchar(30) NOT NULL,
  `no_of_staff_members` int(3) NOT NULL,
  `no_of_students` int(4) NOT NULL,
  PRIMARY KEY (`dept_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_staff_members`
--

DROP TABLE IF EXISTS `project_staff_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_staff_members` (
  `project_id` int(4) NOT NULL,
  `staff_id` int(10) NOT NULL,
  PRIMARY KEY (`project_id`,`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_staff_members`
--

LOCK TABLES `project_staff_members` WRITE;
/*!40000 ALTER TABLE `project_staff_members` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_staff_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `project_id` int(4) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(30) NOT NULL,
  `max_number` int(2) NOT NULL,
  `min_number` int(2) NOT NULL,
  `brief_disc` text,
  `detailed_disc` text,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,'GPU ACCELERATED TTP',1,4,'this project talks about GPU.','al what you need to learn about gpu is here.'),(2,'vechile tracking',8,4,'hii','yoloooo'),(3,'geeky stuff',8,4,'lkjhl','jhgkhhlkjlkj;lkjlkm;lk');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff_members`
--

DROP TABLE IF EXISTS `staff_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff_members` (
  `staff_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `title` varchar(20) NOT NULL,
  `no_of_projects` int(2) NOT NULL,
  `dept_name` varchar(15) NOT NULL,
  PRIMARY KEY (`staff_id`),
  KEY `dept_name` (`dept_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff_members`
--

LOCK TABLES `staff_members` WRITE;
/*!40000 ALTER TABLE `staff_members` DISABLE KEYS */;
/*!40000 ALTER TABLE `staff_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `bench_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `section` int(2) NOT NULL,
  `pre_enrolled` tinyint(1) NOT NULL,
  `grade` int(3) NOT NULL,
  `password` varchar(15) NOT NULL,
  `dept_name` varchar(30) NOT NULL,
  PRIMARY KEY (`bench_no`),
  KEY `dept_name` (`dept_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (43716,'ahmed mohamed shedeed',1,0,80,'secret','ECE'),(43717,'abdo',1,0,90,'secret','ECE');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-12-25 18:52:39
