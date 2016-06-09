<?php
include_once dirname(__FILE__).'/../abstract/DataController.php';
include_once _PS_MODULE_DIR_.'customervisit/classes/Visits.php';
//var_dump(ENT_XML1);
class ExportOrdersController extends DataController
{
    public $export = array('address'=>array(),'customer'=>array());
    
    public $employee;
    
    public $from;
    public $to;
    
	public function __construct()
	{
		$this->display = '';
        $this->className = 'ExportOrders';
		parent::__construct();
        
		$this->meta_title = $this->l('Export Objednávok').' - '.$this->module->displayName;
		if (!$this->module->active)
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminHome'));

        $lov = $this->getUpdateVersion();
        
        if(!empty($lov)){
            if($lov != $this->last_version)
                Tools::redirectAdmin($this->context->link->getAdminLink('Update') . "&presmerovanie=1&ver=".$lov);
        } else {
            $this->warnings[] = Tools::displayError('Pravdepodobne nieste pripojený k internetu alebo nastala chyba pri komunikácii s online serverom');            
        }
        
        
        if(!file_exists(_PS_EXPORTS_DIR_)){
            if(!file_exists(_PS_DOWNLOAD_DIR_.'updates/'))
                mkdir(_PS_DOWNLOAD_DIR_.'updates/');            
            mkdir(_PS_EXPORTS_DIR_);            
        }
                
        if(empty($this->employee))
            $this->employee = $this->context->employee->id;
	}
	
	public function initContent()
	{
		$error_msg = '';
		
		parent::initContent();
	
        $this->content .= $this->initFormExport();
		
		$this->assign('content', $this->content);
		
	}

    public function initFormExport()
    {

$this->fields_form = array(
        'legend' => array(
            'title' => $this->l('Export dát objednávok'),
            'image' => '../img/admin/details.gif',
            'description' => 'Uistite sa že ste pripojený k internetu pre exportovanie objednávok a aktualizovanie stavov a platieb objednávok.',            
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

    $this->fields_value['from'] = date('Y-m-d');
    $this->fields_value['to'] = date('Y-m-d');
    $this->toolbar_btn = null;

    return $this->renderForm();
    }


	public function postProcess() {
	  if(Tools::isSubmit('submitAdd')){   
	    $from = Tools::getValue('from');
        $to = Tools::getValue('to');
        
		if(empty( $from))		      
			$this->errors[] = Tools::displayError('Počiatočný dátum nebol zvolený.');
		if(empty( $to))		      
			$this->errors[] = Tools::displayError('Konečný dátum nebol zvolený.');
        if(!Validate::isDate($from) && !empty($from))
			$this->errors[] = Tools::displayError('Nesprávny formát počiatočného dátumu.');
        if(!Validate::isDate($to) && !empty($to))
			$this->errors[] = Tools::displayError('Nesprávny formát konečného dátumu.');
            
        
        $this->readcustomers();
        $this->readadresses(); 
        $this->readorders($from, $to);     
        $this->from = $from;                  
        $this->to = $to;   
        $this->readstock();                       
        $this->sendfiles();
//	   return parent::postProcess();
      }
    }
    
    public function readorders($from, $to){
        $orders = Order::getOrdersIdByDate($from, $to);
        
        $cmrs = array();
        $orderdetails = array();
        if(!empty($orders)){
            foreach($orders as $c){
                $cc = new Order($c);
//                var_dump($cc);
                $c2 = array();
                foreach(Order::$definition['fields'] as $field => $defs){
                    $c2[$field] = $cc->$field;
/*                    echo $field.'=';
                    var_dump($cc->$field);
                    echo '<br /><br />';
                    */
                } 
                $c2['id_order'] = $c;
                
                $cmrs[] = $c2; 
          		$query = '
			         SELECT *
			         FROM `'._DB_PREFIX_.'order_detail`
			         WHERE id_order = '.(int)$c;
                $result = Db::getInstance()->executeS($query);
                if(!empty($result)) {
                    $orderdetails[(int)$c] = $result;
                    foreach($result as $od){
          		        $query = '
			                 SELECT *
			                 FROM `'._DB_PREFIX_.'order_detail_tax`
			                 WHERE id_order_detail = '.(int)$od['id_order_detail'];
                        $result = Db::getInstance()->executeS($query);
                        if(!empty($result))
                            $orderdetails_tax[(int)$od['id_order_detail']] = $result;                        
                    }                    
                }
                    
            }
        }
        
        $orders = serialize(array('employee' => $this->employee, 'data' => $cmrs, 'orderdetails' => $orderdetails, 'orderdetails_tax' => $orderdetails_tax));
               
        $file = _PS_ORDERS_DATA_;
        $handle = fopen($file,'wb');
        fwrite($handle, $orders); // osetrit error tj nezapisany cely retazec..
        fclose($handle);                       
//        var_dump($orders);         
    }
    
    public function readcustomers(){
        $customers = Customer::getCustomers();
        
        $cmrs = array();
        if(!empty($customers)){
            foreach($customers as $c){
                $cc = new Customer($c['id_customer']); 
                $cmrs[] = $cc->getFields();                 
            }
            if(empty($this->employee))
                $this->employee = $cc->id_employee;            
        }
        
        $customers = serialize(array('employee' => $this->employee, 'data' => $cmrs));
               
        $file = _PS_CUSTOMERS_DATA_;
        $handle = fopen($file,'wb');
        fwrite($handle, $customers); // osetrit error tj nezapisany cely retazec..
        fclose($handle);                       
//        var_dump($customers); 
    }

    public function readstock(){
  		$query = '
			         SELECT p.id_product, pa.id_product_attribute
			         FROM `'._DB_PREFIX_.'product` p
                     LEFT JOIN `'._DB_PREFIX_.'product_attribute` pa ON p.id_product = pa.id_product 
                     ';
        $prds = Db::getInstance()->executeS($query);
        
        $stk = array();

        if(!empty($prds))
            foreach($prds as $prd){
                $stk[] = array(
                    'id_product'=> $prd['id_product'],
                    'id_product_attribute' => $prd['id_product_attribute'],
                    'quantity'=> StockAvailable::getQuantityAvailableByProduct((int)$prd['id_product'],(int)$prd['id_product_attribute'])
                    );
            }
        
        $stock = serialize(array('employee' => $this->employee, 'data' => $stk));
               
        $file = _PS_STOCK_DATA_;
        $handle = fopen($file,'wb');
        fwrite($handle, $stock); // osetrit error tj nezapisany cely retazec..
        fclose($handle);                       
    }


    public function readadresses(){
        $adresses = Address::getAddresses();
        
        $cmrs = array();
        if(!empty($adresses))
            foreach($adresses as $c){
                $cc = new Address($c['id_address']);                
                $cmrs[] = $cc->getFields();                 
            }
        
        $adresses = serialize(array('employee' => $this->employee, 'data' => $cmrs));
               
        $file = _PS_ADRESSES_DATA_;
        $handle = fopen($file,'wb');
        fwrite($handle, $adresses); // osetrit error tj nezapisany cely retazec..
        fclose($handle);                       


        $adresses = Db::getInstance()->executeS('SELECT * FROM new_address_category');                
        $adresses = serialize(array('employee' => $this->employee, 'data' => $adresses));               
        $file = _PS_ADRESSES_CATEGORY_DATA_;
        $handle = fopen($file,'wb');
        fwrite($handle, $adresses); // osetrit error tj nezapisany cely retazec..
        fclose($handle);
                
        $adresses = Db::getInstance()->executeS('SELECT * FROM new_address_moredata');                
        $adresses = serialize(array('employee' => $this->employee, 'data' => $adresses));               
        $file = _PS_ADRESSES_MORE_DATA_;
        $handle = fopen($file,'wb');
        fwrite($handle, $adresses); // osetrit error tj nezapisany cely retazec..
        fclose($handle);

        $adresses = Db::getInstance()->executeS('SELECT * FROM new_address_visit');                
        $adresses = serialize(array('employee' => $this->employee, 'data' => $adresses));               
        $file = _PS_ADRESSES_VISITS_DATA_;
        $handle = fopen($file,'wb');
        fwrite($handle, $adresses); // osetrit error tj nezapisany cely retazec..
        fclose($handle);
                               
    }
    
    public function sendfiles(){
        // initialise the curl request
        $request = curl_init(_ASTALED_ONLINE_ . '/mywebservice.php');

        $args = array();
        $args['customers'] = new CurlFile(_PS_CUSTOMERS_DATA_, 'application/octet-stream', 'customers.data');
        $args['adresses'] = new CurlFile(_PS_ADRESSES_DATA_, 'application/octet-stream', 'adresses.data');
        $args['adresses_category'] = new CurlFile(_PS_ADRESSES_CATEGORY_DATA_, 'application/octet-stream', 'adresses_category.data');
        $args['adresses_more'] = new CurlFile(_PS_ADRESSES_MORE_DATA_, 'application/octet-stream', 'adresses_more.data');
        $args['adresses_visits'] = new CurlFile(_PS_ADRESSES_VISITS_DATA_, 'application/octet-stream', 'adresses_visits.data');
        $args['orders'] = new CurlFile(_PS_ORDERS_DATA_, 'application/octet-stream', 'orders.data');
        $args['stock'] = new CurlFile(_PS_STOCK_DATA_, 'application/octet-stream', 'stock.data');

        // send a file
        curl_setopt($request, CURLOPT_POST, true);
        curl_setopt($request, CURLOPT_POSTFIELDS, $args);

        // output the response
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        $ret = curl_exec($request);
        
        // close the session
        curl_close($request);
        $this->readreturn($ret);
    }
    
    public function readreturn($ret){
        $test = unserialize($ret);
        if($test !== false){
            $hii = $test['history'];
            if(!empty($hii))
                foreach($hii as $id_order=>$hist){
                    if(!empty($hist)){
                        foreach($hist as $history){
                            $vals = $history;
                            unset($vals['id_order_history'],$vals['employee_firstname'],$vals['employee_lastname'],$vals['ostate_name']);
                            $keys = array_keys($vals);
                            $vals['id_order'] = $id_order;
                            $h = new OrderHistory();
                            $h->id_employee = $history['id_employee'];
                            $h->id_order = $id_order;
                            $h->id_order_state = $history['id_order_state'];
                            $h->date_add = $history['date_add'];
                            $h->employee_firstname = $history['employee_firstname'];
                            $h->employee_lastname = $history['employee_lastname'];
                            $h->ostate_name = $history['ostate_name'];
                            if(!$h->check()){
                                $sql = 'INSERT INTO `'._DB_PREFIX_.'order_history` (`'.implode('`, `',$keys).'`) VALUES (\''.implode('\', \'',$vals).'\') ';
                                Db::getInstance()->execute($sql); 
                                $o = new Order((int)$id_order);
                                $o->update();    
                                $test['totals']['order_statuses']['done']++;                                                                                          
                            }
                        }
                    }
                }

            $hii = $test['orderpayment'];
            if(!empty($hii))
                foreach($hii as $id_order=>$payment){
                            $vals = $payment;
                            unset($vals['id_order_payment'],$vals['id_order']);
                            $keys = array_keys($vals);                            
                            $query = '
			                 SELECT *
			                 FROM `'._DB_PREFIX_.'order_payment` op
			                 WHERE op.order_reference = "'.$payment['order_reference'].'" AND op.amount = '.$payment['amount'];
                            $result = Db::getInstance()->executeS($query);                            
                            if(empty($result)){
                                $sql = 'INSERT INTO `'._DB_PREFIX_.'order_payment` (`'.implode('`, `',$keys).'`) VALUES (\''.implode('\', \'',$vals).'\') ';
                                Db::getInstance()->execute($sql); 
                                $id_order_payment = Db::getInstance()->Insert_ID(); 
                                $sql = 'SELECT id_order_invoice FROM `'._DB_PREFIX_.'order_invoice` WHERE id_order = '.$id_order;                                
                                $id_order_invoice = Db::getInstance()->getValue($sql); 
                                $sql = 'INSERT INTO `'._DB_PREFIX_.'order_invoice_payment` (`id_order_invoice`,`id_order_payment`,`id_order`) VALUES ('.$id_order_invoice.','.$id_order_payment.','.$id_order.' ) ';
                                Db::getInstance()->execute($sql); 
                                $o = new Order((int)$id_order);
                                $query = '
			                         SELECT *
			                         FROM `'._DB_PREFIX_.'order_payment` op
			                         WHERE op.order_reference = "'.$payment['order_reference'].'" AND op.amount = '.$payment['amount'];
                                $result = Db::getInstance()->executeS($query);
                                $total = 0;
                                if(!empty($result))
                                    foreach($result as $pmnt){
                                        $total += (float)$pmnt['amount'];
                                    }                            
                                $o->total_paid_real = $total;
                                $o->update();                                
                                $test['totals']['order_payments']['done']++;                               
                            }
                }
            $tots = $test['totals'];
            $m = Tools::displayError('Oz: ' . Context::getContext()->employee->id . ' - ' . Context::getContext()->employee->lastname . ' ' . Context::getContext()->employee->firstname) . "\r\n\r\n";
            $m .= Tools::displayError('Rozsah (od-do) : '.$this->from.' - '.$this->to) . "\r\n";
            
            $m .= Tools::displayError('Zákazníci (spolu/nový) : '.$tots['customers']['total'].'/'.$tots['customers']['done']) . "\r\n";
            $m .= Tools::displayError('Adresy (spolu/nové) : '.$tots['addresses']['total'].'/'.$tots['addresses']['done']) . "\r\n";
            $m .= Tools::displayError('Návštevy (spolu/nové) : '.$tots['visits']['total'].'/'.$tots['visits']['done']) . "\r\n";
            $m .= Tools::displayError('Objednávky (spolu/nové) : '.$tots['orders']['total'].'/'.$tots['orders']['done']) . "\r\n";
            $m .= Tools::displayError('Stavy objednávok (spolu/nové) : '.$tots['order_statuses']['total'].'/'.$tots['order_statuses']['done']) . "\r\n";
            $m .= Tools::displayError('Platby objednávok (spolu/nové) : '.$tots['order_payments']['total'].'/'.$tots['order_payments']['done']) . "\r\n";
            $m .= Tools::displayError('Produkty - stav skladu OZ (spolu/aktualizované) : '.$tots['stock']['total'].'/'.$tots['stock']['done']) . "\r\n";

            $this->email(_PS_ONLINE_MAIL_, 'Export objednávok '. Context::getContext()->employee->id . ' - ' . Context::getContext()->employee->lastname . ' ' . Context::getContext()->employee->firstname, $m, Context::getContext()->employee->email);

            $this->confirmations[] = Tools::displayError("Export objednávok je ukončený \r\n");
            $this->confirmations[] = Tools::displayError('Rozsah (od-do) : '.$this->from.' - '.$this->to) . "\r\n\r\n";
            $this->confirmations[] = Tools::displayError('Zákazníci (spolu/nový) : '.$tots['customers']['total'].'/'.$tots['customers']['done']) . "\r\n";
            $this->confirmations[] = Tools::displayError('Adresy (spolu/nové) : '.$tots['addresses']['total'].'/'.$tots['addresses']['done']) . "\r\n";
            $this->confirmations[] = Tools::displayError('Návštevy (spolu/nové) : '.$tots['visits']['total'].'/'.$tots['visits']['done']) . "\r\n";
            $this->confirmations[] = Tools::displayError('Objednávky (spolu/nové) : '.$tots['orders']['total'].'/'.$tots['orders']['done']) . "\r\n";
            $this->confirmations[] = Tools::displayError('Stavy objednávok (spolu/nové) : '.$tots['order_statuses']['total'].'/'.$tots['order_statuses']['done']) . "\r\n";
            $this->confirmations[] = Tools::displayError('Platby objednávok (spolu/nové) : '.$tots['order_payments']['total'].'/'.$tots['order_payments']['done']) . "\r\n";
            $this->confirmations[] = Tools::displayError('Produkty - stav skladu OZ (spolu/aktualizované) : '.$tots['stock']['total'].'/'.$tots['stock']['done']) . "\r\n";
                                                
        } else {
            $m = $ret; 
            $this->email(_ASTALED_ADMIN_MAIL_, 'Export objednávok neznáma chyba '. Context::getContext()->employee->id . ' - ' . Context::getContext()->employee->lastname . ' ' . Context::getContext()->employee->firstname, $m, Context::getContext()->employee->email);                                                
            $this->email(_PS_ONLINE_MAIL_, 'Export objednávok neznáma chyba '. Context::getContext()->employee->id . ' - ' . Context::getContext()->employee->lastname . ' ' . Context::getContext()->employee->firstname, $m, Context::getContext()->employee->email);                                                
            $this->errors[] = Tools::displayError("Neznáma chyba exportu objednávok. \r\n Server vrátil nasledovné:\r\n".$ret);            
        }
        
    }
        
}

