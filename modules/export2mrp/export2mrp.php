<?php
if (!defined('_PS_VERSION_'))
  exit;
 
class Export2MRP extends Module
{
  public function __construct()
  {
    $this->name = 'export2mrp';
    $this->tab = 'export';
    $this->version = '1.0.1';
    $this->author = 'Peter Kovac';
    $this->controllerClass = 'MRPExport'; 
    
    $this->need_instance = 0;
//    $this->ps_versions_compliancy = array('min' => '1.5', 'max' => _PS_VERSION_); 
    $this->bootstrap = true;
 
    parent::__construct();
 
    $this->displayName = $this->l('Export pre MRP');
    $this->description = $this->l('Modul pre export faktúr a príslušných dát.');
 
    $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
 
    if (!Configuration::get('Export2MRP_ver'))      
      $this->warning = $this->l('No version found');
  }
  
  public function install()
  {
    if (Shop::isFeatureActive())
        Shop::setContext(Shop::CONTEXT_ALL);
 
    if (!parent::install()
        || !Configuration::updateValue('Export2MRP_ver', $this->version)
	    || !$this->registerHook('displayHeader')
        )    
        return false;
 
    $this->addTab();    

    return true;
  }

    public function uninstall()
  {
    $this->removeTab();
    if (!parent::uninstall() ||
        !Configuration::deleteByName('Export2MRP_ver')
    )
        return false;
 
    return true;
  }
  
	protected function addTab()
	{
		$this->installerData['rollback'][] = 'removeTab';
		$id_parent = Tab::getIdFromClassName('AdminOrders');
		if (!$id_parent)
			throw new RuntimeException(sprintf($this->l('Failed to add the module into the main BO menu.')).' : '.Db::getInstance()->getMsgError());
		$tabNames = array();
		foreach (Language::getLanguages(false) as $lang)
			$tabNames[$lang['id_lang']] = $this->displayName;
		$tab = new Tab(); 
		$tab->class_name = $this->controllerClass;
		$tab->name = $tabNames;
		$tab->module = $this->name;
		$tab->id_parent = $id_parent;
		if (!$tab->save())
			throw new RuntimeException($this->l('Failed to add the module into the main BO menu.'));
	}
	protected function removeTab()
	{
		if (!Tab::getInstanceFromClassName($this->controllerClass)->delete())
			throw new RuntimeException($this->l('Failed to remove the module from the main BO menu.'));
	}
    
	public function hookDisplayHeader($params)
	{
		$this->context->controller->addCSS($this->_path.'export2mrp.css', 'all');
		return $this->display(__FILE__, 'export2mrp-header.tpl');        
	}
    
  
}
