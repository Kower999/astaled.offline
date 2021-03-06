<?php
include_once dirname(__FILE__).'/../abstract/DataController.php';

class ExportProductsController extends DataController
{
	public function __construct()
	{
		$this->display = '';
        $this->className = 'ExportProducts';
		parent::__construct();
        
		$this->meta_title = $this->l('Export Produktov').' - '.$this->module->displayName;
		if (!$this->module->active)
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminHome'));
	}
	
	public function initContent()
	{
		$error_msg = '';
		
		parent::initContent();
	
        $this->content .= $this->initFormExport();
// 		$this->content .= $this->fetch('Export.tpl'); zatial nepotrebne
		
		$this->assign('content', $this->content);
		
	}

    public function initFormExport()
    {

$this->fields_form = array(
        'legend' => array(
            'title' => $this->l('Export dát produktov'),
            'image' => '../img/admin/details.gif'
        )
    );

    $this->fields_form['submit'] = array(
        'title' => $this->l('Export'),
        'class' => 'button',
        'icon' => 'process-icon-download-alt'
    );
//    $this->show_toolbar = false;
    $this->toolbar_btn = null;

    return $this->renderForm();
    }

    private function addToXML(&$xml_obj,$result,$element){
/*        if($element == 'carrier') {
            mydump($result);
        }
*/        
        $keys = array_keys($result);
        $xml = $xml_obj->addChild($element);
        foreach($keys as $key){
            $xml->addChild($key,'<![CDATA['.htmlentities($result[$key],16 , "UTF-8").']]>');   
        }                            
    }


	public function postProcess() {
	  if(Tools::isSubmit('submitAdd')){   
                
            $category_table_list = array(
                'category_group' => array(),
                'category_lang' => array(),
                'category_shop' => array(),
                'category_product' => array(),
            );
// neexportujeme : attachement / attribute / carrier / country tax / download / group reduction cache / supplier / tag 
// product_sale bud netreba alebo bude specialny import ...              
            $product_table_list = array(
                'product_lang' => array(),
                'product_shop' => array(),
                'product_provisions' => array(),
                'product_vip_prices' => array(),
            );

            $group_table_list = array(
                'group_lang' => array(),
                'group_shop' => array(),
            );

            $carrier_table_list = array(
/*                'carrier_group' => array(),
                'carrier_lang' => array(),
                'carrier_shop' => array(),
                'carrier_tax_rules_group_shop' => array(),
                'carrier_zone' => array(),
*/                
            );
                        
            $prefix = _DB_PREFIX_;
            
            $lang_id = $this->context->language->id;
            $cats = Category::getSimpleCategories($lang_id);
            $prds = Product::getSimpleProducts($lang_id);
            $grps = Group::getGroups($lang_id);
            $carriers = Carrier::getCarriers($lang_id,true);
            
            if(!empty($carriers)) {
                foreach($carriers as $key => $carrier){
                    $carriers[$key]['base_id'] = $this->getCarrierIdentifier($carrier['id_carrier']);
                }
            }

//            mydump($carriers,false);
//            $this->getCarrierIdentifier(11);

            $to_export = array(
                array(
                    'table' => 'carrier',
                    'identifier' => 'id_carrier',
                    'values' => $carriers,
                    'sub_table_list' => $carrier_table_list
                ),
                array(
                    'table' => 'category',
                    'identifier' => 'id_category',
                    'values' => $cats,
                    'sub_table_list' => $category_table_list
                ),
                array(
                    'table' => 'product',
                    'identifier' => 'id_product',
                    'values' => $prds,
                    'sub_table_list' => $product_table_list
                ),
                array(
                    'table' => 'group',
                    'identifier' => 'id_group',
                    'values' => $grps,
                    'sub_table_list' => $group_table_list
                ),
            );

            
            $zip = new ZipArchive();
            $file = "Export_products.zip";
            $ver = time();
            $zip_name = _PS_DOWNLOAD_DIR_.$file; // Zip name
            
            $config = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
            $config->addChild('file','<![CDATA['.$file.']]>');
            $config->addChild('version','<![CDATA['.$ver.']]>');
            $config->asXML(_PS_DOWNLOAD_DIR_.'export_products.xml');
            
            
            $zip->open($zip_name,  ZipArchive::CREATE);
            $xml_array = array();
            
                    foreach($to_export as $e){
                        // vytvorenie zakladnych xml objektov 
                        $table = $e['table'];
                        $xml_array[$table] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                        $xmlos[$table] = $xml_array[$table]->addChild($table.'s');
                    
                        foreach($e['sub_table_list'] as $ot => $subtables){
                            $xml_array[$ot] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                            $xmlos[$ot] = $xml_array[$ot]->addChild($ot.'s');
                            if(!empty($subtables)){
                                foreach($subtables as $st){
                                    $xml_array[$st] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                                    $xmlos[$st] = $xml_array[$st]->addChild($st.'s');                                    
                                }
                            }                                                                
                        }
                        // plnenie objektov 
                        foreach($e['values'] as $r){
                            $table = $e['table'];
                            $order = Db::getInstance()->getRow("SELECT * FROM `".$prefix.$table."` WHERE ".$e['identifier']." = ".$r[$e['identifier']]);
                            if($table == 'carrier'){
                                $order['base_id'] = $r['base_id'];
                                $carrier = new Carrier((int)$r['id_carrier']);
                                $order['delay'] = base64_encode(json_encode($carrier->delay));
//                                mydump($carrier->delay);
                            }
                            $this->addToXML($xmlos[$table],$order,$table);
                            if(!empty($e['sub_table_list'])){
                                foreach($e['sub_table_list'] as $table => $subtables){                            
                                    $rows = Db::getInstance()->executeS("SELECT * FROM `".$prefix.$table."` WHERE ".$e['identifier']." = ".$r[$e['identifier']]);
                                    if(!empty($rows))
                                        foreach($rows as $row){
                                            $this->addToXML($xmlos[$table],$row,$table);                                    
                                        }                        
                                }
                            }
                        }
                        
                        // vystup xml suborov do zipu 
                        $table = $e['table'];
                        $zip->addFromString($table.'.xml',$xml_array[$table]->asXML());
                        foreach($e['sub_table_list'] as $table => $subtables){                            
                            $zip->addFromString($table.'.xml',$xml_array[$table]->asXML());                        
                        }                                                
                        
                        
                    }
/*                    
                    // vytvorenie zakladnych xml objektov 
                    $table = 'carrier';
                    $xml_array[$table] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                    $xmlos[$table] = $xml_array[$table]->addChild($table.'s');
                    
                    foreach($carrier_table_list as $ot => $subtables){
                            $xml_array[$ot] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                            $xmlos[$ot] = $xml_array[$ot]->addChild($ot.'s');
                            if(!empty($subtables)){
                                foreach($subtables as $st){
                                    $xml_array[$st] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                                    $xmlos[$st] = $xml_array[$st]->addChild($st.'s');                                    
                                }
                            }                                                                
                    }
                              
                    $table = 'category';
                    $xml_array[$table] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                    $xmlos[$table] = $xml_array[$table]->addChild($table.'s');
                    
                    foreach($category_table_list as $ot => $subtables){
                            $xml_array[$ot] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                            $xmlos[$ot] = $xml_array[$ot]->addChild($ot.'s');
                            if(!empty($subtables)){
                                foreach($subtables as $st){
                                    $xml_array[$st] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                                    $xmlos[$st] = $xml_array[$st]->addChild($st.'s');                                    
                                }
                            }                                                                
                    }          

                    $table = 'product';
                    $xml_array[$table] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                    $xmlos[$table] = $xml_array[$table]->addChild($table.'s');
                    
                    foreach($product_table_list as $ot => $subtables){
                            $xml_array[$ot] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                            $xmlos[$ot] = $xml_array[$ot]->addChild($ot.'s');
                            if(!empty($subtables)){
                                foreach($subtables as $st){
                                    $xml_array[$st] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                                    $xmlos[$st] = $xml_array[$st]->addChild($st.'s');                                    
                                }
                            }                                                                
                    }          

                    $table = 'group';
                    $xml_array[$table] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                    $xmlos[$table] = $xml_array[$table]->addChild($table.'s');
                    
                    foreach($group_table_list as $ot => $subtables){
                            $xml_array[$ot] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                            $xmlos[$ot] = $xml_array[$ot]->addChild($ot.'s');
                            if(!empty($subtables)){
                                foreach($subtables as $st){
                                    $xml_array[$st] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                                    $xmlos[$st] = $xml_array[$st]->addChild($st.'s');                                    
                                }
                            }                                                                
                    }          
                                  
                    // koniec vytvaranie zakl xml objektov 

                    foreach($carriers as $r){
                        $table = 'carrier';
                        $order = Db::getInstance()->getRow("SELECT * FROM `".$prefix.$table."` WHERE id_carrier = ".$r['id_carrier']);
                        $this->addToXML($xmlos[$table],$order,$table);
                        
                        foreach($carrier_table_list as $table => $subtables){                            
                            $rows = Db::getInstance()->executeS("SELECT * FROM `".$prefix.$table."` WHERE id_carrier = ".$r['id_carrier']);
                            if(!empty($rows))
                                foreach($rows as $row){
                                    $this->addToXML($xmlos[$table],$row,$table);                                    
                                }
                        
                        }
                    }
                    
                    
                    foreach($cats as $r){
                        $table = 'category';
                        $order = Db::getInstance()->getRow("SELECT * FROM `".$prefix.$table."` WHERE id_category = ".$r['id_category']);
                        $this->addToXML($xmlos[$table],$order,$table);
                        
                        foreach($category_table_list as $table => $subtables){                            
                            $rows = Db::getInstance()->executeS("SELECT * FROM `".$prefix.$table."` WHERE id_category = ".$r['id_category']);
                            if(!empty($rows))
                                foreach($rows as $row){
                                    $this->addToXML($xmlos[$table],$row,$table);                                    
                                }
                        
                        }
                    }

                    foreach($prds as $r){
                        $table = 'product';
                        $order = Db::getInstance()->getRow("SELECT * FROM `".$prefix.$table."` WHERE id_product = ".$r['id_product']);
                        $this->addToXML($xmlos[$table],$order,$table);
                        
                        foreach($product_table_list as $table => $subtables){                            
                            $rows = Db::getInstance()->executeS("SELECT * FROM `".$prefix.$table."` WHERE id_product = ".$r['id_product']);
                            if(!empty($rows))
                                foreach($rows as $row){
                                    $this->addToXML($xmlos[$table],$row,$table);                                    
                                }
                        
                        }
                    }

                    foreach($grps as $r){
                        $table = 'group';
                        $order = Db::getInstance()->getRow("SELECT * FROM `".$prefix.$table."` WHERE id_group = ".$r['id_group']);
                        $this->addToXML($xmlos[$table],$order,$table);
                        
                        foreach($group_table_list as $table => $subtables){                            
                            $rows = Db::getInstance()->executeS("SELECT * FROM `".$prefix.$table."` WHERE id_group = ".$r['id_group']);
                            if(!empty($rows))
                                foreach($rows as $row){
                                    $this->addToXML($xmlos[$table],$row,$table);                                    
                                }
                        
                        }
                    }
                        
                    // vystup xml suborov do zipu 
                    $table = 'carrier';
                    $zip->addFromString($table.'.xml',$xml_array[$table]->asXML());
                    foreach($category_table_list as $table => $subtables){                            
                        $zip->addFromString($table.'.xml',$xml_array[$table]->asXML());                        
                    }                                                

                    $table = 'category';
                    $zip->addFromString($table.'.xml',$xml_array[$table]->asXML());
                    foreach($category_table_list as $table => $subtables){                            
                        $zip->addFromString($table.'.xml',$xml_array[$table]->asXML());                        
                    }                                                

                    $table = 'product';
                    $zip->addFromString($table.'.xml',$xml_array[$table]->asXML());
                    foreach($product_table_list as $table => $subtables){                            
                        $zip->addFromString($table.'.xml',$xml_array[$table]->asXML());                        
                    }                                                

                    $table = 'group';
                    $zip->addFromString($table.'.xml',$xml_array[$table]->asXML());
                    foreach($group_table_list as $table => $subtables){                            
                        $zip->addFromString($table.'.xml',$xml_array[$table]->asXML());                        
                    }                                                
                    
                    // koniec vystupu xml suborov do zipu 
*/                    
                    

            $zip->close();
            
            $this->confirmations[] = Tools::displayError('Export prebehol úspešne');
            
            
/*
            header('Content-Type: application/zip');
            header('Content-disposition: attachment; filename='.basename($zip_name));
            header('Content-Length: ' . filesize($zip_name));
            readfile($zip_name);
            unlink($zip_name);        	   
*/            
	   
      }
    }	
}