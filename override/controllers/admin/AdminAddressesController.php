<?php

class AdminAddressesController extends AdminAddressesControllerCore
{

	public function __construct()
	{
		parent::__construct();

		$this->fields_list = array(
			'id_address' => array('title' => $this->l('ID'), 'align' => 'center', 'width' => 25),
			'company' => array('title' => $this->l('Firma'), 'width' => 120, 'filter_key' => 'a!company'),
			'alias' => array('title' => $this->l('Alias'), 'width' => 140, 'filter_key' => 'a!alias'),
			'address1' => array('title' => $this->l('Address')),
			'postcode' => array('title' => $this->l('Postal Code/Zip Code'), 'align' => 'right', 'width' => 80),
			'city' => array('title' => $this->l('City'), 'width' => 150),
			'country' => array('title' => $this->l('Country'), 'width' => 100, 'type' => 'select', 'list' => $this->countries_array, 'filter_key' => 'cl!id_country'));

	}


	public function renderForm()
	{
		$this->fields_form = array(
			'legend' => array(
				'title' => $this->l('Addresses'),
				'image' => '../img/admin/contact.gif'
			),
			'input' => array(
				array(
					'type' => 'text_customer',
					'label' => $this->l('Customer'),
					'name' => 'id_customer',
					'size' => 33,
					'required' => false,
				),
				array(
					'type' => 'text',
					'label' => $this->l('Address alias'),
					'name' => 'alias',
					'size' => 33,
					'required' => true,
					'hint' => $this->l('Invalid characters:').' <>;=#{}'
				),
				array(
					'type' => 'text',
					'label' => $this->l('Home phone'),
					'name' => 'phone',
					'size' => 33,
					'required' => false,
				),
				array(
					'type' => 'text',
					'label' => $this->l('Mobile phone'),
					'name' => 'phone_mobile',
					'size' => 33,
					'required' => false,
					'desc' => sprintf($this->l('You must register at least one phone number %s'), '<sup>*</sup>')
				),
				array(
					'type' => 'textarea',
					'label' => $this->l('Other'),
					'name' => 'other',
					'cols' => 36,
					'rows' => 4,
					'required' => false,
					'hint' => $this->l('Forbidden characters:').' <>;=#{}<span class="hint-pointer">&nbsp;</span>'
				),
			),
			'submit' => array(
				'title' => $this->l('   Save   '),
				'class' => 'button'
			)
		);
		$id_customer = (int)Tools::getValue('id_customer');
		if (!$id_customer && Validate::isLoadedObject($this->object))
			$id_customer = $this->object->id_customer;
		if ($id_customer)
		{
			$customer = new Customer((int)$id_customer);
			$token_customer = Tools::getAdminToken('AdminCustomers'.(int)(Tab::getIdFromClassName('AdminCustomers')).(int)$this->context->employee->id);
		}

		// @todo in 1.4, this include was done before the class declaration
		// We should use a hook now
		if (Configuration::get('VATNUMBER_MANAGEMENT') && file_exists(_PS_MODULE_DIR_.'vatnumber/vatnumber.php'))
			include_once(_PS_MODULE_DIR_.'vatnumber/vatnumber.php');
		if (Configuration::get('VATNUMBER_MANAGEMENT'))
			if (file_exists(_PS_MODULE_DIR_.'vatnumber/vatnumber.php') && VatNumber::isApplicable(Configuration::get('PS_COUNTRY_DEFAULT')))
				$vat = 'is_applicable';
			else
				$vat = 'management';

		$this->tpl_form_vars = array(
			'vat' => isset($vat) ? $vat : null,
			'customer' => isset($customer) ? $customer : null,
			'tokenCustomer' => isset ($token_customer) ? $token_customer : null
		);

		// Order address fields depending on country format
		$addresses_fields = $this->processAddressFormat();
		// we use  delivery address
		$addresses_fields = $addresses_fields['dlv_all_fields'];

		$temp_fields = array();
        
        $id_address = (int)Tools::getValue('id_address');

        $temp_fields[] = array(
					'type' => 'select',
					'label' => $this->l('Kategória zákazníka:'),
					'name' => 'id_address_category',
					'required' => false,
					'default_value' => Db::getInstance()->getValue('SELECT id_address_category FROM '._DB_PREFIX_.'address_category WHERE id_address='.$id_address),
					'options' => array(
						'query' => Db::getInstance()->query('SELECT id, name FROM '._DB_PREFIX_.'address_categories'),
						'id' => 'id',
						'name' => 'name',
					)
        );

		foreach ($addresses_fields as $addr_field_item)
		{
			if ($addr_field_item == 'company')
			{
				$temp_fields[] = array(
					'type' => 'text',
					'label' => $this->l('Company'),
					'name' => 'company',
					'size' => 33,
					'required' => true,
					'hint' => $this->l('Invalid characters:').' <>;=#{}<span class="hint-pointer">&nbsp;</span>'
				);
				$temp_fields[] = array(
					'type' => 'text',
					'label' => $this->l('IČO'),
					'name' => 'dni',
					'size' => 33,
					'required' => false,
//					'desc' => $this->l('DNI / NIF / NIE')
				);
				$temp_fields[] = array(
					'type' => 'text',
					'label' => $this->l('DIČ'),
					'name' => 'dic',
                    'default_value' => Db::getInstance()->getValue('SELECT dic FROM '._DB_PREFIX_.'address_moredata WHERE id_address='.$id_address),
					'size' => 33,
					'required' => false,
				);
				$temp_fields[] = array(
					'type' => 'text',
					'label' => $this->l('VAT number'),
					'name' => 'vat_number',
					'required' => false,
					'size' => 33,
				);
			}
			else if ($addr_field_item == 'lastname')
			{
				if (isset($customer) &&
					!Tools::isSubmit('submit'.strtoupper($this->table)) &&
					Validate::isLoadedObject($customer) &&
					!Validate::isLoadedObject($this->object))
					$default_value = $customer->lastname;
				else
					$default_value = '';

				$temp_fields[] = array(
					'type' => 'text',
					'label' => $this->l('Last name'),
					'name' => 'lastname',
					'size' => 33,
					'required' => false,
					'hint' => $this->l('Invalid characters:').' 0-9!<>,;?=+()@#"�{}_$%:<span class="hint-pointer">&nbsp;</span>',
					'default_value' => $default_value,
				);
			}
			else if ($addr_field_item == 'firstname')
			{
				if (isset($customer) &&
					!Tools::isSubmit('submit'.strtoupper($this->table)) &&
					Validate::isLoadedObject($customer) &&
					!Validate::isLoadedObject($this->object))
					$default_value = $customer->firstname;
 	 	 	 	else
 	 	 	 		$default_value = '';

				$temp_fields[] = array(
					'type' => 'text',
					'label' => $this->l('First name'),
					'name' => 'firstname',
					'size' => 33,
					'required' => false,
					'hint' => $this->l('Invalid characters:').' 0-9!<>,;?=+()@#"�{}_$%:<span class="hint-pointer">&nbsp;</span>',
					'default_value' => $default_value,
				);
			}
			else if ($addr_field_item == 'address1')
			{
				$temp_fields[] = array(
					'type' => 'text',
					'label' => $this->l('Address'),
					'name' => 'address1',
					'size' => 33,
					'required' => true,
				);
			}
			else if ($addr_field_item == 'address2')
			{
				$temp_fields[] = array(
					'type' => 'text',
					'label' => $this->l('Address').' (2)',
					'name' => 'address2',
					'size' => 33,
					'required' => false,
				);
			}
			elseif ($addr_field_item == 'postcode')
			{
				$temp_fields[] = array(
					'type' => 'text',
					'label' => $this->l('Postal Code/Zip Code'),
					'name' => 'postcode',
					'size' => 33,
					'required' => true,
				);
			}
			else if ($addr_field_item == 'city')
			{
				$temp_fields[] = array(
					'type' => 'text',
					'label' => $this->l('City'),
					'name' => 'city',
					'size' => 33,
					'required' => true,
				);
			}
			else if ($addr_field_item == 'country' || $addr_field_item == 'Country:name')
			{
				$temp_fields[] = array(
					'type' => 'select',
					'label' => $this->l('Country:'),
					'name' => 'id_country',
					'required' => false,
					'default_value' => (int)$this->context->country->id,
					'options' => array(
						'query' => Country::getCountries($this->context->language->id),
						'id' => 'id_country',
						'name' => 'name',
					)
				);
				$temp_fields[] = array(
					'type' => 'select',
					'label' => $this->l('State'),
					'name' => 'id_state',
					'required' => false,
					'options' => array(
						'query' => array(),
						'id' => 'id_state',
						'name' => 'name',
					)
				);
			}
		}

        $temp_fields[] = array(
            'type' => 'text',
            'label' => $this->l('Lat'),
            'name' => 'lat',
            'size' => 33,
            'default_value' => Db::getInstance()->getValue('SELECT lat FROM '._DB_PREFIX_.'address_moredata WHERE id_address='.$id_address),
            'required' => false,
        );
        $temp_fields[] = array(
            'type' => 'text',
            'label' => $this->l('Lng'),
            'name' => 'lng',
            'default_value' => Db::getInstance()->getValue('SELECT lng FROM '._DB_PREFIX_.'address_moredata WHERE id_address='.$id_address),
            'size' => 33,
            'required' => false,
        );

		// merge address format with the rest of the form
		array_splice($this->fields_form['input'], 2, 0, $temp_fields);

		if (!$this->default_form_language)
			$this->getLanguages();

		if (Tools::getValue('submitFormAjax'))
			$this->content .= $this->context->smarty->fetch('form_submit_ajax.tpl');
		if ($this->fields_form && is_array($this->fields_form))
		{
			if (!$this->multiple_fieldsets)
				$this->fields_form = array(array('form' => $this->fields_form));

			// For add a fields via an override of $fields_form, use $fields_form_override
			if (is_array($this->fields_form_override) && !empty($this->fields_form_override))
				$this->fields_form[0]['form']['input'][] = $this->fields_form_override;

			$helper = new HelperForm($this);
			$this->setHelperDisplay($helper);
			$helper->fields_value = $this->getFieldsValue($this->object);
			$helper->tpl_vars = $this->tpl_form_vars;
			!is_null($this->base_tpl_form) ? $helper->base_tpl = $this->base_tpl_form : '';
			if ($this->tabAccess['view'])
			{
				if (Tools::getValue('back'))
					$helper->tpl_vars['back'] = Tools::safeOutput(Tools::getValue('back'));
				else
					$helper->tpl_vars['back'] = Tools::safeOutput(Tools::getValue(self::$currentIndex.'&token='.$this->token));
			}
			$form = $helper->generateForm($this->fields_form);

			return $form;
		}
		return ;
	}

	public function processSave()
	{
		// Transform e-mail in id_customer for parent processing
		if (Validate::isEmail(Tools::getValue('email')))
		{
			$customer = new Customer();
			$customer->getByEmail(Tools::getValue('email'), null, false);
			if (Validate::isLoadedObject($customer))
				$_POST['id_customer'] = $customer->id;
			else
				$this->errors[] = Tools::displayError('This e-mail address is not registered.');
		}
		else if ($id_customer = Tools::getValue('id_customer'))
		{
			$customer = new Customer((int)$id_customer);
			if (Validate::isLoadedObject($customer))
				$_POST['id_customer'] = $customer->id;
			else
				$this->errors[] = Tools::displayError('Unknown customer');
		}
		else
			$this->errors[] = Tools::displayError('Unknown customer');
		if (Country::isNeedDniByCountryId(Tools::getValue('id_country')) && !Tools::getValue('dni'))
			$this->errors[] = Tools::displayError('Identification number is incorrect or has already been used.');

		/* If the selected country does not contain states */
		$id_state = (int)Tools::getValue('id_state');
		$id_country = (int)Tools::getValue('id_country');
		$country = new Country((int)$id_country);
		if ($country && !(int)$country->contains_states && $id_state)
			$this->errors[] = Tools::displayError('You have selected a state for a country that does not contain states.');

		/* If the selected country contains states, then a state have to be selected */
		if ((int)$country->contains_states && !$id_state)
			$this->errors[] = Tools::displayError('An address located in a country containing states must have a state selected.');

		/* Check zip code */
		if ($country->need_zip_code)
		{
			$zip_code_format = $country->zip_code_format;
			if (($postcode = Tools::getValue('postcode')) && $zip_code_format)
			{
				$zip_regexp = '/^'.$zip_code_format.'$/ui';
				$zip_regexp = str_replace(' ', '( |)', $zip_regexp);
				$zip_regexp = str_replace('-', '(-|)', $zip_regexp);
				$zip_regexp = str_replace('N', '[0-9]', $zip_regexp);
				$zip_regexp = str_replace('L', '[a-zA-Z]', $zip_regexp);
				$zip_regexp = str_replace('C', $country->iso_code, $zip_regexp);
				if (!preg_match($zip_regexp, $postcode))
					$this->errors[] = Tools::displayError('Your Postal Code/Zip Code is incorrect.').'<br />'.
									   Tools::displayError('Must be typed as follows:').' '.
									   str_replace('C', $country->iso_code, str_replace('N', '0', str_replace('L', 'A', $zip_code_format)));
			}
			else if ($zip_code_format)
				$this->errors[] = Tools::displayError('Postal Code/Zip Code required.');
			else if ($postcode && !preg_match('/^[0-9a-zA-Z -]{4,9}$/ui', $postcode))
				$this->errors[] = Tools::displayError('Your Postal Code/Zip Code is incorrect.');
		}

		/* If this address come from order's edition and is the same as the other one (invoice or delivery one)
		** we delete its id_address to force the creation of a new one */
		if ((int)Tools::getValue('id_order'))
		{
			$this->_redirect = false;
			if (isset($_POST['address_type']))
				$_POST['id_address'] = '';
		}

		// Check the requires fields which are settings in the BO
		$address = new Address();
		$this->errors = array_merge($this->errors, $address->validateFieldsRequiredDatabase());

		if (empty($this->errors)){
//            $ret = parent::processSave();
              if ($this->id_object) {
			     $ret = $this->loadObject();
		      } else {
		         $ret = $this->object; 
		      }

            if(Validate::isLoadedObject($ret)) {
                $id_addr = $ret->id;
//                var_dump('UPDATE '._DB_PREFIX_.'address_category SET `id_address_category` = '.Tools::getValue('id_address_category').' WHERE `id_address` = '.$id_addr);
//                var_dump($ret);
                $test = (int)Db::getInstance()->getValue('SELECT id_address_category FROM '._DB_PREFIX_.'address_category WHERE id_address='.$id_addr);
                if($test>0) {
                    Db::getInstance()->execute('UPDATE '._DB_PREFIX_.'address_category SET `id_address_category` = '.Tools::getValue('id_address_category').' WHERE `id_address` = '.$id_addr);                    
                } else {
                    Db::getInstance()->execute('INSERT INTO '._DB_PREFIX_.'address_category (`id_address`,`id_address_category`) VALUES ( '.$id_addr.', '.Tools::getValue('id_address_category').')');                                        
                }

                
                $lat = (float)Tools::getValue('lat');
                $lng = (float)Tools::getValue('lng');
                
                if(empty($lat) || empty($lng)){
                    $region = $country->name[$this->context->language->id]; 
                    $address = Tools::getValue('address1').',+'.Tools::getValue('postcode').'+'.Tools::getValue('city').',+'.$region;
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
                }
                
                if(empty($lat) || empty($lng)){
                    $lat = (float)$lat;
                    $lng = (float)$lng;
                }                
                
                $test = (int)Db::getInstance()->getValue('SELECT id_address FROM '._DB_PREFIX_.'address_moredata WHERE id_address='.$id_addr);                
                if($test>0) {
                    Db::getInstance()->execute('UPDATE '._DB_PREFIX_.'address_moredata SET `lat` = '.$lat.', `lng` = '.$lng.', `dic` = "'.Tools::getValue('dic').'" WHERE `id_address` = '.$id_addr);                    
                } else {
                    Db::getInstance()->execute('INSERT INTO '._DB_PREFIX_.'address_moredata (`id_address`,`lat`,`lng`,`dic`) VALUES ( '.$id_addr.', '.$lat.', '.$lng.', "'.Tools::getValue('dic').'")');                    
                }
            }
            if (empty($this->errors)) {
                if ($this->id_object)
                {
                    $this->object = $this->loadObject();
                    $ret = $this->processUpdate();
                } else $ret = $this->processAdd();                
                return $ret;
            } else {
			    $this->display = 'edit';
            }
        }
		else
			// if we have errors, we stay on the form instead of going back to the list
			$this->display = 'edit';
//            var_dump($ret);            

		/* Reassignation of the order's new (invoice or delivery) address */
		$address_type = ((int)Tools::getValue('address_type') == 2 ? 'invoice' : ((int)Tools::getValue('address_type') == 1 ? 'delivery' : ''));
		if ($this->action == 'save' && ($id_order = (int)Tools::getValue('id_order')) && !count($this->errors) && !empty($address_type))
		{
			if (!Db::getInstance()->execute('UPDATE '._DB_PREFIX_.'orders SET `id_address_'.$address_type.'` = '.Db::getInstance()->Insert_ID().' WHERE `id_order` = '.$id_order))
				$this->errors[] = Tools::displayError('An error occurred while linking this address to its order.');
			else
				Tools::redirectAdmin(Tools::getValue('back').'&conf=4');
		}
        
	}
    
 	public function postProcess()
	{	   
        parent::postProcess();
        
        if(Tools::isSubmit('submitAddaddress')){
//            Tools::fd($this->id_object);
//            Tools::fd();
            $ret = $this->object;
            if(Validate::isLoadedObject($ret)) {
                $id_addr = $ret->id;
//                var_dump('UPDATE '._DB_PREFIX_.'address_category SET `id_address_category` = '.Tools::getValue('id_address_category').' WHERE `id_address` = '.$id_addr);
//                var_dump($ret);
                $test = (int)Db::getInstance()->getValue('SELECT id_address_category FROM '._DB_PREFIX_.'address_category WHERE id_address='.$id_addr);
                if($test>0) {
                    Db::getInstance()->execute('UPDATE '._DB_PREFIX_.'address_category SET `id_address_category` = '.Tools::getValue('id_address_category').' WHERE `id_address` = '.$id_addr);                    
                } else {
                    Db::getInstance()->execute('INSERT INTO '._DB_PREFIX_.'address_category (`id_address`,`id_address_category`) VALUES ( '.$id_addr.', '.Tools::getValue('id_address_category').')');                                        
                }

                
                $lat = (float)Tools::getValue('lat');
                $lng = (float)Tools::getValue('lng');
                
                if(empty($lat) || empty($lng)){
                    $region = $country->name[$this->context->language->id]; 
                    $address = Tools::getValue('address1').',+'.Tools::getValue('postcode').'+'.Tools::getValue('city').',+'.$region;
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
                }
                
                if(empty($lat) || empty($lng)){
                    $lat = (float)$lat;
                    $lng = (float)$lng;
                }                
                
                $test = (int)Db::getInstance()->getValue('SELECT id_address FROM '._DB_PREFIX_.'address_moredata WHERE id_address='.$id_addr);                
                if($test>0) {
                    Db::getInstance()->execute('UPDATE '._DB_PREFIX_.'address_moredata SET `lat` = '.$lat.', `lng` = '.$lng.', `dic` = "'.Tools::getValue('dic').'" WHERE `id_address` = '.$id_addr);                    
                } else {
                    Db::getInstance()->execute('INSERT INTO '._DB_PREFIX_.'address_moredata (`id_address`,`lat`,`lng`,`dic`) VALUES ( '.$id_addr.', '.$lat.', '.$lng.', "'.Tools::getValue('dic').'")');                    
                }
            }
        }
    }
    

}

