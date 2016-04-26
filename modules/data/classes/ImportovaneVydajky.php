<?php

class ImportovaneVydajky extends ObjectModel {
	public $id_employee;
	public $cislo;
	public $subor;
    public $imported;
//    public $reference;
//    public $my_date_add;
	
	public static $definition = array(
		'primary' => 'id_importovane_vydajky',
		'table' => 'importovane_vydajky',
		'fields' => array(
			'id_stock_update' => 	     array('type' => self::TYPE_INT, 'required' => true, 'size' => 11),
			'ean' =>	                 array('type' => self::TYPE_STRING, 'required' => true, 'size' => 20),
			'imported' =>     	         array('type' => self::TYPE_INT, 'required' => false, 'size' => 11),
		)        
	);
     
}
