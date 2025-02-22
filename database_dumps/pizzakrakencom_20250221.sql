-- MySQL dump 10.13  Distrib 8.0.41, for Linux (x86_64)
--
-- Host: localhost    Database: pizzakrakencom
-- ------------------------------------------------------
-- Server version	8.0.41-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `blog_posts`
--

DROP TABLE IF EXISTS `blog_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog_posts` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` json DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blog_posts_slug_unique` (`slug`),
  KEY `blog_posts_user_id_foreign` (`user_id`),
  CONSTRAINT `blog_posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_posts`
--

LOCK TABLES `blog_posts` WRITE;
/*!40000 ALTER TABLE `blog_posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brands` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `seo_title` text COLLATE utf8mb4_unicode_ci,
  `seo_description` text COLLATE utf8mb4_unicode_ci,
  `seo_faq_questions` json DEFAULT NULL,
  `seo_about_content` text COLLATE utf8mb4_unicode_ci,
  `seo_keywords` json DEFAULT NULL,
  `cooking_instructions` text COLLATE utf8mb4_unicode_ci,
  `unique_selling_points` text COLLATE utf8mb4_unicode_ci,
  `social_media_handles` json DEFAULT NULL,
  `brand_story` text COLLATE utf8mb4_unicode_ci,
  `founded_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `headquarters_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `brands_slug_unique` (`slug`),
  KEY `brands_image_id_foreign` (`image_id`),
  CONSTRAINT `brands_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES ('024d3652-3023-4942-863d-08306b9abf88','Sbarro','sbarro','Sbarro is known for its New York-style frozen pizzas.','https://www.sbarro.com/','9e40e51e-9a0a-49cb-a1f8-30f8dbb6b2b1','2025-02-20 01:39:50','2025-02-20 01:39:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('02f98953-bcc9-435e-8bce-82944f2f1350','BOLD','bold','BOLD offers unique and flavorful frozen pizzas.','https://www.boldpizzas.com/','9e40e51e-4fac-4bf3-abe6-5a25bd0ce4e8','2025-02-20 01:39:50','2025-02-20 01:39:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('1ed3f0b6-6f0a-4d34-8d4d-175fd53bfb69','Screamin Sicilian','screamin-sicilian','Screamin Sicilian offers bold and flavorful frozen pizzas.','https://www.screamin-sicilian.com/','9e40e51e-9f10-4c54-a17e-6d17a9ffcc58','2025-02-20 01:39:50','2025-02-20 01:39:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('20236163-901d-4467-9a5f-0e3ac3f95fec','Tombstone','tombstone','Tombstone offers a variety of classic frozen pizzas.','https://www.tombstonepizza.com/','9e40e51e-35f1-46be-a7f2-8abab9bcb6a3','2025-02-20 01:39:50','2025-02-20 01:39:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('2211dba7-60c0-4077-8913-115434048a08','Gluseppe','gluseppe','Gluseppe specializes in gourmet frozen pizzas.','https://www.gluseppe.com/','9e40e51e-6ecb-466b-926f-f46bb831b5ba','2025-02-20 01:39:50','2025-02-20 01:39:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('256a7b1b-9486-42c7-8d10-bcefeea0151e','Palermos','palermos','Palermos specializes in authentic Italian frozen pizzas.','https://www.palermos.com/','9e40e51e-94d6-43b1-8a74-91d108acbe44','2025-02-20 01:39:50','2025-02-20 01:39:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('309838ba-9662-4512-b122-744b2ec46824','Chopsies','chopsies','Chopsies offers a variety of frozen pizzas with fresh ingredients.','https://www.chopsies.com/','9e40e51e-5fcd-42b0-ad55-ae3ff5cb7956','2025-02-20 01:39:50','2025-02-20 01:39:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('45ae7f56-6826-4742-9b52-4afa801c7a56','American Flatbread','american-flatbread','George Schenk founded American Flatbread in Waitsfield, VT on personal philosophies of food and community. “Food intimately affects the quality and character of our lives,” he says. “Too often food is seen principally as a vehicle for profit, rather than in its historic sense as a giver of nutrition.”\n\nHe created the American Flatbread concept in 1985 while working in the kitchen at Tucker Hill Restaurant, where a personal passion for cooking with wood led him to build an outdoor oven. Tuesday nights became Flatbread Nights, and the bread was baked under the stars.\n\nWith help, he expanded the concept in 1988 to include a wholesale component as well as a retail outlet, which provided the basis for the current model. George continues to develop his vision for the food at American Flatbread and is very involved in daily operations while becoming increasingly influential in his community and that of the culinary world.','https://www.americanflatbread.com/','9e40e51e-0fca-48c3-b1b6-ce5239a15cc3','2025-02-20 01:39:50','2025-02-20 02:56:31','American Flatbread Frozen Pizzas | Authentic Wood-Fired Pizza Reviews','Discover American Flatbread\'s authentic wood-fired frozen pizzas. Read honest reviews, nutritional information, and find your favorite varieties of these artisanal, handmade frozen pizzas.','[{\"answer\": \"American Flatbread pizzas are handmade, wood-fired frozen pizzas known for their thin, crispy crust and high-quality, organic ingredients. Each pizza is crafted with traditional methods and baked in wood-fired ovens.\", \"question\": \"What makes American Flatbread pizzas unique?\"}, {\"answer\": \"American Flatbread frozen pizzas are available at many major grocery stores, natural food stores, and specialty markets across the United States. You can also find them at retailers like Whole Foods Market and other premium grocery chains.\", \"question\": \"Where can I buy American Flatbread frozen pizzas?\"}, {\"answer\": \"American Flatbread uses many organic ingredients, including 100% organically grown wheat in their crusts. While not all ingredients are organic, they prioritize high-quality, natural ingredients without artificial preservatives.\", \"question\": \"Are American Flatbread pizzas organic?\"}, {\"answer\": \"For best results, preheat your oven to 425°F (218°C) and place the frozen pizza directly on the oven rack. Cook for approximately 15-20 minutes or until the cheese is melted and the crust is crispy. Cooking times may vary by oven.\", \"question\": \"How should I cook American Flatbread frozen pizza?\"}, {\"answer\": \"American Flatbread offers a variety of pizzas including classics like Cheese & Herb, as well as unique combinations featuring organic and locally-sourced ingredients. Each variety maintains their commitment to quality and traditional preparation methods.\", \"question\": \"What varieties of American Flatbread pizzas are available?\"}]','American Flatbread is renowned for their authentic wood-fired frozen pizzas, crafted with organic ingredients and traditional methods. Each pizza is handmade and baked in wood-fired ovens, capturing the essence of artisanal pizza-making. Their commitment to quality ingredients and traditional baking methods sets them apart in the frozen pizza market.','[\"American Flatbread pizzas\", \"wood-fired frozen pizza\", \"organic frozen pizza\", \"artisanal frozen pizza\", \"handmade frozen pizza\", \"authentic frozen pizza\", \"best frozen pizza\", \"American Flatbread reviews\", \"American Flatbread nutrition\", \"American Flatbread ingredients\"]','For the perfect American Flatbread pizza experience:\n\n1. Preheat your oven to 425°F (218°C)\n2. Remove pizza from box and plastic wrap\n3. Place frozen pizza directly on your oven rack\n4. Cook for 15-20 minutes or until cheese is melted and crust is crispy\n5. Let cool for 2-3 minutes before slicing\n\nNote: Cooking times may vary by oven. Watch carefully to avoid overcooking.','• Authentic wood-fired frozen pizzas\n• Handmade with organic and natural ingredients\n• No artificial preservatives or additives\n• Traditional baking methods\n• Thin, crispy crust\n• Premium, locally-sourced ingredients when possible\n• Commitment to quality and authenticity','{\"Twitter\": \"https://twitter.com/AmFlatbread\", \"Facebook\": \"https://www.facebook.com/AmericanFlatbreadFrozenPizzas\", \"Instagram\": \"https://www.instagram.com/americanflatbread\"}','American Flatbread began with a simple mission: to create authentic, wood-fired pizzas that maintain their artisanal quality even when frozen. Founded on the principles of traditional pizza-making and a commitment to organic, high-quality ingredients, American Flatbread has revolutionized the frozen pizza category by proving that convenience doesn\'t have to compromise quality.\n\nEach pizza is handmade, featuring a thin, crispy crust made from 100% organically grown wheat, and topped with carefully selected ingredients. The pizzas are baked in wood-fired ovens, giving them their distinctive flavor and texture that sets them apart from conventional frozen pizzas.','1990','Waitsfield, Vermont'),('5c83d51d-a4c7-416e-a272-6be9b1818825','Jacks','jacks','Jack’s is known for its affordable and delicious frozen pizzas.','https://www.jackspizza.com/','9e40e51e-82fd-49ea-881b-66b7e0e517f9','2025-02-20 01:39:50','2025-02-20 01:39:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('5f56d27c-3435-4833-bf3c-e87d7f880494','Delissio','delissio','Delissio offers a variety of frozen pizzas with unique flavors.','https://www.delissio.com/','9e40e51e-69e3-4824-8456-ddcd5648dece','2025-02-20 01:39:50','2025-02-20 01:39:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('62fd4b3b-9f77-4831-bbfa-d2cedb845966','Bellatoria','bellatoria','Bellatoria offers a variety of frozen pizzas with gourmet toppings.','https://www.bellatoria.com/','9e40e51e-49a0-4fae-a987-42a7218fb9f6','2025-02-20 01:39:50','2025-02-20 01:39:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('638b8199-85f2-44c1-99c0-e3cbef7ee04d','Udi\'s','udis','Udi’s offers gluten-free pizzas and other products.','https://udisglutenfree.com/','9e40e51e-40bc-4fbb-952a-8c2acc1c8437','2025-02-20 01:39:50','2025-02-20 01:39:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('680130b0-8225-4755-800c-332bc61cabee','Luiges','luiges','Luige’s frozen pizza originated in 1952. After 30 years of making fresh pizzas, the group decided to move into the frozen category. In the local Turner halls people could eat free pizza every Tuesday and\nThursday. What the Luige’s people were doing was developing a taste profile. You could grab a slice of\npizza, but you would always have to vote if you liked it, and this went on for years. The end game was a\ngreat tasting product, but also a product that was developed at a lower cost.\n    During the 70s and 80s Luige’s was primarily a fundraising pizza and in the 90s, Luige’s moved into the tavern delivery business. Luige’s was wildly successful, and to this day is the premier brand in Wisconsin. In 2011 Luige’s launched retail distribution in the upper Midwest and was once again very successful. In a meeting in Chicago with some of the largest players in the US, the comment was made Wisconsin has Luige’s and a lot of companies that want to be like them.','https://www.luigespizza.com/','9e40e51e-a944-441d-9a83-74329de11030','2025-02-20 01:39:50','2025-02-20 01:39:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('71a15bc6-d22b-4956-8831-25e7ff25d36c','GoodFellas','goodfellas','GoodFellas is known for its authentic Italian frozen pizzas.','https://www.goodfellas.com/','9e40e51e-7842-42af-9f61-623d5999a1fa','2025-02-20 01:39:50','2025-02-20 01:39:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('82478736-47ed-4fef-802b-9413059a9bda','Whole Foods','whole-foods','Whole Foods Market is known for its organic and natural foods, including frozen pizzas.','https://www.wholefoodsmarket.com/','9e40e51e-4521-4d35-ade7-dff87f371cb8','2025-02-20 01:39:50','2025-02-20 01:39:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('82bf6634-642c-4e2b-9521-9239e47ff53b','Amy\'s','amys','Amy’s Kitchen is a family-owned company that makes delicious organic and non-GMO convenience foods.','https://www.amys.com/','9e40e51e-201d-4310-b2e2-44da72b0f604','2025-02-20 01:39:50','2025-02-20 01:39:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('8e6e05e6-c8fb-48b5-baeb-ed441764bb92','Celeste','celeste','Celeste offers a variety of frozen pizzas at affordable prices.','https://www.celestepizza.com/','9e40e51e-5a1d-468f-822c-1c0daa630a19','2025-02-20 01:39:50','2025-02-20 01:39:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('92b3db56-f7c4-4eb7-bf36-dcb896de530c','Freschetta','freschetta','Freschetta offers a variety of frozen pizzas with fresh ingredients.','https://www.freschetta.com/','9e40e51e-64ec-4cc2-8c66-65b49e0c6ac6','2025-02-20 01:39:50','2025-02-20 01:39:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('99cedbc2-2b5f-4dcc-bab4-0075a8678947','California Pizza Kitchen','california-pizza-kitchen','California Pizza Kitchen is a casual dining restaurant chain that specializes in California-style pizza.','https://www.cpk.com/','9e40e51e-2640-470e-ac25-8ae2b7350cff','2025-02-20 01:39:50','2025-02-20 01:39:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('a8b95069-a474-4aec-88c0-f9112f500a26','Jenos Pizza','jenos-pizza','Jenos Pizza offers a variety of frozen pizza options.','https://www.jenospizza.com/','9e40e51e-86d1-47ea-9c96-94f1ff20fea9','2025-02-20 01:39:50','2025-02-20 01:39:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('c3f7169f-859c-4861-b23f-9da132ab8fe4','Newmans','newmans','Newmans offers frozen pizzas made with organic ingredients.','https://www.newmansown.com/','9e40e51e-908c-4c4f-aaa9-c858ff159aa3','2025-02-20 01:39:50','2025-02-20 01:39:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('cb0af916-e103-4b84-bc52-339b83c9d299','The Take Away','the-take-away','The Take Away provides a variety of frozen pizza options for quick meals.','https://www.thetakeaway.com/','9e40e51e-a3a5-46be-a0fb-77282e572f25','2025-02-20 01:39:50','2025-02-20 01:39:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('d9ceab26-a9d3-4608-abeb-4d296ae3178a','Home Run Inn','home-run-inn','Home Run Inn offers a variety of frozen pizzas inspired by their restaurant recipes.','https://www.homeruninn.com/','9e40e51e-7e40-4f0b-9ff1-4b7af5eca0d4','2025-02-20 01:39:50','2025-02-20 01:39:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('f02404eb-0c7d-4fd3-a44f-917b8c3ecb7a','Red Baron','red-baron','Red Baron is famous for its classic crust pizzas.','https://www.redbaron.com/','9e40e51e-30f5-4fd3-95a1-2c569303de4d','2025-02-20 01:39:50','2025-02-20 01:39:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('f4292754-2c82-4d10-b6bf-1b04cf14384f','Digiorno','digiorno','Digiorno is known for its rising crust pizzas.','https://www.digiorno.com/','9e40e51e-2beb-403c-89a3-28bef37653f1','2025-02-20 01:39:50','2025-02-20 01:39:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('f4d161df-bf52-40ad-b06a-db7e52fbabda','Caulipower','caulipower','Caulipower specializes in cauliflower-based pizzas.','https://www.caulipowerpizza.com/','9e40e51e-54cb-4b26-8c7a-92655554334a','2025-02-20 01:39:50','2025-02-20 01:39:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('f69cccee-e689-494e-80b4-df626cfb9bed','Tony\'s','tonys','Tony’s is known for its delicious frozen pizzas.','https://www.tonyspizza.com/','9e40e51e-3bf5-4cee-9b97-bd5bc86172c8','2025-02-20 01:39:50','2025-02-20 01:39:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('fda7eaad-fbb5-418f-b1b3-33ef299a7b96','Glutino','glutino','Glutino offers gluten-free frozen pizza options.','https://www.glutino.com/','9e40e51e-7302-474d-8bc5-d4c7c786910b','2025-02-20 01:39:50','2025-02-20 01:39:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('fdefefa9-aa93-4950-8baf-585b51955e87','Kashi','kashi','Kashi provides healthy frozen pizza options made with wholesome ingredients.','https://www.kashi.com/','9e40e51e-8ba4-40d7-a12a-47dc7225356c','2025-02-20 01:39:50','2025-02-20 01:39:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_feedback`
--

DROP TABLE IF EXISTS `contact_feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_feedback` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_feedback_user_id_foreign` (`user_id`),
  CONSTRAINT `contact_feedback_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_feedback`
--

LOCK TABLES `contact_feedback` WRITE;
/*!40000 ALTER TABLE `contact_feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
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
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `images` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` bigint unsigned NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `width` int unsigned NOT NULL,
  `height` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES ('9e40e51e-0fca-48c3-b1b6-ce5239a15cc3','public','images/logos/frozen','AmericanFlatbread.png','png',12624,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-201d-4310-b2e2-44da72b0f604','public','images/logos/frozen','Amys.png','png',15018,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-2640-470e-ac25-8ae2b7350cff','public','images/logos/frozen','CaliforniaPizzaKitchen.png','png',19725,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-2beb-403c-89a3-28bef37653f1','public','images/logos/frozen','Digiorno.png','png',25337,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-30f5-4fd3-95a1-2c569303de4d','public','images/logos/frozen','RedBaron.png','png',23600,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-35f1-46be-a7f2-8abab9bcb6a3','public','images/logos/frozen','Tombstone.png','png',24535,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-3bf5-4cee-9b97-bd5bc86172c8','public','images/logos/frozen','Tonys.png','png',15554,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-40bc-4fbb-952a-8c2acc1c8437','public','images/logos/frozen','Udis.png','png',33000,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-4521-4d35-ade7-dff87f371cb8','public','images/logos/frozen','WholeFoods.png','png',32464,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-49a0-4fae-a987-42a7218fb9f6','public','images/logos/frozen','Bellatoria.png','png',16979,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-4fac-4bf3-abe6-5a25bd0ce4e8','public','images/logos/frozen','BOLD.png','png',19974,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-54cb-4b26-8c7a-92655554334a','public','images/logos/frozen','Caulipower.png','png',11050,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-5a1d-468f-822c-1c0daa630a19','public','images/logos/frozen','Celeste.png','png',23618,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-5fcd-42b0-ad55-ae3ff5cb7956','public','images/logos/frozen','Chopsies.png','png',34496,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-64ec-4cc2-8c66-65b49e0c6ac6','public','images/logos/frozen','Freschetta.png','png',29052,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-69e3-4824-8456-ddcd5648dece','public','images/logos/frozen','Delissio.png','png',18369,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-6ecb-466b-926f-f46bb831b5ba','public','images/logos/frozen','Gluseppe.png','png',16782,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-7302-474d-8bc5-d4c7c786910b','public','images/logos/frozen','Glutino.png','png',6857,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-7842-42af-9f61-623d5999a1fa','public','images/logos/frozen','GoodFellas.png','png',24978,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-7e40-4f0b-9ff1-4b7af5eca0d4','public','images/logos/frozen','HomeRunInn.png','png',21988,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-82fd-49ea-881b-66b7e0e517f9','public','images/logos/frozen','Jacks.png','png',20082,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-86d1-47ea-9c96-94f1ff20fea9','public','images/logos/frozen','JenosPizza.png','png',23926,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-8ba4-40d7-a12a-47dc7225356c','public','images/logos/frozen','Kashi.png','png',8333,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-908c-4c4f-aaa9-c858ff159aa3','public','images/logos/frozen','Newmans.png','png',48572,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-94d6-43b1-8a74-91d108acbe44','public','images/logos/frozen','Palermos.png','png',29491,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-9a0a-49cb-a1f8-30f8dbb6b2b1','public','images/logos/frozen','Sbarro.png','png',25915,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-9f10-4c54-a17e-6d17a9ffcc58','public','images/logos/frozen','ScreaminSicilian.png','png',38843,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-a3a5-46be-a0fb-77282e572f25','public','images/logos/frozen','TheTakeAway.png','png',48113,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-a944-441d-9a83-74329de11030','public','images/logos/frozen','Luiges.jpg','jpeg',10159,'image/jpeg',384,384,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-ae1b-427e-bfdc-aa7ad73cb2ae','public','images/styles','new-york.png','png',6121,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-b48b-4ee7-9941-90b476aa3350','public','images/styles','neopolitan.png','png',8038,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-b8ab-4977-a2c8-1a60a6d6a188','public','images/styles','tomato-pie.png','png',15191,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-beef-4b2b-9488-8fffdbbed945','public','images/styles','new-haven.png','png',7875,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-c4e0-4d05-b30a-ad1f9ecf1d2d','public','images/styles','sicilian.png','png',5422,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-c985-48bb-a239-cc83c515e338','public','images/styles','deep-dish.png','png',6718,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-ce08-4b97-951b-e1d5444740ca','public','images/styles','detroit.png','png',6730,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-d255-4b90-8912-8d57fbb3eac7','public','images/styles','st-louis.png','png',6753,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-d7b1-42a3-ad47-2b6d35740ac7','public','images/styles','california.png','png',7440,'image/png',200,200,'2025-02-20 01:39:50','2025-02-20 01:39:50'),('9e40e51e-dbd9-4839-9309-99894b30bc31','public','images/styles','ohio-valley.png','png',10923,'image/png',200,200,'2025-02-20 01:39:51','2025-02-20 01:39:51'),('9e40e51e-e0a2-46a0-ba41-aaf8fbf26d42','public','images/styles','bar-tavern.png','png',8513,'image/png',200,200,'2025-02-20 01:39:51','2025-02-20 01:39:51'),('9e40e51e-e4e8-4973-8fce-64f234493139','public','images/styles','grilled.png','png',13457,'image/png',200,200,'2025-02-20 01:39:51','2025-02-20 01:39:51'),('9e40e51e-e8e7-4c52-abb6-5764110fb313','public','images/styles','pan.png','png',12013,'image/png',200,200,'2025-02-20 01:39:51','2025-02-20 01:39:51'),('9e40e51e-ed6a-4809-b306-a6e29a0534a3','public','images/styles','stuffed-crust.png','png',6171,'image/png',200,200,'2025-02-20 01:39:51','2025-02-20 01:39:51'),('9e40e51e-f278-452d-b700-8513f7e2cb43','public','images/styles','vesuvio.png','png',5763,'image/png',200,200,'2025-02-20 01:39:51','2025-02-20 01:39:51'),('9e40e51e-f6a1-47d1-9b02-fb410d28b397','public','images/styles','old-forge.png','png',6395,'image/png',200,200,'2025-02-20 01:39:51','2025-02-20 01:39:51'),('9e40e51e-fafa-40b6-917e-9678646fdce3','public','images/styles','greek.png','png',9123,'image/png',200,200,'2025-02-20 01:39:51','2025-02-20 01:39:51'),('9e40e51e-fef8-484f-9863-1ebb2893c182','public','images/styles','quad-cities.png','png',8635,'image/png',200,200,'2025-02-20 01:39:51','2025-02-20 01:39:51'),('9e40e51f-033b-42d3-994b-9597c6ddf495','public','images/styles','colorado-mountain-pie.png','png',12402,'image/png',200,200,'2025-02-20 01:39:51','2025-02-20 01:39:51'),('9e40e51f-07b7-4c91-ac22-0334c4c33419','public','images/styles','dc-jumbo.png','png',11378,'image/png',200,200,'2025-02-20 01:39:51','2025-02-20 01:39:51'),('9e40e51f-0cd4-43c4-be73-d7ec2db0526e','public','images/styles','brier-hill.png','png',12050,'image/png',200,200,'2025-02-20 01:39:51','2025-02-20 01:39:51'),('9e40e51f-11b1-4c21-bec0-d923740c06cd','public','images/styles','thin-crust.png','png',9555,'image/png',200,200,'2025-02-20 01:39:51','2025-02-20 01:39:51'),('9e40e51f-1642-46ea-a482-75a9a36d59ec','public','images/styles','pizza-strips.png','png',3900,'image/png',200,200,'2025-02-20 01:39:51','2025-02-20 01:39:51'),('9e40e51f-1b4b-4c6f-8c3f-0fbc249dbbee','public','images/styles','hand-tossed.png','png',7583,'image/png',200,200,'2025-02-20 01:39:51','2025-02-20 01:39:51'),('9e40fe6b-37ae-4b31-9121-6d8c8a56a5e6','public','images/pizzas/luiges/frozen','fresh-italian-pizza-cheese.jpeg','jpeg',128552,'image/jpeg',846,846,'2025-02-20 02:50:35','2025-02-20 02:50:35'),('9e40fe6c-36e4-4859-9940-6ec863f92ab2','public','images/pizzas/luiges/frozen','fresh-italian-pizza-cheese-sausage.jpeg','jpeg',140228,'image/jpeg',846,846,'2025-02-20 02:50:36','2025-02-20 02:50:36'),('9e40fe6d-7a4c-441c-9929-7b69128bca78','public','images/pizzas/luiges/frozen','fresh-italian-pizza-pepperoni.jpeg','jpeg',140434,'image/jpeg',846,846,'2025-02-20 02:50:36','2025-02-20 02:50:36'),('9e40fe6e-750b-4c85-bb0b-a95cc420ccc5','public','images/pizzas/luiges/frozen','fresh-italian-pizza-sausage-peppers.jpeg','jpeg',143484,'image/jpeg',846,846,'2025-02-20 02:50:37','2025-02-20 02:50:37'),('9e40fe6f-5576-48d7-a5a5-8eb61afa205e','public','images/pizzas/luiges/frozen','fresh-italian-pizza-sausage-mushroom.jpeg','jpeg',140195,'image/jpeg',846,846,'2025-02-20 02:50:38','2025-02-20 02:50:38'),('9e40fe70-90ab-43cc-bed7-7076c188780e','public','images/pizzas/luiges/frozen','fresh-italian-pizza-deluxe.jpeg','jpeg',145577,'image/jpeg',846,846,'2025-02-20 02:50:38','2025-02-20 02:50:38'),('9e40fe71-9f4b-4684-8877-f07b23a8c97f','public','images/pizzas/luiges/frozen','fresh-italian-pizza-supreme.jpeg','jpeg',142712,'image/jpeg',846,846,'2025-02-20 02:50:39','2025-02-20 02:50:39'),('9e40fe72-c6b5-4ad3-a066-51eeaa789d80','public','images/pizzas/luiges/frozen','original-homestyle-pizza-cheese.jpeg','jpeg',167994,'image/jpeg',846,846,'2025-02-20 02:50:40','2025-02-20 02:50:40'),('9e40fe74-425a-4ba0-872d-3aa65b3bacea','public','images/pizzas/luiges/frozen','original-homestyle-pizza-cheese-sausage.jpeg','jpeg',403566,'image/jpeg',1500,1500,'2025-02-20 02:50:41','2025-02-20 02:50:41'),('9e40fe75-73ee-43bd-8540-49366088b622','public','images/pizzas/luiges/frozen','original-homestyle-pizza-pepperoni.jpeg','jpeg',485827,'image/jpeg',1600,1600,'2025-02-20 02:50:42','2025-02-20 02:50:42'),('9e40fe76-b29f-42bb-8982-58dfcf8b2182','public','images/pizzas/luiges/frozen','original-homestyle-pizza-sausage-pepperoni.jpeg','jpeg',412273,'image/jpeg',1538,1536,'2025-02-20 02:50:42','2025-02-20 02:50:42'),('9e40fe78-d062-4d4c-bffb-b13094f2e217','public','images/pizzas/luiges/frozen','original-homestyle-pizza-deluxe.jpeg','jpeg',447049,'image/jpeg',1600,1600,'2025-02-20 02:50:44','2025-02-20 02:50:44'),('9e40fe7a-363f-4f07-9f8c-ecc2eeb5a025','public','images/pizzas/luiges/frozen','original-homestyle-pizza-mighty-meaty.jpeg','jpeg',469573,'image/jpeg',1600,1600,'2025-02-20 02:50:45','2025-02-20 02:50:45'),('9e40fe7b-8655-420d-ac87-ac91a4045184','public','images/pizzas/luiges/frozen','original-homestyle-pizza-sausage-mushroom.jpeg','jpeg',486574,'image/jpeg',1600,1600,'2025-02-20 02:50:46','2025-02-20 02:50:46'),('9e40fe7c-677f-4b4e-b572-e28d7577e863','public','images/pizzas/luiges/frozen','original-homestyle-pizza-sausage-mushroom-onion.jpeg','jpeg',167756,'image/jpeg',846,846,'2025-02-20 02:50:46','2025-02-20 02:50:46'),('9e40fe7d-63ea-4a90-88e7-87420cfd5828','public','images/pizzas/luiges/frozen','original-homestyle-pizza-supreme.jpeg','jpeg',172939,'image/jpeg',846,846,'2025-02-20 02:50:47','2025-02-20 02:50:47'),('9e40fe7f-5087-4f0f-96d2-793d75f2a30f','public','images/pizzas/luiges/frozen','big-daddy-pub-style-2x-pepperoni.jpeg','jpeg',354615,'image/jpeg',1500,1500,'2025-02-20 02:50:48','2025-02-20 02:50:48'),('9e40fe80-9a0a-4871-bbf1-1bb89873a53b','public','images/pizzas/luiges/frozen','big-daddy-pub-style-2x-sausage-pepperoni.jpeg','jpeg',348192,'image/jpeg',1500,1500,'2025-02-20 02:50:49','2025-02-20 02:50:49'),('9e40fe82-31c5-428b-9b3a-9e37e55fb017','public','images/pizzas/luiges/frozen','big-daddy-pub-style-2x-sausage-mushroom.jpeg','jpeg',341151,'image/jpeg',1500,1500,'2025-02-20 02:50:50','2025-02-20 02:50:50'),('9e40fe83-6628-4d17-8910-321afb2a30d4','public','images/pizzas/luiges/frozen','big-daddy-pub-style-3x-sausage.jpeg','jpeg',344010,'image/jpeg',1500,1500,'2025-02-20 02:50:51','2025-02-20 02:50:51'),('9e40fe84-7de7-4343-965a-2ea75a4c3213','public','images/pizzas/luiges/frozen','big-daddy-pub-style-chicken-alfredo.jpeg','jpeg',302702,'image/jpeg',1500,1500,'2025-02-20 02:50:51','2025-02-20 02:50:51'),('9e40fe85-9908-4d27-a07c-d5e0993881b1','public','images/pizzas/luiges/frozen','big-daddy-pub-style-mega-meaty.jpeg','jpeg',351780,'image/jpeg',1500,1500,'2025-02-20 02:50:52','2025-02-20 02:50:52'),('9e40fe87-09c1-4429-b69a-f8840c2c721a','public','images/pizzas/luiges/frozen','big-daddy-pub-style-3x-cheese-3x-meat.jpeg','jpeg',360468,'image/jpeg',1500,1500,'2025-02-20 02:50:53','2025-02-20 02:50:53'),('9e40fe8a-b85a-4af1-9c11-c64191728ebb','public','images/pizzas/luiges/frozen','big-daddy-pub-style-garlic-dipper.jpeg','jpeg',123826,'image/jpeg',800,800,'2025-02-20 02:50:55','2025-02-20 02:50:55'),('9e40fe8c-94c4-4022-9ebf-b7b15dcb385e','public','images/pizzas/luiges/frozen','big-daddy-pub-style-x-tra-special.jpeg','jpeg',329305,'image/jpeg',1500,1500,'2025-02-20 02:50:57','2025-02-20 02:50:57'),('9e40fe8d-7838-4099-b9e2-643a95c74c5e','public','images/pizzas/luiges/frozen','fresh-dough-pepperoni.jpeg','jpeg',163677,'image/jpeg',846,846,'2025-02-20 02:50:57','2025-02-20 02:50:57'),('9e40fe8e-f347-423d-a2da-1ba443591ddf','public','images/pizzas/luiges/frozen','fresh-dough-sausage-pepperoni.jpeg','jpeg',160225,'image/jpeg',846,846,'2025-02-20 02:50:58','2025-02-20 02:50:58'),('9e40fe90-0b49-4ba2-8256-0d0863eff167','public','images/pizzas/luiges/frozen','fresh-dough-gourmet-deluxe.jpeg','jpeg',158233,'image/jpeg',846,846,'2025-02-20 02:50:59','2025-02-20 02:50:59'),('9e40fe91-3a4f-433f-a195-40977861bb61','public','images/pizzas/luiges/frozen','fresh-dough-sausage-mushroom.jpeg','jpeg',167821,'image/jpeg',846,846,'2025-02-20 02:51:00','2025-02-20 02:51:00'),('9e40fe92-37b9-4691-b412-fc5d80b5ebda','public','images/pizzas/luiges/frozen','fresh-dough-breakfast-scramble.jpeg','jpeg',178484,'image/jpeg',846,846,'2025-02-20 02:51:00','2025-02-20 02:51:00'),('9e40fe93-b00b-440a-85cf-016cc5267d88','public','images/pizzas/luiges/frozen','fresh-dough-western-omelette.jpeg','jpeg',197346,'image/jpeg',990,1007,'2025-02-20 02:51:01','2025-02-20 02:51:01'),('9e41008a-f5fa-452c-ba7e-0f9a729cb5d6','public','images/pizzas/american-flatbread/frozen','cheese-herb.jpeg','jpeg',73842,'image/jpeg',1194,672,'2025-02-20 02:56:31','2025-02-20 02:56:31'),('9e41008b-eda6-4e08-8611-f68ebbbb55f1','public','images/pizzas/american-flatbread/frozen','vegan-harvest.jpeg','jpeg',186790,'image/jpeg',1000,1000,'2025-02-20 02:56:32','2025-02-20 02:56:32'),('9e41008d-b91f-495f-a8a7-7540ee6ad336','public','images/pizzas/american-flatbread/frozen','revolution.jpeg','jpeg',265717,'image/jpeg',1400,1400,'2025-02-20 02:56:33','2025-02-20 02:56:33');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `from_user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_from_user_id_foreign` (`from_user_id`),
  KEY `messages_to_user_id_foreign` (`to_user_id`),
  CONSTRAINT `messages_from_user_id_foreign` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `messages_to_user_id_foreign` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_01_01_000000_create_images_table',1),(5,'2024_03_20_000001_create_brands_table',1),(6,'2024_03_20_000002_create_styles_table',1),(7,'2024_03_20_000004_create_pizzas_table',1),(8,'2024_03_20_000006_create_reviews_table',1),(9,'2024_03_20_000007_create_messages_table',1),(10,'2024_03_20_000007_create_tags_table',1),(11,'2024_03_20_000008_create_blog_posts_table',1),(12,'2024_03_20_000015_create_detailed_nutrition_facts_table',1),(13,'2024_03_21_000001_create_review_images_table',1),(14,'2024_03_21_add_seo_fields_to_brands_table',1),(15,'2024_03_22_000001_add_rating_metrics_to_reviews',1),(16,'2025_02_03_215159_create_pizza_style_table',1),(17,'2025_02_09_184709_create_pizza_images_table',1),(18,'2025_02_18_015054_add_contact_feedback',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nutrition_facts`
--

DROP TABLE IF EXISTS `nutrition_facts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nutrition_facts` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pizza_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serving_per_container` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serving_size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calories` smallint unsigned NOT NULL,
  `total_fat` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saturated_fat` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trans_fat` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cholesterol` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sodium` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_carbohydrate` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dietary_fiber` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_sugars` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_sugars` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `protein` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vitamin_d` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calcium` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iron` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `potassium` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monounsaturated_fat` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `polyunsaturated_fat` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vitamin_a` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vitamin_c` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nutrition_facts_pizza_id_foreign` (`pizza_id`),
  CONSTRAINT `nutrition_facts_pizza_id_foreign` FOREIGN KEY (`pizza_id`) REFERENCES `pizzas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nutrition_facts`
--

LOCK TABLES `nutrition_facts` WRITE;
/*!40000 ALTER TABLE `nutrition_facts` DISABLE KEYS */;
INSERT INTO `nutrition_facts` VALUES ('9e41008a-fe15-4c2b-af63-10051343a9b8','40401493-7556-4031-b683-151177984b2a','3 servings per container','0.333 pizza (130 g)',370,'15g','8g','0g','45mg','850mg','41g','2g','1g','0g','19g','1.5mcg','390mg','2.2mg','180mg',NULL,NULL,NULL,NULL,'2025-02-20 02:56:31','2025-02-20 02:56:31'),('9e41008b-f484-4edf-8a4d-0b1b2b116d81','89c63831-e2cc-4ebf-9a11-afdd08140155','2 servings per container','145 g',260,'9g','1g','0g','0mg','650mg','38g','3g','2g','1g','6g',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-20 02:56:32','2025-02-20 02:56:32'),('9e41008d-bf20-4dd7-b2b0-fb4f3d768a81','a33a0809-b220-4b29-bd3b-2f5f51555586','3 servings per container','0.13 pizza',300,'12g','6g','0g','30mg','820mg','45g','4g','4g','1g','7g','0mcg','320mg','0.3mg','180mg',NULL,NULL,NULL,NULL,'2025-02-20 02:56:33','2025-02-20 02:56:33');
/*!40000 ALTER TABLE `nutrition_facts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pizza_images`
--

DROP TABLE IF EXISTS `pizza_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pizza_images` (
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pizza_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('main','back','other') COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `pizza_images_pizza_id_foreign` (`pizza_id`),
  KEY `pizza_images_image_id_foreign` (`image_id`),
  KEY `pizza_images_type_index` (`type`),
  CONSTRAINT `pizza_images_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pizza_images_pizza_id_foreign` FOREIGN KEY (`pizza_id`) REFERENCES `pizzas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pizza_images`
--

LOCK TABLES `pizza_images` WRITE;
/*!40000 ALTER TABLE `pizza_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `pizza_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pizza_style`
--

DROP TABLE IF EXISTS `pizza_style`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pizza_style` (
  `pizza_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `style_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `pizza_style_pizza_id_foreign` (`pizza_id`),
  KEY `pizza_style_style_id_foreign` (`style_id`),
  CONSTRAINT `pizza_style_pizza_id_foreign` FOREIGN KEY (`pizza_id`) REFERENCES `pizzas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pizza_style_style_id_foreign` FOREIGN KEY (`style_id`) REFERENCES `styles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pizza_style`
--

LOCK TABLES `pizza_style` WRITE;
/*!40000 ALTER TABLE `pizza_style` DISABLE KEYS */;
/*!40000 ALTER TABLE `pizza_style` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pizzas`
--

DROP TABLE IF EXISTS `pizzas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pizzas` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ingredients` text COLLATE utf8mb4_unicode_ci,
  `average_rating` decimal(3,2) NOT NULL DEFAULT '0.00',
  `average_appearance_rating` decimal(3,2) NOT NULL DEFAULT '0.00',
  `average_texture_rating` decimal(3,2) NOT NULL DEFAULT '0.00',
  `average_flavor_rating` decimal(3,2) NOT NULL DEFAULT '0.00',
  `total_reviews` int NOT NULL DEFAULT '0',
  `tags` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `brand_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `style_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allergens` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pizzas_slug_brand_id_unique` (`slug`,`brand_id`),
  KEY `pizzas_brand_id_foreign` (`brand_id`),
  KEY `pizzas_style_id_foreign` (`style_id`),
  KEY `pizzas_image_id_foreign` (`image_id`),
  CONSTRAINT `pizzas_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pizzas_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pizzas_style_id_foreign` FOREIGN KEY (`style_id`) REFERENCES `styles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pizzas`
--

LOCK TABLES `pizzas` WRITE;
/*!40000 ALTER TABLE `pizzas` DISABLE KEYS */;
INSERT INTO `pizzas` VALUES ('01b4e055-b8fd-41eb-91ef-2129bb7b28a3','Big Daddy Pub Style 3x Cheese & 3x Meat','big-daddy-pub-style-3x-cheese-3x-meat','Great things come in 3\'s! Italian Sausage, Pepperoni, and Spicy Italian Sausage topped with Mozzarella Cheese',NULL,0.00,0.00,0.00,0.00,0,'[\"cheesy\", \"meaty\"]','2025-02-20 02:50:53','2025-02-20 02:50:53','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe87-09c1-4429-b69a-f8840c2c721a',NULL,NULL),('2e636777-f81e-498f-99ab-8b7e3c1ba718','Big Daddy Pub Style 3x Sausage','big-daddy-pub-style-3x-sausage','Fully loaded with 3 varieties of Italian Sausage, one of them being spicy.',NULL,0.00,0.00,0.00,0.00,0,'[\"sausage\", \"spicy\"]','2025-02-20 02:50:51','2025-02-20 02:50:51','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe83-6628-4d17-8910-321afb2a30d4',NULL,NULL),('2f483903-78fd-4fbf-a053-76bbaddc0af3','Fresh Italian Pizza Deluxe','fresh-italian-pizza-deluxe','Crafted with Sausage, Pepperoni, Mushrooms, Black Olives, Green Peppers, Onions, and Mozzarella Cheese',NULL,0.00,0.00,0.00,0.00,0,'[\"deluxe\"]','2025-02-20 02:50:38','2025-02-20 02:50:38','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe70-90ab-43cc-bed7-7076c188780e',NULL,NULL),('398f107b-63a0-40db-a825-29d5f6784227','Fresh Italian Pizza Sausage & Mushroom','fresh-italian-pizza-sausage-mushroom','Fully loaded with Sausage, Mushrooms, and Mozzarella Cheese',NULL,0.00,0.00,0.00,0.00,0,'[\"sausage\", \"mushroom\"]','2025-02-20 02:50:38','2025-02-20 02:50:38','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe6f-5576-48d7-a5a5-8eb61afa205e',NULL,NULL),('3ac6fe3b-bd03-4a85-80d4-72754b531d65','Original \"Homestyle\" Pizza Deluxe','original-homestyle-pizza-deluxe','Crafted with Sausage, Pepperoni, Mushrooms, Black Olives, Green Peppers, Onions, and Mozzarella Cheese',NULL,0.00,0.00,0.00,0.00,0,'[\"deluxe\"]','2025-02-20 02:50:44','2025-02-20 02:50:44','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe78-d062-4d4c-bffb-b13094f2e217',NULL,NULL),('40401493-7556-4031-b683-151177984b2a','Cheese & Herb','cheese-herb','With mozzarella, garlic oil & fresh herbs. Handmade, wood-fired, thin & crispy pizza. Hand crafted to perfection! No artificial preservatives. You don\'t just eat an American Flatbread Pizza - you experience it. That is why we\'re serious about what goes in and on our pizza. To start, there\'s sourcing. We get our cheese straight from farms we trust and love. Then, there\'s quality. Our ingredients have to be fresh, handled properly-only the best. Quantity is Important, too. So is balance: getting all the flavors in our recipes to play well together, creating that special combination of textures that you love when you bite into a pizza. We\'re inspired by ingredients and the way they come together in a perfect bite for you. Unconditionally guaranteed if for any reason you are not satisfied with our product please call us toll free at 888-519-5119 or email us at: info(at)americanflatbreadproducts.com. AmericanFlatbreadProducts.com. Printed on recycled board with soy-based inks. Made in the USA.','Crust: 100% Organically Grown Wheat, Good Mountain Water, Organic Wheat Bran, Kosher Slat, Fresh Yeast. Toppings: Mozzarella Cheese (Whole Milk, Vegetable Rennet, Salt), Vermont\'s Blythedale Farm Padano Cheese (Whole Milk from Jersey Cows, Vegetable Rennet, Salt), Parmesan Cheese (Cultured Milk, Vegetable Rennet, Salt), Garlic Oil (Extra Virgin Olive Oil, Canola Oil, Fresh Garlic), Fresh Parsley, Herbs, Kosher Salt.',0.00,0.00,0.00,0.00,0,'[\"handmade\", \"wood-fired\", \"thin\", \"crispy\"]','2025-02-20 02:56:31','2025-02-20 02:56:31','45ae7f56-6826-4742-9b52-4afa801c7a56',NULL,'9e41008a-f5fa-452c-ba7e-0f9a729cb5d6',NULL,'Milk, Wheat'),('40c02560-5978-4689-8506-8c3ff89d8651','Fresh Dough Sausage & Pepperoni','fresh-dough-sausage-pepperoni','A Tasty Combination of Italian Sausage and Pepperoni',NULL,0.00,0.00,0.00,0.00,0,'[\"sausage\", \"pepperoni\"]','2025-02-20 02:50:58','2025-02-20 02:50:58','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe8e-f347-423d-a2da-1ba443591ddf',NULL,NULL),('4b57f438-d88c-463d-bd01-b954982db532','Original \"Homestyle\" Pizza Supreme','original-homestyle-pizza-supreme','A fan favorite topped with Sausage, Pepperoni, Green Peppers, Onions, and Red Peppers topped with Mozzarella Cheese',NULL,0.00,0.00,0.00,0.00,0,'[\"supreme\"]','2025-02-20 02:50:47','2025-02-20 02:50:47','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe7d-63ea-4a90-88e7-87420cfd5828',NULL,NULL),('55e58b4e-9738-413c-8d0a-c320d3b48f85','Original \"Homestyle\" Pizza Cheese & Sausage','original-homestyle-pizza-cheese-sausage','Made with Sausage and Mozzarella Cheese',NULL,0.00,0.00,0.00,0.00,0,'[\"cheese\", \"sausage\"]','2025-02-20 02:50:41','2025-02-20 02:50:41','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe74-425a-4ba0-872d-3aa65b3bacea',NULL,NULL),('5d44e7b1-7a07-4bcb-921b-0548fd32a0fc','Big Daddy Pub Style Garlic Dipper','big-daddy-pub-style-garlic-dipper','A Garlic and Cheese loaded crust with a Marinara Packet for dipping. Proudly made with Wisconsin Cheese!',NULL,0.00,0.00,0.00,0.00,0,'[\"garlic\", \"cheesy\"]','2025-02-20 02:50:56','2025-02-20 02:50:56','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe8a-b85a-4af1-9c11-c64191728ebb',NULL,NULL),('5fa4f5a7-413f-4d57-8b74-d05ad1681bc3','Big Daddy Pub Style 2x Pepperoni','big-daddy-pub-style-2x-pepperoni','Pizza covered with double the Pepperoni and Mozzarella Cheese',NULL,0.00,0.00,0.00,0.00,0,'[\"pepperoni\", \"cheesy\"]','2025-02-20 02:50:48','2025-02-20 02:50:48','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe7f-5087-4f0f-96d2-793d75f2a30f',NULL,NULL),('625fdec2-0338-4187-8c58-6156da934e30','Big Daddy Pub Style 2x Sausage & Mushroom','big-daddy-pub-style-2x-sausage-mushroom','A savory favorite with double Sausage, double Mushroom, and Mozzarella Cheese',NULL,0.00,0.00,0.00,0.00,0,'[\"sausage\", \"mushroom\"]','2025-02-20 02:50:50','2025-02-20 02:50:50','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe82-31c5-428b-9b3a-9e37e55fb017',NULL,NULL),('62e38e45-a6c6-4236-bc9f-58141ac7465a','Big Daddy Pub Style Chicken Alfredo','big-daddy-pub-style-chicken-alfredo','Creamy Alfredo Sauce and Chicken Breast smothered in Mozzarella Cheese',NULL,0.00,0.00,0.00,0.00,0,'[\"chicken\", \"alfredo\"]','2025-02-20 02:50:51','2025-02-20 02:50:51','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe84-7de7-4343-965a-2ea75a4c3213',NULL,NULL),('651e694d-aa1b-4117-8713-7da268abcaa2','Original \"Homestyle\" Pizza Sausage Mushroom & Onion','original-homestyle-pizza-sausage-mushroom-onion','Italian Sausage, Onions, Mushrooms, and Mozzarella Cheese',NULL,0.00,0.00,0.00,0.00,0,'[\"sausage\", \"mushroom\", \"onion\"]','2025-02-20 02:50:46','2025-02-20 02:50:46','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe7c-677f-4b4e-b572-e28d7577e863',NULL,NULL),('6f248807-3d7b-43d9-b070-3736a9d7854d','Original \"Homestyle\" Pizza Sausage & Mushroom','original-homestyle-pizza-sausage-mushroom','Italian Sausage, Onions, Mushrooms, and Mozzarella Cheese',NULL,0.00,0.00,0.00,0.00,0,'[\"sausage\", \"mushroom\"]','2025-02-20 02:50:46','2025-02-20 02:50:46','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe7b-8655-420d-ac87-ac91a4045184',NULL,NULL),('89c63831-e2cc-4ebf-9a11-afdd08140155','Vegan Harvest','vegan-harvest','American Flatbread Vegan Harvest Thin & Crispy Pizza is a handcrafted, wood-fired pizza featuring homemade tomato sauce, dairy-free mozzarella-style shreds, and a blend of fresh herbs. This pizza offers a rich and satisfying taste with an emphasis on quality ingredients that are non-GMO Project verified. It is produced without artificial preservatives, ensuring a pure and wholesome flavor profile. Each pizza is carefully assembled to deliver an optimal combination of flavors and textures. Made in the USA, this product is presented on recycled board packaging printed with soy-based inks.','Crust: 100% Organically Grown Wheat, Good Mountain Water, Organic Wheat Bran, Sea Salt, Fresh Yeast, Toppings: Tomato Sauce (organic Tomatoes, Fresh Organic Onions, Fresh Organic Carrots, Fresh Organic Celery, Organic Garlic, Organic Red Wine, Organic Maple Syrup, Organic Extra Virgin Olive Oil, Kosher Salt, Fresh Organic Herbs, Organic Black Pepper, Organic Red Pepper Flakes), Vegan Mozzarella Style Shreds (filtered Water, Tapioca Starch, Coconut Oil, Non-gmo, Expeller Pressed: Canola And/or Safflower Oil, Vegan Natural Flavors, Sea Salt, Potato Protein Isolate, Tricalcium Phosphate, Lactic Acid (vegan), Whole Algal Flour, Konjac Gum, Xanthan Gum, Yeast Extract), Fresh Parsley, Herbs, Kosher Salt.',0.00,0.00,0.00,0.00,0,'[\"vegan\", \"vegetarian\", \"handmade\", \"wood-fired\", \"thin\", \"crispy\"]','2025-02-20 02:56:32','2025-02-20 02:56:32','45ae7f56-6826-4742-9b52-4afa801c7a56',NULL,'9e41008b-eda6-4e08-8611-f68ebbbb55f1',NULL,'Wheat'),('89da53c8-6652-41f0-99ef-c0c90ad6316c','Fresh Dough Pepperoni','fresh-dough-pepperoni','An Classic Favorite with Pepperonis and Mozzarella Cheese Spread from Edge to Edge',NULL,0.00,0.00,0.00,0.00,0,'[\"pepperoni\", \"classic\"]','2025-02-20 02:50:57','2025-02-20 02:50:57','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe8d-7838-4099-b9e2-643a95c74c5e',NULL,NULL),('8d62b2c1-60f2-4f88-8def-8832751bc329','Fresh Italian Pizza Sausage & Peppers','fresh-italian-pizza-sausage-peppers','Pork Sausage, Pepperoni, and Mozzarella Cheese',NULL,0.00,0.00,0.00,0.00,0,'[\"sausage\", \"peppers\"]','2025-02-20 02:50:37','2025-02-20 02:50:37','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe6e-750b-4c85-bb0b-a95cc420ccc5',NULL,NULL),('9478ebf1-75a0-46a4-a6b1-72f749ca004e','Big Daddy Pub Style Mega Meaty','big-daddy-pub-style-mega-meaty','Made with Spicy Italian Sausage, 2 Varieties of Seasoned Italian Sausage, Sliced and Diced Pepperoni',NULL,0.00,0.00,0.00,0.00,0,'[\"meaty\", \"spicy\"]','2025-02-20 02:50:52','2025-02-20 02:50:52','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe85-9908-4d27-a07c-d5e0993881b1',NULL,NULL),('9c6eba08-562b-4af6-8cc4-4d8895740c47','Fresh Italian Pizza Pepperoni','fresh-italian-pizza-pepperoni','A tasty original loaded with Pepperoni and Mozzarella Cheese',NULL,0.00,0.00,0.00,0.00,0,'[\"pepperoni\", \"classic\"]','2025-02-20 02:50:36','2025-02-20 02:50:36','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe6d-7a4c-441c-9929-7b69128bca78',NULL,NULL),('a0385b96-364d-4f99-8293-f9915ededd83','Big Daddy Pub Style X-Tra Special','big-daddy-pub-style-x-tra-special','This fully loaded pizza includes Italian Sausage, Pepperoni, Mushrooms, Green Peppers, Onions, and Black Olives',NULL,0.00,0.00,0.00,0.00,0,'[\"deluxe\", \"special\"]','2025-02-20 02:50:57','2025-02-20 02:50:57','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe8c-94c4-4022-9ebf-b7b15dcb385e',NULL,NULL),('a33a0809-b220-4b29-bd3b-2f5f51555586','Revolution','revolution','Handmade, wood-fired, thin & crispy pizza with mushrooms, caramelized onions, & homemade tomato sauce. Handcrafted to perfection! No artificial preservatives. You don\'t just eat an American Flatbread pizza - you experience it. That is why we\'re serious about what goes in and on our pizza. To start, there\'s sourcing. We get our cheese straight from farms we trust and love. Then there\'s quality. Our ingredients have to be fresh, handled properly - only the best. Quantity is important, too. So is balance: getting all the flavors in our recipes to play well together, creating that special combination of textures that you love when you bite into a pizza. We inspired by ingredients and the way they come together in a perfect bite for you. Inspired ingredients in every bite. Unconditionally Guaranteed: If for any reason you are not satisfied with our product please call us toll free at 888-519-5119 or email us at: info(at)AmericanFlatbreadProducts.com. Printed on recycled board with soy-based inks. Made in the USA.','Crust: 100% Organically Grown Wheat, Good Mountain Water, Organic Wheat Bran, Kosher Salt, Fresh Yeast. Toppings: Mozzarella Cheese (Whole Milk, Vegetable Rennet, Salt), Fresh Mushrooms, Tomato Sauce (Organic Tomatoes, Fresh Organic Onions, Fresh Organic Carrots, Fresh Organic Celery, Organic Garlic, Organic Red Wine, Organic Maple Syrup, Organic Extra Virgin Olive Oil, Kosher Salt, Fresh Organic Herbs, Organic Black Pepper, Organic Red Pepper Flakes), Asiago Cheese (Whole Milk, Vegetable Rennet, Salt), Parmesan Cheese (Cultured Milk, Vegetable Rennet, Salt), Fresh Onions, Garlic Oil (Extra Virgin Olive Oil, Canola Oil, Fresh Garlic), Fresh Parsley, Herbs, Kosher Salt.',0.00,0.00,0.00,0.00,0,'[\"handmade\", \"wood-fired\", \"thin\", \"crispy\"]','2025-02-20 02:56:33','2025-02-20 02:56:33','45ae7f56-6826-4742-9b52-4afa801c7a56',NULL,'9e41008d-b91f-495f-a8a7-7540ee6ad336',NULL,'Milk, Wheat'),('a69cb188-7d87-4878-a4aa-e45fd71cf5ec','Original \"Homestyle\" Pizza Sausage & Pepperoni','original-homestyle-pizza-sausage-pepperoni','Pork Sausage, Pepperoni, Topped with Mozzarella Cheese',NULL,0.00,0.00,0.00,0.00,0,'[\"sausage\", \"pepperoni\"]','2025-02-20 02:50:42','2025-02-20 02:50:42','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe76-b29f-42bb-8982-58dfcf8b2182',NULL,NULL),('a6d7fe6f-9410-480c-b41d-267f9f5394a8','Fresh Dough Breakfast Scramble','fresh-dough-breakfast-scramble','Start Your Day Off Right with this Breakfast Pizza that\'s Loaded with Scrambled Eggs, Sausage, Bacon, Sprinkled with Mozzarella and Cheddar Cheese',NULL,0.00,0.00,0.00,0.00,0,'[\"breakfast\", \"eggs\"]','2025-02-20 02:51:00','2025-02-20 02:51:00','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe92-37b9-4691-b412-fc5d80b5ebda',NULL,NULL),('ab59f67a-ceb8-4318-b5dd-8d23a5cb57a8','Original \"Homestyle\" Pizza Mighty Meaty','original-homestyle-pizza-mighty-meaty','Fully Loaded with Sausage, Ham, Pepperoni, Smokey Bacon Bits, and Mozzarella Cheese',NULL,0.00,0.00,0.00,0.00,0,'[\"meaty\"]','2025-02-20 02:50:45','2025-02-20 02:50:45','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe7a-363f-4f07-9f8c-ecc2eeb5a025',NULL,NULL),('ad2d177a-9db7-4c98-959d-0f1ed26a71fd','Fresh Dough Sausage & Mushroom','fresh-dough-sausage-mushroom','This Savory Favorite is Covered in Italian Sausage and Mushrooms on a Mozzarella Cheese Base',NULL,0.00,0.00,0.00,0.00,0,'[\"sausage\", \"mushroom\"]','2025-02-20 02:51:00','2025-02-20 02:51:00','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe91-3a4f-433f-a195-40977861bb61',NULL,NULL),('b55f6014-a9cf-40e6-803c-d354869e3e56','Fresh Italian Pizza Cheese','fresh-italian-pizza-cheese','A Cheese-Lover\'s pizza covered in Mozzarella Cheese',NULL,0.00,0.00,0.00,0.00,0,'[\"classic\", \"cheesy\"]','2025-02-20 02:50:35','2025-02-20 02:50:35','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe6b-37ae-4b31-9121-6d8c8a56a5e6',NULL,NULL),('b9e84e94-6276-4516-a8aa-6a6419cc2499','Original \"Homestyle\" Pizza Pepperoni','original-homestyle-pizza-pepperoni','A tasty classic loaded with Pepperoni and Mozzarella Cheese',NULL,0.00,0.00,0.00,0.00,0,'[\"pepperoni\"]','2025-02-20 02:50:42','2025-02-20 02:50:42','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe75-73ee-43bd-8540-49366088b622',NULL,NULL),('ba1fc3b5-5c93-47c2-9993-52cbef5bc537','Fresh Dough Gourmet Deluxe','fresh-dough-gourmet-deluxe','There\'s a little bit of everything on this pizza! It includes Pepperoni, Sausage, Black Olives, Mushrooms, Red Peppers, Onions, and Green Peppers',NULL,0.00,0.00,0.00,0.00,0,'[\"deluxe\"]','2025-02-20 02:50:59','2025-02-20 02:50:59','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe90-0b49-4ba2-8256-0d0863eff167',NULL,NULL),('e3131e81-25be-49a4-8637-b7722697b0d2','Fresh Dough Western Omelette','fresh-dough-western-omelette','Add a Little Spice to your morning with this Breakfast Pizza loaded with Scrambled Eggs, Smoked Ham, Green Peppers, Onions, Sprinkled with Mozzarella and Cheddar Cheese',NULL,0.00,0.00,0.00,0.00,0,'[\"breakfast\", \"eggs\"]','2025-02-20 02:51:01','2025-02-20 02:51:01','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe93-b00b-440a-85cf-016cc5267d88',NULL,NULL),('ebba3421-a4ca-4cea-b3e5-1049d528c3cf','Original \"Homestyle\" Pizza Cheese','original-homestyle-pizza-cheese','A Cheese Lover\'s classic topped with Mozzarella Cheese',NULL,0.00,0.00,0.00,0.00,0,'[\"cheese\"]','2025-02-20 02:50:40','2025-02-20 02:50:40','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe72-c6b5-4ad3-a066-51eeaa789d80',NULL,NULL),('f8a45abd-e67b-4d08-aec4-38e30d050670','Fresh Italian Pizza Cheese & Sausage','fresh-italian-pizza-cheese-sausage','Made with Sausage and Mozzarella Cheese',NULL,0.00,0.00,0.00,0.00,0,'[\"sausage\", \"cheesy\"]','2025-02-20 02:50:36','2025-02-20 02:50:36','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe6c-36e4-4859-9940-6ec863f92ab2',NULL,NULL),('fabf1890-ef8c-46ad-accc-ce177a81feed','Fresh Italian Pizza Supreme','fresh-italian-pizza-supreme','A fan favorite topped with Sausage, Pepperoni, Green Peppers, Onions, and Red Peppers topped with Mozzarella Cheese',NULL,0.00,0.00,0.00,0.00,0,'[\"supreme\"]','2025-02-20 02:50:39','2025-02-20 02:50:39','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe71-9f4b-4684-8877-f07b23a8c97f',NULL,NULL),('fd8f9546-9961-4eea-9cc0-380ba6e01479','Big Daddy Pub Style 2x Sausage & Pepperoni','big-daddy-pub-style-2x-sausage-pepperoni','Loaded with double Sausage, double Pepperoni, and Mozzarella Cheese',NULL,0.00,0.00,0.00,0.00,0,'[\"sausage\", \"pepperoni\"]','2025-02-20 02:50:49','2025-02-20 02:50:49','680130b0-8225-4755-800c-332bc61cabee',NULL,'9e40fe80-9a0a-4871-bbf1-1bb89873a53b',NULL,NULL);
/*!40000 ALTER TABLE `pizzas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `review_images`
--

DROP TABLE IF EXISTS `review_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `review_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `review_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL DEFAULT '0',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'other',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `review_images_review_id_foreign` (`review_id`),
  KEY `review_images_image_id_foreign` (`image_id`),
  CONSTRAINT `review_images_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`) ON DELETE CASCADE,
  CONSTRAINT `review_images_review_id_foreign` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review_images`
--

LOCK TABLES `review_images` WRITE;
/*!40000 ALTER TABLE `review_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `review_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci,
  `purchase_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pizza_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `appearance_rating` decimal(2,1) DEFAULT NULL,
  `texture_rating` decimal(2,1) DEFAULT NULL,
  `flavor_rating` decimal(2,1) DEFAULT NULL,
  `average_rating_date` date DEFAULT NULL COMMENT 'Date when this review was used to calculate the average rating',
  PRIMARY KEY (`id`),
  KEY `reviews_pizza_id_foreign` (`pizza_id`),
  KEY `reviews_user_id_foreign` (`user_id`),
  CONSTRAINT `reviews_pizza_id_foreign` FOREIGN KEY (`pizza_id`) REFERENCES `pizzas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('0JAPpYSBZE9AWL4sH3QZIJaktrW1KUhIYXwrom2x',NULL,'170.106.181.163','Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoibWdjTTU3Uk1uaU1HY0hkMW1SbWVEaDR3UTBGcVNhTjBkT0wyZ0NLdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHBzOi8vd3d3LnBpenpha3Jha2VuLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1740219672),('0zrG0aBwma8SCt06tJqEOH7fqE7cKiptrh8YDGB3',NULL,'54.36.148.110','Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUG5ybVpxUkpqdEs0UzFsZHNucWVrcWRNUHRlcWFsZ2tKN1ZsTVJqVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vd3d3LnBpenpha3Jha2VuLmNvbS9icmFuZHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1740215832),('122GR9e976ii7Q4BOQ1XEJMDD1cpH6RIUa3fevoU',NULL,'49.51.180.2','Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiM1VDV0U5eVF6YVZBYnQ5SXB3eDJxOUhLTGdFR2N3bVpUVW52TGZWUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHBzOi8vd3d3LnBpenpha3Jha2VuLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1740226080),('19Oy1PaspvJ24CjjMxaBpF2sJYb4sr0ehtns3Rok',NULL,'87.250.224.54','Mozilla/5.0 (compatible; YandexBot/3.0; +http://yandex.com/bots)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiV25hQ0F6RUJMckg1NTRaZW85VGd0SHZ6eUhvaVpSTUQ3cHUwTUhZayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740196270),('2gzjVG3jaA0QBHihoal72x4h3oIsqfdFWVL3ZOJs',NULL,'64.227.173.56','Mozilla/5.0 (compatible)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUzVzRWJuZU1wcnNBdXk3WWxUWmNDMXFscFN0d2s2UDBJc0lBeHB1TSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHBzOi8vd3d3LnBpenpha3Jha2VuLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1740229658),('30Gfui6Zz7dPcWq1uIww49DlQr4dYSRvEYo0Hg4l',NULL,'170.247.220.99','Apache-HttpClient/5.1.4 (Java/11.0.18)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWHRXR2FCeFdLTGprdWdhMTBCUWdIZVlMM01pbXZjY3dDRGZ3dThhbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740212370),('3BMXFGOKmcU7CktiVj3rFuJcgJikHnEXfCBlQV9G',NULL,'43.130.40.120','Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVFNDaWllQXJBU1NJOE9IWVd1bTNReWFUcXM1a0o3UW9NUmNzN0liciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHBzOi8vd3d3LnBpenpha3Jha2VuLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1740205064),('3lm5ZnX3ih9Pz8tOsMCk8yFfb5bmmDI8GsG6foL6',NULL,'104.248.173.95','Mozilla/5.0 (compatible)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWTF1SWljbVk5bGtkZXhNM1c3Mm94VFlEYVowdW1uRXV1M2JKU1FSaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHBzOi8vd3d3LnBpenpha3Jha2VuLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1740234442),('4omRfNhXq5ZO6ZHb2r3lheWsFxyRjfhiazmZJb1D',NULL,'170.106.72.178','Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoieEg0OWVKZkRJbVF5bUhVN2tYZ0tZdlptN1pXU3FlZDR1djVSUzRPMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740224863),('4y97Asj8Ks6hEnqBbrHFUduxAVBjJSMoDYSiIYNt',NULL,'185.247.137.28','Mozilla/5.0 (compatible; InternetMeasurement/1.0; +https://internet-measurement.com/)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiR01ucmYwYURINHZKYTJRWDV5UEFSQXliam1NSHFsVG5CUTZvQWs0QSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740196253),('5Uu7iNnsUiWz166jFTLrSP9is9FSN8BKvAdSHIWg',NULL,'15.204.182.106','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiYlRlUWpOSnM4WG5CREswczdCRU1WQ1UwVFpzWnJkODRucHNrQkxVRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHBzOi8vd3d3LnBpenpha3Jha2VuLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1740226468),('6rB54i1bWnoOssEQblqkIo37GGbSZhaYSTSAVaUv',NULL,'66.249.66.14','Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.6943.53 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMlZQOTI1ZzlLS1M5Wk1pM0JwREhDNzhQTHI2d2plVlM4VlRLVmRxNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tL2JyYW5kcy9qZW5vcy1waXp6YSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1740234205),('96SeLCcGau4Qp0MF1UKTjCnBiB1l94v25J60ZyjU',NULL,'51.222.253.18','Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiY0N6MHU3N0lQTDlIWHBiRDZOTnhqc1dIV3ZmdXJLWlVwaFVRenFzcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHBzOi8vd3d3LnBpenpha3Jha2VuLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1740229014),('a9EJqKzJxTrHYNQ8gw937HDppxVMH8WWQDSPIjLv',NULL,'195.208.90.20','Mozilla/5.0 (iPhone; CPU iPhone OS 17_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) AvastSecureBrowser/5.3.1 Mobile/15E148 Version/17.0 Safari/605.1.15','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVTJId2Y3WndrUE1qWG1yVllqcGsxYlFJQ1JUYTc2MEd1Vzh4aWdtTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740207991),('Ad6kj7qWAlKiKMSMknWgPhEiaXuysiPeynfBq5fG',NULL,'152.42.209.174','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVFRiQUV1d0VkQjZuSFA5ZnJ4RGU0N2s2dHkxSWhKRE1BTlN5UjVSaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740228716),('AgxdX5PdB0ZAqLLLTjQGHAaEO4mhpbXIFRFplmxW',NULL,'43.130.9.111','Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiN2JpZGVNa01WZWtHa1pSb1hIVThDTFkxMVlYeVB1VXZoSmVhTlpYQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTY6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tLz91dG1fY2FtcGFpZ249bWFya2NoYXB0ZXI0LmNvbSZ1dG1fbWVkaXVtPWJhbm5lciZ1dG1fc291cmNlPWRvbWFpbl9vZmZlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1740239426),('AHh32tmZCa4N38dRFTXpv8Y1zHRoaXbK9bxx5qCs',NULL,'196.251.67.56','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiS2Fia1d5MUNuNWxMNFJYeTJVUGZKTERSNFFkNjZRa2lPMTZocUxSMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740237100),('AifpFVmLBPtVEto1fi7y6xSXgFga2vFOQ6llBfgo',NULL,'162.55.174.161','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoidTZ0T3BnT25JWnE4VEVDTlZNR2Z6djkwVk1kYm94TGM5N1ZETDJFcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740231958),('AX81t4YGOxh1uKc3xa0oDpCS7rEWcVxplfNjg5WH',NULL,'66.249.79.103','Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.6943.53 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNzQ4dFBZTHFMQUFpODJtdmVaUGowbTNzSzAzN09QRENKUDR2ZzdTRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vd3d3LnBpenpha3Jha2VuLmNvbS90b3AtcmF0ZWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1740202929),('baigExW6dtCZFjnaXpQwV6KYW2hUGGzURDHyNfW5',NULL,'191.96.227.174','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/122.0.6261.94 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSFdma25lNXBKd3NoTG5TODNiZFNXQ3ZYalJ0bFh1a3QxMnVkNHh5OSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740234915),('Blp02PfAtfYYdUcjOTOZ3zx7eHsYQozq2seIf1ig',NULL,'134.209.146.211','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoieFRUT2ZQTHc3V2FCMnk1WUo5WkxDdWNONTFLMWZuRFpPZmQ3dlMzUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740237684),('BRZEFIBcO9w6P4Zvy8PI7ZjwpcVAS0pUgEWaU1gh',NULL,'66.249.79.5','Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.6943.53 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)','YTozOntzOjY6Il90b2tlbiI7czo0MDoicTE3Z2FYb1JUVExVN0V2WWNPMFVsU1Q3ZlpDNXN1UXE3TVhYN0tTRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tL2JyYW5kcy9zYmFycm8iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1740207669),('ccgkT3VPYeKR8RRcYbuaogSmUWsX2Bdp9MMtIY9R',NULL,'43.157.82.252','Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZUluT3p0aEc3NmZzdUxCR1JoR0l1NzN6Y0d3V0ROb0ZrVGxTbDZPMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tLz91dG1fY2FtcGFpZ249Z2VvYXBpLm9ubGluZSZ1dG1fbWVkaXVtPWJhbm5lciZ1dG1fc291cmNlPWRvbWFpbl9vZmZlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1740238160),('cor1w0u3AGCqB0TcSaybNy93LBABShK6ed4SqmKX',NULL,'152.42.209.174','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaEphNHR0UmlpajJGdHFic3A3N01KWXh3S3VXTXNiM2RZZHFBYWFkdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740237904),('D5vU5tryi4syl4ucWtONdwq51b3JShGx7f9GbvAO',NULL,'98.61.145.254','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiV09Pc2hoNjlPTFhXa015M1FSSms4YlRralpCb202a1NMTHMyOENRWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTAxOiJodHRwczovL3Bpenpha3Jha2VuLmNvbS8/dXRtX2NhbXBhaWduPXRoZWdyYXBoaXRla25pZ2h0LmNvbSZ1dG1fbWVkaXVtPWJhbm5lciZ1dG1fc291cmNlPWRvbWFpbl9vZmZlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1740234863),('DNL6jQ7PcV8Vn5ueikojVuiiklB5AL7RPJxlJY0f',NULL,'149.56.150.57','Mozilla/5.0 (compatible; Dataprovider.com)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUGI0dkF6akw0aUFqejRvWWhuRTZUVldGU2JjN0NlZGFNZEZ6U0N3SSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHBzOi8vd3d3LnBpenpha3Jha2VuLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1740226180),('DWSTF0eFxjhKE8xBNKWnFQ79T8QBecn3p5fvMlSf',NULL,'193.26.115.187','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36 Edg/117.0.2045.60','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNk1VeVdYajBxMktuZnh0YUhsck9MZXdJSFNia1JBY2xxRVFuMGgwdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740212945),('E97fOqad6MZ6feBjzLuSzK2kPnUX1sAByvGUGXJu',NULL,'66.249.79.5','Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.6943.53 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiYnZmTmZpV0FldXZrV3M4dDF1RFdtTFJYVWU0RzdUSktKZHdPQzBOcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tL2JyYW5kcy9ob21lLXJ1bi1pbm4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1740215670),('eaaBQKJ4WyFZLeYWuzCxem8QWrJgWLLPPB4uSJek',NULL,'209.127.97.229','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUko2dG1lNk9IOWtGSlJmWE83SVZMbmFCdHFNdHZXcDhEeXo5OVNUTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740213462),('EBNb56jPBVlwVgl3gyD6LQNpAlhpdrzK8mCIpL7A',NULL,'152.42.209.174','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoid1FlWTZ1Wmd6OE44VDJLbEM5dWJ0TTVmWm1OaDlpQXVlU01vZDhrZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740239519),('EbPkfkwRFsShqzFp3HtHdQtLRyMf1axCPPOidZw7',NULL,'17.246.15.126','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.4 Safari/605.1.15 (Applebot/0.1; +http://www.apple.com/go/applebot)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiYXZvanJ0MHdBZnBrM1Z0QWZzbkFyUUg5RFpObXFUOE1VMXhwbU5nVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740220892),('eMxECL4bUe7Jv48owEk5nKRMNkXeBpRjxNfjVyi6',NULL,'185.220.101.28','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/89.0.4389.90 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWUM4eUdRT1RTQzRXeW9MeDBVSXNvWUpsemlUd0xqM1ZoSEt2dVhBRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740221634),('EsGFmPwtlSCvgSFFl5OwMmjyUKitXTZoPP0gBILc',NULL,'134.209.146.211','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTlNOZ0lZdnJuY3lOYzlVOVFmbGNDRG9RRWJEbW1pbzhNRko1WEM4TiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740239799),('f2E8lRLRnIINy4SRCsHwjNxdRR0bJHJyy3tjL1eV',NULL,'89.248.168.222','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML,like Gecko) Chrome/95.0.4638.69 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiYTJhYjZvZTBvVmkza3pYWFhoMWNld0M2ZG9LaXY2RDFXM1psTlBHUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740200390),('fa4PrW8dTu4qwrV0an4pm1HM7dlMKiCvBqAtYvdK',NULL,'191.102.170.225','Mozilla/5.0 (Macintosh; Intel Mac OS X 13_0_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNmIwV2VrQ3VvWlBIZDVtSFo3NmdFNUdwNTJ3R1g4S2tNRmdHSFYzRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740212916),('fjHs2mnwqY2QqJtPRWhjbJKhKp8c0qD3NUKX6E1K',NULL,'23.27.145.78','Mozilla/5.0 (X11; Linux i686; rv:109.0) Gecko/20100101 Firefox/120.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUFhPZk1MdGt6Z0dTUmNNV0hrOE5GMXZnODBMZDgwc2ljRWRTa3pZWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740204919),('GtaRbdveU0dYeuOphjpjB4X4evwwTx0aIEnpUzMD',NULL,'17.241.219.235','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.4 Safari/605.1.15 (Applebot/0.1; +http://www.apple.com/go/applebot)','YTozOntzOjY6Il90b2tlbiI7czo0MDoicGJpa0ZhMGo0aTRNZW5qeVpFZDBJbEZJZ3hKQWk2ZHJFd2pNMkx4UCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHBzOi8vd3d3LnBpenpha3Jha2VuLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1740222137),('GwOtwkj8fjXLFxSegQ8s4iZ8tQF7oMJ9DyNDpV2N',NULL,'69.167.12.33','Go-http-client/1.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoieTlOb1g0NVJ5SHMwbzVLakJJSVRBd09HRGp3ZjNNQUpzZHFxTXh2aSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740212052),('h3XFIZTP6jz41Dcruv7mKqUzv6pqrRMFhG8jXWsY',NULL,'23.27.145.161','Mozilla/5.0 (X11; Linux i686; rv:109.0) Gecko/20100101 Firefox/120.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOE9aQndGa0paNFpVNkZuaUQzS21TdnM4WXZweVZjaHlhMGNhTjdBWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740235863),('h70mlQduwz7aggzFpPcr89TwCA0OsRAcNsyRIFI5',NULL,'149.56.150.218','Mozilla/5.0 (compatible; Dataprovider.com)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZFBhS25VZTZoSzNhQ2dHSXRwYXB4RXpQQVU0cTdaYmNUR0tZOUFaVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHBzOi8vd3d3LnBpenpha3Jha2VuLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1740226201),('HduXlv2qN0PYROuiMf1kXhy0Z07teWdMEwg9YPxG',NULL,'89.248.168.222','curl/7.68.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiazZsbHNjekpVaTl1S0EyUkpmSDBGU1hIcUY5dExENHJ5U3RSdmxZUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740200389),('hieqXqpDyt1WgxNv1gxxZuHXyHD5ZAQgdtIyl5GI',NULL,'43.130.40.120','Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoibVRvZmduaHNpY0p6eVFMQU91NTBkbXhNcjRrUXRESk4zZ2F5TmNTdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHBzOi8vd3d3LnBpenpha3Jha2VuLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1740233910),('HVrr5SYbWxodjdSbV7b3dqv4ZaIq7a7ZJCZoSbwN',NULL,'199.16.157.181','Twitterbot/1.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiR0RMR2dhanBTc0tKTjE1eWlhcmZiRzd1VDJGNmlyRXV0NGRBdjdiVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740244387),('iI6x6yyg43UkHeWQUC6srkBuQN8Q3VjG6cMbxz9h',NULL,'152.42.209.174','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiajM4QlVhWHVVaE5wZ2M4VHczT2REQmQ1N3d1Szh2b1JybzQyN3VHMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740227631),('ikH43JdPjSMSTD6mxrVnanSUvDQjhYyxLizSxioe',NULL,'66.249.66.14','Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.6943.126 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiU1RCSFVUcWt4dmkwR1NVMmdWTkJRRWxYc3lzQjBsNUZIdkw0WEk5cyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tL2JyYW5kcy9jZWxlc3RlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740243981),('iPHKfr5kY1n0tvvZLZJiPLlXwiNfDQFBEvhwsOYe',NULL,'104.253.203.244','Mozilla/5.0 (iPhone; CPU iPhone OS 17_4_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/123.0.6312.52 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQkxUZXdBMG1MRkoyVkFITVNzb1NXc1JWR0o0ZHhyQTFobmMwWW12TiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740218565),('J122fitdG00DF5B2O8Or5vToHfIcIbqD8csBJz0e',NULL,'152.42.209.174','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZW9sWE55aEtoYTNLNHdHdFNPQmhhU29oOTRLR2hBcXJnTmM5bGsySSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740228414),('jxzpk3dCcM3xI0SG42gSHJBRTY1sd2WwfR4vhqX3',NULL,'66.249.79.105','Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.6943.53 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVkNZSFZuZGpBR3BQaEdRM0FManhqaDlTWU4yN2I4SXBlaXBkb3UwUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHBzOi8vd3d3LnBpenpha3Jha2VuLmNvbS9icmFuZHMvYmVsbGF0b3JpYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1740211452),('K1bjgYYlnGHqEC1CQMyv3K34ILtESpIJZMwPL2Pg',NULL,'49.51.204.74','Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaDFIeXBUUmdOam0wNE9ONFU1dlNKQkFsTUxjWEJ2Sm5wS29YSDJSSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740239953),('k4SBTQuiB5KnDr1bAHpHmtJQ0Krzp2epAr14nWTQ',NULL,'23.27.145.255','Mozilla/5.0 (X11; Linux i686; rv:109.0) Gecko/20100101 Firefox/120.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoienAzMUhuNUFwWFQ5REhqYUJUSUkwVkRrSFJTczB2TkExOXJQS2NCaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740197531),('l2blepFSlk5I5MVeRqgy0768w2RB12lqBlsVio5j',NULL,'43.130.3.122','Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOERhanVuYWxaMktveUJwOGFFeUZPZVNpbjZGS3J2cnY4TmRsMVpBMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHBzOi8vd3d3LnBpenpha3Jha2VuLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1740236790),('LarMS4KsF45S1CJngN4IcwLaVqL0Pcy8M4c3ePYT',NULL,'34.90.207.148','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.131 Safari/537.36 Edg/92.0.902.73','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMm9wbTR3MldCUVdYR3Q4SURLUFMzMDJxOENmcVczdU54bm9oZmlqMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740214686),('LpNFu4bjXXkJPVgDO0L6zb5WL4Ijck8NgfP5MscT',NULL,'44.228.242.45','Mozilla/5.0 (iPhone; CPU iPhone OS 10_3 like Mac OS X) AppleWebKit/602.1.50 (KHTML','YTozOntzOjY6Il90b2tlbiI7czo0MDoiczMzTGpSak9hcXhnTkJsa0dhd2FrNjBVOFVRZm9Cc3JHd2F6U3hJciI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHBzOi8vd3d3LnBpenpha3Jha2VuLmNvbSI7fX0=',1740220699),('lPO9xehROBh9h5xfeuNMKVwyVJj2NciNyqX3PnX2',NULL,'180.149.9.132','Mozilla/5.0 (iPhone; CPU iPhone OS 17_4_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/123.0.6312.52 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTGpRYXNrOElGQjFVUFg4dHNTZkpucjdHbnk1WWhxeW8yMHIyMVJsRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740218507),('LQlzk58s1QvOxvLqZxj34SwPGPY1hDxkpWUppBb4',NULL,'8.212.128.156','Go-http-client/1.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUFlIOTZWbE5hajZtMG93SXUzUG13STJwcXc5dUU5OUVPbVJtRDBFTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740218056),('LRseI8dbqzQFXjlOFrSR2XfzRFNLqUpukOfmU8Tn',NULL,'152.42.209.174','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ25PZWc4d1ZPUlE2clNCRUplT3hiZUJTQXpLTGp4a3hnSDVXQUtYUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740239690),('LVryHFbMsvsBG4OWI9e4kXJa8cxreF9xt6Jj27dr',NULL,'5.255.231.91','Mozilla/5.0 (compatible; YandexBot/3.0; +http://yandex.com/bots) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTnlEaEFjcWk3OXZzSk5uaHNCeTRpOVdMNk1XYzd1TUx6R28wbUd5TiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740242851),('mbVmSIUGkcF4VqJ4zWwcB5zNRfplC7q8KWiJV2un',NULL,'170.246.53.205','Mozilla/5.0 (Macintosh; Intel Mac OS X 13_0_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiT1RiMFJWMzR4OEtFYWVFWEgwTk9lOWVteGNYTUpWODk1TzN2eDRTYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740212914),('mSWeMSyHiYHKpg0CoxhAJZEYngCesRLnXVrj4men',NULL,'15.204.183.221','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoibFhoTTlHTE9hMHlhRm0xdVFpMWcxWGlleURzbmhEWlpCbkluNEwyQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHBzOi8vd3d3LnBpenpha3Jha2VuLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1740215231),('O6E2SOSrSN3mU1ihBsHSCRofdT35T5KzobXcCRB1',NULL,'15.204.161.7','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoia3ZnYTU1a2ZGeTJJcWl3NExGbGFLSmxMMHBPRnRETExUc0kwdkw2MyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHBzOi8vd3d3LnBpenpha3Jha2VuLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1740231774),('oo50g9oSaZ0NH3tZ03VaC6xIw06qRsp8AknJ9pMv',NULL,'149.56.150.57','Mozilla/5.0 (Linux; Android 10; SM-G981B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.162 Mobile Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNHhJaGNzY2hHNFFoMnR0aWVVVGpMYkJoYnRHS1N3ZnM4cDV2cFFIUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHBzOi8vd3d3LnBpenpha3Jha2VuLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1740226181),('PAhbItqrC2N7A717jZUZDj88at7BqiiHUIzDKt7t',NULL,'64.29.88.247','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiR3dLYzlRZVljckxmZGlhUHVsM1BxQkRHR0RaaEpoS1U0M0twaTNSNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740212372),('PZX4mlMwFh1U7njTTHsHghCF7kBwzeoiTdbVJCJc',NULL,'52.80.60.159','Mozilla/5.0 (Macintosh; Intel Mac OS X 9_0_2) AppleWebKit/554.35 (KHTML, like Gecko) Chrome/100.0.1053 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoidEx4bEo4WHpOYW9HcnV2eGRUQUlZN003eW1CSmdpSEg4QTh1UjJRdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740201727),('qQCRHv1o5a3LwfdzhW7H24uqgxa47WWP0XI88AWb',NULL,'15.204.183.221','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoidWNFeXJwQWtScE1PY2tqY3dVMFZLQ2RrQ2hZajFnbXZmMnBlbjlXeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740215230),('rilwYcpMksyHrP99TqHQKMWvkjPcyP1KuKdFS4vO',NULL,'95.177.180.82','Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_1 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/10.0 Mobile/14E304 Safari/602.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaEpob0tObnFNMU1FZEFLYXQwTmYwQ1pBOHJEaXhpREs1OWhVakhPcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740239033),('rkVybFT4vVeQnmD8mJV5Ozezl4ykeUTHBgMTqHx7',NULL,'203.33.203.148','Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZHE5YVNreEhoY0lkZm5FdjdKNEVWVVhLVUdvSXlkUlVmWEJHeTk0VCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740225828),('SAzhahSvGRa1fPt5H9O4gdMA3LUy8Rux2Ghmrf5H',NULL,'196.251.67.56','Mozilla/5.0 (Windows NT 6.1; WOW64; rv:27.0) Gecko/20100101 Firefox/27.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNVdvYUlNcFI0bDcxNzVSNnc1Z2JmVGJFR083M0FTM21vSnljaFpzVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740211563),('SB6mer260dYmLqu3g6tMTRp9HispjGEFUviP16jt',NULL,'138.201.154.74','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZlZpZnBEWlFrczg1SzFxbXhnbzEybWJ5c0NqdmFlUmpoVHdlMFYzUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740234324),('TGeKQDazBgxVYVR4ljca5qwlu2nSDBjjviS7NgsR',NULL,'15.204.161.7','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZlBFVmR1VTVLVEpXeUJjcVZIMXkzdldKdDI1dElNMEU5YkxoeFNwWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740231774),('toKNGKbzkpqKW6KDbn00ealtLDs1gdHuWSyLlzu3',NULL,'156.248.91.26','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaEJNUXFKNmJNOHRVRHlEc1V5OGxyTmZJdlNhdVM5WFVUYzF0d2dPMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740210933),('TOMAc2uZKva5FtUXtVoylZpoQgPywpi2tEMMwhzq',NULL,'49.51.50.147','Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiakVpY1QyekJNbmVaQmRpTFhQbm50aFZYb0psdEo3VTR3TVc4YXRveiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tLz91dG1fY2FtcGFpZ249bnV0Ym94Lm9ubGluZSZ1dG1fbWVkaXVtPWJhbm5lciZ1dG1fc291cmNlPWRvbWFpbl9vZmZlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1740240300),('ui1PoZvxbrq3GBk68Y07ntrdLTZ0LM5LqiHIg856',NULL,'178.212.188.120','Apache-HttpClient/5.1.4 (Java/11.0.18)','YTozOntzOjY6Il90b2tlbiI7czo0MDoidHdDeUZ0MWlucnJZVWM1Y0lWWXV4Yk9rNU5TNHVVVFZsZlpIRGdxbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740210929),('VCLadORap6IsuN07bDBLj8F7vhVx7VblKWWs2krR',NULL,'43.159.138.217','Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUW5PT2gzRVhzcVpweTRPZURrbkxkNmdpdVhpTDdYZHJFVzNmUVFXNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740195826),('VY497e2YBqLZz3GdYyT4Yj2vNBbMPlR6Ge8SMSiV',NULL,'66.249.79.6','Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.6943.53 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRUF2aHR3OHVwRm1yUjA5aUcxaEdyNXYwV3NFOHVsc3I4MkFEdVAzMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tL2JyYW5kcy9uZXdtYW5zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740231024),('wBaaIlI1Z6NW975KHnoAFxShLko5qpuUU2yCeWh8',NULL,'43.130.47.33','Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSW43SVpLT1FzTVZ6SmZSUzVxU0E5bW1STElyNmd0SjdJbHpkcmRjWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740209914),('wZxJEp2fHjX4at7SOFRYmiKAf7EGhJ9GV4x3xX73',NULL,'38.154.214.225','Apache-HttpClient/5.2.1 (Java/11.0.25)','YTozOntzOjY6Il90b2tlbiI7czo0MDoidlVIdFkzQ0tQeVdLUVNqZ1BWeEh2M0NITldhMHF2cWp1OEVZZlE1YSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740212913),('xqjGFVttzwuO9pwxfRkqpTQHo8cWilDmOdJaAgFM',NULL,'138.94.216.29','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMXpPUUQyNGdxeVNPeWJGeE50UG9ycVRIb2NNRkdyNjNEN2pKb3J4NiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740212562),('YvCBq8AF2GFH96OK2l3I9SBsHFQxhuZVfht7oh1H',NULL,'15.204.182.106','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoibVA5cHp3b1kzeHA4dUh1TDZOYm9VeTRWNEdnSm5UMEdXeFliYkpUOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1740226471),('zwwgKjecSzworxKpulIRWWi18lSMyW1FqSf7CSoy',NULL,'66.249.79.5','Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.6943.53 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVXBCd21LN1ZpVlpXb3JoajhLN0Y1aVl0Z2R4WlQ4ejdDUWs1NEQzMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHBzOi8vcGl6emFrcmFrZW4uY29tL2JyYW5kcy90b255cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1740222964);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `styles`
--

DROP TABLE IF EXISTS `styles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `styles` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `styles_slug_unique` (`slug`),
  KEY `styles_image_id_foreign` (`image_id`),
  CONSTRAINT `styles_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `styles`
--

LOCK TABLES `styles` WRITE;
/*!40000 ALTER TABLE `styles` DISABLE KEYS */;
INSERT INTO `styles` VALUES ('03b6aa17-d6c8-4f4a-8156-a5adfbf1cfab','Thin Crust','thin-crust','Thin-crust pizza may refer to any pizza baked with especially thin or flattened dough, and, in particular, these types of pizza in the United States: St. Louis-style pizza, New Haven-style pizza or New York-style pizza','9e40e51f-11b1-4c21-bec0-d923740c06cd','2025-02-20 01:39:51','2025-02-20 01:39:51'),('0a5cdaf3-0baf-4990-9c1d-61014c9306c8','Greek','greek','Not to be confused with the common \"Greek Pizza\" term, which is basically Greek salad ingredients on top of a regular pizza, a true Greek-style pizza can be found in the New England states at places called \"Pizza House\" or \"House of Pizza\" and in Greek restaurants nationwide. Greek-style pizza features a round, oiled dough that puffs up in the pan. The sauce is normally heavy on the oregano, and the cheese (a mix of mozzarella and cheddar) is laid on thick. Greek pizza isn’t for everyone due to the heavy spices and often-dense dough, but there are some good ones out there if you look around.','9e40e51e-fafa-40b6-917e-9678646fdce3','2025-02-20 01:39:51','2025-02-20 01:39:51'),('18a59871-27a2-4190-963f-22d30721b8f2','St. Louis','st-louis','The St. Louis-style pizza is cracker thin all the way around, cut into squares (referred to as a party cut), with toppings that stretch all the way to the edge, a sweet sauce, and a regional cheese called Provel (a combination of cheddar, Swiss, provolone and liquid smoke). It’s easy eating—almost like a big plate of cheese and crackers.','9e40e51e-d255-4b90-8912-8d57fbb3eac7','2025-02-20 01:39:50','2025-02-20 01:39:50'),('2cd41103-9187-4204-a1b9-0b875245c87c','Old Forge','old-forge','According to residents, Old Forge, Pennsylvania, is \"The Pizza Capital of the World,\" baking Sicilian-style pizzas in trays. Vernacular requires full pies be called \"trays,\" and slices \"cuts.\" The sauce is heavy on onions, and the cheese of choice ranges from mozzarella and cheddar to mozzarella and Parmesan.','9e40e51e-f6a1-47d1-9b02-fb410d28b397','2025-02-20 01:39:51','2025-02-20 01:39:51'),('3251d619-09be-409f-86c1-3311ab38a762','Quad Cities','quad-cities','Popular in the Quad Cities (Rock Island, Moline, and East Moline in Illinois, and Bettendorf and Davenport in Iowa), this pizza dough gets a heavy dose of brewer’s malt, giving it a nutty, sweet taste and a darker appearance. The sauce is thin and spicy; the signature lean pork sausage is heavy on fennel and spices; and the pizza is cut into strips using giant, razor-sharp scissors.','9e40e51e-fef8-484f-9863-1ebb2893c182','2025-02-20 01:39:51','2025-02-20 01:39:51'),('3a6d82c2-7cb7-416e-8a3c-a2170b510125','Tomato Pie','tomato-pie','On tomato pies, the sauce is the star of the show. Depending on the region, there are different types of pizza referred to as tomato pie. There’s the \"reverse\" pizza, which is your basic pizza (round or square), but with the placement of sauce and cheese reversed; a Philly tomato pie, which is a thick, square, room-temperature pizza topped with a thick sauce and a sprinkling of Parmesan or Romano cheese; and the hand-tossed Neo-Neapolitan style topped with tomato sauce, oregano, olive oil and just a dusting of cheese.','9e40e51e-b8ab-4977-a2c8-1a60a6d6a188','2025-02-20 01:39:50','2025-02-20 01:39:50'),('406b20a3-acd7-4e9b-8f01-f6270bf896d8','New Haven','new-haven','Assisted by oil or coal-fueled ovens reaching temperatures topping 600 degrees, New Haven-style apizza (pronounced ah-beets by locals) delivers a charred crust reminiscent of a backyard grill. The typically misshapen pies are lightly topped with ingredients such as tomatoes, cheese, and sometimes clams, delivered on wax-covered sheet pans that offer a rewarding crunchy and chewy texture.','9e40e51e-beef-4b2b-9488-8fffdbbed945','2025-02-20 01:39:50','2025-02-20 01:39:50'),('46639bc1-5acb-42ae-9aef-1102d2d2051b','Stuffed Crust','stuffed-crust','Stuffed crust is pizza whos outer rim of crust is traditionaly stuffed with mozzarella cheese, however pizza scientist have been experimenting with different fillings such as hotdogs, etc. Pizza Hut debuted stuffed crust pizza on March 26, 1995 and then engaged in a $45 million ad campaign promoting the pizza. Pizza Hut hired Donald Trump to advertise the pizza. Trump appeared in a 1995 commercial with Ivana Trump. Pizza Hut was sued by Brooklyn resident, Anthony Mongiello, for $1 billion after he claimed to have invented and patented stuffed crust pizza in 1987. Mongiello lost the case in 1999.','9e40e51e-ed6a-4809-b306-a6e29a0534a3','2025-02-20 01:39:51','2025-02-20 01:39:51'),('5e35ff3d-2947-482d-a16a-80318f8d29d7','Pizza Strips','pizza-strips','A specialty of Rhode Island, pizza strips are bakery bread that’s topped with tomato sauce and cut into strips.','9e40e51f-1642-46ea-a482-75a9a36d59ec','2025-02-20 01:39:51','2025-02-20 01:39:51'),('6306c010-f010-4f99-bac0-dc29e80e1b3f','New York','new-york','The quintessential New York pie features big, wide slices that encourage folding and often result in grease-stained clothing for the uninitiated. Ordered by the slice or whole, these hand-tossed beauties are most often light on the sauce and heavy on the cheese. Baked in coal or deck ovens, the New York version boasts a crunchy, yet pliable crust.','9e40e51e-ae1b-427e-bfdc-aa7ad73cb2ae','2025-02-20 01:39:50','2025-02-20 01:39:50'),('684a13c0-fcf8-4832-b729-28a7b853b21d','Grilled','grilled','Introduced in 1980 by Johanne Killeen and George German, the chef owners of Al Forno in Providence, Rhode Island, serve pizza dough brushed with oil before taking a turn or two on the grill over hot coals. Cheese and toppings are added after the last flip and allowed to melt, finishing off the pizza.','9e40e51e-e4e8-4973-8fce-64f234493139','2025-02-20 01:39:51','2025-02-20 01:39:51'),('6964e47c-5914-4ddc-892d-659b8e29259d','Ohio Valley','ohio-valley','In the Ohio Valley region (which includes Ohio, Indiana, Illinois, West Virginia, Pennsylvania, and Kentucky), toppings are added to square pies after the dough exits the oven, the theory being that the heat from the crust will cook the toppings. You won\'t find Ohio Valley-style pizza in every pizzeria in all of these states, but you\'ll have the most luck tracking one down if you\'re in this region.','9e40e51e-dbd9-4839-9309-99894b30bc31','2025-02-20 01:39:51','2025-02-20 01:39:51'),('7b60713d-2b33-4091-87e7-58173b55f82c','Sicilian','sicilian','Sicilian pizza is best recognized by its rectangular shape, one-to-two-inch crust, pillowy interior, and thick, crunchy base. Sicilian toppings are minimal, with tomato sauce placed above the cheese to hold it all together and ensure a well-cooked crust. Very similar to the Sicilian (but not as common to find), is the elusive Grandma, which presents itself as a thinner, crunchier version of the Sicilian.','9e40e51e-c4e0-4d05-b30a-ad1f9ecf1d2d','2025-02-20 01:39:50','2025-02-20 01:39:50'),('81ad71ae-554e-443e-932a-fdda9a3b069f','Vesuvio (Bombe)','vesuvio','This is the Neapolitan version of a stuffed pizza. The Vesuvio puts two crusts on top of each other, filling the interior with ingredients such as mozzarella, tomatoes, and mushrooms. Some pizzerias deliver the pizza to the table and allow the steam from the joined doughs to escape in front of you, mimicking a volcanic eruption.','9e40e51e-f278-452d-b700-8513f7e2cb43','2025-02-20 01:39:51','2025-02-20 01:39:51'),('8eaf8c71-82ff-4796-92e3-d9ab23231074','Hand Tossed','hand-tossed','Hand Tossed crust dough is kneaded, and stretched until to size. Traditional pizza.','9e40e51f-1b4b-4c6f-8c3f-0fbc249dbbee','2025-02-20 01:39:51','2025-02-20 01:39:51'),('a29a378a-b30b-4d11-ac3f-50fe00e3468a','Neopolitan','neopolitan','Over the past decade, Neapolitan-style pizza (authentic Italian and Americanized versions of it) has spread quickly across the country. Doughs that are allowed to ferment anywhere from a few hours to several days result in soft, digestible crusts with beautiful airy pockets that add a delightful crunch when they exit wood-burning ovens. Handled carefully and topped sparingly with fresh tomatoes, herbs and imported cheeses, this style has inspired many trips to Italy.','9e40e51e-b48b-4ee7-9941-90b476aa3350','2025-02-20 01:39:50','2025-02-20 01:39:50'),('aa625e44-4a69-4975-bf35-63171262204a','Detroit','detroit','What do you get when you take a Sicilian-style pizza recipe and bake it in blue steel pans originally designed for the auto industry? Detroit-Style pizza, that’s what. The square pans act like a cast iron skillet to create a super crisp crunch on the crust, and bakers deliberately push the blend of mozzarella and Brick cheese up the deep interior sides of the pans to form an awesome caramelization. The result is a pan pizza on steroids. Traditionalists bake the pizza twice and put the sauce on last to ensure a perfectly crisp crust.','9e40e51e-ce08-4b97-951b-e1d5444740ca','2025-02-20 01:39:50','2025-02-20 01:39:50'),('ac951484-de74-4447-8d82-9dab604f3afe','Bar/Tavern','bar-tavern','Traditionally found in early taverns and bars since they’re easy to hold with your beer and don’t fill you up too fast, bar and tavern pies are super-thin, round pies that are cut into square pieces. This style is found all over the Midwest in cities such as St. Louis, Columbus, Chicago, and Milwaukee.','9e40e51e-e0a2-46a0-ba41-aaf8fbf26d42','2025-02-20 01:39:51','2025-02-20 01:39:51'),('b57e9372-05af-4760-934e-663b43b1ccc8','Brier Hill','brier-hill','This style began in 1974 as a fundraising project for St. Anthony’s Catholic Church in Youngstown, Ohio. The round pies are cooked in pans and covered with a thick sauce before being topped with bell peppers and Romano cheese (a hot variety and another topped with eggs is also available).','9e40e51f-0cd4-43c4-be73-d7ec2db0526e','2025-02-20 01:39:51','2025-02-20 01:39:51'),('baf6e083-e4ba-486d-a9f4-f71f2f97c7f0','Pan','pan','Mostly found in the southeast United States and at chain pizzerias such as Pizza Hut, this pizza is proofed and cooked in a pan with oil or butter imparting a thick, buttery crust.','9e40e51e-e8e7-4c52-abb6-5764110fb313','2025-02-20 01:39:51','2025-02-20 01:39:51'),('ced02023-c6fe-41dc-a3e4-f7a852a02927','Other','other','Other pizza styles that don\'t fit into the other categories.',NULL,'2025-02-20 01:39:51','2025-02-20 01:39:51'),('e100348e-363d-4101-b19d-317d902b5420','DC Jumbo','dc-jumbo','Since 1997, several pizzerias in the Washington, D.C. area have been battling it out over who has the largest slices of pizza. Popular with the late-night crowds, slices are cut from pies larger than 30 inches, usually require two plates to transport, and tip the caloric charts at more than 1,000 calories a piece.','9e40e51f-07b7-4c91-ac22-0334c4c33419','2025-02-20 01:39:51','2025-02-20 01:39:51'),('e52c7bfb-2111-4a2d-a0ef-ecd419250cc3','California','california','Toppings are the big tip off with California-style pizzas. The crust is typically hand-tossed, but the toppings can range from barbecue chicken to Thai to lobster—the more \"gourmet\" the pizza appears, the more you can classify it as Californian.','9e40e51e-d7b1-42a3-ad47-2b6d35740ac7','2025-02-20 01:39:50','2025-02-20 01:39:50'),('e7155bd4-dfb5-4f2e-89c4-f8fec16ca795','Deep Dish','deep-dish','Diving into a deep dish pizza is not an easy undertaking. These one-to-two-inch thick giants of the pizza world are not available by the slice and often require a fork and knife to handle. It’s important to accept a few key facts when facing down a deep-dish pizza: 1) In most cases, you won’t be able to eat a whole one by yourself. 2) It’s best to order some veggies and meat to break up all the cheese. 3) Order ahead so you won\\\'t have to wait 45 minutes for your pie (and it is a pie). Once you have the hang of it, you’ll appreciate the nuances of the flaky, buttery crust, hearty toppings and historic significance of this Chicago mainstay.','9e40e51e-c985-48bb-a239-cc83c515e338','2025-02-20 01:39:50','2025-02-20 01:39:50'),('eebe8971-1914-4480-a71f-ef3aa01c015c','Colorado Mountain Pie','colorado-mountain-pie','So far I only know of one pizzeria chain in Colorado serving the Colorado Mountain Pie, but it’s been wooing locals since 1973 with pizzas listed by weight (one, two, three, or five lbs.), topped with mountains of ingredients and featuring a hand-rolled crust handle that is traditionally dipped in honey for dessert.','9e40e51f-033b-42d3-994b-9597c6ddf495','2025-02-20 01:39:51','2025-02-20 01:39:51');
/*!40000 ALTER TABLE `styles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tags_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES ('01a3da0a-9927-4b7e-94e0-a67654618d89','Pineapple','pineapple','2025-02-20 01:39:51','2025-02-20 01:39:51'),('0955d2de-fcb6-4963-bf56-167a9713f31d','Cheesy','cheesy','2025-02-20 01:39:51','2025-02-20 01:39:51'),('0feb413a-4436-4b67-a60b-1c6bc5168ebb','Low-Carb','low-carb','2025-02-20 01:39:51','2025-02-20 01:39:51'),('11dd0011-3a0c-446a-be4a-7cd30b775526','Feta','feta','2025-02-20 01:39:51','2025-02-20 01:39:51'),('1f035455-7226-4388-9157-1b73bbeff8de','Wood Fired','wood-fired','2025-02-20 01:39:51','2025-02-20 01:39:51'),('233217c6-a100-440a-ac94-e5106339143e','Garlic','garlic','2025-02-20 01:39:51','2025-02-20 01:39:51'),('23c996e0-dc25-4be1-9c00-15b6c5860b67','Meaty','meaty','2025-02-20 01:39:51','2025-02-20 01:39:51'),('2e859949-1e44-4180-9893-7147f5ddf15c','Classic','classic','2025-02-20 01:39:51','2025-02-20 01:39:51'),('344806a1-e236-46b0-9cf6-3322dda85fa2','Deluxe','deluxe','2025-02-20 01:39:51','2025-02-20 01:39:51'),('364da0c8-4ec4-4ab1-98d4-88893aecd68b','Vegan','vegan','2025-02-20 01:39:51','2025-02-20 01:39:51'),('367acc45-526b-4977-9f65-74fa73645d8b','Salami','salami','2025-02-20 01:39:51','2025-02-20 01:39:51'),('4dba70b9-df7f-471f-9426-5e614aba3b05','Mozzarella','mozzarella','2025-02-20 01:39:51','2025-02-20 01:39:51'),('4fb28d7a-d7ac-45e8-9f7b-518529a6612d','Provolone','provolone','2025-02-20 01:39:51','2025-02-20 01:39:51'),('54aa92a8-661b-4a0c-a4b2-bf97ba3daff9','Sausage','sausage','2025-02-20 01:39:51','2025-02-20 01:39:51'),('619586dc-a9e3-4995-a686-8c6da29f99ba','Savory','savory','2025-02-20 01:39:51','2025-02-20 01:39:51'),('64144fcf-f921-4638-a42c-3edc596c8d04','BBQ','bbq','2025-02-20 01:39:51','2025-02-20 01:39:51'),('65807754-34d0-4842-b2de-845040fa7aba','Crispy','crispy','2025-02-20 01:39:51','2025-02-20 01:39:51'),('6a2150a7-70df-4886-87ab-5e72f6fa79c2','Pub Style','pub-style','2025-02-20 01:39:51','2025-02-20 01:39:51'),('70ee2672-f297-4498-b102-c70b27df7973','Thin','thin','2025-02-20 01:39:51','2025-02-20 01:39:51'),('776c351b-cfc9-4209-b4fd-ca2dcd7db507','Keto','keto','2025-02-20 01:39:51','2025-02-20 01:39:51'),('7cf961a9-4476-48ef-9d6f-0e44f85c5f8e','Meat Lovers','meat-lovers','2025-02-20 01:39:51','2025-02-20 01:39:51'),('81a13f7e-ff74-4b4d-82e1-e6357c11ecc8','Tomato','tomato','2025-02-20 01:39:51','2025-02-20 01:39:51'),('882c149e-6f97-4515-926a-dd8f08b5f00d','Pepperoni','pepperoni','2025-02-20 01:39:51','2025-02-20 01:39:51'),('88f63b37-9956-43a3-9a45-e50902a9bcdb','Cheese Lovers','cheese-lovers','2025-02-20 01:39:51','2025-02-20 01:39:51'),('9838ac26-fc0e-42dc-9521-59bb3626ec75','Artichoke','artichoke','2025-02-20 01:39:51','2025-02-20 01:39:51'),('9a021543-20a3-467d-b0ff-ca5e208a7e25','Onion','onion','2025-02-20 01:39:51','2025-02-20 01:39:51'),('9a636b20-47da-4dcf-a5b5-2b7c423cf41e','Ricotta','ricotta','2025-02-20 01:39:51','2025-02-20 01:39:51'),('9f696756-78f5-44e5-aadd-c49f124e5fb6','Gluten-Free','gluten-free','2025-02-20 01:39:51','2025-02-20 01:39:51'),('a0ccff96-9547-4dd4-826b-e17f277d6080','Vegetarian','vegetarian','2025-02-20 01:39:51','2025-02-20 01:39:51'),('a4b3368a-ec89-44d4-a46a-e5d67d85d9cb','Parmesan','parmesan','2025-02-20 01:39:51','2025-02-20 01:39:51'),('ba6d65e8-bf84-4e9e-a2ff-e9b899ecf52e','Spinach','spinach','2025-02-20 01:39:51','2025-02-20 01:39:51'),('be53f1df-ea95-481c-89c9-d2e5fd123c8f','Supreme','supreme','2025-02-20 01:39:51','2025-02-20 01:39:51'),('bf7f68c8-9fad-4128-9c17-18e3ee6103ab','Bacon','bacon','2025-02-20 01:39:51','2025-02-20 01:39:51'),('d1414c85-325e-4d07-8122-a559b56935b0','Handmade','handmade','2025-02-20 01:39:51','2025-02-20 01:39:51'),('dd675e51-5f23-48ef-8a1e-e488fd4f8ac0','Pesto','pesto','2025-02-20 01:39:51','2025-02-20 01:39:51'),('e13d33d9-c542-403b-9850-194d526aecd6','Rising Crust','rising-crust','2025-02-20 01:39:51','2025-02-20 01:39:51'),('e957d9ec-b85f-48c6-8ec2-c495869b934f','Homestyle','homestyle','2025-02-20 01:39:51','2025-02-20 01:39:51'),('f112c8d6-173f-4988-b5bf-57e93b35ca68','Mushroom','mushroom','2025-02-20 01:39:51','2025-02-20 01:39:51'),('f707bb7a-d471-477e-be23-2bedced0b2bd','Ham','ham','2025-02-20 01:39:51','2025-02-20 01:39:51'),('fd879d6d-cf25-45ea-8e1b-2ecaec72467c','Spicy','spicy','2025-02-20 01:39:51','2025-02-20 01:39:51');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('25621748-94f7-4136-9338-e7bc36b545a7','Mark Wickline','mwicklinedev@gmail.com',NULL,'$2y$12$wPQO7lZLPDJryq5a25znwuQ6BYuWvl.7UVAA40ujbHIRKoRCVZRKi','KEfwkTbi56c3GGISq6uOl6cipjGoIoISPl58NFpm1NpkDTPs8D9Osxsbnz5C','2025-02-20 03:31:02','2025-02-20 03:31:02'),('f51f97a5-e445-445e-a106-35d152f4f57c','Catmanallen2','catmanallen2@gmail.com',NULL,'$2y$12$o9w1RpUI1cR.3pLCGe79X.7AcHQRzGdGvJ3/acAL7p5DJiIpY0Xe6','tW5eEktU4CciA91zkqAcTYHVyRs12ovR63QvaIjqmy4ElezdSya8XflcAbNH','2025-02-20 03:35:58','2025-02-20 03:35:58');
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

-- Dump completed on 2025-02-22 17:26:43
