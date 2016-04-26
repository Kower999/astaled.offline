<?php
require(dirname(__FILE__).'/config/config.inc.php');

if (!class_exists('Imports')) {
    require_once(_PS_MODULE_DIR_.'data/classes/Imports.php');
}

if (!class_exists('MnozstvoSkladom')) {
    require_once(_PS_MODULE_DIR_.'data/classes/MnozstvoSkladom.php');
}

if (!class_exists('Visits')) {
    require_once(_PS_MODULE_DIR_.'customervisit/classes/Visits.php');
}

if (!class_exists('AddressCategory')) {
    class AddressCategory extends ObjectModel {
	   public $id_address;
	   public $id_address_category;
    
	   public static $definition = array(
		'primary' => 'id_address',
		'table' => 'address_category',
		'fields' => array(
			'id_address' => 	     array('type' => self::TYPE_INT, 'required' => true, 'size' => 11),
			'id_address_category' => 	     array('type' => self::TYPE_INT, 'required' => true, 'size' => 11),
		)        
	   );

	   protected $webserviceParameters = array(
		'objectsNodeName' => 'address_categories',
	   );
    
    
    }    
}

if (!class_exists('AddressMoredata')) {
    class AddressMoredata extends ObjectModel {
	   public $id_address;
	   public $dic;
	   public $lat;
	   public $lng;
    	
	   public static $definition = array(
		'primary' => 'id_address',
		'table' => 'address_moredata',
		'fields' => array(
			'id_address' => 	     array('type' => self::TYPE_INT, 'required' => true, 'size' => 11),
			'dic' =>	             array('type' => self::TYPE_STRING, 'validate' => 'isString', 'size' => 20),
			'lat' =>	             array('type' => self::TYPE_FLOAT, 'validate' => 'isFloat', 'copy_post' => false),
			'lng' =>	             array('type' => self::TYPE_FLOAT, 'validate' => 'isFloat', 'copy_post' => false),
		)        
	   );

	   protected $webserviceParameters = array(
		'objectsNodeName' => 'address_moredatas',
	   );
    
    
    }    
}



if(!empty($_FILES)) {
        if (!defined('_PS_EXPORTS_DIR_'))
            define('_PS_EXPORTS_DIR_',            _PS_DOWNLOAD_DIR_.'updates/exports/');
        
        if (!defined('_PS_CUSTOMERS_DATA_'))
            define('_PS_CUSTOMERS_DATA_',            _PS_EXPORTS_DIR_.'customers.data');
        if (!defined('_PS_ADRESSES_DATA_'))
            define('_PS_ADRESSES_DATA_',            _PS_EXPORTS_DIR_.'adresses.data');
        if (!defined('_PS_ADRESSES_CATEGORY_DATA_'))
            define('_PS_ADRESSES_CATEGORY_DATA_',            _PS_EXPORTS_DIR_.'adresses_category.data');
        if (!defined('_PS_ADRESSES_MORE_DATA_'))
            define('_PS_ADRESSES_MORE_DATA_',            _PS_EXPORTS_DIR_.'adresses_more.data');
        if (!defined('_PS_ADRESSES_VISITS_DATA_'))
            define('_PS_ADRESSES_VISITS_DATA_',            _PS_EXPORTS_DIR_.'adresses_visits.data');
            
        if (!defined('_PS_ORDERS_DATA_'))
            define('_PS_ORDERS_DATA_',            _PS_EXPORTS_DIR_.'orders.data');
            
        if (!defined('_PS_STOCK_DATA_'))
            define('_PS_STOCK_DATA_',            _PS_EXPORTS_DIR_.'stock.data');
            
 
    $totals = array(
        'customers' => array('total' => 0, 'done' =>0),
        'addresses' => array('total' => 0, 'done' =>0),
        'visits' => array('total' => 0, 'done' =>0),
        'orders' => array('total' => 0, 'done' =>0),
        'order_statuses' => array('total' => 0, 'done' =>0),
        'order_payments' => array('total' => 0, 'done' =>0),
        'stock' => array('total' => 0, 'done' =>0),
        );    
    
    move_uploaded_file($_FILES['customers']['tmp_name'], _PS_CUSTOMERS_DATA_);
    move_uploaded_file($_FILES['adresses']['tmp_name'], _PS_ADRESSES_DATA_);
    move_uploaded_file($_FILES['adresses_category']['tmp_name'], _PS_ADRESSES_CATEGORY_DATA_);
    move_uploaded_file($_FILES['adresses_more']['tmp_name'], _PS_ADRESSES_MORE_DATA_);
    move_uploaded_file($_FILES['adresses_visits']['tmp_name'], _PS_ADRESSES_VISITS_DATA_);
    move_uploaded_file($_FILES['adresses_visits']['tmp_name'], _PS_ADRESSES_VISITS_DATA_);
    move_uploaded_file($_FILES['orders']['tmp_name'], _PS_ORDERS_DATA_);
    move_uploaded_file($_FILES['stock']['tmp_name'], _PS_STOCK_DATA_);
    
    if(file_exists(_PS_CUSTOMERS_DATA_)){
        $file = _PS_CUSTOMERS_DATA_;
        $handle = fopen($file,'r');
        $customers = fread($handle, filesize($file)); 
        $customers = unserialize($customers);
        fclose($handle);                       
        if(!empty($customers['data'])){
            foreach($customers['data'] as $c){
                $imp = new Imports();
                $imp->id_employee = $customers['employee'];
                $employee = $customers['employee'];
                $imp->key = 'id_customer';
                $imp->exported = $c['id_customer'];
                if($imp->check()){
                    $nc = new Customer();
                    foreach($c as $key => $val){
                        $nc->{$key} = $val;
                    }
                    $nc->add(false);
                    $imp->imported = $nc->id;
                    $imp->add();
                    $totals['customers']['done']++;            
                }
            }
            $totals['customers']['total'] = count($customers['data']);            
        }
    }
    if(file_exists(_PS_ADRESSES_DATA_)){
        $file = _PS_ADRESSES_DATA_;
        $handle = fopen($file,'r');
        $adresses = fread($handle, filesize($file)); 
        $adresses = unserialize($adresses);
        fclose($handle);                       

        if(!empty($adresses['data'])){
            foreach($adresses['data'] as $c){
                $imp = new Imports();
                $imp->id_employee = $adresses['employee'];
                $imp->key = 'id_address';
                $imp->exported = $c['id_address'];
                if($imp->check()){
                    $nc = new Address();
                    foreach($c as $key => $val){
                        $nc->{$key} = $val;
                    }
                    $nc->id_customer = Imports::getImp('id_customer', $nc->id_customer,$adresses['employee']);
                    $nc->add(false);
                    $imp->imported = $nc->id;
                    $imp->add();
                    $totals['addresses']['done']++;            
                }
            }
            $totals['addresses']['total'] = count($adresses['data']);            
            
        }
    }

    if(file_exists(_PS_ADRESSES_CATEGORY_DATA_)){
        $file = _PS_ADRESSES_CATEGORY_DATA_;
        $handle = fopen($file,'r');
        $adresses = fread($handle, filesize($file)); 
        $adresses = unserialize($adresses);
        fclose($handle);                       

        if(!empty($adresses['data']))
            foreach($adresses['data'] as $c){
                $imp = new Imports();
                $imp->id_employee = $adresses['employee'];
                $imp->key = 'id_address_c';
                $imp->exported = $c['id_address'];
                if($imp->check()){
                    $nc = new AddressCategory();
                    foreach($c as $key => $val){
                        $nc->{$key} = $val;
                    }
                    $nc->id_address = Imports::getImp('id_address', $nc->id_address,$adresses['employee']);
                    $nc->add(false);
                    $imp->imported = $nc->id;
                    $imp->add();
                }
            }
    }

    if(file_exists(_PS_ADRESSES_MORE_DATA_)){
        $file = _PS_ADRESSES_MORE_DATA_;
        $handle = fopen($file,'r');
        $adresses = fread($handle, filesize($file)); 
        $adresses = unserialize($adresses);
        fclose($handle);                       

        if(!empty($adresses['data']))
            foreach($adresses['data'] as $c){
                $imp = new Imports();
                $imp->id_employee = $adresses['employee'];
                $imp->key = 'id_address_m';
                $imp->exported = $c['id_address'];
                if($imp->check()){
                    $nc = new AddressMoredata();
                    foreach($c as $key => $val){
                        $nc->{$key} = $val;
                    }
                    $nc->lat = (float)$nc->lat;
                    $nc->lng = (float)$nc->lng;                    
                    
                    $nc->id_address = Imports::getImp('id_address', $nc->id_address,$adresses['employee']);
                    if(empty($nc->lat) || empty($nc->lng)){
                        $ret = setlocation($nc->id_address);
                        $nc->lat = $ret['lat'];
                        $nc->lng = $ret['lng'];
                    } 
                    $nc->add(false);
                    $imp->imported = $nc->id;
                    $imp->add();
                }
            }
    }

    if(file_exists(_PS_ADRESSES_VISITS_DATA_)){
        $file = _PS_ADRESSES_VISITS_DATA_;
        $handle = fopen($file,'r');
        $adresses = fread($handle, filesize($file)); 
        $adresses = unserialize($adresses);
        fclose($handle);                       

        if(!empty($adresses['data'])){
            foreach($adresses['data'] as $c){
                $imp = new Imports();
                $imp->id_employee = $adresses['employee'];
                $imp->key = 'id_address_visit';
                $imp->exported = $c['id_address_visit'];
                if($imp->check()){
                    $nc = new Visits();
                    foreach($c as $key => $val){
                        $nc->{$key} = $val;
                    }
                    
                    $nc->id_address = Imports::getImp('id_address', $nc->id_address,$adresses['employee']);
                    $nc->add(false);
                    $imp->imported = $nc->id;
                    $imp->add();
                    $totals['visits']['done']++;            
                }
            }
            $totals['visits']['total'] = count($adresses['data']);            
        }            
    }

    if(file_exists(_PS_ORDERS_DATA_)){
        $file = _PS_ORDERS_DATA_;
        $handle = fopen($file,'r');
        $orders = fread($handle, filesize($file)); 
        $orders = unserialize($orders);
        fclose($handle);                       
        if(!empty($orders['data'])){
            foreach($orders['data'] as $c){
                $imp = new Imports();
                $imp->id_employee = $orders['employee'];
                $imp->key = 'id_order';
                $imp->exported = $c['id_order'];
                if($imp->check()){
                    $nc = new Order();
                    foreach($c as $key => $val){
                        $nc->{$key} = $val;
                    }
                    $nc->total_paid_real = 0;
                    $old = $nc->id_customer;
                    $nc->id_customer = Imports::getImp('id_customer', $old,$orders['employee']);
                    $nc->id_address_delivery = Imports::getImp('id_address', $nc->id_address_delivery,$orders['employee']);
                    $nc->id_address_invoice = Imports::getImp('id_address', $nc->id_address_invoice,$orders['employee']);
                    
                    $nc->add(false);
                    $imp->imported = $nc->id;
                    $nc->id_cart = 0;
                    $imp->add();
                    $totals['orders']['done']++;            
                    
                    if(!empty($orders['orderdetails'][(int)$c['id_order']]))
                        foreach($orders['orderdetails'][(int)$c['id_order']] as $od) {
                            $ood = new OrderDetail();
                            foreach(OrderDetail::$definition['fields'] as $field => $defs){
                                $ood->$field = $od[$field];
                            }
                            $ood->id_order = $nc->id;
                            $ood->add();
                            
                            $vals = $orders['orderdetails_tax'][(int)$od['id_order_detail']][0];
                            $vals['id_order_detail'] = $ood->id;
                            $keys =  array_keys($vals);
                            $sql = 'INSERT INTO `'._DB_PREFIX_.'order_detail_tax` (`'.implode('`, `',$keys).'`) VALUES (\''.implode('\', \'',$vals).'\') ';

                            Db::getInstance()->execute($sql);                            
                            
                        }
                    $nc->setInvoice();
                    $nc->setDelivery();
                    $nc->invoice_number = $c['invoice_number'];
                    $nc->delivery_number = $c['delivery_number'];
                    $nc->invoice_date = $c['invoice_date'];
                    $nc->delivery_date = $c['delivery_date'];
                    $nc->update();
                    $oi = $nc->getInvoice2(); 
                    $oi->number = $c['invoice_number'];
                    $oi->delivery_number = $c['delivery_number'];
                    $oi->delivery_date = $c['delivery_date'];
                    $oi->update(); 
                                           
                    unset($nc, $c);
                }
            }
            $totals['orders']['total'] = count($orders['data']);            
        }            
            
    }

    $out = array();                    
    $query = '
			                 SELECT id_order
			                 FROM `'._DB_PREFIX_.'orders` o
                             LEFT JOIN `'._DB_PREFIX_.'customer` c ON o.id_customer = c.id_customer
			                 WHERE c.id_employee = '.(int)$employee;
    $result = Db::getInstance()->executeS($query);
    $hist = array();
    if(!empty($result))
        foreach($result as $o){
            $order = new Order($o['id_order']);
            $id = Imports::getExp('id_order',$o['id_order'],$employee);
            $hist[(int)$id] = $order->getHistory(7);
        }
    $out['history'] = $hist;
    $totals['order_statuses']['total'] = count($hist);            

    $query = '
			                 SELECT op.*, o.id_order
			                 FROM `'._DB_PREFIX_.'order_payment` op
                             LEFT JOIN `'._DB_PREFIX_.'orders` o ON op.order_reference = o.reference 
                             LEFT JOIN `'._DB_PREFIX_.'customer` c ON o.id_customer = c.id_customer
			                 WHERE c.id_employee = '.(int)$employee;
    $result = Db::getInstance()->executeS($query);
    $orderpayments = array();
    if(!empty($result))
        foreach($result as $o){
//            $order = new Order($o['id_order']);
            $id = Imports::getExp('id_order',$o['id_order'],$employee);
            $orderpayments[(int)$id] = $o;
//            var_dump($o);
        }
    $out['orderpayment'] = $orderpayments;
    $totals['order_payments']['total'] = count($orderpayments);

    if(file_exists(_PS_STOCK_DATA_)){
        $file = _PS_STOCK_DATA_;
        $handle = fopen($file,'r');
        $customers = fread($handle, filesize($file)); 
        $customers = unserialize($customers);
        fclose($handle);                       
        if(!empty($customers['data'])){
            $id_employee = (int)$customers['employee'];               
            foreach($customers['data'] as $c){
//                if(!empty($c['quantity'])){
                    MnozstvoSkladom::setQuantity($id_employee,$c['id_product'],$c['id_product_attribute'],$c['quantity']);
                    $totals['stock']['done']++;                                    
//                }
            }
            $totals['stock']['total'] = count($customers['data']);            
        }
    }
    
    
    $out['totals'] = $totals;            
                            
    echo serialize($out);    
    
} else {
    echo 'Authentification error!';
}

function setlocation($id_address){
                    $addr = new Address($id_address);
                    $id_addr = $id_address;
                    $country = new Country($addr->id_country);
                    $region = $country->name[7]; // hardkodovane id_lang 
                    $address = $addr->address1.',+'.$addr->postcode.'+'.$addr->city.',+'.$region;
                    $address = str_replace(' ','+',$address);
                    $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=$region";
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    $response = curl_exec($ch);
                    curl_close($ch);
                    $response_a = json_decode($response);
                    if($response_a->status == 'OK'){
                        $lat = $response_a->results[0]->geometry->location->lat;
                        $lng = $response_a->results[0]->geometry->location->lng;
                    }

                    if(empty($lat) || empty($lng)){
                        $lat = (float)$lat;
                        $lng = (float)$lng;
                    }                
                    return array('lat'=> $lat , 'lng'=> $lng);
    
}

?>