<?php
 /**
 * 
 *  2011-2013 OBSolutions S.C.P.  
 *  All Rights Reserved.
 * 
 * NOTICE:  All information contained herein is, and remains
 * the property of OBSolutions S.C.P. and its suppliers,
 * if any.  The intellectual and technical concepts contained
 * herein are proprietary to OBSolutions S.C.P.
 * and its suppliers and are protected by trade secret or copyright law.
 * Dissemination of this information or reproduction of this material
 * is strictly forbidden unless prior written permission is obtained
 * from OBSolutions S.C.P.
 */

$sql = array();
$sql[_DB_PREFIX_.'obsegoi_lists'] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'obsegoi_lists` (
			  `id_obsegoi_lists` int(11) NOT NULL AUTO_INCREMENT,
			  `id_egoi` int(11) NOT NULL,
			  `id_extra_newsletter_check` int(11) NOT NULL,
			  `name` varchar(255) NOT NULL,
			  `name_ref` varchar(255) NOT NULL,
			  `subs_num` int(11) NOT NULL,
			  `group` varchar(255) NOT NULL,
			  `iso_lang` varchar(255) NOT NULL,
			  PRIMARY KEY (`id_obsegoi_lists`)
			) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';

$sql[_DB_PREFIX_.'obsegoi_lists_shop'] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'obsegoi_lists_shop` (
			  `id_obsegoi_lists` int(11) NOT NULL,
			  `id_shop` int(11) NOT NULL,
			  PRIMARY KEY (`id_obsegoi_lists`, `id_shop`)
			) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';

$sql[_DB_PREFIX_.'obsegoi_subscribers'] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'obsegoi_subscribers` (
			  `sub_customer_id` int(11) NOT NULL,
			  `sub_egoi_uid` varchar(32) NOT NULL,
			  `sub_list_id` int(11) NOT NULL,
			  `sub_is_subscribed` char(1) NOT NULL,
			  `sub_dateadd` datetime NOT NULL,
			  PRIMARY KEY (`sub_egoi_uid`)
			) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';