<?php

/**
 * @author Kower / VeGaSolutions - http://www.vegasolutions.sk
 * @copyright 2015
 */

include_once dirname(__FILE__).'/../abstract/DataController.php';

class Statistika1Controller extends DataController
{
    public $_tmpTableSelect;
    
	public function __construct()
	{
         $this->table = 'order_detail';
         $this->className = 'Statistika1';
  
         $this->bulk_actions = null;
         $this->lang = false;
         $this->context = Context::getContext();   
         $this->context->link = new Link();                 				
         $this->explSelect = false;

        parent::__construct();            
                 
		$address_categories = array();
		$categories = Db::getInstance()->executeS('SELECT id, name FROM '._DB_PREFIX_.'address_categories');

		foreach ($categories as $cat)
			$address_categories[$cat['id']] = $cat['name'];

		$manufacturers = array();
		$mans = Db::getInstance()->executeS('SELECT id_manufacturer, name FROM '._DB_PREFIX_.'manufacturer');

		foreach ($mans as $man)
			$manufacturers[$man['id_manufacturer']] = $man['name'];

		$employees = array();
		$emps = Db::getInstance()->executeS('SELECT id_employee, lastname FROM '._DB_PREFIX_.'employee');

		foreach ($emps as $emp)
			$employees[$emp['id_employee']] = $emp['lastname'];

		$cats = array();
		$catss = Db::getInstance()->executeS('SELECT c.id_category, cl.name FROM '._DB_PREFIX_.'category AS c LEFT JOIN '._DB_PREFIX_.'category_lang cl ON c.id_category = cl.id_category WHERE cl.id_lang = 7 AND c.id_parent = 2');

		foreach ($catss as $cat)
			$cats[$cat['id_category']] = $cat['name'];

		$subcats = array();
        $selected_main_cat = (int)Tools::getValue('order_detailFilter_cat!id_category');
		$catss = Db::getInstance()->executeS('SELECT c.id_category, cl.name FROM '._DB_PREFIX_.'category AS c LEFT JOIN '._DB_PREFIX_.'category_lang cl ON c.id_category = cl.id_category WHERE cl.id_lang = 7 AND c.id_parent > 2 '.(($selected_main_cat) ? ' AND c.id_parent = '.$selected_main_cat : ''));

		foreach ($catss as $cat)
			$subcats[$cat['id_category']] = $cat['name'];

          
        $this->fields_list = array(
            'invoice_number' => array(
                'title' => $this->l('Faktúra'),
			    'orderby' => false,
                'width' => 50,
			    'filter_key' => 'o!invoice_number',
                'filter_type' => 'int'
            ),
            'date_add' => array(
                'title' => $this->l('Dátum'),
			    'orderby' => false,
                'width' => 130,
			    'align' => 'right',
			    'type' => 'datetime',
			    'filter_key' => 'o!date_add'
            ),
		    'category' => array(
			     'title' => $this->l('Kategória'),
			     'orderby' => false,
			     'width' => 100,
			     'type' => 'select',
			     'list' => $cats,
			     'filter_key' => 'cat!id_category',
			     'filter_type' => 'int'
		    ),
		    'sub_category' => array(
			     'title' => $this->l('Podkategória'),
			     'orderby' => false,
			     'width' => 100,
			     'type' => 'select',
			     'list' => $subcats,
			     'filter_key' => 'scat!id_category',
			     'filter_type' => 'int'
		    ),
		    'product_ean13' => array(
			    'orderby' => false,
			    'title' => $this->l('EAN'),
			    'width' => 50,
			    'filter_key' => 'a!product_ean13'
		    ),
		    'product_name' => array(
			    'orderby' => false,
			    'title' => $this->l('Názov produktu'),
			    'width' => 'auto'
		    ),
		    'manufacturer' => array(
			     'orderby' => false,
			     'title' => $this->l('Výrobca'),
			     'width' => 100,
			     'type' => 'select',
			     'list' => $manufacturers,
			     'filter_key' => 'm!id_manufacturer',
			     'filter_type' => 'int'
		    ),
            'unit_price_tax_excl' => array(
			    'orderby' => false,
                'title' => $this->l('Jedn. cena (bez DPH)'),
                'align' => 'right',
			    'type' => 'price',                
                'width' => 50,
                'filter_type' => 'decimal'
//				'filter_key' => 'a!cena_2',
            ),
            'product_quantity' => array(
			    'orderby' => false,
                'title' => $this->l('Množstvo'),
                'align' => 'center',
                'width' => 25,
                'filter_type' => 'int'
            ),
            'total_price_tax_excl' => array(
			    'orderby' => false,
                'title' => $this->l('Cena (bez DPH)'),
                'align' => 'right',
			    'type' => 'price',                
                'width' => 50,
                'filter_type' => 'decimal'
//				'filter_key' => 'a!cena_2',
            ),
		    'id_address_category' => array(
			     'orderby' => false,
			     'title' => $this->l('Kategória zákazníka'),
			     'width' => 150,
			     'type' => 'select',
			     'list' => $address_categories,
			     'filter_key' => 'ac!id_address_category',
			     'filter_type' => 'int'
            ),
		    'company' => array(
			    'orderby' => false,
			    'title' => $this->l('Firma'),
			    'width' => 50,
			    'filter_key' => 'ad!company',
                'ajax_company_search' => true,
		    ),
		    'city' => array(
			    'orderby' => false,
			    'title' => $this->l('Mesto'),
			    'width' => 50,
			    'filter_key' => 'ad!city',
		    ),
		    'postcode' => array(
			    'orderby' => false,
			    'title' => $this->l('PSČ'),
			    'filter_key' => 'ad!postcode',
			    'width' => 50
		    ),
		    'address1' => array(
			    'orderby' => false,
			    'title' => $this->l('Ulica'),
			    'filter_key' => 'ad!address1',                
			    'width' => 50
		    ),
		    'customer' => array(
			    'title' => $this->l('Zákazník'),
			    'orderby' => false,
			    'search' => false,                
			    'width' => 'auto'
		    ),
		    'dni' => array(
			    'orderby' => false,
			    'title' => $this->l('IČO'),
			    'filter_key' => 'ai!dni',
			    'width' => 50
		    ),
		    'phone_mobile' => array(
			    'orderby' => false,
			    'title' => $this->l('Tel. č.'),
			    'filter_key' => 'ai!phone_mobile',
			    'width' => 50
		    ),
		    'email' => array( // customer
			    'orderby' => false,
			    'title' => $this->l('Email'),
			    'filter_key' => 'c!email',
			    'width' => 50
		    ),
		    'employee' => array( // last name
			     'orderby' => false,
			     'title' => $this->l('OZ'),
			     'width' => 100,
			     'type' => 'select',
			     'list' => $employees,
			     'filter_key' => 'c!id_employee',
			     'filter_type' => 'int'
		    ),
        );


        $this->resetquery();    
                
        $this->_defaultOrderBy = 'scat.level_depth';
        $this->_defaultOrderWay = 'DESC';

        $this->_tmpTableFilter = ' GROUP BY id_order_detail';

        $this->_select = 'a.`id_order_detail`, a.`id_order`, a.`product_id`, a.`product_ean13`, a.`product_name`, m.`name`, a.`unit_price_tax_excl`, a.`product_quantity`, a.`total_price_tax_excl`,  catl.name AS category, IF(scat.`id_category` > 2,  scatl.name, "-") AS sub_category,o.invoice_number, m.name AS manufacturer, o.date_add, acs.name AS id_address_category, ad.company, ad.city, ad.postcode, ad.address1, CONCAT_WS( " ", ai.company, ",", ai.`lastname`,ai.`firstname`, ",", ai.`address1`, ",", ai.`postcode`, ai.`city`,"(IČO:", ai.`dni`,")") AS customer, ai.dni, ai.phone_mobile, c.email, e.lastname AS employee';
        
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'orders` o ON (o.`id_order` = a.`id_order`) ';
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'product` p ON (p.`id_product` = a.`product_id`) ';
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'manufacturer` m ON (m.`id_manufacturer` = p.`id_manufacturer`) ';
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'customer` c ON (c.`id_customer` = o.`id_customer`) ';
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'address` ad ON (ad.`id_address` = o.`id_address_delivery`) ';
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'address` ai ON (ai.`id_address` = o.`id_address_invoice`) ';
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'address_category` ac ON (ac.`id_address` = o.`id_address_delivery`) ';        
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'address_categories` acs ON (acs.`id` = ac.`id_address_category`) ';        
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'employee` e ON (e.`id_employee` = c.`id_employee`) ';
        
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'category_product` cp2 ON (cp2.`id_product` = p.`id_product`) ';
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'category` scat ON (scat.`id_category` = cp2.`id_category` ) ';        
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'category_lang` scatl ON (scatl.`id_category` = scat.`id_category` AND scatl.`id_lang` = 7) ';  

		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'category` cat ON (cat.`id_category` = scat.`id_parent`)';        
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'category_lang` catl ON (catl.`id_category` = cat.`id_category` AND catl.`id_lang` = 7) ';        
        
	    if(!Tools::isSubmit('submitResetorder_detail') && Tools::isSubmit('submitFilterorder_detail')){
            $this->processFilter2('order_detail');
        } else {
            $this->unsetFilter('order_detail');
//            $this->_where .= ' AND o.`date_add` >= (LAST_DAY(CURDATE()) - INTERVAL 1 MONTH + INTERVAL 1 DAY )';
//        $this->_defaultOrderBy = 'scat.level_depth';
//        $this->_defaultOrderWay = 'DESC';
        }
//var_dump($this->_filter);
        $filter = '';
        if(!empty($this->_filter)){
            $filter = '&filter='.urlencode($this->_filter);
        }

		$this->toolbar_btn['export'] = array(
			'href' => $this->context->link->getAdminLink('Statistika1', true).'&export=1'.$filter,
			'desc' => $this->l('Export')
		);

	}
       
	public function initContent()
	{
        
        $this->content .= $this->renderList();

		$this->context->smarty->assign(array(
			'content' => $this->content,
		));
        
	}
        
	public function renderList()
	{
		if (!($this->fields_list && is_array($this->fields_list)))
			return false;
	    if(Tools::isSubmit('submitResetorder_detail') || !Tools::isSubmit('submitFilterorder_detail')){
	       $this->_list = array();
        } else {
		   $this->getList($this->context->language->id,'');            
        }
        
Tools::fd($this->_listsql);

		// Empty list is ok
		if (!is_array($this->_list))
			return false;

		$helper = new HelperList();

		$this->setHelperDisplay($helper);
		$helper->tpl_vars = $this->tpl_list_vars;
		$helper->tpl_delete_link_vars = $this->tpl_delete_link_vars;

		// For compatibility reasons, we have to check standard actions in class attributes
		foreach ($this->actions_available as $action)
		{
			if (!in_array($action, $this->actions) && isset($this->$action) && $this->$action)
				$this->actions[] = $action;
		}

//        $helper->tpl_folder = 'statistika1';
        $helper->override_folder = 'statistika1/';
        $helper->module = $this->module;
        $helper->toolbar_btn = $this->toolbar_btn;
        
//        var_dump($this->_list[0]);
        $total2 = 0;
        $total = 0;
        if(!empty($this->_list) && is_array($this->_list))
            foreach($this->_list as $row){
                $total2 += (float)$row['product_quantity'];
                $total += (float)$row['total_price_tax_excl'];
            }

$back1 = $this->_list;
$back2 = $this->fields_list; 

/* ------------------------------------------ */

        $this->resetquery();    
                
        $this->_defaultOrderBy = 'scat.level_depth';
        $this->_defaultOrderWay = 'DESC';

        $this->_tmpTableFilter = ' GROUP BY id_order_detail';

        $this->_select = 'a.`id_order_detail`, a.`product_quantity`, a.`total_price_tax_excl`';
//unset($this->_select);
//         $this->explSelect = true;
        
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'orders` o ON (o.`id_order` = a.`id_order` ) ';
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'product` p ON (p.`id_product` = a.`product_id` ) ';
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'manufacturer` m ON (m.`id_manufacturer` = p.`id_manufacturer`) ';
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'customer` c ON (c.`id_customer` = o.`id_customer`) ';
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'address` ad ON (ad.`id_address` = o.`id_address_delivery` ) ';
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'address` ai ON (ai.`id_address` = o.`id_address_invoice` ) ';
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'address_category` ac ON (ac.`id_address` = o.`id_address_delivery` ) ';        
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'address_categories` acs ON (acs.`id` = ac.`id_address_category` ) ';        
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'employee` e ON (e.`id_employee` = c.`id_employee` ) ';
        
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'category_product` cp2 ON (cp2.`id_product` = p.`id_product`) ';
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'category` scat ON (scat.`id_category` = cp2.`id_category` ) ';        
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'category_lang` scatl ON (scatl.`id_category` = scat.`id_category` AND scatl.`id_lang` = 7) ';  

		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'category` cat ON (cat.`id_category` = scat.`id_parent` )';        
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'category_lang` catl ON (catl.`id_category` = cat.`id_category` AND catl.`id_lang` = 7) ';        
        
	    if(!Tools::isSubmit('submitResetorder_detail') && Tools::isSubmit('submitFilterorder_detail')){
            $this->processFilter2('order_detail');
        } else {
            $this->unsetFilter('order_detail');
        }

        $this->_tmpTableSelect = ' ';



	    if(Tools::isSubmit('submitResetorder_detail') || !Tools::isSubmit('submitFilterorder_detail')){
	       $this->_list = array();
        } else {
		   $this->getList($this->context->language->id,'a.id_order_detail','ASC',0,false);
        }
        
//        var_dump($this->_list);
                    
        $total3 = 0;
        $total4 = 0;
                            
        if(!empty($this->_list) && is_array($this->_list))
            foreach($this->_list as $row){
                $total3 += (float)$row['product_quantity'];
                $total4 += (float)$row['total_price_tax_excl'];
            }
        if(!empty($this->_list) && is_array($this->_list)){                
            $this->context->smarty->assign(array(
                'total3' => $total3,
                'total4' => $total4,
            ));
                    
        }
        

/* ------------------------------------------------ */

$this->_list = $back1;
$this->fields_list = $back2; 
            
            
		$this->context->smarty->assign(array(
            'currency' => $this->context->currency,
			'total' => $total,
			'total2' => $total2,
		));
        
        
//        if ($helper->context->controller instanceof ModuleAdminController)        
//            var_dump(_PS_MODULE_DIR_.$this->module->name.'/views/templates/admin/_configure/'.'helpers/list/');
//Tools::fd($this->_listsql);
		$list = $helper->generateList($this->_list, $this->fields_list);

		return $list;
	}

	/**
	 * Get the current objects' list form the database
	 *
	 * @param integer $id_lang Language used for display
	 * @param string $order_by ORDER BY clause
	 * @param string $_orderWay Order way (ASC, DESC)
	 * @param integer $start Offset in LIMIT clause
	 * @param integer $limit Row count in LIMIT clause
	 */
	public function getList($id_lang, $order_by = null, $order_way = null, $start = 0, $limit = null, $id_lang_shop = false)
	{
		/* Manage default params values */
		$use_limit = true;
		if ($limit === false)
			$use_limit = false;
		elseif (empty($limit))
		{
			if (isset($this->context->cookie->{$this->table.'_pagination'}) && $this->context->cookie->{$this->table.'_pagination'})
				$limit = $this->context->cookie->{$this->table.'_pagination'};
			else
				$limit = $this->_pagination[1];
		}

		if (!Validate::isTableOrIdentifier($this->table))
			throw new PrestaShopException(sprintf('Table name %s is invalid:', $this->table));

		if (empty($order_by))
		{
			if ($this->context->cookie->{$this->table.'Orderby'})
				$order_by = $this->context->cookie->{$this->table.'Orderby'};
			elseif ($this->_orderBy)
				$order_by = $this->_orderBy;
			else
				$order_by = $this->_defaultOrderBy;
		}

		if (empty($order_way))
		{
			if ($this->context->cookie->{$this->table.'Orderway'})
				$order_way = $this->context->cookie->{$this->table.'Orderway'};
			elseif ($this->_orderWay)
				$order_way = $this->_orderWay;
			else
				$order_way = $this->_defaultOrderWay;
		}

		$limit = (int)Tools::getValue('pagination', $limit);
		$this->context->cookie->{$this->table.'_pagination'} = $limit;

		/* Check params validity */
//        var_dump($order_by);
//        var_dump($order_way);
//        var_dump($start);
//        var_dump($limit);
//        var_dump($id_lang);
		if (!Validate::isOrderBy($order_by) || !Validate::isOrderWay($order_way)
			|| !is_numeric($start) || !is_numeric($limit)
			|| !Validate::isUnsignedId($id_lang))
			throw new PrestaShopException('get list params is not valid');

		/* Determine offset from current page */
		if ((isset($_POST['submitFilter'.$this->table]) ||
		isset($_POST['submitFilter'.$this->table.'_x']) ||
		isset($_POST['submitFilter'.$this->table.'_y'])) &&
		!empty($_POST['submitFilter'.$this->table]) &&
		is_numeric($_POST['submitFilter'.$this->table]))
			$start = ((int)$_POST['submitFilter'.$this->table] - 1) * $limit;

		/* Cache */
		$this->_lang = (int)$id_lang;
		$this->_orderBy = (strpos($order_by, '.') !== false) ? substr($order_by, strpos($order_by, '.') + 1) : $order_by;
		$this->_orderWay = Tools::strtoupper($order_way);

		/* SQL table : orders, but class name is Order */
		$sql_table = $this->table == 'order' ? 'orders' : $this->table;

		// Add SQL shop restriction
		$select_shop = $join_shop = $where_shop = '';
		if ($this->shopLinkType)
		{
			$select_shop = ', shop.name as shop_name ';
			$join_shop = ' LEFT JOIN '._DB_PREFIX_.$this->shopLinkType.' shop
							ON a.id_'.$this->shopLinkType.' = shop.id_'.$this->shopLinkType;
			$where_shop = Shop::addSqlRestriction($this->shopShareDatas, 'a', $this->shopLinkType);
		}

		if ($this->multishop_context && Shop::isTableAssociated($this->table) && !empty($this->className))
		{
			if (Shop::getContext() != Shop::CONTEXT_ALL || !$this->context->employee->isSuperAdmin())
			{
				$test_join = !preg_match('#`?'.preg_quote(_DB_PREFIX_.$this->table.'_shop').'`? *sa#', $this->_join);
				if (Shop::isFeatureActive() && $test_join && Shop::isTableAssociated($this->table))
				{
					$this->_where .= ' AND a.'.$this->identifier.' IN (
						SELECT sa.'.$this->identifier.'
						FROM `'._DB_PREFIX_.$this->table.'_shop` sa
						WHERE sa.id_shop IN ('.implode(', ', Shop::getContextListShopID()).')
					)';
				}
			}
		}

		/* Query in order to get results with all fields */
		$lang_join = '';
		if ($this->lang)
		{
			$lang_join = 'LEFT JOIN `'._DB_PREFIX_.$this->table.'_lang` b ON (b.`'.$this->identifier.'` = a.`'.$this->identifier.'` AND b.`id_lang` = '.(int)$id_lang;
			if ($id_lang_shop)
			{
				if (!Shop::isFeatureActive())
					$lang_join .= ' AND b.`id_shop` = 1';
				elseif (Shop::getContext() == Shop::CONTEXT_SHOP)
					$lang_join .= ' AND b.`id_shop` = '.(int)$id_lang_shop;
				else
					$lang_join .= ' AND b.`id_shop` = a.id_shop_default';
			}
			$lang_join .= ')';
		}

		$having_clause = '';
		if (isset($this->_filterHaving) || isset($this->_having))
		{
			$having_clause = ' HAVING ';
			if (isset($this->_filterHaving))
				$having_clause .= ltrim($this->_filterHaving, ' AND ');
			if (isset($this->_having))
				$having_clause .= $this->_having.' ';
		}

		if (strpos($order_by, '.') > 0)
		{
			$order_by = explode('.', $order_by);
			$order_by = pSQL($order_by[0]).'.`'.pSQL($order_by[1]).'`';
		}

		$this->_listsql = '
		SELECT SQL_CALC_FOUND_ROWS
		'.($this->_tmpTableFilter ? ' * ' . $this->_tmpTableSelect . ' FROM (SELECT ' : '');
		
		if ($this->explicitSelect)
		{
			foreach ($this->fields_list as $key => $array_value)
			{
				// Add it only if it is not already in $this->_select
				if (isset($this->_select) && preg_match('/[\s]`?'.preg_quote($key, '/').'`?\s*,/', $this->_select))
					continue;
			
				if (isset($array_value['filter_key']))
					$this->_listsql .= str_replace('!', '.', $array_value['filter_key']).' as '.$key.',';
				elseif ($key == 'id_'.$this->table)
					$this->_listsql .= 'a.`'.bqSQL($key).'`,';
				elseif ($key != 'image' && !preg_match('/'.preg_quote($key, '/').'/i', $this->_select))
					$this->_listsql .= '`'.bqSQL($key).'`,';
			}
			$this->_listsql = rtrim($this->_listsql, ',');
		}
		else
			$this->_listsql .= ($this->lang ? 'b.*,' : '').($this->explSelect ? ' a.*' : '');
		
		$this->_listsql .= '
		'.(isset($this->_select) ? ($this->explSelect ? ', ' : '').$this->_select : '').$select_shop.'
		FROM `'._DB_PREFIX_.$sql_table.'` a
		'.$lang_join.'
		'.(isset($this->_join) ? $this->_join.' ' : '').'
		'.$join_shop.'
		WHERE 1 '.(isset($this->_where) ? $this->_where.' ' : '').($this->deleted ? 'AND a.`deleted` = 0 ' : '').
		(isset($this->_filter) ? $this->_filter : '').$where_shop.'
		'.(isset($this->_group) ? $this->_group.' ' : '').'
		'.$having_clause.'
		ORDER BY '.(($order_by == $this->identifier) ? 'a.' : '').pSQL($order_by).' '.pSQL($order_way).
		($this->_tmpTableFilter ? ') tmpTable WHERE 1'.$this->_tmpTableFilter : '').
		(($use_limit === true) ? ' LIMIT '.(int)$start.','.(int)$limit : '');

//        Tools::fd($this->_listsql);
		$this->_list = Db::getInstance()->executeS($this->_listsql);
		$this->_listTotal = Db::getInstance()->getValue('SELECT FOUND_ROWS() AS `'._DB_PREFIX_.$this->table.'`');
	}
    
    
	public function postProcess() {
        if(Tools::isSubmit('export')){
            $filter = Tools::getValue('filter');
            if(!empty($filter))
//                $this->_filter = urldecode($filter); 
                $filter = urldecode($filter); 
//      		$this->getList($this->context->language->id);

        $rows = Db::getInstance()->executeS('SELECT SQL_CALC_FOUND_ROWS
         *  FROM (SELECT  a.`id_order_detail`, a.`id_order`, a.`product_id`, a.`product_ean13`, a.`product_name`, m.`name`, a.`unit_price_tax_excl`, a.`product_quantity`, a.`total_price_tax_excl` 
        , catl.name AS category, IF(scat.`id_category` > 2,  scatl.name, "-") AS sub_category,o.invoice_number, m.name AS manufacturer, o.date_add, acs.name AS id_address_category, ad.company, ad.city, ad.postcode, ad.address1, CONCAT_WS( " ", ai.company, ",", ai.`lastname`,ai.`firstname`, ",", ai.`address1`, ",", ai.`postcode`, ai.`city`,"(IČO:", ai.`dni`,")") AS customer, ai.dni, ai.phone_mobile, c.email, e.lastname AS employee
        FROM `new_order_detail` a
        LEFT JOIN `new_orders` o ON (o.`id_order` = a.`id_order`) LEFT JOIN `new_product` p ON (p.`id_product` = a.`product_id`) LEFT JOIN `new_manufacturer` m ON (m.`id_manufacturer` = p.`id_manufacturer`) LEFT JOIN `new_customer` c ON (c.`id_customer` = o.`id_customer`) LEFT JOIN `new_address` ad ON (ad.`id_address` = o.`id_address_delivery`) LEFT JOIN `new_address` ai ON (ai.`id_address` = o.`id_address_invoice`) LEFT JOIN `new_address_category` ac ON (ac.`id_address` = o.`id_address_delivery`) LEFT JOIN `new_address_categories` acs ON (acs.`id` = ac.`id_address_category`) LEFT JOIN `new_employee` e ON (e.`id_employee` = c.`id_employee`) LEFT JOIN `new_category_product` cp2 ON (cp2.`id_product` = p.`id_product`) LEFT JOIN `new_category` scat ON (scat.`id_category` = cp2.`id_category` ) LEFT JOIN `new_category_lang` scatl ON (scatl.`id_category` = scat.`id_category` AND scatl.`id_lang` = 7) LEFT JOIN `new_category` cat ON (cat.`id_category` = scat.`id_parent`)LEFT JOIN `new_category_lang` catl ON (catl.`id_category` = cat.`id_category` AND catl.`id_lang` = 7)  
        WHERE 1  '.$filter.' 
        ORDER BY scat.`level_depth` DESC) tmpTable WHERE 1 GROUP BY id_order_detail');
        
            
            if(!empty($rows)){             
                $subor = _PS_DOWNLOAD_DIR_.'energizer.csv';
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
    }

	public function displayAjaxSearchCompany()
	{
	    $str = Tools::getValue('q');
        $list = array();
        if(strlen($str) > 2){
            $list = Db::getInstance()->executeS('SELECT company FROM `'._DB_PREFIX_.'address` WHERE company LIKE "%'.$str.'%"');
            
        }
		echo Tools::jsonEncode(array('found' => $list ));
	}
    
            
}
