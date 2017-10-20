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
            if(DataController::isThisOnline())
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

    public function walkxmlcarrier($file, $parent, $child, $pri_key, $table) 
    {
            $xml = $this->xml(_PS_UPLOAD_DIR_.'/import_tmp/'.$file);
            $ret = array();            
            
//            Db::getInstance()->execute('TRUNCATE '._DB_PREFIX_.$table);
            
            foreach($xml->{$parent}->{$child} as $c)
            {
                $row = array();
                foreach($c as $field) {
                    $row[$field->getName()] = ''.$field;
                }
                $ret[$row[$pri_key]] = $row;
                
                $carrier_base_id = $row['base_id']; // base_id zo serveru
                
                $carrier = $this->getCarrierByName($row['name']);
                
                $create_new_carrier = false;
                $carrier_found = false;
                if(!empty($carrier) && !empty($carrier->id) && !empty($carrier_base_id) && !empty($carrier->base_id)){
                    if($carrier_base_id != $carrier->base_id){
                        // dopravca sa nasiel ale nezhoduje sa s online takze musime spravit upravu dopravcu
                        
                        $create_new_carrier = true;
/*
                        mydump($carrier_base_id,false,'base_id zo serveru:');
                        $cbi= $this->getCarrierIdentifier($new_carrier->id);
                        mydump($cbi,false,'base_id noveho:');

                        mydump(($cbi == $carrier_base_id),false,'porovnanie:');

                        $ncdata = json_decode(base64_decode($cbi));

                        mydump($new_carrier_data,false,'data zo serveru:');
                        mydump($ncdata,false,'data nove:');
                        
                        
                        die('novy carrier');
*/
                        // vytvorenie kopie a zmena udajov podla online hotove
                        
/*                        
                        mydump($new_carrier,false,"new carrier:");
                        mydump($carrier,false,"carrier found by name:");
                        mydump($row,false,"carrier from server:");

                        mydump($new_carrier_data,false, 'newdata:');
                        mydump($carrier_base_id,false, 'carrier_base_id:');
                        
                        die('carriers found and not same');
*/                        
                    } else {
                        // nasla sa uplna zhoda dopravcu cien aj rozsahov tu neriesime nic
                    }
                    $carrier_found = true;                    
                } else {
                    $create_new_carrier = true;
/*                    mydump($row,false,"carrier from server:");
                    mydump($carrier,false,"carrier found by name:");
                    die('carriers or match not found');
*/                    
                }

                if($create_new_carrier) {
//                        mydump($row,false,'row:');
//                        mydump(,true,'row:');
                        $delays = json_decode(base64_decode($row['delay']));
                        $new_delays = array();
                        if(!empty($delays)){
                            foreach($delays as $key => $delay){
                                $new_delays[$key] = $delay;
                            }
                        }
                        // najprv vytvorit noveho dopravcu potom dat prikaz na skopirovanie dat zo stareho a tie potom upravime podla novych dat
                        $new_carrier = new Carrier();
                        $fields = array_keys(Carrier::$definition['fields']);
                        if(!empty($fields)){
                            foreach($fields as $field){
                                if($field != 'delay') {
                                    $new_carrier->{$field} = $row[$field];                                    
                                } else {
                                    $new_carrier->{$field} = $new_delays;
                                }
                            }
                        }
                        $new_carrier->add();
//                        mydump($new_carrier);
                        
//                        $new_carrier->copyCarrierData($carrier->id);// skopirovanie dat zo stareho
// copyCarrierData
                        if($carrier_found){
                            $old_id = $carrier->id;

                            $old_logo = _PS_SHIP_IMG_DIR_.'/'.(int)$old_id.'.jpg';
                            if (file_exists($old_logo))
                                copy($old_logo, _PS_SHIP_IMG_DIR_.'/'.(int)$new_carrier->id.'.jpg');

                            $old_tmp_logo = _PS_TMP_IMG_DIR_.'/carrier_mini_'.(int)$old_id.'.jpg';
                            if (file_exists($old_tmp_logo))
                            {
                                if (!isset($_FILES['logo']))
                                    copy($old_tmp_logo, _PS_TMP_IMG_DIR_.'/carrier_mini_'.$new_carrier->id.'.jpg');
                                unlink($old_tmp_logo);
                            }                            
                            //Copy default carrier
                            if (Configuration::get('PS_CARRIER_DEFAULT') == $old_id)
                                Configuration::updateValue('PS_CARRIER_DEFAULT', (int)$new_carrier->id);

                            // Copy reference
                            Db::getInstance()->execute('
                                UPDATE `'._DB_PREFIX_.'carrier`
                                SET `id_reference` = '.(int)$carrier->id_reference.'
                                WHERE `id_carrier` = '.(int)$new_carrier->id);

                            // Copy tax rules group
                            Db::getInstance()->execute('INSERT INTO `'._DB_PREFIX_.'carrier_tax_rules_group_shop` (`id_carrier`, `id_tax_rules_group`, `id_shop`)
                                (SELECT '.(int)$new_carrier->id.', `id_tax_rules_group`, `id_shop`
                                FROM `'._DB_PREFIX_.'carrier_tax_rules_group_shop`
                                WHERE `id_carrier`='.(int)$old_id.')');
                            // Update warehouse_carriers
                            Db::getInstance()->execute('UPDATE '._DB_PREFIX_.'warehouse_carrier SET id_carrier='.(int)$new_carrier->id.' WHERE id_carrier='.(int)$old_id);
                        
                            $carrier->active = false;
                            $carrier->deleted = true;
                            if(empty($carrier->delay))
                                mydump($carrier);
                            $carrier->update();                            
                        } else {
                            $new_carrier->id_reference = $new_carrier->id;
                            $new_carrier->update();
                            if($new_carrier->name == "Osobný odber") {
                                if ((int)Configuration::get('PS_CARRIER_DEFAULT') != (int)$new_carrier->id)
                                    Configuration::updateValue('PS_CARRIER_DEFAULT', (int)$new_carrier->id);
                                Db::getInstance()->execute('UPDATE '._DB_PREFIX_.'warehouse_carrier SET id_carrier='.(int)$new_carrier->id.' WHERE 1');
                            }                            
                        }

                        $new_carrier_data = json_decode(base64_decode($carrier_base_id));
        
//                        mydump($new_carrier_data,true, 'newdata:');
        
                        if(!empty($new_carrier_data)){
                            if(!empty($new_carrier_data->deliveries)) {
                                foreach($new_carrier_data->deliveries as $delivery_range){
                                    if(!is_null($delivery_range->delimiter1_weight) && !is_null($delivery_range->delimiter2_weight) ) {
                                        $range =  'range_weight';                         
                                    }
                                    if(!is_null($delivery_range->delimiter1_price) && !is_null($delivery_range->delimiter2_price) ) {
                                        $range =  'range_price';                         
                                    }
                    
                                    $range_part = str_replace('range_','',$range);
                    
                                    
			                        $sql = 'SELECT r.`id_'.$range.'`
					                   FROM `'._DB_PREFIX_.$range.'` r
					                   WHERE r.`id_carrier` = '.(int)$new_carrier->id.'
						                  AND r.`delimiter1` = '.(float)$delivery_range->{'delimiter1_'.$range_part}.'  
						                  AND r.`delimiter2` = '.(float)$delivery_range->{'delimiter2_'.$range_part}.'  
					                   ORDER BY r.`delimiter1` ASC';
			                        $range_id = (int)Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
                                    
                                    if(empty($range_id)) {
                                        Db::getInstance()->execute(' INSERT INTO `'._DB_PREFIX_.$range.'` (`id_carrier`, `delimiter1`, `delimiter2`)
                                            VALUES ('.$new_carrier->id.',' . (float)$delivery_range->{'delimiter1_'.$range_part} . ',' . (float)$delivery_range->{'delimiter2_'.$range_part} . ')');
                                        $range_id = (int)Db::getInstance()->Insert_ID();                                        
                                    }

                                    $range_price_id = ($range == 'range_price') ? $range_id : 'NULL';
                                    $range_weight_id = ($range == 'range_weight') ? $range_id : 'NULL';
//mydump($delivery_range);
                                    Db::getInstance()->execute('
                                        INSERT INTO `'._DB_PREFIX_.'delivery` (`id_carrier`, `id_shop`, `id_shop_group`, `id_range_price`, `id_range_weight`, `id_zone`, `price`) VALUES (
                                            '.(int)$new_carrier->id.', 
                                            '. (empty($delivery_range->id_shop) ? 'NULL' : $delivery_range->id_shop) .',
                                            '. (empty($delivery_range->id_shop_group) ? 'NULL' : $delivery_range->id_shop_group) .',
                                            '.(int)$range_price_id.',
                                            '.(int)$range_weight_id.',
                                            '. (empty($delivery_range->id_zone) ? 'NULL' : $delivery_range->id_zone) .',
                                            '.(float)$delivery_range->price.'
                                        )
                                    ');                    
                                }
                            }
                            
                            // Copy existing zones from data from server
                            if(!empty($new_carrier_data->zones)) {
                                foreach($new_carrier_data->zones as $zone){
                                    Db::getInstance()->execute('
                                        INSERT INTO `'._DB_PREFIX_.'carrier_zone` (`id_carrier`, `id_zone`)
                                        VALUES ('.$new_carrier->id.','.(int)$zone->id_zone.')
                                    ');
                                }
                            }

                            // skopirovanie prav pre skupiny pre noveho dopravcu  z dat zo serveru
                            $datatowrite = array();
                            if(!empty($new_carrier_data->groups)) {
                                foreach($new_carrier_data->groups as $group){
                                    $datatowrite[] = array(
                                        'id_carrier' => $new_carrier->id,
                                        'id_group' => $group->id_group,
                                    );                                
                                }
                            }
                            if(!empty($datatowrite)){
                                Db::getInstance()->insert('carrier_group', $datatowrite, false, false, Db::INSERT);                            
                            }
                        } // if(!empty($new_carrier_data)){
                        // koniec copyCarrierData
                }
            }
//            die("all carriers checked");
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
            
            $pole['carrier'] = $this->walkxmlcarrier('carrier.xml','carriers', 'carrier','id_carrier', 'carrier'); 

            $pole['category'] = $this->walkxml('category.xml','categorys', 'category','id_category', 'category'); 
            $pole['product'] = $this->walkxml('product.xml','products', 'product','id_product', 'product');
            $pole['group'] = $this->walkxml('group.xml','groups', 'group','id_group', 'group');

/*
            $pole['carrier_group'] = $this->walkxml('carrier_group.xml','carrier_groups','carrier_group','id_carrier','carrier_group');
            $pole['carrier_lang'] = $this->walkxml('carrier_lang.xml','carrier_langs','carrier_lang','id_carrier','carrier_lang');
            $pole['carrier_shop'] = $this->walkxml('carrier_shop.xml','carrier_shops','carrier_shop','id_carrier','carrier_shop');
            $pole['carrier_tax_rules_group_shop'] = $this->walkxml('carrier_tax_rules_group_shop.xml','carrier_tax_rules_group_shops','carrier_tax_rules_group_shop','id_carrier','carrier_tax_rules_group_shop');
            $pole['carrier_zone'] = $this->walkxml('carrier_zone.xml','carrier_zones','carrier_zone','id_carrier','carrier_zone');
*/

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
	                           SELECT id_product, 0 AS id_product_attribute, 1 AS id_shop, 0 AS id_shop_group, 0 AS quantity, 0 AS depends_on_stock, 1 AS out_of_stock
	                           FROM new_product WHERE id_product = '.$id);
                        Db::getInstance()->execute('REPLACE INTO new_warehouse_product_location ( id_product, id_product_attribute, id_warehouse, location)
	                           SELECT id_product, 0 AS id_product_attribute, 1 AS id_warehouse, "" AS location
                               FROM new_product WHERE id_product = '.$id) ;                               
                    }/* else {
                        Db::getInstance()->execute('REPLACE INTO new_stock_available ( id_product, id_product_attribute, id_shop, id_shop_group, depends_on_stock, out_of_stock)
	                           SELECT id_product, 0 AS id_product_attribute, 1 AS id_shop, 0 AS id_shop_group, 0 AS depends_on_stock, 1 AS out_of_stock
	                           FROM new_product WHERE id_product = '.$id);                        
                    }  */                  
                }
              Db::getInstance()->execute('UPDATE new_stock_available SET out_of_stock = 1 WHERE 1');
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
        $item1 = pSQL(html_entity_decode($item1));
    }    
