-- MySQL dump 10.13  Distrib 5.7.24, for osx10.13 (x86_64)
--
-- Host: localhost    Database: hospital
-- ------------------------------------------------------
-- Server version	5.7.24-log

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
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `company_id` (`company_id`),
  KEY `branch_id` (`branch_id`),
  CONSTRAINT `branches_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `branches_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branches`
--

LOCK TABLES `branches` WRITE;
/*!40000 ALTER TABLE `branches` DISABLE KEYS */;
/*!40000 ALTER TABLE `branches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` varchar(250) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `npwp` varchar(15) NOT NULL,
  `city` varchar(30) NOT NULL,
  `zip` varchar(5) NOT NULL,
  `level` varchar(1) NOT NULL,
  `npp` varchar(15) NOT NULL,
  `kpa` varchar(15) NOT NULL,
  `max_npwp` int(11) NOT NULL,
  `kelurahan` varchar(40) NOT NULL,
  `kecamatan` varchar(40) NOT NULL,
  `klu` varchar(5) NOT NULL,
  `fax` varchar(5) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `npwp` (`npwp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `branch_id` (`branch_id`),
  CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(30) NOT NULL,
  `npwp` varchar(15) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `grade_id` int(11) DEFAULT NULL,
  `fullname` varchar(50) NOT NULL,
  `join_at` date NOT NULL,
  `resign_at` date DEFAULT NULL,
  `employment` varchar(2) DEFAULT NULL,
  `employment_type` int(11) DEFAULT NULL,
  `salary` decimal(19,4) NOT NULL,
  `religion` varchar(15) NOT NULL,
  `status` varchar(3) NOT NULL,
  `sex` varchar(1) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `point` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`,`npwp`),
  KEY `company_id` (`company_id`),
  KEY `branch_id` (`branch_id`),
  KEY `department_id` (`department_id`),
  KEY `position_id` (`position_id`),
  KEY `team_id` (`team_id`),
  KEY `grade_id` (`grade_id`),
  CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `employees_ibfk_3` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `employees_ibfk_4` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `employees_ibfk_5` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `employees_ibfk_6` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grades`
--

DROP TABLE IF EXISTS `grades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `name` varchar(35) NOT NULL,
  `level` int(11) NOT NULL,
  `salary_min` decimal(10,0) NOT NULL,
  `salary_mid` decimal(10,0) NOT NULL,
  `salary_max` decimal(10,0) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grades`
--

LOCK TABLES `grades` WRITE;
/*!40000 ALTER TABLE `grades` DISABLE KEYS */;
INSERT INTO `grades` VALUES (1,'00001','GM',10,100000000,120000000,150000000,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(2,'00002','Controller',20,10000000,12000000,15000000,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(3,'00003','DIRECTOR',30,10000000,12000000,15000000,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(4,'00004','Manager',40,8000000,9000000,10000000,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(5,'00005','Dept Head',50,6500000,7000000,8000000,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(6,'00006','Supervisor',60,5500000,6000000,6500000,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(7,'00007','Staff',70,4500000,5000000,6000000,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL);
/*!40000 ALTER TABLE `grades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `holidays`
--

DROP TABLE IF EXISTS `holidays`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `holidays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `holidays`
--

LOCK TABLES `holidays` WRITE;
/*!40000 ALTER TABLE `holidays` DISABLE KEYS */;
/*!40000 ALTER TABLE `holidays` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `labs`
--

DROP TABLE IF EXISTS `labs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `labs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `labs`
--

LOCK TABLES `labs` WRITE;
/*!40000 ALTER TABLE `labs` DISABLE KEYS */;
INSERT INTO `labs` VALUES (1,'HEMATOLOGI','hematologi',NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(2,'URINALISA','urinalisa',NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(3,'KIMIA KLINIS','Kimia Klinis',NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(4,'IMMUNOLOGI/SEROLOGI','Immunologi/Serologi',NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(5,'LIVER PROFIL','Liver Profil',NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(6,'RENAL PROFIL','Renal Profil',NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(7,'LIPID PROFIL','Lipid Profil',NULL,NULL,'2020-09-11 17:02:46',NULL,NULL);
/*!40000 ALTER TABLE `labs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `labs_setup`
--

DROP TABLE IF EXISTS `labs_setup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `labs_setup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lab_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `measure` varchar(50) DEFAULT NULL,
  `normal_condition` varchar(100) DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `labs_setup`
--

LOCK TABLES `labs_setup` WRITE;
/*!40000 ALTER TABLE `labs_setup` DISABLE KEYS */;
INSERT INTO `labs_setup` VALUES (1,1,'Hemoglobin','g/dL','13.2 - 17.3',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(2,1,'Leukosit','ribu/µL','3.80 - 10.60',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(3,1,'Hitung Jenis','','',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(4,1,'Basofil','%','0 - 1',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(5,1,'Eosinofil','%','2 - 4',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(6,1,'Neutrofil Batang','%','3 - 5',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(7,1,'Neutrofil Segmen','%','50 - 70',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(8,1,'Limfosit','%','25 - 40',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(9,1,'Monosit','%','2 - 8',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(10,1,'Laju Endap darah','mm','0 - 10',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(11,1,'Trombosit','ribu/µL','150 - 440',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(12,1,'Hematokrit','%','40 - 52',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(13,1,'Eritrosit','10˄6/µL','4.40 - 5.90',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(14,1,'Jumlah Retikulosit','','',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(15,1,'Absolut','ribu/µL','25 - 75',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(16,1,'Persen','%','0.50 - 2.00',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(17,1,'MCV/VER','fL','80 - 100',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(18,1,'MCH/HER','pG','26 - 34',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(19,1,'MCHC/KHER','g/dL','32 - 36',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(20,2,'Warna','','Kuning',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(21,2,'Kejernihan','','Jernih',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(22,2,'Sedimen','','',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(23,2,'Leukosit','\'/LPB','0 - 5',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(24,2,'Eritrosit','\'/LPB','˂= 3',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(25,2,'Selinder','','',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(26,2,'Sel Epitel','','(1+)',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(27,2,'Kristal','','(-) Negatif',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(28,2,'Bakteri','','(-) Negatif',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(29,2,'Lain-lain','','',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(30,2,'Berat jenis','','1.005 - 1.030',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(31,2,'pH','','5.0 - 7.0',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(32,2,'Protein','mg/dL','negatif (˂30)',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(33,2,'Glukosa','mg/dL','negatif (˂100)',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(34,2,'Keton','','(-) Negatif',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(35,2,'Darah Samar / Hb','','(-) Negatif',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(36,2,'Bilirubin','','(-) Negatif',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(37,2,'Urobilinogen','mg/dL','0.2 - 1.0',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(38,2,'Nitrit','','(-) Negatif',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(39,2,'Leukosit esterase','','(-) Negatif',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(40,3,'Glukosa darah puasa','mg/dL','70 - 110',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(41,3,'Glukosa darah sewaktu','mg/dL','',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(42,3,'Glukosa urin','mg/dL','(-) Negatif',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(43,4,'HBsAg','','Non Reaktif',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(44,4,'Anti HBs','','Non Reaktif',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(45,4,'SD HIV 1/2','','Non Reaktif',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(46,4,'ONCOPROBE HIV 1/2','S/CO','Non Reaktif',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(47,4,'HIV 1/2 gO (Elisa)','','˂ 1.00 : non reaktif',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(48,4,'Kesimpulan','','',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(49,4,'Saran','','',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(50,5,'SGOT (AST)','U/L','\'10 - 34',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(51,5,'SGPT (ALT)','U/L','\'9 - 43',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(52,5,'Fosfatase Alkali','U/L','\'80 - 306',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(53,5,'Protein Total','g/dL','\'6.0 - 8.0',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(54,5,'Albumin','g/dL','\'4.0 - 5.2',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(55,5,'Bilirubin Total','mg/dL','˂ 1.0',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(56,5,'Bilirubin Direk','mg/dL','˂ 0.3',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(57,5,'Bilirubin Indirek','mg/dL','˂ 0.8',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(58,6,'Ureum Darah','mg/dL','\'10 - 50',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(59,6,'Kreatinin Darah','mg/dL','˂ 1.4',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(60,6,'Asam Urat','mg/dL','3.0 - 7.0',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(61,7,'Trigliserida','mg/dL','˂ 150',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(62,7,'Kolesterol Total','mg/dL','˂ 200',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(63,7,'Kolesterol HDL','mg/dL','42 - 67',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(64,7,'Kolesterol LDL Direk','mg/dL','˂ 100',NULL,NULL,NULL,'2020-09-11 17:02:46',NULL,NULL);
/*!40000 ALTER TABLE `labs_setup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `labs_test`
--

DROP TABLE IF EXISTS `labs_test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `labs_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_lab_result_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `measure` varchar(50) DEFAULT NULL,
  `value` varchar(50) DEFAULT NULL,
  `normal_condition` varchar(100) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `labs_test`
--

LOCK TABLES `labs_test` WRITE;
/*!40000 ALTER TABLE `labs_test` DISABLE KEYS */;
INSERT INTO `labs_test` VALUES (1,1,'Trigliserida','mg/dL',NULL,NULL,NULL,NULL,'2020-09-11 10:09:16','2020-09-11 10:09:16',NULL),(2,1,'Kolesterol Total','mg/dL',NULL,NULL,NULL,NULL,'2020-09-11 10:09:16','2020-09-11 10:09:16',NULL),(3,1,'Kolesterol HDL','mg/dL',NULL,NULL,NULL,NULL,'2020-09-11 10:09:16','2020-09-11 10:09:16',NULL),(4,1,'Kolesterol LDL Direk','mg/dL',NULL,NULL,NULL,NULL,'2020-09-11 10:09:16','2020-09-11 10:09:16',NULL),(5,2,'Ureum Darah','mg/dL','12',NULL,NULL,NULL,'2020-09-11 17:15:21','2020-09-11 10:15:21',NULL),(6,2,'Kreatinin Darah','mg/dL','23',NULL,NULL,NULL,'2020-09-11 17:15:21','2020-09-11 10:15:21',NULL),(7,2,'Asam Urat','mg/dL','1',NULL,NULL,NULL,'2020-09-11 17:15:21','2020-09-11 10:15:21',NULL),(8,3,'HBsAg','',NULL,NULL,NULL,NULL,'2020-09-11 10:16:11','2020-09-11 10:16:11',NULL),(9,3,'Anti HBs','',NULL,NULL,NULL,NULL,'2020-09-11 10:16:11','2020-09-11 10:16:11',NULL),(10,3,'SD HIV 1/2','',NULL,NULL,NULL,NULL,'2020-09-11 10:16:11','2020-09-11 10:16:11',NULL),(11,3,'ONCOPROBE HIV 1/2','S/CO',NULL,NULL,NULL,NULL,'2020-09-11 10:16:11','2020-09-11 10:16:11',NULL),(12,3,'HIV 1/2 gO (Elisa)','',NULL,NULL,NULL,NULL,'2020-09-11 10:16:11','2020-09-11 10:16:11',NULL),(13,3,'Kesimpulan','',NULL,NULL,NULL,NULL,'2020-09-11 10:16:11','2020-09-11 10:16:11',NULL),(14,3,'Saran','',NULL,NULL,NULL,NULL,'2020-09-11 10:16:11','2020-09-11 10:16:11',NULL),(15,4,'Glukosa darah puasa','mg/dL',NULL,NULL,NULL,NULL,'2020-09-11 10:16:23','2020-09-11 10:16:23',NULL),(16,4,'Glukosa darah sewaktu','mg/dL',NULL,NULL,NULL,NULL,'2020-09-11 10:16:23','2020-09-11 10:16:23',NULL),(17,4,'Glukosa urin','mg/dL',NULL,NULL,NULL,NULL,'2020-09-11 10:16:23','2020-09-11 10:16:23',NULL),(18,5,'Trigliserida','mg/dL','23','˂ 150',NULL,NULL,'2020-09-12 09:13:33','2020-09-12 09:13:33',NULL),(19,5,'Kolesterol Total','mg/dL','2323','˂ 200',NULL,NULL,'2020-09-12 09:13:33','2020-09-12 09:13:33',NULL),(20,5,'Kolesterol HDL','mg/dL','232','42 - 67',NULL,NULL,'2020-09-12 09:13:33','2020-09-12 09:13:33',NULL),(21,5,'Kolesterol LDL Direk','mg/dL',NULL,'˂ 100',NULL,NULL,'2020-09-12 09:13:33','2020-09-12 09:13:33',NULL);
/*!40000 ALTER TABLE `labs_test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_setup`
--

DROP TABLE IF EXISTS `leave_setup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leave_setup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `grade_id` int(11) DEFAULT NULL,
  `leave_type_id` int(11) DEFAULT NULL,
  `year` year(4) NOT NULL,
  `days_per_year` int(11) NOT NULL,
  `days_per_month` int(11) NOT NULL,
  `days` int(11) NOT NULL,
  `expire_count` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `grade_id` (`grade_id`),
  KEY `leave_type_id` (`leave_type_id`),
  CONSTRAINT `leave_setup_ibfk_1` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `leave_setup_ibfk_2` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_type` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_setup`
--

LOCK TABLES `leave_setup` WRITE;
/*!40000 ALTER TABLE `leave_setup` DISABLE KEYS */;
/*!40000 ALTER TABLE `leave_setup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_trans_status`
--

DROP TABLE IF EXISTS `leave_trans_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leave_trans_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(1) NOT NULL,
  `name` varchar(30) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_trans_status`
--

LOCK TABLES `leave_trans_status` WRITE;
/*!40000 ALTER TABLE `leave_trans_status` DISABLE KEYS */;
INSERT INTO `leave_trans_status` VALUES (1,'0','Pending',NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(2,'1','Approved',NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(3,'2','Rejected',NULL,NULL,'2020-09-11 17:02:46',NULL,NULL);
/*!40000 ALTER TABLE `leave_trans_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_trans_type`
--

DROP TABLE IF EXISTS `leave_trans_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leave_trans_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(1) NOT NULL,
  `name` varchar(30) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_trans_type`
--

LOCK TABLES `leave_trans_type` WRITE;
/*!40000 ALTER TABLE `leave_trans_type` DISABLE KEYS */;
INSERT INTO `leave_trans_type` VALUES (1,'0','Leave Claim',NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(2,'1','Leave Taken',NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(3,'2','Leave Expired',NULL,NULL,'2020-09-11 17:02:46',NULL,NULL);
/*!40000 ALTER TABLE `leave_trans_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_type`
--

DROP TABLE IF EXISTS `leave_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leave_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_type`
--

LOCK TABLES `leave_type` WRITE;
/*!40000 ALTER TABLE `leave_type` DISABLE KEYS */;
INSERT INTO `leave_type` VALUES (1,'AL','Annual Leave',NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(2,'DO','Days Off',NULL,NULL,'2020-09-11 17:02:46',NULL,NULL);
/*!40000 ALTER TABLE `leave_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leaves_balance`
--

DROP TABLE IF EXISTS `leaves_balance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leaves_balance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `leave_setup_id` int(11) DEFAULT NULL,
  `leave_setup_code` varchar(5) DEFAULT NULL,
  `year` year(4) NOT NULL,
  `month` int(11) NOT NULL,
  `days` int(11) NOT NULL,
  `valid_at` date NOT NULL,
  `expired_at` date NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_id` (`employee_id`),
  KEY `leave_setup_id` (`leave_setup_id`),
  CONSTRAINT `leaves_balance_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `leaves_balance_ibfk_2` FOREIGN KEY (`leave_setup_id`) REFERENCES `leave_setup` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leaves_balance`
--

LOCK TABLES `leaves_balance` WRITE;
/*!40000 ALTER TABLE `leaves_balance` DISABLE KEYS */;
/*!40000 ALTER TABLE `leaves_balance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leaves_trans`
--

DROP TABLE IF EXISTS `leaves_trans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leaves_trans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `leave_type_id` int(11) DEFAULT NULL,
  `leave_trans_type_id` int(11) DEFAULT NULL,
  `leave_trans_status_id` int(11) DEFAULT NULL,
  `reason` varchar(150) NOT NULL,
  `application_date` date NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `year` year(4) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `holiday_count` int(11) DEFAULT NULL,
  `previous_balance` int(11) DEFAULT NULL,
  `balance` int(11) DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `approved_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `employee_id` (`employee_id`),
  KEY `leave_type_id` (`leave_type_id`),
  KEY `leave_trans_type_id` (`leave_trans_type_id`),
  KEY `leave_trans_status_id` (`leave_trans_status_id`),
  CONSTRAINT `leaves_trans_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `leaves_trans_ibfk_2` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_type` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `leaves_trans_ibfk_3` FOREIGN KEY (`leave_trans_type_id`) REFERENCES `leave_trans_type` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `leaves_trans_ibfk_4` FOREIGN KEY (`leave_trans_status_id`) REFERENCES `leave_trans_status` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leaves_trans`
--

LOCK TABLES `leaves_trans` WRITE;
/*!40000 ALTER TABLE `leaves_trans` DISABLE KEYS */;
/*!40000 ALTER TABLE `leaves_trans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medical_checkups`
--

DROP TABLE IF EXISTS `medical_checkups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medical_checkups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(30) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `provider` varchar(50) DEFAULT NULL,
  `company_id` int(11) NOT NULL DEFAULT '0',
  `patient_id` int(11) NOT NULL,
  `checkup_at` date NOT NULL,
  `height` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `ideal_weight` int(11) DEFAULT NULL,
  `bmi` int(11) DEFAULT NULL,
  `nutrition_stat` varchar(50) DEFAULT NULL,
  `skin` varchar(50) DEFAULT NULL,
  `left_vision` varchar(50) DEFAULT NULL,
  `right_vision` varchar(50) DEFAULT NULL,
  `conjungtiva` varchar(50) DEFAULT NULL,
  `sclera` varchar(50) DEFAULT NULL,
  `pupil` varchar(50) DEFAULT NULL,
  `color_blind` varchar(50) DEFAULT NULL,
  `eye_ball` varchar(50) DEFAULT NULL,
  `cornea` varchar(50) DEFAULT NULL,
  `outer_ear` varchar(50) DEFAULT NULL,
  `nose` varchar(50) DEFAULT NULL,
  `tongue` varchar(50) DEFAULT NULL,
  `upper_teeth` varchar(50) DEFAULT NULL,
  `lower_teeth` varchar(50) DEFAULT NULL,
  `pharing` varchar(50) DEFAULT NULL,
  `tonsil` varchar(50) DEFAULT NULL,
  `blood_pressure` varchar(20) DEFAULT NULL,
  `pulse` varchar(30) DEFAULT NULL,
  `rhythm` varchar(20) DEFAULT NULL,
  `frequency` varchar(30) DEFAULT NULL,
  `lung` varchar(30) DEFAULT NULL,
  `vesiculer` varchar(30) DEFAULT NULL,
  `ronchi` varchar(30) DEFAULT NULL,
  `wheezing` varchar(30) DEFAULT NULL,
  `ekg` varchar(50) DEFAULT NULL,
  `audio_test` varchar(50) DEFAULT NULL,
  `usg` varchar(50) DEFAULT NULL,
  `treadmill` varchar(50) DEFAULT NULL,
  `conclusion` text,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medical_checkups`
--

LOCK TABLES `medical_checkups` WRITE;
/*!40000 ALTER TABLE `medical_checkups` DISABLE KEYS */;
INSERT INTO `medical_checkups` VALUES (1,NULL,NULL,NULL,0,1,'2020-09-12',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-09-11 10:04:14','2020-09-11 10:04:14',NULL);
/*!40000 ALTER TABLE `medical_checkups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patient_labs_result`
--

DROP TABLE IF EXISTS `patient_labs_result`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient_labs_result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `lab_id` int(11) NOT NULL,
  `medical_checkup_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient_labs_result`
--

LOCK TABLES `patient_labs_result` WRITE;
/*!40000 ALTER TABLE `patient_labs_result` DISABLE KEYS */;
INSERT INTO `patient_labs_result` VALUES (1,1,7,1,NULL,NULL,'2020-09-12 16:13:04','2020-09-12 09:13:04','2020-09-12 09:13:04'),(2,1,6,1,NULL,NULL,'2020-09-11 10:10:21','2020-09-11 10:10:21',NULL),(3,1,4,1,NULL,NULL,'2020-09-11 10:16:11','2020-09-11 10:16:11',NULL),(4,1,3,1,NULL,NULL,'2020-09-12 16:13:04','2020-09-12 09:13:04','2020-09-12 09:13:04'),(5,1,7,1,NULL,NULL,'2020-09-12 09:13:33','2020-09-12 09:13:33',NULL);
/*!40000 ALTER TABLE `patient_labs_result` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patients`
--

DROP TABLE IF EXISTS `patients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `code` varchar(255) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `kelurahan` varchar(50) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `zip` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `ever_had_disease` tinyint(1) DEFAULT NULL,
  `ever_had_treated` tinyint(1) DEFAULT NULL,
  `ever_had_surgery` tinyint(1) DEFAULT NULL,
  `ever_had_accident` tinyint(1) DEFAULT NULL,
  `smoking_habit` tinyint(1) DEFAULT NULL,
  `alcohol_habit` tinyint(1) DEFAULT NULL,
  `coffe_habit` tinyint(1) DEFAULT NULL,
  `exercise_habit` tinyint(1) DEFAULT NULL,
  `had_hypertension` tinyint(1) DEFAULT NULL,
  `had_diabetes` tinyint(1) DEFAULT NULL,
  `had_heart_disease` tinyint(1) DEFAULT NULL,
  `had_kidney_disease` tinyint(1) DEFAULT NULL,
  `had_mentally_ill` tinyint(1) DEFAULT NULL,
  `is_being_treated` tinyint(1) DEFAULT NULL,
  `long_being_sick` int(11) DEFAULT NULL,
  `being_sick` tinyint(1) DEFAULT NULL,
  `sickness` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patients`
--

LOCK TABLES `patients` WRITE;
/*!40000 ALTER TABLE `patients` DISABLE KEYS */;
INSERT INTO `patients` VALUES (1,'Hisyam','HIDSDSD323232',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-09-11 10:03:53','2020-09-11 10:03:53',NULL);
/*!40000 ALTER TABLE `patients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phinxlog`
--

DROP TABLE IF EXISTS `phinxlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phinxlog`
--

LOCK TABLES `phinxlog` WRITE;
/*!40000 ALTER TABLE `phinxlog` DISABLE KEYS */;
INSERT INTO `phinxlog` VALUES (20180609140938,'InitMigration','2020-09-11 10:02:35','2020-09-11 10:02:36',0);
/*!40000 ALTER TABLE `phinxlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) NOT NULL,
  `name` varchar(20) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `positions`
--

LOCK TABLES `positions` WRITE;
/*!40000 ALTER TABLE `positions` DISABLE KEYS */;
/*!40000 ALTER TABLE `positions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(20) NOT NULL,
  `value` varchar(100) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) NOT NULL,
  `name` varchar(20) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
INSERT INTO `user_roles` VALUES (1,'0','Super User',NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(2,'1','Admin Dept',NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(3,'2','User Approval',NULL,NULL,'2020-09-11 17:02:46',NULL,NULL),(4,'3','Employee',NULL,NULL,'2020-09-11 17:02:46',NULL,NULL);
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user_role_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`email`),
  KEY `user_role_id` (`user_role_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_role_id`) REFERENCES `user_roles` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'hisyam','$2y$10$O6P9s8uNh6wN/NtpE7h1dODbhm..3g4G8/tVFr21WLQSvDLEmFqHO','iam.ahmadhisyam@gmail.com',1,'Ahmad Hisyam',NULL,NULL,'2020-09-11 17:02:46',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-09-15 17:30:51
