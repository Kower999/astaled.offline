DROP TABLE IF EXISTS `new_order_state`;
CREATE TABLE `new_order_state` (
  `id_order_state` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice` tinyint(1) unsigned DEFAULT '0',
  `send_email` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `module_name` varchar(255) DEFAULT NULL,
  `color` varchar(32) DEFAULT NULL,
  `unremovable` tinyint(1) unsigned NOT NULL,
  `hidden` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `logable` tinyint(1) NOT NULL DEFAULT '0',
  `delivery` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `shipped` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `paid` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_order_state`),
  KEY `module_name` (`module_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records 
-- ----------------------------
INSERT INTO `new_order_state` VALUES ('1','0','0','cheque','RoyalBlue','1','0','0','0','0','0','0'), ('2','1','0','','LimeGreen','1','0','0','1','1','1','0'), ('3','1','0','','DarkOrange','1','0','0','1','1','0','0'), ('4','1','0','','BlueViolet','1','0','0','1','1','0','0'), ('5','0','0','','#108510','1','0','0','1','1','0','0'), ('6','0','0','','Crimson','1','0','0','0','0','0','0'), ('7','0','0','','#ec2e15','1','0','0','0','0','0','0'), ('8','0','0','','#8f0621','1','0','0','0','0','0','0'), ('9','0','0','','HotPink','1','0','0','0','0','0','0'), ('10','1','0','bankwire','RoyalBlue','1','0','0','1','1','0','0'), ('11','0','0','','RoyalBlue','1','0','0','0','0','0','0'), ('12','1','0','','LimeGreen','1','0','0','1','1','1','0'), ('13','1','0','','#f34300','0','0','0','0','0','1','0'), ('14','1','0','','#e16800','0','0','0','1','1','0','0'), ('15','1','0','','#660089','0','0','0','1','1','0','0'), ('16','1','0','','#0007bd','0','0','0','1','1','0','0'), ('17','1','0','','LimeGreen','0','0','0','1','1','1','0');
