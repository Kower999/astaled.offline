<?php
include_once dirname(__FILE__).'/../abstract/DataController.php';

class VisitsController extends DataController
{
    
	public function __construct()
	{
//         $this->table = 'product_provisions';
//         $this->className = 'Provisions';
         $this->table = 'address';
         $this->className = 'Visits';
         $this->context = Context::getContext();
  
         $this->bulk_actions = null;
         $this->bulk_actions = array(
            'actionName' => array(
                'text' => $this->l('Zvoliť označené prevádzky'),
                'confirm' => $this->l('Zvoliť označené prevádzky pre hromadné nastavenie?')
            )
         );
                
         $this->lang = false;

        parent::__construct();            
  
        // Building the list of records stored within the "test" table
        $this->fields_list = array(
            'id_address' => array(
                'title' => $this->l('ID'),
                'align' => 'center',
                'width' => 25,
                'filter_type' => 'int'
            ),
            'id_employee' => array(
                'title' => $this->l('OZ'),
                'width' => 25,
				'filter_key' => 'c!id_employee',
            ),
            'alias' => array(
                'title' => $this->l('Alias'),
                'width' => 'auto',
            ),
            'company' => array(
                'title' => $this->l('Firma'),
                'width' => 'auto',
            ),
            'address1' => array(
                'title' => $this->l('Adresa'),
                'width' => 'auto',
            ),
            'city' => array(
                'title' => $this->l('Mesto'),
                'width' => 'auto',
            ),
            'visit' => array(
                'title' => $this->l('Dátum poslednej návštevy'),
                'width' => 230,
                'type'  => 'date',
				'filter_key' => 'cv!visit',
            ),            
            'dovod' => array(
                'title' => $this->l('Dôvod'),
                'width' => 'auto',
				'filter_key' => 'cv!dovod',
            ),
        );
        
        $alias = 'a';
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'address_visit` cv ON ('.$alias.'.`id_address` = cv.`id_address` AND cv.visit = (SELECT MAX(cvv.visit) FROM `'._DB_PREFIX_.'address_visit` cvv WHERE cvv.id_address = a.id_address)) ';
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'customer` c ON ('.$alias.'.`id_customer` = c.`id_customer` ) ';
		$this->_select .= 'cv.visit, cv.dovod, c.`id_employee` ';
        if ($this->context->employee->isLoggedBack() && ($this->context->employee->id_profile == 5) ) {
            $this->_where .= 'AND c.`id_employee` = '.($this->context->employee->id);            
        }
        $this->_group .= 'GROUP BY a.id_address';
        
        
        $prds = '';
        if(Tools::isSubmit('submitBulkactionNameaddress_visits')) {
            $prd = Tools::getValue('address_visitsBox');
            if(!empty($prd)) $prds = implode(',',$prd);
            $_POST['PS_VISITS_BULK_CUSTOMERS'] = $prds;
        }

	}
   
	public function initContent()
	{
            
        if(Tools::isSubmit('updateaddress_visits')) {
            $this->breadcrumbs[] = 'Pridať novú návštevu';
            $this->initToolbarTitle();
            $this->table = 'address_visits';
	        $this->toolbar_btn['back'] = array(
						'href' => $this->context->link->getAdminLink('Visits'),
						'desc' => $this->l('Back to list')
            );
            $this->content .= $this->renderForm();
        } else if(Tools::isSubmit('viewaddress_visits')) {
            $this->breadcrumbs[] = 'Zoznam návštev u zákazníka';
            $this->initToolbarTitle();
            $this->table = 'address_visit';
//            $this->resetquery();
            $this->_where .= ' AND cv.id_address = '.(int)Tools::getValue('id_address');
            $this->_group = '';
            $this->_join = ' LEFT JOIN `'._DB_PREFIX_.'address_visit` cv ON cv.id_address = a.id_address';
	        $back = Tools::safeOutput(Tools::getValue('back', ''));
	        $this->toolbar_btn['back'] = array(
						'href' => $this->context->link->getAdminLink('Visits'),
						'desc' => $this->l('Back to list')
            );

            $this->content .= $this->renderList2('address_visit','address','address_visit',false,$this->toolbar_btn,'cv.visit','DESC'); 
            
        } else {
            $this->table = 'address';
            $this->addRowAction('view');                   
            $this->content .= $this->renderList();
            $this->table = 'address_visits';
            $this->content .= $this->renderForm2();
        }            
        $this->context->smarty->assign(array( 'content' => $this->content ));
	}
 
    
// This method generates the list of results
    public function renderList()
    {
        // Adds an Edit button for each result
        $this->addRowAction('edit');    
//        $this->toolbar_btn = null;

  		if (!($this->fields_list && is_array($this->fields_list)))
			return false;
            
        $orderBy = Tools::getValue('address_visitsOrderby');
        $orderWay  = Tools::getValue('address_visitsOrderway');
        
        if(!Validate::isOrderBy($orderBy)) $orderBy = null;
        if(!Validate::isOrderWay($orderWay)) $orderWay = null;

        $this->table = 'address_visits';

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
	    if(!Tools::isSubmit('submitResetaddress_visits') && Tools::isSubmit('submitFilteraddress_visits')){
	       
            $this->processFilter2('address_visits');
        } else {
            $this->unsetFilter('address_visits');
        }
//echo "<br/><br/>";
//var_dump($this->context->cookie);

        $filters = $this->context->cookie->getFamily($this->table.'Filter_');
//        var_dump($filters);            
        

        $this->table = 'address';           
            
		$this->getList($this->context->language->id,$orderBy,$orderWay,$start, $limit);

		// Empty list is ok
		if (!is_array($this->_list))
			return false;

        $this->table = 'address_visits';

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
    
    // This method generates the Add/Edit form
    public function renderForm()
    {
        if(Tools::isSubmit('id_address')){
            $this->table = 'address_visit';
//            $this->display = 'edit';
            
            $sql = 'SELECT a.*, cv.* FROM `'._DB_PREFIX_.'address` a 
                LEFT JOIN `'._DB_PREFIX_.'address_visit` cv ON cv.id_address = a.id_address
                WHERE a.id_address = '.(int)Tools::getValue('id_address');
            $ret = Db::getInstance()->getRow($sql);
//            var_dump($ret);

        // Building the Add/Edit form
        $this->fields_form = array(
            'legend' => array(
                'title' => $this->l('Návšteva zákazníka: '.$ret['firstname'].' '.$ret['lastname'].' ('.$ret['company'].')')
            ),
            'input' => array(
                array(
                    'type' => 'hidden',
                    'name' => 'id_address'
                ),
                array(
                    'type' => 'date',
                    'label' => $this->l('Dátum:'),
                    'name' => 'visit',
                    'size' => 33,
//                    'required' => true,
                    'desc' => $this->l('Dátum poslednej návštevy.'),
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Dôvod:'),
                    'name' => 'dovod',
                    'size' => 33,
                    'desc' => $this->l('Dôvod poslednej návštevy.'),
                )
            ),
            'submit' => array(
                'title' => $this->l('Uložiť'),
                'class' => 'button',
            )
        );
        
            
            $this->fields_value = array(
                'visit' => date("Y-m-d"),
                'id_address' => $ret['id_address'],
                'dovod' => $ret['dovod']
            );            

        }
        
  
        return parent::renderForm();
    }    

    public function renderForm2()
    {
        $this->table = 'address_visit';
//        $this->display = 'edit';
            

        // Building the Add/Edit form
        $this->fields_form = array(
            'legend' => array(
                'title' => $this->l('Hromadné pridanie návštev zákazníkov.')
            ),
            'input' => array(
                array(
                    'type' => 'hidden',
                    'name' => 'id_address'
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Zákazníci:'),
                    'name' => 'PS_VISITS_BULK_CUSTOMERS',
                    'desc' => $this->l('Zoznam ID zákazníkov oddelených čiarkou.'),
                ),
                array(
                    'type' => 'date',
                    'label' => $this->l('Dátum:'),
                    'name' => 'visit',
                    'size' => 25,
                    'desc' => $this->l('Dátum poslednej návštevy.'),
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Dôvod:'),
                    'name' => 'dovod',
                    'desc' => $this->l('Dôvod poslednej návštevy.'),
                )
            ),
            'submit' => array(
                'title' => $this->l('Uložiť'),
                'class' => 'button',
            )
        );
        
            
            $this->fields_value = array(
                'visit' => date("Y-m-d"),
            );                    
  
        return parent::renderForm();
    }    


	public function postProcess()
	{
/*	   if(Tools::isSubmit('submitAddproduct_provisions')){
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
           $provizia->provizia = $prov;
           $provizia->update();
           if(!$new) {
                $provizia->update();   
           } else $provizia->save();
	   }
*/       
	   if(Tools::isSubmit('submitAddaddress_visit')){
	       $ids = Tools::getValue('PS_VISITS_BULK_CUSTOMERS');
	       $visit = Tools::getValue('visit');
	       $dovod = Tools::getValue('dovod');
           
           if(!empty($ids)) $idsa = explode(',',$ids);
           if(!empty($idsa)) {
                foreach($idsa as $prd){
                    
                    if(!empty($visit) && Validate::isDate($visit)) {
                        $prv = new Visits();
                        $prv->id_address = (int)$prd;
                        $prv->visit = $visit;
                        $prv->dovod = $dovod;                        
                        $prv->save();
                        
/*           Tools::fd($ids);
           Tools::fd($idsa);
            Tools::fd(array('test'));
*/                                    
                    } 
                }
           } else {
                $id = Tools::getValue('id_address');
                    if(!empty($visit) && Validate::isDate($visit)) {
                        $prv = new Visits($id);
                        $prv->id_address = (int)$id;
                        $prv->visit = $visit;
                        $prv->dovod = $dovod;
                        $prv->save();
                    } 
           }           	       
       } 
       
	   if(Tools::isSubmit('submitResetaddress_visits') || !Tools::isSubmit('submitFilteraddress_visits')){
            $this->unsetFilter('address_visit');            
       }
	   
    }
    
}