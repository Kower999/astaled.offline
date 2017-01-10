<?php
include_once dirname(__FILE__).'/../abstract/DataController.php';

class ExportController extends DataController
{
	public function __construct()
	{
		$this->display = '';
        $this->className = 'Data';
		parent::__construct();
        
		$this->meta_title = $this->l('Export').' - '.$this->module->displayName;
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
            'title' => $this->l('Export dát objednávok'),
            'image' => '../img/admin/details.gif'
        ),
        'input' => array(
            array(
                'type' => 'date',
                'label' => $this->l('Od'),
                'name' => 'from',
                'lang' => FALSE,
                'size' => 20,
                'required' => TRUE,
                'hint' => $this->l('Formát: 2011-12-31')
            ),
            array(
                'type' => 'date',
                'label' => $this->l('Do'),
                'name' => 'to',
                'lang' => FALSE,
                'size' => 20,
                'required' => TRUE,
                'hint' => $this->l('Formát: 2011-12-31')
            ),
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
        $keys = array_keys($result);
        $xml = $xml_obj->addChild($element);
        foreach($keys as $key){
            $xml->addChild($key,'<![CDATA['.htmlentities($result[$key],ENT_XML1 , "UTF-8").']]>');   
        }                            
    }


	public function postProcess() {
	  if(Tools::isSubmit('submitAdd')){   
	    $from = Tools::getValue('from');
        $to = Tools::getValue('to');
        
//        $faktury = (bool)Tools::getValue('faktury');
//        $objednavky = (bool)Tools::getValue('objednavky');
//        $zakaznici = (bool)Tools::getValue('zakaznici');
//        $tovar = (bool)Tools::getValue('tovar');
        
		if(empty( $from))		      
			$this->errors[] = Tools::displayError('Počiatočný dátum nebol zvolený.');
		if(empty( $to))		      
			$this->errors[] = Tools::displayError('Konečný dátum nebol zvolený.');
        if(!Validate::isDate($from) && !empty($from))
			$this->errors[] = Tools::displayError('Nesprávny formát počiatočného dátumu.');
        if(!Validate::isDate($to) && !empty($to))
			$this->errors[] = Tools::displayError('Nesprávny formát konečného dátumu.');
            
        
        
        if(empty($this->errors)){
            $order_table_list = array(
                'order_carrier' => array(),
                'order_cart_rule' => array(),
                'order_detail' => array('order_detail_tax'),
                'order_history' => array(),
                'order_invoice' => array('order_payment','order_invoice_payment','order_invoice_tax'),
//                
//                dorobit navratky ked bude treba
// 
//                'order_return' => array(),
//                'order_return_detail' => array(),

//
//                dorobit dodacie listy ked bude treba (zatial nebol ziadny)
//
//                'order_slip' => array(),
//                'order_slip_detail' => array(),
            );
            $order_payment_table = 'order_payment'; // odkazovat podla reference a nie podla id_order ktore v tabulke nieje
            $address_table = 'address';
            

            $cart_table_list = array(
                'cart_cart_rule' => array(),
                'specific_price' => array()//array('specific_price_priority'),
            );
            $cart_rule_table_list = array(
                'cart_rule_lang' => array()
            );
            
            $customer_table_list = array(
                'customer_group' => array(),
                'customer_thread' => array('customer_message')
            );
            $prefix = _DB_PREFIX_;
            
            $orders = Order::getOrdersIdByDate($from, $to);
            $orders_array = array();
            
            $zip = new ZipArchive();
            $zip_name = _PS_DOWNLOAD_DIR_."Export".time().".zip"; // Zip name
            $zip->open($zip_name,  ZipArchive::CREATE);
            $xml_array = array();
            
/* ---------------- Objednavky a veci s tym suvisiace ----------------- */            
//            if($objednavky){
                if(!empty($orders)){
                    /* vytvorenie zakladnych xml objektov */
                    $table = 'order';
                    $xml_array[$table] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                    $xmlos[$table] = $xml_array[$table]->addChild($table.'s');
                    
                    foreach($order_table_list as $ot => $subtables){
                            $xml_array[$ot] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                            $xmlos[$ot] = $xml_array[$ot]->addChild($ot.'s');
                            if(!empty($subtables)){
                                foreach($subtables as $st){
                                    $xml_array[$st] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                                    $xmlos[$st] = $xml_array[$st]->addChild($st.'s');                                    
                                }
                            }                                                                
                    }          

                    $table = $order_payment_table;
                    $xml_array[$table] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                    $xmlos[$table] = $xml_array[$table]->addChild($table.'s');

                    $table = $address_table;
                    $xml_array[$table] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                    $xmlos[$table] = $xml_array[$table]->addChild($table.'es');


                    $table = 'cart';
                    $xml_array[$table] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                    $xmlos[$table] = $xml_array[$table]->addChild($table.'s');                    
                    foreach($cart_table_list as $ot => $subtables){
                            $xml_array[$ot] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                            $xmlos[$ot] = $xml_array[$ot]->addChild($ot.'s');
                            if(!empty($subtables)){
                                foreach($subtables as $st){
                                    $xml_array[$st] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                                    $xmlos[$st] = $xml_array[$st]->addChild($st.'s');                                    
                                }
                            }                                                                
                    }          

                    $table = 'cart_rule';
                    $xml_array[$table] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                    $xmlos[$table] = $xml_array[$table]->addChild($table.'s');                    
                    foreach($cart_rule_table_list as $ot => $subtables){
                            $xml_array[$ot] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                            $xmlos[$ot] = $xml_array[$ot]->addChild($ot.'s');
                    }          

                    $table = 'customer';
                    $xml_array[$table] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                    $xmlos[$table] = $xml_array[$table]->addChild($table.'s');                    
                    foreach($customer_table_list as $ot => $subtables){
                            $xml_array[$ot] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                            $xmlos[$ot] = $xml_array[$ot]->addChild($ot.'s');
                            if(!empty($subtables)){
                                foreach($subtables as $st){
                                    $xml_array[$st] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                                    $xmlos[$st] = $xml_array[$st]->addChild($st.'s');                                    
                                }
                            }                                                                
                    }          
                                  
                    /* koniec vytvaranie zakl xml objektov */
                    
                    foreach($orders as $id_order){
                        $table = 'order';
                        $order = Db::getInstance()->getRow("SELECT * FROM `".$prefix.$table."s` WHERE id_order = ".$id_order);
                        $this->addToXML($xmlos[$table],$order,$table);
                        
                        foreach($order_table_list as $table => $subtables){                            
                            $rows = Db::getInstance()->executeS("SELECT * FROM `".$prefix.$table."` WHERE id_order = ".$id_order);
                            if(!empty($rows))
                                foreach($rows as $row){
                                    $this->addToXML($xmlos[$table],$row,$table);                                    
                                }
                        
                            if(!empty($subtables)){
                                foreach($subtables as $st){
                                    if(!empty($rows))
                                        foreach($rows as $row){
                                            $rows2 = Db::getInstance()->executeS("SELECT * FROM `".$prefix.$st."` WHERE id_".$table." = ".$row['id_'.$table]);
                                            if(!empty($rows2))
                                                foreach($rows2 as $row2){
                                                    $this->addToXML($xmlos[$st],$row2,$st);                                    
                                                }
                                        }
                                }
                            }                                                                
                        }
                        
                        $table = $order_payment_table;
                        $rows = Db::getInstance()->executeS("SELECT * FROM `".$prefix.$table."` WHERE order_reference = '".$order['reference']."'");
                        if(!empty($rows))
                            foreach($rows as $row){
                                $this->addToXML($xmlos[$table],$row,$table);                                    
                            }

                        $table = $address_table;
                        $row = Db::getInstance()->getRow("SELECT * FROM `".$prefix.$table."` WHERE id_address = ".$order['id_address_delivery']);
                        if(!empty($row)) {
                            $this->addToXML($xmlos[$table],$row,$table);
                            $tmp = $row['id_address'];
                        }
                                                                
                        $row = Db::getInstance()->getRow("SELECT * FROM `".$prefix.$table."` WHERE id_address = ".$order['id_address_invoice']);
                        if(!empty($row)) {
                            if(!($row['id_address'] == $tmp)) $this->addToXML($xmlos[$table],$row,$table);                                                                
                        } 

                        $table = 'cart';
                        $row = Db::getInstance()->getRow("SELECT * FROM `".$prefix.$table."` WHERE id_cart = ".$order['id_cart']);
                        if(!empty($row))
                            $this->addToXML($xmlos[$table],$row,$table);      
                                                          
                        foreach($cart_table_list as $table => $subtables){                            
                            $rows = Db::getInstance()->executeS("SELECT * FROM `".$prefix.$table."` WHERE id_cart = ".$order['id_cart']);
                            if(!empty($rows))
                                foreach($rows as $row){
                                    $this->addToXML($xmlos[$table],$row,$table);     

                                    if($table == 'cart_cart_rule') {
                                        $table2 = 'cart_rule';
                                        $row2 = Db::getInstance()->getRow("SELECT * FROM `".$prefix.$table2."` WHERE id_cart_rule = ".$row['id_cart_rule']);
                                        if(!empty($row))
                                            $this->addToXML($xmlos[$table2],$row2,$table2);      
                                                          
                                        foreach($cart_rule_table_list as $table3 => $subtables){                            
                                            $rows2 = Db::getInstance()->executeS("SELECT * FROM `".$prefix.$table3."` WHERE id_cart_rule = ".$row['id_cart_rule']);
                                            if(!empty($rows2))
                                                foreach($rows2 as $row2){
                                                    $this->addToXML($xmlos[$table3],$row2,$table3);                                    
                                                }
                                        }
                                    }
                                }
                        
                            if(!empty($subtables)){
                                foreach($subtables as $st){
                                    if(!empty($rows))
                                        foreach($rows as $row){
                                            $rows2 = Db::getInstance()->executeS("SELECT * FROM `".$prefix.$st."` WHERE id_".$table." = ".$row['id_'.$table]);
                                            if(!empty($rows2))
                                                foreach($rows2 as $row2){
                                                    $this->addToXML($xmlos[$st],$row2,$st);                                    
                                                }
                                        }
                                }
                            }
                            
                                                                                            
                        }
                        

                        $table = 'customer';
                        $row = Db::getInstance()->getRow("SELECT * FROM `".$prefix.$table."` WHERE id_".$table." = ".$order['id_'.$table]);
                        $this->addToXML($xmlos[$table],$row,$table);
                        
                        foreach($customer_table_list as $table => $subtables){             
                            $rows = Db::getInstance()->executeS("SELECT * FROM `".$prefix.$table."` WHERE id_customer = ".$order['id_customer']);
                            if(!empty($rows))
                                foreach($rows as $row){
                                    $this->addToXML($xmlos[$table],$row,$table);                                    
                                }
                            if(!empty($subtables)){
                                foreach($subtables as $st){
                                    if(!empty($rows))
                                        foreach($rows as $row){
                                            $rows2 = Db::getInstance()->executeS("SELECT * FROM `".$prefix.$st."` WHERE id_".$table." = ".$row['id_'.$table]);
                                            if(!empty($rows2))
                                                foreach($rows2 as $row2){
                                                    $this->addToXML($xmlos[$st],$row2,$st);                                    
                                                }
                                        }
                                }
                            }
                                
                        }
                                                                      
                                                
                    }
                    
                    /* vystup xml suborov do zipu */

                    $table = 'order';
                    $zip->addFromString($table.'s.xml',$xml_array[$table]->asXML());
                    foreach($order_table_list as $table => $subtables){                            
                        $zip->addFromString($table.'.xml',$xml_array[$table]->asXML());                        
                        if(!empty($subtables)){
                            foreach($subtables as $st){
                                $zip->addFromString($st.'.xml',$xml_array[$st]->asXML());                        
                            }
                        }                                                                
                    }                                                

                    $table = $order_payment_table;
                    $zip->addFromString($table.'.xml',$xml_array[$table]->asXML());

                    $table = $address_table;
                    $zip->addFromString($table.'.xml',$xml_array[$table]->asXML());
                    

                    $table = 'cart';
                    $zip->addFromString($table.'.xml',$xml_array[$table]->asXML());
                    foreach($cart_table_list as $table => $subtables){                            
                        $zip->addFromString($table.'.xml',$xml_array[$table]->asXML());                        
                        if(!empty($subtables)){
                            foreach($subtables as $st){
                                $zip->addFromString($st.'.xml',$xml_array[$st]->asXML());                        
                            }
                        }                                                                
                    }                                                

                    $table = 'cart_rule';
                    $zip->addFromString($table.'.xml',$xml_array[$table]->asXML());
                    foreach($cart_rule_table_list as $table => $subtables){                            
                        $zip->addFromString($table.'.xml',$xml_array[$table]->asXML());                        
                    }           
                                                                             
                    $table = 'customer';
                    $zip->addFromString($table.'.xml',$xml_array[$table]->asXML());
                    foreach($customer_table_list as $table => $subtables){                            
                        $zip->addFromString($table.'.xml',$xml_array[$table]->asXML());                        
                        if(!empty($subtables)){
                            foreach($subtables as $st){
                                $zip->addFromString($st.'.xml',$xml_array[$st]->asXML());                        
                            }
                        }                                                                
                    }           
                    
                    /* koniec vystupu xml suborov do zipu */
                    
                }
//            }
/* ----------------- End Objednavky ------------------- */


            $zip->close();

            header('Content-Type: application/zip');
            header('Content-disposition: attachment; filename='.basename($zip_name));
            header('Content-Length: ' . filesize($zip_name));
            readfile($zip_name);
            unlink($zip_name);        	   
            
        }
	   
//	   return parent::postProcess();
      }
    }	
}