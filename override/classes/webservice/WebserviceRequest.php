<?php

if (!class_exists('Visits')) {
    require_once(_PS_MODULE_DIR_.'customervisit/classes/Visits.php');
}

if (!class_exists('AddressCategory')) {
    class AddressCategory extends ObjectModel {
	   public $id_address;
	   public $id_address_category;
    
	   public static $definition = array(
		'primary' => 'id_address',
		'table' => 'address_category',
		'fields' => array(
			'id_address' => 	     array('type' => self::TYPE_INT, 'required' => true, 'size' => 11),
			'id_address_category' => 	     array('type' => self::TYPE_INT, 'required' => true, 'size' => 11),
		)        
	   );

	   protected $webserviceParameters = array(
		'objectsNodeName' => 'address_categories',
	   );
    
    
    }    
}

if (!class_exists('AddressMoredata')) {
    class AddressMoredata extends ObjectModel {
	   public $id_address;
	   public $dic;
	   public $lat;
	   public $lng;
    	
	   public static $definition = array(
		'primary' => 'id_address',
		'table' => 'address_moredata',
		'fields' => array(
			'id_address' => 	     array('type' => self::TYPE_INT, 'required' => true, 'size' => 11),
			'dic' =>	             array('type' => self::TYPE_STRING, 'validate' => 'isString', 'size' => 20),
			'lat' =>	             array('type' => self::TYPE_FLOAT, 'validate' => 'isFloat', 'copy_post' => false),
			'lng' =>	             array('type' => self::TYPE_FLOAT, 'validate' => 'isFloat', 'copy_post' => false),
		)        
	   );

	   protected $webserviceParameters = array(
		'objectsNodeName' => 'address_moredatas',
	   );
    
    
    }    
}


class WebserviceRequest extends WebserviceRequestCore
{
    public static function getResources()
    {
        $resources=parent::getResources();
        $resources['address_visits'] = array('description' => 'Address visits management', 'class' => 'Visits');
        $resources['address_categories'] = array('description' => 'Customer address categories management', 'class' => 'AddressCategory');
        $resources['address_moredatas'] = array('description' => 'Customer address more data management', 'class' => 'AddressMoredata');
        ksort($resources);
        return $resources;
    }
    
	/**
	 * save Entity Object from XML
	 *
	 * @param int $successReturnCode
	 * @return boolean
	 */
	protected function saveEntityFromXml($successReturnCode)
	{
/*	   
       if(!empty($_REQUEST['<?xml_version'])){
            $this->_inputXml = stripslashes('<?xml_version'.$_REQUEST['<?xml_version']);
            $this->_inputXml = str_replace('<?xml_version"1.0"?>','',$this->_inputXml);
            $this->_inputXml = str_replace('<?xml_version"1.0" encoding="UTF-8"?>',"<xml version=\"1.0\" encoding=\"utf-8\">",$this->_inputXml);
            $this->_inputXml .= '</xml>';
       }
*/       
       if(!empty($_REQUEST['<xml_version'])){
            $this->_inputXml = stripslashes('<xml version='.$_REQUEST['<xml_version']);
       }
//	   var_dump($this->_inputXml);
		try
		{
/*            $dom = new DOMDocument;
            $dom->loadXML($this->_inputXml);
            if (!$dom) {
                echo 'Error while parsing string';
                return;
            }

            $xml = simplexml_import_dom($dom);
*/            		  
			$xml = new SimpleXMLElement($this->_inputXml);
//			$xml = simplexml_load_string($this->_inputXml);
//           var_dump($xml);
            
		}
		catch (Exception $error)
		{
			$this->setError(500, 'XML error : '.$error->getMessage()."\n".'XML length : '.strlen($this->_inputXml)."\n".'Original XML : '.$this->_inputXml, 127);
			return;
		}
		$xmlEntities = $xml->children()->children();
		$object = null;

//        var_dump($xmlEntities);

		$ids = array();
		foreach ($xmlEntities as $entity)
		{
			// To cast in string allow to check null values
			if ((string)$entity->id != '')
				$ids[] = (int)$entity->id;
		}
		if ($this->method == 'PUT')
		{
			$ids2 = array();
			$ids2 = array_unique($ids);
			if (count($ids2) != count($ids))
			{
				$this->setError(400, 'id is duplicate in request', 89);
				return false;
			}
			if (count($xmlEntities) != count($ids))
			{
				$this->setError(400, 'id is required when modifying a resource', 90);
				return false;
			}
		}
		elseif ($this->method == 'POST' && count($ids) > 0 && (!in_array($this->resourceConfiguration['retrieveData']['className'],array('AddressCategory') ) ))
		{
			$this->setError(400, 'id is forbidden when adding a new resource', 91);
			return false;
		}

		foreach ($xmlEntities as $xmlEntity)
		{
//		  var_dump($xmlEntity->asXML());
			$attributes = $xmlEntity->children();
//            var_dump($attributes->asXML());

			if ($this->method == 'POST')
				$object = new $this->resourceConfiguration['retrieveData']['className']();
			elseif ($this->method == 'PUT')
			{
				$object = new $this->resourceConfiguration['retrieveData']['className']((int)$attributes->id);
				if (!$object->id)
				{
					$this->setError(404, 'Invalid ID', 92);
					return false;
				}
			}
			$this->objects[] = $object;
			$i18n = false;
			// attributes
			foreach ($this->resourceConfiguration['fields'] as $fieldName => $fieldProperties)
			{
/*			     if($fieldName == 'id_address_delivery') {
			         var_dump($fieldProperties);
                     var_dump($attributes->asXML());
			     }
*/                 
				$sqlId = $fieldProperties['sqlId'];

				if ($fieldName == 'id')
					$sqlId = $fieldName;
				if (isset($attributes->$fieldName) && isset($fieldProperties['sqlId']) && (!isset($fieldProperties['i18n']) || !$fieldProperties['i18n']))
				{
					if (isset($fieldProperties['setter']))
					{
						// if we have to use a specific setter
						if (!$fieldProperties['setter'])
						{
							// if it's forbidden to set this field
							$this->setError(400, 'parameter "'.$fieldName.'" not writable. Please remove this attribute of this XML', 93);
							return false;
						}
						else
							$object->$fieldProperties['setter']((string)$attributes->$fieldName);
//							$object->$fieldProperties['setter'](html_entity_decode((string)$attributes->$fieldName,16, "UTF-8"));
					}
					elseif (property_exists($object, $sqlId))
						$object->$sqlId = (string)$attributes->$fieldName;
					else
						$this->setError(400, 'Parameter "'.$fieldName.'" can\'t be set to the object "'.$this->resourceConfiguration['retrieveData']['className'].'"', 123);

				}
				elseif (isset($fieldProperties['required']) && $fieldProperties['required'] && !$fieldProperties['i18n'])
				{
					$this->setError(400, 'parameter "'.$fieldName.'" required', 41);
					return false;
				}
				elseif ((!isset($fieldProperties['required']) || !$fieldProperties['required']) && property_exists($object, $sqlId))
					$object->$sqlId = null;
				if (isset($fieldProperties['i18n']) && $fieldProperties['i18n'])
				{
					$i18n = true;
					if (isset($attributes->$fieldName, $attributes->$fieldName->language))
						foreach ($attributes->$fieldName->language as $lang)
							$object->{$fieldName}[(int)$lang->attributes()->id] = (string)$lang;
					else
						$object->{$fieldName} = (string)$attributes->$fieldName;
				}
			}
			if (!$this->hasErrors())
			{
				if ($i18n && ($retValidateFieldsLang = $object->validateFieldsLang(false, true)) !== true)
				{
					$this->setError(400, 'Validation error: "'.$retValidateFieldsLang.'"', 84);
					return false;
				}
				elseif (($retValidateFields = $object->validateFields(false, true)) !== true)
				{
					$this->setError(400, 'Validation error: "'.$retValidateFields.'"', 85);
					return false;
				}
				else
				{
					// Call alternative method for add/update
					$objectMethod = ($this->method == 'POST' ? 'add' : 'update');
					if (isset($this->resourceConfiguration['objectMethods']) && array_key_exists($objectMethod, $this->resourceConfiguration['objectMethods']))
						$objectMethod = $this->resourceConfiguration['objectMethods'][$objectMethod];

                    $object->autodate = true;
                    $this->modifyobj($object);
                        
//                    var_dump($object);                 
                    $save = $object;       
					$result = $object->{$objectMethod}($object->autodate);
					if($result)
					{
						if (isset($attributes->associations))
							foreach ($attributes->associations->children() as $association)
							{
								// associations
								if (isset($this->resourceConfiguration['associations'][$association->getName()]))
								{
									$assocItems = $association->children();
									$values = array();
									foreach ($assocItems as $assocItem)
									{
										$fields = $assocItem->children();
										$entry = array();
										foreach ($fields as $fieldName => $fieldValue)
											$entry[$fieldName] = (string)$fieldValue;
										$values[] = $entry;
									}
									$setter = $this->resourceConfiguration['associations'][$association->getName()]['setter'];
									if (!is_null($setter) && $setter && method_exists($object, $setter) && !$object->$setter($values))
									{
										$this->setError(500, 'Error occurred while setting the '.$association->getName().' value', 85);
										return false;
									}
								}
								elseif ($association->getName() != 'i18n')
								{
									$this->setError(400, 'The association "'.$association->getName().'" does not exists', 86);
									return false;
								}
							}
                        if(!empty($association)){
                            if($association->getName() == 'order_rows'){
//                            var_dump($assocItems);         
//                                $this->setOutputEnabled(false);                   
                                $this->changeprices($values, $object);
                            }
                        }
                                  
						$assoc = Shop::getAssoTable($this->resourceConfiguration['retrieveData']['table']);
						if ($assoc !== false && $assoc['type'] != 'fk_shop')
						{
							// PUT nor POST is destructive, no deletion
							$sql = 'INSERT IGNORE INTO `'.bqSQL(_DB_PREFIX_.$this->resourceConfiguration['retrieveData']['table'].'_'.$assoc['type']).'` (id_shop, '.pSQL($this->resourceConfiguration['fields']['id']['sqlId']).') VALUES ';
							foreach (self::$shopIDs as $id)
							{
								$sql .= '('.(int)$id.','.(int)$object->id.')';
								if ($id != end(self::$shopIDs))
									$sql .= ', ';
							}
							Db::getInstance()->execute($sql);
						}
                        
                        $this->aftersave($object, $save);
					}
					else
						$this->setError(500, 'Unable to save resource', 46);
				}
			}
		}
//        var_dump($result);
		if (!$this->hasErrors())
		{
			$this->objOutput->setStatus($successReturnCode);
			return true;
		}
	}

    public function changeprices($assoc, $obj){
        if(!empty($assoc) && is_array($assoc)){
            foreach($assoc as $a){
                $id_od = Db::getInstance()->getValue("SELECT id_order_detail FROM `"._DB_PREFIX_."order_detail` WHERE id_order = ".$obj->id.' AND product_id = '.$a['product_id']);
                if(!empty($id_od)){
                    $od = new OrderDetail($id_od);
                    if((float)$od->product_price != (float)$a['product_price'] ){
                        $od->setDetailPrice($a['product_price']);
                        $od->update();
                    }
                }
            }
        }
    }    

    
    public function modifyobj(&$obj){
        $obj_class = get_class($obj);
        switch ($obj_class) {
            case 'Customer':
            case 'Address':
            case 'CartRule':
            case 'Order':
            case 'Cart':
                $obj->autodate = false;
                break;
            default:
                break;
        }        
    }    
    
    public function aftersave($obj, $save){
        $obj_class = get_class($obj);
        switch ($obj_class) {
            case 'CartRule':
                $c = $obj->code;
                $idc = (int)str_replace('BO_ORDER_','',$c);
                $cart = new Cart($idc);
                $cart->addCartRule($obj->id);
                break;
            case 'Order':
                $o = new Order($save->id);
                $o->date_pay = $save->date_pay;
                $o->valid = $save->valid;
                $o->invoice_number = $save->invoice_number;
                $o->delivery_number = $save->delivery_number;
                $o->reference = $save->reference;
                $o->id_carrier = $save->id_carrier;                
                $o->total_shipping = $save->total_shipping;
                $o->total_shipping_tax_excl = $save->total_shipping_tax_excl;
                $o->total_shipping_tax_incl = $save->total_shipping_tax_incl;
                $o->total_paid = $save->total_paid;
                $o->total_paid_tax_excl = $save->total_paid_tax_excl;
                $o->total_paid_tax_incl = $save->total_paid_tax_incl;
                $o->total_paid_real = 0;
                $o->total_products = $save->total_products;
                $o->total_products_wt = $save->total_products_wt;
                $o->total_provisions = $save->total_provisions;
                $o->update();
//                $o->deleteAssociations();
                
                $oi = $o->getInvoice2();                    
/*                if(!$o->hasInvoice()) {                    
                    $o->setInvoice(false);
                    $o->setDelivery();
                    $o->invoice_number = $save->invoice_number;
                    $o->delivery_number = $save->delivery_number;
                }                
*/                
                $oi->total_paid_tax_excl = $save->total_paid_tax_excl;
                $oi->total_paid_tax_incl = $save->total_paid_tax_incl;
                $oi->total_products = $save->total_products;
                $oi->total_products_wt = $save->total_products_wt;
                $oi->total_shipping_tax_excl = $save->total_shipping_tax_excl;
                $oi->total_shipping_tax_incl = $save->total_shipping_tax_incl;
                $oi->date_add = $save->date_add;
                $oi->number = $save->invoice_number;
                $oi->delivery_number = $save->delivery_number;
                $oi->update(); 
                break;                
            case 'OrderDetail':
                $o = new Order($save->id_order);
                $od = new OrderDetail($save->id);
                $od->product_price = $save->product_price;
                $od->total_price_tax_incl = $save->total_price_tax_incl;
                $od->total_price_tax_excl = $save->total_price_tax_excl;
                $od->unit_price_tax_incl = $save->unit_price_tax_incl;
                $od->unit_price_tax_excl = $save->unit_price_tax_excl;
                $od->update();
                $od->updateTaxAmount($o);
//                $od->setProductTax($o,array('id_product' => $save->product_id, 'id_shop' => $save->id_shop, 'ecotax' => $save->ecotax));
                $o->update();                
                break;             
            case 'AddressMoredata':
                if(empty($obj->lat) || empty($obj->lng)){
                    $addr = new Address($obj->id_address);
                    $id_addr = $obj->id_address;
                    $country = new Country($addr->id_country);
                    $region = $country->name[$this->context->language->id]; 
                    $address = $addr->address1.',+'.$addr->postcode.'+'.$addr->city.',+'.$region;
                    $address = str_replace(' ','+',$address);
                    $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=$region";
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    $response = curl_exec($ch);
                    curl_close($ch);
                    $response_a = json_decode($response);
                    if($response_a->status == 'OK'){
                        $lat = $response_a->results[0]->geometry->location->lat;
                        $lng = $response_a->results[0]->geometry->location->lng;
                    } else {
//				        $this->errors[] = Tools::displayError('Skontrolujte prosím adresu. Podľa zadanej adresy nebolo možné službou google vyhľadať pozíciu na mape.');
//			            $this->display = 'edit';
                    }                     

                    if(empty($lat) || empty($lng)){
                        $lat = (float)$lat;
                        $lng = (float)$lng;
                    }                


                    $test = (int)Db::getInstance()->getValue('SELECT id_address FROM '._DB_PREFIX_.'address_moredata WHERE id_address='.$id_addr);                
                    if($test>0) {
                        Db::getInstance()->execute('UPDATE '._DB_PREFIX_.'address_moredata SET `lat` = '.$lat.', `lng` = '.$lng.' WHERE `id_address` = '.$id_addr);                    
                    } else {
                        Db::getInstance()->execute('INSERT INTO '._DB_PREFIX_.'address_moredata (`id_address`,`lat`,`lng`,`dic`) VALUES ( '.$id_addr.', '.$lat.', '.$lng.', "")');                    
                    }
                    
                }
                break;   
            default:
                break;
        }        
        
    }
}

