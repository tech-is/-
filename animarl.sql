-- MySQL dump 10.16  Distrib 10.1.26-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: animarl
-- ------------------------------------------------------
-- Server version	10.1.26-MariaDB

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
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `customer_id` int(5) NOT NULL AUTO_INCREMENT COMMENT '顧客id',
  `customer_shop_id` int(5) DEFAULT NULL COMMENT '顧客管理ショップid',
  `customer_name` varchar(200) NOT NULL COMMENT '顧客名',
  `customer_kana` varchar(200) DEFAULT NULL COMMENT 'カナ',
  `customer_tel` varchar(11) DEFAULT NULL COMMENT '電話番号',
  `customer_zip_adress` int(7) DEFAULT NULL COMMENT '郵便番号',
  `customer_address` varchar(100) DEFAULT NULL COMMENT '住所',
  `customer_mail` varchar(100) DEFAULT NULL COMMENT 'メールアドレス',
  `customer_magazine` int(3) NOT NULL DEFAULT '0' COMMENT 'メールマガジン 0:送らない 1:送る',
  `customer_group_id` int(2) DEFAULT '0' COMMENT 'kind_group_idとジョインしたもの表示',
  `customer_add_info` text COMMENT '追加情報',
  `customer_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '登録日時',
  `customer_updatedate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新日時',
  `customer_state` int(3) DEFAULT '1' COMMENT '削除フラグ',
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `customer_mail` (`customer_mail`),
  KEY `i_customer` (`customer_shop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,1,'森 裕信','モリ ヒロノブ','00000000000',7900931,'愛媛県松山市港町6-15-15','aaa@example.com',0,1,'おいっすー！','2019-10-18 13:19:04','2019-10-22 16:55:13',1),(4,1,'田中太郎','タナカタロウ','08912223342',7900931,'愛媛県松山市朝生田町6-4-2','example@example.com',1,0,'関西クレーマー','2019-10-22 16:55:21','2019-10-22 16:55:21',1),(5,1,'田中太郎','タナカタロウ','08912223342',7900931,'愛媛県松山市朝生田町6-4-2','eample@example.com',1,0,'関西クレーマー','2019-10-23 13:27:19','2019-10-23 13:27:19',1),(7,1,'田中太郎','タナカタロウ','08912223342',7900931,'愛媛県松山市朝生田町6-4-2','eaample@example.com',1,0,'関西クレーマー','2019-10-23 13:30:35','2019-10-23 13:30:35',1),(8,1,'大本対象','オオモトタイショウ','08912223342',7900931,'愛媛県松山市朝生田町6-4-2','aeamplafafrae@example.com',1,0,'','2019-10-25 18:07:45','2019-10-25 18:07:45',1),(9,1,'大本対象','オオモトタイショウ','08912223342',7900931,'愛媛県松山市朝生田町6-4-2','aeamplafafrdae@example.com',1,0,'','2019-10-25 18:34:53','2019-10-25 18:34:53',1),(10,1,'田中太郎','タナカタロウ','08912223342',7900931,'愛媛県松山市朝生田町6-4-2','aaaaaaaa@example.com',1,0,'関西クレーマー','2019-10-30 16:53:51','2019-10-30 16:53:51',1),(11,1,'若林　太郎','ワカバヤシ　タロウ','0899120000',9991111,'宜野湾市苗場町１１７２番地　森マンション　１１１号室','maaor1111mori@gmail.com',1,0,'あああああ','2019-11-14 14:37:57','2019-11-14 14:37:57',1),(12,1,'若林　太郎','ワカバヤシ　タロウ','0899120000',9991111,'えひ宜野湾市苗場町１１７２番地　森マンション　１１１号室','r1mori@gmail.com',1,0,'あああああ','2019-11-14 14:40:04','2019-11-14 14:40:04',1);
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `karute`
--

DROP TABLE IF EXISTS `karute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `karute` (
  `karute_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'カルテid',
  `karute_shop_id` int(5) NOT NULL COMMENT 'ショップidとのリレーション用id',
  `karute_customer_id` int(5) NOT NULL COMMENT 'カスタマーidとのリレーション用id',
  `karute_title` varchar(100) NOT NULL COMMENT 'カルテタイトル',
  `karute_comment` varchar(255) DEFAULT NULL COMMENT 'カルテ欄',
  `karute_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '作成日時',
  `karute_update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新日時',
  `karute_state` int(3) DEFAULT '1' COMMENT '削除フラグ',
  PRIMARY KEY (`karute_id`),
  KEY `i_karute` (`karute_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `karute`
--

LOCK TABLES `karute` WRITE;
/*!40000 ALTER TABLE `karute` DISABLE KEYS */;
INSERT INTO `karute` VALUES (1,1,2,'',NULL,'2019-11-13 16:38:26','2019-11-13 16:38:26',1),(2,1,2,'',NULL,'2019-11-13 16:49:23','2019-11-13 16:49:23',1),(3,1,2,'',NULL,'2019-11-13 16:50:11','2019-11-13 16:50:11',1),(4,1,2,'',NULL,'2019-11-13 16:52:32','2019-11-13 16:52:32',1),(5,1,2,'',NULL,'2019-11-13 17:09:00','2019-11-13 17:09:00',1),(6,1,1,'',NULL,'2019-11-13 17:09:16','2019-11-13 17:09:16',1),(7,1,1,'',NULL,'2019-11-13 17:09:46','2019-11-13 17:09:46',1),(8,1,1,'',NULL,'2019-11-14 12:45:52','2019-11-14 12:45:52',1),(9,1,1,'',NULL,'2019-11-14 12:47:08','2019-11-14 12:47:08',1),(10,1,1,'',NULL,'2019-11-14 12:47:25','2019-11-14 12:47:25',1),(11,1,2,'',NULL,'2019-11-14 12:47:43','2019-11-14 12:47:43',1),(12,1,2,'',NULL,'2019-11-14 12:56:36','2019-11-14 12:56:36',1),(13,1,2,'',NULL,'2019-11-14 13:13:32','2019-11-14 13:13:32',1),(14,1,12,'',NULL,'2019-11-14 14:46:37','2019-11-14 14:46:37',1),(15,1,12,'',NULL,'2019-11-14 14:46:47','2019-11-14 14:46:47',1),(16,1,12,'',NULL,'2019-11-14 14:46:53','2019-11-14 14:46:53',1),(17,1,12,'',NULL,'2019-11-14 14:49:08','2019-11-14 14:49:08',1),(18,1,12,'',NULL,'2019-11-14 14:51:16','2019-11-14 14:51:16',1),(19,1,12,'',NULL,'2019-11-14 14:53:13','2019-11-14 14:53:13',1),(20,1,12,'',NULL,'2019-11-14 14:53:56','2019-11-14 14:53:56',1),(21,1,12,'',NULL,'2019-11-14 14:54:20','2019-11-14 14:54:20',1),(22,1,12,'',NULL,'2019-11-14 14:54:55','2019-11-14 14:54:55',1),(23,1,12,'',NULL,'2019-11-14 14:55:14','2019-11-14 14:55:14',1),(24,1,12,'',NULL,'2019-11-14 15:21:33','2019-11-14 15:21:33',1),(25,1,12,'',NULL,'2019-11-14 16:29:22','2019-11-14 16:29:22',1);
/*!40000 ALTER TABLE `karute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kind_group`
--

DROP TABLE IF EXISTS `kind_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kind_group` (
  `kind_group_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'グループid',
  `kind_group_shop_id` int(5) DEFAULT NULL COMMENT 'ショップid',
  `kind_group_name` varchar(100) DEFAULT NULL COMMENT 'グループ名',
  `kind_group_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '作成日時',
  `kind_group_update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新日時',
  `kind_group_state` int(3) DEFAULT '1' COMMENT '削除フラグ',
  PRIMARY KEY (`kind_group_id`),
  KEY `i_kind_group` (`kind_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kind_group`
--

LOCK TABLES `kind_group` WRITE;
/*!40000 ALTER TABLE `kind_group` DISABLE KEYS */;
INSERT INTO `kind_group` VALUES (1,1,'犬','2019-10-18 13:19:23','2019-10-21 16:49:59',999),(2,1,'犬','2019-10-21 16:51:25','2019-10-21 16:51:31',999),(3,1,'猫','2019-10-21 16:52:15','2019-10-21 16:52:20',999),(4,1,'あ','2019-10-21 16:52:43','2019-10-21 16:52:48',999),(5,1,'い','2019-10-21 16:53:34','2019-10-21 16:53:38',999);
/*!40000 ALTER TABLE `kind_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mail_magazine`
--

DROP TABLE IF EXISTS `mail_magazine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mail_magazine` (
  `mail_magazine_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'マガジンid',
  `mail_shop_id` int(5) NOT NULL COMMENT 'マガジン利用id',
  `mail_sender_name` varchar(100) NOT NULL,
  `mail_subject` varchar(56) NOT NULL COMMENT '件名',
  `mail_sendend_at` datetime DEFAULT NULL COMMENT '最終送信日',
  `mail_detail` text COMMENT '本文',
  `mail_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '作成日時',
  `mail_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新日時',
  `mail_state` int(3) DEFAULT '1' COMMENT '削除フラグ',
  PRIMARY KEY (`mail_magazine_id`),
  KEY `i_magazine_list` (`mail_shop_id`),
  KEY `i_send_mailmag` (`mail_magazine_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mail_magazine`
--

LOCK TABLES `mail_magazine` WRITE;
/*!40000 ALTER TABLE `mail_magazine` DISABLE KEYS */;
INSERT INTO `mail_magazine` VALUES (1,1,'アイワハウス','おいっすー！',NULL,'おいっすー！\nおいっすー！\nおいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！おいっすー！','2019-10-27 23:59:36','2019-10-29 00:50:04',999),(2,1,'アイワハウス','おいっすー！',NULL,'ヤバいですね！','2019-10-28 00:19:03','2019-10-29 02:36:27',1),(4,1,'アイワハウス','おいっすー！',NULL,'おいっすー！\nおいっすー！','2019-10-28 18:12:39','2019-10-29 00:28:18',1),(5,1,'アイワハウス','おいっすー！',NULL,'おいっすー！\nおいっすー！','2019-10-28 19:35:52','2019-10-29 00:28:31',1),(6,1,'アイワハウス','あああ',NULL,'あああ\nあああ','2019-10-29 00:51:40','2019-10-29 00:52:15',1);
/*!40000 ALTER TABLE `mail_magazine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pet`
--

DROP TABLE IF EXISTS `pet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pet` (
  `pet_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'ペットid',
  `pet_customer_id` int(5) NOT NULL COMMENT '飼い主id',
  `pet_name` varchar(200) NOT NULL COMMENT 'ペット名前',
  `pet_img` varchar(100) DEFAULT NULL COMMENT '写真',
  `pet_classification` varchar(11) DEFAULT NULL COMMENT '分類',
  `pet_type` varchar(56) DEFAULT NULL COMMENT '種類',
  `pet_animal_gender` int(1) DEFAULT '1' COMMENT '性別 1:オス 2:メス 3:その他',
  `pet_contraception` int(1) DEFAULT NULL COMMENT '去勢 1:有 2:無',
  `pet_body_height` varchar(32) DEFAULT NULL COMMENT '体高',
  `pet_body_weight` varchar(32) DEFAULT NULL COMMENT '体重',
  `pet_birthday` date DEFAULT NULL COMMENT '誕生日',
  `pet_last_reservdate` date DEFAULT NULL COMMENT '最終予約日',
  `pet_information` text COMMENT 'ペット情報',
  `pet_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '登録日時',
  `pet_update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新日時',
  `pet_state` int(3) DEFAULT '1' COMMENT '削除フラグ',
  PRIMARY KEY (`pet_id`),
  KEY `i_pet_list` (`pet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pet`
--

LOCK TABLES `pet` WRITE;
/*!40000 ALTER TABLE `pet` DISABLE KEYS */;
INSERT INTO `pet` VALUES (1,11,'たま',NULL,'ねこ','カメレオン',1,1,'6','4','2019-11-20',NULL,'あああｄｄｄｄｄｄｄｇｇｇｇｇｇ','2019-11-14 14:37:57','2019-11-14 14:37:57',1),(2,12,'たま',NULL,'ねこ','カメレオン',1,1,'6','4','2019-11-20',NULL,'あああｄｄｄｄｄｄｄｇｇｇｇｇｇ','2019-11-14 14:40:04','2019-11-14 14:40:04',1);
/*!40000 ALTER TABLE `pet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reserve`
--

DROP TABLE IF EXISTS `reserve`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reserve` (
  `reserve_id` int(5) NOT NULL AUTO_INCREMENT COMMENT '予約id',
  `reserve_shop_id` int(5) NOT NULL COMMENT '予約ショップid',
  `reserve_customer_id` int(5) NOT NULL COMMENT '予約顧客id',
  `reserve_pet_id` int(5) NOT NULL COMMENT '予約ペットid',
  `reserve_content` text COMMENT '内容',
  `reserve_start` varchar(20) DEFAULT NULL COMMENT '開始',
  `reserve_end` varchar(20) DEFAULT NULL COMMENT '終了',
  `reserve_staff_id` int(5) DEFAULT NULL COMMENT '担当id',
  `reserve_color` varchar(45) DEFAULT NULL COMMENT '予約用カラーラベル',
  `reserve_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '作成日時',
  `reserve_update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新日時',
  `reserve_state` int(3) DEFAULT '1' COMMENT '削除フラグ',
  PRIMARY KEY (`reserve_id`),
  KEY `i_reserve` (`reserve_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserve`
--

LOCK TABLES `reserve` WRITE;
/*!40000 ALTER TABLE `reserve` DISABLE KEYS */;
INSERT INTO `reserve` VALUES (1,1,1,1,'','2019-10-24T00:00','2019-10-25T00:00',NULL,NULL,'2019-10-25 01:30:48','2019-10-27 03:11:36',999),(2,0,1,1,'','2019-10-28T00:00',NULL,NULL,NULL,'2019-10-25 15:40:18','2019-10-26 00:46:11',1),(3,0,1,1,'','2019-10-25T00:00',NULL,NULL,NULL,'2019-10-25 15:41:11','2019-10-26 00:46:11',1),(4,0,1,1,'','2019-10-25T00:00',NULL,NULL,NULL,'2019-10-25 15:41:19','2019-10-26 00:46:11',1),(5,1,1,1,'','2019-10-29T10:00','2019-10-29T11:00',NULL,NULL,'2019-10-25 16:02:25','2019-10-27 03:13:21',999),(6,1,1,1,'','2019-10-25T00:00','2019-10-26T00:00',NULL,NULL,'2019-10-25 18:58:33','2019-10-27 03:19:33',999),(7,1,1,5,'','2019-11-01T12:00','2019-11-02T13:00',NULL,'#3a87ad','2019-10-25 18:59:48','2019-10-27 05:31:22',1),(8,1,1,8,'','2019-10-25T00:00','2019-10-27T13:00',NULL,'#3a87ad','2019-10-25 19:01:13','2019-10-27 05:32:18',999),(9,1,1,1,'','2019-10-25T00:00','2019-10-30T12:00',NULL,NULL,'2019-10-26 00:32:57','2019-10-27 03:01:51',999),(10,1,1,5,'','2019-10-30T12:00','2019-10-31T12:00',NULL,NULL,'2019-10-26 00:33:21','2019-10-27 03:14:10',999),(11,1,1,1,'','2019-10-26T00:00','2019-10-28T12:00',NULL,'#3a87ad','2019-10-27 03:39:20','2019-10-27 03:39:51',1);
/*!40000 ALTER TABLE `reserve` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shops`
--

DROP TABLE IF EXISTS `shops`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shops` (
  `shop_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'ショップid',
  `shop_name` varchar(100) NOT NULL COMMENT '登録者',
  `shop_kana` varchar(100) NOT NULL COMMENT 'カナ',
  `shop_tel` varchar(11) DEFAULT NULL COMMENT '電話番号',
  `shop_email` varchar(64) NOT NULL COMMENT 'メールアドレス',
  `shop_zip_code` int(7) DEFAULT NULL COMMENT '郵便番号',
  `shop_address` varchar(100) DEFAULT NULL COMMENT '住所',
  `shop_password` varchar(60) NOT NULL COMMENT 'パスワード',
  `shop_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '登録日時',
  `shop_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新日時',
  `shop_state` int(3) DEFAULT '1' COMMENT '削除フラグ',
  PRIMARY KEY (`shop_id`),
  UNIQUE KEY `shop_email` (`shop_email`),
  KEY `i_shops` (`shop_id`,`shop_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shops`
--

LOCK TABLES `shops` WRITE;
/*!40000 ALTER TABLE `shops` DISABLE KEYS */;
INSERT INTO `shops` VALUES (1,'森 裕信','モリ ヒロノブ','2147483647','delta0716@gmail.com',7900931,'愛媛県松山市西石井6-15-15','$2y$10$YEBCxe/MoeNApxZkYoT1K.b4W1HjcL1or3iKt67okYZcKYTfdR/0S','2019-11-05 18:21:10','2019-11-11 03:21:49',1);
/*!40000 ALTER TABLE `shops` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff` (
  `staff_id` int(5) NOT NULL AUTO_INCREMENT COMMENT '従業員id',
  `staff_shop_id` int(5) DEFAULT NULL COMMENT 'スタッフショップid',
  `staff_name` varchar(50) DEFAULT NULL COMMENT '氏名',
  `staff_tel` int(11) DEFAULT NULL COMMENT '電話番号',
  `staff_mail` varchar(100) DEFAULT NULL COMMENT 'メールアドレス',
  `staff_color` varchar(10) DEFAULT NULL COMMENT 'カラーラベル',
  `staff_remarks` text COMMENT '備考',
  `staff_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '作成日時',
  `staff_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新日時',
  `staff_state` int(3) DEFAULT '1' COMMENT '削除フラグ',
  PRIMARY KEY (`staff_id`),
  KEY `i_staff` (`staff_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` VALUES (1,1,'森 裕信',2147483647,'example@example.com','#0080ff','','2019-10-25 02:17:55','2019-10-25 02:17:55',1);
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff_shift`
--

DROP TABLE IF EXISTS `staff_shift`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff_shift` (
  `shift_id` int(5) NOT NULL AUTO_INCREMENT COMMENT '従業員id',
  `shift_staff_id` int(5) DEFAULT NULL COMMENT '従業員id',
  `shift_shop_id` int(5) DEFAULT NULL COMMENT 'ショップid',
  `shift_start` varchar(20) DEFAULT NULL COMMENT 'シフト開始',
  `shift_end` varchar(20) DEFAULT NULL COMMENT 'シフト終了',
  `shift_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '作成日時',
  `shift_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新日時',
  `shift_state` int(3) DEFAULT '1' COMMENT '削除フラグ',
  PRIMARY KEY (`shift_id`),
  KEY `i_staff_shift` (`shift_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff_shift`
--

LOCK TABLES `staff_shift` WRITE;
/*!40000 ALTER TABLE `staff_shift` DISABLE KEYS */;
/*!40000 ALTER TABLE `staff_shift` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tmp_shops`
--

DROP TABLE IF EXISTS `tmp_shops`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tmp_shops` (
  `tmp_shop_email` varchar(100) NOT NULL COMMENT 'メールアドレス',
  `tmp_shop_code` varchar(100) NOT NULL COMMENT 'パスワードトークン',
  `tmp_expires` datetime NOT NULL,
  UNIQUE KEY `tmp_shop_email` (`tmp_shop_email`),
  KEY `i_tmp_shops_login` (`tmp_shop_email`,`tmp_shop_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tmp_shops`
--

LOCK TABLES `tmp_shops` WRITE;
/*!40000 ALTER TABLE `tmp_shops` DISABLE KEYS */;
INSERT INTO `tmp_shops` VALUES ('delta0716@gmail.com','89c3649be4ef6c7276e56d35ff8daa39','2019-11-11 04:35:02');
/*!40000 ALTER TABLE `tmp_shops` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-11-15 13:52:19
