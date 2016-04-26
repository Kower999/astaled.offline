<?php

class Imports extends ObjectModel {
	public $id_employee;
	public $key;
	public $exported;
    public $imported;
//    public $reference;
//    public $my_date_add;
	
	public static $definition = array(
		'primary' => 'id_data_import',
		'table' => 'data_import',
		'fields' => array(
			'id_employee' => 	     array('type' => self::TYPE_INT, 'required' => true, 'size' => 11),
			'key' =>	             array('type' => self::TYPE_STRING, 'required' => true,),
			'exported' =>     	     array('type' => self::TYPE_INT, 'required' => true, 'size' => 11),
			'imported' =>     	     array('type' => self::TYPE_INT, 'required' => true, 'size' => 11),
//			'reference' =>     	     array('type' => self::TYPE_STRING, 'required' => false, 'size' => 32),
//			'my_date_add' => 			 array('type' => self::TYPE_DATE),			
		)        
	);
    
	/**
	* Check if object is not already imported.
	*/
    public function check()
    {
        $where = '`key` = "'.$this->key.'"
             AND `exported` = '.$this->exported.
//             ' AND `my_date_add` = "'.$this->my_date_add.'"'.
             ' AND `id_employee` = '.$this->id_employee;
//             ((empty($this->reference))?'':' AND reference = "'.$this->reference.'"');
             
        $sql = 'SELECT id_data_import FROM `'._DB_PREFIX_.'data_import` WHERE '.$where;
//            Tools::fd($sql);        
        $ret = Db::getInstance()->getValue($sql);
        return empty($ret);        
    }
    
    public function getImported()
    {
        $where =  '`key` = "'.$this->key.'"';
        $where .= ' AND `exported` = '.$this->exported;        
//        $where .= ' AND `my_date_add` = "'.$this->my_date_add.'"';
        if(!empty($this->id_employee)) $where .= ' AND `id_employee` = '.$this->id_employee;
//        if(!empty($this->reference)) $where .= ' AND reference = "'.$this->reference.'"';
             
        $sql = 'SELECT imported FROM `'._DB_PREFIX_.'data_import` WHERE '.$where;
//            Tools::fd($sql);        
        return Db::getInstance()->getValue($sql);                
    }

    public static function getImp($key,$exported,$employee)
    {
        $where =  '`key` = "'.$key.'"';
        $where .= ' AND `exported` = '.$exported;                     
        $where .= ' AND `id_employee` = '.$employee;
        $sql = 'SELECT imported FROM `'._DB_PREFIX_.'data_import` WHERE '.$where;
//        if((int)$exported == 34) var_dump($sql);
        return Db::getInstance()->getValue($sql);                
    }

    public static function getExp($key,$imported,$employee)
    {
        $where =  '`key` = "'.$key.'"';
        $where .= ' AND `imported` = '.$imported;                     
        $where .= ' AND `id_employee` = '.$employee;
        $sql = 'SELECT exported FROM `'._DB_PREFIX_.'data_import` WHERE '.$where;
//        if((int)$exported == 34) var_dump($sql);
        return Db::getInstance()->getValue($sql);                
    }
    
    public function getEmployee($exported , $date)
    {
//        return Db::getInstance()->getValue('SELECT id_employee FROM `'._DB_PREFIX_.'data_import` WHERE `key` = "id_customer" AND `exported` = '.$exported.' AND `my_date_add` = "'.$date.'"');
        return Db::getInstance()->getValue('SELECT id_employee FROM `'._DB_PREFIX_.'data_import` WHERE `key` = "id_customer" AND `exported` = '.$exported);
    }

}
