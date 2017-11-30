-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: nkucaiserv9.nku.edu    Database: time_entry
-- ------------------------------------------------------
-- Server version	5.7.13-log

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
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `employeeID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`employeeID`),
  UNIQUE KEY `employee_ID_UNIQUE` (`employeeID`)
) ENGINE=InnoDB AUTO_INCREMENT=84849 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,'test','user','test@nku.edu','test','$2a$06$iPIPl.GVOG.QJjUD5CT5busX4bf9uuse7r75To.X6xdtqcuMzTFF6'),(2859,'Tina (Ruth)','Altenhofen','ALTENHOF@nku.edu','ALTENHOF',NULL),(3637,'Vincent','Scheben','schebenv1@nku.edu','schebenv1',NULL),(6444,'Mike','Sames','samesm1@nku.edu','samesm1',NULL),(7487,'Christopher','Rider','riderc1@nku.edu','riderc1',NULL),(12138,'Jesse','Hockenbury','hockenburj1@nku.edu','hockenburj1','$2a$06$iPIPl.GVOG.QJjUD5CT5busX4bf9uuse7r75To.X6xdtqcuMzTFF6'),(12593,'Gabriel','Howard','howardg3@mymail.nku.edu','howardg3',NULL),(12929,'Juliane','Stockman','stockmanj1@nku.edu','stockmanj1',NULL),(13238,'Aaron','Corsi','corsia1@nku.edu','corsia1',NULL),(15926,'Austin','Hardesty','hardestya1@mymail.nku.edu','hardestya1',NULL),(17196,'Eric','Boychan','boychane2@mymail.nku.edu','boychane2',NULL),(18415,'Pamela','Kahwema','kahwemap1@mymail.nku.edu','kahwemap1',NULL),(19630,'Alison','Kilvington','Kilvingtoa1@mymail.nku.edu','kilvingtoa1','$2a$06$iPIPl.GVOG.QJjUD5CT5busX4bf9uuse7r75To.X6xdtqcuMzTFF6'),(19787,'Shannon','Kremer','kremers5@mymail.nku.edu','kremers5',NULL),(20160,'Jill','Henry','henryj5@nku.edu','henryj5',NULL),(20186,'Brendan','Slack','slackb1@mymail.nku.edu','slackb1',NULL),(20189,'Rebecka','Aten','atenr1@mymail.nku.edu','atenr1',NULL),(20228,'Brandon','Owens','owensb7@mymail.nku.edu','owensb7',NULL),(20239,'Joseph','Milazzo','milazzoj1@mymail.nku.edu','milazzoj1',NULL),(20240,'Benjamin','Sanning','sanningb2@mymail.nku.edu','sanningb2',NULL),(20607,'Kierstyn','Oldham','oldhamk1@mymail.nku.edu','oldhamk1',NULL),(20629,'Andrew','Hicks','hicksa11@mymail.nku.edu','hicksa11',NULL),(21039,'Katherine','Ledermeier','ledermeiek1@mymail.nku.edu','ledermeiek1',NULL),(21151,'Yu','Guo','guoy1@mymail.nku.edu','guoy1',NULL),(21232,'Megan','Bedel','bedelm1@mymail.nku.edu','bedelm1',NULL),(21648,'Sandeep','Lamichhane','lamichhans1@mymail.nku.edu','lamichhans1',NULL),(21764,'Jarrett','Venneman','vennemanj2@mymail.nku.edu','vennemanj2',NULL),(21766,'Clay','Verst','verstc2@mymail.nku.edu','verstc2',NULL),(21767,'Zain','Raza','razaz1@mymail.nku.edu','razaz1','$2a$06$iPIPl.GVOG.QJjUD5CT5busX4bf9uuse7r75To.X6xdtqcuMzTFF6'),(21768,'Deactive ','Me','deactivateMe@nku.edu','deactivateMe','$2y$10$NdziX81X8EH3qqzOBtgRs.gta6cL/fr.vaCG/xpWueBf6afKYa2KC'),(21893,'Maci','Alf','alfm1@mymail.nku.edu','alfm1',NULL),(21894,'Nicholas','Starr','starrn1@mymail.nku.edu','starrn1',NULL),(21895,'Cyprian','Nwachukwu','nwachukwuc1@mymail.nku.edu','nwachukwuc1',NULL),(21896,'Jason','Johnson','johnsonj62@mymail.nku.edu','johnsonj62',NULL),(21897,'Mate','Virag','viragm1@mymail.nku.edu','viragm1',NULL);
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees_organizations`
--

DROP TABLE IF EXISTS `employees_organizations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees_organizations` (
  `EOID` int(11) NOT NULL AUTO_INCREMENT,
  `employeeID` int(11) NOT NULL,
  `organizationID` int(11) NOT NULL,
  `roleID` int(11) NOT NULL,
  `isDefault` int(11) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`EOID`),
  UNIQUE KEY `EOID_UNIQUE` (`EOID`),
  UNIQUE KEY `idx_employees_organizations_employeeID_organizationID` (`employeeID`,`organizationID`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees_organizations`
--

LOCK TABLES `employees_organizations` WRITE;
/*!40000 ALTER TABLE `employees_organizations` DISABLE KEYS */;
INSERT INTO `employees_organizations` VALUES (1,12138,1,2,1,1),(7,21767,1,3,1,1),(8,12138,2,2,0,1),(23,21764,1,1,1,1),(32,12593,1,2,1,1),(33,19787,1,4,1,1),(34,21893,1,1,1,1),(35,20189,1,1,1,1),(36,21232,1,1,1,1),(37,17196,1,1,1,1),(38,21151,1,1,1,1),(39,15926,1,1,1,1),(40,20629,1,1,1,1),(41,21896,1,1,1,1),(42,18415,1,1,1,1),(43,19630,1,1,0,1),(44,21648,1,1,1,1),(45,21039,1,1,1,1),(46,20239,1,1,1,1),(47,21895,1,1,1,1),(48,20607,1,1,1,1),(49,20228,1,1,1,1),(50,20240,1,1,1,1),(51,20186,1,1,1,1),(52,21894,1,1,1,1),(53,21766,1,2,1,1),(54,21897,1,1,1,1),(55,20160,1,3,1,1),(56,12929,1,1,1,1),(57,13238,1,1,1,1),(58,2859,1,3,1,1),(60,7487,1,1,1,1),(61,6444,1,2,1,1),(62,3637,1,1,1,1);
/*!40000 ALTER TABLE `employees_organizations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invitations`
--

DROP TABLE IF EXISTS `invitations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invitations` (
  `invitationID` int(11) NOT NULL AUTO_INCREMENT,
  `organizationID` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  PRIMARY KEY (`invitationID`),
  UNIQUE KEY `invitationID_UNIQUE` (`invitationID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invitations`
--

LOCK TABLES `invitations` WRITE;
/*!40000 ALTER TABLE `invitations` DISABLE KEYS */;
INSERT INTO `invitations` VALUES (1,1,'hockenburj1@nku.edu'),(2,1,'hockenburj1@nku.edu'),(3,1,'hockenburj1@nku.edu'),(4,1,'hockenburj1@nku.edu'),(5,1,'hockenburj1@nku.edu');
/*!40000 ALTER TABLE `invitations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organization`
--

DROP TABLE IF EXISTS `organization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `organization` (
  `organizationID` int(11) NOT NULL AUTO_INCREMENT,
  `organizationName` varchar(45) DEFAULT NULL,
  `organizationContact` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`organizationID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organization`
--

LOCK TABLES `organization` WRITE;
/*!40000 ALTER TABLE `organization` DISABLE KEYS */;
INSERT INTO `organization` VALUES (1,'CAI',''),(2,'Marketing',NULL);
/*!40000 ALTER TABLE `organization` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pay_periods`
--

DROP TABLE IF EXISTS `pay_periods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_periods` (
  `ppid` int(11) NOT NULL AUTO_INCREMENT,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `sapNumber` int(11) DEFAULT NULL,
  PRIMARY KEY (`ppid`),
  UNIQUE KEY `ppid_UNIQUE` (`ppid`),
  UNIQUE KEY `startDate_UNIQUE` (`startDate`),
  UNIQUE KEY `endDate_UNIQUE` (`endDate`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pay_periods`
--

LOCK TABLES `pay_periods` WRITE;
/*!40000 ALTER TABLE `pay_periods` DISABLE KEYS */;
INSERT INTO `pay_periods` VALUES (1,'2016-12-18','2016-12-31',1),(5,'2017-01-01','2017-01-14',2),(6,'2017-01-15','2017-01-28',3),(7,'2017-01-29','2017-02-11',4),(8,'2017-02-12','2017-02-25',5),(9,'2017-02-26','2017-03-11',6),(10,'2017-03-12','2017-03-25',7),(11,'2017-03-26','2017-04-08',8),(12,'2017-04-09','2017-04-22',9),(13,'2017-04-23','2017-05-06',10),(14,'2017-05-07','2017-05-20',11),(15,'2017-05-21','2017-06-03',12),(17,'2017-06-18','2017-07-01',13),(18,'2017-07-02','2017-07-15',14),(19,'2017-07-16','2017-07-29',15),(20,'2017-07-30','2017-08-12',16),(21,'2017-08-13','2017-08-26',17),(22,'2017-08-27','2017-09-09',NULL),(23,'2017-09-10','2017-09-23',NULL),(24,'2017-09-24','2017-10-07',NULL),(25,'2017-10-08','2017-10-21',NULL),(26,'2017-10-22','2017-11-04',NULL),(27,'2017-11-05','2017-11-18',NULL),(28,'2017-11-19','2017-12-02',NULL),(29,'2017-12-03','2017-12-16',NULL);
/*!40000 ALTER TABLE `pay_periods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_hours`
--

DROP TABLE IF EXISTS `project_hours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_hours` (
  `projectHoursID` int(11) NOT NULL AUTO_INCREMENT,
  `employeeID` int(11) NOT NULL,
  `projectID` int(11) NOT NULL,
  `approvedBy` int(11) DEFAULT NULL,
  `approvalStatus` bit(1) NOT NULL DEFAULT b'0',
  `projectHours` decimal(4,2) NOT NULL,
  `weekID` int(11) NOT NULL,
  PRIMARY KEY (`projectHoursID`),
  UNIQUE KEY `projecthours_ID_UNIQUE` (`projectHoursID`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_hours`
--

LOCK TABLES `project_hours` WRITE;
/*!40000 ALTER TABLE `project_hours` DISABLE KEYS */;
INSERT INTO `project_hours` VALUES (3,12138,4,NULL,'\0',14.00,665),(4,12138,5,NULL,'\0',1.00,665),(7,12138,3,NULL,'\0',15.00,672),(8,12138,4,NULL,'\0',6.00,672),(10,20189,1,NULL,'\0',4.00,672),(20,12593,46,NULL,'\0',8.75,858),(21,12593,1,NULL,'\0',5.00,858),(25,12138,4,NULL,'\0',15.00,858),(26,12138,5,NULL,'\0',1.00,858),(27,21895,8,NULL,'\0',35.00,858),(28,20228,6,NULL,'\0',2.50,672),(29,20228,1,NULL,'\0',17.50,672),(30,20228,6,NULL,'\0',2.50,858),(31,20228,1,NULL,'\0',17.50,858),(32,21895,8,NULL,'\0',35.00,672),(33,20189,29,NULL,'\0',12.00,858),(34,21767,46,NULL,'\0',20.00,858),(35,21767,46,NULL,'\0',20.00,859),(36,21764,46,NULL,'\0',20.00,858),(37,21764,46,NULL,'\0',20.00,672),(38,21764,46,NULL,'\0',20.00,859),(39,21896,33,NULL,'\0',30.00,672),(40,20607,46,NULL,'\0',4.00,672),(41,20607,6,NULL,'\0',20.00,672);
/*!40000 ALTER TABLE `project_hours` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `projectID` int(11) NOT NULL AUTO_INCREMENT,
  `RAID` int(11) NOT NULL,
  `project` varchar(50) NOT NULL,
  `projectName` varchar(65) NOT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `oldestInvoice` decimal(10,2) DEFAULT NULL,
  `totalInvoice` decimal(10,2) DEFAULT NULL,
  `projectCap` decimal(10,2) DEFAULT NULL,
  `primaryContactName` varchar(100) DEFAULT NULL,
  `primaryContactEmail` varchar(100) DEFAULT NULL,
  `APcontactName` varchar(100) DEFAULT NULL,
  `APcontactEmail` varchar(100) DEFAULT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `pastDue` int(11) DEFAULT '0',
  `isActive` int(11) DEFAULT '1',
  `notes` text,
  PRIMARY KEY (`projectID`),
  UNIQUE KEY `projectID_UNIQUE` (`projectID`),
  KEY `fk_RAID_RAID_idx` (`RAID`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,1,'1','CAI Internal','2007-01-01',NULL,NULL,NULL,0.00,'','','','',10.00,'TIME & MATERIALS',9,1,''),(2,2,'1','CAUDSYS','2012-06-25',NULL,NULL,NULL,0.00,'Jerry Dempsey','jdempsey@cadusys.com','Jerry Dempsey','jdempsey@cadusys.com',24.00,'TIME & MATERIALS',0,1,''),(3,2,'2','Cadusys (new Oct 2016)','2016-10-19',NULL,NULL,NULL,0.00,'Jerry Dempsey','jdempsey@cadusys.com','Jerry Dempsey','jdempsey@cadusys.com',29.00,'TIME & MATERIALS',61,1,''),(4,3,'1','Doctor Scribbles','2013-12-02',NULL,NULL,NULL,0.00,'Angela J. Malone','incipience12@gmail.com','Angela J. Malone','incipience12@gmail.com',24.00,'TIME & MATERIALS',32,1,''),(5,4,'2','InstrumentLife ','2017-05-01',NULL,NULL,NULL,0.00,'Christopher Strum, COO','cstrum@instrumentlife.com','Christopher Strum, COO','cstrum@instrumentlife.com',45.00,'TIME & MATERIALS',91,1,''),(6,5,'2','Shephard Group','2017-05-16',NULL,NULL,NULL,0.00,'Dan Shephard','dan@thefrontlinefundraiser.com','Dan Shephard','dan@thefrontlinefundraiser.com',45.00,'TIME & MATERIALS',0,1,''),(7,6,'2','Best Upon Request - Phase 2','2017-02-14',NULL,NULL,NULL,0.00,'Tillie Lima','','Katie Stout','Katie.Stout@bestuponrequest.com',45.00,'TIME & MATERIALS',0,1,''),(8,7,'1','Gleason Reel','2014-04-03',NULL,NULL,NULL,0.00,'Steve Loeck','sloeck@hubbell-gleason.com','Steve Loeck','sloeck@hubbell-gleason.com',24.00,'TIME & MATERIALS',0,1,''),(9,8,'1','Uptech 3DLT','2013-12-06',NULL,NULL,NULL,0.00,'Colin Klayer, COO','colin@3dlt.com','Colin Klayer, COO','colin@3dlt.com',24.00,'TIME & MATERIALS',0,1,''),(10,9,'1','W. Ron Adams','2014-07-03',NULL,NULL,NULL,0.00,'Ruth Reyer',' ruthreyer@yahoo.com','Elena Wellmann','emw@wronadamslaw.com',24.00,'TIME & MATERIALS',0,1,''),(11,10,'1','Greater Cincinnati Stem Collaborative','2014-10-27',NULL,NULL,NULL,6000.00,'Mary G. Adams, Program Manager','mary@marygadams.org','Mary G. Adams, Program Manager','mary@marygadams.org',24.00,'Fixed Bid: CAPPED',0,1,''),(12,11,'1','NKYEC - Website Upgrade','2014-12-08',NULL,NULL,NULL,0.00,'Polly Lusk Page, Executive Director','','Chris Perkins','cperkins@nkyec.org',24.00,'TIME & MATERIALS',0,1,''),(13,12,'1','Ancra S-Line','2017-07-21',NULL,0.00,0.00,0.00,'Jennifer Ramsey','JenniferRamsey@ancra.com','Jennifer Ramsey','JenniferRamsey@ancra.com',29.00,'Time and Materials',0,1,''),(14,12,'2  ','Ancra Mobile','2017-05-23',NULL,NULL,NULL,0.00,'Jennifer McVey','jmcvey@ancra.com','Melody Anderson','manderson@ancra.com',45.00,'TIME & MATERIALS',0,1,''),(15,13,'1','E-Gov Link (EC Link Invoice Accounting)','2015-06-08',NULL,NULL,NULL,0.00,'William \"Bill\" R. Nadler Jr., President','','Jerry Felix','jfelix@eclink.com',29.00,'TIME & MATERIALS',0,1,''),(16,14,'2','E-Gov Link (EC Link - Phase 2)','2017-04-18',NULL,NULL,NULL,0.00,'Jerry Felix, CEO','jfelix@eclink.com','','accounting@eclink.com',45.00,'TIME & MATERIALS',0,1,''),(17,15,'2','Transit Authority of River City (TARC)','2017-06-21',NULL,NULL,NULL,0.00,'Alvin Russell Goodwin II','','Kim Pangburn','Kpangburn@ridetarc.org',30.00,'TIME & MATERIALS',0,1,''),(18,16,'1 ','KDE Maintenance','2015-09-01',NULL,NULL,NULL,0.00,'Phillip D. Coleman, Director School Technology Services','phil.coleman@education.ky.gov','Phillip D. Coleman, Director School Technology Services','phil.coleman@education.ky.gov',24.00,'TIME & MATERIALS',0,1,'invoice phil.coleman@education.ky.gov'),(19,17,'2','KDE Maintenance','2017-06-02',NULL,NULL,NULL,2500.00,'Phillip D. Coleman, Director School Technology Services','phil.coleman@education.ky.gov','Gary Bachmann','gary.bachmann@education.ky.gov',30.00,'Fixed Bid: CAPPED',0,1,'The RA is TIME&MATIERALS but we\'re tracking a CAP because we found out after signing that there\'s a budget of $2,500.00'),(20,18,'1','Water Quality Maintenance','2015-09-08',NULL,NULL,NULL,750.00,'Madhura Kulkarni, Interim  Director','kulkarnim2@nku.edu','Madhura Kulkarni, Interim  Director','kulkarnim2@nku.edu',24.00,'Fixed Bid: CAPPED',0,1,''),(21,19,'1','84.51','2015-10-26',NULL,NULL,NULL,0.00,'Lori Jeffries, General Counsel/David Middendorf','david.middendorf@8451.com','Lori Jeffries, General Counsel/David Middendorf','david.middendorf@8451.com',29.00,'TIME & MATERIALS',0,1,'(effort TBD, starting January)'),(22,20,'2','AUID Assurance Plan & Dev Work','2017-02-22',NULL,NULL,NULL,0.00,'Melissa Marriott','mmarriot@illinois.edu','Melissa Marriott','mmarriot@illinois.edu',30.00,'WEB ASSURANCE POLICY:  LIFELINE',0,1,'$150/Fixed Monthly Web Assurance - Prepaid Credit $600.00'),(23,21,'1','NKEPC Website Maintenance','2017-07-21',NULL,NULL,NULL,0.00,'Rodney Bell (Chairman)','rbell@sd1.org','Mr. Bob Stark','bstark@covingtonky.gov',29.00,'TIME & MATERIALS',0,1,''),(24,22,'1','Water Quality Android','2017-07-21',NULL,NULL,NULL,5000.00,'Steve Kerlin','skerlin@stroudcenter.org','Rebecca Duczkowski','rduczkowski@stroudcenter.org',24.00,'Fixed Bid: CAPPED',0,1,'capped at $3000 initial, another $2000, possible more funds.'),(25,22,'2','Water Quality App','2017-05-31',NULL,NULL,NULL,0.00,'John D. Pepe, Controller & Treasurer','skerlin@stroudcenter.org','Steve Kerlin','skerlin@stroudcenter.org',30.00,'TIME & MATERIALS',0,1,''),(26,23,'1','Ethos Web','2016-02-18',NULL,NULL,NULL,0.00,'Jacob Case, IT Support Administrator','jacob.case@ethos-labs.com','Beth Hawes','Beth.Hawes@ethos-labs.com',29.00,'TIME & MATERIALS',0,1,''),(27,24,'1','Harmony Acres Farm','2016-03-07',NULL,NULL,NULL,0.00,'Linda Peebles, Owner','harmonyacresfarm@yahoo.com','Linda Peebles, Owner','harmonyacresfarm@yahoo.com',29.00,'TIME & MATERIALS',0,1,''),(28,25,'1  ','Cincinnati Financial iOS code maintenance','2016-03-29',NULL,NULL,NULL,0.00,'Bobby Rice','Bobby.Rice@cinfin.com','Accounts Payable','accounts_payable@cinfin.com',29.00,'TIME & MATERIALS',0,1,'N/A'),(29,26,'2','Right On Q','2017-05-31',NULL,NULL,NULL,0.00,'Josh Hatten, Director of Evaluation','jhatton@childreninc.org','Josh Hatten, Director of Evaluation','jhatton@childreninc.org',30.00,'TIME & MATERIALS',0,1,''),(30,27,'1','Community of Faith Presbyterian Church','2016-05-08',NULL,NULL,NULL,2000.00,'Bill Lindsay ','drlindsay@fuse.net','Bill Lindsay ','drlindsay@fuse.net',24.00,'Fixed Bid: CAPPED',0,1,'RA signed by Jack Kleier, Trustee Community of Faith'),(31,28,'1','Skyward Survey Tool','2016-07-08',NULL,NULL,NULL,0.00,'Nancy Costello, Director','ncostello@skywardnky.org','Nancy Costello, Director','ncostello@skywardnky.org',24.00,'TIME & MATERIALS',0,1,'RA signed by William L. Scheyen, President'),(32,29,'1','Hospice of SW Ohio','2016-08-04',NULL,NULL,NULL,3000.00,'David Walsh, CEO','dwalsh@carebridgeservices.org','David Walsh, CEO','dwalsh@carebridgeservices.org',24.00,'Fixed Bid: CAPPED',0,1,''),(33,30,'1','Spring Grove Cemetery augmented Reality','2016-12-05',NULL,NULL,NULL,0.00,'Greg Kent, Director of IT','gkent@springgrove.org','Greg Kent, Director of IT','gkent@springgrove.org',30.00,'TIME & MATERIALS',0,1,''),(34,31,'1','Cincinnati Children\'s App','2016-12-08',NULL,NULL,NULL,5000.00,'Leanne Tamm','Leanne.Tamm@cchmc.org','Leanne Tamm','Leanne.Tamm@cchmc.org',24.00,'Fixed Bid: CAPPED',0,1,'RA signed by Jana Bazzoli, Vice President-CCRF'),(35,32,'1','Mariemont Phase 1','2017-01-24',NULL,NULL,NULL,6000.00,'Tom Golinar','TGolinar@mariemontschools.org','Tom Golinar','TGolinar@mariemontschools.org',30.00,'Fixed Bid: CAPPED',0,1,'cap is for phase 1'),(36,33,'1','Safety Edge LLC.','2017-02-01',NULL,NULL,NULL,0.00,'David Moss','dmoss@northstarsllc.com','David Moss','dmoss@northstarsllc.com',45.00,'TIME & MATERIALS',0,1,'RA signed by John Fisher, President'),(37,34,'1','Elementz LLC','2017-02-05',NULL,NULL,NULL,0.00,'Monica Barrett','monicabarrett@ymail.com','Monica Barrett','monicabarrett@ymail.com',45.00,'TIME & MATERIALS',0,1,''),(38,35,'1','Pulls','2017-02-07',NULL,NULL,NULL,0.00,'David A. Cain (President & CEO)','david@getpulls.com','David A. Cain (President & CEO)','david@getpulls.com',45.00,'TIME & MATERIALS',0,1,''),(39,36,'1','iReportSource','2017-02-27',NULL,NULL,NULL,0.00,'Christi Brown, CEO','cbrown@ireportsource.com','Christi Brown, CEO','cbrown@ireportsource.com',45.00,'TIME & MATERIALS',0,1,''),(40,37,'1','L.I.F.E. Foundation','2017-03-10',NULL,NULL,NULL,0.00,'Carter F. Randolph','carter@therandolphcompany.com','Carter F. Randolph','carter@therandolphcompany.com',45.00,'TIME & MATERIALS',0,1,''),(41,38,'1','Johnstone','2017-03-13',NULL,NULL,NULL,0.00,'Ben Callahan','ben.callahan@johnstonesolutions.com','Linda Marshall','linda.marshall@johnstonesupply.com',45.00,'TIME & MATERIALS',0,1,'RA signed by Cameron Grimme, VP Finance'),(42,39,'1','RE/MAX Monika - Sustainment 5-hrs','2017-03-30',NULL,NULL,NULL,0.00,'A. Dulin (President)','Alan@morton-holdings.com','A. Dulin (President)','Alan@morton-holdings.com',45.00,'WEB ASSURANCE POLICY:  LIFELINE',0,1,'$225/Fixed Monthly Web Assurance Lifeline - Plus billed maintenance at hrly rate.'),(43,39,'2','RE/MAX Monika - New Website','2017-04-10',NULL,NULL,NULL,14850.00,'A. Dulin (President)','Alan@morton-holdings.com','A. Dulin (President)','Alan@morton-holdings.com',45.00,'Fixed Bid: CAPPED',0,1,''),(44,40,'1','Lodige, USA','2017-04-11',NULL,NULL,NULL,0.00,'Jeffrey W.  Raabe, CEO','jeffraabe@lodige-pt.com','Jeffrey W.  Raabe, CEO','jeffraabe@lodige-pt.com',45.00,'TIME & MATERIALS',0,1,''),(45,41,'1','MRC - Mayerson Funded Project','2017-05-08',NULL,NULL,NULL,4000.00,'Bethany Monahan','bethany@mrccinci.org','Bethany Monahan','bethany@mrccinci.org',30.00,'Fixed Bid: FIXED COST',0,1,''),(46,1,'2','Apprenticeship Program','2017-07-21',NULL,0.00,0.00,0.00,'Mikes Sames','samesm1@nku.edu','Mikes Sames','samesm1@nku.edu',10.00,'Time and Materials',0,1,''),(47,1,'3','System Administation','2017-07-21',NULL,0.00,0.00,0.00,'Jesse Hockenbury','hockenburj1@nku.edu','Jesse Hockenbury','hockenburj1@nku.edu',10.00,'Time and Materials',0,1,'');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `research_agreements`
--

DROP TABLE IF EXISTS `research_agreements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `research_agreements` (
  `RAID` int(11) NOT NULL AUTO_INCREMENT,
  `research_agreement` varchar(50) NOT NULL,
  `companyName` varchar(150) DEFAULT NULL,
  `organizationID` int(11) DEFAULT NULL,
  PRIMARY KEY (`RAID`),
  UNIQUE KEY `RAIDX_UNIQUE` (`RAID`),
  KEY `fk_organizationID_research_agreements_idx` (`organizationID`),
  CONSTRAINT `fk_organizationID_research_agreements` FOREIGN KEY (`organizationID`) REFERENCES `organization` (`organizationID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `research_agreements`
--

LOCK TABLES `research_agreements` WRITE;
/*!40000 ALTER TABLE `research_agreements` DISABLE KEYS */;
INSERT INTO `research_agreements` VALUES (1,'100000','Center for Applied Informatics',1),(2,'100004','Professional Voice Messaging',1),(3,'100008','Incipience Group',1),(4,'100013','InstrumentLife',1),(5,'100027','The Shephard Group LLC',1),(6,'100054','Best Upon Request',1),(7,'100061','Gleason Reel',1),(8,'100067','3DLT',1),(9,'100088','W. Ron Adams',1),(10,'100111','Greater Cincinnati STEM Collaborative',1),(11,'100116','Northern Kentucky Education Council',1),(12,'100131','Ancra International ',1),(13,'100146','Electronic Commerce Link',1),(14,'100146','EC Link',1),(15,'100149','Tandem Public Relations',1),(16,'100158','Kentucky Department of Education',1),(17,'100158','Kentucky Department of Education (KDE)',1),(18,'100159','NKU-Center for Environmental Education (CINSAM)',1),(19,'100166','84.51',1),(20,'100172','Association of University Interior Designers (AUID)',1),(21,'100177','Northern Kentucky Emergency Planning Committee',1),(22,'100179','Stroud Water Research Center',1),(23,'100181','Ethos Laboratories',1),(24,'100184','Harmony Acres Farm',1),(25,'100187','Cincinnati Insurance Company',1),(26,'100189','Children Inc.',1),(27,'100190','Community of Faith Presbyterian Church',1),(28,'100192','Skyward',1),(29,'100193','Hospice of SW Ohio',1),(30,'100197','Spring Grove Cemetery',1),(31,'100198','Cincinnati Children\'s Hospital',1),(32,'100200','Mariemont City Schools',1),(33,'100201','Safety Edge LLC.',1),(34,'100202','Elementz LLC',1),(35,'100203','The Wireless Store Inc, DBA Pulls',1),(36,'100204','iReportSource',1),(37,'100205','The Randolph Company',1),(38,'100206','Johnstone Supply LLC',1),(39,'100207','Morton-Holdings LLC.',1),(40,'100208','Lodige Process Technology',1),(41,'100209','Music Resource Center',1);
/*!40000 ALTER TABLE `research_agreements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `roleID` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(45) NOT NULL,
  PRIMARY KEY (`roleID`),
  UNIQUE KEY `role_ID_UNIQUE` (`roleID`),
  UNIQUE KEY `role_UNIQUE` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (3,'Administrator'),(2,'Manager'),(1,'Student'),(4,'Student Administrator');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedule_times`
--

DROP TABLE IF EXISTS `schedule_times`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedule_times` (
  `scheduleID` int(11) NOT NULL AUTO_INCREMENT,
  `EOID` int(11) NOT NULL,
  `day` varchar(10) NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  PRIMARY KEY (`scheduleID`),
  UNIQUE KEY `schedule_ID_UNIQUE` (`scheduleID`)
) ENGINE=InnoDB AUTO_INCREMENT=180 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule_times`
--

LOCK TABLES `schedule_times` WRITE;
/*!40000 ALTER TABLE `schedule_times` DISABLE KEYS */;
INSERT INTO `schedule_times` VALUES (41,2,'Monday','07:00:00','09:15:00'),(42,2,'Monday','11:00:00','14:15:00'),(43,2,'Wednesday','07:00:00','10:00:00'),(44,2,'Thursday','07:00:00','08:45:00'),(45,8,'Monday','09:00:00','17:00:00'),(46,8,'Tuesday','09:00:00','17:00:00'),(47,8,'Wednesday','09:00:00','16:00:00'),(48,8,'Thursday','08:30:00','13:00:00'),(57,26,'Monday','09:00:00','13:00:00'),(58,26,'Tuesday','09:00:00','13:00:00'),(59,26,'Wednesday','09:00:00','13:00:00'),(60,26,'Thursday','09:00:00','13:00:00'),(61,7,'Monday','10:00:00','14:00:00'),(62,7,'Tuesday','10:00:00','14:00:00'),(63,7,'Wednesday','10:00:00','14:00:00'),(64,7,'Thursday','10:00:00','14:00:00'),(65,7,'Friday','10:00:00','14:00:00'),(69,22,'Monday','09:00:00','16:00:00'),(70,22,'Wednesday','09:00:00','15:00:00'),(71,22,'Thursday','09:00:00','16:00:00'),(75,53,'Monday','09:00:00','16:00:00'),(76,53,'Wednesday','09:00:00','15:00:00'),(77,53,'Thursday','09:00:00','16:00:00'),(78,54,'Monday','09:00:00','16:00:00'),(79,54,'Tuesday','09:00:00','16:00:00'),(80,54,'Wednesday','09:00:00','16:00:00'),(81,54,'Thursday','09:00:00','16:00:00'),(82,54,'Friday','09:00:00','16:00:00'),(83,23,'Monday','09:00:00','17:00:00'),(84,23,'Tuesday','09:00:00','17:00:00'),(85,23,'Wednesday','08:00:00','12:00:00'),(86,25,'Monday','10:00:00','17:00:00'),(87,25,'Tuesday','10:00:00','17:00:00'),(88,25,'Wednesday','10:00:00','17:00:00'),(89,25,'Thursday','10:00:00','17:00:00'),(90,25,'Friday','10:00:00','17:00:00'),(134,32,'Monday','10:00:00','17:00:00'),(135,32,'Tuesday','10:00:00','17:00:00'),(136,32,'Wednesday','10:00:00','17:00:00'),(137,32,'Thursday','10:00:00','17:00:00'),(138,32,'Friday','10:00:00','17:00:00'),(144,1,'Monday','09:30:00','09:30:00'),(145,1,'Tuesday','10:00:00','14:00:00'),(146,1,'Wednesday','10:00:00','14:00:00'),(147,1,'Thursday','10:00:00','14:00:00'),(148,1,'Friday','10:00:00','14:00:00'),(149,52,'Monday','08:00:00','15:00:00'),(150,52,'Tuesday','08:00:00','15:00:00'),(151,52,'Wednesday','08:00:00','15:00:00'),(152,52,'Thursday','08:00:00','15:00:00'),(153,52,'Friday','08:00:00','15:00:00'),(154,49,'Monday','09:00:00','11:00:00'),(155,49,'Monday','12:00:00','14:00:00'),(156,49,'Tuesday','09:00:00','15:00:00'),(157,49,'Wednesday','09:00:00','11:00:00'),(158,49,'Wednesday','12:00:00','14:00:00'),(159,49,'Thursday','09:00:00','15:00:00'),(166,35,'Monday','08:00:00','15:00:00'),(167,35,'Tuesday','08:00:00','15:00:00'),(168,35,'Wednesday','08:00:00','15:00:00'),(169,35,'Thursday','08:00:00','15:00:00'),(170,35,'Friday','08:00:00','15:00:00'),(171,47,'Monday','08:00:00','15:00:00'),(172,47,'Tuesday','08:00:00','15:00:00'),(173,47,'Wednesday','08:00:00','15:00:00'),(174,47,'Thursday','08:00:00','15:00:00'),(175,47,'Friday','08:00:00','15:00:00'),(176,48,'Monday','10:00:00','16:00:00'),(177,48,'Tuesday','10:00:00','16:00:00'),(178,48,'Wednesday','10:00:00','16:00:00'),(179,48,'Thursday','10:00:00','16:00:00');
/*!40000 ALTER TABLE `schedule_times` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `weeks`
--

DROP TABLE IF EXISTS `weeks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `weeks` (
  `weekID` int(11) NOT NULL AUTO_INCREMENT,
  `startDay` date NOT NULL,
  `endDay` date NOT NULL,
  PRIMARY KEY (`weekID`),
  UNIQUE KEY `weekID_UNIQUE` (`weekID`),
  UNIQUE KEY `startDate_UNIQUE` (`startDay`),
  UNIQUE KEY `endDate_UNIQUE` (`endDay`)
) ENGINE=InnoDB AUTO_INCREMENT=1264 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `weeks`
--

LOCK TABLES `weeks` WRITE;
/*!40000 ALTER TABLE `weeks` DISABLE KEYS */;
INSERT INTO `weeks` VALUES (571,'2017-06-18','2017-06-24'),(572,'2017-06-11','2017-06-17'),(573,'2017-06-04','2017-06-10'),(576,'2017-06-25','2017-07-01'),(639,'2017-05-28','2017-06-03'),(660,'2017-07-02','2017-07-08'),(665,'2017-07-09','2017-07-15'),(672,'2017-07-16','2017-07-22'),(780,'2017-07-03','2017-07-07'),(858,'2017-07-23','2017-07-29'),(859,'2017-07-30','2017-08-05'),(860,'2017-08-06','2017-08-12'),(861,'2017-08-13','2017-08-19'),(862,'2017-08-20','2017-08-26'),(863,'2017-08-27','2017-09-02'),(864,'2017-09-03','2017-09-09');
/*!40000 ALTER TABLE `weeks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `worked_hours`
--

DROP TABLE IF EXISTS `worked_hours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `worked_hours` (
  `WHID` int(11) NOT NULL AUTO_INCREMENT,
  `EOID` int(11) NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `weekID` int(11) NOT NULL,
  `workedDate` date DEFAULT NULL,
  PRIMARY KEY (`WHID`),
  KEY `fk_weekID_workedhours_idx` (`weekID`),
  CONSTRAINT `fk_weekID_workedhours` FOREIGN KEY (`weekID`) REFERENCES `weeks` (`weekID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `worked_hours`
--

LOCK TABLES `worked_hours` WRITE;
/*!40000 ALTER TABLE `worked_hours` DISABLE KEYS */;
INSERT INTO `worked_hours` VALUES (27,35,'12:00:00','16:00:00',672,'2017-07-21'),(33,25,'10:00:00','17:00:00',858,'2017-07-24'),(34,25,'10:00:00','17:00:00',858,'2017-07-25'),(35,25,'10:00:00','17:00:00',858,'2017-07-26'),(36,25,'10:00:00','17:00:00',858,'2017-07-27'),(37,25,'10:00:00','17:00:00',858,'2017-07-28'),(59,32,'10:00:00','17:00:00',858,'2017-07-24'),(60,32,'10:00:00','17:00:00',858,'2017-07-25'),(61,32,'10:00:00','17:00:00',858,'2017-07-26'),(62,32,'10:00:00','17:00:00',858,'2017-07-27'),(63,32,'10:00:00','17:00:00',858,'2017-07-28'),(71,1,'07:00:00','09:45:00',858,'2017-07-24'),(72,1,'13:30:00','15:45:00',858,'2017-07-24'),(73,1,'07:00:00','18:00:00',858,'2017-07-25'),(74,47,'08:00:00','15:00:00',858,'2017-07-24'),(75,47,'08:00:00','15:00:00',858,'2017-07-25'),(76,47,'08:00:00','15:00:00',858,'2017-07-26'),(77,47,'08:00:00','15:00:00',858,'2017-07-27'),(78,47,'08:00:00','15:00:00',858,'2017-07-28'),(79,49,'09:00:00','11:00:00',672,'2017-07-17'),(80,49,'12:00:00','14:00:00',672,'2017-07-17'),(81,49,'09:00:00','15:00:00',672,'2017-07-18'),(82,49,'09:00:00','11:00:00',672,'2017-07-19'),(83,49,'12:00:00','14:00:00',672,'2017-07-19'),(84,49,'09:00:00','15:00:00',672,'2017-07-20'),(85,49,'09:00:00','11:00:00',858,'2017-07-24'),(86,49,'12:00:00','14:00:00',858,'2017-07-24'),(87,49,'09:00:00','15:00:00',858,'2017-07-25'),(88,49,'09:00:00','11:00:00',858,'2017-07-26'),(89,49,'12:00:00','14:00:00',858,'2017-07-26'),(90,49,'09:00:00','15:00:00',858,'2017-07-27'),(91,47,'08:00:00','15:00:00',672,'2017-07-17'),(92,47,'08:00:00','15:00:00',672,'2017-07-18'),(93,47,'08:00:00','15:00:00',672,'2017-07-19'),(94,47,'08:00:00','15:00:00',672,'2017-07-20'),(95,47,'08:00:00','15:00:00',672,'2017-07-21'),(96,35,'10:00:00','17:00:00',858,'2017-07-24'),(97,35,'09:30:00','14:30:00',858,'2017-07-25'),(98,7,'10:00:00','14:00:00',858,'2017-07-24'),(99,7,'10:00:00','14:00:00',858,'2017-07-25'),(100,7,'10:00:00','14:00:00',858,'2017-07-26'),(101,7,'10:00:00','14:00:00',858,'2017-07-27'),(102,7,'10:00:00','14:00:00',858,'2017-07-28'),(103,7,'10:00:00','14:00:00',859,'2017-07-31'),(104,7,'10:00:00','14:00:00',859,'2017-08-01'),(105,7,'10:00:00','14:00:00',859,'2017-08-02'),(106,7,'10:00:00','14:00:00',859,'2017-08-03'),(107,7,'10:00:00','14:00:00',859,'2017-08-04'),(108,23,'09:00:00','17:00:00',858,'2017-07-24'),(109,23,'09:00:00','17:00:00',858,'2017-07-25'),(110,23,'08:00:00','12:00:00',858,'2017-07-26'),(111,23,'09:00:00','17:00:00',672,'2017-07-17'),(112,23,'09:00:00','17:00:00',672,'2017-07-18'),(113,23,'08:00:00','12:00:00',672,'2017-07-19'),(114,23,'09:00:00','17:00:00',859,'2017-07-31'),(115,23,'09:00:00','17:00:00',859,'2017-08-01'),(116,23,'08:00:00','12:00:00',859,'2017-08-02'),(117,41,'09:00:00','15:00:00',672,'2017-07-17'),(118,41,'09:00:00','15:00:00',672,'2017-07-18'),(119,41,'09:00:00','15:00:00',672,'2017-07-19'),(120,41,'09:00:00','15:00:00',672,'2017-07-20'),(121,41,'09:00:00','15:00:00',672,'2017-07-21'),(122,48,'10:00:00','16:00:00',672,'2017-07-17'),(123,48,'10:00:00','16:00:00',672,'2017-07-18'),(124,48,'10:00:00','16:00:00',672,'2017-07-19'),(125,48,'10:00:00','16:00:00',672,'2017-07-20');
/*!40000 ALTER TABLE `worked_hours` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-26 13:30:26
