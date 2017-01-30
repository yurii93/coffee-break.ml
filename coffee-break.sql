-- --------------------------------------------------------
-- Сервер:                       127.0.0.1
-- Версія сервера:               10.1.19-MariaDB - mariadb.org binary distribution
-- ОС сервера:                   Win32
-- HeidiSQL Версія:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for таблиця coffee-break.coffee_comments
CREATE TABLE IF NOT EXISTS `coffee_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productId` int(11) NOT NULL,
  `author` varchar(50) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table coffee-break.coffee_comments: ~1 rows (приблизно)
/*!40000 ALTER TABLE `coffee_comments` DISABLE KEYS */;
INSERT IGNORE INTO `coffee_comments` (`id`, `productId`, `author`, `comment`, `date`) VALUES
	(1, 5, 'Safsadf', 'Привет', '2017-01-14 13:47:47');
/*!40000 ALTER TABLE `coffee_comments` ENABLE KEYS */;


-- Dumping structure for таблиця coffee-break.coffee_messages
CREATE TABLE IF NOT EXISTS `coffee_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table coffee-break.coffee_messages: ~0 rows (приблизно)
/*!40000 ALTER TABLE `coffee_messages` DISABLE KEYS */;
INSERT IGNORE INTO `coffee_messages` (`id`, `name`, `email`, `message`, `date`) VALUES
	(1, 'юрий', 'yuriii@a.ua', 'Добрый день хотел бы вам р-чтоыассказаьб кое', '2017-01-13 18:08:48');
/*!40000 ALTER TABLE `coffee_messages` ENABLE KEYS */;


-- Dumping structure for таблиця coffee-break.coffee_orders
CREATE TABLE IF NOT EXISTS `coffee_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL DEFAULT '0',
  `products` text NOT NULL,
  `sum` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `tel` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `addres` varchar(100) NOT NULL,
  `message` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table coffee-break.coffee_orders: ~6 rows (приблизно)
/*!40000 ALTER TABLE `coffee_orders` DISABLE KEYS */;
INSERT IGNORE INTO `coffee_orders` (`id`, `userId`, `products`, `sum`, `name`, `surname`, `tel`, `email`, `city`, `addres`, `message`, `status`, `date`) VALUES
	(2, 20, '{"2":"15","1":6}', 8100, 'Safsadf', 'Sdfsdf', 'sdgsdgsd', 'admin@mail.ru', 'Sdfsdf', 'Улица', '', 0, '2017-01-13 18:45:20'),
	(3, 20, '{"1":2}', 200, 'Safsadf', 'Sdfsdf', 'sdgsdgsd', 'admin@mail.ru', 'Sdfsdf', '', '', 0, '2017-01-13 18:51:40'),
	(4, 20, '{"4":2}', 200, 'Safsadf', 'Sdfsdf', 'sdgsdgsd', 'admin@mail.ru', 'Sdfsdf', '', '', 0, '2017-01-14 14:39:41'),
	(5, 20, '{"4":1}', 100, 'Safsadf', 'Sdfsdf', 'sdgsdgsd', 'admin@mail.ru', 'Sdfsdf', '', '', 0, '2017-01-14 14:42:37'),
	(6, 20, '{"4":2}', 200, 'Safsadf', 'Sdfsdf', 'sdgsdgsd', 'admin@mail.ru', 'Sdfsdf', '', '', 0, '2017-01-14 14:43:27'),
	(7, 20, '{"4":2}', 200, 'Safsadf', 'Sdfsdf', 'sdgsdgsd', 'admin@mail.ru', 'Sdfsdf', '', '', 0, '2017-01-14 14:50:26'),
	(8, 20, '{"4":2}', 200, 'Safsadf', 'Sdfsdf', 'sdgsdgsd', 'admin@mail.ru', 'Sdfsdf', '', '', 0, '2017-01-14 14:50:54');
/*!40000 ALTER TABLE `coffee_orders` ENABLE KEYS */;


-- Dumping structure for таблиця coffee-break.coffee_pages
CREATE TABLE IF NOT EXISTS `coffee_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table coffee-break.coffee_pages: ~2 rows (приблизно)
/*!40000 ALTER TABLE `coffee_pages` DISABLE KEYS */;
INSERT IGNORE INTO `coffee_pages` (`id`, `alias`, `title`, `content`) VALUES
	(1, 'about', 'О нас', '<div class="about">\r\n    <div class="about-top">\r\n        <h3>Несколько слов о нас</h3>\r\n\r\n        <div class="col-lg-12 top-about">\r\n\r\n            <h5><a href="single.html">Sorda atcursus nec luctus a lore tristique orci acem. Duis ultrici es pharetra magna. Donec accum san malesuada orcinec sit amet eros.</a></h5>\r\n            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n            </p>\r\n\r\n        </div>\r\n        <div class="clearfix"> </div>\r\n    </div>\r\n    <div class="about-bottom">\r\n        <div class="col-sm-12 col-md-8 in-profile">\r\n            <h4>Кто мы?</h4>\r\n            <div class="col-in-about">\r\n                <span class="in-sed">1</span>\r\n                <div class="left-sit">\r\n                    <h6><a href="single.html">Sed ut perspiciatis unde </a></h6>\r\n                    <p>Mes cuml dia sed net lacus utenias cet inge iiqt es site.</p>\r\n                </div>\r\n                <div class="clearfix"></div>\r\n            </div>\r\n            <div class="col-in-about">\r\n                <span class="in-sed">2</span>\r\n                <div class="left-sit">\r\n                    <h6><a href="single.html">Sed ut perspiciatis unde</a></h6>\r\n                    <p>Mes cuml dia sed net lacus utenias cet inge iiqt es site.</p>\r\n                </div>\r\n                <div class="clearfix"></div>\r\n            </div>\r\n            <div class="col-in-about">\r\n                <span class="in-sed">3</span>\r\n                <div class="left-sit">\r\n                    <h6><a href="single.html">Sed ut perspiciatis unde </a></h6>\r\n                    <p>Mes cuml dia sed net lacus utenias cet inge iiqt es site.</p>\r\n                </div>\r\n                <div class="clearfix"></div>\r\n            </div>\r\n        </div>\r\n        <div class="col-sm-12 col-md-4 about-in" style="margin: 0 auto;">\r\n            <a href="single.html"><img class="img-responsive" src="/webroot/images/coffee.png" alt="" ></a>\r\n        </div>\r\n        <div class="clearfix"></div>\r\n    </div>\r\n</div>'),
	(2, 'delivery', 'Доставка', '<div class="check-out-2">\r\n    <h2>\r\n        Способы доставки\r\n    </h2>\r\n    <div class="col-sm-6 col-md-4">\r\n        <div class="to-center">\r\n        <img src="../../webroot/images/poshta.png" class="to-center">\r\n        </div>\r\n        <h3 class="to-center deliv-title">Новая почта</h3>\r\n        <p>Товар доставляется в удобное для Вас отделение «Новой Почты» по всей территории Украины. Со списком отделений и графиком работы Вы можете ознакомиться на официальном сайте Новой Почты. Доставка оплачивается клиентом по факту получения товара.</p>\r\n        <p><b>Срок доставки:</b> 1-2 дня с момента оплаты. </p>\r\n        <p><b>Стоимость:</b> 30 грн.</p>\r\n    </div>\r\n    <div class="col-sm-6 col-md-4">\r\n        <div class="to-center">\r\n            <img src="../../webroot/images/courier.png" class="to-center">\r\n        </div>\r\n        <h3 class="to-center deliv-title">Самовывоз</h3>\r\n        <p>Товар доставляется в удобное для Вас отделение «Новой Почты» по всей территории Украины. Со списком отделений и графиком работы Вы можете ознакомиться на официальном сайте Новой Почты. Доставка оплачивается клиентом по факту получения товара.</p>\r\n        <p><b>Срок доставки:</b> 1-2 дня с момента оплаты. </p>\r\n        <p><b>Стоимость:</b> бесплатно.</p>\r\n    </div>\r\n    <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-0">\r\n        <div class="to-center">\r\n            <img src="../../webroot/images/courier-2.png" class="to-center">\r\n        </div>\r\n        <h3 class="to-center deliv-title">Курьер по Киеву</h3>\r\n        <p>Товар доставляется в удобное для Вас отделение «Новой Почты» по всей территории Украины. Со списком отделений и графиком работы Вы можете ознакомиться на официальном сайте Новой Почты. Доставка оплачивается клиентом по факту получения товара.</p>\r\n        <p><b>Срок доставки:</b> 1-2 дня с момента оплаты. </p>\r\n        <p><b>Стоимость:</b> 30 грн.</p>\r\n    </div>\r\n    <div class="clearfix"></div>\r\n    <h3 class="to-center free">При заказе от 500 грн доставка бесплатная!!!</h3>\r\n</div>');
/*!40000 ALTER TABLE `coffee_pages` ENABLE KEYS */;


-- Dumping structure for таблиця coffee-break.coffee_products
CREATE TABLE IF NOT EXISTS `coffee_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `vendor` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `description` text,
  `price` int(11) DEFAULT '0',
  `discount` float DEFAULT '0',
  `is_new` int(1) DEFAULT '0',
  `in_stock` int(1) DEFAULT '1',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table coffee-break.coffee_products: ~2 rows (приблизно)
/*!40000 ALTER TABLE `coffee_products` DISABLE KEYS */;
INSERT IGNORE INTO `coffee_products` (`id`, `title`, `vendor`, `type`, `description`, `price`, `discount`, `is_new`, `in_stock`, `date`) VALUES
	(4, '1111', 'sdfsdf', 'sfdsdf', 'sdfsdf', 100, 1, 0, 1, '2017-01-14 01:00:31'),
	(5, 'ывпвып', 'ывпывп', 'ывпывпы', 'ывпывп', 1555, 1, 0, 1, '2017-01-14 01:07:03');
/*!40000 ALTER TABLE `coffee_products` ENABLE KEYS */;


-- Dumping structure for таблиця coffee-break.coffee_users
CREATE TABLE IF NOT EXISTS `coffee_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `tel` varchar(30) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(50) DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- Dumping data for table coffee-break.coffee_users: ~1 rows (приблизно)
/*!40000 ALTER TABLE `coffee_users` DISABLE KEYS */;
INSERT IGNORE INTO `coffee_users` (`id`, `email`, `password`, `name`, `surname`, `tel`, `city`, `date`, `role`) VALUES
	(20, 'admin@mail.ru', '4ebdd07ee050ca38757cb020f41488a3', 'Safsadf', 'Sdfsdf', 'sdgsdgsd', 'Sdfsdf', '2017-01-09 16:43:00', 'admin');
/*!40000 ALTER TABLE `coffee_users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
