-- MySQL dump 10.13  Distrib 5.6.23, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: humboldt
-- ------------------------------------------------------
-- Server version	5.5.32

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
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Casas / Townhouses',NULL,'2017-05-08'),(2,'Apartamentos',NULL,'2017-05-08'),(4,'Oficina / Local / Negocio','2017-05-08','2017-05-08'),(5,'Terreno / Lote','2017-05-08','2017-05-08'),(6,'Galpón / Depósito','2017-05-08','2017-05-08'),(7,'Edificio / Fábrica / Otros','2017-05-08','2017-05-08'),(8,'Vacacional','2017-05-08','2017-05-08');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publication_id` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `msg` text,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (5,3,'holis','contacto@contacto.com',NULL,NULL,NULL),(6,3,'holis','contacto@contacto.com',NULL,NULL,NULL),(7,4,'holis','contacto@contacto.com',NULL,NULL,NULL),(8,5,'holis','contacto@contacto.com',NULL,NULL,NULL),(9,5,'holis','contacto@contacto.com',NULL,NULL,NULL),(10,2,'holis','contacto@contacto.com',NULL,NULL,NULL),(11,2,'holis','contacto@contacto.com',NULL,NULL,NULL),(12,2,'holis','contacto@contacto.com',NULL,NULL,NULL),(13,2,'holis','contacto@contacto.com',NULL,NULL,NULL),(14,4,'holis','contacto@contacto.com',NULL,NULL,NULL),(15,4,'holis','contacto@contacto.com',NULL,NULL,NULL),(16,3,'carlucho salazar','shenlong_12@hotmail.com','Me gustaría obtener información de la propiedad vhs-001','2017-05-09','2017-05-09'),(17,3,'ssssss','shenlong_12@hotmail.com','Me gustaría obtener información de la propiedad vhs-001','2017-05-09','2017-05-09'),(18,2,'lucho','emailote@email.com','Me gustaría obtener información de la propiedad vhs-004','2017-05-16','2017-05-16'),(19,3,'pepito','emailote@email.com','Me gustaría obtener información de la propiedad vhs-001','2017-05-17','2017-05-17'),(20,3,'nombre','emailote@email.com','Me gustaría obtener información de la propiedad vhs-001','2017-05-18','2017-05-18'),(21,3,'prueaba','lalala@lalala.com','Me gustaría obtener información de la propiedad vhs-001','2017-05-18','2017-05-18');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operations`
--

DROP TABLE IF EXISTS `operations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operations`
--

LOCK TABLES `operations` WRITE;
/*!40000 ALTER TABLE `operations` DISABLE KEYS */;
INSERT INTO `operations` VALUES (1,'venta',NULL,NULL),(2,'alquiler',NULL,NULL),(3,'remodelación',NULL,NULL);
/*!40000 ALTER TABLE `operations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publication_images`
--

DROP TABLE IF EXISTS `publication_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publication_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publication_id` int(11) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publication_images`
--

LOCK TABLES `publication_images` WRITE;
/*!40000 ALTER TABLE `publication_images` DISABLE KEYS */;
INSERT INTO `publication_images` VALUES (1,3,'1494030043.jpg','2017-05-04','2017-05-06'),(2,3,'1494030044.jpg','2017-05-04','2017-05-06'),(3,4,'1494030274.jpg','2017-05-04','2017-05-06'),(4,4,'1494030275.jpg','2017-05-04','2017-05-06'),(5,3,'1494030045.jpg','2017-05-04','2017-05-06'),(7,5,'1494030421.jpg','2017-05-05','2017-05-06'),(8,5,'1494030422.jpg','2017-05-05','2017-05-06'),(9,2,'1494033519.jpg','2017-05-05','2017-05-06'),(10,2,'1494033520.jpg','2017-05-05','2017-05-06'),(11,2,'1494033521.jpg','2017-05-05','2017-05-06'),(12,2,'1494033522.jpg','2017-05-05','2017-05-06'),(14,7,'1494283230.jpg','2017-05-08','2017-05-08'),(15,7,'1494283231.jpg','2017-05-08','2017-05-08'),(16,7,'1494283556.jpg','2017-05-08','2017-05-08'),(17,7,'1494283557.jpg','2017-05-08','2017-05-08'),(18,8,'1495133673.jpg','2017-05-18','2017-05-18'),(19,8,'1495133674.jpg','2017-05-18','2017-05-18'),(20,9,'1495133758.jpg','2017-05-18','2017-05-18'),(21,9,'1495133759.jpg','2017-05-18','2017-05-18');
/*!40000 ALTER TABLE `publication_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publication_miscs`
--

DROP TABLE IF EXISTS `publication_miscs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publication_miscs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publication_id` int(11) DEFAULT NULL,
  `rooms` int(11) DEFAULT NULL,
  `bathrooms` int(11) DEFAULT NULL,
  `size` varchar(20) DEFAULT NULL,
  `parking_slots` int(11) DEFAULT NULL,
  `map` text,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publication_miscs`
--

LOCK TABLES `publication_miscs` WRITE;
/*!40000 ALTER TABLE `publication_miscs` DISABLE KEYS */;
INSERT INTO `publication_miscs` VALUES (1,3,8,8,'3000',6,'<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3925.9915245598663!2d-67.59055108577907!3d10.26226589267163!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e803b5c65b805bf%3A0xf8c853f11248235b!2sCentro+Comercial+Las+Americas!5e0!3m2!1ses!2sve!4v1493310487424\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe> ','2017-05-04','2017-05-06'),(2,4,2,1,'90',2,'<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3925.9915245598663!2d-67.59055108577907!3d10.26226589267163!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e803b5c65b805bf%3A0xf8c853f11248235b!2sCentro+Comercial+Las+Americas!5e0!3m2!1ses!2sve!4v1493310487424\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe> ','2017-05-04','2017-05-06'),(3,5,3,2,'100',1,'<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3925.9915245598663!2d-67.59055108577907!3d10.26226589267163!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e803b5c65b805bf%3A0xf8c853f11248235b!2sCentro+Comercial+Las+Americas!5e0!3m2!1ses!2sve!4v1493310487424\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe> ','2017-05-05','2017-05-06'),(4,2,8,81,'1800       ',2,'<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3925.9915245598663!2d-67.59055108577907!3d10.26226589267163!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e803b5c65b805bf%3A0xf8c853f11248235b!2sCentro+Comercial+Las+Americas!5e0!3m2!1ses!2sve!4v1493310487424\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>       ','2017-05-05','2017-05-06'),(5,7,0,0,'2000 ',0,'<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3925.9915245598663!2d-67.59055108577907!3d10.26226589267163!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e803b5c65b805bf%3A0xf8c853f11248235b!2sCentro+Comercial+Las+Americas!5e0!3m2!1ses!2sve!4v1493310487424\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe> ','2017-05-08','2017-05-08'),(6,8,4,3,'1000',2,'<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3925.9915245598663!2d-67.59055108577907!3d10.26226589267163!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e803b5c65b805bf%3A0xf8c853f11248235b!2sCentro+Comercial+Las+Americas!5e0!3m2!1ses!2sve!4v1493310487424\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>','2017-05-18','2017-05-18'),(7,9,3,2,'80',4,'<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3925.9915245598663!2d-67.59055108577907!3d10.26226589267163!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e803b5c65b805bf%3A0xf8c853f11248235b!2sCentro+Comercial+Las+Americas!5e0!3m2!1ses!2sve!4v1493310487424\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>','2017-05-18','2017-05-18');
/*!40000 ALTER TABLE `publication_miscs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publications`
--

DROP TABLE IF EXISTS `publications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publication_cod` varchar(20) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `operation_id` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `price` float DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publications`
--

LOCK TABLES `publications` WRITE;
/*!40000 ALTER TABLE `publications` DISABLE KEYS */;
INSERT INTO `publications` VALUES (2,'vhs-004',2,2,'Venta de casa','<blockquote>\r\n<p style=\"text-align:center\">Lorem ipsum sied meier lalala lulu li la lel olela&nbsp;Lorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olela</p>\r\n</blockquote>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><s>Lorem ipsum sied meier lalala lulu li la lel olela</s></li>\r\n	<li style=\"text-align:justify\"><em>Lorem ipsum sied meier lalala lulu li la lel olela</em></li>\r\n	<li style=\"text-align:justify\"><strong>Lorem ipsum sied meier lalala lulu li la lel olela</strong></li>\r\n</ul>\r\n',150000,NULL,'2017-05-04','2017-05-06'),(3,'vhs-001',1,1,'Venta de mansion super bonita','<p style=\"text-align:center\">Lorem ipsum sied meier lalala lulu li la lel olela&nbsp;Lorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olela</p>\r\n\r\n<ol>\r\n	<li style=\"text-align:justify\">Lorem ipsum sied meier lalala lulu li la lel olela</li>\r\n</ol>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><em>Lorem ipsum sied meier lalala lulu li la lel olela</em></li>\r\n	<li style=\"text-align:justify\"><strong>Lorem ipsum sied meier lalala lulu li la lel olela</strong></li>\r\n</ul>\r\n',3000000,NULL,'2017-05-04','2017-05-06'),(4,'vhs-002',2,2,'Alquiler de apartamento bien bonito','<p style=\"text-align:justify\">Lorem ipsum sied meier lalala lulu li la lel olela&nbsp;Lorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olela</p>\r\n\r\n<hr />\r\n<blockquote>\r\n<ul>\r\n	<li style=\"text-align:justify\">?Lorem ipsum sied meier lalala lulu li la lel olela</li>\r\n	<li style=\"text-align:justify\">Lorem ipsum sied meier lalala lulu li la lel olela</li>\r\n	<li style=\"text-align:justify\">Lorem ipsum sied meier lalala lulu li la lel olela</li>\r\n</ul>\r\n</blockquote>\r\n',100000,NULL,'2017-05-04','2017-05-06'),(5,'vhs-003',1,1,'Venta de apartamento bien bonito','<blockquote>\r\n<p style=\"text-align:justify\">Lorem ipsum sied meier lalala lulu li la lel olela&nbsp;Lorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olela</p>\r\n</blockquote>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><strong>Lorem ipsum sied meier lalala lulu li la lel olela</strong></li>\r\n	<li style=\"text-align:justify\"><em>Lorem ipsum sied meier lalala lulu li la lel olela</em></li>\r\n	<li style=\"text-align:justify\"><s>Lorem ipsum sied meier lalala lulu li la lel olela</s></li>\r\n</ul>\r\n',90000,NULL,'2017-05-05','2017-05-06'),(7,'vhs-006',5,1,'Terreno en Venta','<blockquote>\r\n<p style=\"text-align:justify\">Lorem ipsum sied meier lalala lulu li la lel olela&nbsp;Lorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olelaLorem ipsum sied meier lalala lulu li la lel olela</p>\r\n</blockquote>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><strong>Lorem ipsum sied meier lalala lulu li la lel olela</strong></li>\r\n	<li style=\"text-align:justify\"><em>Lorem ipsum sied meier lalala lulu li la lel olela</em></li>\r\n	<li style=\"text-align:justify\"><s>Lorem ipsum sied meier lalala lulu li la lel olela</s></li>\r\n</ul>\r\n',2500000,NULL,'2017-05-08','2017-05-08'),(8,'vhs-007',1,1,'Nuevo titulo','<p>Esto es la descripcion</p>\r\n\r\n<ul>\r\n	<li>aqui pueden</li>\r\n	<li>ir otras opciones</li>\r\n	<li>que no se reflejan</li>\r\n	<li>en los campos</li>\r\n	<li>de arriba</li>\r\n</ul>\r\n',800000,NULL,'2017-05-18','2017-05-18'),(9,'vhs-008',4,1,'Casa en venta','<p>Esto es una descripcion para la casa presentada</p>\r\n',1500000,NULL,'2017-05-18','2017-05-18');
/*!40000 ALTER TABLE `publications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publicities`
--

DROP TABLE IF EXISTS `publicities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publicities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ubication` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publicities`
--

LOCK TABLES `publicities` WRITE;
/*!40000 ALTER TABLE `publicities` DISABLE KEYS */;
INSERT INTO `publicities` VALUES (1,1,'Titulo','http://localhost/realestate/public/','1494780746.jpg','2017-05-15','2017-06-15','2017-05-14','2017-05-14'),(3,3,'Publicidad de inmobiliaria','http://localhost/realestate/public/','1494784038.jpg','2017-05-23','2017-06-15','2017-05-14','2017-05-15'),(4,3,'Publicidad nueva','http://localhost/realestate/public/','1494784138.jpg','2017-05-15','2017-06-30','2017-05-14','2017-05-14'),(5,3,NULL,NULL,'1494853092.jpg','2017-05-16','2017-06-15','2017-05-15','2017-05-15');
/*!40000 ALTER TABLE `publicities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,'primeras preguntas','<p>Texto de rellenoTexto de rellenoTexto de rellenoTexto de rellenoTexto de rellenoTexto de rellenoTexto de rellenoTexto de rellenoTexto de rellenoTexto de rellenoTexto de rellenoTexto de rellenoTexto de rellenoTexto de rellenoTexto de rellenoTexto de rellenoTexto de rellenoTexto de rellenoTexto de rellenoTexto de rellenoTexto de rellenoTexto de rellenoTexto de rellenoTexto de rellenoTexto de rellenoTexto de rellenossssss</p>\r\n','2017-05-18','2017-05-18'),(4,'Segunda pregunta','<p>Esto es la segunda pregunta para las preguntas frecuentes</p>\r\n','2017-05-18','2017-05-18');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_desc` varchar(45) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'administrador',NULL,NULL),(2,'usuario',NULL,NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slides`
--

DROP TABLE IF EXISTS `slides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(100) DEFAULT '#!',
  `image` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT 'Inversora Humboldt',
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `show_title` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slides`
--

LOCK TABLES `slides` WRITE;
/*!40000 ALTER TABLE `slides` DISABLE KEYS */;
INSERT INTO `slides` VALUES (1,'http://localhost/realestate/public/','1495134710.jpg','Inversora en Bienes Raices','2017-05-06','2017-05-18',0),(2,'#!','1495134088.jpg','Inversora Humboldt','2017-05-06','2017-05-18',0),(4,'#!','1494603679.jpg','Titulo ha mostrar','2017-05-12','2017-05-12',1);
/*!40000 ALTER TABLE `slides` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ubications`
--

DROP TABLE IF EXISTS `ubications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ubications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ubications`
--

LOCK TABLES `ubications` WRITE;
/*!40000 ALTER TABLE `ubications` DISABLE KEYS */;
INSERT INTO `ubications` VALUES (1,'Pagina Principal',NULL,NULL),(2,'Pagina de Busqueda',NULL,NULL),(3,'Pagina de Publicación',NULL,NULL);
/*!40000 ALTER TABLE `ubications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(60) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `name` varchar(16) DEFAULT NULL,
  `lastname` varchar(16) DEFAULT NULL,
  `address` text,
  `role_id` int(11) DEFAULT '1',
  `remember_token` varchar(100) DEFAULT NULL,
  `avatar` varchar(20) DEFAULT 'avatar5.png',
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$10$i.glwRA1ohU3abaTlqkIs.5MXeuGNhhjp1izQwXVwAC23kvnfalQy','carlucho','salazar',NULL,1,'bzvkgl6w3u7yQRQpLTOJYCBA4LYX2VGCEzbzf7eq84EApYzs2OvLNTAEeBpb','avatar5.png',NULL,'2017-05-01'),(4,'prueba','$2y$10$uxS2/4HgZwe6wvhIEdDfneZRJ.Wh2pCDvSHLzLhVWSKBEePXTTi1i',NULL,NULL,NULL,1,NULL,'avatar5.png','2017-05-02','2017-05-02');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'humboldt'
--

--
-- Dumping routines for database 'humboldt'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-18 15:22:47
