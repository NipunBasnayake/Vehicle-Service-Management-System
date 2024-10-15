-- MySQL dump 10.13  Distrib 8.0.24, for Win64 (x86_64)
--
-- Host: localhost    Database: pvsc
-- ------------------------------------------------------
-- Server version	8.0.24

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
-- Table structure for table `tbladmin`
--

DROP TABLE IF EXISTS `tbladmin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbladmin` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `AdminName` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `UserName` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `MobileNumber` bigint DEFAULT NULL,
  `Email` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Password` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbladmin`
--

LOCK TABLES `tbladmin` WRITE;
/*!40000 ALTER TABLE `tbladmin` DISABLE KEYS */;
INSERT INTO `tbladmin` VALUES (1,'Admin','admin',5689784589,'admin@gmail.com','f925916e2754e5e03f75dd58a5733251','2024-01-30 11:48:13');
/*!40000 ALTER TABLE `tbladmin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblbooking`
--

DROP TABLE IF EXISTS `tblbooking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblbooking` (
  `BookingID` int NOT NULL,
  `ServiceID` int DEFAULT NULL,
  `UserID` int DEFAULT NULL,
  `BookDate` date DEFAULT NULL,
  `BookTime` time DEFAULT NULL,
  `vehicleNumber` varchar(100) DEFAULT NULL,
  `NumberOfWheels` varchar(20) DEFAULT NULL,
  `Message` text,
  `Status` varchar(50) DEFAULT NULL,
  `additional` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`BookingID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblbooking`
--

LOCK TABLES `tblbooking` WRITE;
/*!40000 ALTER TABLE `tblbooking` DISABLE KEYS */;
INSERT INTO `tblbooking` VALUES (325028325,12,15,'2024-10-24','14:34:00','fg3456','10 Wheeler','','Approved',''),(550815808,11,15,'2024-10-22','12:50:00','KG-1234','4 Wheeler','','Approved',''),(576717200,12,16,'2024-10-23','04:30:00','BBB-1234','2 Wheeler','','Pending','');
/*!40000 ALTER TABLE `tblbooking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcontact`
--

DROP TABLE IF EXISTS `tblcontact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcontact` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Email` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Message` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `EnquiryDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IsRead` int DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcontact`
--

LOCK TABLES `tblcontact` WRITE;
/*!40000 ALTER TABLE `tblcontact` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcontact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblpage`
--

DROP TABLE IF EXISTS `tblpage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblpage` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `PageType` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `PageTitle` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `PageDescription` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `Email` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `MobileNumber` bigint DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblpage`
--

LOCK TABLES `tblpage` WRITE;
/*!40000 ALTER TABLE `tblpage` DISABLE KEYS */;
INSERT INTO `tblpage` VALUES (1,'aboutus','About Us','<p>Welcome to <strong>Perera Vehicle Service</strong>, where your vehicle’s performance and safety are our highest priority. Founded on a passion for excellence and a commitment to customer satisfaction, we have proudly served our community for years, earning the trust of drivers and vehicle owners with our exceptional service standards.</p><p>At Perera Vehicle Service, we offer a wide range of services to meet all your automotive needs, from routine maintenance like oil changes and tire rotations to complex mechanical repairs and diagnostics. Our certified technicians are trained to work on vehicles of all makes and models, ensuring that no matter what you drive, we’ve got you covered. We use the latest technology and diagnostic tools, combined with high-quality parts, to deliver the best results every time.</p><p>Our goal is to make vehicle maintenance and repair as seamless and stress-free as possible. When you bring your vehicle to us, we ensure that every detail is handled with precision and care. We believe in clear communication with our customers, which is why we provide transparent estimates, explain the necessary repairs, and keep you informed every step of the way. No surprises—just honest, reliable service that keeps you and your car on the road safely.</p><p>What sets <strong>Perera Vehicle Service</strong> apart is our dedication to personalized service. We know that each vehicle is unique, and so are the needs of its owner. Whether you\'re here for a quick fix or a major overhaul, we treat every vehicle as if it were our own, ensuring it leaves our shop in optimal condition. Our friendly and knowledgeable staff are always available to answer any questions you may have and offer professional advice on maintaining your vehicle’s performance for years to come.</p><p>Thank you for choosing Perera Vehicle Service. We look forward to serving you and keeping your vehicle in top condition!</p>',NULL,NULL,'2024-10-13 16:10:17'),(2,'contactus','Contact Us','No.173, Migahakotuwa, Kuliyapitiya',' info@pereraservicestations.lk',770000000,'2024-10-13 16:10:42');
/*!40000 ALTER TABLE `tblpage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblservice`
--

DROP TABLE IF EXISTS `tblservice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblservice` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `ServiceName` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `SerDes` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ServicePrice` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblservice`
--

LOCK TABLES `tblservice` WRITE;
/*!40000 ALTER TABLE `tblservice` DISABLE KEYS */;
INSERT INTO `tblservice` VALUES (11,'Full Service','A full vehicle service ensures optimal performance, enhances safety, prevents breakdowns, extends vehicle lifespan, and maintains fuel efficiency.','LKR 12000','2024-09-21 21:05:51'),(12,'Oil Change','Frequent oil changes are vital for engine health. They reduce wear, enhance lubrication, and help extend your vehicle\'s lifespan effectively.','LKR 4000','2024-09-21 21:06:46'),(13,'Body Wash','A vehicle body wash protects against rust, preserves paint quality, and enhances the vehicle\'s overall appearance.','LKR 1500','2024-09-21 21:07:18'),(14,'Wheel Alignment','Correct wheel alignment boosts driving safety, increases fuel efficiency, and ensures a smoother, more comfortable ride overall.','LKR 8000','2024-09-21 21:07:40');
/*!40000 ALTER TABLE `tblservice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbluser`
--

DROP TABLE IF EXISTS `tbluser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbluser` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `FullName` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `MobileNumber` bigint DEFAULT NULL,
  `Email` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbluser`
--

LOCK TABLES `tbluser` WRITE;
/*!40000 ALTER TABLE `tbluser` DISABLE KEYS */;
INSERT INTO `tbluser` VALUES (15,'Test User',770000000,'test@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','2024-10-14 15:16:37'),(16,'Test User2',987654322,'test2@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','2024-10-15 19:00:09');
/*!40000 ALTER TABLE `tbluser` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-16  0:42:48
