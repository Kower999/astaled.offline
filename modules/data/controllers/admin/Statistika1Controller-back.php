<?php

/**
 * @author Kower / VeGaSolutions - http://www.vegasolutions.sk
 * @copyright 2015
 */

include_once dirname(__FILE__).'/../abstract/DataController.php';

class Statistika1Controller extends DataController
{
    
	public function __construct()
	{
         $this->table = 'order_detail';
         $this->className = 'Statistika1';
  
         $this->bulk_actions = null;
         $this->lang = false;
         $this->context = Context::getContext();   
         $this->context->link = new Link();                 				

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
/*        
        $this->_from = '(
SELECT 
	b.*,
	catl. NAME AS category,

IF (
	scat.`id_category` > 2,
	scatl. NAME,
	"-"
) AS sub_category,

 o.invoice_number,
 m. NAME AS manufacturer,
 o.date_add,
 acs. NAME AS id_address_category,
 ad.company,
 ad.city,
 ad.postcode,
 ad.address1,
 CONCAT_WS(
	" ",
	ai.company,
	",",
	ai.`lastname`,
	ai.`firstname`,
	",",
	ai.`address1`,
	",",
	ai.`postcode`,
	ai.`city`,
	"(IČO:",
	ai.`dni`,
	")"
) AS customer,
 ai.dni,
 ai.phone_mobile,
 c.email,
 e.lastname AS employee
FROM
	`new_order_detail` b
LEFT JOIN `new_orders` o ON (b.`id_order` = o.`id_order`)
LEFT JOIN `new_product` p ON (
	b.`product_id` = p.`id_product`
)
LEFT JOIN `new_manufacturer` m ON (
	m.`id_manufacturer` = p.`id_manufacturer`
)
LEFT JOIN `new_customer` c ON (
	o.`id_customer` = c.`id_customer`
)
LEFT JOIN `new_address` ad ON (
	o.`id_address_delivery` = ad.`id_address`
)
LEFT JOIN `new_address` ai ON (
	o.`id_address_invoice` = ai.`id_address`
)
LEFT JOIN `new_address_category` ac ON (
	o.`id_address_delivery` = ac.`id_address`
)
LEFT JOIN `new_address_categories` acs ON (
	ac.`id_address_category` = acs.`id`
)
LEFT JOIN `new_employee` e ON (
	c.`id_employee` = e.`id_employee`
)

LEFT JOIN `new_category_product` cp1 ON (
	cp1.`id_product` = p.`id_product`
)
LEFT JOIN `new_category` cat ON (
	cp1.`id_category` = cat.`id_category`
)
LEFT JOIN `new_category_lang` catl ON (
	catl.`id_category` = cat.`id_category`
	AND catl.`id_lang` = 7
)
LEFT JOIN `new_category_product` cp2 ON (
	cp2.`id_product` = p.`id_product`
)
LEFT JOIN `new_category` scat ON (
	cp2.`id_category` = scat.`id_category`
)
LEFT JOIN `new_category_lang` scatl ON (
	scatl.`id_category` = scat.`id_category`
	AND scatl.`id_lang` = 7
)

WHERE
	1

AND cat.`id_parent` = 2
AND CASE
WHEN scat.`id_parent` > 2 THEN
	scat.`id_parent` > 2
ELSE
	scat.`id_parent` < 2
END
ORDER BY
	scat.`id_category` DESC
) as a';
*/
        $this->_select = 'catl.name AS category, IF(scat.`id_category` > 2,  scatl.name, "-") AS sub_category,o.invoice_number, m.name AS manufacturer, o.date_add, acs.name AS id_address_category, ad.company, ad.city, ad.postcode, ad.address1, CONCAT_WS( " ", ai.company, ",", ai.`lastname`,ai.`firstname`, ",", ai.`address1`, ",", ai.`postcode`, ai.`city`,"(IČO:", ai.`dni`,")") AS customer, ai.dni, ai.phone_mobile, c.email, e.lastname AS employee';
        
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'orders` o ON (a.`id_order` = o.`id_order`) ';
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'product` p ON (a.`product_id` = p.`id_product`) ';
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'manufacturer` m ON (m.`id_manufacturer` = p.`id_manufacturer`) ';
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'customer` c ON (o.`id_customer` = c.`id_customer`) ';
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'address` ad ON (o.`id_address_delivery` = ad.`id_address`) ';
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'address` ai ON (o.`id_address_invoice` = ai.`id_address`) ';
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'address_category` ac ON (o.`id_address_delivery` = ac.`id_address`) ';        
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'address_categories` acs ON (ac.`id_address_category` = acs.`id`) ';        
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'employee` e ON (c.`id_employee` = e.`id_employee`) ';
/*
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'category_product` cp1 ON (cp1.`id_product` = p.`id_product`) ';
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'category` cat ON (cp1.`id_category` = cat.`id_category` )';        
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'category_lang` catl ON (catl.`id_category` = cat.`id_category` AND catl.`id_lang` = 7) ';        

		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'category_product` cp2 ON (cp2.`id_product` = p.`id_product`) ';
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'category` scat ON (cp2.`id_category` = scat.`id_category` ) ';        
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'category_lang` scatl ON (scatl.`id_category` = scat.`id_category` AND scatl.`id_lang` = 7) ';  
*/
        
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'category_product` cp2 ON (cp2.`id_product` = p.`id_product`) ';
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'category` scat ON (cp2.`id_category` = scat.`id_category` ) ';        
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'category_lang` scatl ON (scatl.`id_category` = scat.`id_category` AND scatl.`id_lang` = 7) ';  

		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'category` cat ON (scat.`id_parent` = cat.`id_category` )';        
		$this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'category_lang` catl ON (catl.`id_category` = cat.`id_category` AND catl.`id_lang` = 7) ';        

//        $this->_where .= 'AND cat.`id_parent` = 2 AND CASE WHEN scat.`id_parent` > 2 THEN scat.`id_parent` > 2  ELSE scat.`id_parent` < 2 END ';
        
	    if(!Tools::isSubmit('submitResetorder_detail') && Tools::isSubmit('submitFilterorder_detail')){
            $this->processFilter2('order_detail');
        } else {
            $this->unsetFilter('order_detail');
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
		$this->getList($this->context->language->id,'');
        
//        echo($this->_listsql);

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
    
	public function postProcess() {
        if(Tools::isSubmit('export')){
            $filter = Tools::getValue('filter');
            if(!empty($filter))
                $this->_filter = urldecode($filter); 
      		$this->getList($this->context->language->id);
            if(!empty($this->_list)){                
                require_once dirname(__FILE__) . '/../../classes/PHPExcel.php';
                
// Create new PHPExcel object
                $objPHPExcel = new PHPExcel();

// Set document properties
                $objPHPExcel->getProperties()->setCreator("VeGa Solutions s.r.o.")
							 ->setTitle("Štatistika Energizer");


// Add some data
                $sheet = $objPHPExcel->setActiveSheetIndex(0);
                
                $sheet->setCellValue('A1', 'Faktúra');
                $sheet->setCellValue('B1', 'Dátum');
                $sheet->setCellValue('C1', 'Kategória');
                $sheet->setCellValue('D1', 'Podkategória');
                $sheet->setCellValue('E1', 'EAN');
                $sheet->setCellValue('F1', 'Názov produktu');
                $sheet->setCellValue('G1', 'Výrobca');
                $sheet->setCellValue('H1', 'Jedn. cena (bez DPH)');
                $sheet->setCellValue('I1', 'Množstvo');
                $sheet->setCellValue('J1', 'Spolu (bez DPH)');
                $sheet->setCellValue('K1', 'Kategória zákazníka');
                $sheet->setCellValue('L1', 'Firma');
                $sheet->setCellValue('M1', 'Mesto');
                $sheet->setCellValue('N1', 'PSČ');
                $sheet->setCellValue('O1', 'Ulica');
                $sheet->setCellValue('P1', 'Zákazník');
                $sheet->setCellValue('Q1', 'IČO');
                $sheet->setCellValue('R1', 'Telefón');
                $sheet->setCellValue('S1', 'Email');
                $sheet->setCellValue('T1', 'Obchodný zástupca');
                
                $r = 2;
                foreach($this->_list as $row){
                    $sheet->setCellValue('A'.$r, $row['invoice_number']);
                    $sheet->setCellValue('B'.$r, $row['date_add']);
                    $sheet->setCellValue('C'.$r, $row['category']);
                    $sheet->setCellValue('D'.$r, $row['sub_category']);
                    $sheet->setCellValue('E'.$r, $row['product_ean13']);
                    $sheet->setCellValue('F'.$r, $row['product_name']);
                    $sheet->setCellValue('G'.$r, $row['manufacturer']);
                    $sheet->setCellValue('H'.$r, $row['unit_price_tax_excl']);
                    $sheet->setCellValue('I'.$r, $row['product_quantity']);
                    $sheet->setCellValue('J'.$r, $row['total_price_tax_excl']);
                    $sheet->setCellValue('K'.$r, $row['id_address_category']);
                    $sheet->setCellValue('L'.$r, $row['company']);
                    $sheet->setCellValue('M'.$r, $row['city']);
                    $sheet->setCellValue('N'.$r, $row['postcode']);
                    $sheet->setCellValue('O'.$r, $row['address1']);
                    $sheet->setCellValue('P'.$r, $row['customer']);
                    $sheet->setCellValue('Q'.$r, $row['dni']);
                    $sheet->setCellValue('R'.$r, $row['phone_mobile']);
                    $sheet->setCellValue('S'.$r, $row['email']);
                    $sheet->setCellValue('T'.$r, $row['employee']);
                    $r++;                    
                }
                
//                var_dump($this->_list[5]);
                


// Redirect output to a client’s web browser (Excel5)
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="01simple.xls"');
                header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
                header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
                header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header ('Pragma: public'); // HTTP/1.0

//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

                $objWriter->save('php://output');
                
            }
        }
    }
            
}

?>