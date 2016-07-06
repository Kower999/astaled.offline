<?php
include_once dirname(__FILE__).'/../abstract/DataController.php';

class MnozstvoSkladomController extends DataController
{    
	public function __construct()
	{
		$this->display = '';
        $this->className = 'MnozstvoSkladom';
        $this->table = 'mnozstvo_skladom';
        $this->identifier = 'id_mnozstvo_skladom';
		parent::__construct();
        
		$this->meta_title = $this->l('Sklady OZ').' - '.$this->module->displayName;
		if (!$this->module->active)
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminHome'));

        $filter = '';
        if(!empty($this->_filter)){
            $filter = '&filter='.urlencode($this->_filter);
        }        
        
        $this->toolbar_btn = array();
		$this->toolbar_btn['filterbad2'] = array(
			'href' => "#",
			'desc' => $this->l('< 0'),
            'js' => 'testscript(\'filterbad2\');',
            'imgclass' => 'preview'
		);

		$this->toolbar_btn['filterok'] = array(
			'href' => "#",//$this->context->link->getAdminLink('MnozstvoSkladom', true).'&filterok=1'.$filter,
			'desc' => $this->l('0 - 1'),
            'js' => 'testscript(\'filterok\');',
            'imgclass' => 'preview'
		);
		$this->toolbar_btn['filternok'] = array(
			'href' => "#",//$this->context->link->getAdminLink('MnozstvoSkladom', true).'&filternok=1'.$filter,
			'desc' => $this->l('1 - 2'),
            'js' => 'testscript(\'filternok\');',
            'imgclass' => 'preview'
		);

		$this->toolbar_btn['filterbad'] = array(
			'href' => "#",//$this->context->link->getAdminLink('MnozstvoSkladom', true).'&filterbad=1'.$filter,
			'desc' => $this->l('2 - ...'),
            'js' => 'testscript(\'filterbad\');',
            'imgclass' => 'preview'
		);
            
	}

    
	public function initContent()
	{
		$error_msg = '';
		
		parent::initContent();
        
        unset($this->toolbar_btn['new']);
        $this->content .= $this->initList();
		
		$this->assign('content', $this->content);
		
	}

    public function setMedia()
    {
        parent::setMedia();
        $this->context->controller->addJS(_MODULE_DIR_.$this->module->name.'/js/msc.js');
    }

    public function initList()
    {
        $ret = '';

		$this->fields_list = array(
		'id_employee' => array(
			'title' => $this->l('ID OZ'),
			'align' => 'center',
            'filter_type' => 'int',
			'width' => 25
		),
		'id_product' => array(
			'title' => $this->l('ID Produktu'),
			'align' => 'center',
            'filter_type' => 'int',
			'width' => 25
		),
		'ean13' => array(
			'title' => $this->l('EAN'),
			'align' => 'center',
			'width' => 50,
            'filter_key' => 'p!ean13'
		),
        'name' => array(
                'title' => $this->l('Názov produktu'),
                'width' => 'auto',
			    'filter_key' => 'b!name'
            ),
        'name_category' => array(
                'title' => $this->l('Kategória'),
                'width' => 230,
				'filter_key' => 'cl!name',
            ),
		'quantity' => array(
			'title' => $this->l('Množstvo'),
			'align' => 'center',
			'width' => 25,
			'filter_key' => 'a!quantity',
            'filter_type' => 'int',
		),
		'sells' => array(
			'title' => $this->l('Zásoba'),
			'align' => 'center',
			'width' => 25,
            'type' => 'float',
//            'filter_type' => 'decimal',
            'search' => false,
		),
		);
        
		$admin = array(        
		'wholesale_price' => array(
			'title' => $this->l('Cena / ks'),
			'align' => 'center',
			'width' => 100,
            'type' => 'price',
			'filter_key' => 'p!wholesale_price',
		),
		'wsp_total' => array(
			'title' => $this->l('Cena'),
			'align' => 'center',
            'type' => 'price',
			'width' => 100,
		),
		);
                
        $alias = 'a';
        $id_lang = $this->context->language->id;
        if($this->isadmin) {
            $this->fields_list = array_merge($this->fields_list,$admin);
            $this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'product_lang` b ON (b.`id_product` = '.$alias.'.`id_product` AND b.`id_lang` = '.$id_lang.' AND b.id_shop = 1) ';
            $this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'product` p ON p.`id_product` = '.$alias.'.`id_product` ';
            $this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (cl.`id_category` = p.`id_category_default` AND cl.`id_lang` = b.`id_lang` AND cl.id_shop = 1) ';
            $this->_select .= 'cl.name AS `name_category`, b.name , p.ean13, p.wholesale_price, (p.wholesale_price * a.quantity) as wsp_total ';
            $this->_defaultOrderBy = 'a.id_mnozstvo_skladom';
        } else {
            unset($this->fields_list['id_employee']);
            $this->table = 'stock_available';
            $this->identifier = 'id_stock_available';
            $this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'product_lang` b ON (b.`id_product` = '.$alias.'.`id_product` AND b.`id_lang` = '.$id_lang.' AND b.id_shop = 1) ';
            $this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'product` p ON p.`id_product` = '.$alias.'.`id_product` ';
            $this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (cl.`id_category` = p.`id_category_default` AND cl.`id_lang` = b.`id_lang` AND cl.id_shop = 1) ';
            $this->_select .= 'cl.name AS `name_category`, b.name , p.ean13, p.wholesale_price ';
        $this->_defaultOrderBy = 'a.id_product';
        }

//        $now = date("Y-m-d") . " 23:59:59";                
//        $start = date("Y-m-d", strtotime("-1 year",time())) . " 00:00:00";                                            
                                            
//        $this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'order_detail` od ON (od.product_id = a.id_product AND od.product_attribute_id = a.id_product_attribute)';
//        $this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'orders` o ON (o.id_order = od.id_order AND (o.date_add BETWEEN \''.$start.'\' AND \''.$now.'\'))';
//        $this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'customer` c ON (c.id_customer = o.id_customer)';

//        $this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'product_vipprices` AS pvip ON a.id_product = pvip.id_product '; 

//		$this->_select .= 'cl.name AS `name_category`, b.name , p.ean13, p.wholesale_price, (p.wholesale_price * a.quantity) as wsp_total, ( a.quantity / ( SUM(od.product_quantity) / 12 ) ) AS sell ';
//        $this->_tmpTableSelect = ' ';
//        $this->_tmpTableFilter = ' AND 1';
        
//        $this->_where .= " ";
//        $this->_group .= ' GROUP BY a.id_product';
/*
         $this->bulk_actions = array(
            'actionName' => array(
                'text' => $this->l('Zvoliť označené'),
                'confirm' => $this->l('Zvoliť označené produkty pre hromadné nastavenie?')
            )
         );
*/
        $this->context->smarty->assign(array(
                'filter_stav' => isset($_REQUEST['MnozstvoSkladomFilter_stav']) ? (string)$_REQUEST['MnozstvoSkladomFilter_stav'] : "",
        ));

        $ret .= $this->renderList2('MnozstvoSkladom',$this->table,$this->table, false); 
        return $ret;
    }
    

    public function renderList2($what,$what2,$what3, $lang = true, $toolbar = null,$order_by = null, $order_way = null)
    {
        $tmp = $this->table;
        $this->table = $what; // 3

        
        // Adds an Edit button for each result
        if(!empty($toolbar))
            $this->toolbar_btn = $toolbar;
        $this->lang = $lang;

  		if (!($this->fields_list && is_array($this->fields_list)))
			return false;
            
        if(empty($order_by)) {
            $orderBy = Tools::getValue($what.'Orderby');
        } else {
            $orderBy = $order_by;
        }
        if(empty($order_way)) {
            $orderWay  = Tools::getValue($what.'Orderway');
        } else {
            $orderWay = $order_way;            
        }        
        if(!Validate::isOrderBy($orderBy)) $orderBy = null;
        if(!Validate::isOrderWay($orderWay)) $orderWay = null;


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

//        $this->table = $what3;

        $filters = $this->context->cookie->getFamily($this->table.'Filter_');

        $this->table = $what2;           
//        var_dump($this->table);    
//        var_dump( $start,$limit);    
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
//Tools::fd($this->_listsql);

        $this->context->smarty->assign(array(
                'isadmin' => $this->isadmin,
        ));

        $now = date("Y-m-d") . " 23:59:59";                
        $start = date("Y-m-d", strtotime("-1 year",time())) . " 00:00:00";

        if(!empty($this->_list) && is_array($this->_list))
            foreach($this->_list as $key => $row){
                $id_prod = (int)$row['id_product'];
                $id_prod_attribute = (int)$row['id_product_attribute'];
                $id_employee = (int)$row['id_employee'];
                
                if($this->isadmin) {                
                    $sells = Db::getInstance()->executeS("SELECT SUM(od.product_quantity) AS quantity FROM new_order_detail od
                        LEFT JOIN new_orders o ON (o.id_order = od.id_order)
                        LEFT JOIN new_customer c ON (c.id_customer = o.id_customer)
                        WHERE od.product_id = $id_prod AND od.product_attribute_id = $id_prod_attribute AND c.id_employee = $id_employee AND (o.date_add BETWEEN '$start' AND '$now')");
                } else {
                    $sells = Db::getInstance()->executeS("SELECT SUM(od.product_quantity) AS quantity FROM new_order_detail od
                        LEFT JOIN new_orders o ON (o.id_order = od.id_order)
                        WHERE od.product_id = $id_prod AND od.product_attribute_id = $id_prod_attribute AND (o.date_add BETWEEN '$start' AND '$now')");                    
                }
                
                $sells = (int)$sells[0]['quantity'];

                
                if(empty($sells)) {
                    if( (int)$row['quantity'] == 0 ) {
                        $sells = 0;
                    } else {
                        $sells = 99;
                    }
                } else {
                    $sells = $sells / 12;
                    $sells = round($row['quantity'] / $sells, 2);
//                    var_dump($sells);
//                    die();
                }
                
                $this->_list[$key]['sells'] = $sells;
                
//                if(isset($_REQUEST['MnozstvoSkladomFilter_stav'])) {
                    if($sells < 0) {
                        if(in_array($_REQUEST['MnozstvoSkladomFilter_stav'], array("filterok","filternok","filterbad"))){
                            unset($this->_list[$key]);
                        }
                    }
                    if($sells >= 0 && $sells <=1) {
                        $this->_list[$key]['color'] = "#B3D0A0";
                        if(in_array($_REQUEST['MnozstvoSkladomFilter_stav'], array("filterbad2","filternok","filterbad"))){
                            unset($this->_list[$key]);
                        }
                    }
                    if($sells > 1 && $sells <=2) {
                        $this->_list[$key]['color'] = "#FBBB79";
                        if(in_array($_REQUEST['MnozstvoSkladomFilter_stav'], array("filterbad2","filterok","filterbad"))){
                            unset($this->_list[$key]);
                        }                    
                    }
                    if($sells > 2) {
                        $this->_list[$key]['color'] = "#EFA3A3";
                        if(in_array($_REQUEST['MnozstvoSkladomFilter_stav'], array("filterbad2","filterok","filternok"))){
                            unset($this->_list[$key]);
                        }                    
                    }                    
//                }
                
            }


        $helper->override_folder = 'mnozstvoSkladom/';
    if($this->isadmin) {


        $total = 0;
        
        if(!empty($this->_list) && is_array($this->_list)) {
            foreach($this->_list as $row){
                $total += (float)$row['wsp_total'];
            }            
        }
        $this->context->smarty->assign(array(
                'total2' => $total,
        ));
        
//        Tools::fd($this->_list);

$back1 = $this->_list;
$back2 = $this->fields_list; 

/* ------------------------------------------ */

        $this->resetquery();    

        $alias = 'a';
        $id_lang = $this->context->language->id;
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'product_lang` b ON ('.$alias.'.`id_product` = b.`id_product` AND b.`id_lang` = '.$id_lang.' AND b.id_shop = 1) ';
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'product` p ON '.$alias.'.`id_product` = p.`id_product` ';
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (p.`id_category_default` = cl.`id_category` AND b.`id_lang` = cl.`id_lang` AND cl.id_shop = 1) ';
		$this->_select .= 'cl.name AS `name_category`, b.name , p.ean13, p.wholesale_price, (p.wholesale_price * a.quantity) as wsp_total';
        $this->_defaultOrderBy = 'a.id_mnozstvo_skladom';

        
	    if(!Tools::isSubmit('submitResetMnozstvoSkladom') && Tools::isSubmit('submitFilterMnozstvoSkladom')){
            $this->processFilter2('MnozstvoSkladom');
        } else {
            $this->unsetFilter('MnozstvoSkladom');
        }

        $this->_tmpTableSelect = ' ';

        $this->table = $tmp;      

		$this->getList($this->context->language->id,'a.id_mnozstvo_skladom','ASC',0,false);
        
//        var_dump($this->_list);
                    
        $total = 0;
                            
        if(!empty($this->_list) && is_array($this->_list)) {
            foreach($this->_list as $key => $row){
                $sells = $row['sells'];
                if($sells < 0) {
                    if(isset($_REQUEST['filternok']) || isset($_REQUEST['filterbad']) || isset($_REQUEST['filterok'])) {
                        unset($this->_list[$key]);
                    }
                }
                
                if($sells >= 0 && $sells <=1) {
                    if(isset($_REQUEST['filternok']) || isset($_REQUEST['filterbad']) || isset($_REQUEST['filterbad2'])) {
                        unset($this->_list[$key]);
                    }
                }
                if($sells > 1 && $sells <=2) {
                    if(isset($_REQUEST['filterok']) || isset($_REQUEST['filterbad']) || isset($_REQUEST['filterbad2'])) {
                        unset($this->_list[$key]);
                    }                    
                }
                if($sells > 2) {
                    if(isset($_REQUEST['filterok']) || isset($_REQUEST['filternok']) || isset($_REQUEST['filterbad2'])) {
                        unset($this->_list[$key]);
                    }                    
                }
                
                if(isset($this->_list[$key]))
                    $total += (float)$row['wsp_total'];
            }            
        }
        if(!empty($this->_list) && is_array($this->_list)){                
            $this->context->smarty->assign(array(
                'total' => $total,
            ));
                    
        }
        

/* ------------------------------------------------ */

$this->_list = $back1;
$this->fields_list = $back2;

            
        } // end if isadmin
        
        $helper->toolbar_btn = $this->toolbar_btn;
        
		$list = $helper->generateList($this->_list, $this->fields_list);
        $this->lang = false;

        
        
        return $list; 
}    

// This method generates the list of results

	public function postProcess()
	{
    }
    
}