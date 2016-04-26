<?php

class AdminController extends AdminControllerCore
{
	public function __construct()
	{
        $ret = parent::__construct();
        Context::getContext()->smarty->assign(array(
            'LAST_UPDATE_VERSION' => Configuration::get('LAST_UPDATE_VERSION'),
            'LAST_STOCK_UPDATE' => date('d. m. Y', (int)Configuration::get('LAST_STOCK_UPDATE')),
            'LAST_UPDATE_PRODUCTS_VERSION' => date('d. m. Y', (int)Configuration::get('LAST_UPDATE_PRODUCTS_VERSION')),
        ));
        return $ret;	   
    }
}

