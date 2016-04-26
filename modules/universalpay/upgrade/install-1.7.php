<?php
// Sample file for module update
 
if (!defined('_PS_VERSION_'))
  exit;
 
// object module ($this) available
function upgrade_module_1_7($object)
{
  return (
	  $object->registerHook('displayOrderDetail')&&
		  Db::getInstance()->Execute("CREATE TABLE `"._DB_PREFIX_."universalpay_system_group` (
			  `id_universalpay_system` int(10) unsigned NOT NULL,
			  `id_group` int(10) unsigned NOT NULL,
			  UNIQUE KEY `id_universalpay_system` (`id_universalpay_system`,`id_group`)
			) ENGINE="._MYSQL_ENGINE_." DEFAULT CHARSET=utf8")
	);
}
