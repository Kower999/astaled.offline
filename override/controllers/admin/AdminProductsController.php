<?php

class AdminProductsController extends AdminProductsControllerCore
{
	public function __construct()
	{
		$this->table = 'product';
		$this->className = 'Product';
		$this->lang = true;
		$this->explicitSelect = true;
		$this->bulk_actions = array('delete' => array('text' => $this->l('Delete selected'), 'confirm' => $this->l('Delete selected items?')));

		if (!Tools::getValue('id_product'))
			$this->multishop_context_group = false;

		parent::__construct();
        
		$this->_select .= ', a.on_sale';

//        $this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'product_provisions` pp ON (a.`id_product` = pp.`id_product` )';
//		$this->_select .= ', pp.cena_2, pp.provizia';

        
		$this->fields_list['ean13'] = array(
			'title' => $this->l('EAN'),
			'align' => 'left',
			'width' => 100
		);


        if (Context::getContext()->employee->isLoggedBack() && 
            ((Context::getContext()->employee->id_profile == 5) || 
             (Context::getContext()->employee->id_profile == 6) )) {
      		unset($this->fields_list['wholesale_price']);
//            unset($this->fields_list['sav_quantity']);
            unset($this->fields_list['active']);

		  $this->fields_list['price'] = array(
			'title' => $this->l('Odporúčaná cena (bez DPH)'),
			'width' => 90,
			'type' => 'price',
			'align' => 'right',
			'filter_key' => 'a!price'
		  );
            
        } else {
		  $this->fields_list['wholesale_price'] = array(
			'title' => $this->l('Nákupná cena'),
			'width' => 90,
			'type' => 'price',
			'align' => 'right',
			'filter_key' => 'a!wholesale_price'
		  );    
            
        }        
	}

	public function initContent($token = null)
	{
//	   var_dump($this->tabAccess);
//	  if (($this->display == 'edit' && $this->tabAccess['edit'] == '1') || ($this->display == 'add' && $this->tabAccess['edit'] == '1'))
//      {
            
		if (($this->display == 'edit') || ($this->display == 'add'))
		{
		  
		    if($this->tabAccess[$this->display] == '1') {
		      
			$this->fields_form = array();
			// Check if Module
			if (substr($this->tab_display, 0, 6) == 'Module')
			{
				$this->tab_display_module = strtolower(substr($this->tab_display, 6, Tools::strlen($this->tab_display) - 6));
				$this->tab_display = 'Modules';
			}
			if (method_exists($this, 'initForm'.$this->tab_display))
				$this->tpl_form = strtolower($this->tab_display).'.tpl';

			if ($this->ajax)
				$this->content_only = true;
			else
			{
				$product_tabs = array();

				// tab_display defines which tab to display first
				if (!method_exists($this, 'initForm'.$this->tab_display))
					$this->tab_display = $this->default_tab;

				$advanced_stock_management_active = Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT');
				$stock_management_active = Configuration::get('PS_STOCK_MANAGEMENT');

				foreach ($this->available_tabs as $product_tab => $value)
				{
					// if it's the quantities tab and stock management is disabled, continue
					if ($stock_management_active == 0 && $product_tab == 'Quantities')
						continue;

					// if it's the warehouses tab and advanced stock management is disabled, continue
					if ($advanced_stock_management_active == 0 && $product_tab == 'Warehouses')
						continue;

					$product_tabs[$product_tab] = array(
						'id' => $product_tab,
						'selected' => (strtolower($product_tab) == strtolower($this->tab_display) || (isset($this->tab_display_module) && 'module'.$this->tab_display_module == Tools::strtolower($product_tab))),
						'name' => $this->available_tabs_lang[$product_tab],
						'href' => $this->context->link->getAdminLink('AdminProducts').'&amp;id_product='.(int)Tools::getValue('id_product').'&amp;action='.$product_tab,
					);
				}
				$this->tpl_form_vars['product_tabs'] = $product_tabs;
			}
            
            } else {
                Tools::redirectAdmin(self::$currentIndex.'&token='.$this->token);                        
            }
		}
		else
		{
			if ($id_category = (int)Tools::getValue('id_category'))
				self::$currentIndex .= '&id_category='.(int)$id_category;

			// If products from all categories are displayed, we don't want to use sorting by position
			if (!$id_category)
			{
				$this->_defaultOrderBy = $this->identifier;
				if ($this->context->cookie->{$this->table.'Orderby'} == 'position')
				{
					unset($this->context->cookie->{$this->table.'Orderby'});
					unset($this->context->cookie->{$this->table.'Orderway'});
				}
			}
			$id_category = (int)Tools::getValue('id_category', 1);
			$this->tpl_list_vars['is_category_filter'] = Tools::getValue('id_category') ? true : false;

			// Generate category selection tree
			$helper = new Helper();
			$this->tpl_list_vars['category_tree'] = $helper->renderCategoryTree(null, array((int)$id_category), 'categoryBox', true, false, array(), false, true);

			// used to build the new url when changing category
			$this->tpl_list_vars['base_url'] = preg_replace('#&id_category=[0-9]*#', '', self::$currentIndex).'&token='.$this->token;
		}
		// @todo module free
		$this->tpl_form_vars['vat_number'] = file_exists(_PS_MODULE_DIR_.'vatnumber/ajax.php');

		parent::initContent();
        
//      } else {
//        Tools::redirectAdmin(self::$currentIndex.'&token='.$this->token);        
//      }        
	}

	protected function copyFromPost(&$object, $table)
	{
		parent::copyFromPost($object, $table);
		if (get_class($object) != 'Product')
			return;

		$_POST['cena_2'] = empty($_POST['cena_2']) ? '0' : str_replace(',', '.', $_POST['cena_2']);
		$_POST['provizia'] = empty($_POST['provizia']) ? '0' : str_replace(',', '.', $_POST['provizia']);
		$_POST['ecotax2'] = empty($_POST['ecotax2']) ? '0' : str_replace(',', '.', $_POST['ecotax2']);

		$object->cena_2 = (float)Tools::getValue('cena_2');
		$object->provizia = (float)Tools::getValue('provizia');
		$object->ecotax2 = (float)Tools::getValue('ecotax2');
//        var_dump($object);
	}

}

