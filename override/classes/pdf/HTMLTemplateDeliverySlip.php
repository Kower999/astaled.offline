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
class HTMLTemplateDeliverySlip extends HTMLTemplateDeliverySlipCore
{
    
	public function __construct(OrderInvoice $order_invoice, $smarty)
	{
		$this->order_invoice = $order_invoice;
		$this->order = new Order($this->order_invoice->id_order);
		$this->smarty = $smarty;
//var_dump($this->order_invoice->delivery_number);

		$id_lang = Context::getContext()->language->id;

		// header informations        
		$this->date = Tools::displayDate($this->order->invoice_date,$id_lang);
		$this->title = HTMLTemplateDeliverySlip::l('Delivery').' '.sprintf('%09d', $this->order->invoice_number);

		// footer informations
		$this->shop = new Shop((int)$this->order->id_shop);
		$this->smarty->assign(array(
            'dodaci' => true
		));
	}
    

	/**
	 * Returns the template's HTML content
	 * @return string HTML content
	 */
	public function getContent()
	{
		$delivery_address = new Address((int)$this->order->id_address_delivery);
		$formatted_delivery_address = AddressFormat::generateAddress($delivery_address, array(), '<br />', ' ',array('dni'=>'<br />IČO: %s','dic'=>'DIČ: %s','vat_number'=>'IČ DPH: %s'));
		$formatted_invoice_address = '';

		if ($this->order->id_address_delivery != $this->order->id_address_invoice)
		{
			$invoice_address = new Address((int)$this->order->id_address_invoice);
			$formatted_invoice_address = AddressFormat::generateAddress($invoice_address, array(), '<br />', ' ',array('dni'=>'<br />IČO: %s','dic'=>'DIČ: %s','vat_number'=>'IČ DPH: %s'));
		}
		
		$carrier = new Carrier($this->order->id_carrier);
		$carrier->name = ($carrier->name == '0' ? Configuration::get('PS_SHOP_NAME') : $carrier->name);
		$this->shop = new Shop((int)$this->order->id_shop);
        
        $this->shop->getAddress();
        
        $this->country = Country::getNameById($this->order->id_lang,$this->shop->address->id_country);
                
		$this->smarty->assign(array(
			'order' => $this->order,
            'dodaci' => true,
			'order_details' => $this->order_invoice->getProducts(),
			'delivery_address' => $formatted_delivery_address,
			'invoice_address' => $formatted_invoice_address,
			'order_invoice' => $this->order_invoice,
			'carrier' => $carrier,
            'email' => Configuration::get('PS_SHOP_EMAIL'),
            'ico' => Configuration::get('PS_SHOP_ICO'),
            'dic' => Configuration::get('PS_SHOP_DIC'),
            'icdph' => Configuration::get('PS_SHOP_ICDPH'),
            'ucet' => Configuration::get('PS_SHOP_UCET'),
            'iban' => Configuration::get('PS_SHOP_IBAN'),
            'swift' => Configuration::get('PS_SHOP_SWIFT'),
            'banka' => Configuration::get('PS_SHOP_BANKA'),            
            'vs' => sprintf('%09d', $this->order->invoice_number),
            'ks' => Configuration::get('PS_SHOP_KS'),
			'shop' => $this->shop,
            'address' => $this->shop->address,
            'country' => $this->country,


		));

		return $this->smarty->fetch($this->getTemplate('delivery-slip'));
	}

	/**
	 * Returns the template filename
	 * @return string filename
	 */
	public function getFilename()
	{
		return 'Dodaci_list_' . sprintf('%09d', $this->order->invoice_number).'.pdf';
	}

}

