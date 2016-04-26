<?php
include_once dirname(__FILE__).'/../abstract/DataController.php';

class ProvisionsController extends DataController
{
    
	public function __construct()
	{
//         $this->table = 'product_provisions';
//         $this->className = 'Provisions';
         $this->table = 'product';
         $this->className = 'Product';
  
         $this->bulk_actions = null;
         $this->bulk_actions = array(
            'actionName' => array(
                'text' => $this->l('Zvoliť označené'),
                'confirm' => $this->l('Zvoliť označené produkty pre hromadné nastavenie?')
            )
         );
                 
         $this->lang = false;

        parent::__construct();            
  
        // Building the list of records stored within the "test" table
        $this->fields_list = array(
            'id_product' => array(
                'title' => $this->l('ID'),
                'align' => 'center',
                'width' => 25,
                'filter_type' => 'int'
            ),
            'ean13' => array(
                'title' => $this->l('EAN'),
                'width' => 50,
//			    'filter_key' => 'b!name'
//			    'filter_key' => 'pl!name'
            ),
            'name' => array(
                'title' => $this->l('Názov produktu'),
                'width' => 'auto',
			    'filter_key' => 'b!name'
//			    'filter_key' => 'pl!name'
            ),
            'name_category' => array(
                'title' => $this->l('Kategória'),
                'width' => 230,
				'filter_key' => 'cl!name',
            ),                        
            'price' => array(
                'title' => $this->l('Odporúčaná cena (bez DPH)'),
                'align' => 'center',
			    'type' => 'price',                
                'width' => 50,
//				'filter_key' => '',
//                'filter_type' => 'decimal'
//				'filter_key' => 'a!cena_2',
            ),
            'cena_2' => array(
                'title' => $this->l('Hraničná cena'), // cena 2
                'align' => 'center',
			    'type' => 'price',                
                'width' => 50,
				'filter_key' => 'pp!cena_2',
                'filter_type' => 'decimal'
//				'filter_key' => 'a!cena_2',
            ),
            'provizia' => array(
                'title' => $this->l('Provízia'),
                'align' => 'center',
                'width' => 25,
                'type'  => 'decimal',
//				'filter_key' => 'a!provizia',
				'filter_key' => 'pp!provizia',
            ),
        );
        
        $alias = 'a';
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON ('.$alias.'.`id_category_default` = cl.`id_category` AND b.`id_lang` = cl.`id_lang` AND cl.id_shop = 1) ';
        $this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'product_provisions` AS pp ON a.id_product = pp.id_product '; 
		$this->_select .= 'cl.name AS `name_category` , '.$alias.'.`price`, '.$alias.'.`wholesale_price` ,  pp.cena_2, pp.provizia ';

//		$this->_join .= 'INNER JOIN `'._DB_PREFIX_.'product` p ON '.$alias.'.`id_product` = p.`id_product` ';        
//		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (p.`id_product` = pl.`id_product` AND pl.`id_lang` = 7) ';        
//		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (p.`id_category_default` = cl.`id_category` AND cl.id_shop = 1 AND cl.id_lang = 7) ';
//		$this->_select .= 'cl.name AS `name_category` , p.`price`, p.`wholesale_price` ,  a.cena_2, a.provizia ';
        
        $prds = '';
        if(Tools::isSubmit('submitBulkactionNameproduct_provisions')) {
            $prd = Tools::getValue('product_provisionsBox');
            if(!empty($prd)) $prds = implode(',',$prd);
            $_POST['PS_PROVISIONS_BULK_PRODUCTS'] = $prds;
//            Configuration::set('PS_PROVISIONS_BULK_PRODUCTS',$prds);
//            Configuration::loadConfiguration();
        }
        

        $ops['PS_PROVISIONS_BULK_PRODUCTS'] = array(
                'title' => $this->l('Produkty'),
                'desc' => $this->l('Zoznam ID produktov oddelených čiarkou. '),
                'cast' => 'strval',
                'type' => 'text',
                'size' => '30'
            );
        
        
        $ops['PS_DATA_CENA_2'] = array(
                'title' => $this->l('Cena 2'),
                'desc' => $this->l('Hraničná cena pre výpočet provízie OZ.<br/>Ak túto cenu nenastavíš použije sa automaticky základná cena produktu.'),
                'cast' => 'floatval',
                'suffix' => '€ (s DPH)',
                'type' => 'text',
                'size' => '10'
            );
        $ops['PS_DATA_PROVISION'] = array(
                'title' => $this->l('Provízia'),
                'desc' => $this->l('Provízia pre OZ po prekročení Ceny 2.'),
                'cast' => 'floatval',
                'suffix' => '%',
                'type' => 'text',
                'size' => '10'
            );
        
        
        $this->fields_options = array(
            'general' => array(
                'title' => $this->l('Hromadné nastavenie cien a provízie'),
                'fields' => $ops,
                'image' => '/modules/data/Provisions.gif',
                'submit' => array(
                    'title' => $this->l('Aplikovať'),
                    'class' => 'button'
                )
            )
        );   

		if (!$this->module->active) {
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminHome'));
        } else {
            if($this->module->installDatabase() && $this->module->createMenu())
                $this->module->setMenuAccess();
        }
     
  
	}
   
	public function initContent()
	{
        if(!Tools::isSubmit('updateproduct_provisions') || !($this->tabAccess['edit'] === '1')) {
//		$this->initToolbar();
/*
        $this->toolbar_btn['save-date'] = array(
		      'href' => 'www.google.sk',
			  'desc' => $this->l('Generate PDF file by date')
		);
*/
        $this->toolbar_btn = null;                
        $this->table = 'product';
        $this->content .= $this->renderList();
        if($this->tabAccess['edit'] === '1') {
          $this->table = 'provisions';
		  $this->content .= $this->renderOptions();
        }

		$this->context->smarty->assign(array(
			'content' => $this->content,
		));
        } else {
            $this->table = 'product_provisions';
            $this->content .= $this->renderForm();
		    $this->context->smarty->assign(array(
			     'content' => $this->content,
		    ));
//            parent::initContent();
        }
	}

    
// This method generates the list of results
    public function renderList()
    {
        // Adds an Edit button for each result
        if ($this->tabAccess['edit'] === '1') $this->addRowAction('edit');    
//        $this->toolbar_btn = null;
        $this->lang = true;

  		if (!($this->fields_list && is_array($this->fields_list)))
			return false;
            
        $orderBy = Tools::getValue('product_provisionsOrderby');
        $orderWay  = Tools::getValue('product_provisionsOrderway');
        
        if(!Validate::isOrderBy($orderBy)) $orderBy = null;
        if(!Validate::isOrderWay($orderWay)) $orderWay = null;

        $this->table = 'product_provisions';

			if (isset($this->context->cookie->{$this->table.'_pagination'}) && $this->context->cookie->{$this->table.'_pagination'})
				$limit = $this->context->cookie->{$this->table.'_pagination'};
			else
				$limit = $this->_pagination[1];

		$limit = (int)Tools::getValue('pagination', $limit);
		$this->context->cookie->{$this->table.'_pagination'} = $limit;
        
        
        $start = 0;
 		if ((isset($_POST['submitFilter'.$this->table]) ||
		isset($_POST['submitFilter'.$this->table.'_x']) ||
		isset($_POST['submitFilter'.$this->table.'_y'])) &&
		!empty($_POST['submitFilter'.$this->table]) &&
		is_numeric($_POST['submitFilter'.$this->table]))
			$start = ((int)$_POST['submitFilter'.$this->table] - 1) * $limit;

//var_dump($this->context->cookie);
	    if(!Tools::isSubmit('submitResetproduct_provisions') && Tools::isSubmit('submitFilterproduct_provisions')){
	       
            $this->processFilter();
        } else {
            $this->unsetFilter('product_provisions');
        }
//echo "<br/><br/>";
//var_dump($this->context->cookie);

        $filters = $this->context->cookie->getFamily($this->table.'Filter_');
//        var_dump($filters);            
        

        $this->table = 'product';           
            
		$this->getList($this->context->language->id,$orderBy,$orderWay,$start, $limit);

		// Empty list is ok
		if (!is_array($this->_list))
			return false;

        $this->table = 'product_provisions';

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
//var_dump($this->_listsql);
		$list = $helper->generateList($this->_list, $this->fields_list);
        $this->lang = false;

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
        $this->table = 'product_provisions';
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
		if (!Validate::isOrderBy($order_by) || !Validate::isOrderWay($order_way)
			|| !is_numeric($start) || !is_numeric($limit)
			|| !Validate::isUnsignedId($id_lang))
			throw new PrestaShopException('get list params is not valid');

		/* Determine offset from current page */
		if ((isset($_POST['submitFilter'.$this->table]) ||
		isset($_POST['submitFilter'.$this->table.'_x']) ||
		isset($_POST['submitFilter'.$this->table.'_y'])) &&
		!empty($_POST['submitFilter'.$this->table]) &&
		is_numeric($_POST['submitFilter'.$this->table])){
			$start = ((int)$_POST['submitFilter'.$this->table] - 1) * $limit;
		}

		/* Cache */
		$this->_lang = (int)$id_lang;
		$this->_orderBy = (strpos($order_by, '.') !== false) ? substr($order_by, strpos($order_by, '.') + 1) : $order_by;
		$this->_orderWay = Tools::strtoupper($order_way);

        $this->table = 'product';

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
		'.($this->_tmpTableFilter ? ' * FROM (SELECT ' : '');
		
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
			$this->_listsql .= ($this->lang ? 'b.*,' : '').' a.*';

		
		$this->_listsql .= '
		'.(isset($this->_select) ? ', '.$this->_select : '').$select_shop.'
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
        
//        var_dump($this->_listsql);

		$this->_list = Db::getInstance()->executeS($this->_listsql);
		$this->_listTotal = Db::getInstance()->getValue('SELECT FOUND_ROWS() AS `'._DB_PREFIX_.$this->table.'`');
	}
    
    
    // This method generates the Add/Edit form
    public function renderForm()
    {
        if(Tools::isSubmit('id_product')){
            $this->table = 'product_provisions';
            $this->display = 'edit';
            
            $sql = 'SELECT a.*, pl.*, pp.* FROM `'._DB_PREFIX_.'product` a 
                LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON pl.id_product = a.id_product AND id_lang = 7
                LEFT JOIN `'._DB_PREFIX_.'product_provisions` pp ON pp.id_product = a.id_product
                WHERE a.id_product = '.(int)Tools::getValue('id_product');
            $ret = Db::getInstance()->getRow($sql);
//            var_dump($ret);

        // Building the Add/Edit form
        $this->fields_form = array(
            'legend' => array(
                'title' => $this->l('Provízia produktu: '.$ret['name'])
            ),
            'input' => array(
                array(
                    'type' => 'hidden',
                    'name' => 'id_product'
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Cena 2:'),
                    'name' => 'cena_2',
                    'size' => 33,
//                    'required' => true,
                    'desc' => $this->l('Hraničná cena pre počítanie provízie OZ.<br/>Ak túto cenu nenastavíš použije sa automaticky predajná cena produktu.<br/>Nákupná cena: '.$ret['wholesale_price'].' bez DPH<br/>Predajná cena: '.$ret['price'].' bez DPH'),
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Provízia:'),
                    'name' => 'provizia',
                    'size' => 33,
//                    'required' => true,
                    'desc' => $this->l('Provízia z produktu (%)'),
                )
            ),
            'submit' => array(
                'title' => $this->l('Uložiť'),
                'class' => 'button',
            )
        );
        
            
            $this->fields_value = array(
                'cena_2' => $ret['cena_2'],
                'provizia' => $ret['provizia'],
                'id_product' => $ret['id_product']
            );            
/*
            $this->toolbar_btn['save'] = array(
		      'href' => 'www.google.sk',
			  'desc' => $this->l('Uložiť')
		    );
*/
        }
        
  
        return parent::renderForm();
    }    

	public function postProcess()
	{
	   if(Tools::isSubmit('submitAddproduct_provisions')){
	       $idp = (int)Tools::getValue('id_product');
	       $c2 = (float)Tools::getValue('cena_2');
	       $prov = (float)Tools::getValue('provizia');
           
//           $idpp = Provisions::getProvisionByIdProduct($idp);
//           $provizia = new Provisions($idp);
           $provizia = new Provisions(Provisions::getProvisionByIdProduct($idp));
           $new = false;
           if(empty($provizia->id_product)) {
                $provizia->id_product = (int)$idp;
                $new = true;    
           }

           $provizia->cena_2 = $c2;

           if(!empty($c2)) {
                $provizia->cena_2 = $c2;
           } else {
                $tmprd = new Product((int)$idp);
                $provizia->cena_2 = $tmprd->price;
           }
           $provizia->provizia = $prov;
           $provizia->update();
           if(!$new) {
                $provizia->update();   
           } else $provizia->save();
	   }
	   if(Tools::isSubmit('submitOptionsprovisions')){
	       $idps = Tools::getValue('PS_PROVISIONS_BULK_PRODUCTS');
	       $c2 = (float)Tools::getValue('PS_DATA_CENA_2');
	       $prov = (float)Tools::getValue('PS_DATA_PROVISION');
           
           if(!empty($idps)) $idpsa = explode(',',$idps);
           
           if(!empty($idpsa))
                foreach($idpsa as $prd){
                    $prv = new Provisions(Provisions::getProvisionByIdProduct($prd));
                    $new = false;
                    if(empty($prv->id_product)) {
                        $prv->id_product = (int)$prd;
                        $new = true;    
                    }
                    if(!empty($c2)) {
                        $prv->cena_2 = $c2;
                    } else {
                        $tmprd = new Product((int)$prd);
                        $prv->cena_2 = $tmprd->price;
                    }
                    if(!empty($prov)) $prv->provizia = $prov;
                    if(!$new) {
                        $ret = $prv->update();   
                    } else $prv->save();
                }           	       
       } 
       
	   if(Tools::isSubmit('submitResetproduct_provisions') || !Tools::isSubmit('submitFilterproduct_provisions')){
            $this->unsetFilter('product_provisions');            
       }
	   
    }
    
    
	/**
	 * Set the filters used for the list display
	 */
	public function processFilter()
	{
		// Filter memorization
		if (isset($_POST) && !empty($_POST) && isset($this->table))
			foreach ($_POST as $key => $value)
			{
				if (is_array($this->table))
				{
					foreach ($this->table as $table)
						if (stripos($key, $table.'Filter_') === 0 || stripos($key, 'submitFilter') === 0)
							$this->context->cookie->$key = !is_array($value) ? $value : serialize($value);
				}
				elseif (stripos($key, $this->table.'Filter_') === 0 || stripos($key, 'submitFilter') === 0)
					$this->context->cookie->$key = !is_array($value) ? $value : serialize($value);
			}

		if (isset($_GET) && !empty($_GET) && isset($this->table))
			foreach ($_GET as $key => $value)
			{
				if (is_array($this->table))
				{
					foreach ($this->table as $table)
						if (stripos($key, $table.'OrderBy') === 0 || stripos($key, $table.'Orderway') === 0)
							$this->context->cookie->$key = $value;
				}
				elseif (stripos($key, $this->table.'OrderBy') === 0 || stripos($key, $this->table.'Orderway') === 0)
					$this->context->cookie->$key = $value;
			}
			
		$filters = $this->context->cookie->getFamily($this->table.'Filter_');

		foreach ($filters as $key => $value)
		{
			/* Extracting filters from $_POST on key filter_ */
			if ($value != null && !strncmp($key, $this->table.'Filter_', 7 + Tools::strlen($this->table)))
			{
				$key = Tools::substr($key, 7 + Tools::strlen($this->table));
				/* Table alias could be specified using a ! eg. alias!field */
				$tmp_tab = explode('!', $key);
				$filter = count($tmp_tab) > 1 ? $tmp_tab[1] : $tmp_tab[0];

				if ($field = $this->filterToField($key, $filter))
				{
					$type = (array_key_exists('filter_type', $field) ? $field['filter_type'] : (array_key_exists('type', $field) ? $field['type'] : false));					if (($type == 'date' || $type == 'datetime') && is_string($value))
						$value = Tools::unSerialize($value);
					$key = isset($tmp_tab[1]) ? $tmp_tab[0].'.`'.$tmp_tab[1].'`' : '`'.$tmp_tab[0].'`';

					// Assignement by reference
					if (array_key_exists('tmpTableFilter', $field))
						$sql_filter = & $this->_tmpTableFilter;
					elseif (array_key_exists('havingFilter', $field))
						$sql_filter = & $this->_filterHaving;
					else
						$sql_filter = & $this->_filter;

					/* Only for date filtering (from, to) */
					if (is_array($value))
					{
						if (isset($value[0]) && !empty($value[0]))
						{
							if (!Validate::isDate($value[0]))
								$this->errors[] = Tools::displayError('\'From:\' date format is invalid (YYYY-MM-DD)');
							else
								$sql_filter .= ' AND '.pSQL($key).' >= \''.pSQL(Tools::dateFrom($value[0])).'\'';
						}

						if (isset($value[1]) && !empty($value[1]))
						{
							if (!Validate::isDate($value[1]))
								$this->errors[] = Tools::displayError('\'To:\' date format is invalid (YYYY-MM-DD)');
							else
								$sql_filter .= ' AND '.pSQL($key).' <= \''.pSQL(Tools::dateTo($value[1])).'\'';
						}
					}
					else
					{
						$sql_filter .= ' AND ';
						$check_key = ($key == $this->identifier || $key == '`'.$this->identifier.'`');

						if ($type == 'int' || $type == 'bool')
							$sql_filter .= (($check_key || $key == '`active`') ? 'a.' : '').pSQL($key).' = '.(int)$value.' ';
						elseif ($type == 'decimal')
							$sql_filter .= ($check_key ? 'a.' : '').pSQL($key).' = '.(float)$value.' ';
						elseif ($type == 'select')
							$sql_filter .= ($check_key ? 'a.' : '').pSQL($key).' = \''.pSQL($value).'\' ';
						else
							$sql_filter .= ($check_key ? 'a.' : '').pSQL($key).' LIKE \'%'.pSQL($value).'%\' ';
					}
				}
			}
		}
	}
    
}