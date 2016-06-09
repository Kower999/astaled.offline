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
                                
		$this->addRowAction('delete');
            

		$this->fields_list = array(
		'id_stock_update' => array(
			'title' => $this->l('ID'),
			'align' => 'center',
            'filter_type' => 'int',            
			'width' => 25
		),
        'id_employee' => array(
                'title' => $this->l('ID OZ'),
			    'align' => 'center',
                'filter_type' => 'int',                
                'width' => 50,
            ),
        
		'cislo' => array(
			'title' => $this->l('Číslo výdajky'),
		),
		);
        $this->_where .= ' AND imported = 0 ';

	    if(!Tools::isSubmit('submitFilter')){
            $this->unsetFilter('stock_update');
        }


	}
	
}