<?php
include_once dirname(__FILE__).'/../abstract/DataController.php';

class ImportovaneVydajkyController extends DataController
{
    public $isadmin = false;
    
	public function __construct()
	{
		$this->display = '';
        $this->className = 'ImportovaneVydajky';
        $this->table = 'stock_update';
        $this->identifier = 'id_stock_update';
		parent::__construct();
        
		if (!$this->module->active)
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminHome'));

        $this->fields_list = array(
            'id_stock_update' => array(
                'title' => $this->l('ID'),
                'align' => 'center',
                'width' => 25,
                'filter_type' => 'int'
            ),
            'id_employee' => array(
                'title' => $this->l('OZ'),
                'width' => 50,
                'filter_type' => 'int'
            ),
            'datum' => array(
                'title' => $this->l('Dátum'),
                'width' => 150,
                'search' => false,
                'filter_key' => 'a!subor',
            ),                        
            'cislo' => array(
                'title' => $this->l('Číslo výdajky'),
                'width' => 'auto',
            ),
        );
        
        $this->_where = ' AND imported = 1';         
        $this->_select = ' DATE_FORMAT(FROM_UNIXTIME(`subor`), \'%d.%m.%Y %H:%i:%s\') as "datum"';
//        $this->_defaultOrderBy = 'subor';
        $this->_defaultOrderWay = 'DESC';
        
        $this->addRowAction('details');
        
        $this->fieldsDisplay = array(
            'id_stock_update' => array(
                'title' => $this->l('ID'),
                'width' => 50,
                'filter_type' => 'int'
            ),
            'ean' => array(
                'title' => $this->l('EAN'),
                'width' => 100,
            ),                        
            'imported' => array(
                'title' => $this->l('Množstvo'),
                'width' => 'auto',
            ),
        );
        
	    if(!Tools::isSubmit('submitFilter')){
            $this->unsetFilter('stock_update');
        }
        
                   
	}

    public function ajaxProcess()
    {
        $id = (int)$_REQUEST['id'];
        $query = 'SELECT * FROM '._DB_PREFIX_.'importovane_vydajky WHERE id_stock_update ='.$id;
        $data = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($query);
        echo Tools::jsonEncode(array(
            'data2'=> $data,
            'use_parent_structure' => false,
            'data' => $this->dispFields($data)
        ));
        die();
    }
    
    public function dispFields($data) 
    {
        if(is_array($data))
            if(!empty($data)) {
                $ret = '<table><thead>';    
                $ret .= '<tr>';    
                $ret .= '<th>EAN</th>';    
                $ret .= '<th>Množstvo</th>';    
                $ret .= '</tr>';    
                $ret .= '</thead><tbody>';    
                foreach($data as $r){
                    $ret .= '<tr>';    
                    $ret .= '<td>'.$r['ean'].'</td>';    
                    $ret .= '<td>'.$r['imported'].'</td>';    
                    $ret .= '</tr>';                        
                }
                $ret .= '</tbody></table>';                     
            } else {
                $ret = 'Neexistujú záznami pre túto výdajku.';
            }
        return $ret;                   
    }

    
}