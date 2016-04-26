<?php

class AdminOrdersController extends AdminOrdersControllerCore
{
    public $classes = array('Provisions','Imports','VIPPrices');
	

	public function __construct()
	{	   
		parent::__construct();

		$this->addRowAction('delete');
        
        foreach($this->classes as $cls){
		  $classFile = _PS_MODULE_DIR_.'data/classes/'.$cls.'.php';            
		  include_once $classFile;
        }
        

		$statuses_array = array();
		$statuses = OrderState::getOrderStates((int)$this->context->language->id);
        
		foreach ($statuses as $status)
			     $statuses_array[$status['id_order_state']] = $status['name'];
//Tools::fd($statuses_array);
//Tools::fd($ozstatusy);

    if (Context::getContext()->employee->isLoggedBack() && (Context::getContext()->employee->id_profile == 5) ) {        	   
		$this->fields_list = array(
		'id_order' => array(
			'title' => $this->l('ID'),
			'align' => 'center',
			'width' => 25
		),
		'invoice_number' => array(
			'title' => $this->l('Invoice'),
			'align' => 'center',
			'width' => 65
		),
		'company' => array(
			'title' => $this->l('Firma'),
			'havingFilter' => true,
		),
		'customer' => array(
			'title' => $this->l('Customer'),
			'havingFilter' => true,
		),
		'total_paid_tax_incl' => array(
			'title' => $this->l('Total'),
			'width' => 70,
			'align' => 'right',
			'prefix' => '<b>',
			'suffix' => '</b>',
			'type' => 'price',
			'tprice' => true,
			'currency' => true
		),
		'total_provisions' => array(
			'title' => $this->l('Provízia'),
			'width' => 70,
			'align' => 'right',
			'prefix' => '<b>',
			'suffix' => '</b>',
			'type' => 'price',
			'provisions' => true,
			'currency' => true
		),
		'osname' => array(
			'title' => $this->l('Status'),
			'color' => 'color',
			'width' => 280,
			'type' => 'select',
			'list' => $statuses_array,
			'filter_key' => 'os!id_order_state',
			'filter_type' => 'int'
		),
		'date_add' => array(
			'title' => $this->l('Date'),
			'width' => 130,
			'align' => 'right',
			'type' => 'datetime',
			'filter_key' => 'a!date_add'
		),
		'id_pdf' => array(
			'title' => $this->l('PDF'),
			'width' => 35,
			'align' => 'center',
			'callback' => 'printPDFIcons',
			'orderby' => false,
			'search' => false,
			'remove_onclick' => true)
		);
    } else {
		$this->fields_list = array(
		'id_order' => array(
			'title' => $this->l('ID'),
			'align' => 'center',
			'width' => 25
		),
		'invoice_number' => array(
			'title' => $this->l('Invoice'),
			'align' => 'center',
			'width' => 65
		),
		'id_employee' => array(
			'title' => $this->l('ID OZ'),
			'align' => 'center',
			'width' => 25
		),
		'company' => array(
			'title' => $this->l('Firma'),
			'havingFilter' => true,
		),
		'customer' => array(
			'title' => $this->l('Customer'),
			'havingFilter' => true,
		),
		'total_paid_tax_incl' => array(
			'title' => $this->l('Total'),
			'width' => 70,
			'align' => 'right',
			'prefix' => '<b>',
			'suffix' => '</b>',
			'type' => 'price',
			'tprice' => true,
			'currency' => true
		),
		'total_provisions' => array(
			'title' => $this->l('Provízia'),
			'width' => 70,
			'align' => 'right',
			'prefix' => '<b>',
			'suffix' => '</b>',
			'type' => 'price',
			'provisions' => true,
			'currency' => true
		),
		'osname' => array(
			'title' => $this->l('Status'),
			'color' => 'color',
			'width' => 280,
			'type' => 'select',
			'list' => $statuses_array,
			'filter_key' => 'os!id_order_state',
			'filter_type' => 'int'
		),
		'date_add' => array(
			'title' => $this->l('Date'),
			'width' => 130,
			'align' => 'right',
			'type' => 'date',
			'filter_key' => 'a!date_add'
		),
		'id_pdf' => array(
			'title' => $this->l('PDF'),
			'width' => 35,
			'align' => 'center',
			'callback' => 'printPDFIcons',
			'orderby' => false,
			'search' => false,
			'remove_onclick' => true)
		);        
    }
    $this->fields_list['date_pay'] = array(
			'title' => $this->l('Splatnosť'),
			'width' => 130,
			'align' => 'right',
			'type' => 'date',
			'filter_key' => 'a!date_pay'
    );
    $this->fields_list['zostava'] = array(
			'title' => $this->l('Do splatnosti'),
			'width' => 35,
			'align' => 'center',
			'type' => 'int',
//			'filter_key' => '',
    );
    $this->fields_list['total_paid_real'] = array(
			'title' => $this->l('Zaplatené'),
			'width' => 70,
			'prefix' => '<b>',
			'suffix' => '</b>',
			'align' => 'right',
			'type' => 'price',
			'filter_key' => 'a!total_paid_real'
    );

        if (file_exists($this->context->smarty->getTemplateDir(1).DIRECTORY_SEPARATOR.$this->override_folder.'_documents.tpl')){
            Context::getContext()->smarty->assign(array('overiden_documents' => $this->context->smarty->getTemplateDir(1).DIRECTORY_SEPARATOR.$this->override_folder.'_documents.tpl'));            
        }
        

        

       if (Context::getContext()->employee->isLoggedBack() && (Context::getContext()->employee->id_profile == 5) ) {        
            Context::getContext()->smarty->assign(array('oz' => true));
            if (Tools::isSubmit('id_order'))
            {
                $order = new Order((int)Tools::getValue('id_order'));
                $dodaci = $order->getHistory((int)$this->context->language->id, 4);
                if(!empty($dodaci)) {
                    Context::getContext()->smarty->assign(array('disable_fakturu' => true));                
                } else {
                    Context::getContext()->smarty->assign(array('disable_fakturu' => false));
                }
            }
       } else {
            Context::getContext()->smarty->assign(array(
                'oz' => false,
                'disable_fakturu' => false
            ));
       }
       
       Context::getContext()->smarty->assign(array(
            'nos_provisions' => Configuration::get('PS_NEW_ORDER_SHOW_PROVISIONS'),
            'nos_ean' => Configuration::get('PS_NEW_ORDER_SHOW_EAN'),
            'nos_price' => Configuration::get('PS_NEW_ORDER_SHOW_PRICE'),
            'nos_qty' => Configuration::get('PS_NEW_ORDER_SHOW_QTY'),
            'nos_qty2add' => Configuration::get('PS_NEW_ORDER_SHOW_QTY2ADD'),
       ));
    
//    var_dump($this->override_folder);
    }

	public function renderList()
	{
    
        if (Context::getContext()->employee->isLoggedBack() && (Context::getContext()->employee->id_profile == 5) ) {
//            var_dump($this->_join);
            $this->_where = 'AND c.`id_employee` = '.(Context::getContext()->employee->id);            
        }
        
        $this->_select .= " , DATEDIFF(a.`date_pay`,now()) as zostava";

        $backup = $this;
//-------------------------------------------------------------------

		$this->getList(Context::getContext()->language->id,null,null,0,false);
        
//        var_dump($this->_list);
                    
        $total3 = 0;
        $total4 = 0;
                            
        if(!empty($this->_list) && is_array($this->_list))
            foreach($this->_list as $row){
                $total3 += (float)$row['total_paid_tax_incl'];
                $total4 += (float)$row['total_provisions'];
            }

//        var_dump($total3);
            
            
        if(!empty($this->_list) && is_array($this->_list)){                
            Context::getContext()->smarty->assign(array(
                'total5' => $total3,
                'total6' => $total4,
                'currency' => Context::getContext()->currency,
            ));
                    
        }
        
//-------------------------------------------------------------------
        foreach($backup as $key => $val){
            $this->$key = $val;
        }

        $filter = '';
        if(!empty($this->_filter)){
            $filter = '&filter='.urlencode($this->_filter);
        }

		$this->toolbar_btn['export'] = array(
			'href' => $this->context->link->getAdminLink('AdminOrders', true).'&export=1'.$filter,
			'desc' => $this->l('Export')
		);

//        Tools::fd($this->_listsql);

   		return parent::renderList();

    }
/*
	public function renderView()
	{
       if (Context::getContext()->employee->isLoggedBack() && (Context::getContext()->employee->id_profile == 5) ) {
            Context::getContext()->smarty->assign(array('oz' => true));
       } else {
            Context::getContext()->smarty->assign(array('oz' => false));
       }
       

	   return parent::renderView();
    }
*/    

    function datetomysql($date){
        $newdate = $date;
        if((strpos($date,'.') !==false) && (strlen($date) == 10)) {
            $tmp = explode('.',$date);
            $newdate = $tmp[2].'-'.$tmp[1].'-'.$tmp[0];
        }
    return $newdate;
    }


	public function ajaxProcessDatePay()
	{
        $out = array('success' => false);
        if(Tools::isSubmit('id_order') && Tools::isSubmit('date_pay')){
            $o = new Order((int)Tools::getValue('id_order'));
            $date = $this->datetomysql(Tools::getValue('date_pay'));
            if(Validate::isDate($date)){
                $o->date_pay = $date;
                $out = array('success' => (bool)$o->update());
            }
        }	   
        $this->content = Tools::jsonEncode($out);
    }

	public function ajaxProcessSearchProducts()
	{
        $timer = array();
        $timer['start'] = microtime(true);
		Context::getContext()->customer = new Customer((int)Tools::getValue('id_customer'));
        
		$currency = new Currency((int)Tools::getValue('id_currency'));
        $timer['stage_0'] = microtime(true) - $timer['start'];
		if ($products = Product::searchByName((int)$this->context->language->id, pSQL(Tools::getValue('product_search'))))
		{
            $timer['stage_1'] = microtime(true) - $timer['start'];
            $cmr = Context::getContext()->customer;
            if(empty($cmr->id)) {
                $cmr = new Customer((int)Customer::getByAddress((int)Tools::getValue('id_address')));
                Context::getContext()->customer = $cmr;                
            } 
//            $test = $cmr->isVIP();
//            tools::fd($test);            
            $disabled = array();
            if($cmr->isVIP()){
                $vipgrps = $cmr->getVIPgrps();
                $vipgrp = array_shift($vipgrps);
                
                $vpp = VIPPrices::getProductsVIPPrices($products,$vipgrp);
                $timer['stage_2'] = microtime(true) - $timer['start'];                
                if(!empty($vpp))
                    foreach ($products as &$product){
                        if(key_exists($product['id_product'],$vpp)) {
                            $product['cena_2'] = (float)$vpp[$product['id_product']]['cena_2'];
                            $product['price'] = (float)$vpp[$product['id_product']]['z_cena'];
                            $product['z_cena'] = (float)$vpp[$product['id_product']]['z_cena'];
                            $product['provizia'] = (float)$vpp[$product['id_product']]['provizia'];                                                    
                        } else {
                            $disabled[] = $product['id_product'];                            
                        }
                    }                
            } else {
                if(!empty($products))
                    foreach ($products as &$product){
                        $prv = Provisions::getByIdProduct($product['id_product']);
                        $product['price'] = (float)$product['price'];
                        $product['z_cena'] = (float)$product['price'];
                        $product['cena_2'] = (float)$prv['cena_2'];
                        $product['provizia'] = (float)$prv['provizia'];                                                    
                    }                                
            }
            $out = array();
            $timer['stage_3'] = microtime(true) - $timer['start'];            
    if($cmr->isVIP())
    {            
			foreach ($products as &$product)
			{
		      if(!(in_array($product['id_product'],$disabled))){
				// Formatted price
				$product['formatted_price'] = Tools::displayPrice(Tools::convertPrice($product['price_tax_incl'], $currency), $currency);
				// Concret price
				$product['price_tax_incl'] = Tools::ps_round(Tools::convertPrice($product['price_tax_incl'], $currency), 2);
				$product['price_tax_excl'] = Tools::ps_round(Tools::convertPrice($product['price_tax_excl'], $currency), 2);
				$productObj = new Product((int)$product['id_product'], false, (int)$this->context->language->id);
				$combinations = array();
				$attributes = $productObj->getAttributesGroups((int)$this->context->language->id);
				
				// Tax rate for this customer
				if (Tools::isSubmit('id_address'))
					$product['tax_rate'] = $productObj->getTaxesRate(new Address(Tools::getValue('id_address')));

				$product['warehouse_list'] = array();

				foreach ($attributes as $attribute)
				{
					if (!isset($combinations[$attribute['id_product_attribute']]['attributes']))
						$combinations[$attribute['id_product_attribute']]['attributes'] = '';
					$combinations[$attribute['id_product_attribute']]['attributes'] .= $attribute['attribute_name'].' - ';
					$combinations[$attribute['id_product_attribute']]['id_product_attribute'] = $attribute['id_product_attribute'];
					$combinations[$attribute['id_product_attribute']]['default_on'] = $attribute['default_on'];
					if (!isset($combinations[$attribute['id_product_attribute']]['price']))
					{
						$price_tax_incl = Product::getPriceStatic((int)$product['id_product'], true, $attribute['id_product_attribute']);
						$price_tax_excl = Product::getPriceStatic((int)$product['id_product'], false, $attribute['id_product_attribute']);
						$combinations[$attribute['id_product_attribute']]['price_tax_incl'] = Tools::ps_round(Tools::convertPrice($price_tax_incl, $currency), 2);
						$combinations[$attribute['id_product_attribute']]['price_tax_excl'] = Tools::ps_round(Tools::convertPrice($price_tax_excl, $currency), 2);
						$combinations[$attribute['id_product_attribute']]['formatted_price'] = Tools::displayPrice(Tools::convertPrice($price_tax_excl, $currency), $currency);
					}
					if (!isset($combinations[$attribute['id_product_attribute']]['qty_in_stock']))
						$combinations[$attribute['id_product_attribute']]['qty_in_stock'] = StockAvailable::getQuantityAvailableByProduct((int)$product['id_product'], $attribute['id_product_attribute'], (int)$this->context->shop->id);

					if (Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT') && (int)$product['advanced_stock_management'] == 1)
						$product['warehouse_list'][$attribute['id_product_attribute']] = Warehouse::getProductWarehouseList($product['id_product'], $attribute['id_product_attribute']);
					else
						$product['warehouse_list'][$attribute['id_product_attribute']] = array();

					$product['stock'][$attribute['id_product_attribute']] = Product::getRealQuantity($product['id_product'], $attribute['id_product_attribute']);

				}

				if (Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT') && (int)$product['advanced_stock_management'] == 1)
					$product['warehouse_list'][0] = Warehouse::getProductWarehouseList($product['id_product']);
				else
					$product['warehouse_list'][0] = array();

				$product['stock'][0] = StockAvailable::getQuantityAvailableByProduct((int)$product['id_product'], 0, (int)$this->context->shop->id);

				foreach ($combinations as &$combination)
					$combination['attributes'] = rtrim($combination['attributes'], ' - ');
				$product['combinations'] = $combinations;
				
				if ($product['customizable'])
				{
					$product_instance = new Product((int)$product['id_product']);
					$product['customization_fields'] = $product_instance->getCustomizationFields($this->context->language->id);
				}
                $out[] = $product;
                
              }
			}
   } else {
			foreach ($products as &$product)
			{
				// Formatted price
				$product['formatted_price'] = Tools::displayPrice(Tools::convertPrice($product['price_tax_incl'], $currency), $currency);
				// Concret price
				$product['price_tax_incl'] = Tools::ps_round(Tools::convertPrice($product['price_tax_incl'], $currency), 2);
				$product['price_tax_excl'] = Tools::ps_round(Tools::convertPrice($product['price_tax_excl'], $currency), 2);
				$productObj = new Product((int)$product['id_product'], false, (int)$this->context->language->id);
				$combinations = array();
				$attributes = $productObj->getAttributesGroups((int)$this->context->language->id);
				
				// Tax rate for this customer
				if (Tools::isSubmit('id_address'))
					$product['tax_rate'] = $productObj->getTaxesRate(new Address(Tools::getValue('id_address')));

				$product['warehouse_list'] = array();

				foreach ($attributes as $attribute)
				{
					if (!isset($combinations[$attribute['id_product_attribute']]['attributes']))
						$combinations[$attribute['id_product_attribute']]['attributes'] = '';
					$combinations[$attribute['id_product_attribute']]['attributes'] .= $attribute['attribute_name'].' - ';
					$combinations[$attribute['id_product_attribute']]['id_product_attribute'] = $attribute['id_product_attribute'];
					$combinations[$attribute['id_product_attribute']]['default_on'] = $attribute['default_on'];
					if (!isset($combinations[$attribute['id_product_attribute']]['price']))
					{
						$price_tax_incl = Product::getPriceStatic((int)$product['id_product'], true, $attribute['id_product_attribute']);
						$price_tax_excl = Product::getPriceStatic((int)$product['id_product'], false, $attribute['id_product_attribute']);
						$combinations[$attribute['id_product_attribute']]['price_tax_incl'] = Tools::ps_round(Tools::convertPrice($price_tax_incl, $currency), 2);
						$combinations[$attribute['id_product_attribute']]['price_tax_excl'] = Tools::ps_round(Tools::convertPrice($price_tax_excl, $currency), 2);
						$combinations[$attribute['id_product_attribute']]['formatted_price'] = Tools::displayPrice(Tools::convertPrice($price_tax_excl, $currency), $currency);
					}
					if (!isset($combinations[$attribute['id_product_attribute']]['qty_in_stock']))
						$combinations[$attribute['id_product_attribute']]['qty_in_stock'] = StockAvailable::getQuantityAvailableByProduct((int)$product['id_product'], $attribute['id_product_attribute'], (int)$this->context->shop->id);

					if (Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT') && (int)$product['advanced_stock_management'] == 1)
						$product['warehouse_list'][$attribute['id_product_attribute']] = Warehouse::getProductWarehouseList($product['id_product'], $attribute['id_product_attribute']);
					else
						$product['warehouse_list'][$attribute['id_product_attribute']] = array();

					$product['stock'][$attribute['id_product_attribute']] = Product::getRealQuantity($product['id_product'], $attribute['id_product_attribute']);

				}

				if (Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT') && (int)$product['advanced_stock_management'] == 1)
					$product['warehouse_list'][0] = Warehouse::getProductWarehouseList($product['id_product']);
				else
					$product['warehouse_list'][0] = array();

				$product['stock'][0] = StockAvailable::getQuantityAvailableByProduct((int)$product['id_product'], 0, (int)$this->context->shop->id);

				foreach ($combinations as &$combination)
					$combination['attributes'] = rtrim($combination['attributes'], ' - ');
				$product['combinations'] = $combinations;
				
				if ($product['customizable'])
				{
					$product_instance = new Product((int)$product['id_product']);
					$product['customization_fields'] = $product_instance->getCustomizationFields($this->context->language->id);
				}
                $out[] = $product;
                
			}
    
   }
   
            if(!empty($out)) {
                $to_return = array(
				    'products' => $out,
				    'found' => true
			    );                
            } else {
                $to_return = array('products' => $out,'found' => false);                
            }
		}
		else
			$to_return = array('products' => $out,'found' => false);
   
        $timer['stage_4'] = microtime(true) - $timer['start'];
        $to_return['timer'] = $timer;

		$this->content = Tools::jsonEncode($to_return);
	}

	protected function doEditProductValidation(OrderDetail $order_detail, Order $order, OrderInvoice $order_invoice = null)
	{
		if (!Validate::isLoadedObject($order_detail))
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Can\'t load Order Detail object')
			)));

		if (!empty($order_invoice) && !Validate::isLoadedObject($order_invoice))
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Can\'t load Invoice object')
			)));

		if (!Validate::isLoadedObject($order))
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Can\'t load Order object')
			)));

		if ($order_detail->id_order != $order->id)
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Can\'t edit this Order Detail for this order')
			)));

		if (!empty($order_invoice) && $order_invoice->id_order != Tools::getValue('id_order'))
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Can\'t use this invoice for this order')
			)));

		// Clean price
		$product_price_tax_incl = str_replace(',', '.', Tools::getValue('product_price_tax_incl'));
		$product_price_tax_excl = str_replace(',', '.', Tools::getValue('product_price_tax_excl'));

		if (!Validate::isPrice($product_price_tax_incl) || !Validate::isPrice($product_price_tax_excl))
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Invalid price')
			)));

		if (!is_array(Tools::getValue('product_quantity')) && !Validate::isUnsignedInt(Tools::getValue('product_quantity')))
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Invalid quantity')
			)));
		elseif (is_array(Tools::getValue('product_quantity')))
			foreach (Tools::getValue('product_quantity') as $qty)
				if (!Validate::isUnsignedInt($qty))
					die(Tools::jsonEncode(array(
						'result' => false,
						'error' => Tools::displayError('Invalid quantity')
					)));
	}

	protected function doDeleteProductLineValidation(OrderDetail $order_detail, Order $order)
	{
		if (!Validate::isLoadedObject($order_detail))
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Can\'t load Order Detail object')
			)));

		if (!Validate::isLoadedObject($order))
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Can\'t load Order object')
			)));

		if ($order_detail->id_order != $order->id)
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Can\'t delete this Order Detail for this order')
			)));

	}
    
	protected function getProducts($order)
	{
		$products = $order->getProducts();

        $idc = $order->id_customer;
        if(!empty($idc)) {
            $cmr = new Customer($idc);
        } else {
            $cmr = Context::getContext()->customer;
        }                        
        if($cmr->isVIP()){
            $vipgrps = $cmr->getVIPgrps();
            $vipgrp = array_shift($vipgrps);

            $vpp = VIPPrices::getProductsVIPPrices($products,$vipgrp);
            if(!empty($vpp))
                foreach ($products as &$product){
                    if(key_exists($product['id_product'],$vpp)) {
                        $product['cena_2'] = (float)$vpp[$product['id_product']]['cena_2'];
//                        $product['price'] = (float)$vpp[$product['id_product']]['z_cena'];
//                        $product['z_cena'] = (float)$vpp[$product['id_product']]['z_cena'];
                        $product['provizia'] = (float)$vpp[$product['id_product']]['provizia'];                                                    
                    }
                }                

        }        

        

		foreach ($products as &$product)
		{
			if ($product['image'] != null)
			{
				$name = 'product_mini_'.(int)$product['product_id'].(isset($product['product_attribute_id']) ? '_'.(int)$product['product_attribute_id'] : '').'.jpg';
				// generate image cache, only for back office
				$product['image_tag'] = ImageManager::thumbnail(_PS_IMG_DIR_.'p/'.$product['image']->getExistingImgPath().'.jpg', $name, 45, 'jpg');
				if (file_exists(_PS_TMP_IMG_DIR_.$name))
					$product['image_size'] = getimagesize(_PS_TMP_IMG_DIR_.$name);
				else
					$product['image_size'] = false;
			}
            
            if(!$cmr->isVIP()){
                $pp = Provisions::getByIdProduct($product['product_id']);
                $product['cena_2'] = (float)$pp['cena_2'];
                $product['provizia'] = (float)$pp['provizia'];                                                
            }   
                                     
            
		}
        

		return $products;
	}
    
    

	public function ajaxProcessAddProductOnOrder()
	{
		// Load object
		$order = new Order((int)Tools::getValue('id_order'));
		if (!Validate::isLoadedObject($order))
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Can\'t load Order object')
			)));


		$product_informations = $_POST['add_product'];
		if (isset($_POST['add_invoice']))
			$invoice_informations = $_POST['add_invoice'];
		else
			$invoice_informations = array();
		$product = new Product($product_informations['product_id'], false, $order->id_lang);
		if (!Validate::isLoadedObject($product))
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Can\'t load Product object')
			)));

		if (isset($product_informations['product_attribute_id']) && $product_informations['product_attribute_id'])
		{
			$combination = new Combination($product_informations['product_attribute_id']);
			if (!Validate::isLoadedObject($combination))
				die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Can\'t load Combination object')
			)));
		}

		// Total method
		$total_method = Cart::BOTH_WITHOUT_SHIPPING;

		// Create new cart
		$cart = new Cart($order->id_cart);        

		// Save context (in order to apply cart rule)
		$this->context->cart = $cart;
		$this->context->customer = new Customer($order->id_customer);

		// always add taxes even if there are not displayed to the customer
		$use_taxes = true;

		$initial_product_price_tax_incl = Product::getPriceStatic($product->id, $use_taxes, isset($combination) ? $combination->id : null, 2, null, false, true, 1,
			false, $order->id_customer, $cart->id, $order->{Configuration::get('PS_TAX_ADDRESS_TYPE')});

		// Creating specific price if needed
		if ($product_informations['product_price_tax_incl'] != $initial_product_price_tax_incl)
		{
			$specific_price = new SpecificPrice();
			$specific_price->id_shop = 0;
			$specific_price->id_shop_group = 0;
			$specific_price->id_currency = 0;
			$specific_price->id_country = 0;
			$specific_price->id_group = 0;
			$specific_price->id_customer = $order->id_customer;
			$specific_price->id_product = $product->id;
			if (isset($combination))
				$specific_price->id_product_attribute = $combination->id;
			else
				$specific_price->id_product_attribute = 0;
			$specific_price->price = $product_informations['product_price_tax_excl'];
			$specific_price->from_quantity = 1;
			$specific_price->reduction = 0;
			$specific_price->reduction_type = 'amount';
			$specific_price->from = '0000-00-00 00:00:00';
			$specific_price->to = '0000-00-00 00:00:00';
			$specific_price->add();
		}

		// Add product to cart
		$update_quantity = $cart->updateQty($product_informations['product_quantity'], $product->id, isset($product_informations['product_attribute_id']) ? $product_informations['product_attribute_id'] : null,
			isset($combination) ? $combination->id : null, 'up', 0, new Shop($cart->id_shop));
			
		if ($update_quantity < 0)
		{
			// If product has attribute, minimal quantity is set with minimal quantity of attribute
			$minimal_quantity = ($product_informations['product_attribute_id']) ? Attribute::getAttributeMinimalQty($product_informations['product_attribute_id']) : $product->minimal_quantity;
			die(Tools::jsonEncode(array('error' => sprintf(Tools::displayError('You must add %d minimum quantity', false), $minimal_quantity))));
		}
		elseif (!$update_quantity)
			die(Tools::jsonEncode(array('error' => Tools::displayError('You already have the maximum quantity available for this product.', false))));
		
		// If order is valid, we can create a new invoice or edit an existing invoice
		if ($order->hasInvoice())
		{
			$order_invoice = new OrderInvoice($product_informations['invoice']);
			// Create new invoice
			if ($order_invoice->id == 0)
			{
				// If we create a new invoice, we calculate shipping cost
				$total_method = Cart::BOTH;
				// Create Cart rule in order to make free shipping
				if (isset($invoice_informations['free_shipping']) && $invoice_informations['free_shipping'])
				{
					$cart_rule = new CartRule();
					$cart_rule->id_customer = $order->id_customer;
					$cart_rule->name = array(
						Configuration::get('PS_LANG_DEFAULT') => $this->l('[Generated] CartRule for Free Shipping')
					);
					$cart_rule->date_from = date('Y-m-d H:i:s', time());
					$cart_rule->date_to = date('Y-m-d H:i:s', time() + 24 * 3600);
					$cart_rule->quantity = 1;
					$cart_rule->quantity_per_user = 1;
					$cart_rule->minimum_amount_currency = $order->id_currency;
					$cart_rule->reduction_currency = $order->id_currency;
					$cart_rule->free_shipping = true;
					$cart_rule->active = 1;
					$cart_rule->add();

					// Add cart rule to cart and in order
					$cart->addCartRule($cart_rule->id);
					$values = array(
						'tax_incl' => $cart_rule->getContextualValue(true),
						'tax_excl' => $cart_rule->getContextualValue(false)
					);
					$order->addCartRule($cart_rule->id, $cart_rule->name[Configuration::get('PS_LANG_DEFAULT')], $values);
				}

				$order_invoice->id_order = $order->id;
				if ($order_invoice->number)
					Configuration::updateValue('PS_INVOICE_START_NUMBER', false);
				else
					$order_invoice->number = Order::getLastInvoiceNumber() + 1;

				$invoice_address = new Address((int)$order->{Configuration::get('PS_TAX_ADDRESS_TYPE')});
				$carrier = new Carrier((int)$order->id_carrier);
				$tax_calculator = $carrier->getTaxCalculator($invoice_address);

//				$order_invoice->total_paid_tax_excl = Tools::ps_round((float)$order->getOrderTotal(false, $total_method), 2);
//				$order_invoice->total_paid_tax_incl = Tools::ps_round((float)$order->getOrderTotal($use_taxes, $total_method), 2);
//				$order_invoice->total_products = (float)$order->getOrderTotal(false, Cart::ONLY_PRODUCTS);
//				$order_invoice->total_products_wt = (float)$order->getOrderTotal($use_taxes, Cart::ONLY_PRODUCTS);
                
                $order_invoice->calculate_totals();

				$order_invoice->total_shipping_tax_excl = (float)$cart->getTotalShippingCost(null, false);
				$order_invoice->total_shipping_tax_incl = (float)$cart->getTotalShippingCost();

				$order_invoice->total_wrapping_tax_excl = abs($order->getOrderTotal(false, Cart::ONLY_WRAPPING));
				$order_invoice->total_wrapping_tax_incl = abs($order->getOrderTotal($use_taxes, Cart::ONLY_WRAPPING));
				$order_invoice->shipping_tax_computation_method = (int)$tax_calculator->computation_method;

				// Update current order field, only shipping because other field is updated later
				$order->total_shipping += $order_invoice->total_shipping_tax_incl;
				$order->total_shipping_tax_excl += $order_invoice->total_shipping_tax_excl;
				$order->total_shipping_tax_incl += ($use_taxes) ? $order_invoice->total_shipping_tax_incl : $order_invoice->total_shipping_tax_excl;

				$order->total_wrapping += abs($order->getOrderTotal($use_taxes, Cart::ONLY_WRAPPING));
				$order->total_wrapping_tax_excl += abs($order->getOrderTotal(false, Cart::ONLY_WRAPPING));
				$order->total_wrapping_tax_incl += abs($order->getOrderTotal($use_taxes, Cart::ONLY_WRAPPING));
				$order_invoice->add();

				$order_invoice->saveCarrierTaxCalculator($tax_calculator->getTaxesAmount($order_invoice->total_shipping_tax_excl));

				$order_carrier = new OrderCarrier();
				$order_carrier->id_order = (int)$order->id;
				$order_carrier->id_carrier = (int)$order->id_carrier;
				$order_carrier->id_order_invoice = (int)$order_invoice->id;
				$order_carrier->weight = (float)$cart->getTotalWeight();
				$order_carrier->shipping_cost_tax_excl = (float)$order_invoice->total_shipping_tax_excl;
				$order_carrier->shipping_cost_tax_incl = ($use_taxes) ? (float)$order_invoice->total_shipping_tax_incl : (float)$order_invoice->total_shipping_tax_excl;
				$order_carrier->add();
			}
			// Update current invoice
			else
			{
                $order_invoice->calculate_totals();
                
				$order_invoice->update();
			}

            $order_invoice->total_paid_tax_incl = Tools::ps_round((float)(Tools::getPriceWT($order_invoice->total_paid_tax_excl)), 2);
            $order_invoice->total_products_wt = (float)(Tools::getPriceWT($order_invoice->total_products));
            $order_invoice->update();            
		}
		// Create Order detail information
		$order_detail = new OrderDetail();
		$order_detail->createList($order, $cart, $order->getCurrentOrderState(), $cart->getProducts(true,$product->id), (isset($order_invoice) ? $order_invoice->id : 0), $use_taxes, (int)Tools::getValue('add_product_warehouse'));

		// update totals amount of order
        $order->calctulate_totals();
		
		if (isset($order_invoice) && Validate::isLoadedObject($order_invoice))
		{
			$order->total_shipping = $order_invoice->total_shipping_tax_incl;
			$order->total_shipping_tax_incl = $order_invoice->total_shipping_tax_incl;
			$order->total_shipping_tax_excl = $order_invoice->total_shipping_tax_excl;
		}
		// discount
		$order->total_discounts += (float)abs($order->getOrderTotal(true, Cart::ONLY_DISCOUNTS));
		$order->total_discounts_tax_excl += (float)abs($order->getOrderTotal(false, Cart::ONLY_DISCOUNTS));
		$order->total_discounts_tax_incl += (float)abs($order->getOrderTotal(true, Cart::ONLY_DISCOUNTS));

		// Save changes of order
		$order->update();

		// Update Tax lines
		$order_detail->updateTaxAmount($order);

		if (isset($order_invoice) && Validate::isLoadedObject($order_invoice))
		{
            $order_invoice->calculate_totals();
                
            $order_invoice->update();
        }
        

		// Delete specific price if exists
		if (isset($specific_price))
			$specific_price->delete();

		$products = $this->getProducts($order);

		// Get the last product
		$product = end($products);
		$resume = OrderSlip::getProductSlipResume((int)$product['id_order_detail']);
		$product['quantity_refundable'] = $product['product_quantity'] - $resume['product_quantity'];
		$product['amount_refundable'] = $product['total_price_tax_incl'] - $resume['amount_tax_incl'];
		$product['amount_refund'] = Tools::displayPrice($resume['amount_tax_incl']);
		$product['return_history'] = OrderReturn::getProductReturnDetail((int)$product['id_order_detail']);
		$product['refund_history'] = OrderSlip::getProductSlipDetail((int)$product['id_order_detail']);

		// Get invoices collection
		$invoice_collection = $order->getInvoicesCollection();

		$invoice_array = array();
		foreach ($invoice_collection as $invoice)
		{
			$invoice->name = $invoice->getInvoiceNumberFormatted(Context::getContext()->language->id);
			$invoice_array[] = $invoice;
		}

        $this->context->smarty->caching = 0;
        $this->context->smarty->setCaching(Smarty::CACHING_OFF);
        $this->context->smarty->clearCache('_product_line.tpl');

		// Assign to smarty informations in order to show the new product line
		$this->context->smarty->assign(array(
			'product' => $product,
			'order' => $order,
			'currency' => new Currency($order->id_currency),
			'can_edit' => $this->tabAccess['edit'],
			'invoices_collection' => $invoice_collection,
			'current_id_lang' => Context::getContext()->language->id,
			'link' => Context::getContext()->link,
			'current_index' => self::$currentIndex
		),null, true);
		
		$this->sendChangedNotification($order);

        $tpl = $this->createTemplate('_product_line.tpl');
        $tpl->caching = Smarty::CACHING_OFF;
        $tpl->cached->valid = false;
        $tplout = $tpl->fetch();
        $this->context->smarty->caching = 1;
        

		die(Tools::jsonEncode(array(
			'result' => true,
			'view' => $tplout,
			'can_edit' => $this->tabAccess['add'],
			'order' => $order,
			'invoices' => $invoice_array,
			'documents_html' => $this->createTemplate('_documents.tpl')->fetch(),
			'shipping_html' => $this->createTemplate('_shipping.tpl')->fetch(),
			'discount_form_html' => $this->createTemplate('_discount_form.tpl')->fetch(),
            'product' => $product
		)));
	}


	public function postProcess()
	{
		// If id_order is sent, we instanciate a new Order object
		if (Tools::isSubmit('id_order') && Tools::getValue('id_order') > 0)
		{
			$order = new Order(Tools::getValue('id_order'));
			if (!Validate::isLoadedObject($order))
				throw new PrestaShopException('Can\'t load Order object');
		}
        
        if(Tools::isSubmit('export')){
            $filter = Tools::getValue('filter');
            if(!empty($filter))
                $filter = urldecode($filter); 
//            $this->getList($this->context->language->id);
            
            $rows = Db::getInstance()->executeS("SELECT SQL_CALC_FOUND_ROWS
		a.`id_order`,`invoice_number`,`id_employee`,`company`,`total_paid_tax_incl`,`total_provisions`,a.date_add as date_add,a.date_pay as date_pay,a.total_paid_real as total_paid_real
		, 
		a.id_currency,
		a.id_order AS id_pdf,
		CONCAT(LEFT(c.`firstname`, 1), '. ', c.`lastname`) AS `customer`,
		osl.`name` AS `osname`,
		os.`color`,
		IF((SELECT COUNT(so.id_order) FROM `new_orders` so WHERE so.id_customer = a.id_customer) > 1, 0, 1) as new , DATEDIFF(a.`date_pay`,now()) as zostava
		FROM `new_orders` a				
		LEFT JOIN `new_customer` c ON (c.`id_customer` = a.`id_customer`)
		LEFT JOIN `new_order_state` os ON (os.`id_order_state` = a.`current_state`)
		LEFT JOIN `new_order_state_lang` osl ON (os.`id_order_state` = osl.`id_order_state` AND osl.`id_lang` = 7) 		
		WHERE 1 ".$filter." ORDER BY a.id_order DESC");
                        
            if(!empty($rows)){             
                $subor = _PS_DOWNLOAD_DIR_.'objednavky.csv';
                $fil = fopen($subor,'w');
                
                if(!empty($fil)){
                    $keys = array_keys($rows[0]);
                    fputcsv($fil,$keys,';');
//                    $str = implode(';',$keys)."\r\n";
//                    $fwr = fwrite($fil,$str, strlen($str));
                    foreach($rows as $row){
                        $fwr = fputcsv($fil,$row,';');
//                        $str = implode(';',$row)."\r\n";
//                        $fwr = fwrite($fil,$str, strlen($str));
                        if($fwr === false) die('write error');
                    }
//                    die($str);                    
                } else die('fopen error');


// Redirect output to a client’s web browser (Excel5)
                header('Content-Type: text/csv');
                header('Content-Disposition: attachment;filename="'.basename($subor).'"');
                header('Content-Length: ' . filesize($subor));
                
                header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
                header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
                header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header ('Pragma: public'); // HTTP/1.0
                readfile($subor);
                fclose($fil);
                unlink($subor);
                die();
            } else die('empty respond');
        }
        
        
		if (Tools::isSubmit('submitGenerateInvoice') && isset($order))
		{
			if (!Configuration::get('PS_INVOICE'))
				$this->errors[] = Tools::displayError('Invoice management has been disabled');
			elseif ($order->hasInvoice())
				$this->errors[] = Tools::displayError('This order already has an invoice');
			else
			{
				$order->setInvoice(true);
				Tools::redirectAdmin(self::$currentIndex.'&id_order='.$order->id.'&vieworder&conf=4&token='.$this->token);
			}
		} else {
            parent::postProcess();
		}                
    }

	public function ajaxProcessEditProductOnOrder()
	{
		// Return value
		$res = true;

		$order = new Order((int)Tools::getValue('id_order'));
		$order_detail = new OrderDetail((int)Tools::getValue('product_id_order_detail'));
		if (Tools::isSubmit('product_invoice'))
			$order_invoice = new OrderInvoice((int)Tools::getValue('product_invoice'));

		// Check fields validity
		$this->doEditProductValidation($order_detail, $order, isset($order_invoice) ? $order_invoice : null);

		// If multiple product_quantity, the order details concern a product customized
		$product_quantity = 0;
		if (is_array(Tools::getValue('product_quantity')))
			foreach (Tools::getValue('product_quantity') as $id_customization => $qty)
			{
				// Update quantity of each customization
				Db::getInstance()->update('customization', array('quantity' => $qty), 'id_customization = '.(int)$id_customization);
				// Calculate the real quantity of the product
				$product_quantity += $qty;
			}
		else
			$product_quantity = Tools::getValue('product_quantity');

		$product_price_tax_incl = Tools::ps_round(Tools::getValue('product_price_tax_incl'), 2);
		$product_price_tax_excl = Tools::ps_round(Tools::getValue('product_price_tax_excl'), 2);
		$total_products_tax_excl = $product_price_tax_excl * $product_quantity;
		$total_products_tax_incl = Tools::ps_round((float)(Tools::getPriceWT($total_products_tax_excl)), 2);

		// Calculate differences of price (Before / After)
		$diff_price_tax_incl = $total_products_tax_incl - $order_detail->total_price_tax_incl;
		$diff_price_tax_excl = $total_products_tax_excl - $order_detail->total_price_tax_excl;

		$old_quantity = $order_detail->product_quantity;

		$order_detail->product_quantity = $product_quantity;
        
        
//var_dump($diff_price_tax_excl);
//var_dump($diff_price_tax_incl);
		// Apply change on OrderInvoice
		if (isset($order_invoice))
			// If OrderInvoice to use is different, we update the old invoice and new invoice
			if ($order_detail->id_order_invoice != $order_invoice->id)
			{
				$old_order_invoice = new OrderInvoice($order_detail->id_order_invoice);
				// We remove cost of products
				$old_order_invoice->total_products -= $order_detail->total_price_tax_excl;
				$old_order_invoice->total_products_wt = Tools::ps_round((float)(Tools::getPriceWT($old_order_invoice->total_products)), 2);

				$old_order_invoice->total_paid_tax_excl -= $order_detail->total_price_tax_excl;
				$old_order_invoice->total_paid_tax_incl = Tools::ps_round((float)(Tools::getPriceWT($old_order_invoice->total_paid_tax_excl)), 2);

				$res &= $old_order_invoice->update();

				$order_invoice->total_products += $order_detail->total_price_tax_excl;
				$order_invoice->total_products_wt = Tools::ps_round((float)(Tools::getPriceWT($order_invoice->total_products)), 2);

				$order_invoice->total_paid_tax_excl += $order_detail->total_price_tax_excl;
				$order_invoice->total_paid_tax_incl = Tools::ps_round((float)(Tools::getPriceWT($order_invoice->total_paid_tax_excl)), 2);

				$order_detail->id_order_invoice = $order_invoice->id;
			}
            
        $ct = false;   
        $od = false;         

		if ($diff_price_tax_incl != 0 && $diff_price_tax_excl != 0)
		{
			$order_detail->unit_price_tax_excl = $product_price_tax_excl;
//			$order_detail->unit_price_tax_incl = $product_price_tax_incl;

//			$order_detail->total_price_tax_excl += $diff_price_tax_excl;
//			$order_detail->total_price_tax_incl = Tools::ps_round((float)(Tools::getPriceWT($order_detail->total_price_tax_excl)), 2);
            $order_detail->calculate_totals();

    		$res &= $order_detail->updateTaxAmount($order);

		    $res &= $order_detail->update();
            
            $od = true;

			if (isset($order_invoice))
			{
				// Apply changes on OrderInvoice
				$order_invoice->total_products += $diff_price_tax_excl;
				$order_invoice->total_products_wt = Tools::ps_round((float)(Tools::getPriceWT($order_invoice->total_products)), 2);

				$order_invoice->total_paid_tax_excl += $diff_price_tax_excl;
				$order_invoice->total_paid_tax_incl = Tools::ps_round((float)(Tools::getPriceWT($order_invoice->total_paid_tax_excl)), 2);
			}

			// Apply changes on Order
			$order = new Order($order_detail->id_order);
//			$order->total_products += $diff_price_tax_excl;
//			$order->total_products_wt = Tools::ps_round((float)(Tools::getPriceWT($order->total_products)), 2);

//			$order->total_paid_tax_excl += $diff_price_tax_excl;
//			$order->total_paid_tax_incl = Tools::ps_round((float)(Tools::getPriceWT($order->total_paid_tax_excl)), 2);
//			$order->total_paid = (string)$order->total_paid_tax_incl;
            $order->calctulate_totals();
            $ct = true;

			$res &= $order->update();
		}

		
        if(!$od) {
		  // update taxes
		  $res &= $order_detail->updateTaxAmount($order);
	
		  // Save order detail
		  $res &= $order_detail->update();            
        }

        if(!$ct){
            $order->calctulate_totals();

            $res &= $order->update();            
        }
		// Save order invoice
		if (isset($order_invoice)) {
            $order_invoice->calculate_totals();
            $res &= $order_invoice->update();		  
		}

		// Update product available quantity
		StockAvailable::updateQuantity($order_detail->product_id, $order_detail->product_attribute_id, ($old_quantity - $order_detail->product_quantity), $order->id_shop);

		$products = $this->getProducts($order);
		// Get the last product
		$product = $products[$order_detail->id];
		$resume = OrderSlip::getProductSlipResume($order_detail->id);
		$product['quantity_refundable'] = $product['product_quantity'] - $resume['product_quantity'];
		$product['amount_refundable'] = $product['total_price_tax_incl'] - $resume['amount_tax_incl'];
		$product['amount_refund'] = Tools::displayPrice($resume['amount_tax_incl']);

		// Get invoices collection
		$invoice_collection = $order->getInvoicesCollection();

		$invoice_array = array();
		foreach ($invoice_collection as $invoice)
		{
			$invoice->name = $invoice->getInvoiceNumberFormatted(Context::getContext()->language->id);
			$invoice_array[] = $invoice;
		}

		// Assign to smarty informations in order to show the new product line
		$this->context->smarty->assign(array(
			'product' => $product,
			'order' => $order,
			'currency' => new Currency($order->id_currency),
			'can_edit' => $this->tabAccess['edit'],
			'invoices_collection' => $invoice_collection,
			'current_id_lang' => Context::getContext()->language->id,
			'link' => Context::getContext()->link,
			'current_index' => self::$currentIndex
		));

		if (!$res)
			die(Tools::jsonEncode(array(
				'result' => $res,
				'error' => Tools::displayError('Error occurred while editing this product line')
			)));


		if (is_array(Tools::getValue('product_quantity')))
			$view = $this->createTemplate('_customized_data.tpl')->fetch();
		else
			$view = $this->createTemplate('_product_line.tpl')->fetch();
			
		$this->sendChangedNotification($order);

		die(Tools::jsonEncode(array(
			'result' => $res,
			'view' => $view,
			'can_edit' => $this->tabAccess['add'],
			'invoices_collection' => $invoice_collection,
			'order' => $order,
			'invoices' => $invoice_array,
			'documents_html' => $this->createTemplate('_documents.tpl')->fetch(),
			'shipping_html' => $this->createTemplate('_shipping.tpl')->fetch(),
			'customized_product' => is_array(Tools::getValue('product_quantity'))
		)));
	}

	public function ajaxProcessDeleteProductLine()
	{
		$res = true;

		$order_detail = new OrderDetail(Tools::getValue('id_order_detail'));
		$order = new Order(Tools::getValue('id_order'));
//		$cart = new Cart($order->id_cart);
		$total_method = Cart::BOTH_WITHOUT_SHIPPING;

		$this->doDeleteProductLineValidation($order_detail, $order);

        $order->mydeleteProduct($order_detail, $order_detail->product_quantity);

		$res &= $order_detail->delete();

        $order->calctulate_totals();

		$res &= $order->update();

		// Update OrderInvoice of this OrderDetail
		if ($order_detail->id_order_invoice != 0)
		{
            $total_method = Cart::BOTH;
		  
			$order_invoice = new OrderInvoice($order_detail->id_order_invoice);

            $order_invoice->calculate_totals();
            
			$res &= $order_invoice->update();            
		}

		if (!$res)
			die(Tools::jsonEncode(array(
				'result' => $res,
				'error' => Tools::displayError('Error occurred on deletion of this product line')
			)));

		// Get invoices collection
		$invoice_collection = $order->getInvoicesCollection();

		$invoice_array = array();
		foreach ($invoice_collection as $invoice)
		{
			$invoice->name = $invoice->getInvoiceNumberFormatted(Context::getContext()->language->id);
			$invoice_array[] = $invoice;
		}

		// Assign to smarty informations in order to show the new product line
		$this->context->smarty->assign(array(
			'order' => $order,
			'currency' => new Currency($order->id_currency),
			'invoices_collection' => $invoice_collection,
			'current_id_lang' => Context::getContext()->language->id,
			'link' => Context::getContext()->link,
			'current_index' => self::$currentIndex
		));
		
		$this->sendChangedNotification($order);

		die(Tools::jsonEncode(array(
			'result' => $res,
			'order' => $order,
			'invoices' => $invoice_array,
			'documents_html' => $this->createTemplate('_documents.tpl')->fetch(),
			'shipping_html' => $this->createTemplate('_shipping.tpl')->fetch()
		)));
	}


}


