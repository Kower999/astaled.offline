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
class HTMLTemplateInvoice extends HTMLTemplateInvoiceCore
{
	public function __construct(OrderInvoice $order_invoice, $smarty)
	{        
        parent::__construct( $order_invoice, $smarty);
        	   
		$this->order_invoice = $order_invoice;
		$this->order = new Order((int)$this->order_invoice->id_order);
		$this->smarty = $smarty;

		$id_lang = Context::getContext()->language->id;

		// header informations
		$this->date = Tools::displayDate($order_invoice->date_add,$id_lang);

        
        $this->title = HTMLTemplateInvoice::l('Invoice ').' č. '.Configuration::get(((Tools::isSubmit('invoice'))?'PS_INVOICE_PREFIX3':'PS_INVOICE_PREFIX'), $id_lang, null, (int)$this->order->id_shop).sprintf('%09d', $this->order->invoice_number);            
		// footer informations
		$this->shop = new Shop((int)$this->order->id_shop);
        
        $this->shop->getAddress();
        
        $this->country = Country::getNameById($this->order->id_lang,$this->shop->address->id_country);
        
		$this->smarty->assign(array(
			'shop' => $this->shop,
            'address' => $this->shop->address,
            'country' => $this->country,
            'faktura' => true,
            'email' => Configuration::get('PS_SHOP_EMAIL'),
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
        
	}

	/**
	 * Returns the tax tab content
	 */
	public function getTaxTabContent()
	{
			$address = new Address((int)$this->order->{Configuration::get('PS_TAX_ADDRESS_TYPE')});
			$tax_exempt = Configuration::get('VATNUMBER_MANAGEMENT')
								&& !empty($address->vat_number)
								&& $address->id_country != Configuration::get('VATNUMBER_COUNTRY');
			$carrier = new Carrier($this->order->id_carrier);
			
			$this->smarty->assign(array(
				'tax_exempt' => $tax_exempt,
				'use_one_after_another_method' => $this->order_invoice->useOneAfterAnotherTaxComputationMethod(),
				'product_tax_breakdown' => $this->order_invoice->getProductTaxesBreakdown(),
				'shipping_tax_breakdown' => $this->order_invoice->getShippingTaxesBreakdown($this->order),
				'ecotax_tax_breakdown' => $this->order_invoice->getEcoTaxTaxesBreakdown(),
				'wrapping_tax_breakdown' => $this->order_invoice->getWrappingTaxesBreakdown(),
				'order' => $this->order,
				'order_invoice' => $this->order_invoice,
				'carrier' => $carrier
			));

			return $this->smarty->fetch($this->getTemplate('invoice.tax-tab'));
	}
    
	public function getContent()
	{
		$country = new Country((int)$this->order->id_address_invoice);
		$invoice_address = new Address((int)$this->order->id_address_invoice);
		$formatted_invoice_address = AddressFormat::generateAddress($invoice_address, array(), '<br />', ' ',array('dni'=>'<br />IČO: %s','dic'=>'DIČ: %s','vat_number'=>'IČ DPH: %s'));
		$formatted_delivery_address = '';

		if ($this->order->id_address_delivery != $this->order->id_address_invoice)
		{
			$delivery_address = new Address((int)$this->order->id_address_delivery);
			$formatted_delivery_address = AddressFormat::generateAddress($delivery_address, array(), '<br />', ' ',array('dni'=>'<br />IČO: %s','dic'=>'DIČ: %s','vat_number'=>'IČ DPH: %s'));
		}

		$customer = new Customer((int)$this->order->id_customer);

		$this->smarty->assign(array(
			'order' => $this->order,
			'order_details' => $this->order_invoice->getProducts(),
			'cart_rules' => $this->order->getCartRules($this->order_invoice->id),
			'delivery_address' => $formatted_delivery_address,
			'invoice_address' => $formatted_invoice_address,
			'tax_excluded_display' => Group::getPriceDisplayMethod($customer->id_default_group),
			'tax_tab' => $this->getTaxTabContent(),
			'customer' => $customer
		));

		return $this->smarty->fetch($this->getTemplateByCountry($country->iso_code));
	}
    

	/**
	 * Returns the template filename
	 * @return string filename
	 */
	public function getFilename()
	{
		return 'Faktura_' . sprintf('%09d', $this->order->invoice_number).'.pdf';
	}
    
}

