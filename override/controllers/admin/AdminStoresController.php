<?php
/*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2014 PrestaShop SA
*  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class AdminStoresController extends AdminStoresControllerCore
{
	protected function _getDefaultFieldsContent()
	{
		$this->context = Context::getContext();
		$countryList = array();
		$countryList[] = array('id' => '0', 'name' => $this->l('Choose your country'));
		foreach (Country::getCountries($this->context->language->id) as $country)
			$countryList[] = array('id' => $country['id_country'], 'name' => $country['name']);
		$stateList = array();
		$stateList[] = array('id' => '0', 'name' => $this->l('Choose your state (if applicable)'));
		foreach (State::getStates($this->context->language->id) as $state)
			$stateList[] = array('id' => $state['id_state'], 'name' => $state['name']);

		$formFields = array(
			'PS_SHOP_NAME' => array(
				'title' => $this->l('Shop name'),
				'hint' => $this->l('Displayed in emails and page titles.'),
				'validation' => 'isGenericName',
				'required' => true,
				'type' => 'text'
			),
			'PS_SHOP_EMAIL' => array('title' => $this->l('Shop email'),
				'hint' => $this->l('Displayed in emails sent to customers.'),
				'validation' => 'isEmail',
				'required' => true,
				'type' => 'text'
			),
			'PS_SHOP_DETAILS' => array(
				'title' => $this->l('Registration'),
				'hint' => $this->l('Shop registration information (e.g. SIRET or RCS).'),
				'validation' => 'isGenericName',
				'type' => 'textarea',
				'cols' => 30,
				'rows' => 5
			),
			'PS_SHOP_ADDR1' => array(
				'title' => $this->l('Shop address line 1'),
				'validation' => 'isAddress',
				'type' => 'text'
			),
			'PS_SHOP_ADDR2' => array(
				'title' => $this->l('Shop address line 2'),
				'validation' => 'isAddress',
				'type' => 'text'
			),
			'PS_SHOP_CODE' => array(
				'title' => $this->l('Zip/postal code'),
				'validation' => 'isGenericName',
				'type' => 'text'
			),
			'PS_SHOP_CITY' => array(
				'title' => $this->l('City'),
				'validation' => 'isGenericName',
				'type' => 'text'
			),
			'PS_SHOP_COUNTRY_ID' => array(
				'title' => $this->l('Country'),
				'validation' => 'isInt',
				'type' => 'select',
				'list' => $countryList,
				'identifier' => 'id',
				'cast' => 'intval',
				'defaultValue' => (int)$this->context->country->id
			),
			'PS_SHOP_STATE_ID' => array(
				'title' => $this->l('State'),
				'validation' => 'isInt',
				'type' => 'select',
				'list' => $stateList,
				'identifier' => 'id',
				'cast' => 'intval'
			),
			'PS_SHOP_PHONE' => array(
				'title' => $this->l('Phone'),
				'validation' => 'isGenericName',
				'type' => 'text'
			),
			'PS_SHOP_FAX' => array(
				'title' => $this->l('Fax'),
				'validation' => 'isGenericName',
				'type' => 'text'
			),
			'PS_SHOP_ICO' => array(
				'title' => $this->l('IČO'),
				'validation' => 'isGenericName',
				'type' => 'text'
			),
			'PS_SHOP_DIC' => array(
				'title' => $this->l('DIČ'),
				'validation' => 'isGenericName',
				'type' => 'text'
			),
			'PS_SHOP_ICDPH' => array(
				'title' => $this->l('IČ DPH'),
				'validation' => 'isGenericName',
				'type' => 'text'
			),

			'PS_SHOP_UCET' => array(
				'title' => $this->l('Číslo účtu'),
				'validation' => 'isGenericName',
				'type' => 'text'
			),
			'PS_SHOP_IBAN' => array(
				'title' => $this->l('IBAN'),
				'validation' => 'isGenericName',
				'type' => 'text'
			),
			'PS_SHOP_SWIFT' => array(
				'title' => $this->l('SWIFT'),
				'validation' => 'isGenericName',
				'type' => 'text'
			),
			'PS_SHOP_BANKA' => array(
				'title' => $this->l('Názov banky'),
				'validation' => 'isGenericName',
				'type' => 'text'
			),
			'PS_SHOP_KS' => array(
				'title' => $this->l('Konštantný symbol'),
				'validation' => 'isGenericName',
				'type' => 'text'
			),
            
            
		);

		return $formFields;
	}
}
