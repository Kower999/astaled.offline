<?php

class RecyPop extends ObjectModel {
	public $id_product;
	public $id_poplatok;
	
	public static $definition = array(
		'primary' => 'id_recypop',
		'table' => 'product_recypop',
		'fields' => array(
			'id_recypop' =>	         array('type' => self::TYPE_INT, 'required' => true, 'size' => 11),
			'id_product' => 	     array('type' => self::TYPE_INT, 'required' => true, 'size' => 11),
			'id_poplatok' => 	     array('type' => self::TYPE_INT, 'required' => true, 'size' => 11),
		)        
	);

}
