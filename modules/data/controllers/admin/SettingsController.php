<?php
include_once dirname(__FILE__).'/../abstract/DataController.php';

class SettingsController extends DataController
{        
	public function __construct()
	{
		$this->display = '';
        $this->className = 'Settings';

		// Options list
		$this->fields_options = array(
			'general' => array(
				'title' =>	$this->l('Zobrazovanie provízie'),
                'image' => _PS_ADMIN_IMG_.'../t/AdminTools.gif',                
                'fields' => array(
                    'PS_NEW_ORDER_SHOW_PROVISIONS' => array(
                        'title' => $this->l('Pri vytáraní objednávky'),              
                        'cast' => 'boolval',
                        'type' => 'bool'
                    ),
                ),
			    'submit' => array(
				    'title' => $this->l('Uložiť'),
				    'class' => 'button',
				    'style' => 'display: block'
			    )                                
			),
			'general2' => array(
				'title' =>	$this->l('Zobrazovanie položiek v zozname produktov pri vytváraní objednávky'),
                'image' => _PS_ADMIN_IMG_.'../t/AdminTools.gif',                
                'fields' => array(
                    'PS_NEW_ORDER_SHOW_EAN' => array( 
                        'title' => $this->l('EAN'), 
                        'cast' => 'boolval',
                        'type' => 'bool'
                    ),
                    'PS_NEW_ORDER_SHOW_PRICE' => array( 
                        'title' => $this->l('Cena'), 
                        'cast' => 'boolval',
                        'type' => 'bool'
                    ),
                    'PS_NEW_ORDER_SHOW_QTY' => array( 
                        'title' => $this->l('Množstvo skladom'), 
                        'cast' => 'boolval',
                        'type' => 'bool'
                    ),
                    'PS_NEW_ORDER_SHOW_QTY2ADD' => array( 
                        'title' => $this->l('Množstvo na pridanie'), 
                        'cast' => 'boolval',
                        'type' => 'bool'
                    ),
                ),
			),
		);

		parent::__construct();

        if (Context::getContext()->employee->isLoggedBack()) {                            
            if ($this->module->active){
                $this->module->installDatabase();
                $this->module->createMenu();
                $this->module->setMenuAccess();
            }
        }            
	}
    
    
}