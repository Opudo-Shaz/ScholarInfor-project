-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: mvogms_db
-- ------------------------------------------------------
-- Server version	5.7.40-log

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
-- Table structure for table `cart_list`
--

DROP TABLE IF EXISTS `cart_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `client_id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `quantity` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `cart_list_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client_list` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_list_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product_list` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart_list`
--

LOCK TABLES `cart_list` WRITE;
/*!40000 ALTER TABLE `cart_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_list`
--

DROP TABLE IF EXISTS `category_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `vendor_id` (`vendor_id`),
  CONSTRAINT `category_list_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor_list` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_list`
--

LOCK TABLES `category_list` WRITE;
/*!40000 ALTER TABLE `category_list` DISABLE KEYS */;
INSERT INTO `category_list` VALUES (2,2,'Sample 101','This is a sample Category Only.',1,0,'2022-02-09 11:03:40','2022-02-09 11:05:03'),(3,2,'Sample 102','This is a sample Category 102',1,0,'2022-02-09 11:05:57',NULL),(4,2,'Category 103','Sample Category 103',1,0,'2022-02-09 11:06:10',NULL),(5,2,'test','test',0,1,'2022-02-09 11:06:17','2022-02-09 11:06:20'),(6,1,'Category 101','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper leo vitae dui rutrum ultricies. Etiam sit amet odio lorem. In sit amet cursus justo',1,0,'2022-02-09 11:09:36',NULL),(7,1,'Category 102','Morbi pellentesque, dolor in sodales pretium, libero leo finibus arcu, vitae pharetra ligula quam quis enim. Quisque suscipit venenatis finibus.',1,0,'2022-02-09 11:09:45',NULL),(8,1,'Category 103','Curabitur fermentum, diam ut dictum molestie, eros dolor luctus dolor, in hendrerit dui sapien vel lorem. Nulla ultrices gravida nisl, id feugiat turpis varius a. In iaculis lorem nisi. Aliquam nec aliquam ipsum, vitae fermentum dui.',1,0,'2022-02-09 11:10:19',NULL),(9,1,'Category 104','Phasellus luctus ultricies dui, non euismod massa congue id. Fusce ut nisi convallis, aliquam dolor consectetur, varius enim. Phasellus dignissim, erat ac ullamcorper lacinia, nibh est auctor risus, eget ornare est felis et orci.',1,0,'2022-02-09 11:10:35',NULL);
/*!40000 ALTER TABLE `category_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_list`
--

DROP TABLE IF EXISTS `client_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text,
  `lastname` text NOT NULL,
  `gender` text NOT NULL,
  `contact` text NOT NULL,
  `address` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_list`
--

LOCK TABLES `client_list` WRITE;
/*!40000 ALTER TABLE `client_list` DISABLE KEYS */;
INSERT INTO `client_list` VALUES (1,'202202-00001','John','D','Smith','Male','09123456789','This is only my sample address','jsmith@sample.com','1254737c076cf867dc53d60a0364f38e','uploads/clients/1.png?v=1644386016',1,0,'2022-02-09 13:53:36','2022-02-10 13:42:53'),(2,'202202-00002','test','test','test','Male','094564654','test','test@sample.com','098f6bcd4621d373cade4e832627b4f6','uploads/clients/2.png?v=1644471867',1,1,'2022-02-10 13:44:26','2022-02-10 13:44:35');
/*!40000 ALTER TABLE `client_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `order_id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `quantity` double NOT NULL DEFAULT '0',
  `price` double NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_list` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product_list` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (1,1,3,1500,'2022-02-10 09:56:49'),(2,7,10,285.99,'2022-02-10 09:56:49'),(3,4,5,50,'2022-02-10 10:29:01'),(3,3,5,125,'2022-02-10 10:29:01'),(3,5,3,150,'2022-02-10 10:29:01'),(4,6,3,45.88,'2022-02-10 10:29:01'),(4,7,3,285.99,'2022-02-10 10:29:01'),(5,4,11,50,'2024-04-30 12:35:32'),(5,1,5,1500,'2024-04-30 12:35:32'),(6,7,6,285.99,'2024-04-30 12:35:32');
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_list`
--

DROP TABLE IF EXISTS `order_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `client_id` int(30) NOT NULL,
  `vendor_id` int(30) NOT NULL,
  `total_amount` double NOT NULL DEFAULT '0',
  `delivery_address` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  KEY `vendor_id` (`vendor_id`),
  CONSTRAINT `order_list_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client_list` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_list_ibfk_2` FOREIGN KEY (`vendor_id`) REFERENCES `vendor_list` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_list`
--

LOCK TABLES `order_list` WRITE;
/*!40000 ALTER TABLE `order_list` DISABLE KEYS */;
INSERT INTO `order_list` VALUES (1,'202202-00001',1,1,4500,'This is only my sample address',5,'2022-02-10 09:56:49','2022-02-10 11:52:53'),(2,'202202-00002',1,2,7359.9,'This is only my sample address',0,'2022-02-10 09:56:49','2022-02-10 09:56:49'),(3,'202202-00003',1,1,1325,'This is only my sample address',1,'2022-02-10 10:29:00','2022-02-10 12:09:59'),(4,'202202-00004',1,2,2320.61,'This is only my sample address',0,'2022-02-10 10:29:01','2022-02-10 10:29:01'),(5,'202404-00001',1,1,8050,'This is only my sample address',5,'2024-04-30 12:35:32','2024-04-30 12:35:54'),(6,'202404-00002',1,2,1715.94,'This is only my sample address',0,'2024-04-30 12:35:32','2024-04-30 12:35:32');
/*!40000 ALTER TABLE `order_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_list`
--

DROP TABLE IF EXISTS `product_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(30) DEFAULT NULL,
  `category_id` int(30) DEFAULT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `image_path` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `vendor_id` (`vendor_id`),
  KEY `category_id` (`category_id`) USING BTREE,
  CONSTRAINT `product_list_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor_list` (`id`) ON DELETE SET NULL,
  CONSTRAINT `product_list_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category_list` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_list`
--

LOCK TABLES `product_list` WRITE;
/*!40000 ALTER TABLE `product_list` DISABLE KEYS */;
INSERT INTO `product_list` VALUES (1,1,9,'Product 101','<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper leo vitae dui rutrum ultricies. Etiam sit amet odio lorem. In sit amet cursus justo. Morbi pellentesque, dolor in sodales pretium, libero leo finibus arcu, vitae pharetra ligula quam quis enim. Quisque suscipit venenatis finibus. Curabitur fermentum, diam ut dictum molestie, eros dolor luctus dolor, in hendrerit dui sapien vel lorem. Nulla ultrices gravida nisl, id feugiat turpis varius a. In iaculis lorem nisi. Aliquam nec aliquam ipsum, vitae fermentum dui.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px;\">Phasellus luctus ultricies dui, non euismod massa congue id. Fusce ut nisi convallis, aliquam dolor consectetur, varius enim. Phasellus dignissim, erat ac ullamcorper lacinia, nibh est auctor risus, eget ornare est felis et orci. Pellentesque aliquam, lectus sed porttitor consequat, sem orci fringilla nisi, a pellentesque metus tellus nec tellus. Nullam metus tortor, mattis in tristique et, tincidunt ac dui. Praesent id viverra diam, vel cursus nulla. Vestibulum ut lobortis velit, a euismod eros. Integer dignissim finibus rhoncus. Praesent non neque ac ipsum lobortis commodo sed ac massa. Mauris justo tortor, dapibus sit amet dui sed, congue vehicula urna.</p>',1500,'uploads/products/1.png?v=1644379549',1,0,'2022-02-09 12:05:49','2022-02-09 14:32:27'),(2,1,9,'Loaf Bread','<p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">Nullam nisi metus, convallis quis consectetur vitae, laoreet ac nulla. Interdum et malesuada fames ac ante ipsum primis in faucibus. Proin ligula augue, vestibulum in auctor pharetra, posuere id lacus. Aenean aliquam felis quis condimentum congue. Donec porttitor ultricies mi eget vestibulum. Nullam in magna tortor. Suspendisse ullamcorper ultricies accumsan. Duis ultrices sollicitudin velit sed auctor. Vivamus semper placerat porttitor. Praesent diam lorem, luctus sit amet viverra non, consequat ac elit. Suspendisse eleifend massa sit amet nisl porta, eu rutrum massa blandit. Integer congue lacus non fringilla suscipit.</span><br></p>',85,'uploads/products/2.png?v=1644382715',1,0,'2022-02-09 12:58:35','2022-02-09 14:32:21'),(3,1,7,'Canned Soda','<p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">Aliquam erat volutpat. Fusce scelerisque pulvinar bibendum. Proin convallis elit at molestie egestas. Cras ornare ornare dolor quis mattis. Suspendisse in egestas odio. Fusce nibh ante, ultrices nec elit at, auctor elementum nunc. Curabitur facilisis mauris at congue maximus. Integer a facilisis nisl, sed laoreet odio. Nulla facilisi. Vivamus sed tincidunt eros, non convallis metus. Nullam vestibulum nisi at est euismod, et molestie ligula dapibus. Integer ligula felis, volutpat a accumsan id, egestas nec dolor. Duis dignissim condimentum lectus, eget pharetra ex laoreet vitae. Nam enim mauris, pharetra sit amet leo eget, condimentum lacinia neque.</span><br></p>',125,'uploads/products/3.png?v=1644382753',1,0,'2022-02-09 12:59:13','2022-02-09 14:32:08'),(4,1,6,'Canned Sardines','<p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">Praesent id pretium neque. Nullam nec scelerisque quam. Donec faucibus erat enim, sit amet aliquet ipsum suscipit at. Suspendisse interdum euismod libero, eu tincidunt ligula elementum a. Nulla id velit vestibulum nisl scelerisque pretium sed at neque. In dignissim purus ut nibh rutrum, at placerat ex elementum. Nam eleifend, sapien ac luctus eleifend, orci purus pulvinar nisl, et scelerisque erat turpis ac tellus. Duis a libero sit amet massa posuere molestie.</span><br></p>',50,'uploads/products/4.png?v=1644382779',1,0,'2022-02-09 12:59:38','2022-02-09 14:32:02'),(5,1,7,'Dry 101','<p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">Nam vel velit eget libero scelerisque varius. Morbi sodales consectetur eros sed lacinia. Phasellus lobortis, neque sed consequat commodo, felis elit tempor sapien, eu blandit ante ex eu magna. Maecenas pulvinar lectus sed augue pharetra porttitor et sed ligula. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent mattis ante est, sed fringilla nisi posuere non.</span><br></p>',150,'uploads/products/5.png?v=1644382802',1,0,'2022-02-09 13:00:02','2022-02-09 14:32:16'),(6,2,4,'Bottled Juice','<p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">Quisque commodo tincidunt rhoncus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas molestie lacus lacus. Pellentesque velit quam, cursus sit amet congue sed, facilisis et risus. Duis ac consequat eros, id venenatis tortor. Nulla vitae iaculis ante. Morbi id felis non ipsum facilisis sagittis. Integer sed quam et metus pretium tempor sit amet non neque. Praesent eu ante a mauris auctor tempor. Pellentesque luctus erat eget metus vulputate iaculis. Sed rhoncus malesuada ipsum, sed imperdiet leo consequat et. In eu mauris eu felis lacinia semper sit amet nec nisi. Aliquam convallis, neque eget dignissim aliquam, sem enim laoreet arcu, vitae maximus nisi nisl vitae tellus.</span><br></p>',45.88,'uploads/products/6.png?v=1644382977',1,0,'2022-02-09 13:02:57','2022-02-09 14:30:59'),(7,2,2,'Chicken Wings','<p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">Quisque aliquet tellus sed nulla vulputate pharetra et nec mauris. Nulla placerat magna sed enim ullamcorper, ac tempor turpis varius. Sed in ipsum id odio varius pellentesque. In hac habitasse platea dictumst. Nunc eget nisi sed nisl pellentesque posuere. Nulla quis nibh nec neque ornare mollis sed vitae eros. Nulla nulla turpis, bibendum euismod purus sit amet, semper aliquam enim. Proin dignissim ac nisl in lobortis. Aenean at justo vel ipsum pretium dapibus. Aliquam lorem mi, laoreet eu leo ac, congue blandit orci. Sed vulputate suscipit nibh, at ultrices ipsum sagittis nec.</span><br></p>',285.99,'uploads/products/7.png?v=1644383066',1,0,'2022-02-09 13:04:25','2022-02-09 14:31:48'),(8,2,4,'Chicken Fillet Raw','<p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">Ut viverra maximus orci et tincidunt. Aliquam erat volutpat. Morbi convallis nibh nec libero ultrices, id suscipit nisl facilisis. Maecenas sed consectetur leo, id tempus nisl. Maecenas tincidunt ultrices ex sed feugiat. Nunc sit amet arcu enim. Nunc tristique faucibus elit sed mollis. Cras commodo tincidunt porttitor.</span><br></p>',195.75,'uploads/products/8.png?v=1644383112',1,0,'2022-02-09 13:05:12','2022-02-09 14:31:40');
/*!40000 ALTER TABLE `product_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_type_list`
--

DROP TABLE IF EXISTS `shop_type_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shop_type_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_type_list`
--

LOCK TABLES `shop_type_list` WRITE;
/*!40000 ALTER TABLE `shop_type_list` DISABLE KEYS */;
INSERT INTO `shop_type_list` VALUES (1,'Dry Goods',1,0,'2022-02-09 08:49:34',NULL),(2,'Cosmetics',1,0,'2022-02-09 08:49:46',NULL),(3,'Produce',1,0,'2022-02-09 08:50:31',NULL),(4,'Anyy',1,0,'2022-02-09 08:50:36','2022-02-09 08:50:57'),(5,'Others',1,1,'2022-02-09 08:50:41','2022-02-09 08:50:45');
/*!40000 ALTER TABLE `shop_type_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_info`
--

DROP TABLE IF EXISTS `system_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `system_info` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_info`
--

LOCK TABLES `system_info` WRITE;
/*!40000 ALTER TABLE `system_info` DISABLE KEYS */;
INSERT INTO `system_info` VALUES (1,'name','Share The buzzz '),(6,'short_name','Buzzz'),(11,'logo','uploads/logo-1644367440.png'),(13,'user_avatar','uploads/user_avatar.jpg'),(14,'cover','uploads/cover-1644367404.png');
/*!40000 ALTER TABLE `system_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Adminstrator','Admin','admin','0192023a7bbd73250516f069df18b500','uploads/avatar-1.png?v=1644472635',NULL,1,'2021-01-20 14:02:37','2022-02-10 13:57:15'),(11,'Claire','Blake','cblake','4744ddea876b11dcb1d169fadf494418','uploads/avatar-11.png?v=1644472553',NULL,2,'2022-02-10 13:55:52','2022-02-10 13:55:53');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendor_list`
--

DROP TABLE IF EXISTS `vendor_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendor_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `shop_type_id` int(30) NOT NULL,
  `shop_name` text NOT NULL,
  `shop_owner` text NOT NULL,
  `contact` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `shop_type_id` (`shop_type_id`),
  CONSTRAINT `vendor_list_ibfk_1` FOREIGN KEY (`shop_type_id`) REFERENCES `shop_type_list` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendor_list`
--

LOCK TABLES `vendor_list` WRITE;
/*!40000 ALTER TABLE `vendor_list` DISABLE KEYS */;
INSERT INTO `vendor_list` VALUES (1,'202202-00001',4,'Shop101','Shop 101 Owner','09123456788','shop101','ee6c4d4ba80f29dd389f0deb8863de69','uploads/vendors/1.png?v=1644375053',1,0,'2022-02-09 10:50:53','2022-02-10 13:43:21'),(2,'202202-00002',1,'Shop102','John Miller','09123456789','shop102','90be022251077e3488c998613214df74','uploads/vendors/2.png?v=1644375129',1,0,'2022-02-09 10:52:09','2022-02-09 17:02:54'),(3,'202202-00003',2,'test','test','123123123','test','098f6bcd4621d373cade4e832627b4f6','uploads/vendors/3.png?v=1644471934',1,1,'2022-02-10 13:45:34','2022-02-10 13:50:15');
/*!40000 ALTER TABLE `vendor_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'mvogms_db'
--

--
-- Dumping routines for database 'mvogms_db'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-06 14:42:05
