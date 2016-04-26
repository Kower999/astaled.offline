REPLACE INTO `new_configuration` (`name`, `value` ) VALUES  ('PS_ONLINE_CHECK','0');
ALTER TABLE `new_order_detail` ADD `cena_2` decimal(17,2) NOT NULL DEFAULT '0.00';
ALTER TABLE `new_order_detail` ADD `provizia` decimal(17,2) NOT NULL DEFAULT '0.00';
