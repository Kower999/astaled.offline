<?php

class ImportovaneVydajky extends ObjectModel {
	public $id_employee;
	public $cislo;
    public $imported;
    public $from;
    public $to;
	
	public static $definition = array(
		'primary' => 'id_importovane_vydajky',
		'table' => 'importovane_vydajky',
		'fields' => array(
			'id_stock_update' => 	     array('type' => self::TYPE_INT, 'required' => true, 'size' => 11),
			'ean' =>	                 array('type' => self::TYPE_STRING, 'required' => true, 'size' => 20),
			'imported' =>     	         array('type' => self::TYPE_INT, 'required' => false, 'size' => 11),
			'from' =>     	         array('type' => self::TYPE_INT, 'required' => false, 'size' => 11),
			'to' =>     	         array('type' => self::TYPE_INT, 'required' => false, 'size' => 11),
		)        
	);
     
}
