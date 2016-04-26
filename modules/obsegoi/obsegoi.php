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

class OBSEgoi extends Module {
	
	public function __construct() {	
		$this->name = 'obsegoi';
		parent::__construct();
		
		$this->tab = 'advertising_marketing';
		$this->version = '1.2';
		$this->author = 'OBSolutions.es';
		$this->module_key = '2b274c67f2adb4dd8479261423fe02b3';

		$this->displayName = $this->l('E-goi - Email Marketing and SMS Automation');
		$this->description = $this->l('The most comprehensive and automated PrestaShop Addon for SMS / Email Marketing. ');
		$this->confirmUninstall = $this->l('Are you sure you want to delete your details ?');
		include_once 'install.php';
		
		$this->_errors = array();
		$this->error = false;
		
		/* Backward compatibility */
		if (version_compare(_PS_VERSION_,'1.5','<'))
			require(_PS_MODULE_DIR_.$this->name.'/backward_compatibility/backward.php');
		
		spl_autoload_register(array($this, 'autoload'));
		
		try {
			smartyRegisterFunction($this->context->smarty, 'function', 'obs_l', array($this, 'getTranslation'));
		} catch (SmartyException $se) {
			//tag already registered
			//PS 1.5 or higher
		} catch (Exception $se) {
			//tag already registered
			//PS 1.4
		}
	}
	
	public function autoload($classname) {
		$classFile = dirname(__FILE__).'/classes/'.$classname.'.php';
		if(is_file($classFile))
			include_once $classFile;
	}

	public function install() {
		if(!parent::install() OR !$this->installDatabase() OR !$this->createMenu() OR !$this->registerHook('actionCustomerAccountAdd'))
			return false;
		return true;
	}
	
	public function uninstall() {
		if(!parent::uninstall() OR !$this->uninstallDatabase() OR !Configuration::deleteByName('OBSEGOI_API_KEY') OR !$this->deleteMenu())
			return false;
		return true;
	}
	
	public function installDatabase()
	{
		$return = true;
		$sql = array();
		include(dirname(__FILE__).'/installSQL.php');
		foreach ($sql as $s)
			$return &= Db::getInstance()->execute($s);
		return $return;
	}
	
	public function uninstallDatabase()
	{
		include(dirname(__FILE__).'/installSQL.php');
		foreach ($sql as $name => $v)
			Db::getInstance()->execute('DROP TABLE IF EXISTS '.$name);
		return true;
	}
	
	//HOOK
	public function hookActionCustomerAccountAdd($params)
	{
		$customer = $params['newCustomer'];
		
		$id_lang = $customer->id_lang;
		$id_shop = $customer->id_shop;
		
		$lists = OBSEgoiList::getLists($id_lang, $id_shop);
		
		foreach($lists as $list)
		{
			//API
			$api = new EgoiAPI();
			
			$extraFields = array();
			if($list['id_extra_newsletter_check'])
				$extraFields['extra_'.$list['id_extra_newsletter_check']] = ($customer->newsletter)? $customer->newsletter:'0';
			
			$id_egoi_customer = $api->addSubscriber($customer, $list['id_egoi'], $extraFields);
			
			//TABLE SUBSCRIBERS
			$subscriber = new OBSEgoiSubscriber();
			$subscriber->sub_customer_id = $customer->id;
			$subscriber->sub_egoi_uid = $id_egoi_customer;
			$subscriber->sub_list_id = $list['id_obsegoi_lists'];
			$subscriber->sub_is_subscribed = ($customer->newsletter)? $customer->newsletter:'0';
			$subscriber->sub_dateadd = date('Y-m-d H:i:s');
			
			$subscriber->save();
			
			//TABLE LISTS
			$list = new OBSEgoiList($list['id_obsegoi_lists']);
			$list->subs_num = (int) $list->subs_num  + 1;
			$list->update();
			
		}
		
	}
	
	private function createMenu() {
		$mainTab = Tab::getInstanceFromClassName('OBSEgoi');
		
		$subtabs = array(
			'MyAccountOBSEgoi' => array('3' => 'Mi Cuenta', '1' => 'My Account'),
			'MyListsOBSEgoi' => array('3' => 'Mis Listas', '1' => 'My Lists'),
			'ImportListsOBSEgoi' => array('3' => 'Importar listas de E-goi', '1' => 'Import Lists from E-goi'),
			/*'SubscribersOBSEgoi' => 'Subscribers',*/
		);
		
		$res = true;
		
		if(!Validate::isLoadedObject($mainTab)) {
			$mainTab->active = 1;
			$mainTab->class_name = 'OBSEgoi';
			$mainTab->id_parent = 0;
			$mainTab->module = $this->name;
			$mainTab->name = $this->createMultiLangField('E-goi');
			$res &= $mainTab->save();
			$mainTab = Tab::getInstanceFromClassName('OBSEgoi');
		}
		
		if($subtabs)
		foreach($subtabs as $className => $menuName) {
			$res &= $this->createSubmenu($mainTab->id, $menuName, $className);
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
		} elseif($subTab->id_parent != $parentId) {
			$subTab->id_parent = $parentId;
			return $subTab->save();
		}
		return true;
	}
	
	private function deleteMenu() {
		$mainTab = Tab::getInstanceFromClassName('OBSEgoi');
		
		$subtabs = array(
			'MyAccountOBSEgoi',
			'MyListsOBSEgoi',
			'ImportListsOBSEgoi',
			/*'SubscribersOBSEgoi',*/
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
 	 	if (!extension_loaded('soap')){
 	 		
 	 		$output .= '<fieldset>
 	 					<p><b>'.$this->l('PHP SOAP LIBRARY:').'</b> <span style="color: red">'.$this->l('NOT LOADED').'</span></p>
 	 					<p>'.$this->l('Your website sever has not loaded PHP SOAP library required to use integration with E-goi Email Marketing.').'</p>
 	 					<p>'.$this->l('Please ask your server\'s administrator who will install the PHP SOAP library.').'</p>
 	 					</fieldset>';
 	 		return $output;
 	 	} else {
			$error_msg = '';
	 	 	if (Tools::getIsset('submitUpdate')) {
	 	 		if (Tools::getValue('obsegoi_api_key') == NULL)
					$this->_errors[] = $this->l('Indicate API key.');
					
	 	 		if (!sizeof($this->_errors))
				{
					Configuration::updateValue('OBSEGOI_API_KEY', (Tools::getValue('obsegoi_api_key')));
					$output = $this->displayConfirmation($this->l('Settings updated'));
				}
				else{
					foreach ($this->_errors AS $error)
						$error_msg .= $error.'<br />';
					$error_msg =  $this->displayError($error_msg);
				}
	 	 	}
	 	 	
			$this->assign('obs_egoi_error_message', $error_msg);
			$this->assign('obs_egoi_has_error', $this->error);
			
			$this->assign('obsShowApiKeyWarn', Configuration::get('OBSEGOI_API_KEY')?false:true);
			$this->assign('obs_egoi_title', $this->displayName);
			$this->assign('obs_egoi_version', $this->version);
			
			return $this->display($this->name, 'views/templates/admin/config.tpl');
 	 	}
	}
	
	private function assign($key, $value) {
		$this->smarty->assign($key, $value);
	}
	
	public function getTranslation($params, &$smarty) {
		$trans = array(
			'CLIENTE_ID' => $this->l('Client Id'),
			'COMPANY_NAME' => $this->l('Company Name'),
			'COMPANY_LEGAL_NAME' => $this->l('Company Legal Name'),
			'COMPANY_TYPE' => $this->l('Company Type'),
			'BUSINESS_ACTIVITY_CODE' => $this->l('Business Activity Code'),
			'DATE_REGISTRATION' => $this->l('Date Registration'),
			'COUNTRY' => $this->l('Country'),
			'STATE' => $this->l('State'),
			'CITY' => $this->l('City'),
			'ADDRESS' => $this->l('Address'),
			'WEBSITE' => $this->l('Website'),
			'SIGNUP_DATE' => $this->l('Signup Date'),
			'CREDITS' => $this->l('Credits'),
		);
		
		$key = $params['l'];
		
		if(array_key_exists($key, $trans))
			return $trans[$key];
		else
			return $key;
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