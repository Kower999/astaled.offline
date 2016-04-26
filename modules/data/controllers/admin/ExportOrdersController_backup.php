<?php
include_once dirname(__FILE__).'/../abstract/DataController.php';
include_once _PS_MODULE_DIR_.'customervisit/classes/Visits.php';
//var_dump(ENT_XML1);
class ExportOrdersController extends DataController
{
    public $export = array('address'=>array(),'customer'=>array());
    
	public function __construct()
	{
		$this->display = '';
        $this->className = 'ExportOrders';
		parent::__construct();
        
		$this->meta_title = $this->l('Export Objednávok').' - '.$this->module->displayName;
		if (!$this->module->active)
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminHome'));
            
        if(ENT_XML1 != 16) {
	       define('ENT_XML1', 16);            
        }
            
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


    $this->fields_value['from'] = date('Y-m-d');
    $this->fields_value['to'] = date('Y-m-d');
//var_dump($this->fields_value['from']);
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
        
		if(empty( $from))		      
			$this->errors[] = Tools::displayError('Počiatočný dátum nebol zvolený.');
		if(empty( $to))		      
			$this->errors[] = Tools::displayError('Konečný dátum nebol zvolený.');
        if(!Validate::isDate($from) && !empty($from))
			$this->errors[] = Tools::displayError('Nesprávny formát počiatočného dátumu.');
        if(!Validate::isDate($to) && !empty($to))
			$this->errors[] = Tools::displayError('Nesprávny formát konečného dátumu.');
            
        
        
        if(empty($this->errors)){
            $online = new Online();


            $customers = Customer::getCustomers();
            if(!empty($customers))
                foreach($customers as $c){                    
                    if($customer = $online->customerisnotonline($c['id_customer']))
                        $online->addCustomer($customer);   
                }


            $addresses = Address::getAddresses();
            if(!empty($addresses))
                foreach($addresses AS $a){
                    $id_address_invoice = $a['id_address'];
                    if($address = $online->addressisnotonline($id_address_invoice)) {                                    
                        $online->addAddress($address);
                        
                        $adrcat = $online->address_categoryisnotonline($id_address_invoice);
                        if(!empty($adrcat))
                            $online->addAddress_category($adrcat);                                                                     
                        $adrmore = $online->address_moredataisnotonline($id_address_invoice);
                        if(!empty($adrmore))
                            $online->addAddress_moredata($adrmore);
                            
                            
                                                                                                                     
                    }

                    $visits = Visits::getAddressVisits($a['id_address']);
                    if(!empty($visits))
                        foreach($visits as $v){
                            if(!key_exists($v['id_address_visit'],$online->ai_address_visit))
                                if($cv = $online->address_visitisnotonline($v['id_address_visit'])){
                                    $online->addAddress_visit($cv);                                    
                                }
                        }
                    
                }
                
//$online->debugnow();                            


            $carts = Cart::getCarts($from, $to);
//            $tmp = array();
            if(!empty($carts))
                foreach($carts AS $c){
                    $id_cart = $c['id_cart'];
//                    $tmp[$id_cart] = $c;
                    if($cart = $online->cartisnotonline($id_cart)) {                                    
                        $online->addCart($cart);
                                                
                        $crt = new Cart($id_cart);
                        $crs = $crt->getCartRules();
                        if(!empty($crs))
                            foreach($crs as $cr){
                                if($ccr = $online->cartruleisnotonline($cr['id_cart_rule'],$cr['id_cart'])){
                                    $online->addCartRule($ccr, $cr['name']);                                    
                                }                            
                            }                        
                        
                        
                    }
                }
                        

            $orders = Order::getOrdersIdByDate($from, $to);

//            $online->order_details = array();
            $online->order_details = $online->ws->get(array('resource' => 'order_details','display'    => '[id,id_order,id_order_invoice,product_id]',));
            
            if(!empty($orders)){
                foreach($orders AS $id_order){
                    if($order = $online->orderisnotonline($id_order)){
//                        var_dump($order);
                        $online->addOrder($order);
                        $ods = OrderDetail::getWsDetails($id_order);
                        if(!empty($ods))
                            foreach($ods as $od){
                                if($ood = $online->orderdetailisnotonline($od['id_order_detail'])){                                                                                              
                                    $online->addOrderDetail($ood);
                                }
                            }
                    }
                }
            }
            
//            $online->order_details = $online->ws->get(array('resource' => 'order_details','display'    => '[id,id_order,id_order_invoice,product_id]',));
/*            
            if(!empty($orders)){
                foreach($orders AS $id_order){
                        $ods = OrderDetail::getWsDetails($id_order);
                        if(!empty($ods))
                            foreach($ods as $od){
                                if($ood = $online->orderdetailisnotonline($od['id_order_detail'])){                                                                                              
                                    $online->addOrderDetail($ood);
                                }
                            }
                }
            }
*/
//Tools::fd(Online::$cache);

            $this->confirmations[] = Tools::displayError('Export objednávok prebehol úspešne.');
            $this->confirmations[] = Tools::displayError('Exportovaní zákazníci: '.count($online->ai_customer));
            $this->confirmations[] = Tools::displayError('Exportované adresy / prevádzky: '.count($online->ai_address));
            $this->confirmations[] = Tools::displayError('Exportované návštevy: '.count($online->ai_address_visit));
            $this->confirmations[] = Tools::displayError('Exportované objednávky: '.count($online->ai_order));
            
            
        } //end if empty errors	
	   
//	   return parent::postProcess();
      }
    }
    
        
}

