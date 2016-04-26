<?php

abstract class DataController extends ModuleAdminController {
	
	protected $errorMessages = '';
	
	public function __construct() {
		parent::__construct();
				
	}
	
	public function fetch($template) {
		return $this->context->smarty->fetch($this->module->getTemplatePath('views/templates/admin/'.$template));
	}
	
	public function assign($key, $value) {
		$this->context->smarty->assign($key, $value);
	}

    public function resetquery(){
        $this->_select = '';
        $this->_join = '';
        $this->_filter = '';
        $this->_where = '';
        $this->_group = '';
        $this->_defaultOrderBy = '';                
    }
    
	/**
	 * @what  = filter
	 * @what2 = tabulka pre getlist
	 * @what3 = tabulka pre orderby a filtre
     * @lang  = viacjazicne nacitanie
	 */
    public function renderList2($what,$what2,$what3, $lang = true, $toolbar = null,$order_by = null, $order_way = null)
    {
        $tmp = $this->table;
        $this->table = $what3;

        
        // Adds an Edit button for each result
        $this->toolbar_btn = $toolbar;
        $this->lang = $lang;

  		if (!($this->fields_list && is_array($this->fields_list)))
			return false;
            
        if(empty($order_by)) {
            $orderBy = Tools::getValue($what.'Orderby');
            if(!Validate::isOrderBy($orderBy)) $orderBy = null;
        } else {
            $orderBy = $order_by;
        }
        if(empty($order_way)) {
            $orderWay  = Tools::getValue($what.'Orderway');
            if(!Validate::isOrderWay($orderWay)) $orderWay = null;
        } else {
            $orderWay = $order_way;            
        }        


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

	    if(!Tools::isSubmit('submitReset'.$what) && Tools::isSubmit('submitFilter'.$what)){	       
            $this->processFilter2($what);
        } else {
            $this->unsetFilter($what);
        }

        $filters = $this->context->cookie->getFamily($this->table.'Filter_');

        $this->table = $what2;           
            
		$this->getList($this->context->language->id,$orderBy,$orderWay,$start, $limit);

		// Empty list is ok
		if (!is_array($this->_list))
			return false;

        $this->table = $what;

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
Tools::fd($this->_listsql);
		$list = $helper->generateList($this->_list, $this->fields_list);
        $this->lang = false;

        $this->table = $tmp;        
		return $list;
    }

    public function unsetFilter($what){
        $tmp = $this->table;
        $this->table = $what;
            $this->context->cookie->unsetFamily($this->table.'Filter_');
            $this->context->cookie->unsetFamily('submitFilter'.$this->table);
            $this->context->cookie->unsetFamily($this->table.'Orderby');
            $this->context->cookie->unsetFamily($this->table.'Orderway');            
            if(isset($_POST['submitFilter'.$this->table])) unset($_POST['submitFilter'.$this->table]);
            foreach($this->fields_list as $key => $field){
                $k = empty($field['filter_key'])?$key:$field['filter_key'];
                if(isset($_POST[$this->table.'Filter_'.$k])) unset($_POST[$this->table.'Filter_'.$k]);
            }
        $this->table = $tmp;        
    }

    
	/**
	 * Set the filters used for the list display
	 */
	public function processFilter2($what)
	{

        $tmp = $this->table;
        $this->table = $what;
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
        $this->table = $tmp;        
	}
    
}