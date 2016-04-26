<?php
include_once dirname(__FILE__).'/../abstract/DataController.php';

class ImportOrdersController extends DataController
{
	public function __construct()
	{
	 	$this->table = 'data_import';
		$this->className = 'ImportOrders';
//		Shop::addTableAssociation('obsegoi_lists', array('type' => 'shop'));
		
		parent::__construct();
		$this->meta_title = $this->l('Import Objednávok').' - '.$this->module->displayName;
		if (!$this->module->active)
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminHome'));
            
        if(ENT_XML1 != 16) {
	       define('ENT_XML1', 16);            
        }
	}
	
	public function initToolbar() {
		//NO TOOLBAR
		$this->toolbar_btn = array();
	}
    
    public function xml($file)
    {
        return simplexml_load_string (html_entity_decode(file_get_contents(_PS_UPLOAD_DIR_.'import_tmp/'.$file),ENT_XML1 , "UTF-8"));     
//        html_entity_decode($string, ENT_QUOTES, "utf-8");       
        
    }
/*    
    public function addImport($arr, $pri_key, $table, $employee)
    {

        $i = new Imports();
        $i->id_employee = $employee;
        $i->key = $pri_key;
        $i->exported = $arr[$pri_key];
        $i->my_date_add = $arr['date_add'];
        if($i->check()) {        
            $vals = array_diff_key($arr,array($pri_key => 1));
            $keys = array_keys($vals);
                    
            $sql = 'INSERT INTO `'._DB_PREFIX_.$table.'` ('.implode(', ',$keys).') VALUES (\''.implode('\', \'',$vals).'\')';
//            Tools::fd($sql);
            Db::getInstance()->execute($sql);
            $w = Db::getInstance()->Insert_ID();
            $i->imported = $w; 
//            Tools::fd($new);
            $i->add();
            return $w;
        }
        return false;
    }
    
    public function walkxml($file, $parent, $child, $pri_key, $table, $arr = null, $re = null) 
    {
            $xml = $this->xml($file);
            $ret = array();            
            
            foreach($xml->{$parent}->{$child} as $c)
            {
                $row = array();
                foreach($c as $field) {
                    $row[$field->getName()] = ''.$field;
                }
                $ret[$row[$pri_key]] = $row;
                
                if($table == 'customer') {
                    $ret[$row[$pri_key]]['imported'] = (empty($ret[$row[$pri_key]]['imported']))?$this->addImport( $row, $pri_key, $table, $row['id_employee']):$ret[$row[$pri_key]]['imported'];;                    
                } elseif(key_exists('id_customer',$row) && !empty($arr)) {
                    $empl = $arr['customer'][$row['id_customer']]['id_employee'];
                    
                    if(!empty($re))
                        foreach($re as $k => $r){
                                $row[$k] = $arr[$r][$row[$k]]['imported'];  
//            Tools::fd($table . ' - ' . $pri_key . ' - ' . $k . ' - ' .  $mk . ' - ' . $mf . ' - ' . $row[$mf]);
//            Tools::fd($arr[$mk]);
                        }
                        
                    $ret[$row[$pri_key]] = $row;
                    
                    $ret[$row[$pri_key]]['imported'] = (empty($ret[$row[$pri_key]]['imported']))?$this->addImport( $row, $pri_key, $table, $empl):$ret[$row[$pri_key]]['imported'];                                                            
//            Tools::fd($row);
                }
                                
            }
            
            return $ret;
        
    }
/*
    public function importSubtable($arr, $table, $pri_key,  $exclude = false)
    {

        if($exclude){
            $vals = array_diff_key($arr,array($pri_key => 1));
            $keys = array_keys($vals);            
        } else {
            $vals = $arr;
            $keys = array_keys($arr);            
        }
        
        $where = '';        
        foreach($vals as  $key => $val){
            $where .= (empty($where))? ' WHERE `'.$key.'` = "'.$val.'"': ' AND `'.$key.'` = "'.$val.'"';
        }
        $sql = 'SELECT * FROM `'._DB_PREFIX_.$table.'` '.$where;
        $test = Db::getInstance()->getRow($sql);
        if(empty($test)) {
            $sql = 'INSERT INTO `'._DB_PREFIX_.$table.'` (`'.implode('`, `',$keys).'`) VALUES ("'.implode('", "',$vals).'")';
            Db::getInstance()->execute($sql);
            return Db::getInstance()->Insert_ID();
        }
        return false;

    }
    

    public function walkchildtablexml($file, $parent, $child, $pri_key, $table, $arr = null, $re = array(), $exclude = false) 
    {
            $xml = $this->xml($file);
            $ret = array();
//Tools::fd($re);     
//Tools::fd($xml->{$parent}->{$child});            
            $cons = array_keys($re);
            
        if(!empty($xml->{$parent}->{$child}))
            foreach($xml->{$parent}->{$child} as $c)
            {
                $row = array();
                foreach($c as $field) {
                    if(in_array($field->getName(),$cons )) {
                        foreach($re as $key => $tabl) {
                            if($field->getName() == $key) {
//Tools::fd($tabl.' - '.$field);
//Tools::fd($key);
//Tools::fd($arr[$tabl][''.$field]);
//Tools::fd('---');
                                if($arr[$tabl][''.$field]['imported'] !== false) {
                                    $row[$field->getName()] = $arr[$tabl][''.$field]['imported'];                                    
                                } else {
                                    $row[$field->getName()] = ''.$field;                                                                                
                                }
                            }                       
                        }
                    } else {
                        $row[$field->getName()] = ''.$field;                                            
                    }
                }
                if (empty($ret[$row[$pri_key]])) {
                    $ret[$row[$pri_key]] = $row;
                    $ret[$row[$pri_key]]['imported'] = (empty($ret[$row[$pri_key]]['imported'])) ? $this->importSubtable($row,$table,$pri_key,$exclude) : $ret[$row[$pri_key]]['imported'];                                                                                                    
                }

            }
            
            return $ret;
        
    }
*/


    public function importSubtable($arr, $table, $pri_key,  $exclude = false,$pri_keys)
    {
        if(!empty($pri_keys)) {
/*            foreach($pri_keys as $pri_k){
                $vals = array_diff_key($arr,array($pri_k => 1));
                $keys = array_keys($vals);                            
            }
*/            
                $vals = $arr;
                
//                array_walk($vals, 'decode_array');

                $keys = array_keys($arr);            
        } else {
            if($exclude){
                $vals = array_diff_key($arr,array($pri_key => 1));
                $keys = array_keys($vals);            
            } else {
                $vals = $arr;
                $keys = array_keys($arr);            
            }
            
        }
        
        
            $where = '';
            if(empty($pri_keys)) {
                if(!empty($pri_key)){
                    $where .= (empty($where))? ' WHERE `'.$pri_key.'` = "'.pSQL($vals[$pri_key]).'"': ' AND `'.$pri_key.'` = "'.pSQL($vals[$pri_key]).'"';                                    
                }
            } else {
                foreach($pri_keys as $pri_k){
                    $where .= (empty($where))? ' WHERE `'.$pri_k.'` = "'.pSQL($vals[$pri_k]).'"': ' AND `'.$pri_k.'` = "'.pSQL($vals[$pri_k]).'"';
                }
            }
            
        $sql = 'SELECT * FROM `'._DB_PREFIX_.$table.'` '.$where;
        $test = Db::getInstance()->getRow($sql);
//        Tools::fd('--------------------------------------------');
//                Tools::fd($test);
//                Tools::fd($sql);
        if(empty($test)) {
            $sql = 'INSERT INTO `'._DB_PREFIX_.$table.'` (`'.implode('`, `',$keys).'`) VALUES (\''.implode('\', \'',$vals).'\')';
            Db::getInstance()->execute($sql);
            return Db::getInstance()->Insert_ID();
        } else {
/*
            $sql = 'DELETE FROM `'._DB_PREFIX_.$table.'`'.$where;
            Db::getInstance()->execute($sql);

            if((int)($vals[$pri_key]) == 150)
                Tools::fd($sql);

            $sql = 'INSERT INTO `'._DB_PREFIX_.$table.'` (`'.implode('`, `',$keys).'`) VALUES (\''.implode('\', \'',$vals).'\')';
            Db::getInstance()->execute($sql);



            if((int)($vals[$pri_key]) == 150)
                Tools::fd($sql);

            return Db::getInstance()->Insert_ID();
  */          
//var_dump($test);            
        }
        return false;

    }
    

    public function walkchildtablexml($file, $parent, $child, $pri_key, $table, $arr = null, $re = array(), $exclude = false,$ptable,$multikeys = array()) 
    {
            $xml = $this->xml($file);
            $ret = array();

//            Db::getInstance()->execute('TRUNCATE '._DB_PREFIX_.$table);
            
//Tools::fd($re);     
//Tools::fd($xml->{$parent}->{$child});            
            $cons = array_keys($re);
            
        if(!empty($xml->{$parent}->{$child}))
            foreach($xml->{$parent}->{$child} as $c)
            {
                $row = array();
                $old = array();
                foreach($c as $field) {
                    $k = $field->getName();
                    $v = ''.$field;
                    if(in_array($k,$cons )) {
                        if(!empty($arr[$re[$k]['table']][$v]['imported'])) {
//                            $row[$k] = $arr[$re[$k]][$v]['imported'];  
                            $row[$k] = $arr[$re[$k]['table']][$v]['imported'];  
                        } else {
                            $row[$k] = Imports::getImp($re[$k]['key'],$v);
                        }
                    } else {
                        $row[$k] = $v;                                            
                    }
                    $old[$k] = $v;                                  
                }
                
                if (empty($ret[$row[$pri_key]])) {
                    $ret[$row[$pri_key]] = $row;
                    $ret[$row[$pri_key]]['imported'] = (!empty($arr[$ptable][$old[$pri_key]]['imported'])) ? $this->importSubtable($row,$table,$pri_key,$exclude,$multikeys) : Imports::getImp($pri_key,$old[$pri_key]);                                                            
                } else {
                    $i = false;
                    foreach($re as $k1 => $a){
                        if(isset($old[$a['key']]))
                            if(isset($arr[$a['table']][$old[$a['key']]]['imported']))
                                if(!empty($arr[$a['table']][$old[$a['key']]]['imported'])) $i = true;
                    }
                    if($i) {                        
                        $row['imported'] = $this->importSubtable($row,$table,$pri_key,$exclude,$multikeys);                            
                    } else $row['imported'] = false;                      
                    if(isset($ret[$row[$pri_key]][$pri_key])) {
                                                                                
                        $tmp = $ret[$row[$pri_key]];
                        $ret[$row[$pri_key]] = array();
                        $ret[$row[$pri_key]][] = $tmp;
                    }
                    $ret[$row[$pri_key]][] = $row;
                }

            }
            
            return $ret;
        
    }

    public function addImport($arr, $pri_key, $table, $employee)
    {

        $i = new Imports();
        $i->id_employee = $employee;
        $i->key = $pri_key;
        $i->exported = $arr[$pri_key];
        $i->my_date_add = $arr['date_add'];
        if($i->check()) {        
            $vals = array_diff_key($arr,array($pri_key => 1));
//            $vals = $arr;
            $keys = array_keys($vals);
            
            $upd = '';
            foreach($keys as $key){
                $upd .= empty($upd)? '' : ' , ';
                $upd.= '`'. $key . '`="' . $vals[$key] . '"';
            }
            
//            array_walk($vals, 'decode_array');
//            $vals = array_diff_key($arr,array($pri_key => 1));
//            $keys = array_keys($vals);
            
                    
            $sql = 'INSERT INTO `'._DB_PREFIX_.$table.'` (`'.implode('`, `',$keys).'`) VALUES (\''.implode('\', \'',$vals).'\') ';
//            $sql = 'INSERT INTO `'._DB_PREFIX_.$table.'` (`'.implode('`, `',$keys).'`) VALUES (\''.implode('\', \'',$vals).'\') ON DUPLICATE KEY UPDATE '.$upd;
//            Tools::fd($sql);
            Db::getInstance()->execute($sql);
            $w = Db::getInstance()->Insert_ID();
            
            if(empty($w)) {
                $sql = 'UPDATE `'._DB_PREFIX_.$table.'` SET '.$upd. ' WHERE '.$pri_key.' = "'.$vals[$pri_key].'"';
                Db::getInstance()->execute($sql);
                $w = $vals[$pri_key];
//            Tools::fd($sql);
            } else {
                $i->imported = $w; 
                $i->add();                
            }
            
            return $w;
        } else {
//            Tools::fd('UPDATE :'.$i->exported);
        }
        
        return false;
    }
    
    public function walkxml($file, $parent, $child, $pri_key, $table, $arr = null, $re = null) 
    {
            $xml = $this->xml($file);
            $ret = array();            
            
//            Db::getInstance()->execute('TRUNCATE '._DB_PREFIX_.$table);
            
            foreach($xml->{$parent}->{$child} as $c)
            {
                $row = array();
                foreach($c as $field) {
                    $row[$field->getName()] = ''.$field;
                }
                $ret[$row[$pri_key]] = $row;
                
                    $empl = 1;

                    if($table == 'customer') {
                        $empl =  $row['id_employee'];                    
                    } elseif(key_exists('id_customer',$row) && !empty($arr)) {
                        $empl = $arr['customer'][$row['id_customer']]['id_employee'];
                    }
                    
                    if(!empty($re))
                        foreach($re as $k => $r){
                            if(!empty($arr[$r['table']][$row[$k]]['imported'])) {
                                $row[$k] = $arr[$r['table']][$row[$k]]['imported'];                                  
                            } else {
//                                $sql = 'SELECT * FROM `'._DB_PREFIX_.$table.'` '.$where;
//                                $test = Db::getInstance()->getRow($sql);
                                $row[$k] = Imports::getImp($r['key'],$row[$k]);
                            }
                        }
                    $ret[$row[$pri_key]] = $row;
                    
                    $t = (isset($re[$pri_key]['table']))? $re[$pri_key]['table'] : $table;
                    $ret[$row[$pri_key]]['imported'] = 
                        (empty($arr[$t][$row[$pri_key]]['imported'])) ?
                        $this->addImport( $row, $pri_key, $table, $empl) : 
                        $arr[$t][$row[$pri_key]]['imported'];                                                            
                                
            }
            
            return $ret;
        
    }

	
	public function postProcess() {
	   
        $field_name = 'zipfile';
//var_dump($_FILES);

		if (Tools::isSubmit('submitAdddata_import') && isset($_FILES[$field_name]['tmp_name']) && $_FILES[$field_name]['tmp_name'])
		{
			$tmp_name = tempnam(_PS_UPLOAD_DIR_, 'PS');
			if (!$tmp_name || !move_uploaded_file($_FILES[$field_name]['tmp_name'], $tmp_name))
				return false;

            $zip = new ZipArchive;
            $res = $zip->open($tmp_name);
            if ($res === TRUE) {
                $zip->extractTo(_PS_UPLOAD_DIR_.'/import_tmp/');
                $zip->close();
            } else {
                $this->errors[] = 'Error opening zip file ('.$res.')';
            }
            
            $suvisiace = array();
            $suvisiace['id_customer'] = array('table'=>'customer','key'=>'id_customer');

            $pole['customer'] = $this->walkxml('customer.xml','customers', 'customer','id_customer', 'customer');
            $pole['address'] = $this->walkxml('address.xml','addresses', 'address','id_address', 'address',$pole, $suvisiace);
            
            $suvisiace['id_address_delivery'] = array('table'=>'address','key'=>'id_address');
            $suvisiace['id_address_invoice'] = array('table'=>'address','key'=>'id_address');
            $pole['cart'] = $this->walkxml('cart.xml','carts', 'cart','id_cart', 'cart',$pole, $suvisiace);
                        
            $suvisiace['id_cart'] = array('table'=>'cart','key'=>'id_cart');
            $pole['orders'] = $this->walkxml('orders.xml','orders', 'order','id_order', 'orders',$pole, $suvisiace);
            
            $suvisiace['id_order'] = array('table'=>'orders','key'=>'id_order');
            
            $suvisiace['id_address'] = array('table'=>'address','key'=>'id_address');

            $pole['address_category'] = $this->walkchildtablexml('address_category.xml','address_categorys','address_category','id_address','address_category',$pole,$suvisiace,false,'address',array('id_address','id_address_category'));
            $pole['address_moredata'] = $this->walkchildtablexml('address_moredata.xml','address_moredatas','address_moredata','id_address','address_moredata',$pole,$suvisiace,false,'address',array('id_address'));
            

            $pole['customer_visit'] = $this->walkchildtablexml('customer_visit.xml','customer_visits','customer_visit','id_customer_visit','customer_visit',$pole,$suvisiace,false,'customer');
            $pole['customer_group'] = $this->walkchildtablexml('customer_group.xml','customer_groups','customer_group','id_customer','customer_group',$pole,$suvisiace,false,'customer',array('id_customer','id_group'));
            $pole['customer_thread'] = $this->walkchildtablexml('customer_thread.xml','customer_threads','customer_thread','id_customer_thread','customer_thread',$pole,$suvisiace,false,'customer');

            $suvisiace['id_customer_thread'] = array('table'=>'customer_thread','key'=>'id_customer_thread');
                        
            $pole['customer_message'] = $this->walkchildtablexml('customer_message.xml','customer_messages','customer_message','id_customer_message','customer_message',$pole,$suvisiace,true,'customer');
          
            $pole['cart_rule'] = $this->walkchildtablexml('cart_rule.xml','cart_rules','cart_rule','id_cart_rule','cart_rule',$pole,$suvisiace,true,'customer');

            $suvisiace['id_cart_rule'] = array('table'=>'cart_rule','key'=>'id_cart_rule');
            
            $pole['cart_rule_lang'] = $this->walkchildtablexml('cart_rule_lang.xml','cart_rule_langs','cart_rule_lang','id_cart_rule','cart_rule_lang',$pole,$suvisiace,false,'cart_rule',array('id_cart_rule','id_lang'));
            $pole['cart_cart_rule'] = $this->walkchildtablexml('cart_cart_rule.xml','cart_cart_rules','cart_cart_rule','id_cart','cart_cart_rule',$pole,$suvisiace,false,'cart',array('id_cart','id_cart_rule'));
            $pole['specific_price'] = $this->walkchildtablexml('specific_price.xml','specific_prices','specific_price','id_specific_price','specific_price',$pole,$suvisiace,true,'cart');
            

            $pole['order_carrier'] = $this->walkchildtablexml('order_carrier.xml','order_carriers','order_carrier','id_order_carrier','order_carrier',$pole,$suvisiace,true,'orders');
            $pole['order_cart_rule'] = $this->walkchildtablexml('order_carrier.xml','order_cart_rules','order_cart_rule','id_order_cart_rule','order_cart_rule',$pole,$suvisiace,true,'orders');
            $pole['order_history'] = $this->walkchildtablexml('order_history.xml','order_historys','order_history','id_order_history','order_history',$pole,$suvisiace,true,'orders');
            $pole['order_detail'] = $this->walkchildtablexml('order_detail.xml','order_details','order_detail','id_order_detail','order_detail',$pole,$suvisiace,true,'orders');

            $suvisiace['id_order_detail'] = array('table'=>'order_detail','key'=>'id_order_detail');
            
            $pole['order_detail_tax'] = $this->walkchildtablexml('order_detail_tax.xml','order_detail_taxs','order_detail_tax','id_order_detail','order_detail_tax',$pole,$suvisiace,false,'order_detail');

            $pole['order_invoice'] = $this->walkchildtablexml('order_invoice.xml','order_invoices','order_invoice','id_order_invoice','order_invoice',$pole,$suvisiace,true,'orders');
//            $pole['order_payment'] = $this->walkchildtablexml('order_payment.xml','order_payments','order_payment','id_order_payment','order_payment',$pole,array(),true);
//            $pole['order_invoice_payment'] = $this->walkchildtablexml('order_invoice_payment.xml','order_invoice_payments','order_invoice_payment','id_order_invoice','order_invoice_payment',$pole,array('id_order_invoice' => 'order_invoice', 'id_order_payment' => 'order_payment'));
//            $pole['order_invoice_tax'] = $this->walkchildtablexml('order_invoice_tax.xml','order_invoice_taxs','order_invoice_tax','id_order_invoice','order_invoice_tax',$pole,array('id_order_invoice' => 'order_invoice'));
            
            
            

//            Tools::fd($pole);

			unlink($tmp_name);
		}

 
    }
	
	public function initContent()
	{
        parent::initContent();
        
        $this->content .= $this->initForm();
		
		$this->assign('content', $this->content);	
	}
/*	
	public function renderList() {
		
	}
*/	
    public function initForm()
    {

$this->fields_form = array(
        'legend' => array(
            'title' => $this->l('Import dát objednávok'),
            'image' => '../img/admin/details.gif'
        ),
        'input' => array(
            array(
                'type' => 'file',
                'label' => $this->l('Súbor:'),
                'name' => 'zipfile',
                'display_image' => FALSE,
                'required' => TRUE,                
                'desc' => $this->l('Zvoľte zip súbor s exportovanými dátami.')
            )
        )
    );

    $this->fields_form['submit'] = array(
        'title' => $this->l('Import'),
        'class' => 'button',
        'icon' => 'process-icon-download-alt'
    );
//    $this->show_toolbar = false;
    $this->toolbar_btn = null;

    return $this->renderForm();
    }

	
}