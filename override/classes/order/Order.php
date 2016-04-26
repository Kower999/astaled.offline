<?php

class Order extends OrderCore
{

	public $total_provisions = 0;

	/** @var string Object payment date */
	public $date_pay;

	/** @var object Customer */
	public $customer;

	public static $definition = array(
		'table' => 'orders',
		'primary' => 'id_order',
		'fields' => array(
			'id_address_delivery' => 		array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
			'id_address_invoice' => 		array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
			'id_cart' => 					array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
			'id_currency' => 				array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
			'id_shop_group' => 				array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId'),
			'id_shop' => 					array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId'),
			'id_lang' => 					array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
			'id_customer' => 				array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
			'id_carrier' => 				array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
			'current_state' => 				array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId'),
			'secure_key' => 				array('type' => self::TYPE_STRING, 'validate' => 'isMd5'),
			'payment' => 					array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'required' => true),
			'module' => 					array('type' => self::TYPE_STRING),
			'recyclable' => 				array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
			'gift' => 						array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
			'gift_message' => 				array('type' => self::TYPE_STRING, 'validate' => 'isMessage'),
			'total_discounts' =>			array('type' => self::TYPE_FLOAT, 'validate' => 'isPrice'),
			'total_discounts_tax_incl' =>	array('type' => self::TYPE_FLOAT, 'validate' => 'isPrice'),
			'total_discounts_tax_excl' =>	array('type' => self::TYPE_FLOAT, 'validate' => 'isPrice'),
			'total_paid' => 				array('type' => self::TYPE_FLOAT, 'validate' => 'isPrice', 'required' => true),
			'total_paid_tax_incl' => 		array('type' => self::TYPE_FLOAT, 'validate' => 'isPrice'),
			'total_paid_tax_excl' => 		array('type' => self::TYPE_FLOAT, 'validate' => 'isPrice'),
			'total_paid_real' => 			array('type' => self::TYPE_FLOAT, 'validate' => 'isPrice', 'required' => true),
			'total_products' => 			array('type' => self::TYPE_FLOAT, 'validate' => 'isPrice', 'required' => true),
			'total_products_wt' => 			array('type' => self::TYPE_FLOAT, 'validate' => 'isPrice', 'required' => true),
			'total_shipping' => 			array('type' => self::TYPE_FLOAT, 'validate' => 'isPrice'),
			'total_shipping_tax_incl' =>	array('type' => self::TYPE_FLOAT, 'validate' => 'isPrice'),
			'total_shipping_tax_excl' =>	array('type' => self::TYPE_FLOAT, 'validate' => 'isPrice'),
			'carrier_tax_rate' => 			array('type' => self::TYPE_FLOAT, 'validate' => 'isFloat'),
			'total_provisions' => 			array('type' => self::TYPE_FLOAT ),  // tu
			'total_wrapping' => 			array('type' => self::TYPE_FLOAT, 'validate' => 'isPrice'),
			'total_wrapping_tax_incl' =>	array('type' => self::TYPE_FLOAT, 'validate' => 'isPrice'),
			'total_wrapping_tax_excl' =>	array('type' => self::TYPE_FLOAT, 'validate' => 'isPrice'),
			'shipping_number' => 			array('type' => self::TYPE_STRING, 'validate' => 'isTrackingNumber'),
			'conversion_rate' => 			array('type' => self::TYPE_FLOAT, 'validate' => 'isFloat', 'required' => true),
			'invoice_number' => 			array('type' => self::TYPE_INT),
			'delivery_number' => 			array('type' => self::TYPE_INT),
			'invoice_date' => 				array('type' => self::TYPE_DATE),
			'delivery_date' => 				array('type' => self::TYPE_DATE),
			'valid' => 						array('type' => self::TYPE_BOOL),
			'reference' => 					array('type' => self::TYPE_STRING),
			'date_add' => 					array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
			'date_upd' => 					array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
			'date_pay' => 					array('type' => self::TYPE_DATE),            
		),
	);

	protected $webserviceParameters = array(
		'objectMethods' => array('add' => 'addWs'),
		'objectNodeName' => 'order',
		'objectsNodeName' => 'orders',
		'fields' => array(
			'id_address_delivery' => array(),
			'id_address_invoice' => array(),
			'id_cart' => array(),
			'id_currency' => array(),
			'id_lang' => array(),
			'id_customer' => array(),
			'id_carrier' => array(),
			'current_state' => array(),
			'module' => array('required' => true),
			'invoice_number' => array(),
			'invoice_date' => array(),
			'delivery_number' => array(),
			'delivery_date' => array(),
			'valid' => array(),
			'date_add' => array(),
			'date_upd' => array(),
		),
		'associations' => array(
			'order_rows' => array('resource' => 'order_row', 'setter' => false, 'virtual_entity' => true,
				'fields' => array(
					'id' =>  array(),
					'product_id' => array('required' => true),
					'product_attribute_id' => array('required' => true),
					'product_quantity' => array('required' => true),
					'product_name' => array('setter' => false),
					'product_price' => array('setter' => false),
				)),
		),

	);

	public function __construct($id = null, $id_lang = null)
	{
		parent::__construct($id, $id_lang);

        if ($this->id_customer && empty($this->customer))
        {
            $this->customer = new Customer((int)($this->id_customer));
        }
        
        if(empty($this->date_pay) || !Validate::isDate($this->date_pay)) {
		    if (Tools::isSubmit('submitAddOrder') && Tools::isSubmit('date_pay')){		       
                $o = Validate::isDate(Tools::getValue('date_pay'));
//                Tools::fd($o);
		          if ($this->id_customer && empty($this->customer))
                  {
                    $this->customer = new Customer((int)($this->id_customer));
		          } else if($this->id_cart && empty($this->customer) ) {
		              $cart = new Cart($this->id_cart);
                      $this->customer = new Customer((int)($cart->id_customer));
		          };
                if($o){
                    $this->date_pay = Tools::getValue('date_pay');                    
                } else {
                    $d = (int)Tools::getValue('date_pay');
                    if(empty($d)) {
                        $d = $this->customer->splatnost;
                    }
                    $x = '+'.$d.' days';
//                    var_dump($this->customer->splatnost);
//                    var_dump($x);
                    if(!empty($d)) {
                        $this->date_pay = date("Y-m-d",strtotime($x));                                        
                    } else $this->date_pay = 'xxx';
                }
            } else {
//                $o = Tools::isSubmit('date_pay');                         
//                Tools::fd($o);
                
                $this->date_pay = date("Y-m-d",strtotime('+14 days'));                
            }
		}        
	}

	public function add($autodate = true, $null_values = true)
	{
        if ($this->id_customer && empty($this->customer))
        {
            $this->customer = new Customer((int)($this->id_customer));
        } else if($this->id_cart && empty($this->customer) ) {
            $cart = new Cart($this->id_cart);
            $this->customer = new Customer((int)($cart->id_customer));
        };
        $o = Validate::isDate($this->date_pay);
        if(!$o) {
            $d = (int)Tools::getValue('date_pay');
            if(empty($d)) {
                $d = $this->customer->splatnost;
            }
            $x = '+'.$d.' days';
            if(!empty($d)) {
                $this->date_pay = date("Y-m-d",strtotime($x));                                        
            } else if(Tools::getValue('date_pay') == ''){
                $this->date_pay = date("Y-m-d",strtotime('+14 days'));                
            } else {
                $this->date_pay = date("Y-m-d");                                
            }
            
        }
/*        
        Tools::fd($this->customer);
        Tools::fd($this->id_customer);
        Tools::fd($this->id_cart);
        Tools::fd($this->date_pay);
*/        
		return parent::add($autodate, $null_values);
	}
    
    


    public function update($null_values = false) 
    {
//        parent::update();

        Context::getContext()->customer = new Customer($this->id_customer);

        $this->checkOrderDetails();
        
        $total_ws_price = 0;
        $total_products = 0;
        $total_provisions = 0;
        
        $products = Db::getInstance()->executeS('SELECT p.id_product, od.product_quantity as cart_quantity, od.total_price_tax_excl, p.wholesale_price, pp.cena_2, pp.provizia, od.unit_price_tax_excl as price   
                                                 FROM `'._DB_PREFIX_.'order_detail` as od 
                                                 LEFT JOIN `'._DB_PREFIX_.'product` as p ON od.product_id = p.id_product
                                                 LEFT JOIN `'._DB_PREFIX_.'product_provisions` as pp ON pp.id_product = od.product_id
                                                 WHERE id_order = '.$this->id);
        
        if(!empty($products))
            $total_provisions = Tools::TotalProvisions($products);
        $this->total_provisions = $total_provisions; // nemeni sa total ws price treba opravit
        $os = Db::getInstance()->getValue('
		SELECT `id_order_state`
		FROM `'._DB_PREFIX_.'order_history`
		WHERE `id_order` = '.(int)$this->id.'
		ORDER BY `date_add` DESC, `id_order_history` DESC');
//        var_dump($os);
//        echo '<br />';
//        var_dump($this->current_state);
        if(in_array($os,array('14','15','16','12','17','2')))
            $this->current_state = (int)$os;//OrderHistory::getLastOrderState2($this->id);        
        

        return parent::update($null_values);        
    }

	public function setDelivery()
	{
		// Get all invoice
        $donumber = empty($this->delivery_number);
                
		$order_invoice_collection = $this->getInvoicesCollection();
        if(!empty($order_invoice_collection)) {
		 foreach ($order_invoice_collection as $order_invoice)
		 {
            if($donumber) {
                $number = (int)Configuration::get('PS_DELIVERY_NUMBER');
                if (!$number)
                {
				    //if delivery number is not set or wrong, we set a default one.
				    Configuration::updateValue('PS_DELIVERY_NUMBER', 1);
				    $number = 1;
			    }
				
			    // Set delivery number on invoice
			    $order_invoice->delivery_number = $number;
			    $order_invoice->delivery_date = date('Y-m-d H:i:s');
			    // Update Order Invoice
			    $order_invoice->update();

			    // Keep for backward compatibility
			    $this->delivery_number = $number;
    			Configuration::updateValue('PS_DELIVERY_NUMBER', $number + 1);                
            }
		 }
        } else {
            if($donumber) {
                $number = (int)Configuration::get('PS_DELIVERY_NUMBER');
                if (!$number)
                {
				    //if delivery number is not set or wrong, we set a default one.
				    Configuration::updateValue('PS_DELIVERY_NUMBER', 1);
				    $number = 1;
			    }
			    $this->delivery_number = $number;
			    Configuration::updateValue('PS_DELIVERY_NUMBER', $number + 1);
            }            
        }

		// Keep it for backward compatibility, to remove on 1.6 version
		// Set delivery date
        if($donumber) {        
            $this->delivery_date = date('Y-m-d H:i:s');
        }
		// Update object
		$this->update();
	}

	public function mydeleteProduct($orderDetail, $quantity)
	{
		return $this->_deleteProduct($orderDetail, (int)$quantity);
	}
    
    
	/* DOES delete the product */
	protected function _deleteProduct($orderDetail, $quantity)
	{

		$product_price_tax_excl = $orderDetail->unit_price_tax_excl * $quantity;
		$product_price_tax_incl = Tools::getPriceWT($product_price_tax_excl);
		
		/* Update cart */
		$cart = new Cart($this->id_cart);
		$cart->updateQty($quantity, $orderDetail->product_id, $orderDetail->product_attribute_id, false, 'down'); // customization are deleted in deleteCustomization
		$cart->update();
                

		/* Update order */
		$shipping_diff_tax_incl = $this->total_shipping_tax_incl - $cart->getPackageShippingCost($this->id_carrier, true, null, $this->getCartProducts());
		$shipping_diff_tax_excl = $this->total_shipping_tax_excl - $cart->getPackageShippingCost($this->id_carrier, false, null, $this->getCartProducts());
		$this->total_shipping -= $shipping_diff_tax_incl;
		$this->total_shipping_tax_excl -= $shipping_diff_tax_excl;
		$this->total_shipping_tax_incl -= $shipping_diff_tax_incl;
		$this->total_products -= $product_price_tax_excl;
		$this->total_products_wt = (float)Tools::getPriceWT($this->total_products);        
		$this->total_paid_tax_excl -= $product_price_tax_excl + $shipping_diff_tax_excl;
		$this->total_paid = Tools::ps_round((float)(Tools::getPriceWT($this->total_paid_tax_excl)), 2);
		$this->total_paid_tax_incl = Tools::ps_round((float)(Tools::getPriceWT($this->total_paid_tax_excl)), 2);
		$this->total_paid_real -= $product_price_tax_incl + $shipping_diff_tax_incl;

		$fields = array(
			'total_shipping',
			'total_shipping_tax_excl',
			'total_shipping_tax_incl',
			'total_products',
			'total_products_wt',
			'total_paid',
			'total_paid_tax_incl',
			'total_paid_tax_excl',
			'total_paid_real'
		);
		
		/* Prevent from floating precision issues (total_products has only 2 decimals) */
		foreach ($fields as $field)
			if ($this->{$field} < 0)
				$this->{$field} = 0;

		/* Prevent from floating precision issues */
		foreach ($fields as $field)
			$this->{$field} = number_format($this->{$field}, 2, '.', '');

        StockAvailable::updateQuantity($orderDetail->product_id, $orderDetail->product_attribute_id, (int)$quantity);

		/* Update order detail */
		$orderDetail->product_quantity -= (int)$quantity;
		if ($orderDetail->product_quantity == 0)
		{
			if (!$orderDetail->delete())
				return false;
			if (count($this->getProductsDetail()) == 0)
			{
				$history = new OrderHistory();
				$history->id_order = (int)($this->id);
				$history->changeIdOrderState(Configuration::get('PS_OS_CANCELED'), $this);
				if (!$history->addWithemail())
					return false;
			}            
			return $this->update();
		}
		else
		{
			$orderDetail->total_price_tax_excl -= $product_price_tax_excl;
			$orderDetail->total_price_tax_incl = Tools::ps_round((float)(Tools::getPriceWT($orderDetail->total_price_tax_excl)), 2);;
			$orderDetail->total_shipping_price_tax_excl -= $shipping_diff_tax_excl;
			$orderDetail->total_shipping_price_tax_incl -= $shipping_diff_tax_incl;
		}
        
        
		return $orderDetail->update() && $this->update();	   
    }    
    
    public function getInvoice2(){
        $sql = 'SELECT `id_order_invoice`
				FROM `'._DB_PREFIX_.'order_invoice`
				WHERE `id_order` = '.(int)$this->id.' ORDER BY id_order_invoice DESC';
        $id = (int)Db::getInstance()->getValue($sql);                

		return (empty($id))? new OrderInvoice() : new OrderInvoice($id);
    }
    
	/**
	 * Get product total with taxes
	 *
	 * @return Product total with taxes
	 */
/*     
	public function getTotalProductsWithTaxes($products = false)
	{
		if ($this->total_products_wt != '0.00' && !$products)
			return $this->total_products_wt;

		if (!$products)
			$products = $this->getProductsDetail();

		$return = 0;
        $return = $this->getTotalProductsWT();

		if (!$products)
		{
			$this->total_products_wt = $return;
			$this->update();
		}
		return $return;
	}
*/
    

	public function setInvoice($use_existing_payment = false)
	{
		if (!$this->hasInvoice())
		{
			$order_invoice = new OrderInvoice();
			$order_invoice->id_order = $this->id;
			$order_invoice->number = Configuration::get('PS_INVOICE_START_NUMBER');
			// If invoice start number has been set, you clean the value of this configuration
			if ($order_invoice->number)
				Configuration::updateValue('PS_INVOICE_START_NUMBER', false	);
			else
				$order_invoice->number = Order::getLastInvoiceNumber() + 1;

			$invoice_address = new Address((int)$this->id_address_invoice);
			$carrier = new Carrier((int)$this->id_carrier);
			$tax_calculator = $carrier->getTaxCalculator($invoice_address);

			$order_invoice->total_discount_tax_excl = $this->total_discounts_tax_excl;
			$order_invoice->total_discount_tax_incl = $this->total_discounts_tax_incl;
			$order_invoice->total_paid_tax_excl = $this->total_paid_tax_excl;
			$order_invoice->total_paid_tax_incl = $this->total_paid_tax_incl;
			$order_invoice->total_products = $this->total_products;
			$order_invoice->total_products_wt = $this->total_products_wt;
            
			$order_invoice->total_shipping_tax_excl = $this->total_shipping_tax_excl;
			$order_invoice->total_shipping_tax_incl = $this->total_shipping_tax_incl;
			$order_invoice->shipping_tax_computation_method = $tax_calculator->computation_method;
			$order_invoice->total_wrapping_tax_excl = $this->total_wrapping_tax_excl;
			$order_invoice->total_wrapping_tax_incl = $this->total_wrapping_tax_incl;

			// Save Order invoice
			$order_invoice->add();

			$order_invoice->saveCarrierTaxCalculator($tax_calculator->getTaxesAmount($order_invoice->total_shipping_tax_excl));

			// Update order_carrier
			$id_order_carrier = Db::getInstance()->getValue('
				SELECT `id_order_carrier`
				FROM `'._DB_PREFIX_.'order_carrier`
				WHERE `id_order` = '.(int)$order_invoice->id_order.'
				AND (`id_order_invoice` IS NULL OR `id_order_invoice` = 0)');
			
			if ($id_order_carrier)
			{
				$order_carrier = new OrderCarrier($id_order_carrier);
				$order_carrier->id_order_invoice = (int)$order_invoice->id;
				$order_carrier->update();
			}

			// Update order detail
			Db::getInstance()->execute('
				UPDATE `'._DB_PREFIX_.'order_detail`
				SET `id_order_invoice` = '.(int)$order_invoice->id.'
				WHERE `id_order` = '.(int)$order_invoice->id_order);

			// Update order payment
			if ($use_existing_payment)
			{
				$id_order_payments = Db::getInstance()->executeS('
					SELECT op.id_order_payment 
					FROM `'._DB_PREFIX_.'order_payment` op
					INNER JOIN `'._DB_PREFIX_.'orders` o ON (o.reference = op.order_reference)
					LEFT JOIN `'._DB_PREFIX_.'order_invoice_payment` oip ON (oip.id_order_payment = op.id_order_payment)					
					WHERE oip.id_order_payment IS NULL AND o.id_order = '.(int)$order_invoice->id_order);
				
				if (count($id_order_payments))
					foreach ($id_order_payments as $order_payment)
						Db::getInstance()->execute('
							INSERT INTO `'._DB_PREFIX_.'order_invoice_payment`
							SET
								`id_order_invoice` = '.(int)$order_invoice->id.',
								`id_order_payment` = '.(int)$order_payment['id_order_payment'].',
								`id_order` = '.(int)$order_invoice->id_order);
			}

			// Update order cart rule
			Db::getInstance()->execute('
				UPDATE `'._DB_PREFIX_.'order_cart_rule`
				SET `id_order_invoice` = '.(int)$order_invoice->id.'
				WHERE `id_order` = '.(int)$order_invoice->id_order);

			// Keep it for backward compatibility, to remove on 1.6 version
			$this->invoice_date = $order_invoice->date_add;
			$this->invoice_number = $order_invoice->number;
			$this->update();
		}
	}
    
	public function getOrderTotal($with_taxes = true, $type = Cart::BOTH, $products = null, $id_carrier = null, $use_cache = true)
	{
        $cart = new Cart($this->id_cart);
        if(empty($products))
            $products = $this->getCartProducts();
        
        if(!empty($products))
            foreach($products as &$p){
                $p['cart_quantity'] = $p['product_quantity'];
            }            
//var_dump($products);            
        $order_total = $cart->getOrderTotal(false, $type, $products,$id_carrier,$use_cache);
        if($with_taxes){
            $order_total = Tools::getPriceWT($order_total);                                    
        }
//var_dump($order_total);
		return Tools::ps_round((float)$order_total, 2);
        
    }    

	public function checkOrderDetails()
	{
        $products = $this->getCartProducts();
        
        if(!empty($products))
            foreach($products as &$p){
//                * (1+ ((float)$p['tax_calculator']->taxes[0]->rate / 100 ))
                $tpti = Tools::getPriceWT((int)$p['product_quantity'] * (float)$p['product_price'] );
                if($tpti != (float)$p['total_price_tax_incl']) {
                    $od = new OrderDetail($p['id_order_detail']);
                    $od->total_price_tax_incl = $tpti;
                    $total_amount = $od->total_price_tax_incl - $od->total_price_tax_excl;
                    $od->update();
			        Db::getInstance()->execute('
				        UPDATE `'._DB_PREFIX_.'order_detail_tax`
				        SET `total_amount` = '.$total_amount.'
				        WHERE `id_order_detail` = '.(int)$p['id_order_detail']);
                }                
            }   
//        var_dump($p);         
    }    

	public static function getOrdersIdByDate($date_from, $date_to, $id_customer = null, $type = null)
	{
		$sql = 'SELECT `id_order`
				FROM `'._DB_PREFIX_.'orders`
				WHERE DATE_ADD(date_add, INTERVAL -1 DAY) <= \''.pSQL($date_to).'\' AND date_add >= \''.pSQL($date_from).'\'
					'.Shop::addSqlRestriction()
					.($type ? ' AND '.pSQL(strval($type)).'_number != 0' : '')
					.($id_customer ? ' AND id_customer = '.(int)($id_customer) : '');
		$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

		$orders = array();
		foreach ($result as $order)
			$orders[] = (int)($order['id_order']);
		return $orders;
	}

    public function calctulate_totals(){
        $products = $this->getCartProducts();
        $total = 0;
        if(!empty($products))
            foreach($products as &$p){
                $q = (int)$p['product_quantity'];
                $total += (int)$p['product_quantity'] * (float)$p['unit_price_tax_excl'];                
            }
        $total_wt = Tools::getPriceWT($total);                    
        $this->total_products = $total;
        $this->total_products_wt = $total_wt;

        $this->total_paid_tax_excl = $total; // tu bude treba dorobit pocitanie postovneho balneho a zlavy ak bude potreba
        $this->total_paid_tax_incl = $total_wt;
        $this->total_paid = $total_wt;        
    }

	public function getWsOrderRows2()
	{
		$query = 'SELECT id_order_detail as `id`, `product_id`, `unit_price_tax_excl` as `product_price`, `id_order`, `product_attribute_id`, `product_quantity`, `product_name`
		FROM `'._DB_PREFIX_.'order_detail`
		WHERE id_order = '.(int)$this->id;
		$result = Db::getInstance()->executeS($query);
		return $result;
	}
    
    public function delete(){
		$query = 'SELECT id_order_detail as `id`, `product_id`, `unit_price_tax_excl` as `product_price`, `id_order`, `product_attribute_id`, `product_quantity`, `product_name`
		FROM `'._DB_PREFIX_.'order_detail`
		WHERE id_order = '.(int)$this->id;
		$result = Db::getInstance()->executeS($query);
        

        $ret = parent::delete();        

        if(!empty($result) && is_array($result)){
            foreach($result as $od){
                StockAvailable::updateQuantity((int)$od['product_id'], (int)$od['product_attribute_id'], (int)$od['product_quantity']);                
            }
        }        

        return $ret;       
    }
}

