-- MySQL dump 10.13  Distrib 8.0.45, for Win64 (x86_64)
--
-- Host: localhost    Database: bienes_raices
-- ------------------------------------------------------
-- Server version	8.4.7

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
-- Table structure for table `propiedades`
--

DROP TABLE IF EXISTS `propiedades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `propiedades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(60) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `descripcion` longtext,
  `habitaciones` int DEFAULT NULL,
  `wc` int DEFAULT NULL,
  `estacionamiento` int DEFAULT NULL,
  `creado` date DEFAULT NULL,
  `vendedorId` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vendedorId_idx` (`vendedorId`),
  CONSTRAINT `vendedorId` FOREIGN KEY (`vendedorId`) REFERENCES `vendedores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propiedades`
--

LOCK TABLES `propiedades` WRITE;
/*!40000 ALTER TABLE `propiedades` DISABLE KEYS */;
INSERT INTO `propiedades` VALUES (5,'Casa Oasis',22559998.00,'4740b4f3d2c4524e45b21feeee1de87d.jpg','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi imperdiet lacus vitae vehicula vehicula. Nunc ac rutrum ante. Vivamus et commodo felis. Etiam rutrum magna ligula, sit amet dictum tellus vulputate ut. Curabitur risus mauris, porttitor quis pulvinar vel, dapibus in eros. Phasellus ultrices ultrices risus. Suspendisse nec ipsum non augue vestibulum blandit.',2,1,1,'2026-02-20',1),(12,'Residencia Mar del Sur',1000000.00,'97de9dfd4e2de0a3aa63c52d12c4775d.jpg','Morbi sollicitudin urna a nunc dignissim, a sagittis orci fermentum. Sed tristique, odio sed rutrum commodo, elit ipsum finibus quam, pretium vehicula mi turpis non quam. Sed quis condimentum orci. Nullam non facilisis neque, id consectetur sapien. Nulla nec dolor ullamcorper, ornare eros eu,',1,2,3,'2026-03-08',1),(35,'Casa Los Álamos',451200.00,'8dc2b4ee14614c217e3dc518fe580955.jpg','Quisque auctor elementum dui, ac vulputate eros sollicitudin at. Proin in turpis quis elit accumsan vestibulum. Aliquam eget blandit ex, ac sodales ligula. Proin vel tempor diam, nec interdum tellus.',1,1,1,'2026-06-05',2),(36,'Casa Océano',21321312.00,'f64c6bdb25c78aa4e6fbd62757f23035.jpg','Quisque auctor elementum dui, ac vulputate eros sollicitudin at. Proin in turpis quis elit accumsan vestibulum. Aliquam eget blandit ex, ac sodales ligula. Proin vel tempor diam, nec interdum tellus.',1,1,1,'2026-06-13',2);
/*!40000 ALTER TABLE `propiedades` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-20 23:28:44
