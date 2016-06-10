<?php
include_once dirname(__FILE__).'/../abstract/DataController.php';

class ImportProductsController extends DataController
{
	public function __construct()
	{
	 	$this->table = 'data_import';
		$this->className = 'ImportProducts';

		$this->fields_options = array(
			'general' => array(
				'title' =>	$this->l('Aktualizácia Cenníkov a Produktov'),
                'image' => _PS_ADMIN_IMG_.'../t/AdminImport.gif',                
                'description' => 'Uistite sa že ste pripojený k internetu pre stiahnutie aktualizácie cenníkov a katalógu produktov.',
			'submit' => array(
				'title' => $this->l('Aktualizovať'),
				'class' => 'button',
				'style' => 'display: block'
			)
			)
		);
		
		parent::__construct();
		$this->meta_title = $this->l('Aktualizácia Cenníkov a Produktov').' - '.$this->module->displayName;
		if (!$this->module->active)
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminHome'));

        $lov = $this->getUpdateVersion();
        
        if(!empty($lov)){
            if(_ASTALED_UPDATE_)
                if($lov != $this->last_version)
                    Tools::redirectAdmin($this->context->link->getAdminLink('Update') . "&presmerovanie=1&ver=".$lov);
        } else {
            $this->warnings[] = Tools::displayError('Pravdepodobne nieste pripojený k internetu alebo nastala chyba pri komunikácii s online serverom');            
        }

        $this->last_version = Configuration::get('LAST_UPDATE_PRODUCTS_VERSION');            
	}
    public function xml($file)
    {
        return simplexml_load_string (html_entity_decode(file_get_contents($file),ENT_XML1 , "UTF-8"));     
    }
        
    public function addImport($arr, $table)
    {
            $vals = $arr;
            $keys = array_keys($vals);

            array_walk($vals, 'decode_array');
                    
            $sql = 'INSERT INTO `'._DB_PREFIX_.$table.'` (`'.implode('`, `',$keys).'`) VALUES (\''.implode('\', \'',$vals).'\') ';

            Db::getInstance()->execute($sql);
            $w = Db::getInstance()->Insert_ID();
            return $w;
    }
    
    public function walkxml($file, $parent, $child, $pri_key, $table) 
    {
            $xml = $this->xml(_PS_UPLOAD_DIR_.'/import_tmp/'.$file);
            $ret = array();            
            
            Db::getInstance()->execute('TRUNCATE '._DB_PREFIX_.$table);
            
            foreach($xml->{$parent}->{$child} as $c)
            {
                $row = array();
                foreach($c as $field) {
                    $row[$field->getName()] = ''.$field;
                }
                $ret[$row[$pri_key]] = $row;
                
                $this->addImport( $row, $table);                                
            }
            
            return $ret;
        
    }
	
	public function postProcess() {
	   
        $field_name = 'zipfile';

		if (Tools::isSubmit('submitOptionsdata_import'))
		{
            $fname = 'export_products.xml';
            if(file_exists(_PS_DOWNLOAD_DIR_.$fname)){
                unlink(_PS_DOWNLOAD_DIR_.$fname);
            }
            file_put_contents(_PS_DOWNLOAD_DIR_.$fname, fopen(_PS_ONLINE_DOWNLOAD_.$fname, 'r'));
            
            $fs = filesize(_PS_DOWNLOAD_DIR_.$fname);
            
            if(file_exists(_PS_DOWNLOAD_DIR_.$fname) && !empty($fs)){
                $xml = $this->xml(_PS_DOWNLOAD_DIR_.$fname);
                
                if($this->last_version == ''.$xml->version){
                    $this->errors[] = Tools::displayError('Už máte nainštalovanú najaktuálnejšiu verziu databázy produktov. Nieje potrebná ďaľšia aktualizácia. Posledná verzia je: '.$this->last_version);
//			        unlink(_PS_DOWNLOAD_DIR_.$fname);
                    return;                                
                }
                
            } else {
                    $this->errors[] = Tools::displayError(' Chyba pri sťahovaní konfiguračného súboru aktualizácie produktov.');
                    return;                                                
            }

			unlink(_PS_DOWNLOAD_DIR_.$fname);
            
            $fname = $xml->file;

            if(file_exists(_PS_DOWNLOAD_DIR_.$fname)){
                unlink(_PS_DOWNLOAD_DIR_.$fname);
            }            
            file_put_contents(_PS_DOWNLOAD_DIR_.$fname, fopen(_PS_ONLINE_DOWNLOAD_.$fname, 'r'));

            $fs = filesize(_PS_DOWNLOAD_DIR_.$fname);
            if(!file_exists(_PS_DOWNLOAD_DIR_.$fname) || empty($fs)){
                    $this->errors[] = Tools::displayError(' Chyba pri sťahovaní aktualizačného súboru.');
                    return;                                                                
            }
                            
            $zip = new ZipArchive;
            $res = $zip->open(_PS_DOWNLOAD_DIR_.$fname);
            if ($res === TRUE) {
                $zip->extractTo(_PS_UPLOAD_DIR_.'/import_tmp/');
                $zip->close();
            } else {
                $this->errors[] = 'Error opening zip file ('.$res.')';
            }
            
            $pole['category'] = $this->walkxml('category.xml','categorys', 'category','id_category', 'category'); 
            $pole['product'] = $this->walkxml('product.xml','products', 'product','id_product', 'product');
            $pole['group'] = $this->walkxml('group.xml','groups', 'group','id_group', 'group');

            $pole['group_lang'] = $this->walkxml('group_lang.xml','group_langs','group_lang','id_group','group_lang');
            $pole['group_shop'] = $this->walkxml('group_shop.xml','group_shops','group_shop','id_group','group_shop');

            $pole['category_lang'] = $this->walkxml('category_lang.xml','category_langs','category_lang','id_category','category_lang');
            $pole['category_group'] = $this->walkxml('category_group.xml','category_groups','category_group','id_category','category_group');
            $pole['category_shop'] = $this->walkxml('category_shop.xml','category_shops','category_shop','id_category','category_shop');
            $pole['category_product'] = $this->walkxml('category_product.xml','category_products','category_product','id_category','category_product');
                                   
            $pole['product_lang'] = $this->walkxml('product_lang.xml','product_langs','product_lang','id_product','product_lang');
            $pole['product_shop'] = $this->walkxml('product_shop.xml','product_shops','product_shop','id_product','product_shop');
            $pole['product_provisions'] = $this->walkxml('product_provisions.xml','product_provisionss','product_provisions','id_product_provisions','product_provisions');
            $pole['product_vip_prices'] = $this->walkxml('product_vip_prices.xml','product_vip_pricess','product_vip_prices','id_product_vip_prices','product_vip_prices');

            if(!empty($pole['product']))
                foreach($pole['product'] as $id => $prd){
                    $sav = StockAvailable::getQuantityAvailableByProduct($id);
                    if(empty($sav)){
                        
                        Db::getInstance()->execute('REPLACE INTO new_stock_available ( id_product, id_product_attribute, id_shop, id_shop_group, quantity, depends_on_stock, out_of_stock)
	                           SELECT id_product, 0 AS id_product_attribute, 1 AS id_shop, 0 AS id_shop_group, 0 AS quantity, 0 AS depends_on_stock, 2 AS out_of_stock
	                           FROM new_product WHERE id_product = '.$id);
                        Db::getInstance()->execute('REPLACE INTO new_warehouse_product_location ( id_product, id_product_attribute, id_warehouse, location)
	                           SELECT id_product, 0 AS id_product_attribute, 1 AS id_warehouse, "" AS location
                               FROM new_product WHERE id_product = '.$id) ;                               
                    }                    
                }
//            var_dump($pole['category_lang']);           

			unlink(_PS_DOWNLOAD_DIR_.$fname);
            
            if(empty($this->errors)) {
                Configuration::updateValue('LAST_UPDATE_PRODUCTS_VERSION', ''.$xml->version);  
                $this->confirmations[] = Tools::displayError('Aktualizácia prebehla úspešne');
            }
            
		}

 
    }
	
}

    function decode_array(&$item1, $key)
    {
        $item1 = html_entity_decode($item1);
    }    
