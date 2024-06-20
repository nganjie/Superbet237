-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: kenodb
-- ------------------------------------------------------
-- Server version	5.7.43-log

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
-- Table structure for table `approvisionnement`
--

DROP TABLE IF EXISTS `approvisionnement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `approvisionnement` (
  `approvID` varchar(50) NOT NULL,
  `caisseID` varchar(50) DEFAULT NULL,
  `dateApprov` date DEFAULT NULL,
  `montant` double DEFAULT NULL,
  `user_update` varchar(50) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip_update` varchar(50) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`approvID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approvisionnement`
--

LOCK TABLES `approvisionnement` WRITE;
/*!40000 ALTER TABLE `approvisionnement` DISABLE KEYS */;
INSERT INTO `approvisionnement` VALUES ('APPROV20230708024943.101.100','CAIS20230707211535.000.100','2023-07-28',67676776,'User1','2023-07-08 02:14:19','127.0.0.1','User1','2023-07-08 01:49:43'),('APPROV20230708030247.011.201','CAIS20230707211909.200.002','2023-07-08',2020000,'User1','2023-07-11 10:40:04','127.0.0.1','User1','2023-07-08 02:02:47'),('APPROV20230708031258.102.021','CAIS20230707211535.000.100','2023-07-13',8900000,'User1','2023-07-08 02:12:58','127.0.0.1','User1','2023-07-08 02:12:58'),('APPROV20230711113940.102.221','CAIS20230707211535.000.100','2023-07-11',1200000,'User1','2023-07-11 10:39:40','127.0.0.1','User1','2023-07-11 10:39:40');
/*!40000 ALTER TABLE `approvisionnement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bonus`
--

DROP TABLE IF EXISTS `bonus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bonus` (
  `code_salle` varchar(45) NOT NULL,
  `jackpot_min` double DEFAULT NULL,
  `jackpot_max` double DEFAULT NULL,
  `jackpot_rate` double DEFAULT NULL,
  `actif` tinyint(4) DEFAULT NULL,
  `lastupdate` datetime DEFAULT NULL,
  `userID` varchar(45) DEFAULT NULL,
  `turnoverID` varchar(100) DEFAULT NULL,
  `montant_bonus` double DEFAULT NULL,
  `organisationID` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`code_salle`),
  KEY `FK_BONUS_SALLE_idx` (`code_salle`),
  KEY `FK_BONUS_USERS_idx` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bonus`
--

LOCK TABLES `bonus` WRITE;
/*!40000 ALTER TABLE `bonus` DISABLE KEYS */;
INSERT INTO `bonus` VALUES ('SALL01220NKOA',1000,1000,12,0,'2024-04-29 21:46:08',NULL,NULL,45,'ORG2023ORG1222102916000000001');
/*!40000 ALTER TABLE `bonus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bonus_historique`
--

DROP TABLE IF EXISTS `bonus_historique`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bonus_historique` (
  `bonusID` varchar(50) NOT NULL,
  `code_salle` varchar(45) DEFAULT NULL,
  `jackpot_min` double DEFAULT NULL,
  `jackpot_max` double DEFAULT NULL,
  `jackpot_rate` double DEFAULT NULL,
  `actif` tinyint(4) DEFAULT NULL,
  `lastupdate` datetime DEFAULT NULL,
  `userID` varchar(45) DEFAULT NULL,
  `turnoverID` varchar(100) DEFAULT NULL,
  `montant_bonus` double DEFAULT NULL,
  `organisationID` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`bonusID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bonus_historique`
--

LOCK TABLES `bonus_historique` WRITE;
/*!40000 ALTER TABLE `bonus_historique` DISABLE KEYS */;
INSERT INTO `bonus_historique` VALUES ('BON.6.5705152196535055','SALL01220NKOA',150,12,100,1,'2024-04-29 20:58:32','ADMIN',NULL,12000,'ORG2023ORG1222102916000000001');
/*!40000 ALTER TABLE `bonus_historique` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bonus_solde`
--

DROP TABLE IF EXISTS `bonus_solde`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bonus_solde` (
  `code_salle` varchar(45) NOT NULL,
  `jackpot_solde` double DEFAULT NULL,
  `lastupdate` datetime DEFAULT NULL,
  PRIMARY KEY (`code_salle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bonus_solde`
--

LOCK TABLES `bonus_solde` WRITE;
/*!40000 ALTER TABLE `bonus_solde` DISABLE KEYS */;
INSERT INTO `bonus_solde` VALUES ('TSINGA',38000,'2023-12-22 18:58:37');
/*!40000 ALTER TABLE `bonus_solde` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cagnotte`
--

DROP TABLE IF EXISTS `cagnotte`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cagnotte` (
  `code_salle` varchar(45) NOT NULL,
  `salle` varchar(45) DEFAULT NULL,
  `actif` tinyint(4) DEFAULT NULL,
  `date_cagnotte` datetime DEFAULT NULL,
  `lots` varchar(45) DEFAULT NULL,
  `lastupdate` varchar(45) DEFAULT NULL,
  `userID` varchar(45) DEFAULT NULL,
  `turnoverID` varchar(45) DEFAULT NULL,
  `organisationID` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`code_salle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cagnotte`
--

LOCK TABLES `cagnotte` WRITE;
/*!40000 ALTER TABLE `cagnotte` DISABLE KEYS */;
INSERT INTO `cagnotte` VALUES ('SALL01220NKOA',NULL,0,'2024-05-12 00:00:00','CONGELO','2024-04-29 21:46:08','ADMIN',NULL,'ORG2023ORG1222102916000000001');
/*!40000 ALTER TABLE `cagnotte` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cagnotte_historique`
--

DROP TABLE IF EXISTS `cagnotte_historique`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cagnotte_historique` (
  `cagnotteID` varchar(45) NOT NULL,
  `code_salle` varchar(45) NOT NULL,
  `salle` varchar(45) DEFAULT NULL,
  `actif` tinyint(4) DEFAULT NULL,
  `date_cagnotte` datetime DEFAULT NULL,
  `lots` varchar(45) DEFAULT NULL,
  `lastupdate` varchar(45) DEFAULT NULL,
  `userID` varchar(45) DEFAULT NULL,
  `turnoverID` varchar(45) DEFAULT NULL,
  `organisationID` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cagnotteID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cagnotte_historique`
--

LOCK TABLES `cagnotte_historique` WRITE;
/*!40000 ALTER TABLE `cagnotte_historique` DISABLE KEYS */;
INSERT INTO `cagnotte_historique` VALUES ('CANG.6.5705152196535055','SALL01220NKOA',NULL,NULL,'2024-05-12 00:00:00','CONGELO','2024-04-29 21:38:53','ADMIN',NULL,'ORG2023ORG1222102916000000001');
/*!40000 ALTER TABLE `cagnotte_historique` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caisse`
--

DROP TABLE IF EXISTS `caisse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `caisse` (
  `code_salle` varchar(50) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `bloque` tinyint(4) DEFAULT '1',
  `userID` varchar(50) DEFAULT NULL,
  `ip_update` varchar(50) DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) DEFAULT NULL,
  `solde` double DEFAULT NULL,
  `organisationID` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`code_salle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caisse`
--

LOCK TABLES `caisse` WRITE;
/*!40000 ALTER TABLE `caisse` DISABLE KEYS */;
INSERT INTO `caisse` VALUES ('dddeed','ddsdsdsd',0,'ADMIN',NULL,'2024-04-28 18:43:06','2024-04-28 18:43:06',NULL,0,'ORG2023ORG1222102916000000001'),('dsdsdsd','dssdsdds',0,'ADMIN',NULL,'2024-04-28 18:44:30','2024-04-28 18:44:30',NULL,0,'ORG2023ORG1222102916000000001'),('dsdsdsdsdsdsddsd','dsdsdsdsdsdsdsdsd',0,'ADMIN',NULL,'2024-04-28 18:45:12','2024-04-28 18:45:12',NULL,0,'ORG2023ORG1222102916000000001'),('SALL01220NKOA','NKOABANG',0,'ADMIN',NULL,'2024-04-29 20:10:05','2024-04-29 20:10:05',NULL,0,'ORG2023ORG1222102916000000001'),('SANKOABANG','Salle de nkabang',0,'ADMIN',NULL,'2024-04-28 18:39:59','2024-04-28 18:39:59',NULL,0,'ORG2023ORG1222102916000000001'),('SKLLSKK','s,,sl,slslz,,zls²²²²',0,'ADMIN',NULL,'2024-04-28 18:41:13','2024-04-28 18:41:13',NULL,0,'ORG2023ORG1222102916000000001'),('TSINGA','TSINGA',0,'USER2023USER1222102916000000004',NULL,'2023-12-22 11:14:49','2023-12-22 11:14:49',NULL,61200.33333333333,'ORG2023ORG1222102916000000001');
/*!40000 ALTER TABLE `caisse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caisse_mouvement`
--

DROP TABLE IF EXISTS `caisse_mouvement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `caisse_mouvement` (
  `caisse_mouvID` varchar(50) NOT NULL,
  `caisseID` varchar(45) DEFAULT NULL,
  `montant` double DEFAULT NULL,
  `modetransfert` varchar(1) DEFAULT NULL,
  `code_salle` varchar(45) DEFAULT NULL,
  `lastupdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `solde_apres_operation` double DEFAULT NULL,
  `organisationID` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`caisse_mouvID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caisse_mouvement`
--

LOCK TABLES `caisse_mouvement` WRITE;
/*!40000 ALTER TABLE `caisse_mouvement` DISABLE KEYS */;
INSERT INTO `caisse_mouvement` VALUES ('CAIM2023CAIM1222123344000000001','TSINGA',20000,NULL,'TSINGA','2023-12-22 12:33:44',20000,NULL),('CAIM2023CAIM1222235806000000002','TSINGA',7708,'D','TSINGA','2023-12-22 23:58:06',20000.333333333332,NULL),('CAIM2023CAIM1223004617000000003','TSINGA',3000,'D','TSINGA','2023-12-23 00:46:17',61000.33333333333,NULL);
/*!40000 ALTER TABLE `caisse_mouvement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cycle_mouvement`
--

DROP TABLE IF EXISTS `cycle_mouvement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cycle_mouvement` (
  `id` int(11) NOT NULL,
  `code_salle` varchar(45) DEFAULT NULL,
  `lastupdate` datetime DEFAULT NULL,
  `solde` double DEFAULT NULL,
  `turnoverID` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cycle_mouvement`
--

LOCK TABLES `cycle_mouvement` WRITE;
/*!40000 ALTER TABLE `cycle_mouvement` DISABLE KEYS */;
/*!40000 ALTER TABLE `cycle_mouvement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cycle_solde`
--

DROP TABLE IF EXISTS `cycle_solde`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cycle_solde` (
  `code_salle` varchar(45) NOT NULL,
  `solde` double DEFAULT NULL,
  `lastupdate` datetime DEFAULT NULL,
  `turnoverID` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`code_salle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cycle_solde`
--

LOCK TABLES `cycle_solde` WRITE;
/*!40000 ALTER TABLE `cycle_solde` DISABLE KEYS */;
INSERT INTO `cycle_solde` VALUES ('dddeed',0,'2024-04-28 19:50:44','dddeed'),('TSINGA',58590,'2023-12-22 13:00:44','TSINGA');
/*!40000 ALTER TABLE `cycle_solde` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detailoption`
--

DROP TABLE IF EXISTS `detailoption`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detailoption` (
  `detailOptionID` int(11) NOT NULL AUTO_INCREMENT,
  `nbreBoule` int(11) DEFAULT NULL,
  `cote` double DEFAULT NULL,
  `userID` varchar(50) DEFAULT NULL,
  `codeOption` varchar(50) DEFAULT NULL,
  `organisationID` varchar(50) DEFAULT NULL,
  `dateCreation` varchar(50) DEFAULT NULL,
  `nbreBouleApparu` int(11) DEFAULT NULL,
  PRIMARY KEY (`detailOptionID`),
  KEY `FK_DetailOption_option_idx` (`detailOptionID`,`codeOption`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detailoption`
--

LOCK TABLES `detailoption` WRITE;
/*!40000 ALTER TABLE `detailoption` DISABLE KEYS */;
INSERT INTO `detailoption` VALUES (1,1,3.6,NULL,'TOUTOURIEN',NULL,'2023-12-12 02:08:34',NULL),(2,2,14,NULL,'TOUTOURIEN',NULL,'2023-12-12 02:08:34',NULL),(3,3,60,NULL,'TOUTOURIEN',NULL,'2023-12-12 02:08:34',NULL),(4,4,275,NULL,'TOUTOURIEN',NULL,'2023-12-12 02:08:34',NULL),(5,5,1400,NULL,'TOUTOURIEN',NULL,'2023-12-12 02:08:34',NULL),(6,6,6500,NULL,'TOUTOURIEN',NULL,'2023-12-12 02:08:34',NULL),(11,1,1.2,NULL,'NONSORTANT',NULL,'2023-12-12 02:08:34',NULL),(12,2,1.6,NULL,'NONSORTANT',NULL,'2023-12-12 02:08:34',NULL),(13,3,2,NULL,'NONSORTANT',NULL,'2023-12-12 02:08:34',NULL),(14,4,2.7,NULL,'NONSORTANT',NULL,'2023-12-12 02:08:34',NULL),(15,5,3.7,NULL,'NONSORTANT',NULL,'2023-12-12 02:08:34',NULL),(16,6,5,NULL,'NONSORTANT',NULL,'2023-12-12 02:08:34',NULL),(17,2,1,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',1),(18,2,8,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',2),(19,3,1,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',1),(20,3,2,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',2),(21,3,10,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',3),(22,4,0,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',1),(23,4,1,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',2),(24,4,4,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',3),(25,4,75,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',4),(26,5,0,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',1),(27,5,1,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',2),(28,5,2,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',3),(29,5,8,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',4),(30,5,500,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',5),(31,6,0,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',1),(32,6,1,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',2),(33,6,2,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',3),(34,6,3,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',4),(35,6,25,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',5),(36,6,800,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',6),(37,7,0,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',1),(38,7,0,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',2),(39,7,1,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',3),(40,7,3,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',4),(41,7,30,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',5),(42,7,220,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',6),(43,7,3000,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',7),(44,8,0,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',1),(45,8,0,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',2),(46,8,1,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',3),(47,8,2,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',4),(48,8,6,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',5),(49,8,50,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',6),(50,8,1200,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',7),(51,8,8000,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',8),(52,9,0,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',1),(53,9,0,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',2),(54,9,1,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',3),(55,9,2,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',4),(56,9,3,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',5),(57,9,25,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',6),(58,9,100,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',7),(59,9,1500,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',8),(60,9,9000,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',9),(61,10,0,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',1),(62,10,0,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',2),(63,10,1,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',3),(64,10,2,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',4),(65,10,3,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',5),(66,10,5,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',6),(67,10,10,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',7),(68,10,200,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',8),(69,10,2000,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',9),(70,10,10000,NULL,'SIMPLE',NULL,'2023-12-20 10:42:05',10),(71,7,7,NULL,'NONSORTANT',NULL,'2023-12-22 23:46:34',NULL),(72,8,9.5,NULL,'NONSORTANT',NULL,'2023-12-22 23:46:34',NULL),(73,9,13,NULL,'NONSORTANT',NULL,'2023-12-22 23:46:34',NULL),(74,10,18,NULL,'NONSORTANT',NULL,'2023-12-22 23:46:34',NULL);
/*!40000 ALTER TABLE `detailoption` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gestionsalle`
--

DROP TABLE IF EXISTS `gestionsalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gestionsalle` (
  `salleID` varchar(50) NOT NULL,
  `userID` varchar(50) NOT NULL,
  `dateAffectation` date DEFAULT NULL,
  PRIMARY KEY (`salleID`,`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gestionsalle`
--

LOCK TABLES `gestionsalle` WRITE;
/*!40000 ALTER TABLE `gestionsalle` DISABLE KEYS */;
/*!40000 ALTER TABLE `gestionsalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historique`
--

DROP TABLE IF EXISTS `historique`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_update` varchar(50) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `typeID` int(11) DEFAULT NULL,
  `action_label` varchar(50) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `entityID` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=281 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historique`
--

LOCK TABLES `historique` WRITE;
/*!40000 ALTER TABLE `historique` DISABLE KEYS */;
INSERT INTO `historique` VALUES (1,'dee','2023-07-07 14:41:31',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(2,NULL,'2023-07-07 14:42:23',1,'INSERTION','Insertion d\'une organisation','ORG20230707154223.112.012'),(3,'dee','2023-07-07 14:42:23',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(4,NULL,'2023-07-07 14:43:36',1,'INSERTION','Insertion d\'une organisation','ORG20230707154336.110.111'),(5,'dee','2023-07-07 14:43:36',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(6,'dee','2023-07-07 14:48:22',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(7,'dee','2023-07-07 14:58:55',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(8,NULL,'2023-07-07 14:59:05',1,'INSERTION','Insertion d\'une organisation','ORG20230707155905.220.222'),(9,'dee','2023-07-07 14:59:05',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(10,'dee','2023-07-07 15:09:57',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(11,'dee','2023-07-07 15:10:04',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(12,'dee','2023-07-07 15:11:24',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(13,'dee','2023-07-07 15:11:53',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(14,'dee','2023-07-07 15:15:56',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(15,'dee','2023-07-07 15:16:24',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(16,'dee','2023-07-07 15:16:28',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(17,'dee','2023-07-07 15:16:34',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(18,'dee','2023-07-07 15:18:39',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(19,'dee','2023-07-07 15:18:45',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(20,'dee','2023-07-07 15:18:48',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(21,'dee','2023-07-07 15:18:49',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(22,'dee','2023-07-07 15:18:50',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(23,'dee','2023-07-07 15:22:05',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(24,'dee','2023-07-07 15:23:48',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(25,'dee','2023-07-07 15:25:02',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(26,'dee','2023-07-07 15:25:06',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(27,'dee','2023-07-07 15:25:10',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(28,'dee','2023-07-07 15:25:20',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(29,NULL,'2023-07-07 15:26:31',1,'INSERTION','Insertion d\'une organisation','ORG20230707162631.210.022'),(30,'dee','2023-07-07 15:26:31',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(31,'dee','2023-07-07 15:27:18',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(32,'dee','2023-07-07 15:27:22',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(33,'dee','2023-07-07 15:27:26',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(34,NULL,'2023-07-07 15:27:52',2,'MISE A JOUR ORGANISATION','Mise à jours d\'une organisation','ORG20230707154336.110.111'),(35,'dee','2023-07-07 15:27:52',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(36,'dee','2023-07-07 15:27:55',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(37,NULL,'2023-07-07 15:28:06',2,'MISE A JOUR ORGANISATION','Mise à jours d\'une organisation','ORG20230707155905.220.222'),(38,'dee','2023-07-07 15:28:07',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(39,NULL,'2023-07-07 15:28:16',2,'MISE A JOUR ORGANISATION','Mise à jours d\'une organisation','ORG20230707154336.110.111'),(40,'dee','2023-07-07 15:28:16',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(41,NULL,'2023-07-07 15:28:22',2,'MISE A JOUR ORGANISATION','Mise à jours d\'une organisation','ORG20230707162631.210.022'),(42,'dee','2023-07-07 15:28:22',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(43,'dee','2023-07-07 15:28:27',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(44,'dee','2023-07-07 15:28:29',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(45,NULL,'2023-07-07 15:28:46',2,'MISE A JOUR ORGANISATION','Mise à jours d\'une organisation','ORG20230707154336.110.111'),(46,'dee','2023-07-07 15:28:46',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(47,'dee','2023-07-07 15:28:50',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(48,'dee','2023-07-07 15:30:47',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(49,NULL,'2023-07-07 15:30:56',2,'MISE A JOUR ORGANISATION','Mise à jours d\'une organisation','ORG20230707155905.220.222'),(50,'dee','2023-07-07 15:30:56',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(51,'user1','2023-07-07 15:39:08',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(52,NULL,'2023-07-07 15:43:36',1,'INSERTION','Insertion d\'une salle','SALL20230707164336.020.110'),(53,'user1','2023-07-07 15:43:37',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(54,'user1','2023-07-07 15:48:06',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(55,NULL,'2023-07-07 15:50:21',2,'MISE A JOUR','Mise à jours d\'une salle','SALL20230707164336.020.110'),(56,'user1','2023-07-07 15:50:21',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(57,NULL,'2023-07-07 15:50:55',1,'INSERTION','Insertion d\'une salle','SALL20230707165055.101.120'),(58,'user1','2023-07-07 15:50:55',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(59,'user1','2023-07-07 15:54:11',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(60,'user1','2023-07-07 19:22:01',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(61,NULL,'2023-07-07 19:22:07',2,'MISE A JOUR','Mise à jours d\'une salle','SALL20230707164336.020.110'),(62,'user1','2023-07-07 19:22:07',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(63,'user1','2023-07-07 19:22:37',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(64,'user1','2023-07-07 19:24:36',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(65,NULL,'2023-07-07 19:25:57',1,'INSERTION','Insertion d\'une salle','SALL20230707202557.101.200'),(66,'user1','2023-07-07 19:25:57',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(67,NULL,'2023-07-07 19:26:27',2,'MISE A JOUR','Mise à jours d\'une salle','SALL20230707165055.101.120'),(68,'user1','2023-07-07 19:26:27',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(69,NULL,'2023-07-07 19:28:42',2,'MISE A JOUR','Mise à jours d\'une salle','SALL20230707165055.101.120'),(70,'user1','2023-07-07 19:28:42',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(71,'user1','2023-07-07 19:29:03',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(72,'user1','2023-07-07 19:33:46',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(73,'user1','2023-07-07 19:48:34',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(74,'user1','2023-07-07 20:08:06',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(75,'user1','2023-07-07 20:08:06',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(76,'user1','2023-07-07 20:08:57',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(77,'user1','2023-07-07 20:08:57',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(78,'user1','2023-07-07 20:11:18',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(79,'user1','2023-07-07 20:11:18',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(80,'User1','2023-07-07 20:15:35',1,'INSERTION','Insertion d\'une caisse','CAIS20230707211535.000.100'),(81,'user1','2023-07-07 20:15:35',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(82,'user1','2023-07-07 20:17:42',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(83,'user1','2023-07-07 20:17:42',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(84,'User1','2023-07-07 20:17:56',2,'MISE A JOUR ORGANISATION','Mise à jours d\'une caisse','CAIS20230707211535.000.100'),(85,'user1','2023-07-07 20:17:56',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(86,'user1','2023-07-07 20:18:54',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(87,'user1','2023-07-07 20:18:54',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(88,'User1','2023-07-07 20:19:09',1,'INSERTION','Insertion d\'une caisse','CAIS20230707211909.200.002'),(89,'user1','2023-07-07 20:19:09',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(90,'user1','2023-07-07 20:21:14',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(91,'user1','2023-07-07 20:21:14',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(92,'user1','2023-07-07 20:21:54',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(93,'user1','2023-07-07 20:21:54',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(94,'user1','2023-07-07 20:21:55',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(95,'dee','2023-07-07 20:21:56',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(96,NULL,'2023-07-07 20:22:11',2,'MISE A JOUR ORGANISATION','Mise à jours d\'une organisation','ORG20230707162631.210.022'),(97,'dee','2023-07-07 20:22:11',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(98,'user1','2023-07-07 20:22:54',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(99,'user1','2023-07-07 20:23:02',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(100,'user1','2023-07-07 20:23:02',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(101,'dee','2023-07-08 00:39:33',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(102,'user1','2023-07-08 00:39:53',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(103,'user1','2023-07-08 00:39:53',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(104,'dee','2023-07-08 00:39:57',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(105,'dee','2023-07-08 00:49:22',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(106,NULL,'2023-07-08 00:49:32',1,'INSERTION','Insertion d\'une organisation','ORG20230708014932.102.120'),(107,'dee','2023-07-08 00:49:32',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(108,NULL,'2023-07-08 00:49:42',2,'MISE A JOUR ORGANISATION','Mise à jours d\'une organisation','ORG20230708014932.102.120'),(109,'dee','2023-07-08 00:49:42',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(110,'dee','2023-07-08 00:49:48',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(111,'user1','2023-07-08 00:49:57',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(112,'user1','2023-07-08 00:49:57',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(113,'User1','2023-07-08 00:50:03',2,'MISE A JOUR ORGANISATION','Mise à jours d\'une caisse','CAIS20230707211909.200.002'),(114,'user1','2023-07-08 00:50:03',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(115,'user1','2023-07-08 00:50:13',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(116,'user1','2023-07-08 00:56:04',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(117,'dee','2023-07-08 00:59:02',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(118,'user1','2023-07-08 00:59:03',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(119,NULL,'2023-07-08 01:02:00',1,'INSERTION','Insertion d\'une salle','SALL20230708020200.010.021'),(120,'user1','2023-07-08 01:02:00',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(121,NULL,'2023-07-08 01:02:13',2,'MISE A JOUR','Mise à jours d\'une salle','SALL20230708020200.010.021'),(122,'user1','2023-07-08 01:02:13',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(123,'user1','2023-07-08 01:05:43',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(124,'user1','2023-07-08 01:05:43',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(125,'user1','2023-07-08 01:12:40',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(126,'user1','2023-07-08 01:14:48',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(127,'user1','2023-07-08 01:14:48',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(128,'user1','2023-07-08 01:17:10',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(129,'user1','2023-07-08 01:17:10',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(130,'user1','2023-07-08 01:27:28',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(131,'user1','2023-07-08 01:27:28',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(132,'user1','2023-07-08 01:31:23',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(133,'user1','2023-07-08 01:32:22',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(134,'user1','2023-07-08 01:32:56',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(135,'user1','2023-07-08 01:39:01',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(136,'user1','2023-07-08 01:39:01',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(137,'user1','2023-07-08 01:40:47',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(138,'user1','2023-07-08 01:40:47',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(139,'user1','2023-07-08 01:43:10',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(140,'user1','2023-07-08 01:43:10',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(141,'user1','2023-07-08 01:47:38',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(142,'user1','2023-07-08 01:47:38',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(143,'User1','2023-07-08 01:49:43',1,'INSERTION','Insertion d\'un approvisionnement','APPROV20230708024943.101.100'),(144,'user1','2023-07-08 01:49:43',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(145,'user1','2023-07-08 01:51:46',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(146,'user1','2023-07-08 01:52:31',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(147,'user1','2023-07-08 01:52:32',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(148,'User1','2023-07-08 01:52:42',2,'MISE A JOUR','Mise à jours d\'un approvisionnement','APPROV20230708024943.101.100'),(149,'user1','2023-07-08 01:52:42',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(150,'User1','2023-07-08 01:52:49',2,'MISE A JOUR','Mise à jours d\'un approvisionnement','APPROV20230708024943.101.100'),(151,'user1','2023-07-08 01:52:49',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(152,'User1','2023-07-08 01:57:08',2,'MISE A JOUR','Mise à jours d\'un approvisionnement','APPROV20230708024943.101.100'),(153,'user1','2023-07-08 01:57:08',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(154,'user1','2023-07-08 01:58:17',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(155,'user1','2023-07-08 01:58:17',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(156,'user1','2023-07-08 02:01:57',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(157,'user1','2023-07-08 02:01:57',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(158,'User1','2023-07-08 02:02:47',1,'INSERTION','Insertion d\'un approvisionnement','APPROV20230708030247.011.201'),(159,'user1','2023-07-08 02:02:47',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(160,'user1','2023-07-08 02:09:36',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(161,'user1','2023-07-08 02:09:36',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(162,'user1','2023-07-08 02:10:14',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(163,'user1','2023-07-08 02:10:14',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(164,'user1','2023-07-08 02:11:32',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(165,'user1','2023-07-08 02:11:32',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(166,'user1','2023-07-08 02:12:36',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(167,'user1','2023-07-08 02:12:36',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(168,'User1','2023-07-08 02:12:58',1,'INSERTION','Insertion d\'un approvisionnement','APPROV20230708031258.102.021'),(169,'user1','2023-07-08 02:12:58',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(170,'user1','2023-07-08 02:13:28',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(171,'user1','2023-07-08 02:13:28',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(172,'user1','2023-07-08 02:13:33',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(173,'user1','2023-07-08 02:13:33',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(174,'User1','2023-07-08 02:13:43',2,'MISE A JOUR ORGANISATION','Mise à jours d\'une caisse','CAIS20230707211535.000.100'),(175,'user1','2023-07-08 02:13:43',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(176,'User1','2023-07-08 02:13:59',2,'MISE A JOUR ORGANISATION','Mise à jours d\'une caisse','CAIS20230707211909.200.002'),(177,'user1','2023-07-08 02:13:59',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(178,'user1','2023-07-08 02:14:02',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(179,'user1','2023-07-08 02:14:02',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(180,'User1','2023-07-08 02:14:19',2,'MISE A JOUR','Mise à jours d\'un approvisionnement','APPROV20230708024943.101.100'),(181,'user1','2023-07-08 02:14:19',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(182,'user1','2023-07-08 02:15:04',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(183,'user1','2023-07-08 02:15:04',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(184,'user1','2023-07-08 02:15:52',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(185,'user1','2023-07-08 02:15:52',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(186,'User1','2023-07-08 02:16:24',1,'INSERTION','Insertion d\'un approvisionnement','APPROV20230708031624.212.202'),(187,'user1','2023-07-08 02:16:24',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(188,'user1','2023-07-08 02:17:44',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(189,'user1','2023-07-08 02:17:44',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(190,'user1','2023-07-08 02:18:36',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(191,'user1','2023-07-08 02:18:36',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(192,'user1','2023-07-08 02:19:26',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(193,'user1','2023-07-08 02:19:26',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(194,'user1','2023-07-08 02:20:50',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(195,'user1','2023-07-08 02:20:50',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(196,'user1','2023-07-08 02:21:26',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(197,'user1','2023-07-08 02:21:27',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(198,'user1','2023-07-08 02:21:27',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(199,'user1','2023-07-08 02:21:28',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(200,'user1','2023-07-08 02:21:29',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(201,'user1','2023-07-08 02:21:50',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(202,'user1','2023-07-08 02:21:50',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(203,'user1','2023-07-08 02:21:53',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(204,'user1','2023-07-08 02:21:59',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(205,'user1','2023-07-08 02:21:59',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(206,'dee','2023-07-08 02:22:16',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(207,'user1','2023-07-08 02:22:20',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(208,'user1','2023-07-08 02:34:48',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(209,'user1','2023-07-08 02:34:48',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(210,'user1','2023-07-08 02:34:50',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(211,'user1','2023-07-08 02:34:51',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(212,'user1','2023-07-08 02:34:51',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(213,'user1','2023-07-08 02:47:16',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(214,'user1','2023-07-08 02:47:16',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(215,'user1','2023-07-08 02:47:18',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(216,'user1','2023-07-08 02:47:18',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(217,'user1','2023-07-08 02:47:20',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(218,'dee','2023-07-08 02:47:21',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(219,'user1','2023-07-08 02:48:18',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(220,'user1','2023-07-08 02:48:21',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(221,'user1','2023-07-08 02:48:21',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(222,'user1','2023-07-08 02:48:24',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(223,'user1','2023-07-08 02:48:24',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(224,'dee','2023-07-08 03:22:20',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(225,'user1','2023-07-08 03:22:21',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(226,'user1','2023-07-08 03:22:22',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(227,'user1','2023-07-08 03:22:22',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(228,'user1','2023-07-08 03:22:24',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(229,'user1','2023-07-08 03:22:24',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(230,'dee','2023-07-08 20:10:24',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(231,'user1','2023-07-08 20:11:03',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(232,'user1','2023-07-08 20:11:03',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(233,'user1','2023-07-08 20:11:06',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(234,'user1','2023-07-08 20:11:06',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(235,'user1','2023-07-08 20:11:08',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(236,'user1','2023-07-08 20:20:05',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(237,'user1','2023-07-08 20:20:05',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(238,'dee','2023-07-11 10:35:45',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(239,'dee','2023-07-11 10:36:11',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(240,'user1','2023-07-11 10:39:00',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(241,'user1','2023-07-11 10:39:13',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(242,'user1','2023-07-11 10:39:17',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(243,'user1','2023-07-11 10:39:17',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(244,'user1','2023-07-11 10:39:19',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(245,'user1','2023-07-11 10:39:19',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(246,'User1','2023-07-11 10:39:40',1,'INSERTION','Insertion d\'un approvisionnement','APPROV20230711113940.102.221'),(247,'user1','2023-07-11 10:39:40',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(248,'User1','2023-07-11 10:40:04',2,'MISE A JOUR','Mise à jours d\'un approvisionnement','APPROV20230708030247.011.201'),(249,'user1','2023-07-11 10:40:04',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(250,'User1','2023-07-11 10:40:28',2,'MISE A JOUR','Mise à jours d\'un approvisionnement','APPROV20230708031624.212.202'),(251,'user1','2023-07-11 10:40:28',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(252,'user1','2023-07-11 10:40:31',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(253,'User1','2023-07-11 10:40:52',2,'MISE A JOUR','Mise à jours d\'un approvisionnement','APPROV20230708031624.212.202'),(254,'user1','2023-07-11 10:40:52',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(255,'user1','2023-07-11 10:41:02',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(256,'user1','2023-07-13 02:11:38',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(257,'dee','2023-08-04 20:30:37',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(258,NULL,'2023-08-04 20:30:49',2,'MISE A JOUR ORGANISATION','Mise à jours d\'une organisation','ORG20230707154336.110.111'),(259,'dee','2023-08-04 20:30:49',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(260,'user1','2023-08-04 20:31:21',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(261,'user1','2023-08-04 20:31:21',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(262,'user1','2023-08-04 20:31:57',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(263,'user1','2023-08-04 20:31:57',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(264,'user1','2023-08-04 20:32:05',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(265,'dee','2023-08-25 13:17:39',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(266,NULL,'2023-08-25 13:17:50',1,'INSERTION','Insertion d\'une organisation','ORG20230825141750.111.212'),(267,'dee','2023-08-25 13:17:50',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(268,'dee','2023-08-25 13:18:24',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(269,'user1','2023-08-25 13:18:32',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(270,'user1','2023-08-25 13:18:32',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(271,'user1','2023-08-25 19:43:39',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(272,'user1','2023-08-25 19:44:16',5,'CONSULTATION LISTE','Consultation de la liste des approvisionnements',NULL),(273,'user1','2023-08-25 19:44:16',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(274,'user1','2023-08-25 19:44:19',4,'CONSULTATION LISTE','Consultation de la liste des caisses',NULL),(275,'user1','2023-08-25 19:44:19',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(276,'user1','2023-08-25 19:44:20',3,'CONSULTATION LISTE','Consultation de la liste des salles',NULL),(277,'dee','2023-08-25 19:44:21',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(278,'dee','2023-09-02 22:04:51',3,'CONSULTATION LISTE','Consultation de la liste des organisations',NULL),(279,'USER','2023-10-13 11:57:42',1,'INSERTION','Insertion d\'une salle','TCHINGA'),(280,'ADMIN','2023-12-18 06:30:55',1,'INSERTION','Insertion d\'une salle','TSINGA');
/*!40000 ALTER TABLE `historique` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historiquetirage`
--

DROP TABLE IF EXISTS `historiquetirage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historiquetirage` (
  `historiqueTirageID` int(11) NOT NULL,
  `tirageID` varchar(50) DEFAULT NULL,
  `listeBouleTirer` varchar(200) DEFAULT NULL,
  `userID` varchar(50) DEFAULT NULL,
  `organisationID` varchar(50) DEFAULT NULL,
  `dateCreation` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`historiqueTirageID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historiquetirage`
--

LOCK TABLES `historiquetirage` WRITE;
/*!40000 ALTER TABLE `historiquetirage` DISABLE KEYS */;
/*!40000 ALTER TABLE `historiquetirage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mise`
--

DROP TABLE IF EXISTS `mise`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mise` (
  `miseID` varchar(50) NOT NULL,
  `ticketID` varchar(50) DEFAULT NULL,
  `optionID` varchar(50) DEFAULT NULL,
  `tirageID` varchar(50) DEFAULT NULL,
  `userID` varchar(50) DEFAULT NULL,
  `organisationID` varchar(50) DEFAULT NULL,
  `date_creation` datetime DEFAULT NULL,
  `listeBouleTires` varchar(50) DEFAULT NULL,
  `mise` double DEFAULT NULL,
  `gagner` tinyint(4) DEFAULT '0',
  `annuler` tinyint(4) DEFAULT '0',
  `cloturer` tinyint(4) DEFAULT '0',
  `gain` double DEFAULT NULL,
  `libelleOption` varchar(45) DEFAULT NULL,
  `avecMultiplicateur` tinyint(4) DEFAULT NULL,
  `turnoverID` varchar(45) DEFAULT NULL,
  `code_salle` varchar(45) DEFAULT NULL,
  `cote` double DEFAULT NULL,
  `etat` varchar(50) DEFAULT 'EN ATTENTE',
  `date_tirage` datetime DEFAULT NULL,
  `utilise` tinyint(4) DEFAULT NULL,
  `codebarre` varchar(50) DEFAULT NULL,
  `rang` int(11) DEFAULT NULL,
  `last_mise` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`miseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mise`
--

LOCK TABLES `mise` WRITE;
/*!40000 ALTER TABLE `mise` DISABLE KEYS */;
INSERT INTO `mise` VALUES ('MISE2024MISE0525151958000000001','SINGA2024052500000','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-25 15:19:58','44,55,66',200,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','TSINGA',NULL,'EN ATTENTE','2024-05-25 15:19:58',NULL,'1784165889',1,1),('MISE2024MISE0527033512000000002','0010022024052700000','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 03:35:11','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 03:35:11',NULL,'2456187865',1,0),('MISE2024MISE0527033512000000003','0010022024052700000','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 03:35:11','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 03:39:11',NULL,'2456187865',2,0),('MISE2024MISE0527033512000000004','0010022024052700000','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 03:35:11','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 03:43:11',NULL,'2456187865',3,1),('MISE2024MISE0527040905000000005','0010022024052700001','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:09:05','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 04:09:05',NULL,'7894938324',1,0),('MISE2024MISE0527040905000000006','0010022024052700001','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:09:05','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 04:13:05',NULL,'7894938324',2,0),('MISE2024MISE0527040906000000007','0010022024052700001','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:09:05','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 04:17:05',NULL,'7894938324',3,1),('MISE2024MISE0527041216000000008','0010022024052700002','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:12:16','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 04:12:16',NULL,'1011589580',1,0),('MISE2024MISE0527041216000000009','0010022024052700002','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:12:16','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 04:16:16',NULL,'1011589580',2,0),('MISE2024MISE0527041216000000010','0010022024052700002','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:12:16','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 04:20:16',NULL,'1011589580',3,1),('MISE2024MISE0527041242000000011','0010022024052700003','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:12:42','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 04:12:42',NULL,'4904431845',1,0),('MISE2024MISE0527041243000000012','0010022024052700003','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:12:42','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 04:16:42',NULL,'4904431845',2,0),('MISE2024MISE0527041243000000013','0010022024052700003','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:12:42','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 04:20:42',NULL,'4904431845',3,1),('MISE2024MISE0527041258000000014','0010022024052700004','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:12:58','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 04:12:58',NULL,'5169588423',1,0),('MISE2024MISE0527041258000000015','0010022024052700004','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:12:58','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 04:16:58',NULL,'5169588423',2,0),('MISE2024MISE0527041258000000016','0010022024052700004','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:12:58','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 04:20:58',NULL,'5169588423',3,1),('MISE2024MISE0527041431000000017','0010022024052700005','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:14:31','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 04:14:31',NULL,'1395306394',1,0),('MISE2024MISE0527041432000000018','0010022024052700005','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:14:31','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 04:18:31',NULL,'1395306394',2,0),('MISE2024MISE0527041432000000019','0010022024052700005','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:14:31','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 04:22:31',NULL,'1395306394',3,1),('MISE2024MISE0527041657000000020','0010022024052700006','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:16:57','1,13,8,9',66.66666666666667,0,0,0,2800,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',14,'EN ATTENTE','2024-05-27 04:16:57',NULL,'7179120820',1,0),('MISE2024MISE0527041657000000021','0010022024052700006','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:16:57','1,13,8,9',66.66666666666667,0,0,0,2800,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',14,'EN ATTENTE','2024-05-27 04:20:57',NULL,'7179120820',2,0),('MISE2024MISE0527041657000000022','0010022024052700006','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:16:57','1,13,8,9',66.66666666666667,0,0,0,2800,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',14,'EN ATTENTE','2024-05-27 04:24:57',NULL,'7179120820',3,1),('MISE2024MISE0527042929000000023','0010022024052700007','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:29:29','1,13,8,9',66.66666666666667,0,0,0,2800,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',14,'EN ATTENTE','2024-05-27 04:29:29',NULL,'2491663690',1,0),('MISE2024MISE0527042929000000024','0010022024052700007','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:29:29','1,13,8,9',66.66666666666667,0,0,0,2800,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',14,'EN ATTENTE','2024-05-27 04:33:29',NULL,'2491663690',2,0),('MISE2024MISE0527042929000000025','0010022024052700007','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:29:29','1,13,8,9',66.66666666666667,0,0,0,2800,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',14,'EN ATTENTE','2024-05-27 04:37:29',NULL,'2491663690',3,1),('MISE2024MISE0527043030000000026','0010022024052700008','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:30:30','1,13,8,9',66.66666666666667,0,0,0,2800,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',14,'EN ATTENTE','2024-05-27 04:30:30',NULL,'1916072603',1,0),('MISE2024MISE0527043030000000027','0010022024052700008','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:30:30','1,13,8,9',66.66666666666667,0,0,0,2800,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',14,'EN ATTENTE','2024-05-27 04:34:30',NULL,'1916072603',2,0),('MISE2024MISE0527043030000000028','0010022024052700008','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:30:30','1,13,8,9',66.66666666666667,0,0,0,2800,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',14,'EN ATTENTE','2024-05-27 04:38:30',NULL,'1916072603',3,1);
/*!40000 ALTER TABLE `mise` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `optionjeux`
--

DROP TABLE IF EXISTS `optionjeux`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `optionjeux` (
  `optionID` varchar(50) NOT NULL,
  `libelleOP` varchar(100) DEFAULT NULL,
  `dateCreation` varchar(50) DEFAULT NULL,
  `userID` varchar(50) DEFAULT NULL,
  `organisationID` varchar(50) DEFAULT NULL,
  `codeOption` varchar(10) NOT NULL,
  PRIMARY KEY (`optionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `optionjeux`
--

LOCK TABLES `optionjeux` WRITE;
/*!40000 ALTER TABLE `optionjeux` DISABLE KEYS */;
INSERT INTO `optionjeux` VALUES ('NONSORTANT','NON SORTANT','2023-10-13 16:58:36','USER',NULL,'NONSORTANT'),('SIMPLE','SIMPLE','2023-10-13 16:59:50','USER',NULL,'SIMPLE'),('TOUTOURIEN','TOUT OU RIEN','2023-10-13 17:00:11','USER',NULL,'TOUTOURIEN');
/*!40000 ALTER TABLE `optionjeux` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organisation`
--

DROP TABLE IF EXISTS `organisation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organisation` (
  `organisationID` varchar(50) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `parentID` varchar(50) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(50) DEFAULT NULL,
  `ip_update` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) DEFAULT NULL,
  `login` varchar(45) DEFAULT NULL,
  `motdepasse` varchar(45) DEFAULT NULL,
  `responsableID` varchar(45) DEFAULT NULL,
  `responsable` varchar(100) DEFAULT NULL,
  `actif` int(11) DEFAULT NULL,
  PRIMARY KEY (`organisationID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organisation`
--

LOCK TABLES `organisation` WRITE;
/*!40000 ALTER TABLE `organisation` DISABLE KEYS */;
INSERT INTO `organisation` VALUES ('ORG2023ORG1222102916000000001','SUPER1BET','ORG2023ORG1222102916000000001','2023-12-22 09:29:16',NULL,NULL,'2023-12-22 09:29:16',NULL,'JC','1234','USER2023USER1222102916000000004','JEAN CLAUDE',NULL),('ORG2024ORG0428165732000000002','SUPER GOAL','ORG2023ORG1222102916000000001','2024-04-28 15:57:32','ADMIN',NULL,'2024-04-28 15:57:32','ADMIN','RTCHINDA','test','USER2024USER0428165732000000005','TCHINDA RONALD',NULL);
/*!40000 ALTER TABLE `organisation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profil`
--

DROP TABLE IF EXISTS `profil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profil` (
  `profilID` varchar(50) NOT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_by` varchar(50) NOT NULL DEFAULT 'CURRENT_TIMESTAMP()',
  `user_update` varchar(50) NOT NULL DEFAULT 'CURRENT_TIMESTAMP()',
  `ip_update` varchar(50) NOT NULL DEFAULT 'CURRENT_TIMESTAMP()',
  PRIMARY KEY (`profilID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profil`
--

LOCK TABLES `profil` WRITE;
/*!40000 ALTER TABLE `profil` DISABLE KEYS */;
/*!40000 ALTER TABLE `profil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salle`
--

DROP TABLE IF EXISTS `salle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `salle` (
  `code_salle` varchar(50) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `ferme` int(11) DEFAULT '0',
  `userID` varchar(50) DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) DEFAULT NULL,
  `ip_update` varchar(50) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `organisationID` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`code_salle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salle`
--

LOCK TABLES `salle` WRITE;
/*!40000 ALTER TABLE `salle` DISABLE KEYS */;
INSERT INTO `salle` VALUES ('SALL01220NKOA','NKOABANG',0,'ADMIN','2024-04-29 20:10:08','2024-04-29 20:10:05',NULL,NULL,'NKOABANG','ORG2023ORG1222102916000000001');
/*!40000 ALTER TABLE `salle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp_mise`
--

DROP TABLE IF EXISTS `temp_mise`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `temp_mise` (
  `miseID` varchar(50) NOT NULL,
  `ticketID` varchar(50) DEFAULT NULL,
  `optionID` varchar(50) DEFAULT NULL,
  `tirageID` varchar(50) DEFAULT NULL,
  `userID` varchar(50) DEFAULT NULL,
  `organisationID` varchar(50) DEFAULT NULL,
  `date_creation` datetime DEFAULT NULL,
  `listeBouleTires` varchar(50) DEFAULT NULL,
  `mise` double DEFAULT NULL,
  `gagner` tinyint(4) DEFAULT '0',
  `annuler` tinyint(4) DEFAULT '0',
  `cloturer` tinyint(4) DEFAULT '0',
  `gain` double DEFAULT NULL,
  `libelleOption` varchar(45) DEFAULT NULL,
  `avecMultiplicateur` tinyint(4) DEFAULT NULL,
  `turnoverID` varchar(45) DEFAULT NULL,
  `code_salle` varchar(45) DEFAULT NULL,
  `cote` double DEFAULT NULL,
  `etat` varchar(50) DEFAULT 'EN ATTENTE',
  `date_tirage` datetime DEFAULT NULL,
  `utilise` tinyint(4) DEFAULT NULL,
  `codebarre` varchar(50) DEFAULT NULL,
  `rang` int(11) DEFAULT NULL,
  `last_mise` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`miseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_mise`
--

LOCK TABLES `temp_mise` WRITE;
/*!40000 ALTER TABLE `temp_mise` DISABLE KEYS */;
INSERT INTO `temp_mise` VALUES ('MISE2023MISE1223000303000000005','TICK202312231203037186386285','TOUTDEDANS',NULL,'ADMIN',NULL,'2023-12-23 00:02:37','2,13,',5000,0,0,0,18000,NULL,0,'TSINGA','TSINGA',3.6,'EN ATTENTE','2023-12-23 00:03:03',NULL,'455847724431',1,1),('MISE2023MISE1223003337000000010','TICK202312231233377521127347','SIMPLE',NULL,'ADMIN',NULL,'2023-12-23 00:33:02','4,5,45,36,37,27,',5000,0,0,0,NULL,'SIMPLE',0,'TSINGA','TSINGA',NULL,'EN ATTENTE','2023-12-23 00:33:37',NULL,'157043635043',1,1),('MISE2024MISE0525151958000000001','SINGA2024052500000','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-25 15:19:58','44,55,66',200,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','TSINGA',NULL,'EN ATTENTE','2024-05-25 15:19:58',NULL,'1784165889',1,1),('MISE2024MISE0527033512000000002','0010022024052700000','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 03:35:11','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 03:35:11',NULL,'2456187865',1,0),('MISE2024MISE0527033512000000003','0010022024052700000','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 03:35:11','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 03:39:11',NULL,'2456187865',2,0),('MISE2024MISE0527033512000000004','0010022024052700000','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 03:35:11','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 03:43:11',NULL,'2456187865',3,1),('MISE2024MISE0527040905000000005','0010022024052700001','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:09:05','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 04:09:05',NULL,'7894938324',1,0),('MISE2024MISE0527040905000000006','0010022024052700001','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:09:05','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 04:13:05',NULL,'7894938324',2,0),('MISE2024MISE0527040906000000007','0010022024052700001','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:09:05','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 04:17:05',NULL,'7894938324',3,1),('MISE2024MISE0527041216000000008','0010022024052700002','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:12:16','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 04:12:16',NULL,'1011589580',1,0),('MISE2024MISE0527041216000000009','0010022024052700002','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:12:16','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 04:16:16',NULL,'1011589580',2,0),('MISE2024MISE0527041216000000010','0010022024052700002','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:12:16','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 04:20:16',NULL,'1011589580',3,1),('MISE2024MISE0527041242000000011','0010022024052700003','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:12:42','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 04:12:42',NULL,'4904431845',1,0),('MISE2024MISE0527041243000000012','0010022024052700003','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:12:42','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 04:16:42',NULL,'4904431845',2,0),('MISE2024MISE0527041243000000013','0010022024052700003','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:12:42','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 04:20:42',NULL,'4904431845',3,1),('MISE2024MISE0527041258000000014','0010022024052700004','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:12:58','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 04:12:58',NULL,'5169588423',1,0),('MISE2024MISE0527041258000000015','0010022024052700004','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:12:58','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 04:16:58',NULL,'5169588423',2,0),('MISE2024MISE0527041258000000016','0010022024052700004','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:12:58','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 04:20:58',NULL,'5169588423',3,1),('MISE2024MISE0527041431000000017','0010022024052700005','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:14:31','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 04:14:31',NULL,'1395306394',1,0),('MISE2024MISE0527041432000000018','0010022024052700005','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:14:31','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 04:18:31',NULL,'1395306394',2,0),('MISE2024MISE0527041432000000019','0010022024052700005','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:14:31','1,13,8,9',66.66666666666667,0,0,0,NULL,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',NULL,'EN ATTENTE','2024-05-27 04:22:31',NULL,'1395306394',3,1),('MISE2024MISE0527041657000000020','0010022024052700006','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:16:57','1,13,8,9',66.66666666666667,0,0,0,2800,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',14,'EN ATTENTE','2024-05-27 04:16:57',NULL,'7179120820',1,0),('MISE2024MISE0527041657000000021','0010022024052700006','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:16:57','1,13,8,9',66.66666666666667,0,0,0,2800,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',14,'EN ATTENTE','2024-05-27 04:20:57',NULL,'7179120820',2,0),('MISE2024MISE0527041657000000022','0010022024052700006','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:16:57','1,13,8,9',66.66666666666667,0,0,0,2800,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',14,'EN ATTENTE','2024-05-27 04:24:57',NULL,'7179120820',3,1),('MISE2024MISE0527042929000000023','0010022024052700007','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:29:29','1,13,8,9',66.66666666666667,0,0,0,2800,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',14,'EN ATTENTE','2024-05-27 04:29:29',NULL,'2491663690',1,0),('MISE2024MISE0527042929000000024','0010022024052700007','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:29:29','1,13,8,9',66.66666666666667,0,0,0,2800,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',14,'EN ATTENTE','2024-05-27 04:33:29',NULL,'2491663690',2,0),('MISE2024MISE0527042929000000025','0010022024052700007','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:29:29','1,13,8,9',66.66666666666667,0,0,0,2800,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',14,'EN ATTENTE','2024-05-27 04:37:29',NULL,'2491663690',3,1),('MISE2024MISE0527043030000000026','0010022024052700008','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:30:30','1,13,8,9',66.66666666666667,0,0,0,2800,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',14,'EN ATTENTE','2024-05-27 04:30:30',NULL,'1916072603',1,0),('MISE2024MISE0527043030000000027','0010022024052700008','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:30:30','1,13,8,9',66.66666666666667,0,0,0,2800,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',14,'EN ATTENTE','2024-05-27 04:34:30',NULL,'1916072603',2,0),('MISE2024MISE0527043030000000028','0010022024052700008','TOUTOURIEN',NULL,'ADMIN',NULL,'2024-05-27 04:30:30','1,13,8,9',66.66666666666667,0,0,0,2800,'TOUT OU RIEN',0,'SALL01220NKOA','O001002',14,'EN ATTENTE','2024-05-27 04:38:30',NULL,'1916072603',3,1);
/*!40000 ALTER TABLE `temp_mise` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp_params`
--

DROP TABLE IF EXISTS `temp_params`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `temp_params` (
  `code_salle` varchar(50) NOT NULL,
  `cagnotte` varchar(45) DEFAULT NULL,
  `multiplicateur` double DEFAULT NULL,
  `jackpot` varchar(45) DEFAULT NULL,
  `megajackpot` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`code_salle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_params`
--

LOCK TABLES `temp_params` WRITE;
/*!40000 ALTER TABLE `temp_params` DISABLE KEYS */;
INSERT INTO `temp_params` VALUES ('TSINGA','\'Moto\'',5,NULL,NULL);
/*!40000 ALTER TABLE `temp_params` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ticket` (
  `ticketID` varchar(50) NOT NULL,
  `code_salle` varchar(50) DEFAULT NULL,
  `nbre_tirage` int(11) DEFAULT NULL,
  `mise_total` double DEFAULT NULL,
  `date_creation` datetime DEFAULT NULL,
  `annuler` tinyint(4) DEFAULT '0',
  `cloturer` tinyint(4) DEFAULT '0',
  `userID` varchar(50) DEFAULT NULL,
  `organisationID` varchar(50) DEFAULT NULL,
  `payer` tinyint(4) DEFAULT '0',
  `codebarre` varchar(45) DEFAULT NULL,
  `codepaiement` varchar(45) DEFAULT NULL,
  `avec_multiplicateur` tinyint(4) DEFAULT '0',
  `gains_max` double DEFAULT NULL,
  `gains_min` double DEFAULT NULL,
  PRIMARY KEY (`ticketID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
INSERT INTO `ticket` VALUES ('0010022024052700000','O001002',3,200,'2024-05-27 03:35:12',0,0,'ADMIN',NULL,0,'2456187865',NULL,0,NULL,NULL),('0010022024052700001','O001002',3,200,'2024-05-27 04:09:05',0,0,'ADMIN',NULL,0,'7894938324',NULL,0,NULL,NULL),('0010022024052700002','O001002',3,200,'2024-05-27 04:12:16',0,0,'ADMIN',NULL,0,'1011589580',NULL,0,NULL,NULL),('0010022024052700003','O001002',3,200,'2024-05-27 04:12:42',0,0,'ADMIN',NULL,0,'4904431845',NULL,0,NULL,NULL),('0010022024052700004','O001002',3,200,'2024-05-27 04:12:58',0,0,'ADMIN',NULL,0,'5169588423',NULL,0,NULL,NULL),('0010022024052700005','O001002',3,200,'2024-05-27 04:14:31',0,0,'ADMIN',NULL,0,'1395306394',NULL,0,NULL,NULL),('0010022024052700006','O001002',3,200,'2024-05-27 04:16:57',0,0,'ADMIN',NULL,0,'7179120820',NULL,0,NULL,NULL),('0010022024052700007','O001002',3,200,'2024-05-27 04:29:29',0,0,'ADMIN',NULL,0,'2491663690',NULL,0,NULL,NULL),('0010022024052700008','O001002',3,200,'2024-05-27 04:30:30',0,0,'ADMIN',NULL,0,'1916072603',NULL,0,NULL,NULL);
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_historique`
--

DROP TABLE IF EXISTS `ticket_historique`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ticket_historique` (
  `ticketID` varchar(50) NOT NULL,
  `code_salle` varchar(50) DEFAULT NULL,
  `nbre_tirage` int(11) DEFAULT NULL,
  `mise_total` double DEFAULT NULL,
  `date_creation` datetime DEFAULT NULL,
  `annuler` tinyint(4) DEFAULT '0',
  `cloturer` tinyint(4) DEFAULT '0',
  `userID` varchar(50) DEFAULT NULL,
  `organisationID` varchar(50) DEFAULT NULL,
  `payer` tinyint(4) DEFAULT '0',
  `codebarre` varchar(45) DEFAULT NULL,
  `codepaiement` varchar(45) DEFAULT NULL,
  `avec_multiplicateur` tinyint(4) DEFAULT '0',
  `gains_max` double DEFAULT NULL,
  `gains_min` double DEFAULT NULL,
  `turnover` double DEFAULT NULL,
  `cycle` int(11) DEFAULT NULL,
  `cagnotte` varchar(200) DEFAULT NULL,
  `win_cagnotte` tinyint(4) DEFAULT NULL,
  `jackpot` double DEFAULT NULL,
  `win_jackpot` tinyint(4) DEFAULT NULL,
  `megajackpot` double DEFAULT NULL,
  `win_megajackpot` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`ticketID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_historique`
--

LOCK TABLES `ticket_historique` WRITE;
/*!40000 ALTER TABLE `ticket_historique` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_historique` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tirage`
--

DROP TABLE IF EXISTS `tirage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tirage` (
  `TirageID` varchar(50) NOT NULL,
  `userID` varchar(50) DEFAULT NULL,
  `organisationID` varchar(50) DEFAULT NULL,
  `date_creation` datetime DEFAULT NULL,
  `listeBoulesTires` varchar(200) DEFAULT NULL,
  `multiplicateur` double DEFAULT NULL,
  `jackpot` varchar(50) DEFAULT NULL,
  `dateDebut` datetime DEFAULT NULL,
  `dateFin` datetime DEFAULT NULL,
  `dateDebutSys` datetime DEFAULT NULL,
  `dateFinSys` datetime DEFAULT NULL,
  `code_salle` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`TirageID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tirage`
--

LOCK TABLES `tirage` WRITE;
/*!40000 ALTER TABLE `tirage` DISABLE KEYS */;
INSERT INTO `tirage` VALUES ('TIRA202312220910222726332007',NULL,NULL,'2023-12-22 21:10:22','67,36,56,11,47,43,73,76,80,13,62,31,48,68,35,51,69,34,42,25,',NULL,NULL,'2023-12-22 21:25:21','2023-12-22 21:28:21','2023-12-22 21:10:22','2023-12-22 21:13:22','TSINGA'),('TIRA202312220914204567124086',NULL,NULL,'2023-12-22 21:14:20','26,63,79,47,76,2,18,34,6,4,77,60,70,11,3,59,48,9,16,50,',NULL,NULL,'2023-12-22 21:29:18','2023-12-22 21:32:18','2023-12-22 21:14:20','2023-12-22 21:17:20','TSINGA'),('TIRA202312221107344428127221',NULL,NULL,'2023-12-22 23:07:34',NULL,NULL,NULL,'2023-12-22 23:07:33','2023-12-22 23:10:33','2023-12-22 23:07:34','2023-12-22 23:10:34','TSINGA'),('TIRA202312221108193443750430',NULL,NULL,'2023-12-22 23:08:19','50,62,2,60,54,11,52,68,25,77,71,46,17,23,65,16,41,79,34,10,',NULL,NULL,'2023-12-22 23:23:18','2023-12-22 23:26:18','2023-12-22 23:08:19','2023-12-22 23:11:19','TSINGA'),('TIRA202312221112163236178444',NULL,NULL,'2023-12-22 23:12:17','6,30,55,25,36,28,29,60,54,9,39,10,20,70,50,38,42,16,31,26,',NULL,NULL,'2023-12-22 23:27:15','2023-12-22 23:30:15','2023-12-22 23:12:17','2023-12-22 23:15:17','TSINGA'),('TIRA202312221116145331021564',NULL,NULL,'2023-12-22 23:16:14','2,31,67,6,66,71,79,21,24,59,62,54,2,8,32,16,74,4,34,55,',NULL,NULL,'2023-12-22 23:31:13','2023-12-22 23:34:13','2023-12-22 23:16:14','2023-12-22 23:19:14','TSINGA'),('TIRA202312221120123238604457',NULL,NULL,'2023-12-22 23:20:12','25,13,66,54,72,36,45,43,26,79,78,73,47,65,27,19,11,77,34,18,',NULL,NULL,'2023-12-22 23:35:10','2023-12-22 23:38:10','2023-12-22 23:20:12','2023-12-22 23:23:12','TSINGA'),('TIRA202312221124093503682638',NULL,NULL,'2023-12-22 23:24:09','43,12,7,78,51,19,22,53,38,28,29,57,39,25,4,32,6,14,48,40,',NULL,NULL,'2023-12-22 23:39:08','2023-12-22 23:42:08','2023-12-22 23:24:09','2023-12-22 23:27:09','TSINGA'),('TIRA202312221128076237570500',NULL,NULL,'2023-12-22 23:28:07','62,64,53,73,48,21,37,44,26,77,69,35,42,27,6,14,43,17,32,28,',NULL,NULL,'2023-12-22 23:43:06','2023-12-22 23:46:06','2023-12-22 23:28:07','2023-12-22 23:31:07','TSINGA'),('TIRA202312221130384643732322',NULL,NULL,'2023-12-22 23:30:38',NULL,NULL,NULL,'2023-12-22 23:30:38','2023-12-22 23:33:38','2023-12-22 23:30:38','2023-12-22 23:33:38','TSINGA'),('TIRA202312221132057262500886',NULL,NULL,'2023-12-22 23:32:05','50,69,38,58,20,2,29,44,45,15,18,8,63,52,71,41,68,5,11,36,',NULL,NULL,'2023-12-22 23:47:03','2023-12-22 23:50:03','2023-12-22 23:32:05','2023-12-22 23:35:05','TSINGA'),('TIRA202312221136023233235154',NULL,NULL,'2023-12-22 23:36:02','43,54,61,62,48,50,30,75,49,16,15,23,70,45,13,7,39,28,3,10,',NULL,NULL,'2023-12-22 23:51:01','2023-12-22 23:54:01','2023-12-22 23:36:02','2023-12-22 23:39:02','TSINGA'),('TIRA202312221140007713813037',NULL,NULL,'2023-12-22 23:40:00','66,26,10,48,53,40,41,3,52,75,59,70,11,5,68,9,77,39,45,28,',NULL,NULL,'2023-12-22 23:54:59','2023-12-22 23:57:59','2023-12-22 23:40:00','2023-12-22 23:43:00','TSINGA'),('TIRA202312221143585605056141',NULL,NULL,'2023-12-22 23:43:58','45,17,27,4,74,77,8,42,26,6,28,43,50,58,15,55,73,67,49,45,',NULL,NULL,'2023-12-22 23:58:56','2023-12-23 00:01:56','2023-12-22 23:43:58','2023-12-22 23:46:58','TSINGA'),('TIRA202312221147555178275622',NULL,NULL,'2023-12-22 23:47:55','7,26,33,5,6,11,38,77,32,7,17,62,20,74,69,44,10,36,30,40,',NULL,NULL,'2023-12-23 00:02:54','2023-12-23 00:05:54','2023-12-22 23:47:55','2023-12-22 23:50:55','TSINGA'),('TIRA202312221151537267404157',NULL,NULL,'2023-12-22 23:51:53','4,47,66,28,22,25,59,62,50,64,9,13,37,67,63,33,56,23,43,70,',NULL,NULL,'2023-12-23 00:06:52','2023-12-23 00:09:52','2023-12-22 23:51:53','2023-12-22 23:54:53','TSINGA'),('TIRA202312221155511656665172',NULL,NULL,'2023-12-22 23:55:51','54,20,19,32,23,29,7,14,78,33,9,22,5,38,15,65,52,62,42,55,',NULL,NULL,'2023-12-23 00:10:49','2023-12-23 00:13:49','2023-12-22 23:55:51','2023-12-22 23:58:51','TSINGA'),('TIRA202312221159482778814172',NULL,NULL,'2023-12-22 23:59:48','12,40,6,65,72,5,46,54,53,25,42,57,80,67,14,27,15,78,12,64,',NULL,NULL,'2023-12-23 00:14:47','2023-12-23 00:17:47','2023-12-22 23:59:48','2023-12-23 00:02:48','TSINGA'),('TIRA202312230100301231150586',NULL,NULL,'2023-12-23 01:00:30','36,63,51,62,77,42,54,66,10,8,11,29,33,75,37,41,12,15,40,74,',NULL,NULL,'2023-12-23 01:00:30','2023-12-23 01:03:30','2023-12-23 01:00:30','2023-12-23 01:03:30','TSINGA'),('TIRA202312230101554353826322',NULL,NULL,'2023-12-23 01:01:55','16,8,71,14,12,18,54,56,37,17,53,52,23,38,40,7,72,22,49,45,',NULL,NULL,'2023-12-23 01:16:54','2023-12-23 01:19:54','2023-12-23 01:01:55','2023-12-23 01:04:55','TSINGA'),('TIRA202312230104274154506160',NULL,NULL,'2023-12-23 01:04:27',NULL,NULL,NULL,'2023-12-23 01:04:27','2023-12-23 01:07:27','2023-12-23 01:04:27','2023-12-23 01:07:27','TSINGA'),('TIRA202312230105534444028345',NULL,NULL,'2023-12-23 01:05:53',NULL,NULL,NULL,'2023-12-23 01:20:52','2023-12-23 01:23:52','2023-12-23 01:05:53','2023-12-23 01:08:53','TSINGA'),('TIRA202312231203463341058531',NULL,NULL,'2023-12-23 00:03:46','41,34,46,47,18,28,4,15,63,30,41,36,55,8,32,20,13,2,52,78,',NULL,NULL,'2023-12-23 00:18:45','2023-12-23 00:21:45','2023-12-23 00:03:46','2023-12-23 00:06:46','TSINGA'),('TIRA202312231207446634641140',NULL,NULL,'2023-12-23 00:07:44','59,51,78,77,68,32,35,76,36,31,45,54,56,37,18,59,13,58,16,42,',NULL,NULL,'2023-12-23 00:22:43','2023-12-23 00:25:43','2023-12-23 00:07:44','2023-12-23 00:10:44','TSINGA'),('TIRA202312231211427546511612',NULL,NULL,'2023-12-23 00:11:42','70,45,15,17,37,54,2,5,19,77,11,59,24,20,28,65,13,12,3,57,',NULL,NULL,'2023-12-23 00:26:40','2023-12-23 00:29:40','2023-12-23 00:11:42','2023-12-23 00:14:42','TSINGA'),('TIRA202312231222408800272330',NULL,NULL,'2023-12-23 00:22:40',NULL,NULL,NULL,'2023-12-23 00:22:40','2023-12-23 00:25:40','2023-12-23 00:22:40','2023-12-23 00:25:40','TSINGA'),('TIRA202312231230125185558243',NULL,NULL,'2023-12-23 00:30:12','4,78,61,68,77,22,37,76,29,53,36,4,23,43,69,54,64,40,42,12,',NULL,NULL,'2023-12-23 00:45:11','2023-12-23 00:48:11','2023-12-23 00:30:12','2023-12-23 00:33:12','TSINGA'),('TIRA202312231234104525158247',NULL,NULL,'2023-12-23 00:34:10','24,31,2,73,45,3,36,14,40,76,24,49,15,6,61,50,66,21,64,19,',NULL,NULL,'2023-12-23 00:49:09','2023-12-23 00:52:09','2023-12-23 00:34:10','2023-12-23 00:37:10','TSINGA'),('TIRA202312231237461065377628',NULL,NULL,'2023-12-23 00:37:46','80,45,61,13,39,77,30,55,42,44,15,20,53,46,70,52,21,27,74,48,',NULL,NULL,'2023-12-23 00:37:46','2023-12-23 00:40:46','2023-12-23 00:37:46','2023-12-23 00:40:46','TSINGA'),('TIRA202312231238081316140615',NULL,NULL,'2023-12-23 00:38:08','73,59,77,48,10,60,35,72,16,22,71,19,37,51,63,1,54,29,61,34,',NULL,NULL,'2023-12-23 00:53:07','2023-12-23 00:56:07','2023-12-23 00:38:08','2023-12-23 00:41:08','TSINGA'),('TIRA202312231242068684566746',NULL,NULL,'2023-12-23 00:42:06','24,25,48,9,57,20,7,53,33,65,64,46,37,45,34,69,3,44,52,49,',NULL,NULL,'2023-12-23 00:57:05','2023-12-23 01:00:05','2023-12-23 00:42:06','2023-12-23 00:45:06','TSINGA'),('TIRA202312231242255627276134',NULL,NULL,'2023-12-23 00:42:25','67,5,58,36,6,77,53,32,1,66,10,11,21,73,62,25,14,71,22,57,',NULL,NULL,'2023-12-23 00:42:25','2023-12-23 00:45:25','2023-12-23 00:42:25','2023-12-23 00:45:25','TSINGA'),('TIRA202312231246043624221714',NULL,NULL,'2023-12-23 00:46:04','59,51,79,5,23,18,60,73,25,62,76,35,26,27,29,65,72,37,46,40,',NULL,NULL,'2023-12-23 01:01:02','2023-12-23 01:04:02','2023-12-23 00:46:04','2023-12-23 00:49:04','TSINGA'),('TIRA202312231250010857627274',NULL,NULL,'2023-12-23 00:50:01','44,77,12,68,63,33,53,8,38,7,76,45,73,65,26,11,58,20,2,28,',NULL,NULL,'2023-12-23 01:05:00','2023-12-23 01:08:00','2023-12-23 00:50:01','2023-12-23 00:53:01','TSINGA'),('TIRA202312231254005106822006',NULL,NULL,'2023-12-23 00:54:00','70,10,79,45,67,43,11,4,65,75,20,34,27,35,15,23,57,56,31,72,',NULL,NULL,'2023-12-23 01:08:58','2023-12-23 01:11:58','2023-12-23 00:54:00','2023-12-23 00:57:00','TSINGA'),('TIRA202312231256323478087130',NULL,NULL,'2023-12-23 00:56:32','10,15,44,16,24,72,51,36,29,34,5,78,60,66,69,42,12,22,75,39,',NULL,NULL,'2023-12-23 00:56:32','2023-12-23 00:59:32','2023-12-23 00:56:32','2023-12-23 00:59:32','TSINGA'),('TIRA202312231257571437185616',NULL,NULL,'2023-12-23 00:57:57','69,2,37,21,73,64,20,67,35,52,74,56,55,30,62,61,40,15,49,60,',NULL,NULL,'2023-12-23 01:12:56','2023-12-23 01:15:56','2023-12-23 00:57:57','2023-12-23 01:00:57','TSINGA'),('TIRA202312250916361017687000',NULL,NULL,'2023-12-25 09:16:37',NULL,NULL,NULL,'2023-12-25 09:16:35','2023-12-25 09:19:35','2023-12-25 09:16:37','2023-12-25 09:19:37','TSINGA'),('TIRA202312250917425005655015',NULL,NULL,'2023-12-25 09:17:42',NULL,NULL,NULL,'2023-12-25 09:17:42','2023-12-25 09:20:42','2023-12-25 09:17:42','2023-12-25 09:20:42','TSINGA'),('TIRA202312250919120508034068',NULL,NULL,'2023-12-25 09:19:12','42,58,3,76,55,47,70,26,66,16,37,59,24,21,32,17,68,50,5,40,',NULL,NULL,'2023-12-25 09:19:12','2023-12-25 09:22:12','2023-12-25 09:19:12','2023-12-25 09:22:12','TSINGA'),('TIRA202312250923097187584726',NULL,NULL,'2023-12-25 09:23:09','7,79,55,37,19,62,16,51,48,8,53,3,12,50,43,52,18,25,75,5,',NULL,NULL,'2023-12-25 09:23:09','2023-12-25 09:26:09','2023-12-25 09:23:09','2023-12-25 09:26:09','TSINGA'),('TIRA202312250927078525226310',NULL,NULL,'2023-12-25 09:27:07','43,60,13,43,17,32,29,48,75,72,52,46,74,71,55,54,11,51,64,8,',NULL,NULL,'2023-12-25 09:27:07','2023-12-25 09:30:07','2023-12-25 09:27:07','2023-12-25 09:30:07','TSINGA'),('TIRA202312250931042503814878',NULL,NULL,'2023-12-25 09:31:04','11,75,22,42,63,29,35,10,78,48,54,45,64,25,9,50,65,13,28,23,',NULL,NULL,'2023-12-25 09:31:04','2023-12-25 09:34:04','2023-12-25 09:31:04','2023-12-25 09:34:04','TSINGA'),('TIRA202312280825128345281810',NULL,NULL,'2023-12-28 08:25:12','58,69,13,16,41,76,18,19,42,70,67,45,23,60,6,61,48,57,49,66,',NULL,NULL,'2023-12-28 08:25:10','2023-12-28 08:28:10','2023-12-28 08:25:12','2023-12-28 08:28:12','TSINGA'),('TIRA202312280829086627481307',NULL,NULL,'2023-12-28 08:29:08',NULL,NULL,NULL,'2023-12-28 08:29:08','2023-12-28 08:32:08','2023-12-28 08:29:08','2023-12-28 08:32:08','TSINGA'),('TIRA202312280830486180788510',NULL,NULL,'2023-12-28 08:30:48','16,71,60,7,12,37,6,52,29,48,73,61,5,79,64,2,56,34,55,38,',NULL,NULL,'2023-12-28 08:30:48','2023-12-28 08:33:48','2023-12-28 08:30:48','2023-12-28 08:33:48','TSINGA'),('TIRA202312280834456660865751',NULL,NULL,'2023-12-28 08:34:45','78,5,29,50,33,69,6,60,45,9,67,70,57,76,51,26,53,65,72,37,',NULL,NULL,'2023-12-28 08:34:45','2023-12-28 08:37:45','2023-12-28 08:34:45','2023-12-28 08:37:45','TSINGA'),('TIRA202312280838438717718807',NULL,NULL,'2023-12-28 08:38:43',NULL,NULL,NULL,'2023-12-28 08:38:43','2023-12-28 08:41:43','2023-12-28 08:38:43','2023-12-28 08:41:43','TSINGA');
/*!40000 ALTER TABLE `tirage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `turnover`
--

DROP TABLE IF EXISTS `turnover`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `turnover` (
  `turn_over` double DEFAULT NULL,
  `userID` varchar(50) DEFAULT NULL,
  `organisationID` varchar(50) DEFAULT NULL,
  `date_creation` varchar(50) DEFAULT NULL,
  `cycle` int(11) DEFAULT NULL,
  `montantcycle` double DEFAULT NULL,
  `code_salle` varchar(45) NOT NULL,
  PRIMARY KEY (`code_salle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turnover`
--

LOCK TABLES `turnover` WRITE;
/*!40000 ALTER TABLE `turnover` DISABLE KEYS */;
INSERT INTO `turnover` VALUES (1400,'ADMIN','ORG2023ORG1222102916000000001','2024-04-28 20:21:48',142,24000,'SALL01220NKOA');
/*!40000 ALTER TABLE `turnover` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `userID` varchar(50) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `pasword` varchar(50) DEFAULT NULL,
  `profilID` varchar(50) DEFAULT NULL,
  `actif` tinyint(4) DEFAULT NULL,
  `code_salle` varchar(45) DEFAULT NULL,
  `organisationID` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('ADMIN','Jean Claude','','ADMIN','super1bet2021',NULL,1,'TSINGA','ORG2023ORG1222102916000000001'),('USER2023USER1222101236000000002','ssd',NULL,'dsd','ds','PARTENAIRE',1,NULL,'ORG2023ORG1222102916000000001'),('USER2023USER1222101519000000003','JEAN CLAUDE',NULL,'JC','1234','PARTENAIRE',1,NULL,'ORG2023ORG1222102916000000001'),('USER2023USER1222102916000000004','JEAN CLAUDE',NULL,'JC','1234','PARTENAIRE',1,NULL,'ORG2023ORG1222102916000000001'),('USER2024USER0428165732000000005','TCHINDA RONALD',NULL,'RTCHINDA','test','PARTENAIRE',1,NULL,'ORG2024ORG0428165732000000002');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'kenodb'
--

--
-- Dumping routines for database 'kenodb'
--
/*!50003 DROP FUNCTION IF EXISTS `fnGenere_Boule` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE FUNCTION `fnGenere_Boule`() RETURNS varchar(1000) CHARSET latin1
BEGIN
         declare _taille int;
    declare _serepete tinyint;
    declare _numBoule int;
     declare _val varchar(15);
    declare _listeBoule varchar(1000);
    set _taille=1;
    set _listeBoule='';
    while _taille<=20
        do
			set _serepete=false;
            set _numBoule = ROUND( RAND() * 79 ) + 1 ;
            set _val=concat(',',convert(_numBoule,CHAR(5)),',');
            if instr(_listeBoule, _val)=0 then
				if _listeBoule='' then
					set _listeBoule = concat(convert(_numBoule,CHAR(5)),',');
				else
					set _listeBoule =concat( _listeBoule , convert(_numBoule,CHAR(5)),',');
                end if;
				set _taille = _taille + 1;
                
            end if;
	end while; 
RETURN _listeBoule;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `fnGenere_ID` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE FUNCTION `fnGenere_ID`(codeTable varchar(4),taille int) RETURNS varchar(50) CHARSET latin1
BEGIN
	declare ID varchar(50);
    declare machaine varchar(9);
    set machaine='';
    set ID='';
    set machaine=convert(taille+1,CHAR);
    while length(machaine)<>9
    do
       set machaine=concat('0',machaine);
    end while;
	set ID=concat(codeTable,date_format(now(),'%Y'),codeTable,date_format(now(),'%m%d%H%i%s'),machaine);
RETURN ID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `fn_count` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE FUNCTION `fn_count`(chaine varchar(2000),sep varchar(1)) RETURNS int(11)
BEGIN
     declare result int;
     set result=0;
     while(instr(chaine,sep)>0)
     do
         set result=result+1;
         set chaine=substring(chaine,instr(chaine,',')+1);
     end while;
RETURN result;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `fn_date_cameroon` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE FUNCTION `fn_date_cameroon`() RETURNS varchar(30) CHARSET latin1
BEGIN
      declare _madate varchar(30);
      set _madate=(select current_timestamp());
RETURN _madate;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `fn_genere_barrecode` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE FUNCTION `fn_genere_barrecode`(_code_salle varchar(20)) RETURNS varchar(10) CHARSET latin1
BEGIN
     declare _codebarre varchar(10);
     set _codebarre=(lpad(cast(floor(rand()*pow(16,10))as char),10,'0'));
     while(exists(select * from ticket where codebarre=_codebarre and code_salle=_code_salle))
	 do
        set _codebarre=(lpad(cast(floor(rand()*pow(16,10))as char),10,'0'));
     end while;
RETURN _codebarre;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psAlgoDistribution` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psAlgoDistribution`(_code_salle varchar(50),_tirageID varchar(50))
BEGIN

    -- DECLARATION DES VARIABLES RETOURS --
   	declare _listeBoule varchar(200);
    declare _multiplicateur varchar(100);
    declare _cagnotte varchar(100);
    declare _jackpot varchar(100);
    declare _megajackpot varchar(100);
	declare _wincagnotte varchar(1);
    
    -- DECLARATION DE VARIABLES POUR GENERATION DE BOULES --
    declare _serepete boolean;
    declare _numBoule int;
	declare _taille int;
    declare _combinaisonParfaite boolean;
    
    -- DECLARATION DE VARIABLES POUR PARCOURIR TEMP_MISE --
	declare _miseID varchar(50);
	declare _ticketID varchar(50);
	declare _dateCreation datetime;
	declare _codeOption varchar(50);
	declare _listeBouleTire varchar(200);
    declare _avec_multiplicateur tinyint;
    declare _last_mise tinyint;
    
    -- DECLARE VARIABLES POUR OPTIONS --
    declare _listeBouleR varchar(200);
	declare _bouleR varchar(2);
	declare _nbreBoule int;
    declare _cote double;
    
    -- DECLARATION DE VARIABLES POUR CALCUL
    declare _gain double;
    declare _total_gains double;
    declare _mise double;
    declare _total_mises double;
    declare _solde_du_cycle double;
    declare _total_turnover double;
    declare _turnover double;
    declare _total double;
    declare _total_O double;
    declare _total_O_min double;
    declare _total_O_max double;
    declare _jackpot_rate double;
    declare _jackpot_retire_sur_mise double;
    declare _jackpot_solde double;
    declare _jackpot_min double;
    declare _jackpot_max double;
    declare _jackpot_win tinyint;
    declare _dateDebutTirage datetime;
    declare _dateFinTirage datetime;
	declare _dateDebutTirageSys datetime;
    declare _dateFinTirageSys datetime;
    
    delete from temp_params where code_salle=_code_salle;
    
    -- INITIALISATION DES VARIABLES POUR GENERATION DE BOULES --
    set _combinaisonParfaite=false;
    
    set _dateDebutTirage=(select dateDebut from tirage where tirageID=_tirageID);
    set _dateFinTirage=(select dateFin from tirage where tirageID=_tirageID);
    
	set _dateDebutTirageSys=(select dateDebutSys from tirage where tirageID=_tirageID);
    set _dateFinTirageSys=(select dateFinSys from tirage where tirageID=_tirageID);
    
    -- REGENERER LES BOULES JUSQU'A AVOIR UNE CONDITION FAVORABLE --
    while(_combinaisonParfaite=false)
    do	
    
		set _taille=1;
        
        -- MULTIPLICATEUR 
        set _multiplicateur=floor(0+(rand()*(3-0+1))); 
        if _multiplicateur=0 then
           set _multiplicateur=0.5;
		elseif _multiplicateur=3 then
           set _multiplicateur=5;
        end if; 
        
        -- GENERATION DE 20 BOULES DE FACON ALEATOIRE
        set _listeBoule=(select fnGenere_Boule());
	
        -- INITIALISE LES MISES DU TIRAGE ACTUEL POUR PARCOURIR LA TABLE TEMP_MISE --
        update temp_mise set utilise=false where date_tirage between _dateDebutTirageSys and _dateFinTirageSys; 
        set _total_gains=0;
        set _total_mises=0; 
        
        -- PARCOURIR TEMP_MISE --
        while exists(select * from temp_mise where utilise=false and (date_tirage between _dateDebutTirageSys and _dateFinTirageSys))
        do
            set _mise=0;
            set _gain=0;
            set _miseID=(select miseID  from temp_mise where utilise=false and date_tirage between _dateDebutTirageSys and _dateFinTirageSys limit 1);
			set _dateCreation=(select date_creation  from temp_mise where utilise=false and date_tirage between _dateDebutTirageSys and _dateFinTirageSys limit 1);
			set _codeOption=(select optionID  from temp_mise where utilise=false and date_tirage between _dateDebutTirageSys and _dateFinTirageSys limit 1);
			set _listeBouleTire=(select listeBouleTires  from temp_mise where utilise=false and date_tirage between _dateDebutTirageSys and _dateFinTirageSys limit 1);
			set _mise=(select mise from temp_mise where utilise=false and date_tirage between _dateDebutTirageSys and _dateFinTirageSys limit 1);
            set _last_mise=(select last_mise from temp_mise where utilise=false and date_tirage between _dateDebutTirageSys and _dateFinTirageSys limit 1);
            set _avec_multiplicateur=(select avecMultiplicateur from temp_mise where utilise=false and date_tirage between _dateDebutTirageSys and _dateFinTirageSys limit 1);

            set _total_mises=_total_mises+_mise;  
            
            -- OPTION NON SORTANT --
            if _codeOption='NONSORTANT' then   
				update temp_mise set gagner=true where miseID=_miseID;
                set _listeBouleR=_listeBouleTire;
                set _bouleR=substring(_listeBouleR,1,(instr(_listeBouleR,',')-1));
				while(_listeBouleR<>'')
                do
                    if(instr(_listeBoule,_bouleR)>0)
                    then
						 update temp_mise set gagner=false where miseID=_miseID;
					else
                         -- LORSQUE LA MISE A GAGNE
						 set _gain=(select gain from temp_mise where miseID=_miseID);
                         if (_avec_multiplicateur=true)then
                            set _gain=_gain*_multiplicateur;
							update temp_mise set gain=_gain where miseID=_miseID;
						 end if;
                         set _total_gains=_total_gains+_gain;
                    end if;
					set _listeBouleR=substring(_listeBouleR,instr(_listeBouleR,',')+1);
                end while;
			elseif _codeOption='TOUTOURIEN' then
				set _nbreBoule=0;
                set _listeBouleR=_listeBouleTire;
                set _bouleR=substring(_listeBouleR,1,(instr(_listeBouleR,',')-1));
				while(_listeBouleR<>'')
                do
                    if(instr(_listeBoule,_bouleR)>0)
                    then
						 set _nbreBoule=_nbreBoule+1;
                    end if;
					set _listeBouleR=substring(_listeBouleR,instr(_listeBouleR,',')+1);
                end while;
                -- LORSQUE LA MISE A GAGNE
                if(_nbreBoule=fn_count(_listeBouleTire,','))
				then
					 update temp_mise set gagner=true where miseID=_miseID;
                     set _gain=(select gain from temp_mise where miseID=_miseID);
                     if (_avec_multiplicateur=true)then
						set _gain=_gain*_multiplicateur;
						update temp_mise set gain=_gain where miseID=_miseID;
					 end if;
					 set _total_gains=_total_gains+_gain;
				end if;
			elseif _codeOption='SIMPLE' then
				set _nbreBoule=0;
                set _listeBouleR=_listeBouleTire;
                set _bouleR=substring(_listeBouleR,1,(instr(_listeBouleR,',')-1));
				while(_listeBouleR<>'')
                do
                    if(instr(_listeBoule,_bouleR)>0)
                    then
						 set _nbreBoule=_nbreBoule+1;
                    end if;
					set _listeBouleR=substring(_listeBouleR,instr(_listeBouleR,',')+1);
                end while;
                -- LORSQUE LA MISE A GAGNE
                if(_nbreBoule>0)
				then
					 update temp_mise set gagner=true where miseID=_miseID;
                     set _cote=(select cote from detailoption where codeOption='SIMPLE' and nbreBoule=fn_count(_listeBouleTire,',') and nbreBouleApparu=_nbreBoule);
                     set _gain=(select mise from temp_mise where miseID=_miseID);
                     if (_avec_multiplicateur=true)then
						set _gain=_gain*_cote*_multiplicateur;
					 else
                        set _gain=_gain*_cote;
					 end if;
                     update temp_mise set gain=_gain,cote=_cote where miseID=_miseID;
					 set _total_gains=_total_gains+_gain;
				end if;
			end if;
            
          --  if(_last_mise=true)then
           --     insert into ticket_mouvement()
           --     values();
          --  end if; 
            
            update temp_mise set utilise=true where miseID=_miseID; 
            
        end while; 
        
        -- CALCUL --
        set _turnover=(SELECT turn_over FROM turnover where code_salle=_code_salle);
		set _total_turnover=(SELECT montantcycle FROM turnover where code_salle=_code_salle);
		set _solde_du_cycle=(SELECT solde FROM cycle_solde where code_salle=_code_salle);
        set _total=_total_gains+_solde_du_cycle;
        set _total_O=_total_turnover*_turnover;
        set _total_O_min=_total_O-_total_O*0.05;
        set _total_O_max=_total_O+_total_O*0.05; 
        
        if(_total<_total_O_min) then
            set _combinaisonParfaite=true;
            update cycle_solde set solde=_total where code_salle=_code_salle;
        elseif(_total<=_total_O_max) then
            set _combinaisonParfaite=true;
            update cycle_solde set solde=_total where code_salle=_code_salle;
            insert into cycle_mouvement(code_salle,lastupdate,solde,turnoverID) select code_salle,lastupdate,solde,turnoverID from cycle_solde where code_salle=_code_salle;
            update cycle_solde set solde=0 where code_salle=_code_salle;
        end if; 
        
    end while; 
    
    -- GESTION DU JACKPOT
	set _jackpot_win=0;
    set _jackpot_rate=(SELECT jackpot_rate from bonus where code_salle=_code_salle);
    set _jackpot_min=(SELECT jackpot_min from bonus where code_salle=_code_salle);
    set _jackpot_max=(SELECT jackpot_max from bonus where code_salle=_code_salle);
    set _jackpot_retire_sur_mise=(_total_mises-_total_mises*_jackpot_rate);
    set _jackpot_solde=(select jackpot_solde from bonus_solde where code_salle=_code_salle);
    update bonus_solde set jackpot_solde=(_jackpot_solde+_jackpot_retire_sur_mise) where code_salle=_code_salle;
    set _jackpot_solde=_jackpot_solde+_jackpot_retire_sur_mise;
    if (_jackpot_solde>=_jackpot_min and _jackpot_solde<=_jackpot_max)then
        set _jackpot_solde=_jackpot_solde-100; -- LE SOLDE JACKPOT MINIMAL DU JACKPOT DOIT TOUJOURS RESTER 100 F CFA 
        set _jackpot_win=1;  -- CAD JACKPOT A ETE GAGNE
        update bonus_solde set jackpot_solde=100 where code_salle=_code_salle; -- IL RESTE EN SOLDE 100 F CFA
    end if; 
    
    -- GESTION DE LA CAGNOTTE
    set _wincagnotte=false;
    set _cagnotte=(select lots from cagnotte where code_salle=_code_salle);
    if exists(select * from cagnotte where date_cagnotte between _dateDebutTirage and _dateFinTirage)
    then
        set _wincagnotte=true;
    end if; 
    
    -- MIGRATION DES DONNEES DANS DE LE BUT DE LIBERER LA TABLE DYNAMIQUE TEMP_MISE
    delete from mise where date_tirage between _dateDebutTirageSys and _dateFinTirageSys;
    insert into mise select * from temp_mise where date_tirage between _dateDebutTirageSys and _dateFinTirageSys;
    update mise set cloturer=1 where date_tirage between _dateDebutTirageSys and _dateFinTirageSys;
    update mise set etat='GAGNEE' where date_tirage between _dateDebutTirageSys and _dateFinTirageSys and gagner=true;
    update mise set etat='PERDUE' where date_tirage between _dateDebutTirageSys and _dateFinTirageSys and gagner=false;
    update mise set tirageID=_tirageID where date_tirage between _dateDebutTirageSys and _dateFinTirageSys;
    delete from temp_mise where date_tirage between _dateDebutTirageSys and _dateFinTirageSys;
    
    -- MISE A JOUR DE LA SYNCHRONISATION DE DONNEES DE TIRAGE
    insert into temp_params (code_salle,cagnotte,multiplicateur,jackpot,megajackpot)
    values(_code_salle,_cagnotte,_multiplicateur,_jackpot,_megajackpot);  
    
    update tirage set listeBoulesTires=_listeBoule where tirageID=_tirageID;
  
    select _listeBoule,_multiplicateur,_cagnotte,_jackpot_solde,_megajackpot,_wincagnotte;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psApprov_Delete` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psApprov_Delete`(
	IN `_id` VARCHAR(50)
)
BEGIN

	DELETE FROM approvisionnement WHERE approvID= _id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psApprov_Insert` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psApprov_Insert`(
	IN `_user_update` VARCHAR(50),
	IN `_approvID` VARCHAR(50),
	IN `_caisseID` VARCHAR(50),
	IN `_dateApprov` VARCHAR(50),
	IN `_montant` double,
	IN `_ip_update` VARCHAR(50)
)
BEGIN
	
    IF NOT EXISTS ( SELECT `approvID` FROM approvisionnement  WHERE  approvID = _approvID) THEN
        INSERT INTO `approvisionnement`(`last_update`,`user_update`,`approvID`, `caisseID`,`montant`, `created_by`, `ip_update`, `dateApprov`)
        VALUES(CURRENT_TIMESTAMP,_user_update,_approvID,_caisseID,_montant,_user_update, _ip_update, _dateApprov);
        
        INSERT INTO `historique`
				(`user_update`,`last_update`,`typeID`,`action_label`,`description`,`entityID`)
			VALUES(_user_update,CURRENT_TIMESTAMP,1,"INSERTION","Insertion d'un approvisionnement",_approvID);
    ELSE
        UPDATE `approvisionnement`
            SET
            `caisseID` = _caisseID,
            `user_update` = _user_update,
            `ip_update` = _ip_update,
            `dateApprov` = _dateApprov,
            `montant` = _montant,
            `last_update` = current_timestamp()
        WHERE `approvID` = _approvID;
        
        INSERT INTO `historique`
				(`user_update`,`last_update`,`typeID`,`action_label`,`description`,`entityID`)
			VALUES(_user_update,CURRENT_TIMESTAMP,2,"MISE A JOUR","Mise à jours d'un approvisionnement",_approvID);
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psApprov_List` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psApprov_List`(
	IN `_user_update` VARCHAR(50)
)
BEGIN
	SELECT * FROM approvisionnement;
	
	INSERT INTO `historique`
				(`user_update`,`last_update`,	`typeID`,`action_label`,`description`)
			VALUES(_user_update,	CURRENT_TIMESTAMP,5,	"CONSULTATION LISTE","Consultation de la liste des approvisionnements");
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psBonus_Insert` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psBonus_Insert`( 
  _code_salle varchar(45),
  _jackpot_min double,
  _jackpot_max double,
  _jackpot_rate varchar(45),
  _montant_bonus double,
  _organisationID varchar(45),
  _userID varchar(45),
  _lots varchar(50),
  _date_cagnotte datetime)
BEGIN
     
     declare _bonusID varchar(45);
     declare _turnoverID varchar(45);
     declare _cagnotteID varchar(45);
     declare _taille int;
     
     set _taille=(select count(*) from bonus);
     -- set _turnoverID=(select turnoverID from turnover where code_salle=_code_salle);
	 set _bonusID=fnGenere_ID('BONU',_taille);
     
     update bonus
     set jackpot_min=_jackpot_min,
         jackpot_max=_jackpot_max,
         jackpot_rate=_jackpot_rate*0.01,
         montant_bonus=_montant_bonus,
         lastupdate=current_timestamp()
	 where code_salle=_code_salle;
     
     set _taille=(select count(*) from bonus);
     set _cagnotteID=fnGenere_ID('CAGN',_taille);
     
	 update cagnotte
     set date_cagnotte=_date_cagnotte,
         lots=_lots,
         lastupdate=current_timestamp()
	 where code_salle=_code_salle;
    
     insert into bonus_historique(bonusID,code_salle,turnoverID,jackpot_min,jackpot_max,jackpot_rate,organisationID,userID,lastupdate,montant_bonus)
     values(_bonusID,_code_salle,_code_salle,_jackpot_min,_jackpot_max,_jackpot_rate,_organisationID,_userID,current_timestamp(),_montant_bonus);
     
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psBonus_List` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psBonus_List`(_organisationID varchar(45))
BEGIN
      
      /* 
      select cagnotteID,actif,code_salle,jackpot_rate,jackpot_reserve,montant_bonus_max,montant_bonus_min
      from bonus
      where organisationID=_organisationID; */
      
      select b.code_salle,b.jackpot_rate,b.jackpot_min,b.jackpot_max,b.montant_bonus,
        b.lastupdate,b.organisationID,b.userID,c.lots as cagnotte,c.date_cagnotte
	  from bonus b,cagnotte c
      where b.code_salle=c.code_salle and b.organisationID=_organisationID;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psBonus_Select` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psBonus_Select`(_code_salle varchar(45),_organisationID varchar(45))
BEGIN
      select cagnotteID,actif,code_salle,jackpot_rate,jackpot_reserve,montant_bonus_max,montant_bonus_min
      from bonus
      where code_salle=_code_salle and organisationID=_organisationID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psBonus_SelectBonus` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psBonus_SelectBonus`(_code_salle varchar(45),_organisationID varchar(45))
BEGIN
      select   cagnotteID,actif,code_salle,jackpot_rate,jackpot_reserve,montant_bonus_max,montant_bonus_min
      from bonus
      where code_salle=_code_salle and organisationID=_organisationID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psCagnotte_Insert` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psCagnotte_Insert`(_code_salle varchar(50),_date_cagnotte varchar(50),_lots varchar(50),_actif boolean,_organisationID varchar(50),_userID varchar(50))
BEGIN

     declare _cagnotteID varchar(45);
     declare _taille int; 
     declare _turnoverID varchar(45);
     set _taille=(select count(*) from bonus);
     set _cagnotteID=fnGenere_ID('CAGN',_taille);
      set _turnoverID=(select turnoverID from turnover where code_salle=_code_salle);
     
     delete from cagnotte where code_salle=_code_salle;
     
     insert into cagnotte(cagnotteID,code_salle,turnoverID,date_cagnotte,lots,actif,organisationID,userID)
     values(concat("CANG.", rand(10)*10),_code_salle,_turnoverID,_date_cagnotte,_lots,_actif,_organisationID,_userID);
     
     insert into cagnotte_historique(cagnotteID,code_salle,turnoverID,date_cagnotte,lots,actif,organisationID,userID)
     values(concat("CANG.", rand(10)*10),_code_salle,_turnoverID,_date_cagnotte,_lots,_actif,_organisationID,_userID);
     
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psCagnotte_List` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psCagnotte_List`(_organisationID varchar(50))
BEGIN
       select cagnotteID,actif,lots,salle,code_salle,date_cagnotte
       from cagnotte
       where organisationID=_organisationID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psCagnotte_Select` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psCagnotte_Select`(_code_salle varchar(45),_organisationID varchar(45))
BEGIN
      select cagnotteID,actif,lots,salle,code_salle,date_cagnotte
      from cagnotte
      where code_salle=_code_salle and organisationID=_organisationID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psCaisse_Bloquer` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psCaisse_Bloquer`(_caisseID varchar(50))
BEGIN
      update caisse
      set bloque=false
      where caisseID=_caisseID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psCaisse_Crediter` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psCaisse_Crediter`(_caisseID varchar(50),_code_salle varchar(50))
BEGIN
	 declare caisse_soldeID varchar(50);
     declare _taille int;
     set _taille=(select count(*) from caisse_solde);
     set caisse_soldeID=fnGenereID('CASO',_taille);
     insert into caisse_solde(caisse_soldeID,caisseID,montant,modetransfert,code_salle)
     values(_caisse_creditID,_caisseID,_montant,1,_code_salle);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psCaisse_Crediter_Debiter` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psCaisse_Crediter_Debiter`(_code_salle varchar(50),_montant double,_operation varchar(10))
BEGIN
     declare _solde_en_caisse double;
     declare _caisse_mouvID varchar(50);
     declare _taille int;
     set _solde_en_caisse=(select solde from caisse where code_salle=_code_salle);
     if(_operation='C')then
         set _solde_en_caisse=_solde_en_caisse+_montant;
     elseif(_operation='D')then 
         set _solde_en_caisse=_solde_en_caisse-_montant;
     end if;
     update caisse set solde=_solde_en_caisse where code_salle=_code_salle;
     set _taille=(select count(*) from caisse_mouvement);
     set _caisse_mouvID=(select fnGenere_ID("CAIM",_taille));
     insert into caisse_mouvement(caisse_mouvID,caisseID,montant,modetransfert,code_salle,solde_apres_operation)
     values(_caisse_mouvID,_code_salle,_montant,_operation,_code_salle,_solde_en_caisse);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psCaisse_Delete` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psCaisse_Delete`(
	IN `_id` VARCHAR(50)
)
BEGIN

	DELETE FROM caisse WHERE caisseID= _id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psCaisse_Insert` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psCaisse_Insert`(

	IN `_user_update` VARCHAR(50),

	IN `_caisseID` VARCHAR(50),

	IN `_libelle` VARCHAR(255),

	IN `_salleID` VARCHAR(50),
    IN `_bloque` int

)
BEGIN

	

    IF NOT EXISTS ( SELECT `caisseID`  FROM caisse  WHERE  caisseID = _caisseID) THEN

        INSERT INTO `caisse`(`last_update`,`user_update`,`caisseID`, `libelle`, `salleID`, `created_by`, `bloque`)

        VALUES(CURRENT_TIMESTAMP,_user_update,_caisseID,_libelle,_salleID,_user_update, _bloque);

        

        INSERT INTO `historique`

				(`user_update`,`last_update`,`typeID`,`action_label`,`description`,`entityID`)

			VALUES(_user_update,CURRENT_TIMESTAMP,1,"INSERTION","Insertion d'une caisse",_caisseID);

    ELSE

        UPDATE `caisse`

            SET

            `libelle` = _libelle,

            `user_update` = _user_update,

            `salleID` = _salleID,

            `last_update` = current_timestamp()

        WHERE `caisseID` = _caisseID;

        

        INSERT INTO `historique`

				(`user_update`,`last_update`,`typeID`,`action_label`,`description`,`entityID`)

			VALUES(_user_update,CURRENT_TIMESTAMP,2,"MISE A JOUR ORGANISATION","Mise à jours d'une caisse",_caisseID);

    END IF;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psCaisse_List` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psCaisse_List`(

	 `_organisationID` VARCHAR(50)

)
BEGIN
    select code_salle,libelle,solde from caisse where organisationID=_organisationID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psGenere_ID` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psGenere_ID`(codeTable varchar(3),taille int)
BEGIN
    declare ID varchar(30);
    declare machaine varchar(9);
    set machaine='';
    set ID='';
   set machaine=convert(taille+1,CHAR);
   while length(machaine)<>9
    do
       set machaine=concat('0',machaine);
    end while;
	set ID=concat(codeTable,date_format(now(),'%Y%m%d%H%i%s'),machaine);
    select ID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psKenOrganisation_Delete` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psKenOrganisation_Delete`(

	IN `_id` VARCHAR(50)

)
BEGIN



	DELETE FROM organisation WHERE organisationID= _id;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psList_BoulesLesMoinsTirees` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psList_BoulesLesMoinsTirees`(_codesalle varchar(10))
BEGIN
      select 'moinstires' ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psList_BoulesLesPlusTirees` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psList_BoulesLesPlusTirees`(_codesalle varchar(10))
BEGIN
      select 'listeBoulesTires' ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psList_DerniersMultiplicateurs` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psList_DerniersMultiplicateurs`(_codesalle varchar(10))
BEGIN
      select 'multiplicateurs' ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psList_DerniersTirage` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psList_DerniersTirage`(_codesalle varchar(10))
BEGIN
      select top (5) 'numTirage','heure','listeBoule','multiplicateur';
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psList_EnteteCaisse` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psList_EnteteCaisse`(_codesalle varchar(10))
BEGIN
      select 'tempsrestant','joueurs','credit','jackpot','megajackpot' ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psMise_List` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psMise_List`()
BEGIN
     select  `miseID`,`ticketID` ,`optionID` ,
			  `tirageID` ,`userID` ,`organisationID`,
			  `dateCreation` ,`listeBouleTires` ,`mise` ,
			  `gagner`, `annuler`, `cloturer` , `gain`  
	 from mise order by dateCreation desc;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psMise_ListByTicket` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psMise_ListByTicket`(_ticketID varchar(50))
BEGIN
        select   opt.libelleOP, m.date_tirage, m.etat
        from mise m
        inner join optionjeux opt
        where m.ticketID=_ticketID and m.optionID=opt.optionID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psOption_Insert` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psOption_Insert`(
  `_codeOption` varchar(10) ,
  `_libelleOP` varchar(100) ,
  `_userID` varchar(50) )
BEGIN
    declare _optionID varchar(50);
    declare _taille int;
    set _taille=(select count(*) from optionjeux);
    set _optionID=fnGenere_ID('OPT',_taille);
    insert into optionjeux(optionID,libelleOP,dateCreation,userID,codeOption)
    values(_optionID,_libelleOP,current_timestamp(),_userID,_codeOption);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psOrganisation_Insert` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psOrganisation_Insert`(
	`_user_update` VARCHAR(50),
	`_libelle` VARCHAR(255),
	`_parentID` VARCHAR(50),
    _login VARCHAR(50),
    _password VARCHAR(50),
    _responsable VARCHAR(100)
)
BEGIN   

        declare _organisationID varchar(4);
        declare _newUserID varchar(8);
	
        set _organisationID=(select LPAD(count(*),3,'0') FROM organisation);
        set _organisationID=concat('O',_organisationID);
        
		set _newUserID=(select LPAD(count(*),4,'0') FROM users where organisationID=_organisationID);
		set _newUserID=concat('U',substring(_organisationID,2),_newUserID);
        
        INSERT INTO `organisation`(`last_update`,`user_update`,`organisationID`, `libelle`, `parentID`, `created_by`,login,motdepasse,responsableID,responsable)
        VALUES(CURRENT_TIMESTAMP,_user_update,_organisationID,_libelle,_parentID,_user_update,_login,_password,_newUserID,_responsable);
		
        insert into users(userID,nom,login,pasword,profilID,actif,organisationID)
        values(_newUserID,_responsable,_login,_password,'PARTENAIRE',true,_organisationID);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psOrganisation_List` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psOrganisation_List`(

	IN `_user_update` VARCHAR(50)

)
BEGIN

	SELECT * FROM organisation;

	

	INSERT INTO `historique`

				(`user_update`,`last_update`,	`typeID`,`action_label`,`description`)

			VALUES(_user_update,	CURRENT_TIMESTAMP,3,	"CONSULTATION LISTE","Consultation de la liste des organisations");

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psOrganisation_ListByParent` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psOrganisation_ListByParent`(_organisationID varchar(100))
BEGIN
     select organisationID,libelle,parentID,user_update,login,motdepasse,responsable
     from organisation
     where parentID=_organisationID order by created_at desc;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psParametre_Update` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psParametre_Update`(
          _code_salle varchar(50),
          _date_cagnotte varchar(50),
          _lots varchar(50),
          _actif boolean,
          _organisationID varchar(50),
          _userID varchar(50),
          _jackpot_min double,
          _jackpot_max double,
          _jackpot_rate varchar(45),
          _montant_bonus double,
          _turn_over double,
          _cycle int
     )
BEGIN

     UPDATE `turnover`
     SET
          `turn_over` = _turn_over,
          `organisationID` = _organisationID,
          `cycle` = _cycle
     WHERE `code_salle` = _code_salle;

     UPDATE `cagnotte`
     SET
          `date_cagnotte` = _date_cagnotte,
          `lots` = _lots,
          `lastupdate` = current_timestamp,
          `organisationID` = _organisationID
     WHERE `code_salle` = _code_salle;

     UPDATE `bonus`
     SET
          `jackpot_min` = _jackpot_min,
          `jackpot_max` = _jackpot_max,
          `jackpot_rate` = _jackpot_rate,
          `lastupdate` = current_timestamp,
          `montant_bonus` = _montant_bonus,
          `organisationID` = _organisationID
     WHERE `code_salle` = _code_salle;


     /*INSERT INTO `cagnotte_historique`(`cagnotteID`,`code_salle`,`date_cagnotte`,`lots`,`lastupdate`,`userID`,`organisationID`)
     VALUES (concat("CANG.", rand(10)*10),_code_salle,_date_cagnotte,_lots,current_timestamp,_userID,_organisationID);

     INSERT INTO `bonus_historique`(`bonusID`,`code_salle`,`jackpot_min`,`jackpot_max`,`jackpot_rate`,`actif`,`lastupdate`,`userID`,`montant_bonus`,`organisationID`)
     VALUES (concat("BON.", rand(10)*10),_code_salle,_jackpot_min,_jackpot_max,_jackpot_rate,_actif,current_timestamp,_userID,_montant_bonus,_organisationID);*/

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psSalle_Delete` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psSalle_Delete`(
	IN `_id` VARCHAR(50)
)
BEGIN

	DELETE FROM salle WHERE salleID= _id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psSalle_Insert` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psSalle_Insert`(
	IN `_userID` VARCHAR(50),
	IN `_organisationID` VARCHAR(4),
	IN `_libelle` VARCHAR(255),
	IN `_description` VARCHAR(1000)
)
BEGIN

	declare _code_salle varchar(7);
    
	set _code_salle=(select LPAD(count(*),3,'0') FROM salle where organisationID=_organisationID);
    set _code_salle=concat('S',substring(_organisationID,2),_code_salle);
    
    IF NOT EXISTS ( SELECT `code_salle`  FROM salle  WHERE  code_salle = _code_salle) THEN

        insert into `salle`(`last_update`,`userID`,`code_salle`, `libelle`, `description`,organisationID)
        values(CURRENT_TIMESTAMP,_userID,_code_salle,_libelle,_description,_organisationID);
		
        insert into cagnotte(code_salle,actif,lastupdate,userID,organisationID)
        values(_code_salle,false,current_timestamp,_userID,_organisationID);
        
        insert into caisse(code_salle,libelle,bloque,userID,solde,organisationID) 
        values(_code_salle,_libelle,0,_userID,0,_organisationID);
        
        insert into bonus(code_salle,lastupdate,actif,organisationID)
        values(_code_salle,current_timestamp(),0,_organisationID);
        
        INSERT INTO `turnover`(`turn_over`,`userID`,`organisationID`,`date_creation`,`code_salle`)
		VALUES(0,_userID,_organisationID,current_timestamp(),_code_salle);

		insert into bonus_solde(code_salle,jackpot_solde,last_update)
        values(_code_salle,0,current_timestamp());
        
        -- call `psTurnover_Insert`(_code_salle,0,_userID,_organisationID,0);
        
    ELSE

        UPDATE `salle`
		SET `libelle` = _libelle,
            `userID` = _userID,
            `description` = _description,
            `last_update` = current_timestamp()
        WHERE `code_salle` = _code_salle;

    END IF;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psSalle_List` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psSalle_List`(	_organisationID VARCHAR(50))
BEGIN
SELECT S.*, 
     T.turn_over,
     T.date_creation,
     T.cycle,
     T.montantcycle,
     C.actif as actifca,
     C.date_cagnotte,
     C.lots,
     C.lastupdate as lastupdateca,
     B.jackpot_min,
     B.jackpot_max,
     B.jackpot_rate,
     B.actif as actifbo,
     B.lastupdate as lastupdatebo,
     B.montant_bonus
     FROM salle S INNER JOIN turnover T ON S.code_salle = T.code_salle 
     INNER JOIN cagnotte C ON S.code_salle = C.code_salle
     INNER JOIN bonus B ON S.code_salle = B.code_salle
     WHERE S.organisationID=_organisationID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psTempParams_Select` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psTempParams_Select`(_userID varchar(100))
BEGIN
      declare _code_salle varchar(50);
      set _code_salle=(select code_salle from users where userID=_userID);
      select cagnotte,multiplicateur,jackpot,megajackpot from temp_params where code_salle=_code_salle;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psTicket_Insert` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psTicket_Insert`(_code_salle varchar(20),_code_option varchar(50),_mise double,_nbre_tirage int,_userID varchar(50),_listeBoules varchar(100),_avec_multiplicateur tinyint)
BEGIN
			
            declare _indexTicket varchar(5); declare _ticketID varchar(30); declare _codebarre varchar(14);
			declare _tailleMise int;
			declare _tirageID varchar(50);  declare _miseID varchar(50);  declare _turnoverID varchar(50);  
            declare _date_tirage datetime;  declare _gain double;declare _cote double;
            declare _libelleOption varchar(100);declare _nbreBoule int;declare solde_en_caisse double;declare _rang int;
            declare _last_mise tinyint;
            declare _gain_max double;
            declare _gain_min double;
            
            declare _date_create varchar(50);
            set _date_create=(select fn_date_cameroon());
            set _indexTicket=(select LPAD(count(*),5,'0') FROM ticket where date_format(date_creation,'%Y%m%d')=date_format(current_date(),'%Y%m%d') and code_salle=_code_salle);
            set _ticketID=concat(substring(_code_salle,2),date_format(current_date(),'%Y%m%d'),_indexTicket);
            
            set _codebarre=(select fn_genere_barrecode(_code_salle));
            
            set _date_tirage=current_timestamp();  set _tailleMise=0;
            set _rang=0; set _last_mise=false;
            set _nbreBoule=length(_listeBoules)-length(replace(_listeBoules,',',''))-1;
            if (_code_option<>'SIMPLE')then
                 set _cote=(select cote 
			     from detailoption 
			     where codeOption=_code_option and nbreBoule=_nbreBoule);  
				 set _gain=(select _mise*cote from detailoption where codeOption=_code_option and nbreBoule=_nbreBoule);
                 set _gain_max=_gain;
                 set _gain_min=_gain/_nbre_tirage;
                 set _gain_min=round(_gain_min,-1);
            end if;
            
			set _libelleOption=(select libelleOp 
                                from optionjeux where codeOption=_code_option 
                                group by libelleOp);
            
            -- ORG
			set _tirageID=(select tirageID from tirage 
							where code_salle=_code_salle
							and date_creation=(select Max(date_creation) from tirage));
	
			set _tailleMise=(select count(miseID) from mise);
			set _turnoverID=(select code_salle 
                             from turnover 
                             where date_creation=(select Max(date_creation) from turnover));
             
            insert into ticket(ticketID,code_salle,nbre_tirage,mise_total,date_creation,userID,codebarre)
            values(_ticketID,_code_salle,_nbre_tirage,_mise,current_timestamp(),_userID,_codebarre);
            set _mise=(_mise/_nbre_tirage);   
            
            -- MAJ DU SOLDE EN CAISSE
            set solde_en_caisse=(select solde from caisse where code_salle=_code_salle);
            set solde_en_caisse=solde_en_caisse+_mise;
            update caisse set solde=solde_en_caisse where code_salle=_code_salle; 
            
            while _nbre_tirage<>0 do
                 set _rang=_rang+1;
                 if((_nbre_tirage-1)=0)then -- CETTE CONDITION EST VERIFIEE LORSQU'ON A ATTEINT LA DERNIERE BOUCLE
                    set _last_mise=true;
                 end if;
                 set _miseID=fnGenere_ID('MISE',_tailleMise);
                 insert into temp_mise(miseID,ticketID,optionID,userID,date_creation,listeBouleTires,
                                  mise,avecMultiplicateur,turnoverID,code_salle,date_tirage,gain,cote,libelleOption,codebarre,rang,last_mise) 
                 values(_miseID,_ticketID,_code_option,_userID,_date_create,_listeBoules,
                        _mise,_avec_multiplicateur,_turnoverID,_code_salle,_date_tirage,_gain,_cote,_libelleOption,_codebarre,_rang,_last_mise);
                        
				 insert into mise(miseID,ticketID,optionID,userID,date_creation,listeBouleTires,
                                  mise,avecMultiplicateur,turnoverID,code_salle,date_tirage,gain,cote,libelleOption,codebarre,rang,last_mise) 
                 values(_miseID,_ticketID,_code_option,_userID,_date_create,_listeBoules,
                        _mise,_avec_multiplicateur,_turnoverID,_code_salle,_date_tirage,_gain,_cote,_libelleOption,_codebarre,_rang,_last_mise);
                 set _nbre_tirage=_nbre_tirage-1;
                 set _tailleMise=_tailleMise+1;
                 set _date_tirage=DATE_ADD(_date_tirage,INTERVAL 4 MINUTE);
            end while; 
            select codebarre,date_tirage,_gain_max,_gain_min from mise where ticketID=_ticketID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psTicket_Mouvement` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psTicket_Mouvement`(_organisationID varchar(50))
BEGIN
     select code_salle,ticketID,mise_totale,date_creation,codebarre,gains_max,cloturer
     from ticket
     where organisationID=_organisationID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psTicket_Payer` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psTicket_Payer`(_codebarre varchar(50))
BEGIN

      declare _total_gain double;
      declare _solde double;
      declare _code_salle varchar(100);
      
      set _code_salle=(select code_salle from mise where codebarre=_codebarre limit 1);
      set _solde=(select solde from caisse);
      set _total_gain=(select sum(gain) from mise where codebarre=_codebarre and gagner=true);
      
      update mise 
      set etat='PAYE'
      where codebarre=_codebarre and gagner=true;
      
      update caisse
      set solde=(_solde-_total_gain)
      where code_salle=_code_salle;
      
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psTicket_Print` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psTicket_Print`(_ticketID varchar(50))
BEGIN
     select  t.codebarre as codeticket,
			 m.date_tirage as dateDebut,
			 m.listeBouleTires as jeux,
			 m.cote as quote,
			 t.mise_total as mise,
			 concat('Mise Total: ',mise_total,'CFA. ') as piedDePage,
			 concat('Salle:',t.code_salle,' - Caissiere:','Simo') as summary1,
			 concat('Devise: XAF Expire', '09-19-2023 16:55',')') as summary2
     from ticket t 
     inner join mise m on m.ticketID=t.ticketID 
     where t.ticketID=_ticketID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psTicket_SelectByCodebarre` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psTicket_SelectByCodebarre`(_codebarre varchar(50))
BEGIN
        select date_tirage,listeBouleTires,mise,etat
		from mise 
		where codebarre=_codebarre;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psTirage_Insert` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psTirage_Insert`(_tirageID varchar(50),_codeSalle varchar(50),_dateDebut varchar(50))
BEGIN
      declare _taille varchar(50);
      declare _dateDebutSys datetime;
      declare _dateFinSys datetime;
      declare _dateFin datetime;
      set _dateDebutSys=current_timestamp();
      set _dateFin=DATE_ADD(_dateDebut,INTERVAL 3 MINUTE);
      set _dateFinSys=DATE_ADD(_dateDebutSys,INTERVAL 3 MINUTE);

	  insert into tirage(tirageID,code_salle,dateDebut,dateFin,dateDebutSys,dateFinSys,date_creation)
      values(_tirageID,_codeSalle,_dateDebut,_dateFin,_dateDebutSys,_dateFinSys,current_timestamp());
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psTurnover_Insert` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psTurnover_Insert`(_code_salle varchar(50),_turn_over double,_userID varchar(50),_organisationID varchar(50),_cycle int)
BEGIN

    -- declare _turnoverID varchar(50);
    declare _taille int;
    declare _montantcycle double;
    
    -- set _taille=(select count(turnoverID) from turnover);
    set _montantcycle=200*_cycle;
    -- set _turnoverID=fnGenere_ID('TURN',_taille); 
    
    if exists(select * from turnover where code_salle=_code_salle and organisationID=_organisationID)then
        update turnover 
		   set turn_over=_turn_over*0.01,
               cycle=_cycle,
               montantcycle=_montantcycle
		where code_salle=_code_salle and organisationID=_organisationID;
    else
        insert into turnover(code_salle,turn_over,cycle,montantcycle,userID,organisationID,date_creation, turnoverID)
        values(_code_salle,_turn_over*0.01,_cycle,_montantcycle,_userID,_organisationID,current_timestamp(), concat("TURN.", rand(10)*10));
    
		insert into cycle_solde(code_salle,lastupdate,solde,turnoverID)
		values(_code_salle,current_timestamp(),0,_code_salle);
    end if;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psTurnover_List` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psTurnover_List`(_organisationID varchar(50))
BEGIN
      select code_salle,`turn_over`,`cycle` , `date_creation`,`userID`,`organisationID`
      from turnover
      where organisationID=_organisationID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psTurnover_Select` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psTurnover_Select`()
BEGIN
      select turnoverID,`turn_over`,`cycle` ,
             `date_creation`,`userID`,`organisationID`
      from turnover
      where date_create=(select MAX(date_create) from turnover);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psUsers_Insert` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psUsers_Insert`(	`_user_update` VARCHAR(50),
	`_nom` VARCHAR(255),
	`_organisationID` VARCHAR(50),
    _login VARCHAR(50),
    _password VARCHAR(50))
BEGIN

        declare _newUserID varchar(8);
		set _newUserID=(select LPAD(count(*),4,'0') FROM users where organisationID=_organisationID);
		set _newUserID=concat('U',substring(_organisationID,2),_newUserID);
        
        insert into users(userID,nom,login,pasword,profilID,actif,organisationID)
        values(_newUserID,_nom,_login,_password,'CAISSIER',true,_organisationID);

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `psUsers_Login` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `psUsers_Login`(_login varchar(50),_password varchar(200))
BEGIN
    select userID,nom,prenom,login,pasword,
           profilID,actif,code_salle,organisationID
    from users where login=_login and pasword=_password;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-31  1:26:50
