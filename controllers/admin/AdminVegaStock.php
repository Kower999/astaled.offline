<?php
/*
* 2007-2013 PrestaShop
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
*  @copyright  2007-2013 PrestaShop SA
*  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class AdminVegaStock extends AdminController 
{

	public function __construct()
	{
		$this->className = 'VegaStock';

		// Upload quota
		$max_upload = (int)ini_get('upload_max_filesize');
		$max_post = (int)ini_get('post_max_size');
		$upload_mb = min($max_upload, $max_post);

		// Options list
		$this->fields_options = array(
			'general' => array(
				'title' =>	$this->l('Import výdajky z online systému'),
				'icon' =>	'tab-preferences',
                'description' => 'Uistite sa že ste pripojený k internetu pre stiahnutie aktualizácie stavu skladu.',
			'submit' => array(
				'title' => $this->l('Aktualizovať'),
				'class' => 'button',
				'style' => 'display: block'
			)
			)
		);
        
        if (!defined('_PS_ADMIN_IMPORT_'))
            define('_PS_ADMIN_IMPORT_',            _PS_ROOT_DIR_.'/shopadmin/import/');
        if (!defined('_PS_ONLINE_DOWNLOAD_'))
            define('_PS_ONLINE_DOWNLOAD_',         'http://astaled.sk/shopadmin/export/');

		parent::__construct();
		
	}
    
    public function displayAjaxAktualizujSklad(){
//        if (Context::getContext()->employee->isLoggedBack() && (Context::getContext()->employee->id_profile == 5) ) {

        $id = Context::getContext()->employee->id;
        $fname = $id.'_vydajka.xls';
        $notimp = array();
        $imported = array();
        
        file_put_contents(_PS_ADMIN_IMPORT_.$fname, fopen(_PS_ONLINE_DOWNLOAD_.$fname, 'r'));
        
        if(file_exists(_PS_ADMIN_IMPORT_.$fname)){
			require_once 'excel_reader2.php';
			$data = new Spreadsheet_Excel_Reader(_PS_ADMIN_IMPORT_.$fname);

			for($row=24; $row<=$data->rowcount(); $row++) {
            	$ean = $data->val($row, 'T'); 
				$ean = str_replace("'", "", $ean);
				$amnt = $data->val($row, 'W'); 
            	$amnt = str_replace(" ", "", $amnt);
            	$amnt = str_replace(",000", "", $amnt);
            	$amnt = str_replace("'", "", $amnt);  
				
				if (strlen($ean) > 0) {
					$product = Db::getInstance()->getValue("SELECT id_product FROM new_product WHERE ean13 = '".$ean."'");
//					$product = $product['id_product'];
					if ((int)$product > 0) {						
						$cnt = Db::getInstance()->getRow("SELECT COUNT(id_product) as cnt FROM new_stock_available WHERE id_product = ".$product);
						if ($cnt['cnt'] > 0) {
							Db::getInstance()->Execute("UPDATE new_stock_available SET quantity = ( quantity + ".intval($amnt).") WHERE id_product = ".$product);
						} else {
							Db::getInstance()->Execute("INSERT INTO new_stock_available(id_product, id_product_attribute, id_shop, id_shop_group, quantity, depends_on_stock, out_of_stock) VALUES(".$product.", 0, 1, 0, ".intval($amnt).", 1 , 1)");
						}
						$imported[] = $ean;
					} else $notimp[] = $ean;
					
				}
			}
            
        }
        
        die(json_encode(array('not_imported'=> $notimp,'imported' => $imported, 'warning'=>!empty($notimp))));
    }
    
    public function renderOptions() {
        $this->addJS(_PS_JS_DIR_.'VegaStock.js');
        
        return parent::renderOptions();
    }

	public function postProcess()
	{
		if (Tools::isSubmit('submitOptionsconfiguration')) {
			$newname = $_SERVER['DOCUMENT_ROOT'].'/shopadmin/import/subor.xls';  
			//echo $newname;
			//print_r($_FILES['mrpfile']);
			move_uploaded_file($_FILES['mrpfile']['tmp_name'],$newname);			
			require_once 'excel_reader2.php';
			$data = new Spreadsheet_Excel_Reader($newname);

			for($row=8; $row<=$data->rowcount(); $row++) {
//            	$ean = $data->val($row, 'K'); 
//				$ean = str_replace("'", "", $ean);
            	$code = $data->val($row, 'N'); // bolo L
				$code = str_replace("'", "", $code);
				$amnt = $data->val($row, 'I'); // bolo J
            	$amnt = str_replace(" ", "", $amnt);
            	$amnt = str_replace(",000", "", $amnt);
            	$amnt = str_replace("'", "", $amnt);  // povodne nebolo
				
				if (strlen($code) > 0) {
                } else if (strlen($code)) {
					$cnt = Db::getInstance()->getRow("SELECT COUNT(id_product) as cnt FROM new_product WHERE reference = '".$code."'");
					if ($cnt['cnt'] > 0) {
						$product = Db::getInstance()->getRow("SELECT id_product FROM new_product WHERE reference = '".$code."'");
						$product = $product['id_product'];
						
						$cnt = Db::getInstance()->getRow("SELECT COUNT(id_product) as cnt FROM new_stock_available WHERE id_product = ".$product);
						if ($cnt['cnt'] > 0) {
							Db::getInstance()->Execute("UPDATE new_stock_available SET quantity = ".intval($amnt)." WHERE id_product = ".$product);
						} else {
							Db::getInstance()->Execute("INSERT INTO new_stock_available(id_product, id_product_attribute, id_shop, id_shop_group, quantity, depends_on_stock, out_of_stock) VALUES(".$product.", 0, 1, 0, ".intval($amnt).", 0 , 2)");
						}
						echo $code.": ".$amnt."<br/>"; 
					}
					
				}
			}
            
            
		}
		//parent::postProcess();
	}

}
/*
function get_id_product_by_ean_or_reference($ean,$code){
    $cnt = 0;
    if (strlen($ean) > 0) {
        $cnt = Db::getInstance()->getRow("SELECT COUNT(id_product) as cnt FROM new_product WHERE ean13 = '".$ean."'");
    } else if (strlen($code)) {
        $cnt = Db::getInstance()->getRow("SELECT COUNT(id_product) as cnt FROM new_product WHERE reference = '".$code."'");					
    }
    
					if ($cnt['cnt'] > 0) {
						$product = Db::getInstance()->getRow("SELECT id_product FROM new_product WHERE reference = '".$code."'");
						$product = $product['id_product'];
						
						$cnt = Db::getInstance()->getRow("SELECT COUNT(id_product) as cnt FROM new_stock_available WHERE id_product = ".$product);
						if ($cnt['cnt'] > 0) {
							Db::getInstance()->Execute("UPDATE new_stock_available SET quantity = ".intval($amnt)." WHERE id_product = ".$product);
						} else {
							Db::getInstance()->Execute("INSERT INTO new_stock_available(id_product, id_product_attribute, id_shop, id_shop_group, quantity, depends_on_stock, out_of_stock) VALUES(".$product.", 0, 1, 0, ".intval($amnt).", 0 , 2)");
						}
						echo $code.": ".$amnt."<br/>"; 
					}
    
}
*/