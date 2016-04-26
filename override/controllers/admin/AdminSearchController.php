<?php

class AdminSearchController extends AdminSearchControllerCore
{
	protected function initProductList()
	{
        if (Context::getContext()->employee->isLoggedBack() && (Context::getContext()->employee->id_profile != 5) ) {                            	   
		  $this->show_toolbar = false;
		  $this->fields_list['products'] = array(
			'id_product' => array('title' => $this->l('ID'), 'width' => 25),
			'manufacturer_name' => array('title' => $this->l('Manufacturer'), 'align' => 'center', 'width' => 200),
			'ean13' => array('title' => $this->l('EAN'), 'width' => 150),
			'reference' => array('title' => $this->l('Reference'), 'align' => 'center', 'width' => 150),
			'name' => array('title' => $this->l('Name'), 'width' => 'auto'),
			'wholesale_price' => array('title' => $this->l('Nákupná cena'), 'align' => 'right', 'type' => 'price', 'width' => 60),
			'price_tax_excl' => array('title' => $this->l('Price (tax excl.)'), 'align' => 'right', 'type' => 'price', 'width' => 60),
			'price_tax_incl' => array('title' => $this->l('Price (tax incl.)'), 'align' => 'right', 'type' => 'price', 'width' => 60),
			'cena_2' => array('title' => $this->l('Cena 2'), 'align' => 'right', 'type' => 'price', 'width' => 60),
			'active' => array('title' => $this->l('Active'), 'width' => 70, 'active' => 'status', 'align' => 'center', 'type' => 'bool')
		  );
        }
	}

}

