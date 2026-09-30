-- MySQL dump 10.13  Distrib 5.7.37, for Linux (x86_64)
--
-- Host: localhost    Database: crimson_ink
-- ------------------------------------------------------
-- Server version	5.7.37-log

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
-- Table structure for table `artists`
--

DROP TABLE IF EXISTS `artists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `artists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_vi` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_en` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_vi` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio_en` text COLLATE utf8mb4_unicode_ci,
  `bio_vi` text COLLATE utf8mb4_unicode_ci,
  `content_en` longtext COLLATE utf8mb4_unicode_ci,
  `content_vi` longtext COLLATE utf8mb4_unicode_ci,
  `tattoo_style_ids` json DEFAULT NULL,
  `avatar_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience_years` tinyint(3) unsigned DEFAULT NULL,
  `socials` json DEFAULT NULL,
  `meta_title_en` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title_vi` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description_en` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description_vi` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` smallint(6) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `artists_slug_unique` (`slug`),
  KEY `artists_is_featured_index` (`is_featured`),
  KEY `artists_is_active_index` (`is_active`),
  KEY `artists_sort_order_index` (`sort_order`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artists`
--

LOCK TABLES `artists` WRITE;
/*!40000 ALTER TABLE `artists` DISABLE KEYS */;
INSERT INTO `artists` VALUES (1,'minh-khoa','Minh Khoa','Minh Khoa','Fineline & Blackwork','Fineline & Blackwork','A short introduction: signature styles, years of experience and what keeps clients coming back. Two or three lines fit this layout best.','Mô tả ngắn về artist: phong cách sở trường, số năm kinh nghiệm, điều khiến khách quay lại. Khoảng 2-3 dòng là vừa đẹp với bố cục này.',NULL,NULL,'[1, 2]','assets/images/tattoo-artist-1.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-09-22 22:24:58','2026-09-22 22:24:58',NULL),(2,'bao-long','Jacky','Bảo Long','Realism & Portrait','Tả thực & Chân dung','A short introduction: signature styles, years of experience and what keeps clients coming back. Two or three lines fit this layout best.','Mô tả ngắn về artist: phong cách sở trường, số năm kinh nghiệm, điều khiến khách quay lại. Khoảng 2-3 dòng là vừa đẹp với bố cục này.',NULL,NULL,'[4]','assets/images/tattoo-artist-2.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,2,'2026-09-22 22:24:58','2026-09-27 15:13:34',NULL),(3,'ha-vy','Hà Vy','Hà Vy','Japanese & Traditional','Nhật Bản & Truyền thống','A short introduction: signature styles, years of experience and what keeps clients coming back. Two or three lines fit this layout best.','Mô tả ngắn về artist: phong cách sở trường, số năm kinh nghiệm, điều khiến khách quay lại. Khoảng 2-3 dòng là vừa đẹp với bố cục này.',NULL,NULL,'[5, 3]','assets/images/tattoo-artist-3.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,3,'2026-09-22 22:24:58','2026-09-22 22:24:58',NULL),(4,'duc-anh','Đức Anh','Đức Anh','Dotwork & Ornamental','Chấm điểm & Hoa văn','A short introduction: signature styles, years of experience and what keeps clients coming back. Two or three lines fit this layout best.','Mô tả ngắn về artist: phong cách sở trường, số năm kinh nghiệm, điều khiến khách quay lại. Khoảng 2-3 dòng là vừa đẹp với bố cục này.',NULL,NULL,'[10]','assets/images/junk-juz-tattoo-artist-bali.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,4,'2026-09-22 22:24:58','2026-09-22 22:24:58',NULL);
/*!40000 ALTER TABLE `artists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preferred_date` date DEFAULT NULL,
  `preferred_time` time DEFAULT NULL,
  `artist_id` int(10) unsigned DEFAULT NULL,
  `tattoo_style_id` int(10) unsigned DEFAULT NULL,
  `placement` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size_cm` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_paths` json DEFAULT NULL,
  `status` enum('new','contacted','confirmed','done','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `admin_note` text COLLATE utf8mb4_unicode_ci,
  `handled_by` bigint(20) unsigned DEFAULT NULL,
  `locale` char(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'vi',
  `ip` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bookings_code_unique` (`code`),
  KEY `bookings_status_created_index` (`status`,`created_at`),
  KEY `bookings_email_index` (`email`),
  KEY `bookings_preferred_date_index` (`preferred_date`),
  KEY `bookings_artist_id_index` (`artist_id`),
  KEY `bookings_tattoo_style_id_index` (`tattoo_style_id`),
  KEY `bookings_handled_by_index` (`handled_by`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES (1,'CI-20260926-0001','Nguyen Van Dong','0388666108','nguyendong1990@gmail.com','2026-09-30','09:30:00',2,4,'Đùi trái','15 x 20 cm','mesage a',NULL,'confirmed','Đã gọi xác nhận, khách đồng ý 14h30.',1,'vi',NULL,NULL,'2026-09-26 03:16:29','2026-09-28 03:20:43',NULL);
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faqs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'booking',
  `question_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_vi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_en` text COLLATE utf8mb4_unicode_ci,
  `answer_vi` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` smallint(6) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `faqs_group_index` (`group`),
  KEY `faqs_is_active_index` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (1,'booking','How far in advance do I need to book?','Tôi cần đặt lịch trước bao lâu?','<p>You should book at least two weeks in advance to secure a slot with your preferred tattoo artist, especially for weekends or peak seasons. For large or complex designs, you may need to book even further in advance.</p>','<p>Bạn nên đặt lịch trước ít nhất khoảng 2 tuần để đảm bảo có slot với thợ xăm mong muốn, đặc biệt vào cuối tuần hoặc mùa cao điểm. Với các hình lớn, phức tạp, thời gian đặt trước có thể lâu hơn.</p>',1,1,'2026-09-28 03:24:54','2026-09-28 03:24:54'),(2,'booking','Do you accept walk-ins?','Có nhận khách vãng lai (walk-in) không?','<p>Walk-ins are always welcome, but booking in advance is recommended to avoid waiting.</p>','<p>Luôn luôn welcome walk in, nhưng nên book in advance để ko phải đợi.</p>',1,2,'2026-09-28 03:53:56','2026-09-28 03:53:56'),(3,'booking','Is a deposit required before getting a tattoo? Is the deposit refundable if I cancel the appointment?','Có cần đặt cọc trước khi xăm không? Nếu hủy lịch thì cọc có được hoàn lại không?','<p>Yes, we require a deposit (approximately 10–20%) to secure your appointment. This amount will be deducted from the total cost of the tattoo session. Please note that the deposit is non-refundable if you cancel the appointment or switch to a different design idea.</p>','<p>Có, chúng tôi yêu cầu đặt cọc (~10-20%) để giữ lịch. Khoản cọc này sẽ được trừ vào tổng chi phí buổi xăm. Nếu bạn hủy lịch hoặc đổi sang ý tưởng khác sẽ không được hoàn cọc.</p>',1,3,'2026-09-28 03:55:01','2026-09-28 03:55:01'),(4,'booking','What does the tattooing process involve, from consultation to completion?','Quy trình xăm diễn ra như thế nào, từ tư vấn đến hoàn thành?','<p>The process consists of the following steps: consultation on the concept and placement → design sketching → revisions based on your requests → applying the stencil to your skin for final approval → the tattooing procedure → cleaning and aftercare instructions.</p>','<p>Quy trình gồm các bước: tư vấn ý tưởng và vị trí xăm → phác thảo thiết kế → chỉnh sửa theo yêu cầu → in phác thảo lên da (stencil) để bạn duyệt lần cuối → tiến hành xăm → vệ sinh và hướng dẫn chăm sóc sau xăm.</p>',1,4,'2026-09-28 03:57:24','2026-09-28 03:57:24');
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mediable_type` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mediable_id` int(10) unsigned NOT NULL,
  `collection` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'gallery',
  `type` enum('image','video','embed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'image',
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poster_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `embed_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_en` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_vi` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caption_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caption_vi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `width` smallint(5) unsigned DEFAULT NULL,
  `height` smallint(5) unsigned DEFAULT NULL,
  `duration_seconds` int(10) unsigned DEFAULT NULL,
  `tattoo_style_id` int(10) unsigned DEFAULT NULL,
  `artist_id` int(10) unsigned DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` smallint(6) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_mediable_collection_index` (`mediable_type`,`mediable_id`,`collection`),
  KEY `media_tattoo_style_id_index` (`tattoo_style_id`),
  KEY `media_artist_id_index` (`artist_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (1,'App\\Models\\Page',7,'gallery','image','assets/images/ext-scontentcgk22-71932086114689_2992458166866653174_n.jpg',NULL,NULL,'Small lines with big meaning, it’s easy to see why fine line tattoos are a favorite ??',NULL,'Small lines with big meaning, it’s easy to see why fine line tattoos are a favorite ??',NULL,NULL,NULL,NULL,NULL,NULL,1,1,'2026-09-22 22:24:58','2026-09-22 22:24:58'),(2,'App\\Models\\Page',7,'gallery','image','assets/images/ext-scontentcgk21-71560905114689_1190225360991079783_n.jpg',NULL,NULL,'? Prefer to talk in person?',NULL,'? Prefer to talk in person?',NULL,NULL,NULL,NULL,NULL,NULL,1,2,'2026-09-22 22:24:58','2026-09-22 22:24:58'),(3,'App\\Models\\Page',7,'gallery','image','assets/images/ext-scontentcgk22-70116282114689_7085329359733970096_n.jpg',NULL,NULL,'The Kraken Curse ?⚓️?',NULL,'The Kraken Curse ?⚓️?',NULL,NULL,NULL,NULL,NULL,NULL,1,3,'2026-09-22 22:24:58','2026-09-22 22:24:58'),(4,'App\\Models\\Page',7,'gallery','image','assets/images/ext-scontentcgk22-69943959114689_1155432106259041391_n.jpg',NULL,NULL,'Black and grey Octopus ? ,custom made. Thank you brother for the trust ??',NULL,'Black and grey Octopus ? ,custom made. Thank you brother for the trust ??',NULL,NULL,NULL,NULL,NULL,NULL,1,4,'2026-09-22 22:24:58','2026-09-22 22:24:58'),(5,'App\\Models\\Page',7,'gallery','image','assets/images/ext-scontentcgk22-68166255114689_5475073316086351570_n.jpg',NULL,NULL,'Studio work',NULL,'Thay bằng caption thật của Crimson Ink.',NULL,NULL,NULL,NULL,NULL,NULL,1,5,'2026-09-22 22:24:58','2026-09-22 22:24:58'),(6,'App\\Models\\Page',7,'gallery','image','assets/images/ext-scontentcgk22-67813647114689_6693890198391297788_n.jpg',NULL,NULL,'Cover-up Tattoo! Before and After Result ??',NULL,'Cover-up Tattoo! Before and After Result ??',NULL,NULL,NULL,NULL,NULL,NULL,1,6,'2026-09-22 22:24:58','2026-09-22 22:24:58'),(7,'App\\Models\\Page',7,'gallery','image','assets/images/ext-scontentcgk11-67010559114689_3585207281467755615_n.jpg',NULL,NULL,'Dark Lace Femme Gothic Tattoo. ??',NULL,'Dark Lace Femme Gothic Tattoo. ??',NULL,NULL,NULL,NULL,NULL,NULL,1,7,'2026-09-22 22:24:58','2026-09-22 22:24:58'),(8,'App\\Models\\Page',7,'gallery','image','assets/images/ext-scontentcgk21-66871764114689_5521703402726660541_n.jpg',NULL,NULL,'Hand rose and love heart tattoo ??',NULL,'Hand rose and love heart tattoo ??',NULL,NULL,NULL,NULL,NULL,NULL,1,8,'2026-09-22 22:24:58','2026-09-22 22:24:58'),(9,'App\\Models\\Page',7,'gallery','image','assets/images/ext-scontentcgk22-66857250114689_6187879796236403058_n.jpg',NULL,NULL,'Hand mask tattoo ??',NULL,'Hand mask tattoo ??',NULL,NULL,NULL,NULL,NULL,NULL,1,9,'2026-09-22 22:24:58','2026-09-22 22:24:58'),(10,'App\\Models\\Page',7,'gallery','image','assets/images/ext-scontentcgk12-65571918114689_5303473502543576605_n.jpg',NULL,NULL,'Yesterday’s Owl and geometrical tattoo. Thank you ?',NULL,'Yesterday’s Owl and geometrical tattoo. Thank you ?',NULL,NULL,NULL,NULL,NULL,NULL,1,10,'2026-09-22 22:24:58','2026-09-22 22:24:58'),(11,'App\\Models\\Page',7,'gallery','image','assets/images/ext-scontentcgk12-64959408114689_6863282894952290924_n.jpg',NULL,NULL,'American traditional/neo traditional Cartoon Bomb tattoo ??',NULL,'American traditional/neo traditional Cartoon Bomb (boom) tattoo ??',NULL,NULL,NULL,NULL,NULL,NULL,1,11,'2026-09-22 22:24:58','2026-09-22 22:24:58'),(12,'App\\Models\\Page',7,'gallery','image','assets/images/ext-scontentcgk21-64227957114689_1478979128825284376_n.jpg',NULL,NULL,'A custom of black and grey bear, ibex and bee tattoo ?',NULL,'A custom of black and grey bear, ibex and bee tattoo. Thanks brother for the trust ?',NULL,NULL,NULL,NULL,NULL,NULL,1,12,'2026-09-22 22:24:58','2026-09-22 22:24:58'),(13,'App\\Models\\Page',7,'gallery','image','assets/images/ext-scontentcgk21-63829773114689_1571867816168016646_n.jpg',NULL,NULL,'Cover-up work',NULL,'If you need some old tattoos to be covered up, check out some of our cover-up work.',NULL,NULL,NULL,NULL,NULL,NULL,1,13,'2026-09-22 22:24:58','2026-09-22 22:24:58'),(14,'App\\Models\\Page',7,'gallery','image','assets/images/ext-scontentcgk21-63320946114689_9008939654080199522_n.jpg',NULL,NULL,'Dragon in black and grey with roses ??',NULL,'Dragon in black and grey with roses ?? ..thank you heaps brother ?',NULL,NULL,NULL,NULL,NULL,NULL,1,14,'2026-09-22 22:24:58','2026-09-22 22:24:58'),(15,'App\\Models\\Page',7,'gallery','image','assets/images/ext-scontentcgk12-462820819114689_185774594112390677_n.jpg',NULL,NULL,'Studio work',NULL,'Thay bằng caption thật của Crimson Ink.',NULL,NULL,NULL,NULL,NULL,NULL,1,15,'2026-09-22 22:24:58','2026-09-22 22:24:58'),(16,'App\\Models\\Page',7,'gallery','image','assets/images/ext-scontentcgk11-62771358114689_6465686018843637992_n.jpg',NULL,NULL,'Full back piece Hannya mask ?',NULL,'Full back piece Hannya mask done! Thank you loads brother ?',NULL,NULL,NULL,NULL,NULL,NULL,1,16,'2026-09-22 22:24:58','2026-09-22 22:24:58'),(17,'App\\Models\\Page',7,'gallery','image','assets/images/ext-scontentcgk21-62595753114689_3225290629889647103_n.jpg',NULL,NULL,'Cover-up Japanese Samurai! ?',NULL,'Cover-up Japanese Samurai! ?',NULL,NULL,NULL,NULL,NULL,NULL,1,17,'2026-09-22 22:24:58','2026-09-22 22:24:58'),(18,'App\\Models\\Page',7,'gallery','image','assets/images/ext-scontentcgk11-62094141114689_1380918085777632707_n.jpg',NULL,NULL,'Full sleeve nature tattoo in black and grey ?',NULL,'Full sleeve nature tattoo in black and grey. Thank you brother Adam ?',NULL,NULL,NULL,NULL,NULL,NULL,1,18,'2026-09-22 22:24:58','2026-09-22 22:24:58'),(19,'App\\Models\\Page',7,'gallery','image','assets/images/ext-scontentcgk22-61296801114689_7642999274555102154_n.jpg',NULL,NULL,'Kewpie doll tattoo ?',NULL,'Still cute in horror — Kewpie doll tattoo. Thank you Steph ?',NULL,NULL,NULL,NULL,NULL,NULL,1,19,'2026-09-22 22:24:58','2026-09-22 22:24:58'),(20,'App\\Models\\Page',7,'gallery','image','assets/images/ext-scontentcgk21-59471586114689_1439567129567876270_n.jpg',NULL,NULL,'Custom design ??',NULL,'Done last night, 1 hour work — custom design ??',NULL,NULL,NULL,NULL,NULL,NULL,1,20,'2026-09-22 22:24:58','2026-09-22 22:24:58');
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `location` enum('header','footer_quick','footer_styles') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'header',
  `parent_id` int(10) unsigned DEFAULT NULL,
  `label_en` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label_vi` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route_name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target_blank` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` smallint(6) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_items_location_index` (`location`),
  KEY `menu_items_parent_id_index` (`parent_id`),
  KEY `menu_items_is_active_index` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_items`
--

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` VALUES (1,'header',NULL,'Home','Trang chủ','page.home','http://crimsonink.lc',0,1,10,'2026-09-22 23:43:33','2026-09-27 04:35:16'),(2,'header',NULL,'About Us','Giới thiệu','page.about-us',NULL,0,1,20,'2026-09-22 23:43:33','2026-09-22 23:43:33'),(3,'header',NULL,'Tattoo Styles','Phong cách xăm','page.tattoo-styles',NULL,0,1,30,'2026-09-22 23:43:33','2026-09-22 23:43:33'),(4,'header',NULL,'Gallery','Thư viện ảnh','page.gallery',NULL,0,1,40,'2026-09-22 23:43:33','2026-09-22 23:43:33'),(5,'header',NULL,'Artists','Đội ngũ artist','page.artists',NULL,0,1,50,'2026-09-22 23:43:33','2026-09-22 23:43:33'),(6,'header',NULL,'FAQs','Câu hỏi thường gặp','page.faqs','http://crimsonink.lc/faqs',0,1,60,'2026-09-22 23:43:33','2026-09-28 04:06:45'),(7,'header',NULL,'Blog','Blog',NULL,'#',0,1,70,'2026-09-22 23:43:33','2026-09-22 23:43:33'),(8,'header',NULL,'Book now','Đặt lịch ngay','page.contact-us','http://crimsonink.lc/contact-us',0,1,80,'2026-09-22 23:43:33','2026-09-27 08:50:58'),(9,'header',3,'Japanese Tattoos','Xăm Nhật Bản','page.tattoo-styles.japanese-tattoos',NULL,0,1,10,'2026-09-22 23:43:33','2026-09-22 23:43:33'),(10,'header',3,'Realism Tattoos','Xăm tả thực','page.tattoo-styles.realism-tattoos',NULL,0,1,20,'2026-09-22 23:43:33','2026-09-22 23:43:33'),(11,'header',3,'Tribal Tattoos','Xăm thổ dân','page.tattoo-styles.tribal-tattoos',NULL,0,1,30,'2026-09-22 23:43:33','2026-09-22 23:43:33'),(12,'header',3,'Cartoon Tattoos','Xăm hoạt hình','page.tattoo-styles.cartoon-tattoos',NULL,0,1,40,'2026-09-22 23:43:33','2026-09-22 23:43:33');
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2026_09_23_000001_create_settings_table',2),(5,'2026_09_23_000002_create_artists_table',2),(6,'2026_09_23_000003_create_tattoo_styles_table',2),(7,'2026_09_23_000004_create_media_table',2),(8,'2026_09_23_000005_create_reviews_table',2),(9,'2026_09_23_000006_create_bookings_table',2),(10,'2026_09_23_000007_create_pages_table',2),(11,'2026_09_23_000008_create_page_sections_table',2),(12,'2026_09_23_000009_create_menu_items_table',2),(13,'2026_09_23_000010_create_faqs_table',2),(14,'2026_09_23_000011_create_redirects_table',2),(15,'2026_09_23_000012_add_admin_fields_to_users_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_sections`
--

DROP TABLE IF EXISTS `page_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page_sections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(10) unsigned NOT NULL,
  `key` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'rich_text',
  `eyebrow_en` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eyebrow_vi` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `heading_en` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `heading_vi` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subheading_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subheading_vi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body_en` text COLLATE utf8mb4_unicode_ci,
  `body_vi` text COLLATE utf8mb4_unicode_ci,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `background_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_label_en` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_label_vi` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_route` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` smallint(6) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_sections_page_key_unique` (`page_id`,`key`),
  KEY `page_sections_page_id_index` (`page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_sections`
--

LOCK TABLES `page_sections` WRITE;
/*!40000 ALTER TABLE `page_sections` DISABLE KEYS */;
INSERT INTO `page_sections` VALUES (1,1,'hero','hero','Welcome to','Chào mừng đến với','Tattoo Studio in Hanoi','Tiệm xăm tại Hà Nội','WHERE ART MEET SKIN','NƠI NGHỆ THUẬT CHẠM VÀO LÀN DA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,'2026-09-27 06:09:49','2026-09-27 13:48:47'),(2,1,'why_choose','rich_text','MORE THAN TATTOOS','HƠN CẢ MỘT HÌNH XĂM','Why Choose <span>Crimson Ink</span>','Vì sao chọn <span>Crimson Ink</span>',NULL,NULL,'Every tattoo here starts with a fresh needle and hospital-grade sterilised equipment. Every design is drawn for you alone — never pulled from a template. And from the first free consultation through to aftercare, we stay with you at every step. That is why thousands of clients keep coming back.','Mỗi hình xăm tại đây đều được thực hiện bằng kim mới và các dụng cụ đã qua quy trình tiệt trùng đạt chuẩn y tế. Mọi mẫu thiết kế đều được vẽ riêng cho bạn — tuyệt đối không sử dụng các mẫu có sẵn. Chúng tôi luôn đồng hành cùng bạn trong suốt quá trình, từ buổi tư vấn miễn phí ban đầu cho đến khâu chăm sóc sau khi xăm. Đó chính là lý do hàng ngàn khách hàng luôn tin tưởng và quay trở lại.',NULL,NULL,'Book an appointment','Đặt lịch xăm','page.contact-us',NULL,NULL,1,20,'2026-09-27 06:09:49','2026-09-27 15:02:50'),(3,1,'styles','styles_carousel','Explore Our','Khám phá','Tattoo <span>Styles</span>','<span>Phong cách</span> xăm',NULL,NULL,NULL,NULL,NULL,NULL,'View all','Xem tất cả','page.tattoo-styles',NULL,NULL,1,30,'2026-09-27 06:09:49','2026-09-27 15:06:44'),(4,1,'artists','artists_list','Meet Our','Gặp gỡ','Professional Tattoo <span>Artists</span>','Đội ngũ <span>Artists</span> chuyên nghiệp',NULL,NULL,NULL,NULL,NULL,NULL,'View all artists','Xem tất cả artist','page.artists',NULL,NULL,1,40,'2026-09-27 06:09:49','2026-09-27 06:09:49'),(5,1,'reviews','reviews','Real experiences','Trải nghiệm thật','My Happy <span>Clients!</span>','<span>Khách hàng</span> của chúng tôi',NULL,NULL,NULL,NULL,NULL,NULL,'Read more reviews','Xem thêm đánh giá',NULL,NULL,NULL,1,50,'2026-09-27 06:09:49','2026-09-27 06:09:49');
/*!40000 ALTER TABLE `page_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('page','service','landing') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'page',
  `route_name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `template` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `title_en` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_vi` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `heading_en` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `heading_vi` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body_en` longtext COLLATE utf8mb4_unicode_ci,
  `body_vi` longtext COLLATE utf8mb4_unicode_ci,
  `hero_image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title_en` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title_vi` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description_en` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description_vi` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og_image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `canonical_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `noindex` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` smallint(6) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`),
  KEY `pages_type_index` (`type`),
  KEY `pages_is_active_index` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'home','landing','page.home','home','Tattoo Studio in Hanoi','Tiệm xăm tại Hà Nội',NULL,NULL,'<p><br></p>','<p><br></p>',NULL,'Tattoo Studio in Hanoi - Crimson Ink','Tiệm xăm tại Hà Nội - Crimson Ink','Looking for the best tattoo studio in Hanoi? Crimson Ink Tattoo offers custom designs, hygienic studios, and expert artists since 2015.','Bạn đang tìm kiếm tiệm xăm tốt nhất tại Hà Nội? Crimson Ink Tattoo cung cấp các mẫu thiết kế theo yêu cầu, không gian đảm bảo vệ sinh và đội ngũ nghệ sĩ lành nghề từ năm 2015.',NULL,NULL,0,1,1,'2026-09-22 22:24:58','2026-09-27 15:31:01'),(2,'about-us','page','page.about-us','default','About Us','Về chúng tôi',NULL,NULL,'<p data-start=\"540\" data-end=\"758\">Welcome to CrimsonInk Tattoo Studio, the best place for tattoos in Hanoi! We are proud to be the first tattooist in Kuta, established in 2015 by professional artists with Phong Nha.</p>\r\n									<p data-start=\"760\" data-end=\"1081\">At our studio, your safety and satisfaction always come first. We use new needles for every client, and you can open the packet yourself for full confidence. Every piece of equipment is clean, safe, and sterilized to hospital-grade standards using an autoclave machine approved by the health department.</p>\r\n									<p data-start=\"1083\" data-end=\"1463\">Our tattoo artists also wear new surgical gloves for every customer. We use only original tattoo inks such as Eternal Inks and Intenze Inks to ensure vibrant, long-lasting colors. Whether you love freehand designs, custom artwork, or bright color tattoos, we’ve got you covered. Plus, your privacy is always respected whenever you request it.</p>\r\n									<p data-start=\"1465\" data-end=\"1794\">We offer a clean, comfortable, and private environment where creativity flows freely. You can explore our wide design collection or bring your own tattoo ideas. Our artists also specialize in cover-ups and tattoo renewals, helping you refresh or transform your previous designs into something you’ll love again.</p>\r\n									<p data-start=\"1796\" data-end=\"2113\">At CrimsonInk Tattoo Studio, we’re known for our friendly service and lowest price guarantee in town. You’ll enjoy a fully air-conditioned studio, great music.</p>\r\n									<p data-start=\"2115\" data-end=\"2270\">Experience the best in tattoo artistry and service at CrimsonInk Tattoo Studio — where your safety, comfort, and satisfaction always come first.</p>','<p data-start=\"540\" data-end=\"758\">Chào mừng bạn đến với CrimsonInk Tattoo Studio – địa chỉ xăm hình hàng đầu tại Hà Nội! Chúng tôi tự hào là tiệm xăm tiên phong tại Kuta, được thành lập vào năm 2015 bởi các nghệ sĩ chuyên nghiệp cùng Phong Nhã.</p><p data-start=\"540\" data-end=\"758\">Tại studio của chúng tôi, sự an toàn và hài lòng của bạn luôn được đặt lên hàng đầu. Chúng tôi sử dụng kim mới cho mỗi khách hàng và bạn có thể tự tay bóc bao bì để hoàn toàn an tâm. Mọi thiết bị đều sạch sẽ, an toàn và được tiệt trùng theo tiêu chuẩn bệnh viện bằng máy hấp tiệt trùng được cơ quan y tế chứng nhận.</p><p data-start=\"540\" data-end=\"758\">Các nghệ sĩ xăm của chúng tôi cũng sử dụng găng tay y tế mới cho từng khách hàng. Chúng tôi chỉ dùng các loại mực xăm chính hãng như Eternal Inks và Intenze Inks để đảm bảo màu sắc sống động và bền đẹp. Dù bạn yêu thích các mẫu vẽ tự do (freehand), thiết kế riêng hay hình xăm nhiều màu sắc rực rỡ, chúng tôi đều có thể đáp ứng. Ngoài ra, sự riêng tư của bạn luôn được tôn trọng bất cứ khi nào bạn yêu cầu.</p><p data-start=\"540\" data-end=\"758\">Chúng tôi mang đến một không gian sạch sẽ, thoải mái và riêng tư, nơi sự sáng tạo được thăng hoa. Bạn có thể tham khảo bộ sưu tập mẫu đa dạng của chúng tôi hoặc mang theo ý tưởng xăm của riêng mình. Các nghệ sĩ của chúng tôi cũng rất am hiểu về kỹ thuật che hình cũ (cover-up) và chỉnh sửa hình xăm, giúp bạn làm mới hoặc biến đổi những hình xăm cũ thành tác phẩm mà bạn sẽ yêu thích trở lại.</p><p data-start=\"540\" data-end=\"758\">CrimsonInk Tattoo Studio nổi tiếng với dịch vụ thân thiện và cam kết mức giá tốt nhất trong khu vực. Bạn sẽ được tận hưởng không gian studio có máy lạnh, âm nhạc tuyệt vời, dịch vụ giải trí.</p><p data-start=\"540\" data-end=\"758\">Hãy trải nghiệm nghệ thuật xăm hình và dịch vụ đẳng cấp tại CrimsonInk Tattoo Studio – nơi sự an toàn, thoải mái và hài lòng của bạn luôn là ưu tiên hàng đầu.</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,2,'2026-09-22 22:24:58','2026-09-27 08:23:24'),(5,'faqs','service','page.faqs','default','Frequently Asked Questions','Câu Hỏi Thường Gặp','<span>CrimsonInk</span> Tattoo Studio','Tiệm Xăm <span>CrimsonInk</span>','<p>Here are the questions customers frequently ask Crimson Ink—covering everything from booking and the tattooing process to aftercare. Can\'t find the answer you need? Send us a message via the booking page.</p>','<p>Những câu hỏi khách hay gửi tới Crimson Ink — từ đặt lịch, quy trình xăm cho tới chăm sóc sau khi xăm. Chưa thấy câu trả lời bạn cần? Nhắn cho chúng tôi qua trang đặt lịch.</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,5,'2026-09-22 22:24:58','2026-09-28 04:12:54'),(7,'gallery','page','page.gallery','gallery','Gallery','Thư viện ảnh',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,7,'2026-09-22 22:24:58','2026-09-22 22:24:58'),(8,'contact-us','landing','page.contact-us','booking','Book Your Appointment','Đặt lịch xăm',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,8,'2026-09-22 22:24:58','2026-09-22 22:24:58'),(9,'artists','page','page.artists','default','Our Artists','Đội ngũ artist',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,9,'2026-09-22 22:24:58','2026-09-22 22:24:58'),(10,'tattoo-styles','page','page.tattoo-styles','default','Tattoo Styles','Phong cách xăm',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,10,'2026-09-22 22:24:58','2026-09-22 22:24:58');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `redirects`
--

DROP TABLE IF EXISTS `redirects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `redirects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_code` smallint(6) NOT NULL DEFAULT '301',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `redirects_from_path_unique` (`from_path`),
  KEY `redirects_is_active_index` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `redirects`
--

LOCK TABLES `redirects` WRITE;
/*!40000 ALTER TABLE `redirects` DISABLE KEYS */;
/*!40000 ALTER TABLE `redirects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author_name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_avatar_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_country` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` tinyint(3) unsigned NOT NULL DEFAULT '5',
  `content_en` text COLLATE utf8mb4_unicode_ci,
  `content_vi` text COLLATE utf8mb4_unicode_ci,
  `source` enum('google','facebook','instagram','manual') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'manual',
  `source_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reviewed_at` date DEFAULT NULL,
  `artist_id` int(10) unsigned DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` smallint(6) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_artist_id_index` (`artist_id`),
  KEY `reviews_is_featured_index` (`is_featured`),
  KEY `reviews_is_active_index` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,'Khách hàng 1',NULL,NULL,5,'Replace this with a real client review.','Thay bằng nội dung review thật của khách.','manual',NULL,'2026-09-09',NULL,1,1,1,'2026-09-22 22:24:58','2026-09-22 22:24:58'),(2,'Khách hàng 2',NULL,NULL,5,'Replace this with a real client review.','Thay bằng nội dung review thật của khách.','manual',NULL,'2026-09-02',NULL,1,1,2,'2026-09-22 22:24:58','2026-09-22 22:24:58'),(3,'Khách hàng 3',NULL,NULL,5,'Replace this with a real client review.','Thay bằng nội dung review thật của khách.','manual',NULL,'2026-08-24',NULL,1,1,3,'2026-09-22 22:24:58','2026-09-22 22:24:58');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('text','textarea','html','image','number','bool','json') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `value` text COLLATE utf8mb4_unicode_ci,
  `value_en` text COLLATE utf8mb4_unicode_ci,
  `value_vi` text COLLATE utf8mb4_unicode_ci,
  `sort_order` smallint(6) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_group_key_unique` (`group`,`key`),
  KEY `settings_group_index` (`group`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'studio','name','text','Crimson Ink',NULL,NULL,1,'2026-09-22 23:43:38','2026-09-22 23:43:38'),(2,'studio','phone','text','+84 346.955.898',NULL,NULL,3,'2026-09-22 23:43:38','2026-09-22 23:43:38'),(3,'studio','whatsapp','text','84346955898',NULL,NULL,3,'2026-09-22 22:24:58','2026-09-22 22:24:58'),(4,'studio','email','text','luuphongnha1990@gmail.com',NULL,NULL,6,'2026-09-22 23:43:38','2026-09-22 23:43:38'),(5,'studio','address','text',NULL,'98 Quan Thanh, Ba Dinh, Hanoi, Viet Nam','98 Quán Thánh, Ba Đình, Hà Nội, Việt Nam',7,'2026-09-22 23:43:38','2026-09-22 23:43:38'),(7,'studio','logo_path','image','assets/imgs/logo.png',NULL,NULL,2,'2026-09-22 23:43:38','2026-09-22 23:43:38'),(8,'studio','map_embed_url','text','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.7607082127593!2d105.84125917606741!3d21.04225858061056!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab23b20878bf%3A0xd2848ff4501761e0!2sHanoiink%20Tattoo!5e0!3m2!1svi!2s!4v1789201926546!5m2!1svi!2s',NULL,NULL,10,'2026-09-22 23:43:38','2026-09-22 23:43:38'),(9,'studio','copyright','text',NULL,'Copyright © 2026 CrimsonInk. All rights reserved','Copyright © 2026 CrimsonInk. Bảo lưu mọi quyền',11,'2026-09-22 23:43:38','2026-09-22 23:43:38'),(10,'i18n','locales','json','[{\"code\":\"vi\",\"label\":\"Tiếng Việt\",\"flag_path\":\"assets/imgs/vnflat.png\",\"is_default\":true},{\"code\":\"en\",\"label\":\"English\",\"flag_path\":\"assets/imgs/ukflat.png\",\"is_default\":false}]',NULL,NULL,1,'2026-09-22 23:43:38','2026-09-22 23:43:38'),(11,'social','links','json','[{\"platform\":\"whatsapp\",\"label\":\"WhatsApp\",\"url\":\"https://wa.me/84346955898\",\"icon\":\"fab fa-whatsapp\",\"footer\":true,\"dock\":true,\"header\":false,\"sort\":1},{\"platform\":\"instagram\",\"label\":\"Instagram\",\"url\":\"https://www.instagram.com/crimsonink.tattoo/\",\"icon\":\"fab fa-instagram\",\"footer\":true,\"dock\":true,\"header\":false,\"sort\":2},{\"platform\":\"facebook\",\"label\":\"Facebook\",\"url\":\"https://www.facebook.com/\",\"icon\":\"fab fa-facebook-f\",\"footer\":true,\"dock\":true,\"header\":false,\"sort\":3},{\"platform\":\"phone\",\"label\":\"Phone\",\"url\":\"tel:+84346955898\",\"icon\":\"fas fa-phone-alt\",\"footer\":true,\"dock\":false,\"header\":false,\"sort\":4}]',NULL,NULL,1,'2026-09-22 23:43:38','2026-09-28 16:53:43'),(12,'booking','notify_email','text',NULL,NULL,NULL,1,'2026-09-22 23:43:38','2026-09-22 23:43:38'),(13,'booking','code_prefix','text','CI',NULL,NULL,2,'2026-09-22 23:43:38','2026-09-22 23:43:38'),(14,'studio','phone_url','text','tel:+84346955898',NULL,NULL,4,'2026-09-22 23:43:38','2026-09-22 23:43:38'),(15,'studio','whatsapp_url','text','https://wa.me/84346955898',NULL,NULL,5,'2026-09-22 23:43:38','2026-09-22 23:43:38'),(16,'studio','open_days','text',NULL,'Open Daily','Mở cửa tất cả các ngày',8,'2026-09-22 23:43:38','2026-09-22 23:43:38'),(17,'studio','open_hours','text','10 am – 18 pm',NULL,NULL,9,'2026-09-22 23:43:38','2026-09-22 23:43:38');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tattoo_styles`
--

DROP TABLE IF EXISTS `tattoo_styles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tattoo_styles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_vi` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt_vi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_en` longtext COLLATE utf8mb4_unicode_ci,
  `content_vi` longtext COLLATE utf8mb4_unicode_ci,
  `cover_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `has_detail_page` tinyint(1) NOT NULL DEFAULT '0',
  `route_name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title_en` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title_vi` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description_en` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description_vi` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` smallint(6) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tattoo_styles_slug_unique` (`slug`),
  KEY `tattoo_styles_is_featured_index` (`is_featured`),
  KEY `tattoo_styles_is_active_index` (`is_active`),
  KEY `tattoo_styles_sort_order_index` (`sort_order`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tattoo_styles`
--

LOCK TABLES `tattoo_styles` WRITE;
/*!40000 ALTER TABLE `tattoo_styles` DISABLE KEYS */;
INSERT INTO `tattoo_styles` VALUES (1,'fineline','Fineline','Fineline',NULL,NULL,NULL,NULL,'assets/images/tattoo-gallery-1.jpg',0,NULL,NULL,NULL,NULL,NULL,1,1,1,'2026-09-22 22:24:58','2026-09-22 22:24:58',NULL),(2,'blackwork','Blackwork','Blackwork',NULL,NULL,NULL,NULL,'assets/images/tattoo-gallery-2.jpg',0,NULL,NULL,NULL,NULL,NULL,1,1,2,'2026-09-22 22:24:58','2026-09-22 22:24:58',NULL),(3,'traditional','Traditional','Truyền thống',NULL,NULL,NULL,NULL,'assets/images/tattoo-gallery-3.jpg',0,NULL,NULL,NULL,NULL,NULL,1,1,3,'2026-09-22 22:24:58','2026-09-22 22:24:58',NULL),(4,'realism-tattoos','Realism','Tả thực',NULL,NULL,NULL,NULL,'assets/images/Realism-tattoo-31-1-768x670.png',1,'page.tattoo-styles.realism-tattoos',NULL,NULL,NULL,NULL,1,1,4,'2026-09-22 22:24:58','2026-09-22 22:24:58',NULL),(5,'japanese-tattoos','Japanese','Nhật Bản',NULL,NULL,NULL,NULL,'assets/images/Japanese-tattoo-61-768x670.png',1,'page.tattoo-styles.japanese-tattoos',NULL,NULL,NULL,NULL,1,1,5,'2026-09-22 22:24:58','2026-09-22 22:24:58',NULL),(6,'tribal-tattoos','Tribal','Thổ dân',NULL,NULL,NULL,NULL,'assets/images/Tribal-tattoo-21-768x670.png',1,'page.tattoo-styles.tribal-tattoos',NULL,NULL,NULL,NULL,1,1,6,'2026-09-22 22:24:58','2026-09-22 22:24:58',NULL),(7,'cartoon-tattoos','Cartoon','Hoạt hình',NULL,NULL,NULL,NULL,'assets/images/cartoon-tattoo--768x670.png',1,'page.tattoo-styles.cartoon-tattoos',NULL,NULL,NULL,NULL,1,1,7,'2026-09-22 22:24:58','2026-09-22 22:24:58',NULL),(8,'lettering','Lettering','Chữ',NULL,NULL,NULL,NULL,'assets/images/tattoo-gallery-4.jpg',0,NULL,NULL,NULL,NULL,NULL,1,1,8,'2026-09-22 22:24:58','2026-09-22 22:24:58',NULL),(9,'big-piece','Big Piece','Mảng lớn',NULL,NULL,NULL,NULL,'assets/images/tattoo-gallery-5.jpg',0,NULL,NULL,NULL,NULL,NULL,1,1,9,'2026-09-22 22:24:58','2026-09-22 22:24:58',NULL),(10,'dotwork','Dotwork','Chấm điểm',NULL,NULL,NULL,NULL,'assets/images/tattoo-gallery-6.jpg',0,NULL,NULL,NULL,NULL,NULL,1,1,10,'2026-09-22 22:24:58','2026-09-22 22:24:58',NULL),(11,'landscape','Landscape','Phong cảnh',NULL,NULL,NULL,NULL,'assets/images/tattoo-gallery-7.jpg',0,NULL,NULL,NULL,NULL,NULL,1,1,11,'2026-09-22 22:24:58','2026-09-22 22:24:58',NULL),(12,'demon','Demon','Quỷ dữ',NULL,NULL,NULL,NULL,'assets/images/tattoo-gallery-8.jpg',0,NULL,NULL,NULL,NULL,NULL,1,1,12,'2026-09-22 22:24:58','2026-09-22 22:24:58',NULL);
/*!40000 ALTER TABLE `tattoo_styles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','editor') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'editor',
  `google_id` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stat` tinyint(4) NOT NULL DEFAULT '0',
  `last_login` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_phone_unique` (`phone`),
  UNIQUE KEY `users_google_id_unique` (`google_id`),
  KEY `users_stat_index` (`stat`),
  KEY `users_role_index` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'nguyendong1990@gmail.com','0934348822','Nguyen Dong','admin','101471010302209970675','https://lh3.googleusercontent.com/a/ACg8ocJNW2Rp1ROWP8e3GKRJA8GdCrwIPoNhUDNsNAwN2ZLpUDYIlfS_=s96-c',NULL,NULL,1,NULL,NULL,'2026-09-25 14:42:39','2026-09-25 14:42:39');
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

-- Dump completed on 2026-09-30  9:21:43
