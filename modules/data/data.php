<?php
 
if (!defined('_PS_VERSION_'))
	exit;

class Data extends Module {
    
    public $classes = array('Provisions','Imports','VIPPrices','PSWebServiceLibrary','Online','MnozstvoSkladom','StockUpdate','StockAvailableLog','ImportovaneVydajky'/*,'RecyPop'*/);
    
    /**
     * ParentTab => array (
     *      ClassName => TabName
     * )
     **/       
    public $mytabs = array(
        'AdminTools' =>  array(
            'Update' => array(
                'name'      =>  'Aktualizácia systému',
                'online'    =>  false,
                'offline'   =>  true
                ),
            'UploadStockUpdate' => array(
                'name'      =>  'Upload výdajky pre OZ',
                'online'    =>  true,
                'offline'   =>  false
                ),
            'Settings' => array(
                'name'      =>  'Nastavenia',
                'online'    =>  true, 
                'offline'   =>  true
                ),
            'AllStockUpdate' => array(
                'name'      =>  'Evidencia výdajok',
                'online'    =>  true, 
                'offline'   =>  false
                ),
            'ImportovaneVydajky' => array(
                'name'      =>  'Importované výdajky',
                'online'    =>  true, 
                'offline'   =>  false
                ),
            ),
            
        'AdminParentOrders' =>  array(
            'ExportOrders'  =>  array(
                'name'      =>  'Export Objednávok', 
                'online'    =>  false, 
                'offline'   =>  true
                ),
            'ParovaniePlatieb'  =>  array(
                'name'      =>  'Párovanie Platieb', 
                'online'    =>  true, 
                'offline'   =>  false   // potom prepnut na false po dokoncni ..
                ),
            ),
        'AdminCatalog' =>  array(
			'Provisions' => array(
                'name'      =>  'Provízie',
                'online'    =>  true, 
                'offline'   =>  true
                ),
			'VIPPrices' => array(
                'name'      =>  'VIP Ceny a Provízie',
                'online'    =>  true, 
                'offline'   =>  true
                ),
			'ExportProducts' => array(
                'name'      =>  'Export Produktov',
                'online'    =>  true, 
                'offline'   =>  false
                ),
			'ImportProducts' => array(
                'name'      =>  'Aktualizácia produktov',
                'online'    =>  false, 
                'offline'   =>  true
                ),
            'StockUpdate' => array(
                'name'      =>  'Import výdajky',
                'online'    =>  false, 
                'offline'   =>  true
                ),
            'MnozstvoSkladom' => array(
                'name'      =>  'Sklady OZ',
                'online'    =>  true, 
                'offline'   =>  true
                ),
            ),
        'AdminParentStats' =>  array(
			'Statistika1' => array(
                'name'      =>  'Štatistika energizer',
                'online'    =>  true, 
                'offline'   =>  true),
			'Odrobene' => array(
                'name'      =>  'Odrobené dni OZ',
                'online'    =>  true, 
                'offline'   =>  false),
			'MapaPredajov' => array(
                'name'      =>  'Mapa Predajov',
                'online'    =>  true, 
                'offline'   =>  true),
        ),
        
    );
    
    public $oz_tab_access = array(
        'AdminTools' =>  array(
            'Update' => array('view', 'add', 'edit', 'delete'),
            'Settings' => array('view', 'add', 'edit', 'delete'),
/*			'ImportovaneVydajky' => array('view'),*/
        ),
        'AdminParentOrders' =>  array(
            'ExportOrders' => array('view', 'add', 'edit', 'delete'),
        ),
        'AdminCatalog' =>  array(
			'Provisions' => array('view'),
			'VIPPrices' => array('view'),
			'ImportProducts' => array('view', 'add', 'edit', 'delete'),
            'StockUpdate' => array('view', 'add', 'edit', 'delete'),
            'MnozstvoSkladom' => array('view'),            
        ),
        'AdminParentStats' =>  array(
			'Statistika1' => array('view'),
            'MapaPredajov' => array('view', 'add', 'edit', 'delete')
        ),
        
    );
    
	
	public function __construct() {	

        foreach($this->classes as $cls){
		  $classFile = dirname(__FILE__).'/classes/'.$cls.'.php';            
		  include_once $classFile;
        }
	   
       
		$this->name = 'data';
		parent::__construct();
		
		$this->tab = 'export';
		$this->version = '1.0';
		$this->author = 'Peter Kovac';
        $this->className = 'Data';

		$this->displayName = $this->l('Data transfer modul');
		$this->description = $this->l('Modul pre export a import dát.');
		$this->confirmUninstall = $this->l('Are you sure you want to delete your details ?');
		
		$this->_errors = array();
		$this->error = false;

        $this->tables[_DB_PREFIX_.'product_provisions'] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'product_provisions` (
			  `id_product_provisions` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			  `id_product` int(11) NOT NULL,
			  `cena_2` decimal(20,6) ,
			  `provizia` decimal(20,6)
			) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';

        $this->tables[_DB_PREFIX_.'data_import'] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'data_import` (
			  `id_data_import` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			  `id_employee` int(11),
			  `key` varchar(25),
			  `exported` int(11),
			  `imported` int(11)
			) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';
            
        $this->tables[_DB_PREFIX_.'product_vip_prices'] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'product_vip_prices` (
			  `id_product_vip_prices` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			  `id_product` int(11) NOT NULL,
			  `id_group` int(11) NOT NULL,
			  `z_cena` decimal(20,6) ,
			  `cena_2` decimal(20,6) ,
			  `provizia` decimal(20,6)
			) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';
      
        $this->tables[_DB_PREFIX_.'mnozstvo_skladom'] = 'CREATE TABLE IF NOT EXISTS `new_mnozstvo_skladom` (
                `id_mnozstvo_skladom` int(10) unsigned NOT NULL AUTO_INCREMENT,
                `id_employee` int(10) unsigned DEFAULT NULL,
                `id_product` int(10) unsigned DEFAULT NULL,
                `id_product_attribute` int(10) unsigned DEFAULT NULL,
                `quantity` int(11) DEFAULT NULL,
                PRIMARY KEY (`id_mnozstvo_skladom`)
            ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';
        $this->tables[_DB_PREFIX_.'stock_update'] = 'CREATE TABLE IF NOT EXISTS `new_stock_update` (
                `id_stock_update` int(10) unsigned NOT NULL AUTO_INCREMENT,
                `id_employee` int(10) unsigned DEFAULT NULL,
                `cislo` varchar(255) DEFAULT NULL,
                `subor` varchar(255) DEFAULT NULL,
                `imported` int(10) unsigned DEFAULT NULL,
                PRIMARY KEY (`id_stock_update`)
            ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';

        $this->tables[_DB_PREFIX_.'importovane_vydajky'] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'importovane_vydajky` (
			  `id_importovane_vydajky` int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
			  `id_stock_update` int(11) unsigned NOT NULL,
			  `ean` varchar(20) NOT NULL,
			  `imported` int(11)
			) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';
            
        $this->tables[_DB_PREFIX_.'stock_available_log'] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'stock_available_log` (
                `id_stock_available_log` int(10) unsigned NOT NULL AUTO_INCREMENT,
                `id_employee` int(10) unsigned DEFAULT NULL,
                `action_name` varchar(255) NOT NULL,
                `action_done_by_id_employee` int(10) unsigned NOT NULL,
                `action_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `sa_from` int(11) NOT NULL,
                `sa_to` int(11) NOT NULL,
                `sa_change` int(11) NOT NULL,
                `id_product` int(10) unsigned DEFAULT NULL,
                `id_product_attribute` int(10) unsigned DEFAULT 0,
                PRIMARY KEY (`id_stock_available_log`)
                ) ENGINE='._MYSQL_ENGINE_.'  DEFAULT CHARSET=utf8;';    
/*            
        $this->tables[_DB_PREFIX_.'product_recypop'] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'product_recypop` (
            `id_recypop`  int UNSIGNED NOT NULL AUTO_INCREMENT ,
            `id_product`  int UNSIGNED NULL ,
            `id_poplatok`  int UNSIGNED NULL ,
            PRIMARY KEY (`id_recypop`)
            );';
            
        $this->tables[_DB_PREFIX_.'poplatky'] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'poplatky` (
            `id_poplatok`  int UNSIGNED NOT NULL AUTO_INCREMENT ,
            `popis`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
            `suma`  decimal(10,2) NULL ,
            PRIMARY KEY (`id_poplatok`)
            );';
*/            
//$this->registerHook('actionUpdateQuantity');
	}

	public function install() {
		if(!parent::install() OR !$this->installDatabase() OR !$this->createMenu() OR !$this->registerHook('actionUpdateQuantity') /*OR !$this->registerHook('actionCustomerAccountAdd')*/)
			return false;
        $this->setMenuAccess();            
		return true;
	}
	
	public function uninstall() {
		if(!parent::uninstall() OR !$this->uninstallDatabase() OR !$this->deleteMenu())
			return false;
		return true;
	}

	public function hookActionUpdateQuantity($params)
	{
	   if(!empty($params)) {
	       extract($params);	       
	   } else {
	       return ;
	   }
       
       if(isset($this->context->controller->controller_myaction)){
            $action = $this->context->controller->controller_myaction;                
       } else {
            $action = $this->context->controller->controller_name;        
       }
       
       $sal = new StockAvailableLog();
       $sal->action_done_by_id_employee = $this->context->employee->id;
       $sal->action_name = $action;
       $sal->action_date = date("Y-m-d H:i:s");
       $sal->sa_from = $before;
       $sal->sa_to = $after;
       $sal->sa_change = $change;
       $sal->id_product = $id_product;
       $sal->id_product_attribute = $id_product_attribute;
       $sal->save();
	}
    	
	public function installDatabase()
	{
		$return = true;
		$sql = $this->tables;
        if(!empty($sql)){
		  foreach ($sql as $s)
			$return &= Db::getInstance()->execute($s);            
//          $this->fillDatabase();
        }            
		return $return;
	}
	
	public function uninstallDatabase()
	{
//		$sql = $this->tables;
        if(!empty($sql))
		  foreach ($sql as $name => $v)
			Db::getInstance()->execute('DROP TABLE IF EXISTS '.$name);
		return true;
	}

	public function createMenu() {
		$res = true;
        
        $tabs = $this->mytabs;
        
        $isonline = (bool)Configuration::get('PS_ONLINE_CHECK');
        
        if(!empty($tabs))
            foreach($tabs AS $parent => $childs){
                $mainTab = Tab::getInstanceFromClassName($parent);
                if(!empty($childs))
                    foreach($childs as $className => $submenu){
                        $submenuName = $this->createMultiLangField($submenu['name']);
                        if($isonline){
                            if($submenu['online']){
                                $res &= $this->createSubmenu($mainTab->id, $submenuName, $className);
                            }                
                        } else {
                            if($submenu['offline']){
                                $res &= $this->createSubmenu($mainTab->id, $submenuName, $className);
                            }                                            
                        }
                                                
                    }                
            }    
		return $res;
	}

	public function setMenuAccess() {
		$res = true;
        
        $tabs = $this->mytabs;

        $isonline = (bool)Configuration::get('PS_ONLINE_CHECK');
        
        if(!empty($tabs))
            foreach($tabs AS $parent => $childs){
                if(!empty($childs))
                    foreach($childs as $className => $submenu){
                                $subTab = Tab::getInstanceFromClassName($className);

                                $id_tab = $subTab->id;
                                $query = 'REPLACE INTO `'._DB_PREFIX_.'access` (`id_profile`, `id_tab`, `view`, `add`, `edit`, `delete`) VALUES ';
                                $query .= '(1, '.(int)$id_tab.', 1, 1, 1, 1), ';
                                
                                if($isonline){
                                    if($submenu['online']){
			                            $query .= '( 5, '.(int)$id_tab.', 0, 0, 0, 0)';
	 	                                Db::getInstance()->execute($query);                                        
                                    }                
                                } else {
                                    if($submenu['offline']){
	 	 	                            $rights = isset($this->oz_tab_access[$parent][$className])? $this->oz_tab_access[$parent][$className] : array();
			                            $query .= '( 5, '.(int)$id_tab.', '.(int)in_array('view',$rights).', '.(int)in_array('add',$rights).', '.(int)in_array('edit',$rights).', '.(int)in_array('delete',$rights).')';
	 	                                Db::getInstance()->execute($query);                                        
                                    } else {
			                            $query .= '( 5, '.(int)$id_tab.', 0, 0, 0, 0)';
	 	                                Db::getInstance()->execute($query);                                                                                
                                    }                                            
                                }
                                
                                                    
                    }                
            }    
        
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
		} elseif(($subTab->id_parent != $parentId) || ($subTab->name[7] != $menuName[7])) {
			$subTab->id_parent = $parentId;
			$subTab->name = $this->createMultiLangFieldHard($menuName);
			return $subTab->save();
		}
		return true;
	}
	
	private function deleteMenu() {
		$tabs = $this->mytabs;
		
		$res = true;
	
        if(!empty($tabs))
            foreach($tabs AS $parent => $childs){
                if(!empty($childs))
                    foreach($childs as $className => $menuName){
			            $res &= $this->deleteSubmenu($className);
                    }                
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