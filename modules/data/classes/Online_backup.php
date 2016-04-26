<?php

class XmlElement {
  var $name;
  var $attributes;
  var $content;
  var $children;
};

function xml_to_object($xml) {
  $parser = xml_parser_create();
  xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
  xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
  xml_parse_into_struct($parser, $xml, $tags);
  xml_parser_free($parser);

  $elements = array();  // the currently filling [child] XmlElement array
  $stack = array();
  foreach ($tags as $tag) {
    $index = count($elements);
    if ($tag['type'] == "complete" || $tag['type'] == "open") {
      $elements[$index] = new XmlElement;
      $elements[$index]->name = empty($tag['tag']) ? '' : $tag['tag'];
      $elements[$index]->attributes = empty($tag['attributes']) ? '' : $tag['attributes'];
      $elements[$index]->content = empty($tag['value']) ? '' : $tag['value'];
      if ($tag['type'] == "open") {  // push
        $elements[$index]->children = array();
        $stack[count($stack)] = &$elements;
        $elements = &$elements[$index]->children;
      }
    }
    if ($tag['type'] == "close") {  // pop
      $elements = &$stack[count($stack) - 1];
      unset($stack[count($stack) - 1]);
    }
  }
  return $elements[0];  // the single top-level element
}

class Online 
{
    public $debug = false;
//    private $ws_path = 'http://esystem.sk/clients/astaledonline/';
    private $ws_path = 'http://www.astaled.sk/';
    private $ws_key = '3U7835SG7DCFQ5A3AKWZSL7E6M6WJICN';
    
    /** public WebService objec */
    public $ws;
    
    /** public orders */
    public $orders;

    /** public order_invoices */
    public $order_invoices;

    /** public order_details */
    public $order_details;

    /** public customers */
    public $customers;

    /** public address visits */
    public $address_visits;

    /** public customer address */
    public $addresses;

    /** public customer address_categories */
    public $address_categories;
    
    /** public customer address_moredatas */
    public $address_moredatas;
    

    /** public customer carts */
    public $carts;
    
    /** public cart rules */
    public $cart_rules;    
    
    /** private templates */
    private $templates = array();      
    
    public $ai_customer = array();
    public $ai_address = array();  
    public $ai_address_category = array();  
    public $ai_address_visit = array();
    public $ai_cart = array();
    public $ai_cart_rule = array();
    public $ai_order = array();
    public $ai_order_invoice = array();
    public $ai_order_detail = array();
    
    public static $cache = array(
        'customer' => array(),
        'address' => array(),
        'address_category' => array(),
        'address_moredata' => array(),
        'address_visit' => array(),
        'cart' => array(),
        'cart_rule' => array(),
        'order' => array(),
        'order_invoice' => array(),
        'order_detail' => array(),
        'new_id' => array(),
    );
    
    public static $table_prikeys = array (
        'customer' => 'id_customer',
        'address_visit' => 'id_address_visit',
        'address' => 'id_address',
        'address_category' => 'id_address',
        'address_moredata' => 'id_address',
        'cart' => 'id_cart',
        'cart_rule' => 'id_cart_rule',
        'order' => 'id_order',
        'order_invoice' => 'id_order_invoice',
        'order_detail' => 'id_order_detail',
    );
    
    public $xchange = array(
        'address' => array('id_customer'=>'customer'),
        'address_visit' => array('id_address'=>'address'),
        'cart' => array(
            'id_customer'=>'customer',
            'id_address_delivery'=>'address',
            'id_address_invoice'=>'address',
        ),

        'cart_rule' => array(
            'id_customer'=>'customer',
            'id_cart' => 'cart',
        ),
        'order' => array(
            'id_address_delivery' => 'address',
            'id_address_invoice' => 'address',
            'id_customer' => 'customer',
            'id_cart' => 'cart',
        ),
        'order_detail' => array(
            'id_order' => 'order',
        ),
        'order_invoice' => array(
            'id_order' => 'order',
        ),

        
    );    

    public static $compare = array(
        'customer' => array(
            'id_employee' => 'id_employee',
            'company' => 'company',
            'date_add' => 'date_add',
            'email' => 'email',
        ),
        'address_visit' => array(
            'id_address' => 'id_address',
            'visit' => 'visit',
            'dovod' => 'dovod',
        ),
        'address' => array(
            'id_customer' => 'id_customer',
            'company' => 'company',
            'date_add' => 'date_add',
            'address1' => 'address1',
            'vat_number' => 'vat_number',
            'dni' => 'dni',
            'deleted' => 'deleted',
            'alias' => 'alias',
        ),
        'cart' => array(
            'id_customer' => 'id_customer',
            'id_address_delivery' => 'id_address_delivery',
            'id_address_invoice' => 'id_address_invoice',
            'date_add' => 'date_add',
        ),

        'cart_rule' => array(
            'id_customer' => 'id_customer',
            'date_add' => 'date_add',
            'code' => 'code',
        ),
        'order' => array(
            'id_cart' => 'id_cart',
            'id_customer' => 'id_customer',
            'date_add' => 'date_add',
        ),
        'order_detail' => array(
            'id_order' => 'id_order',
            'product_id' => 'product_id',
        ),
        'order_invoice' => array(
            'id_order' => 'id_order',
            'date_add' => 'date_add',
        ),
        
    );

    
    public function __construct(){        
        try
        {
            $ws_path = $this->ws_path;
            
            $this->ws = new PrestaShopWebservice($this->ws_path,$this->ws_key,$this->debug);

            $this->customers = $this->ws->get(array('resource' => 'customers','display'    => '[id,id_employee,company,email,date_add]',));
            
            $this->addresses = $this->ws->get(array('resource' => 'addresses','display'    => '[id,id_customer,alias,company,address1,vat_number,dni,date_add,deleted]',));
            $this->address_categories = $this->ws->get(array('resource' => 'address_categories','display'    => '[id,id_address_category]',));
            $this->address_moredatas = $this->ws->get(array('resource' => 'address_moredatas','display'    => '[id,dic,lat,lng]',));
            $this->address_visits = $this->ws->get(array('resource' => 'address_visits','display'    => '[id_address,visit,dovod]',));
            
            $this->carts = $this->ws->get(array('resource' => 'carts','display'    => '[id,id_customer,id_address_delivery,id_address_invoice,date_add]',));
            $this->cart_rules = $this->ws->get(array('resource' => 'cart_rules','display'    => '[id,id_customer,date_add,code]',));

            $this->orders = $this->ws->get(array('resource' => 'orders','display'    => '[id,id_customer,id_cart,id_address_delivery,id_address_invoice,reference,date_add]',));
//$this->debugnow();

//            $this->order_invoices = $this->ws->get(array('resource' => 'order_invoices','display'    => '[id,id_order,date_add]',));
//$this->debugoff();            
/*
            // specific prices // to je ked preda za inu cenu
            
            // customer thread az po order je tam id order netreba
            // customer message netreba
            // order states
*/
            $this->templates['customer'] = $this->ws->get(array('url' => $ws_path.'api/customers?schema=blank'));
                        
            $this->templates['address'] = $this->ws->get(array('url' => $ws_path.'api/addresses?schema=blank'));                        
            $this->templates['address_category'] = $this->ws->get(array('url' => $ws_path.'api/address_categories?schema=blank'));            
            $this->templates['address_moredata'] = $this->ws->get(array('url' => $ws_path.'api/address_moredatas?schema=blank'));
            $this->templates['address_visit'] = $this->ws->get(array('url' => $ws_path.'api/address_visits?schema=blank'));
                        
            $this->templates['cart'] = $this->ws->get(array('url' => $ws_path.'api/carts?schema=blank'));            
            $this->templates['cart_rule'] = $this->ws->get(array('url' => $ws_path.'api/cart_rules?schema=blank'));

            $this->templates['order'] = $this->ws->get(array('url' => $ws_path.'api/orders?schema=blank'));
//$this->debugnow();
                        
            $this->templates['order_detail'] = $this->ws->get(array('url' => $ws_path.'api/order_details?schema=blank'));            
//$this->debugoff();            
                        
//$this->debugnow();

            
        }
        catch (PrestaShopWebserviceException $e)
        {
        }
    }

    public function debugnow(){
        $this->ws = new PrestaShopWebservice($this->ws_path,$this->ws_key,true);
    }

    public function debugoff(){
        if(isset($this->ws)) unset($this->ws);
        $this->ws = new PrestaShopWebservice($this->ws_path,$this->ws_key,false);
    }

/** --------------------- Order ------------------------------------------ **/
    
    /** check order in online system */
    public function orderisnotonline($id_order){
        $table = 'order';        
        $element = $this->getCached($table, $id_order);
        $compare = self::$compare[$table];        
      
        $this->exchange($element,$table);
        
        $tables = $table.'s';
        $elements = simplexml_load_string($this->$tables->children()->asXML());
        if(!empty($elements))
            foreach($elements AS $o){
                $have = true;
                foreach($compare AS $cmp1 => $cmp2){
                    $have = $have & ((string)$o->{$cmp1} == $element[$cmp2]);
                }
                if( $have ) return false;                    
            }
        return $element;        
    } /** end check order online **/

    /** add order to online system */
    public function addOrder($order){
        $table = 'order';
        $tpl = simplexml_load_string($this->templates[$table]->asXML());
        $resources = $tpl->children()->children();
        $ass_res = simplexml_load_string($resources->associations->order_rows->order_row->asXML());

        $ret = array();
        unset($resources -> id);
        unset($resources -> secure_key);

//        unset($resources -> id_cart);
//$order['id_cart'] = 0;

        foreach ($resources as $nodeKey => $node) {
            if(key_exists($nodeKey,$order)){
                $resources->$nodeKey = $order[$nodeKey];
            } else if($nodeKey== 'associations'){                
/*
                $o = new Order($order['id_order']);
                $pdetails = $o->getWsOrderRows();
                if(!empty($pdetails)) {
                    unset($node->order_rows->order_row);
                    foreach($pdetails AS $pd){
                        $row = $node->order_rows->addChild('order_row');
                        foreach ($ass_res as $nKey => $nod) {
                            if(key_exists($nKey,$pd) && $nKey != 'id'){ 
                                $row->addChild($nKey, $pd[$nKey]);
                            } 
                        }                        
                    }
                }
                 */               
            }
        }
                
//        $this->debugnow();                
        $opt = array('resource' => 'orders');
        $opt['postXml'] = self::wrapXML2CDATA(($tpl),'');
//        Tools::fd($opt['postXml']);
        $this->ai_order[$order['id_order']] =  $this->ws->add($opt);
//$this->debugoff();

        if(!key_exists($table,self::$cache['new_id']))
            self::$cache['new_id'][$table] = array();
        self::$cache['new_id'][$table][$order['id_order']] = (string)$this->ai_order[$order['id_order']]->$table->id;
                
    } /** end add order **/

/** --------------------- Order ------------------------------------------ **/
    
    /** check order in online system */
    public function orderdetailisnotonline($id_order_detail){
        $table = 'order_detail';        
        $element = $this->getCached($table, $id_order_detail);
        $compare = self::$compare[$table];        
      
        $this->exchange($element,$table);
        
        $tables = $table.'s';
        $elements = simplexml_load_string($this->$tables->children()->asXML());
        if(!empty($elements))
            foreach($elements AS $o){
                $have = true;
                foreach($compare AS $cmp1 => $cmp2){
                    $have = $have & ((string)$o->{$cmp1} == $element[$cmp2]);
                }
                if( $have ) return false;                    
            }
        return $element;        
    } /** end check order_detail online **/

    /** add order_detail to online system */
    public function addOrderDetail($order_detail){
        $table = 'order_detail';
        $tpl = simplexml_load_string($this->templates[$table]->asXML());
        $resources = $tpl->children()->children();
        $ass_res = simplexml_load_string($resources->associations->taxes->tax->asXML());

        $ret = array();
        unset($resources -> id);

        foreach ($resources as $nodeKey => $node) {
            if(key_exists($nodeKey,$order_detail)){
                $resources->$nodeKey = $order_detail[$nodeKey];
            } else if($nodeKey== 'associations'){                

                $o = new OrderDetail($order_detail['id_order_detail']);
                $pdetails = $o->getWsTaxes();
                if(!empty($pdetails)) {
                    unset($node->taxes->tax);
                    foreach($pdetails AS $pd){
                        $row = $node->taxes->addChild('tax');
                        foreach ($ass_res as $nKey => $nod) {
                            if(key_exists($nKey,$pd)){ 
                                $row->addChild($nKey, $pd[$nKey]);
                            } 
                        }                        
                    }
                }
                                
            }
        }

        $resources -> id_warehouse = '1';

                
//        $this->debugnow();                
        $opt = array('resource' => 'order_details');
        $opt['postXml'] = self::wrapXML2CDATA(($tpl),'');
//        Tools::fd($opt['postXml']);
        $this->ai_order_detail[$order_detail['id_order_detail']] =  $this->ws->add($opt);
//$this->debugoff();
        if(!key_exists($table,self::$cache['new_id']))
            self::$cache['new_id'][$table] = array();
        self::$cache['new_id'][$table][$order_detail['id_order_detail']] = (string)$this->ai_order_detail[$order_detail['id_order_detail']]->$table->id;
                
    } /** end add order_detail **/


/** --------------------- Cart --------------------------------------- **/    

    /** check Cart in online system */
    public function cartisnotonline($id_cart){
        $table = 'cart';        
        $element = $this->getCached($table, $id_cart);
        $compare = self::$compare[$table];        
        
        $this->exchange($element,$table);
        
        $tables = $table.'s';
        $elements = simplexml_load_string($this->$tables->children()->asXML());
        if(!empty($elements))
            foreach($elements AS $o){
                $have = true;
                foreach($compare AS $cmp1 => $cmp2){
                    $have = $have & ((string)$o->{$cmp1} == $element[$cmp2]);
                }
                if( $have ) return false;                    
            }
        return $element;        
    } /** check Cart online **/

    /** add Cart to online system */
    public function addCart($cart){
        $table = 'cart';
        $tpl = simplexml_load_string($this->templates[$table]->asXML());
        $resources = $tpl->children()->children();
        $ass_res = simplexml_load_string($resources->associations->cart_rows->cart_row->asXML());

        $ret = array();
        unset($resources -> id);
        unset($resources -> secure_key);

        foreach ($resources as $nodeKey => $node) {
            if(key_exists($nodeKey,$cart)){
                $resources->$nodeKey = $cart[$nodeKey];
            } else if($nodeKey== 'associations'){ 
                
                $o = new Cart($cart['id_cart']);
                $pdetails = $o->getWsCartRows();
                if(!empty($pdetails)) {
                    unset($node->cart_rows->cart_row);
                    foreach($pdetails AS $pd){
                        $row = $node->cart_rows->addChild('cart_row');
                        foreach ($ass_res as $nKey => $nod) {
                            if(key_exists($nKey,$pd)){ 
                                $row->addChild($nKey, $pd[$nKey]);
                            } 
                        }
                    }
                }
                
            }
        }
                
        $opt = array('resource' => 'carts');
        $opt['postXml'] = self::wrapXML2CDATA(($tpl),'');
        $this->ai_cart[$cart['id_cart']] =  $this->ws->add($opt);
        
        if(!key_exists($table,self::$cache['new_id']))
            self::$cache['new_id'][$table] = array();
        self::$cache['new_id'][$table][$cart['id_cart']] = (string)$this->ai_cart[$cart['id_cart']]->$table->id;
    } /** end add Cart **/


    /** check Cart in online system */
    public function cartruleisnotonline($id_cart_rule,$id_cart){
        $table = 'cart_rule';        
        $element = $this->getCached($table, $id_cart_rule);
        $compare = self::$compare[$table];        

        $element['id_cart'] = $id_cart;         
        $this->exchange($element,$table);
        
        $code = $element['code'];
        $oido = str_replace('BO_ORDER_','',$code);
        $new_ido = $this->getOnlineID('cart',$oido);
        $element['code'] = str_replace($oido,$new_ido,$code);
        
        
        $tables = $table.'s';
        $elements = simplexml_load_string($this->$tables->children()->asXML());
        if(!empty($elements))
            foreach($elements AS $o){
                $have = true;
                foreach($compare AS $cmp1 => $cmp2){
                    $have = $have & ((string)$o->{$cmp1} == $element[$cmp2]);
                }
                if( $have ) return false;                    
            }
        return $element;        
    } /** check Cart online **/

    /** add Cart to online system */    
    public function addCartRule($cart_rule, $name){
        $tpl = simplexml_load_string($this->templates['cart_rule']->asXML());
        $resources = $tpl->children()->children();

        $ret = array();
        unset($resources -> id);
        

        foreach ($resources as $nodeKey => $node) {
            if(key_exists($nodeKey,$cart_rule)){
                $resources->$nodeKey = $cart_rule[$nodeKey];
            }
        }
        
        $resources->name->language = $name;
                        
        $opt = array('resource' => 'cart_rules');
        $opt['postXml'] = self::wrapXML2CDATA(($tpl),'');
        $this->ai_cart_rule[$cart_rule['id_cart_rule']] =  $this->ws->add($opt);
    } /** end add Cart **/


/** --------------------- Visits --------------------------------------- **/    

    /** check Visits in online system */    
    public function address_visitisnotonline($id_address_visit){
        $table = 'address_visit';        
        $element = $this->getCached($table, $id_address_visit);
        $compare = self::$compare[$table];        

        $this->exchange($element, $table);

        $address_visits = simplexml_load_string($this->address_visits->children()->asXML());
        if(!empty($address_visits))
            foreach($address_visits AS $o){
                $have = true;
                foreach($compare AS $cmp1 => $cmp2){
                    $have = $have & ((string)$o->{$cmp1} == $element[$cmp2]);
                }
                if( $have ) return false;                    
            }
        return $element;
    } /** check Visits online **/

    /** add Visits to online system */
    public function addAddress_visit($address_visit){
        $tpl = simplexml_load_string($this->templates['address_visit']->asXML());
        $resources = $tpl->children()->children();

        unset($resources -> id);

        foreach ($resources as $nodeKey => $node) {
            if(key_exists($nodeKey,$address_visit)){
                $resources->$nodeKey = $address_visit[$nodeKey];
            }
        }
                
        $opt = array('resource' => 'address_visits');
        $opt['postXml'] = self::wrapXML2CDATA(($tpl),'');
        $this->ai_address_visit[$address_visit['id_address_visit']] =  $this->ws->add($opt);
    } /** end add Visits **/



/** --------------------- Address moredata --------------------------------------- **/    

    /** check address_moredata in online system */
    public function address_moredataisnotonline($id_address){

        $address_moredata = $this->getCached('address_moredata',$id_address);

        if(empty($address_moredata)) {
            $address_moredata = array('id_address'=>$id_address,'dic' => '0', 'lat'=>'0','lng'=>'0');
        }        
        
            
        $address_moredata['id'] = $address_moredata['id_address'];
                
        $addresses = simplexml_load_string($this->address_moredatas->children()->asXML());
        if(!empty($addresses))
            foreach($addresses AS $o){
                if(
                    (''.$o->id == $address_moredata['id_address'])
                    && (''.$o->dic == $address_moredata['dic'])
                ) return false;                    
            }
        return $address_moredata;
        
    } /** check address_moredata online **/

    /** add address_moredata to online system */
    public function addAddress_moredata($address_moredata){

        $tpl = simplexml_load_string($this->templates['address_moredata']->asXML());
        $resources = $tpl->children()->children();
        
        $old_id = $address_moredata['id_address'];
        $address_moredata['id_address'] = $this->getOnlineID('address',$old_id);

        $address = $this->getCached('address',$old_id);                        
        $country = new Country((int)$address['id_country']);        
        $region = $country->name[Context::getContext()->language->id];
        $addr = $address['address1'].',+'.$address['postcode'].'+'.$address['city'].',+'.$region;        
        $addr = str_replace(' ','+',$addr);
        
        $url = "http://maps.google.com/maps/api/geocode/json?address=$addr&sensor=false&region=$region";
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
        } else {
            $addr = str_replace('+',' ',$addr);            
            $this->warnings[] = Tools::displayError('Nenašla sa pozícia adresy: ('.$address['alias'].'), '.$address['company'].' IČO: '.$address['vat_number'].', '.$addr);                                        
            $this->display = 'edit';
//				        $this->errors[] = Tools::displayError('Skontrolujte prosím adresu. Podľa zadanej adresy nebolo možné službou google vyhľadať pozíciu na mape.');
        }                     
                
        if(empty($lat) || empty($lng)){
            $lat = (float)'0';
            $lng = (float)'0';
        }                
        
        $address_moredata['lat'] = (string)$lat;                        
        $address_moredata['lng'] = (string)$lng;                        

        unset($resources -> id);        
        
        foreach ($resources as $nodeKey => $node) {
            if(key_exists($nodeKey,$address_moredata)){
                $resources->$nodeKey = $address_moredata[$nodeKey];
            }
        }
                
        $opt = array('resource' => 'address_moredatas');
        $opt['postXml'] = self::wrapXML2CDATA(($tpl),'');
        $this->ai_address_moredata[$address_moredata['id_address']] =  $this->ws->add($opt);
        
    } /** end add address_moredata **/




/** --------------------- Address category --------------------------------------- **/    

    /** check address_category in online system */
    public function address_categoryisnotonline($id_address){
        $address_category = $this->getCached('address_category',$id_address);

        if(empty($address_category)) {
            $address_category = array('id_address'=>$id_address,'id_address_category' => '0');
        }        
        
        $address_category['id_address'] = $this->getOnlineID('address',$id_address);
            
        $address_category['id'] = $address_category['id_address'];
                
        $addresses = simplexml_load_string($this->address_categories->children()->asXML());
        if(!empty($addresses))
            foreach($addresses AS $o){
                if(
                    (''.$o->id == $address_category['id_address'])
                ) return false;                    
            }
        return $address_category;
    } /** check address online **/

    /** add address to online system */
    public function addAddress_category($address_category){
        $tpl = simplexml_load_string($this->templates['address_category']->asXML());
        $resources = $tpl->children()->children();

        unset($resources -> id);
        
        if(empty($address_category['id_address_category']))        
            $address_category['id_address_category'] = '1';
        
        foreach ($resources as $nodeKey => $node) {
            if(key_exists($nodeKey,$address_category)){
                $resources->$nodeKey = $address_category[$nodeKey];
            }
        }
                
        $opt = array('resource' => 'address_categories');
        $opt['postXml'] = self::wrapXML2CDATA(($tpl),'');
        $this->ai_address_category[$address_category['id_address']] =  $this->ws->add($opt);
    } /** end add address **/



/** --------------------- Address --------------------------------------- **/    

    /** check address in online system */
    public function addressisnotonline($id_address){
        $address = $this->getCached('address',$id_address);

        $address['id_customer'] = $this->getOnlineID('customer',$address['id_customer']);        

        $addresses = simplexml_load_string($this->addresses->children()->asXML());
        if(!empty($addresses))
            foreach($addresses AS $o){
                if(
                    (''.$o->id_customer == $address['id_customer']) &&
                    (''.$o->company == $address['company']) &&
                    (''.$o->address1 == $address['address1']) &&
                    (''.$o->vat_number == $address['vat_number']) &&
                    (''.$o->dni == $address['dni']) &&
                    (''.$o->date_add == $address['date_add']) &&
                    (''.$o->deleted == $address['deleted']) &&
                    (''.$o->alias == $address['alias'])
                ) return false;                    
            }
        return $address;
    } /** check address online **/

    /** add address to online system */
    public function addAddress($address){
        $table = 'address';
        $tpl = simplexml_load_string($this->templates[$table]->asXML());
        $resources = $tpl->children()->children();
        
/*        if(key_exists($address['id_customer'],$this->ai_customer)){
            $address['id_customer'] = (string)$this->ai_customer[$address['id_customer']]->customer->id;
        } else {
            $address['id_customer'] = $this->customerisonline($address['id_customer']);
            // tento stav by nemal ani nastat kedze vzdy sa importuju vsetci existujuci zakaznici tak sa id_customer neimportovanej adresy musi nachadzat v zozname
        }
*/
        $ret = array();
        unset($resources -> id);

        foreach ($resources as $nodeKey => $node) {
            if(key_exists($nodeKey,$address)){
                $resources->$nodeKey = $address[$nodeKey];
            }
        }
                
        $opt = array('resource' => 'addresses');
        $opt['postXml'] = self::wrapXML2CDATA(($tpl),'');
        $this->ai_address[$address['id_address']] =  $this->ws->add($opt);

        if(!key_exists($table,self::$cache['new_id']))
            self::$cache['new_id'][$table] = array();
        self::$cache['new_id'][$table][$address['id_address']] = (string)$this->ai_address[$address['id_address']]->$table->id;
        
    } /** end add address **/

    
/** --------------------- Customer --------------------------------------- **/    

    /** check customer in online system */
    public function customerisnotonline($id_customer){
        $customer = $this->getCached('customer',$id_customer);
        
        $customers = simplexml_load_string($this->customers->children()->asXML());
        if(!empty($customers))
            foreach($customers AS $o){
                if(
                    (''.$o->id_employee == $customer['id_employee']) &&
                    (''.$o->company == $customer['company']) &&
                    (''.$o->date_add == $customer['date_add']) &&
                    (''.$o->email == $customer['email'])
                ) return false;                    
            }
        return $customer;
    } /** check customer online **/

    /** check customer in online system and return new id*/
    public function customerisonline($id_customer){
        $customer = $this->getCached('customer',$id_customer);
        
        $customers = simplexml_load_string($this->customers->children()->asXML());
        if(!empty($customers))
            foreach($customers AS $o){
                if(
                    ((string)$o->id_employee == $customer['id_employee']) &&
                    ((string)$o->company == $customer['company']) &&
                    ((string)$o->date_add == $customer['date_add']) &&
                    ((string)$o->email == $customer['email'])
                ) return (string)$o->id;                    
            }
        return false;
    } /** check customer online **/


    /** add customer to online system */
    public function addCustomer($customer){
        $table = 'customer';
        $tpl = simplexml_load_string($this->templates[$table]->asXML());

        $resources = $tpl->children()->children();
        $ass_res = simplexml_load_string($resources->associations->groups->group->asXML());

        $ret = array();
        unset($resources -> id);
        unset($resources -> secure_key);

        foreach ($resources as $nodeKey => $node) {
            if(key_exists($nodeKey,$customer)){
                $resources->$nodeKey = $customer[$nodeKey];
            } else if($nodeKey== 'associations'){
                $o = new Customer($customer['id_customer']);
                $pdetails = $o->getWsGroups();

                if(!empty($pdetails))
                    foreach($pdetails AS $pd){
                        $row = $node->groups->addChild('group');
                        foreach ($ass_res as $nKey => $nod) {
                            if(key_exists($nKey,$pd)){ 
                                $row->addChild($nKey, $pd[$nKey]);
                            } 
                        }                        
                    }
            }
        }
                
        $opt = array('resource' => 'customers');
        $opt['postXml'] = self::wrapXML2CDATA(($tpl),'');
        $this->ai_customer[$customer['id_customer']] =  $this->ws->add($opt);

        if(!key_exists($table,self::$cache['new_id']))
            self::$cache['new_id'][$table] = array();
        self::$cache['new_id'][$table][$customer['id_customer']] = (string)$this->ai_customer[$customer['id_customer']]->$table->id;
        
    } /** end add order **/
    

/** -------------------- wrapXMLtoCDATA ---------------------------------------- **/

    public static function wrapXML2CDATA($xml){
        $simple = $xml->asXML();
        $p = xml_parser_create("UTF-8");
        xml_parse_into_struct($p, $simple, $vals, $index);
        xml_parser_free($p);
//        $out = '';
        $out = "<xml version=\"1.0\" encoding=\"utf-8\">";
        foreach($vals AS $f){
            switch ($f['type']) {
                case 'open':
                    $out.= '<'.strtolower($f['tag']);
                    if(!empty($f['attributes']))
                        foreach($f['attributes'] AS $akey => $a)
                            $out.= ' '.strtolower($akey).'="'.$a.'"';
                    $out.= '>';                            
                    break;
                case 'complete':
                    $out.= '<'.strtolower($f['tag']);
                    if(!empty($f['attributes']))
                        foreach($f['attributes'] AS $akey => $a)
                            $out.= ' '.strtolower($akey).'="'.$a.'"';
                    $out.= '>';                            
                    if(!empty($f['value'])){
                        $val = $f['value'];
                        $encoding = mb_detect_encoding($val,mb_list_encodings());
                        if($encoding != "UTF-8")
                            $val = mb_convert_encoding($val,"UTF-8",$encoding);
//                        $encoding2 = mb_detect_encoding($val,mb_list_encodings());
//                        Tools::fd($encoding,$encoding2);
//                        $out.= '<![CDATA['.utf8_encode($val).']]>';                        
                        $out.= '<![CDATA['.urlencode($val).']]>';                        
                    }                            
                    $out.='</'.strtolower($f['tag']).'>';
                    break;
                case 'close':
                    $out.= '</'.strtolower($f['tag']);
                    if(!empty($f['attributes']))
                        foreach($f['attributes'] AS $akey => $a)
                            $out.= ' '.strtolower($akey).'="'.$a.'"';
                    $out.= '>';                            
                    break;
                default:
                    break;
            }        
        }
        $out.= '</xml>';
/*
        $new = simplexml_load_string($out);
        $out = $new->asXML();
        $out = str_replace('<?','<',$out);
        $out = str_replace('?>','>',$out);
        $out.= '</xml>';
*/
//        return utf8_encode($out);
        return $out;
    }

/** ----------------------- Xchange IDs -------------------------------- **/

    public function exchange(&$element, $table){
        foreach($this->xchange[$table] AS $key => $tab){
                $element[$key] = $this->getOnlineID($tab,$element[$key]);
        }                
    } /** Xchange IDs  **/


/** ----------------------- Get online ID -------------------------------- **/

    /** get online ID just imported or cached */
    public function getNewID($table,$old_id){    
        $ai_table = 'ai_'.$table;
        if(key_exists((int)$old_id,$this->$ai_table)){
            return (string)((int)($this->{$ai_table}[(int)$old_id]->$table->id));
        } 
        if(key_exists($old_id,$this->$ai_table)){
            return (string)((int)($this->{$ai_table}[$old_id]->$table->id));
        } 
        if(key_exists($table,self::$cache['new_id'])){
            if(key_exists($old_id,self::$cache['new_id'][$table]))
             return self::$cache['new_id'][$table][$old_id];            
            if(key_exists((int)$old_id,self::$cache['new_id'][$table]))
             return self::$cache['new_id'][$table][(int)$old_id];            
        }
        
        return false;
    } /** End get online ID just imported  **/

/** ----------------------- Get cached element -------------------------------- **/

    public function getCached($table,$id){
        $primary_key = self::$table_prikeys[$table];
        if(isset(self::$cache[$table][$id])){                
            return self::$cache[$table][$id];
        } else {
            if($table == 'order') $table = 'orders';
            $element = Db::getInstance()->getRow("SELECT * FROM `"._DB_PREFIX_.$table."` WHERE $primary_key = $id");
            if($table == 'orders') {
                $table = 'order';
            }
/*            if(empty($element)){
                Tools::fd("SELECT * FROM `"._DB_PREFIX_.$table."` WHERE $primary_key = $id  =>  ".$element);
            }
*/            
            self::$cache[$table][$id] = $element;            
            return $element;
        }
        return false;
    } /** End get online ID just imported  **/

    /** check customer in online system and return new id*/
        
    public function getOnlineID($table,$old_id){
        $new_id = $this->getNewID($table,$old_id);
        if(!empty($new_id)){
//            Tools::fd('cached table='.$table.' old='.$old_id.' new='.$new_id);
            return $new_id;            
        }
        
//        Tools::fd($old_id.' <= '.$table);
        $element = $this->getCached($table, $old_id);
        if(empty($element))
            return '0'; // ak nenajdeme element vratim id 0 v reale by sa to nemalo stat pokial niekto neurobi nejaku zaskodnicku cinnost :)
        // ak nenajdeme element tak by to malo byt uz nove id preto ho vratime rovno .. povodne ale asi neplati
            
        $compare = self::$compare[$table];
        
        if(!empty($this->xchange[$table]))
            foreach($this->xchange[$table] AS $key => $tab){
                $element[$key] = $this->getOnlineID($tab,$element[$key]);
            }        

        
        if($table != 'address'){
            $tables = $table.'s';                        
        } else {
            $tables = $table.'es';            
        }
//        var_dump($tables);
        $elements = simplexml_load_string($this->$tables->children()->asXML());
        if(!empty($elements))
            foreach($elements AS $o){
                $have = true;
                foreach($compare AS $cmp1 => $cmp2){
                    $have = $have & ((string)$o->{$cmp1} == $element[$cmp2]);
                }
                if( $have ) {
                    if(!key_exists($table,self::$cache['new_id']))
                        self::$cache['new_id'][$table] = array();
                    self::$cache['new_id'][$table][$old_id] = (string)$o->id;
//                    Tools::fd('new in cache table='.$table.' old='.$old_id.' new='.(string)$o->id);
                    return (string)$o->id;
                }                    
            }
        return false;
    } /** check customer online **/

                
} /** ---------------------- End online Class ----------------------------- **/    



// toto bude nepotrebne po dokonceni exportu/importu objednavok pomocou webservice

//    public function exportorders(){
    function nonsense(){
            $order_table_list = array(
                'order_carrier' => array(),
                'order_cart_rule' => array(),
                'order_detail' => array('order_detail_tax'),
                'order_history' => array(),
                'order_invoice' => array('order_invoice_tax'),
//                
//                dorobit navratky a dobropisy ked bude treba
// 
//                'order_return' => array(), // navratky
//                'order_return_detail' => array(),

//
//                'order_slip' => array(),  // dobropisy
//                'order_slip_detail' => array(),
            );
            $order_payment_table = 'order_payment'; // odkazovat podla reference a nie podla id_order ktore v tabulke nieje - zrusene platby smerom offline -> online sa neprenasaju
//            $address_table = 'address';
//            $address_table_list = array(
//                'address_category' => array(),
//                'address_moredata' => array()
//            );
            

            $cart_table_list = array(
                'cart_cart_rule' => array(),
                'specific_price' => array()//array('specific_price_priority'),
            );
            $cart_rule_table_list = array(
                'cart_rule_lang' => array()
            );
            
            $customer_table_list = array(
                'customer_group' => array(),
                'customer_thread' => array('customer_message'),
                'customer_visit' => array()

            );
            $prefix = _DB_PREFIX_;
            
            $orders = Order::getOrdersIdByDate($from, $to);
            $orders_array = array();
            
            $zip = new ZipArchive();
            $zip_name = _PS_DOWNLOAD_DIR_."Export_objednavok_".time().".zip"; // Zip name
            $zip->open($zip_name,  ZipArchive::CREATE);
            $xml_array = array();
            
// ---------------- Objednavky a veci s tym suvisiace -----------------             
//            if($objednavky){
                if(!empty($orders)){
                    // vytvorenie zakladnych xml objektov 
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
/**
                    $table = $order_payment_table;
                    $xml_array[$table] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                    $xmlos[$table] = $xml_array[$table]->addChild($table.'s');
**/
                    $table = $address_table;
                    $xml_array[$table] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                    $xmlos[$table] = $xml_array[$table]->addChild($table.'es');

                    foreach($address_table_list as $ot => $subtables){
                            $xml_array[$ot] = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                            $xmlos[$ot] = $xml_array[$ot]->addChild($ot.'s');
                    }          


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
/**                        
                        $table = $order_payment_table;
                        $rows = Db::getInstance()->executeS("SELECT * FROM `".$prefix.$table."` WHERE order_reference = '".$order['reference']."'");
                        if(!empty($rows))
                            foreach($rows as $row){
                                $this->addToXML($xmlos[$table],$row,$table);                                    
                            }
                            
**/
                        if(empty($this->export['address'][$order['id_address_delivery']])) {
                            $table = $address_table;
                            $row = Db::getInstance()->getRow("SELECT * FROM `".$prefix.$table."` WHERE id_address = ".$order['id_address_delivery']);
                            if(!empty($row)) {
                                $this->addToXML($xmlos[$table],$row,$table);
                                $tmp = $row['id_address'];
                                
                                $this->export['address'][$order['id_address_delivery']] = true;
                                
                                foreach($address_table_list as $table => $subtables){             
                                    $rows = Db::getInstance()->executeS("SELECT * FROM `".$prefix.$table."` WHERE id_address = ".$order['id_address_delivery']);
                                    if(!empty($rows))
                                        foreach($rows as $row){
                                            $this->addToXML($xmlos[$table],$row,$table);                                    
                                        }                                
                                }                            
                            }                                                    
                        }
                                                                
                        if(empty($this->export['address'][$order['id_address_invoice']])) {
                            $row = Db::getInstance()->getRow("SELECT * FROM `".$prefix.$table."` WHERE id_address = ".$order['id_address_invoice']);
                            if(!empty($row)) {
                                if(!($row['id_address'] == $tmp)) {
                                    $this->addToXML($xmlos[$table],$row,$table);
                                    
                                    $this->export['address'][$order['id_address_invoice']] = true;

                                    foreach($address_table_list as $table => $subtables){             
                                        $rows = Db::getInstance()->executeS("SELECT * FROM `".$prefix.$table."` WHERE id_address = ".$order['id_address_invoice']);
                                        if(!empty($rows))
                                            foreach($rows as $row){
                                                $this->addToXML($xmlos[$table],$row,$table);                                    
                                            }                                
                                    }                                                            
                                }                                                                 
                            }
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
                        

                        if(empty($this->export['customer'][$order['id_customer']])) {
                            $table = 'customer';
                            $row = Db::getInstance()->getRow("SELECT * FROM `".$prefix.$table."` WHERE id_".$table." = ".$order['id_'.$table]);
                            $this->addToXML($xmlos[$table],$row,$table);
                            
                            $this->export['customer'][$order['id_customer']] = true;                        
                        
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
                                                
                    }
                    
                    // vystup xml suborov do zipu 

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

//                    $table = $order_payment_table;
//                    $zip->addFromString($table.'.xml',$xml_array[$table]->asXML());

                    $table = $address_table;
                    $zip->addFromString($table.'.xml',$xml_array[$table]->asXML());
                    foreach($address_table_list as $table => $subtables){                            
                        $zip->addFromString($table.'.xml',$xml_array[$table]->asXML());                        
                    }                                                
                    

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
                    
                    // koniec vystupu xml suborov do zipu 
                    
                }
//            }
// ----------------- End Objednavky ------------------- 


            $zip->close();

            header('Content-Type: application/zip');
            header('Content-disposition: attachment; filename='.basename($zip_name));
            header('Content-Length: ' . filesize($zip_name));
            readfile($zip_name);
            unlink($zip_name);        	   
            
        }


