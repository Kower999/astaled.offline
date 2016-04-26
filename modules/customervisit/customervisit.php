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

if (!defined('_PS_VERSION_'))
	exit;

class Customervisit extends Module {
	
	public function __construct() {	

		$classFile = dirname(__FILE__).'/classes/Visits.php';
		include_once $classFile;
	   
       
		$this->name = 'customervisit';
		parent::__construct();
		
		$this->tab = 'administration';
		$this->version = '1.0';
		$this->author = 'Peter Kovac';
        $this->className = 'Customervisit';

		$this->displayName = $this->l('Customer Visit modul');
		$this->description = $this->l('Modul pre spravovanie návštev zákazníkov.');
		$this->confirmUninstall = $this->l('Are you sure you want to delete your details ?');
		
		$this->_errors = array();
		$this->error = false;
	}

	public function install() {
		if(!parent::install() OR !$this->installDatabase() OR !$this->createMenu() /*OR !$this->registerHook('actionCustomerAccountAdd')*/)
			return false;
		return true;
	}
	
	public function uninstall() {
		if(!parent::uninstall() OR !$this->uninstallDatabase() /*OR !Configuration::deleteByName('OBSEGOI_API_KEY')*/ OR !$this->deleteMenu())
			return false;
		return true;
	}
	
	public function installDatabase()
	{
		$return = true;
		$sql = array();
        
        $sql[_DB_PREFIX_.'address_visit'] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'address_visit` (
			  `id_address_visit` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			  `id_address` int(11) NOT NULL,
			  `visit` datetime,
              `dovod` varchar(255) 
			) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';
        
		foreach ($sql as $s)
			$return &= Db::getInstance()->execute($s);
		return $return;
	}
	
	public function uninstallDatabase()
	{
		$sql = array();        
        $sql[_DB_PREFIX_.'address_visit'] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'address_visit` (
			  `id_address_visit` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			  `id_address` int(11) NOT NULL,
			  `visit` datetime, 
              `dovod` varchar(255) 
			) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';
		foreach ($sql as $name => $v)
			Db::getInstance()->execute('DROP TABLE IF EXISTS '.$name);
		return true;
	}

	private function createMenu() {
        
        $res = true;
        $catalog = Tab::getInstanceFromClassName('AdminParentCustomer');
        $res &= $this->createSubmenu($catalog->id, $this->createMultiLangField('Návštevy'), 'Visits');
		
		return $res;
	}
	
	private function createSubmenu($parentId, $menuName, $className) {
		$subTab = Tab::getInstanceFromClassName($className);
		if(!Validate::isLoadedObject($subTab)) {
			$subTab->active = 1;
			$subTab->class_name = $className;
			$subTab->id_parent = $parentId;
			$subTab->module = $this->name;
			$subTab->name = $this->createMultiLangFieldHard($menuName);
			return $subTab->save();
		} elseif($subTab->id_parent != $parentId) {
			$subTab->id_parent = $parentId;
			return $subTab->save();
		}
		return true;
	}
	
	private function deleteMenu() {

		$subtabs = array(
			'Visits',
		);
		
		$res = true;
	
		if($subtabs)
		foreach($subtabs as $className) {
			$res &= $this->deleteSubmenu($className);
		}
		return $res;
	}
	
	private function deleteSubmenu($className) {
		$subTab = Tab::getInstanceFromClassName($className);
		return $subTab->delete();
	}
	
	public function getContent() {
	
		$output = '';
		return $this->display($this->name, 'views/templates/admin/config.tpl');
	}
	
	private function assign($key, $value) {
		$this->smarty->assign($key, $value);
	}

	private static function createMultiLangField($field)
	{
		$languages = Language::getLanguages(false);
		$res = array();
		foreach ($languages as $lang)
			$res[$lang['id_lang']] = $field;
		return $res;
	}
	
	private static function createMultiLangFieldHard($res)
	{
		$languages = Language::getLanguages(false);
		foreach ($languages as $lang)
		{	
			if(!array_key_exists($lang['id_lang'], $res))
				$res[$lang['id_lang']] = $res['1'];
		}
		return $res;
	}
	
}

?>