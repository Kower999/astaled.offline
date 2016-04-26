<?php

class Poplatky extends ObjectModel {
	public $id_product;
	public $id_poplatok;
	
	public static $definition = array(
		'primary' => 'id_poplatok',
		'table' => 'poplatky',
		'fields' => array(
			'id_poplatok' =>	     array('type' => self::TYPE_INT, 'required' => true, 'size' => 11),
			'popis' => 	             array('type' => self::TYPE_STRING, 'validate' => 'isString', 'size' => 255),
			'suma' =>	             array('type' => self::TYPE_FLOAT, 'validate' => 'isFloat'),
		)        
	);

}
