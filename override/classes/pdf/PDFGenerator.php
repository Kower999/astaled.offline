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
class PDFGenerator extends PDFGeneratorCore
{
         
	const DEFAULT_FONT = 'dejavusans';
    
    public $isLastPage = false;

	public $altheader;
/*    
    public $smarty;

	public function __construct($use_cache = false)
	{
		parent::__construct('P', 'mm', 'A4', true, 'UTF-8', $use_cache, false);
        $this->smarty = Context::getContext()->smarty;
	}
*/

	/**
	 *
	 * set the PDF header
	 * @param string $header HTML
	 */
	public function createAltHeader($header)
	{
		$this->altheader = $header;
	}

    
	/**
	 * @see TCPDF::Header()
	 */
	public function Header()
	{
        if($this->PageNo() == 1) {
            $this->setMargins(5, 100, 5, true);            
            $this->writeHTML($this->header);            
        } else {
            $this->setMargins(5, 25, 5, true);            
            $this->writeHTML($this->altheader);                        
        }
	}

	/**
	 * Returns the shop address
	 * @return string
	 */
	protected function getShopAddress()
	{
		$shop_address = '';
		if (Validate::isLoadedObject(Context::getContext()->shop))
		{
			$shop_address_obj = Context::getContext()->shop->getAddress();
			if (isset($shop_address_obj) && $shop_address_obj instanceof Address)
				$shop_address = AddressFormat::generateAddress($shop_address_obj, array(), ' - ', ' ');
			return $shop_address;
		}

		return $shop_address;
	}

	/**
	 * @see TCPDF::Footer()
	 */
	public function Footer()
	{
        if($this->isLastPage) {	   
            $shop_address = $this->getShopAddress();
            Context::getContext()->smarty->assign(array(
                'available_in_your_account' => true,
                'shop_address' => $shop_address,
                'shop_fax' => Configuration::get('PS_SHOP_FAX'),
                'shop_phone' => Configuration::get('PS_SHOP_PHONE'),
                'shop_details' => Configuration::get('PS_SHOP_DETAILS'),
                'free_text' => Configuration::get('PS_INVOICE_FREE_TEXT', (int)Context::getContext()->language->id),
                'page' => $this->PageNo(),
                ));
            
            $this->writeHTML(Context::getContext()->smarty->fetch($this->getTemplate('footer')));            
        } else {
            Context::getContext()->smarty->assign(array(
                'page' => $this->PageNo(),
            ));                    
            $this->writeHTML(Context::getContext()->smarty->fetch($this->getTemplate('alt-footer')));            
        }
	}

	/**
	 * If the template is not present in the theme directory, it will return the default template
	 * in _PS_PDF_DIR_ directory
	 *
	 * @param $template_name
	 * @return string
	 */
	protected function getTemplate($template_name)
	{
		$template = false;
		$default_template = _PS_PDF_DIR_.'/'.$template_name.'.tpl';
		$overriden_template = _PS_THEME_DIR_.'/pdf/'.$template_name.'.tpl';

		if (file_exists($overriden_template))
			$template = $overriden_template;
		else if (file_exists($default_template))
			$template = $default_template;

		return $template;
	}

    
   	/**
	 * Reset pointer to the last document page.
	 * @param $resetmargins (boolean) if true reset left, right, top margins and Y position.
	 * @public
	 * @since 2.0.000 (2008-01-04)
	 * @see setPage(), getPage(), getNumPages()
	 */
	public function lastPage($resetmargins=false) {
		$this->setPage($this->getNumPages(), $resetmargins);
        $this->isLastPage = true;
	}


	/**
	 * Write a PDF page
	 */
	public function writePage()
	{
		$this->SetHeaderMargin(5);
		$this->SetFooterMargin(30);
        if($this->PageNo() > 1) {
        } else {
        }
		$this->AddPage('','',true);
//        $t = $this->getCellMargins();
//        var_dump($t);
        $this->setCellPaddings(0,0,0,0);

		$this->writeHTML($this->content, true, false, true, false, '');
	}
	

	public function __construct($use_cache = false)
	{
		parent::__construct($use_cache);
        $this->SetMargins(5,5,-1,true);
	}
    
}
