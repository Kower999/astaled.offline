<?php

class AdminCartsController extends AdminCartsControllerCore
{
	public function __construct()
	{        
		parent::__construct();

		$this->_select = 'CONCAT(LEFT(c.`firstname`, 1), \'. \', c.`lastname`) `customer`, c.`company`, a.id_cart total, ca.name carrier, o.id_order, IF(co.id_guest, 1, 0) id_guest';
		$this->_join = 'LEFT JOIN '._DB_PREFIX_.'customer c ON (c.id_customer = a.id_customer)
		LEFT JOIN '._DB_PREFIX_.'currency cu ON (cu.id_currency = a.id_currency)
		LEFT JOIN '._DB_PREFIX_.'carrier ca ON (ca.id_carrier = a.id_carrier)
		LEFT JOIN '._DB_PREFIX_.'orders o ON (o.id_cart = a.id_cart)
		LEFT JOIN `'._DB_PREFIX_.'connections` co ON (a.id_guest = co.id_guest AND TIME_TO_SEC(TIMEDIFF(NOW(), co.`date_add`)) < 1800)';

		$this->fields_list = array(
			'id_cart' => array(
				'title' => $this->l('ID'),
				'align' => 'center',
				'width' => 25
			),
			'id_order' => array(
				'title' => $this->l('Order ID'),
				'align' => 'center', 'width' => 25
			),
			'company' => array(
				'title' => $this->l('Customer'),
				'width' => 'auto',
				'filter_key' => 'c!company'
			),
			'total' => array(
				'title' => $this->l('Total'),
				'callback' => 'getOrderTotalUsingTaxCalculationMethod',
				'orderby' => false,
				'search' => false,
				'width' => 80,
				'align' => 'right',
				'prefix' => '<b>',
				'suffix' => '</b>',
			),
			'carrier' => array(
				'title' => $this->l('Carrier'),
				'width' => 50,
				'align' => 'center',
				'callback' => 'replaceZeroByShopName',
				'filter_key' => 'ca!name'
			),
			'date_add' => array(
				'title' => $this->l('Date'),
				'width' => 150,
				'align' => 'right',
				'type' => 'datetime',
				'filter_key' => 'a!date_add'
			),
			'id_guest' => array(
				'title' => $this->l('Online'),
				'width' => 40,
				'align' => 'center',
				'type' => 'bool',
				'havingFilter' => true,
				'icon' => array(0 => 'blank.gif', 1 => 'tab-customers.gif')
			)
		);
 		$this->shopLinkType = 'shop';

        foreach($this->classes as $cls){
		  $classFile = _PS_MODULE_DIR_.'data/classes/'.$cls.'.php';            
		  include_once $classFile;
        }
	}


	public function renderList()
	{
    
        if (Context::getContext()->employee->isLoggedBack() && (Context::getContext()->employee->id_profile == 5) ) {
//            var_dump($this->_join);
            $this->_where = 'AND c.`id_employee` = '.(Context::getContext()->employee->id);            
        }
   		return parent::renderList();

    }

    public $classes = array('Provisions','Imports','VIPPrices');
	
    
/*    
    public function renderView()
    {
		$this->tpl_view_vars['total_provisions'] = 'hocico';

		return parent::renderView();        
    }
/*    
   	protected function getCartSummary()
	{
        $summary = parent::getCartSummary();
        
   		$summary['total_provisions'] = str_replace(
			$currency->sign, '',
			Tools::displayPrice($summary['total_price'], $currency)
		);

        
        return $summary;
    }
*/    
}

