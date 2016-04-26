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
class EgoiAPI {
	
    const PLUGIN_KEY = 'b304e2bc78f91213336744c8f419eab0'; //MODULESHOP
	//const PLUGIN_KEY = '62ac6dc8bb834852881327c5721e12bf'; //PRESTASHOP ADDONS
    const API_URL = 'http://api.e-goi.com/v2/soap.php?wsdl';
    public $apiKey;
    /** SOAP CLIENT INSTANCE **/
    private $_c;
    
    public function __construct() {
    	$this->apiKey = Configuration::get('OBSEGOI_API_KEY');
    	$this->_c = new SoapClient(self::API_URL, array("user_agent" => "Mozilla/5.0 (Windows NT 6.1; rv:12.0) Gecko/20120403211507 Firefox/12.0"));
    }
	
	public function getApiKey() {
		return $this->apiKey?$this->apiKey:Configuration::get('OBSEGOI_API_KEY');
	}
	
	private function getSoapParams() {
		return array(
			'apikey' => $this->getApiKey(),
			'plugin_key' => self::PLUGIN_KEY
		);
	}
	
	public function getUserData() {
		return $this->_c->getUserData($this->getSoapParams());
	}
	
	public function getClientData() {
		return $this->_c->getClientData($this->getSoapParams());
	}
	
	/** LISTS **/
	public function createList($name, $email=false, $sms = false, $fax = false, $voice = false) {
		
		//ALL REQUIRED
		$params = array(
			'nome' => $name?$name:'',		//Mailing list title
			'idioma_lista' => 'sp',			//Mailing list language
			'canal_email' => $email?1:0,	//Enable/disable e-mail channel (set it to "1" to enable it, "0" to disable it)
			'canal_sms' => $sms?1:0,		//Enable/disable SMS channel (set it to "1" to enable it, "0" to disable it)
			'canal_fax' => $fax?1:0,		//Enable/disable fax channel (set it to "1" to enable it, "0" to disable it)
			'canal_voz' => $voice?1:0		//Enable/disable voice channel (set it to "1" to enable it, "0" to disable it)
		);
		
		$result = $this->_c->createList(array_merge($this->getSoapParams(), $params));
		
		if (isset($result['ERROR']))
			return false;
		else {
			$id = $result['LIST_ID'];
			
			return $id;
		}
	}
	
	public function getLists() {
		
		return $this->_c->getLists($this->getSoapParams());
	}
	
	/** SUBSCRIBERS **/
	public function getSubscribersFromListId($listId) {
		return $this->_c->subscriberData(array_merge($this->getSoapParams(),array('listID' => $listId, 'subscriber' => 'all_subscribers')));
	}
	
	public function addSubscriber(CustomerCore $customer, $id_list, $extraFields) {
		
		//ALL REQUIRED
		$params = array( 
			'listID' => $id_list,
			'subscriber' => $customer->id,
			'status' => '1',
			'from' => '',
			'lang' => Language::getIsoById($customer->id_lang),
		    'email' => $customer->email,
			'validate_email' => '0',
		    'cellphone' => '',
		    'telephone' => '',
		    'fax' => '',
		    'first_name' => $customer->firstname,
		    'last_name' => $customer->lastname,
		    'birth_date' => ($customer->birthday) ? date('d-m-Y', strtotime($customer->birthday)):'',
		);
		
		
		if($extraFields AND count ($extraFields)> 0)
			$params = array_merge($params, $extraFields);
		
		$result = $this->_c->addSubscriber(array_merge($this->getSoapParams(), $params));
		
		if (isset($result['ERROR']))
			return false;
		else {
			$id = $result['UID'];
			return $id;
		}
	}
	
	public function createExtraField($id_list, $name, $type) {
		
		//ALL REQUIRED
		$params = array( 
			'listID' => $id_list,
			'name' => $name,
			'type' => $type
		);
		
		$result = $this->_c->addExtraField(array_merge($this->getSoapParams(), $params));
		
		if (isset($result['ERROR']))
			return false;
		else {
			$id = $result['NEW_ID'];
			return $id;
		}
	}
	
	public function addCallbacks($id_list) {
		/*
		 * notif_api_1: Submits a single opt-in subscription form
		 * notif_api_2: Opts out using the unsubscription form
		 * notif_api_3: Is added manually to the list
		 * notif_api_4: Is removed manually from the list
		 * notif_api_5: Is removed from the list due to bouncing
		 * notif_api_6: Converts another contact
		 * notif_api_7: Submits a double opt-in subscription form
		 * notif_api_8: Opts out by clicking the unsubscribe link
		 * notif_api_9: Is added to the list via API
		 * notif_api_10: Is removed from the list via API
		 * notif_api_12: Has their subscription info changed manually
		 * notif_api_13: Submits their «edit subscription» form
		 * notif_api_14: Has their subscription info changed via API
		 * notif_api_15: Confirmação de inscrição por formulário
		 * notif_api_16: Confirmação de alteração de dados por formulário
		 */
		
		$callbackUrl = Context::getContext()->link->getModuleLink('obsegoi', 'callback');
		
		$params = array(
			'listID' => $id_list,
			'notif_api_1' => false,
			'notif_api_2' => true,
			'notif_api_3' => true,
			'notif_api_4' => true,
			'notif_api_5' => true,
			'notif_api_6' => false,
			'notif_api_7' => false,
			'notif_api_8' => true,
			'notif_api_9' => false,
			'notif_api_10' => false,
			'notif_api_12' => true,
			'notif_api_13' => true,
			'notif_api_14' => false,
			'notif_api_15' => false,
			'notif_api_16' => false,
			'callback_url' => $callbackUrl
		);
		$result = $this->_c->editApiCallback(array_merge($this->getSoapParams(), $params));
		
		if (!isset($result['RESULT']) OR $result['RESULT'] != 'OK')
			return false;
		else
			return true;
	}
	
}