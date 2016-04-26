DROP TABLE IF EXISTS `new_customer_visit`;

CREATE TABLE IF NOT EXISTS `new_address_visit` (
  `id_address_visit` int(11) NOT NULL AUTO_INCREMENT,
  `id_address` int(11) NOT NULL,
  `visit` datetime DEFAULT NULL,
  `dovod` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_address_visit`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
