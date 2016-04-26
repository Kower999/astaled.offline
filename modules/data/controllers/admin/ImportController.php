<?php
 /**
 * 
 *  2011-2013 OBSolutions S.C.P.  
 *  All Rights Reserved.
 * 
 * NOTICE:  All information contained herein is, and remains
 * the property of OBSolutions S.C.P. and its suppliers,
 * if any.  The intellectual and technical concepts contained
 * herein are proprietary to OBSolutions S.C.P.
 * and its suppliers and are protected by trade secret or copyright law.
 * Dissemination of this information or reproduction of this material
 * is strictly forbidden unless prior written permission is obtained
 * from OBSolutions S.C.P.
 */
include_once dirname(__FILE__).'/../abstract/DataController.php';

class ImportController extends DataController
{
	public function __construct()
	{
	 	$this->table = 'data_import';
		$this->className = 'Import';
//		Shop::addTableAssociation('obsegoi_lists', array('type' => 'shop'));
		
		parent::__construct();
		$this->meta_title = $this->l('Import').' - '.$this->module->displayName;
		if (!$this->module->active)
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminHome'));
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
                                
                                $row[$field->getName()] = $arr[$tabl][''.$field]['imported'];
                            }                       
                        }
                    } else {
                        $row[$field->getName()] = ''.$field;                                            
                    }
                }
                if (empty($ret[$row[$pri_key]])) {
                    $ret[$row[$pri_key]] = $row;
                    $ret[$row[$pri_key]]['imported'] = $this->importSubtable($row,$table,$pri_key,$exclude);                    
                }

            }
            
            return $ret;
        
    }
	
	public function postProcess() {
	   
        $field_name = 'zipfile';

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
            $suvisiace['id_customer'] = 'customer';

            $pole['customer'] = $this->walkxml('customer.xml','customers', 'customer','id_customer', 'customer');
            $pole['address'] = $this->walkxml('address.xml','addresses', 'address','id_address', 'address',$pole, $suvisiace);
            
            $suvisiace['id_address_delivery'] = 'address';
            $suvisiace['id_address_invoice'] = 'address';
            $pole['cart'] = $this->walkxml('cart.xml','carts', 'cart','id_cart', 'cart',$pole, $suvisiace);
                        
            $suvisiace['id_cart'] = 'cart';
            $pole['orders'] = $this->walkxml('orders.xml','orders', 'order','id_order', 'orders',$pole, $suvisiace);

            $pole['customer_group'] = $this->walkchildtablexml('customer_group.xml','customer_groups','customer_group','id_customer','customer_group',$pole,array('id_customer' => 'customer'));
            $pole['customer_thread'] = $this->walkchildtablexml('customer_thread.xml','customer_threads','customer_thread','id_customer_thread','customer_thread',$pole,array('id_customer' => 'customer', 'id_order' => 'orders'));
            $pole['customer_message'] = $this->walkchildtablexml('customer_message.xml','customer_messages','customer_message','id_customer_message','customer_message',$pole,array('id_customer_thread' => 'customer_thread'),true);

            $pole['cart_rule'] = $this->walkchildtablexml('cart_rule.xml','cart_rules','cart_rule','id_cart_rule','cart_rule',$pole,array('id_customer' => 'customer'),true);
            $pole['cart_rule_lang'] = $this->walkchildtablexml('cart_rule_lang.xml','cart_rule_langs','cart_rule_lang','id_cart_rule','cart_rule_lang',$pole,array('id_cart_rule' => 'cart_rule'));

            $pole['cart_cart_rule'] = $this->walkchildtablexml('cart_cart_rule.xml','cart_cart_rules','cart_cart_rule','id_cart','cart_cart_rule',$pole,array('id_cart' => 'cart', 'id_cart_rule' => 'cart_rule'));

            $pole['specific_price'] = $this->walkchildtablexml('specific_price.xml','specific_prices','specific_price','id_specific_price','specific_price',$pole,array('id_cart' => 'cart', 'id_customer' => 'customer'),true);
            

            $pole['order_carrier'] = $this->walkchildtablexml('order_carrier.xml','order_carriers','order_carrier','id_order_carrier','order_carrier',$pole,array('id_order' => 'orders'),true);
            $pole['order_cart_rule'] = $this->walkchildtablexml('order_carrier.xml','order_cart_rules','order_cart_rule','id_order_cart_rule','order_cart_rule',$pole,array('id_order' => 'orders', 'id_cart_rule' => 'cart_rule'),true);
            $pole['order_history'] = $this->walkchildtablexml('order_history.xml','order_historys','order_history','id_order_history','order_history',$pole,array('id_order' => 'orders'),true);
            $pole['order_detail'] = $this->walkchildtablexml('order_detail.xml','order_details','order_detail','id_order_detail','order_detail',$pole,array('id_order' => 'orders'),true);
            $pole['order_detail_tax'] = $this->walkchildtablexml('order_detail_tax.xml','order_detail_taxs','order_detail_tax','id_order_detail','order_detail_tax',$pole,array('order_detail' => 'order_detail'));

            $pole['order_invoice'] = $this->walkchildtablexml('order_invoice.xml','order_invoices','order_invoice','id_order_invoice','order_invoice',$pole,array('id_order' => 'orders'),true);
            $pole['order_payment'] = $this->walkchildtablexml('order_payment.xml','order_payments','order_payment','id_order_payment','order_payment',$pole,array(),true);
            $pole['order_invoice_payment'] = $this->walkchildtablexml('order_invoice_payment.xml','order_invoice_payments','order_invoice_payment','id_order_invoice','order_invoice_payment',$pole,array('id_order_invoice' => 'order_invoice', 'id_order_payment' => 'order_payment'));
            $pole['order_invoice_tax'] = $this->walkchildtablexml('order_invoice_tax.xml','order_invoice_taxs','order_invoice_tax','id_order_invoice','order_invoice_tax',$pole,array('id_order_invoice' => 'order_invoice'));
            
            
            

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