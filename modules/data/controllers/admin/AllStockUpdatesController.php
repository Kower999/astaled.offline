<?php
include_once dirname(__FILE__).'/../abstract/DataController.php';

class AllStockUpdateController extends DataController
{
	public function __construct()
	{
	 	$this->table = 'stock_update';
		$this->className = 'StockUpdate';
        $this->identifier = 'id_stock_update';
		
		parent::__construct();
		$this->meta_title = $this->l('Evidencia Výdajok').' - '.$this->module->displayName;
		if (!$this->module->active)
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminHome'));
                                
            
        if(ENT_XML1 != 16) {
	       define('ENT_XML1', 16);            
        }


		$this->fields_list = array(
		'id_stock_update' => array(
			'title' => $this->l('ID'),
			'align' => 'center',
			'width' => 25
		),
        'id_employee' => array(
                'title' => $this->l('ID OZ'),
                'width' => 50,
//			    'filter_key' => 'p!ean13'
            ),
        
		'cislo' => array(
			'title' => $this->l('Číslo výdajky'),
			'align' => 'center',
			'width' => 25
		),
		);


	}
	
}