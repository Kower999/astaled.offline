<?php
include_once dirname(__FILE__).'/../abstract/DataController.php';

class VIPPricesController extends DataController
{
	public function __construct()
	{
		$this->display = '';
        $this->className = 'VIPPrices';
		parent::__construct();
                
		$this->meta_title = $this->l('VIP Ceny a Provízie').' - '.$this->module->displayName;
		if (!$this->module->active)
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminHome'));
            
        $prds = '';
        if(Tools::isSubmit('submitBulkactionNameproduct_provisions')) {
            $prd = Tools::getValue('product_provisionsBox');
            if(!empty($prd)) $prds = implode(',',$prd);
            $_POST['PS_PROVISIONS_BULK_PRODUCTS'] = $prds;
//            Configuration::set('PS_PROVISIONS_BULK_PRODUCTS',$prds);
//            Configuration::loadConfiguration();
        }
        
            
	}
    
	public function initContent()
	{
		$error_msg = '';
		
		parent::initContent();
	
        if(Tools::isSubmit('updateproduct_vip_prices') && ($this->tabAccess['edit'] === '1')){
            $this->display = 'edit';
            $this->table = 'vip_prices';
            $this->toolbar_btn = null;                
            $this->initEdit();
            $this->content .= '<style>.margin-form { padding: 0.4em 0 1em 260px; } .margin-form input {margin-top: -0.4em;}</style>';
		    $this->content .= $this->renderForm();            
        } else {
            if($this->tabAccess['edit'] === '1') {
                $this->content .= $this->initList();
                $this->initOpts();
		      $this->content .= $this->renderForm();
                $this->content .= '<br/>';
            }
            $this->content .= $this->initList2();            
        }
		
		$this->assign('content', $this->content);
		
	}

    public function initEdit(){

        $id = Tools::getValue('id_product_vip_prices');
        if(!empty($id)){
            $vpp = new VIPPrices($id);
            $prd = new Product($vpp->id_product);
            $grp = new Group($vpp->id_group);
            $lng = $this->context->language->id;

            $this->fields_form = array(
                'legend' => array(       
                    'title' => $this->l('Nastavenie cien a provizie pre VIP skupinu / produkt'),       
                    'image' => '/modules/data/Provisions.gif'   
                ),   
                'input' => array(       
                    array(           
                        'label' => $this->l('Row'),         
                        'type' => 'hidden',
                        'name' => 'id_product_vip_prices',
                    ),
                    array(           
                        'label' => $this->l('Produkt:'),         
                        'type' => 'free',
                        'name' => 'vip_product',
                    ),
                    array(
                        'type' => 'free',                              
                        'label' => $this->l('Skupina:'),         
                        'name' => 'vip_group',                     
                    ),     
                    array(
                        'type' => 'free',                              
                        'label' => $this->l('Nákupná cena:'),         
                        'name' => 'vip_wholesale_price',                     
                    ),     
                    array(
                        'type' => 'text',                              
                        'label' => $this->l('Základná cena:'),         
                        'name' => 'z_cena',                     
                    ),     
                    array(
                        'type' => 'text',                              
                        'label' => $this->l('Hraničná cena:'),         
                        'name' => 'cena_2',                     
                    ),     
                    array(
                        'type' => 'text',                              
                        'label' => $this->l('Provízia'),         
                        'name' => 'provizia',                     
                    ),     
                    
                ),
                'submit' => array(
                    'title' => $this->l('Uložiť'),       
                    'class' => 'button'   
                )
            );
            
            $this->fields_value = array(
                'vip_product' => $prd->name[$lng],
                'vip_group' => $grp->name[$lng],
                'vip_wholesale_price' => $prd->wholesale_price,
                'z_cena' => $vpp->z_cena,
                'cena_2' => $vpp->cena_2,
                'provizia' => $vpp->provizia
            );            
            
            
        }


    }

    
    public function initOpts(){

$options = array();
foreach (Group::getGroups((int)$this->context->language->id) as $group)
{
   if(strpos($group['name'],'VIP') !== false)
  $options[] = array(
    "id" => (int)$group['id_group'],
    "name" => $group['name']
  );
}            

//Tools::fd($options);

$this->fields_form = array(
  'legend' => array(       
    'title' => $this->l('Pridanie produktov pre VIP skupinu'),       
    'image' => '/modules/data/Provisions.gif'   
  ),   
  'input' => array(       
    array(           
      'label' => $this->l('Produkty:'),         // The <label> for this <select> tag.
      'type' => 'text',
      'name' => 'vip_products',
     ),
    array(
        'type' => 'select',                              // This is a <select> tag.
        'label' => $this->l('Skupina:'),         // The <label> for this <select> tag.
        'desc' => $this->l('Vyber skupinu pre ktorú chceš pridať produkty/ceny/provizie'),  // A help text, displayed right next to the <select> tag.
        'name' => 'vip_group',                     // The content of the 'id' attribute of the <select> tag.
        'required' => false,                              // If set to true, this option must be set.
        'options' => array(
            'query' => $options,                           // $options contains the data itself.
            'id' => 'id',                           // The value of the 'id' key must be the same as the key for 'value' attribute of the <option> tag in each $options sub-array.
            'name' => 'name'                               // The value of the 'name' key must be the same as the key for the text content of the <option> tag in each $options sub-array.
        )
),     
  ),
  'submit' => array(
    'title' => $this->l('Uložiť'),       
    'class' => 'button'   
  )
);
        if(Tools::isSubmit('submitBulkactionNameproduct_vipprices')) {
            $arr = Tools::getValue('product_vippricesBox');
            if(is_array($arr)) {
                $v = implode(',',$arr);
            } else {
                $v = $arr;
            }
            
		  $this->fields_value = array(
			'vip_products' => $v  
		  );            
        }

    }
    
    public function initList2()
    {
        $ret = '';
        $this->table = 'product_vip_prices';
        $this->identifier = 'id_product_vip_prices';

		$this->fields_list = array(
/*		'id_vipprice' => array(
			'title' => $this->l('ID'),
			'align' => 'center',
			'width' => 25
		),*/
		'id_product_vip_prices' => array(
			'title' => $this->l('ID'),
			'align' => 'center',
            'filter_type' => 'int',            
			'width' => 25
		),
        'ean13' => array(
                'title' => $this->l('EAN'),
                'width' => 50,
			    'filter_key' => 'p!ean13'
            ),
        
		'id_product' => array(
			'title' => $this->l('ID Produktu'),
			'align' => 'center',
            'filter_type' => 'int',      
            'filter_key' => 'a!id_product',                  
			'width' => 25
		),
        'group' => array(
                'title' => $this->l('Skupina'),
                'width' => 'auto',
			    'filter_key' => 'gl!name'
            ),
        'name' => array(
                'title' => $this->l('Názov produktu'),
                'width' => 'auto',
			    'filter_key' => 'pl!name'
            ),
        'name_category' => array(
                'title' => $this->l('Kategória'),
                'width' => 'auto',
				'filter_key' => 'cl!name',
            ),
		);
        if (Context::getContext()->employee->isLoggedBack() && 
            ((Context::getContext()->employee->id_profile == 5) || (Context::getContext()->employee->id_profile == 6))) {
      		unset($this->fields_list['wholesale_price']);
        } else {
		  $this->fields_list['wholesale_price'] = array(
			'title' => $this->l('Nákupná cena'),
			'width' => 50,
			'type' => 'price',
			'align' => 'right',
			'filter_key' => 'p!wholesale_price'
		  );            
        }
    
        $this->fields_list['z_cena'] = array(
                'title' => $this->l('Odporúčaná cena (bez DPH)'),
                'align' => 'center',
			    'type' => 'price',                
                'width' => 50,
			    'filter_key' => 'a!z_cena'
        );
        $this->fields_list['cena_2'] = array(
                'title' => $this->l('Hraničná cena'),
                'align' => 'center',
			    'type' => 'price',                
                'width' => 50,
        );
        $this->fields_list['provizia'] = array(
                'title' => $this->l('Provízia'),
                'align' => 'center',
                'width' => 25,
                'type'  => 'decimal',
				'filter_key' => 'a!provizia'
            );
        
        $this->resetquery();
        $alias = 'a';
		$this->_join = ' LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (pl.id_product = a.id_product AND pl.`id_lang` = '.$this->context->language->id.' )';
		$this->_join .= ' LEFT JOIN `'._DB_PREFIX_.'product` p ON (p.id_product = a.id_product)';
		$this->_join .= ' LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (p.`id_category_default` = cl.`id_category` AND cl.`id_lang` = '.$this->context->language->id.' ) ';
		$this->_join .= ' LEFT JOIN `'._DB_PREFIX_.'group_lang` gl ON (a.`id_group` = gl.`id_group` AND gl.`id_lang` = '.$this->context->language->id.' ) ';
		$this->_select = ' pl.`name`, p.wholesale_price, gl.`name` AS `group`, cl.`name` AS `name_category`, p.ean13';
        $this->_defaultOrderBy = 'a.id_product_vip_prices';
         $this->bulk_actions = null;
        if (Context::getContext()->employee->isLoggedBack() && (Context::getContext()->employee->id_profile != 5) ) {
		  $this->addRowAction('delete');
        }

        $ret .= $this->renderList2('product_vip_prices','product_vip_prices','vipprices_list', false); 
//        Tools::fd($this->_listsql);

        return $ret;
    }

    public function initList()
    {
        $ret = '';
        $this->table = 'product';
        $this->identifier = 'id_product';

		$this->fields_list = array(
/*		'id_vipprice' => array(
			'title' => $this->l('ID'),
			'align' => 'center',
			'width' => 25
		),*/
		'id_product' => array(
			'title' => $this->l('ID Produktu'),
			'align' => 'center',
            'filter_type' => 'int',            
            'filter_key' => 'a!id_product',
			'width' => 25
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
		);
                                    
		$this->fields_list['wholesale_price'] = array(
			'title' => $this->l('Nákupná cena'),
			'width' => 90,
			'type' => 'price',
			'align' => 'right',
			'filter_key' => 'a!wholesale_price'
		);
    
        $this->fields_list['price'] = array(
                'title' => $this->l('Odporúčaná cena (bez DPH)'),
                'align' => 'center',
			    'type' => 'price',                
                'width' => 50,
        );
        
        $alias = 'a';
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON ('.$alias.'.`id_category_default` = cl.`id_category` AND b.`id_lang` = cl.`id_lang` AND cl.id_shop = 1) ';
//        $this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'product_vipprices` AS pvip ON a.id_product = pvip.id_product '; 
		$this->_select .= 'cl.name AS `name_category` ';
        $this->_defaultOrderBy = 'a.id_product';
        $this->_group .= ' GROUP BY a.id_product';
         $this->bulk_actions = array(
            'actionName' => array(
                'text' => $this->l('Zvoliť označené'),
                'confirm' => $this->l('Zvoliť označené produkty pre hromadné nastavenie?')
            )
         );

        if (Context::getContext()->employee->isLoggedBack() && 
            ((Context::getContext()->employee->id_profile == 5) || (Context::getContext()->employee->id_profile == 6))) {
      		unset($this->fields_list['wholesale_price']);
        }


        $ret .= $this->renderList2('product_vipprices','product','product_list'); 
        return $ret;
    }

// This method generates the list of results

	public function postProcess()
	{
	   if(Tools::isSubmit('submitAddproduct') && Tools::isSubmit('vip_products'))
	   {
	       $prds = Tools::getValue('vip_products');
           if(!empty($prds)){
                $arr = explode(',',$prds);
                $grp = Tools::getValue('vip_group');
                
                foreach($arr as $p){
                    $vpp = new VIPPrices();
                    $vpp->id_product = $p;
                    $vpp->id_group = $grp;
                    $chk = $vpp->check();
                    if(empty($chk)){
                        $prd = new Product($p);
                        $vpp->z_cena = $prd->price;
                        $prv = Provisions::getByIdProduct($p);
                        $vpp->cena_2 = (empty($prv['cena_2'])) ? $vpp->z_cena : $prv['cena_2']; 
                        $vpp->provizia = (empty($prv['provizia'])) ? 20 : $prv['provizia'];
                        $vpp->add(); 
                    }
                }
           }
	   }
	   if(Tools::isSubmit('deleteproduct_vip_prices') && Tools::isSubmit('id_product_vip_prices')){
           $id = (int)Tools::getValue('id_product_vip_prices');
	       $vpp = new VIPPrices($id);
           $vpp->delete();	       
       } 
	   if(Tools::isSubmit('submitAddvip_prices') && Tools::isSubmit('id_product_vip_prices')){
	       $id = Tools::getValue('id_product_vip_prices');
           $vpp = new VIPPrices($id);
           $vpp->z_cena = Tools::getValue('z_cena');
           $vpp->cena_2 = Tools::getValue('cena_2');
           $vpp->provizia = Tools::getValue('provizia');
           $vpp->update();
	   }
    }
    
}