--
-- Database: guida-tv
--

--
-- Table structure for table `stations`
--
CREATE TABLE `stations` (
  `intIdStation` int(11) NOT NULL AUTO_INCREMENT,
  `strName` varchar(50) NOT NULL,
  `boolDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`intIdStation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `stations` (`intIdStation`, `strName`, `boolDelete`) VALUES
  (1,'Rai',0),
  (2,'Mediaset',0),
  (3,'Sky',0);

--
-- Table structure for table `channels`
--
CREATE TABLE `channels` (
  `strIdChannel` varchar(15) NOT NULL,
  `intIdStation` int(11) NOT NULL,
  `strIdChannelStation` varchar(15) NOT NULL,
  `strName` varchar(50) NOT NULL,
  `intChannelNumber` int(11) DEFAULT NULL,
  `boolDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`strIdChannel`),
  FOREIGN KEY (`intIdStation`) REFERENCES `stations`(`intIdStation`),
  UNIQUE (`strIdChannelStation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `channels` (`strIdChannel`, `intIdStation`, `strIdChannelStation`, `strName`, `intChannelNumber`, `boolDelete`) VALUES
	('boing',2,'KB','Boing',40,0),
	('canale-5',2,'C5','Canale 5',5,0),
	('cartoon-network',3,'9693','Cartoon Network',607,0),
	('cartoonito',2,'LA','Cartoonito',46,0),
	('cielo-hd',3,'8133','Cielo HD',26,0),
	('cine-34',2,'B6','Cine 34',34,0),
	('discovery-channel',3,'9059','Discovery Channel',401,0),
	('dmax',3,'8933','DMAX',52,0),
	('focus',2,'FU','Focus',35,0),
	('fox',3,'9077','Fox',112,0),
	('fox-crime',3,'9074','Fox Crime',116,0),
	('frisbee',3,'6610','Frisbee',44,0),
	('giallo',3,'9234','Giallo',38,0),
	('hisotry',3,'9101','History',407,0),
	('iris',2,'KI','Iris',22,0),
	('italia-1',2,'I1','Italia 1',6,0),
	('italia-2',2,'I2','Italia 2',32,0),
	('k2',3,'6240','K2',41,0),
	('la-5',2,'KA','La5',30,0),
	('la-7',3,'8329','La7',7,0),
	('national-geographic',3,'9098','National Geographic',403,0),
	('nove',3,'9753','Nove',9,0),
	('rai-1',1,'rai-1','Rai 1',1,0),
	('rai-2',1,'rai-2','Rai 2',2,0),
	('rai-3',1,'rai-3','Rai 3',3,0),
	('rai-4',1,'rai-4','Rai 4',21,0),
	('rai-5',1,'rai-5','Rai 5',23,0),
	('rai-gulp',1,'rai-gulp','Rai Gulp',42,0),
	('rai-movie',1,'rai-movie','Rai Movie',24,0),
	('rai-news-24',1,'rai-news-24','Rai News 24',48,0),
	('rai-premium',1,'rai-premium','Rai Premium',25,0),
	('rai-sport',1,'rai-sport','Rai Sport',57,0),
	('rai-storia',1,'rai-storia','Rai Storia',54,0),
	('rai-yoyo',1,'rai-yoyo','Rai Yoyo',43,0),
	('real-time',3,'8173','Real Time',31,0),
	('rete-4',2,'R4','Rete 4',4,0),
	('sky-1',3,'9115','Sky Uno',108,0),
	('sky-tg-24',3,'9313','SkyTG24',50,0),
	('super',3,'6460','Super!',47,0),
	('tgcom24',2,'KF','TGCom24',51,0),
	('top-crime',2,'LT','Top Crime',39,0),
	('tv-8',3,'8195','TV8',8,0),
	('venti',2,'LB','20',20,0);

--
-- Table structure for table `users`
--
CREATE TABLE `users` (
  `intIdUser` int(11) NOT NULL AUTO_INCREMENT,
  `strName` varchar(50) NOT NULL,
  `strEmail` varchar(50) NOT NULL,
  `strProjectName` varchar(100) NOT NULL,
  `strProjectDescription` text,
  `strApiKey` varchar(22) NOT NULL,
  `dtaLastUsage` datetime DEFAULT NULL,
  `dtaData` datetime DEFAULT CURRENT_TIMESTAMP,
  `boolDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`intIdUser`),
  UNIQUE(`strApiKey`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

---
