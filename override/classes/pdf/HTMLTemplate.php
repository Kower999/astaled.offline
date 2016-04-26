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

/**
 * @since 1.5
 */
abstract class HTMLTemplate extends HTMLTemplateCore
{

	public function getAltHeader()
	{
		$path_logo = $this->getLogo();
        
		$this->smarty->assign(array(
			'title' => $this->title,
			'logo_path' => $path_logo,
		));        

		return $this->smarty->fetch($this->getTemplate('alt-header'));
	}
    
	/**
	 * Returns the template's HTML header
	 * @return string HTML header
	 */
	public function getHeader()
	{
		$shop_name = Configuration::get('PS_SHOP_NAME', null, null, (int)$this->order->id_shop);
		$path_logo = $this->getLogo();

		$width = 0;
		$height = 0;
		if (!empty($path_logo))
			list($width, $height) = getimagesize($path_logo);
		$this->smarty->assign(array(
			'logo_path' => $path_logo,
            'razitko' => _PS_OVERRIDE_DIR_.'classes/pdf/razitko.jpg',
            'medzera' => _PS_OVERRIDE_DIR_.'classes/pdf/medzera.jpg',
			'img_ps_dir' => 'http://'.Tools::getMediaServer(_PS_IMG_)._PS_IMG_,
			'img_update_time' => Configuration::get('PS_IMG_UPDATE_TIME'),
			'title' => $this->title,
			'date' => $this->date,
			'shop_name' => $shop_name,
			'width_logo' => $width,
			'height_logo' => $height,
            'alt_header' => $this->smarty->fetch($this->getTemplate('alt-header'))
		));
        
		$id_lang = Context::getContext()->language->id;

		// footer informations
		$this->shop = new Shop((int)$this->order->id_shop);
        
        $this->shop->getAddress();
        
        $this->country = Country::getNameById($this->order->id_lang,$this->shop->address->id_country);
        
		$this->smarty->assign(array(
			'shop' => $this->shop,
            'address' => $this->shop->address,
            'country' => $this->country,
//            'faktura' => true,
            'email' => Configuration::get('PS_SHOP_EMAIL'),
            'shop_phone' => Configuration::get('PS_SHOP_PHONE'),
            'shop_fax' => Configuration::get('PS_SHOP_FAX'),
            'ico' => Configuration::get('PS_SHOP_ICO'),
            'dic' => Configuration::get('PS_SHOP_DIC'),
            'icdph' => Configuration::get('PS_SHOP_ICDPH'),
            'ucet' => Configuration::get('PS_SHOP_UCET'),
            'iban' => Configuration::get('PS_SHOP_IBAN'),
            'swift' => Configuration::get('PS_SHOP_SWIFT'),
            'banka' => Configuration::get('PS_SHOP_BANKA'),            
            'vs' => Configuration::get(((Tools::isSubmit('invoice'))?'PS_INVOICE_PREFIX3':'PS_INVOICE_PREFIX'), $id_lang, null, (int)$this->order->id_shop) . sprintf('%09d', $this->order->invoice_number),
            'ks' => Configuration::get('PS_SHOP_KS'),
            
		));

		$invoice_address = new Address((int)$this->order->id_address_invoice);
		$formatted_invoice_address = AddressFormat::generateAddress($invoice_address, array(), '<br />', ' ',array('dni'=>'<br />IČO: %s','dic'=>'DIČ: %s','vat_number'=>'IČ DPH: %s'));
		$formatted_delivery_address = '';

		if ($this->order->id_address_delivery != $this->order->id_address_invoice)
		{
			$delivery_address = new Address((int)$this->order->id_address_delivery);
			$formatted_delivery_address = AddressFormat::generateAddress($delivery_address, array(), '<br />', ' ',array('dni'=>'<br />IČO: %s','dic'=>'DIČ: %s','vat_number'=>'IČ DPH: %s'));
		}

		$customer = new Customer((int)$this->order->id_customer);
        $carrier = new Carrier($this->order->id_carrier);

		$this->smarty->assign(array(
			'order' => $this->order,
			'carrier' => $carrier,
			'delivery_address' => $formatted_delivery_address,
			'invoice_address' => $formatted_invoice_address,
			'tax_excluded_display' => Group::getPriceDisplayMethod($customer->id_default_group),
			'customer' => $customer
		));


		return $this->smarty->fetch($this->getTemplate('header'));
	}
     
}

