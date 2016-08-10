CREATE DATABASE IF NOT EXISTS `pokervelvet` ;
USE `pokervelvet`;

--
-- Table structure for table `status_table`
--

DROP TABLE IF EXISTS `status_table`;

CREATE TABLE `status_table` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `status_table`
--

LOCK TABLES `status_table` WRITE;
INSERT INTO `status_table` VALUES (1,'active'),(9,'deleted'),(0,'inactive');
UNLOCK TABLES;

--
-- Table structure for table `roomconfig`
--

DROP TABLE IF EXISTS `roomconfig`;

CREATE TABLE `roomconfig` (
  `ConfigId` smallint(6) NOT NULL AUTO_INCREMENT,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Status 0 - inactive \nStatus 1 - active\nStatus 9 - deleted',
  `GameTypeId` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 - Standard \n2 - Shootout Tournament\n3 - Sit''n''go Tournament',
  `GameSpeed` tinyint(4) NOT NULL DEFAULT '18' COMMENT 'Game speed (in seconds)',
  `MaxSize` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Game size (number of players)',
  `SmallBlinds` int(11) NOT NULL DEFAULT '0',
  `BigBlinds` int(11) NOT NULL DEFAULT '0',
  `BuyInMin` int(11) NOT NULL DEFAULT '0',
  `BuyInMax` int(11) DEFAULT '0',
  `SitNGoChips` int(11) NOT NULL,
  `entryFee` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ConfigId`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `roomconfig`
--

LOCK TABLES `roomconfig` WRITE;
INSERT INTO `roomconfig` VALUES (1,1,1,18,5,1,2,20,40,0,0),(3,1,1,18,5,5,10,100,2200,0,0),(4,1,1,18,5,25,50,500,10000,0,0),(5,1,1,18,5,50,100,1000,30000,0,0),(6,1,1,18,5,100,200,2000,50000,0,0),(7,1,1,18,5,250,500,5000,80000,0,0),(8,1,1,18,5,500,1000,10000,150000,0,0),(9,1,1,18,5,1000,2000,20000,300000,0,0),(11,1,1,18,5,5000,10000,90000,1500000,0,0),(12,1,1,18,5,10000,20000,200000,3000000,0,0),(13,1,1,18,5,25000,50000,300000,5000000,0,0),(14,1,1,18,5,100000,200000,1000000,20000000,0,0),(16,1,1,18,5,400000,800000,10000000,80000000,0,0),(17,1,1,18,5,500000,1000000,20000000,120000000,0,0),(19,1,1,18,9,1,2,20,40,0,0),(21,1,1,18,9,5,10,100,2200,0,0),(22,1,1,18,9,25,50,500,10000,0,0),(23,1,1,18,9,50,100,1000,30000,0,0),(24,1,1,18,9,100,200,2000,50000,0,0),(25,1,1,18,9,250,500,5000,80000,0,0),(26,1,1,18,9,500,1000,10000,150000,0,0),(27,1,1,18,9,1000,2000,20000,300000,0,0),(29,1,1,18,9,5000,10000,90000,1500000,0,0),(30,1,1,18,9,10000,20000,200000,3000000,0,0),(31,1,1,18,9,25000,50000,300000,5000000,0,0),(32,1,1,18,9,100000,200000,1000000,20000000,0,0),(34,1,1,18,9,400000,800000,10000000,80000000,0,0),(35,1,1,18,9,500000,1000000,20000000,120000000,0,0),(50,1,1,9,5,1,2,20,40,0,0),(52,1,1,9,5,5,10,100,2200,0,0),(53,1,1,9,5,25,50,500,10000,0,0),(54,1,1,9,5,50,100,1000,30000,0,0),(55,1,1,9,5,100,200,2000,50000,0,0),(56,1,1,9,5,250,500,5000,80000,0,0),(57,1,1,9,5,500,1000,10000,150000,0,0),(58,1,1,9,5,1000,2000,20000,300000,0,0),(60,1,1,9,5,5000,10000,90000,1500000,0,0),(61,1,1,9,5,10000,20000,200000,3000000,0,0),(62,1,1,9,5,25000,50000,300000,5000000,0,0),(63,1,1,9,5,100000,200000,1000000,20000000,0,0),(65,1,1,9,5,400000,800000,10000000,80000000,0,0),(66,1,1,9,5,500000,1000000,20000000,120000000,0,0),(68,1,1,9,9,1,2,20,40,0,0),(70,1,1,9,9,5,10,100,2200,0,0),(71,1,1,9,9,25,50,500,10000,0,0),(72,1,1,9,9,50,100,1000,30000,0,0),(73,1,1,9,9,100,200,2000,50000,0,0),(74,1,1,9,9,250,500,5000,80000,0,0),(75,1,1,9,9,500,1000,10000,150000,0,0),(76,1,1,9,9,1000,2000,20000,300000,0,0),(78,1,1,9,9,5000,10000,90000,1500000,0,0),(79,1,1,9,9,10000,20000,200000,3000000,0,0),(80,1,1,9,9,25000,50000,300000,5000000,0,0),(81,1,1,9,9,100000,200000,1000000,20000000,0,0),(83,1,1,9,9,400000,800000,10000000,80000000,0,0),(84,1,1,9,9,500000,1000000,20000000,120000000,0,0),(116,1,3,18,5,5,10,100,100,0,10),(117,1,3,18,5,50,100,1000,1000,0,50),(118,1,3,18,5,500,1000,10000,10000,0,500),(119,1,3,18,5,5000,10000,100000,100000,0,5000),(120,1,3,18,5,25000,50000,500000,500000,0,20000),(121,1,3,18,5,50000,100000,1000000,1000000,0,50000);
UNLOCK TABLES;

--
-- Table structure for table `gift_groups`
--

DROP TABLE IF EXISTS `gift_groups`;

CREATE TABLE `gift_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '0 value must be portfolio items',
  `name` varchar(20) NOT NULL,
  `isPortfolio` tinyint(1) NOT NULL DEFAULT '0',
  `status` smallint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `gift_groups`
--

LOCK TABLES `gift_groups` WRITE;
INSERT INTO `gift_groups` VALUES (1,'Drinks',0,1),(2,'Food',0,1),(3,'Fashion',0,1),(4,'Love',0,1),(5,'Animals',0,1),(6,'Cool stuff',0,1),(7,'Bling Bling',0,1),(10,'Transportation',1,1),(11,'Luxury',1,1),(12,'Real Estate',1,1);
UNLOCK TABLES;

--
-- Table structure for table `gifts`
--

DROP TABLE IF EXISTS `gifts`;

CREATE TABLE `gifts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` smallint(4) NOT NULL DEFAULT '0' COMMENT 'Status 0 - inactive \nStatus 1 - active\nStatus 9 - deleted',
  `name` varchar(40) NOT NULL,
  `price_gold` int(11) NOT NULL DEFAULT '0',
  `price_chips` int(11) NOT NULL DEFAULT '0',
  `gift_group` int(11) NOT NULL DEFAULT '0',
  `description` varchar(50) DEFAULT NULL,
  `imagePath` varchar(40) NOT NULL,
  `existsInClient` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_GIFT_GROUPS_idx` (`gift_group`),
  CONSTRAINT `FK_GIFT_GROUPS` FOREIGN KEY (`gift_group`) REFERENCES `gift_groups` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=261 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `gifts`
--

LOCK TABLES `gifts` WRITE;
INSERT INTO `gifts` VALUES (7,1,'Chicken',0,35,5,'Chicken','Animals_Chicken.png',1),(17,1,'Pig',2,0,5,'Pig','Animals_Pig.png',1),(21,1,'Pink Diamond',125,0,11,'10 Carat Pink Diamond','Portfolio_10ctpinkdiamond.png',1),(22,1,'Velvet Diamond',25,0,11,'Velvet Diamond','Portfolio_VelvetDiamond.png',1),(23,1,'Private Jet',290,0,10,'Private Jet','Portfolio_PrivateJet.png',1),(24,1,'Sports Car',90,0,10,'Sports Car','Portfolio_SportsCar.png',1),(25,1,'Penthouse',400,0,12,'Penthouse','Portfolio_Penthouse.png',1),(26,1,'Gold Bar',75,0,11,'Gold Bar','Portfolio_9999GoldBar.png',1),(27,1,'Beach House',300,0,12,'Beach House','Portfolio_BeachHouse.png',1),(28,1,'Jacht',150,0,10,'Jacht','Portfolio_Jacht.png',1),(42,1,'Snail',0,35,5,'Snail','1snail.png',1),(43,1,'Python',0,100,5,'Python','Python.png',1),(44,1,'Rabbit',0,35,5,'Rabbit','rabbit.png',1),(45,1,'Monkey',2,0,5,'Monkey','monkey.png',1),(46,1,'Panda bear',0,150,5,'Panda bear','Panda.png',1),(47,1,'Mouse',0,30,5,'Mouse','mouse.png',1),(48,1,'Coala',0,120,5,'Coala','koala.png',1),(49,1,'Bulldog puppy',0,50,5,'Bulldog puppy','Puppy.png',1),(50,1,'Groundhog',0,100,5,'Groundhog','1groundhog.png',1),(51,1,'Wolf',0,150,5,'Wolf','wolf.png',1),(52,1,'Kitten(cat)',0,40,5,'Kitten(cat)','kitten.png',1),(53,1,'Donkey',1,0,5,'Donkey','donkey.png',1),(54,1,'Owl',0,100,5,'Owl','owl.png',1),(55,1,'Fox',0,110,5,'Fox','fox.png',1),(56,1,'Little black dress',0,90,3,'Little black dress','little black dress.png',1),(57,1,'Lizard',0,50,5,'Lizard','Lizard.png',1),(58,1,'Rat',1,0,5,'Rat','rat.png',1),(59,1,'Bee',0,20,5,'Bee','bee.png',1),(60,1,'Octopus',0,75,5,'Octopus','Octopus.png',1),(61,1,'Red pumps',0,120,3,'Red pumps','red pumps.png',1),(62,1,'Coke',0,25,1,'Coke','coke.png',1),(63,1,'Ice-cream',0,20,2,'Ice-cream','icecream.png',1),(64,1,'Green tea',0,15,1,'Green tea','green tea.png',1),(65,1,'Spring rolls',0,35,2,'Spring rolls','springrolls.png',1),(67,1,'Eggs',1,0,2,'Eggs','Eggs.png',1),(68,1,'Caffe latte',0,15,1,'Caffe latte','caffe latte.png',1),(69,1,'Kiss',0,100,4,'Love','kiss.png',1),(70,1,'Peking duck',0,40,2,'Peking duck','peking duck.png',1),(71,1,'Sombrero',0,40,3,'Sombrero','1Sombrero.png',1),(72,1,'Chocolate candy',0,150,4,'Chocolate candy','chocolate candy.png',1),(73,1,'Sandwich',0,25,2,'Sandwich','sandwich.png',1),(74,1,'Irish coffee',0,15,1,'Irish coffee','irish coffee.png',1),(75,1,'Harlekin',0,500,4,'Harlekin','harlekin.png',1),(76,1,'Heart',0,120,4,'Heart','heart.png',1),(77,1,'Hot&Sour soup',0,30,2,'Hot&Sour soup','hot&Sour soup.png',1),(78,1,'Espresso',0,15,1,'Espresso','espresso.png',1),(79,1,'Chips',0,20,2,'Chips','chips.png',1),(80,1,'Teddy bear',0,160,4,'Teddy bear','teddy bear.png',1),(81,1,'Macchiato',0,15,1,'Macchiato','macchiato.png',1),(82,1,'Briefs',1,0,3,'Briefs','briefs.png',1),(83,1,'Moussaca',0,35,2,'Moussaca','moussaca.png',1),(84,1,'Call me',2,0,4,'Call me','banner_callme.png',1),(85,1,'Birthday cake',0,50,2,'Birthday cake','birthday cake.png',1),(86,1,'Broken Heart',0,120,4,'Broken Heart','broken heart.png',1),(87,1,'Coconout water',0,18,1,'Coconout water','coconut water.png',1),(88,1,'Corset',2,0,3,'Corset','corset.png',1),(89,1,'Red rose',0,90,4,'Red rose','red rose.png',1),(90,1,'Spaghetti',0,35,2,'Spaghetti','spaghetti.png',1),(91,1,'Fresh fruit juice',0,20,1,'Fresh fruit juice','fruit juice.png',1),(92,1,'Gift',0,150,4,'Gift','gift.png',1),(93,1,'Bowl of fruit',0,30,2,'Bowl of fruit','bowl of fruit.png',1),(94,1,'Flowers',0,110,4,'Flowers','flowers.png',1),(95,1,'Bow-tie',0,35,3,'Bow-tie','bow-tie.png',1),(96,1,'Shooter',0,35,1,'Shooter','shooter.png',1),(97,1,'Kiss',1,0,4,'Kiss','banner_kiss.png',1),(98,1,'Tiropites',0,35,2,'Tiropites','tiropites.png',1),(99,1,'Milk',0,10,1,'Milk','milk.png',1),(100,1,'Marry me\"',2,0,4,'Marry me','banner_marry me.png',1),(101,1,'Shrimp cocktail',0,40,2,'Shrimp cocktail','shrimp coctail.png',1),(102,1,'PokerVelvet Tshirt',0,50,3,'PokerVelvet Tshirt','PV T-shirt.png',1),(103,1,'Love letter',0,90,4,'Love letter','love letter.png',1),(104,1,'Energy drink',0,30,1,'Energy drink','energy drink.png',1),(105,1,'Tortilla',0,35,2,'Tortilla','tortillas.png',1),(106,1,'Cupid',1,0,4,'Cupid','cupid.png',1),(107,1,'Pizza cut',0,25,2,'Pizza cut','pizza.png',1),(108,1,'I <3U\"',2,0,4,'I <3U','banner_iloveu.png',1),(109,1,'Cowboy belt',0,45,3,'Cowboy belt','cowboy belt.png',1),(110,1,'Paella',0,35,2,'Paella','paella.png',1),(111,1,'Lobster',0,75,2,'Lobster','lobster.png',1),(112,1,'Popcorn',0,20,2,'Popcorn','popcorn.png',1),(113,1,'Diamond Ring',0,500,7,'Diamond Ring','diamond ring.png',1),(114,1,'Sushi',0,40,2,'Sushi','sushi.png',1),(115,1,'Tacos',0,30,2,'Tacos','tacos.png',1),(116,1,'Glasses',1,0,3,'Glasses','1glasses.png',1),(117,1,'24ct Diamond Bracelet',5,0,7,'24ct Diamond Bracele','diamond bracelet.png',1),(118,1,'French toast-caviar',0,60,2,'French toast-caviar','French toast caviar.png',1),(119,1,'Black Velvet Pearl',0,700,7,'Black Velvet Pearl','black velvet pearl.png',1),(120,1,'Chocolate cake',0,25,2,'Chocolate cake','chocolate cake.png',1),(121,1,'Diamond Smartphone',5,0,7,'Diamond Smartphone','diamond smartphone.png',1),(122,1,'Cowboy hat',0,45,3,'Cowboy hat','cowboy hat.png',1),(123,1,'French fries',0,20,2,'French fries','french fries.png',1),(124,1,'Kings Crown',0,2000,7,'Kings Crown','kings crown.png',1),(125,1,'Velvet panna cotta',0,25,2,'Velvet panna cotta','Velvet panna cota.png',1),(126,1,'Martini',2,0,1,'Martini','martini.png',1),(127,1,'Gold Chain',6,0,7,'Gold Chain','gold chain.png',1),(128,1,'Hot dog',0,25,2,'Hot dog','hot dog.png',1),(129,1,'Bavarien beer',0,24,1,'Bavarien beer','bavarian beer.png',1),(130,1,'Ruby Necklace',9,0,7,'Ruby Necklace','ruby necklace.png',1),(131,1,'Banana',2,0,2,'Banana','banana.png',1),(132,1,'Carneval mask',0,55,3,'Carneval mask','1carneval mask.png',1),(133,1,'Pearl Necklace',0,1200,7,'Pearl Necklace','pearl necklace.png',1),(134,1,'Burger',0,25,2,'Burger','Burger.png',1),(135,1,'Qeens Crown',0,1800,7,'Qeens Crown','queen crown.png',1),(136,1,'Emerald Necklace',10,0,7,'Emerald Necklace','emerald necklace.png',1),(137,1,'Double burger',1,0,2,'Double burger','double burger.png',1),(138,1,'Cold beer',0,24,1,'Cold beer','beer.png',1),(139,1,'24ct Gold Watch',0,1000,7,'24ct Gold Watch','gold watch.png',1),(140,1,'Sausage',1,0,2,'Sausage','sausage.png',1),(141,1,'Sneakers',0,70,3,'Sneakers','Sneakers.png',1),(142,1,'Blue Sapphire',4,0,7,'Blue Sapphire','blue sapphire.png',1),(143,1,'Cosmopolitan',2,0,1,'Cosmopolitan','csmopolitan.png',1),(144,1,'Vintage vine',0,25,1,'Vintage vine','vintage wine.png',1),(145,1,'Cuban cigars',0,100,6,'Cuban cigars','cuban.png',1),(146,1,'Sparkling champagne',3,0,1,'Sparkling champagne','champagne.png',1),(147,1,'PJ\'s',0,80,3,'PJ\'s','Pajamas.png',1),(149,1,'Gin',0,35,1,'Gin','gin.png',1),(151,1,'Manhattan',2,0,1,'Manhattan','manhattan.png',1),(152,1,'Tuxedo',0,150,3,'Tuxedo','tuxedo.png',1),(154,1,'Mineral Water',0,12,1,'Mineral Water','mineral water.png',1),(157,1,'Palinka',0,40,1,'Palinka','palinka.png',1),(158,1,'Coctail dress',0,100,3,'Coctail dress','Coctai dress.png',1),(159,1,'Whiskey',0,40,1,'Whiskey','whiskey.png',1),(160,1,'Tequila',0,35,1,'Tequila','tequila.png',1),(161,1,'Evening gown',0,130,3,'Evening gown','evening gown.png',1),(163,1,'Slivovitz rakia',0,35,1,'Slivovitz rakia','slilovitz.png',1),(164,1,'Skull',2,0,6,'Skull','skull.png',1),(165,1,'Vodka',0,35,1,'Vodka','vodka.png',1),(166,1,'Cigarettes',0,30,6,'Cigarettes','cigarettes.png',1),(167,1,'Cognac',0,45,1,'Cognac','cognac.png',1),(168,1,'Bikini',1,0,3,'Bikini','bikini.png',1),(169,1,'Black Velvet',0,45,1,'Black Velvet','black velvet.png',1),(170,1,'Spade',1,0,6,'Spade','1PV symbol 4.png',1),(171,1,'Mojito',0,50,1,'Mojito','mojito.png',1),(172,1,'Thumb down',0,60,6,'Thumb down','thumbs down.png',1),(173,1,'Caipirinha',1,0,1,'Caipirinha','caipirinha.png',1),(174,1,'Stopwatch',1,0,6,'Stopwatch','stopwatch.png',1),(175,1,'Mink',0,200,3,'Mink','mink.png',1),(176,1,'Lemonade',0,14,1,'Lemonade','lemonade 2.png',1),(177,1,'Anarchy',0,80,6,'Anarchy','anarchy.png',1),(178,1,'First aid',0,80,6,'First aid','first aid.png',1),(179,1,'Tissue',1,0,6,'Tissue','tissue.png',1),(180,1,'Pina Colada',0,50,1,'Pina Colada','Pina Colada.png',1),(181,1,'Diamond',1,0,6,'Diamond','PV symbol 1.png',1),(182,1,'Margarita',0,45,1,'Margarita','margarita 2.png',1),(183,1,'Angel wings',1,0,3,'Angel wings','angel wings.png',1),(184,1,'Soju',0,40,1,'Soju','soju.png',1),(185,1,'Club',1,0,6,'Club','PV symbol 2.png',1),(186,1,'Absinthe',1,0,1,'Absinthe','absinthe.png',1),(187,1,'Question mark',0,50,6,'Question mark','question mark.png',1),(188,1,'Sunglasses',1,0,3,'Sunglasses','sunglasses.png',1),(189,1,'Thunder',0,75,6,'Thunder','thunder.png',1),(190,1,'Bloody Mary',2,0,1,'Bloody Mary','bloody mary.png',1),(191,1,'WC paper',2,0,6,'WC paper','wc paper.png',1),(192,1,'Thumbs up',0,60,6,'Thumbs up','thumbs up.png',1),(193,1,'Kentucky tea',2,0,1,'Kentucky tea','kentuckey tea.png',1),(194,1,'Football helmet',0,45,3,'Football helmet','football helmet.png',1),(195,1,'Dollars',0,55,6,'Dollars','dollars.png',1),(196,1,'Snake bite',1,0,1,'Snake bite','snake bite.png',1),(197,1,'Tequila Sunrise',1,0,1,'Tequila Sunrise','tequila sunrise.png',1),(198,1,'Toxic',1,0,6,'Toxic','radioactive.png',1),(199,1,'Velvet cap',0,35,3,'Velvet cap','velvet cap.png',1),(200,1,'Clock ticking',1,0,6,'Clock ticking','clock.png',1),(201,1,'Rum',0,35,1,'Rum','rum.png',1),(202,1,'\"Nice\"',0,50,6,'\"Nice\" banner','banner_nice.png',1),(203,1,'\"Zzz\"',1,0,6,'\"Zzz\" banner','banner_Zzz.png',1),(204,1,'China emblem',0,250,6,'China emblem','china emblem.png',1),(205,1,'White vine',0,20,1,'White vine','white wine.png',1),(206,1,'Applause',0,80,6,'Applause','applause.png',1),(207,1,'Gun',0,200,6,'Gun','gun.png',1),(208,1,'CCCP hammer&sickle',0,250,6,'CCCP hammer&sickle','CCCP emblem.png',1),(209,1,'Light bulb',0,65,6,'Light bulb','lightbulb.png',1),(210,1,'French emblem',0,250,6,'French emblem','france emblem.png',1),(211,1,'Pacifier',1,0,6,'Pacifier','pacifier.png',1),(212,1,'Diaper',1,0,6,'Diaper','diaper.png',1),(213,1,'\"LOL\"',1,0,6,'\"LOL\" banner','banner_lol.png',1),(214,1,'UK emblem',0,250,6,'UK emblem','uk emblem.png',1),(215,1,'Army helmet',0,55,3,'Army helmet','army helmet.png',1),(216,1,'Paintball',3,0,6,'Paintball','paintball.png',1),(217,1,'Uncle Sam',0,250,6,'Uncle Sam','uncle sam.png',1),(218,1,'Dinamit',0,120,6,'Dinamit','dynamite.png',1),(219,1,'Baseball cap',0,45,3,'Baseball cap','baseball cap.png',1),(220,1,'Africa emblem',0,250,6,'Africa emblem','africa.png',1),(221,1,'Diploma',0,90,6,'Diploma','diploma.png',1),(222,1,'Deutschland Wappen',0,250,6,'Deutschland Wappen','germany emblem.png',1),(223,1,'\"Ouch\"',0,50,6,'\"Ouch\" banner','banner_ouch.png',1),(224,1,'Australian kangoo',0,250,6,'Australian kangoo','aussie.png',1),(225,1,'High heels clear',2,0,3,'High heels clear','high heels.png',1),(226,1,'Peace',0,60,6,'Peace','victory.png',1),(228,1,'Clutch',0,50,3,'Clutch','Clutch.png',1),(229,1,'Hawaian swimshorts',0,65,3,'Hawaian swimshorts','hawaian swimshorts.png',1),(230,1,'Hearts',1,0,6,'Hearts','4PV symbol 3.png',1),(234,1,'Motorcycle',50,0,10,'Motorcycle','Portfolio_Motorcycle.png',1),(236,1,'Villa',250,0,12,'Villa','Portfolio_Villa.png',1),(240,1,'Mansion',500,0,12,'Mansion','Portfolio_Mansion.png',1),(241,1,'Golf course',650,0,12,'Golf court','Golf court650gold.png',1),(242,1,'Private island',800,0,12,'Private island','Private island800gold.png',1),(243,1,'Ski chalet',450,0,12,'Ski chalet','Ski chalet450gold.png',1),(244,1,'Stadium',700,0,12,'Stadium','Stadium700gold.png',1),(245,1,'Tower building',900,0,12,'Tower building','Tower building900gold.png',1),(246,1,'Tropical villa',350,0,12,'Tropical villa','Tropical villa 350gold.png',1),(247,1,'Diamond phone',15,0,11,'Diamond phone','Diamond phone15gold.png',1),(248,1,'Diamond ring',50,0,11,'Diamond ring','Diamond ring50gold.png',1),(249,1,'Gold bike',30,0,11,'Gold bike','Gold bike30gold.png',1),(250,1,'Gold paper',20,0,11,'Gold paper','Gold paper20gold.png',1),(251,1,'Golden egg',60,0,11,'Golden egg','Golden egg60gold.png',1),(252,1,'Golden toilet',80,0,11,'Golden toilet','Golden toilet80gold.png',1),(253,1,'Luxury watch',55,0,11,'Luxury watch','Luxury watch55gold.png',1),(254,1,'Roller skates',40,0,11,'Roller skates','Roller skates40gold.png',1),(255,1,'Mega yacht',170,0,10,'Mega yacht','Mega jacht170.png',1),(256,1,'Chopper',65,0,10,'Chopper','Chopper65gold.png',1),(257,1,'Custom limo',120,0,10,'Custom limo','Custom limo120gold.png',1),(258,1,'Helicopter',140,0,10,'Helicopter','Helicopter140gold.png',1),(259,1,'Hot ride',90,0,10,'Hot ride','Hot ride90gold.png',1),(260,1,'Moto cross',35,0,10,'Moto cross','Moto cross35gold.png',1);
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;


CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` smallint(4) NOT NULL DEFAULT '1' COMMENT 'Status 0 - inactive \nStatus 1 - active\nStatus 9 - deleted',
  `name` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `description` varchar(50) DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Type 0 - standard product\nType 1 - promotional product\n',
  `productId` varchar(20) DEFAULT NULL,
  `product_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'product_types:\n0 - chips\n1 - gold',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `productId_UNIQUE` (`productId`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
INSERT INTO `products` VALUES (1,1,'100K chips',100000,0.99,' ',0,'100Kchips',0),(2,1,'500k chips',500000,2.99,' ',0,'500Kchips',0),(3,1,'1M chips',1000000,4.99,' ',0,'1MChips',0),(4,1,'3M chips',3000000,9.99,' ',0,'3Mchips',0),(5,1,'10M chips',10000000,29.99,' ',0,'10Mchips',0),(6,1,'50M chips',50000000,49.99,' ',0,'50Mchips',0),(7,1,'10 Gold',10,0.99,'',0,'10gold',1),(8,1,'25 gold',25,1.99,' ',0,'25gold',1),(9,1,'75 gold',75,4.99,' ',0,'75goldd',1),(10,1,'200 gold',200,9.99,' ',0,'200gold',1),(11,1,'500 gold',500,19.99,' ',0,'500gold',1);
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 - admin \n1 - user',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Status 0 - inactive \nStatus 1 - active\nStatus 2 - blocked\nStatus 9 - deleted',
  `name` varchar(50) NOT NULL DEFAULT '',
  `surname` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `chips` int(11) NOT NULL DEFAULT '0',
  `gold` mediumint(9) NOT NULL DEFAULT '0',
  `location` varchar(50) NOT NULL DEFAULT '',
  `level` mediumint(9) NOT NULL DEFAULT '0',
  `handsPlayed` mediumint(9) NOT NULL DEFAULT '0',
  `handsWon` mediumint(9) NOT NULL DEFAULT '0',
  `levelProgress` tinyint(4) NOT NULL DEFAULT '0',
  `r2Tickets` smallint(6) NOT NULL DEFAULT '0',
  `r3Tickets` smallint(6) NOT NULL DEFAULT '0',
  `r4Tickets` smallint(6) NOT NULL DEFAULT '0',
  `shootOutWon` smallint(6) NOT NULL DEFAULT '0',
  `sitNGoWon` smallint(6) NOT NULL DEFAULT '0',
  `userStatus` varchar(50) DEFAULT NULL,
  `dateRegistered` datetime DEFAULT NULL,
  `lastLogin` datetime DEFAULT NULL,
  `avatar` varchar(100) NOT NULL DEFAULT '',
  `show_avatar` tinyint(1) DEFAULT '1',
  `activeGiftId` int(11) DEFAULT NULL,
  `activeGiftExpiration` datetime DEFAULT NULL,
  `guest` tinyint(1) NOT NULL DEFAULT '0',
  `dailyMoneyTransfer` int(11) DEFAULT NULL,
  `lastMoneyTransfer` datetime DEFAULT NULL,
  `lostChipsCounter` int(11) NOT NULL DEFAULT '0',
  `facebookUser` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_key` (`email`),
  KEY `activeGift_key` (`activeGiftId`),
  KEY `login_key` (`user_type`,`email`,`facebookUser`,`status`,`guest`),
  CONSTRAINT `active_Gift` FOREIGN KEY (`activeGiftId`) REFERENCES `gifts` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
INSERT INTO `users` VALUES (1,0,0,'Administrator','PokerVelvet','admin','admin','admin',0,0,'',0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,'PV_icon_512.jpg',0,NULL,NULL,0,NULL,NULL,0,0);
UNLOCK TABLES;

--
-- Table structure for table `gift_trans`
--

DROP TABLE IF EXISTS `gift_trans`;

CREATE TABLE `gift_trans` (
  `transId` bigint(20) NOT NULL AUTO_INCREMENT,
  `itemsBought` int(11) DEFAULT NULL,
  `paidChips` bigint(20) DEFAULT NULL,
  `paidGold` int(11) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `giftId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  PRIMARY KEY (`transId`),
  KEY `gifts_key_idx` (`giftId`),
  KEY `users_key_idx` (`userId`),
  CONSTRAINT `gifts_key` FOREIGN KEY (`giftId`) REFERENCES `gifts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `gifts_users_key` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Table structure for table `money_transfer`
--

DROP TABLE IF EXISTS `money_transfer`;

CREATE TABLE `money_transfer` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `receiverUserId` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date_created_key` (`dateCreated`),
  KEY `money_userid_key_idx` (`userId`),
  KEY `money_receiverid_key_idx` (`receiverUserId`),
  CONSTRAINT `money_receiverid_key` FOREIGN KEY (`receiverUserId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `money_userid_key` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Table structure for table `portfolio`
--

DROP TABLE IF EXISTS `portfolio`;

CREATE TABLE `portfolio` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `giftId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gifts_key_idx` (`giftId`),
  KEY `users_key_idx` (`userId`),
  CONSTRAINT `pf_gifts_key` FOREIGN KEY (`giftId`) REFERENCES `gifts` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `pf_gifts_users` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


--
-- Table structure for table `product_trans`
--

DROP TABLE IF EXISTS `product_trans`;
CREATE TABLE `product_trans` (
  `transId` bigint(20) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `productId` int(11) DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `timestamp` datetime NOT NULL,
  `quantity` int(11) NOT NULL,
  `receipt` text ,
  `transactionId` varchar(50) DEFAULT NULL,
  `receiptValidated` tinyint(1) DEFAULT '0',
  `tidValidated` tinyint(1) DEFAULT '0',
  `storeType` varchar(1) NOT NULL,
  PRIMARY KEY (`transId`),
  KEY `key_products_idx` (`productId`),
  KEY `key_product_users_idx` (`userId`),
  KEY `tid_idx` (`transactionId`,`storeType`),
  CONSTRAINT `key_products` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `key_product_users` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Table structure for table `user_avatar_history`
--

DROP TABLE IF EXISTS `user_avatar_history`;
CREATE TABLE `user_avatar_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `dateChanged` datetime NOT NULL,
  `avatarImage` varchar(100) COLLATE utf8_bin NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `key_avatarhistory_users_idx` (`userId`),
  CONSTRAINT `key_avatarhistory_users` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Table structure for table `user_awards`
--

DROP TABLE IF EXISTS `user_awards`;
CREATE TABLE `user_awards` (
  `userId` int(11) NOT NULL,
  `counterUpdated` datetime DEFAULT NULL,
  `facebookAwards` smallint(6) DEFAULT '0',
  `emailAwards` smallint(6) DEFAULT '0',
  `totalAwardedInvites` int(11) DEFAULT '0',
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Table structure for table `user_friends`
--

DROP TABLE IF EXISTS `user_friends`;
CREATE TABLE `user_friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `friendId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `key_users_user_idx` (`userId`),
  KEY `key_users_friend_idx` (`friendId`),
  CONSTRAINT `key_friend_friend` FOREIGN KEY (`friendId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `key_friend_user` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Table structure for table `user_notification`
--

DROP TABLE IF EXISTS `user_notification`;

CREATE TABLE `user_notification` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `dateCreated` datetime DEFAULT NULL,
  `notificationText` varchar(200) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `isRead` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `key_users_idx` (`userId`),
  KEY `key_read_idx` (`isRead`),
  CONSTRAINT `key_notify_users` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
