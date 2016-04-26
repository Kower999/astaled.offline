<?php

class StockUpdate extends ObjectModel {
	public $id_employee;
	public $cislo;
	public $subor;
    public $imported;
//    public $reference;
//    public $my_date_add;
	
	public static $definition = array(
		'primary' => 'id_stock_update',
		'table' => 'stock_update',
		'fields' => array(
			'id_employee' => 	     array('type' => self::TYPE_INT, 'required' => true, 'size' => 11),
			'cislo' =>	             array('type' => self::TYPE_STRING, 'required' => true,),
			'subor' =>     	         array('type' => self::TYPE_STRING, 'required' => true,),
			'imported' =>     	     array('type' => self::TYPE_INT, 'required' => true, 'size' => 11),
//			'reference' =>     	     array('type' => self::TYPE_STRING, 'required' => false, 'size' => 32),
//			'my_date_add' => 			 array('type' => self::TYPE_DATE),			
		)        
	);
    
    
    public function getNotImported($id_employee)
    {
             
        $sql = 'SELECT imported FROM `'._DB_PREFIX_.'stock_update` WHERE ( NOT `imported` = 1 ) AND `id_employee` = '.$id_employee;

        return Db::getInstance()->executeS($sql);                
    }

    public static function getAllNotImported()
    {
             
        $sql = 'SELECT * FROM `'._DB_PREFIX_.'stock_update` WHERE NOT `imported` = 1 ORDER BY id_employee ASC';

        return Db::getInstance()->executeS($sql);                
    }

    public static function getBySubor($subor)
    {
             
        $sql = 'SELECT id_stock_update FROM `'._DB_PREFIX_.'stock_update` WHERE `subor` = "'.$subor.'"';

        return (int)Db::getInstance()->getValue($sql);                
    }

}
